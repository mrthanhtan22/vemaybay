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

	    	$list = $this->product_model->get_list($input);
	    	$this->data['list'] = $list;
            /* end loc */
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
         	$this->form_validation->set_rules('catalog', 'Thể loại', 'required');
   
            //nhập liệu chính xác
            if($this->form_validation->run())
            {
                //them vao csdl
                $name     = $this->input->post('name');
                $price 	  = $this->input->post('price');
                $price    = str_replace(',', '', $price);
                $discount = $this->input->post('discount');
                $discount = str_replace(',', '', $discount);


                /*up hinh anh dai dien*/
                $this->load->library('upload_library');
                $upload_path = './upload/product';
                $upload_data = $this->upload_library->upload($upload_path,'image' );

                $image_link = '';
                if (isset($upload_data['file_name'])) 
                {
                	$image_link = $upload_data['file_name'];
                }

                /*Upload hinh anh kem theo*/
                $image_list = array();
                $image_list = $this->upload_library->upload_file($upload_path, 'image_list');
                $image_list_json = json_encode($image_list);

                $data = array(
                    'name'         => $name,
                    'price'        => $price,
                    'discount'     => $discount,
                    'warranty'     => $this->input->post('warranty'),
                    'gifts'    	   => $this->input->post('gitfs'),
                    'meta_desc'    => $this->input->post('meta_desc'),
                    'meta_key'     => $this->input->post('meta_key'),
                    'site_title'   => $this->input->post('site_title'),
                    'content'	   => $this->input->post('content'),
                    'catalog_id'   => $this->input->post('catalog')
                );
                if($image_link != '')
                {
                    $data['image_link'] = $image_link;
                }
                
                if(!empty($image_list))
                {
                    $data['image_list'] = $image_list_json;
                }

                if($this->product_model->create($data))
                { 
                    //tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Thêm mới san pham thành công');
                }else{
                    $this->session->set_flashdata('message', 'Không thêm được');
                }
                //chuyen tới trang danh sách san pham
                redirect(admin_url('product'));
            }
        }


	   		$this->data['temp'] = 'admin/product/add';
	   		$this->load->view('admin/main', $this->data);
	  }
      
	
	function edit()
    {
        $id = $this->uri->rsegment('3');
        $product = $this->product_model->get_info($id);
        if(!$product)
        {
            //tạo ra nội dung thông báo
            $this->session->set_flashdata('message', 'Không tồn tại sản phẩm này');
            redirect(admin_url('product'));
        }
        $this->data['product'] = $product;
       
        //lay danh sach danh muc san pham
        $this->load->model('catalog_model');
        $input = array();
        $input['where'] = array('parent_id' => 0);
        $catalogs = $this->catalog_model->get_list($input);
        foreach ($catalogs as $row)
        {
            $input['where'] = array('parent_id' => $row->id);
            $subs = $this->catalog_model->get_list($input);
            $row->subs = $subs;
        }
        $this->data['catalogs'] = $catalogs;
        
        //load thư viện validate dữ liệu
        $this->load->library('form_validation');
        $this->load->helper('form');
        
        //neu ma co du lieu post len thi kiem tra
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Tên', 'required');
            $this->form_validation->set_rules('catalog', 'Thể loại', 'required');
            $this->form_validation->set_rules('price', 'Giá', 'required');
        
            //nhập liệu chính xác
            if($this->form_validation->run())
            {
                //them vao csdl
                $name        = $this->input->post('name');
                $catalog_id  = $this->input->post('catalog');
                $price       = $this->input->post('price');
                $price       = str_replace(',', '', $price);
               
                $discount = $this->input->post('discount');
                $discount = str_replace(',', '', $discount);
                
                //lay ten file anh minh hoa duoc update len
                $this->load->library('upload_library');
                $upload_path = './upload/product';
                $upload_data = $this->upload_library->upload($upload_path, 'image');
                $image_link = '';
                if(isset($upload_data['file_name']))
                {
                    $image_link = $upload_data['file_name'];
                }
            
                //upload cac anh kem theo
                $image_list = array();
                $image_list = $this->upload_library->upload_file($upload_path, 'image_list');
                $image_list_json = json_encode($image_list);
        
                //luu du lieu can them
                $data = array(
                    'name'       => $name,
                    'catalog_id' => $catalog_id,
                    'price'      => $price,
                    'discount'   => $discount,
                    'warranty'   => $this->input->post('warranty'),
                    'gifts'      => $this->input->post('gifts'),
                    'site_title' => $this->input->post('site_title'),
                    'meta_desc'  => $this->input->post('meta_desc'),
                    'meta_key'   => $this->input->post('meta_key'),
                    'content'    => $this->input->post('content'),
                );
                if($image_link != '')
                {
                    $data['image_link'] = $image_link;
                }
                
                if(!empty($image_list))
                {
                    $data['image_list'] = $image_list_json;
                }
                
                //them moi vao csdl
                if($this->product_model->update($product->id, $data))
                {
                    //tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
                }else{
                    $this->session->set_flashdata('message', 'Không cập nhật được');
                }
                //chuyen tới trang danh sách
                redirect(admin_url('product'));
            }
        }
        
        
        //load view
        $this->data['temp'] = 'admin/product/edit';
        $this->load->view('admin/main', $this->data);
    }
    function del(){

         $id = $this->uri->rsegment('3');
            $this->_del($id);
        $this->session->set_flashdata('message', 'Xoa thanh cong ');
        redirect(admin_url('product'));
        

    }
    function delete_all(){

       $ids =  $this->input->post('ids');
        foreach ($ids as $id) {
            $this->_del($id);
        }
        $this->session->set_flashdata('message', 'Xoa thanh cong cac san pham ');
        redirect(admin_url('product'));

    }

   private function _del($id){

        $product = $this->product_model->get_info($id);
        if(!$product)
        {
            //tạo ra nội dung thông báo
            $this->session->set_flashdata('message', 'Không tồn tại sản phẩm này');
            redirect(admin_url('product'));
        }
        $this->data['product'] = $product;
        $this->product_model->delete($id);

        $image_link = './upload/product'.$product->image_link;
        if (file_exists($image_link)) {
            unlink($image_link);
        }

        $image_list = json_decode($product->image_list);
        foreach ($image_list as $img) {
            $image_link = '.upload/product'.$img;
            if (file_exists($image_link)) {
                unlink($image_link);
            }
        }

    }


	}
?>