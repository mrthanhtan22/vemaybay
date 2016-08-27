<div class="master-wrapper-page">
		<div class="wrapper-home-banner flight">
			<div class="container-fluid khoangcach" id="khoangcach">
		
			</div>
			<!---Form Search -->
		
			<div class="jumbotron text-center bg-search1" id="bg-search">
				 <form id="myForm" class="form-inline form-search" role="form" method="get" action="">
				 <!-- diem di -->
					<div class="form-group">
					    <div class="input-group">
					    	<div class="input-group-addon"><span class="fa fa-location-arrow" style="font-size:25px;color:#f4511e;"></span></div>
					    	<input type="text" class="form-control" id="inputDiemdi" placeholder="Điểm đi" data-toggle="modal" data-target="#noidi" style="height:50px" maxlength="5">
						</div>
					</div>
				<!--end diem di -->
					<span class="fa fa-plane"></span>
				<!-- diem den -->
					<div class="form-group">
					   
					    <div class="input-group">
					    	<div class="input-group-addon"><span class="fa fa-location-arrow" style="font-size:25px;color:#f4511e;"></span></div>
					    	<input type="text" class="form-control" id="inputDiemden" placeholder="Điểm đến" data-toggle="modal" data-target="#noiden" style="height:50px">
					    </div>
					</div>
				<!-- end diem den -->

					<div class="form-group">
						<div class="input-group">
				    		<div class="input-group-addon"><span class="fa fa-calendar" style="font-size:25px;color:#f4511e;"></span></div>
				    		<input type="text" name="ngaydi" id="inputNgaydi" class="form-control" placeholder="Ngày đi" required="required" title="" style="height:50px">
				    	</div>
					</div>

					<div class="form-group">
						<div class="input-group">
				    		<div class="input-group-addon"><span class="fa fa-calendar" style="font-size:25px;color:#f4511e;"></span></div>
				    		<input type="text" name="ngayve" id="inputNgayve" class="form-control" placeholder="Ngày về" required="required" title="" style="height:50px" readonly="readonly">
						  </div>
					</div>		
					<div class="form-group">
							
							<div class="input-group">
				    		<div class="input-group-addon"><span class="fa fa-group" style="font-size:25px;color:#f4511e;"></span></div>
				    		<input type="number" name="songuoi" id="inputSonguoi" class="form-control" placeholder="Số người" min="1" step="" required="required" title="songuoi" style="height:50px" data-toggle="modal" data-target="#soluong" >
				    		<input type="hidden" name="nguoilon" id="nguoilon" class="form-control" value="">
				    		<input type="hidden" name="treem" id="treem" class="form-control" value="">
				    		<input type="hidden" name="tresosinh" id="tresosinh" class="form-control" value="">
				    		
						  </div>
					
						
					</div>

					<!-- 1  chieu, khu hoi -->
					<div class="form-group">
						<div class="container">

							<div class="row">
								<div class="col-sm-12"><br>
								<div class="radio">
									<label class="radio-inline">
										<input type="radio" name="choosechieu" id="khuhoi" value="khuhoi" checked="checked">
										Khứ Hồi
									</label>
									<label class="radio-inline">
										<input type="radio" name="choosechieu" id="motchieu" value="motchieu" >
										Một Chiều
									</label>
									
								</div>	
								</div>
							</div>
						</div><br>
						<button type="submit" id="search" class="btn btn-primary btn-search">
						Tìm kiếm</button>
					</div>
					<!-- end khu hoi 1 chieu-->
					

						
						
					
				</form>
			</div>
		
		
		
		
		<div  class="modal fade" id="noidi" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header" style="background-color: #333">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Hãy chọn nơi đi</h4>
					</div>
					<div class="modal-body">
						<div class="container-fluid">
							<div class="row">
								<div class="col-sm-6">
									 <ul class="item-di" style="list-style-type:none;">
					                    <li class="title-footer">Miền Bắc</li>
					                    <li><a id="choose-noidi" href="javascript:;"><b>Hà Nội</b> (HAN)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Hải Phòng</b> (HPH)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Điện Biên</b> (DIN)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Thanh Hóa</b> (THD)</a></li>
					                </ul>
					                <ul class="item" style="list-style-type:none;">
					                    <li class="title-footer">Miền Trung</li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Vinh</b> (VII)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Huế</b> (HUI)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Đồng Hới</b> (VDH)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Đà Nẵng</b> (DAD)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Pleiku</b> (PXU)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Tuy Hòa</b> (TBB)</a></li>
					                </ul>
								</div>
								<div class="col-sm-6">
									 <ul class="item" style="list-style-type:none;margin-bottom: 20px">
					                    <li class="title-footer">Miền Nam</li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Hồ Chí Minh</b> (SGN)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Nha Trang</b> (CXR)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Đà Lạt</b> (DLI)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Phú Quốc</b> (PQC)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Tam Kỳ</b> (VCL)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Qui Nhơn</b> (UIH)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Cần Thơ</b> (VCA)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Côn Đảo</b> (VCS)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Ban Mê Thuột</b> (BMV)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Rạch Giá</b> (VKG)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Cà Mau</b> (CAH)</a></li>
					                </ul>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						
					</div>
				</div>
			</div>
		</div> <!-- end moldal noi di -->
		<div  class="modal fade" id="noiden" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header" style="background-color: #333">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Hãy chọn nơi đến</h4>
					</div>
					<div class="modal-body">
						<div class="container-fluid">
							<div class="row">
								<div class="col-sm-12">
									<div class="row">
										<div class="col-sm-6">
											<h3 class="title-footer"><strong>Sân bay quốc tế đến</strong></h3>
									
										</div>
										<div class="col-sm-6 pull-left">
											<input type="text" name="" id="modaldsanbay" class="form-control" value="" required="required" title="">
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									 <ul class="item" style="list-style-type:none;">
					                    <li class="title-footer">Miền Bắc</li>
					                    <li><a href="javascript:;"><b>Hà Nội</b> (HAN)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Hải Phòng</b> (HPH)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Điện Biên</b> (DIN)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Thanh Hóa</b> (THD)</a></li>
					                </ul>
					                <ul class="item" style="list-style-type:none;">
					                    <li class="title-footer">Miền Trung</li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Vinh</b> (VII)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Huế</b> (HUI)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Đồng Hới</b> (VDH)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Đà Nẵng</b> (DAD)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Pleiku</b> (PXU)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Tuy Hòa</b> (TBB)</a></li>
					                </ul>
								</div>
								<div class="col-sm-6">
									 <ul class="item" style="list-style-type:none;margin-bottom: 20px">
					                    <li class="title-footer">Miền Nam</li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Hồ Chí Minh</b> (SGN)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Nha Trang</b> (CXR)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Đà Lạt</b> (DLI)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Phú Quốc</b> (PQC)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Tam Kỳ</b> (VCL)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Qui Nhơn</b> (UIH)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Cần Thơ</b> (VCA)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Côn Đảo</b> (VCS)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Ban Mê Thuột</b> (BMV)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Rạch Giá</b> (VKG)</a></li>
					                    <li><a href="javascript:;" rel="nofollow"><b>Cà Mau</b> (CAH)</a></li>
					                </ul>

								</div>
								
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" id="" class="btn btn-primary" onclick="xong()">Xong</button>
					</div>
				</div>
			</div>
		</div> <!-- end modal noi den -->

		<div class="modal fade" id="soluong">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header" style="background-color: #333">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Số hành khách</h4>
					</div>
					<div class="modal-body">
						<form action="" method="POST" class="form-inline" role="form">
							<div class="form-group">
							<div class="row">
								<div class="col-sm-4">
								<b><h5>Người lớn(> 11t ) </h5></b>
								<div class="input-group">
									<div class="input-group-addon"></div>
									<input type="number" name="" id="inputNguoilon" class="form-control" value="1" min="1" max="" step="" required="required" title="" placeholder="Người lớn(>12t)">
								</div>
								</div>
								<div class="col-sm-4">
								<b><h5>Trẻ em(2t - 11t) </h5></b>
								<div class="input-group">
									<div class="input-group-addon"></div>
									<input type="number" name="" id="inputTreem" class="form-control" value="0" min="0" step="" required="required" title="" placeholder="Trẻ em (2-11t)">
								</div>
								</div>
								<div class="col-sm-4">
								<b><h5>Trẻ sơ sinh( < 2t) </h5></b>
								<div class="input-group">
									<div class="input-group-addon"></div>
									<input type="number" name="" id="inputTresosinh" class="form-control" value="0" min="0" step="" required="required" title="" placeholder="Trẻ sơ sinh(<2t)">
								</div>
								</div>
							</div>
							
							
							
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" onclick="hanhkhach()">Xong</button>
					</div>
				</div>
			</div>
		</div>
		
		
 			
	<!-- ket thuc form search -->

		</div>
		
	</div> 