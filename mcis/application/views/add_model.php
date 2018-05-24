<?php 
	$this->view('templates/header');
	$this->view('templates/navigation');

	date_default_timezone_set('UTC'); 
?>
	<div class="container" style="margin-top:20px;">
		<h1>Add Model</h1>
		<br/>
		<label id="ModelViewUpdatedAt" style="display:none;" ><?php echo date('Y-m-d H:i:s');?></label>
		<label style="color:#ff0000;">* All the fields are manditory</label>
		<br/>
		<form id="ModelForm" action="" method="post">
			<div id="AlertSuccessSection" class="alert alert-success" role="alert" style="display:none;">			
			</div>
			<div id="AlertErrorSection" class="alert alert-danger" role="alert" style="display:none;">			
			</div>
			<div class="form-row">
				<div class="col-md-4 mb-3">
					<label for="ManufacturerName">Model Name</label>
					<input type="text" class="form-control" id="ModelName" maxlength="200" name="ModelName" placeholder="Enter Model Name" value="" autocomplete="off" required />
				</div>
				<div class="col-md-4 mb-3">
				  <label for="validationTooltip02">Manufacturer</label>
				  <select class="form-control" id="Manufacturer" name="Manufacturer">
					<option value="">Select Manufacturer</option>
					<?php foreach($Records as $manufacturer){ ?>
							<option value="<?php echo $manufacturer->id;?>"><?php echo $manufacturer->manufacturer_name;?></option>
					<?php } ?>
				  </select>
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-4 mb-3">
					<label for="ManufacturerName">Color</label>
					<input type="text" class="form-control" id="ModelColor" name="ModelColor" maxlength="30" placeholder="Enter Model Color" value="" autocomplete="off" required />
				</div>
				<div class="col-md-4 mb-3">
				  <label for="validationTooltip02">Year</label>
				  <select class="form-control" id="ModelYear" name="ModelYear">
					<option value="">Select</option>
					<?php $currentYear = date('Y');
						for($i=$currentYear-50; $i<=$currentYear; $i++){ ?>
							<option value="<?php echo $i;?>"><?php echo $i;?></option>
					<?php } ?>
				  </select>
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-4 mb-3">
					<label for="ManufacturerName">Registration No.</label>
					<input type="text" class="form-control" id="ModelRegistrationNo" name="ModelRegistrationNo" maxlength="30" placeholder="Enter Model Registration No." value="" autocomplete="off" required />
				</div>
				<div class="col-md-4 mb-3">
					<label for="validationTooltip02">Note</label>
					<input type="text" class="form-control" id="ModelNote" name="ModelNote" maxlength="200" placeholder="Enter Note" value="" autocomplete="off" required />
				</div>
			</div>		
			<div class="form-row">
				<div class="col-md-4 mb-3">
					<label for="ManufacturerName">Upload File 1 <label style="color:#ff0000;">(gif / jpg / png - Max. 2 MB)</label></label>
					<input type="file" class="form-control" id="ModelUploadFile1" name="ModelUploadFile1" placeholder="Enter Model Registration No." value="" autocomplete="off" required />
				</div>
				<div class="col-md-4 mb-3">
					<label for="validationTooltip02">Upload File 2  <label style="color:#ff0000;">(gif / jpg / png - Max. 2 MB)</label></label>
					<input type="file" class="form-control" id="ModelUploadFile2" name="ModelUploadFile2" placeholder="Enter Note" value="" autocomplete="off" required />
				</div>
			</div>							
			<button class="btn btn-primary" type="submit" >Submit</button>
			<button class="btn btn-secondary" onclick="clearModelForm()" >Clear</button>
			<img src="<?php echo base_url(); ?>resources/ajax-loader.gif" alt="Processing request..." id="AjaxLoaderImg" style="display:none;">
		</form>	
	</div>
	
<?php $this->view('templates/footer'); ?>
