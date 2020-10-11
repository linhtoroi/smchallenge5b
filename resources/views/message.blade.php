<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('./mains.css') }}">
    <link rel="stylesheet" href="{{ asset('./navbars.css') }}">
    <link rel="stylesheet" href="{{ asset('./listOfUsers.css') }}">
    <link rel="stylesheet" href="{{ asset('./message.css') }}">
    <style>
        
    .message{
        color: floralwhite;
        padding-top: 2px;
        margin-top: 2px;
        margin-right: 0px;
        font-size: 24px;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }
    body{
        margin: 0px;
        background-color: floralwhite;
    }
    .delete{
        border: none;
        background-color: floralwhite;
    }
    .change{
        border: none;
        margin-left: 5px;
        background-color: floralwhite;
    }
    .hide{
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
        border:none;
        color:red;
    }
    .box-chat1{
        /* scroll-behavior: smooth; */
        /* height:150px; */
        overflow-y: scroll;
        color: floralwhite;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        font-size: 35px;
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
    @empty($send)
    <div class="container">
        <div style="width: 10%"></div>
        <div class="list" style="width: 25%">
            <div class="box-chat1" style="height: 80%">
                <p>MESSAGEs</p>
                @foreach($accountSenders as $ac)
                    <a href="{{route('myMessage', [$ac->accountSender])}}">{{$ac->accountSender}}</a>
                    <br>
                @endforeach
            </div>
        </div>
        <div style="width: 10%"></div>

        <div style="width: 40%">
            <div style="height: 10%"></div>
            <div class="list" style="width: 100%">
                <div class="box-chat1" style="height: 60%">
                @isset($contents)
                    From {{$nameSender}}:
                    <br>
                    <br>
                    @foreach($contents as $ct)
                    @if($ct!='')
                        {{$ct}}
                        <br>
                    @endif
                    @endforeach
                @endisset
                </div>
            </div>
        </div>
    </div>
    @endempty
    @isset($send)
    <div class="container">
        <div style="width: 10%"></div>
        <div class="list" style="width: 50%">
            <div class="box-chat1" style="height: 60%">
                @foreach($contents as $key => $ct)
                    @if($ct!='')
                    <div style="display:flex">
                    {{$ct}}
                    <div style="width: 2%"></div>
                    <form action="{{route('messageDelete')}}" method="post">
                     @csrf
                        <input type="hidden" name="userRe" value={{$userRe}}>
                        <input type="hidden" name="line" value={{$key}}>
                        <input type="submit" name="delete" value="delete">
                    </form>
                    <!-- {{route('messageEdit')}} -->
                    <form action="{{route('openMessageEdit')}}" method="post">
                     @csrf
                        <input type="hidden" name="userRe" value={{$userRe}}>
                        <input type="hidden" name="line" value={{$key}}>
                        <input type="submit" name="edit" value="edit">
                    </form>
                    </div>
                    @endif
                @endforeach
            </div>
            <div class="box-chat2" style="height:20%">
                <form action="{{route('inbox')}}" method="post">
                    @csrf
                    <input type="hidden" name="user" value={{$userRe}}>
                    <input type="text" name="message" class="box-chat" required>
                    <input type="submit" name="submit" class="submitChat" value="submit" style="color: floralwhite;">
                </form>
            </div>
        </div>
        @isset($openEdit)
        <div style="width: 5%"></div>
        <div class="list" style="width: 40%">
            <div style="height: 50%"></div>
            <div class="box-chat2" style="height:30%">
                <form action="{{route('messageEdit')}}" method="post">
                    @csrf
                    <input type="hidden" name="userRe" value={{$userRe}}>
                    <input type="hidden" name="line" value={{$line}}>
                    <input type="text" name="messageEdit" class="box-chat" required>
                    <input type="submit" name="edit" class="submitChat" value="submit" style="color: floralwhite;">
                </form>
            </div>
        </div>
        <div style="width: 10%"></div>
        @endisset
    </div>
    @endisset
    
</body>

