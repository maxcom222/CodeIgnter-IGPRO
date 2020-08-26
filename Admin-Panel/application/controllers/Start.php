<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Start extends CI_Controller {

    public function index()
    {
        $page_root = 'HOME > Dashboard';
        $page_title = 'Dashboard';
        if ($this->Admin_model->verifyUser()) {
            $sql = "SELECT count(*) as cnt FROM users";
            $query = $this->db->query($sql)->result();
            $cntUser = $query[0]->cnt;
            $sql = "SELECT count(*) as cnt FROM hashtags WHERE is_delete = TRUE";
            $query = $this->db->query($sql)->result();
            $cntHash = $query[0]->cnt;
            $this->load->view('header');
            $this->load->view('welcome_message', compact('page_root', 'page_title', 'cntHash', 'cntUser'));
            $this->load->view('footer');
        }
    }
}
