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
$product_videos_add = new cproduct_videos_add();
$Page =& $product_videos_add;

// Page init processing
$product_videos_add->Page_Init();

// Page main processing
$product_videos_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var product_videos_add = new ew_Page("product_videos_add");

// page properties
product_videos_add.PageID = "add"; // page ID
var EW_PAGE_ID = product_videos_add.PageID; // for backward compatibility

// extend page with ValidateForm function
product_videos_add.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_video"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - video");
		elm = fobj.elements["x" + infix + "_product_id"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - product");
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
product_videos_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
product_videos_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
product_videos_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
product_videos_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
product_videos_add.ShowHighlightText = "Show highlight"; 
product_videos_add.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">Add to TABLE: product videos<br><br>
<a href="<?php echo $product_videos->getReturnUrl() ?>">Go Back</a></span></p>
<?php $product_videos_add->ShowMessage() ?>
<form name="fproduct_videosadd" id="fproduct_videosadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return product_videos_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="product_videos">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($product_videos->video->Visible) { // video ?>
	<tr<?php echo $product_videos->video->RowAttributes ?>>
		<td class="ewTableHeader">video<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $product_videos->video->CellAttributes() ?>><span id="el_video">
<input type="text" name="x_video" id="x_video" size="30" maxlength="200" value="<?php echo $product_videos->video->EditValue ?>"<?php echo $product_videos->video->EditAttributes() ?>>
</span><?php echo $product_videos->video->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($product_videos->product_id->Visible) { // product_id ?>
	<tr<?php echo $product_videos->product_id->RowAttributes ?>>
		<td class="ewTableHeader">product<span class="ewRequired">&nbsp;*</span></td>
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
		<td class="ewTableHeader">order<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $product_videos->order->CellAttributes() ?>><span id="el_order">
<input type="text" name="x_order" id="x_order" size="30" value="<?php echo $product_videos->order->EditValue ?>"<?php echo $product_videos->order->EditAttributes() ?>>
</span><?php echo $product_videos->order->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($product_videos->active->Visible) { // active ?>
	<tr<?php echo $product_videos->active->RowAttributes ?>>
		<td class="ewTableHeader">active<span class="ewRequired">&nbsp;*</span></td>
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
$product_videos_add->Page_Terminate();
?>
<?php

//
// Page Class
//
class cproduct_videos_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'product_videos';

	// Page Object Name
	var $PageObjName = 'product_videos_add';

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
	function cproduct_videos_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["product_videos"] = new cproduct_videos();

		// Initialize other table object
		$GLOBALS['products'] = new cproducts();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $x_ewPriv = 0;

	// 
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsFormError, $product_videos;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $product_videos->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $product_videos->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$product_videos->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $product_videos->CurrentAction = "C"; // Copy Record
		  } else {
		    $product_videos->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($product_videos->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("No records found"); // No record found
		      $this->Page_Terminate("product_videoslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$product_videos->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("Add succeeded"); // Set up success message
					$sReturnUrl = $product_videos->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "product_videosview.php")
						$sReturnUrl = $product_videos->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$product_videos->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $product_videos;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $product_videos;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $product_videos;
		$product_videos->video->setFormValue($objForm->GetValue("x_video"));
		$product_videos->product_id->setFormValue($objForm->GetValue("x_product_id"));
		$product_videos->order->setFormValue($objForm->GetValue("x_order"));
		$product_videos->active->setFormValue($objForm->GetValue("x_active"));
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

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $product_videos;
		$sFilter = $product_videos->KeyFilter();

		// Call Row Selecting event
		$product_videos->Row_Selecting($sFilter);

		// Load sql based on filter
		$product_videos->CurrentFilter = $sFilter;
		$sSql = $product_videos->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$product_videos->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $product_videos;
		$product_videos->id->setDbValue($rs->fields('id'));
		$product_videos->video->setDbValue($rs->fields('video'));
		$product_videos->product_id->setDbValue($rs->fields('product_id'));
		$product_videos->order->setDbValue($rs->fields('order'));
		$product_videos->active->setDbValue($rs->fields('active'));
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
		} elseif ($product_videos->RowType == EW_ROWTYPE_ADD) { // Add row

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
		}

		// Call Row Rendered event
		$product_videos->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $product_videos;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($product_videos->video->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - video";
		}
		if ($product_videos->product_id->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - product";
		}
		if ($product_videos->order->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - order";
		}
		if (!ew_CheckInteger($product_videos->order->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - order";
		}
		if ($product_videos->active->FormValue == "") {
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
		global $conn, $Security, $product_videos;
		$rsnew = array();

		// Field video
		$product_videos->video->SetDbValueDef($product_videos->video->CurrentValue, "");
		$rsnew['video'] =& $product_videos->video->DbValue;

		// Field product_id
		$product_videos->product_id->SetDbValueDef($product_videos->product_id->CurrentValue, 0);
		$rsnew['product_id'] =& $product_videos->product_id->DbValue;

		// Field order
		$product_videos->order->SetDbValueDef($product_videos->order->CurrentValue, 0);
		$rsnew['order'] =& $product_videos->order->DbValue;

		// Field active
		$product_videos->active->SetDbValueDef($product_videos->active->CurrentValue, 0);
		$rsnew['active'] =& $product_videos->active->DbValue;

		// Call Row Inserting event
		$bInsertRow = $product_videos->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($product_videos->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($product_videos->CancelMessage <> "") {
				$this->setMessage($product_videos->CancelMessage);
				$product_videos->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$product_videos->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $product_videos->id->DbValue;

			// Call Row Inserted event
			$product_videos->Row_Inserted($rsnew);
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
