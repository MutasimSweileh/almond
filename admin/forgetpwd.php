<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "usersinfo.php" ?>
<?php include "userfn6.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Define page object
$forgetpwd = new cforgetpwd();
$Page =& $forgetpwd;

// Page init processing
$forgetpwd->Page_Init();

// Page main processing
$forgetpwd->Page_Main();
?>
<?php include "header.php" ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<script type="text/javascript">
<!--
var forgetpwd = new ew_Page("forgetpwd");

// extend page with ValidateForm function
forgetpwd.ValidateForm = function(fobj)
{
	if (!this.ValidateRequired)
		return true; // ignore validation
	if  (!ew_HasValue(fobj.email))
		return ew_OnError(this, fobj.email, "Please enter valid Email Address!");
	if  (!ew_CheckEmail(fobj.email.value))
		return ew_OnError(this, fobj.email, "Please enter valid Email Address!");

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	return true;
}

// extend page with Form_CustomValidate function
forgetpwd.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// requires js validation
<?php if (EW_CLIENT_VALIDATE) { ?>
forgetpwd.ValidateRequired = true;
<?php } else { ?>
forgetpwd.ValidateRequired = false;
<?php } ?>

//-->
</script>
<p><span class="phpmaker">Request Password Page<br><br>
<a href="login.php">Back to login page</a></span></p>
<?php $forgetpwd->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return forgetpwd.ValidateForm(this);">
<table border="0" cellspacing="0" cellpadding="4">
	<tr>
		<td><span class="phpmaker">User Email</span></td>
		<td><span class="phpmaker"><input type="text" name="email" id="email" value="<?php ew_HtmlEncode($forgetpwd->sEmail) ?>" size="30" maxlength="100"></span></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><span class="phpmaker"><input type="submit" name="submit" id="submit" value="Send Password"></span></td>
	</tr>
</table>
</form>
<br>
<script language="JavaScript" type="text/javascript">
<!--

// Write your startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$forgetpwd->Page_Terminate();
?>
<?php

//
// Page Class
//
class cforgetpwd {

	// Page ID
	var $PageID = 'forgetpwd';

	// Page Object Name
	var $PageObjName = 'forgetpwd';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EW_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EW_SESSION_MESSAGE] .= "<br>" . $v;
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = $v;
		}
	}

	// Show Message
	function ShowMessage() {
		if ($this->getMessage() <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $this->getMessage() . "</span></p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}

	// Validate Page request
	function IsPageRequest() {
		return TRUE;
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cforgetpwd() {
		global $conn;

		// Initialize table object
		$GLOBALS["users"] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'forgetpwd', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $users;
		global $Security;
		$Security = new cAdvancedSecurity();

		// Global page loading event (in userfn6.php)
		Page_Loading();

		// Page load event, used in current page
		$this->Page_Load();
	}

	//
	//  Page_Terminate
	//  - called when exit page
	//  - if URL specified, redirect to the URL
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page unload event, used in current page
		$this->Page_Unload();

		// Global page unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close Connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			ob_end_clean();
			header("Location: $url");
		}
		exit();
	}
	var $sEmail = "";

	//
	// Page main processing
	//
	function Page_Main() {
		global $conn, $gsFormError, $users;
		if (ew_IsHttpPost()) {
			$bValidEmail = FALSE;
			$bEmailSent = FALSE;

			// Setup variables
			$sEmail = $_POST["email"];
			if ($this->ValidateForm($sEmail)) {

				// Set up filter (SQL WHERE clause) and get Return SQL
				// SQL constructor in users class, usersinfo.php

				$sFilter = '`email` = ' . ew_QuotedValue($sEmail, EW_DATATYPE_STRING);
				$users->CurrentFilter = $sFilter;
				$sSql = $users->SQL();
				if ($RsUser = $conn->Execute($sSql)) {
					if (!$RsUser->EOF) {
						$sUserName = $RsUser->fields('username');
						$sPassword = $RsUser->fields('password');
						if (EW_MD5_PASSWORD) {
							$rsnew = array('password' => $sPassword); // Reset the password
							$conn->Execute($users->UpdateSQL($rsnew));
						}
						$bValidEmail = TRUE;
					} else {
						$this->setMessage("Invalid Email");
					}
					if ($bValidEmail) {
						$Email = new cEmail();
						$Email->Load("txt/forgetpwd.txt");
						$Email->ReplaceSender(EW_SENDER_EMAIL); // Replace Sender
						$Email->ReplaceRecipient($sEmail); // Replace Recipient
						$Email->ReplaceContent('<!--$UserName-->', $sUserName);
						$Email->ReplaceContent('<!--$Password-->', $sPassword);
						$Args = array();
						$Args["rs"] =& $rsnew;
						if ($this->Email_Sending($Email, $Args))
							$bEmailSent = $Email->Send();
					}
					$RsUser->Close();
				}
				if ($bEmailSent) {
					$this->setMessage("Password sent to your email"); // Set success message
					$this->Page_Terminate("login.php"); // Return to login page
				} elseif ($bValidEmail) {
					$this->setMessage("Failed to send mail"); // Set up error message
				}
			} else {
				$this->setMessage($gsFormError);
			}
		}
	}

	//
	// Validate form
	//
	function ValidateForm($email) {
		global $gsFormError;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if ($email == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter valid Email Address!";
		}
		if (!ew_CheckEmail($email)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter valid Email Address!";
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form Custom Validate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
