<?php 
	$this->view('templates/header');
	$this->view('templates/navigation');

	date_default_timezone_set('UTC'); 
?>
	<div class="container" style="margin-top:20px;">
		<h1>View Inventory</h1>
		<br/>
		<div id="InventoryViewSection">
			Updated At: <label id="ModelViewUpdatedAt" ><?php echo date('Y-m-d H:i:s');?></label> UTC
			<?php if(count($models)>0){ ?>
				<table class="table table-hover">
				  <thead>
					<tr>
					  <th scope="col">Sr. No.</th>
					  <th scope="col">Manufacturer</th>
					  <th scope="col">Model</th>
					  <th scope="col">Count</th>
					</tr>
				  </thead>
				  <tbody>
					<?php $i=1; foreach($models as $m){ ?>
						<tr  data-toggle="modal" onclick="showModelDetails('<?php echo $m->model_name; ?>')" title="Click to view the details" style="cursor:pointer;">
						  <th scope="row"><?php echo $i++; ?></th>
						  <td><?php echo htmlentities($m->manufacturer_name); ?></td>
						  <td><?php echo htmlentities($m->model_name); ?></td>
						  <td><?php echo $m->model_count; ?></td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			<?php }else{ ?>
				<h4>No records available</h4>
			<?php } ?>
		</div>
	</div>
		
	<div class="modal fade" id="ModelDetailsPopupSection" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Modal Details</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<div class="card-group" id="ModelDetailsSection">
			</div>
		  </div>
		</div>
	  </div>
	</div>
		
<?php $this->view('templates/footer'); ?>