<?php

class database_model extends CI_Model{
	
	function __construct(){
		parent::__construct();	
		date_default_timezone_set('UTC');		
		$config['hostname'] = 'localhost';
		$config['username'] = 'root';
		$config['password'] = '';
		$config['database'] = 'mcis';
		$config['dbdriver'] = 'mysqli';
		$config['dbprefix'] = '';
		$config['pconnect'] = TRUE;
		$config['db_debug'] = FALSE;
		$config['cache_on'] = FALSE;
		$config['cachedir'] = '';
		$config['char_set'] = 'utf8';
		$config['dbcollat'] = 'utf8_general_ci';
		$config['swap_pre'] = '';
		$config['autoinit'] = TRUE;
		$config['stricton'] = FALSE;
		$this->load->database($config);
	}
	
	public function checkManufacturerExist($manufacturerName){
		$this->db->select('id');
		$query = $this->db->get_where('manufacturer', array('manufacturer_name'=> $manufacturerName)); 
		return $query->result();
	}
	
	function addManufacturer($manufacturerName){	
		$data = array(
					'manufacturer_name' => $manufacturerName, 
					'created_on' => date('Y-m-d H:i:s')
				);
		$this->db->insert('manufacturer', $data);
		return $this->db->insert_id();
    }

	function getAllManufacturers(){
		$this->db->select('id, manufacturer_name');
		$query = $this->db->get('manufacturer');
		return $query->result();
	}
	
	public function getModelSuggestion($modelName){
		$this->db->select('manufacturer_fid as id, model_name as value');
		$this->db->like('model_name',$modelName);
		$query = $this->db->get('models');
		return $query->result();
	}
	
	public function saveModel($manufacturerId, $name, $color, $manufacturingYear, $registrationNumber, $note, $image1, $image2){
		$currentDatetime = date('Y-m-d H:i:s');
		$data = array(
		   'manufacturer_fid' => $manufacturerId,
		   'model_name' => $name,
		   'model_color' => $color,
		   'manufacturing_year' => $manufacturingYear,
		   'registration_number' => $registrationNumber,
		   'note' => $note,
		   'image1' => $image1,
		   'image2' => $image2,
		   'is_available' => 1,
		   'created_at' => $currentDatetime,
		   'updated_at' => $currentDatetime		   
		);

		$this->db->insert('models', $data); 
		$insertedModelId = $this->db->insert_id();
		return $insertedModelId;		
	}
		
	public function listModels(){
		$this->db->select('manufacturer.manufacturer_name, models.id, model_name, count(model_name) as model_count');
		$this->db->join('manufacturer', 'manufacturer.id = models.manufacturer_fid', 'left');
		$this->db->group_by("model_name"); 
		$query = $this->db->get_where('models', array('is_available' => 1));
		return $query->result();		
	}
	
	public function getAllModelDetails($modelName){
		$this->db->select('manufacturer.manufacturer_name, models.id, model_name, model_color, manufacturing_year, registration_number, note, image1, image2');
		$this->db->join('manufacturer', 'manufacturer.id = models.manufacturer_fid', 'left');
		$query = $this->db->get_where('models', array('models.is_available' => 1, 'models.model_name' => $modelName));
		return $query->result();	
	}
		
	public function saleModel($modelId){
		$this->db->where('id', $modelId);
		$this->db->update('models', array('is_available' => 0, 'updated_at' => date('Y-m-d H:i:s'))); 
		return true;
	}
	
	public function checkModelUpdates($updatedAt){
		$this->db->select('id, model_name');
		$query = $this->db->get_where('models', array('is_available' => 0, 'updated_at >'=> $updatedAt)); 
		return $query->result();
	}
	
}

?>