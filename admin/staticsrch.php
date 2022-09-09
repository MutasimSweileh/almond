<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "staticinfo.php" ?>
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
$static_search = new cstatic_search();
$Page =& $static_search;

// Page init processing
$static_search->Page_Init();

// Page main processing
$static_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var static_search = new ew_Page("static_search");

// page properties
static_search.PageID = "search"; // page ID
var EW_PAGE_ID = static_search.PageID; // for backward compatibility

// extend page with validate function for search
static_search.ValidateSearch = function(fobj) {
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
static_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
static_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
static_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
static_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
static_search.ShowHighlightText = "Show highlight"; 
static_search.HideHighlightText = "Hide highlight";

//-->
</script>
<script type="text/javascript" src="fckeditor/fckeditor.js"></script>
<script type="text/javascript">
<!--
_width_multiplier = 16;
_height_multiplier = 60;
var ew_DHTMLEditors = [];

// update value from editor to textarea
function ew_UpdateTextArea() {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof FCKeditorAPI != 'undefined') {			
			var inst;			
			for (inst in FCKeditorAPI.__Instances)
				FCKeditorAPI.__Instances[inst].UpdateLinkedField();
	}
}

// update value from textarea to editor
function ew_UpdateDHTMLEditor(name) {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof FCKeditorAPI != 'undefined') {
		var inst = FCKeditorAPI.GetInstance(name);		
		if (inst)
			inst.SetHTML(inst.LinkedField.value)
	}
}

// focus editor
function ew_FocusDHTMLEditor(name) {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof FCKeditorAPI != 'undefined') {
		var inst = FCKeditorAPI.GetInstance(name);	
		if (inst && inst.EditorWindow) {
			inst.EditorWindow.focus();
		}
	}
}

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker">Search TABLE: static<br><br>
<a href="<?php echo $static->getReturnUrl() ?>">Back to List</a></span></p>
<?php $static_search->ShowMessage() ?>
<form name="fstaticsearch" id="fstaticsearch" action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="static">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $static->id->RowAttributes ?>>
		<td class="ewTableHeader">id</td>
		<td<?php echo $static->id->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_id" id="z_id" value="="></span></td>
		<td<?php echo $static->id->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_id" id="x_id" value="<?php echo $static->id->EditValue ?>"<?php echo $static->id->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $static->code->RowAttributes ?>>
		<td class="ewTableHeader">code</td>
		<td<?php echo $static->code->CellAttributes() ?>><span class="ewSearchOpr">contains<input type="hidden" name="z_code" id="z_code" value="LIKE"></span></td>
		<td<?php echo $static->code->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_code" id="x_code" size="30" maxlength="100" value="<?php echo $static->code->EditValue ?>"<?php echo $static->code->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $static->english->RowAttributes ?>>
		<td class="ewTableHeader">english</td>
		<td<?php echo $static->english->CellAttributes() ?>><span class="ewSearchOpr">contains<input type="hidden" name="z_english" id="z_english" value="LIKE"></span></td>
		<td<?php echo $static->english->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<textarea name="x_english" id="x_english" cols="40" rows="10"<?php echo $static->english->EditAttributes() ?>><?php echo $static->english->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_english", function() {
	var sBasePath = 'fckeditor/';
	var oFCKeditor = new FCKeditor('x_english', 40*_width_multiplier, 10*_height_multiplier);
	oFCKeditor.BasePath = sBasePath;
	oFCKeditor.ReplaceTextarea();
	this.active = true;
}));
-->
</script>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $static->arabic->RowAttributes ?>>
		<td class="ewTableHeader">arabic</td>
		<td<?php echo $static->arabic->CellAttributes() ?>><span class="ewSearchOpr">contains<input type="hidden" name="z_arabic" id="z_arabic" value="LIKE"></span></td>
		<td<?php echo $static->arabic->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<textarea name="x_arabic" id="x_arabic" cols="40" rows="10"<?php echo $static->arabic->EditAttributes() ?>><?php echo $static->arabic->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_arabic", function() {
	var sBasePath = 'fckeditor/';
	var oFCKeditor = new FCKeditor('x_arabic', 40*_width_multiplier, 10*_height_multiplier);
	oFCKeditor.BasePath = sBasePath;
	oFCKeditor.ReplaceTextarea();
	this.active = true;
}));
-->
</script>
</span></td>
			</tr></table>
		</td>
	</tr>
</table>
</div>
</td></tr></table>
<p>
<input type="button" name="Action" id="Action" value="  Search  " onclick="ew_SubmitSearch(static_search, this.form);">
<input type="button" name="Reset" id="Reset" value="   Reset   " onclick="ew_ClearForm(this.form);">
</form>
<script type="text/javascript">
<!--
ew_CreateEditor();  // Create DHTML editor(s)

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$static_search->Page_Terminate();
?>
<?php

//
// Page Class
//
class cstatic_search {

	// Page ID
	var $PageID = 'search';

	// Table Name
	var $TableName = 'static';

	// Page Object Name
	var $PageObjName = 'static_search';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $static;
		if ($static->UseTokenInUrl) $PageUrl .= "t=" . $static->TableVar . "&"; // add page token
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
		global $objForm, $static;
		if ($static->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($static->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($static->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cstatic_search() {
		global $conn;

		// Initialize table object
		$GLOBALS["static"] = new cstatic();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'static', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $static;
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
		global $objForm, $gsSearchError, $static;
		$objForm = new cFormObj();
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$static->CurrentAction = $objForm->GetValue("a_search");
			switch ($static->CurrentAction) {
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
						$sSrchStr = $static->UrlParm($sSrchStr);
						$this->Page_Terminate("staticlist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$static->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $static;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $static->id); // id
	$this->BuildSearchUrl($sSrchUrl, $static->code); // code
	$this->BuildSearchUrl($sSrchUrl, $static->english); // english
	$this->BuildSearchUrl($sSrchUrl, $static->arabic); // arabic
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
		global $objForm, $static;

		// Load search values
		// id

		$static->id->AdvancedSearch->SearchValue = $objForm->GetValue("x_id");
		$static->id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_id");

		// code
		$static->code->AdvancedSearch->SearchValue = $objForm->GetValue("x_code");
		$static->code->AdvancedSearch->SearchOperator = $objForm->GetValue("z_code");

		// english
		$static->english->AdvancedSearch->SearchValue = $objForm->GetValue("x_english");
		$static->english->AdvancedSearch->SearchOperator = $objForm->GetValue("z_english");

		// arabic
		$static->arabic->AdvancedSearch->SearchValue = $objForm->GetValue("x_arabic");
		$static->arabic->AdvancedSearch->SearchOperator = $objForm->GetValue("z_arabic");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $static;

		// Call Row_Rendering event
		$static->Row_Rendering();

		// Common render codes for all row types
		// id

		$static->id->CellCssStyle = "";
		$static->id->CellCssClass = "";

		// code
		$static->code->CellCssStyle = "";
		$static->code->CellCssClass = "";

		// english
		$static->english->CellCssStyle = "";
		$static->english->CellCssClass = "";

		// arabic
		$static->arabic->CellCssStyle = "";
		$static->arabic->CellCssClass = "";
		if ($static->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$static->id->ViewValue = $static->id->CurrentValue;
			$static->id->CssStyle = "";
			$static->id->CssClass = "";
			$static->id->ViewCustomAttributes = "";

			// code
			$static->code->ViewValue = $static->code->CurrentValue;
			$static->code->CssStyle = "";
			$static->code->CssClass = "";
			$static->code->ViewCustomAttributes = "";

			// english
			$static->english->ViewValue = $static->english->CurrentValue;
			$static->english->CssStyle = "";
			$static->english->CssClass = "";
			$static->english->ViewCustomAttributes = "";

			// arabic
			$static->arabic->ViewValue = $static->arabic->CurrentValue;
			$static->arabic->CssStyle = "";
			$static->arabic->CssClass = "";
			$static->arabic->ViewCustomAttributes = "";

			// id
			$static->id->HrefValue = "";

			// code
			$static->code->HrefValue = "";

			// english
			$static->english->HrefValue = "";

			// arabic
			$static->arabic->HrefValue = "";
		} elseif ($static->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id
			$static->id->EditCustomAttributes = "";
			$static->id->EditValue = ew_HtmlEncode($static->id->AdvancedSearch->SearchValue);

			// code
			$static->code->EditCustomAttributes = "";
			$static->code->EditValue = ew_HtmlEncode($static->code->AdvancedSearch->SearchValue);

			// english
			$static->english->EditCustomAttributes = "";
			$static->english->EditValue = ew_HtmlEncode($static->english->AdvancedSearch->SearchValue);

			// arabic
			$static->arabic->EditCustomAttributes = "";
			$static->arabic->EditValue = ew_HtmlEncode($static->arabic->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		$static->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $static;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($static->id->AdvancedSearch->SearchValue)) {
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
		global $static;
		$static->id->AdvancedSearch->SearchValue = $static->getAdvancedSearch("x_id");
		$static->code->AdvancedSearch->SearchValue = $static->getAdvancedSearch("x_code");
		$static->english->AdvancedSearch->SearchValue = $static->getAdvancedSearch("x_english");
		$static->arabic->AdvancedSearch->SearchValue = $static->getAdvancedSearch("x_arabic");
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
