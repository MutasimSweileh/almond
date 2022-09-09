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
$slider_search = new cslider_search();
$Page =& $slider_search;

// Page init processing
$slider_search->Page_Init();

// Page main processing
$slider_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var slider_search = new ew_Page("slider_search");

// page properties
slider_search.PageID = "search"; // page ID
var EW_PAGE_ID = slider_search.PageID; // for backward compatibility

// extend page with validate function for search
slider_search.ValidateSearch = function(fobj) {
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
slider_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
slider_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
slider_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
slider_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
slider_search.ShowHighlightText = "Show highlight"; 
slider_search.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">Search TABLE: slider<br><br>
<a href="<?php echo $slider->getReturnUrl() ?>">Back to List</a></span></p>
<?php $slider_search->ShowMessage() ?>
<form name="fslidersearch" id="fslidersearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return slider_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="slider">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $slider->id->RowAttributes ?>>
		<td class="ewTableHeader">id</td>
		<td<?php echo $slider->id->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_id" id="z_id" value="="></span></td>
		<td<?php echo $slider->id->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_id" id="x_id" value="<?php echo $slider->id->EditValue ?>"<?php echo $slider->id->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $slider->order->RowAttributes ?>>
		<td class="ewTableHeader">order</td>
		<td<?php echo $slider->order->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_order" id="z_order" value="="></span></td>
		<td<?php echo $slider->order->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_order" id="x_order" size="30" value="<?php echo $slider->order->EditValue ?>"<?php echo $slider->order->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $slider->active->RowAttributes ?>>
		<td class="ewTableHeader">active</td>
		<td<?php echo $slider->active->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_active" id="z_active" value="="></span></td>
		<td<?php echo $slider->active->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<div id="tp_x_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_active" id="x_active" value="{value}"<?php echo $slider->active->EditAttributes() ?>></div>
<div id="dsl_x_active" repeatcolumn="5">
<?php
$arwrk = $slider->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($slider->active->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
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
$slider_search->Page_Terminate();
?>
<?php

//
// Page Class
//
class cslider_search {

	// Page ID
	var $PageID = 'search';

	// Table Name
	var $TableName = 'slider';

	// Page Object Name
	var $PageObjName = 'slider_search';

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
	function cslider_search() {
		global $conn;

		// Initialize table object
		$GLOBALS["slider"] = new cslider();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

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

	//
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsSearchError, $slider;
		$objForm = new cFormObj();
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$slider->CurrentAction = $objForm->GetValue("a_search");
			switch ($slider->CurrentAction) {
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
						$sSrchStr = $slider->UrlParm($sSrchStr);
						$this->Page_Terminate("sliderlist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$slider->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $slider;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $slider->id); // id
	$this->BuildSearchUrl($sSrchUrl, $slider->order); // order
	$this->BuildSearchUrl($sSrchUrl, $slider->active); // active
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
		global $objForm, $slider;

		// Load search values
		// id

		$slider->id->AdvancedSearch->SearchValue = $objForm->GetValue("x_id");
		$slider->id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_id");

		// order
		$slider->order->AdvancedSearch->SearchValue = $objForm->GetValue("x_order");
		$slider->order->AdvancedSearch->SearchOperator = $objForm->GetValue("z_order");

		// active
		$slider->active->AdvancedSearch->SearchValue = $objForm->GetValue("x_active");
		$slider->active->AdvancedSearch->SearchOperator = $objForm->GetValue("z_active");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $slider;

		// Call Row_Rendering event
		$slider->Row_Rendering();

		// Common render codes for all row types
		// id

		$slider->id->CellCssStyle = "";
		$slider->id->CellCssClass = "";

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

			// id
			$slider->id->HrefValue = "";

			// image
			$slider->image->HrefValue = "";

			// order
			$slider->order->HrefValue = "";

			// active
			$slider->active->HrefValue = "";
		} elseif ($slider->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id
			$slider->id->EditCustomAttributes = "";
			$slider->id->EditValue = ew_HtmlEncode($slider->id->AdvancedSearch->SearchValue);

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
			$slider->order->EditValue = ew_HtmlEncode($slider->order->AdvancedSearch->SearchValue);

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

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $slider;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($slider->id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect integer - id";
		}
		if (!ew_CheckInteger($slider->order->AdvancedSearch->SearchValue)) {
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
		global $slider;
		$slider->id->AdvancedSearch->SearchValue = $slider->getAdvancedSearch("x_id");
		$slider->order->AdvancedSearch->SearchValue = $slider->getAdvancedSearch("x_order");
		$slider->active->AdvancedSearch->SearchValue = $slider->getAdvancedSearch("x_active");
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
