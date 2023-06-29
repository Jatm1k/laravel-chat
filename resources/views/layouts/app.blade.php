<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <title>Chat</title>
</head>
<body>
<div id="app">
    @auth()
        <auth-header></auth-header>
    @endauth
@yield('content')
</div>
</body>
</html>
