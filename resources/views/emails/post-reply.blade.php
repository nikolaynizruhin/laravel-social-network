<!doctype html>
<html>
<head>
    <title></title>
</head>
<body>
    <h1>Hi, {{ $recipient->name }}!</h1>
    <h3>You got a reply from <a href="http://homestead.app/{{ $sender->username }} }}">{{ $sender->name }}</a>. Please take a look.</h3>
</body>
</html>