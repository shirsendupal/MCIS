<?php
	$className = $this->router->fetch_class();
	$methodName = $this->router->fetch_method();
	
?>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	  <a class="navbar-brand" href="#" title="Mini Car Inventory System" >MCIS</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
		  <li class="nav-item <?php if($className=='model' && $methodName=='index'){ echo 'active';} ?>">
			<a class="nav-link" href="<?php echo base_url(); ?>">View Inventory</a>
		  </li>
		  <li class="nav-item <?php if($className=='Manufacturer' && $methodName=='add_form'){ echo 'active';} ?>">
			<a class="nav-link" href="<?php echo base_url(); ?>manufacturer/add_form">Add Manufacturer</a>
		  </li>
		  <li class="nav-item <?php if($className=='Model' && $methodName=='add_form'){ echo 'active';} ?>">
			<a class="nav-link" href="<?php echo base_url(); ?>model/add_form">Add Model</a>
		  </li>
	  </div>
	</nav>