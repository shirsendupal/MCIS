<?php 	date_default_timezone_set('UTC'); ?>
Updated At: <label id="ModelViewUpdatedAt" ><?php echo date('Y-m-d H:i:s');?></label> UTC
<input type="hidden" id="ModelViewUpdatedAt" value="<?php echo date('Y-m-d H:i:s');?>" />
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
			  <td><?php echo $m->manufacturer_name; ?></td>
			  <td><?php echo $m->model_name; ?></td>
			  <td><?php echo $m->model_count; ?></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
<?php }else{ ?>
	<h4>No records available</h4>
<?php } ?>

