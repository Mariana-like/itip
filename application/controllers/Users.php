<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function login() {

        $data['title'] = 'Sign In';

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run() === FALSE) {
            
            $this->load->view('templates/header');
            $this->load->view('users/login', $data);
            $this->load->view('templates/footer');
        } 
        else {
            
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            $user = $this->user_model->login($username, $password);

            if($user) {

                $user_data = array(
                    'user_id' => $user['id'],
                    'username' => $username,
                    'logged_in' => true,
                    'is_admin' => !!$user['admin_level']
                );

                $this->session->set_userdata($user_data);

                // Set message
                //$this->session->set_flashdata('user_loggedin', 'You are now logged in');

                redirect('/');
            } 
            else {
                // Set message
                $this->session->set_flashdata('login_failed', 'Login is invalid');

                redirect('users/login');
            }		
        }
    }

    public function logout() {

        $this->session->unset_userdata('is_admin');
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');

        // Set message
        //$this->session->set_flashdata('user_loggedout', 'You are now logged out');

        redirect('/');
    }
}