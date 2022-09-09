<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "searchengineinfo.php" ?>
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
$searchengine_update = new csearchengine_update();
$Page =& $searchengine_update;

// Page init processing
$searchengine_update->Page_Init();

// Page main processing
$searchengine_update->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var searchengine_update = new ew_Page("searchengine_update");

// page properties
searchengine_update.PageID = "update"; // page ID
var EW_PAGE_ID = searchengine_update.PageID; // for backward compatibility

// extend page with ValidateForm function
searchengine_update.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_zpage"];
		uelm = fobj.elements["u" + infix + "_zpage"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - page");
		}
		elm = fobj.elements["x" + infix + "_description"];
		uelm = fobj.elements["u" + infix + "_description"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - description");
		}
		elm = fobj.elements["x" + infix + "_keywords"];
		uelm = fobj.elements["u" + infix + "_keywords"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - keywords");
		}
		elm = fobj.elements["x" + infix + "_title"];
		uelm = fobj.elements["u" + infix + "_title"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - title");
		}

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
searchengine_update.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
searchengine_update.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
searchengine_update.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
searchengine_update.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
searchengine_update.ShowHighlightText = "Show highlight"; 
searchengine_update.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">Update TABLE: searchengine<br><br>
<a href="<?php echo $searchengine->getReturnUrl() ?>">Back to List</a></span></p>
<?php $searchengine_update->ShowMessage() ?>
<form name="fsearchengineupdate" id="fsearchengineupdate" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return searchengine_update.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="searchengine">
<input type="hidden" name="a_update" id="a_update" value="U">
<?php for ($i = 0; $i < $searchengine_update->nKeySelected; $i++) { ?>
<input type="hidden" name="k<?php echo $i+1 ?>_key" id="key<?php echo $i+1 ?>" value="<?php echo ew_HtmlEncode($searchengine_update->arRecKeys[$i]) ?>">
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr class="ewTableHeader">
		<td>Update<input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"></td>
		<td>Field Name</td>
		<td>New Value</td>
	</tr>
<?php if ($searchengine->zpage->Visible) { // page ?>
	<tr<?php echo $searchengine->zpage->RowAttributes ?>>
		<td<?php echo $searchengine->zpage->CellAttributes() ?>>
<input type="checkbox" name="u_zpage" id="u_zpage" value="1"<?php echo ($searchengine->zpage->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $searchengine->zpage->CellAttributes() ?>>page</td>
		<td<?php echo $searchengine->zpage->CellAttributes() ?>><span id="el_zpage">
<input type="text" name="x_zpage" id="x_zpage" size="30" maxlength="50" value="<?php echo $searchengine->zpage->EditValue ?>"<?php echo $searchengine->zpage->EditAttributes() ?>>
</span><?php echo $searchengine->zpage->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($searchengine->description->Visible) { // description ?>
	<tr<?php echo $searchengine->description->RowAttributes ?>>
		<td<?php echo $searchengine->description->CellAttributes() ?>>
<input type="checkbox" name="u_description" id="u_description" value="1"<?php echo ($searchengine->description->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $searchengine->description->CellAttributes() ?>>description</td>
		<td<?php echo $searchengine->description->CellAttributes() ?>><span id="el_description">
<textarea name="x_description" id="x_description" cols="35" rows="4"<?php echo $searchengine->description->EditAttributes() ?>><?php echo $searchengine->description->EditValue ?></textarea>
</span><?php echo $searchengine->description->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($searchengine->keywords->Visible) { // keywords ?>
	<tr<?php echo $searchengine->keywords->RowAttributes ?>>
		<td<?php echo $searchengine->keywords->CellAttributes() ?>>
<input type="checkbox" name="u_keywords" id="u_keywords" value="1"<?php echo ($searchengine->keywords->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $searchengine->keywords->CellAttributes() ?>>keywords</td>
		<td<?php echo $searchengine->keywords->CellAttributes() ?>><span id="el_keywords">
<textarea name="x_keywords" id="x_keywords" cols="35" rows="4"<?php echo $searchengine->keywords->EditAttributes() ?>><?php echo $searchengine->keywords->EditValue ?></textarea>
</span><?php echo $searchengine->keywords->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($searchengine->title->Visible) { // title ?>
	<tr<?php echo $searchengine->title->RowAttributes ?>>
		<td<?php echo $searchengine->title->CellAttributes() ?>>
<input type="checkbox" name="u_title" id="u_title" value="1"<?php echo ($searchengine->title->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $searchengine->title->CellAttributes() ?>>title</td>
		<td<?php echo $searchengine->title->CellAttributes() ?>><span id="el_title">
<input type="text" name="x_title" id="x_title" size="30" maxlength="250" value="<?php echo $searchengine->title->EditValue ?>"<?php echo $searchengine->title->EditAttributes() ?>>
</span><?php echo $searchengine->title->CustomMsg ?></td>
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
$searchengine_update->Page_Terminate();
?>
<?php

//
// Page Class
//
class csearchengine_update {

	// Page ID
	var $PageID = 'update';

	// Table Name
	var $TableName = 'searchengine';

	// Page Object Name
	var $PageObjName = 'searchengine_update';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $searchengine;
		if ($searchengine->UseTokenInUrl) $PageUrl .= "t=" . $searchengine->TableVar . "&"; // add page token
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
		global $objForm, $searchengine;
		if ($searchengine->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($searchengine->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($searchengine->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function csearchengine_update() {
		global $conn;

		// Initialize table object
		$GLOBALS["searchengine"] = new csearchengine();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'update', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'searchengine', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $searchengine;
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
		global $objForm, $gsFormError, $searchengine;

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
				$searchengine->CurrentAction = $_POST["a_update"];

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
					$searchengine->CurrentAction = "I"; // Form error, reset action
					$this->setMessage($gsFormError);
				}
			}
		}
		if ($this->nKeySelected <= 0)
			$this->Page_Terminate("searchenginelist.php"); // No records selected, return to list
		switch ($searchengine->CurrentAction) {
			case "U": // Update
				if ($this->UpdateRows()) { // Update Records based on key
					$this->setMessage("Update succeeded"); // Set update success message
					$this->Page_Terminate($searchengine->getReturnUrl()); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values
				}
		}

		// Render row
		$searchengine->RowType = EW_ROWTYPE_EDIT; // Render edit
		$this->RenderRow();
	}

	// Load initial values to form if field values are identical in all selected records
	function LoadMultiUpdateValues() {
		global $searchengine;
		$searchengine->CurrentFilter = $this->BuildKeyFilter();

		// Load recordset
		$rs = $this->LoadRecordset();
		$i = 1;
		while (!$rs->EOF) {
			if ($i == 1) {
				$searchengine->zpage->setDbValue($rs->fields('page'));
				$searchengine->description->setDbValue($rs->fields('description'));
				$searchengine->keywords->setDbValue($rs->fields('keywords'));
				$searchengine->title->setDbValue($rs->fields('title'));
			} else {
				if (!ew_CompareValue($searchengine->zpage->DbValue, $rs->fields('page')))
					$searchengine->zpage->CurrentValue = NULL;
				if (!ew_CompareValue($searchengine->description->DbValue, $rs->fields('description')))
					$searchengine->description->CurrentValue = NULL;
				if (!ew_CompareValue($searchengine->keywords->DbValue, $rs->fields('keywords')))
					$searchengine->keywords->CurrentValue = NULL;
				if (!ew_CompareValue($searchengine->title->DbValue, $rs->fields('title')))
					$searchengine->title->CurrentValue = NULL;
			}
			$i++;
			$rs->MoveNext();
		}
		$rs->Close();
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $searchengine;
		$sWrkFilter = "";
		foreach ($this->arRecKeys as $sKey) {
			$sKey = trim($sKey);
			if ($this->SetupKeyValues($sKey)) {
				$sFilter = $searchengine->KeyFilter();
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
		global $searchengine;
		$sKeyFld = $key;
		if (!is_numeric($sKeyFld))
			return FALSE;
		$searchengine->id->CurrentValue = $sKeyFld;
		return TRUE;
	}

	// Update all selected rows
	function UpdateRows() {
		global $conn, $searchengine;
		$conn->BeginTrans();

		// Get old recordset
		$searchengine->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $searchengine->SQL();
		$rsold = $conn->Execute($sSql);

		// Update all rows
		$sKey = "";
		foreach ($this->arRecKeys as $sThisKey) {
			$sThisKey = trim($sThisKey);
			if ($this->SetupKeyValues($sThisKey)) {
				$searchengine->SendEmail = FALSE; // Do not send email on update success
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
		global $objForm, $searchengine;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $searchengine;
		$searchengine->zpage->setFormValue($objForm->GetValue("x_zpage"));
		$searchengine->zpage->MultiUpdate = $objForm->GetValue("u_zpage");
		$searchengine->description->setFormValue($objForm->GetValue("x_description"));
		$searchengine->description->MultiUpdate = $objForm->GetValue("u_description");
		$searchengine->keywords->setFormValue($objForm->GetValue("x_keywords"));
		$searchengine->keywords->MultiUpdate = $objForm->GetValue("u_keywords");
		$searchengine->title->setFormValue($objForm->GetValue("x_title"));
		$searchengine->title->MultiUpdate = $objForm->GetValue("u_title");
		$searchengine->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $searchengine;
		$searchengine->id->CurrentValue = $searchengine->id->FormValue;
		$searchengine->zpage->CurrentValue = $searchengine->zpage->FormValue;
		$searchengine->description->CurrentValue = $searchengine->description->FormValue;
		$searchengine->keywords->CurrentValue = $searchengine->keywords->FormValue;
		$searchengine->title->CurrentValue = $searchengine->title->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $searchengine;

		// Call Recordset Selecting event
		$searchengine->Recordset_Selecting($searchengine->CurrentFilter);

		// Load list page SQL
		$sSql = $searchengine->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$searchengine->Recordset_Selected($rs);
		return $rs;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $searchengine;

		// Call Row_Rendering event
		$searchengine->Row_Rendering();

		// Common render codes for all row types
		// page

		$searchengine->zpage->CellCssStyle = "";
		$searchengine->zpage->CellCssClass = "";

		// description
		$searchengine->description->CellCssStyle = "";
		$searchengine->description->CellCssClass = "";

		// keywords
		$searchengine->keywords->CellCssStyle = "";
		$searchengine->keywords->CellCssClass = "";

		// title
		$searchengine->title->CellCssStyle = "";
		$searchengine->title->CellCssClass = "";
		if ($searchengine->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$searchengine->id->ViewValue = $searchengine->id->CurrentValue;
			$searchengine->id->CssStyle = "";
			$searchengine->id->CssClass = "";
			$searchengine->id->ViewCustomAttributes = "";

			// page
			$searchengine->zpage->ViewValue = $searchengine->zpage->CurrentValue;
			$searchengine->zpage->CssStyle = "";
			$searchengine->zpage->CssClass = "";
			$searchengine->zpage->ViewCustomAttributes = "";

			// description
			$searchengine->description->ViewValue = $searchengine->description->CurrentValue;
			$searchengine->description->CssStyle = "";
			$searchengine->description->CssClass = "";
			$searchengine->description->ViewCustomAttributes = "";

			// keywords
			$searchengine->keywords->ViewValue = $searchengine->keywords->CurrentValue;
			$searchengine->keywords->CssStyle = "";
			$searchengine->keywords->CssClass = "";
			$searchengine->keywords->ViewCustomAttributes = "";

			// title
			$searchengine->title->ViewValue = $searchengine->title->CurrentValue;
			$searchengine->title->CssStyle = "";
			$searchengine->title->CssClass = "";
			$searchengine->title->ViewCustomAttributes = "";

			// page
			$searchengine->zpage->HrefValue = "";

			// description
			$searchengine->description->HrefValue = "";

			// keywords
			$searchengine->keywords->HrefValue = "";

			// title
			$searchengine->title->HrefValue = "";
		} elseif ($searchengine->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// page
			$searchengine->zpage->EditCustomAttributes = "";
			$searchengine->zpage->EditValue = ew_HtmlEncode($searchengine->zpage->CurrentValue);

			// description
			$searchengine->description->EditCustomAttributes = "";
			$searchengine->description->EditValue = ew_HtmlEncode($searchengine->description->CurrentValue);

			// keywords
			$searchengine->keywords->EditCustomAttributes = "";
			$searchengine->keywords->EditValue = ew_HtmlEncode($searchengine->keywords->CurrentValue);

			// title
			$searchengine->title->EditCustomAttributes = "";
			$searchengine->title->EditValue = ew_HtmlEncode($searchengine->title->CurrentValue);

			// Edit refer script
			// page

			$searchengine->zpage->HrefValue = "";

			// description
			$searchengine->description->HrefValue = "";

			// keywords
			$searchengine->keywords->HrefValue = "";

			// title
			$searchengine->title->HrefValue = "";
		}

		// Call Row Rendered event
		$searchengine->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $searchengine;

		// Initialize
		$gsFormError = "";
		$lUpdateCnt = 0;
		if ($searchengine->zpage->MultiUpdate == "1") $lUpdateCnt++;
		if ($searchengine->description->MultiUpdate == "1") $lUpdateCnt++;
		if ($searchengine->keywords->MultiUpdate == "1") $lUpdateCnt++;
		if ($searchengine->title->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = "No field selected for update";
			return FALSE;
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($searchengine->zpage->MultiUpdate <> "" && $searchengine->zpage->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - page";
		}
		if ($searchengine->description->MultiUpdate <> "" && $searchengine->description->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - description";
		}
		if ($searchengine->keywords->MultiUpdate <> "" && $searchengine->keywords->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - keywords";
		}
		if ($searchengine->title->MultiUpdate <> "" && $searchengine->title->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - title";
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
		global $conn, $Security, $searchengine;
		$sFilter = $searchengine->KeyFilter();
		$searchengine->CurrentFilter = $sFilter;
		$sSql = $searchengine->SQL();
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

			// Field page
						if ($searchengine->zpage->MultiUpdate == "1") {
			$searchengine->zpage->SetDbValueDef($searchengine->zpage->CurrentValue, "");
			$rsnew['page'] =& $searchengine->zpage->DbValue;
			}

			// Field description
						if ($searchengine->description->MultiUpdate == "1") {
			$searchengine->description->SetDbValueDef($searchengine->description->CurrentValue, "");
			$rsnew['description'] =& $searchengine->description->DbValue;
			}

			// Field keywords
						if ($searchengine->keywords->MultiUpdate == "1") {
			$searchengine->keywords->SetDbValueDef($searchengine->keywords->CurrentValue, "");
			$rsnew['keywords'] =& $searchengine->keywords->DbValue;
			}

			// Field title
						if ($searchengine->title->MultiUpdate == "1") {
			$searchengine->title->SetDbValueDef($searchengine->title->CurrentValue, "");
			$rsnew['title'] =& $searchengine->title->DbValue;
			}

			// Call Row Updating event
			$bUpdateRow = $searchengine->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($searchengine->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($searchengine->CancelMessage <> "") {
					$this->setMessage($searchengine->CancelMessage);
					$searchengine->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$searchengine->Row_Updated($rsold, $rsnew);
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
