<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_meta_model extends CI_Model {

	var $table = "usermeta";
	var $primary_key = "umeta_id";
    
    public function __construct(){
        parent::__construct();
        $this->db = $this->load->database("default" , TRUE);
    }
	public function saveData($arrData = array(),$debug=false , $insert_batch = false){
		
		if($debug){
			$retVal = $this->db->get_compiled_insert($this->table);
		}else{
			if($insert_batch){
				$res = $this->db->insert_batch($this->table , $arrData);	
			}else{
				$this->db->set($arrData);
				$res = $this->db->insert($this->table);	
			}
			
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
    
    public function deleteByUserID($id){
		$this->db->where("user_id" ,$id);
		$res = $this->db->delete($this->table);
		if(!$res){
			$retVal['error_stat'] = "Failed To Delete";
			$retVal['status'] = false;
		}else{
			$retVal['error_stat'] = "Success To Delete";
			$retVal['status'] = true;
		}
		return $retVal;
	}
	
	public function getUserMetaModel($id){
		$this->db->where("user_id" ,$id);
		$this->db->from($this->table);
		$ret = $this->db->get();
		if($ret){
			$res = $ret->result_array();
		}else{
			$res = false;	
		}
		return $res;
	}
	
	public function countMetaID($objectID = ""){
		$this->db->where("user_id" ,$objectID);
		$this->db->from($this->table);
		$ret = $this->db->count_all_results();
		return $ret;
	}
	
	
}

