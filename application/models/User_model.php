<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	var $table = "user";
	var $primary_key = "ID";
    
    public function __construct(){
        parent::__construct();
        $this->db = $this->load->database("default" , TRUE);
    }
    
    public function getDataIndex($offset = 0 , $limit = 10, $search = "" , $main_site = ""){
		
		if(!empty($search)){
			$this->db->like('name', $search);
		}
		
		
        $this->db->select($this->table.'.* ');
		$this->db->from($this->table);
		$this->db->limit($limit);
		$this->db->offset($offset);
		///$this->db->order_by($this->table.".user_login ASC");
        $data = $this->db->get();
        return $data->result();
    }
	
	public function getUserByMail($key){
		$this->db->like("user_name" , $key);
		$this->db->from($this->table);
		$this->db->limit(1);
		$data = $this->db->get();
        return $data->row_array();
	}
	
	public function getCountDataIndex($search=""){
		if(!empty($search)){
			$this->db->like('user_login', $search);
		}
		$this->db->select($this->table.'.* ');
		$this->db->from($this->table);
		$data = $this->db->count_all_results();
		return $data;
	}
	
	public function getDetailUser($id){
		$this->db->where($this->primary_key , $id);
		$query = $this->db->get($this->table, 1);
		$resVal = "";
		if($query->num_rows() > 0){
			$resVal = $query->result_array();	
		}else{
			$resVal = false;
		}
		return $resVal;
	}
	
	public function saveData($arrData = array(),$debug=false){
		
		$this->db->set($arrData);
		if($debug){
			$retVal = $this->db->get_compiled_insert($this->table);
		}else{
			$res = $this->db->insert($this->table);
			if(!$res){
				$retVal['error_stat'] = "Failed To Insert";
				$retVal['status'] = false;
			}else{
				$retVal['error_stat'] = "Success To Insert";
				$retVal['status'] = true;
				$retVal['id'] = $this->db->insert_id();
			}
			
		}
		return $retVal;
	}
	
	public function updateDetail($array , $id){
		
		$this->db->where($this->primary_key , $id);
		$query = $this->db->update($this->table, $array);
		if(!$query){
			
			$retVal['error_stat'] = "Failed To Insert";
			$retVal['status'] = false;
		}else{
			$retVal['error_stat'] = "Success To Update";
			$retVal['status'] = true;
			$retVal['id'] = $id;
		}
		
		return $retVal;
	}
	
	
}

