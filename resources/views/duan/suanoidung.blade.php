@include('layouts.headermini')
<article class="duan" style="height: auto;background-color: #F2F2F0;min-height: 980px;">
    <div class="container" id="companybox">
        <div class="row">
            <h2 style="margin-bottom: 20px;width: 100%;"><b>Thêm nội dung.</b> <span><a  style="float: right;font-size: 16px;padding-top: 10px" target="_blank" href="{{url('duan')}}">Quay lại</a></span></h2>
            <hr style="border: solid 1px #b1b1b1">
            <div class="col-md-1"></div>
            <div class="col-md-8" >
                <form style="background-color: #fff;padding: 20px;" action="{{route('themmodul')}}" id="formbay" method="post">
                  @csrf
                  <input type="hidden" name="id" value="{{$id}}">
                  <div class="form-group">
                    <label>Tên modul</label> <span id="demtenmodul" style="float: right;color: #b3b2b2;" ></span>
                    <input type="text" id="tenmodul" onkeyup="checkkytu('tenmodul')" value="" name="tenmodul" class="form-control">
                    <span style="float: right;color: #b3b2b2;font-size: 11px;">25 ký tự</span>
                  </div>
                  <div class="form-group">
                    <label >Nội dung</label><span id="demmotangan" style="float: right;color: #b3b2b2;" ></span> 
                        <textarea id="noidung" name="noidung" class="textarea form-control" placeholder="Place some text here" style="width: 100%; height: 350px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                  </div>
                  <button type="button" onclick="kiemtra()" class="btn btn-primary">Thêm modul</button>
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
            </div>
            <div class="col-md-3" style="background-color: #fff">
                <h3>Vị trí</h3>
                <table class="table table-hover">
                    @foreach($modul as $mo)
                    <tr>
                        <td style="font-size: 16px;">{{$mo->name}}</td>
                        <td style="width: 1px;">
                            <a href="{{url('suamodul/'.$mo->id)}}"><button class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></button></a>
                        </td>
                        <td style="width: 1px;text-align: right;">
                            <a href="{{url('lenmodul/'.$mo->id)}}"><button class="btn btn-primary"><span class="glyphicon glyphicon-arrow-up"></span></button></a>
                            <a href="{{url('xuongmodul/'.$mo->id)}}"><button class="btn btn-primary" style="margin-top: 5px;"><span class="glyphicon glyphicon-arrow-down"></span></button></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div style="">
        <div class="container">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-8" style="margin-top: 30px;">
                    <div class="row">
                        <div style="padding-right: 0px;" class="col-md-3">
                            <ul class="slidebarleft">
                                @foreach($modul as $mo)
                                <li><a href="">{{$mo->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-9" style="padding: 25px 25px 25px 50px">
                            @foreach($modul as $mo)
                                <h2 class="section-title">{{$mo->name}}</h2>
                                <div class="custom-content" style="border-bottom: 1px dashed #b1b1b1;margin-bottom: 25px;float: left;padding-bottom: 20px"><?php echo($mo->content); ?></div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
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