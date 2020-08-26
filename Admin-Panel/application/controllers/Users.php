<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function index()
    {
        $page_root = 'HOME > Users';
        $page_title = '';
        if ($this->Admin_model->verifyUser()) {
            $this->load->view('header');
            $this->load->view('users', compact('page_title', 'page_root'));
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
    public function getUsers()
    {
        if ($this->Admin_model->verifyUser()) {
            if ($this->input->get()) {
                $requestData = $this->input->get();
                $sql = "SELECT user_id, user_name, user_email, status, created_at FROM users WHERE user_name LIKE '%".$requestData['username']."%'";
                $query = $this->db->query($sql)->result();
                echo json_encode(array("draw" => 1, "recordsTotal" => count($query), "recordsFiltered" => count($query), "data" => $query));
                exit;
            }
        }
    }
    public function changeStatus()
    {
        if ($this->Admin_model->verifyUser()) {
            if ($this->input->post()) {
                $postData = $this->input->post();
                $sql = "UPDATE users SET status = " . $postData['curval'] . " WHERE user_id = " . $postData["user_id"];
                $bool = $this->db->query($sql);
                if($bool)
                    exit("success");
                else
                    exit("error");
            }
        }
        exit("error");
    }
    public function saveUser()
    {
        if ($this->Admin_model->verifyUser()) {
            if ($this->input->post()) {
                $postData = $this->input->post();
                if ($postData['user_id'] == 0 || $postData['user_id'] == "0"){
                    $sql = "INSERT INTO users(user_email, user_name, user_password, status, created_at, updated_at) VALUES ".
                        "('".$postData['email']."', '".$postData['name']."', '".password_hash($postData['password'], PASSWORD_DEFAULT)."', '".$postData['status']."', '"
                        .$postData['dtreg']."', '".$postData['dtreg']."')";
                }else{
                    $sql = "UPDATE users SET user_email = '" . $postData['email'] . "', user_name = '" . $postData['name']
                        . "', status = '" . $postData['status']
                        . "', created_at = '" . $postData['dtreg'] . "', updated_at = '" . $postData['dtreg'] . "' WHERE user_id = " . $postData["user_id"];
                }
                $bool = $this->db->query($sql);
                if($bool)
                    exit("success");
                else
                    exit("error");
            }
        }
        exit("error");
    }
    public function deleteUser()
    {
        if ($this->Admin_model->verifyUser()) {
            if ($this->input->post()) {
                $postData = $this->input->post();
                $sql = "DELETE FROM users WHERE user_id = " . $postData["user_id"];
                $bool = $this->db->query($sql);
                if($bool)
                    exit("success");
                else
                    exit("error");
            }
        }
        exit("error");
    }
}
