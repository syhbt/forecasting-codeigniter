<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forecasting_model extends CI_Model {

	var $table = "transaction";
	var $primary_key = "id_transaction";
    
    public function __construct(){
        parent::__construct();
        
    }
	
	public function deleteDataTransaction(){
		
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
    
    public function getByPeriode($periode , $method = 1){
        $this->db->where("periode" , $periode);
        $this->db->where("method" , $method);
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

	public function saveHasil($arrData){
		$ret = $this->db->insert("forecasting_hasil" , $arrData);
		$retVal = array();
		if($ret){
			$retVal['status'] = true;
			$retVal['id'] = $this->db->insert_id();
		}else{
			$retVal['status'] = false;
			$retVal['id'] = "";
		}
		return $retVal;
	}

	public function saveHasilDetail($arrInsert){

		$ret = $this->db->insert_batch("forecasting_hasil_detail" , $arrInsert);
		if($ret){
			$retVal['status'] = true;
		}else{
			$retVal['status'] = false;			
		}
		return $retVal;
	}

	public function saveHasilError($arrData){
		$ret = $this->db->insert("forecasting_hasil_error" , $arrData);
		$retVal = array();
		if($ret){
			$retVal['status'] = true;
			$retVal['id'] = $this->db->insert_id();
		}else{
			$retVal['status'] = false;
			$retVal['id'] = "";
		}
		return $retVal;
	}

	public function getDataHasil($dtStart , $dtEnd){
		$dtStart .= " 00:00:00";
		$dtEnd .= " 23:59:59";
		$this->db->where("tanggal_hasil BETWEEN '".$dtStart."' AND '".$dtEnd."'");
		$ret = $this->db->get("forecasting_hasil");
		return $ret->result_array();
	}

	public function getDetailPeramalan($id_hasil){
		$this->db->where("id_hasil" , $id_hasil);
		$ret = $this->db->get("forecasting_hasil");
		return $ret->row_array();
	}

	public function getDetailHasil($id_hasil){
		$this->db->where("id_hasil" , $id_hasil);
		$this->db->order_by("periode_urutan ASC");
		$ret = $this->db->get("forecasting_hasil_detail");
		return $ret->result_array();
	}

	public function getDetailError($id_hasil){
		$this->db->where("id_hasil" , $id_hasil);
		$ret = $this->db->get("forecasting_hasil_error");
		return $ret->row_array();
	}

	public function hapus_hasil($id_hasil){
		$this->db->where("id_hasil" , $id_hasil);
		$ret = $this->db->delete("forecasting_hasil");
		$retVal['status'] = $ret;
		$retVal['message'] = $ret==true ? "Data Berhasil Di Hapus" : "Data Gagal Di Hapus";
		return $retVal;
	}
	
	
}

