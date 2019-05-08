<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forecasting extends MY_Controller {
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

	var $arrWeek = array(
		"1" => "1",
		"2" => "2",
		"3" => "3",
		"4" => "4",
		"5" => "5",
	);
	var $arrYear = array( "2014" => "2014",
						  "2015" => "2015",
						  "2016" => "2016",
						  "2017" => "2017",
						  );
	var $arrStatus = array( "1" => "Observasi",
						  "2" => "Forecast",
						  );
	
    public function __construct(){
        parent::__construct();
        $this->base_url = $this->base_url_site."user/";
		$this->load->model("forecasting_model");
    }

	public function dashboard(){
		$dt = array(
            "title" => $this->meta_title,
            "description" => $this->meta_desc,
			"container" => $this->_dashboard(),
			"custom_js" => array(
				ASSETS_URL."plugins/validate/jquery.validate_1.11.1.min.js",
				ASSETS_JS_URL."form/forecasting.js",
			),
		);	
		
		$this->_render("default",$dt);	
	}

	private function _dashboard(){
		$dt = array();
		$ret = $this->load->view("forecasting/dashboard" , $dt , true);
        return $ret;
	}
    
	public function index()
	{
		
		$dt = array(
            "title" => $this->meta_title,
            "description" => $this->meta_desc,
			"container" => $this->_home(),
			"custom_js" => array(
				ASSETS_URL."plugins/validate/jquery.validate_1.11.1.min.js",
				ASSETS_JS_URL."form/forecasting.js",
			),
		);	
		
		$this->_render("default",$dt);	
	}
	
	public function double_params()
	{
		
		$dt = array(
            "title" => $this->meta_title,
            "description" => $this->meta_desc,
			"container" => $this->_home(),
			"custom_js" => array(
				ASSETS_URL."plugins/validate/jquery.validate_1.11.1.min.js",
				ASSETS_JS_URL."form/forecasting.js",
			),
		);	
		
		$this->_render("default",$dt);	
	}
	
	private function _home(){
		$ret = "";
		$frmMonthList = form_dropdown("month_list" , $this->arrMonth , "" , "id='month_list' class='form-control'");
		$frmYearList = form_dropdown("year_list" , $this->arrYear , "" , "id='year_list' class='form-control'");
		//$frmPeriode = form_dropdown("periode_list" , $this->arrPeriode , "" , "id='periode_list' class='form-control' ");
		$frmPeriode = form_input("periode_list" , "" , 'class="form-control" id="periode_list"');
		$frmWeek = form_dropdown("week_list" , $this->arrWeek , "" , "id='periode_week' class='form-control' ");
		$dt = array(
			"frm_month_list"=> $frmMonthList,
			"frm_year_list"=> $frmYearList,
			"frm_type_list"=> $frmYearList,
			"frm_periode_list" => $frmPeriode,
			"frm_week_list" => $frmWeek,
		);
		$resTransaction = $this->forecasting_model->getAllDataTransaction();
		$Alfa = "";
		if(count($resTransaction) > 0){
			$Alfa = $resTransaction[0]['alfa'];
		}
		$dt["data_transaction"] = $resTransaction;
		$dt["arrMonth"]  = $this->arrMonth;
		$dt["alfaValue"]  = $Alfa;
		$ret = $this->load->view("forecasting/content" , $dt , true);
        return $ret;
	}
	
	public function clearData(){
		$resVal = $this->forecasting_model->truncateTable();
		if($resVal){
			$dt['status'] = 'success';
			$dt['msg'] = 'Data Berhasil Di Hapus';
		}else{
			$dt['status'] = 'failed';
			$dt['msg'] = 'Data Gagal Di Hapus';
		}
		echo json_encode($dt);
	}

	public function getFormSimpan(){

		$dt = array();
		$dt['frm_tanggal'] = form_input("tglData","" ,'class="form-control"  id="tglData"');
		$dt['frm_file'] = form_input("fileData","" ,'class="form-control" id="fileData"');
		$ret = $this->load->view("forecasting/save_form" , $dt);
        return $ret;
	}

	public function simpanHasilForecasting(){
		

		$forecasting_periode_string = $this->input->post("forecasting_periode_string");
		$forecasting_periode_value = $this->input->post("forecasting_periode_value");
		$forecasting_periode_urut = $this->input->post("forecasting_periode_urut");		
		$arrHasilForecasting = array(
			"tanggal_hasil" => $this->input->post("tglData"),
			"nama_hasil" => $this->input->post("fileData"),
			"status_hasil" => 1,
		);

		$retInsert = $this->forecasting_model->saveHasil($arrHasilForecasting);
		
		if($retInsert['status']){
			$idInsert = $retInsert['id'];
			$arrDetailForecasting = array();
			$forecasting_periode_string = $this->input->post("forecasting_periode_string");
			$index = 0;
			foreach($forecasting_periode_string as $row_string){
				$arrHasilForecasting = array(
					"id_hasil" => $idInsert,
					"periode_char" => $row_string,
					"hasil" => $forecasting_periode_value[$index],
					"periode_urutan" => $forecasting_periode_urut[$index],
				);
				$arrDetailForecasting[] = $arrHasilForecasting;
				$index++;
			}	
			$retInsertDetailHasil = $this->forecasting_model->saveHasilDetail($arrDetailForecasting);

			$arrInsertErrorHasil = array(
				"id_hasil" => $idInsert,
				"nilaiPerhitunganMADValue" => $this->input->post("nilaiPerhitunganMADValue"),
				"nilaiHasilMADValue" => $this->input->post("nilaiHasilMADValue"),
				"nilaiPerhitunganMSEValue" => $this->input->post("nilaiPerhitunganMSEValue"),
				"nilaiHasilMSEValue" => $this->input->post("nilaiHasilMSEValue"),
				"nilaiPerhitunganMAPEValue" => $this->input->post("nilaiPerhitunganMAPEValue"),
				"nilaiHasilMAPEValue" => $this->input->post("nilaiHasilMAPEValue"),
			);

			$retInsertError = $this->forecasting_model->saveHasilError($arrInsertErrorHasil);
		}

		$retVal = array();
		$retVal['status'] = $retInsert;
		$retVal['message'] = $retInsert==true ? "Data Berhasil Di SImpan" : "Data Gagal Di Simpan";
		echo json_encode($retVal);
	}
	
	public function processForecastingEksponential(){
		$nilaiAlfa = $this->input->post("nilai_alfa");
		$periode = $this->input->post("periode_list");
		
		$countTrans = $this->forecasting_model->getCountDataTransaction();
		if($countTrans < 1){
			$dt["status"] = "Failed";
			$dt["status_msg"] = "Failed No Data Can Count";
			exit();
		}
		
		$lastInputData = $this->forecasting_model->getLastDataTransaction();
		$dataLast = $lastInputData[0];
		$last_periode = $dataLast['periode'];
		$at = $dataLast['at_value'];
		$bt = $dataLast['bt_value'];
		
		$rowHtml = "";
		$resArray = array();
		$year = substr($last_periode,0,4); 
		$month = substr($last_periode,4,2); 
		$week = substr($last_periode,6,1);
		$number = 0;
		for($j = 1; $j <= $periode;$j++){
			
			///$periode_time = $last_periode + $j;
			//echo $periode_time;
			$number = $number + $j;
			$forecast = $at + $bt * $j;
			$modWeek = $week % 5;
			if($modWeek == 0){
				$month += 1;
				$week = 0;
				if(strlen($month) < 2){
					$month = "0".$month;
				}	
			}
			
			if($month>=13){
				$year = $year + 1;
				///$month = $month - $periode;
				$month = 1;
				if(strlen($month) < 2){
					$month = "0".$month;
				}
			}
			
			$week+=1;
            $monthString = $this->arrMonth[$month];
			
			$resArr = array();
			$resArr["month"] = $monthString." - ".$year;
			$resArr["forecast"] = $forecast;
			$resArray[] = $resArr;
			$valString = $year." - ".$monthString." (".$week.")"; 
			$rowHtml .= "<tr>".form_hidden("forecasting_periode_string[]" , $valString).
					form_hidden("forecasting_periode_value[]" , $forecast).
					form_hidden("forecasting_periode_urut[]" , $j).
					"<td>".$valString." </td>
                  <td>".$forecast."</td>
                  <td>".$j."</td>
                </tr>";	
		}
		$dt["ErrorMethod"] = $this->calculateMethodError();
		$dt['resVal'] = $resArray;
		$dt["status"] = "Success";
		$dt["status_msg"] = "Success For Forecasting";
		$dt["htmlVal"] = $rowHtml;
		echo json_encode($dt);
	}
	
	public function calculateMethodError(){
		
		$resDataTransaction = $this->forecasting_model->getAllDataTransaction();
		
		$deviderAngka = 0;
		$TotalAbsDeviasi = 0;
		$TotalPowDeviasi = 0;
		$TotalAbsSquareError = 0;
		foreach($resDataTransaction as $rowTrans){
			$forecasting = $rowTrans['forecasting'];
			$nilaiObservasi = $rowTrans['x_value'];
			if($forecasting > 0){
				$AbsDeviasi = abs($nilaiObservasi - $forecasting);
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
	
	public function saveValueForecasting(){
		
		$nilaiAlfa = $this->input->post("alfa");
		$nilaiObservasi = $this->input->post("nilai_observasi");
		$countTrans = $this->forecasting_model->getCountDataTransaction();
		$year = $this->input->post("year_list");
		$month = $this->input->post("month_list");
		$week = $this->input->post("week_list");
		$monthString = $this->arrMonth[$month];
		$periode = $year.$month.$week;
		$id_forecast = $this->input->post("id_forecast");
		$dt["x_value"] = $nilaiObservasi;
		$dt["periode"] = $periode;
		
		$nilaiA = 0;
		$nilaiAccent = 0;
		$nilaiAt = 0;
		$nilaiBt = 0;
		$nilaiForecast = 0;
			
		if($countTrans > 0){
			
			$checkPeriode = $this->forecasting_model->checkPeriode($periode);
			if($checkPeriode > 0){
				$dt["status"] = "Failed";
				$dt["status_msg"] = "Periode Sudah Ada";
				echo json_encode($dt);
				exit();
			}
			
			///$periodeSebelumnya = $periode==1 ? ($year - 1 . $month) : ($periode - 1);
			$periodeSebelumnya = "";
			if($week==1){
				$weekBefore = 5;
				$month = $month - 1;
				if(strlen($month) < 2){
					$month = "0".$month;
				}
				$periodeSebelumnya = $year . $month . $weekBefore;
			}else{
				$periodeSebelumnya = $periode - 1;
			}
			///echo $periodeSebelumnya;
			
			$dataPeriodePrev = $this->forecasting_model->getByPeriode($periodeSebelumnya); 
			if(empty($dataPeriodePrev) ){
				$dt["status"] = "Failed";
				$dt["status_msg"] = "Periode Tidak Urut";
				echo json_encode($dt);
				exit();
			}else{
				
			
			$dataPrev = $dataPeriodePrev[0];
			$nilaiObsBefore = $dataPrev['x_value'];
			$nilaiABefore = $dataPrev['a_value'];
			$nilaiAAccentBefore = $dataPrev['aa_value'];
			$nilaiAtBefore = $dataPrev['at_value'];
			$nilaiBtBefore = $dataPrev['bt_value'];
			
			$nilaiA = $nilaiAlfa * $nilaiObservasi + (1 - $nilaiAlfa) * $nilaiABefore; 
			$nilaiAccent = $nilaiAlfa * $nilaiA + (1 - $nilaiAlfa) * $nilaiAAccentBefore;
			$nilaiAt = 2 * $nilaiA  - $nilaiAccent;
			$nilaiBt = $nilaiAlfa / ($nilaiAlfa - 1) * ($nilaiA - $nilaiAccent);
			$nilaiForecast = $nilaiAtBefore + $nilaiBtBefore * 1;
			
			$rowHtml = "<tr>
                  <td>".$year." - ".$monthString." (".$week.")</td>
                  <td>".$nilaiObservasi."</td>
                  <td>".$nilaiA."</td>
                  <td>".$nilaiAccent."</td>
                  <td>".$nilaiAt."</td>
                  <td>".$nilaiBt."</td>
                  <td>".$nilaiForecast."</td>
                  <td>1</td>
                </tr>";
			
			}
			
		}else{
			//echo $nilaiObservasi."-".$nilaiAlfa;die;
			$nilaiA = ($nilaiAlfa * $nilaiObservasi) + (1 - $nilaiAlfa) * $nilaiObservasi;
			$nilaiAccent = $nilaiA;
			$nilaiAt = $nilaiA;
			
			$rowHtml = "<tr>
                  <td>".$year." - ".$monthString." (".$week.")</td>
                  <td>".$nilaiObservasi."</td>
                  <td>".$nilaiA."</td>
                  <td>".$nilaiAccent."</td>
                  <td>".$nilaiAt."</td>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                </tr>";
		}
		$dt["a_value"] = $nilaiA;
		$dt["aa_value"] = $nilaiAccent;
		$dt["at_value"] = $nilaiAt;
		$dt["bt_value"] = $nilaiBt;
		$dt["method"] = 1;
		$dt["forecasting"] = $nilaiForecast;
		$dt["status"] = 1;
		$dt["alfa"] = $nilaiAlfa;
		
		if(empty($id_forecast)){
			$resSave = $this->forecasting_model->saveData($dt);
			if($resSave['status']){
				$dt["status"] = "Berhasil";
				$dt["status_msg"] = "Berhasil menyimpan Peramalan";
			}else{
				$dt["status"] = "Gagal";
				$dt["status_msg"] = "Gagal menyimpan Peramalan";
			}
		}
		$dt['rowHtml'] = $rowHtml;
		echo json_encode($dt);
	}
	
	
}
