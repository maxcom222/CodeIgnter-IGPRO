<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Paypal_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /* This function create new Service. */

//    function create($Total,$SubTotal,$Tax,$PaymentMethod,$PayerStatus,$PayerMail,$saleId,$CreateTime,$UpdateTime,$State) {
//        $this->db->set('txn_id',$saleId);
//        $this->db->set('PaymentMethod',$PaymentMethod);
//        $this->db->set('PayerStatus',$PayerStatus);
//        $this->db->set('PayerMail',$PayerMail);
//        $this->db->set('Total',$Total);
//        $this->db->set('SubTotal',$SubTotal);
//        $this->db->set('Tax',$Tax);
//        $this->db->set('Payment_state',$State);
//        $this->db->set('CreateTime',$CreateTime);
//        $this->db->set('UpdateTime',$UpdateTime);
//        $this->db->insert('payments');
//        $id = $this->db->insert_id();
//        return $id;
//    }
    function create($userid, $username, $useremail, $PayerMail, $item_name, $item_number, $item_price, $item_currency
                , $Total, $currency, $saleId, $State, $date, $CreateTime, $UpdateTime) {
        $this->db->set('user_id',$userid);
        $this->db->set('name',$username);
        $this->db->set('email',$useremail);
        $this->db->set('sender_email',$PayerMail);
        $this->db->set('item_name',strtoupper($item_name));
        $this->db->set('item_number',$item_number);
        $this->db->set('item_price',$item_price);
        $this->db->set('item_price_currency',$item_currency);
        $this->db->set('paid_amount',$Total);
        $this->db->set('paid_amount_currency',$currency);
        $this->db->set('txn_id', $saleId);
        $this->db->set('payment_status', $State);
        $this->db->set('dt_expirydate', $date);
        $this->db->set('created', $CreateTime);
        $this->db->set('modified', $UpdateTime);
        $this->db->insert('orders');
        $id = $this->db->insert_id();
        return $id;
    }

}