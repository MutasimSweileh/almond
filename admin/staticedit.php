<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "staticinfo.php" ?>
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
$static_edit = new cstatic_edit();
$Page =& $static_edit;

// Page init processing
$static_edit->Page_Init();

// Page main processing
$static_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var static_edit = new ew_Page("static_edit");

// page properties
static_edit.PageID = "edit"; // page ID
var EW_PAGE_ID = static_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
static_edit.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_english"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - english");
		elm = fobj.elements["x" + infix + "_arabic"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - arabic");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
static_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
static_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
static_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
static_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
static_edit.ShowHighlightText = "Show highlight"; 
static_edit.HideHighlightText = "Hide highlight";

//-->
</script>
<script type="text/javascript" src="fckeditor/fckeditor.js"></script>
<script type="text/javascript">
<!--
_width_multiplier = 16;
_height_multiplier = 60;
var ew_DHTMLEditors = [];

// update value from editor to textarea
function ew_UpdateTextArea() {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof FCKeditorAPI != 'undefined') {			
			var inst;			
			for (inst in FCKeditorAPI.__Instances)
				FCKeditorAPI.__Instances[inst].UpdateLinkedField();
	}
}

// update value from textarea to editor
function ew_UpdateDHTMLEditor(name) {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof FCKeditorAPI != 'undefined') {
		var inst = FCKeditorAPI.GetInstance(name);		
		if (inst)
			inst.SetHTML(inst.LinkedField.value)
	}
}

// focus editor
function ew_FocusDHTMLEditor(name) {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof FCKeditorAPI != 'undefined') {
		var inst = FCKeditorAPI.GetInstance(name);	
		if (inst && inst.EditorWindow) {
			inst.EditorWindow.focus();
		}
	}
}

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker">Edit TABLE: static<br><br>
<a href="<?php echo $static->getReturnUrl() ?>">Go Back</a></span></p>
<?php $static_edit->ShowMessage() ?>
<form name="fstaticedit" id="fstaticedit" action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="a_table" id="a_table" value="static">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($static->id->Visible) { // id ?>
	<tr<?php echo $static->id->RowAttributes ?>>
		<td class="ewTableHeader">id</td>
		<td<?php echo $static->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $static->id->ViewAttributes() ?>><?php echo $static->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($static->id->CurrentValue) ?>">
</span><?php echo $static->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($static->code->Visible) { // code ?>
	<tr<?php echo $static->code->RowAttributes ?>>
		<td class="ewTableHeader">code<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $static->code->CellAttributes() ?>><span id="el_code">
<input type="text" name="x_code" id="x_code" size="30" maxlength="100" value="<?php echo $static->code->EditValue ?>"<?php echo $static->code->EditAttributes() ?>>
</span><?php echo $static->code->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($static->english->Visible) { // english ?>
	<tr<?php echo $static->english->RowAttributes ?>>
		<td class="ewTableHeader">english<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $static->english->CellAttributes() ?>><span id="el_english">
<textarea name="x_english" id="x_english" cols="40" rows="10"<?php echo $static->english->EditAttributes() ?>><?php echo $static->english->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_english", function() {
	var sBasePath = 'fckeditor/';
	var oFCKeditor = new FCKeditor('x_english', 40*_width_multiplier, 10*_height_multiplier);
	oFCKeditor.BasePath = sBasePath;
	oFCKeditor.ReplaceTextarea();
	this.active = true;
}));
-->
</script>
</span><?php echo $static->english->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($static->arabic->Visible) { // arabic ?>
	<tr<?php echo $static->arabic->RowAttributes ?>>
		<td class="ewTableHeader">arabic<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $static->arabic->CellAttributes() ?>><span id="el_arabic">
<textarea name="x_arabic" id="x_arabic" cols="40" rows="10"<?php echo $static->arabic->EditAttributes() ?>><?php echo $static->arabic->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_arabic", function() {
	var sBasePath = 'fckeditor/';
	var oFCKeditor = new FCKeditor('x_arabic', 40*_width_multiplier, 10*_height_multiplier);
	oFCKeditor.BasePath = sBasePath;
	oFCKeditor.ReplaceTextarea();
	this.active = true;
}));
-->
</script>
</span><?php echo $static->arabic->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="button" name="btnAction" id="btnAction" value="   Edit   " onclick="ew_SubmitForm(static_edit, this.form);">
</form>
<script type="text/javascript">
<!--
ew_CreateEditor();  // Create DHTML editor(s)

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$static_edit->Page_Terminate();
?>
<?php

//
// Page Class
//
class cstatic_edit {

	// Page ID
	var $PageID = 'edit';

	// Table Name
	var $TableName = 'static';

	// Page Object Name
	var $PageObjName = 'static_edit';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $static;
		if ($static->UseTokenInUrl) $PageUrl .= "t=" . $static->TableVar . "&"; // add page token
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
		global $objForm, $static;
		if ($static->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($static->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($static->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cstatic_edit() {
		global $conn;

		// Initialize table object
		$GLOBALS["static"] = new cstatic();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'static', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $static;
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
		global $objForm, $gsFormError, $static;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$static->id->setQueryStringValue($_GET["id"]);

		// Create form object
		$objForm = new cFormObj();
		if (@$_POST["a_edit"] <> "") {
			$static->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$static->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$this->RestoreFormValues();
			}
		} else {
			$static->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($static->id->CurrentValue == "")
			$this->Page_Terminate("staticlist.php"); // Invalid key, return to list
		switch ($static->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage("No records found"); // No record found
					$this->Page_Terminate("staticlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$static->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage("Update succeeded"); // Update success
					$sReturnUrl = $static->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "staticview.php")
						$sReturnUrl = $static->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$static->RowType = EW_ROWTYPE_EDIT; // Render as edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $static;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $static;
		$static->id->setFormValue($objForm->GetValue("x_id"));
		$static->code->setFormValue($objForm->GetValue("x_code"));
		$static->english->setFormValue($objForm->GetValue("x_english"));
		$static->arabic->setFormValue($objForm->GetValue("x_arabic"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $static;
		$this->LoadRow();
		$static->id->CurrentValue = $static->id->FormValue;
		$static->code->CurrentValue = $static->code->FormValue;
		$static->english->CurrentValue = $static->english->FormValue;
		$static->arabic->CurrentValue = $static->arabic->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $static;
		$sFilter = $static->KeyFilter();

		// Call Row Selecting event
		$static->Row_Selecting($sFilter);

		// Load sql based on filter
		$static->CurrentFilter = $sFilter;
		$sSql = $static->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$static->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $static;
		$static->id->setDbValue($rs->fields('id'));
		$static->code->setDbValue($rs->fields('code'));
		$static->english->setDbValue($rs->fields('english'));
		$static->arabic->setDbValue($rs->fields('arabic'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $static;

		// Call Row_Rendering event
		$static->Row_Rendering();

		// Common render codes for all row types
		// id

		$static->id->CellCssStyle = "";
		$static->id->CellCssClass = "";

		// code
		$static->code->CellCssStyle = "";
		$static->code->CellCssClass = "";

		// english
		$static->english->CellCssStyle = "";
		$static->english->CellCssClass = "";

		// arabic
		$static->arabic->CellCssStyle = "";
		$static->arabic->CellCssClass = "";
		if ($static->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$static->id->ViewValue = $static->id->CurrentValue;
			$static->id->CssStyle = "";
			$static->id->CssClass = "";
			$static->id->ViewCustomAttributes = "";

			// code
			$static->code->ViewValue = $static->code->CurrentValue;
			$static->code->CssStyle = "";
			$static->code->CssClass = "";
			$static->code->ViewCustomAttributes = "";

			// english
			$static->english->ViewValue = $static->english->CurrentValue;
			$static->english->CssStyle = "";
			$static->english->CssClass = "";
			$static->english->ViewCustomAttributes = "";

			// arabic
			$static->arabic->ViewValue = $static->arabic->CurrentValue;
			$static->arabic->CssStyle = "";
			$static->arabic->CssClass = "";
			$static->arabic->ViewCustomAttributes = "";

			// id
			$static->id->HrefValue = "";

			// code
			$static->code->HrefValue = "";

			// english
			$static->english->HrefValue = "";

			// arabic
			$static->arabic->HrefValue = "";
		} elseif ($static->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$static->id->EditCustomAttributes = "";
			$static->id->EditValue = $static->id->CurrentValue;
			$static->id->CssStyle = "";
			$static->id->CssClass = "";
			$static->id->ViewCustomAttributes = "";

			// code
			$static->code->EditCustomAttributes = "";
			$static->code->EditValue = ew_HtmlEncode($static->code->CurrentValue);

			// english
			$static->english->EditCustomAttributes = "";
			$static->english->EditValue = ew_HtmlEncode($static->english->CurrentValue);

			// arabic
			$static->arabic->EditCustomAttributes = "";
			$static->arabic->EditValue = ew_HtmlEncode($static->arabic->CurrentValue);

			// Edit refer script
			// id

			$static->id->HrefValue = "";

			// code
			$static->code->HrefValue = "";

			// english
			$static->english->HrefValue = "";

			// arabic
			$static->arabic->HrefValue = "";
		}

		// Call Row Rendered event
		$static->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $static;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($static->code->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - code";
		}
		if ($static->english->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - english";
		}
		if ($static->arabic->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - arabic";
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
		global $conn, $Security, $static;
		$sFilter = $static->KeyFilter();
		$static->CurrentFilter = $sFilter;
		$sSql = $static->SQL();
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

			$static->code->SetDbValueDef($static->code->CurrentValue, "");
			$rsnew['code'] =& $static->code->DbValue;

			// Field english
			$static->english->SetDbValueDef($static->english->CurrentValue, "");
			$rsnew['english'] =& $static->english->DbValue;

			// Field arabic
			$static->arabic->SetDbValueDef($static->arabic->CurrentValue, "");
			$rsnew['arabic'] =& $static->arabic->DbValue;

			// Call Row Updating event
			$bUpdateRow = $static->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($static->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($static->CancelMessage <> "") {
					$this->setMessage($static->CancelMessage);
					$static->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$static->Row_Updated($rsold, $rsnew);
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
