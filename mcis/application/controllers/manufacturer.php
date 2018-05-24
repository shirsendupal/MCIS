<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manufacturer extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		date_default_timezone_set('UTC');
	}
		
	public function add_form()
	{
		$this->load->view('add_manufacturer.php');
	}
	
	public function add()
	{
		$manufacturerName = $this->input->post('ManufacturerName');
		$this->load->model('database_model');
		$recordId = $this->database_model->checkManufacturerExist($manufacturerName);
		if(count($recordId)>0)
		{
			echo 'EXIST';
		}
		else
		{
			$recordId = $this->database_model->addManufacturer($manufacturerName);
			if($recordId!=0){
				echo 'TRUE';
			}
			else{
				echo 'FALSE';
			}			
		}
	}
}
