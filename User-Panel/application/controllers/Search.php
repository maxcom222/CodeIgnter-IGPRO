<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

    function  __construct() {
        parent::__construct();
    }

    public function index()
    {
        $page_root = 'HOME > Search';
        $page_title = 'Search';
        $userIP = $this->Admin_model->getUserIP();
        if ($this->Admin_model->verifyUser()) {
            $imagePath = "assets/images/users/user_" . $this->session->userdata("user_id") . ".jpg";
            if (!file_exists($imagePath))
                $imagePath = "assets/images/users/user.png";
            $this->load->view('header');
            $this->load->view('search', compact('page_root', 'page_title'));
            $this->load->view('footer');
        }
    }
    public function getInfo()
    {
        $page_root = 'HOME > Search';
        $page_title = 'Search';
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
            $radioType = $postData['radioType'];
            $range = $postData['range'];
            if ($hashtags == "")
            {
                $this->load->view('header');
                $this->load->view('search', compact('page_root', 'page_title', 'hashtags', 'average', 'radioType', 'range'));
                $this->load->view('footer');
                return;
            }
            $arrHashtag = explode(" ", $hashtags);
            if (sizeof($arrHashtag) > 3)
            {
                $error = " Error: You've input too many hashtags. ";
                $this->load->view('header');
                $this->load->view('search', compact('page_root', 'page_title', 'hashtags', 'average', 'radioType', 'range', 'error'));
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
                $oneTotal['title'] = $oneHashtag;
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
                $data = array();
                if(intval($radioType) == 1)
                {
                    $start = 0;
                    $end = 1000;
                    $oneData = array();
                    $oneData['onetitle'] = "Displaying results with APPD in [1 - 1 000]";
                    if ($range == "1_20")
                    {
                        $start = 0;
                        $end = 5000;
                        $oneData['onetitle'] = "Displaying results with APPD in [1 - 5 000]";
                    } else if ($range == "1_30")
                    {
                        $start = 0;
                        $end = 10000;
                        $oneData['onetitle'] = "Displaying results with APPD in [1 - 10 000]";
                    } else if ($range == "1_40")
                    {
                        $start = 0;
                        $end = 999999999999;
                        $oneData['onetitle'] = "Displaying results with APPD in [1 - MAX]";
                    }
                    $sql = "SELECT * FROM hashtags WHERE vchHashTags LIKE '%".$oneHashtag."%' AND intDAPC >= " . $start . " AND intDAPC <= " . $end;
                    $hashtagData = $this->db->query($sql)->result();
                    $oneData['onedata'] = $hashtagData;
                    array_push($data, $oneData);
                } else if (intval($radioType) == 2)
                {
                    $start = 0;
                    $end = 10000;
                    $oneData = array();
                    $oneData['onetitle'] = "Displaying results with Count in [1 - 10 000]";
                    if ($range == "2_20")
                    {
                        $start = 0;
                        $end = 20000;
                        $oneData['onetitle'] = "Displaying results with Count in [1 - 20 000]";
                    } else if ($range == "2_30")
                    {
                        $start = 0;
                        $end = 50000;
                        $oneData['onetitle'] = "Displaying results with Count in [1 - 50 000]";
                    } else if ($range == "2_40")
                    {
                        $start = 0;
                        $end = 100000;
                        $oneData['onetitle'] = "Displaying results with Count in [1 - 100 000]";
                    } else if ($range == "2_50")
                    {
                        $start = 0;
                        $end = 200000;
                        $oneData['onetitle'] = "Displaying results with Count in [1 - 200 000]";
                    } else if ($range == "2_60")
                    {
                        $start = 0;
                        $end = 500000;
                        $oneData['onetitle'] = "Displaying results with Count in [1 - 500 000]";
                    } else if ($range == "2_70")
                    {
                        $start = 0;
                        $end = 1000000;
                        $oneData['onetitle'] = "Displaying results with Count in [1 - 1 000 000]";
                    } else if ($range == "2_80")
                    {
                        $start = 0;
                        $end = 2000000;
                        $oneData['onetitle'] = "Displaying results with Count in [1 - 2 000 000]";
                    } else if ($range == "2_90")
                    {
                        $start = 0;
                        $end = 5000000;
                        $oneData['onetitle'] = "Displaying results with Count in [1 - 5 000 000]";
                    } else if ($range == "2_100")
                    {
                        $start = 0;
                        $end = 10000000;
                        $oneData['onetitle'] = "Displaying results with Count in [1 - 10 000 000]";
                    } else if ($range == "2_110")
                    {
                        $start = 0;
                        $end = 20000000;
                        $oneData['onetitle'] = "Displaying results with Count in [1 - 20 000 000]";
                    } else if ($range == "2_120")
                    {
                        $start = 0;
                        $end = 50000000;
                        $oneData['onetitle'] = "Displaying results with Count in [1 - 50 000 000]";
                    } else if ($range == "2_130")
                    {
                        $start = 0;
                        $end = 100000000;
                        $oneData['onetitle'] = "Displaying results with Count in [1 - 100 000 000]";
                    } else if ($range == "2_140")
                    {
                        $start = 0;
                        $end = 200000000;
                        $oneData['onetitle'] = "Displaying results with Count in [1 - 200 000 000]";
                    } else if ($range == "2_150")
                    {
                        $start = 0;
                        $end = 500000000;
                        $oneData['onetitle'] = "Displaying results with Count in [1 - 500 000 000]";
                    } else if ($range == "2_160")
                    {
                        $start = 0;
                        $end = 999999999999999;
                        $oneData['onetitle'] = "Displaying results with Count in [1 - MAX]";
                    }
                    $sql = "SELECT * FROM hashtags WHERE vchHashTags LIKE '%".$oneHashtag."%' AND intPostCount >= " . $start . " AND intPostCount <= " . $end;
                    $hashtagData = $this->db->query($sql)->result();
                    $oneData['onedata'] = $hashtagData;
                    array_push($data, $oneData);
                } else if (intval($radioType) == 3)
                {
                    if ($range == "3_10")
                    {
                        $oneData = array();
                        $start = 0;
                        $end = 100;
                        $oneData['onetitle'] = "Displaying results with APPD in [1 - 100]";
                        $sql = "SELECT * FROM hashtags WHERE vchHashTags LIKE '%".$oneHashtag."%' AND intDAPC >= " . $start . " AND intDAPC < " . $end;
                        $hashtagData = $this->db->query($sql)->result();
                        $oneData['onedata'] = $hashtagData;
                        array_push($data, $oneData);
                        $start = 100;
                        $end = 500;
                        $oneData['onetitle'] = "Displaying results with APPD in [100 - 500]";
                        $sql = "SELECT * FROM hashtags WHERE vchHashTags LIKE '%".$oneHashtag."%' AND intDAPC >= " . $start . " AND intDAPC < " . $end;
                        $hashtagData = $this->db->query($sql)->result();
                        $oneData['onedata'] = $hashtagData;
                        array_push($data, $oneData);
                        $start = 500;
                        $end = 1000;
                        $oneData['onetitle'] = "Displaying results with APPD in [500 - 1 000]";
                        $sql = "SELECT * FROM hashtags WHERE vchHashTags LIKE '%".$oneHashtag."%' AND intDAPC >= " . $start . " AND intDAPC < " . $end;
                        $hashtagData = $this->db->query($sql)->result();
                        $oneData['onedata'] = $hashtagData;
                        array_push($data, $oneData);
                    } else if ($range == "3_20")
                    {
                        $oneData = array();
                        $start = 0;
                        $end = 500;
                        $oneData['onetitle'] = "Displaying results with APPD in [1 - 500]";
                        $sql = "SELECT * FROM hashtags WHERE vchHashTags LIKE '%".$oneHashtag."%' AND intDAPC >= " . $start . " AND intDAPC < " . $end;
                        $hashtagData = $this->db->query($sql)->result();
                        $oneData['onedata'] = $hashtagData;
                        array_push($data, $oneData);
                        $start = 500;
                        $end = 1000;
                        $oneData['onetitle'] = "Displaying results with APPD in [500 - 1 000]";
                        $sql = "SELECT * FROM hashtags WHERE vchHashTags LIKE '%".$oneHashtag."%' AND intDAPC >= " . $start . " AND intDAPC < " . $end;
                        $hashtagData = $this->db->query($sql)->result();
                        $oneData['onedata'] = $hashtagData;
                        array_push($data, $oneData);
                        $start = 1000;
                        $end = 2000;
                        $oneData['onetitle'] = "Displaying results with APPD in [1 000 - 2 000]";
                        $sql = "SELECT * FROM hashtags WHERE vchHashTags LIKE '%".$oneHashtag."%' AND intDAPC >= " . $start . " AND intDAPC < " . $end;
                        $hashtagData = $this->db->query($sql)->result();
                        $oneData['onedata'] = $hashtagData;
                        array_push($data, $oneData);
                    } else if ($range == "3_30")
                    {
                        $oneData = array();
                        $start = 0;
                        $end = 1000;
                        $oneData['onetitle'] = "Displaying results with APPD in [1 - 1 000]";
                        $sql = "SELECT * FROM hashtags WHERE vchHashTags LIKE '%".$oneHashtag."%' AND intDAPC >= " . $start . " AND intDAPC < " . $end;
                        $hashtagData = $this->db->query($sql)->result();
                        $oneData['onedata'] = $hashtagData;
                        array_push($data, $oneData);
                        $start = 1000;
                        $end = 5000;
                        $oneData['onetitle'] = "Displaying results with APPD in [1 000 - 5 000]";
                        $sql = "SELECT * FROM hashtags WHERE vchHashTags LIKE '%".$oneHashtag."%' AND intDAPC >= " . $start . " AND intDAPC < " . $end;
                        $hashtagData = $this->db->query($sql)->result();
                        $oneData['onedata'] = $hashtagData;
                        array_push($data, $oneData);
                        $start = 5000;
                        $end = 10000;
                        $oneData['onetitle'] = "Displaying results with APPD in [5 000 - 10 000]";
                        $sql = "SELECT * FROM hashtags WHERE vchHashTags LIKE '%".$oneHashtag."%' AND intDAPC >= " . $start . " AND intDAPC < " . $end;
                        $hashtagData = $this->db->query($sql)->result();
                        $oneData['onedata'] = $hashtagData;
                        array_push($data, $oneData);
                    }
                } else if (intval($radioType) == 4)
                {
                    if ($range == "4_10")
                    {
                        $oneData = array();
                        $start = 0;
                        $end = 10000;
                        $oneData['onetitle'] = "Displaying results with Count in [1 - 10K]";
                        $sql = "SELECT * FROM hashtags WHERE vchHashTags LIKE '%".$oneHashtag."%' AND intPostCount >= " . $start . " AND intPostCount < " . $end;
                        $hashtagData = $this->db->query($sql)->result();
                        $oneData['onedata'] = $hashtagData;
                        array_push($data, $oneData);
                        $start = 10000;
                        $end = 20000;
                        $oneData['onetitle'] = "Displaying results with Count in [10K - 20K]";
                        $sql = "SELECT * FROM hashtags WHERE vchHashTags LIKE '%".$oneHashtag."%' AND intPostCount >= " . $start . " AND intPostCount < " . $end;
                        $hashtagData = $this->db->query($sql)->result();
                        $oneData['onedata'] = $hashtagData;
                        array_push($data, $oneData);
                        $start = 20000;
                        $end = 50000;
                        $oneData['onetitle'] = "Displaying results with Count in [20K - 50K]";
                        $sql = "SELECT * FROM hashtags WHERE vchHashTags LIKE '%".$oneHashtag."%' AND intPostCount >= " . $start . " AND intPostCount < " . $end;
                        $hashtagData = $this->db->query($sql)->result();
                        $oneData['onedata'] = $hashtagData;
                        array_push($data, $oneData);
                    } else if ($range == "4_20")
                    {
                        $oneData = array();
                        $start = 0;
                        $end = 50000;
                        $oneData['onetitle'] = "Displaying results with Count in [1 - 50K]";
                        $sql = "SELECT * FROM hashtags WHERE vchHashTags LIKE '%".$oneHashtag."%' AND intPostCount >= " . $start . " AND intPostCount < " . $end;
                        $hashtagData = $this->db->query($sql)->result();
                        $oneData['onedata'] = $hashtagData;
                        array_push($data, $oneData);
                        $start = 50000;
                        $end = 100000;
                        $oneData['onetitle'] = "Displaying results with Count in [50K - 100K]";
                        $sql = "SELECT * FROM hashtags WHERE vchHashTags LIKE '%".$oneHashtag."%' AND intPostCount >= " . $start . " AND intPostCount < " . $end;
                        $hashtagData = $this->db->query($sql)->result();
                        $oneData['onedata'] = $hashtagData;
                        array_push($data, $oneData);
                        $start = 100000;
                        $end = 500000;
                        $oneData['onetitle'] = "Displaying results with Count in [100K - 500K]";
                        $sql = "SELECT * FROM hashtags WHERE vchHashTags LIKE '%".$oneHashtag."%' AND intPostCount >= " . $start . " AND intPostCount < " . $end;
                        $hashtagData = $this->db->query($sql)->result();
                        $oneData['onedata'] = $hashtagData;
                        array_push($data, $oneData);
                    } else if ($range == "4_30")
                    {
                        $oneData = array();
                        $start = 10000;
                        $end = 100000;
                        $oneData['onetitle'] = "Displaying results with Count in [10K - 100K]";
                        $sql = "SELECT * FROM hashtags WHERE vchHashTags LIKE '%".$oneHashtag."%' AND intPostCount >= " . $start . " AND intPostCount < " . $end;
                        $hashtagData = $this->db->query($sql)->result();
                        $oneData['onedata'] = $hashtagData;
                        array_push($data, $oneData);
                        $start = 100000;
                        $end = 500000;
                        $oneData['onetitle'] = "Displaying results with APPD in [100K - 500K]";
                        $sql = "SELECT * FROM hashtags WHERE vchHashTags LIKE '%".$oneHashtag."%' AND intPostCount >= " . $start . " AND intPostCount < " . $end;
                        $hashtagData = $this->db->query($sql)->result();
                        $oneData['onedata'] = $hashtagData;
                        array_push($data, $oneData);
                        $start = 500000;
                        $end = 1000000;
                        $oneData['onetitle'] = "Displaying results with Count in [500K - 1M]";
                        $sql = "SELECT * FROM hashtags WHERE vchHashTags LIKE '%".$oneHashtag."%' AND intPostCount >= " . $start . " AND intPostCount < " . $end;
                        $hashtagData = $this->db->query($sql)->result();
                        $oneData['onedata'] = $hashtagData;
                        array_push($data, $oneData);
                    } else if ($range == "4_40")
                    {
                        $oneData = array();
                        $start = 100000;
                        $end = 500000;
                        $oneData['onetitle'] = "Displaying results with Count in [100K - 500K]";
                        $sql = "SELECT * FROM hashtags WHERE vchHashTags LIKE '%".$oneHashtag."%' AND intPostCount >= " . $start . " AND intPostCount < " . $end;
                        $hashtagData = $this->db->query($sql)->result();
                        $oneData['onedata'] = $hashtagData;
                        array_push($data, $oneData);
                        $start = 500000;
                        $end = 1000000;
                        $oneData['onetitle'] = "Displaying results with Count in [500K - 1M]";
                        $sql = "SELECT * FROM hashtags WHERE vchHashTags LIKE '%".$oneHashtag."%' AND intPostCount >= " . $start . " AND intPostCount < " . $end;
                        $hashtagData = $this->db->query($sql)->result();
                        $oneData['onedata'] = $hashtagData;
                        array_push($data, $oneData);
                        $start = 1000000;
                        $end = 5000000;
                        $oneData['onetitle'] = "Displaying results with Count in [1M - 5M]";
                        $sql = "SELECT * FROM hashtags WHERE vchHashTags LIKE '%".$oneHashtag."%' AND intPostCount >= " . $start . " AND intPostCount < " . $end;
                        $hashtagData = $this->db->query($sql)->result();
                        $oneData['onedata'] = $hashtagData;
                        array_push($data, $oneData);
                    }
                }
                $oneTotal['data'] = $data;
                array_push($total, $oneTotal);
            }
            $this->load->view('header');
            $this->load->view('search', compact('page_root', 'page_title', 'hashtags', 'average', 'radioType', 'range', 'total', 'nohashtags', 'noscanhashtags'));
            $this->load->view('footer');
        }
    }
    public function detail($hash_id)
    {
        $remain = $this->Admin_model->getAccountRemain();
        if ($remain < 1)
        {
            redirect(base_url()."account", 'auto');
            return;
        }
        $page_root = 'HOME > Search';
        $page_title = 'Search';
        $sql = "SELECT a.*, b.vchHashTags FROM hashtags_log AS a
                LEFT JOIN hashtags AS b ON a.intHashTagID = b.intID
                WHERE intHashTagID = " . $hash_id . " ORDER BY dt_Date DESC LIMIT 7";
        $rows = $this->db->query($sql)->result();
        $this->load->view('header');
        $this->load->view('detail', compact('page_root', 'page_title', 'rows'));
        $this->load->view('footer');
    }
}
