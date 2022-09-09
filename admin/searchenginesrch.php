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
$searchengine_search = new csearchengine_search();
$Page =& $searchengine_search;

// Page init processing
$searchengine_search->Page_Init();

// Page main processing
$searchengine_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var searchengine_search = new ew_Page("searchengine_search");

// page properties
searchengine_search.PageID = "search"; // page ID
var EW_PAGE_ID = searchengine_search.PageID; // for backward compatibility

// extend page with validate function for search
searchengine_search.ValidateSearch = function(fobj) {
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
searchengine_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
searchengine_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
searchengine_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
searchengine_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
searchengine_search.ShowHighlightText = "Show highlight"; 
searchengine_search.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">Search TABLE: searchengine<br><br>
<a href="<?php echo $searchengine->getReturnUrl() ?>">Back to List</a></span></p>
<?php $searchengine_search->ShowMessage() ?>
<form name="fsearchenginesearch" id="fsearchenginesearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return searchengine_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="searchengine">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $searchengine->id->RowAttributes ?>>
		<td class="ewTableHeader">id</td>
		<td<?php echo $searchengine->id->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_id" id="z_id" value="="></span></td>
		<td<?php echo $searchengine->id->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_id" id="x_id" value="<?php echo $searchengine->id->EditValue ?>"<?php echo $searchengine->id->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $searchengine->zpage->RowAttributes ?>>
		<td class="ewTableHeader">page</td>
		<td<?php echo $searchengine->zpage->CellAttributes() ?>><span class="ewSearchOpr">contains<input type="hidden" name="z_zpage" id="z_zpage" value="LIKE"></span></td>
		<td<?php echo $searchengine->zpage->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_zpage" id="x_zpage" size="30" maxlength="50" value="<?php echo $searchengine->zpage->EditValue ?>"<?php echo $searchengine->zpage->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $searchengine->description->RowAttributes ?>>
		<td class="ewTableHeader">description</td>
		<td<?php echo $searchengine->description->CellAttributes() ?>><span class="ewSearchOpr">contains<input type="hidden" name="z_description" id="z_description" value="LIKE"></span></td>
		<td<?php echo $searchengine->description->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<textarea name="x_description" id="x_description" cols="35" rows="4"<?php echo $searchengine->description->EditAttributes() ?>><?php echo $searchengine->description->EditValue ?></textarea>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $searchengine->keywords->RowAttributes ?>>
		<td class="ewTableHeader">keywords</td>
		<td<?php echo $searchengine->keywords->CellAttributes() ?>><span class="ewSearchOpr">contains<input type="hidden" name="z_keywords" id="z_keywords" value="LIKE"></span></td>
		<td<?php echo $searchengine->keywords->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<textarea name="x_keywords" id="x_keywords" cols="35" rows="4"<?php echo $searchengine->keywords->EditAttributes() ?>><?php echo $searchengine->keywords->EditValue ?></textarea>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $searchengine->title->RowAttributes ?>>
		<td class="ewTableHeader">title</td>
		<td<?php echo $searchengine->title->CellAttributes() ?>><span class="ewSearchOpr">contains<input type="hidden" name="z_title" id="z_title" value="LIKE"></span></td>
		<td<?php echo $searchengine->title->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_title" id="x_title" size="30" maxlength="250" value="<?php echo $searchengine->title->EditValue ?>"<?php echo $searchengine->title->EditAttributes() ?>>
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
$searchengine_search->Page_Terminate();
?>
<?php

//
// Page Class
//
class csearchengine_search {

	// Page ID
	var $PageID = 'search';

	// Table Name
	var $TableName = 'searchengine';

	// Page Object Name
	var $PageObjName = 'searchengine_search';

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
	function csearchengine_search() {
		global $conn;

		// Initialize table object
		$GLOBALS["searchengine"] = new csearchengine();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

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

	//
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsSearchError, $searchengine;
		$objForm = new cFormObj();
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$searchengine->CurrentAction = $objForm->GetValue("a_search");
			switch ($searchengine->CurrentAction) {
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
						$sSrchStr = $searchengine->UrlParm($sSrchStr);
						$this->Page_Terminate("searchenginelist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$searchengine->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $searchengine;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $searchengine->id); // id
	$this->BuildSearchUrl($sSrchUrl, $searchengine->zpage); // page
	$this->BuildSearchUrl($sSrchUrl, $searchengine->description); // description
	$this->BuildSearchUrl($sSrchUrl, $searchengine->keywords); // keywords
	$this->BuildSearchUrl($sSrchUrl, $searchengine->title); // title
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
		global $objForm, $searchengine;

		// Load search values
		// id

		$searchengine->id->AdvancedSearch->SearchValue = $objForm->GetValue("x_id");
		$searchengine->id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_id");

		// page
		$searchengine->zpage->AdvancedSearch->SearchValue = $objForm->GetValue("x_zpage");
		$searchengine->zpage->AdvancedSearch->SearchOperator = $objForm->GetValue("z_zpage");

		// description
		$searchengine->description->AdvancedSearch->SearchValue = $objForm->GetValue("x_description");
		$searchengine->description->AdvancedSearch->SearchOperator = $objForm->GetValue("z_description");

		// keywords
		$searchengine->keywords->AdvancedSearch->SearchValue = $objForm->GetValue("x_keywords");
		$searchengine->keywords->AdvancedSearch->SearchOperator = $objForm->GetValue("z_keywords");

		// title
		$searchengine->title->AdvancedSearch->SearchValue = $objForm->GetValue("x_title");
		$searchengine->title->AdvancedSearch->SearchOperator = $objForm->GetValue("z_title");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $searchengine;

		// Call Row_Rendering event
		$searchengine->Row_Rendering();

		// Common render codes for all row types
		// id

		$searchengine->id->CellCssStyle = "";
		$searchengine->id->CellCssClass = "";

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

			// id
			$searchengine->id->HrefValue = "";

			// page
			$searchengine->zpage->HrefValue = "";

			// description
			$searchengine->description->HrefValue = "";

			// keywords
			$searchengine->keywords->HrefValue = "";

			// title
			$searchengine->title->HrefValue = "";
		} elseif ($searchengine->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id
			$searchengine->id->EditCustomAttributes = "";
			$searchengine->id->EditValue = ew_HtmlEncode($searchengine->id->AdvancedSearch->SearchValue);

			// page
			$searchengine->zpage->EditCustomAttributes = "";
			$searchengine->zpage->EditValue = ew_HtmlEncode($searchengine->zpage->AdvancedSearch->SearchValue);

			// description
			$searchengine->description->EditCustomAttributes = "";
			$searchengine->description->EditValue = ew_HtmlEncode($searchengine->description->AdvancedSearch->SearchValue);

			// keywords
			$searchengine->keywords->EditCustomAttributes = "";
			$searchengine->keywords->EditValue = ew_HtmlEncode($searchengine->keywords->AdvancedSearch->SearchValue);

			// title
			$searchengine->title->EditCustomAttributes = "";
			$searchengine->title->EditValue = ew_HtmlEncode($searchengine->title->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		$searchengine->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $searchengine;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($searchengine->id->AdvancedSearch->SearchValue)) {
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
		global $searchengine;
		$searchengine->id->AdvancedSearch->SearchValue = $searchengine->getAdvancedSearch("x_id");
		$searchengine->zpage->AdvancedSearch->SearchValue = $searchengine->getAdvancedSearch("x_zpage");
		$searchengine->description->AdvancedSearch->SearchValue = $searchengine->getAdvancedSearch("x_description");
		$searchengine->keywords->AdvancedSearch->SearchValue = $searchengine->getAdvancedSearch("x_keywords");
		$searchengine->title->AdvancedSearch->SearchValue = $searchengine->getAdvancedSearch("x_title");
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
