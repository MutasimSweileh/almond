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
$visitors_search = new cvisitors_search();
$Page =& $visitors_search;

// Page init processing
$visitors_search->Page_Init();

// Page main processing
$visitors_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var visitors_search = new ew_Page("visitors_search");

// page properties
visitors_search.PageID = "search"; // page ID
var EW_PAGE_ID = visitors_search.PageID; // for backward compatibility

// extend page with validate function for search
visitors_search.ValidateSearch = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var infix = "";
	elm = fobj.elements["x" + infix + "_id"];
	if (elm && !ew_CheckInteger(elm.value))
		return ew_OnError(this, elm, "Incorrect integer - id");

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
visitors_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
visitors_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
visitors_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
visitors_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
visitors_search.ShowHighlightText = "Show highlight"; 
visitors_search.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">Search TABLE: visitors<br><br>
<a href="<?php echo $visitors->getReturnUrl() ?>">Back to List</a></span></p>
<?php $visitors_search->ShowMessage() ?>
<form name="fvisitorssearch" id="fvisitorssearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return visitors_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="visitors">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $visitors->id->RowAttributes ?>>
		<td class="ewTableHeader">id</td>
		<td<?php echo $visitors->id->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_id" id="z_id" value="="></span></td>
		<td<?php echo $visitors->id->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_id" id="x_id" value="<?php echo $visitors->id->EditValue ?>"<?php echo $visitors->id->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $visitors->zemail->RowAttributes ?>>
		<td class="ewTableHeader">email</td>
		<td<?php echo $visitors->zemail->CellAttributes() ?>><span class="ewSearchOpr">contains<input type="hidden" name="z_zemail" id="z_zemail" value="LIKE"></span></td>
		<td<?php echo $visitors->zemail->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_zemail" id="x_zemail" size="30" maxlength="250" value="<?php echo $visitors->zemail->EditValue ?>"<?php echo $visitors->zemail->EditAttributes() ?>>
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
$visitors_search->Page_Terminate();
?>
<?php

//
// Page Class
//
class cvisitors_search {

	// Page ID
	var $PageID = 'search';

	// Table Name
	var $TableName = 'visitors';

	// Page Object Name
	var $PageObjName = 'visitors_search';

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
	function cvisitors_search() {
		global $conn;

		// Initialize table object
		$GLOBALS["visitors"] = new cvisitors();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

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

	//
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsSearchError, $visitors;
		$objForm = new cFormObj();
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$visitors->CurrentAction = $objForm->GetValue("a_search");
			switch ($visitors->CurrentAction) {
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
						$sSrchStr = $visitors->UrlParm($sSrchStr);
						$this->Page_Terminate("visitorslist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$visitors->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $visitors;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $visitors->id); // id
	$this->BuildSearchUrl($sSrchUrl, $visitors->zemail); // email
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
		global $objForm, $visitors;

		// Load search values
		// id

		$visitors->id->AdvancedSearch->SearchValue = $objForm->GetValue("x_id");
		$visitors->id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_id");

		// email
		$visitors->zemail->AdvancedSearch->SearchValue = $objForm->GetValue("x_zemail");
		$visitors->zemail->AdvancedSearch->SearchOperator = $objForm->GetValue("z_zemail");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $visitors;

		// Call Row_Rendering event
		$visitors->Row_Rendering();

		// Common render codes for all row types
		// id

		$visitors->id->CellCssStyle = "";
		$visitors->id->CellCssClass = "";

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

			// id
			$visitors->id->HrefValue = "";

			// email
			$visitors->zemail->HrefValue = "";
		} elseif ($visitors->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id
			$visitors->id->EditCustomAttributes = "";
			$visitors->id->EditValue = ew_HtmlEncode($visitors->id->AdvancedSearch->SearchValue);

			// email
			$visitors->zemail->EditCustomAttributes = "";
			$visitors->zemail->EditValue = ew_HtmlEncode($visitors->zemail->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		$visitors->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $visitors;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($visitors->id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect integer - id";
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
		global $visitors;
		$visitors->id->AdvancedSearch->SearchValue = $visitors->getAdvancedSearch("x_id");
		$visitors->zemail->AdvancedSearch->SearchValue = $visitors->getAdvancedSearch("x_zemail");
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
