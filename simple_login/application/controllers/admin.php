<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function index()
    {

        if ( isset($_SESSION['username']) ) {
            redirect('home');
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email_address', 'Email Address', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');
        
        if( $this->form_validation->run() !== false ) {
            // then validation passed. Get from DB
            $this->load->model('admin_model');
            //$this->admin_model->verify_user('dadams@bemythic.com','mypassword'); //test verify_user with manual input
            $res = $this
                ->admin_model
                ->verify_user(
                              $this->input->post('email_address'),
                              $this->input->post('password')
                              );
            
            if($res !== false ) {
                //person has an acct
                $_SESSION['username'] = $this->input->post('email_address');
                redirect('home');
            }
        }
        
        $this->load->view('login_view');
        
    }
    
    public function logout(){
        session_destroy();
        $this->load->view('login_view');
	
    }
}

