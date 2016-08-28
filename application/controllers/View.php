<?php 
	/**
	* 
	*/
	class View extends MY_Controller
	{
		
			 function __construct()
		{
			parent::__construct();
			$this->load->model('news_model');
		}
		function index(){
			$id = $this->uri->segment(3);
			$info = $this->news_model->get_info($id);
			$this->data['info'] = $info;
			
			$this->data['temp'] = 'site/view/index';
			$this->load->view('site/view/layout', $this->data);
		}
	}
	
 ?>