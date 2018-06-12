@include('layouts.headermini')
<article class="duan" style="height: auto;background-color: #F2F2F0">
    <div class="container" id="companybox"  style="margin-top: 50px;">
        <div class="row">
            @if ( session()->has('suc') )
              <div id="delay3s" class="alert alert-success alert-dismissible" style="    background-color: #00a65a !important;">
                <b><i class="icon fa fa-check"></i> Thông báo!</b> {{ session()->get('suc') }}
              </div>
            @endif
            @if ( session()->has('error') )
              <div id="delay3s" class="alert alert-danger alert-dismissible">
                <b><i class="icon fa fa-check"></i> Thông báo!</b> {{ session()->get('error') }}
              </div>
            @endif
            @if(Auth::check() && $idget == Auth::user()->id)
            @if($checkvery == 0 && $very == 0)
            <div class="callout callout-warning" style="position: relative;">
                <h4>Thông báo</h4>
                <p>Để xác minh thông tin tài khoản, bạn cần điền đầy đủ thông tin trong phần thông tin cá nhân!</p>
                <button class="btn btn-default btn-lg" @if($checkve == 0 ) disabled="" @endif style="position: absolute;top: 20px;right:10px" data-toggle="modal" data-target="#myModal2" >Xác minh</button>
                @if($verymail == 0)
                <div style="width: 100%" id="nutvery">
                    <a onclick="verymail()" style="text-decoration: underline;" >Xác minh email</a>
                </div>
                @endif
            </div>
            @elseif($checkvery == 1)
            <div class="alert  alert-dismissible">
                <h4><i class="icon fa fa-info" style="background: black;width: 25px;border-radius: 100%;height: 25px;color: #fff;padding: 4px 0 0 10px;"></i> Tài khoản đang đợi sác minh!</h4>
            </div>
            @endif
            @endif
            <div class="col-md-1"></div>
            <div class="col-md-10 boxcanhan">
                @include('layouts.slide-bar-left')
                <div class="col-md-9 midsesion" style="padding-right: 0px;">
                    <div class="postmid postpro">
                        <div class="contentmid">
                            <span class="valuect">
                                <h3>Đổi mật khẩu.</h3>
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <form style="margin-top: 20px;" action="{{route('doimatkhaus')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$id}}">
                                    <div class="form-group">
                                        <label>Mật khẩu cũ</label>
                                        <input placeholder="******" type="password" id="name" name="current-password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Mật khẩu mới</label>
                                        <input placeholder="" type="password" id="name" name="new-password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Nhập lại mật khẩu</label>
                                        <input placeholder="" type="password" id="name" name="new-password-confirm" class="form-control">
                                    </div>
                                    <input type="submit" name="" value="Lưu" style="" class="btn btn-primary">
                                </form>
                                @if(count($errors)>0)
                                <ul class="tb" style="color:red;margin-top: 20px;list-style: none;">
                                    @foreach ($errors->all() as $error)
                                        <li class="text-red">
                                        {{$error}}
                                        </li>
                                    @endforeach
                                </ul>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</article>
<footer>
    <div class="container">
        <a href="#">Made by: Dương Văn Minh</a>
    </div>
</footer>
</body>
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Xác minh</h4>
      </div>
      <div class="modal-body">
        <form action="{{route('verymem')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{$idget}}" name="idget">
            <div class="form-group">
                <label>Bạn là?</label>
                <select name="code" id="selectform" class="form-control">
                    <option disabled="" selected="">Chọn chức vụ</option>
                    <option value='sv'>Sinh viên</option>
                    <option value='gt'>Gatekeeper</option>
                    <option value='dn'>Doanh nghiệp</option>
                </select>
            </div>
            <div id="formsm"></div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Xác minh</h4>
      </div>
      <div class="modal-body">
        <form action="{{route('verymem')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{$idget}}" name="idget">
            <div class="form-group">
                <label>Bạn là?</label>
                <select name="code" id="selectform" class="form-control">
                    <option disabled="" selected="">Chọn chức vụ</option>
                    <option value='sv'>Sinh viên</option>
                    <option value='gt'>Gatekeeper</option>
                    <option value='dn'>Doanh nghiệp</option>
                </select>
            </div>
            <div id="formsm"></div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script src="{{url('public')}}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
    function verymail() {
        $('#nutvery').html('<img style="width: 50px" src="{{url("public/image/loadding.gif")}}">');
        var iddata = '{{$idget}}';
        $.ajax({
            url : "{{url('verymailax')}}",
            type : "GET",
            dataType:"text",
            data : { iddata },
            success : function (result){
                $('#nutvery').html('<a style="text-decoration: none;color:#fff" ><span style="color: green;font-size: 18px" class="glyphicon glyphicon-ok"></span> Đã gửi mã sác nhận, hãy kiểm tra hòm thư của bạn.</a>');
            }
        });
    }
    setTimeout(function() { $('#delay3s').css('display','none'); }, 3000);
    $('#selectform').on('change', function() {
        if (this.value == 'sv') {
            $('#formsm').html('<div class="form-group"><label for="exampleInputFile">Thẻ sinh viên</label><input type="file" id="exampleInputFile" name="thesv"><p class="help-block">Tải lên file ảnh thẻ sinh viên của bạn.</p></div><input type="submit" name="" class="btn btn-primary" value="Hoàn thành">');
        }else if (this.value == 'gt') {
            $('#formsm').html('<div class="form-group"><label for="exampleInputFile">Hợp đồng lao động</label><input type="file" id="exampleInputFile" name="hdld"><p class="help-block">Tải lên hợp đồng lao động tại cơ sở đào tạo của bạn.</p></div><div class="form-group"><label for="exampleInputFile">Ảnh mặt trước chứng minh thư</label><input type="file" id="exampleInputFile" name="mattruoccmt"><p class="help-block">Tải lên anh mặt trước chứng minh thư của bạn.</p></div><div class="form-group"><label for="exampleInputFile">Ảnh mặt sau chứng minh thư</label><input type="file" id="exampleInputFile" name="matsaucmt"><p class="help-block">Tải lên file ảnh mặt sau chứng minh thư.</p></div><input type="submit" name="" class="btn btn-primary" value="Hoàn thành">');
        }else if (this.value == 'dn') {
            $('#formsm').html('<div class="form-group"><label >Mã số thuế</label><input type="number" class="form-control" placeholder="Mã số thuế"  name="masothue"></div><div class="form-group"><label for="exampleInputFile">Gấy phép đăng ký kinh doanh</label><input type="file" id="exampleInputFile" name="giayphepdkkd"><p class="help-block">Tải lên gấy phép đăng ký kinh doanh.</p></div><input type="submit" name="" class="btn btn-primary" value="Hoàn thành">');
        }
    })
</script>
</html>