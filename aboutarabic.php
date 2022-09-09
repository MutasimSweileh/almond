<?
$pagg = 2;
include  "inc.php";
?>
<div <?php if($id || !$id){ ?> style="    background-color: #fff;"  <?php }else{  ?>  class="container"   <?php } ?>  >
 <div class="go-out"  style="z-index: 999999;"><a id="button" href="#map"><i style="border: 2px solid #fff;    color: #fff;" class="fa fa-angle-down "></i></a></div>
            <section class="award-opa mar-head" style="background-color: #fff;padding: 70px 90px;">
    <p><?=getValue("about",$lang)?></p>
            </section>
</div>
<?php include "inc/footer.php" ?>