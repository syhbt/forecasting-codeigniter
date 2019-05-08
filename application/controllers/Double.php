<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Double extends MY_Controller {
    var $meta_title = "Sistem Peramalan";
    var $meta_desc = "";
	var $main_title = "User";
    var $base_url = "";
	var $upload_dir = "";
	var $upload_url = "";
	var $limit = "10";
	var $arrMonth = array(
						  "01" => "Januari" ,
						  "02" => "Februari" ,
						  "03" => "Maret" ,
						  "04" => "April" ,
						  "05" => "Mei" ,
						  "06" => "Juni" ,
						  "07" => "Juli" ,
						  "08" => "Agustus" ,
						  "09" => "September" ,
						  "10" => "Oktober" ,
						  "11" => "November" ,
						  "12" => "Desember" ,
						  );
	var $arrPeriode = array(
						  "1" => "1" ,
						  "2" => "2" ,
						  "3" => "3" ,
						  "4" => "4" ,
						  "5" => "5" ,
						  "6" => "6" ,
						  "7" => "7" ,
						  "8" => "8" ,
						  "9" => "9" ,
						  "10" => "10" ,
						  "11" => "11" ,
						  "12" => "12" ,
						  );
	var $arrYear = array("2014" => "2014",
						  "2015" => "2015",
						  "2016" => "2016",
						  );
	
	
    public function __construct(){
        parent::__construct();
        $this->base_url = $this->base_url_site."user/";
		$this->load->model("forecasting_model");
		$this->load->model("forecasting_model_double");
    }
    
	public function index()
	{
		
		$dt = array(
            "title" => $this->meta_title,
            "description" => $this->meta_desc,
			"container" => $this->_double_params(),
			"custom_js" => array(
				ASSETS_JS_URL."form/double.js",
			),
		);	
		
		$this->_render("default",$dt);	
	}
	
	private function _double_params(){
		$ret = "";
		$frmMonthList = form_dropdown("month_list" , $this->arrMonth , "" , "id='month_list' class='form-control'");
		$frmYearList = form_dropdown("year_list" , $this->arrYear , "" , "id='year_list' class='form-control'");
		$frmPeriode = form_dropdown("periode_list" , $this->arrPeriode , "" , "id='periode_list' class='form-control' ");
		$dt = array(
			"frm_month_list"=> $frmMonthList,
			"frm_year_list"=> $frmYearList,
			"frm_periode_list" => $frmPeriode
		);
		$resTransaction = $this->forecasting_model_double->getAllDataTransaction();
		$alfa = "";
		$beta = "";
		if(!empty($resTransaction)){
			$alfa = $resTransaction[0]['alfa'];
			$beta = $resTransaction[0]['beta'];
		}
		$dt["data_transaction"] = $this->forecasting_model_double->getAllDataTransaction();
		$dt["arrMonth"]  = $this->arrMonth;
		$dt["alfaValue"] = $alfa;
		$dt["betaValue"] = $beta;
		$ret = $this->load->view("forecasting/content_2" , $dt , true);
        return $ret;
	}
	
	public function clearData(){
		$resVal = $this->forecasting_model_double->truncateTable();
		if($resVal){
			$dt['status'] = 'success';
			$dt['msg'] = 'Data Berhasil Di Hapus';
		}else{
			$dt['status'] = 'failed';
			$dt['msg'] = 'Data Gagal Di Hapus';
		}
		$rowHtml = "<tr>
                  <th>Periode</th>
                  <th>Penjualan Produk</th>
                  <th>At</th>
                  <th>T</th>
                  <th>Forecasting</th>
                  <th>P</th>
                </tr>";
		$dt['html'] = $rowHtml;
		echo json_encode($dt);
	}
	
	public function processForecastingEksponentialDouble(){
		$nilaiAlfa = $this->input->post("nilai_alfa");
		$nilaiBeta = $this->input->post("nilai_alfa");
		$periode = $this->input->post("periode_list");
		
		$countTrans = $this->forecasting_model_double->getCountDataTransaction();
		if($countTrans < 1){
			$dt["status"] = "Failed";
			$dt["status_msg"] = "Failed No Data Can Count";
			exit();
		}
		
		$lastInputData = $this->forecasting_model_double->getLastDataTransaction();
		$dataLast = $lastInputData[0];
		$last_periode = $dataLast['periode'];
		$nilaiObsPrev = $dataLast['x_value'];
		$nilaiAPrev = $dataLast['at_value'];
		$nilaiTPrev = $dataLast['t_value'];
		$nilaiForecastPrev = $dataLast['forecasting'];
		
		$rowHtml = "<tr>
                  <td>Periode</td>
                  <td>Forecasting</td>
                  <td>P</td>
                </tr>";
		$resArray = array();
		for($j = 1; $j <= $periode;$j++){
			
			$periode_time = $last_periode + $j;
			$forecast = $nilaiAPrev + $nilaiTPrev * $j;
			$year = substr($periode_time,0,4);
			$month = substr($periode_time,4,2);
			if($month>=13){
				$year = $year + 1;
				$month = $month - $periode;
				if(strlen($month) < 2){
					$month = "0".$month;
				}
			}
			
            $monthString = $this->arrMonth[$month];
			$resArr = array();
			$resArr["month"] = $monthString." - ".$year;
			$resArr["forecast"] = $forecast;
			$resArray[] = $resArr;
			$rowHtml .= "<tr>
                  <td>".$monthString." - ".$year."</td>
                  <td>".$forecast."</td>
                  <td>".$j."</td>
                </tr>";	
		}
		$dt['resVal'] = $resArray;
		$dt["status"] = "Success";
		$dt["status_msg"] = "Success For Forecasting";
		$dt["htmlVal"] = $rowHtml;
		$dt["ErrorMethod"] = $this->calculateMethodError();
		echo json_encode($dt);
	}
	
	public function saveValueForecastingDouble(){
		
		
		$nilaiAlfa = $this->input->post("alfa");
		$nilaiBeta = $this->input->post("beta");
		$nilaiObservasi = $this->input->post("nilai_observasi");
		$countTrans = $this->forecasting_model_double->getCountDataTransaction();
		$year = $this->input->post("year_list");
		$month = $this->input->post("month_list");
		$monthString = $this->arrMonth[$month];
		$periode = $year.$month;
		$id_forecast = $this->input->post("id_forecast");
		$dt["x_value"] = $nilaiObservasi;
		$dt["periode"] = $periode;
		$nilaiA = 0;
		$nilaiT = 0;
		$nilaiForecast = 0;
		
		if($countTrans > 0){
			
			$checkPeriode = $this->forecasting_model_double->checkPeriode($periode);
			if($checkPeriode > 0){
				$dt["status"] = "Failed";
				$dt["status_msg"] = "Periode Sudah Ada";
				echo json_encode($dt);
				exit();
			}
			
			$periodeSebelumnya = $periode==1 ? ($year - 1 . $month) : ($periode - 1);
			$dataPeriodePrev = $this->forecasting_model_double->getByPeriode($periodeSebelumnya);
			if(empty($dataPeriodePrev) ){
				$dt["status"] = "Failed";
				$dt["status_msg"] = "Periode Tidak Urut";
				echo json_encode($dt);
				exit();
			}else{

			$dataPrev = $dataPeriodePrev[0];
			$nilaiObsPrev = $dataPrev['x_value'];
			$nilaiAPrev = $dataPrev['at_value'];
			$nilaiTPrev = $dataPrev['t_value'];
			$nilaiForecastPrev = $dataPrev['forecasting'];

			if($countTrans==1){
				$idTransaction = $dataPrev['id_transaction'];
				$nilaiTPrev = $nilaiObservasi - $nilaiObsPrev;
				$du["t_value"] = $nilaiTPrev;
				$resUpdate = $this->forecasting_model_double->updateDetail($du , $idTransaction);
			}
				$nilaiA = $nilaiAlfa * $nilaiObservasi + (1 - $nilaiAlfa) * ($nilaiAPrev + $nilaiTPrev);
				$nilaiT = $nilaiBeta * ($nilaiA - $nilaiAPrev) + (1 - $nilaiBeta) * $nilaiTPrev;
				$nilaiForecast = $nilaiAPrev + $nilaiTPrev * 1;
			}
			
		}else{
			//echo $nilaiObservasi."-".$nilaiAlfa;die;
			$nilaiA = ($nilaiAlfa * $nilaiObservasi) + (1 - $nilaiAlfa) * $nilaiObservasi;
			$nilaiT = 0;
		}
		
		$dt["at_value"] = $nilaiA;
		$dt["t_value"] = $nilaiT;
		$dt["forecasting"] = $nilaiForecast;
		$dt["status"] = 1;
		$dt["alfa"] = $nilaiAlfa;
		$dt["beta"] = $nilaiBeta;
		
		if(empty($id_forecast)){
			$resSave = $this->forecasting_model_double->saveData($dt);
			if($resSave['status']){
				$dt["status"] = "Success";
				$dt["status_msg"] = "Success To Insert Peramalan";
			}else{
				$dt["status"] = "Failed";
				$dt["status_msg"] = "Failed To Insert Peramalan";
			}
		}
		
		$resAll = $this->forecasting_model_double->getAllDataTransaction();
		$rowHtml = "<tr>
                  <th>Periode</th>
                  <th>Penjualan Produk</th>
                  <th>At</th>
                  <th>T</th>
                  <th>Forecasting</th>
                  <th>P</th>
                </tr>";
		foreach($resAll as $rowTrans) {
		$periode = $rowTrans['periode'];
		$year = substr($periode,0,4);
		$month = substr($periode,4,2);
		$monthString = $this->arrMonth[$month];
		$rowHtml .= "<tr>
			  <td>".$monthString." - ".$year."</td>
			  <td>".$rowTrans['x_value']."</td>
			  <td>".$rowTrans['at_value']."</td>
			  <td>".$rowTrans['t_value']."</td>
			  <td>".$rowTrans['forecasting']."</td>
			  <td>1</td>
			</tr>";	
		}
		
		$dt['rowHtml'] = $rowHtml;
		echo json_encode($dt);
	}
	
	public function calculateMethodError(){
		
		$resDataTransaction = $this->forecasting_model_double->getAllDataTransaction();
		
		$deviderAngka = 0;
		$TotalAbsDeviasi = 0;
		$TotalPowDeviasi = 0;
		$TotalAbsSquareError = 0;
		foreach($resDataTransaction as $rowTrans){
			$forecasting = $rowTrans['forecasting'];
			$nilaiObservasi = $rowTrans['x_value'];
			if($forecasting > 0){
			
			$AbsDeviasi = abs($nilaiObservasi - $forecasting);
			//echo $AbsDeviasi;die;
			$PowAbsDeviasi = pow($AbsDeviasi , 2);
			$AbsSquareError = $AbsDeviasi / $nilaiObservasi * 100;	
			$TotalAbsDeviasi += $AbsDeviasi;
			$TotalPowDeviasi += $PowAbsDeviasi;
			$TotalAbsSquareError += $AbsSquareError;
			$deviderAngka += 1;
			}
		}
		
		$resVal["SumAbsDeviasi"] = $TotalAbsDeviasi;
		$resVal["SumPowDeviasi"] = $TotalPowDeviasi;
		$resVal["SumAbsSquareError"] = $TotalAbsSquareError;
		$resVal["Devider"] = $deviderAngka;
		
		$resVal['MAD_value'] = number_format(($TotalAbsDeviasi / $deviderAngka) , 2);
		$resVal['MSE_value'] = number_format(($TotalPowDeviasi / $deviderAngka) , 2);
		$resVal['MAPE_value'] = number_format(($TotalAbsSquareError / $deviderAngka) , 2);
		return $resVal;
	}
	
}
