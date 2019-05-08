<?php 

class Hasil extends MY_Controller {

    var $meta_title = "Sistem Peramalan | Hasil";
    var $meta_desc = "";
	var $main_title = "User";
    var $base_url = "";
	var $upload_dir = "";
	var $upload_url = "";
	var $limit = "10";   


    public function __construct(){
        parent::__construct();
        $this->base_url = $this->base_url_site."hasil/";
		$this->load->model("forecasting_model");
    }


    public function index(){
        $dt = array(
            "title" => $this->meta_title,
            "description" => $this->meta_desc,
			"container" => $this->_build_hasil(),
			"custom_js" => array(
				ASSETS_URL."plugins/validate/jquery.validate_1.11.1.min.js",
				ASSETS_JS_URL."form/hasil.js",
			),
		);	
		
		$this->_render("default",$dt);	
    }

    public function _build_hasil(){
        $dt = array();
		$ret = $this->load->view("hasil/content" , $dt , true);
        return $ret;
    }

    public function cetakHasil($id_hasil){
        $dt = array(
            "title" => $this->meta_title,
            "description" => $this->meta_desc,
			"container" => $this->_build_cetak($id_hasil),
			"custom_js" => array(
				ASSETS_URL."plugins/validate/jquery.validate_1.11.1.min.js",
				ASSETS_JS_URL."form/hasil.js",
			),
		);	
        $this->_render("default",$dt);	
    }

    public function _build_cetak($id_hasil){
        $dt = array();
        $detailPeramalan = $this->forecasting_model->getDetailPeramalan($id_hasil);
        $detailHasilPeramalan = $this->forecasting_model->getDetailHasil($id_hasil);
        $detailHasilError = $this->forecasting_model->getDetailError($id_hasil);
        $dt['detailPeramalan'] = $detailPeramalan;
        $dt['detailHasilPeramalan'] = $detailHasilPeramalan;
        $dt['detailHasilError'] = $detailHasilError;
		$ret = $this->load->view("hasil/cetak" , $dt , true);
        return $ret;
    }

    public function getDataHasil(){
        $retVal['data'] = array();   
        $start_date = $this->input->post("start_date");
        $end_date = $this->input->post("end_date");
        $resDataForecasting = $this->forecasting_model->getDataHasil($start_date , $end_date);
        if(!empty($resDataForecasting)){
            $number = 1;
            foreach($resDataForecasting as $rowForecast){
                $txtHasil = "";
                $detailHasil = $this->forecasting_model->getDetailHasil($rowForecast['id_hasil']);
                foreach($detailHasil as $rowHasil){
                    $txtHasil .= $rowHasil['periode_char']." = " . $rowHasil['hasil'] . '<br/>';
                }

                $btnHapus = form_button("btnHapus" , "Hapus" ,'class="btn btn-danger" onclick="hapusData('.$rowForecast['id_hasil'].')" id="btnHapus"');
                $btnCetak = anchor($this->base_url . "cetakHasil/" . $rowHasil['id_hasil'] , "Cetak" , 'class="btn btn-warning" target="_blank"');
                $retVal['data'][] = array(
                    $number,
                    indonesian_date($rowForecast['tanggal_hasil']),
                    $rowForecast['nama_hasil'],
                    $txtHasil,
                    $btnHapus.$btnCetak,
                );
                $number++;
            }
        }
        echo json_encode($retVal);
    }

    public function hapusData($id_hasil){

        $resData = $this->forecasting_model->hapus_hasil($id_hasil);
        echo json_encode($resData);
    }
}