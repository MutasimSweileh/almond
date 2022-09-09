<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "product_videosinfo.php" ?>
<?php include "productsinfo.php" ?>
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
$product_videos_update = new cproduct_videos_update();
$Page =& $product_videos_update;

// Page init processing
$product_videos_update->Page_Init();

// Page main processing
$product_videos_update->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var product_videos_update = new ew_Page("product_videos_update");

// page properties
product_videos_update.PageID = "update"; // page ID
var EW_PAGE_ID = product_videos_update.PageID; // for backward compatibility

// extend page with ValidateForm function
product_videos_update.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_video"];
		uelm = fobj.elements["u" + infix + "_video"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - video");
		}
		elm = fobj.elements["x" + infix + "_product_id"];
		uelm = fobj.elements["u" + infix + "_product_id"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - product");
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
product_videos_update.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
product_videos_update.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
product_videos_update.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
product_videos_update.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
product_videos_update.ShowHighlightText = "Show highlight"; 
product_videos_update.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">Update TABLE: product videos<br><br>
<a href="<?php echo $product_videos->getReturnUrl() ?>">Back to List</a></span></p>
<?php $product_videos_update->ShowMessage() ?>
<form name="fproduct_videosupdate" id="fproduct_videosupdate" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return product_videos_update.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="product_videos">
<input type="hidden" name="a_update" id="a_update" value="U">
<?php for ($i = 0; $i < $product_videos_update->nKeySelected; $i++) { ?>
<input type="hidden" name="k<?php echo $i+1 ?>_key" id="key<?php echo $i+1 ?>" value="<?php echo ew_HtmlEncode($product_videos_update->arRecKeys[$i]) ?>">
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr class="ewTableHeader">
		<td>Update<input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"></td>
		<td>Field Name</td>
		<td>New Value</td>
	</tr>
<?php if ($product_videos->video->Visible) { // video ?>
	<tr<?php echo $product_videos->video->RowAttributes ?>>
		<td<?php echo $product_videos->video->CellAttributes() ?>>
<input type="checkbox" name="u_video" id="u_video" value="1"<?php echo ($product_videos->video->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $product_videos->video->CellAttributes() ?>>video</td>
		<td<?php echo $product_videos->video->CellAttributes() ?>><span id="el_video">
<input type="text" name="x_video" id="x_video" size="30" maxlength="200" value="<?php echo $product_videos->video->EditValue ?>"<?php echo $product_videos->video->EditAttributes() ?>>
</span><?php echo $product_videos->video->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($product_videos->product_id->Visible) { // product_id ?>
	<tr<?php echo $product_videos->product_id->RowAttributes ?>>
		<td<?php echo $product_videos->product_id->CellAttributes() ?>>
<input type="checkbox" name="u_product_id" id="u_product_id" value="1"<?php echo ($product_videos->product_id->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $product_videos->product_id->CellAttributes() ?>>product</td>
		<td<?php echo $product_videos->product_id->CellAttributes() ?>><span id="el_product_id">
<?php if ($product_videos->product_id->getSessionValue() <> "") { ?>
<div<?php echo $product_videos->product_id->ViewAttributes() ?>><?php echo $product_videos->product_id->ViewValue ?></div>
<input type="hidden" id="x_product_id" name="x_product_id" value="<?php echo ew_HtmlEncode($product_videos->product_id->CurrentValue) ?>">
<?php } else { ?>
<select id="x_product_id" name="x_product_id"<?php echo $product_videos->product_id->EditAttributes() ?>>
<?php
if (is_array($product_videos->product_id->EditValue)) {
	$arwrk = $product_videos->product_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($product_videos->product_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
<?php } ?>
</span><?php echo $product_videos->product_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($product_videos->order->Visible) { // order ?>
	<tr<?php echo $product_videos->order->RowAttributes ?>>
		<td<?php echo $product_videos->order->CellAttributes() ?>>
<input type="checkbox" name="u_order" id="u_order" value="1"<?php echo ($product_videos->order->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $product_videos->order->CellAttributes() ?>>order</td>
		<td<?php echo $product_videos->order->CellAttributes() ?>><span id="el_order">
<input type="text" name="x_order" id="x_order" size="30" value="<?php echo $product_videos->order->EditValue ?>"<?php echo $product_videos->order->EditAttributes() ?>>
</span><?php echo $product_videos->order->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($product_videos->active->Visible) { // active ?>
	<tr<?php echo $product_videos->active->RowAttributes ?>>
		<td<?php echo $product_videos->active->CellAttributes() ?>>
<input type="checkbox" name="u_active" id="u_active" value="1"<?php echo ($product_videos->active->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $product_videos->active->CellAttributes() ?>>active</td>
		<td<?php echo $product_videos->active->CellAttributes() ?>><span id="el_active">
<div id="tp_x_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_active" id="x_active" value="{value}"<?php echo $product_videos->active->EditAttributes() ?>></div>
<div id="dsl_x_active" repeatcolumn="5">
<?php
$arwrk = $product_videos->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($product_videos->active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_active" id="x_active" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $product_videos->active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $product_videos->active->CustomMsg ?></td>
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
$product_videos_update->Page_Terminate();
?>
<?php

//
// Page Class
//
class cproduct_videos_update {

	// Page ID
	var $PageID = 'update';

	// Table Name
	var $TableName = 'product_videos';

	// Page Object Name
	var $PageObjName = 'product_videos_update';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $product_videos;
		if ($product_videos->UseTokenInUrl) $PageUrl .= "t=" . $product_videos->TableVar . "&"; // add page token
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
		global $objForm, $product_videos;
		if ($product_videos->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($product_videos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($product_videos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cproduct_videos_update() {
		global $conn;

		// Initialize table object
		$GLOBALS["product_videos"] = new cproduct_videos();

		// Initialize other table object
		$GLOBALS['products'] = new cproducts();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'update', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'product_videos', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $product_videos;
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
		global $objForm, $gsFormError, $product_videos;

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
				$product_videos->CurrentAction = $_POST["a_update"];

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
					$product_videos->CurrentAction = "I"; // Form error, reset action
					$this->setMessage($gsFormError);
				}
			}
		}
		if ($this->nKeySelected <= 0)
			$this->Page_Terminate("product_videoslist.php"); // No records selected, return to list
		switch ($product_videos->CurrentAction) {
			case "U": // Update
				if ($this->UpdateRows()) { // Update Records based on key
					$this->setMessage("Update succeeded"); // Set update success message
					$this->Page_Terminate($product_videos->getReturnUrl()); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values
				}
		}

		// Render row
		$product_videos->RowType = EW_ROWTYPE_EDIT; // Render edit
		$this->RenderRow();
	}

	// Load initial values to form if field values are identical in all selected records
	function LoadMultiUpdateValues() {
		global $product_videos;
		$product_videos->CurrentFilter = $this->BuildKeyFilter();

		// Load recordset
		$rs = $this->LoadRecordset();
		$i = 1;
		while (!$rs->EOF) {
			if ($i == 1) {
				$product_videos->video->setDbValue($rs->fields('video'));
				$product_videos->product_id->setDbValue($rs->fields('product_id'));
				$product_videos->order->setDbValue($rs->fields('order'));
				$product_videos->active->setDbValue($rs->fields('active'));
			} else {
				if (!ew_CompareValue($product_videos->video->DbValue, $rs->fields('video')))
					$product_videos->video->CurrentValue = NULL;
				if (!ew_CompareValue($product_videos->product_id->DbValue, $rs->fields('product_id')))
					$product_videos->product_id->CurrentValue = NULL;
				if (!ew_CompareValue($product_videos->order->DbValue, $rs->fields('order')))
					$product_videos->order->CurrentValue = NULL;
				if (!ew_CompareValue($product_videos->active->DbValue, $rs->fields('active')))
					$product_videos->active->CurrentValue = NULL;
			}
			$i++;
			$rs->MoveNext();
		}
		$rs->Close();
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $product_videos;
		$sWrkFilter = "";
		foreach ($this->arRecKeys as $sKey) {
			$sKey = trim($sKey);
			if ($this->SetupKeyValues($sKey)) {
				$sFilter = $product_videos->KeyFilter();
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
		global $product_videos;
		$sKeyFld = $key;
		if (!is_numeric($sKeyFld))
			return FALSE;
		$product_videos->id->CurrentValue = $sKeyFld;
		return TRUE;
	}

	// Update all selected rows
	function UpdateRows() {
		global $conn, $product_videos;
		$conn->BeginTrans();

		// Get old recordset
		$product_videos->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $product_videos->SQL();
		$rsold = $conn->Execute($sSql);

		// Update all rows
		$sKey = "";
		foreach ($this->arRecKeys as $sThisKey) {
			$sThisKey = trim($sThisKey);
			if ($this->SetupKeyValues($sThisKey)) {
				$product_videos->SendEmail = FALSE; // Do not send email on update success
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
		global $objForm, $product_videos;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $product_videos;
		$product_videos->video->setFormValue($objForm->GetValue("x_video"));
		$product_videos->video->MultiUpdate = $objForm->GetValue("u_video");
		$product_videos->product_id->setFormValue($objForm->GetValue("x_product_id"));
		$product_videos->product_id->MultiUpdate = $objForm->GetValue("u_product_id");
		$product_videos->order->setFormValue($objForm->GetValue("x_order"));
		$product_videos->order->MultiUpdate = $objForm->GetValue("u_order");
		$product_videos->active->setFormValue($objForm->GetValue("x_active"));
		$product_videos->active->MultiUpdate = $objForm->GetValue("u_active");
		$product_videos->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $product_videos;
		$product_videos->id->CurrentValue = $product_videos->id->FormValue;
		$product_videos->video->CurrentValue = $product_videos->video->FormValue;
		$product_videos->product_id->CurrentValue = $product_videos->product_id->FormValue;
		$product_videos->order->CurrentValue = $product_videos->order->FormValue;
		$product_videos->active->CurrentValue = $product_videos->active->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $product_videos;

		// Call Recordset Selecting event
		$product_videos->Recordset_Selecting($product_videos->CurrentFilter);

		// Load list page SQL
		$sSql = $product_videos->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$product_videos->Recordset_Selected($rs);
		return $rs;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $product_videos;

		// Call Row_Rendering event
		$product_videos->Row_Rendering();

		// Common render codes for all row types
		// video

		$product_videos->video->CellCssStyle = "";
		$product_videos->video->CellCssClass = "";

		// product_id
		$product_videos->product_id->CellCssStyle = "";
		$product_videos->product_id->CellCssClass = "";

		// order
		$product_videos->order->CellCssStyle = "";
		$product_videos->order->CellCssClass = "";

		// active
		$product_videos->active->CellCssStyle = "";
		$product_videos->active->CellCssClass = "";
		if ($product_videos->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$product_videos->id->ViewValue = $product_videos->id->CurrentValue;
			$product_videos->id->CssStyle = "";
			$product_videos->id->CssClass = "";
			$product_videos->id->ViewCustomAttributes = "";

			// video
			$product_videos->video->ViewValue = $product_videos->video->CurrentValue;
			$product_videos->video->CssStyle = "";
			$product_videos->video->CssClass = "";
			$product_videos->video->ViewCustomAttributes = "";

			// product_id
			if (strval($product_videos->product_id->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `name`, `name_arabic` FROM `products` WHERE `id` = " . ew_AdjustSql($product_videos->product_id->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$product_videos->product_id->ViewValue = $rswrk->fields('name');
					$product_videos->product_id->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('name_arabic');
					$rswrk->Close();
				} else {
					$product_videos->product_id->ViewValue = $product_videos->product_id->CurrentValue;
				}
			} else {
				$product_videos->product_id->ViewValue = NULL;
			}
			$product_videos->product_id->CssStyle = "";
			$product_videos->product_id->CssClass = "";
			$product_videos->product_id->ViewCustomAttributes = "";

			// order
			$product_videos->order->ViewValue = $product_videos->order->CurrentValue;
			$product_videos->order->CssStyle = "";
			$product_videos->order->CssClass = "";
			$product_videos->order->ViewCustomAttributes = "";

			// active
			if (strval($product_videos->active->CurrentValue) <> "") {
				switch ($product_videos->active->CurrentValue) {
					case "0":
						$product_videos->active->ViewValue = "No";
						break;
					case "1":
						$product_videos->active->ViewValue = "Yes";
						break;
					default:
						$product_videos->active->ViewValue = $product_videos->active->CurrentValue;
				}
			} else {
				$product_videos->active->ViewValue = NULL;
			}
			$product_videos->active->CssStyle = "";
			$product_videos->active->CssClass = "";
			$product_videos->active->ViewCustomAttributes = "";

			// video
			$product_videos->video->HrefValue = "";

			// product_id
			$product_videos->product_id->HrefValue = "";

			// order
			$product_videos->order->HrefValue = "";

			// active
			$product_videos->active->HrefValue = "";
		} elseif ($product_videos->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// video
			$product_videos->video->EditCustomAttributes = "";
			$product_videos->video->EditValue = ew_HtmlEncode($product_videos->video->CurrentValue);

			// product_id
			$product_videos->product_id->EditCustomAttributes = "";
			if ($product_videos->product_id->getSessionValue() <> "") {
				$product_videos->product_id->CurrentValue = $product_videos->product_id->getSessionValue();
			if (strval($product_videos->product_id->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `name`, `name_arabic` FROM `products` WHERE `id` = " . ew_AdjustSql($product_videos->product_id->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$product_videos->product_id->ViewValue = $rswrk->fields('name');
					$product_videos->product_id->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('name_arabic');
					$rswrk->Close();
				} else {
					$product_videos->product_id->ViewValue = $product_videos->product_id->CurrentValue;
				}
			} else {
				$product_videos->product_id->ViewValue = NULL;
			}
			$product_videos->product_id->CssStyle = "";
			$product_videos->product_id->CssClass = "";
			$product_videos->product_id->ViewCustomAttributes = "";
			} else {
			$sSqlWrk = "SELECT `id`, `name`, `name_arabic`, '' AS SelectFilterFld FROM `products`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select", ""));
			$product_videos->product_id->EditValue = $arwrk;
			}

			// order
			$product_videos->order->EditCustomAttributes = "";
			$product_videos->order->EditValue = ew_HtmlEncode($product_videos->order->CurrentValue);

			// active
			$product_videos->active->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$product_videos->active->EditValue = $arwrk;

			// Edit refer script
			// video

			$product_videos->video->HrefValue = "";

			// product_id
			$product_videos->product_id->HrefValue = "";

			// order
			$product_videos->order->HrefValue = "";

			// active
			$product_videos->active->HrefValue = "";
		}

		// Call Row Rendered event
		$product_videos->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $product_videos;

		// Initialize
		$gsFormError = "";
		$lUpdateCnt = 0;
		if ($product_videos->video->MultiUpdate == "1") $lUpdateCnt++;
		if ($product_videos->product_id->MultiUpdate == "1") $lUpdateCnt++;
		if ($product_videos->order->MultiUpdate == "1") $lUpdateCnt++;
		if ($product_videos->active->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = "No field selected for update";
			return FALSE;
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($product_videos->video->MultiUpdate <> "" && $product_videos->video->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - video";
		}
		if ($product_videos->product_id->MultiUpdate <> "" && $product_videos->product_id->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - product";
		}
		if ($product_videos->order->MultiUpdate <> "" && $product_videos->order->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - order";
		}
		if ($product_videos->order->MultiUpdate <> "") {
			if (!ew_CheckInteger($product_videos->order->FormValue)) {
				if ($gsFormError <> "") $gsFormError .= "<br>";
				$gsFormError .= "Incorrect integer - order";
			}
		}
		if ($product_videos->active->MultiUpdate <> "" && $product_videos->active->FormValue == "") {
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
		global $conn, $Security, $product_videos;
		$sFilter = $product_videos->KeyFilter();
		$product_videos->CurrentFilter = $sFilter;
		$sSql = $product_videos->SQL();
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

			// Field video
						if ($product_videos->video->MultiUpdate == "1") {
			$product_videos->video->SetDbValueDef($product_videos->video->CurrentValue, "");
			$rsnew['video'] =& $product_videos->video->DbValue;
			}

			// Field product_id
						if ($product_videos->product_id->MultiUpdate == "1") {
			$product_videos->product_id->SetDbValueDef($product_videos->product_id->CurrentValue, 0);
			$rsnew['product_id'] =& $product_videos->product_id->DbValue;
			}

			// Field order
						if ($product_videos->order->MultiUpdate == "1") {
			$product_videos->order->SetDbValueDef($product_videos->order->CurrentValue, 0);
			$rsnew['order'] =& $product_videos->order->DbValue;
			}

			// Field active
						if ($product_videos->active->MultiUpdate == "1") {
			$product_videos->active->SetDbValueDef($product_videos->active->CurrentValue, 0);
			$rsnew['active'] =& $product_videos->active->DbValue;
			}

			// Call Row Updating event
			$bUpdateRow = $product_videos->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($product_videos->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($product_videos->CancelMessage <> "") {
					$this->setMessage($product_videos->CancelMessage);
					$product_videos->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$product_videos->Row_Updated($rsold, $rsnew);
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
