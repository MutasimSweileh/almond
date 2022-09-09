<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "about_iteminfo.php" ?>
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
$about_item_update = new cabout_item_update();
$Page =& $about_item_update;

// Page init processing
$about_item_update->Page_Init();

// Page main processing
$about_item_update->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var about_item_update = new ew_Page("about_item_update");

// page properties
about_item_update.PageID = "update"; // page ID
var EW_PAGE_ID = about_item_update.PageID; // for backward compatibility

// extend page with ValidateForm function
about_item_update.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_title"];
		uelm = fobj.elements["u" + infix + "_title"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - title");
		}
		elm = fobj.elements["x" + infix + "_title_arabic"];
		uelm = fobj.elements["u" + infix + "_title_arabic"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - title arabic");
		}
		elm = fobj.elements["x" + infix + "_text"];
		uelm = fobj.elements["u" + infix + "_text"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - text");
		}
		elm = fobj.elements["x" + infix + "_text_arabic"];
		uelm = fobj.elements["u" + infix + "_text_arabic"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - text arabic");
		}
		elm = fobj.elements["x" + infix + "_count"];
		uelm = fobj.elements["u" + infix + "_count"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - count");
		}
		elm = fobj.elements["x" + infix + "_count"];
		uelm = fobj.elements["u" + infix + "_count"];
		if (uelm && uelm.checked) {
			if (elm && !ew_CheckInteger(elm.value))
				return ew_OnError(this, elm, "Incorrect integer - count");
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
about_item_update.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
about_item_update.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
about_item_update.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
about_item_update.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
about_item_update.ShowHighlightText = "Show highlight"; 
about_item_update.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">Update TABLE: about item<br><br>
<a href="<?php echo $about_item->getReturnUrl() ?>">Back to List</a></span></p>
<?php $about_item_update->ShowMessage() ?>
<form name="fabout_itemupdate" id="fabout_itemupdate" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return about_item_update.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="about_item">
<input type="hidden" name="a_update" id="a_update" value="U">
<?php for ($i = 0; $i < $about_item_update->nKeySelected; $i++) { ?>
<input type="hidden" name="k<?php echo $i+1 ?>_key" id="key<?php echo $i+1 ?>" value="<?php echo ew_HtmlEncode($about_item_update->arRecKeys[$i]) ?>">
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr class="ewTableHeader">
		<td>Update<input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"></td>
		<td>Field Name</td>
		<td>New Value</td>
	</tr>
<?php if ($about_item->title->Visible) { // title ?>
	<tr<?php echo $about_item->title->RowAttributes ?>>
		<td<?php echo $about_item->title->CellAttributes() ?>>
<input type="checkbox" name="u_title" id="u_title" value="1"<?php echo ($about_item->title->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $about_item->title->CellAttributes() ?>>title</td>
		<td<?php echo $about_item->title->CellAttributes() ?>><span id="el_title">
<textarea name="x_title" id="x_title" cols="35" rows="4"<?php echo $about_item->title->EditAttributes() ?>><?php echo $about_item->title->EditValue ?></textarea>
</span><?php echo $about_item->title->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($about_item->title_arabic->Visible) { // title_arabic ?>
	<tr<?php echo $about_item->title_arabic->RowAttributes ?>>
		<td<?php echo $about_item->title_arabic->CellAttributes() ?>>
<input type="checkbox" name="u_title_arabic" id="u_title_arabic" value="1"<?php echo ($about_item->title_arabic->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $about_item->title_arabic->CellAttributes() ?>>title arabic</td>
		<td<?php echo $about_item->title_arabic->CellAttributes() ?>><span id="el_title_arabic">
<textarea name="x_title_arabic" id="x_title_arabic" cols="35" rows="4"<?php echo $about_item->title_arabic->EditAttributes() ?>><?php echo $about_item->title_arabic->EditValue ?></textarea>
</span><?php echo $about_item->title_arabic->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($about_item->text->Visible) { // text ?>
	<tr<?php echo $about_item->text->RowAttributes ?>>
		<td<?php echo $about_item->text->CellAttributes() ?>>
<input type="checkbox" name="u_text" id="u_text" value="1"<?php echo ($about_item->text->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $about_item->text->CellAttributes() ?>>text</td>
		<td<?php echo $about_item->text->CellAttributes() ?>><span id="el_text">
<textarea name="x_text" id="x_text" cols="35" rows="4"<?php echo $about_item->text->EditAttributes() ?>><?php echo $about_item->text->EditValue ?></textarea>
</span><?php echo $about_item->text->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($about_item->text_arabic->Visible) { // text_arabic ?>
	<tr<?php echo $about_item->text_arabic->RowAttributes ?>>
		<td<?php echo $about_item->text_arabic->CellAttributes() ?>>
<input type="checkbox" name="u_text_arabic" id="u_text_arabic" value="1"<?php echo ($about_item->text_arabic->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $about_item->text_arabic->CellAttributes() ?>>text arabic</td>
		<td<?php echo $about_item->text_arabic->CellAttributes() ?>><span id="el_text_arabic">
<textarea name="x_text_arabic" id="x_text_arabic" cols="35" rows="4"<?php echo $about_item->text_arabic->EditAttributes() ?>><?php echo $about_item->text_arabic->EditValue ?></textarea>
</span><?php echo $about_item->text_arabic->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($about_item->count->Visible) { // count ?>
	<tr<?php echo $about_item->count->RowAttributes ?>>
		<td<?php echo $about_item->count->CellAttributes() ?>>
<input type="checkbox" name="u_count" id="u_count" value="1"<?php echo ($about_item->count->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $about_item->count->CellAttributes() ?>>count</td>
		<td<?php echo $about_item->count->CellAttributes() ?>><span id="el_count">
<input type="text" name="x_count" id="x_count" size="30" value="<?php echo $about_item->count->EditValue ?>"<?php echo $about_item->count->EditAttributes() ?>>
</span><?php echo $about_item->count->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($about_item->order->Visible) { // order ?>
	<tr<?php echo $about_item->order->RowAttributes ?>>
		<td<?php echo $about_item->order->CellAttributes() ?>>
<input type="checkbox" name="u_order" id="u_order" value="1"<?php echo ($about_item->order->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $about_item->order->CellAttributes() ?>>order</td>
		<td<?php echo $about_item->order->CellAttributes() ?>><span id="el_order">
<input type="text" name="x_order" id="x_order" size="30" value="<?php echo $about_item->order->EditValue ?>"<?php echo $about_item->order->EditAttributes() ?>>
</span><?php echo $about_item->order->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($about_item->active->Visible) { // active ?>
	<tr<?php echo $about_item->active->RowAttributes ?>>
		<td<?php echo $about_item->active->CellAttributes() ?>>
<input type="checkbox" name="u_active" id="u_active" value="1"<?php echo ($about_item->active->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $about_item->active->CellAttributes() ?>>active</td>
		<td<?php echo $about_item->active->CellAttributes() ?>><span id="el_active">
<div id="tp_x_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_active" id="x_active" value="{value}"<?php echo $about_item->active->EditAttributes() ?>></div>
<div id="dsl_x_active" repeatcolumn="5">
<?php
$arwrk = $about_item->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($about_item->active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_active" id="x_active" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $about_item->active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $about_item->active->CustomMsg ?></td>
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
$about_item_update->Page_Terminate();
?>
<?php

//
// Page Class
//
class cabout_item_update {

	// Page ID
	var $PageID = 'update';

	// Table Name
	var $TableName = 'about_item';

	// Page Object Name
	var $PageObjName = 'about_item_update';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $about_item;
		if ($about_item->UseTokenInUrl) $PageUrl .= "t=" . $about_item->TableVar . "&"; // add page token
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
		global $objForm, $about_item;
		if ($about_item->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($about_item->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($about_item->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cabout_item_update() {
		global $conn;

		// Initialize table object
		$GLOBALS["about_item"] = new cabout_item();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'update', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'about_item', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $about_item;
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
		global $objForm, $gsFormError, $about_item;

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
				$about_item->CurrentAction = $_POST["a_update"];

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
					$about_item->CurrentAction = "I"; // Form error, reset action
					$this->setMessage($gsFormError);
				}
			}
		}
		if ($this->nKeySelected <= 0)
			$this->Page_Terminate("about_itemlist.php"); // No records selected, return to list
		switch ($about_item->CurrentAction) {
			case "U": // Update
				if ($this->UpdateRows()) { // Update Records based on key
					$this->setMessage("Update succeeded"); // Set update success message
					$this->Page_Terminate($about_item->getReturnUrl()); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values
				}
		}

		// Render row
		$about_item->RowType = EW_ROWTYPE_EDIT; // Render edit
		$this->RenderRow();
	}

	// Load initial values to form if field values are identical in all selected records
	function LoadMultiUpdateValues() {
		global $about_item;
		$about_item->CurrentFilter = $this->BuildKeyFilter();

		// Load recordset
		$rs = $this->LoadRecordset();
		$i = 1;
		while (!$rs->EOF) {
			if ($i == 1) {
				$about_item->title->setDbValue($rs->fields('title'));
				$about_item->title_arabic->setDbValue($rs->fields('title_arabic'));
				$about_item->text->setDbValue($rs->fields('text'));
				$about_item->text_arabic->setDbValue($rs->fields('text_arabic'));
				$about_item->count->setDbValue($rs->fields('count'));
				$about_item->order->setDbValue($rs->fields('order'));
				$about_item->active->setDbValue($rs->fields('active'));
			} else {
				if (!ew_CompareValue($about_item->title->DbValue, $rs->fields('title')))
					$about_item->title->CurrentValue = NULL;
				if (!ew_CompareValue($about_item->title_arabic->DbValue, $rs->fields('title_arabic')))
					$about_item->title_arabic->CurrentValue = NULL;
				if (!ew_CompareValue($about_item->text->DbValue, $rs->fields('text')))
					$about_item->text->CurrentValue = NULL;
				if (!ew_CompareValue($about_item->text_arabic->DbValue, $rs->fields('text_arabic')))
					$about_item->text_arabic->CurrentValue = NULL;
				if (!ew_CompareValue($about_item->count->DbValue, $rs->fields('count')))
					$about_item->count->CurrentValue = NULL;
				if (!ew_CompareValue($about_item->order->DbValue, $rs->fields('order')))
					$about_item->order->CurrentValue = NULL;
				if (!ew_CompareValue($about_item->active->DbValue, $rs->fields('active')))
					$about_item->active->CurrentValue = NULL;
			}
			$i++;
			$rs->MoveNext();
		}
		$rs->Close();
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $about_item;
		$sWrkFilter = "";
		foreach ($this->arRecKeys as $sKey) {
			$sKey = trim($sKey);
			if ($this->SetupKeyValues($sKey)) {
				$sFilter = $about_item->KeyFilter();
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
		global $about_item;
		$sKeyFld = $key;
		if (!is_numeric($sKeyFld))
			return FALSE;
		$about_item->id->CurrentValue = $sKeyFld;
		return TRUE;
	}

	// Update all selected rows
	function UpdateRows() {
		global $conn, $about_item;
		$conn->BeginTrans();

		// Get old recordset
		$about_item->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $about_item->SQL();
		$rsold = $conn->Execute($sSql);

		// Update all rows
		$sKey = "";
		foreach ($this->arRecKeys as $sThisKey) {
			$sThisKey = trim($sThisKey);
			if ($this->SetupKeyValues($sThisKey)) {
				$about_item->SendEmail = FALSE; // Do not send email on update success
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
		global $objForm, $about_item;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $about_item;
		$about_item->title->setFormValue($objForm->GetValue("x_title"));
		$about_item->title->MultiUpdate = $objForm->GetValue("u_title");
		$about_item->title_arabic->setFormValue($objForm->GetValue("x_title_arabic"));
		$about_item->title_arabic->MultiUpdate = $objForm->GetValue("u_title_arabic");
		$about_item->text->setFormValue($objForm->GetValue("x_text"));
		$about_item->text->MultiUpdate = $objForm->GetValue("u_text");
		$about_item->text_arabic->setFormValue($objForm->GetValue("x_text_arabic"));
		$about_item->text_arabic->MultiUpdate = $objForm->GetValue("u_text_arabic");
		$about_item->count->setFormValue($objForm->GetValue("x_count"));
		$about_item->count->MultiUpdate = $objForm->GetValue("u_count");
		$about_item->order->setFormValue($objForm->GetValue("x_order"));
		$about_item->order->MultiUpdate = $objForm->GetValue("u_order");
		$about_item->active->setFormValue($objForm->GetValue("x_active"));
		$about_item->active->MultiUpdate = $objForm->GetValue("u_active");
		$about_item->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $about_item;
		$about_item->id->CurrentValue = $about_item->id->FormValue;
		$about_item->title->CurrentValue = $about_item->title->FormValue;
		$about_item->title_arabic->CurrentValue = $about_item->title_arabic->FormValue;
		$about_item->text->CurrentValue = $about_item->text->FormValue;
		$about_item->text_arabic->CurrentValue = $about_item->text_arabic->FormValue;
		$about_item->count->CurrentValue = $about_item->count->FormValue;
		$about_item->order->CurrentValue = $about_item->order->FormValue;
		$about_item->active->CurrentValue = $about_item->active->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $about_item;

		// Call Recordset Selecting event
		$about_item->Recordset_Selecting($about_item->CurrentFilter);

		// Load list page SQL
		$sSql = $about_item->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$about_item->Recordset_Selected($rs);
		return $rs;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $about_item;

		// Call Row_Rendering event
		$about_item->Row_Rendering();

		// Common render codes for all row types
		// title

		$about_item->title->CellCssStyle = "";
		$about_item->title->CellCssClass = "";

		// title_arabic
		$about_item->title_arabic->CellCssStyle = "";
		$about_item->title_arabic->CellCssClass = "";

		// text
		$about_item->text->CellCssStyle = "";
		$about_item->text->CellCssClass = "";

		// text_arabic
		$about_item->text_arabic->CellCssStyle = "";
		$about_item->text_arabic->CellCssClass = "";

		// count
		$about_item->count->CellCssStyle = "";
		$about_item->count->CellCssClass = "";

		// order
		$about_item->order->CellCssStyle = "";
		$about_item->order->CellCssClass = "";

		// active
		$about_item->active->CellCssStyle = "";
		$about_item->active->CellCssClass = "";
		if ($about_item->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$about_item->id->ViewValue = $about_item->id->CurrentValue;
			$about_item->id->CssStyle = "";
			$about_item->id->CssClass = "";
			$about_item->id->ViewCustomAttributes = "";

			// title
			$about_item->title->ViewValue = $about_item->title->CurrentValue;
			$about_item->title->CssStyle = "";
			$about_item->title->CssClass = "";
			$about_item->title->ViewCustomAttributes = "";

			// title_arabic
			$about_item->title_arabic->ViewValue = $about_item->title_arabic->CurrentValue;
			$about_item->title_arabic->CssStyle = "";
			$about_item->title_arabic->CssClass = "";
			$about_item->title_arabic->ViewCustomAttributes = "";

			// text
			$about_item->text->ViewValue = $about_item->text->CurrentValue;
			$about_item->text->CssStyle = "";
			$about_item->text->CssClass = "";
			$about_item->text->ViewCustomAttributes = "";

			// text_arabic
			$about_item->text_arabic->ViewValue = $about_item->text_arabic->CurrentValue;
			$about_item->text_arabic->CssStyle = "";
			$about_item->text_arabic->CssClass = "";
			$about_item->text_arabic->ViewCustomAttributes = "";

			// count
			$about_item->count->ViewValue = $about_item->count->CurrentValue;
			$about_item->count->CssStyle = "";
			$about_item->count->CssClass = "";
			$about_item->count->ViewCustomAttributes = "";

			// order
			$about_item->order->ViewValue = $about_item->order->CurrentValue;
			$about_item->order->CssStyle = "";
			$about_item->order->CssClass = "";
			$about_item->order->ViewCustomAttributes = "";

			// active
			if (strval($about_item->active->CurrentValue) <> "") {
				switch ($about_item->active->CurrentValue) {
					case "0":
						$about_item->active->ViewValue = "No";
						break;
					case "1":
						$about_item->active->ViewValue = "Yes";
						break;
					default:
						$about_item->active->ViewValue = $about_item->active->CurrentValue;
				}
			} else {
				$about_item->active->ViewValue = NULL;
			}
			$about_item->active->CssStyle = "";
			$about_item->active->CssClass = "";
			$about_item->active->ViewCustomAttributes = "";

			// title
			$about_item->title->HrefValue = "";

			// title_arabic
			$about_item->title_arabic->HrefValue = "";

			// text
			$about_item->text->HrefValue = "";

			// text_arabic
			$about_item->text_arabic->HrefValue = "";

			// count
			$about_item->count->HrefValue = "";

			// order
			$about_item->order->HrefValue = "";

			// active
			$about_item->active->HrefValue = "";
		} elseif ($about_item->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// title
			$about_item->title->EditCustomAttributes = "";
			$about_item->title->EditValue = ew_HtmlEncode($about_item->title->CurrentValue);

			// title_arabic
			$about_item->title_arabic->EditCustomAttributes = "";
			$about_item->title_arabic->EditValue = ew_HtmlEncode($about_item->title_arabic->CurrentValue);

			// text
			$about_item->text->EditCustomAttributes = "";
			$about_item->text->EditValue = ew_HtmlEncode($about_item->text->CurrentValue);

			// text_arabic
			$about_item->text_arabic->EditCustomAttributes = "";
			$about_item->text_arabic->EditValue = ew_HtmlEncode($about_item->text_arabic->CurrentValue);

			// count
			$about_item->count->EditCustomAttributes = "";
			$about_item->count->EditValue = ew_HtmlEncode($about_item->count->CurrentValue);

			// order
			$about_item->order->EditCustomAttributes = "";
			$about_item->order->EditValue = ew_HtmlEncode($about_item->order->CurrentValue);

			// active
			$about_item->active->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$about_item->active->EditValue = $arwrk;

			// Edit refer script
			// title

			$about_item->title->HrefValue = "";

			// title_arabic
			$about_item->title_arabic->HrefValue = "";

			// text
			$about_item->text->HrefValue = "";

			// text_arabic
			$about_item->text_arabic->HrefValue = "";

			// count
			$about_item->count->HrefValue = "";

			// order
			$about_item->order->HrefValue = "";

			// active
			$about_item->active->HrefValue = "";
		}

		// Call Row Rendered event
		$about_item->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $about_item;

		// Initialize
		$gsFormError = "";
		$lUpdateCnt = 0;
		if ($about_item->title->MultiUpdate == "1") $lUpdateCnt++;
		if ($about_item->title_arabic->MultiUpdate == "1") $lUpdateCnt++;
		if ($about_item->text->MultiUpdate == "1") $lUpdateCnt++;
		if ($about_item->text_arabic->MultiUpdate == "1") $lUpdateCnt++;
		if ($about_item->count->MultiUpdate == "1") $lUpdateCnt++;
		if ($about_item->order->MultiUpdate == "1") $lUpdateCnt++;
		if ($about_item->active->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = "No field selected for update";
			return FALSE;
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($about_item->title->MultiUpdate <> "" && $about_item->title->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - title";
		}
		if ($about_item->title_arabic->MultiUpdate <> "" && $about_item->title_arabic->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - title arabic";
		}
		if ($about_item->text->MultiUpdate <> "" && $about_item->text->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - text";
		}
		if ($about_item->text_arabic->MultiUpdate <> "" && $about_item->text_arabic->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - text arabic";
		}
		if ($about_item->count->MultiUpdate <> "" && $about_item->count->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - count";
		}
		if ($about_item->count->MultiUpdate <> "") {
			if (!ew_CheckInteger($about_item->count->FormValue)) {
				if ($gsFormError <> "") $gsFormError .= "<br>";
				$gsFormError .= "Incorrect integer - count";
			}
		}
		if ($about_item->order->MultiUpdate <> "" && $about_item->order->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - order";
		}
		if ($about_item->order->MultiUpdate <> "") {
			if (!ew_CheckInteger($about_item->order->FormValue)) {
				if ($gsFormError <> "") $gsFormError .= "<br>";
				$gsFormError .= "Incorrect integer - order";
			}
		}
		if ($about_item->active->MultiUpdate <> "" && $about_item->active->FormValue == "") {
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
		global $conn, $Security, $about_item;
		$sFilter = $about_item->KeyFilter();
		$about_item->CurrentFilter = $sFilter;
		$sSql = $about_item->SQL();
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

			// Field title
						if ($about_item->title->MultiUpdate == "1") {
			$about_item->title->SetDbValueDef($about_item->title->CurrentValue, "");
			$rsnew['title'] =& $about_item->title->DbValue;
			}

			// Field title_arabic
						if ($about_item->title_arabic->MultiUpdate == "1") {
			$about_item->title_arabic->SetDbValueDef($about_item->title_arabic->CurrentValue, "");
			$rsnew['title_arabic'] =& $about_item->title_arabic->DbValue;
			}

			// Field text
						if ($about_item->text->MultiUpdate == "1") {
			$about_item->text->SetDbValueDef($about_item->text->CurrentValue, "");
			$rsnew['text'] =& $about_item->text->DbValue;
			}

			// Field text_arabic
						if ($about_item->text_arabic->MultiUpdate == "1") {
			$about_item->text_arabic->SetDbValueDef($about_item->text_arabic->CurrentValue, "");
			$rsnew['text_arabic'] =& $about_item->text_arabic->DbValue;
			}

			// Field count
						if ($about_item->count->MultiUpdate == "1") {
			$about_item->count->SetDbValueDef($about_item->count->CurrentValue, 0);
			$rsnew['count'] =& $about_item->count->DbValue;
			}

			// Field order
						if ($about_item->order->MultiUpdate == "1") {
			$about_item->order->SetDbValueDef($about_item->order->CurrentValue, 0);
			$rsnew['order'] =& $about_item->order->DbValue;
			}

			// Field active
						if ($about_item->active->MultiUpdate == "1") {
			$about_item->active->SetDbValueDef($about_item->active->CurrentValue, 0);
			$rsnew['active'] =& $about_item->active->DbValue;
			}

			// Call Row Updating event
			$bUpdateRow = $about_item->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($about_item->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($about_item->CancelMessage <> "") {
					$this->setMessage($about_item->CancelMessage);
					$about_item->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$about_item->Row_Updated($rsold, $rsnew);
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
