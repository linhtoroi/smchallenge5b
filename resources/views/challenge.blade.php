<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('./mains.css') }}">
    <link rel="stylesheet" href="{{ asset('./navbars.css') }}">
    <link rel="stylesheet" href="{{ asset('./listOfUsers.css') }}">
    <style>
        .answerChallenge{
            font-size: 30px;
            background-color: rgb(199, 175, 175, 0);
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color: rgb(199, 175, 175);
            margin-right: 20px;
            border: none;
        }
        .submitChallenge{
            font-size: 30px;
            background-color: rgb(199, 175, 175, 0);
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color: rgb(199, 175, 175);
            margin-right: 20px;
            border: none;
        }
    </style>
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
    @empty($status)
        @if($userNow->isTeacher==1)
            <div style="height: 10%"></div>
            <div style="display:flex">
                <div style="width: 35%"></div>
                <form action = "./postChallengeFile" method="post" enctype = "multipart/form-data">
                    @csrf
                    <input type="text" name="hint">
                    <input type="file" name="myFile">
                    <input type="submit">
                </form>
            </div>
        @endif
    @endempty
    <div style="height: 10%"></div>
    <div style="height: 30%">
    <table id="t01">                                                 
            <tr>
                <th>Code of Challenge</th>
                <th>Teacher</th>
                <th>Hint</th>
            </tr>                                     
            @foreach($detailChallenge as $ex)
                <tr>
                <td><a href="{{route('detailChallenge', [$ex->id])}}">{{$ex->id}}</a></td>
                <td>{{$ex->fullName}}</td>
                <td>{{$ex->hint}}</td>
                </tr>
            @isset($status)
                <tr>
                <td>Answer</td>
                <form action = "http://localhost:8080/sm/public/answerChallenge" method="post">
                @csrf
                <td><input type="hidden" value={{$ex->id}} name="id">
                <input type="text" name="answer" placeholder="Write your answer here" class="answerChallenge" required></td>
                <td><input type="submit" class="submitChallenge"></td>
                </form>
                </tr>
            @endisset
            @endforeach
    </table>
    </div>
</body>

