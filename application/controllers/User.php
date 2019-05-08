<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
    var $meta_title = "Sistem Peramalan | Admin";
    var $meta_desc = "Global CMS";
	var $main_title = "User";
    var $base_url = "";
	var $upload_dir = "";
	var $upload_url = "";
	var $limit = "10";
	var $arr_level_user = array("1"=>"Aktif" , "0"=> "Tidak Aktif");
    public function __construct(){
        parent::__construct();
        $this->base_url = base_url()."user/";
		$this->load->model("user_model");
		$this->load->model("user_meta_model");
		$this->load->library("upload");
		if($this->user_logged_level=="Editor"){
			redirect($this->base_url_site);
		}
    }
    
	public function index()
	{
		$dt = array(
            "title" => $this->meta_title,
            "description" => $this->meta_desc,
			"container" => $this->_home(),
			"custom_js" => array(
				ASSETS_JS_URL."form/user.js",
			),
		);	
		
		$this->_render("default",$dt);	
	}
	
	public function insert($id="" , $mode="edit")
	{
		$dt = array(
            "title" => $this->meta_title,
            "description" => $this->meta_desc,
			"container" => $this->edit($id , $mode),
			"custom_js" => array(
				ASSETS_PLUGIN_URL."validate/jquery.validate-add.js",
				ASSETS_PLUGIN_URL."validate/jquery.validate_1.11.1.min.js",
				ASSETS_JS_URL."form/user.js",
			),
		);	
		
		$this->_render("default",$dt);	
	}
	
	public function checkpass($user_id){
		$pass_input = $this->input->post("user_password_old");
		$dataUser = $this->user_model->getDetailUser($user_id);
		$pass_old = $dataUser[0]['user_pass'];
		$password = md5("_".$pass_input."_b00mb45t15");
		
		if($password==$pass_old){
			$ret = "true";
			echo json_encode($ret);
		}else{
			$ret = "Password Not Same";
			echo json_encode($ret);
			exit;
		}
	}
	
	public function updatepass(){
		$id = $this->input->post("user_id");
		$pass_input = $this->input->post("user_password");
		$password = md5("_".$pass_input."_b00mb45t15");
		$arrInsert = array(
						"user_pass" => $password,
					);
		
		$res = $this->user_model->updateDetail($arrInsert , $id);
		if($res['status']){
			$return = array("status" => "success",
						"message" => "Berhasil menyimpan admin $name.");
		}else{
			$return = array("status" => "failed",
						"message" => "Gagal menyimpan admin $name.");
		}
		
		$this->session->set_flashdata("alert_user" , $return);
		$edit_link = $this->base_url."edit/".$id;
		redirect($edit_link);
	}
	
	
	public function save()
	{
		if(!isset($_POST['user_id'])){
			redirect($this->base_url);
		}
		
		if(!empty($_POST['user_id'])){
			$mode = "update";
		}else{
			$mode = "insert";
		}
		
		$res = $this->_saveData($mode , $this->input->post('user_id'));
		$dt = array(
            "title" => $this->meta_title,
            "description" => $this->meta_desc,
			"container" => $this->_home($res),
			"custom_js" => array(
				ASSETS_JS_URL."form/user.js",
			),
		);
		$this->_render("default",$dt);	
	}
	
	public function edit($user_id , $mode_form="edit"){
		$dt = array();
		if(!empty($user_id)){
			$dataUser = $this->user_model->getDetailUser($user_id);
			$arrayInput = array("user_id" ,
							"user_nicename" ,
							"user_email" ,
							"user_login" ,
							"user_password" ,
							"user_thumbuser" ,
							"user_status" ,
							"user_site" ,
							);
			$dataUser = $dataUser[0];
			$dataMeta = $this->user_meta_model->getUserMetaModel($user_id);
			$arrMeta = array();
			foreach($dataMeta as $row){
				$arrMeta[$row['meta_key']] = $row['meta_value'];
			}
			$arrLevelUser = $this->arr_level_user;
			
			$filesUrl = ASSETS_UPLOAD_URL."user/thumb/";
			$name = $dataUser['user_nicename'];
			$level = $arrLevelUser[$dataUser['user_status']];
			$foto = isset($arrMeta['thumb_image']) && !empty($arrMeta['thumb_image']) ? $arrMeta['thumb_image'] : "";
			
			if(!empty($foto)){
				$namefoto = getNameFile($foto);
				$fotoUrl = $filesUrl.$namefoto."-128x128.jpg";
			}else{
				$fotoUrl = "";
			}
			$mail = $dataUser['user_email'];
			$arrDataPost = array(
								"user_id" =>$dataUser['ID'],
								"user_nicename" =>$dataUser['user_nicename'],
								"user_email" =>$dataUser['user_email'],
								"user_login" =>$dataUser['user_login'],
								"user_status" => $dataUser['user_status'],
								"user_thumbuser" => isset($arrMeta['thumb_image']) && !empty($arrMeta['thumb_image']) ? $arrMeta['thumb_image'] : "",
								"user_site" => isset($arrMeta["site_access"]) && !empty($arrMeta['site_access']) ? $arrMeta['site_access'] : "",
								"user_description" => isset($arrMeta["user_description"]) && !empty($arrMeta['user_description']) ? $arrMeta['user_description'] : "",
								);
			$mode = "update";
			
		}else{
			$arrDataPost = array();
			$mode = "insert";
			$name = "(Fill Your Name)";
			$level = "Administrator";
			$fotoUrl = "http://placehold.it/128x128";
			$mail = "(Fill Your Email)";
		}
		
		$arrBreadcrumbs = array(
								"Home" => base_url(),
								"User" => $this->base_url,
								"Insert" => "#",
								);
		
		$arrDataForm = array(
							 "arr_data_post" => $arrDataPost
							 );	
		$dt["breadcrumbs"] = $this->setBreadcrumbs($arrBreadcrumbs);
		$dt["title"] = $this->main_title;
		$dt["name"] = $name;
		$dt["level"] = $level;
		$dt["foto_url"] = $fotoUrl;
		$dt["mail"] = $mail;
		
		$form = $mode_form=="edit" ? $this->_get_form($arrDataForm , $mode) : $this->_get_form_pass($user_id);
		$dt["form_insert"] = $form;
		$ret = $this->load->view("user/insert",$dt , true);
		return $ret;
	}
    
    private function _home($alert = ''){
		$page = isset($_REQUEST["page"]) ? $_REQUEST["page"] : 1;
		$search = isset($_REQUEST["search"]) ? $_REQUEST["search"] : "";
		$start = ($page - 1) * $this->limit;
		$data = $this->user_model->getDataIndex($start , $this->limit, $search , $this->site_active);
		$countTotal = $this->user_model->getCountDataIndex($search);
		
		$arrBreadcrumbs = array(
								"Home" => base_url(),
								"User" => $this->base_url,
								"List" => "#",
								);
		$dt["breadcrumbs"] = $this->setBreadcrumbs($arrBreadcrumbs);
		$dt["title"] = $this->main_title;
		$dt["data"] = $data;
		$dt["alert"] = $alert;
		$dt["insert_link"] = $this->base_url."insert/";
		$dt["base_url"] = $this->base_url;
		$dt["pagination"] = $this->_build_pagination($this->base_url,$countTotal ,$this->limit ,true , "&search=".$search);
		$ret = $this->load->view("user/content",$dt,true);
        return $ret;
	}
	
	private function _get_form_pass($user_id){
		$dt['form_user_id'] = form_hidden(
									  array(
											"user_id" => $user_id,
											)
									  );
		$dt['form_user_pass_old'] = form_password(
									  array(
											"name"=>"user_password_old",
											"id"=>"user_password_old",
											"placeholder" => "Old Password",
											"class" => "form-control",
											"value" => "",
											)
									  );
		
		$dt['form_user_pass'] = form_password(
									  array(
											"name"=>"user_password",
											"id"=>"user_password",
											"placeholder" => "New Password",
											"class" => "form-control",
											"value" => "",
											)
									  );
		
		$dt['form_user_pass2'] = form_password(
									  array(
											"name"=>"user_password2",
											"id"=>"user_password2",
											"placeholder" => "Re-Enter New Password",
											"class" => "form-control",
											"value" => "",
											)
									  );
		$dt['form_post_url'] = $this->base_url."update_password/";
		$ret = $this->load->view("user/form_pass",$dt , true);
		return $ret;
	
	}
	
	private function _get_form($arrData , $mode="insert"){
		$arrayInput = array("user_id" ,
							"user_nicename" ,
							"user_email" ,
							"user_login" ,
							"user_password" ,
							"user_thumbuser" ,
							"user_status" ,
							"user_site" ,
							"user_description" ,
							);
		
		$arrDataPost = $arrData['arr_data_post'];
		
		foreach($arrayInput as $val){
			$$val = isset($arrDataPost[$val]) ? $arrDataPost[$val] : "";
		}
		
		$dt['form_user_id'] = form_hidden(
									  array(
											"user_id" => $user_id,
											"thumb_user" => $user_thumbuser
											)
									  );
		$dt['form_user_name'] = form_input(
									  array(
											"name"=>"user_nicename",
											"id"=>"user_nicename",
											"placeholder" => "Name",
											"class" => "form-control",
											"value" => $user_nicename,
											)
									  );
		
		$dt['form_user_email'] = form_input(
									  array(
											"name"=>"user_email",
											"id"=>"user_email",
											"placeholder" => "Email",
											"class" => "form-control",
											"value" => $user_email,
											)
									  );
		
		$dt['form_user_description'] = form_textarea(
									  array(
											"name"=>"user_description",
											"id"=>"user_description",
											"placeholder" => "Description",
											"class" => "form-control",
											"value" => $user_description,
											)
									  );
		
		$dt['form_user_login'] = form_input(
									  array(
											"name"=>"user_login",
											"id"=>"user_login",
											"placeholder" => "Username",
											"class" => "form-control",
											"value" => $user_login,
											)
									  );
		
		$dt['form_user_pass'] = form_password(
									  array(
											"name"=>"user_password",
											"id"=>"user_password",
											"placeholder" => "Password",
											"class" => "form-control",
											"value" => $user_password,
											)
									  );
		
		$dt['form_user_pass2'] = form_password(
									  array(
											"name"=>"user_password2",
											"id"=>"user_password2",
											"placeholder" => "Re-Enter Password",
											"class" => "form-control",
											"value" => "",
											)
									  );
		
		if($mode=='update'){ 
			$dt['form_user_pass'] = "";
			$dt['form_user_pass2'] = "";
		}
		
		$dt['form_upload_thumb'] = form_upload(
														 array(
															"name" => "thumb_user",
															"id"=>"thumb_user",
															"style" => "display:none;"
														 ));
		$arrLevelUser = $this->arr_level_user;
		$arrUsersite = explode(",",$user_site);
		$user_site = $this->config->item("site_property");
		
		$dt["form_user_site1"] = form_checkbox("privilege[]","greencore",in_array("greencore" , $arrUsersite));
		$dt["form_user_site2"] = form_checkbox("privilege[]","danangda",in_array("danangda" , $arrUsersite));
		
		$dt['form_user_level'] = form_dropdown("user_level",
											   $arrLevelUser,
											   $user_status,"id='user_level' class='form-control'");;
		
		$dt['url_change_password'] = $this->base_url."edit/".$user_id."/change_password/";
		$dt['form_post_url'] = $this->base_url."save/";
		$ret = $this->load->view("user/form",$dt , true);
		return $ret;
	}
	

	public function _saveData($mode , $id=""){
		
			if($mode=="update"){
				//Update Mode
				$pass_input = $this->input->post("user_password");
				$password = md5("_".$pass_input."_b00mb45t15");
				$name = $this->input->post("user_login");
				$siteAccess = implode(",",$_POST['privilege']);
				$arrInsert = array(
								"user_name" => $this->input->post("user_login"),
								"password" => $this->input->post("user_password"),
								"status_user" => $this->input->post("user_level"),
							);
				$res = $this->user_model->updateDetail($arrInsert , $id);
				if($res['status']){
					$return = array("status" => "success",
								"message" => "Success to update User $name.");
				}else{
					$return = array("status" => "failed",
								"message" => "Failed to update User $name.");
				}
			}else{
				//Insert Mode
				$pass_input = $this->input->post("user_password");
				$password = md5("_".$pass_input."_b00mb45t15");
				$name = $this->input->post("user_login");
				$arrInsert = array(
								"user_name" => $this->input->post("user_login"),
								"password" => $this->input->post("user_password"),
								"status_user" => $this->input->post("user_level"),
							);
				$res = $this->user_model->saveData($arrInsert);
				/// Input Menu, And Display Picture
				
				if($res['status']){
					$return = array("status" => "success",
								"message" => "Success to insert User $name.");
				}else{
					$return = array("status" => "failed",
								"message" => "Failed to insert User $name.");
				}
			}
			
			return $return;
	}
	
	
}
