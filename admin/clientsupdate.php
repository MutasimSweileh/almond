<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "clientsinfo.php" ?>
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
$clients_update = new cclients_update();
$Page =& $clients_update;

// Page init processing
$clients_update->Page_Init();

// Page main processing
$clients_update->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var clients_update = new ew_Page("clients_update");

// page properties
clients_update.PageID = "update"; // page ID
var EW_PAGE_ID = clients_update.PageID; // for backward compatibility

// extend page with ValidateForm function
clients_update.ValidateForm = function(fobj) {
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
clients_update.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
clients_update.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
clients_update.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
clients_update.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
clients_update.ShowHighlightText = "Show highlight"; 
clients_update.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">Update TABLE: clients<br><br>
<a href="<?php echo $clients->getReturnUrl() ?>">Back to List</a></span></p>
<?php $clients_update->ShowMessage() ?>
<form name="fclientsupdate" id="fclientsupdate" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return clients_update.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="clients">
<input type="hidden" name="a_update" id="a_update" value="U">
<?php for ($i = 0; $i < $clients_update->nKeySelected; $i++) { ?>
<input type="hidden" name="k<?php echo $i+1 ?>_key" id="key<?php echo $i+1 ?>" value="<?php echo ew_HtmlEncode($clients_update->arRecKeys[$i]) ?>">
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr class="ewTableHeader">
		<td>Update<input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"></td>
		<td>Field Name</td>
		<td>New Value</td>
	</tr>
<?php if ($clients->image->Visible) { // image ?>
	<tr<?php echo $clients->image->RowAttributes ?>>
		<td<?php echo $clients->image->CellAttributes() ?>>
<input type="checkbox" name="u_image" id="u_image" value="1"<?php echo ($clients->image->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $clients->image->CellAttributes() ?>>image</td>
		<td<?php echo $clients->image->CellAttributes() ?>><span id="el_image">
<div id="old_x_image">
<?php if ($clients->image->HrefValue <> "") { ?>
<?php if (!is_null($clients->image->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $clients->image->Upload->DbValue ?>" border=0<?php echo $clients->image->ViewAttributes() ?>>
<?php } elseif (!in_array($clients->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($clients->image->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $clients->image->Upload->DbValue ?>" border=0<?php echo $clients->image->ViewAttributes() ?>>
<?php } elseif (!in_array($clients->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_image">
<?php if (!is_null($clients->image->Upload->DbValue)) { ?>
<input type="radio" name="a_image" id="a_image" value="1" checked="checked">Keep&nbsp;
<input type="radio" name="a_image" id="a_image" value="2" disabled="disabled">Remove&nbsp;
<input type="radio" name="a_image" id="a_image" value="3">Replace<br>
<?php } else { ?>
<input type="hidden" name="a_image" id="a_image" value="3">
<?php } ?>
<input type="file" name="x_image" id="x_image" onchange="if (this.form.a_image[2]) this.form.a_image[2].checked=true;"<?php echo $clients->image->EditAttributes() ?>>
</div>
</span><?php echo $clients->image->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($clients->order->Visible) { // order ?>
	<tr<?php echo $clients->order->RowAttributes ?>>
		<td<?php echo $clients->order->CellAttributes() ?>>
<input type="checkbox" name="u_order" id="u_order" value="1"<?php echo ($clients->order->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $clients->order->CellAttributes() ?>>order</td>
		<td<?php echo $clients->order->CellAttributes() ?>><span id="el_order">
<input type="text" name="x_order" id="x_order" size="30" value="<?php echo $clients->order->EditValue ?>"<?php echo $clients->order->EditAttributes() ?>>
</span><?php echo $clients->order->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($clients->active->Visible) { // active ?>
	<tr<?php echo $clients->active->RowAttributes ?>>
		<td<?php echo $clients->active->CellAttributes() ?>>
<input type="checkbox" name="u_active" id="u_active" value="1"<?php echo ($clients->active->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $clients->active->CellAttributes() ?>>active</td>
		<td<?php echo $clients->active->CellAttributes() ?>><span id="el_active">
<div id="tp_x_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_active" id="x_active" value="{value}"<?php echo $clients->active->EditAttributes() ?>></div>
<div id="dsl_x_active" repeatcolumn="5">
<?php
$arwrk = $clients->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($clients->active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_active" id="x_active" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $clients->active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $clients->active->CustomMsg ?></td>
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
$clients_update->Page_Terminate();
?>
<?php

//
// Page Class
//
class cclients_update {

	// Page ID
	var $PageID = 'update';

	// Table Name
	var $TableName = 'clients';

	// Page Object Name
	var $PageObjName = 'clients_update';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $clients;
		if ($clients->UseTokenInUrl) $PageUrl .= "t=" . $clients->TableVar . "&"; // add page token
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
		global $objForm, $clients;
		if ($clients->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($clients->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($clients->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cclients_update() {
		global $conn;

		// Initialize table object
		$GLOBALS["clients"] = new cclients();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'update', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'clients', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $clients;
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
		global $objForm, $gsFormError, $clients;

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
				$clients->CurrentAction = $_POST["a_update"];

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
					$clients->CurrentAction = "I"; // Form error, reset action
					$this->setMessage($gsFormError);
				}
			}
		}
		if ($this->nKeySelected <= 0)
			$this->Page_Terminate("clientslist.php"); // No records selected, return to list
		switch ($clients->CurrentAction) {
			case "U": // Update
				if ($this->UpdateRows()) { // Update Records based on key
					$this->setMessage("Update succeeded"); // Set update success message
					$this->Page_Terminate($clients->getReturnUrl()); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values
				}
		}

		// Render row
		$clients->RowType = EW_ROWTYPE_EDIT; // Render edit
		$this->RenderRow();
	}

	// Load initial values to form if field values are identical in all selected records
	function LoadMultiUpdateValues() {
		global $clients;
		$clients->CurrentFilter = $this->BuildKeyFilter();

		// Load recordset
		$rs = $this->LoadRecordset();
		$i = 1;
		while (!$rs->EOF) {
			if ($i == 1) {
				$clients->order->setDbValue($rs->fields('order'));
				$clients->active->setDbValue($rs->fields('active'));
			} else {
				if (!ew_CompareValue($clients->order->DbValue, $rs->fields('order')))
					$clients->order->CurrentValue = NULL;
				if (!ew_CompareValue($clients->active->DbValue, $rs->fields('active')))
					$clients->active->CurrentValue = NULL;
			}
			$i++;
			$rs->MoveNext();
		}
		$rs->Close();
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $clients;
		$sWrkFilter = "";
		foreach ($this->arRecKeys as $sKey) {
			$sKey = trim($sKey);
			if ($this->SetupKeyValues($sKey)) {
				$sFilter = $clients->KeyFilter();
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
		global $clients;
		$sKeyFld = $key;
		if (!is_numeric($sKeyFld))
			return FALSE;
		$clients->id->CurrentValue = $sKeyFld;
		return TRUE;
	}

	// Update all selected rows
	function UpdateRows() {
		global $conn, $clients;
		$conn->BeginTrans();

		// Get old recordset
		$clients->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $clients->SQL();
		$rsold = $conn->Execute($sSql);

		// Update all rows
		$sKey = "";
		foreach ($this->arRecKeys as $sThisKey) {
			$sThisKey = trim($sThisKey);
			if ($this->SetupKeyValues($sThisKey)) {
				$clients->SendEmail = FALSE; // Do not send email on update success
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
		$clients->image->Upload->RemoveFromSession(); // Remove file value from Session

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
		global $objForm, $clients;

		// Get upload data
			$clients->image->Upload->Index = $objForm->Index;
			if ($clients->image->Upload->UploadFile()) {

				// No action required
			} else {
				echo $clients->image->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
		$clients->image->MultiUpdate = $objForm->GetValue("u_image");
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $clients;
		$clients->order->setFormValue($objForm->GetValue("x_order"));
		$clients->order->MultiUpdate = $objForm->GetValue("u_order");
		$clients->active->setFormValue($objForm->GetValue("x_active"));
		$clients->active->MultiUpdate = $objForm->GetValue("u_active");
		$clients->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $clients;
		$clients->id->CurrentValue = $clients->id->FormValue;
		$clients->order->CurrentValue = $clients->order->FormValue;
		$clients->active->CurrentValue = $clients->active->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $clients;

		// Call Recordset Selecting event
		$clients->Recordset_Selecting($clients->CurrentFilter);

		// Load list page SQL
		$sSql = $clients->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$clients->Recordset_Selected($rs);
		return $rs;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $clients;

		// Call Row_Rendering event
		$clients->Row_Rendering();

		// Common render codes for all row types
		// image

		$clients->image->CellCssStyle = "";
		$clients->image->CellCssClass = "";

		// order
		$clients->order->CellCssStyle = "";
		$clients->order->CellCssClass = "";

		// active
		$clients->active->CellCssStyle = "";
		$clients->active->CellCssClass = "";
		if ($clients->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$clients->id->ViewValue = $clients->id->CurrentValue;
			$clients->id->CssStyle = "";
			$clients->id->CssClass = "";
			$clients->id->ViewCustomAttributes = "";

			// image
			if (!is_null($clients->image->Upload->DbValue)) {
				$clients->image->ViewValue = $clients->image->Upload->DbValue;
				$clients->image->ImageWidth = 100;
				$clients->image->ImageHeight = 0;
				$clients->image->ImageAlt = "";
			} else {
				$clients->image->ViewValue = "";
			}
			$clients->image->CssStyle = "";
			$clients->image->CssClass = "";
			$clients->image->ViewCustomAttributes = "";

			// order
			$clients->order->ViewValue = $clients->order->CurrentValue;
			$clients->order->CssStyle = "";
			$clients->order->CssClass = "";
			$clients->order->ViewCustomAttributes = "";

			// active
			if (strval($clients->active->CurrentValue) <> "") {
				switch ($clients->active->CurrentValue) {
					case "0":
						$clients->active->ViewValue = "No";
						break;
					case "1":
						$clients->active->ViewValue = "Yes";
						break;
					default:
						$clients->active->ViewValue = $clients->active->CurrentValue;
				}
			} else {
				$clients->active->ViewValue = NULL;
			}
			$clients->active->CssStyle = "";
			$clients->active->CssClass = "";
			$clients->active->ViewCustomAttributes = "";

			// image
			$clients->image->HrefValue = "";

			// order
			$clients->order->HrefValue = "";

			// active
			$clients->active->HrefValue = "";
		} elseif ($clients->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// image
			$clients->image->EditCustomAttributes = "";
			if (!is_null($clients->image->Upload->DbValue)) {
				$clients->image->EditValue = $clients->image->Upload->DbValue;
				$clients->image->ImageWidth = 100;
				$clients->image->ImageHeight = 0;
				$clients->image->ImageAlt = "";
			} else {
				$clients->image->EditValue = "";
			}

			// order
			$clients->order->EditCustomAttributes = "";
			$clients->order->EditValue = ew_HtmlEncode($clients->order->CurrentValue);

			// active
			$clients->active->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$clients->active->EditValue = $arwrk;

			// Edit refer script
			// image

			$clients->image->HrefValue = "";

			// order
			$clients->order->HrefValue = "";

			// active
			$clients->active->HrefValue = "";
		}

		// Call Row Rendered event
		$clients->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $clients;

		// Initialize
		$gsFormError = "";
		$lUpdateCnt = 0;
		if ($clients->image->MultiUpdate == "1") $lUpdateCnt++;
		if ($clients->order->MultiUpdate == "1") $lUpdateCnt++;
		if ($clients->active->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = "No field selected for update";
			return FALSE;
		}
		if ($clients->image->MultiUpdate <> "") {
			if (!ew_CheckFileType($clients->image->Upload->FileName)) {
				$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
				$gsFormError .= "File type is not allowed.";
			}
			if ($clients->image->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
				if ($clients->image->Upload->FileSize > EW_MAX_FILE_SIZE)
					$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "Max. file size (%s bytes) exceeded.");
			}
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($clients->image->MultiUpdate <> "" && is_null($clients->image->Upload->Value)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - image";
		}
		if ($clients->order->MultiUpdate <> "" && $clients->order->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - order";
		}
		if ($clients->order->MultiUpdate <> "") {
			if (!ew_CheckInteger($clients->order->FormValue)) {
				if ($gsFormError <> "") $gsFormError .= "<br>";
				$gsFormError .= "Incorrect integer - order";
			}
		}
		if ($clients->active->MultiUpdate <> "" && $clients->active->FormValue == "") {
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
		global $conn, $Security, $clients;
		$sFilter = $clients->KeyFilter();
		$clients->CurrentFilter = $sFilter;
		$sSql = $clients->SQL();
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
			$clients->image->Upload->SaveToSession(); // Save file value to Session
						if ($clients->image->MultiUpdate == "1") {
if ($clients->image->Upload->Action == "2" || $clients->image->Upload->Action == "3") { // Update/Remove
			$clients->image->Upload->DbValue = $rs->fields('image'); // Get original value
			if (is_null($clients->image->Upload->Value)) {
				$rsnew['image'] = NULL;
			} else {
				if ($clients->image->Upload->FileName == $clients->image->Upload->DbValue) { // Upload file name same as old file name
					$rsnew['image'] = $clients->image->Upload->FileName;
				} else {
					$rsnew['image'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, "../images/"), $clients->image->Upload->FileName);
				}
			}
			}
}

			// Field order
						if ($clients->order->MultiUpdate == "1") {
			$clients->order->SetDbValueDef($clients->order->CurrentValue, 0);
			$rsnew['order'] =& $clients->order->DbValue;
			}

			// Field active
						if ($clients->active->MultiUpdate == "1") {
			$clients->active->SetDbValueDef($clients->active->CurrentValue, 0);
			$rsnew['active'] =& $clients->active->DbValue;
			}

			// Call Row Updating event
			$bUpdateRow = $clients->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {

			// Field image
			if (!is_null($clients->image->Upload->Value)) {
				if ($clients->image->Upload->FileName == $clients->image->Upload->DbValue) { // Overwrite if same file name
					$clients->image->Upload->SaveToFile("../images/", $rsnew['image'], TRUE);
					$clients->image->Upload->DbValue = ""; // No need to delete any more
				} else {
					$clients->image->Upload->SaveToFile("../images/", $rsnew['image'], FALSE);
				}
			}
			if ($clients->image->Upload->Action == "2" || $clients->image->Upload->Action == "3") { // Update/Remove
				if ($clients->image->Upload->DbValue <> "")
					@unlink(ew_UploadPathEx(TRUE, "../images/") . $clients->image->Upload->DbValue);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($clients->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($clients->CancelMessage <> "") {
					$this->setMessage($clients->CancelMessage);
					$clients->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$clients->Row_Updated($rsold, $rsnew);
		$rs->Close();

		// Field image
		$clients->image->Upload->RemoveFromSession(); // Remove file value from Session
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
