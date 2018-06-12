@include('layouts.headermini')
@foreach($project as $pro)
<article class="tophea" style="padding-bottom: 20px;">
	<div class="container" style="padding: 0px;">
		@if ( session()->has('succ') )
		  <div id="delay3s" class="alert alert-success alert-dismissible" style="    background-color: #00a65a !important;">
		    <b><i class="icon fa fa-check"></i> Thông báo!</b> {{ session()->get('succ') }}
		  </div>
		@endif
		@if ( session()->has('error') )
		  <div id="delay3s" class="alert alert-danger alert-dismissible">
		    <b><i class="icon fa fa-check"></i> Thông báo!</b> {{ session()->get('error') }}
		  </div>
		@endif
		<div class="col-md-8">
			<div class="companyname">
				<img src="{{url('public')}}/fileupload/{{$pro->avatar}}" class="urbologo">
				<h1>{{$pro->name}}</h1>
				<p>{{$pro->short_description}}</p>
			</div>
			<div class="youtubebox" style="padding-top: 30px;">
				<div class="video">
					<iframe id="embedded_video" src="https://www.youtube.com/embed/{{$pro->video}}?HD=1;rel=0;showinfo=0&amp;wmode=transparent" marginwidth="0" marginheight="0" scrolling="no" allowfullscreen="" height="438" frameborder="0"></iframe>
				</div>
				<div style="width: 100%;float: left;height: 50px;margin-top: 20px;">
					<span class="glyphicon glyphicon-link"></span>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="company-tags">
				<p class="company-location">{{$pro->place}}</p>
				<p class="company-tag">{{$pro->tag}}</p>
				<!-- <div class="buttonshare">
					<span class="fa fa-facebook-f"></span>
					<span class="fa fa-twitter"></span>
					<span class="fa fa-linkedin"></span>
				</div> -->
				<div class="company-action">
					<div class="company-primary-cta" style="text-align: left;">
						@foreach($user as $us)
						<div class="sidebar-top-investor">
							<div class="sidebar-top-investor-meta">
								<img class="lazy" src="{{url('public/avatar')}}/{{$us->avatar}}" alt="Iain Cameron" style="display: block;">
								<h3>{{$us->name}}</h3>
								<p>{{$us->birthday}}</p>
							</div><!-- .sidebar-top-investor-meta -->
						</div><!-- .sidebar-top-investor -->
						<div class="sidebar-top-investor">
							<span><b>Đến từ</b>: {{$us->address}}</span>
							<br>
							@foreach($position as $p)
							@if($p->code == 'cv')
							<span><b>{{$p->name}}</b> tại <b>{{$p->company}}</b></span><br>
							@endif
							@endforeach
							@foreach($position as $p)
							@if($p->code == 'th')
							<span>Từng học tại: <b>{{$p->name}}</b></span><br>
							@endif
							@endforeach
							<span><b>Kĩ năng làm việc</b>: </span>
							@foreach($position as $p)
							@if($p->code == 'kn')
							<span class="duanthamgia">{{$p->name}}</span>
							@endif
							@endforeach
							<br><!-- 
							<span><b>Dự án từng tham gia</b>: </span>
							chưa làm -->
						</div>
						@endforeach
					</div>
					@if(Auth::check() && Auth::user()->id != $pro->id_user)
					<div class="company-primary-cta" style="margin-top: 20px;">
						@if(count($team) == 0 && Auth::user()->id != $pro->id_user)
						<button class="verifyInvestoStatus" style="width: 100%" onclick="thamgiaduan()">Tham gia dự án</button> 
						@else
							@foreach($team as $teams)
							@if($teams->rule == 'yc' )
								<div class="verifyInvestoStatus " style="width: 100%;background-color: #fff;color: #000;border: 0px;"><span class="glyphicon glyphicon-refresh"> </span> Chờ phê duyệt</div> 
							@elseif($teams->rule == 'sv' )
								@if($teams->agree == 1 )
	                            <div class="verifyInvestoStatus " style="width: 100%;background-color: #fff;color: #000;border: 0px;">Đã tham gia <span class="glyphicon glyphicon-ok"></span></div>
	                            @else($teams->rule == '0' )
								<button class="verifyInvestoStatus" style="width: 100%" onclick="traloithamgia()">Trả lời lời mời</button>   
								@endif
							@elseif($teams->rule == 'gt' )
								@if($teams->agree == 1 )
	                            <div class="verifyInvestoStatus " style="width: 100%;background-color: #fff;color: #000;border: 0px;">Đã tham gia <span class="glyphicon glyphicon-ok"></span></div>
	                            @else($teams->rule == '0' )
								<button class="verifyInvestoStatus" style="width: 100%" onclick="traloithamgia()">Trả lời lời mời</button>   
								@endif
							@endif
							@endforeach
						@endif
						<button class="verifyInvestoStatus" style="margin-top: 10px;width: 100%" onclick="taitro()">Tài trợ</button>          
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</article>
	<div class="nutmid">
		<div class="container">
			<button id="active" onclick="nut2()"><img style="margin-right: 7px" src="{{url('public')}}/image/icon-company-tab.png">THÔNG TIN DỰ ÁN</button>
			<button id="active2" onclick="nut()" style="margin-top: 12px;"><img src="{{url('public')}}/image/icon-investment-tab.png" style="margin-right: 7px;">Báo cáo thực hiện dự án</button>
				@if(count($progress) > 0)
				<?php 
				$today = date("Y/m/d");
				foreach ($progress as $keyx) {
					$getday = $keyx->date;
					break;
				}
	            $date1=date_create($today);
	            $date2=date_create($getday);
	            $diffx=date_diff($date1,$date2);
	            $tongxxx = $diffx->format("%R%a")+0;
				?>
				@else
				<?php $tongxxx = '1'; ?>
				@endif
				@if($tongxxx <= 0)
				<button id="active3" onclick="nut3()" style="margin-top: 12px;"><img src="{{url('public')}}/image/icon-investment-tab.png" style="margin-right: 7px;">Đánh giá kết quả</button>
				@endif
		</div>
	</div>
	<article class=""> <!-- duan -->
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					@if($tongxxx <= 0)
					<div class="row" id="danhgiakq" style="display: none;">
						<div class="">
							<section class="details" style="padding: 25px 60px 25px 25px;">
								<h2 class="section-title">Đánh giá kết quả</h2>
								<div style="margin-left: 20px;">
									@if(Auth::check() && ($checkmember != 0 || $pro->id_user == Auth::user()->id) )
										<button class="btn btn-success btn-lg" onclick="addrating()">
											Thêm đánh giá <span class="glyphicon glyphicon-pencil"></span>
										</button>
										<div class="col-md-12" style="margin-top: 20px;display:none;" id="boxhunt">
											@if($pro->id_user == Auth::user()->id && Auth::user()->rule != 6)
											<div class="col-md-4">
												<button class="col-md-12 btn btn-primary btn-lg" style="height: 100px;font-size: 20px;" onclick="boxsv()">
													Sinh viên
												</button>
											</div>
											@endif
											@if($pro->id_user != Auth::user()->id)
											<div class="col-md-4">
												<button class="col-md-12 btn btn-primary btn-lg" onclick="boxgate()" style="height: 100px;font-size: 20px;">
													Gatekeeper
												</button>
											</div>
											@endif
											@if((Auth::user()->rule != 6 && Auth::user()->rule != 8) || Auth::user()->id == $pro->id_user)
											<div class="col-md-4">
												<button class="col-md-12 btn btn-primary btn-lg" onclick="boxdn()" style="height: 100px;font-size: 20px;">
													Doanh nghiệp
												</button>
											</div>
											@endif
										</div>
										<div class="col-md-12" style="margin-top: 20px;display:none;" id="boxsv">
											@if((count($mangsv)) >0)
												@foreach($mangsv as $msv)
													<div class="col-md-4 " style="padding: 10px">
														<button onclick="selectsv('{{$msv->users['id']}}')" class="col-md-12 btn btn-default">
															<img  src="{{url('public')}}/avatar/{{$msv->users['avatar']}}"  style="display: block;width: 60px;margin: 0 auto;">
															<h3 id="namesv{{$msv->users['id']}}" style="width: 100%;text-align: center;">{{$msv->users['name']}}</h3>
														</button>
													</div>
												@endforeach
											@endif
										</div>
										<div class="col-md-12" style="margin-top: 20px;display:none" id="boxgate">
													<div class="col-md-4 " style="padding: 10px">
														<button onclick="selectgate('{{$us->id}}')" class="col-md-12 btn btn-default">
															<img  src="{{url('public')}}/avatar/{{$us->avatar}}"  style="display: block;width: 60px;margin: 0 auto;">
															<h3 id="namegate{{$us->id}}" style="width: 100%;text-align: center;">{{$us->name}}</h3>
														</button>
													</div>
										</div>
										<div class="col-md-12" style="margin-top: 20px;display:none;" id="boxdn">
											@if((count($mangndt)) >0)
												@foreach($mangndt as $ndt)
													<div class="col-md-4 " style="padding: 10px">
														<button onclick="selectndt('{{$ndt->users['id']}}')" class="col-md-12 btn btn-default">
															<img  src="{{url('public')}}/avatar/{{$ndt->users['avatar']}}"  style="display: block;width: 60px;margin: 0 auto;">
															<h3 id="namendt{{$ndt->users['id']}}" style="width: 100%;text-align: center;">{{$ndt->users['name']}}</h3>
														</button>
													</div>
												@endforeach
											@endif
										</div>
										<div class="col-md-12 boxratesv" style="margin-top: 20px;display:none;">
											<div class="box box-success">
												<div class="box-header with-border">
													<h3 class="box-title">Đánh giá Sinh viên: <span id="nhansv"></span></h3>
												</div>
												<div class="box-body">
													<form action="{{route('danhgiasv')}}" method="post">
														@csrf
														<input type="hidden" value="{{$id}}" name="id">
														<input type="hidden" name="sv" id="svinput">
														<input type="hidden" name="skill" id="inputskill">
														<input type="hidden" name="knowledge" id="inputknowledge">
														<input type="hidden" name="attitude" id="inputattitude">
														<div class="form-group">
										                	<label >Nội dung đánh giá</label>
															<textarea name="noidung" class="form-control" placeholder="Nội dung"></textarea>
										                </div> 
														<div class="form-group">
										                	<label>Skill</label>
										                	<div id="rating">
										                		<span id="skill1" onclick="skill(1)" class="glyphicon glyphicon-star"></span>
										                		<span id="skill2" onclick="skill(2)" class="glyphicon glyphicon-star"></span>
										                		<span id="skill3" onclick="skill(3)" class="glyphicon glyphicon-star"></span>
										                		<span id="skill4" onclick="skill(4)" class="glyphicon glyphicon-star"></span>
										                		<span id="skill5" onclick="skill(5)" class="glyphicon glyphicon-star"></span>
										                	</div>
										                </div>
														<div class="form-group">
										                	<label>Knowledge</label>
										                	<div id="rating">
										                		<span id="knowledge1" onclick="knowledge(1)" class="glyphicon glyphicon-star"></span>
										                		<span id="knowledge2" onclick="knowledge(2)" class="glyphicon glyphicon-star"></span>
										                		<span id="knowledge3" onclick="knowledge(3)" class="glyphicon glyphicon-star"></span>
										                		<span id="knowledge4" onclick="knowledge(4)" class="glyphicon glyphicon-star"></span>
										                		<span id="knowledge5" onclick="knowledge(5)" class="glyphicon glyphicon-star"></span>
										                	</div>
										                </div>
														<div class="form-group">
										                	<label>Attitude</label>
										                	<div id="rating">
										                		<span id="attitude1" onclick="attitude(1)" class="glyphicon glyphicon-star"></span>
										                		<span id="attitude2" onclick="attitude(2)" class="glyphicon glyphicon-star"></span>
										                		<span id="attitude3" onclick="attitude(3)" class="glyphicon glyphicon-star"></span>
										                		<span id="attitude4" onclick="attitude(4)" class="glyphicon glyphicon-star"></span>
										                		<span id="attitude5" onclick="attitude(5)" class="glyphicon glyphicon-star"></span>
										                	</div>
										                </div>
										                <button type="submit" class="btn btn-primary">Hoàn thành</button>
									                </form>
												</div>
											<!-- /.box-body -->
											</div>
										</div>
										<div class="col-md-12 boxratendt" style="margin-top: 20px;display:none;">
											<div class="box box-success">
												<div class="box-header with-border">
													<h3 class="box-title">Đánh giá Nhà đầu tư: <span id="nhanndt"></span></h3>
												</div>
												<div class="box-body">
													<form action="{{route('danhgiandt')}}" method="post">
														@csrf
														<input type="hidden" value="{{$id}}" name="id">
														<input type="hidden" name="ndt" id="ndtinput"> 
														<div class="form-group">
										                	<label >Nội dung đánh giá</label>
															<textarea name="noidung" class="form-control" placeholder="Nội dung"></textarea>
										                </div> 
										                <button type="submit" class="btn btn-primary">Hoàn thành</button>
									                </form>
												</div>
											<!-- /.box-body -->
											</div>
										</div>
										<div class="col-md-12 boxrategate" style="margin-top: 20px;display:none;">
											<div class="box box-success">
												<div class="box-header with-border">
													<h3 class="box-title">Đánh giá Gatekeeper: <span id="nhangate"></span></h3>
												</div>
												<div class="box-body">
													<form action="{{route('danhgiagate')}}" method="post">
														@csrf
														<input type="hidden" value="{{$id}}" name="id">
														<input type="hidden" name="gate" id="gateinput">
														<input type="hidden" name="star" id="stargateinput">
														<div class="form-group">
										                	<label >Nội dung đánh giá</label>
															<textarea name="noidung" class="form-control" placeholder="Nội dung"></textarea>
										                </div> 
														<div class="form-group">
										                	<label>Đánh giá</label>
										                	<div id="rating">
										                		<span id="star1" onclick="starover(1)" class="glyphicon glyphicon-star"></span>
										                		<span id="star2" onclick="starover(2)" class="glyphicon glyphicon-star"></span>
										                		<span id="star3" onclick="starover(3)" class="glyphicon glyphicon-star"></span>
										                		<span id="star4" onclick="starover(4)" class="glyphicon glyphicon-star"></span>
										                		<span id="star5" onclick="starover(5)" class="glyphicon glyphicon-star"></span>
										                	</div>
										                </div>
										                <button type="submit" class="btn btn-primary">Hoàn thành</button>
									                </form>
												</div>
											<!-- /.box-body -->
											</div>
										</div>
									@endif
									<div class="col-md-12" style="margin-top: 30px">
									  <ul class="nav nav-tabs" style="font-weight: bold;">
									    <li class="active"><a data-toggle="tab" href="#home">Sinh Viên</a></li>
									    <li><a data-toggle="tab" href="#menu1">Gatekeeper</a></li>
									    <li><a data-toggle="tab" href="#menu2">Doanh nghiệp</a></li>
									  </ul>
									  <div class="tab-content">
									    <div id="home" class="tab-pane fade in active">
									    	@foreach($reviews as $rw)
									    	@if($rw->leve == 'sv')
										    <div class="col-md-12" style="margin-top: 20px;padding: 0px;">
												@foreach($mangsv as $msv)
													@if($rw->id_user == $msv->users['id'])
														<div class="box box-success" style="box-shadow: 0 1px 1px rgba(0, 0, 0, 0.36);">
															<div class="box-header with-border" style="padding-bottom: 5px;border-bottom: 1px solid #00000014;">
																<h3 class="box-title">
																	<a href="{{url($msv->users['linkprofile'])}}" target="blank">
																		<img src="{{url('public/avatar/'.$msv->users['avatar'])}}" style="width: 50px;height: 50px;float: left;margin-right: 10px;border-radius: 100%">
																		<span style="margin-top: 15px;float: left;width: 100%;position: absolute;">
																			<b>{{$msv->users['name']}}</b>
																		</span>
																	</a>
																</h3>
															</div>
															<div class="box-body" style="padding-top: 0px;">
																Người đánh giá: <a href="{{url($us->linkprofile)}}" target="blank">{{$us->name}}</a>
																<br>
																{{$rw->comment}}
																<br>
																<div style="width: 100%;float: left;">
																	<span style="width: 80px;float: left;margin-top: 20px;">Skill:</span> @for ($i = 0; $i < $rw->skill; $i++) <span class="glyphicon glyphicon-star" style="font-size: 35px;top:10px;color: orange"></span> @endfor @for ($i = 0; $i < 5 - $rw->skill; $i++) <span class="glyphicon glyphicon-star" style="font-size: 35px;top:10px;color: #b1b1b1"></span> @endfor
																</div>
																<div style="width: 100%;float: left;">
																	<span style="width: 80px;float: left;margin-top: 20px;">Attitude:</span> @for ($i = 0; $i < $rw->attitude; $i++) <span class="glyphicon glyphicon-star" style="font-size: 35px;top:10px;color: orange"></span> @endfor @for ($i = 0; $i < 5 - $rw->attitude; $i++) <span class="glyphicon glyphicon-star" style="font-size: 35px;top:10px;color: #b1b1b1"></span> @endfor
																</div>
																<div style="width: 100%;float: left;">
																	<span style="width: 80px;float: left;margin-top: 20px;">Knowledge:</span> @for ($i = 0; $i < $rw->knowledge; $i++) <span class="glyphicon glyphicon-star" style="font-size: 35px;top:10px;color: orange"></span> @endfor @for ($i = 0; $i < 5 - $rw->knowledge; $i++) <span class="glyphicon glyphicon-star" style="font-size: 35px;top:10px;color: #b1b1b1"></span> @endfor
																</div>
															</div>
														<!-- /.box-body -->
														</div>
													@endif
												@endforeach
										    </div>
										    @endif
										    @endforeach
									    </div>
									    <div id="menu1" class="tab-pane fade">
									    	@foreach($reviews as $rw)
									    	@if($rw->leve == 'gate')
										    <div class="col-md-12" style="margin-top: 20px;padding: 0px;">
												@if($rw->id_gatepro == $us->id)
													<div class="box box-success" style="box-shadow: 0 1px 1px rgba(0, 0, 0, 0.36);">
														<div class="box-header with-border" style="padding-bottom: 5px;border-bottom: 1px solid #00000014;">
															<h3 class="box-title">
																<a href="{{url($us->linkprofile)}}" target="blank">
																	<img src="{{url('public/avatar/'.$us->avatar)}}" style="width: 50px;height: 50px;float: left;margin-right: 10px;border-radius: 100%">
																	<span style="margin-top: 15px;float: left;width: 100%;position: absolute;">
																		<b>{{$us->name}}</b>
																	</span>
																</a>
															</h3>
														</div>
														<div class="box-body" style="padding-top: 0px;">
															Người đánh giá: <a href="{{url($us->linkprofile)}}" target="blank">{{$us->name}}</a>
															<br>
															{{$rw->comment}}
															<br>
															<div style="width: 100%">
																<span style="width: 80px;float: left;margin-top: 20px;">Đánh giá:</span> @for ($i = 0; $i < $rw->rate; $i++) <span class="glyphicon glyphicon-star" style="font-size: 35px;top:10px;color: orange"></span> @endfor @for ($i = 0; $i < 5 - $rw->rate; $i++) <span class="glyphicon glyphicon-star" style="font-size: 35px;top:10px;color: #b1b1b1"></span> @endfor
															</div>
														</div>
													<!-- /.box-body -->
													</div>
												@endif
										    </div>
										    @endif
											@endforeach
									    </div>
									    <div id="menu2" class="tab-pane fade">
									    	@foreach($reviews as $rw)
									    	@if($rw->leve == 'ndt')
										    <div class="col-md-12" style="margin-top: 20px;padding: 0px;">
												@foreach($mangndt as $mndt)
													@if($rw->id_user == $mndt->users['id'])
														<div class="box box-success" style="box-shadow: 0 1px 1px rgba(0, 0, 0, 0.36);">
															<div class="box-header with-border" style="padding-bottom: 5px;border-bottom: 1px solid #00000014;">
																<h3 class="box-title">
																	<a href="{{url($mndt->users['linkprofile'])}}" target="blank">
																		<img src="{{url('public/avatar/'.$mndt->users['avatar'])}}" style="width: 50px;height: 50px;float: left;margin-right: 10px;;border-radius: 100%">
																		<span style="margin-top: 15px;float: left;width: 100%;position: absolute;">
																			<b>{{$mndt->users['name']}}</b>
																		</span>
																	</a>
																</h3>
															</div>
															<div class="box-body" style="padding-top: 0px;">
																Người đánh giá: <a href="{{url($us->linkprofile)}}" target="blank">{{$us->name}}</a>
																<br>
																{{$rw->comment}}
																<br>
															</div>
														<!-- /.box-body -->
														</div>
													@endif
												@endforeach
										    </div>
										    @endif
										    @endforeach
									    </div>
									  </div>
									</div>
								</div>
							</section>
						</div>
					</div>
					@endif
					<div class="row">
						<div class="col-md-12"   style="display: block;" id="tiendotab1">
							<section class="investment-details" >
								<h2 class="section-title" style="margin: 25px 0 0px 0px">Tiến độ đầu tư</h2>
								<div class="investment-amount clearfix">
									<?php 
									$demtien = 0;
									foreach ($invest as $ke) {
										$demtien = $demtien + $ke->money;
									}
									$tongtien = $demtien/($pro->money / 100);
									 ?>
									<div class="investment-type"><strong>{{round($tongtien)}}% được tài trợ</strong></div>
								</div><!-- end investment-amount -->
								<div style="width: 100%;position: relative;margin-top: 10px;">
									<div style="width: 100%;height: 15px;background-color: #cdcdcd;float: left;position: absolute;">
										<div style="width: {{$tongtien}}%;height: 15px;background-color: #ff8900;"></div>
									</div>
								</div>
								<p style="margin-top: 30px;"></p>
								<div class="col-md-12 moneytaitro">
									<div class="col-md-6">
										<p><span id="sotien1">{{$demtien}}</span> đ</p>
										<span>Tiền đặt cọc</span>
									</div>
									<div class="col-md-6">
										<p style="margin-top: 14px;font-size: 20px !important"><span id="sotien2" style="color: #333;font-size: 24px !important;">{{$pro->money}}</span> đ</p>
										<span>Mục tiêu</span>
									</div>
								</div>
								<div class="unverified-investor invest-buttons">
									<button class="potential-investment default verify-first verifyInvestoStatus" data-fund-type="default verify-first" data-deal-id="52439" data-min-invest-amount="$5,000" data-company-name="urbo" onclick="taitro()" style="margin-top: 20px">Tôi muốn tài trợ</button>
								</div>
							</section>
						</div>
						<div class="col-md-12"   style="display: none;padding: 0px" id="tiendodautu">
							<section id="details">
								<h2 class="section-title">Tiến độ dự án ban đầu</h2>
								@if(count($progress) != 0)
								<div id="khungtimeline">
									<?php 
									$demprog = count($progress);
									$vach = array();
									foreach ($progress as $key) {
										$vach[] = date('d-m-Y', strtotime($key->date));
									}
									$date1=date_create($vach[0]);
									$date2=date_create($vach[$demprog-1]);
									$diff=date_diff($date1,$date2);
									$tongpc = $diff->format("%R%a");
									for ($i=0; $i < $demprog ; $i++) { 
										if ($i == 0) {
											echo '<button type="button" id="vach'.$i.'" class="buttimeline" data-toggle="tooltip" data-placement="left" title="'.$vach[$i].'" style="left: 0%"></button>';
										}elseif($demprog > 1){
											if ($i == ($demprog-1)) {
												echo '<button type="button" id="vach'.$i.'" class="buttimeline" data-toggle="tooltip" data-placement="left" title="'.$vach[$i].'" style="left: 99%"></button>';
											}else{
												$vach1=date_create($vach[0]);
												$vach2=date_create($vach[$i]);
												$diffvach =date_diff($vach1,$vach2);
												$tongvach = $diffvach->format("%R%a");
												$timpc = $tongvach/($tongpc/100);
												$timpc = $timpc - ($timpc/100);
												echo '<button type="button" id="vach'.$i.'" class="buttimeline" data-toggle="tooltip" data-placement="left" title="'.$vach[$i].'" style="left: '.$timpc.'%"></button>';
											}
										}
									}
									?>
								</div>
								<div class="row">
									<table class="table table-striped col-md-12">
										<thead style="border-bottom: solid 1px #b1b1b1;">
											<th style="width: 100px;border-bottom: 2px solid #b5b5b5;">Ngày</th>
											<th style="border-bottom: 2px solid #b5b5b5;">Mục tiêu đề ra</th>
										</thead>
										<tbody>
											<?php $demtable = 0; ?>
											@foreach($progress as $prg)
											<tr id="bang{{$demtable}}" onmouseover="bang({{$demtable}})" onmouseout="tru({{$demtable}})">
												<td id="date{{$prg->id}}"><?= date('d-m-Y', strtotime($prg->date)); ?></td>
												<td style="white-space: pre-line;" id="content{{$prg->id}}">{{$prg->content}}
												</td>
											</tr>
											<?php $demtable++; ?>
											@endforeach
										</tbody>
									</table>
								</div>
								@else
								<p>Chưa có tiến độ dự kiến.</p>
								@endif
							</section>
						</div>
						<div class="col-md-12"   style="display: none;padding: 0px" id="dutoan">
							<section id="">
								<h2 class="section-title">Bảng dự toán</h2>
								@if(count($progress) != 0)
									<table class="table">
					                  <thead>
					                    <th>Khoản mục</th>
					                    <th>Đơn vị</th>
					                    <th>Số lượng</th>
					                    <th>Số tiền khi thuê ngoài</th>
					                    <th>Số tiền trên nền tảng homoi.vn</th>
					                  </thead>
					                  <tbody>
					                  	<?php $tongngoai = 0; $tongsv= 0; ?>
					                    @foreach($estimate as $es)
					                    <?php 
					                    	$tongsv = $tongsv+$es->sotiensv;
					                    	$tongngoai = $tongngoai+$es->sotienkhac;
					                    ?>
					                    <tr>
					                      <td><span id="khoanmuc{{$es->id}}">{{$es->name}}</span></td>
					                      <td><span id="donvi{{$es->id}}">{{$es->donvi}}</span></td>
					                      <td><span id="soluong{{$es->id}}">{{$es->soluong}}</span></td>
					                      <td style="text-align: right;"><span id="donvi{{$es->id}}">{{$es->sotienkhac}}</span> đ</td>
					                      <td style="text-align: right;"><span id="sotiensv{{$es->id}}">{{$es->sotiensv}}</span> đ</td>
					                    </tr>
					                    @endforeach
					                    <tr style="border-top: 2px #000 solid">
					                    	<td>Tổng</td>
					                    	<td></td>
					                    	<td></td>
					                    	<td style="text-align: right;">{{$tongngoai}} đ</td>
					                    	<td style="text-align: right;">{{$tongsv}} đ</td>
					                    </tr>
					                  </tbody>
					                </table>
								@else
								<p>Chưa có tiến độ dự kiến.</p>
								@endif
							</section>
						</div>
						<div class="modulbox col-md-12" style="float: left;margin-top: 30px;">
							<div style="padding-right: 0px;float: left;" class="col-md-3">
								<ul class="slidebarleft" id="slidebarleft">
									@foreach($modul as $mo)
									
									<li><a onClick="$('html,body').animate({scrollTop: $('#idcll{{$mo->id}}').offset().top-20},'slow');" >{{$mo->name}}</a></li>
									@endforeach
								</ul>
							</div>
							<div class="col-md-9" style="padding: 25px 25px 25px 50px">
								@foreach($modul as $mo)
								<h2 style="float: left;" class="section-title" id="idcll{{$mo->id}}">{{$mo->name}}</h2>
								<div class="custom-content col-md-12" style="border-bottom: 1px dashed #b1b1b1;margin-bottom: 25px;padding: 0 0 20px 0"><?php echo($mo->content); ?></div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
				<div style="padding-right: 0px;" class="col-md-4 " id="slidebarright">
					<div style="margin-bottom: 20px;position: relative;margin-top: 20px">
						@if(Auth::check() && Auth::user()->id != $pro->id_user)
				            @if($follow == 0)
				            <button class="btn btn-primary btn-lg" id="follow" onclick="follow()" style="background-color: #3897f0;border-color: #3897f0;width: 100%">Theo dõi dự án</button>
				            @else
				            <button class="btn btn-primary btn-lg" id="follow" onclick="follow()" style="background-color: #fff;border-color: #dbdbdb;color:#000;width: 100%">Bỏ theo dõi dự án</button>
				            @endif
				        @endif
				        <div class="col-md-12" style="position: absolute;top: 3px;">
				            <div class="col-md-5"></div>
				            <div class="col-md-5">
				                <img src="{{url('public/image/loadding.gif')}}" id="imgfollow" style="width: 40px;height: 40px;margin: 0px;display: none;">
				            </div>
				        </div>
					</div>
					<div class="col-md-12" style="padding: 0px;margin-bottom: 30px;">
						<h2>Tổng quan</h2>
						<div class="mitongquan col-md-4" style="float: left;">
							<p id="countfollow">{{$countfollow}}</p>
							<span>Người theo dõi</span>
						</div>
						<div class="mitongquan xam col-md-4" style="float: left;">
							<p>{{$countsv}}</p>
							<span>Số sinh viên</span>
						</div> 
						<div class="mitongquan  col-md-4" style="float: left;">
							<p>{{$countgate}}</p>
							<span>Số ban cố vấn</span>
						</div> 
						<div class="mitongquan xam col-md-4" style="float: left;">
							<p>{{$countdautu}}</p>
							<span>Nhà đầu tư</span>
						</div>
						<div class="mitongquan  col-md-4" style="float: left;">
							@if(isset($$getstart) && count($getstart) != 0)<?php $getstart = date_create($getstart); ?>
							<p style="font-size: 16px;margin-top: 18px;">{{date_format($getstart,"d/m/Y")}}</p>
							@else
							<p>0</p>
							@endif
							<span>Ngày bắt đầu</span>
						</div>
						<div class="mitongquan xam col-md-4" style="float: left;">
							@if(isset($$getstop) && count($getstop) != 0)
							<?php $getstop = date_create($getstop); ?>
							<p style="font-size: 16px;margin-top: 18px;">{{date_format($getstop,"d/m/Y")}}</p>
							@else
							<p>0</p>
							@endif
							<span>Ngày kết thúc</span>
						</div>
					</div>
					@if(count($invest) != 0)
					<div class="col-md-12  raise-details-module" id="nhataitro" style="display: none;padding: 0px;">
						<h2>Nhà tài trợ</h2>
						<ul>
							@foreach($invest as $inv)
							<li>
								@foreach($mangndt as $mndt)
								@if($mndt->users['id'] == $inv->id_user)
								<strong><a target="blank" href="{{url($mndt->users['linkprofile'])}}">{{$mndt->users['name']}}</a></strong>
								@endif
								@endforeach
								<span><span id="sotien3">{{$inv->money}} đ</span></span>
							</li>
							@endforeach
						</ul>
					</div>
					@endif
					<div class="col-md-12 sidebar-module raise-details-module" id="dokhoduan" style="padding-bottom: 20px;display: none;">
						<h2 style="margin-bottom: 5px;">Độ khó dự án</h2>
						<div id="dokho"><span class="glyphicon glyphicon-star stardokho" style=""></span><span class="glyphicon glyphicon-star stardokho" style=""></span><span class="glyphicon glyphicon-star stardokho" style=""></span><span class="glyphicon glyphicon-star stardokho" style="color: #b1b1b1"></span></div>
						<div style="width: 100%;">
							<ul class="dokhoulli">
								<li>
									<strong>Một sao:</strong>
									<span>Nhân viên tập sự</span>
								</li>
								<li>
									<strong>Hai sao:</strong>
									<span>Nhân viên chính thức</span>
								</li>
								<li>
									<strong>Ba sao:</strong>
									<span>Nhân viên cao cấp</span>
								</li>
								<li>
									<strong>Bốn sao:</strong>
									<span>Lãnh đạo, trưởng nhóm</span>
								</li>
							</ul>
						</div>
					</div>
					@if((count($manggate)) >0)
					<div class="col-md-12 investors-module clearfix" style="padding: 0px;background-color: #fff">
						<h2>Ban cố vấn chuyên môn</h2>
						@foreach($manggate as $gtg)
						<div class="sidebar-top-investor">
							<div class="sidebar-top-investor-meta">
								<a href="{{url($gtg->users['linkprofile'])}}" target="blank">
									<img class="lazy" src="{{url('public')}}/avatar/{{$gtg->users['avatar']}}" alt="Iain Cameron" style="display: block;">
									<h3>{{$gtg->users['name']}}</h3>
								</a>
							</div><!-- .sidebar-top-investor-meta -->
						</div><!-- .sidebar-top-investor -->
						@endforeach
					</div>
					@endif
					@if((count($mangsv)) >0)
					<div class="col-md-12 investors-module clearfix" style="padding: 0px;background-color: #fff">
						<h2>Sinh viên tham gia dự án</h2>
						@foreach($mangsv as $msv)
						<div class="sidebar-top-investor">
							<div class="sidebar-top-investor-meta">
								<a href="{{url($msv->users['linkprofile'])}}" target="blank">
									<img class="lazy" src="{{url('public')}}/avatar/{{$msv->users['avatar']}}" alt="Iain Cameron" style="display: block;">
									<h3>{{$msv->users['name']}}</h3>
								</a>
							</div><!-- .sidebar-top-investor-meta -->
						</div><!-- .sidebar-top-investor -->
						@endforeach
					</div>
					@endif
				</div>
			</div>
		</div>
	</article>
	<footer>
		
	</footer>
</body>
@endforeach
<!-- Modal -->
<div id="hoixinthamgia" class="modal fade" role="dialog">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Bạn có muốn tham gia dự án?</h4>
      </div>
      <div class="modal-body bodydautu">
      	<div class="row">
      	<div class="col-md-4"></div>
      	<div class="col-md-4 contentthamgia"> 
      		<a href="{{url('thamgiaduan/'.$id)}}">
		        <button class="btn btn-default btn-lg"><span class="glyphicon glyphicon-ok"> </span> Gửi yêu cầu tham gia</button>
      		</a>
	        <button data-dismiss="modal" class="btn btn-lg btn-danger"><span class="glyphicon glyphicon-remove"> </span> Quay lại</button>
      	</div>
      	<div class="col-md-4"></div>
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal -->
<div id="traloithamgia" class="modal fade" role="dialog">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Bạn có muốn tham gia dự án?</h4>
      </div>
      <div class="modal-body bodydautu">
      	<div class="row">
      	<div class="col-md-4"></div>
      	<div class="col-md-4 contentthamgia">
      		<a href="{{url('dongythamgia/'.$id)}}">
		        <button class="btn btn-default btn-lg">Đồng ý tham gia</button>
      		</a>
      		<a href="{{url('tuchoithamgia/'.$id)}}">
		        <button class="btn btn-danger btn-lg">Xóa lời mời</button>
		    </a>
      	</div>
      	<div class="col-md-4"></div>
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body bodydautu thongtincuthe">
	        <h4 class="modal-title">THÔNG TIN DỰ ÁN</h4>
	      	<table class="table table-striped">
	      		<thead>
	      			<th style="width: 200px"></th>
	      			<th></th>
	      		</thead>
	      		<tbody>
	      			<tr>
				      	<td>Tên dự án</td>
				      	<td><b>{{$pro->name}}</b></td>
				    </tr>
				    <tr>
				      	<td>Địa điểm thực hiện</td>
				      	<td><b>{{$pro->place}}</b></td>
				    </tr>
				    <tr>
				      	<td>Mô tả dự án</td>
				      	<td><b>{{$pro->short_description}}</b></td>
				    </tr>
				    <tr>
				      	<td>Người bảo trợ</td>
		      			<td><b><a href="{{url($us->linkprofile)}}" style="color: #3c8dbc;">{{$us->name}}</a></b></td>
				    </tr>
				    <tr>
						<td>Số tiền dự án cần đầu tư</td>
						<td><b id="idsotien">{{$pro->money}} </b> đ</td>
					</tr>
	      		</tbody>
	      	</table>
      </div>
      <div class="modal-body bodydautu" id="hienthihoadon">
      	<div class="row">
	      	<div class="col-md-4"></div>
	      	<div class="col-md-4 contentmodautu">
		        <img src="{{url('public/image/loadding.gif')}}">
	      	</div>
	      	<div class="col-md-4"></div>
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
      </div>
    </div>

  </div>
</div>
<script src="{{url('public')}}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{url('public')}}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
	window.onscroll = function() {myFunction()};
	var header = document.getElementById("slidebarleft");
	var sticky = $("#slidebarleft").offset();
	function myFunction() {
	  if (window.pageYOffset >= sticky.top) {
	    header.classList.add("stick");
	  } else {
	    header.classList.remove("stick");
	  }
	}

	demrating = 0;
	demboxhunt = 0;
	function follow() {
        $('#follow').css('opacity','0.7');
        $('#imgfollow').css('display','block');
        var iddata = '{{$id}}';
        var thispro = 1;
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
                	var x = $('#countfollow').html();
                	$('#countfollow').html(Number(x)+1);
                }else{
                   $('#follow').html('Theo dõi');
                    $('#follow').css('color','#fff');
                    $('#follow').css('background-color','#3897f0');
                    $('#follow').css('border-color','#3897f0');
                	var x = $('#countfollow').html();
                	$('#countfollow').html(Number(x)-1);
                }
            }
        });
    }
	function addrating() {
		if (demboxhunt == 0) {
			$('#boxhunt').css('display','block');
			demboxhunt = 1;
		}else {
			demboxhunt = 0;
			$('#boxhunt').css('display','none');
			$('#boxsv').css('display','none');
			$('#boxgate').css('display','none');
			$('#boxdn').css('display','none');
			$('.boxratesv').css('display','none');
			$('.boxrategate').css('display','none');
			$('.boxratendt').css('display','none');
		}
	}
	function boxsv() {
		$('.boxratesv').css('display','none');
		$('.boxrategate').css('display','none');
		$('.boxratendt').css('display','none');
		$('#boxsv').css('display','block');
		$('#boxgate').css('display','none');
		$('#boxdn').css('display','none');
	}
	function boxgate() {
		$('.boxratesv').css('display','none');
		$('.boxrategate').css('display','none');
		$('.boxratendt').css('display','none');
		$('#boxsv').css('display','none');
		$('#boxgate').css('display','block');
		$('#boxdn').css('display','none');
	}
	function boxdn() {
		$('.boxratesv').css('display','none');
		$('.boxrategate').css('display','none');
		$('.boxratendt').css('display','none');
		$('#boxsv').css('display','none');
		$('#boxgate').css('display','none');
		$('#boxdn').css('display','block');
	}
	function selectgate(n) {
		$('.boxrategate').css('display','block');
		$('#nhangate').html($('#namegate'+n).html());
		$('#gateinput').val(n);
	}
	function selectndt(n) {
		$('.boxratendt').css('display','block');
		$('#nhanndt').html($('#namendt'+n).html());
		$('#ndtinput').val(n);
	}
	function selectsv(n) {
		$('.boxratesv').css('display','block'); 
		$('#nhansv').html($('#namesv'+n).html());
		$('#svinput').val(n);
	}
	function attitude(n) {
		$('#inputattitude').val(n);
		if (n == 1) {
			$('#attitude1').css('color','red');
			$('#attitude2').css('color','#b1b1b1');
			$('#attitude3').css('color','#b1b1b1');
			$('#attitude4').css('color','#b1b1b1');
			$('#attitude5').css('color','#b1b1b1');
		}else if(n == 2){
			$('#attitude1').css('color','red');
			$('#attitude2').css('color','red');
			$('#attitude3').css('color','#b1b1b1');
			$('#attitude4').css('color','#b1b1b1');
			$('#attitude5').css('color','#b1b1b1');
		}else if(n == 3){
			$('#attitude1').css('color','red');
			$('#attitude2').css('color','red');
			$('#attitude3').css('color','red');
			$('#attitude4').css('color','#b1b1b1');
			$('#attitude5').css('color','#b1b1b1');
		}else if(n == 4){
			$('#attitude1').css('color','red');
			$('#attitude2').css('color','red');
			$('#attitude3').css('color','red');
			$('#attitude4').css('color','red');
			$('#attitude5').css('color','#b1b1b1');
		}else if(n == 5){
			$('#attitude1').css('color','red');
			$('#attitude2').css('color','red');
			$('#attitude3').css('color','red');
			$('#attitude4').css('color','red');
			$('#attitude5').css('color','red');
		}
	}
	function knowledge(n) {
		$('#inputknowledge').val(n);
		if (n == 1) {
			$('#knowledge1').css('color','red');
			$('#knowledge2').css('color','#b1b1b1');
			$('#knowledge3').css('color','#b1b1b1');
			$('#knowledge4').css('color','#b1b1b1');
			$('#knowledge5').css('color','#b1b1b1');
		}else if(n == 2){
			$('#knowledge1').css('color','red');
			$('#knowledge2').css('color','red');
			$('#knowledge3').css('color','#b1b1b1');
			$('#knowledge4').css('color','#b1b1b1');
			$('#knowledge5').css('color','#b1b1b1');
		}else if(n == 3){
			$('#knowledge1').css('color','red');
			$('#knowledge2').css('color','red');
			$('#knowledge3').css('color','red');
			$('#knowledge4').css('color','#b1b1b1');
			$('#knowledge5').css('color','#b1b1b1');
		}else if(n == 4){
			$('#knowledge1').css('color','red');
			$('#knowledge2').css('color','red');
			$('#knowledge3').css('color','red');
			$('#knowledge4').css('color','red');
			$('#knowledge5').css('color','#b1b1b1');
		}else if(n == 5){
			$('#knowledge1').css('color','red');
			$('#knowledge2').css('color','red');
			$('#knowledge3').css('color','red');
			$('#knowledge4').css('color','red');
			$('#knowledge5').css('color','red');
		}
	}
	function skill(n) {
		$('#inputskill').val(n);
		if (n == 1) {
			$('#skill1').css('color','red');
			$('#skill2').css('color','#b1b1b1');
			$('#skill3').css('color','#b1b1b1');
			$('#skill4').css('color','#b1b1b1');
			$('#skill5').css('color','#b1b1b1');
		}else if(n == 2){
			$('#skill1').css('color','red');
			$('#skill2').css('color','red');
			$('#skill3').css('color','#b1b1b1');
			$('#skill4').css('color','#b1b1b1');
			$('#skill5').css('color','#b1b1b1');
		}else if(n == 3){
			$('#skill1').css('color','red');
			$('#skill2').css('color','red');
			$('#skill3').css('color','red');
			$('#skill4').css('color','#b1b1b1');
			$('#skill5').css('color','#b1b1b1');
		}else if(n == 4){
			$('#skill1').css('color','red');
			$('#skill2').css('color','red');
			$('#skill3').css('color','red');
			$('#skill4').css('color','red');
			$('#skill5').css('color','#b1b1b1');
		}else if(n == 5){
			$('#skill1').css('color','red');
			$('#skill2').css('color','red');
			$('#skill3').css('color','red');
			$('#skill4').css('color','red');
			$('#skill5').css('color','red');
		}
	}
	function starover(n) {
		$('#stargateinput').val(n);
		if (n == 1) {
			$('#star1').css('color','red');
			$('#star2').css('color','#b1b1b1');
			$('#star3').css('color','#b1b1b1');
			$('#star4').css('color','#b1b1b1');
			$('#star5').css('color','#b1b1b1');
		}else if(n == 2){
			$('#star1').css('color','red');
			$('#star2').css('color','red');
			$('#star3').css('color','#b1b1b1');
			$('#star4').css('color','#b1b1b1');
			$('#star5').css('color','#b1b1b1');
		}else if(n == 3){
			$('#star1').css('color','red');
			$('#star2').css('color','red');
			$('#star3').css('color','red');
			$('#star4').css('color','#b1b1b1');
			$('#star5').css('color','#b1b1b1');
		}else if(n == 4){
			$('#star1').css('color','red');
			$('#star2').css('color','red');
			$('#star3').css('color','red');
			$('#star4').css('color','red');
			$('#star5').css('color','#b1b1b1');
		}else if(n == 5){
			$('#star1').css('color','red');
			$('#star2').css('color','red');
			$('#star3').css('color','red');
			$('#star4').css('color','red');
			$('#star5').css('color','red');
		}
	}
	dem = 1;
	demmodautu = 0;
	function traloithamgia() {
		$('#traloithamgia').modal('show');
	}
	function thamgiaduan() {
		@if(Auth::check())
			var checklog = '{{Auth::user()->rule}}';
		@else
			var checklog = '';
		@endif
		if (checklog == '8' || checklog == '') {
			$('#hoixinthamgia').modal('show');
		}else{
			alert('Bạn không phải sinh viên, hãy liên hệ với người tạo dự án!');
		}
	}
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
	function bang(n) {
		$('#vach'+n).tooltip('show');
		$('#bang'+n).css('background-color','#d6d6d6');
	}
	function tru(n) {
		$('#vach'+n).tooltip('hide');
		$('#bang'+n).css('background-color','#fff');
	}
	$('p a').tooltip({placement: 'bottom',trigger: 'manual'}).tooltip('show');
	function nut() {
		if (dem != 0) {
			$('#dutoan').css('display','block');
			$('.modulbox').css('display','none');
			$('#tiendotab1').css('display','none');
			$('#tiendodautu').css('display','block');
			$('#nhataitro').css('display','block');
			$('#dokhoduan').css('display','none');
			$('#danhgiakq').css('display','none');
			$('#active').css('background','#e4e4e4');
			$('#active').css('borderBottom','solid 1px #b1b1b1');
			$('#active').css('height','58px');
			$('#active').css('marginTop','12px');
			$('#active3').css('background','#e4e4e4');
			$('#active3').css('borderBottom','solid 1px #b1b1b1');
			$('#active3').css('height','58px');
			$('#active3').css('marginTop','12px');
			$('#active2').css('background','#fff');
			$('#active2').css('borderBottom','none');
			$('#active2').css('height','70px');
			$('#active2').css('marginTop','0px');
			dem =0;
		}
	}
	function nut3() {
		if (dem != 2) {
			$('#dutoan').css('display','none');
			$('.modulbox').css('display','none');
			$('#tiendotab1').css('display','none');
			$('#tiendodautu').css('display','none');
			$('#nhataitro').css('display','none');
			$('#danhgiakq').css('display','block');
			$('#dokhoduan').css('display','block');
			// active
			$('#active').css('background','#e4e4e4');
			$('#active').css('borderBottom','solid 1px #b1b1b1');
			$('#active').css('height','58px');
			$('#active').css('marginTop','12px');
			//active2
			$('#active2').css('background','#e4e4e4');
			$('#active2').css('borderBottom','solid 1px #b1b1b1');
			$('#active2').css('height','58px');
			$('#active2').css('marginTop','12px');
			//active3
			$('#active3').css('background','#fff');
			$('#active3').css('borderBottom','none');
			$('#active3').css('height','70px');
			$('#active3').css('marginTop','0px');
			dem =2;
		}
	}
	function nut2() {
		if(dem != 1){
			dem = 1;
			$('.modulbox').css('display','block');
			$('#dutoan').css('display','none');
			$('#tiendotab1').css('display','block');
			$('#tiendodautu').css('display','none');
			$('#dokhoduan').css('display','none');
			$('#nhataitro').css('display','none');
			$('#danhgiakq').css('display','none');
			$('#active2').css('background','#e4e4e4');
			$('#active2').css('borderBottom','solid 1px #b1b1b1');
			$('#active2').css('height','58px');
			$('#active2').css('marginTop','12px');
			$('#active3').css('background','#e4e4e4');
			$('#active3').css('borderBottom','solid 1px #b1b1b1');
			$('#active3').css('height','58px');
			$('#active3').css('marginTop','12px');
			$('#active').css('background','#fff');
			$('#active').css('borderBottom','none');
			$('#active').css('height','70px');
			$('#active').css('marginTop','0px');
		}
	}
	function editmoneyx() {
        ted = $('#sotien1').html();
        for (var i = 0; i < 10; i++) {
            ted = ted.replace(' ','');
        }
        $('#sotien1').html(ted.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        ted = $('#sotien2').html();
        for (var i = 0; i < 10; i++) {
            ted = ted.replace(' ','');
        }
        $('#sotien2').html(ted.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
        ted = $('#sotien3').html();
        for (var i = 0; i < 10; i++) {
            ted = ted.replace(' ','');
        }
        $('#sotien3').html(ted.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));
    }
    editmoneyx();
	function taitro() {
		$('#myModal').modal('show');
		if (demmodautu == 0) {
			demmodautu = 1;
			var getdata = '{{$id}}';
			$.ajax({
                url : "{{url('moddautu')}}",
                type : "GET",
                dataType:"text",
                data : { getdata },
                success : function (result){
					$('#hienthihoadon').html(result);
                }
            });
		}
	}
</script>
</html>