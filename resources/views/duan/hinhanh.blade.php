@include('layouts.headermini')
<article class="duan" style="height: auto;background-color: #F2F2F0;min-height: 980px;">
    <div class="container" id="companybox">
        <div class="row">
            <h2 style="margin-bottom: 20px;width: 100%;"><b>Thêm nội dung.</b> <span><a  style="float: right;font-size: 16px;padding-top: 10px" target="_blank" href="{{url('duan')}}">Quay lại</a></span></h2>
            <hr style="border: solid 1px #b1b1b1">
            <div class="col-md-1"></div>
            <div class="col-md-8" >
                @foreach($project as $pro)
                <form style="background-color: #fff;padding: 20px;" action="{{route('thayvideo')}}" id="formbay" method="post" enctype="multipart/form-data">
                  <h4>Video</h4>
                  <iframe style="width: 100%;height: 500px" src="https://www.youtube.com/embed/{{$pro->video_slide}}?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                  @csrf
                  <input type="hidden" name="id" value="{{$id}}">
                  <div class="form-group">
                    <label>ID video youtube</label>
                    <input type="text" id="video_slide" value="{{$pro->video_slide}}" name="video_slide" class="form-control">
                  </div>
                  <button type="submit" class="btn btn-primary">Thay Id video</button>
                </form>
                <hr>
                <form style="background-color: #fff;padding: 20px;" action="{{route('thayavatar')}}" id="formbay" method="post" enctype="multipart/form-data">
                  <h4>Logo dự án</h4>
                  <img src="{{url('public/fileupload/'.$pro->avatar)}}" style="width: 300px;">
                  @csrf
                  <input type="hidden" name="id" value="{{$id}}">
                  <div class="form-group">
                    <div class="custom-file" style="margin-top: 30px;">
                        <input name="myfile" type="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Logo dự án</label>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Thay logo</button>
                </form>
                <hr>
                <form style="background-color: #fff;padding: 20px;" action="{{route('thaybanner')}}" id="formbay" method="post" enctype="multipart/form-data">
                  <h4>Banner dự án</h4>
                  <img src="{{url('public/fileupload/'.$pro->banner)}}" style="width: 100%;">
                  @csrf
                  <input type="hidden" name="id" value="{{$id}}">
                  <div class="form-group">
                    <div class="custom-file" style="margin-top: 30px;">
                        <input name="myfile" type="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Banner dự án</label>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Thay Banner</button>
                </form>
                @endforeach
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
        </div>
    </div>
</article> 
<footer>
    <div class="container">
        <a href="#">Made by: Dương Văn Minh</a>
    </div>
</footer>
<!-- jQuery 3 -->
<script src="{{url('public')}}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{url('public')}}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{url('public')}}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
    $(function () {
        $('.textarea').wysihtml5()
    })
    function kiemtra() {
        tenmodul = document.getElementById('tenmodul').value;
        if (tenmodul.length < 26 && tenmodul.length != '') {
            document.getElementById('formbay').submit();
        }
    }
    function checkkytu(data) {
        if (data == 'tenmodul') {
            getdt = document.getElementById(data);
            document.getElementById('demtenmodul').innerHTML = getdt.value.length;
            if (getdt.value.length > 25) {
                getdt.style.color = 'red';
            }else{
                getdt.style.color = '#333';
            }
        }
    }
</script>
</body>
</html>