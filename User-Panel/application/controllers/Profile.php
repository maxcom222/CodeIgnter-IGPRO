<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function index()
    {
        $page_root = 'HOME > Profile';
        $page_title = 'Profile';
        if ($this->Admin_model->verifyUser()) {
            $sql = "SELECT * FROM users WHERE user_id = " . $this->session->userdata("user_id");
            $query = $this->db->query($sql)->result();
            $name = $query[0]->user_name;
            $email = $query[0]->user_email;
            $imagePath = "assets/images/users/user_" . $this->session->userdata("user_id") . ".jpg";
            if (!file_exists($imagePath))
                $imagePath = "assets/images/users/user.png";
            $this->load->view('header');
            $this->load->view('profile', compact('page_root', 'page_title', 'name', 'email', 'imagePath'));
            $this->load->view('footer');
        }
    }
    public function change()
    {
        if ($this->Admin_model->verifyUser()) {
            if ($this->input->post()) {
                $postData = $this->input->post();
                if(isset($_FILES['file'])){
                    $file_name = $_FILES['file']['name'];
                    $file_size = $_FILES['file']['size'];
                    $file_tmp = $_FILES['file']['tmp_name'];
                    $file_type = $_FILES['file']['type'];
                    $arr = explode('.', $_FILES['file']['name']);
                    $file_ext = strtolower($arr[sizeof($arr) - 1]);

                    $target = "assets/images/users/user_" . $this->session->userdata("user_id") . "." . $file_ext;
                    $bl = move_uploaded_file($file_tmp, $target);
                }
                $this->load->helper('url');
                redirect(base_url().'profile');
            }
        }
    }
    public function changePassword()
    {
        if ($this->Admin_model->verifyUser()) {
            if ($this->input->post()) {
                $postData = $this->input->post();
                $password = $this->db->escape(md5("xiORG17N6ayoEn6X3".$postData['password']));
                $sql = "UPDATE users SET user_password = $password WHERE user_id = " . $this->session->userdata("user_id");
                $this->db->query($sql);
                exit("success");
            }
        }
    }
}
