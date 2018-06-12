@include('layouts.header')
<article class="duan" style="height: auto;background-color: #F2F2F0">
    <div class="container" id="companybox" style="margin-top: 50px;">
        <div class="midbtnadd">
            <h3>Bạn là sinh viên, giảng viên? Bạn muốn kêu gọi tài trợ cho dự án của mình?</h3>
            <a href="{{url('tao-du-an')}}">
                <button>Thêm dự án của bạn</button>
            </a>
        </div>
        <h3 style="color: #e37a01; font-weight: bold;margin-bottom: 15px;">Sinh viên</h3>
        <hr>
        <div class="row">
            @foreach($project as $pr)
                <div class="col-md-4">
                  <div class="boxsp">
                    <a href="{{url('project/'.$pr->id)}}" class="indboxsp">
                      <img src="{{url('public')}}/fileupload/{{$pr->banner}}" class="anhbsp">
                      <h3>{{$pr->name}}</h3>
                      <p>Địa điểm: {{$pr->place}}</p>
                      <hr>
                    </a>
                    <div class="boxcpn">
                      @foreach($project as $use)
                      @if($use->users['id'] == $pr->id_user)
                      <a  class="namecpn" href="#">
                        <img src="{{url('public/avatar/'.$use->users['avatar'])}}" style="width: 50px;height: 50px;border-radius: 100%;margin-right: 10px;border: 1px solid #dee0e2">
                        {{$use->users['name']}}
                      </a>
                      @endif
                      @endforeach
                    </div>
                    <span><b>0đ</b> of {{number_format($pr->money, 0)}} đ</span>
                    <div class="ke">
                      <div style="width: 100%;position: relative;margin-top: 10px;padding: 0 10px;">
                        <div style="width: 100%;height: 10px;background-color: #b7b7b7;float: left;border-radius: 5px;">
                          <div style="width: 0%;height: 10px;border-radius: 10px;background-color: #ff8900;"></div>
                        </div>
                        <div style="width: 22px;height: 22px;background-color: #ff8900;border-radius: 100%;margin-top: -7px;position: absolute;margin-left: 0%;border:solid 1px #bf6700;cursor: pointer;">
                        </div>
                      </div>
                    </div>
                    <div class="botbit">
                      <i>Số sinh viên tham gia: 0 sinh viên</i>
                      <br>
                      <i style="margin-top: 5px;float: left;">Trạng thái: chờ duyệt</i>
                    </div>
                  </div>
                </div>
            @endforeach
            <div class="col-md-12">
                <div style="float: right;">
                    {{ $project->links() }}
                </div>
            </div>
        </div>
    </div>
              

</article>
<!-- @include('layouts.footer') -->
<footer>
    <div class="container">
      <div class="col-md-3 box3footer">
        <h3>VỀ CHÚNG TÔI</h3>
      </div>
      <div class="col-md-3 box3footer">
        <h3>Hướng dẫn sử dụng</h3>
      </div>
      <div class="col-md-3 box3footer">
        <h3>CÓ THẮC MẮC?</h3>
      </div>
      <div class="col-md-3 box3footer">
        <h3>Kết nối</h3>
        <div class="buttonshare">
          <span class="fa fa-facebook-f"></span>
          <span class="fa fa-twitter"></span>
          <span class="fa fa-linkedin"></span>
        </div>
      </div>
    </div>
</footer>
</body>
</html>