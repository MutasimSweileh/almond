<?php  ?>
     <footer id="map" class="footer-xo">
            <div class="container">

                <div class="mar-head">
                    <div class="footer-top">
                        <div class="col-md-4 logo-footer">
                            <img src="images/logo.png">
                        </div>
                        <div class="col-md-8 about-footer">
                            <ul class="footer-ul">
                                 <?=getValue("footer_text",$lang)?>
                            </ul>
                        </div>
                    </div>
                    <div class="footer-bottom">
                        <div class="col-md-6 link-footer">
                            <h3 class="head-wed out">  <?=($plang?"روابط":"Quick links")?>	 </h3>
                            <ul class="use-links">
                                <li><a  class="list" href="index<?=$plang?>.php"><?=getTitle("index".$plang)?></a> </li>
                                <li> <a  class="list" href="about<?=$plang?>.php"><?=getTitle("about".$plang)?></a> </li>
                                <li><a  class="list" href="services<?=$plang?>.php"><?=getTitle("services".$plang)?></a> </li>
                                <li> <a  class="list" href="projects<?=$plang?>.php"><?=getTitle("projects".$plang)?></a> </li>
                                <li><a  class="list" href="clients<?=$plang?>.php"><?=getTitle("Partners".$plang)?></a></li>
                                <li><a    class="list"  href="contact<?=$plang?>.php"><?=getTitle("contact".$plang)?></a></li>
                            </ul>
                        </div>

                        <div class="col-md-6 news-footer">
                            <h3 class="head-wed"> <?=($plang?"القائمة البريدية":"newsletter")?></h3>
                            <?php if($plang){ ?><p class="txt">اشترك الان في القائمة البريدية لتلقي
                                <br> أحدث العروض والأخبار</p>      <?php } ?>
                            <form class="newletter" id="myForm" action="index<?=$plang?>.php" method="post">
                                <label><?=($plang?"اكتب بريدك":"Your Email")?></label>
                                <input name="email" type="email" class="">
<!--                                 <input value="<?=($plang?"اشتراك":"Subscribe")?>" data-sitekey="6LdBAIYUAAAAADAAHVGfL-lvvd3G5RoC_okE7vdm"   name="btnSubmit" class="but-news g-recaptcha" data-callback="onSubmit" type="submit"> -->
<button class="but-news"  value="subscribe"  name="subscribe" type="submit" ><?=($plang?"اشتراك":"Subscribe")?></button>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </footer>

        <div class="copy-right">
            <div class="container">
                <div class="content-copy">
                    <div class="col-md-6">
                        <p><?=$plang?"جميع الحقوق محفوظة ":"All Copyrights Reserved"?> &reg; <?=$alt?></p>
                    </div>

                    <div class="col-md-6">
                        <div class="social">
                            <a href="<?=getValue("facebook")?>" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="<?=getValue("twitter")?>" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="<?=getValue("instagram")?>" target="_blank"><i class="fa fa-instagram"></i> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery JS -->
        <script src="js/lightbox-plus-jquery.min.js"></script>
        <script src="js/jquery-1.12.0.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Animate JS -->
        <script src="vendors/animate/wow.min.js"></script>
        <!-- Camera Slider -->
        <script src="vendors/camera-slider/jquery.easing.1.3.js"></script>
        <script src="vendors/camera-slider/camera.min.js"></script>
        <!-- Isotope JS -->
        <script src="vendors/isotope/imagesloaded.pkgd.min.js"></script>
        <script src="vendors/isotope/isotope.pkgd.min.js"></script>
        <!-- Progress JS -->
        <script src="vendors/Counter-Up/jquery.counterup.min.js"></script>
        <script src="vendors/Counter-Up/waypoints.min.js"></script>
        <!-- Owlcarousel JS -->
        <script src="vendors/owl_carousel/owl.carousel.min.js"></script>
        <!-- Stellar JS -->
        <script src="vendors/stellar/jquery.stellar.js"></script>
        <!-- Theme JS -->
        <script src="js/theme.js"></script>
                     <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script type="text/javascript">
  /*  var onSubmit = function(response) {
        document.getElementById("myForm").submit(); // send response to your backend service
        }    */              </script>
        <script>
            $('.count').each(function() {
                $(this).prop('Counter', 0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 6000,
                    easing: 'swing',
                    step: function(now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            });

            var MyCheckboxes = $("input[name='mycheckboxes']");

            MyCheckboxes.change(function() {
                $(".showme").toggle(MyCheckboxes.is(":checked"));
            });
            $(".showme").toggle(MyCheckboxes.is(":checked"));
        </script>

        <script>
            var x, i, j, selElmnt, a, b, c;
            /*look for any elements with the class "custom-select":*/
            x = document.getElementsByClassName("custom-select");
            for (i = 0; i < x.length; i++) {
                selElmnt = x[i].getElementsByTagName("select")[0];
                /*for each element, create a new DIV that will act as the selected item:*/
                a = document.createElement("DIV");
                a.setAttribute("class", "select-selected");
                a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
                x[i].appendChild(a);
                /*for each element, create a new DIV that will contain the option list:*/
                b = document.createElement("DIV");
                b.setAttribute("class", "select-items select-hide");
                for (j = 1; j < selElmnt.length; j++) {
                    /*for each option in the original select element,
                    create a new DIV that will act as an option item:*/
                    c = document.createElement("DIV");
                    c.innerHTML = selElmnt.options[j].innerHTML;
                    c.addEventListener("click", function(e) {
                        /*when an item is clicked, update the original select box,
                        and the selected item:*/
                        var y, i, k, s, h;
                        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                        h = this.parentNode.previousSibling;
                        for (i = 0; i < s.length; i++) {
                            if (s.options[i].innerHTML == this.innerHTML) {
                                s.selectedIndex = i;
                                h.innerHTML = this.innerHTML;
                                y = this.parentNode.getElementsByClassName("same-as-selected");
                                for (k = 0; k < y.length; k++) {
                                    y[k].removeAttribute("class");
                                }
                                this.setAttribute("class", "same-as-selected");
                                break;
                            }
                        }
                        h.click();
                    });
                    b.appendChild(c);
                }
                x[i].appendChild(b);
                a.addEventListener("click", function(e) {
                    /*when the select box is clicked, close any other select boxes,
                    and open/close the current select box:*/
                    e.stopPropagation();
                    closeAllSelect(this);
                    this.nextSibling.classList.toggle("select-hide");
                    this.classList.toggle("select-arrow-active");
                });
            }

            function closeAllSelect(elmnt) {
                /*a function that will close all select boxes in the document,
                except the current select box:*/
                var x, y, i, arrNo = [];
                x = document.getElementsByClassName("select-items");
                y = document.getElementsByClassName("select-selected");
                for (i = 0; i < y.length; i++) {
                    if (elmnt == y[i]) {
                        arrNo.push(i)
                    } else {
                        y[i].classList.remove("select-arrow-active");
                    }
                }
                for (i = 0; i < x.length; i++) {
                    if (arrNo.indexOf(i)) {
                        x[i].classList.add("select-hide");
                    }
                }
            }
            /*if the user clicks anywhere outside the select box,
            then close all select boxes:*/
            document.addEventListener("click", closeAllSelect);
        </script>

        <script>
            $(document).ready(function() {
                $("#button").click(function(e) {
                    e.preventDefault();
                    $('html, body').animate({
                        scrollTop: $($.attr(this, 'href')).offset().top
                    }, 2000);
                });
            });

            $(document).ready(function() {
                $('a[href="#search"]').on('click', function(event) {
                    $('#search').addClass('open');
                    $('#search > form > input[type="search"]').focus();
                });
                $('#search, #search button.close2').on('click keyup', function(event) {
                    if (event.target == this || event.target.className == 'close2' || event.keyCode == 27) {
                        $(this).removeClass('open');
                    }
                });
            });

            function openSearchbox() {
                document.getElementById("search_box").classList.toggle("active");
                document.getElementById("searchbox-layer").style.display = "block";
            }

            function hidesearchbox() {
                document.getElementById("search_box").classList.toggle("active");
                document.getElementById("searchbox-layer").style.display = "none";
            }
        </script>

</body>

</html>