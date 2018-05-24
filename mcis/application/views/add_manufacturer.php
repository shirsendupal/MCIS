<?php 
	$this->view('templates/header');
	$this->view('templates/navigation');

	date_default_timezone_set('UTC'); 
?>	
	<div class="container" style="margin-top:20px;">
		<h1>Add Manufacturer</h1>
		<br/>
		<label id="ModelViewUpdatedAt" style="display:none;" ><?php echo date('Y-m-d H:i:s');?></label>
		<label style="color:#ff0000;">* All the fields are manditory</label>
		<br/>
		<div id="AlertSuccessSection" class="alert alert-success" role="alert" style="display:none;">			
			<strong>Yeah!</strong> Manufacturer added successfully
		</div>
		<div id="AlertErrorSection" class="alert alert-danger" role="alert" style="display:none;">			
			<strong>Oops!</strong> Unable to add Manufacturer
		</div>
		<div id="AlertError2Section" class="alert alert-danger" role="alert" style="display:none;">			
			<strong>Oops!</strong> Manufacturer already exist, please change it and try again
		</div>
		
		<div class="form-row">
			<div class="col-md-4 mb-3">
				<label for="ManufacturerName">Manufacturer name</label>
				<input type="text" class="form-control" id="ManufacturerName" placeholder="Enter Manufacturer name" value="" autocomplete="off" required>
			</div>
		</div>
		<button class="btn btn-primary" onclick="addManufacturer()" >Submit</button>
		<button class="btn btn-secondary" onclick="clearManufacturerForm()" >Clear</button>
		<img src="<?php echo base_url(); ?>resources/ajax-loader.gif" alt="Processing request..." id="AjaxLoaderImg" style="display:none;">
	</div>
	
<?php $this->view('templates/footer'); ?>