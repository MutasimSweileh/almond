<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "visitorsinfo.php" ?>
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
$visitors_add = new cvisitors_add();
$Page =& $visitors_add;

// Page init processing
$visitors_add->Page_Init();

// Page main processing
$visitors_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var visitors_add = new ew_Page("visitors_add");

// page properties
visitors_add.PageID = "add"; // page ID
var EW_PAGE_ID = visitors_add.PageID; // for backward compatibility

// extend page with ValidateForm function
visitors_add.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_zemail"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - email");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
visitors_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
visitors_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
visitors_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
visitors_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
visitors_add.ShowHighlightText = "Show highlight"; 
visitors_add.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">Add to TABLE: visitors<br><br>
<a href="<?php echo $visitors->getReturnUrl() ?>">Go Back</a></span></p>
<?php $visitors_add->ShowMessage() ?>
<form name="fvisitorsadd" id="fvisitorsadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return visitors_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="visitors">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($visitors->zemail->Visible) { // email ?>
	<tr<?php echo $visitors->zemail->RowAttributes ?>>
		<td class="ewTableHeader">email<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $visitors->zemail->CellAttributes() ?>><span id="el_zemail">
<input type="text" name="x_zemail" id="x_zemail" size="30" maxlength="250" value="<?php echo $visitors->zemail->EditValue ?>"<?php echo $visitors->zemail->EditAttributes() ?>>
</span><?php echo $visitors->zemail->CustomMsg ?></td>
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
$visitors_add->Page_Terminate();
?>
<?php

//
// Page Class
//
class cvisitors_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'visitors';

	// Page Object Name
	var $PageObjName = 'visitors_add';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $visitors;
		if ($visitors->UseTokenInUrl) $PageUrl .= "t=" . $visitors->TableVar . "&"; // add page token
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
		global $objForm, $visitors;
		if ($visitors->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($visitors->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($visitors->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cvisitors_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["visitors"] = new cvisitors();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'visitors', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $visitors;
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
		global $objForm, $gsFormError, $visitors;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $visitors->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $visitors->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$visitors->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $visitors->CurrentAction = "C"; // Copy Record
		  } else {
		    $visitors->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($visitors->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("No records found"); // No record found
		      $this->Page_Terminate("visitorslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$visitors->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("Add succeeded"); // Set up success message
					$sReturnUrl = $visitors->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "visitorsview.php")
						$sReturnUrl = $visitors->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$visitors->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $visitors;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $visitors;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $visitors;
		$visitors->zemail->setFormValue($objForm->GetValue("x_zemail"));
		$visitors->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $visitors;
		$visitors->id->CurrentValue = $visitors->id->FormValue;
		$visitors->zemail->CurrentValue = $visitors->zemail->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $visitors;
		$sFilter = $visitors->KeyFilter();

		// Call Row Selecting event
		$visitors->Row_Selecting($sFilter);

		// Load sql based on filter
		$visitors->CurrentFilter = $sFilter;
		$sSql = $visitors->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$visitors->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $visitors;
		$visitors->id->setDbValue($rs->fields('id'));
		$visitors->zemail->setDbValue($rs->fields('email'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $visitors;

		// Call Row_Rendering event
		$visitors->Row_Rendering();

		// Common render codes for all row types
		// email

		$visitors->zemail->CellCssStyle = "";
		$visitors->zemail->CellCssClass = "";
		if ($visitors->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$visitors->id->ViewValue = $visitors->id->CurrentValue;
			$visitors->id->CssStyle = "";
			$visitors->id->CssClass = "";
			$visitors->id->ViewCustomAttributes = "";

			// email
			$visitors->zemail->ViewValue = $visitors->zemail->CurrentValue;
			$visitors->zemail->CssStyle = "";
			$visitors->zemail->CssClass = "";
			$visitors->zemail->ViewCustomAttributes = "";

			// email
			$visitors->zemail->HrefValue = "";
		} elseif ($visitors->RowType == EW_ROWTYPE_ADD) { // Add row

			// email
			$visitors->zemail->EditCustomAttributes = "";
			$visitors->zemail->EditValue = ew_HtmlEncode($visitors->zemail->CurrentValue);
		}

		// Call Row Rendered event
		$visitors->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $visitors;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($visitors->zemail->FormValue == "") {
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

	// Add record
	function AddRow() {
		global $conn, $Security, $visitors;
		$rsnew = array();

		// Field email
		$visitors->zemail->SetDbValueDef($visitors->zemail->CurrentValue, "");
		$rsnew['email'] =& $visitors->zemail->DbValue;

		// Call Row Inserting event
		$bInsertRow = $visitors->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($visitors->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($visitors->CancelMessage <> "") {
				$this->setMessage($visitors->CancelMessage);
				$visitors->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$visitors->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $visitors->id->DbValue;

			// Call Row Inserted event
			$visitors->Row_Inserted($rsnew);
		}
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
