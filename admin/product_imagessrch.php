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
$product_images_search = new cproduct_images_search();
$Page =& $product_images_search;

// Page init processing
$product_images_search->Page_Init();

// Page main processing
$product_images_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var product_images_search = new ew_Page("product_images_search");

// page properties
product_images_search.PageID = "search"; // page ID
var EW_PAGE_ID = product_images_search.PageID; // for backward compatibility

// extend page with validate function for search
product_images_search.ValidateSearch = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var infix = "";
	elm = fobj.elements["x" + infix + "_id"];
	if (elm && !ew_CheckInteger(elm.value))
		return ew_OnError(this, elm, "Incorrect integer - id");
	elm = fobj.elements["x" + infix + "_order"];
	if (elm && !ew_CheckInteger(elm.value))
		return ew_OnError(this, elm, "Incorrect integer - order");

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	for (var i=0;i<fobj.elements.length;i++) {
		var elem = fobj.elements[i];
		if (elem.name.substring(0,2) == "s_" || elem.name.substring(0,3) == "sv_")
			elem.value = "";
	}
	return true;
}

// extend page with Form_CustomValidate function
product_images_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
product_images_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
product_images_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
product_images_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
product_images_search.ShowHighlightText = "Show highlight"; 
product_images_search.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">Search TABLE: product images<br><br>
<a href="<?php echo $product_images->getReturnUrl() ?>">Back to List</a></span></p>
<?php $product_images_search->ShowMessage() ?>
<form name="fproduct_imagessearch" id="fproduct_imagessearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return product_images_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="product_images">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $product_images->id->RowAttributes ?>>
		<td class="ewTableHeader">id</td>
		<td<?php echo $product_images->id->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_id" id="z_id" value="="></span></td>
		<td<?php echo $product_images->id->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_id" id="x_id" value="<?php echo $product_images->id->EditValue ?>"<?php echo $product_images->id->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $product_images->name->RowAttributes ?>>
		<td class="ewTableHeader">name</td>
		<td<?php echo $product_images->name->CellAttributes() ?>><span class="ewSearchOpr">contains<input type="hidden" name="z_name" id="z_name" value="LIKE"></span></td>
		<td<?php echo $product_images->name->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_name" id="x_name" size="30" maxlength="200" value="<?php echo $product_images->name->EditValue ?>"<?php echo $product_images->name->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $product_images->name_arabic->RowAttributes ?>>
		<td class="ewTableHeader">name arabic</td>
		<td<?php echo $product_images->name_arabic->CellAttributes() ?>><span class="ewSearchOpr">contains<input type="hidden" name="z_name_arabic" id="z_name_arabic" value="LIKE"></span></td>
		<td<?php echo $product_images->name_arabic->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_name_arabic" id="x_name_arabic" size="30" maxlength="200" value="<?php echo $product_images->name_arabic->EditValue ?>"<?php echo $product_images->name_arabic->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $product_images->product_id->RowAttributes ?>>
		<td class="ewTableHeader">product</td>
		<td<?php echo $product_images->product_id->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_product_id" id="z_product_id" value="="></span></td>
		<td<?php echo $product_images->product_id->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_product_id" name="x_product_id"<?php echo $product_images->product_id->EditAttributes() ?>>
<?php
if (is_array($product_images->product_id->EditValue)) {
	$arwrk = $product_images->product_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($product_images->product_id->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $product_images->order->RowAttributes ?>>
		<td class="ewTableHeader">order</td>
		<td<?php echo $product_images->order->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_order" id="z_order" value="="></span></td>
		<td<?php echo $product_images->order->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_order" id="x_order" size="30" value="<?php echo $product_images->order->EditValue ?>"<?php echo $product_images->order->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $product_images->active->RowAttributes ?>>
		<td class="ewTableHeader">active</td>
		<td<?php echo $product_images->active->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_active" id="z_active" value="="></span></td>
		<td<?php echo $product_images->active->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<div id="tp_x_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_active" id="x_active" value="{value}"<?php echo $product_images->active->EditAttributes() ?>></div>
<div id="dsl_x_active" repeatcolumn="5">
<?php
$arwrk = $product_images->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($product_images->active->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
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
</span></td>
			</tr></table>
		</td>
	</tr>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="  Search  ">
<input type="button" name="Reset" id="Reset" value="   Reset   " onclick="ew_ClearForm(this.form);">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$product_images_search->Page_Terminate();
?>
<?php

//
// Page Class
//
class cproduct_images_search {

	// Page ID
	var $PageID = 'search';

	// Table Name
	var $TableName = 'product_images';

	// Page Object Name
	var $PageObjName = 'product_images_search';

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
	function cproduct_images_search() {
		global $conn;

		// Initialize table object
		$GLOBALS["product_images"] = new cproduct_images();

		// Initialize other table object
		$GLOBALS['products'] = new cproducts();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

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

	//
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsSearchError, $product_images;
		$objForm = new cFormObj();
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$product_images->CurrentAction = $objForm->GetValue("a_search");
			switch ($product_images->CurrentAction) {
				case "S": // Get Search Criteria

					// Build search string for advanced search, remove blank field
					$this->LoadSearchValues(); // Get search values
					if ($this->ValidateSearch()) {
						$sSrchStr = $this->BuildAdvancedSearch();
					} else {
						$sSrchStr = "";
						$this->setMessage($gsSearchError);
					}
					if ($sSrchStr <> "") {
						$sSrchStr = $product_images->UrlParm($sSrchStr);
						$this->Page_Terminate("product_imageslist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$product_images->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $product_images;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $product_images->id); // id
	$this->BuildSearchUrl($sSrchUrl, $product_images->name); // name
	$this->BuildSearchUrl($sSrchUrl, $product_images->name_arabic); // name_arabic
	$this->BuildSearchUrl($sSrchUrl, $product_images->product_id); // product_id
	$this->BuildSearchUrl($sSrchUrl, $product_images->order); // order
	$this->BuildSearchUrl($sSrchUrl, $product_images->active); // active
	return $sSrchUrl;
}

// Function to build search URL
function BuildSearchUrl(&$Url, &$Fld) {
	global $objForm;
	$sWrk = "";
	$FldParm = substr($Fld->FldVar, 2);
	$FldVal = $objForm->GetValue("x_$FldParm");
	$FldOpr = $objForm->GetValue("z_$FldParm");
	$FldCond = $objForm->GetValue("v_$FldParm");
	$FldVal2 = $objForm->GetValue("y_$FldParm");
	$FldOpr2 = $objForm->GetValue("w_$FldParm");
	$FldVal = ew_StripSlashes($FldVal);
	if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
	$FldVal2 = ew_StripSlashes($FldVal2);
	if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
	$FldOpr = strtoupper(trim($FldOpr));
	if ($FldOpr == "BETWEEN") {
		$IsValidValue = ($Fld->FldDataType <> EW_DATATYPE_NUMBER) ||
			($Fld->FldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal) && is_numeric($FldVal2));
		if ($FldVal <> "" && $FldVal2 <> "" && $IsValidValue) {
			$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
				"&y_" . $FldParm . "=" . urlencode($FldVal2) .
				"&z_" . $FldParm . "=" . urlencode($FldOpr);
		}
	} elseif ($FldOpr == "IS NULL" || $FldOpr == "IS NOT NULL") {
		$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
			"&z_" . $FldParm . "=" . urlencode($FldOpr);
	} else {
		$IsValidValue = ($Fld->FldDataType <> EW_DATATYPE_NUMBER) ||
			($Fld->FldDataType = EW_DATATYPE_NUMBER && is_numeric($FldVal));
		if ($FldVal <> "" && $IsValidValue && ew_IsValidOpr($FldOpr, $Fld->FldDataType)) {

			//$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
				"&z_" . $FldParm . "=" . urlencode($FldOpr);
		}
		$IsValidValue = ($Fld->FldDataType <> EW_DATATYPE_NUMBER) ||
			($Fld->FldDataType = EW_DATATYPE_NUMBER && is_numeric($FldVal2));
		if ($FldVal2 <> "" && $IsValidValue && ew_IsValidOpr($FldOpr2, $Fld->FldDataType)) {

			//$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			if ($sWrk <> "") $sWrk .= "&v_" . $FldParm . "=" . urlencode($FldCond) . "&";
			$sWrk .= "&y_" . $FldParm . "=" . urlencode($FldVal2) .
				"&w_" . $FldParm . "=" . urlencode($FldOpr2);
		}
	}
	if ($sWrk <> "") {
		if ($Url <> "") $Url .= "&";
		$Url .= $sWrk;
	}
}

	// Convert search value for date
	function ConvertSearchValue(&$Fld, $FldVal) {
		$Value = $FldVal;
		if ($Fld->FldDataType == EW_DATATYPE_DATE && $FldVal <> "")
			$Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
		return $Value;
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $product_images;

		// Load search values
		// id

		$product_images->id->AdvancedSearch->SearchValue = $objForm->GetValue("x_id");
		$product_images->id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_id");

		// name
		$product_images->name->AdvancedSearch->SearchValue = $objForm->GetValue("x_name");
		$product_images->name->AdvancedSearch->SearchOperator = $objForm->GetValue("z_name");

		// name_arabic
		$product_images->name_arabic->AdvancedSearch->SearchValue = $objForm->GetValue("x_name_arabic");
		$product_images->name_arabic->AdvancedSearch->SearchOperator = $objForm->GetValue("z_name_arabic");

		// product_id
		$product_images->product_id->AdvancedSearch->SearchValue = $objForm->GetValue("x_product_id");
		$product_images->product_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_product_id");

		// order
		$product_images->order->AdvancedSearch->SearchValue = $objForm->GetValue("x_order");
		$product_images->order->AdvancedSearch->SearchOperator = $objForm->GetValue("z_order");

		// active
		$product_images->active->AdvancedSearch->SearchValue = $objForm->GetValue("x_active");
		$product_images->active->AdvancedSearch->SearchOperator = $objForm->GetValue("z_active");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $product_images;

		// Call Row_Rendering event
		$product_images->Row_Rendering();

		// Common render codes for all row types
		// id

		$product_images->id->CellCssStyle = "";
		$product_images->id->CellCssClass = "";

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

			// id
			$product_images->id->HrefValue = "";

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
		} elseif ($product_images->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id
			$product_images->id->EditCustomAttributes = "";
			$product_images->id->EditValue = ew_HtmlEncode($product_images->id->AdvancedSearch->SearchValue);

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
			$product_images->name->EditValue = ew_HtmlEncode($product_images->name->AdvancedSearch->SearchValue);

			// name_arabic
			$product_images->name_arabic->EditCustomAttributes = "";
			$product_images->name_arabic->EditValue = ew_HtmlEncode($product_images->name_arabic->AdvancedSearch->SearchValue);

			// product_id
			$product_images->product_id->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `id`, `name`, `name_arabic`, '' AS SelectFilterFld FROM `products`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select", ""));
			$product_images->product_id->EditValue = $arwrk;

			// order
			$product_images->order->EditCustomAttributes = "";
			$product_images->order->EditValue = ew_HtmlEncode($product_images->order->AdvancedSearch->SearchValue);

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

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $product_images;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($product_images->id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect integer - id";
		}
		if (!ew_CheckInteger($product_images->order->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect integer - order";
		}

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sFormCustomError;
		}
		return $ValidateSearch;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $product_images;
		$product_images->id->AdvancedSearch->SearchValue = $product_images->getAdvancedSearch("x_id");
		$product_images->name->AdvancedSearch->SearchValue = $product_images->getAdvancedSearch("x_name");
		$product_images->name_arabic->AdvancedSearch->SearchValue = $product_images->getAdvancedSearch("x_name_arabic");
		$product_images->product_id->AdvancedSearch->SearchValue = $product_images->getAdvancedSearch("x_product_id");
		$product_images->order->AdvancedSearch->SearchValue = $product_images->getAdvancedSearch("x_order");
		$product_images->active->AdvancedSearch->SearchValue = $product_images->getAdvancedSearch("x_active");
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
