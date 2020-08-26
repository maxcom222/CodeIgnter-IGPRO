<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function index()
    {
        /*
        Error List:
        0 - No Error
        1 - Too Many Login Attempts
        2 - Bad Credentials
        */
        $this->load->view('register');
    }

    public function usernew(){
        $postData = $this->input->post();
        if ($postData["user_password"] != $postData["user_confirm"])
        {
            $data["error"] = 5;
            $this->load->view('register', $data);
            return;
        }
        $auth = $this->Admin_model->updateUsers($postData, "add");
        if ($auth == 10) {
            redirect(base_url().'login', "auto");
        } else {
            $data["error"] = $auth;
            $this->load->view('register', $data);
            return;
        }
    }
}
