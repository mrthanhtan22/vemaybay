<?php 
	/**
	 * summary
	 */
	class News extends MY_Controller
	{
	   public function __construct()
	   {
	   		parent::__construct();
	   		$this->load->model('news_model');
	   }

	   function index(){
        //lay tong so luong ta ca cac bai vai trong websit
        $total = $this->news_model->get_total();
        $this->data['total'] = $total;
        
        //load ra thu vien phan trang
        $this->load->library('pagination');
        $config = array();
        $config['total_rows'] = $total;//tong tat ca cac bài viết tren website
        $config['base_url']   = admin_url('news/index'); //link hien thi ra danh sach bài viết
        $config['per_page']   = 3;//so luong bài viết hien thi tren 1 trang
        $config['uri_segment'] = 4;//phan doan hien thi ra so trang tren url
        $config['next_link']   = 'Trang kế tiếp';
        $config['prev_link']   = 'Trang trước';
        //khoi tao cac cau hinh phan trang
        $this->pagination->initialize($config);
        
        $segment = $this->uri->segment(4);
        $segment = intval($segment);


        $input = array();
        $input['limit'] = array($config['per_page'], $segment);
        
        //kiem tra co thuc hien loc du lieu hay khong
        $id = $this->input->get('id');
        $id = intval($id);
        $input['where'] = array();
        if($id > 0)
        {
            $input['where']['id'] = $id;
        }
        $title = $this->input->get('title');
        if($title)
        {
            $input['like'] = array('title', $title);
        }
       
        //lay danh sach bai viet
        $list = $this->news_model->get_list($input);
        $this->data['list'] = $list;
       
        //lay nội dung của biến message
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        
        //load view
        $this->data['temp'] = 'admin/news/index';
        $this->load->view('admin/main', $this->data);
        }



	  function add(){
	  	

            $message = $this->session->flashdata('message');
            $this->data['message'] = $message;

            $this->load->library('form_validation');
       	 	$this->load->helper('form');
        
        	//neu ma co du lieu post len thi kiem tra
        	if($this->input->post())
        	{
         	$this->form_validation->set_rules('title', 'Tên', 'required');
         	$this->form_validation->set_rules('content', 'content', 'required');
         	
   
            //nhập liệu chính xác
            if($this->form_validation->run())
            {
                
                /*up hinh anh dai dien*/
                $this->load->library('upload_library');
                $upload_path = './upload/news';
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
                    'title'        =>  $this->input->post('title'),
                    'image_link'   =>  $image_link,
                    'meta_desc'     => $this->input->post('meta_desc'),
                    'meta_key'      => $this->input->post('meta_key'),
                    'content'       => $this->input->post('content'),
                    'created'       => now(),
                );
                if($image_link != '')
                {
                    $data['image_link'] = $image_link;
                }
                
                if(!empty($image_list))
                {
                    $data['image_list'] = $image_list_json;
                }

                if($this->news_model->create($data))
                { 
                    //tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Thêm mới bai viet thành công');
                }else{
                    $this->session->set_flashdata('message', 'Không thêm được');
                }
                //chuyen tới trang danh sách san pham
                redirect(admin_url('news'));
            }
        }


	   		$this->data['temp'] = 'admin/news/add';
	   		$this->load->view('admin/main', $this->data);
	  }
      
	   function edit(){
        
            $id = $this->uri->rsegment('3');
            $news = $this->news_model->get_info($id);
            if(!$news)
            {
                //tạo ra nội dung thông báo
                $this->session->set_flashdata('message', 'Không tồn tại sản phẩm này');
                redirect(admin_url('news'));
            }
            $this->data['news'] = $news;

            $message = $this->session->flashdata('message');
            $this->data['message'] = $message;

            $this->load->library('form_validation');
            $this->load->helper('form');
        
            //neu ma co du lieu post len thi kiem tra
            if($this->input->post())
            {
            $this->form_validation->set_rules('title', 'Tên', 'required');
            $this->form_validation->set_rules('content', 'content', 'required');
            
   
            //nhập liệu chính xác
            if($this->form_validation->run())
            {
                
                /*up hinh anh dai dien*/
                $this->load->library('upload_library');
                $upload_path = './upload/news';
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
                    'title'        =>  $this->input->post('title'),
                    'image_link'   =>  $image_link,
                    'meta_desc'     => $this->input->post('meta_desc'),
                    'meta_key'      => $this->input->post('meta_key'),
                    'content'       => $this->input->post('content'),
                    'created'       => now(),
                );
                if($image_link != '')
                {
                    $data['image_link'] = $image_link;
                }
                
                if(!empty($image_list))
                {
                    $data['image_list'] = $image_list_json;
                }

                if($this->news_model->update($data))
                { 
                    //tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Thêm mới bai viet thành công');
                }else{
                    $this->session->set_flashdata('message', 'Không thêm được');
                }
                //chuyen tới trang danh sách san pham
                redirect(admin_url('news'));
            }
        }


            $this->data['temp'] = 'admin/news/edit';
            $this->load->view('admin/main', $this->data);
      }
	

    function del(){

         $id = $this->uri->rsegment('3');
            $this->_del($id);
        $this->session->set_flashdata('message', 'Xoa thanh cong ');
        redirect(admin_url('news'));
        

    }
    function delete_all(){

       $ids =  $this->input->post('ids');
        foreach ($ids as $id) {
            $this->_del($id);
        }
        $this->session->set_flashdata('message', 'Xoa thanh cong cac bai viet ');
        redirect(admin_url('news'));

    }

   private function _del($id){

        $news = $this->news_model->get_info($id);
        if(!$news)
        {
            //tạo ra nội dung thông báo
            $this->session->set_flashdata('message', 'Không tồn tại bai viet này');
            redirect(admin_url('news'));
        }
        $this->data['news'] = $news;
        $this->news_model->delete($id);

        $image_link = './upload/news'.$news->image_link;
        if (file_exists($image_link)) {
            unlink($image_link);
        }

        $image_list = json_decode($news->image_list);
        foreach ($image_list as $img) {
            $image_link = '.upload/news'.$img;
            if (file_exists($image_link)) {
                unlink($image_link);
            }
        }

    }


	}
?>