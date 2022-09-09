<?php
$pagg = 5;
include "inc.php";
$id = isv("level");
?>
        <div class="container">
            <section class="clients-op">
                <div class="go-out"><a id="button" href="#map"><i class="fa fa-angle-down "></i></a></div>

                <div class="head-of">
                    <h2><?=getTitle("Partners".$plang)?></h2></div>

                <div class="almond-clients">
                                                                                                  <?php
         $data = $core->getclients(array());
         for($i=0;$i<count($data);$i++){
         	?>
                    <div class="src-img"><div class="ima-card">
                        <img src="images/<?=$data[$i]["image"]?>" alt="<?=$alt?>"></div>
                    </div>
                <?php
                }
                ?>

                </div>

            </section>
        </div>
<?php
include "inc/footer.php";
?>