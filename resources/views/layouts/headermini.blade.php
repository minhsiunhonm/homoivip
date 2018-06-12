<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="{{url('public')}}/css/bootstrap.min.css">
    <script src="{{url('public')}}/js/bootstrap.min.js" ></script>
    <link rel="stylesheet" href="{{url('public')}}/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{url('public')}}/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="{{url('public')}}/dist/css/AdminLTE.min.css">
    <script src="{{url('public')}}/js/jquery-3.3.1.min.js"></script>
    <script src="{{url('public')}}/js/myjs.js"></script>
    <link rel="stylesheet" type="text/css" href="{{url('public')}}/style.css">
    <link rel="stylesheet" href="{{ asset('public/plugins/pace/pace-theme-center-atom.css') }}">
</head>
<script type="text/javascript">
    var demaajaxlert = 0;
    var demsoalert = 0;
    var onoff = 0;
    $(document).ready(function(){
        $('#demboxalert').click(function(event){
            if (demaajaxlert == 0) {
                demaajaxlert = 1; 
                $.ajax({
                    url : "{{url('loadajaxalert')}}",
                    type : "GET",
                    dataType:"text",
                    data : {},
                    success : function (result){
                        var demresult = result.split('<!--chiamang-->');
                        if ((demresult.length - 1) == 10) {
                            demsoalert = 10;
                        }
                        $('#alertcontent').html(result);
                    }
                });
            }
        });
    });
    jQuery(function($) {
        $('#alertcontent').on('scroll', function() {
            if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
                if (demsoalert != 0) {
                    if (onoff == 0) {
                        onoff = 1;
                        $.ajax({
                            url : "{{url('loadajaxalerttiep')}}",
                            type : "GET",
                            dataType:"text",
                            data : { demsoalert },
                            success : function (result){
                                var demresult = result.split('<!--chiamang-->');
                                if ((demresult.length - 1) == 10) {
                                    demsoalert += 10;
                                }else{
                                    demsoalert = 0;
                                }
                                dulieualert = $('#alertcontent').html();
                                $('#alertcontent').html(dulieualert+result);
                                onoff=0;
                            }
                        });
                    }
                }
            }
        })
    });
</script>
<body>
<header id="slideheade" style="position: unset;height:130px;">
    <div class="container cleafix " style="background-color: #00000042;padding: 0 10px 10px 10px;">
        <h1 style="float: left;">
            <a class="logositetr"  href="{{url('')}}">
                <span id="logospan">Homoi.vn</span>
            </a>
        </h1>
        <div class="menutop">
            <ul>
                <li><a class="limenu" id="limenutr">Kêu gọi tài trợ</a></li>
                <li><a class="limenu" id="limenutr">Dự án hoàn thành</a></li>
                <li><a href="{{url('gioithieu')}}" class="limenu" id="limenutr">Giới thiệu</a></li>
            </ul>
        </div>
        <div class="boxright" onmouseover="hienthimenu()" onmouseout="anmenu()">
            @if(Auth::check())
                <img src="{{url('public/avatar/'.Auth::user()->avatar)}}">
                <span>{{Auth::user()->name}}</span>
                <ul id="menuright" >
                    @if(Auth::user()->rule == 1)
                    <a href="{{url('m/project')}}"><li>Admin</li></a>
                    @endif
                    <a href="{{url('duan')}}"><li>Project của tôi</li></a>
                    <a href="{{url('').'/'.Auth::user()->linkprofile}}"><li>Thông tin cá nhân</li></a>
                    <a href="{{url('logout')}}"><li>Đăng xuất</li></a>
                </ul>
            @else
                <span><a href="{{url('login')}}" style="color: #fff">Đăng nhập</a></span>
            @endif
        </div>
        @if(Auth::check())
        <div class="boxalert">
            <div class="demboxalert" id="demboxalert">
                <img src="{{url('public/image/mail.png')}}" width="30" height="30">
                @if($demtb > 0)
                <span id="countalert" class="countalert">{{$demtb}}</span>
                @endif
            </div>
            <div class="alertbox" id="alertbox">
                <div class="alertcontenttop">Thông báo</div>
                <ul class="alertcontent" id="alertcontent">
                    <img src="{{url('public/image/loadding.gif')}}" width="35" style="margin-left: 170px;">
                </ul>
                <a><div class="alertcontentbot">Xem tất cả</div></a>
            </div>
        </div>
        @endif
    </div>
</header>