<?php
include_once ("classes/core.php");
$core = new core;
include ("inc/inc_formemail.php");
$name = pathinfo(basename($_SERVER["PHP_SELF"]))["filename"];
$lang = (strpos($name,"arabic")?"arabic":"english");
$plang = ($lang =="arabic" ?$lang:"");
$clang = ($lang =="english" ?"":"_arabic");
include  "inc/header.php";
if($pagg == 1 || $pagg == 2 || isv("level"))
include  "inc/slider.php";
if(@$_POST["btnSubmit"]) {
$_SESSION["cpost"]=$_POST;
$firstname  = $_POST["name"];
$email  = $_POST["email"];
$mobile  = $_POST["mobile"];
$subject  = $_POST["subject"];
$message  = $_POST["message"];
$adress  = $_POST["address"];
$phone  = $_POST["phone"];
$city  = $_POST["city"];
$country  = $_POST["country"];
$Product  = $_POST["Product"];


$writecode  = $_POST["writecode"];
$securitycode  = $_POST["securitycode"];

if($writecode == $securitycode){



$text = "I have sent the following message to you through a form on the web.<br />";

$text .= " Name  : $firstname <br />  Email  : $email <br />Country  : $country <br /> Subject  : $subject  ".($id?"<br /> Product  : $Product":"")."  <br /> Message  : $message <br />";

require("class.phpmailer.php");

$mail = new PHPMailer();

$mail->IsSMTP();
$mail->Host = "mail.sherktk.net";

$mail->SMTPAuth = true;
//$mail->SMTPSecure = "ssl";
$mail->Port = 587;
$mail->Username = "mail@sherktk.net";
$mail->Password = "JCrS%^)qc!eH";

$mail->From = "mail@sherktk.net";
$mail->FromName = $name;

$info_media["code"] = "email";
$contents = $core -> getinfo_media($info_media);
$emaills = $contents[0]["link"];

$mail->AddAddress($emaills);
//$mail->AddReplyTo("mail@mail.com");

$mail->IsHTML(true);

$mail->Subject = "Contact us";
$mail->Body = $text;
//$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

if(!$mail->Send())
{
 ?>

<script type="text/javascript">
alert("<?=trim(htmlspecialchars_decode(str_replace("</p>"," ",str_replace("<p>"," ",$mail->ErrorInfo))))?>");
</script>

<?php
}else{
  ?>
<script type="text/javascript">
alert("Thank you !!");
</script>  <?php  
}


}else{

 ?>
    <script type="text/javascript">
alert("íÑÌì ßÊÇÈÉ ÇáßæÏ ÇáÕÍíÍ");
</script>
<?php
}

}
if(isset($_POST["subscribe"])){
$text =  $_POST["email"];
require("class.phpmailer.php");
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = "mail.sherktk.net";

$mail->SMTPAuth = true;
//$mail->SMTPSecure = "ssl";
$mail->Port = 587;
$mail->Username = "mail@sherktk.net";
$mail->Password = "JCrS%^)qc!eH";

$mail->From = "mail@sherktk.net";

$mail->FromName = $name;
$info_media["code"] = "email";
$contents = $core -> getinfo_media($info_media);
$emaills = $contents[0]["link"];
$mail->AddAddress($emaills);
//$mail->AddReplyTo("mail@mail.com");
$mail->IsHTML(true);
$mail->Subject = "Subscribe";
$mail->Body = $text;

//$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
if($text)
$core->addemail(array("email"=>$_POST["email"]));
if($mail->Send()){
?>

<script type="text/javascript">
alert("Thank you !!");
</script>

<?php
}else{ ?>
    <script type="text/javascript">
alert("<?=trim(htmlspecialchars_decode(str_replace("</p>"," ",str_replace("<p>"," ",$mail->ErrorInfo))))?>");
</script>
<?php  } } ?>