
<!-- {{route('postFile')}} -->
<form action = "./postFile" method="post" enctype = "multipart/form-data">
    @csrf
    <input type="file" name="myFile">
    <input type="submit">
</form>
<a href="./download/1.txt">File Name</a> 