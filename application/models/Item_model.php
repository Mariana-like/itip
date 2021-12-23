<?php

class Item_model extends CI_Model {

    protected $table = 'items';

    public function __construct() {
        $this->load->database();
    }

    public function get_items($id = FALSE, $limit = FALSE, $offset = FALSE) {

        if($limit) {
            $this->db->limit($limit, $offset);
        }

        if($id === FALSE){
            $this->db->order_by('sort_order', 'ASC');
            $query = $this->db->get($this->table);
            return $query->result_array();
        }

        $query = $this->db->get_where($this->table, array('id' => $id));
		return $query->row_array();
	}

    public function get_count_all() {

        return $this->db->count_all($this->table);
    }

    public function create_item($item_image) {

        $this->db->set('sort_order', 'sort_order+1', FALSE);
        $this->db->update($this->table);

        $data = array(
            'title' => $this->input->post('title'),
            'user_id' => $this->session->userdata('user_id'),
            'item_image' => $item_image,
            'sort_order' => 1
        );

        return $this->db->insert($this->table, $data);
    }

    public function delete_item($id) {

        $image_file_name = $this->db->select('item_image')->get_where($this->table, array('id' => $id))->row()->item_image;
        $cwd = getcwd(); // save the current working directory
        $image_file_path = $cwd."\\assets\\images\\items";
        chdir($image_file_path);
        unlink($image_file_name);
        chdir($cwd); // Restore the previous working directory
        
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        
        return true;
    }

    public function update_item() {

        $data = array(
            'title' => $this->input->post('title')
        );

        $this->db->where('id', $this->input->post('id'));
        return $this->db->update($this->table, $data);
    }

    public function update_item_order($item_id, $item_order) {
               
        $data = array(
            'sort_order' => $item_order
        );

        $this->db->where('id', $item_id);
        return $this->db->update($this->table, $data);
    }
}