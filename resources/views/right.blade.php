<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="mains.css">
    <link rel="stylesheet" href="navbars.css">
    <link rel="stylesheet" href="listOfUsers.css">
    
</head>
<body>
    <div>
        <ul>
            <li><a href='http://localhost:8080/sm/public/listOfUsers'>Homepage</a></li>
            <li><a href='http://localhost:8080/sm/public/exercise'>Exercise</a></li>
            <li><a href='http://localhost:8080/sm/public/message'>Message</a></li>
            <li><a href='http://localhost:8080/sm/public/challenge'>Challenge</a></li>
            <li style="float:right"><a href="{{route('detail', [$userNow->username])}}">{{$userNow->username}}</a></li>
            <li style="float:right"><a href="{{route('logout')}}">Sign Out</a></li>
        </ul>
    </div>
    @isset($contentChallenge)
        <h1>Right!!!</h1>
        @foreach($contentChallenge as $ct)
            {{$ct}}<br>
        @endforeach
    @endisset
</body>