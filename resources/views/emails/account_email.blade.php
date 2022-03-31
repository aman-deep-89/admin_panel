<!DOCTYPE html>
<html>
<head>
    <title>Account Credentials</title>
</head>
<body>
    <h1>{{ $mailData['title'] }}</h1>
    <p>Congratulations, {{ $mailData['name'] }},</p>
    <p>Your account has been created. Now you can login using following credentials</p>
    <table border="1">
        <tr><th>Product</th><th>Username</th><th>Password</th><th>Start Date</th><th>End Date</th></tr>
        @foreach($mailData['detail'] as $val)
            <tr><th>{{$mailData['product'] }}</th><th>{{$val['username'] }}</th><th>{{$val['password'] }}</th><th>{{$val['start_date'] }}</th><th>{{$val['end_date'] }}</th></tr>
        @endforeach
    </table>
    <p>Thank you</p>
</body>
</html>