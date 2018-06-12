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
                <h4><i class="icon fa fa-info" style="background: black;width: 25px;border-radius: 100%;height: 25px;color: #fff;padding: 4px 0 0 10px;"></i> Tài khoản đang đợi sác minh!</h4>
            </div>
            @endif
            @endif
            <div class="col-md-1"></div>
            <div class="col-md-10 boxcanhan">
                @foreach($user as $u)
                @endforeach
                @include('layouts.slide-bar-left')
                <div class="col-md-9 midsesion" style="padding-right: 0px;">
                    <div class="postmid postpro" >
                        <div class="contentmid">
                            <h3 style="width: 100%;padding: 10px;background-color: #f9f9f9;margin-top: 0px;">Công việc và học vấn.</h3> 
                            <span class="valuect">
                                <div style="width: 100%;float: left;">
                                    <p style="margin: 0pc;font-weight: bold;color: #b1b1b1;font-size: 14px;">Công việc.</p>
                                    <hr style="margin: 0px;">
                                    <table class="table table-hover" style="margin-bottom: 10px;">
                                    <tbody>
                                    @foreach($positioncv as $p)
                                    <tr onmouseover="hiennutxoa({{$p->id}})" onmouseout="annutxoa({{$p->id}})">
                                        <td>
                                            <div style="float: left;color: #333;width: 100%;margin: 5px 0">
                                                <span class="glyphicon glyphicon-camera" style=";padding: 5px;top: 0px;background-color: #000;color: #fff;border-radius: 100%;"></span>
                                                Làm <b>{{$p->name}}</b> tại <b>{{$p->company}}</b>

                                            </div>
                                        </td>
                                        <td style="width: 10%"><input style="display: none;" type="button" class="btn" id="nut{{$p->id}}" value="Xóa" onclick="xoacongviec({{$p->id}})" name=""></td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                    </table>
                                    <div style="float: left;padding: 10px 10px 10px 0px;color: #333;width: 100%;background-color: #f8f8f8;display: none;" id="congviec">
                                        <form action="{{route('themcongviec')}}" method="post">
                                            @csrf
                                            <input type="hidden" value="{{$u->id}}" name="id">
                                            <div class="form-group" style="width: 250px; margin: 10px auto"> 
                                                <label>Công ty</label>
                                                <input placeholder="Công ty" type="text" id="" name="congty" class="form-control">
                                            </div>
                                            <div class="form-group" style="width: 250px; margin: 10px auto"> 
                                                <label>Chức vụ</label>
                                                <input placeholder="Chức vụ" type="text" id="" name="chucvu" class="form-control">
                                            </div>
                                            <div class="form-group" style="width: 250px; margin: 10px auto"> 
                                                <input type="submit" class="btn btn-primary" value="lưu thay đổi">
                                                <input type="button" class="btn" value="Hủy" onclick="congviec2()">
                                            </div>
                                        </form>
                                    </div>
                                    <div style="cursor: pointer;float: left;padding: 10px;border:1px dashed #4080ff;color: #4080ff" onclick="congviec()" id="nutcongviec">
                                        <span class="glyphicon glyphicon-plus" style="font-size: 11px;padding: 0 5px 5px 5px;top: 0px;"></span>
                                        Thêm công việc của bạn.
                                    </div>
                                </div>
                            </span>
                            <span class="valuect">
                                <div style="width: 100%;float: left;">
                                    <p style="margin: 0pc;font-weight: bold;color: #b1b1b1;font-size: 14px;">Kỹ năng chuyên môn.</p>
                                    <hr style="margin: 0px;">
                                    <table class="table table-hover" style="margin-bottom: 10px;">
                                    <tbody>
                                    @foreach($positionkn as $p)
                                    <tr onmouseover="hiennutxoa({{$p->id}})" onmouseout="annutxoa({{$p->id}})">
                                        <td>
                                            <div style="float: left;color: #333;width: 100%;margin: 5px 0">
                                                <span class="glyphicon glyphicon-camera" style=";padding: 5px;top: 0px;background-color: #000;color: #fff;border-radius: 100%;"></span>
                                                <b>{{$p->name}}</b>

                                            </div>
                                        </td>
                                        <td style="width: 10%"><input style="display: none;" type="button" class="btn" id="nut{{$p->id}}" value="Xóa" onclick="xoakynang({{$p->id}})" name=""></td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                    </table>
                                    <div style="float: left;padding: 10px 10px 10px 0px;color: #333;width: 100%;background-color: #f8f8f8;display: none;" id="kynang">
                                        <form action="{{route('themkynang')}}" method="post">
                                            @csrf
                                            <input type="hidden" value="{{$u->id}}" name="id">
                                            <div class="form-group" style="width: 250px; margin: 10px auto"> 
                                                <label>Kỹ năng chuyên môn</label>
                                                <input placeholder="Kỹ năng" type="text" id="" name="kynang" class="form-control">
                                            </div>
                                            <div class="form-group" style="width: 250px; margin: 10px auto"> 
                                                <input type="submit" class="btn btn-primary" value="lưu thay đổi">
                                                <input type="button" class="btn" value="Hủy" onclick="kynang2()">
                                            </div>
                                        </form>
                                    </div>
                                    <div style="cursor: pointer;float: left;padding: 10px;border:1px dashed #4080ff;color: #4080ff" onclick="kynang()" id="nutkynang">
                                        <span class="glyphicon glyphicon-plus" style="font-size: 11px;padding: 0 5px 5px 5px;top: 0px;"></span>
                                        Thêm một kỹ năng.
                                    </div>
                                </div>
                            </span>
                            <span class="valuect">
                                <div style="width: 100%;float: left;">
                                    <p style="margin: 0pc;font-weight: bold;color: #b1b1b1;font-size: 14px;">Học vấn.</p>
                                    <hr style="margin: 0px;">
                                    <table class="table table-hover" style="margin-bottom: 10px;">
                                    <tbody>
                                    @foreach($positionth as $p)
                                    <tr onmouseover="hiennutxoa({{$p->id}})" onmouseout="annutxoa({{$p->id}})">
                                        <td>
                                            <div style="float: left;color: #333;width: 100%;margin: 5px 0">
                                                <span class="glyphicon glyphicon-education" style=";padding: 5px;top: 0px;background-color: #000;color: #fff;border-radius: 100%;"></span>
                                                Từng học tại: <b>{{$p->name}}</b>

                                            </div>
                                        </td>
                                        <td style="width: 10%"><input style="display: none;" type="button" class="btn" id="nut{{$p->id}}" value="Xóa" onclick="xoatruonghoc({{$p->id}})" name=""></td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                    </table>
                                    <div style="float: left;padding: 10px 10px 10px 0px;color: #333;width: 100%;background-color: #f8f8f8;display: none;" id="truonghoc">
                                        <form action="{{route('themtruonghoc')}}" method="post">
                                            @csrf
                                            <input type="hidden" value="{{$u->id}}" name="id">
                                            <div class="form-group" style="width: 250px; margin: 10px auto"> 
                                                <label>Trường học</label>
                                                <input placeholder="Trường học" type="text" id="" name="truonghoc" class="form-control">
                                            </div>
                                            <div class="form-group" style="width: 250px; margin: 10px auto"> 
                                                <label>Ngày nhập học</label>
                                                <input placeholder="Ngày nhập học" type="date" id="" name="ngaynhaphoc" class="form-control">
                                            </div>
                                            <div class="form-group" style="width: 250px; margin: 10px auto"> 
                                                <input type="submit" class="btn btn-primary" value="lưu thay đổi">
                                                <input type="button" class="btn" value="Hủy" onclick="truonghoc2()">
                                            </div>
                                        </form>
                                    </div>
                                    <div style="cursor: pointer;float: left;padding: 10px;border:1px dashed #4080ff;color: #4080ff" onclick="truonghoc()" id="nuttruonghoc">
                                        <span class="glyphicon glyphicon-plus" style="font-size: 11px;padding: 0 5px 5px 5px;top: 0px;"></span>
                                        Thêm trường đại học.
                                    </div>
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="postmid postpro">
                        <div class="contentmid">
                            <h3 style="width: 100%;padding: 10px;background-color: #f9f9f9;margin-top: 0px;">Thông tin cá nhân.</h3>
                            <span class="valuect">
                                <form style="margin-top: 20px;padding-bottom: 30px;" action="{{route('suathongtincanhan')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$u->id}}">
                                    <div class="form-group">
                                        <label>Họ Tên</label>
                                        <span id="demname" style="float: right;color: #b3b2b2;" ></span>
                                        <input placeholder="Họ Tên" type="text" id="name" onkeyup="checkkytu('name')" value="{{$u->name}}" name="name" class="form-control">
                                        <span style="float: right;color: #b3b2b2;font-size: 11px;">23 ký tự</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Địa chỉ email</label>
                                        <input style="opacity: 0.6" placeholder="Địa chỉ email" type="text" value="{{$u->email}}" name="" disabled="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày sinh</label>
                                        <input placeholder="Ngày sinh" type="date" id="" value="{{$u->birthday}}" name="birthday" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Số điện thoại</label>
                                        <span id="demphone" style="float: right;color: #b3b2b2;" ></span>
                                        <input placeholder="Số điện thoại" type="number" onkeyup="checkkytu('phone')" id="phone" value="{{$u->phone}}" name="phone" class="form-control">
                                        <span style="float: right;color: #b3b2b2;font-size: 11px;">11 ký tự</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Địa chỉ</label>
                                        <span id="demaddress" style="float: right;color: #b3b2b2;" ></span>
                                        <input placeholder="Địa chỉ" type="text" id="address" onkeyup="checkkytu('address')" value="{{$u->address}}" name="address" class="form-control">
                                        <span style="float: right;color: #b3b2b2;font-size: 11px;">50 ký tự</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Số chứng minh thư</label>
                                        <span id="demcmt" style="float: right;color: #b3b2b2;" ></span>
                                        <input placeholder="Số chứng minh thư" type="number" id="cmt" onkeyup="checkkytu('cmt')" value="{{$u->cmt}}" name="cmt" class="form-control">
                                        <span style="float: right;color: #b3b2b2;font-size: 11px;">25 ký tự</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Giới tính</label>
                                        <select name="gender" class="form-control">
                                            <option value="1" @if($u->gender == 1) selected @endif >Nam</option>
                                            <option value="2" @if($u->gender == 2) selected @endif >Nữ</option>
                                        </select>
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
</article>
<script src="{{url('public')}}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<form action="{{route('xoakynang')}}" method="post" id="formxoakn">
    @csrf
    <input type="hidden" id="valuexoakn" name="id">
</form>
<form action="{{route('xoatruonghoc')}}" method="post" id="formxoath">
    @csrf
    <input type="hidden" id="valuexoath" name="id">
</form>
<form action="{{route('xoacongviec')}}" method="post" id="formxoacv">
    @csrf
    <input type="hidden" id="valuexoacv" name="id">
</form>
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
    function xoakynang($id) {
        document.getElementById('valuexoakn').value = $id;
        document.getElementById('formxoakn').submit();
    }
    function xoatruonghoc($id) {
        document.getElementById('valuexoath').value = $id;
        document.getElementById('formxoath').submit();
    }
    function xoacongviec($id) {
        document.getElementById('valuexoacv').value = $id;
        document.getElementById('formxoacv').submit();
    }
    function hiennutxoa($id) {
        document.getElementById('nut'+$id).style.display = 'block';
    }
    function annutxoa($id) {
        document.getElementById('nut'+$id).style.display = 'none';
    }
    function kynang() {
        document.getElementById('kynang').style.display = 'block';
        document.getElementById('nutkynang').style.display = 'none';
    }
    function kynang2() {
        document.getElementById('kynang').style.display = 'none';
        document.getElementById('nutkynang').style.display = 'block';
    }
    function truonghoc() {
        document.getElementById('truonghoc').style.display = 'block';
        document.getElementById('nuttruonghoc').style.display = 'none';
    }
    function truonghoc2() {
        document.getElementById('truonghoc').style.display = 'none';
        document.getElementById('nuttruonghoc').style.display = 'block';
    }
    function congviec() {
        document.getElementById('congviec').style.display = 'block';
        document.getElementById('nutcongviec').style.display = 'none';
    }
    function congviec2() {
        document.getElementById('congviec').style.display = 'none';
        document.getElementById('nutcongviec').style.display = 'block';
    }
    function checkkytu(data) {
        if (data == 'name') {
            getdt = document.getElementById(data);
            document.getElementById('demname').innerHTML = getdt.value.length;
            if (getdt.value.length > 23) {
                getdt.style.color = 'red';
            }else{
                getdt.style.color = '#333';
            }
        }
        if (data == 'phone') {
            getdt = document.getElementById(data);
            document.getElementById('demphone').innerHTML = getdt.value.length;
            if (getdt.value.length > 11) {
                getdt.style.color = 'red';
            }else if (getdt.value.length < 10) {
                getdt.style.color = 'red';
            }else{
                getdt.style.color = '#333';
            }
        }
        if (data == 'address') {
            getdt = document.getElementById(data);
            document.getElementById('demaddress').innerHTML = getdt.value.length;
            if (getdt.value.length > 50) {
                getdt.style.color = 'red';
            }else{
                getdt.style.color = '#333';
            }
        }
        if (data == 'cmt') {
            getdt = document.getElementById(data);
            document.getElementById('demcmt').innerHTML = getdt.value.length;
            if (getdt.value.length > 25) {
                getdt.style.color = 'red';
            }else{
                getdt.style.color = '#333';
            }
        }
    }
</script>
<footer>
    <div class="container">
        <a href="#">Made by: Dương Văn Minh</a>
    </div>
</footer>
</body>
</html>