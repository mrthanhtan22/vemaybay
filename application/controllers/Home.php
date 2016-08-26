<?php 
	class Home extends CI_Controller
	{
		
		public function index()
		{
			$data = array();
			$data['temp'] = 'site/home/index';
			$this->load->view('site/layout',$data);

			/* lay ve khuyen mai*/

			$this->load->model('tdeal_model');
			$tdeal_list = $this->tdeal_model->get_list();
			$this->data['tdeal_list'] = $tdeal_list;
		}
	}
 ?>