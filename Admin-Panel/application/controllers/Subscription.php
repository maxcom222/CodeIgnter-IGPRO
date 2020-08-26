<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscription extends CI_Controller {

    public function index()
    {
        $page_root = 'HOME > Subscription';
        $page_title = '';
        if ($this->Admin_model->verifyUser()) {
            $this->load->view('header');
            $this->load->view('subscription', compact('page_title', 'page_root'));
            $this->load->view('footer');
        }
    }
    public function getExpiryDate()
    {
        if ($this->Admin_model->verifyUser()) {
            if ($this->input->post()) {
                $postData = $this->input->post();
                $sql = "SELECT dt_expirydate FROM orders WHERE id = " . $postData["id"];
                $query = $this->db->query($sql)->result();
                echo json_encode($query[0]);exit;
            }
        }
    }
    public function getSubscriptions()
    {
        if ($this->Admin_model->verifyUser()) {
            if ($this->input->get()) {
                $requestData = $this->input->get();
                $sql = "SELECT * FROM orders WHERE user_id IN (SELECT user_id FROM users WHERE user_name LIKE '%".$requestData['username']."%')";
                $query = $this->db->query($sql)->result();
                echo json_encode(array("draw" => 1, "recordsTotal" => count($query), "recordsFiltered" => count($query), "data" => $query));
                exit;
            }
        }
    }
    public function saveExpiryDate()
    {
        if ($this->Admin_model->verifyUser()) {
            if ($this->input->post()) {
                $postData = $this->input->post();
                if ($postData['id'] != 0){
                    $sql = "UPDATE orders SET dt_expirydate = '" . $postData['dt_expirydate'] . "' WHERE id = " . $postData["id"];
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
    public function deleteSubscription()
    {
        if ($this->Admin_model->verifyUser()) {
            if ($this->input->post()) {
                $postData = $this->input->post();
                $sql = "DELETE FROM orders WHERE id = " . $postData["id"];
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
