@include('layouts.headermini')
<article class="duan" style="height: auto;background-color: #F2F2F0">
    <div class="container" id="companybox" style="margin-top: 50px;">
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
                <h4><i class="icon fa fa-info" style="background: black;width: 25px;border-radius: 100%;height: 25px;color: #fff;padding: 4px 0 0 10px;"></i> Tài khoản đang đợi xác minh!</h4>
            </div>
            @endif
            @endif
            <div class="col-md-1"></div>
            <div class="col-md-10 boxcanhan">
                @include('layouts.slide-bar-left')
                <div class="col-md-9 midsesion" style="padding-right: 0px;">
                    <div class="postmid postpro">
                        <div class="avatarmid">
                            <img  src="{{url('')}}/public/avatar/avatar_disabled.png">
                        </div>
                        <div class="namemid">
                            <p class="namect" >Đạp xe đạp quanh bờ hồ</p>
                            <p class="infmid">Dương văn minh</p>
                            <p class="infmid">50 phút trước</p>
                        </div>
                        <div class="contentmid">
                            <p class="ratepro" style="text-align: left;margin-left: 10px;">★★★★☆</p>
                            <span class="valuect">
                                This is a paragraph with a standard line-height. This is a paragraph with a standard line height. This is a paragraph with a standard line-height.
                            </span>
                        </div>
                    </div>
                    <div class="postmid postpro">
                        <div class="avatarmid" style="">
                            <img src="{{url('')}}/public/avatar/avatar_disabled.png">
                        </div>
                        <div class="namemid">
                            <p class="namect" >Đạp xe đạp quanh bờ hồ</p>
                            <p class="infmid">Dương văn minh</p>
                            <p class="infmid">50 phút trước</p>
                        </div>
                        <div class="contentmid">
                            <p class="ratepro" style="text-align: left;margin-left: 10px;">★★★★☆</p>
                            <span class="valuect">
                                This is a paragraph with a standard line-height. This is a paragraph with a standard line height. This is a paragraph with a standard line-height.
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</article>
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
@if(Auth::check())
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    @if(Auth::check())
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Chọn ảnh đại diện</h4>
      </div>
      <div class="modal-body">
        <form role="form" method="post" action="{{route('thayavatarmember')}}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="box-body">
              <div class="form-group">
                <label for="exampleInputFile">File ảnh</label>
                <input type="file" id="exampleInputFile" name="myfile">
                <p class="help-block">Giới hạn dung lượng file 2mb</p>
                <input type="hidden" name="id" value="{{Auth::user()->id}}">
              </div>
            </div>

            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Hoàn tất</button>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    @endif

  </div>
</div>
@endif
<footer>
    <div class="container">
        <a href="#">Made by: Dương Văn Minh</a>
    </div>
</footer>
</body>
</html> 
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
                $('#nutvery').html('<a style="text-decoration: none;color:#fff" ><span style="color: green;font-size: 18px" class="glyphicon glyphicon-ok"></span> Đã gửi mã xác nhận, hãy kiểm tra hòm thư của bạn.</a>');
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
    function thayavatar() {
        $('#myModal').modal('show');
    }
    function follow() {
        $('#follow').css('opacity','0.7');
        $('#imgfollow').css('display','block');
        var iddata = '{{$idget}}';
        var thispro = 0;
        $.ajax({
            url : "{{url('follow')}}",
            type : "GET",
            dataType:"text",
            data : { iddata,thispro },
            success : function (result){
                $('#imgfollow').css('display','none');
                $('#follow').css('opacity','1');
                if (result == 0) {
                    $('#follow').html('Bỏ theo dõi');
                    $('#follow').css('color','#000');
                    $('#follow').css('background-color','#fff');
                    $('#follow').css('border-color','#dbdbdb');
                }else{
                   $('#follow').html('Theo dõi');
                    $('#follow').css('color','#fff');
                    $('#follow').css('background-color','#3897f0');
                    $('#follow').css('border-color','#3897f0');
                }
            }
        });
    }
</script>
