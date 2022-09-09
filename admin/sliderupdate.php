<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "sliderinfo.php" ?>
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
$slider_update = new cslider_update();
$Page =& $slider_update;

// Page init processing
$slider_update->Page_Init();

// Page main processing
$slider_update->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var slider_update = new ew_Page("slider_update");

// page properties
slider_update.PageID = "update"; // page ID
var EW_PAGE_ID = slider_update.PageID; // for backward compatibility

// extend page with ValidateForm function
slider_update.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_image"];
		uelm = fobj.elements["u" + infix + "_image"];
		aelm = fobj.elements["a" + infix + "_image"];
		var chk_image = (aelm && aelm[0])?(aelm[2].checked):true;
		if (uelm && uelm.checked) {
			if (elm && chk_image && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - image");
		}
		elm = fobj.elements["x" + infix + "_image"];
		uelm = fobj.elements["u" + infix + "_image"];
		if (uelm && uelm.checked) {
			if (elm && !ew_CheckFileType(elm.value))
				return ew_OnError(this, elm, "File type is not allowed.");
		}
		elm = fobj.elements["x" + infix + "_order"];
		uelm = fobj.elements["u" + infix + "_order"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - order");
		}
		elm = fobj.elements["x" + infix + "_order"];
		uelm = fobj.elements["u" + infix + "_order"];
		if (uelm && uelm.checked) {
			if (elm && !ew_CheckInteger(elm.value))
				return ew_OnError(this, elm, "Incorrect integer - order");
		}
		elm = fobj.elements["x" + infix + "_active"];
		uelm = fobj.elements["u" + infix + "_active"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - active");
		}

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
slider_update.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
slider_update.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
slider_update.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
slider_update.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
slider_update.ShowHighlightText = "Show highlight"; 
slider_update.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">Update TABLE: slider<br><br>
<a href="<?php echo $slider->getReturnUrl() ?>">Back to List</a></span></p>
<?php $slider_update->ShowMessage() ?>
<form name="fsliderupdate" id="fsliderupdate" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return slider_update.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="slider">
<input type="hidden" name="a_update" id="a_update" value="U">
<?php for ($i = 0; $i < $slider_update->nKeySelected; $i++) { ?>
<input type="hidden" name="k<?php echo $i+1 ?>_key" id="key<?php echo $i+1 ?>" value="<?php echo ew_HtmlEncode($slider_update->arRecKeys[$i]) ?>">
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr class="ewTableHeader">
		<td>Update<input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"></td>
		<td>Field Name</td>
		<td>New Value</td>
	</tr>
<?php if ($slider->image->Visible) { // image ?>
	<tr<?php echo $slider->image->RowAttributes ?>>
		<td<?php echo $slider->image->CellAttributes() ?>>
<input type="checkbox" name="u_image" id="u_image" value="1"<?php echo ($slider->image->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $slider->image->CellAttributes() ?>>image</td>
		<td<?php echo $slider->image->CellAttributes() ?>><span id="el_image">
<div id="old_x_image">
<?php if ($slider->image->HrefValue <> "") { ?>
<?php if (!is_null($slider->image->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $slider->image->Upload->DbValue ?>" border=0<?php echo $slider->image->ViewAttributes() ?>>
<?php } elseif (!in_array($slider->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($slider->image->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $slider->image->Upload->DbValue ?>" border=0<?php echo $slider->image->ViewAttributes() ?>>
<?php } elseif (!in_array($slider->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_image">
<?php if (!is_null($slider->image->Upload->DbValue)) { ?>
<input type="radio" name="a_image" id="a_image" value="1" checked="checked">Keep&nbsp;
<input type="radio" name="a_image" id="a_image" value="2" disabled="disabled">Remove&nbsp;
<input type="radio" name="a_image" id="a_image" value="3">Replace<br>
<?php } else { ?>
<input type="hidden" name="a_image" id="a_image" value="3">
<?php } ?>
<input type="file" name="x_image" id="x_image" size="30" onchange="if (this.form.a_image[2]) this.form.a_image[2].checked=true;"<?php echo $slider->image->EditAttributes() ?>>
</div>
</span><?php echo $slider->image->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($slider->order->Visible) { // order ?>
	<tr<?php echo $slider->order->RowAttributes ?>>
		<td<?php echo $slider->order->CellAttributes() ?>>
<input type="checkbox" name="u_order" id="u_order" value="1"<?php echo ($slider->order->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $slider->order->CellAttributes() ?>>order</td>
		<td<?php echo $slider->order->CellAttributes() ?>><span id="el_order">
<input type="text" name="x_order" id="x_order" size="30" value="<?php echo $slider->order->EditValue ?>"<?php echo $slider->order->EditAttributes() ?>>
</span><?php echo $slider->order->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($slider->active->Visible) { // active ?>
	<tr<?php echo $slider->active->RowAttributes ?>>
		<td<?php echo $slider->active->CellAttributes() ?>>
<input type="checkbox" name="u_active" id="u_active" value="1"<?php echo ($slider->active->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $slider->active->CellAttributes() ?>>active</td>
		<td<?php echo $slider->active->CellAttributes() ?>><span id="el_active">
<div id="tp_x_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_active" id="x_active" value="{value}"<?php echo $slider->active->EditAttributes() ?>></div>
<div id="dsl_x_active" repeatcolumn="5">
<?php
$arwrk = $slider->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($slider->active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_active" id="x_active" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $slider->active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $slider->active->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="  Update  ">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$slider_update->Page_Terminate();
?>
<?php

//
// Page Class
//
class cslider_update {

	// Page ID
	var $PageID = 'update';

	// Table Name
	var $TableName = 'slider';

	// Page Object Name
	var $PageObjName = 'slider_update';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $slider;
		if ($slider->UseTokenInUrl) $PageUrl .= "t=" . $slider->TableVar . "&"; // add page token
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
		global $objForm, $slider;
		if ($slider->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($slider->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($slider->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cslider_update() {
		global $conn;

		// Initialize table object
		$GLOBALS["slider"] = new cslider();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'update', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'slider', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $slider;
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
		global $objForm, $gsFormError, $slider;

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
				$slider->CurrentAction = $_POST["a_update"];

				// Get record keys
				$sKey = @$_POST["k" . strval($this->nKeySelected+1) . "_key"];
				while ($sKey <> "") {
					$this->arRecKeys[$this->nKeySelected] = ew_StripSlashes($sKey);
					$this->nKeySelected++;
					$sKey = @$_POST["k" . strval($this->nKeySelected+1) . "_key"];
				}
				$this->GetUploadFiles(); // Get upload files
				$this->LoadFormValues(); // Get form values

				// Validate Form
				if (!$this->ValidateForm()) {
					$slider->CurrentAction = "I"; // Form error, reset action
					$this->setMessage($gsFormError);
				}
			}
		}
		if ($this->nKeySelected <= 0)
			$this->Page_Terminate("sliderlist.php"); // No records selected, return to list
		switch ($slider->CurrentAction) {
			case "U": // Update
				if ($this->UpdateRows()) { // Update Records based on key
					$this->setMessage("Update succeeded"); // Set update success message
					$this->Page_Terminate($slider->getReturnUrl()); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values
				}
		}

		// Render row
		$slider->RowType = EW_ROWTYPE_EDIT; // Render edit
		$this->RenderRow();
	}

	// Load initial values to form if field values are identical in all selected records
	function LoadMultiUpdateValues() {
		global $slider;
		$slider->CurrentFilter = $this->BuildKeyFilter();

		// Load recordset
		$rs = $this->LoadRecordset();
		$i = 1;
		while (!$rs->EOF) {
			if ($i == 1) {
				$slider->order->setDbValue($rs->fields('order'));
				$slider->active->setDbValue($rs->fields('active'));
			} else {
				if (!ew_CompareValue($slider->order->DbValue, $rs->fields('order')))
					$slider->order->CurrentValue = NULL;
				if (!ew_CompareValue($slider->active->DbValue, $rs->fields('active')))
					$slider->active->CurrentValue = NULL;
			}
			$i++;
			$rs->MoveNext();
		}
		$rs->Close();
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $slider;
		$sWrkFilter = "";
		foreach ($this->arRecKeys as $sKey) {
			$sKey = trim($sKey);
			if ($this->SetupKeyValues($sKey)) {
				$sFilter = $slider->KeyFilter();
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
		global $slider;
		$sKeyFld = $key;
		if (!is_numeric($sKeyFld))
			return FALSE;
		$slider->id->CurrentValue = $sKeyFld;
		return TRUE;
	}

	// Update all selected rows
	function UpdateRows() {
		global $conn, $slider;
		$conn->BeginTrans();

		// Get old recordset
		$slider->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $slider->SQL();
		$rsold = $conn->Execute($sSql);

		// Update all rows
		$sKey = "";
		foreach ($this->arRecKeys as $sThisKey) {
			$sThisKey = trim($sThisKey);
			if ($this->SetupKeyValues($sThisKey)) {
				$slider->SendEmail = FALSE; // Do not send email on update success
				$UpdateRows = $this->EditRow(); // Update this row
			} else {
				$UpdateRows = FALSE;
			}
			if (!$UpdateRows)
				return; // Update failed
			if ($sKey <> "") $sKey .= ", ";
			$sKey .= $sThisKey;
		}

		// Field image
		$slider->image->Upload->RemoveFromSession(); // Remove file value from Session

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
		global $objForm, $slider;

		// Get upload data
			$slider->image->Upload->Index = $objForm->Index;
			if ($slider->image->Upload->UploadFile()) {

				// No action required
			} else {
				echo $slider->image->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
		$slider->image->MultiUpdate = $objForm->GetValue("u_image");
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $slider;
		$slider->order->setFormValue($objForm->GetValue("x_order"));
		$slider->order->MultiUpdate = $objForm->GetValue("u_order");
		$slider->active->setFormValue($objForm->GetValue("x_active"));
		$slider->active->MultiUpdate = $objForm->GetValue("u_active");
		$slider->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $slider;
		$slider->id->CurrentValue = $slider->id->FormValue;
		$slider->order->CurrentValue = $slider->order->FormValue;
		$slider->active->CurrentValue = $slider->active->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $slider;

		// Call Recordset Selecting event
		$slider->Recordset_Selecting($slider->CurrentFilter);

		// Load list page SQL
		$sSql = $slider->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$slider->Recordset_Selected($rs);
		return $rs;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $slider;

		// Call Row_Rendering event
		$slider->Row_Rendering();

		// Common render codes for all row types
		// image

		$slider->image->CellCssStyle = "";
		$slider->image->CellCssClass = "";

		// order
		$slider->order->CellCssStyle = "";
		$slider->order->CellCssClass = "";

		// active
		$slider->active->CellCssStyle = "";
		$slider->active->CellCssClass = "";
		if ($slider->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$slider->id->ViewValue = $slider->id->CurrentValue;
			$slider->id->CssStyle = "";
			$slider->id->CssClass = "";
			$slider->id->ViewCustomAttributes = "";

			// image
			if (!is_null($slider->image->Upload->DbValue)) {
				$slider->image->ViewValue = $slider->image->Upload->DbValue;
				$slider->image->ImageWidth = 100;
				$slider->image->ImageHeight = 0;
				$slider->image->ImageAlt = "";
			} else {
				$slider->image->ViewValue = "";
			}
			$slider->image->CssStyle = "";
			$slider->image->CssClass = "";
			$slider->image->ViewCustomAttributes = "";

			// order
			$slider->order->ViewValue = $slider->order->CurrentValue;
			$slider->order->CssStyle = "";
			$slider->order->CssClass = "";
			$slider->order->ViewCustomAttributes = "";

			// active
			if (strval($slider->active->CurrentValue) <> "") {
				switch ($slider->active->CurrentValue) {
					case "0":
						$slider->active->ViewValue = "No";
						break;
					case "1":
						$slider->active->ViewValue = "Yes";
						break;
					default:
						$slider->active->ViewValue = $slider->active->CurrentValue;
				}
			} else {
				$slider->active->ViewValue = NULL;
			}
			$slider->active->CssStyle = "";
			$slider->active->CssClass = "";
			$slider->active->ViewCustomAttributes = "";

			// image
			$slider->image->HrefValue = "";

			// order
			$slider->order->HrefValue = "";

			// active
			$slider->active->HrefValue = "";
		} elseif ($slider->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// image
			$slider->image->EditCustomAttributes = "";
			if (!is_null($slider->image->Upload->DbValue)) {
				$slider->image->EditValue = $slider->image->Upload->DbValue;
				$slider->image->ImageWidth = 100;
				$slider->image->ImageHeight = 0;
				$slider->image->ImageAlt = "";
			} else {
				$slider->image->EditValue = "";
			}

			// order
			$slider->order->EditCustomAttributes = "";
			$slider->order->EditValue = ew_HtmlEncode($slider->order->CurrentValue);

			// active
			$slider->active->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$slider->active->EditValue = $arwrk;

			// Edit refer script
			// image

			$slider->image->HrefValue = "";

			// order
			$slider->order->HrefValue = "";

			// active
			$slider->active->HrefValue = "";
		}

		// Call Row Rendered event
		$slider->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $slider;

		// Initialize
		$gsFormError = "";
		$lUpdateCnt = 0;
		if ($slider->image->MultiUpdate == "1") $lUpdateCnt++;
		if ($slider->order->MultiUpdate == "1") $lUpdateCnt++;
		if ($slider->active->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = "No field selected for update";
			return FALSE;
		}
		if ($slider->image->MultiUpdate <> "") {
			if (!ew_CheckFileType($slider->image->Upload->FileName)) {
				$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
				$gsFormError .= "File type is not allowed.";
			}
			if ($slider->image->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
				if ($slider->image->Upload->FileSize > EW_MAX_FILE_SIZE)
					$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "Max. file size (%s bytes) exceeded.");
			}
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($slider->image->MultiUpdate <> "" && is_null($slider->image->Upload->Value)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - image";
		}
		if ($slider->order->MultiUpdate <> "" && $slider->order->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - order";
		}
		if ($slider->order->MultiUpdate <> "") {
			if (!ew_CheckInteger($slider->order->FormValue)) {
				if ($gsFormError <> "") $gsFormError .= "<br>";
				$gsFormError .= "Incorrect integer - order";
			}
		}
		if ($slider->active->MultiUpdate <> "" && $slider->active->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - active";
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
		global $conn, $Security, $slider;
		$sFilter = $slider->KeyFilter();
		$slider->CurrentFilter = $sFilter;
		$sSql = $slider->SQL();
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

			// Field image
			$slider->image->Upload->SaveToSession(); // Save file value to Session
						if ($slider->image->MultiUpdate == "1") {
if ($slider->image->Upload->Action == "2" || $slider->image->Upload->Action == "3") { // Update/Remove
			$slider->image->Upload->DbValue = $rs->fields('image'); // Get original value
			if (is_null($slider->image->Upload->Value)) {
				$rsnew['image'] = NULL;
			} else {
				if ($slider->image->Upload->FileName == $slider->image->Upload->DbValue) { // Upload file name same as old file name
					$rsnew['image'] = $slider->image->Upload->FileName;
				} else {
					$rsnew['image'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, "../images/"), $slider->image->Upload->FileName);
				}
			}
			}
}

			// Field order
						if ($slider->order->MultiUpdate == "1") {
			$slider->order->SetDbValueDef($slider->order->CurrentValue, 0);
			$rsnew['order'] =& $slider->order->DbValue;
			}

			// Field active
						if ($slider->active->MultiUpdate == "1") {
			$slider->active->SetDbValueDef($slider->active->CurrentValue, 0);
			$rsnew['active'] =& $slider->active->DbValue;
			}

			// Call Row Updating event
			$bUpdateRow = $slider->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {

			// Field image
			if (!is_null($slider->image->Upload->Value)) {
				if ($slider->image->Upload->FileName == $slider->image->Upload->DbValue) { // Overwrite if same file name
					$slider->image->Upload->SaveToFile("../images/", $rsnew['image'], TRUE);
					$slider->image->Upload->DbValue = ""; // No need to delete any more
				} else {
					$slider->image->Upload->SaveToFile("../images/", $rsnew['image'], FALSE);
				}
			}
			if ($slider->image->Upload->Action == "2" || $slider->image->Upload->Action == "3") { // Update/Remove
				if ($slider->image->Upload->DbValue <> "")
					@unlink(ew_UploadPathEx(TRUE, "../images/") . $slider->image->Upload->DbValue);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($slider->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($slider->CancelMessage <> "") {
					$this->setMessage($slider->CancelMessage);
					$slider->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$slider->Row_Updated($rsold, $rsnew);
		$rs->Close();

		// Field image
		$slider->image->Upload->RemoveFromSession(); // Remove file value from Session
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
