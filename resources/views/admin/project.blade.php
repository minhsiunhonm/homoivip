@include('admin.teamplate.header') 
@include('admin.teamplate.slidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 1126px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dự án
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Ban quản trị</h3>
            <div class="box-tools">
              <form action="{{route('timkiemduanadmin')}}" method="post" style="float: right;">
                @csrf
                <button type="button" class="nuttimkiemadmin">
                  <span class="glyphicon glyphicon-search"></span>
                </button>
                <input type="text" placeholder="Tìm kiếm" name="value" class="timkiemadmin">
              </form>
              <select class="form-control pull-right selectduanad" onchange="javascript:location.href = this.value;">
                @if($idselect == 'timkiem')
                <option disabled="" selected="">Tìm kiếm</option>
                @endif
                <option @if($idselect == 'yeucaupheduyet') selected @endif  value="{{url('m/project/')}}/yeucaupheduyet">Yêu cầu phê duyệt ({{$dyeucaupheduyet}})</option>
                @foreach($status as $sta)
                <option @if($idselect == $sta->id) selected @endif value="{{url('m/project/'.$sta->id)}}">{{$sta->name}}
                  (@if($sta->id == 1){{$driengtu}}@elseif($sta->id==2){{$dcongkhai}}@elseif($sta->id==3){{$ddth}}@elseif($sta->id==4){{$dhoanthanh}}@endif)
                </option>
                @endforeach
                <option @if($idselect == 'thungrac') selected @endif  value="{{url('m/project/')}}/thungrac">Thùng rác ({{$dthungrac}})</option>
              </select>
            </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body " style="margin-top: 20px;">
              @if ( session()->has('error') )
                <div style="margin-top: 10px;" id="delay3s" class="alert alert-danger alert-dismissible">
                  <b><i class="icon fa fa-check"></i> Thông báo!</b> {{ session()->get('error') }}
                </div>
              @endif
              <div class="row">
                  @foreach($project as $pr)
                    <div class="col-md-3">
                      <div class="boxsp">
                        <a href="{{url('project/'.$pr->id)}}" target="_blank">
                          <img src="{{url('public')}}/fileupload/{{$pr->banner}}" class="anhbsp">
                          <h3>{{$pr->name}}</h3>
                          <p>Địa điểm: {{$pr->place}}</p>
                          <hr>
                        </a>
                        <div class="boxcpn">
                          @if($pr->users['id'] == $pr->id_user)
                          <a  class="namecpn" href="#">
                            <img src="{{url('public/avatar/'.$pr->users['avatar'])}}" style="width: 50px;height: 50px;border-radius: 100%;margin-right: 10px;border: 1px solid #dee0e2">
                            {{$pr->users['name']}}
                          </a>
                          @endif
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
                        <button class="btn btn-warning adminbuttoneditpro" style="display: block;" data-toggle="modal" data-target="#myModal{{$pr->id}}">
                          <div class="glyphicon glyphicon-pencil"></div>
                        </button>
                      </div>
                      <!-- Modal -->
                      <div class="modal fade" id="myModal{{$pr->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title" id="myModalLabel" style="text-transform: uppercase;">{{$pr->name}}</h4>
                            </div>
                            <div class="modal-body">
                              <div>
                                @if($pr->hidden == 0)
                                  <a href="{{url('caidat'.'/'.$pr->id)}}">
                                    <button class="btn btn-default btn-lg col-md-12" style="margin-bottom: 10px;">
                                      Cài đặt
                                    </button>
                                  </a>
                                  @if($pr->status == 1)
                                  <button onclick="pheduyet({{$pr->id}})" class="btn btn-primary btn-lg col-md-12" style="margin-bottom: 10px;">
                                    Phê duyệt
                                  </button>
                                  @elseif($pr->status == 2)
                                  <button onclick="riengtu({{$pr->id}})" class="btn btn-primary btn-lg col-md-12" style="margin-bottom: 10px;">
                                    Riêng tư
                                  </button>
                                  @endif
                                  <a href="{{url('suathongtincoban'.'/'.$pr->id)}}">
                                    <button type="button" class="btn btn-warning btn-lg col-md-12" style="margin-bottom: 10px;">
                                      Thông tin cơ bản
                                    </button>
                                  </a>
                                  <button onclick="bovaothungrac({{$pr->id}})" class="btn btn-danger btn-lg col-md-12" style="margin-bottom: 10px;">
                                    Bỏ vào thùng rác
                                  </button>
                                @else
                                  <a href="{{url('m/khoiphucthungrac'.'/'.$pr->id)}}">
                                    <button class="btn btn-success btn-lg col-md-12" style="margin-bottom: 10px;">
                                      Khôi phục
                                    </button>
                                  </a>
                                  <button disabled="" class="btn btn-danger btn-lg col-md-12" style="margin-bottom: 10px;">
                                    Xóa vĩnh viễn
                                  </button>
                                @endif
                              </div>
                              <a href="{{url('project/'.$pr->id)}}" target="_blank">
                                <img src="{{url('public')}}/fileupload/{{$pr->banner}}" class="anhbsp">
                              </a>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Modal -->
                      @if($pr->hidden == 0)
                      <div class="modal fade" id="thungracmodal{{$pr->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title" id="myModalLabel">{{$pr->name}}</h4>
                            </div>
                            <div class="modal-body">
                              <div>
                                <div class="alert alert-danger alert-dismissible">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                  <h4><i class="icon fa fa-ban"></i> Cảnh báo!</h4>
                                  Dự án này sẽ bị ẩn cho đến khi bạn mở lại!... <br>
                                  <b>Đặc biệt</b> nó sẽ ảnh hưởng đến tương tác của người dùng trên website!
                                </div>
                                <button class="btn btn-default btn-lg col-md-4" data-dismiss="modal" style="margin-bottom: 10px;">
                                  Quay lại
                                </button>
                                <a href="{{url('m/thungrac'.'/'.$pr->id)}}">
                                  <button class="btn btn-danger btn-lg col-md-4" style="margin-bottom: 10px;float: right;">
                                    Bỏ vào thùng rác
                                  </button>
                                </a>
                              </div>
                              <a href="{{url('project/'.$pr->id)}}" target="_blank">
                                <img src="{{url('public')}}/fileupload/{{$pr->banner}}" class="anhbsp">
                              </a>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal fade" id="pheduyetmodal{{$pr->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title" id="myModalLabel">{{$pr->name}}</h4>
                            </div>
                            <div class="modal-body">
                              <div>
                                <div class="alert alert-danger alert-dismissible">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                  <h4><i class="icon fa fa-ban"></i> Cảnh báo!</h4>
                                  Sẽ có nhiều trường hợp sảy ra sau khi phê duyệt dự án. <br>
                                  - Dự án sẽ bắt đầu nhận tiền đầu tư. <br>
                                  - Dự án sẽ suất hiện trên trang chủ. <br>
                                  - Các lời mời tham gia dự án bị xóa hoàn toàn. <br>
                                  - Không được phép mời thêm các thành viên khác tham gia. <br>
                                  - Không được phép sửa các nội dung chi tiết liên quan đến dự án như modul, tiêu đề, mô tả, từ khóa... <br>
                                </div>
                                <button class="btn btn-default btn-lg col-md-4" data-dismiss="modal" style="margin-bottom: 10px;">
                                  Quay lại
                                </button>
                                <button onclick="hoantatpheduyet({{$pr->id}})" class="btn btn-success btn-lg col-md-4" style="margin-bottom: 10px;float: right;">
                                  Phê duyệt
                                </button>
                              </div>
                              <a href="{{url('project/'.$pr->id)}}" target="_blank">
                                <img src="{{url('public')}}/fileupload/{{$pr->banner}}" class="anhbsp">
                              </a>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal fade" id="riengtumodal{{$pr->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title" id="myModalLabel">{{$pr->name}}</h4>
                            </div>
                            <div class="modal-body">
                              <div>
                                <div class="alert alert-success alert-dismissible" style="background-color: #00a65a !important;">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                  <h4><i class="icon fa fa-ban"></i> Cảnh báo!</h4>
                                  Sẽ có nhiều trường hợp sảy ra sau khi bật riêng tư dự án. <br>
                                  - Dự án không suất hiện trên trang giao diện người dùng. <br>
                                  - Được phép mời thêm các thành viên khác tham gia. <br>
                                  - Được phép sửa các nội dung chi tiết liên quan đến dự án như modul, tiêu đề, mô tả, từ khóa... <br>
                                </div>
                                <button class="btn btn-default btn-lg col-md-4" data-dismiss="modal" style="margin-bottom: 10px;">
                                  Quay lại
                                </button>
                                <button onclick="hoantatriengtu({{$pr->id}})" class="btn btn-danger btn-lg col-md-4" style="margin-bottom: 10px;float: right;">
                                  Riêng tư
                                </button>
                              </div>
                              <a href="{{url('project/'.$pr->id)}}" target="_blank">
                                <img src="{{url('public')}}/fileupload/{{$pr->banner}}" class="anhbsp">
                              </a>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      @endif
                    </div>
                  @endforeach
                  <div class="col-md-12">
                    <div style="float: right;">
                      {{ $project->links() }}
                    </div>
                  </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </section>
  </div>
<form action="{{route('pheduyetduan')}}" method="post" id="hoantatpheduyet">
  @csrf
  <input type="hidden" name="id" id="inputidpd">
</form>
<form action="{{route('riengtuduan')}}" method="post" id="hoantatriengtu">
  @csrf
  <input type="hidden" name="id" id="inputidrt">
</form>
<script type="text/javascript">
  function bovaothungrac(id) {
    // $('#myModal'+id).modal('hide');
    $('#thungracmodal'+id).modal('show');
  }
  function pheduyet(id) {
    // $('#myModal'+id).modal('hide');
    $('#pheduyetmodal'+id).modal('show');
  }
  function riengtu(id) {
    // $('#myModal'+id).modal('hide');
    $('#riengtumodal'+id).modal('show');
  }
  function hoantatpheduyet(id) {
    $('#inputidpd').val(id);
    $('#hoantatpheduyet').submit();
  }
  function hoantatriengtu(id) {
    $('#inputidrt').val(id);
    $('#hoantatriengtu').submit();
  }
</script>
@include('admin.teamplate.footer')
