<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends CI_Controller {

    public function __construct(){
        parent::__construct();

        $this->load->helper('url');
        $this->load->model('item_model');
        $this->load->library('pagination');
    }

	public function index($offset = 0) {    

        $config = array();
        $config['base_url'] = base_url() . 'items/index';
        $config['total_rows'] = $this->item_model->get_count_all();
        $config['per_page'] = 30;
        $config['uri_segment'] = 3;
		$config['attributes'] = array('class' => 'pagination-link');

        $this->pagination->initialize($config);

        $data['links'] = $this->pagination->create_links();
        
        $data['title'] = 'Home';
        $data['cur_page'] = $this->pagination->cur_page;
        $data['per_page'] = $this->pagination->per_page;
        $data['items'] = $this->item_model->get_items(FALSE, $config['per_page'], $offset);
        
        $this->load->view('templates/header', $data);
        $this->load->view('items/index', $data);
        $this->load->view('templates/footer');
	}
    
    public function create() {

        if(!$this->session->userdata('logged_in')){
        	redirect('users/login');
        }

        if(!$this->session->userdata('is_admin')){
        	redirect('/');
        }
        
        $this->form_validation->set_rules('title', 'Title', 'trim');

        if($this->form_validation->run() === FALSE){

            $this->load->view('templates/header', array('title' => 'Add Item'));
            $this->load->view('items/create');
            $this->load->view('templates/footer');
        } 
        else {
            
            $config['upload_path'] = './assets/images/items';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = '2048';
          
            $this->load->library('upload', $config);
           
            $count = count($_FILES['files']['name']);
            
            for($i = 0; $i < $count; $i++) {
                if(!empty($_FILES['files']['name'][$i])){
         
                    $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                    $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                    $_FILES['file']['size'] = $_FILES['files']['size'][$i];       
                    
                    if(!$this->upload->do_upload('file')) {
                        $item_image = 'noimage.jpg';
                    }
                    else {
                        $item_image = $_FILES['file']['name'];
                    }
                    
                    $this->item_model->create_item($item_image);
                }
            }
            
            // Set message
            $this->session->set_flashdata('item_created', ' Your item(s) has been added');
            
            redirect('/items');
        }
    }

    public function delete($id) {

        if(!$this->session->userdata('logged_in')){
            redirect('users/login');
        }

        if(!$this->session->userdata('is_admin')){
        	redirect('/');
        }

        $this->item_model->delete_item($id);

        // Set message
        $this->session->set_flashdata('item_deleted', 'Your item has been deleted');

        redirect('/items');        
    }

    public function edit($id) {

        if(!$this->session->userdata('logged_in')){
            redirect('users/login');
        }

        if(!$this->session->userdata('is_admin')){
        	redirect('/');
        }
       
        $data['item'] = $this->item_model->get_items($id);

        if(empty($data['item'])) {
            show_404();
        }

        $this->load->view('templates/header', array('title' => 'Edit Text Item'));
        $this->load->view('items/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update() {

        if(!$this->session->userdata('logged_in')){
            redirect('users/login');
        }

        if(!$this->session->userdata('is_admin')){
        	redirect('/');
        }

        $this->item_model->update_item();

        // Set message
        $this->session->set_flashdata('item_updated', 'Your item has been updated');

        redirect('/items');
    }

    public function update_order() {

        if(!$this->session->userdata('logged_in')){
            redirect('users/login');
        }

        if(!$this->session->userdata('is_admin')){
        	redirect('/');
        }
        
        $cur_page = $this->input->post('cur_page');
        $per_page = $this->input->post('per_page');
        $tmp_order = $cur_page == 0 ? 0 : ($cur_page - 1) * $per_page;       

        $count = count($this->input->post('items'));       
        
        for($i = 0; $i < $count; $i++) {
            
            $item_id = $this->input->post('items')[$i]['id'];
            $item_order = $this->input->post('items')[$i]['order'];
            $item_order += $tmp_order;   

            $this->item_model->update_item_order($item_id, $item_order); 
        }

        // Set message
        //$this->session->set_flashdata('item_updated', 'Item order has been updated');

        redirect('/items');

    }
}