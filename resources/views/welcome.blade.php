<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@auth
    <div>name : {{ Auth::user()->name }}</div>
    <div>email : {{ Auth::user()->name }}</div>
    <div>avatar : <img src="{{ Auth::user()->avatar }}" alt=""></div>
    <div>provider_id : {{ Auth::user()->provider_id }}</div>
    <div>platform : {{ Auth::user()->platform }}</div>
@endauth

@guest
    <a href="{{ route('social-login.redirect',['social_platform'=>'google']) }}">google login</a>
@endguest
</body>
</html>
