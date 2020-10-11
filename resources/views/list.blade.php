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
    <div style="display: flex">
        @isset($detail)
            @if($username != $userNow->username)
                <div class='edit'><a href="{{route('detailMessage', [$username])}}"><img src="{{ asset('image/voice-message.png') }}" alt='Message' style='float:right;width:100px;height:100px;'></a></div>
            @endif
            @isset($students)
                @if($username == $userNow->username)
                    <div class='edit'><a href="{{route('edit')}}"><img src="{{ asset('image/user.png') }}" alt='EDIT' style='float:right;width:100px;height:100px;'></a></div>
                @endif
                @if($userNow->isTeacher == 1) <!--sua nha-->
                <div class='edit'><a href="{{route('editForTeacher', [$username])}}"><img src="{{ asset('image/user.png') }}" alt='EDIT' style='float:right;width:100px;height:100px;'></a></div>
                <div class='edit'><a href="{{route('delete', [$username])}}"><img src="{{ asset('image/userdelete.png') }}" alt='DELETE' style='float:right;width:100px;height:100px;'></a></div>
                @endif
            @endisset
        @endisset
    </div>
    <div style="display: flex">
        <div style="width: 40%"></div>
        <div class="selectButton">
        <a href="{{route('listOfUsersType', ['1'])}}" name="all" class = "detailButton">All</a>
        <a href="{{route('listOfUsersType', ['2'])}}" name="student" class = "detailButton">Student</a>
        <a href="{{route('listOfUsersType', ['3'])}}" name="teacher" class = "detailButton">Teacher</a>
        </div>
        <!-- <form action="http://localhost:8080/sm/public/listOfUsers" method = "POST" class="selectButton">    
            <input type="submit" name="all" class = "detailButton" value="All">
            <input type="submit" name="student" class = "detailButton" value="Student">
            <input type="submit" name="teacher" class = "detailButton" value="Teacher">
        </form> -->
    </div>
    
<!-- <form action="http://localhost:8080/sm/public/listOfUsers/18020758" method="get">
<input type="submit"> -->
</form>

@isset($students)
    @empty($teachers)
        <table id="t01">                                                 
            <tr>
                <th>Account</th>
                <th>Email</th>
                <th>Full Name</th>
                <th>Phone Number</th>
            </tr>                                     
            @foreach($students as $student)
                <tr>
                <td><a href="{{route('detail', [$student->account])}}">{{$student->account}}</a></td>
                <td>{{$student->email}}</td>
                <td>{{$student->fullName}}</td>
                <td>{{$student->phoneNumber}}</td>
                </tr>
            @endforeach
        </table>
    @endempty
    @isset($teachers)
        <table id="t01">                                                 
            <tr>
                <th>Account</th>
                <th>Email</th>
                <th>Full Name</th>
                <th>Phone Number</th>
            </tr>                                     
            @foreach($students as $student)
                <tr>
                <td><a href="{{route('detail', [$student->account])}}">{{$student->account}}</a></td>
                <td>{{$student->email}}</td>
                <td>{{$student->fullName}}</td>
                <td>{{$student->phoneNumber}}</td>
                </tr>
            @endforeach
            @foreach($teachers as $teacher)
                <tr>
                <td><a href="{{route('detail', [$teacher->account])}}">{{$teacher->account}}</a></td>
                <td>.</td>
                <td>{{$teacher->fullName}}</td>
                <td>.</td>
                </tr>
            @endforeach
        </table>
    @endisset
@endisset

@isset($teachers)
    @empty($students)
    <table id="t01">                                                 
        <tr>
            <th>Account</th>
            <th>Full Name</th>
        </tr>                                     
        @foreach($teachers as $teacher)
                <tr>
                <td><a href="{{route('detail', [$teacher->account])}}">{{$teacher->account}}</a></td>
                <td>{{$teacher->fullName}}</td>
                </tr>
            @endforeach
    </table>
    @endempty
@endisset
</body>

