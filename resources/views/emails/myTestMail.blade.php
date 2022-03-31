<!DOCTYPE html>
<html>
<head>
    <title>Account Credentials</title>
</head>
<body>
    <h1>{{ $mailData['title'] }}</h1>
    <p>Congratulations, {{ $mailData['name'] }},</p>
    <p>Your account has been created. Now you can login using following credentials<br/>
        Username:-{{ $mailData['username'] }}<br/>
        Password:-{{ $mailData['password'] }}
        
        </p>
    <p>Thank you</p>
</body>
</html>