<?php
$pagg = 4;
include "inc.php";
$id =  isv("id");
$name = isv("name");
$prodpram = array();
if($id)
$prodpram = array("id"=>$id);
$products = $core->getprojects($prodpram);
?>
    <!-- Our Services Area -->
        <section class="our_services_area">
            <div class="container">
                <div class="head-of">
                    <h2><?=getTitle("gallery".$plang)?></h2></div>
                <div class="portfolio_inner_area">
                    <div class="portfolio_filter">
                        <ul>
                            <li data-filter="*" class="active"><a href="#"><?=($plang?" كل المشاريع ":"ALL ")?></a></li>
                             <?php
  $products = $core -> getCat();
  if($products)
   for ($i = 0; $i < count($products); $i++) {
   ?>
                            <li data-filter=".<?=$products[$i]["id"]?>th"><a href="#"><?=$products[$i]["name".$clang]?></a></li>
                                <?php } ?>

                        </ul>
                    </div>
                    <div class="portfolio_item">
                        <div class="grid-sizer"></div>
                          <?php
$prodpram = array("special"=>1);
$products = $core -> getmGallery($prodpram);
if($products != null)
 for($ii=0;$ii<count($products);$ii++){
?>
                        <div class="single_facilities col-sm-3 col-xs-6 p0 <?=$products[$ii]["category"]?>th ">
                            <div class="single_facilities_inner">
                                <img src="images/<?=$products[$ii]["image"]?>" alt="<?=$products[$i]["name".$clang]?>">
                                <div class="gallery_hover">
                                    <h4><?=$products[$i]["name".$clang]?></h4>
                                    <ul>
                                        <li><a href="#"><i class="fa fa-link" aria-hidden="true"></i></a></li>
                                        <li><a href="images/<?=$products[$ii]["image"]?>" data-lightbox="example-set"><i class="fa fa-search" aria-hidden="true"></i></a></li>
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

<?php
include "inc/footer.php";
?>