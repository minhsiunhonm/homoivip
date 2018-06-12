@include('layouts.headermini')
<article class="duan" style="height: auto;background-color: #F2F2F0">
    <div class="container" id="companybox">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10 boxaddpro" style="border:0px;margin-top: 50px">
                <h2 style="margin-bottom: 20px;"><b>Dự án của bạn.</b></h2>
                <table class="table">
                    <thead>
                        <th style="width: 1px;"></th>
                        <th>Tên dự án</th>
                        <th style="width: 130px;">Số tiền</th>
                        <th>Trạng thái</th>
                        <th style="width: 200px;"></th>
                    </thead>
                    <tbody>
                        @foreach($project as $pr)
                        <tr>
                            <td>
                                <a target="_blank" href="{{url('project').'/'.$pr->id}}" style="font-weight: bold;">
                                    <img src="{{url('public/fileupload/'.$pr->avatar)}}" width="150">
                                </a>
                            </td>
                            <td>
                                <a target="_blank" href="{{url('project').'/'.$pr->id}}" style="font-weight: bold;">
                                    {{$pr->name}}
                                </a>
                            </td>
                            <td><?= number_format($pr->money,0,",","."); ?> <b> đ</b></td>
                            <td>
                                @if($pr->status == 1) 
                                    Riêng tư
                                @elseif($pr->status == 2)
                                    Chờ duyệt
                                @elseif($pr->status == 3)
                                    Công khai, chờ đầu tư
                                @elseif($pr->status == 4)
                                    Đang thực hiện
                                @elseif($pr->status == 5)
                                    Hoàn thành
                                @endif
                            </td>
                            <td style="text-align: right;">
                                <?php $demyc=0; ?>
                                @foreach($demthamgia as $dt)
                                    @if($dt->id_project == $pr->id)
                                        <?php $demyc++; ?>
                                    @endif
                                @endforeach
                                @if($demyc != 0)
                                <a href="{{url('suathongtincoban/'.$pr->id)}}">
                                    <button style="margin-top: 5px;" class="btn btn-default">Yêu cầu tham gia <span style="color: red;font-weight: bold;">({{$demyc}})</span></button>
                                </a>
                                @endif
                                <a href="{{url('suathongtincoban'.'/'.$pr->id)}}"><button style="margin-top: 5px;" class="btn btn-warning" >Thông tin cơ bản</button></a>
                                @if($pr->ngaybatdau == null)
                                <button style="margin-top: 5px;" class="btn btn-success" onclick="yeucaupheduyet('{{$pr->id}}')">Yêu cầu phê duyệt</button>
                                @elseif($pr->ngaybatdau == '0000-01-01')
                                <span class="alert" style="margin-top: 5px;float: right;width: 205px;">Chờ duyệt <span class="glyphicon glyphicon-refresh"></span></span>
                                @else
                                 <?php 
                                    $date1=date_create($date = date('d-m-Y', time()));
                                    $date2=date_create($pr->ngayketthuc);
                                    $diff=date_diff($date1,$date2);
                                    $tongpc = $diff->format("%R%a")+0;
                                    if ($tongpc > 30) {
                                        // $date2 = date_add($date1, date_interval_create_from_date_string('30 days'));
                                        // echo date_format($date1, 'Y-m-d');
                                    }
                                ?>
                                    @if($tongpc < 0)
                                        <span class="alert alert-danger alert-dismissible" style="margin-top: 5px;float: right;width: 205px;">Gọi vốn thất bại <span class="glyphicon glyphicon-time"></span></span>
                                    @elseif($tongpc >= 0)
                                        <span class="alert alert-success alert-dismissible" style="margin-top: 5px;float: right;width: 205px;background-color: #00a65a !important">Còn {{$tongpc}} ngày gọi vốn  <span class="glyphicon glyphicon-time"></span></span>
                                    @endif
                                @endif
                                @if($pr->status < 3) 
                                <!-- <a href="{{url('xoaduan'.'/'.$pr->id)}}"><button disabled="" style="margin-top: 5px;" class="btn btn-danger">Xóa dự án</button></a> -->
                                @endif
                            </td>
                            <div id="myModal{{$pr->id}}" class="modal fade" role="dialog">
                              <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Thông báo</h4>
                                  </div>
                                  <div class="modal-body">
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
                                    <a href="{{url('guiyeucaupheduyet/'.$pr->id)}}">
                                        <button class="btn btn-success btn-lg col-md-4" style="margin-bottom: 10px;float: right;">
                                          Gửi yêu cầu
                                        </button>
                                    </a> 
                                  </div>
                                  <div class="modal-footer">
                                  </div>
                                </div>

                              </div>
                            </div>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
</html>
<script src="{{url('public')}}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
    function yeucaupheduyet(n) {
        $('#myModal'+n).modal('show');
    }
</script>