<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('./mains.css') }}">
    <link rel="stylesheet" href="{{ asset('./navbars.css') }}">
    <link rel="stylesheet" href="{{ asset('./listOfUsers.css') }}">
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
                <div style="width: 38%"></div>
                <form action = "./postExerciseFile" method="post" enctype = "multipart/form-data">
                    @csrf
                    <input type="file" name="myFile">
                    <input type="submit">
                </form>
            </div>
        @endif
        <div style="height: 10%"></div>
        <div style="height: 30%">
            <table id="t01">                                                 
                <tr>
                    <th>Code of exercise</th>
                    <th>Teacher</th>
                </tr>                                     
                @foreach($detailExercise as $ex)
                    <tr>
                        <td><a href="{{route('detailExercise', [$ex->id])}}">{{$ex->id}}</a></td>
                        <td>{{$ex->fullName}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endempty

    <!--  -->


    @isset($status)
        @if($userNow->isTeacher==0)
            <div style="height: 10%"></div>
            <div style="display:flex">
                <div style="width: 38%"></div>
                <form action = "./postHomeworkFile" method="post" enctype = "multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{$id}}" name="id">
                    <input type="file" name="myhomework">
                    <input type="submit">
                </form>
            </div>
        @endif
        <div style="height: 10%"></div>
        <div style="height: 30%">
            <table id="t01">                                                 
                <tr>
                    <th>Code of exercise</th>
                    <th>Teacher</th>
                    <th>Exercise</th>
                </tr>                                     
                @foreach($detailExercise as $ex)
                    <tr>
                    <td><a href="{{route('detailExercise', [$ex->id])}}">{{$ex->id}}</a></td>
                    <td>{{$ex->fullName}}</td>
                    <td><a href="./downloadExercise/<?php echo $ex->fileName;?>">{{$ex->fileName}}</a></td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div style="height: 35%">
            <table id="t01">                                                 
                <tr>
                    <th>Code of exercise</th>
                    <th>Student</th>
                    <th>Completed homework</th>
                </tr>                                     
                @foreach($detailHomework as $ex)
                    <tr>
                    <td>{{$ex->id}}</td>
                    <td>{{$ex->fullName}}</td>
                    <td><a href="./downloadHomework/<?php echo $ex->fileName;?>">{{$ex->fileName}}</a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endisset
</body>

