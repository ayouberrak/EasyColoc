<div class="h-full max-w-5xl mx-auto flex flex-col bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden" style="height: calc(100vh - 12rem); min-height: 500px;">
    
    <!-- Header -->
    <div class="px-6 py-4 flex items-center justify-between border-b border-slate-100 bg-white z-10">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-lg">
                #
            </div>
            <div>
                <h3 class="text-base font-bold text-slate-800">{{ $colocation->name }}</h3>
                <div class="flex items-center gap-2">
                    <span id="online-indicator" class="w-2 h-2 rounded-full bg-slate-300"></span>
                    <span id="online-count" class="text-xs font-medium text-slate-500">Connexion...</span>
                </div>
            </div>
        </div>
        
        <div class="flex items-center">
            <div class="flex -space-x-2">
                @foreach($colocation->members->take(5) as $m)
                    <div class="w-8 h-8 rounded-full border-2 border-white bg-slate-100 flex items-center justify-center text-xs font-bold text-slate-600" title="{{ $m->user->name }}">
                        {{ substr($m->user->name, 0, 1) }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Messages Container -->
    <div id="messages-container" class="flex-1 overflow-y-auto p-6 space-y-4 bg-slate-50 lg:px-12">
        <div id="chat-loader" class="flex flex-col items-center justify-center h-full text-slate-400">
            <svg class="animate-spin w-6 h-6 mb-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <circle cx="12" cy="12" r="10" stroke-width="3" stroke="currentColor" class="opacity-25"></circle>
                <path d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" class="opacity-75" fill="currentColor"></path>
            </svg>
            <span class="text-xs">Chargement...</span>
        </div>
    </div>

    <!-- Input Form -->
    <div class="p-4 bg-white border-t border-slate-100">
        <form id="chat-form" class="flex items-center gap-3 max-w-4xl mx-auto">
            @csrf
            <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">
            <input type="text" id="chat-input" name="content" autocomplete="off" required
                class="flex-1 bg-slate-100 border-transparent focus:border-blue-500 focus:ring-0 rounded-full px-6 py-3 text-sm text-slate-800 placeholder-slate-400"
                placeholder="Écrivez un message...">
            <button type="submit" id="send-btn"
                class="w-12 h-12 rounded-full bg-blue-600 hover:bg-blue-700 text-white flex items-center justify-center transition-colors disabled:opacity-50 disabled:cursor-not-allowed shrink-0">
                <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
            </button>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const colocationId = {{ $colocation->id }};
    const userId = {{ auth()->id() }};

    const messagesContainer = document.getElementById("messages-container");
    const chatForm = document.getElementById("chat-form");
    const chatInput = document.getElementById("chat-input");
    const sendBtn = document.getElementById("send-btn");

    fetch("/chat/" + colocationId)
        .then(response => response.json())
        .then(messages => {

            messagesContainer.innerHTML = "";

            if (messages.length === 0) {
                messagesContainer.innerHTML =
                    "<p class='text-center text-slate-400'>Aucun message</p>";
            }

            messages.forEach(msg => {
                afficherMessage(msg);
            });

            scrollBas();
        });


    chatForm.addEventListener("submit", function (e) {

        e.preventDefault();

        let text = chatInput.value.trim();

        if (text === "") return;

        chatInput.value = "";
        sendBtn.disabled = true;

        let socketId = null;
        if (window.Echo) {
            socketId = window.Echo.socketId();
        }

        fetch("/chat", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                "X-Socket-ID": socketId
            },
            body: JSON.stringify({
                colocation_id: colocationId,
                content: text
            })
        })
        .then(response => response.json())
        .then(data => {

            if (!document.querySelector(`[data-message-id="${data.message.id}"]`)) {
                let emptyMessageText = messagesContainer.querySelector('.text-slate-400.text-center');
                if (emptyMessageText) messagesContainer.innerHTML = '';
                
                afficherMessage(data.message);
                scrollBas();
            }

        })
        .finally(() => {

            sendBtn.disabled = false;
            chatInput.focus();

        });

    });


    if (window.Echo) {

        window.Echo.private("colocation." + colocationId)
            .listen(".message.sent", (e) => {
                
                if (document.querySelector(`[data-message-id="${e.message.id}"]`)) return;

                let emptyMessageText = messagesContainer.querySelector('.text-slate-400.text-center');
                if (emptyMessageText) messagesContainer.innerHTML = '';

                afficherMessage(e.message);
                scrollBas();

            });

    }


    function afficherMessage(msg) {

        let isMe = msg.user_id === userId;

        let nom = isMe ? "Vous" : (msg.user ? msg.user.name : "Inconnu");

        let date = new Date(msg.created_at);
        let heures = date.getHours().toString().padStart(2, '0');
        let minutes = date.getMinutes().toString().padStart(2, '0');
        let heure = heures + ":" + minutes;

        let position = isMe ? "justify-end" : "justify-start";
        
        let bulleStyle = isMe
            ? "bg-blue-600 text-white rounded-2xl rounded-tr-sm shadow-sm"
            : "bg-white text-slate-700 border border-slate-100 rounded-2xl rounded-tl-sm shadow-sm";
            
        let colorNom = isMe ? "text-slate-400" : "text-blue-600 font-semibold";

        let html = `
        <div class="flex w-full ${position} mb-4" data-message-id="${msg.id}">

            <div class="flex flex-col ${isMe ? 'items-end' : 'items-start'} max-w-[85%] md:max-w-[70%]">

                <span class="text-[11px] mb-1 px-2 ${colorNom}">${nom}</span>

                <div class="px-5 py-3 text-[14px] leading-relaxed ${bulleStyle}">
                    ${msg.content}
                </div>

                <span class="text-[10px] text-slate-400 mt-1 px-2">${heure}</span>

            </div>

        </div>
        `;

        messagesContainer.insertAdjacentHTML("beforeend", html);

    }


    function scrollBas() {

        messagesContainer.scrollTop =
            messagesContainer.scrollHeight;

    }

});
</script>

<style>
#messages-container::-webkit-scrollbar { width: 6px; }
#messages-container::-webkit-scrollbar-track { background: transparent; }
#messages-container::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
</style>