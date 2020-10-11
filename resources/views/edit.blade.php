<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="">
    <style>
    .editForm{
        padding-top: 100px;
        padding-bottom: 20px;
        height: 80%;
        border: none;
        background-color: rgb(199, 175, 175, 0.5);
    }

    .submit{
        background-color: rgb(199, 175, 175);
        color: white;
        padding: 14px 20px;
        margin-top: 100px;
        margin-bottom: 100px;
        border-color: black;
        cursor: pointer;
        border: none;
        width: 60%;
        font-size: 20px;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }

    .box{
        padding: 5px;
        margin-top: 10px;
        cursor: pointer;
        width: 60%;
        border-color: black;
        border: none;
        background-color: floralwhite;
    }

    .string{
        padding: 0;
        margin-top: 10px;
        cursor: pointer;
        width: 60%;
        font-size: 20px;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }
    body{
        background-color: floralwhite;
    }
    </style>
</head>

<div style="display: flex">
    <div style="width:35%"></div>
    <div style="width:30%">
        <div style="height:20%"></div>
        <form action="{{route('editComplete')}}" method = "POST" class="editForm">       <!--Tạo form để điền-->
        @csrf
            <div style="display:flex">
                <div style="width:20%"></div>
                <label for="password" class="string">Password:</label><br>
            </div>
            <div style="display:flex">
                <div style="width:20%"></div>
                <input type="password" id="password" name="password" class="box" value='' ><br>
            </div>
            <div style="display:flex">
                <div style="width:20%"></div>
                <label for="email" class="string">Email:</label><br>
            </div>
            <div style="display:flex">
                <div style="width:20%"></div>
                <input type="text" id="email" name="email" class="box" value={{$students->email}} ><br>
            </div>
            <div style="display:flex">
                <div style="width:20%"></div>
                <label for="phoneNumber" class="string">Phone number:</label><br>
            </div>
            <div style="display:flex">
                <div style="width:20%"></div>
                <input type="text" id="phoneNumber" name="phoneNumber" class="box" value={{$students->phoneNumber}} ><br>
            </div>
            <div style="display:flex">
                <div style="width:20%"></div>
                <input type="submit" value="Save" class="submit">
            </div>    
        </form>
    </div>
</div>
