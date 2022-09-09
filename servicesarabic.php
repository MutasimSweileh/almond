
<?php
$pagg = 3;
include "inc.php";
$id =  isv("level");
$name = isv("name");
$prodpram = array();
if($id)
$prodpram = array("id"=>$id);
if($name)
$prodpram = array("name"=>$name);
$products = $core->getproducts($prodpram);
?>
<div <?php if($id){ ?> style="    background-color: #fff;"  <?php }else{  ?>  class="container"   <?php } ?>  >
<?php
if($id){
    $i = 0;
?>

 <div class="go-out"  style="z-index: 999999;"><a id="button" href="#map"><i style="border: 2px solid #fff;    color: #fff;" class="fa fa-angle-down "></i></a></div>
            <section class="award-opa mar-head" style="background-color: #fff;padding: 70px 90px;">
      <?php if(!$core->getproducts_images( array("product_id"=>$products[0]["id"]),"product_videos")){ ?>
                <div class="">
                <img src="images/<?=$products[$i]["image"]?>" alt="<?=$products[$i]["name".$clang]?>">
                </div>
                <div style="clear: both;"></div>
                <p><?=$products[$i]["description".$clang]?></p>
                     <?php  if($products[$i]["file"] != null ){ ?>
                     <p style="text-align: center; float:<?=!$plang?"right":"left"?>;"><a href="images/<?=$products[$i]["file"]?>" class="but-news"><?=$plang?"تحميل الملف ":"Download File"?></a></p>
                     <?php } ?>
                                          <?php  if($products[$i]["video"] != null ){ ?>
                    <p style="text-align: center;">
        <iframe width="30%" height="100%" style="margin: auto; margin-right: 0%; border: 0px; min-height: 200px;"  src="https://www.youtube.com/embed/<?

    echo $products[$i]["video"];



    ?>" allowfullscreen>



       </iframe>
           </p>

       <?php } }else{ ?>


<div class="row">

        <form id="msform">
             <div class="col-md-10 col-md-offset-1">
            <!-- progressbar -->
            <ul id="progressbar">
                 <li class="active"> <img src="images/Icons-20.png" alt="<?=$products[$i]["name".$clang]?>"> <p><?=($plang?" معلومات المشروع   ":"Project Information")?></p> </li>
                 <li> <img src="images/Icons-21.png" alt="<?=$products[$i]["name".$clang]?>">  <p><?=($plang?"صور المشروع   ":"Project Photo")?></p></li>
                 <li> <img src="images/Icons-22.png" alt="<?=$products[$i]["name".$clang]?>">  <p><?=($plang?"فديوهات المشروع   ":"Project Videos")?></p></li>
            </ul>
                </div>
            <div class="clear" style="clear: both;"></div>
            <!-- fieldsets -->
            <fieldset>
                 <p><?=$products[$i]["description".$clang]?></p>
            </fieldset>
            <fieldset>
                            <?php $videospaaaarm = array("product_id"=>$products[0]["id"]);
$productss = $core->getproducts_images($videospaaaarm);   if($productss){ ?>
    <!-- Our Services Area -->
        <section class="our_services_area">
            <div class="containerr">
                <div class="portfolio_inner_area" style="    border-top: none;    padding: 0;">
                    <div class="portfolio_itema">
                        <div class="grid-sizer"></div>
                          <?php

if($productss != null)
 for($ii=0;$ii<count($productss);$ii++){
?>
                        <div class="single_facilities col-sm-3 col-xs-6 p0  " style="    height: auto;">
                            <div class="single_facilities_inner">
                               <a href="images/<?=$productss[$ii]["image"]?>" data-lightbox="example-set"> <img src="images/<?=$productss[$ii]["image"]?>" alt="<?=$productss[$i]["name".$clang]?>"></a>
                            </div>
                        </div>
                       <?php } ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Our Services Area -->
        <?php } ?>
            </fieldset>

            <fieldset>
<?php
$productss = $core->getproducts_images( array("product_id"=>$products[0]["id"]),"product_videos");   if($productss){ ?>
    <!-- Our Services Area -->
        <section class="our_services_area">
            <div class="containerr">
                <div class="portfolio_inner_area" style="    border-top: none;    padding: 0;">
                    <div class="portfolio_itema">
                        <div class="grid-sizer"></div>
                          <?php

if($productss != null)
 for($ii=0;$ii<count($productss);$ii++){
?>
                        <div class="single_facilities col-sm-3 col-xs-6 p0  "  style="    height: auto;">
                            <div class="single_facilities_inner">
                                      <iframe width="100%" height="100%" style=" border: 0px;     padding: 5px;"  src="https://www.youtube.com/embed/<?

    echo $productss[$i]["video"];



    ?>" allowfullscreen>



       </iframe>
                            </div>
                        </div>
                       <?php } ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Our Services Area -->
        <?php } ?>
            </fieldset>
        </form>

</div>
<?php } ?>
            </section>
            <?php $videospaaaarm = array("product_id"=>$products[0]["id"]);
$productss = $core->getproducts_images($videospaaaarm);   if($productss && !$core->getproducts_images( array("product_id"=>$products[0]["id"]),"product_videos")){ ?>
    <!-- Our Services Area -->
        <section class="our_services_area">
            <div class="container">
                <div class="head-of" >
                    <h2 style="    background: #fff;"><?=getTitle("gallery".$plang)?></h2></div>
                <div class="portfolio_inner_area" style="    border-top: 1px solid #B1B3B3;">
                    <div class="portfolio_item">
                        <div class="grid-sizer"></div>
                          <?php

if($productss != null)
 for($ii=0;$ii<count($productss);$ii++){
?>
                        <div class="single_facilities col-sm-3 col-xs-6 p0  ">
                            <div class="single_facilities_inner">
                                <img src="images/<?=$productss[$ii]["image"]?>" alt="<?=$productss[$i]["name".$clang]?>">
                                <div class="gallery_hover">
                                    <h4><?=$productss[$i]["name".$clang]?></h4>
                                    <ul>
                                        <li><a href="images/<?=$productss[$ii]["image"]?>" data-lightbox="example-set"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                       <?php } ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Our Services Area -->
<?php } }else{ ?>

            <section class="services-op">

                <div class="head-of">
                    <h2><?=getTitle("services".$plang)?></h2></div>

                <div class="sli-carousela partnersa row">
                  <?php
  $products = $core -> getproducts(array());
  if($products)
   for ($i = 0; $i < count($products); $i++) {
   ?>
                    <div class="it-ser col-md-3">
                        <div class="icon">
                       <a href="services<?=$plang?>.php?level=<?=$products[$i]["id"]?>" title="<?=$products[$i]["name".$clang]?> "  > <img src="images/<?=$products[$i]["image"]?>" alt="<?=$products[$i]["name".$clang]?>">
                        <img class="hover-two" src="images/<?=$products[$i]["image2"]?>" alt="<?=$products[$i]["name".$clang]?>">
                        </a></div>
                        <div class="ani">
                            <div class="card-front"> <a href="services<?=$plang?>.php?level=<?=$products[$i]["id"]?>" title="<?=$products[$i]["name".$clang]?> "  ><?=$products[$i]["name".$clang]?></a></div>
                            <div class="card-back"><a href="services<?=$plang?>.php?level=<?=$products[$i]["id"]?>" title="<?=$products[$i]["name".$clang]?> "  ><?=$products[$i]["name".$clang]?></a></div>
                        </div>
                    </div>
             <?php } ?>

                </div>

            </section>

<?php
}  ?>
</div>
<?php
include "inc/footer.php";
?>
<script type="text/javascript">

//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$("li").click(function(){
	current_fs = $(this).index()-1;
    next_fs = $(this).index();
	$("li").removeClass("active");
	$(this).addClass("active");
    $("fieldset").hide();
	$("fieldset").eq(next_fs).show();
    current_fs = $("fieldset").eq(current_fs);
    next_fs = $("fieldset").eq(next_fs);
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			scale = 1 - (1 - now) * 0.2;
			opacity = 1 - now;
			next_fs.css({'opacity': opacity});
		},
		duration: 800,
		complete: function(){
			current_fs.hide();
			animating = false;
		},
		easing: 'easeInOutBack'
	});
});




</script>