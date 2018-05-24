<?php foreach($models as $m){ ?>
	<div class="card" style="width: 18rem; margin-right:10px;" id="ModelDetailSection_<?php echo $m->id; ?>">
		<div class="row">
			<div class="col">
			  <img class="card-img-top" src="<?php echo base_url(); ?>resources/Model_Uploaded_Images/<?php echo $m->id.'/'.$m->image1; ?>" alt="<?php echo $m->image1; ?>" style="width:100%;">
			</div>
			<div class="col">
			  <img class="card-img-top" src="<?php echo base_url(); ?>resources/Model_Uploaded_Images/<?php echo $m->id.'/'.$m->image2; ?>" alt="<?php echo $m->image2; ?>" style="width:100%;">
			</div>
		</div>
	  
	  <div class="card-body">
		<h5 class="card-title"><?php echo $m->manufacturer_name.' - '.$m->model_name; ?></h5>
		<p class="card-text">
			<small class="text-muted">Name:</small> <?php echo $m->model_name; ?><br/>
			<small class="text-muted">Manufacturer:</small> <?php echo $m->manufacturer_name; ?><br/>
			<small class="text-muted">Color:</small> <?php echo $m->model_color; ?><br/>
			<small class="text-muted">Year:</small> <?php echo $m->manufacturing_year; ?><br/>
			<small class="text-muted">Registration No.:</small> <?php echo $m->registration_number; ?><br/>
			<small class="text-muted">Note:</small> <?php echo $m->note; ?>
		</p>
		<a href="#" class="btn btn-primary btn-lg btn-block" id="ModelDetailSoldBtn_<?php echo $m->id; ?>" onclick="saleModel('<?php echo $m->id; ?>')">SOLD</a>
	  </div>
	</div>
<?php } ?>	
	
	