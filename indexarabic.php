<?php
$pagg = 1;
include "inc.php";
/*
$lang : get form  inc.php  = arabic || english;
$plang : get form  inc.php for  php file name  = arabic || "";
$clang : get form  inc.php for column name  =  _arabic || "" ;
*/
?>
<div class="container">
        <section class="feat-about">

            <div class="professional_builder">

                <div class=" builder_all">

                    <div class="feat-img">
                        <div class="builder">
                            <img class="oreginal" src="images/icon5.png" alt="" class="">
                            <img class="hover" src="images/wicon5.png" alt="" class="">

                        </div>
                    </div>

                    <div class="feat-img">
                        <div class="builder">
                            <img class="oreginal" src="images/icon4.png" alt="" class="">
                            <img class="hover" src="images/wicon4.png" alt="" class="">

                        </div>
                    </div>
                    <div class="feat-img">
                        <div class="builder">
                            <img class="oreginal" src="images/icon3.png" alt="" class="">
                            <img class="hover" src="images/wicon3.png" alt="" class="">

                        </div>
                    </div>
                    <div class="feat-img">
                        <div class="builder">
                            <img class="oreginal" src="images/icon2.png" alt="" class="">
                            <img class="hover" src="images/wicon2.png" alt="" class="">

                        </div>
                    </div>

                    <div class="feat-img">
                        <div class="builder">
                            <img class="oreginal" src="images/icon1.png" alt="" class="">
                            <img class="hover" src="images/wicon1.png" alt="" class="">

                        </div>
                    </div>
                </div>

            </div>

            <!-- About Us Area -->
            <div class="about_us_area row">
                <div class="container">
                    <div class="about_row">

                        <div class="who_we_area col-md-8 col-sm-7">

                            <p>    <?=getValue("home_text",$lang)?>   </p>

                        </div>

                        <div class="col-md-4 about-img">
                            <div class="ima">
                                <h3> <?=getTitle("about".$plang)?></h3>
                            </div>
                        </div>

                    </div>

                    <div class=" message_row about_row">

                        <div class="b-bord-top"></div>

                        <div class="col-md-6 col-sm-12 del-os">
                            <div class="around-ms">
                                <div class="img"><img src="images/icon6.png" alt=""></div>
                                <div class="txt">
                                    <h2><?=($plang?"رسالتنا":"Our Mission")?></h2>
                                    <p> <?=getValue("Mission",$lang)?></p>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12 del-os">
                            <div class="around-ms">
                                <div class="img"><img src="images/icon7.png" alt=""></div>
                                <div class="txt">
                                    <h2><?=($plang?"رؤيتنا":"Our vision")?></h2>
                                    <p> <?=getValue("Vision",$lang)?></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- End About Us Area -->

        </section>

        </div>

        <div class="container">
            <section class="services-op">

                <div class="head-of">
                    <h2><?=getTitle("services".$plang)?></h2></div>

                <div class="sli-carousel partners">
                  <?php
  $products = $core -> getproducts(array("special"=>1));
  if($products)
   for ($i = 0; $i < count($products); $i++) {
   ?>
                    <div class="it-ser">
                        <div class="icon">
                        <img src="images/<?=$products[$i]["image"]?>" alt="<?=$products[$i]["name".$clang]?>">
                        <img class="hover-two" src="images/<?=$products[$i]["image2"]?>" alt="<?=$products[$i]["name".$clang]?>">
                        </div>
                        <div class="ani">
                            <div class="card-front"> <a href="services<?=$plang?>.php?level=<?=$products[$i]["id"]?>" title="<?=$products[$i]["name".$clang]?> "  ><?=$products[$i]["name".$clang]?></a></div>
                            <div class="card-back"><a href="services<?=$plang?>.php?level=<?=$products[$i]["id"]?>" title="<?=$products[$i]["name".$clang]?> "  ><?=$products[$i]["name".$clang]?></a></div>
                        </div>
                    </div>
             <?php } ?>

                </div>

            </section>
        </div>

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
                                        <li><a href="<?=$products[$ii]["link"]?>"><i class="fa fa-link" aria-hidden="true"></i></a></li>
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

        <div class="container">
            <div class="con-num">
                <div class="exp">
                    <h2><?=($plang?"خبرة":"Experience")?><span><?=getValue("Experience")?></span><?=($plang?"عام":"year")?></h2>
                </div>
                <div id="shiva2">
               <?php $data  = $core->getaboutItem(); if($data) for ($i = 0; $i < count($data); $i++) { ?>
                    <div class="col-md-3 col-xs-6 count-box">
                        <span class="count"><?=$data[$i]["count"]?></span><span class="plus">+</span>
                        <p><?=$data[$i]["title".$clang]?></p>
                        <p class="detail"><?=$data[$i]["text".$clang]?></p>
                    </div>
                   <?php } ?>
                </div>
            </div>
        </div>

        <div class="container">
            <section class="award-op">

                <div class="head-of">
                    <h2><?=($plang?"الجوائز":"Awards")?></h2></div>

                <p><?=getValue("Awards",$lang)?></p>

            </section>
        </div>

        <div class="container">
            <section class="clients-op">
                <div class="go-out"><a id="button" href="#map"><i class="fa fa-angle-down "></i></a></div>

                <div class="head-of">
                    <h2><?=getTitle("clients".$plang)?></h2></div>

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

        <div class="container">
            <section class="contact-op">

                <div class="head-of">
                    <h2><?=getTitle("contact".$plang)?></h2></div>

                <div class="col-md-6 col-sm-12 ccont-xo">
                    <div class=" half-xo1"><div class="voo"><img src="images/icon9.png" alt=""><img class="hover-voo" src="images/wicon9.png" alt=""></div>
                        <p class="font"><?=getValue("mobilepage")?></p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 ccont-xo">
                    <div class=" half-xo2"><div class="voo"><img src="images/icon8.png" alt=""><img class="hover-voo" src="images/wicon8.png" alt=""></div>
                        <p class="font"><?=getValue("footeremail")?></p>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12 ccont-xo">
                    <div class=""><div class="voo"><img src="images/icon10.png" alt=""><img class="hover-voo" src="images/wicon10.png" alt=""></div>
                        <p><?=($plang?"فرع الرياض ":"Riyadh Branch")?></p>
                        <p class="add-xo"><?=getValue("RiyadhBranch".$plang)?></p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 ccont-xo">
                    <div class=""><div class="voo"><img src="images/icon10.png" alt=""><img class="hover-voo" src="images/wicon10.png" alt=""></div>
                        <p><?=($plang?"فرع القاهرة ":"Cairo Branch")?></p>
                        <p class="add-xo"><?=getValue("CairoBranch".$plang)?></p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 ccont-xo">
                    <div class=""><div class="voo"><img src="images/icon10.png" alt=""><img class="hover-voo" src="images/wicon10.png" alt=""></div>
                        <p><?=($plang?"فرع دبي":"Dubai Branch")?></p>
                        <p class="add-xo"><?=getValue("DubaiBranch".$plang)?></p>
                    </div>
                </div>

            </section>
        </div>

        <div class="message-map">

            <div class="head-of">
                <h2><span class=""><?=($plang?"الخريطة":"Message")?></span>
<label class="switch">
  <input class="ch-ck" type="checkbox" checked="checked" name='mycheckboxes'>
  <span class="slider round"></span>
</label>
<span class="cec"><?=($plang?"رسالة":"Map")?></span>
</h2></div>

            <div class="ms-map showme">
                <div class="rel">
                    <iframe src="<?=getValue("googlemap")?>" width="100%" height="650" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>

            <div class="ms-sms">
                <div class="container">
                    <form class="form" method="post"  action="contact<?=$plang?>.php"  >
                        <div class="custom-select ">
                            <label class="lab-l"><?=($plang?"إختر الجهة ":"Select the destination")?></label>
                            <select class="effect-16" name="country">
                                <?php if($plang){ ?>
 <OPTION value=مصر>مصر</OPTION>
 <OPTION value=الكويت>الكويت</OPTION>

   <OPTION value=قطر>قطر</OPTION>
   <OPTION
  value=الأردن>الأردن</OPTION>
  <OPTION value="المملكة العربية السعودية">المملكة العربية السعودية</OPTION>
  <OPTION value=اليمن>اليمن</OPTION>
  <OPTION
  value=عمان>عمان</OPTION>
  <OPTION
  value=البحرين>البحرين</OPTION>  <OPTION value=فلسطين المحتلة>فلسطين المحتلة</OPTION><OPTION
  value=سوريا>سوريا</OPTION> <OPTION
  value=لبنان>لبنان</OPTION> <OPTION value=العراق>العراق</OPTION><OPTION
  value=السودان>السودان</OPTION> <OPTION value=ليبيا>ليبيا</OPTION>  <OPTION
  value=الجزائر>الجزائر</OPTION><OPTION  value=موريتانيا>موريتانيا</OPTION><OPTION  value=المغرب>المغرب</OPTION><OPTION  value=تونس>تونس</OPTION><OPTION
  value="جزر القمر">جزر القمر</OPTION> <OPTION
  value="الإمارات العربية المتحدة">الإمارات العربية المتحدة</OPTION>
  <OPTION
  value=تركيا>تركيا</OPTION>
  <OPTION value=ماليزيا>ماليزيا</OPTION>
   <OPTION value=أفغانستان>أفغانستان</OPTION><OPTION value=باكستان>باكستان</OPTION>
   <OPTION value="المملكة المتحدة">المملكة المتحدة</OPTION>  <OPTION value="الولايات المتحدة الامريكية">الولايات المتحدة  الامريكية</OPTION>
   <OPTION value=كندا>كندا</OPTION> <OPTION
  value=فرنسا>فرنسا</OPTION><OPTION value=النمسا>النمسا</OPTION><OPTION
  value=ألمانيا>ألمانيا</OPTION>

    <OPTION value=ax>جزر
  آلاند</OPTION> <OPTION  value=ألبانيا>ألبانيا</OPTION> <OPTION value="ساموا  الأمريكية">ساموا الأمريكية</OPTION> <OPTION
  value=أندورا>أندورا</OPTION> <OPTION value=أنغولا>أنغولا</OPTION> <OPTION
  value=أنجويلا>أنجويلا</OPTION> <OPTION value=أنتاركتيكا>أنتاركتيكا</OPTION> <OPTION
  value="أنتيغوا وبربودا">أنتيغوا وبربودا</OPTION> <OPTION value=الأرجنتين>الأرجنتين</OPTION> <OPTION
  value=أرمينيا>أرمينيا</OPTION> <OPTION value=أروبا>أروبا</OPTION> <OPTION
  value=أستراليا>أستراليا</OPTION> <OPTION value=النمسا>النمسا</OPTION> <OPTION
  value=أذربيجان>أذربيجان</OPTION> <OPTION value="جزر  البهاما">جزر البهاما</OPTION> <OPTION  value=بنغلاديش>بنغلاديش</OPTION> <OPTION
  value=بربادوس>بربادوس</OPTION> <OPTION value="روسيا  البيضاء (بيلاروسيا)">روسيا البيضاء (بيلاروسيا)</OPTION>
  <OPTION value=بلجيكا>بلجيكا</OPTION>
<OPTION value=بليز>بليز</OPTION> <OPTION
  value=بينين>بينين</OPTION> <OPTION value=برمودا>برمودا</OPTION> <OPTION
  value=بوتان>بوتان</OPTION> <OPTION value=بوليفيا>بوليفيا</OPTION> <OPTION
  value="البوسنة والهرسك">البوسنة والهرسك</OPTION> <OPTION value=بتسوانا>بتسوانا</OPTION> <OPTION
  value="جزيرة بوفيه">جزيرة بوفيه</OPTION> <OPTION value=البرازيل>البرازيل</OPTION> <OPTION
  value="إقليم المحيط الهندي البريطاني">إقليم المحيط الهندي البريطاني</OPTION>
   <OPTION value="جزر فيرجين البريطانية">جزر فيرجين البريطانية</OPTION>
   <OPTION value=بروناي>بروناي</OPTION> <OPTION
  value=بلغاريا>بلغاريا</OPTION> <OPTION value="بوركينا فاسو">بوركينا فاسو</OPTION> <OPTION
  value=بوروندي>بوروندي</OPTION> <OPTION value=كامبوديا>كامبوديا</OPTION> <OPTION
  value=الكاميرون>الكاميرون</OPTION>  <OPTION
  value="جزيرة الرأس الأخضر">جزيرة الرأس الأخضر</OPTION> <OPTION value=جزر كايمان>جزر كايمان</OPTION>
  <OPTION value="جمهورية أفريقيا الوسطى">جمهورية أفريقيا الوسطى</OPTION> <OPTION
  value=تشاد>تشاد</OPTION> <OPTION value=تشيلي>تشيلي</OPTION> <OPTION
  value=الصين>الصين</OPTION> <OPTION value=جزيرة الكريسماس>جزيرة الكريسماس</OPTION> <OPTION
  value="جزر كوكوس (كيلنج)">جزر كوكوس (كيلنج)</OPTION>  <OPTION value=كولومبيا>كولومبيا</OPTION> <OPTION  value=الكونغو>الكونغو</OPTION> <OPTION
  value=جزر كوك>جزر كوك</OPTION> <OPTION value=كوستاريكا>كوستاريكا</OPTION> <OPTION
  value=كرواتيا>كرواتيا</OPTION> <OPTION value=كوبا>كوبا</OPTION> <OPTION
  value=قبرص>قبرص</OPTION> <OPTION value="جمهورية التشيك">جمهورية التشيك</OPTION> <OPTION
  value="جمهورية الكونغو الديمقراطية">جمهورية الكونغو الديمقراطية</OPTION> <OPTION
  value=الدنمارك>الدنمارك</OPTION> <OPTION value="منطقة متنازع عليها">منطقة متنازع عليها</OPTION>
  <OPTION value=جيبوتي>جيبوتي</OPTION> <OPTION value=دومينيكا>دومينيكا</OPTION> <OPTION
  value="جمهورية الدومنيكان">جمهورية الدومنيكان</OPTION>  <OPTION value="تيمور الشرقية">تيمور الشرقية</OPTION>
  <OPTION value=الإكوادور>الإكوادور</OPTION>  <OPTION
  value=السلفادور>السلفادور</OPTION> <OPTION value="غينيا الاستوائية">غينيا الاستوائية</OPTION> <OPTION
  value=أرتيريا>أرتيريا</OPTION> <OPTION value=إستونيا>إستونيا</OPTION> <OPTION
  value=أثيوبيا>أثيوبيا</OPTION> <OPTION value=جزر فوكلاند>جزر فوكلاند</OPTION> <OPTION
  value="جزر فارو">جزر فارو</OPTION> <OPTION value="ولايات  ميكرونيسيا المتحدة">ولايات ميكرونيسيا المتحدة</OPTION>
  <OPTION value=فيجي>فيجي</OPTION> <OPTION  value=فنلندا>فنلندا</OPTION> <OPTION value="غويانا  الفرنسية">غويانا الفرنسية</OPTION> <OPTION
  value="بولينيزيا الفرنسية">بولينيزيا الفرنسية</OPTION> <OPTION value=الغابون>الغابون</OPTION> <OPTION
  value=غامبيا>غامبيا</OPTION> <OPTION  value=جورجيا>جورجيا</OPTION>  <OPTION  value=غانا>غانا</OPTION> <OPTION value="جبل طارق">جبل
  طارق</OPTION> <OPTION value=اليونان>اليونان</OPTION> <OPTION
  value=جرينلاند>جرينلاند</OPTION> <OPTION value=غرينادا>غرينادا</OPTION> <OPTION
  value=غوادلوب>غوادلوب</OPTION> <OPTION value=غوام>غوام</OPTION> <OPTION
  value=غواتيمالا>غواتيمالا</OPTION> <OPTION value=غينيا>غينيا</OPTION> <OPTION
  value="غينيا-بيساو">غينيا-بيساو</OPTION> <OPTION value=غويانا>غويانا</OPTION> <OPTION
  value=هايتي>هايتي</OPTION> <OPTION value="جزيرة هيرد وجزر ماكدونالد">جزيرة هيرد وجزر ماكدونالد</OPTION>
  <OPTION value=هندوراس>هندوراس</OPTION> <OPTION value="هونغ كونغ">هونغ كونغ</OPTION> <OPTION
  value="المجر (هنغاريا)">المجر (هنغاريا)</OPTION> <OPTION value=أيسلندا>أيسلندا</OPTION> <OPTION
  value=الهند>الهند</OPTION> <OPTION value=إندونيسيا>إندونيسيا</OPTION> <OPTION
  value=إيران>إيران</OPTION> <OPTION
  value=أيرلندا>أيرلندا</OPTION>  <OPTION
  value=إيطاليا>إيطاليا</OPTION> <OPTION value=ساحل العاج>ساحل العاج</OPTION> <OPTION
  value=جامايكا>جامايكا</OPTION> <OPTION value=اليابان>اليابان</OPTION> <OPTION
  value=الأردن>الأردن</OPTION> <OPTION value=كازاخستان>كازاخستان</OPTION> <OPTION
  value=كينيا>كينيا</OPTION> <OPTION value="جزر  الكيريباتي">جزر الكيريباتي</OPTION> <OPTION  value=قيرغيزستان>قيرغيزستان</OPTION> <OPTION
  value=لاوس>لاوس</OPTION> <OPTION  value=لاتفيا>لاتفيا</OPTION>  <OPTION  value=ليسوتو>ليسوتو</OPTION> <OPTION
  value=ليبريا>ليبريا</OPTION><OPTION
  value=ليختنشتاين>ليختنشتاين</OPTION> <OPTION value=ليتوانيا>ليتوانيا</OPTION> <OPTION
  value=لوكسمبورغ>لوكسمبورغ</OPTION> <OPTION value=ماكاو>ماكاو</OPTION> <OPTION
  value=مقدونيا>مقدونيا</OPTION> <OPTION value=مدغشقر>مدغشقر</OPTION> <OPTION
  value=ملاوي>ملاوي</OPTION>  <OPTION
  value=المالديف>المالديف</OPTION> <OPTION value=مالي>مالي</OPTION> <OPTION
  value=مالطا>مالطا</OPTION> <OPTION value="جزر مارشال">جزر مارشال</OPTION> <OPTION
  value=مارتينيك>مارتينيك</OPTION>  <OPTION
  value=موريشيوس>موريشيوس</OPTION> <OPTION value=مايوت>مايوت</OPTION> <OPTION
  value=المكسيك>المكسيك</OPTION> <OPTION value=مولدوفا>مولدوفا</OPTION> <OPTION
  value=موناكو>موناكو</OPTION> <OPTION value=منغوليا>منغوليا</OPTION> <OPTION
  value=مونتسرات>مونتسرات</OPTION>  <OPTION
  value=موزمبيق>موزمبيق</OPTION> <OPTION value=ميانمار>ميانمار</OPTION> <OPTION
  value=ناميبيا>ناميبيا</OPTION> <OPTION value=ناورو>ناورو</OPTION> <OPTION
  value=نيبال>نيبال</OPTION> <OPTION value=هولندا>هولندا</OPTION>
  <OPTION value="كاليدونيا الجديدة">كاليدونيا الجديدة</OPTION> <OPTION
  value=نيوزيلندا>نيوزيلندا</OPTION> <OPTION value=نيكاراغوا>نيكاراغوا</OPTION> <OPTION
  value=النيجر>النيجر</OPTION> <OPTION value=نيجيريا>نيجيريا</OPTION> <OPTION
  value=نيوي>نيوي</OPTION> <OPTION value="جزيرة نورفولك">جزيرة نورفولك</OPTION> <OPTION
  value="كوريا الشمالية">كوريا الشمالية</OPTION>  <OPTION value=النرويج>النرويج</OPTION>   <OPTION
  value=بالاو>بالاو</OPTION><OPTION
  value=بنما>بنما</OPTION> <OPTION value="بابوا غينيا الجديدة">بابوا غينيا الجديدة</OPTION> <OPTION
  value=باراغواي>باراغواي</OPTION> <OPTION value=بيرو>بيرو</OPTION> <OPTION
  value=الفلبين>الفلبين</OPTION> <OPTION value="جزر بيتكيرن">جزر بيتكيرن</OPTION> <OPTION
  value=بولندا>بولندا</OPTION> <OPTION value=البرتغال>البرتغال</OPTION> <OPTION
  value=بورتوريكو>بورتوريكو</OPTION><OPTION
  value=ريونيون>ريونيون</OPTION> <OPTION value=رومانيا>رومانيا</OPTION> <OPTION
  value=روسيا>روسيا</OPTION> <OPTION  value=رواندا>رواندا</OPTION> <OPTION value=سانت كيتس  ونيفس>سانت كيتس ونيفس</OPTION> <OPTION
  value="سانت لوسيا">سانت لوسيا</OPTION> <OPTION value="سانت بيير وميكويلون">سانت بيير وميكويلون</OPTION>
  <OPTION value="سانت فينسنت وجزر غرينادين">سانت فينسنت وجزر غرينادين</OPTION> <OPTION
  value=ساموا>ساموا</OPTION> <OPTION value=سان مارينو>سان مارينو</OPTION> <OPTION
  value="ساو تومي وبرنسيب">ساو تومي وبرنسيب</OPTION>
  <OPTION value=السنغال>السنغال</OPTION> <OPTION
  value=سيشيل>سيشيل</OPTION> <OPTION value=سيراليون>سيراليون</OPTION> <OPTION
  value=سنغافورة>سنغافورة</OPTION> <OPTION value=سلوفاكيا>سلوفاكيا</OPTION> <OPTION
  value=سلوفينيا>سلوفينيا</OPTION> <OPTION value=جزر سليمان>جزر سليمان</OPTION> <OPTION
  value=الصومال>الصومال</OPTION> <OPTION value=جنوب أفريقيا>جنوب أفريقيا</OPTION> <OPTION
  value=كوريا الجنوبية>كوريا الجنوبية</OPTION> <OPTION value=إسبانيا>إسبانيا</OPTION> <OPTION
  value=جزر سبراتلي>جزر سبراتلي</OPTION> <OPTION  value=سريلانكا>سريلانكا</OPTION>  <OPTION  value=سورينام>سورينام</OPTION> <OPTION
  value="سفالبارد وجان ماين">سفالبارد وجان ماين</OPTION> <OPTION value=سوازيلند>سوازيلند</OPTION>
  <OPTION value=السويد>السويد</OPTION> <OPTION  value=سويسرا>سويسرا</OPTION>  <OPTION  value=تايوان>تايوان</OPTION> <OPTION
  value=طاجكستان>طاجكستان</OPTION> <OPTION value=تنزانيا>تنزانيا</OPTION> <OPTION
  value=تايلاند>تايلاند</OPTION> <OPTION value=توغو>توغو</OPTION> <OPTION
  value=توكيلو>توكيلو</OPTION> <OPTION value=تونغا>تونغا</OPTION> <OPTION
  value="ترينيداد وتوباغو">ترينيداد وتوباغو</OPTION>    <OPTION value=تركمانستان>تركمانستان</OPTION> <OPTION
  value="جزر تركس وكايكوس">جزر تركس وكايكوس</OPTION> <OPTION value=توفالو>توفالو</OPTION> <OPTION
  value=أوغندا>أوغندا</OPTION> <OPTION value=أوكرانيا>أوكرانيا</OPTION>
   <OPTION
  value=أوروغواي>أوروغواي</OPTION>
  <OPTION value=أوزباكستان>أوزباكستان</OPTION> <OPTION value=فانواتو>فانواتو</OPTION> <OPTION
  value=مدينة الفاتيكان>مدينة الفاتيكان</OPTION> <OPTION value=فنزويلا>فنزويلا</OPTION> <OPTION
  value=فيتنام>فيتنام</OPTION> <OPTION value="والس وفوتونا">والس وفوتونا</OPTION> <OPTION
  value="الصحراء الغربية">الصحراء الغربية</OPTION>  <OPTION
  value=زامبيا>زامبيا</OPTION> <OPTION value=زيمبابوي>زيمبابوي</OPTION> <OPTION
  value=صربيا>صربيا</OPTION> <OPTION value="الجبل الأسود">الجبل الأسود</OPTION>
                                <?php }else{ ?>
<option value="Afganistan">Afghanistan</option>
<option value="Albania">Albania</option>
<option value="Algeria">Algeria</option>
<option value="American Samoa">American Samoa</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguilla">Anguilla</option>
<option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
<option value="Argentina">Argentina</option>
<option value="Armenia">Armenia</option>
<option value="Aruba">Aruba</option>
<option value="Australia">Australia</option>
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="Bahamas">Bahamas</option>
<option value="Bahrain">Bahrain</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Barbados">Barbados</option>
<option value="Belarus">Belarus</option>
<option value="Belgium">Belgium</option>
<option value="Belize">Belize</option>
<option value="Benin">Benin</option>
<option value="Bermuda">Bermuda</option>
<option value="Bhutan">Bhutan</option>
<option value="Bolivia">Bolivia</option>
<option value="Bonaire">Bonaire</option>
<option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
<option value="Botswana">Botswana</option>
<option value="Brazil">Brazil</option>
<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
<option value="Brunei">Brunei</option>
<option value="Bulgaria">Bulgaria</option>
<option value="Burkina Faso">Burkina Faso</option>
<option value="Burundi">Burundi</option>
<option value="Cambodia">Cambodia</option>
<option value="Cameroon">Cameroon</option>
<option value="Canada">Canada</option>
<option value="Canary Islands">Canary Islands</option>
<option value="Cape Verde">Cape Verde</option>
<option value="Cayman Islands">Cayman Islands</option>
<option value="Central African Republic">Central African Republic</option>
<option value="Chad">Chad</option>
<option value="Channel Islands">Channel Islands</option>
<option value="Chile">Chile</option>
<option value="China">China</option>
<option value="Christmas Island">Christmas Island</option>
<option value="Cocos Island">Cocos Island</option>
<option value="Colombia">Colombia</option>
<option value="Comoros">Comoros</option>
<option value="Congo">Congo</option>
<option value="Cook Islands">Cook Islands</option>
<option value="Costa Rica">Costa Rica</option>
<option value="Cote DIvoire">Cote D'Ivoire</option>
<option value="Croatia">Croatia</option>
<option value="Cuba">Cuba</option>
<option value="Curaco">Curacao</option>
<option value="Cyprus">Cyprus</option>
<option value="Czech Republic">Czech Republic</option>
<option value="Denmark">Denmark</option>
<option value="Djibouti">Djibouti</option>
<option value="Dominica">Dominica</option>
<option value="Dominican Republic">Dominican Republic</option>
<option value="East Timor">East Timor</option>
<option value="Ecuador">Ecuador</option>
<option selected="selected" value="Egypt">Egypt</option>
<option value="El Salvador">El Salvador</option>
<option value="Equatorial Guinea">Equatorial Guinea</option>
<option value="Eritrea">Eritrea</option>
<option value="Estonia">Estonia</option>
<option value="Ethiopia">Ethiopia</option>
<option value="Falkland Islands">Falkland Islands</option>
<option value="Faroe Islands">Faroe Islands</option>
<option value="Fiji">Fiji</option>
<option value="Finland">Finland</option>
<option value="France">France</option>
<option value="French Guiana">French Guiana</option>
<option value="French Polynesia">French Polynesia</option>
<option value="French Southern Ter">French Southern Ter</option>
<option value="Gabon">Gabon</option>
<option value="Gambia">Gambia</option>
<option value="Georgia">Georgia</option>
<option value="Germany">Germany</option>
<option value="Ghana">Ghana</option>
<option value="Gibraltar">Gibraltar</option>
<option value="Great Britain">Great Britain</option>
<option value="Greece">Greece</option>
<option value="Greenland">Greenland</option>
<option value="Grenada">Grenada</option>
<option value="Guadeloupe">Guadeloupe</option>
<option value="Guam">Guam</option>
<option value="Guatemala">Guatemala</option>
<option value="Guinea">Guinea</option>
<option value="Guyana">Guyana</option>
<option value="Haiti">Haiti</option>
<option value="Hawaii">Hawaii</option>
<option value="Honduras">Honduras</option>
<option value="Hong Kong">Hong Kong</option>
<option value="Hungary">Hungary</option>
<option value="Iceland">Iceland</option>
<option value="India">India</option>
<option value="Indonesia">Indonesia</option>
<option value="Iran">Iran</option>
<option value="Iraq">Iraq</option>
<option value="Ireland">Ireland</option>
<option value="Isle of Man">Isle of Man</option>
<option value="Israel">Israel</option>
<option value="Italy">Italy</option>
<option value="Jamaica">Jamaica</option>
<option value="Japan">Japan</option>
<option value="Jordan">Jordan</option>
<option value="Kazakhstan">Kazakhstan</option>
<option value="Kenya">Kenya</option>
<option value="Kiribati">Kiribati</option>
<option value="Korea North">Korea North</option>
<option value="Korea Sout">Korea South</option>
<option value="Kuwait">Kuwait</option>
<option value="Kyrgyzstan">Kyrgyzstan</option>
<option value="Laos">Laos</option>
<option value="Latvia">Latvia</option>
<option value="Lebanon">Lebanon</option>
<option value="Lesotho">Lesotho</option>
<option value="Liberia">Liberia</option>
<option value="Libya">Libya</option>
<option value="Liechtenstein">Liechtenstein</option>
<option value="Lithuania">Lithuania</option>
<option value="Luxembourg">Luxembourg</option>
<option value="Macau">Macau</option>
<option value="Macedonia">Macedonia</option>
<option value="Madagascar">Madagascar</option>
<option value="Malaysia">Malaysia</option>
<option value="Malawi">Malawi</option>
<option value="Maldives">Maldives</option>
<option value="Mali">Mali</option>
<option value="Malta">Malta</option>
<option value="Marshall Islands">Marshall Islands</option>
<option value="Martinique">Martinique</option>
<option value="Mauritania">Mauritania</option>
<option value="Mauritius">Mauritius</option>
<option value="Mayotte">Mayotte</option>
<option value="Mexico">Mexico</option>
<option value="Midway Islands">Midway Islands</option>
<option value="Moldova">Moldova</option>
<option value="Monaco">Monaco</option>
<option value="Mongolia">Mongolia</option>
<option value="Montserrat">Montserrat</option>
<option value="Morocco">Morocco</option>
<option value="Mozambique">Mozambique</option>
<option value="Myanmar">Myanmar</option>
<option value="Nambia">Nambia</option>
<option value="Nauru">Nauru</option>
<option value="Nepal">Nepal</option>
<option value="Netherland Antilles">Netherland Antilles</option>
<option value="Netherlands">Netherlands (Holland, Europe)</option>
<option value="Nevis">Nevis</option>
<option value="New Caledonia">New Caledonia</option>
<option value="New Zealand">New Zealand</option>
<option value="Nicaragua">Nicaragua</option>
<option value="Niger">Niger</option>
<option value="Nigeria">Nigeria</option>
<option value="Niue">Niue</option>
<option value="Norfolk Island">Norfolk Island</option>
<option value="Norway">Norway</option>
<option value="Oman">Oman</option>
<option value="Pakistan">Pakistan</option>
<option value="Palau Island">Palau Island</option>
<option value="Palestine">Palestine</option>
<option value="Panama">Panama</option>
<option value="Papua New Guinea">Papua New Guinea</option>
<option value="Paraguay">Paraguay</option>
<option value="Peru">Peru</option>
<option value="Phillipines">Philippines</option>
<option value="Pitcairn Island">Pitcairn Island</option>
<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Puerto Rico">Puerto Rico</option>
<option value="Qatar">Qatar</option>
<option value="Republic of Montenegro">Republic of Montenegro</option>
<option value="Republic of Serbia">Republic of Serbia</option>
<option value="Reunion">Reunion</option>
<option value="Romania">Romania</option>
<option value="Russia">Russia</option>
<option value="Rwanda">Rwanda</option>
<option value="St Barthelemy">St Barthelemy</option>
<option value="St Eustatius">St Eustatius</option>
<option value="St Helena">St Helena</option>
<option value="St Kitts-Nevis">St Kitts-Nevis</option>
<option value="St Lucia">St Lucia</option>
<option value="St Maarten">St Maarten</option>
<option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
<option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
<option value="Saipan">Saipan</option>
<option value="Samoa">Samoa</option>
<option value="Samoa American">Samoa American</option>
<option value="San Marino">San Marino</option>
<option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Serbia">Serbia</option>
<option value="Seychelles">Seychelles</option>
<option value="Sierra Leone">Sierra Leone</option>
<option value="Singapore">Singapore</option>
<option value="Slovakia">Slovakia</option>
<option value="Slovenia">Slovenia</option>
<option value="Solomon Islands">Solomon Islands</option>
<option value="Somalia">Somalia</option>
<option value="South Africa">South Africa</option>
<option value="Spain">Spain</option>
<option value="Sri Lanka">Sri Lanka</option>
<option value="Sudan">Sudan</option>
<option value="Suriname">Suriname</option>
<option value="Swaziland">Swaziland</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>
<option value="Syria">Syria</option>
<option value="Tahiti">Tahiti</option>
<option value="Taiwan">Taiwan</option>
<option value="Tajikistan">Tajikistan</option>
<option value="Tanzania">Tanzania</option>
<option value="Thailand">Thailand</option>
<option value="Togo">Togo</option>
<option value="Tokelau">Tokelau</option>
<option value="Tonga">Tonga</option>
<option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Uganda">Uganda</option>
<option value="Ukraine">Ukraine</option>
<option value="United Arab Erimates">United Arab Emirates</option>
<option value="United Kingdom">United Kingdom</option>
<option value="United States of America">United States of America</option>
<option value="Uraguay">Uruguay</option>
<option value="Uzbekistan">Uzbekistan</option>
<option value="Vanuatu">Vanuatu</option>
<option value="Vatican City State">Vatican City State</option>
<option value="Venezuela">Venezuela</option>
<option value="Vietnam">Vietnam</option>
<option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
<option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
<option value="Wake Island">Wake Island</option>
<option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
<option value="Yemen">Yemen</option>
<option value="Zaire">Zaire</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabwe">Zimbabwe</option>
                               <?php } ?>
                            </select>

                        </div>

                        <div class=" input-effect">
                            <input class="effect-16" type="text" name="name" placeholder="">
                            <label><?=($plang?"إسمك":"Your Name")?> </label>
                            <span class="focus-border"></span>
                        </div>

                        <div class=" input-effect">
                            <input class="effect-16" type="text" name="email" placeholder="">
                            <label><?=($plang?"بريدك الالكتروني":"Your E-mail")?></label>
                            <span class="focus-border"></span>
                        </div>

                        <div class="input-effect">
                            <input class="effect-16" type="text" name="subject" placeholder="">
                            <label><?=($plang?"الموضوع":"Subject")?></label>
                            <span class="focus-border"></span>
                        </div>
                        <div class=" input-effect">
                            <input style="height: 90px;" class="effect-16" name="message" type="text" placeholder="">
                            <label><?=($plang?"رسالة":"Message")?></label>
                            <span class="focus-border"></span>
                        </div>
                        <p class="fif-w">
                            <input value="<?=($plang?"ارسال":"Submit")?>" name="btnSubmit" class="rol-submit" type="submit"><span class="ajax-loader"></span></p>

                    </form>
                </div>
            </div>

        </div>

<?php
include "inc/footer.php";
?>