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
$slider_add = new cslider_add();
$Page =& $slider_add;

// Page init processing
$slider_add->Page_Init();

// Page main processing
$slider_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var slider_add = new ew_Page("slider_add");

// page properties
slider_add.PageID = "add"; // page ID
var EW_PAGE_ID = slider_add.PageID; // for backward compatibility

// extend page with ValidateForm function
slider_add.ValidateForm = function(fobj) {
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
slider_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
slider_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
slider_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
slider_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
slider_add.ShowHighlightText = "Show highlight"; 
slider_add.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">Add to TABLE: slider<br><br>
<a href="<?php echo $slider->getReturnUrl() ?>">Go Back</a></span></p>
<?php $slider_add->ShowMessage() ?>
<form name="fslideradd" id="fslideradd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return slider_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="slider">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($slider->image->Visible) { // image ?>
	<tr<?php echo $slider->image->RowAttributes ?>>
		<td class="ewTableHeader">image<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $slider->image->CellAttributes() ?>><span id="el_image">
<input type="file" name="x_image" id="x_image" size="30"<?php echo $slider->image->EditAttributes() ?>>
</div>
</span><?php echo $slider->image->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($slider->order->Visible) { // order ?>
	<tr<?php echo $slider->order->RowAttributes ?>>
		<td class="ewTableHeader">order<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $slider->order->CellAttributes() ?>><span id="el_order">
<input type="text" name="x_order" id="x_order" size="30" value="<?php echo $slider->order->EditValue ?>"<?php echo $slider->order->EditAttributes() ?>>
</span><?php echo $slider->order->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($slider->active->Visible) { // active ?>
	<tr<?php echo $slider->active->RowAttributes ?>>
		<td class="ewTableHeader">active<span class="ewRequired">&nbsp;*</span></td>
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
$slider_add->Page_Terminate();
?>
<?php

//
// Page Class
//
class cslider_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'slider';

	// Page Object Name
	var $PageObjName = 'slider_add';

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
	function cslider_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["slider"] = new cslider();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $x_ewPriv = 0;

	// 
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsFormError, $slider;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $slider->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $slider->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->GetUploadFiles(); // Get upload files
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$slider->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $slider->CurrentAction = "C"; // Copy Record
		  } else {
		    $slider->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($slider->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("No records found"); // No record found
		      $this->Page_Terminate("sliderlist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$slider->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("Add succeeded"); // Set up success message
					$sReturnUrl = $slider->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "sliderview.php")
						$sReturnUrl = $slider->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$slider->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
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
	}

	// Load default values
	function LoadDefaultValues() {
		global $slider;
		$slider->image->CurrentValue = NULL; // Clear file related field
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $slider;
		$slider->order->setFormValue($objForm->GetValue("x_order"));
		$slider->active->setFormValue($objForm->GetValue("x_active"));
		$slider->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $slider;
		$slider->id->CurrentValue = $slider->id->FormValue;
		$slider->order->CurrentValue = $slider->order->FormValue;
		$slider->active->CurrentValue = $slider->active->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $slider;
		$sFilter = $slider->KeyFilter();

		// Call Row Selecting event
		$slider->Row_Selecting($sFilter);

		// Load sql based on filter
		$slider->CurrentFilter = $sFilter;
		$sSql = $slider->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$slider->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $slider;
		$slider->id->setDbValue($rs->fields('id'));
		$slider->image->Upload->DbValue = $rs->fields('image');
		$slider->order->setDbValue($rs->fields('order'));
		$slider->active->setDbValue($rs->fields('active'));
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
		} elseif ($slider->RowType == EW_ROWTYPE_ADD) { // Add row

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
		}

		// Call Row Rendered event
		$slider->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $slider;

		// Initialize
		$gsFormError = "";
		if (!ew_CheckFileType($slider->image->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "File type is not allowed.";
		}
		if ($slider->image->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($slider->image->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "Max. file size (%s bytes) exceeded.");
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (is_null($slider->image->Upload->Value)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - image";
		}
		if ($slider->order->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - order";
		}
		if (!ew_CheckInteger($slider->order->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - order";
		}
		if ($slider->active->FormValue == "") {
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
		global $conn, $Security, $slider;
		$rsnew = array();

		// Field image
		$slider->image->Upload->SaveToSession(); // Save file value to Session
		if (is_null($slider->image->Upload->Value)) {
			$rsnew['image'] = NULL;
		} else {
			$rsnew['image'] = ew_UploadFileNameEx(ew_UploadPathEx(True, "../images/"), $slider->image->Upload->FileName);
		}

		// Field order
		$slider->order->SetDbValueDef($slider->order->CurrentValue, 0);
		$rsnew['order'] =& $slider->order->DbValue;

		// Field active
		$slider->active->SetDbValueDef($slider->active->CurrentValue, 0);
		$rsnew['active'] =& $slider->active->DbValue;

		// Call Row Inserting event
		$bInsertRow = $slider->Row_Inserting($rsnew);
		if ($bInsertRow) {

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
			$AddRow = $conn->Execute($slider->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($slider->CancelMessage <> "") {
				$this->setMessage($slider->CancelMessage);
				$slider->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$slider->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $slider->id->DbValue;

			// Call Row Inserted event
			$slider->Row_Inserted($rsnew);
		}

		// Field image
		$slider->image->Upload->RemoveFromSession(); // Remove file value from Session
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
