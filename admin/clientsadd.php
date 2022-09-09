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
$clients_add = new cclients_add();
$Page =& $clients_add;

// Page init processing
$clients_add->Page_Init();

// Page main processing
$clients_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var clients_add = new ew_Page("clients_add");

// page properties
clients_add.PageID = "add"; // page ID
var EW_PAGE_ID = clients_add.PageID; // for backward compatibility

// extend page with ValidateForm function
clients_add.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_image"];
		aelm = fobj.elements["a" + infix + "_image"];
		var chk_image = (aelm && aelm[0])?(aelm[2].checked):true;
		if (elm && chk_image && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - image");
		elm = fobj.elements["x" + infix + "_image"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, "File type is not allowed.");
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
clients_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
clients_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
clients_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
clients_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
clients_add.ShowHighlightText = "Show highlight"; 
clients_add.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">Add to TABLE: clients<br><br>
<a href="<?php echo $clients->getReturnUrl() ?>">Go Back</a></span></p>
<?php $clients_add->ShowMessage() ?>
<form name="fclientsadd" id="fclientsadd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return clients_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="clients">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($clients->image->Visible) { // image ?>
	<tr<?php echo $clients->image->RowAttributes ?>>
		<td class="ewTableHeader">image<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $clients->image->CellAttributes() ?>><span id="el_image">
<input type="file" name="x_image" id="x_image"<?php echo $clients->image->EditAttributes() ?>>
</div>
</span><?php echo $clients->image->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($clients->order->Visible) { // order ?>
	<tr<?php echo $clients->order->RowAttributes ?>>
		<td class="ewTableHeader">order<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $clients->order->CellAttributes() ?>><span id="el_order">
<input type="text" name="x_order" id="x_order" size="30" value="<?php echo $clients->order->EditValue ?>"<?php echo $clients->order->EditAttributes() ?>>
</span><?php echo $clients->order->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($clients->active->Visible) { // active ?>
	<tr<?php echo $clients->active->RowAttributes ?>>
		<td class="ewTableHeader">active<span class="ewRequired">&nbsp;*</span></td>
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
<input type="submit" name="btnAction" id="btnAction" value="    Add    ">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$clients_add->Page_Terminate();
?>
<?php

//
// Page Class
//
class cclients_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'clients';

	// Page Object Name
	var $PageObjName = 'clients_add';

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
	function cclients_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["clients"] = new cclients();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $x_ewPriv = 0;

	// 
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsFormError, $clients;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $clients->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $clients->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->GetUploadFiles(); // Get upload files
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$clients->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $clients->CurrentAction = "C"; // Copy Record
		  } else {
		    $clients->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($clients->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("No records found"); // No record found
		      $this->Page_Terminate("clientslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$clients->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("Add succeeded"); // Set up success message
					$sReturnUrl = $clients->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "clientsview.php")
						$sReturnUrl = $clients->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$clients->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
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
	}

	// Load default values
	function LoadDefaultValues() {
		global $clients;
		$clients->image->CurrentValue = NULL; // Clear file related field
		$clients->order->CurrentValue = 0;
		$clients->active->CurrentValue = 0;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $clients;
		$clients->order->setFormValue($objForm->GetValue("x_order"));
		$clients->active->setFormValue($objForm->GetValue("x_active"));
		$clients->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $clients;
		$clients->id->CurrentValue = $clients->id->FormValue;
		$clients->order->CurrentValue = $clients->order->FormValue;
		$clients->active->CurrentValue = $clients->active->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $clients;
		$sFilter = $clients->KeyFilter();

		// Call Row Selecting event
		$clients->Row_Selecting($sFilter);

		// Load sql based on filter
		$clients->CurrentFilter = $sFilter;
		$sSql = $clients->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$clients->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $clients;
		$clients->id->setDbValue($rs->fields('id'));
		$clients->image->Upload->DbValue = $rs->fields('image');
		$clients->order->setDbValue($rs->fields('order'));
		$clients->active->setDbValue($rs->fields('active'));
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
		} elseif ($clients->RowType == EW_ROWTYPE_ADD) { // Add row

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
		}

		// Call Row Rendered event
		$clients->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $clients;

		// Initialize
		$gsFormError = "";
		if (!ew_CheckFileType($clients->image->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "File type is not allowed.";
		}
		if ($clients->image->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($clients->image->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "Max. file size (%s bytes) exceeded.");
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (is_null($clients->image->Upload->Value)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - image";
		}
		if ($clients->order->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - order";
		}
		if (!ew_CheckInteger($clients->order->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - order";
		}
		if ($clients->active->FormValue == "") {
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

	// Add record
	function AddRow() {
		global $conn, $Security, $clients;
		$rsnew = array();

		// Field image
		$clients->image->Upload->SaveToSession(); // Save file value to Session
		if (is_null($clients->image->Upload->Value)) {
			$rsnew['image'] = NULL;
		} else {
			$rsnew['image'] = ew_UploadFileNameEx(ew_UploadPathEx(True, "../images/"), $clients->image->Upload->FileName);
		}

		// Field order
		$clients->order->SetDbValueDef($clients->order->CurrentValue, 0);
		$rsnew['order'] =& $clients->order->DbValue;

		// Field active
		$clients->active->SetDbValueDef($clients->active->CurrentValue, 0);
		$rsnew['active'] =& $clients->active->DbValue;

		// Call Row Inserting event
		$bInsertRow = $clients->Row_Inserting($rsnew);
		if ($bInsertRow) {

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
			$AddRow = $conn->Execute($clients->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($clients->CancelMessage <> "") {
				$this->setMessage($clients->CancelMessage);
				$clients->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$clients->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $clients->id->DbValue;

			// Call Row Inserted event
			$clients->Row_Inserted($rsnew);
		}

		// Field image
		$clients->image->Upload->RemoveFromSession(); // Remove file value from Session
		return $AddRow;
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
