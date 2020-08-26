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
            $sql = "SELECT count(*) as cnt FROM hashtags WHERE is_delete = TRUE AND enumStatus='Y'";
            $query = $this->db->query($sql)->result();
            $cntScanHash = $query[0]->cnt;
            $scanPregress = floor($cntScanHash/$cntHash * 100);
            $sql = "SELECT item_name, DATE(dt_expirydate) dt_expire, DATEDIFF(dt_expirydate, NOW()) remain FROM orders ".
                "WHERE dt_expirydate = (SELECT MAX(dt_expirydate) FROM orders WHERE user_id = " . $this->session->userdata("user_id").") AND user_id = "
                . $this->session->userdata("user_id");
            $query = $this->db->query($sql)->result();
            if (sizeof($query) > 0)
            {
                $plan_name = $query[0]->item_name;
                $dt_expire = $query[0]->dt_expire;
                $remain = $query[0]->remain;
            }else{
                $plan_name = "NONE";
                $dt_expire = "NONE";
                $remain = "0";
            }
            $this->load->view('header');
            $this->load->view('welcome_message', compact('page_root', 'page_title', 'cntHash', 'scanPregress', 'cntScanHash', 'cntUser', 'plan_name', 'dt_expire', 'remain'));
            $this->load->view('footer');
        }
    }
}
