<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Top extends CI_Controller {

    function  __construct() {
        parent::__construct();
    }

    public function index()
    {
        $page_root = 'HOME > Top Hashtags';
        $page_title = 'Top Hashtags';
        $userIP = $this->Admin_model->getUserIP();
        if ($this->Admin_model->verifyUser()) {
            $remain = $this->Admin_model->getAccountRemain();
            if ($remain < 1)
            {
                redirect(base_url()."account", 'auto');
                return;
            }
            $imagePath = "assets/images/users/user_" . $this->session->userdata("user_id") . ".jpg";
            if (!file_exists($imagePath))
                $imagePath = "assets/images/users/user.png";
            $postData = $this->input->post();
            $sql = "SELECT * FROM hashtags ORDER BY intPostCount DESC LIMIT 40";
            $total = $this->db->query($sql)->result();
            $this->load->view('header');
            $this->load->view('top', compact('page_root', 'page_title', 'total'));
            $this->load->view('footer');
        }
    }
}
