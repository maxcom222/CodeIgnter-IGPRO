<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'libraries/PayPal-PHP-SDK/autoload.php'); // require paypal files
use PayPal\Api\ItemList;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\OpenIdTokeninfo;
use PayPal\Api\OpenIdUserinfo;

class Paypal extends CI_Controller
{
    public $_api_context;

    function  __construct()
    {
        parent::__construct();
        $this->load->model('Paypal_model');
        // paypal credentials
        $this->config->load('paypal');

        $this->_api_context = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                $this->config->item('client_id'), $this->config->item('secret')
            )
        );
    }

    function index(){
        $this->load->view('buy_form');
    }


    function create_payment_with_paypal()
    {
        // setup PayPal api context
        $this->_api_context->setConfig($this->config->item('settings'));
// ### Payer
// A resource representing a Payer that funds a payment
// For direct credit card payments, set payment method
// to 'credit_card' and add an array of funding instruments.
        $payer['payment_method'] = 'paypal';
// ### Itemized information
// (Optional) Lets you specify item wise
// information
        $item1["name"] = $this->input->post('item_name');
        $item1["sku"] = $this->input->post('item_number');  // Similar to `item_number` in Classic API
        $item1["description"] = $this->input->post('item_description');
        $item1["currency"] ="USD";
        $item1["quantity"] =1;
        $item1["price"] = $this->input->post('item_price');
        $itemList = new ItemList();
        $itemList->setItems(array($item1));
// ### Additional payment details
// Use this optional field to set additional
// payment information such as tax, shipping
// charges etc.
//        $details['tax'] = $this->input->post('details_tax');
//        $details['subtotal'] = $this->input->post('details_subtotal');
// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
        $amount['currency'] = "USD";
        $amount['total'] = $this->input->post('item_price');
//        $amount['total'] = $details['tax'] + $details['subtotal'];
//        $amount['details'] = $details;
// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it.
        $transaction['description'] ='Payment description';
        $transaction['amount'] = $amount;
        $transaction['invoice_number'] = uniqid();
        $transaction['item_list'] = $itemList;
        // ### Redirect urls
// Set the urls that the buyer must be redirected to after
// payment approval/ cancellation.
        $baseUrl = base_url();
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($baseUrl."PayPal/getPaymentStatus")
            ->setCancelUrl($baseUrl."PayPal/getPaymentStatus");
// ### Payment
// A Payment Resource; create one using
// the above types and intent set to sale 'sale'
        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
        try {
            $payment->create($this->_api_context);
        } catch (Exception $ex) {
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
            echo "<HTML><BODY><pre>";
            echo $ex;
            echo "</pre></BODY></HTML>";
            exit(1);
        }
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        if(isset($redirect_url)) {
            /** redirect to paypal **/
            redirect($redirect_url);
        }
        $this->session->set_flashdata('success_msg','Unknown error occurred');
        redirect('PayPal/index');
    }


    public function getPaymentStatus()
    {

        // paypal credentials

        /** Get the payment ID before session clear **/
        $payment_id = $this->input->get("paymentId") ;
        $PayerID = $this->input->get("PayerID") ;
        $token = $this->input->get("token") ;
        /** clear the session payment ID **/

        if (empty($PayerID) || empty($token)) {
            $this->session->set_flashdata('success_msg','Payment failed');
            redirect('PayPal/index');
        }

        $payment = Payment::get($payment_id,$this->_api_context);


        /** PaymentExecution object includes information necessary **/
        /** to execute a PayPal account payment. **/
        /** The payer_id is added to the request query parameters **/
        /** when the user is redirected from paypal back to your site **/
        $execution = new PaymentExecution();
        $execution->setPayerId($this->input->get('PayerID'));

        /**Execute the payment **/
        $result = $payment->execute($execution,$this->_api_context);



        //  DEBUG RESULT, remove it later **/
        if ($result->getState() == 'approved') {
            $trans = $result->getTransactions();

            // item info
            $Subtotal = $trans[0]->getAmount()->getDetails()->getSubtotal();
            $Tax = $trans[0]->getAmount()->getDetails()->getTax();
            $item_number = $trans[0]->getItemList()->getItems()[0]->getSku();
            $item_name = $trans[0]->getItemList()->getItems()[0]->getName();
            $item_price = $trans[0]->getItemList()->getItems()[0]->getPrice();
            $item_currency = $trans[0]->getItemList()->getItems()[0]->getCurrency();
            $payer = $result->getPayer();
            $username = $this->Admin_model->getUserInfo($this->session->userdata("user_id"))->user_name;
            $useremail = $this->Admin_model->getUserInfo($this->session->userdata("user_id"))->user_email;
            // payer info //
            $PaymentMethod =$payer->getPaymentMethod();
            $PayerStatus =$payer->getStatus();
            $PayerMail =$payer->getPayerInfo()->getEmail();

            $relatedResources = $trans[0]->getRelatedResources();
            $sale = $relatedResources[0]->getSale();
            // sale info //
            $saleId = $sale->getId();
            $CreateTime = $sale->getCreateTime();
            $UpdateTime = $sale->getUpdateTime();
            $State = $sale->getState();
            $Total = $sale->getAmount()->getTotal();
            $currency = $sale->getAmount()->getCurrency();
            $sql = "SELECT MAX(dt_expirydate) expire_dt FROM orders WHERE user_id = " . $this->session->userdata("user_id");
            $query = $this->db->query($sql);
            $olddate = '';
            if ($query->num_rows() > 0)
            {
                $olddate = $query->row()->expire_dt;
                if ($olddate != '' && date_create($olddate) >= date_create($CreateTime))
                {
                    $CreateTime = $olddate;
                }
            }
            $day_num = 4;
            if ($item_number == 2) $day_num = 30;
            if ($item_number == 3) $day_num = 180;
            if ($item_number == 4) $day_num = 360;

            $date = date_create($CreateTime);
            date_add($date, date_interval_create_from_date_string($day_num . ' days'));
            $expire_time = date_format($date, 'Y-m-d h:i:s');
            /** it's all right **/
            /** Here Write your database logic like that insert record or value in database if you want **/
            $this->Paypal_model->create($this->session->userdata("user_id"), $username, $useremail, $PayerMail, $item_name, $item_number, $item_price, $item_currency
                , $Total, $currency, $saleId, $State, $expire_time, $CreateTime, $UpdateTime);
//            $this->Paypal_model->create($Total,$Subtotal,$Tax,$PaymentMethod,$PayerStatus,$PayerMail,$saleId,$CreateTime,$UpdateTime,$State);
            $this->session->set_flashdata('success_msg','Payment success');
            redirect(base_url().'paypalsuccess');
        }
        $this->session->set_flashdata('success_msg','Payment failed');
        redirect('base_url().paypalcancel');
    }
    function success(){
        //$this->load->view("success");
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
                $plan_name = $query[sizeof($query) - 1]->item_name;
                $dt_expire = $query[sizeof($query) - 1]->dt_expire;
                $remain = $query[sizeof($query) - 1]->remain;
            }else{
                $plan_name = "NONE";
                $dt_expire = "NONE";
                $remain = "0";
            }
            $paid = 1;
            $this->load->view('header');
            $this->load->view('welcome_message', compact('page_root', 'page_title', 'cntHash', 'scanPregress', 'cntScanHash', 'cntUser', 'plan_name', 'dt_expire', 'remain', 'paid'));
            $this->load->view('footer');
        }
    }
    function cancel(){
        //$this->Paypal_model->create_payment();
        $this->load->view("cancel");
    }

    function free(){
        if ($this->input->post('item_name') == "free")
        {
            $chFree = 1;
            $sql = "SELECT * FROM users WHERE user_id = " . $this->session->userdata("user_id");
            $query = $this->db->query($sql)->result();
            $name = $query[0]->user_name;
            $email = $query[0]->user_email;
            $ip = $query[0]->ip;
            $sql = "SELECT * FROM orders WHERE item_name='FREE' AND user_id = " . $this->session->userdata("user_id");
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0)
            {
                $chFree = 2;
            }

            $sql = "SELECT * FROM orders WHERE item_name='FREE' AND user_id IN (SELECT user_id FROM users WHERE ip = '" . $ip . "')";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0)
            {
                $chFree = 2;
            }
            if ($chFree == 2) {
                $page_root = 'HOME > Account Plan';
                $page_title = 'Account Plan';
                $imagePath = "assets/images/users/user_" . $this->session->userdata("user_id") . ".jpg";
                if (!file_exists($imagePath))
                    $imagePath = "assets/images/users/user.png";
                $errormsg = "You have signed up with free, please contact support!";
                $chFree = 1;
                $this->load->view('header');
                $this->load->view('account', compact('page_root', 'page_title', 'chFree', 'errormsg'));
                $this->load->view('footer');
                return;
            }
        }
        $item_number = "1";
        $item_name = "FREE";
        $item_price = "0.00";
        $item_currency = "USD";
        $username = $this->Admin_model->getUserInfo($this->session->userdata("user_id"))->user_name;
        $useremail = $this->Admin_model->getUserInfo($this->session->userdata("user_id"))->user_email;
        $PayerMail = $useremail;

        $saleId = "";
        $CreateTime = date('Y-m-d h:i:s');
        $UpdateTime = $CreateTime;
        $State = "completed";
        $Total = "0.00";
        $currency = "USD";
        $sql = "SELECT MAX(dt_expirydate) expire_dt FROM orders WHERE user_id = " . $this->session->userdata("user_id");
        $query = $this->db->query($sql);
        $olddate = '';
        if ($query->num_rows() > 0)
        {
            $olddate = $query->row()->expire_dt;
            if ($olddate != '' && date_create($olddate) >= date_create($CreateTime))
            {
                $CreateTime = $olddate;
            }
        }
        $day_num = 4;
        $date = date_create($CreateTime);
        date_add($date, date_interval_create_from_date_string($day_num . ' days'));
        $expire_time = date_format($date, 'Y-m-d h:i:s');
        /** it's all right **/
        /** Here Write your database logic like that insert record or value in database if you want **/
        $this->Paypal_model->create($this->session->userdata("user_id"), $username, $useremail, $PayerMail, $item_name, $item_number, $item_price, $item_currency
            , $Total, $currency, $saleId, $State, $expire_time, $CreateTime, $UpdateTime);
        $this->session->set_flashdata('success_msg','Payment success');
        redirect(base_url().'paypalsuccess');
    }
}