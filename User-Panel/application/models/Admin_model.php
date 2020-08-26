<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
                // Your own constructor code
        }

        public function generateSalt() {
                $salt = "xiORG17N6ayoEn6X3";
                return $salt;
        }

        protected function generateVerificationKey() {
                $length = 10;
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
        }

        public function getUserIP() {
		    $ipaddress = '';
		    if (isset($_SERVER['HTTP_CLIENT_IP']))
		        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		    else if(isset($_SERVER['HTTP_X_FORWARDED']))
		        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		    else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
		        $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
		    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
		        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		    else if(isset($_SERVER['HTTP_FORWARDED']))
		        $ipaddress = $_SERVER['HTTP_FORWARDED'];
		    else if(isset($_SERVER['REMOTE_ADDR']))
		        $ipaddress = $_SERVER['REMOTE_ADDR'];
		    else
		        $ipaddress = 'UNKNOWN';
		    return $ipaddress;
	   }

        public function getUserInfo($userid=null) {
            $sql = "SELECT * FROM users WHERE user_id = ".$this->db->escape(strip_tags((int)$userid));
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return array();
            }
        }

        public function updateUsers($postData=null, $action=null) {
            if ($action == "add") {
                $error = 0;
                if (!isset($postData["user_name"]) || empty($postData["user_name"])) { $error = 1;} else { $user_name = $this->db->escape(strip_tags($postData["user_name"]));}
                if (!isset($postData["user_password"]) || empty($postData["user_password"])) { $error = 2;} else { $user_password = strip_tags($postData["user_password"]);}
                if (!isset($postData["user_email"]) || empty($postData["user_email"])) { $error = 3;} else { $user_email = $this->db->escape(strip_tags($postData["user_email"]));}
                if (!isset($postData["status"]) || empty($postData["status"])) { $status = "0";} else { $status = $this->db->escape(strip_tags($postData["status"]));}
                $verification_key = $this->db->escape($this->generateVerificationKey());
                $salt = $this->generateSalt();
                $user_password = $this->db->escape(md5($salt.$user_password));
                if ($error > 0) { return $error; }
                $now = $this->db->escape(time());
                $sql = "SELECT * FROM users WHERE user_name = " . $user_name . " or user_email = " . $user_email;
                $query = $this->db->query($sql);
                if ($query->num_rows() > 0) {
                    return 4;
                } else {
                    $sql2 = "INSERT INTO users (user_name, user_password, user_email, created_at, verification_key, status) VALUES ".
                            "($user_name, $user_password, $user_email, $now, $verification_key, $status)";
                    $this->db->query($sql2);
                    return 10;
                }

            }
            if ($action == "edit") {
                    $error = 0;
                if (!isset($postData["user_name"]) || empty($postData["user_name"])) { $error = 1;} else { $user_name = $this->db->escape(strip_tags($postData["user_name"]));}
                if (!isset($postData["user_password"]) || empty($postData["user_password"])) { $pass = 0; } else { $pass = 1; $user_password = strip_tags($postData["user_password"]);}
                if (!isset($postData["user_email"]) || empty($postData["user_email"])) { $error = 3;} else { $user_email = $this->db->escape(strip_tags($postData["user_email"]));}
                if (!isset($postData["status"]) || empty($postData["status"])) { $status = "0";} else { $status = $this->db->escape(strip_tags($postData["status"]));}
                if ($error > 0) { return $error; }
                $sql = "SELECT * FROM users WHERE user_name = ".$user_name;
                $query = $this->db->query($sql);
                if ($query->num_rows() > 0) {
                    if ($pass == 0) {
                        $sql = "UPDATE users SET user_email = $user_email, user_name = $user_name, status = $status WHERE user_id = ".$this->db->escape($query->row()->user_id);
                        $this->db->query($sql);
                        return TRUE;
                    } else {
                        $salt = $this->generateSalt();
                        $user_password = $this->db->escape(md5($salt.$user_password));
                        $sql = "UPDATE users SET user_email = $user_email, user_name = $user_name, status = $status, user_password = $user_password WHERE user_id = ".$this->db->escape($query->row()->user_id);
                        $this->db->query($sql);
                        return TRUE;
                    }
                } else {
                    return 4;
                }
            }
            if ($action == "delete") {
                    $user_id = $this->db->escape(strip_tags((int)$postData["user_id"]));
                    if ((int)$postData["id"] == $this->session->userdata("user_id")) {
                            return FALSE;
                    } else {
                       $sql = "DELETE FROM users WHERE user_id = ".$user_id;
                       $this->db->query($sql);
                       return TRUE;
                    }

            }
        }

        public function userLogin($postData) {
        	if (!isset($postData["user_email"])) { return 2; }
        	if (!isset($postData["user_password"])) { return 2; }
        	$salt = $this->generateSalt();
        	$user_email = $this->db->escape(strip_tags($postData["user_email"]));
        	$user_password = $this->db->escape(strip_tags(md5($salt.$postData["user_password"])));
        	$sql = "SELECT * FROM users WHERE user_email = ".$user_email." AND user_password = ".$user_password;
        	$query = $this->db->query($sql);
        	if ($query->num_rows() > 0) {
        		$q = $query->row();
        		$this->session->set_userdata("user_name", $q->user_name);
        		$this->session->set_userdata("verification_key", $q->verification_key);
        		$this->session->set_userdata("user_id", $q->user_id);
        		$this->session->set_userdata("loggedin", 1);
        		$ip = $this->getUserIP();
        		$sql2 = "UPDATE users SET updated_at = NOW(), ip = ".$this->db->escape($ip)." WHERE user_id = ".$q->user_id;
        		$this->db->query($sql2);
        		return true;
        	} else {
        		return false;
        	}
        }

        public function verifyUser() {
        	if ($this->session->userdata("user_name") && $this->session->userdata("verification_key") && $this->session->userdata("user_id") && $this->session->userdata("loggedin")) {
        		$sql = "SELECT * FROM users WHERE user_id = ".$this->db->escape(strip_tags((int)$this->session->userdata("user_id")))
                    ." AND verification_key = ".$this->db->escape(strip_tags($this->session->userdata("verification_key")));
        		$query = $this->db->query($sql);
        		if ($query->num_rows() > 0) {
        			return TRUE;
        		} else {
        			$this->logout();
        			redirect(base_url()."login", 'auto');
        		}
        	} else {
        		$this->logout();
        		redirect(base_url()."login", 'auto');
        	}
        }

        public function logout() {
        	$this->session->unset_userdata("user_name");
        	$this->session->unset_userdata("verification_key");
        	$this->session->unset_userdata("user_id");
        	$this->session->unset_userdata("loggedin");
        	return TRUE;
        }

        public function getAccountRemain() {
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
            return intval($remain);
        }
}