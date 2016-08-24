<?php 
	/**
	 * summary
	 */
	class Product extends MY_Controller
	{
	   public function __construct()
	   {
	   		parent::__construct();
	   		$this->load->model('product_model');
	   }

	   function index(){

	   		
	    	$total = $this->product_model->get_total();
	    	$this->data['total'] = $total;

	    	//load thu vien phan trang
	    	$this->load->library('pagination');
	    	$config = array();
	    	$config['base_url'] = admin_url('product/index');
	    	$config['total_rows'] = $total;
	    	$config['per_page'] = 5;
	    	$config['uri_segment'] = 4;
	    	$config['next_link']   = "Trang ke tiep";
			$config['prev_link']   = "Trang truoc";
	    	
	    	$this->pagination->initialize($config);
	    	
	    	/*end phan trang*/

	    	/*load trang*/
	    	$segment = $this->uri->segment(4);
	    	$segment = intval($segment);

	    	$input = array();
	    	$input['limit'] = array($config['per_page'],$segment);

	    	/*loc theo id*/
            $id = $this->input->get('id');
            $id = intval($id);
            $input['where'] = array();
            if ($id > 0) {

                $input['where']['id'] = $id;
            }
            
	    	/*loc theo ten*/
	    	$name = $this->input->get('name');
	    	if ($name) {
	    		$input['like'] = array('name',$name);
	    	}


	    	/*loc theo danh muc*/
	    	$catalog_id = $this->input->get('catalog');
	    	$catalog_id = intval($catalog_id);
	    	
	    	if ($catalog_id > 0) {
	    		$input['where']['catalog_id'] = $catalog_id;
	    	}
	    	/* end loc */

	    	$list = $this->product_model->get_list($input);
	    	$this->data['list'] = $list;
	    	/* end load phan trang*/


	    	/*lay danh muc san pham*/
	    	$this->load->model('catalog_model');
	    	$input = array();
	    	$input['where'] = array('parent_id'=> 0);
	    	$catalogs = $this->catalog_model->get_list($input);
	    	foreach ($catalogs as $row) {
	    	
	    		$input['where'] = array('parent_id'=> $row->id);
	    		$subs = $this->catalog_model->get_list($input);
	    		$row->subs = $subs;
	    	}
	    	$this->data['catalogs'] = $catalogs;
	    	/*end lay danh muc*/

            $message = $this->session->flashdata('message');
            $this->data['message'] = $message;

	   		$this->data['temp'] = 'admin/product/index';
	   		$this->load->view('admin/main', $this->data);
	  }



	  function add(){
	  	
	  		/*lay danh muc san pham*/
	    	$this->load->model('catalog_model');
	    	$input = array();
	    	$input['where'] = array('parent_id'=> 0);
	    	$catalogs = $this->catalog_model->get_list($input);
	    	foreach ($catalogs as $row) {
	    	
	    		$input['where'] = array('parent_id'=> $row->id);
	    		$subs = $this->catalog_model->get_list($input);
	    		$row->subs = $subs;
	    	}
	    	$this->data['catalogs'] = $catalogs;
	    	/*end lay danh muc*/

            $message = $this->session->flashdata('message');
            $this->data['message'] = $message;

            $this->load->library('form_validation');
       	 	$this->load->helper('form');
        
        	//neu ma co du lieu post len thi kiem tra
        	if($this->input->post())
        	{
         	$this->form_validation->set_rules('name', 'Tên', 'required');
         	$this->form_validation->set_rules('price', 'Gia', 'required');
         	$this->form_validation->set_rules('discount', 'Gia Giam', 'required');
   
            //nhập liệu chính xác
            if($this->form_validation->run())
            {
                //them vao csdl
                $name     = $this->input->post('name');
                $price = $this->input->post('price');
                $price = str_replace(',', '', $price);
                $discount = $this->input->post('discount');
                $discount = str_replace(',', '', $discount);
                /*up hinh anh*/
                $this->load->library('upload_library');
                $upload_path = './upload/product';
                $upload_data = $this->upload_library->upload($upload_path, );

                $image_link = '';


                $data = array(
                    'name'         => $name,
                    'price'        => $price,
                    'discount'     => $discount,
                    'warranty'     => $this->input->post('warranty'),
                    'gifts'    	   => $this->input->post('gitfs'),
                    'meta_desc'    => $this->input->post('meta_desc'),
                    'meta_key'     => $this->input->post('meta_key'),
                    'site_title'   => $this->input->post('site_title'),
                    'content'	   => $this->input->post('content')
                );


                if($this->catalog_model->create($data))
                { 
                    //tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Thêm mới san pham thành công');
                }else{
                    $this->session->set_flashdata('message', 'Không thêm được');
                }
                //chuyen tới trang danh sách quản trị viên
                redirect(admin_url('product'));
            }
        }


	   		$this->data['temp'] = 'admin/product/add';
	   		$this->load->view('admin/main', $this->data);
	  }
	





	}
?>