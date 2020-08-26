<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hashtag extends CI_Controller {

    public function index()
    {
        $page_root = 'HOME > Hashtag';
        $page_title = '';
        if ($this->Admin_model->verifyUser()) {
            $this->load->view('header');
            $this->load->view('hashtag', compact('page_title', 'page_root'));
            $this->load->view('footer');
        }
    }
    public function getOneUsers()
    {
        if ($this->Admin_model->verifyUser()) {
            if ($this->input->post()) {
                $postData = $this->input->post();
                $sql = "SELECT user_id, user_name, user_email, status, created_at FROM users WHERE user_id = " . $postData["user_id"];
                $query = $this->db->query($sql)->result();
                echo json_encode($query[0]);exit;
            }
        }
    }
    public function getHashTags()
    {
        if ($this->Admin_model->verifyUser()) {
            if ($this->input->get()) {
                $requestData = $this->input->get();
                $sql = "SELECT * FROM hashtags WHERE is_delete = TRUE AND vchHashTags LIKE '%".$requestData['hashtag']."%' ORDER BY intID DESC";
                $query = $this->db->query($sql)->result();
                echo json_encode(array("draw" => 1, "recordsTotal" => count($query), "recordsFiltered" => count($query), "data" => $query));
                exit;
            }
        }
    }
    public function saveHashTags()
    {
        if ($this->Admin_model->verifyUser()) {
            if ($this->input->post()) {
                $postData = $this->input->post();
                if ($postData['hashid'] == 0){
                    $hashtag = $postData['hashtag'];
                    $arrtag = explode(',', $hashtag);
                    $created = '';
                    $exists = '';
                    $error = '';
                    for ($i = 0; $i < sizeof($arrtag); $i++)
                    {
                        $hashtagone = $arrtag[$i];
                        $sql = "SELECT * FROM hashtags WHERE vchHashTags = '#".$hashtagone."'";
                        $query = $this->db->query($sql)->result();
                        if (count($query) > 0)
                        {
                            if ($exists == '')
                            {
                                $exists .= $hashtagone;
                            } else {
                                $exists .= ', ' . $hashtagone;
                            }
                            continue;
                        }
                        $sql = "INSERT INTO hashtags(vchHashTags, dt_CronRunDate) VALUES ".
                            "('#".$hashtagone."', '0000-00-00')";
                        $bool = $this->db->query($sql);
                        if($bool)
                        {
                            if ($created == '')
                            {
                                $created .= $hashtagone;
                            } else {
                                $created .= ', ' . $hashtagone;
                            }
                        } else {
                            if ($error == '')
                            {
                                $error .= $hashtagone;
                            } else {
                                $error .= ', ' . $hashtagone;
                            }
                        }
                    }
                    echo json_encode(array('created'=>$created, 'exists'=>$exists, 'error'=>$error)); exit;
                }else{

                }
            }
        }
        exit("error");
    }
    public function deleteHashTags()
    {
        if ($this->Admin_model->verifyUser()) {
            if ($this->input->post()) {
                $postData = $this->input->post();
                $sql = "DELETE FROM hashtags WHERE intID = " . $postData["intID"];
                $bool = $this->db->query($sql);
                if(!$bool)
                    exit("error");
                $sql = "DELETE FROM hashtags_log WHERE intHashTagID = " . $postData["intID"];
                $bool = $this->db->query($sql);
                if(!$bool)
                    exit("error");

                exit("success");
            }
        }
        exit("error");
    }
}
