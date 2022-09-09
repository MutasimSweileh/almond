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
$searchengine_add = new csearchengine_add();
$Page =& $searchengine_add;

// Page init processing
$searchengine_add->Page_Init();

// Page main processing
$searchengine_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var searchengine_add = new ew_Page("searchengine_add");

// page properties
searchengine_add.PageID = "add"; // page ID
var EW_PAGE_ID = searchengine_add.PageID; // for backward compatibility

// extend page with ValidateForm function
searchengine_add.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_zpage"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - page");
		elm = fobj.elements["x" + infix + "_description"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - description");
		elm = fobj.elements["x" + infix + "_keywords"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - keywords");
		elm = fobj.elements["x" + infix + "_title"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - title");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
searchengine_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
searchengine_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
searchengine_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
searchengine_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
searchengine_add.ShowHighlightText = "Show highlight"; 
searchengine_add.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">Add to TABLE: searchengine<br><br>
<a href="<?php echo $searchengine->getReturnUrl() ?>">Go Back</a></span></p>
<?php $searchengine_add->ShowMessage() ?>
<form name="fsearchengineadd" id="fsearchengineadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return searchengine_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="searchengine">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($searchengine->zpage->Visible) { // page ?>
	<tr<?php echo $searchengine->zpage->RowAttributes ?>>
		<td class="ewTableHeader">page<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $searchengine->zpage->CellAttributes() ?>><span id="el_zpage">
<input type="text" name="x_zpage" id="x_zpage" size="30" maxlength="50" value="<?php echo $searchengine->zpage->EditValue ?>"<?php echo $searchengine->zpage->EditAttributes() ?>>
</span><?php echo $searchengine->zpage->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($searchengine->description->Visible) { // description ?>
	<tr<?php echo $searchengine->description->RowAttributes ?>>
		<td class="ewTableHeader">description<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $searchengine->description->CellAttributes() ?>><span id="el_description">
<textarea name="x_description" id="x_description" cols="35" rows="4"<?php echo $searchengine->description->EditAttributes() ?>><?php echo $searchengine->description->EditValue ?></textarea>
</span><?php echo $searchengine->description->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($searchengine->keywords->Visible) { // keywords ?>
	<tr<?php echo $searchengine->keywords->RowAttributes ?>>
		<td class="ewTableHeader">keywords<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $searchengine->keywords->CellAttributes() ?>><span id="el_keywords">
<textarea name="x_keywords" id="x_keywords" cols="35" rows="4"<?php echo $searchengine->keywords->EditAttributes() ?>><?php echo $searchengine->keywords->EditValue ?></textarea>
</span><?php echo $searchengine->keywords->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($searchengine->title->Visible) { // title ?>
	<tr<?php echo $searchengine->title->RowAttributes ?>>
		<td class="ewTableHeader">title<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $searchengine->title->CellAttributes() ?>><span id="el_title">
<input type="text" name="x_title" id="x_title" size="30" maxlength="250" value="<?php echo $searchengine->title->EditValue ?>"<?php echo $searchengine->title->EditAttributes() ?>>
</span><?php echo $searchengine->title->CustomMsg ?></td>
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
$searchengine_add->Page_Terminate();
?>
<?php

//
// Page Class
//
class csearchengine_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'searchengine';

	// Page Object Name
	var $PageObjName = 'searchengine_add';

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
	function csearchengine_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["searchengine"] = new csearchengine();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $x_ewPriv = 0;

	// 
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsFormError, $searchengine;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $searchengine->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $searchengine->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$searchengine->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $searchengine->CurrentAction = "C"; // Copy Record
		  } else {
		    $searchengine->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($searchengine->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("No records found"); // No record found
		      $this->Page_Terminate("searchenginelist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$searchengine->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("Add succeeded"); // Set up success message
					$sReturnUrl = $searchengine->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "searchengineview.php")
						$sReturnUrl = $searchengine->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$searchengine->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $searchengine;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $searchengine;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $searchengine;
		$searchengine->zpage->setFormValue($objForm->GetValue("x_zpage"));
		$searchengine->description->setFormValue($objForm->GetValue("x_description"));
		$searchengine->keywords->setFormValue($objForm->GetValue("x_keywords"));
		$searchengine->title->setFormValue($objForm->GetValue("x_title"));
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

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $searchengine;
		$sFilter = $searchengine->KeyFilter();

		// Call Row Selecting event
		$searchengine->Row_Selecting($sFilter);

		// Load sql based on filter
		$searchengine->CurrentFilter = $sFilter;
		$sSql = $searchengine->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$searchengine->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $searchengine;
		$searchengine->id->setDbValue($rs->fields('id'));
		$searchengine->zpage->setDbValue($rs->fields('page'));
		$searchengine->description->setDbValue($rs->fields('description'));
		$searchengine->keywords->setDbValue($rs->fields('keywords'));
		$searchengine->title->setDbValue($rs->fields('title'));
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
		} elseif ($searchengine->RowType == EW_ROWTYPE_ADD) { // Add row

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
		}

		// Call Row Rendered event
		$searchengine->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $searchengine;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($searchengine->zpage->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - page";
		}
		if ($searchengine->description->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - description";
		}
		if ($searchengine->keywords->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - keywords";
		}
		if ($searchengine->title->FormValue == "") {
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

	// Add record
	function AddRow() {
		global $conn, $Security, $searchengine;
		$rsnew = array();

		// Field page
		$searchengine->zpage->SetDbValueDef($searchengine->zpage->CurrentValue, "");
		$rsnew['page'] =& $searchengine->zpage->DbValue;

		// Field description
		$searchengine->description->SetDbValueDef($searchengine->description->CurrentValue, "");
		$rsnew['description'] =& $searchengine->description->DbValue;

		// Field keywords
		$searchengine->keywords->SetDbValueDef($searchengine->keywords->CurrentValue, "");
		$rsnew['keywords'] =& $searchengine->keywords->DbValue;

		// Field title
		$searchengine->title->SetDbValueDef($searchengine->title->CurrentValue, "");
		$rsnew['title'] =& $searchengine->title->DbValue;

		// Call Row Inserting event
		$bInsertRow = $searchengine->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($searchengine->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($searchengine->CancelMessage <> "") {
				$this->setMessage($searchengine->CancelMessage);
				$searchengine->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$searchengine->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $searchengine->id->DbValue;

			// Call Row Inserted event
			$searchengine->Row_Inserted($rsnew);
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
