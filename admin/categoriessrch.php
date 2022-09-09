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
$categories_search = new ccategories_search();
$Page =& $categories_search;

// Page init processing
$categories_search->Page_Init();

// Page main processing
$categories_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var categories_search = new ew_Page("categories_search");

// page properties
categories_search.PageID = "search"; // page ID
var EW_PAGE_ID = categories_search.PageID; // for backward compatibility

// extend page with validate function for search
categories_search.ValidateSearch = function(fobj) {
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
categories_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
categories_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
categories_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
categories_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
categories_search.ShowHighlightText = "Show highlight"; 
categories_search.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">Search TABLE: categories<br><br>
<a href="<?php echo $categories->getReturnUrl() ?>">Back to List</a></span></p>
<?php $categories_search->ShowMessage() ?>
<form name="fcategoriessearch" id="fcategoriessearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return categories_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="categories">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $categories->id->RowAttributes ?>>
		<td class="ewTableHeader">id</td>
		<td<?php echo $categories->id->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_id" id="z_id" value="="></span></td>
		<td<?php echo $categories->id->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_id" id="x_id" value="<?php echo $categories->id->EditValue ?>"<?php echo $categories->id->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $categories->name->RowAttributes ?>>
		<td class="ewTableHeader">name</td>
		<td<?php echo $categories->name->CellAttributes() ?>><span class="ewSearchOpr">contains<input type="hidden" name="z_name" id="z_name" value="LIKE"></span></td>
		<td<?php echo $categories->name->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<textarea name="x_name" id="x_name" cols="35" rows="4"<?php echo $categories->name->EditAttributes() ?>><?php echo $categories->name->EditValue ?></textarea>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $categories->name_arabic->RowAttributes ?>>
		<td class="ewTableHeader">name arabic</td>
		<td<?php echo $categories->name_arabic->CellAttributes() ?>><span class="ewSearchOpr">contains<input type="hidden" name="z_name_arabic" id="z_name_arabic" value="LIKE"></span></td>
		<td<?php echo $categories->name_arabic->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<textarea name="x_name_arabic" id="x_name_arabic" cols="35" rows="4"<?php echo $categories->name_arabic->EditAttributes() ?>><?php echo $categories->name_arabic->EditValue ?></textarea>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $categories->order->RowAttributes ?>>
		<td class="ewTableHeader">order</td>
		<td<?php echo $categories->order->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_order" id="z_order" value="="></span></td>
		<td<?php echo $categories->order->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_order" id="x_order" size="30" value="<?php echo $categories->order->EditValue ?>"<?php echo $categories->order->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $categories->active->RowAttributes ?>>
		<td class="ewTableHeader">active</td>
		<td<?php echo $categories->active->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_active" id="z_active" value="="></span></td>
		<td<?php echo $categories->active->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<div id="tp_x_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_active" id="x_active" value="{value}"<?php echo $categories->active->EditAttributes() ?>></div>
<div id="dsl_x_active" repeatcolumn="5">
<?php
$arwrk = $categories->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($categories->active->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
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
$categories_search->Page_Terminate();
?>
<?php

//
// Page Class
//
class ccategories_search {

	// Page ID
	var $PageID = 'search';

	// Table Name
	var $TableName = 'categories';

	// Page Object Name
	var $PageObjName = 'categories_search';

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
	function ccategories_search() {
		global $conn;

		// Initialize table object
		$GLOBALS["categories"] = new ccategories();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

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
		global $objForm, $gsSearchError, $categories;
		$objForm = new cFormObj();
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$categories->CurrentAction = $objForm->GetValue("a_search");
			switch ($categories->CurrentAction) {
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
						$sSrchStr = $categories->UrlParm($sSrchStr);
						$this->Page_Terminate("categorieslist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$categories->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $categories;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $categories->id); // id
	$this->BuildSearchUrl($sSrchUrl, $categories->name); // name
	$this->BuildSearchUrl($sSrchUrl, $categories->name_arabic); // name_arabic
	$this->BuildSearchUrl($sSrchUrl, $categories->order); // order
	$this->BuildSearchUrl($sSrchUrl, $categories->active); // active
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
		global $objForm, $categories;

		// Load search values
		// id

		$categories->id->AdvancedSearch->SearchValue = $objForm->GetValue("x_id");
		$categories->id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_id");

		// name
		$categories->name->AdvancedSearch->SearchValue = $objForm->GetValue("x_name");
		$categories->name->AdvancedSearch->SearchOperator = $objForm->GetValue("z_name");

		// name_arabic
		$categories->name_arabic->AdvancedSearch->SearchValue = $objForm->GetValue("x_name_arabic");
		$categories->name_arabic->AdvancedSearch->SearchOperator = $objForm->GetValue("z_name_arabic");

		// order
		$categories->order->AdvancedSearch->SearchValue = $objForm->GetValue("x_order");
		$categories->order->AdvancedSearch->SearchOperator = $objForm->GetValue("z_order");

		// active
		$categories->active->AdvancedSearch->SearchValue = $objForm->GetValue("x_active");
		$categories->active->AdvancedSearch->SearchOperator = $objForm->GetValue("z_active");
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
		} elseif ($categories->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id
			$categories->id->EditCustomAttributes = "";
			$categories->id->EditValue = ew_HtmlEncode($categories->id->AdvancedSearch->SearchValue);

			// name
			$categories->name->EditCustomAttributes = "";
			$categories->name->EditValue = ew_HtmlEncode($categories->name->AdvancedSearch->SearchValue);

			// name_arabic
			$categories->name_arabic->EditCustomAttributes = "";
			$categories->name_arabic->EditValue = ew_HtmlEncode($categories->name_arabic->AdvancedSearch->SearchValue);

			// order
			$categories->order->EditCustomAttributes = "";
			$categories->order->EditValue = ew_HtmlEncode($categories->order->AdvancedSearch->SearchValue);

			// active
			$categories->active->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$categories->active->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$categories->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $categories;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($categories->id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect integer - id";
		}
		if (!ew_CheckInteger($categories->order->AdvancedSearch->SearchValue)) {
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
		global $categories;
		$categories->id->AdvancedSearch->SearchValue = $categories->getAdvancedSearch("x_id");
		$categories->name->AdvancedSearch->SearchValue = $categories->getAdvancedSearch("x_name");
		$categories->name_arabic->AdvancedSearch->SearchValue = $categories->getAdvancedSearch("x_name_arabic");
		$categories->order->AdvancedSearch->SearchValue = $categories->getAdvancedSearch("x_order");
		$categories->active->AdvancedSearch->SearchValue = $categories->getAdvancedSearch("x_active");
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
