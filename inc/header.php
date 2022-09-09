<?php

ob_start();

session_start();

$issingle =0;

$engine = array();

$engines = $core -> getEngines($engine);

$titlee = $core -> getEngines(array("page"=>"info".$plang))[0];

$title = $titlee["title"];

$str = $titlee["title"];

$alt = $titlee["title"];

$alt_ar = "";

$description =  $titlee["description"];

$keywords = $titlee["keywords"] ;

$name = pathinfo(basename($_SERVER["PHP_SELF"]))["filename"];

$exname = pathinfo(basename($_SERVER["PHP_SELF"]))["extension"];

if(is_array(@$engines)) {

foreach($engines as $engine) {

//if(basename($_SERVER["PHP_SELF"]).($_SERVER["QUERY_STRING"] ? "?" . $_SERVER["QUERY_STRING"] : "" ) == $engine["page"]) {

if($name.".php" == $engine["page"]) {

$exDescription = $engine["description"];

$exKeywords = $engine["keywords"];

$exTitle = $engine["title"];



$id = isv("id");

if(!$id)

$id = isv("level");

$exTitle = $engine["title"];

if($id){

$array = array("id"=>$id);

$exTitle = (strpos($name,"news")?$core->getevents($array)[0]["name".$clang]:(strpos($name,"services") && $core->getservices($array)[0]["name".$clang]?$core->getservices($array)[0]["name".$clang]:(strpos($name,"products") || $pagg == 3 ?$core->getproducts($array)[0]["name".$clang]:$core->getprojects($array)[0]["name".$clang]))) ;

if(!$exTitle)

$exTitle = $engine["title"];

}

$pageTitle = $exTitle;



}

}

}

if(@$exTitle) $title = $exTitle  . " | $str";

if(@$exDescription) $description = $exDescription . " | $description";

if(@$exKeywords) $keywords = $keywords . "," . $exKeywords;

?>

<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="Description" content="<?=$description?>" />

        <title><?=$title?></title>

        <meta name="keywords" content="<?=$keywords?>" />

    <!-- Favicon -->

    <link rel="icon" href="images/Icons-11.png" type="image/x-icon" />

    <!-- Bootstrap CSS -->

    <link href="css/lib.css" rel="stylesheet">

    <!-- Animate CSS -->

    <link href="vendors/animate/animate.css" rel="stylesheet">

    <!-- Icon CSS-->

    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- Camera Slider -->



    <link rel="stylesheet" href="vendors/camera-slider/camera.css">

    <!-- Owlcarousel CSS-->

    <link rel="stylesheet" type="text/css" href="vendors/owl_carousel/owl.carousel.css" media="all">



    <!--Theme Styles CSS-->

    <link rel="stylesheet" type="text/css" href="css/style.css" media="all" />

    <link href="css/lightbox.min.css" rel="stylesheet">

     <style type="text/css">

     #myCarousel h2 {

    text-align:  center;

        font-size: 20px;

    }

    .footer-ul {

    color: #fff;

    }

    .hide{

        display: none !important;

    }

   .message_row.about_row h2 {

    text-align: right !important;

}

.it-ser.col-md-3 {

    float: right;

}

.grecaptcha-badge {

    display: none;

}
 .header_aera .navbar-collapse .navbar-nav.navbar-right li a:hover, .header_aera .navbar-collapse .navbar-nav.navbar-right li a:focus {
    color: #f2b662;
    background: transparent;
}
#myCarousel h1 {
    color: #ffff;
    }
    .almond-clients img {
    width: 80%;
    height: 80%;
    }
    .footer-ul {
    color: #acb3b3;
}
    <?php if($pagg == 3){ ?>

    #myCarousel.carousel .item,.carousel-inner,#myCarousel{

            height: 600px;

    }

   #myCarousel > div:nth-child(2) > section > div:nth-child(1) > img{
       filter: brightness(0.9) invert(.7) sepia(.5) hue-rotate(100deg) saturate(200%);

   }


    <?php } if($pagg != 1 && $pagg != 6 ){ ?>
    body p {
    color: #222222;
    }
    <?php } if($pagg != 1 && $pagg != 2 && !isv("level")){ ?>

    .header_aera {

    position: relative;

    }

    .it-ser a {

    color: #fff;

    }

    section.our_services_area {

    margin-top: 20px;

}

.it-ser.col-md-3:hover a {

    color: #f2b662;

}

    <?php } ?>

#myCarousel > div.containera > section.award-opa.mar-head > p:nth-child(4) > a{

    float: left;

}

     <?php if(!$plang){ ?>

     @FONT-FACE {

    font-family: "arabic";

    src: url("fonts/open.woff2");

}

#myCarousel > div.containera > section.award-opa.mar-head > p:nth-child(4) > a{

    float: right;

}

     body{

         direction: ltr !important;

     }

    .footer-bottom > div, .footer-top > div,.it-ser.col-md-3 {

    float: left;

}

.content-copy > div {

    float: left;

    text-align: left;

}

.social i{

     float: right;

}
@media (max-width: 767px) {

.our_services_area .portfolio_inner_area .portfolio_filter ul li {
float: left;
}



   .count-box {

text-align: center !important;
padding-left: 0 !important;

}
}

   .count-box {

    text-align: left;

    float: left;

    padding-left: 60px;

    padding-right: unset;

}

.footer-ul {

    border-left: 1px solid #3C3B3C;

    text-align: left;

    padding-left: 30px;

    border-right: none;

}

.about_us_area .about_row h3 {

    border-right: 1px solid #3C3B3C;

    border-left: none;

}

.who_we_area.col-md-8.col-sm-7 {

    float: right;

}

.header_aera .navbar-collapse .navbar-nav.navbar-right li a {

    padding-right: 22px;

        padding-left: unset;

    }

.del-os:last-child {

    padding-left: 55px;

        padding-right: unset;

    }

.del-os {

    float: left;

}

.lab-l,.effect-16 ~ label{

    border-left: none;

    padding-left: unset;

        border-right: 1px solid;

    padding-right: 15px;

}



.lab-l,.effect-16 ~ label {

    left: 15px;

    right: auto;

    }

.select-selected:after {

    right: 20px;

    left: auto;

    }

.head-wed {

    text-transform: capitalize;

    }

.around-ms .img {

    float: left;

    }

.around-ms .txt {

    float: right;

    }

.navbar-default .navbar-nav li {

    text-align: left;

    float: left;

}

.footer-bottom > div ,.award-op p{

    text-align: left;

}

.about_us_area .about_row p{

    direction: ltr;

}

 .message_row.about_row h2 {

    text-align: left !important;

}

.use-links li {

    text-align: left;

    float: left;

    }

.head-wed.out {

    left: 0;

    right: auto;

    }

footer .newletter label {

    color: #f2b662;

    border-right: 1px solid #f2b662;

    border-left: none;

    float: left;

    margin-left: 0px;

    margin-right: 10px;

    }

@media (max-width: 767px){


.select-selected {
text-align: right;

}




.navbar-default .navbar-nav li {

    float: none;

    }

   .del-os:last-child {

    padding-left: 15px;

    }

    .content-copy > div {

    float: none;

    text-align: center;

}

.footer-bottom > div, .footer-top > div, .it-ser.col-md-3 {

    float: none;

}


.ccont-xo p.add-xo {
direction: ltr;
}



.del-os:last-child {

border-left: 1px solid #3C3B3C;
}


}



      <?php } ?>

      /*custom font*/

@import url(https://fonts.googleapis.com/css?family=Montserrat);





/*form styles*/

#msform {

    text-align: center;

    position: relative;

    margin-top: 30px;

}



/*Hide all except first fieldset*/

#msform fieldset:not(:first-of-type) {

    display: none;

}





/*headings*/

.fs-title {

    font-size: 18px;

    text-transform: uppercase;

    color: #2C3E50;

    margin-bottom: 10px;

    letter-spacing: 2px;

    font-weight: bold;

}



.fs-subtitle {

    font-weight: normal;

    font-size: 13px;

    color: #666;

    margin-bottom: 20px;

}



/*progressbar*/

#progressbar {

    margin-bottom: 30px;

    overflow: hidden;

    /*CSS counters to number the steps*/

    counter-reset: step;

        padding: 0;

}



#progressbar li {

    list-style-type: none;

    color: #2e2d2e;

    text-transform: uppercase;

    font-size: 13px;

    width: 33.33%;

    float: left;

    position: relative;

    letter-spacing: 1px;

    cursor: pointer;

}

a.current {

    color: #f2b662 !important;

}

#progressbar li:after {

    content: '\f192';

    counter-increment: step;

    width: 25px;

    height: 25px;

    line-height: 26px;

    display: block;

    font-size: 12px;

    color: #333;

    background: #d9d9d9;

    border-radius: 25px;

    z-index: 2;

    font-family: FontAwesome;

    margin: 0 auto 10px auto;

        position: relative;

}



/*progressbar connectors*/

#progressbar li:before {

    content: '';

    width: 100%;

    height: 2px;

    background: #d9d9d9;

    position: absolute;

    left: -50%;

    bottom: 21px;

    z-index: 1; /*put it behind the numbers*/

}



#progressbar li:first-child:before {

    /*connector not needed before the first step*/

    content: none;

}



/*marking active/completed steps green*/

/*The number of the step and the connector before it = green*/

#progressbar li.active:after {

    background: #f2b662;

    color: #fff;

}

ul#progressbar img {

    width: 70px;

    height: 70px;

}

fieldset{

    text-align: left;

}

.single_facilities.col-sm-3.col-xs-6.p0 {

  /* position: relative !important; */

}

.portfolio_itema {

    border-radius: 40px;

    overflow: hidden;

}

.our_services_area .portfolio_inner_area .portfolio_itema .single_facilities .single_facilities_inner {

    position: relative;

}

.our_services_area .portfolio_inner_area .portfolio_itema .single_facilities .single_facilities_inner img {

    width: 100%;

    height: 240px;

    padding: 4px;

}





<?php if($plang){ ?>

#progressbar li {

    float: right;

}

#progressbar li:first-child:before {

    content: '';

}

#progressbar li:last-child:before {

    /*connector not needed before the first step*/

    content: none;

}

fieldset{

    text-align: right;

}


@media (max-width: 767px) {

.our_services_area .portfolio_inner_area .portfolio_filter ul li {
float: right;
}


.select-selected {
text-align: left;
padding-left: 45px;
}


}


.ccont-xo p.add-xo {
direction: rtl;
}

.del-os:last-child {

border-right: 1px solid #3C3B3C;
}




<?php } ?>



     </style>

</head>

<body>

    <!-- Preloader -->



    <!-- Top Header_Area -->

    <section class="top_header_area">

        <div class="container">

            <ul class="nav navbar-nav top_nav">

                <li><a href="#"><i class="fa fa-phone"></i></a></li>

                <li><a href="#"><i class="fa fa-envelope-o"></i><span class="__cf_email__" data-cfemail="#"></span></a></li>

                <li><a href="#"><i class="fa fa-clock-o"></i></a></li>

            </ul>

            <ul class="nav navbar-nav navbar-right social_nav">

                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>

                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>

                <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>

                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>

                <li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>

                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>

            </ul>

        </div>

    </section>

    <!-- End Top Header_Area -->



    <!-- Header_Area -->

<div>

                            <div class='search-box' id='search_box'>

                                <div class='inputpoint'>

                                    <div class="searchForm">

                                        <form action="services<?=$plang?>.php" method="post" class="row m0">

                                            <div class="input-group">



                                                <input type="search" name="name" class="form-control" placeholder="<?=($plang?"كلمة البحث":"Type & Hit Enter")?>">

                                            </div>

                                        </form>

                                    </div>

                                    <!-- End searchForm -->

                                </div>



                                <div class="close-searchbox" onclick="hidesearchbox()"><span>&#215;</span></div>

                            </div>

                            <div id='searchbox-layer'></div>

</div>



    <nav class="navbar navbar-default header_aera" id="main_navbar">

        <div class="container">

            <div class="mar-head">

                <!-- Brand and toggle get grouped for better mobile display -->









                <div class="col-md-2 p0">

                    <div class="navbar-header">

                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#min_navbar">

                            <span class="sr-only">Toggle navigation</span>

                            <span class="icon-bar"></span>

                            <span class="icon-bar"></span>

                            <span class="icon-bar"></span>

                        </button>

                        <a class="navbar-brand" href="index<?=$plang?>.php"><img src="images/logo.png" alt=""></a>



                    </div>

                </div>





                <!-- Collect the nav links, forms, and other content for toggling -->

                <div class="col-md-8 p0">

                    <div class="collapse navbar-collapse" id="min_navbar">

                        <ul class="nav navbar-nav navbar-right">

                            <li class=" submenu">

                               <a href="index<?=$plang?>.php"  class="<?=getCurrent(1)?>" ><?=getTitle("index".$plang)?></a>



                            </li>



                            <li class=" submenu">

                          <a href="about<?=$plang?>.php"  class="<?=getCurrent(2)?>" ><?=getTitle("about".$plang)?></a>

                            </li>



                            <li class=" submenu">

                              <a href="services<?=$plang?>.php"  class="<?=getCurrent(3)?>" ><?=getTitle("services".$plang)?></a>

                            </li>



                            <li class=" submenu">

                            <a href="projects<?=$plang?>.php"  class="<?=getCurrent(4)?>" ><?=getTitle("projects".$plang)?></a>

                            </li>



                            <li class=" submenu">

                               <a href="clients<?=$plang?>.php"  class="<?=getCurrent(5)?>" ><?=getTitle("Partners".$plang)?></a>

                            </li>



                            <li class=" submenu">

                                <a href="contact<?=$plang?>.php"  class="<?=getCurrent(6)?>" ><?=getTitle("contact".$plang)?></a>

                            </li>



                        </ul>

                    </div>

                    <!-- /.navbar-collapse -->

                </div>





<div class="col-md-2 p0 sect-out">

<div class="sear-lang">

<li class=""><a href="index<?=$plang?"":"arabic"?>.php" class="lang"><?=$plang?"EN":"AR"?></a></li>

<li class="">

<a href='javascript:void(0)' class="searchbutton sty-xo" onclick='openSearchbox()' title='Quick Search'></a>

</li>



</div>

</div>

            </div>

        </div>

        <!-- /.container -->

    </nav>

    <!-- End Header_Area -->
