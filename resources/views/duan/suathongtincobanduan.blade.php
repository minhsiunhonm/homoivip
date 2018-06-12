@foreach($project as $pr)
<div class="col-md-6" style=";padding-bottom: 50px;">
  <h3><b>Chỉnh sửa thông tin cơ bản của dự án.</b></h3>
  <form action="{{route('suattcoban')}}" id="formbayttcb" method="post">
    @csrf
    <input type="hidden" name="id" value="{{$pr->id}}">
    <input type="hidden" id="xttenduan" name="tenduan">
    <input type="hidden" id="xtmotangan" name="motangan">
    <input type="hidden" id="xtadress" name="adress">
    <input type="hidden" id="xttag" name="tag">
    <input type="hidden" id="xtnganhnghe" name="nganhnghe">
    <input type="hidden" id="xtcity" name="city">
  </form>
  <div class="form-group">
    <label>Tên dự án của bạn</label> <span id="demtenduan" style="float: right;color: #b3b2b2;" ></span>
    <input type="text" id="tenduan" onkeyup="checkkytu('tenduan')" value="{{$pr->name}}" name="tenduan" class="form-control">
    <span style="float: right;color: #b3b2b2;font-size: 11px;">230 ký tự</span>
  </div>
  <div class="form-group">
    <label >Mô tả ngắn về dự án của bạn</label><span id="demmotangan" style="float: right;color: #b3b2b2;" ></span>
    <textarea style="max-width: 100%;min-width: 100%;min-height: 120px;" type="text" class="form-control" id="motangan"  rows="3" onkeyup="checkkytu('motangan')"  >{{$pr->short_description}}</textarea>
    <span style="float: right;color: #b3b2b2;font-size: 11px;">500 ký tự</span>
  </div>
  <div class="form-group">
    <label>Địa điểm thực hiện dự án</label><span id="demadress" style="float: right;color: #b3b2b2;" ></span>
    <input value="{{$pr->place}}" onkeyup="checkkytu('adress')"  id="adress" type="text" class="form-control">
    <span style="float: right;color: #b3b2b2;font-size: 11px;">230 ký tự</span>
  </div>
  <div class="form-group">
    <label>Thành phố</label> 
    <select name="city" id="city" class="form-control">
      @foreach($city as $ci)
        <option @if($ci->id == $pr->id_city) selected @endif  value="{{$ci->id}}">{{$ci->name}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label>Từ khóa</label> 
    <input value="{{$pr->tag}}" id="tag" type="text" class="form-control">
    <span style="float: right;color: #b3b2b2;font-size: 11px;">Cách nhau bằng dấu phẩy ","</span>
  </div>
  <div class="form-group">
    <label>Ngành nghề</label> 
    <select name="nganhnghe" id="nganhnghe" class="form-control">
      @foreach($career as $ca)
        <option @if($ca->id == $pr->id_career) selected @endif value="{{$ca->id}}">{{$ca->name}}</option>
      @endforeach
    </select>
  </div>
  <button type="button" onclick="kiemtra()" @if($status == 2 || $status == 3 || $status == 4) disabled="" @endif class="btn btn-primary">Lưu</button>
  @if(count($errors)>0)
  <ul class="tb" style="color:red;margin-top: 20px;list-style: none;">
    @foreach ($errors->all() as $error)
    <li class="text-red">
      {{$error}}
    </li>
    @endforeach
  </ul>
  @endif
</div>
<div class="col-md-6" style="padding-bottom: 50px;">
  @foreach($project as $pr)
  <span id="bvideo" style="cursor: pointer;font-size: 24px;margin: 20px 20px 20px 0;float: left;color: #333" style="cursor: pointer;" onclick="nutvideo('video')"><b>Video</b></span>
  <span id="blogo" style="cursor: pointer;font-size: 24px;margin: 20px 20px 20px 0;float: left;color: #b1b1b1" style="cursor: pointer;" onclick="nutvideo('logo')"><b>Logo dự án</b></span>
  <span id="bbanner" style="cursor: pointer;font-size: 24px;margin: 20px 20px 20px 0;float: left;color: #b1b1b1" style="cursor: pointer;" onclick="nutvideo('banner')"><b>Banner dự án</b></span>
  <form style="background-color: #fff;" id="video" action="{{route('thayvideo')}}" id="formbay" method="post" enctype="multipart/form-data">
    <iframe style="width: 100%;height: 300px" src="https://www.youtube.com/embed/{{$pr->video}}?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    @csrf
    <input type="hidden" name="id" value="{{$id}}">
    <div class="form-group">
      <label>ID video youtube</label>
      <input type="text" id="video" value="{{$pr->video}}" name="video" class="form-control">
    </div>
    <button type="submit"  class="btn btn-primary">Thay Id video</button>
  </form>
  <form style="background-color: #fff;display: none;" id="logo" action="{{route('thayavatar')}}" id="formbay" method="post" enctype="multipart/form-data">
    <img onclick="getFile()" src="{{url('public/fileupload/'.$pr->avatar)}}" onmouseover="$('.checkavatar').css('opacity','0.7')" onmouseout="$('.checkavatar').css('opacity','0')" id="imglogo" style="width: 150px;height: 150px; cursor: pointer;">
    <div class="checkavatar">
      Thay avatar
    </div>
    @csrf
    <input type="hidden" name="id" value="{{$id}}">
    <div class="form-group">
      <div class="custom-file" style="">
        <input name="myfile" type="file" style="display: none;" class="custom-file-input" id="customFilelogo">
        <style type="text/css">
          .markcss {
            width: 100%;
            border: 2px dashed #bbb;
            border-radius: 5px;
            padding: 25px;
            text-align: center;
            color: #000;
            font-weight: bold;
            cursor: pointer;
          }
          .checkbanner {
            background-color: #333;
            width: 380px;
            color: #fff;
            text-align: center;
            padding: 10px;
            font-size: 16px;
            opacity: 0;
          }
          .checkavatar {
            background-color: #333;
            width: 150px;
            color: #fff;
            text-align: center;
            padding: 10px;
            font-size: 16px;
            opacity: 0;
          }
        </style>
        <script type="text/javascript">
          function getFile(){
            document.getElementById("customFilelogo").click();
          }
          function readURL(input) {
            if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function(e) {
                $('#imglogo').attr('src', e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
            }
          }
          $("#customFilelogo").change(function() {
            readURL(this);
          });
        </script>
      </div>
    </div>
    <button type="submit"  class="btn btn-primary">Xác nhận</button>
  </form>
  <form style="background-color: #fff;display: none;cursor: pointer;" id="banner" action="{{route('thaybanner')}}" id="formbay" method="post" enctype="multipart/form-data">
    <img onclick="getFilebanner()" onmouseover="$('.checkbanner').css('opacity','0.7')" onmouseout="$('.checkbanner').css('opacity','0')" src="{{url('public/fileupload/'.$pr->banner)}}" id="imgbanner" style="width: 380px;height: 230px;color: pointer">
    <div class="checkbanner">
      Thay banner
    </div>
    @csrf
    <input type="hidden" name="id" value="{{$id}}">
    <div class="form-group">
      <div class="custom-file" style="margin-top: 30px;">
        <input name="myfile" type="file" style="display: none;" class="custom-file-input" id="customFilebanner"> 
        <script type="text/javascript">
          function getFilebanner(){
            document.getElementById("customFilebanner").click();
          }
          function readURLbn(input) {
            if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function(e) {
                $('#imgbanner').attr('src', e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
            }
          }
          $("#customFilebanner").change(function() {
            readURLbn(this);
          });
        </script>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Xác nhận</button>
  </form>
  @endforeach
</div>
<script type="text/javascript">
  function checkkytu(data) {
      if (data == 'tenduan') {
          getdt = document.getElementById(data);
          document.getElementById('demtenduan').innerHTML = getdt.value.length;
          if (getdt.value.length > 230) {
              getdt.style.color = 'red';
          }else{
              getdt.style.color = '#333';
          }
      }
      if(data == 'motangan') {
          getdt = document.getElementById(data);
          document.getElementById('demmotangan').innerHTML = getdt.value.length;
          if (getdt.value.length > 500) {
              getdt.style.color = 'red';
          }else{
              getdt.style.color = '#333';
          }
      }
      if(data == 'adress') {
          getdt = document.getElementById(data);
          document.getElementById('demadress').innerHTML = getdt.value.length;
          if (getdt.value.length > 230) {
              getdt.style.color = 'red';
          }else{
              getdt.style.color = '#333';
          }
      }
  }
  function kiemtra() {
      tenduan = document.getElementById('tenduan').value;
      motangan = document.getElementById('motangan').value;
      adress = document.getElementById('adress').value;
      tag = document.getElementById('tag').value;
      if (tenduan.length < 231 && motangan.length < 501 && adress.length <231 &&tenduan.length != '' && motangan.length != '' && adress.length != '' ) {
          document.getElementById('xttenduan').value= tenduan;
          document.getElementById('xtmotangan').value= motangan;
          document.getElementById('xtadress').value= adress;
          document.getElementById('xttag').value = tag;
          document.getElementById('xtnganhnghe').value = document.getElementById('nganhnghe').value;
          document.getElementById('xtcity').value = document.getElementById('city').value;
          document.getElementById('formbayttcb').submit();
      }
  }
  function nutvideo(id) {
      if (id == 'video') {
          document.getElementById('video').style.display = 'block';
          document.getElementById('logo').style.display = 'none';
          document.getElementById('banner').style.display = 'none';
          document.getElementById('bvideo').style.color = '#333';
          document.getElementById('blogo').style.color = '#b1b1b1';
          document.getElementById('bbanner').style.color = '#b1b1b1';
      }
      if (id == 'logo') {
          document.getElementById('video').style.display = 'none';
          document.getElementById('logo').style.display = 'block';
          document.getElementById('banner').style.display = 'none';
          document.getElementById('bvideo').style.color = '#b1b1b1';
          document.getElementById('blogo').style.color = '#333';
          document.getElementById('bbanner').style.color = '#b1b1b1';
      }
      if (id == 'banner') {
          document.getElementById('video').style.display = 'none';
          document.getElementById('logo').style.display = 'none';
          document.getElementById('banner').style.display = 'block';
          document.getElementById('bvideo').style.color = '#b1b1b1';
          document.getElementById('blogo').style.color = '#b1b1b1';
          document.getElementById('bbanner').style.color = '#333';
      }
  }
</script>
@endforeach
