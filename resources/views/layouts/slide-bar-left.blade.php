@foreach($user as $u)
<div class="col-md-3 boxcnleft" style="padding-right: 0px;">
    @if(Auth::check() && $u->id == Auth::user()->id)
    <img src="{{url('/public/avatar/'.$u->avatar)}} "  onclick="thayavatar()" style="cursor: pointer;">
    @else
    <img src="{{url('/public/avatar/'.$u->avatar)}} "  style="cursor: pointer;">
    @endif
    <p class="ratepro">★★★★☆</p>
    <h1>{{$u->name}}</h1>
    <div class="col-md-12" style="padding-left: 0px;margin-bottom: 20px;position: relative;">
        @if(Auth::check() && Auth::user()->id != $u->id)
            @if($follow == 0)
            <button class="btn btn-primary" id="follow" onclick="follow()" style="background-color: #3897f0;border-color: #3897f0;width: 100%;">Theo dõi</button>
            @else
            <button class="btn btn-primary" id="follow" onclick="follow()" style="background-color: #fff;border-color: #dbdbdb;width: 100%;color:#000">Bỏ theo dõi</button>
            @endif
        @endif
        <div class="col-md-12" style="position: absolute;top: 3px;">
            <div class="col-md-4"></div>
            <div class="col-md-5">
                <img src="{{url('public/image/loadding.gif')}}" id="imgfollow" style="width: 30px;height: 30px;margin: 0px;display: none;">
            </div>
        </div>
    </div>
    <p><b>3</b> Dự án đã quản lý</p>
    <p><b>32</b> Dự án tham gia</p>
    <p><b>953</b> Lượt đánh giá</p>
    @foreach($positioncv as $p)
    <p>Làm <b>{{$p->name}}</b> tại <b>{{$p->company}}</b></p>
    @endforeach
    @foreach($positionth as $p)
    <p>Từng học tại: <b>{{$p->name}}</b></p>
    @endforeach
    <?php $dem=0; ?>
    @foreach($positionkn as $p)
        <?php if ($dem == 0) {
            echo "Kỹ năng: ";
            }
            $dem++;
        ?>
        @if($p->code == 'kn')
        <b>{{$p->name}}</b>@if($dem < (count($positionkn))),@else.@endif
        @endif
    @endforeach
    <div class="toolprofile">
        <a href="{{url($u->linkprofile)}}">
            <div class="btnprofile @if($menu == 'cn') activepro @endif" style="color: #000">Lượt đánh giá</div>
        </a>
        @if(Auth::check() && $u->id == Auth::user()->id)
        <a href="{{url($u->linkprofile.'/thong-tin-ca-nhan')}}">
            <div class="btnprofile @if($menu == 'ttcn') activepro @endif" style="color: #000">Thông tin cá nhân</div>
        </a>
        <a href="{{url($u->linkprofile.'/doi-mat-khau')}}">
            <div class="btnprofile @if($menu == 'dmk') activepro @endif" style="color: #000">Đổi mật khẩu</div>
        </a>
        @endif
        <a href="{{url('logout')}}">
            <div class="btnprofile"  style="color: #000">Đăng xuất</div>
        </a>
    </div>
</div>
@endforeach