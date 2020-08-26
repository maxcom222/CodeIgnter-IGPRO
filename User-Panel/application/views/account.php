<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
        /*@media (min-width: 1035px) {*/
        /*    .col-md-3 {*/
        /*        flex: 0 0 25%;*/
        /*        max-width: 25%;*/
        /*    }*/
        /*}*/
        /*@media (min-width: 850px) and (max-width: 1034px) {*/
        /*    .col-md-3 {*/
        /*        flex: 0 0 33.333333%;*/
        /*        max-width: 33.333333%;*/
        /*    }*/
        /*}*/
        /*@media (min-width: 600px) and (max-width: 850px) {*/
        /*    .col-md-3 {*/
        /*        flex: 0 0 50%;*/
        /*        max-width: 50%;*/
        /*    }*/
        /*}*/
        /*@media (max-width: 600px) {*/
        /*    .col-md-3 {*/
        /*        flex: 0 0 100%;*/
        /*        max-width: 100%;*/
        /*    }*/
        /*}*/
    </style>
</head>
<?php if(isset($errormsg)){
    ?>
    <div class="alert alert-fill-warning" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" style="color: white">×</span>
        </button>
        <i class="mdi mdi-alert-circle"></i>
        Warning! Already you have used free version. That can use only once.
    </div>
<?php }
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center">
<!--                <div class="container text-center pt-5">-->
                    <h4 class="mb-3 mt-5">Enjoy unlimited access to all of IGPRO features</h4>
                    <p class="w-75 mx-auto mb-5">Stop wasting time trying to find hashtags that kind of work, and let Hashtastic do the math for you.
                        Every time.
                    </p>
                    <div class="row pricing-table">
                        <div class="col-md-3 col-sm-6 grid-margin stretch-card pricing-card" style="min-width: 240px">
                            <div class="card border-primary border pricing-card-body">
                                <div class="text-center pricing-card-head">
                                    <h2 style="height: 63px">Free</h2>
                                    <h2 class="font-weight-normal mb-4">$0.00</h2>
                                </div>
                                <div class="text-center mb-0 text-gray" style="height: 75px;">
                                    <p>This is the package for you. You can use this only once.</p>
                                </div>
                                <ul class="list-unstyled plan-features">
                                    <li style="height: 58px" class="text-center">Unlimited access : <B>Yes</B></li>
                                    <li style="height: 58px" class="text-center">Viral Media : <B>No</B></li>
                                    <li style="height: 58px" class="text-center">Duration : <B>4 Days</B></li>
                                </ul>
                                <form method="post" class="form-horizontal" role="form" action="<?= base_url() ?>paypalfree">
                                    <input title="item_name" name="item_name" type="hidden" value="free">
                                    <input title="item_number" name="item_number" type="hidden" value="1">
                                    <input title="item_description" name="item_description" type="hidden" value="Hashtastic Subscription">
                                    <input title="item_price" name="item_price" type="hidden" value="0.00">
                                    <div class="wrapper">
                                        <button type="submit" class="btn btn-outline-primary btn-block">Start</button>
                                        <p class="mt-3 mb-0 plan-cost text-gray">Free</p>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 grid-margin stretch-card pricing-card" style="min-width: 240px">
                            <div class="card border-primary border pricing-card-body">
                                <div class="text-center pricing-card-head">
                                    <h2 style="height: 63px">Basic</h2>
                                    <h2 class="font-weight-normal mb-4">$9.99</h2>
                                </div>
                                <div class="text-center mb-0 text-gray" style="height: 75px;">
                                    <p>Feel like trying the service out? This is the package for you.</p>
                                </div>
                                <ul class="list-unstyled plan-features">
                                    <li style="height: 58px" class="text-center">Unlimited access : <B>Yes</B></li>
                                    <li style="height: 58px" class="text-center">Viral Media : <B>Yes</B></li>
                                    <li style="height: 58px" class="text-center">Duration : <B>30 Days</B></li>
                                </ul>
                                <form method="post" class="form-horizontal" role="form" action="<?= base_url() ?>PayPal/create_payment_with_paypal">
                                    <input title="item_name" name="item_name" type="hidden" value="basic">
                                    <input title="item_number" name="item_number" type="hidden" value="2">
                                    <input title="item_description" name="item_description" type="hidden" value="Hashtastic Subscription">
                                    <input title="item_price" name="item_price" type="hidden" value="9.99">
                                    <div class="wrapper">
                                        <button type="submit" class="btn btn-outline-primary btn-block">Buy Now</button>
                                        <p class="mt-3 mb-0 plan-cost text-gray">Basic</p>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 grid-margin stretch-card pricing-card" style="min-width: 240px">
                            <div class="card border border-success pricing-card-body">
                                <div class="text-center pricing-card-head">
                                    <h2 style="height: 63px" class="text-success">Pro</h2>
                                    <h2 class="font-weight-normal text-success mb-4">$49.95</h2>
                                </div>
                                <div class="text-center mb-0 text-gray" style="height: 75px;">
                                    <p>Want to get serious with Instagram growth? Go PRO.</p>
                                </div>
                                <ul class="list-unstyled plan-features">
                                    <li style="height: 58px" class="text-center">Unlimited access : <B>Yes</B></li>
                                    <li style="height: 58px" class="text-center">Viral Media : <B>Yes</B></li>
                                    <li style="height: 58px" class="text-center">Duration : <B>180 Days</B></li>
                                </ul>
                                <form method="post" class="form-horizontal" role="form" action="<?= base_url() ?>PayPal/create_payment_with_paypal">
                                    <input title="item_name" name="item_name" type="hidden" value="pro">
                                    <input title="item_number" name="item_number" type="hidden" value="3">
                                    <input title="item_description" name="item_description" type="hidden" value="Hashtastic Subscription">
                                    <input title="item_price" name="item_price" type="hidden" value="49.95">
                                    <div class="wrapper">
                                        <button type="submit" class="btn btn-success btn-block">Buy Now</button>
                                        <p class="mt-3 mb-0 plan-cost text-success">Professoinal</p>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 grid-margin stretch-card pricing-card" style="min-width: 240px">
                            <div class="card border border-primary pricing-card-body">
                                <div class="text-center pricing-card-head">
                                    <h2 style="height: 63px">Premium</h2>
                                    <h2 class="font-weight-normal mb-4">$89.95</h2>
                                </div>
                                <div class="text-center mb-0 text-gray" style="height: 75px;">
                                    <p>For the ultimate Instagram Killers. LET'S GET IT.</p>
                                </div>
                                <ul class="list-unstyled plan-features">
                                    <li style="height: 58px" class="text-center">Unlimited access : <B>Yes</B></li>
                                    <li style="height: 58px" class="text-center">Viral Media : <B>Yes</B></li>
                                    <li style="height: 58px" class="text-center">Duration : <B>365 Days</B></li>
                                </ul>
                                <form method="post" class="form-horizontal" role="form" action="<?= base_url() ?>PayPal/create_payment_with_paypal">
                                    <input title="item_name" name="item_name" type="hidden" value="premium">
                                    <input title="item_number" name="item_number" type="hidden" value="4">
                                    <input title="item_description" name="item_description" type="hidden" value="Hashtastic Subscription">
                                    <input title="item_price" name="item_price" type="hidden" value="89.95">
                                    <div class="wrapper">
                                        <button type="submit" class="btn btn btn-outline-primary btn-block">Buy Now</button>
                                        <p class="mt-3 mb-0 plan-cost text-gray">Premium</p>
                                    </div>
                                </form>
                            </div>
                        </div>
<!--                    </div>-->
                </div>
            </div>
        </div>
    </div>
</div>