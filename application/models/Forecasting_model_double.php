<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forecasting_model_double extends CI_Model {

	var $table = "transaction_double";
	var $primary_key = "id_transaction";
    
    public function __construct(){
        parent::__construct();
        
    }
	
    
    public function getAllDataTransaction(){
        $this->db->from($this->table);
        $data = $this->db->get();
        return $data->result_array();
    }
    
    public function getLastDataTransaction(){
        $this->db->where("status" , "1");
        $this->db->limit(1);
        $this->db->order_by($this->table.".periode DESC");
        $this->db->from($this->table);
        $data = $this->db->get();
        return $data->result_array();
    }
    
    public function getCountDataTransaction(){
        $this->db->where("status" , "1");
        $this->db->from($this->table);
        $data = $this->db->count_all_results();
        return $data;
    }
    
    public function checkPeriode($periode){
        $this->db->where("periode" , $periode);
        $this->db->from($this->table);
        $data = $this->db->count_all_results();
        return $data;
    }
    
    public function getByPeriode($periode){
        $this->db->where("periode" , $periode);
        
        $query = $this->db->get($this->table,1);
        $resVal = $query->result_array();	
        return $resVal;
    }
	
	public function getDetail($id){
		$this->db->where($this->primary_key , $id);
		$query = $this->db->get($this->table,1);
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
	
	public function truncateTable(){
		$this->db->from($this->table);
		$q = $this->db->truncate();
		return $q;
	}
	
	public function delete($id){
		$this->db->where($this->primary_key , $id);
		$q = $this->db->delete($this->table);
		
		if(!$q){
			$retVal['error_stat'] = "Failed To Delete";
			$retVal['status'] = false;
		}else{
			$retVal['error_stat'] = "Success To Delete";
			$retVal['status'] = true;
		}
		return $retVal;
	}
	
	
}

