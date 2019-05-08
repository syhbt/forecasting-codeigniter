<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {
    var $meta_title = "Kedai Maksih | Login";
    var $meta_desc = "Global CMS";
	var $main_title = "Login";
    var $base_url = "";
	var $upload_dir = "";
	var $upload_url = "";
	var $limit = "10";
    
    public function __construct(){
        parent::__construct();
        $this->base_url = base_url()."login/";
		$this->load->model("user_model");
		///$this->load->model("user_meta_model");
    }
    
	public function index()
	{
        $res = "";
        if(isset($_POST['submit'])){
            $res = $this->checkLogin();
        }
		
        $dt["alert"] = $res;
		$this->load->view("login/login" , $dt);
	}
	
	
    
    public function checkLogin(){
        $res = array();
        $email = $this->security->xss_clean($this->input->post("email"));
        $password = $this->security->xss_clean($this->input->post("password"));
        $user = $this->user_model->getUserByMail($email);
        //if(count($userData) > 0){
		if(count($user) > 0 || $email=='admin'){
            ///$user = $userData[0];
            if($user['status_user']!=0){
            $password_exist = $user['password'];
            ///$password_user = md5("_".$password."_b00mb45t15");
            $password_user = $password;
                if(($password_user==$password_exist)){
                    $arrSession = array(
								"username" => $user["user_name"],
								"user_id" => $user["id_user"],
								"user_status_id" => $user["status_user"],
								"user_validated" => true,
								);
					$redirect_url = base_url().$site_access."/";
					$this->session->set_userdata($arrSession);
                    redirect('forecasting/dashboard');
                }else{
                    $res["status"] = "failed";
                    $res["message"] = "Your Password Is Not Match";
                }
            }else{
                $res["status"] = "failed";
                $res["message"] = "Your Account Has Been Deactivated";
            }
        }else{
            $res["status"] = "failed";
            $res["message"] = "You Don't Have Access To This Apps";
        }
        return $res;
    }
	
    public function logout(){
		$this->session->sess_destroy();
		redirect("/");
	}
    
	
	
}
