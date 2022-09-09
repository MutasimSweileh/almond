<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "product_imagesinfo.php" ?>
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
$product_images_add = new cproduct_images_add();
$Page =& $product_images_add;

// Page init processing
$product_images_add->Page_Init();

// Page main processing
$product_images_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var product_images_add = new ew_Page("product_images_add");

// page properties
product_images_add.PageID = "add"; // page ID
var EW_PAGE_ID = product_images_add.PageID; // for backward compatibility

// extend page with ValidateForm function
product_images_add.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_name"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - name");
		elm = fobj.elements["x" + infix + "_name_arabic"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - name arabic");
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
product_images_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
product_images_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
product_images_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
product_images_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
product_images_add.ShowHighlightText = "Show highlight"; 
product_images_add.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">Add to TABLE: product images<br><br>
<a href="<?php echo $product_images->getReturnUrl() ?>">Go Back</a></span></p>
<?php $product_images_add->ShowMessage() ?>
<form name="fproduct_imagesadd" id="fproduct_imagesadd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return product_images_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="product_images">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($product_images->image->Visible) { // image ?>
	<tr<?php echo $product_images->image->RowAttributes ?>>
		<td class="ewTableHeader">image<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $product_images->image->CellAttributes() ?>><span id="el_image">
<input type="file" name="x_image" id="x_image" size="30"<?php echo $product_images->image->EditAttributes() ?>>
</div>
</span><?php echo $product_images->image->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($product_images->name->Visible) { // name ?>
	<tr<?php echo $product_images->name->RowAttributes ?>>
		<td class="ewTableHeader">name<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $product_images->name->CellAttributes() ?>><span id="el_name">
<input type="text" name="x_name" id="x_name" size="30" maxlength="200" value="<?php echo $product_images->name->EditValue ?>"<?php echo $product_images->name->EditAttributes() ?>>
</span><?php echo $product_images->name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($product_images->name_arabic->Visible) { // name_arabic ?>
	<tr<?php echo $product_images->name_arabic->RowAttributes ?>>
		<td class="ewTableHeader">name arabic<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $product_images->name_arabic->CellAttributes() ?>><span id="el_name_arabic">
<input type="text" name="x_name_arabic" id="x_name_arabic" size="30" maxlength="200" value="<?php echo $product_images->name_arabic->EditValue ?>"<?php echo $product_images->name_arabic->EditAttributes() ?>>
</span><?php echo $product_images->name_arabic->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($product_images->product_id->Visible) { // product_id ?>
	<tr<?php echo $product_images->product_id->RowAttributes ?>>
		<td class="ewTableHeader">product<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $product_images->product_id->CellAttributes() ?>><span id="el_product_id">
<?php if ($product_images->product_id->getSessionValue() <> "") { ?>
<div<?php echo $product_images->product_id->ViewAttributes() ?>><?php echo $product_images->product_id->ViewValue ?></div>
<input type="hidden" id="x_product_id" name="x_product_id" value="<?php echo ew_HtmlEncode($product_images->product_id->CurrentValue) ?>">
<?php } else { ?>
<select id="x_product_id" name="x_product_id"<?php echo $product_images->product_id->EditAttributes() ?>>
<?php
if (is_array($product_images->product_id->EditValue)) {
	$arwrk = $product_images->product_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($product_images->product_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $product_images->product_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($product_images->order->Visible) { // order ?>
	<tr<?php echo $product_images->order->RowAttributes ?>>
		<td class="ewTableHeader">order<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $product_images->order->CellAttributes() ?>><span id="el_order">
<input type="text" name="x_order" id="x_order" size="30" value="<?php echo $product_images->order->EditValue ?>"<?php echo $product_images->order->EditAttributes() ?>>
</span><?php echo $product_images->order->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($product_images->active->Visible) { // active ?>
	<tr<?php echo $product_images->active->RowAttributes ?>>
		<td class="ewTableHeader">active<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $product_images->active->CellAttributes() ?>><span id="el_active">
<div id="tp_x_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_active" id="x_active" value="{value}"<?php echo $product_images->active->EditAttributes() ?>></div>
<div id="dsl_x_active" repeatcolumn="5">
<?php
$arwrk = $product_images->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($product_images->active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_active" id="x_active" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $product_images->active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $product_images->active->CustomMsg ?></td>
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
$product_images_add->Page_Terminate();
?>
<?php

//
// Page Class
//
class cproduct_images_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'product_images';

	// Page Object Name
	var $PageObjName = 'product_images_add';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $product_images;
		if ($product_images->UseTokenInUrl) $PageUrl .= "t=" . $product_images->TableVar . "&"; // add page token
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
		global $objForm, $product_images;
		if ($product_images->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($product_images->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($product_images->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cproduct_images_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["product_images"] = new cproduct_images();

		// Initialize other table object
		$GLOBALS['products'] = new cproducts();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'product_images', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $product_images;
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
		global $objForm, $gsFormError, $product_images;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $product_images->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $product_images->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->GetUploadFiles(); // Get upload files
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$product_images->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $product_images->CurrentAction = "C"; // Copy Record
		  } else {
		    $product_images->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($product_images->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("No records found"); // No record found
		      $this->Page_Terminate("product_imageslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$product_images->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("Add succeeded"); // Set up success message
					$sReturnUrl = $product_images->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "product_imagesview.php")
						$sReturnUrl = $product_images->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$product_images->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $product_images;

		// Get upload data
			$product_images->image->Upload->Index = $objForm->Index;
			if ($product_images->image->Upload->UploadFile()) {

				// No action required
			} else {
				echo $product_images->image->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load default values
	function LoadDefaultValues() {
		global $product_images;
		$product_images->image->CurrentValue = NULL; // Clear file related field
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $product_images;
		$product_images->name->setFormValue($objForm->GetValue("x_name"));
		$product_images->name_arabic->setFormValue($objForm->GetValue("x_name_arabic"));
		$product_images->product_id->setFormValue($objForm->GetValue("x_product_id"));
		$product_images->order->setFormValue($objForm->GetValue("x_order"));
		$product_images->active->setFormValue($objForm->GetValue("x_active"));
		$product_images->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $product_images;
		$product_images->id->CurrentValue = $product_images->id->FormValue;
		$product_images->name->CurrentValue = $product_images->name->FormValue;
		$product_images->name_arabic->CurrentValue = $product_images->name_arabic->FormValue;
		$product_images->product_id->CurrentValue = $product_images->product_id->FormValue;
		$product_images->order->CurrentValue = $product_images->order->FormValue;
		$product_images->active->CurrentValue = $product_images->active->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $product_images;
		$sFilter = $product_images->KeyFilter();

		// Call Row Selecting event
		$product_images->Row_Selecting($sFilter);

		// Load sql based on filter
		$product_images->CurrentFilter = $sFilter;
		$sSql = $product_images->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$product_images->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $product_images;
		$product_images->id->setDbValue($rs->fields('id'));
		$product_images->image->Upload->DbValue = $rs->fields('image');
		$product_images->name->setDbValue($rs->fields('name'));
		$product_images->name_arabic->setDbValue($rs->fields('name_arabic'));
		$product_images->product_id->setDbValue($rs->fields('product_id'));
		$product_images->order->setDbValue($rs->fields('order'));
		$product_images->active->setDbValue($rs->fields('active'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $product_images;

		// Call Row_Rendering event
		$product_images->Row_Rendering();

		// Common render codes for all row types
		// image

		$product_images->image->CellCssStyle = "";
		$product_images->image->CellCssClass = "";

		// name
		$product_images->name->CellCssStyle = "";
		$product_images->name->CellCssClass = "";

		// name_arabic
		$product_images->name_arabic->CellCssStyle = "";
		$product_images->name_arabic->CellCssClass = "";

		// product_id
		$product_images->product_id->CellCssStyle = "";
		$product_images->product_id->CellCssClass = "";

		// order
		$product_images->order->CellCssStyle = "";
		$product_images->order->CellCssClass = "";

		// active
		$product_images->active->CellCssStyle = "";
		$product_images->active->CellCssClass = "";
		if ($product_images->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$product_images->id->ViewValue = $product_images->id->CurrentValue;
			$product_images->id->CssStyle = "";
			$product_images->id->CssClass = "";
			$product_images->id->ViewCustomAttributes = "";

			// image
			if (!is_null($product_images->image->Upload->DbValue)) {
				$product_images->image->ViewValue = $product_images->image->Upload->DbValue;
				$product_images->image->ImageWidth = 100;
				$product_images->image->ImageHeight = 0;
				$product_images->image->ImageAlt = "";
			} else {
				$product_images->image->ViewValue = "";
			}
			$product_images->image->CssStyle = "";
			$product_images->image->CssClass = "";
			$product_images->image->ViewCustomAttributes = "";

			// name
			$product_images->name->ViewValue = $product_images->name->CurrentValue;
			$product_images->name->CssStyle = "";
			$product_images->name->CssClass = "";
			$product_images->name->ViewCustomAttributes = "";

			// name_arabic
			$product_images->name_arabic->ViewValue = $product_images->name_arabic->CurrentValue;
			$product_images->name_arabic->CssStyle = "";
			$product_images->name_arabic->CssClass = "";
			$product_images->name_arabic->ViewCustomAttributes = "";

			// product_id
			if (strval($product_images->product_id->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `name`, `name_arabic` FROM `products` WHERE `id` = " . ew_AdjustSql($product_images->product_id->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$product_images->product_id->ViewValue = $rswrk->fields('name');
					$product_images->product_id->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('name_arabic');
					$rswrk->Close();
				} else {
					$product_images->product_id->ViewValue = $product_images->product_id->CurrentValue;
				}
			} else {
				$product_images->product_id->ViewValue = NULL;
			}
			$product_images->product_id->CssStyle = "";
			$product_images->product_id->CssClass = "";
			$product_images->product_id->ViewCustomAttributes = "";

			// order
			$product_images->order->ViewValue = $product_images->order->CurrentValue;
			$product_images->order->CssStyle = "";
			$product_images->order->CssClass = "";
			$product_images->order->ViewCustomAttributes = "";

			// active
			if (strval($product_images->active->CurrentValue) <> "") {
				switch ($product_images->active->CurrentValue) {
					case "0":
						$product_images->active->ViewValue = "No";
						break;
					case "1":
						$product_images->active->ViewValue = "Yes";
						break;
					default:
						$product_images->active->ViewValue = $product_images->active->CurrentValue;
				}
			} else {
				$product_images->active->ViewValue = NULL;
			}
			$product_images->active->CssStyle = "";
			$product_images->active->CssClass = "";
			$product_images->active->ViewCustomAttributes = "";

			// image
			$product_images->image->HrefValue = "";

			// name
			$product_images->name->HrefValue = "";

			// name_arabic
			$product_images->name_arabic->HrefValue = "";

			// product_id
			$product_images->product_id->HrefValue = "";

			// order
			$product_images->order->HrefValue = "";

			// active
			$product_images->active->HrefValue = "";
		} elseif ($product_images->RowType == EW_ROWTYPE_ADD) { // Add row

			// image
			$product_images->image->EditCustomAttributes = "";
			if (!is_null($product_images->image->Upload->DbValue)) {
				$product_images->image->EditValue = $product_images->image->Upload->DbValue;
				$product_images->image->ImageWidth = 100;
				$product_images->image->ImageHeight = 0;
				$product_images->image->ImageAlt = "";
			} else {
				$product_images->image->EditValue = "";
			}

			// name
			$product_images->name->EditCustomAttributes = "";
			$product_images->name->EditValue = ew_HtmlEncode($product_images->name->CurrentValue);

			// name_arabic
			$product_images->name_arabic->EditCustomAttributes = "";
			$product_images->name_arabic->EditValue = ew_HtmlEncode($product_images->name_arabic->CurrentValue);

			// product_id
			$product_images->product_id->EditCustomAttributes = "";
			if ($product_images->product_id->getSessionValue() <> "") {
				$product_images->product_id->CurrentValue = $product_images->product_id->getSessionValue();
			if (strval($product_images->product_id->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `name`, `name_arabic` FROM `products` WHERE `id` = " . ew_AdjustSql($product_images->product_id->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$product_images->product_id->ViewValue = $rswrk->fields('name');
					$product_images->product_id->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('name_arabic');
					$rswrk->Close();
				} else {
					$product_images->product_id->ViewValue = $product_images->product_id->CurrentValue;
				}
			} else {
				$product_images->product_id->ViewValue = NULL;
			}
			$product_images->product_id->CssStyle = "";
			$product_images->product_id->CssClass = "";
			$product_images->product_id->ViewCustomAttributes = "";
			} else {
			$sSqlWrk = "SELECT `id`, `name`, `name_arabic`, '' AS SelectFilterFld FROM `products`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select", ""));
			$product_images->product_id->EditValue = $arwrk;
			}

			// order
			$product_images->order->EditCustomAttributes = "";
			$product_images->order->EditValue = ew_HtmlEncode($product_images->order->CurrentValue);

			// active
			$product_images->active->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$product_images->active->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$product_images->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $product_images;

		// Initialize
		$gsFormError = "";
		if (!ew_CheckFileType($product_images->image->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "File type is not allowed.";
		}
		if ($product_images->image->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($product_images->image->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "Max. file size (%s bytes) exceeded.");
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (is_null($product_images->image->Upload->Value)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - image";
		}
		if ($product_images->name->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - name";
		}
		if ($product_images->name_arabic->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - name arabic";
		}
		if ($product_images->product_id->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - product";
		}
		if ($product_images->order->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - order";
		}
		if (!ew_CheckInteger($product_images->order->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - order";
		}
		if ($product_images->active->FormValue == "") {
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
		global $conn, $Security, $product_images;
		$rsnew = array();

		// Field image
		$product_images->image->Upload->SaveToSession(); // Save file value to Session
		if (is_null($product_images->image->Upload->Value)) {
			$rsnew['image'] = NULL;
		} else {
			$rsnew['image'] = ew_UploadFileNameEx(ew_UploadPathEx(True, "../images/"), $product_images->image->Upload->FileName);
		}

		// Field name
		$product_images->name->SetDbValueDef($product_images->name->CurrentValue, "");
		$rsnew['name'] =& $product_images->name->DbValue;

		// Field name_arabic
		$product_images->name_arabic->SetDbValueDef($product_images->name_arabic->CurrentValue, "");
		$rsnew['name_arabic'] =& $product_images->name_arabic->DbValue;

		// Field product_id
		$product_images->product_id->SetDbValueDef($product_images->product_id->CurrentValue, 0);
		$rsnew['product_id'] =& $product_images->product_id->DbValue;

		// Field order
		$product_images->order->SetDbValueDef($product_images->order->CurrentValue, 0);
		$rsnew['order'] =& $product_images->order->DbValue;

		// Field active
		$product_images->active->SetDbValueDef($product_images->active->CurrentValue, 0);
		$rsnew['active'] =& $product_images->active->DbValue;

		// Call Row Inserting event
		$bInsertRow = $product_images->Row_Inserting($rsnew);
		if ($bInsertRow) {

			// Field image
			if (!is_null($product_images->image->Upload->Value)) {
				if ($product_images->image->Upload->FileName == $product_images->image->Upload->DbValue) { // Overwrite if same file name
					$product_images->image->Upload->SaveToFile("../images/", $rsnew['image'], TRUE);
					$product_images->image->Upload->DbValue = ""; // No need to delete any more
				} else {
					$product_images->image->Upload->SaveToFile("../images/", $rsnew['image'], FALSE);
				}
			}
			if ($product_images->image->Upload->Action == "2" || $product_images->image->Upload->Action == "3") { // Update/Remove
				if ($product_images->image->Upload->DbValue <> "")
					@unlink(ew_UploadPathEx(TRUE, "../images/") . $product_images->image->Upload->DbValue);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($product_images->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($product_images->CancelMessage <> "") {
				$this->setMessage($product_images->CancelMessage);
				$product_images->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$product_images->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $product_images->id->DbValue;

			// Call Row Inserted event
			$product_images->Row_Inserted($rsnew);
		}

		// Field image
		$product_images->image->Upload->RemoveFromSession(); // Remove file value from Session
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
