<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

/////////////////// the buy form file //////////////////
<div class="container">

    <div class="starter-template">
        <h1>PayPal Payment</h1>
        <p class="lead">Pay Now</p>
    </div>

    <div class="contact-form">

        <p class="notice error"><?= $this->session->flashdata('error_msg') ?></p><br/>
        <p class="notice error"><?= $this->session->flashdata('success_msg') ?></p><br/>

        <form method="post" class="form-horizontal" role="form" action="<?= base_url() ?>paypal/create_payment_with_paypal">
            <fieldset>
                <input title="item_name" name="item_name" type="hidden" value="ahmed fakhr">
                <input title="item_number" name="item_number" type="hidden" value="12345">
                <input title="item_description" name="item_description" type="hidden" value="to buy samsung smart tv">
                <input title="item_tax" name="item_tax" type="hidden" value="1">
                <input title="item_price" name="item_price" type="hidden" value="9.99">
                <input title="details_tax" name="details_tax" type="hidden" value="9.99">
                <input title="details_subtotal" name="details_subtotal" type="hidden" value="9.99">

                <div class="form-group">
                    <div class="col-sm-offset-5">
                        <button  type="submit"  class="btn btn-success">Pay Now</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div><!-- /.container -->