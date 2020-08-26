<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bulk extends CI_Controller {

    function  __construct() {
        parent::__construct();
    }

    public function index()
    {
        $page_root = 'HOME > Mass Search';
        $page_title = 'Mass Search';
        $userIP = $this->Admin_model->getUserIP();
        if ($this->Admin_model->verifyUser()) {
            $imagePath = "assets/images/users/user_" . $this->session->userdata("user_id") . ".jpg";
            if (!file_exists($imagePath))
                $imagePath = "assets/images/users/user.png";
            $this->load->view('header');
            $this->load->view('bulk', compact('page_root', 'page_title'));
            $this->load->view('footer');
        }
    }
    public function getInfo()
    {
        $page_root = 'HOME > Mass Search';
        $page_title = 'Mass Search';
        if ($this->Admin_model->verifyUser()){
            $remain = $this->Admin_model->getAccountRemain();
            if ($remain < 1)
            {
                redirect(base_url()."account", 'auto');
                return;
            }
            $postData = $this->input->post();
            $hashtags = $postData['hashtags'];
            $average = $postData['average'];
            if ($hashtags == "")
            {
                $this->load->view('header');
                $this->load->view('bulk', compact('page_root', 'page_title', 'hashtags', 'average'));
                $this->load->view('footer');
                return;
            }
            $arrHashtag = explode(" ", $hashtags);
            if (sizeof($arrHashtag) > 30)
            {
                $error = " Error: You've input too many hashtags. ";
                $this->load->view('header');
                $this->load->view('bulk', compact('page_root', 'page_title', 'hashtags', 'average', 'error'));
                $this->load->view('footer');
                return;
            }
            $total = array();
            $nohashtags = "";
            $noscanhashtags = "";
            for ($i = 0; $i < sizeof($arrHashtag); $i++)
            {
                $oneTotal = array();
                $oneHashtag = str_replace("#", "", $arrHashtag[$i]);
                $oneHashtag = str_replace(" ", "", $oneHashtag);
                $oneHashtag = strtolower($oneHashtag);
                if ($oneHashtag == "") continue;
                $sql = "SELECT * FROM hashtags WHERE vchHashTags LIKE '%".$oneHashtag."%'";
                $numrows = $this->db->query($sql)->num_rows();
                if ($numrows < 1)
                {
                    $sql = "INSERT INTO hashtags(vchHashTags, dt_CronRunDate) VALUES ".
                        "('#".$oneHashtag."', '0000-00-00')";
                    $bool = $this->db->query($sql);
                    $nohashtags .= $nohashtags == ""?$oneHashtag:",".$oneHashtag;
                    continue;
                }
                $sql = "SELECT * FROM hashtags WHERE vchHashTags = '#".$oneHashtag."' AND enumstatus = 'N'";
                $numrows = $this->db->query($sql)->num_rows();
                if ($numrows > 0)
                {
                    $noscanhashtags .= $noscanhashtags == ""?$oneHashtag:",".$oneHashtag;
                    continue;
                }
                $sql = "SELECT * FROM hashtags WHERE vchHashTags = '#".$oneHashtag."'";
                $hashtagData = $this->db->query($sql)->result();
                array_push($total, $hashtagData[0]);
            }
//            echo "<HTML><BODY><PRE>";
//            var_dump($total);
//            echo "</PRE></BODY></HTML>";
//            exit;
            $this->load->view('header');
            $this->load->view('bulk', compact('page_root', 'page_title', 'hashtags', 'average', 'total', 'nohashtags', 'noscanhashtags'));
            $this->load->view('footer');
        }
    }
}
