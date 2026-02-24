<!DOCTYPE html>
<html>
<head>
    <title>Invitation EasyColoc</title>
</head>
<body style="font-family: sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background-color: #f8fafc; padding: 40px; border-radius: 20px; border: 1px solid #e2e8f0;">
        <h1 style="color: #2563eb; margin-bottom: 20px;">Bonjour ! </h1>
        <p style="font-size: 16px;">Vous avez été invité à rejoindre la colocation <strong>{{ $invitation->colocation->name }}</strong> sur EasyColoc.</p>
        <p style="font-size: 14px; color: #64748b;">EasyColoc vous aide à gérer vos dépenses, vos paiements et la vie en communauté sans stress.</p>
        
        <div style="margin-top: 30px; text-align: center;">
            <a href="{{ route('invitations.show', $invitation->token) }}" style="background-color: #2563eb; color: white; padding: 12px 24px; border-radius: 12px; text-decoration: none; font-weight: bold; display: inline-block;">Rejoindre la colocation</a>
        </div>
        
        <p style="margin-top: 40px; font-size: 12px; color: #94a3b8;">Si vous n'êtes pas à l'origine de cette demande, vous pouvez ignorer cet email.</p>
        <p style="font-size: 12px; color: #94a3b8;">EasyColoc - La gestion de colocation simplifiée.</p>
    </div>
</body>
</html>
