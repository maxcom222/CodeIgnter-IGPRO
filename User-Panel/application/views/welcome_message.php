<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style type="text/css">
        .card-body {
            text-align: left;
        }

        .quick-start h5, .quick-start p {
            line-height: 1.3;
        }

        .quick-start p {
            margin-bottom: 20px;
        }

        .card-body i {
            color: #fff;
            width: 50px;
            height: 50px;
            border-radius: 5px;
            text-align: center;
            padding: 17px 0;
            font-size: 18px;
            text-shadow: 0 6px 8px rgba(62, 57, 107, 0.18);
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>

<?php include("page-title.php") ?>

<?php if(isset($paid) && $paid == 1){
    ?>
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="alert alert-fill-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" style="color: white">×</span>
                </button>
                <h3 class="mt-1">Successful!</h3><h4 class="mt-1">Enjoy unlimited access to all of Hashtastic's features</h4>
            </div>
        </div>
    </div>
<?php }
?>
<div class="row">
    <div class="col-md-6 col-lg-4 grid-margin stretch-card">
        <div class="card bg-gradient-primary text-white text-center card-shadow-primary">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="font-weight-bold mb-10">Account Plan : <?=$plan_name?></h5>
                        <h4 class="mb-10"><?=$remain?> Days Remaining</h4>
                        <h5 class="mb-0">Expires on <?=$dt_expire?></h5>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-star" style="background: #675DFA;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 grid-margin stretch-card">
        <div class="card bg-gradient-danger text-white text-center card-shadow-danger">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="font-weight-bold mb-10">Registered Users</h5>
                        <h3 class="mb-10"><?=number_format($cntUser)?></h3>
                        <h6 class="mb-0"><strong>Earn money</strong> by referring your friends!</h6>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-user" style="background: #FB8C99;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 grid-margin stretch-card">
        <div class="card bg-gradient-warning text-white text-center card-shadow-warning">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="font-weight-bold">Hashtags Scanned Today</h5>
                        <h3 class="mb-10" style="margin-bottom: 20px"><?=number_format($cntScanHash)?> /<?=number_format($cntHash)?></h3>
                        <div class="progress progress-md">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: <?=$scanPregress?>%" aria-valuenow="<?=100;//$scanPregress?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-hashtag" style="background: #FFB64D;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" style="min-height: 600px">
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card quick-start">
            <div class="card-body">
                <h4 class="card-title">MENU</h4>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <h5>Search</h5>
                        <p>Get right into your <a href="<?=base_url()?>search">search!</a> <!-- This tool provided you with information on <a href="javascript:;" data-toggle="tooltip" data-placement="top" data-custom-class="tooltip-info" title='Also known as "DAPC (Daily Average Post Count)", Daily Posts are a measure of how popular a Hashtag is, and how many people use it every day. The lower the DAPC, the lower your competition, and the higher your chances of ranking on that Hashtag!'><strong>Daily Posts</strong></a> , <a href="javascript:;" data-toggle="tooltip" data-placement="top" data-custom-class="tooltip-info" title="This gives you an indication of how many average likes posts usually get on that Hashtag. If you usually get more likes on your posts than the Average Likes, that means you can easily rank on that Hashtag!"><strong>Average number of likes per hour</strong></a> , and a bunch more useful metrics for you to start ranking on Hashtags! --></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <h5>Mass Search</h5>
                        <p>Need to search in <a href="<?=base_url()?>mass">mass search?</a> This option is for you.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <h5>My Hashtags</h5>
                        <p>View your custom <a href="javascript:;">hashtag</a> sets.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <h5>Viral Social Posts  <label class="badge bg-gradient-warning">Coming Soon!</label></h5>
                        <p>Need inspiration for your next posts? we've got you (analytically) covered.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <h5>Source Finder  <label class="badge bg-gradient-warning">Coming Soon!</label></h5>
                        <p>Find users who have the audience you need to grow, they call it social media for a reason!</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <h5>Analytics  <label class="badge bg-gradient-warning">Coming Soon!</label></h5>
                        <p>View your audience growth, and your competitors with a simple search.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card quick-start">
            <div class="card-body">
                <h4 class="card-title">Tips/FAQ'S</h4>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <h5>How does IGPRO function?</h5>
                        <p>IGPRO in real-time is <B>the</B> tool designed for Instagrammers, by instagrammers to
                            help you with (you guessed it) your instagram game.
                            <br><br>Whether itʼs marketing,
                            growing or client satisfaction, we know that hashtags, quality content,
                            engagement, analytics AND consistency are essential for success.. which is
                            exactly why we have created the perfect set of tools for it.<br><br>
                            Our intuitive Hashtag Tool works by scanning an ever-expanding list of
                            hashtags <B>every single day</B>. <br><br>If your Search returns no results, IGPRO will then
                            log your Hashtag, search the web for hundreds of relevant hashtags, and add
                            them to the database within 24 hours.
                            <br><br>
                            This means that within 24 hours your hashtag (and relevant tags) will be
                            available on the engine for you forever.
                            <br><br>
                            Have feature requests? Let us know <a href="javascript:;">here</a>.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <h5>Whatʼs the right way to get more reach?</h5>
                        <p>The quickest way to gain more reach for your content is to find the most <a href="javascript:;" data-toggle="tooltip"
                                                                                                       data-custom-class="tooltip-info" data-placement="top" title="For instance, when using hashtags if
                            you were going on a vacation… and use the hashtag #vacation as opposed to
                            using #vacationvibes, oneʼs been used on 30 Million posts and the other
                            20,000, (did we forget to mention theyʼre both being used the same amount of
                            times per day?) theyʼre both just as popular as each other, however itʼs obvious
                            which one has less competition."><B>High-Performing Hashtags</B></a>.
                            <br><br>Go on over to the <a href="<?=base_url()?>search">search</a> tool and find them
                            now! </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <h5>Have questions?</h5>
                        <p>Common questions have a simple solution on the <a href="javascript:;">FAQʼs</a>
                            page, however if you canʼt find what youʼre looking for, hit up the <a href="javascript:;">Support</a>
                            tab and weʼll get back to you ASAP!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>