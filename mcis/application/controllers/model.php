<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');	
		$this->load->model('database_model');
		date_default_timezone_set('UTC');
	}
	
	public function index(){
		$records = $this->database_model->listModels();
		$this->load->view('view_inventory', array('models' =>$records));
	}
	
	public function get_latest_inventory_view(){
		$records = $this->database_model->listModels();
		$this->load->view('partial_view_inventory', array('models' =>$records));
	}
	
	public function add_form(){
		//$this->output->cache(100);		
		$records = $this->database_model->getAllManufacturers();
		$this->load->view('add_model', array('Records'=>$records));
	}
	
	public function get_model_suggestion(){
		$modelName = $this->input->get('ModelName');
		
		$record = $this->database_model->getModelSuggestion($modelName);		
		echo json_encode($record);
	}
	
	public function add_model(){		
		$manufacturerId = (integer)$this->input->post('Manufacturer');
		$name = $this->input->post('ModelName');
		$color = $this->input->post('ModelColor');
		$manufacturingYear = (integer)$this->input->post('ModelYear');
		$registrationNumber = $this->input->post('ModelRegistrationNo');
		$note = $this->input->post('ModelNote');
		$image1 = $_FILES['ModelUploadFile1']['name']; 
		$image2 = $_FILES['ModelUploadFile2']['name']; 
		
		$responseMsg = array();
		if(empty($manufacturerId) || empty($name) || empty($color) || empty($manufacturingYear) || empty($registrationNumber) || empty($note)  || empty($image1)  || empty($image2) ) {
			$responseMsg = array('Status'=>'FALSE', 'Message'=>'Please fill in the manditory fields and try again' );
		}
		else if(!is_int($manufacturerId)){
			$responseMsg = array('Status'=>'FALSE', 'Message'=>'Invalid Manufacturer, please change it try again' );
		}
		else if(!is_int($manufacturingYear)){
			$responseMsg = array('Status'=>'FALSE', 'Message'=>'Invalid manufacturing year, please change it try again' );
		}		
		else{
			$uniqueFolder = $manufacturerId.microtime(false);
			$uploadTempPath = dirname(dirname(dirname(__FILE__))) .'/resources/Model_Uploaded_Images/temp/'.$uniqueFolder;
			if (!mkdir($uploadTempPath, 0777, true)) {
				die('FALSE10');
			}
			$config = array();
			$config['upload_path']          = $uploadTempPath;
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 2048; // 2048 KB = 2 MB
			//$config['max_width']            = 1024;
			//$config['max_height']           = 768;

			$this->load->library('upload', $config);
			if ( $this->upload->do_upload('ModelUploadFile1'))
			{
				if ( $this->upload->do_upload('ModelUploadFile2'))
				{
					$insertedModelId = $this->database_model->saveModel($manufacturerId, $name, $color, $manufacturingYear, $registrationNumber, $note, $image1, $image2);
					if($insertedModelId!=0){
						$uploadPath = dirname(dirname(dirname(__FILE__))) .'/resources/Model_Uploaded_Images/'.$insertedModelId;
						if (!mkdir($uploadPath, 0777, true)) {
							$responseMsg = array('Status'=>'FALSE', 'Message'=>'Error occurred while saving the model data' );
						}
						else{
							chmod($uploadTempPath, 0755);
							rename($uploadTempPath.'/'.$image1, $uploadPath.'/'.$image1);
							rename($uploadTempPath.'/'.$image2, $uploadPath.'/'.$image2);
							
							rmdir($uploadTempPath);
							$responseMsg = array('Status'=>'TRUE', 'Message'=>'Model data saved successfully' );
						}
					}
					else{
						$responseMsg = array('Status'=>'FALSE', 'Message'=>'Unable to save model data' );
					}
				}
				else
				{
					$responseMsg = array('Status'=>'FALSE', 'Message'=>$this->upload->display_errors() );
				}
			}
			else
			{
				$responseMsg = array('Status'=>'FALSE', 'Message'=>$this->upload->display_errors() );
			}			
		}
		echo json_encode($responseMsg);	
	}
	
	
	public function get_model_details(){
		$modelName = $this->input->get('ModelName');
		$records = $this->database_model->getAllModelDetails($modelName);
		$this->load->view('model_details', array('models' =>$records));
	}
	
	public function sale_model(){
		$modelId = $this->input->get('ModelId');
		$response = $this->database_model->saleModel($modelId);
		if($response){
			echo 'TRUE';
		}
		else{
			echo 'FALSE';
		}
	}
	
	public function check_model_updates(){
		$updatedAt = $this->input->get('UpdatedAt');
		$response = $this->database_model->checkModelUpdates($updatedAt);
		$currentDatetime = date('Y-m-d H:i:s');
		$response1 = array('UpdatedAt'=>$currentDatetime, 'Data'=>$response);
		echo json_encode($response1);
	}	 
	 
	 
}
