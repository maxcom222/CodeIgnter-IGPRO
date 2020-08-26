<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

    function  __construct() {
        parent::__construct();
    }

    public function index()
    {
        $page_root = 'HOME > Account Plan';
        $page_title = 'Account Plan';
        $userIP = $this->Admin_model->getUserIP();
        if ($this->Admin_model->verifyUser()) {
            $chFree = 1;
            $sql = "SELECT * FROM users WHERE user_id = " . $this->session->userdata("user_id");
            $query = $this->db->query($sql)->result();
            $name = $query[0]->user_name;
            $email = $query[0]->user_email;
            $ip = $query[0]->ip;
            $sql = "SELECT * FROM orders WHERE item_name='FREE' AND user_id = " . $this->session->userdata("user_id");
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0)
            {
                $chFree = 1;
            }
            $imagePath = "assets/images/users/user_" . $this->session->userdata("user_id") . ".jpg";
            if (!file_exists($imagePath))
                $imagePath = "assets/images/users/user.png";
            $this->load->view('header');
            $this->load->view('account', compact('page_root', 'page_title', 'chFree'));
            $this->load->view('footer');
        }
    }
}
