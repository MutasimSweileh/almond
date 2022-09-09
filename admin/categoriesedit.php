<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "categoriesinfo.php" ?>
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
$categories_edit = new ccategories_edit();
$Page =& $categories_edit;

// Page init processing
$categories_edit->Page_Init();

// Page main processing
$categories_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var categories_edit = new ew_Page("categories_edit");

// page properties
categories_edit.PageID = "edit"; // page ID
var EW_PAGE_ID = categories_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
categories_edit.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_name"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - name");
		elm = fobj.elements["x" + infix + "_name_arabic"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - name arabic");
		elm = fobj.elements["x" + infix + "_order"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - order");
		elm = fobj.elements["x" + infix + "_order"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "Incorrect integer - order");
		elm = fobj.elements["x" + infix + "_active"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - active");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
categories_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
categories_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
categories_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
categories_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
categories_edit.ShowHighlightText = "Show highlight"; 
categories_edit.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">Edit TABLE: categories<br><br>
<a href="<?php echo $categories->getReturnUrl() ?>">Go Back</a></span></p>
<?php $categories_edit->ShowMessage() ?>
<form name="fcategoriesedit" id="fcategoriesedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return categories_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="categories">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($categories->id->Visible) { // id ?>
	<tr<?php echo $categories->id->RowAttributes ?>>
		<td class="ewTableHeader">id</td>
		<td<?php echo $categories->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $categories->id->ViewAttributes() ?>><?php echo $categories->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($categories->id->CurrentValue) ?>">
</span><?php echo $categories->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($categories->name->Visible) { // name ?>
	<tr<?php echo $categories->name->RowAttributes ?>>
		<td class="ewTableHeader">name<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $categories->name->CellAttributes() ?>><span id="el_name">
<textarea name="x_name" id="x_name" cols="35" rows="4"<?php echo $categories->name->EditAttributes() ?>><?php echo $categories->name->EditValue ?></textarea>
</span><?php echo $categories->name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($categories->name_arabic->Visible) { // name_arabic ?>
	<tr<?php echo $categories->name_arabic->RowAttributes ?>>
		<td class="ewTableHeader">name arabic<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $categories->name_arabic->CellAttributes() ?>><span id="el_name_arabic">
<textarea name="x_name_arabic" id="x_name_arabic" cols="35" rows="4"<?php echo $categories->name_arabic->EditAttributes() ?>><?php echo $categories->name_arabic->EditValue ?></textarea>
</span><?php echo $categories->name_arabic->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($categories->order->Visible) { // order ?>
	<tr<?php echo $categories->order->RowAttributes ?>>
		<td class="ewTableHeader">order<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $categories->order->CellAttributes() ?>><span id="el_order">
<input type="text" name="x_order" id="x_order" size="30" value="<?php echo $categories->order->EditValue ?>"<?php echo $categories->order->EditAttributes() ?>>
</span><?php echo $categories->order->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($categories->active->Visible) { // active ?>
	<tr<?php echo $categories->active->RowAttributes ?>>
		<td class="ewTableHeader">active<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $categories->active->CellAttributes() ?>><span id="el_active">
<div id="tp_x_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_active" id="x_active" value="{value}"<?php echo $categories->active->EditAttributes() ?>></div>
<div id="dsl_x_active" repeatcolumn="5">
<?php
$arwrk = $categories->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($categories->active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_active" id="x_active" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $categories->active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $categories->active->CustomMsg ?></td>
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
$categories_edit->Page_Terminate();
?>
<?php

//
// Page Class
//
class ccategories_edit {

	// Page ID
	var $PageID = 'edit';

	// Table Name
	var $TableName = 'categories';

	// Page Object Name
	var $PageObjName = 'categories_edit';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $categories;
		if ($categories->UseTokenInUrl) $PageUrl .= "t=" . $categories->TableVar . "&"; // add page token
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
		global $objForm, $categories;
		if ($categories->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($categories->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($categories->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccategories_edit() {
		global $conn;

		// Initialize table object
		$GLOBALS["categories"] = new ccategories();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'categories', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $categories;
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
		global $objForm, $gsFormError, $categories;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$categories->id->setQueryStringValue($_GET["id"]);

		// Create form object
		$objForm = new cFormObj();
		if (@$_POST["a_edit"] <> "") {
			$categories->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$categories->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$this->RestoreFormValues();
			}
		} else {
			$categories->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($categories->id->CurrentValue == "")
			$this->Page_Terminate("categorieslist.php"); // Invalid key, return to list
		switch ($categories->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage("No records found"); // No record found
					$this->Page_Terminate("categorieslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$categories->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage("Update succeeded"); // Update success
					$sReturnUrl = $categories->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "categoriesview.php")
						$sReturnUrl = $categories->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$categories->RowType = EW_ROWTYPE_EDIT; // Render as edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $categories;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $categories;
		$categories->id->setFormValue($objForm->GetValue("x_id"));
		$categories->name->setFormValue($objForm->GetValue("x_name"));
		$categories->name_arabic->setFormValue($objForm->GetValue("x_name_arabic"));
		$categories->order->setFormValue($objForm->GetValue("x_order"));
		$categories->active->setFormValue($objForm->GetValue("x_active"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $categories;
		$this->LoadRow();
		$categories->id->CurrentValue = $categories->id->FormValue;
		$categories->name->CurrentValue = $categories->name->FormValue;
		$categories->name_arabic->CurrentValue = $categories->name_arabic->FormValue;
		$categories->order->CurrentValue = $categories->order->FormValue;
		$categories->active->CurrentValue = $categories->active->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $categories;
		$sFilter = $categories->KeyFilter();

		// Call Row Selecting event
		$categories->Row_Selecting($sFilter);

		// Load sql based on filter
		$categories->CurrentFilter = $sFilter;
		$sSql = $categories->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$categories->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $categories;
		$categories->id->setDbValue($rs->fields('id'));
		$categories->name->setDbValue($rs->fields('name'));
		$categories->name_arabic->setDbValue($rs->fields('name_arabic'));
		$categories->order->setDbValue($rs->fields('order'));
		$categories->active->setDbValue($rs->fields('active'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $categories;

		// Call Row_Rendering event
		$categories->Row_Rendering();

		// Common render codes for all row types
		// id

		$categories->id->CellCssStyle = "";
		$categories->id->CellCssClass = "";

		// name
		$categories->name->CellCssStyle = "";
		$categories->name->CellCssClass = "";

		// name_arabic
		$categories->name_arabic->CellCssStyle = "";
		$categories->name_arabic->CellCssClass = "";

		// order
		$categories->order->CellCssStyle = "";
		$categories->order->CellCssClass = "";

		// active
		$categories->active->CellCssStyle = "";
		$categories->active->CellCssClass = "";
		if ($categories->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$categories->id->ViewValue = $categories->id->CurrentValue;
			$categories->id->CssStyle = "";
			$categories->id->CssClass = "";
			$categories->id->ViewCustomAttributes = "";

			// name
			$categories->name->ViewValue = $categories->name->CurrentValue;
			$categories->name->CssStyle = "";
			$categories->name->CssClass = "";
			$categories->name->ViewCustomAttributes = "";

			// name_arabic
			$categories->name_arabic->ViewValue = $categories->name_arabic->CurrentValue;
			$categories->name_arabic->CssStyle = "";
			$categories->name_arabic->CssClass = "";
			$categories->name_arabic->ViewCustomAttributes = "";

			// order
			$categories->order->ViewValue = $categories->order->CurrentValue;
			$categories->order->CssStyle = "";
			$categories->order->CssClass = "";
			$categories->order->ViewCustomAttributes = "";

			// active
			if (strval($categories->active->CurrentValue) <> "") {
				switch ($categories->active->CurrentValue) {
					case "0":
						$categories->active->ViewValue = "No";
						break;
					case "1":
						$categories->active->ViewValue = "Yes";
						break;
					default:
						$categories->active->ViewValue = $categories->active->CurrentValue;
				}
			} else {
				$categories->active->ViewValue = NULL;
			}
			$categories->active->CssStyle = "";
			$categories->active->CssClass = "";
			$categories->active->ViewCustomAttributes = "";

			// id
			$categories->id->HrefValue = "";

			// name
			$categories->name->HrefValue = "";

			// name_arabic
			$categories->name_arabic->HrefValue = "";

			// order
			$categories->order->HrefValue = "";

			// active
			$categories->active->HrefValue = "";
		} elseif ($categories->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$categories->id->EditCustomAttributes = "";
			$categories->id->EditValue = $categories->id->CurrentValue;
			$categories->id->CssStyle = "";
			$categories->id->CssClass = "";
			$categories->id->ViewCustomAttributes = "";

			// name
			$categories->name->EditCustomAttributes = "";
			$categories->name->EditValue = ew_HtmlEncode($categories->name->CurrentValue);

			// name_arabic
			$categories->name_arabic->EditCustomAttributes = "";
			$categories->name_arabic->EditValue = ew_HtmlEncode($categories->name_arabic->CurrentValue);

			// order
			$categories->order->EditCustomAttributes = "";
			$categories->order->EditValue = ew_HtmlEncode($categories->order->CurrentValue);

			// active
			$categories->active->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$categories->active->EditValue = $arwrk;

			// Edit refer script
			// id

			$categories->id->HrefValue = "";

			// name
			$categories->name->HrefValue = "";

			// name_arabic
			$categories->name_arabic->HrefValue = "";

			// order
			$categories->order->HrefValue = "";

			// active
			$categories->active->HrefValue = "";
		}

		// Call Row Rendered event
		$categories->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $categories;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($categories->name->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - name";
		}
		if ($categories->name_arabic->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - name arabic";
		}
		if ($categories->order->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - order";
		}
		if (!ew_CheckInteger($categories->order->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - order";
		}
		if ($categories->active->FormValue == "") {
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
		global $conn, $Security, $categories;
		$sFilter = $categories->KeyFilter();
		$categories->CurrentFilter = $sFilter;
		$sSql = $categories->SQL();
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
			// Field name

			$categories->name->SetDbValueDef($categories->name->CurrentValue, "");
			$rsnew['name'] =& $categories->name->DbValue;

			// Field name_arabic
			$categories->name_arabic->SetDbValueDef($categories->name_arabic->CurrentValue, "");
			$rsnew['name_arabic'] =& $categories->name_arabic->DbValue;

			// Field order
			$categories->order->SetDbValueDef($categories->order->CurrentValue, 0);
			$rsnew['order'] =& $categories->order->DbValue;

			// Field active
			$categories->active->SetDbValueDef($categories->active->CurrentValue, 0);
			$rsnew['active'] =& $categories->active->DbValue;

			// Call Row Updating event
			$bUpdateRow = $categories->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($categories->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($categories->CancelMessage <> "") {
					$this->setMessage($categories->CancelMessage);
					$categories->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$categories->Row_Updated($rsold, $rsnew);
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
