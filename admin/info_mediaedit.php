<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "info_mediainfo.php" ?>
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
$info_media_edit = new cinfo_media_edit();
$Page =& $info_media_edit;

// Page init processing
$info_media_edit->Page_Init();

// Page main processing
$info_media_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var info_media_edit = new ew_Page("info_media_edit");

// page properties
info_media_edit.PageID = "edit"; // page ID
var EW_PAGE_ID = info_media_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
info_media_edit.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_code"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - code");
		elm = fobj.elements["x" + infix + "_link"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - link");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
info_media_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
info_media_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
info_media_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
info_media_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
info_media_edit.ShowHighlightText = "Show highlight"; 
info_media_edit.HideHighlightText = "Hide highlight";

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker">Edit TABLE: info media<br><br>
<a href="<?php echo $info_media->getReturnUrl() ?>">Go Back</a></span></p>
<?php $info_media_edit->ShowMessage() ?>
<form name="finfo_mediaedit" id="finfo_mediaedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return info_media_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="info_media">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($info_media->id->Visible) { // id ?>
	<tr<?php echo $info_media->id->RowAttributes ?>>
		<td class="ewTableHeader">id</td>
		<td<?php echo $info_media->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $info_media->id->ViewAttributes() ?>><?php echo $info_media->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($info_media->id->CurrentValue) ?>">
</span><?php echo $info_media->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($info_media->code->Visible) { // code ?>
	<tr<?php echo $info_media->code->RowAttributes ?>>
		<td class="ewTableHeader">code<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $info_media->code->CellAttributes() ?>><span id="el_code">
<input type="text" name="x_code" id="x_code" size="30" maxlength="200" value="<?php echo $info_media->code->EditValue ?>"<?php echo $info_media->code->EditAttributes() ?>>
</span><?php echo $info_media->code->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($info_media->link->Visible) { // link ?>
	<tr<?php echo $info_media->link->RowAttributes ?>>
		<td class="ewTableHeader">link<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $info_media->link->CellAttributes() ?>><span id="el_link">
<textarea name="x_link" id="x_link" cols="35" rows="4"<?php echo $info_media->link->EditAttributes() ?>><?php echo $info_media->link->EditValue ?></textarea>
</span><?php echo $info_media->link->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="   Edit   ">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$info_media_edit->Page_Terminate();
?>
<?php

//
// Page Class
//
class cinfo_media_edit {

	// Page ID
	var $PageID = 'edit';

	// Table Name
	var $TableName = 'info_media';

	// Page Object Name
	var $PageObjName = 'info_media_edit';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $info_media;
		if ($info_media->UseTokenInUrl) $PageUrl .= "t=" . $info_media->TableVar . "&"; // add page token
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
		global $objForm, $info_media;
		if ($info_media->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($info_media->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($info_media->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cinfo_media_edit() {
		global $conn;

		// Initialize table object
		$GLOBALS["info_media"] = new cinfo_media();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'info_media', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $info_media;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

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

	// 
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsFormError, $info_media;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$info_media->id->setQueryStringValue($_GET["id"]);

		// Create form object
		$objForm = new cFormObj();
		if (@$_POST["a_edit"] <> "") {
			$info_media->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$info_media->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$this->RestoreFormValues();
			}
		} else {
			$info_media->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($info_media->id->CurrentValue == "")
			$this->Page_Terminate("info_medialist.php"); // Invalid key, return to list
		switch ($info_media->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage("No records found"); // No record found
					$this->Page_Terminate("info_medialist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$info_media->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage("Update succeeded"); // Update success
					$sReturnUrl = $info_media->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "info_mediaview.php")
						$sReturnUrl = $info_media->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$info_media->RowType = EW_ROWTYPE_EDIT; // Render as edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $info_media;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $info_media;
		$info_media->id->setFormValue($objForm->GetValue("x_id"));
		$info_media->code->setFormValue($objForm->GetValue("x_code"));
		$info_media->link->setFormValue($objForm->GetValue("x_link"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $info_media;
		$this->LoadRow();
		$info_media->id->CurrentValue = $info_media->id->FormValue;
		$info_media->code->CurrentValue = $info_media->code->FormValue;
		$info_media->link->CurrentValue = $info_media->link->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $info_media;
		$sFilter = $info_media->KeyFilter();

		// Call Row Selecting event
		$info_media->Row_Selecting($sFilter);

		// Load sql based on filter
		$info_media->CurrentFilter = $sFilter;
		$sSql = $info_media->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$info_media->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $info_media;
		$info_media->id->setDbValue($rs->fields('id'));
		$info_media->code->setDbValue($rs->fields('code'));
		$info_media->link->setDbValue($rs->fields('link'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $info_media;

		// Call Row_Rendering event
		$info_media->Row_Rendering();

		// Common render codes for all row types
		// id

		$info_media->id->CellCssStyle = "";
		$info_media->id->CellCssClass = "";

		// code
		$info_media->code->CellCssStyle = "";
		$info_media->code->CellCssClass = "";

		// link
		$info_media->link->CellCssStyle = "";
		$info_media->link->CellCssClass = "";
		if ($info_media->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$info_media->id->ViewValue = $info_media->id->CurrentValue;
			$info_media->id->CssStyle = "";
			$info_media->id->CssClass = "";
			$info_media->id->ViewCustomAttributes = "";

			// code
			$info_media->code->ViewValue = $info_media->code->CurrentValue;
			$info_media->code->CssStyle = "";
			$info_media->code->CssClass = "";
			$info_media->code->ViewCustomAttributes = "";

			// link
			$info_media->link->ViewValue = $info_media->link->CurrentValue;
			$info_media->link->CssStyle = "";
			$info_media->link->CssClass = "";
			$info_media->link->ViewCustomAttributes = "";

			// id
			$info_media->id->HrefValue = "";

			// code
			$info_media->code->HrefValue = "";

			// link
			$info_media->link->HrefValue = "";
		} elseif ($info_media->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$info_media->id->EditCustomAttributes = "";
			$info_media->id->EditValue = $info_media->id->CurrentValue;
			$info_media->id->CssStyle = "";
			$info_media->id->CssClass = "";
			$info_media->id->ViewCustomAttributes = "";

			// code
			$info_media->code->EditCustomAttributes = "";
			$info_media->code->EditValue = ew_HtmlEncode($info_media->code->CurrentValue);

			// link
			$info_media->link->EditCustomAttributes = "";
			$info_media->link->EditValue = ew_HtmlEncode($info_media->link->CurrentValue);

			// Edit refer script
			// id

			$info_media->id->HrefValue = "";

			// code
			$info_media->code->HrefValue = "";

			// link
			$info_media->link->HrefValue = "";
		}

		// Call Row Rendered event
		$info_media->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $info_media;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($info_media->code->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - code";
		}
		if ($info_media->link->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - link";
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $info_media;
		$sFilter = $info_media->KeyFilter();
		$info_media->CurrentFilter = $sFilter;
		$sSql = $info_media->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// Field id
			// Field code

			$info_media->code->SetDbValueDef($info_media->code->CurrentValue, "");
			$rsnew['code'] =& $info_media->code->DbValue;

			// Field link
			$info_media->link->SetDbValueDef($info_media->link->CurrentValue, "");
			$rsnew['link'] =& $info_media->link->DbValue;

			// Call Row Updating event
			$bUpdateRow = $info_media->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($info_media->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($info_media->CancelMessage <> "") {
					$this->setMessage($info_media->CancelMessage);
					$info_media->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$info_media->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
