<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	var $id_user = "1";
	var $user_level = array("1"=>"Super Adminstrator" , "2" => "Adminstrator CMS",
								"3" => "Editor" , "0"=> "OFF");
	var $site_active = "greencore";
	var $base_url_site = "";
	var $user_logged_level = "";
	var $cms_title = "";
	var $cms_active_config = array();
	function __construct(){
		parent::__construct();
		$this->load->library("breadcrumbs");
		/// Set Site Uri
	}
	
	public function _render($template,$cnf = array()){
		$this->_checkValidateUser();
		$template = (isset($cnf['template'])) ? $cnf['template'] : 'template/default';
		
        //loop for css custom file
        $css_script = '';
        if (isset($cnf['custom_css']) && is_array($cnf['custom_css']))
        {
            foreach ($cnf['custom_css'] as $val)
            {
                $css_script .= "<link rel=\"stylesheet\" href=\"" . $val . "\" />\n\t";
            }
        }
        else
        {
            $css_script = isset($cnf['custom_css']) ? isset($cnf['custom_css']) : '';
        }
        //end loop
        //loop for js custom file
        $js_script = '';
        if (isset($cnf['custom_js']) && is_array($cnf['custom_js']))
        {
            foreach ($cnf['custom_js'] as $val)
            {
                $js_script .= "<script type=\"text/javascript\" src=\"" . $val . "\"></script>\n\t\t";
            }
        }
        else
        {
            $js_script = isset($cnf['custom_js']) ? isset($cnf['custom_js']) : '';
        }
        //end loop
        
        $meta_refresh = '1800';
        if(isset($cnf['meta_refresh'])){
            $meta_refresh = '<meta http-equiv="Refresh" content="'.$cnf['meta_refresh'].'" />';
        }

        $subCat = (isset($cnf['sub_categori'])) ? $cnf['sub_categori'] : '';
		
		/// Get Template Setting
		$setting_cms = $this->config->item("site_property");
		$default_set = $setting_cms[$this->site_active];
		
        $color_template = $default_set['theme_color'];
		$site_name = $default_set['cms_name'];
		
		$this->cms_title = $site_name;
		
		$theme_default = "skin-".$color_template;
        // set expire
        $my_time = time();
        $expired_header = gmdate('D, d M Y H:i:s', $my_time + 120) . " GMT";
		
		$company = 'Technobit.co.id';
        $dt = array(
            'meta_title' => isset($cnf['title']) ? $cnf['title'] : $site_name,
            'description' => isset($cnf['description']) ? $cnf['description'] : '',
            'keywords' => isset($cnf['keywords']) ? $cnf['keywords'] : '',
            'url' => isset($cnf['url']) ? $cnf['url'] : '',
            'og_image' => isset($cnf['og_image']) ? $cnf['og_image'] : '',
            'meta_refresh' => $meta_refresh,
            'expires' => '',
			'header_title' => (isset($cnf['header'])) ? $cnf['header'] : '', 
            'custom_css' => $css_script,
			'assets_css_url' => ASSETS_CSS_URL,
			'assets_js_url' => ASSETS_JS_URL,
			'assets_image_url' => ASSETS_IMAGE_URL,
			'theme' => $theme_default,
            'custom_js' => $js_script,
			'base_url_admin' => $this->base_url_site,
            'main_content' => (isset($cnf['container'])) ? $cnf['container'] : '',
			"head_navbar" => $this->_get_header_nav(),
			"side_navbar" => $this->_get_sidebar_nav(),
			"main_footer" => $this->_get_footer(),
        );
		$this->load->view($template,$dt);
	}
	
	private function _get_header_nav(){		
		$menu["username"] = $this->session->userdata("username");
		$menu["link_logout"] = base_url()."login/logout/";
		$ret = $this->load->view("template/navbar/header_nav" , $menu , true);
		return $ret;
	}
	
	private function _get_sidebar_nav(){
		$menu["sidebar_nav"] = array("user" =>
									array("class" => "glyphicon glyphicon-user",
										  "desc" => "User",
										  "main_url" => $this->base_url_site."user/",
										  "sub_menu" => ""
										  ),
									"post" =>
									array("class" => "glyphicon glyphicon-list-alt",
										  "desc" => "Post",
										  "main_url" => $this->base_url_site."post/",
										  "sub_menu" => "post_sub"
										  ),
									"media" =>
									array("class" => "glyphicon glyphicon-picture",
										  "desc" => "Media",
										  "main_url" => $this->base_url_site."media/",
										  "sub_menu" => "media_sub"
										  ),
									"page" =>
									array("class" => "glyphicon glyphicon-file",
										  "desc" => "Page",
										  "main_url" => $this->base_url_site."page/",
										  "sub_menu" => ""
										  ),
									"gallery" =>
									array("class" => "glyphicon glyphicon-film",
										  "desc" => "Gallery",
										  "main_url" => $this->base_url_site."gallery/",
										  "sub_menu" => "gallery_sub"
										  ),
									"tags" =>
									array("class" => "glyphicon glyphicon-tags",
										  "desc" => "Tags",
										  "main_url" => $this->base_url_site."tags/",
										  "sub_menu" => ""
										  ),
									"category" =>
									array("class" => "glyphicon glyphicon-th-large",
										  "desc" => "Category",
										  "main_url" => $this->base_url_site."category/",
										  "sub_menu" => ""
										  ),
									"author" =>
									array("class" => "glyphicon glyphicon-sunglasses",
										  "desc" => "Author",
										  "main_url" => $this->base_url_site."author/",
										  "sub_menu" => ""
										  ),
									"trending" =>
									array("class" => "glyphicon glyphicon-flash",
										  "desc" => "Trending",
										  "main_url" => $this->base_url_site."trending/",
										  "sub_menu" => "trend_sub"
										  ),
									);
		
		$menu["submenu_side"] = array("post_sub" => array(
										"post_insert" => array(
											"class" => "glyphicon glyphicon-pencil",
											"url" => "insert/",
											"desc" => "Add New Post",
										 ),
										"post_list" => array(
											"class" => "glyphicon glyphicon-list",
											"url" => "",
											"desc" => "Post List",
										 ),
									), "media_sub" => array(
										"media_insert" => array(
											"class" => "glyphicon glyphicon-plus",
											"url" => "insert/",
											"desc" => "Add New Media",
										 ),
										"post_list" => array(
											"class" => "glyphicon glyphicon-book",
											"url" => "",
											"desc" => "Media Library",
										 ),
										
									),
									"gallery_sub" => array(
										"gallery_image" => array(
											"class" => "glyphicon glyphicon-camera",
											"url" => "image/",
											"desc" => "Images",
										 ),
										"gallery_video" => array(
											"class" => "glyphicon glyphicon-facetime-video",
											"url" => "video/",
											"desc" => "Video",
										 )
									),
									  "trend_sub" => array(
										"trend_news" => array(
											"class" => "glyphicon glyphicon-plus",
											"url" => "post/",
											"desc" => "Trend Posts",
										 ),
										"trend_tags" => array(
											"class" => "glyphicon glyphicon-book",
											"url" => "tags/",
											"desc" => "Trend Tags",
										 )),
									"setting_sub" => array(
										"trend_news" => array(
											"class" => "glyphicon glyphicon-plus",
											"url" => "cache/",
											"desc" => "Clear Cache",
										 ),
										)
								);
		
		
		if($this->user_logged_level=='Editor'){
			unset($menu["sidebar_nav"]['user']);
		}
		$menu["site_active"] = $this->site_active;
		$site_property =  $this->config->item('site_property');
		$arr_access = array();
		$arr_site = $this->session->userdata("user_site_access");
		
		$menu["site_sidebar"] = $arr_access;
		$ret = $this->load->view("template/navbar/side_nav" , $menu , true);
		return $ret;
	}
	
	private function _get_footer(){
		$dt = array();
		$ret = $this->load->view("template/footer" , $dt , true);
		return $ret;
	}
	
	public function _get_template_table(){
		$template = array(
				'table_open'            => '<table class="table table-hover table-stripped">',
				'thead_open'            => '<thead>',
				'thead_close'           => '</thead>',
				'heading_row_start'     => '<tr>',
				'heading_row_end'       => '</tr>',
				'heading_cell_start'    => '<th>',
				'heading_cell_end'      => '</th>',
				'tbody_open'            => '<tbody>',
				'tbody_close'           => '</tbody>',
				'row_start'             => '<tr>',
				'row_end'               => '</tr>',
				'cell_start'            => '<td>',
				'cell_end'              => '</td>',
				'row_alt_start'         => '<tr>',
				'row_alt_end'           => '</tr>',
				'cell_alt_start'        => '<td>',
				'cell_alt_end'          => '</td>',
				'table_close'           => '</table>'
		);
	
		return $template;
	}
	
	public function _build_pagination($base_url = "",$total =100, $per_page = 10, $query_string=TRUE,$url_string="&search="){
		
		$config_pagination['base_url'] = $base_url;
		$config_pagination['total_rows'] = $total;
		$config_pagination['per_page'] = $per_page;
		
		$config_pagination['page_query_string'] = $query_string;
		$config_pagination['query_string_segment'] = 'page';
		$config_pagination['suffix'] = $url_string;
		$config_pagination['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
		$config_pagination['full_tag_close'] = '</ul>';
		
		$config_pagination['next_tag_open'] = '<li>';
		$config_pagination['next_tag_close'] = '</li>';
		
		
		$config_pagination['use_page_numbers'] = TRUE;
		//$config_pagination['prefix'] = 'search';
		
		$config_pagination['prev_tag_open'] = '<li>';
		$config_pagination['prev_tag_close'] = '</li>';	
		
		$config_pagination['cur_tag_open'] = '<li class="active"><a href="#">';
		$config_pagination['cur_tag_close'] = '</li></a>';
		$config_pagination['num_tag_open'] = '<li>';
		$config_pagination['num_tag_close'] = '</li>';
		$config_pagination['first_tag_open'] = '';
		$config_pagination['first_link'] = '';
		$config_pagination['last_link'] = '';
		
		
		$this->pagination->initialize($config_pagination);
		$ret = $this->pagination->create_links();
		return $ret;
	}
	
	public function setBreadcrumbs($arrBreadcrumbs = array()){
		$res = "";
		foreach($arrBreadcrumbs as $label=>$url){
			$this->breadcrumbs->add($label , $url);
		}
		$res = $this->breadcrumbs->output();
		return $res;
	}
	
	public function _checkValidateUser(){
		$base_url = base_url();
		$login = base_url()."login/";
		///$arr_site = $this->session->userdata("user_site_access");
		if(!isset($_SESSION["user_validated"])){
			redirect($login);
		}
		
	}
}
