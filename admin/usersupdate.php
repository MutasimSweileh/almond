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
$users_update = new cusers_update();
$Page =& $users_update;

// Page init processing
$users_update->Page_Init();

// Page main processing
$users_update->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var users_update = new ew_Page("users_update");

// page properties
users_update.PageID = "update"; // page ID
var EW_PAGE_ID = users_update.PageID; // for backward compatibility

// extend page with ValidateForm function
users_update.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_username"];
		uelm = fobj.elements["u" + infix + "_username"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - username");
		}
		elm = fobj.elements["x" + infix + "_password"];
		uelm = fobj.elements["u" + infix + "_password"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - password");
		}
		elm = fobj.elements["x" + infix + "_zemail"];
		uelm = fobj.elements["u" + infix + "_zemail"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - email");
		}

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
users_update.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
users_update.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
users_update.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
users_update.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
users_update.ShowHighlightText = "Show highlight"; 
users_update.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">Update TABLE: users<br><br>
<a href="<?php echo $users->getReturnUrl() ?>">Back to List</a></span></p>
<?php $users_update->ShowMessage() ?>
<form name="fusersupdate" id="fusersupdate" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return users_update.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="users">
<input type="hidden" name="a_update" id="a_update" value="U">
<?php for ($i = 0; $i < $users_update->nKeySelected; $i++) { ?>
<input type="hidden" name="k<?php echo $i+1 ?>_key" id="key<?php echo $i+1 ?>" value="<?php echo ew_HtmlEncode($users_update->arRecKeys[$i]) ?>">
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr class="ewTableHeader">
		<td>Update<input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"></td>
		<td>Field Name</td>
		<td>New Value</td>
	</tr>
<?php if ($users->username->Visible) { // username ?>
	<tr<?php echo $users->username->RowAttributes ?>>
		<td<?php echo $users->username->CellAttributes() ?>>
<input type="checkbox" name="u_username" id="u_username" value="1"<?php echo ($users->username->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $users->username->CellAttributes() ?>>username</td>
		<td<?php echo $users->username->CellAttributes() ?>><span id="el_username">
<input type="text" name="x_username" id="x_username" size="30" maxlength="20" value="<?php echo $users->username->EditValue ?>"<?php echo $users->username->EditAttributes() ?>>
</span><?php echo $users->username->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($users->password->Visible) { // password ?>
	<tr<?php echo $users->password->RowAttributes ?>>
		<td<?php echo $users->password->CellAttributes() ?>>
<input type="checkbox" name="u_password" id="u_password" value="1"<?php echo ($users->password->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $users->password->CellAttributes() ?>>password</td>
		<td<?php echo $users->password->CellAttributes() ?>><span id="el_password">
<input type="text" name="x_password" id="x_password" size="30" maxlength="100" value="<?php echo $users->password->EditValue ?>"<?php echo $users->password->EditAttributes() ?>>
</span><?php echo $users->password->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($users->zemail->Visible) { // email ?>
	<tr<?php echo $users->zemail->RowAttributes ?>>
		<td<?php echo $users->zemail->CellAttributes() ?>>
<input type="checkbox" name="u_zemail" id="u_zemail" value="1"<?php echo ($users->zemail->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $users->zemail->CellAttributes() ?>>email</td>
		<td<?php echo $users->zemail->CellAttributes() ?>><span id="el_zemail">
<input type="text" name="x_zemail" id="x_zemail" size="30" maxlength="100" value="<?php echo $users->zemail->EditValue ?>"<?php echo $users->zemail->EditAttributes() ?>>
</span><?php echo $users->zemail->CustomMsg ?></td>
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
$users_update->Page_Terminate();
?>
<?php

//
// Page Class
//
class cusers_update {

	// Page ID
	var $PageID = 'update';

	// Table Name
	var $TableName = 'users';

	// Page Object Name
	var $PageObjName = 'users_update';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $users;
		if ($users->UseTokenInUrl) $PageUrl .= "t=" . $users->TableVar . "&"; // add page token
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
		global $objForm, $users;
		if ($users->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($users->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($users->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cusers_update() {
		global $conn;

		// Initialize table object
		$GLOBALS["users"] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'update', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'users', TRUE);

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
		global $objForm, $gsFormError, $users;

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
				$users->CurrentAction = $_POST["a_update"];

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
					$users->CurrentAction = "I"; // Form error, reset action
					$this->setMessage($gsFormError);
				}
			}
		}
		if ($this->nKeySelected <= 0)
			$this->Page_Terminate("userslist.php"); // No records selected, return to list
		switch ($users->CurrentAction) {
			case "U": // Update
				if ($this->UpdateRows()) { // Update Records based on key
					$this->setMessage("Update succeeded"); // Set update success message
					$this->Page_Terminate($users->getReturnUrl()); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values
				}
		}

		// Render row
		$users->RowType = EW_ROWTYPE_EDIT; // Render edit
		$this->RenderRow();
	}

	// Load initial values to form if field values are identical in all selected records
	function LoadMultiUpdateValues() {
		global $users;
		$users->CurrentFilter = $this->BuildKeyFilter();

		// Load recordset
		$rs = $this->LoadRecordset();
		$i = 1;
		while (!$rs->EOF) {
			if ($i == 1) {
				$users->username->setDbValue($rs->fields('username'));
				$users->password->setDbValue($rs->fields('password'));
				$users->zemail->setDbValue($rs->fields('email'));
			} else {
				if (!ew_CompareValue($users->username->DbValue, $rs->fields('username')))
					$users->username->CurrentValue = NULL;
				if (!ew_CompareValue($users->password->DbValue, $rs->fields('password')))
					$users->password->CurrentValue = NULL;
				if (!ew_CompareValue($users->zemail->DbValue, $rs->fields('email')))
					$users->zemail->CurrentValue = NULL;
			}
			$i++;
			$rs->MoveNext();
		}
		$rs->Close();
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $users;
		$sWrkFilter = "";
		foreach ($this->arRecKeys as $sKey) {
			$sKey = trim($sKey);
			if ($this->SetupKeyValues($sKey)) {
				$sFilter = $users->KeyFilter();
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
		global $users;
		$sKeyFld = $key;
		if (!is_numeric($sKeyFld))
			return FALSE;
		$users->id->CurrentValue = $sKeyFld;
		return TRUE;
	}

	// Update all selected rows
	function UpdateRows() {
		global $conn, $users;
		$conn->BeginTrans();

		// Get old recordset
		$users->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $users->SQL();
		$rsold = $conn->Execute($sSql);

		// Update all rows
		$sKey = "";
		foreach ($this->arRecKeys as $sThisKey) {
			$sThisKey = trim($sThisKey);
			if ($this->SetupKeyValues($sThisKey)) {
				$users->SendEmail = FALSE; // Do not send email on update success
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
		global $objForm, $users;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $users;
		$users->username->setFormValue($objForm->GetValue("x_username"));
		$users->username->MultiUpdate = $objForm->GetValue("u_username");
		$users->password->setFormValue($objForm->GetValue("x_password"));
		$users->password->MultiUpdate = $objForm->GetValue("u_password");
		$users->zemail->setFormValue($objForm->GetValue("x_zemail"));
		$users->zemail->MultiUpdate = $objForm->GetValue("u_zemail");
		$users->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $users;
		$users->id->CurrentValue = $users->id->FormValue;
		$users->username->CurrentValue = $users->username->FormValue;
		$users->password->CurrentValue = $users->password->FormValue;
		$users->zemail->CurrentValue = $users->zemail->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $users;

		// Call Recordset Selecting event
		$users->Recordset_Selecting($users->CurrentFilter);

		// Load list page SQL
		$sSql = $users->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$users->Recordset_Selected($rs);
		return $rs;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $users;

		// Call Row_Rendering event
		$users->Row_Rendering();

		// Common render codes for all row types
		// username

		$users->username->CellCssStyle = "";
		$users->username->CellCssClass = "";

		// password
		$users->password->CellCssStyle = "";
		$users->password->CellCssClass = "";

		// email
		$users->zemail->CellCssStyle = "";
		$users->zemail->CellCssClass = "";
		if ($users->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$users->id->ViewValue = $users->id->CurrentValue;
			$users->id->CssStyle = "";
			$users->id->CssClass = "";
			$users->id->ViewCustomAttributes = "";

			// username
			$users->username->ViewValue = $users->username->CurrentValue;
			$users->username->CssStyle = "";
			$users->username->CssClass = "";
			$users->username->ViewCustomAttributes = "";

			// password
			$users->password->ViewValue = $users->password->CurrentValue;
			$users->password->CssStyle = "";
			$users->password->CssClass = "";
			$users->password->ViewCustomAttributes = "";

			// email
			$users->zemail->ViewValue = $users->zemail->CurrentValue;
			$users->zemail->CssStyle = "";
			$users->zemail->CssClass = "";
			$users->zemail->ViewCustomAttributes = "";

			// username
			$users->username->HrefValue = "";

			// password
			$users->password->HrefValue = "";

			// email
			$users->zemail->HrefValue = "";
		} elseif ($users->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// username
			$users->username->EditCustomAttributes = "";
			$users->username->EditValue = ew_HtmlEncode($users->username->CurrentValue);

			// password
			$users->password->EditCustomAttributes = "";
			$users->password->EditValue = ew_HtmlEncode($users->password->CurrentValue);

			// email
			$users->zemail->EditCustomAttributes = "";
			$users->zemail->EditValue = ew_HtmlEncode($users->zemail->CurrentValue);

			// Edit refer script
			// username

			$users->username->HrefValue = "";

			// password
			$users->password->HrefValue = "";

			// email
			$users->zemail->HrefValue = "";
		}

		// Call Row Rendered event
		$users->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $users;

		// Initialize
		$gsFormError = "";
		$lUpdateCnt = 0;
		if ($users->username->MultiUpdate == "1") $lUpdateCnt++;
		if ($users->password->MultiUpdate == "1") $lUpdateCnt++;
		if ($users->zemail->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = "No field selected for update";
			return FALSE;
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($users->username->MultiUpdate <> "" && $users->username->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - username";
		}
		if ($users->password->MultiUpdate <> "" && $users->password->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - password";
		}
		if ($users->zemail->MultiUpdate <> "" && $users->zemail->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - email";
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
		global $conn, $Security, $users;
		$sFilter = $users->KeyFilter();
		$users->CurrentFilter = $sFilter;
		$sSql = $users->SQL();
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

			// Field username
						if ($users->username->MultiUpdate == "1") {
			$users->username->SetDbValueDef($users->username->CurrentValue, "");
			$rsnew['username'] =& $users->username->DbValue;
			}

			// Field password
						if ($users->password->MultiUpdate == "1") {
			$users->password->SetDbValueDef($users->password->CurrentValue, "");
			$rsnew['password'] =& $users->password->DbValue;
			}

			// Field email
						if ($users->zemail->MultiUpdate == "1") {
			$users->zemail->SetDbValueDef($users->zemail->CurrentValue, "");
			$rsnew['email'] =& $users->zemail->DbValue;
			}

			// Call Row Updating event
			$bUpdateRow = $users->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($users->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($users->CancelMessage <> "") {
					$this->setMessage($users->CancelMessage);
					$users->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$users->Row_Updated($rsold, $rsnew);
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
