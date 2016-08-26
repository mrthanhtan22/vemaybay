<h2><strong>VÉ MÁY BAY KHUYẾN MÃI</strong></h2>
<b class="pull-right"><a href="">Xem tất cả</a></b><br>
<div class="col-md-12 bxslider1">
		
		<div class="row bg bxslide">
		<?php foreach($tdeal_list->$row): ?>
			<div class="col-sm-4 pull-left">
				<p><span class="fa fa-paper-plane-o" style="font-size:25px;color:#f4511e;"></span></p>
				<p class="diemdi"><strong><?php $row->name ?></strong></p>
				<p><i>Đểm đi</i></p>
				
			</div>
			<div class="col-sm-2 text-center">
				<p class="muiten"><img src="<?php echo public_url()?>/images/muiten.gif"></p>
			</div>
			<div class="col-sm-4">
				<p><span class="fa fa-paper-plane-o" style="font-size:25px;color:#f4511e;"></span></p>
				<p class="diemden"><strong>Phu Quoc</strong></p>
				<p><i>Điểm đến</i></p>
			</div>
			<div class="col-sm-2 pull-right">
				<img src="<?php echo public_url()?>/images/vietjet.gif">
				<p class="pice"><strong>1.890.000đ</strong></p>
			</div>
		<?php endforeach; ?>
		</div>
		

	</div>
