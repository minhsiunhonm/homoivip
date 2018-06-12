<!-- <script src="{{url('public')}}/js/jquery-3.3.1.min.js"></script>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Upload file vs Ajax</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body>
  <form enctype="multipart/form-data" id="upload_form" role="form" method="POST" action="" >
    <div class="form-group">
      <label for="catagry_name">Name</label>
      <input type="hidden" name="_token" value="{{ csrf_token()}}">
      <input type="text" class="form-control" id="catagry_name" placeholder="Name">
      <p class="invalid">Enter Catagory Name.</p>
    </div>
    <div class="form-group">
      <label for="catagry_name">Logo</label>
      <input type="file" name="logo" class="form-control" id="catagry_logo">
      <p class="invalid">Enter Catagory Logo.</p>
    </div>

  </form>
</div>
<div class="modelFootr">
  <button type="button" class="addbtn">Add</button>
  <button type="button" class="cnclbtn">Reset</button>
</div>
</div>
</body>
</html>
<script>
  $(".addbtn").click(function(){
    $.ajax({
      url : "{{url('eavatarajxx')}}",
      type : "post",
      async:false,
      processData: false,
      contentType: false,
      dataType:"json",
      data : new FormData($("#upload_form")[0]),
      success : function (result){
        alert('s');
      }
    });
    // $.ajax({
    //   url:'add-catagory',
    //   data:new FormData($("#upload_form")[0]),
    //   dataType:'json',
    //   async:false,
    //   type:'post',
    //   processData: false,
    //   contentType: false,
    //   success:function(response){
    //     alert(response);
    //   },
    // });
  });

</script> -->