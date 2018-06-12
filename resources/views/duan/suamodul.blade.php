@include('layouts.headermini')

<article class="duan" style="height: auto;background-color: #F2F2F0;min-height: 980px;">
    <div class="container" id="companybox">
        <div class="row">
            <h2 style="margin-bottom: 20px;width: 100%;"><b>Thêm nội dung.</b> <span><a  style="float: right;font-size: 16px;padding-top: 10px" href="{{url('suathongtincoban/'.$id_project.'#modulgioithieu')}}">Quay lại</a></span></h2>
            <hr style="border: solid 1px #b1b1b1">
            <div class="col-md-1"></div>
            <div class="col-md-8" >
                @foreach($modul as $mo)
                <form style="background-color: #fff;padding: 20px;" action="{{route('suamoduls')}}" id="formbay" method="post">
                  @csrf
                  <input type="hidden" name="id" value="{{$id}}">
                  <div class="form-group">
                    <label>Tên modul</label> <span id="demtenmodul" style="float: right;color: #b3b2b2;" ></span>
                    <input type="text" id="tenmodul" onkeyup="checkkytu('tenmodul')" value="{{$mo->name}}" name="tenmodul" class="form-control">
                    <span style="float: right;color: #b3b2b2;font-size: 11px;">25 ký tự</span>
                  </div>
                  <div class="form-group">
                    <label >Nội dung</label><span id="demmotangan" style="float: right;color: #b3b2b2;" ></span> 
                        <textarea id="editor1" name="noidung" class="form-control" placeholder="Place some text here" style="width: 100%; height: 350px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$mo->content}}</textarea>
                  </div>
                  <button type="button" onclick="kiemtra()" class="btn btn-warning">Sửa modul</button>
                    @if(count($errors)>0)
                    <ul class="tb" style="color:red;margin-top: 20px;list-style: none;">
                        @foreach ($errors->all() as $error)
                            <li class="text-red">
                            {{$error}}
                            </li>
                        @endforeach
                    </ul>
                    @endif
                </form>
                @endforeach
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
<script src="{{ asset('public/ckeditor/ckeditor.js') }}"></script>
<script> CKEDITOR.replace('editor1'); </script><script>
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