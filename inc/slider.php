    <div id="myCarousel" class="carousel slide caption-animate" data-ride="carousel">
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                                                                                                                    <?php

$sliderpram = array();
$sliders = $core -> getslider($sliderpram);
$id = isv("level");
if($id)
$sliders = $core -> getproducts(array("id"=>$id));
$ie = 0;
foreach ($sliders as $slider){

                                                                                                ?>
                        <div class="item <?=($ie?"":"active")?>" <?php if(!$id || $id){ ?> style="background:url(images/<?=$slider[(!$id?"image":"image3")]?>); "   <?php } ?>>
                                <div class="container">
                                        <div class=" slide-margin">

                  <div class="col-sm-12">
                            <div class="carousel-content mar-head">
                                <h1 class="animation animated-item-4 "><?= $slider["name".$clang] ?></h1>
                            </div>
                        </div>
                                              <!--  <div class="col-md-6 col-sm-12  col-xs-12 animation animated-item-4 pull-right">
                                                <h1><?= $slider["name".$clang] ?></h1>
                                                  <div class="slider-img">

                                                        </div>
                                                </div>-->
                                        </div>
                                </div>
                        </div>
                         <?php $ie++; } ?>

        </div>
