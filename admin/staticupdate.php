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
$static_update = new cstatic_update();
$Page =& $static_update;

// Page init processing
$static_update->Page_Init();

// Page main processing
$static_update->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var static_update = new ew_Page("static_update");

// page properties
static_update.PageID = "update"; // page ID
var EW_PAGE_ID = static_update.PageID; // for backward compatibility

// extend page with ValidateForm function
static_update.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	if (!ew_UpdateSelected(fobj)) {
		alert('No field selected for update');
		return false;
	}
	var uelm;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_code"];
		uelm = fobj.elements["u" + infix + "_code"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - code");
		}
		elm = fobj.elements["x" + infix + "_english"];
		uelm = fobj.elements["u" + infix + "_english"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - english");
		}
		elm = fobj.elements["x" + infix + "_arabic"];
		uelm = fobj.elements["u" + infix + "_arabic"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - arabic");
		}

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
static_update.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
static_update.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
static_update.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
static_update.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
static_update.ShowHighlightText = "Show highlight"; 
static_update.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">Update TABLE: static<br><br>
<a href="<?php echo $static->getReturnUrl() ?>">Back to List</a></span></p>
<?php $static_update->ShowMessage() ?>
<form name="fstaticupdate" id="fstaticupdate" action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="static">
<input type="hidden" name="a_update" id="a_update" value="U">
<?php for ($i = 0; $i < $static_update->nKeySelected; $i++) { ?>
<input type="hidden" name="k<?php echo $i+1 ?>_key" id="key<?php echo $i+1 ?>" value="<?php echo ew_HtmlEncode($static_update->arRecKeys[$i]) ?>">
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr class="ewTableHeader">
		<td>Update<input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"></td>
		<td>Field Name</td>
		<td>New Value</td>
	</tr>
<?php if ($static->code->Visible) { // code ?>
	<tr<?php echo $static->code->RowAttributes ?>>
		<td<?php echo $static->code->CellAttributes() ?>>
<input type="checkbox" name="u_code" id="u_code" value="1"<?php echo ($static->code->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $static->code->CellAttributes() ?>>code</td>
		<td<?php echo $static->code->CellAttributes() ?>><span id="el_code">
<input type="text" name="x_code" id="x_code" size="30" maxlength="100" value="<?php echo $static->code->EditValue ?>"<?php echo $static->code->EditAttributes() ?>>
</span><?php echo $static->code->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($static->english->Visible) { // english ?>
	<tr<?php echo $static->english->RowAttributes ?>>
		<td<?php echo $static->english->CellAttributes() ?>>
<input type="checkbox" name="u_english" id="u_english" value="1"<?php echo ($static->english->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $static->english->CellAttributes() ?>>english</td>
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
		<td<?php echo $static->arabic->CellAttributes() ?>>
<input type="checkbox" name="u_arabic" id="u_arabic" value="1"<?php echo ($static->arabic->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $static->arabic->CellAttributes() ?>>arabic</td>
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
<input type="button" name="btnAction" id="btnAction" value="  Update  " onclick="ew_SubmitForm(static_update, this.form);">
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
$static_update->Page_Terminate();
?>
<?php

//
// Page Class
//
class cstatic_update {

	// Page ID
	var $PageID = 'update';

	// Table Name
	var $TableName = 'static';

	// Page Object Name
	var $PageObjName = 'static_update';

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
	function cstatic_update() {
		global $conn;

		// Initialize table object
		$GLOBALS["static"] = new cstatic();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'update', TRUE);

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
	var $nKeySelected;
	var $arRecKeys;
	var $sDisabled;

	//
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsFormError, $static;

		// Try to load keys from list form
		$this->nKeySelected = 0;
		if (ew_IsHttpPost()) {
			if (isset($_POST["key_m"])) { // Key count > 0
				$this->nKeySelected = count($_POST["key_m"]); // Get number of keys
				$this->arRecKeys = ew_StripSlashes($_POST["key_m"]);
				$this->LoadMultiUpdateValues(); // Load initial values to form
			}
		}

		// Try to load key from update form
		if ($this->nKeySelected == 0) {
			$this->arRecKeys = array();

			// Create form object
			$objForm = new cFormObj();
			if (@$_POST["a_update"] <> "") {

				// Get action
				$static->CurrentAction = $_POST["a_update"];

				// Get record keys
				$sKey = @$_POST["k" . strval($this->nKeySelected+1) . "_key"];
				while ($sKey <> "") {
					$this->arRecKeys[$this->nKeySelected] = ew_StripSlashes($sKey);
					$this->nKeySelected++;
					$sKey = @$_POST["k" . strval($this->nKeySelected+1) . "_key"];
				}
				$this->LoadFormValues(); // Get form values

				// Validate Form
				if (!$this->ValidateForm()) {
					$static->CurrentAction = "I"; // Form error, reset action
					$this->setMessage($gsFormError);
				}
			}
		}
		if ($this->nKeySelected <= 0)
			$this->Page_Terminate("staticlist.php"); // No records selected, return to list
		switch ($static->CurrentAction) {
			case "U": // Update
				if ($this->UpdateRows()) { // Update Records based on key
					$this->setMessage("Update succeeded"); // Set update success message
					$this->Page_Terminate($static->getReturnUrl()); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values
				}
		}

		// Render row
		$static->RowType = EW_ROWTYPE_EDIT; // Render edit
		$this->RenderRow();
	}

	// Load initial values to form if field values are identical in all selected records
	function LoadMultiUpdateValues() {
		global $static;
		$static->CurrentFilter = $this->BuildKeyFilter();

		// Load recordset
		$rs = $this->LoadRecordset();
		$i = 1;
		while (!$rs->EOF) {
			if ($i == 1) {
				$static->code->setDbValue($rs->fields('code'));
				$static->english->setDbValue($rs->fields('english'));
				$static->arabic->setDbValue($rs->fields('arabic'));
			} else {
				if (!ew_CompareValue($static->code->DbValue, $rs->fields('code')))
					$static->code->CurrentValue = NULL;
				if (!ew_CompareValue($static->english->DbValue, $rs->fields('english')))
					$static->english->CurrentValue = NULL;
				if (!ew_CompareValue($static->arabic->DbValue, $rs->fields('arabic')))
					$static->arabic->CurrentValue = NULL;
			}
			$i++;
			$rs->MoveNext();
		}
		$rs->Close();
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $static;
		$sWrkFilter = "";
		foreach ($this->arRecKeys as $sKey) {
			$sKey = trim($sKey);
			if ($this->SetupKeyValues($sKey)) {
				$sFilter = $static->KeyFilter();
				if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
				$sWrkFilter .= $sFilter;
			} else {
				$sWrkFilter = "0=1";
				break;
			}
		}
		return $sWrkFilter;
	}

	// Set up key value
	function SetupKeyValues($key) {
		global $static;
		$sKeyFld = $key;
		if (!is_numeric($sKeyFld))
			return FALSE;
		$static->id->CurrentValue = $sKeyFld;
		return TRUE;
	}

	// Update all selected rows
	function UpdateRows() {
		global $conn, $static;
		$conn->BeginTrans();

		// Get old recordset
		$static->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $static->SQL();
		$rsold = $conn->Execute($sSql);

		// Update all rows
		$sKey = "";
		foreach ($this->arRecKeys as $sThisKey) {
			$sThisKey = trim($sThisKey);
			if ($this->SetupKeyValues($sThisKey)) {
				$static->SendEmail = FALSE; // Do not send email on update success
				$UpdateRows = $this->EditRow(); // Update this row
			} else {
				$UpdateRows = FALSE;
			}
			if (!$UpdateRows)
				return; // Update failed
			if ($sKey <> "") $sKey .= ", ";
			$sKey .= $sThisKey;
		}

		// Check if all rows updated
		if ($UpdateRows) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			$rsnew = $conn->Execute($sSql);
		} else {
			$conn->RollbackTrans(); // Rollback transaction
		}
		return $UpdateRows;
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
		$static->code->setFormValue($objForm->GetValue("x_code"));
		$static->code->MultiUpdate = $objForm->GetValue("u_code");
		$static->english->setFormValue($objForm->GetValue("x_english"));
		$static->english->MultiUpdate = $objForm->GetValue("u_english");
		$static->arabic->setFormValue($objForm->GetValue("x_arabic"));
		$static->arabic->MultiUpdate = $objForm->GetValue("u_arabic");
		$static->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $static;
		$static->id->CurrentValue = $static->id->FormValue;
		$static->code->CurrentValue = $static->code->FormValue;
		$static->english->CurrentValue = $static->english->FormValue;
		$static->arabic->CurrentValue = $static->arabic->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $static;

		// Call Recordset Selecting event
		$static->Recordset_Selecting($static->CurrentFilter);

		// Load list page SQL
		$sSql = $static->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$static->Recordset_Selected($rs);
		return $rs;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $static;

		// Call Row_Rendering event
		$static->Row_Rendering();

		// Common render codes for all row types
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

			// code
			$static->code->HrefValue = "";

			// english
			$static->english->HrefValue = "";

			// arabic
			$static->arabic->HrefValue = "";
		} elseif ($static->RowType == EW_ROWTYPE_EDIT) { // Edit row

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
		$lUpdateCnt = 0;
		if ($static->code->MultiUpdate == "1") $lUpdateCnt++;
		if ($static->english->MultiUpdate == "1") $lUpdateCnt++;
		if ($static->arabic->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = "No field selected for update";
			return FALSE;
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($static->code->MultiUpdate <> "" && $static->code->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - code";
		}
		if ($static->english->MultiUpdate <> "" && $static->english->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - english";
		}
		if ($static->arabic->MultiUpdate <> "" && $static->arabic->FormValue == "") {
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

			// Field code
						if ($static->code->MultiUpdate == "1") {
			$static->code->SetDbValueDef($static->code->CurrentValue, "");
			$rsnew['code'] =& $static->code->DbValue;
			}

			// Field english
						if ($static->english->MultiUpdate == "1") {
			$static->english->SetDbValueDef($static->english->CurrentValue, "");
			$rsnew['english'] =& $static->english->DbValue;
			}

			// Field arabic
						if ($static->arabic->MultiUpdate == "1") {
			$static->arabic->SetDbValueDef($static->arabic->CurrentValue, "");
			$rsnew['arabic'] =& $static->arabic->DbValue;
			}

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
