<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "about_iteminfo.php" ?>
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
$about_item_search = new cabout_item_search();
$Page =& $about_item_search;

// Page init processing
$about_item_search->Page_Init();

// Page main processing
$about_item_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var about_item_search = new ew_Page("about_item_search");

// page properties
about_item_search.PageID = "search"; // page ID
var EW_PAGE_ID = about_item_search.PageID; // for backward compatibility

// extend page with validate function for search
about_item_search.ValidateSearch = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var infix = "";
	elm = fobj.elements["x" + infix + "_id"];
	if (elm && !ew_CheckInteger(elm.value))
		return ew_OnError(this, elm, "Incorrect integer - id");
	elm = fobj.elements["x" + infix + "_count"];
	if (elm && !ew_CheckInteger(elm.value))
		return ew_OnError(this, elm, "Incorrect integer - count");
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
about_item_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
about_item_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
about_item_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
about_item_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
about_item_search.ShowHighlightText = "Show highlight"; 
about_item_search.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">Search TABLE: about item<br><br>
<a href="<?php echo $about_item->getReturnUrl() ?>">Back to List</a></span></p>
<?php $about_item_search->ShowMessage() ?>
<form name="fabout_itemsearch" id="fabout_itemsearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return about_item_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="about_item">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $about_item->id->RowAttributes ?>>
		<td class="ewTableHeader">id</td>
		<td<?php echo $about_item->id->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_id" id="z_id" value="="></span></td>
		<td<?php echo $about_item->id->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_id" id="x_id" value="<?php echo $about_item->id->EditValue ?>"<?php echo $about_item->id->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $about_item->title->RowAttributes ?>>
		<td class="ewTableHeader">title</td>
		<td<?php echo $about_item->title->CellAttributes() ?>><span class="ewSearchOpr">contains<input type="hidden" name="z_title" id="z_title" value="LIKE"></span></td>
		<td<?php echo $about_item->title->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<textarea name="x_title" id="x_title" cols="35" rows="4"<?php echo $about_item->title->EditAttributes() ?>><?php echo $about_item->title->EditValue ?></textarea>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $about_item->title_arabic->RowAttributes ?>>
		<td class="ewTableHeader">title arabic</td>
		<td<?php echo $about_item->title_arabic->CellAttributes() ?>><span class="ewSearchOpr">contains<input type="hidden" name="z_title_arabic" id="z_title_arabic" value="LIKE"></span></td>
		<td<?php echo $about_item->title_arabic->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<textarea name="x_title_arabic" id="x_title_arabic" cols="35" rows="4"<?php echo $about_item->title_arabic->EditAttributes() ?>><?php echo $about_item->title_arabic->EditValue ?></textarea>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $about_item->text->RowAttributes ?>>
		<td class="ewTableHeader">text</td>
		<td<?php echo $about_item->text->CellAttributes() ?>><span class="ewSearchOpr">contains<input type="hidden" name="z_text" id="z_text" value="LIKE"></span></td>
		<td<?php echo $about_item->text->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<textarea name="x_text" id="x_text" cols="35" rows="4"<?php echo $about_item->text->EditAttributes() ?>><?php echo $about_item->text->EditValue ?></textarea>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $about_item->text_arabic->RowAttributes ?>>
		<td class="ewTableHeader">text arabic</td>
		<td<?php echo $about_item->text_arabic->CellAttributes() ?>><span class="ewSearchOpr">contains<input type="hidden" name="z_text_arabic" id="z_text_arabic" value="LIKE"></span></td>
		<td<?php echo $about_item->text_arabic->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<textarea name="x_text_arabic" id="x_text_arabic" cols="35" rows="4"<?php echo $about_item->text_arabic->EditAttributes() ?>><?php echo $about_item->text_arabic->EditValue ?></textarea>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $about_item->count->RowAttributes ?>>
		<td class="ewTableHeader">count</td>
		<td<?php echo $about_item->count->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_count" id="z_count" value="="></span></td>
		<td<?php echo $about_item->count->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_count" id="x_count" size="30" value="<?php echo $about_item->count->EditValue ?>"<?php echo $about_item->count->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $about_item->order->RowAttributes ?>>
		<td class="ewTableHeader">order</td>
		<td<?php echo $about_item->order->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_order" id="z_order" value="="></span></td>
		<td<?php echo $about_item->order->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_order" id="x_order" size="30" value="<?php echo $about_item->order->EditValue ?>"<?php echo $about_item->order->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $about_item->active->RowAttributes ?>>
		<td class="ewTableHeader">active</td>
		<td<?php echo $about_item->active->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_active" id="z_active" value="="></span></td>
		<td<?php echo $about_item->active->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<div id="tp_x_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_active" id="x_active" value="{value}"<?php echo $about_item->active->EditAttributes() ?>></div>
<div id="dsl_x_active" repeatcolumn="5">
<?php
$arwrk = $about_item->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($about_item->active->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_active" id="x_active" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $about_item->active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
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
$about_item_search->Page_Terminate();
?>
<?php

//
// Page Class
//
class cabout_item_search {

	// Page ID
	var $PageID = 'search';

	// Table Name
	var $TableName = 'about_item';

	// Page Object Name
	var $PageObjName = 'about_item_search';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $about_item;
		if ($about_item->UseTokenInUrl) $PageUrl .= "t=" . $about_item->TableVar . "&"; // add page token
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
		global $objForm, $about_item;
		if ($about_item->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($about_item->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($about_item->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cabout_item_search() {
		global $conn;

		// Initialize table object
		$GLOBALS["about_item"] = new cabout_item();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'about_item', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $about_item;
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
		global $objForm, $gsSearchError, $about_item;
		$objForm = new cFormObj();
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$about_item->CurrentAction = $objForm->GetValue("a_search");
			switch ($about_item->CurrentAction) {
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
						$sSrchStr = $about_item->UrlParm($sSrchStr);
						$this->Page_Terminate("about_itemlist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$about_item->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $about_item;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $about_item->id); // id
	$this->BuildSearchUrl($sSrchUrl, $about_item->title); // title
	$this->BuildSearchUrl($sSrchUrl, $about_item->title_arabic); // title_arabic
	$this->BuildSearchUrl($sSrchUrl, $about_item->text); // text
	$this->BuildSearchUrl($sSrchUrl, $about_item->text_arabic); // text_arabic
	$this->BuildSearchUrl($sSrchUrl, $about_item->count); // count
	$this->BuildSearchUrl($sSrchUrl, $about_item->order); // order
	$this->BuildSearchUrl($sSrchUrl, $about_item->active); // active
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
		global $objForm, $about_item;

		// Load search values
		// id

		$about_item->id->AdvancedSearch->SearchValue = $objForm->GetValue("x_id");
		$about_item->id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_id");

		// title
		$about_item->title->AdvancedSearch->SearchValue = $objForm->GetValue("x_title");
		$about_item->title->AdvancedSearch->SearchOperator = $objForm->GetValue("z_title");

		// title_arabic
		$about_item->title_arabic->AdvancedSearch->SearchValue = $objForm->GetValue("x_title_arabic");
		$about_item->title_arabic->AdvancedSearch->SearchOperator = $objForm->GetValue("z_title_arabic");

		// text
		$about_item->text->AdvancedSearch->SearchValue = $objForm->GetValue("x_text");
		$about_item->text->AdvancedSearch->SearchOperator = $objForm->GetValue("z_text");

		// text_arabic
		$about_item->text_arabic->AdvancedSearch->SearchValue = $objForm->GetValue("x_text_arabic");
		$about_item->text_arabic->AdvancedSearch->SearchOperator = $objForm->GetValue("z_text_arabic");

		// count
		$about_item->count->AdvancedSearch->SearchValue = $objForm->GetValue("x_count");
		$about_item->count->AdvancedSearch->SearchOperator = $objForm->GetValue("z_count");

		// order
		$about_item->order->AdvancedSearch->SearchValue = $objForm->GetValue("x_order");
		$about_item->order->AdvancedSearch->SearchOperator = $objForm->GetValue("z_order");

		// active
		$about_item->active->AdvancedSearch->SearchValue = $objForm->GetValue("x_active");
		$about_item->active->AdvancedSearch->SearchOperator = $objForm->GetValue("z_active");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $about_item;

		// Call Row_Rendering event
		$about_item->Row_Rendering();

		// Common render codes for all row types
		// id

		$about_item->id->CellCssStyle = "";
		$about_item->id->CellCssClass = "";

		// title
		$about_item->title->CellCssStyle = "";
		$about_item->title->CellCssClass = "";

		// title_arabic
		$about_item->title_arabic->CellCssStyle = "";
		$about_item->title_arabic->CellCssClass = "";

		// text
		$about_item->text->CellCssStyle = "";
		$about_item->text->CellCssClass = "";

		// text_arabic
		$about_item->text_arabic->CellCssStyle = "";
		$about_item->text_arabic->CellCssClass = "";

		// count
		$about_item->count->CellCssStyle = "";
		$about_item->count->CellCssClass = "";

		// order
		$about_item->order->CellCssStyle = "";
		$about_item->order->CellCssClass = "";

		// active
		$about_item->active->CellCssStyle = "";
		$about_item->active->CellCssClass = "";
		if ($about_item->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$about_item->id->ViewValue = $about_item->id->CurrentValue;
			$about_item->id->CssStyle = "";
			$about_item->id->CssClass = "";
			$about_item->id->ViewCustomAttributes = "";

			// title
			$about_item->title->ViewValue = $about_item->title->CurrentValue;
			$about_item->title->CssStyle = "";
			$about_item->title->CssClass = "";
			$about_item->title->ViewCustomAttributes = "";

			// title_arabic
			$about_item->title_arabic->ViewValue = $about_item->title_arabic->CurrentValue;
			$about_item->title_arabic->CssStyle = "";
			$about_item->title_arabic->CssClass = "";
			$about_item->title_arabic->ViewCustomAttributes = "";

			// text
			$about_item->text->ViewValue = $about_item->text->CurrentValue;
			$about_item->text->CssStyle = "";
			$about_item->text->CssClass = "";
			$about_item->text->ViewCustomAttributes = "";

			// text_arabic
			$about_item->text_arabic->ViewValue = $about_item->text_arabic->CurrentValue;
			$about_item->text_arabic->CssStyle = "";
			$about_item->text_arabic->CssClass = "";
			$about_item->text_arabic->ViewCustomAttributes = "";

			// count
			$about_item->count->ViewValue = $about_item->count->CurrentValue;
			$about_item->count->CssStyle = "";
			$about_item->count->CssClass = "";
			$about_item->count->ViewCustomAttributes = "";

			// order
			$about_item->order->ViewValue = $about_item->order->CurrentValue;
			$about_item->order->CssStyle = "";
			$about_item->order->CssClass = "";
			$about_item->order->ViewCustomAttributes = "";

			// active
			if (strval($about_item->active->CurrentValue) <> "") {
				switch ($about_item->active->CurrentValue) {
					case "0":
						$about_item->active->ViewValue = "No";
						break;
					case "1":
						$about_item->active->ViewValue = "Yes";
						break;
					default:
						$about_item->active->ViewValue = $about_item->active->CurrentValue;
				}
			} else {
				$about_item->active->ViewValue = NULL;
			}
			$about_item->active->CssStyle = "";
			$about_item->active->CssClass = "";
			$about_item->active->ViewCustomAttributes = "";

			// id
			$about_item->id->HrefValue = "";

			// title
			$about_item->title->HrefValue = "";

			// title_arabic
			$about_item->title_arabic->HrefValue = "";

			// text
			$about_item->text->HrefValue = "";

			// text_arabic
			$about_item->text_arabic->HrefValue = "";

			// count
			$about_item->count->HrefValue = "";

			// order
			$about_item->order->HrefValue = "";

			// active
			$about_item->active->HrefValue = "";
		} elseif ($about_item->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id
			$about_item->id->EditCustomAttributes = "";
			$about_item->id->EditValue = ew_HtmlEncode($about_item->id->AdvancedSearch->SearchValue);

			// title
			$about_item->title->EditCustomAttributes = "";
			$about_item->title->EditValue = ew_HtmlEncode($about_item->title->AdvancedSearch->SearchValue);

			// title_arabic
			$about_item->title_arabic->EditCustomAttributes = "";
			$about_item->title_arabic->EditValue = ew_HtmlEncode($about_item->title_arabic->AdvancedSearch->SearchValue);

			// text
			$about_item->text->EditCustomAttributes = "";
			$about_item->text->EditValue = ew_HtmlEncode($about_item->text->AdvancedSearch->SearchValue);

			// text_arabic
			$about_item->text_arabic->EditCustomAttributes = "";
			$about_item->text_arabic->EditValue = ew_HtmlEncode($about_item->text_arabic->AdvancedSearch->SearchValue);

			// count
			$about_item->count->EditCustomAttributes = "";
			$about_item->count->EditValue = ew_HtmlEncode($about_item->count->AdvancedSearch->SearchValue);

			// order
			$about_item->order->EditCustomAttributes = "";
			$about_item->order->EditValue = ew_HtmlEncode($about_item->order->AdvancedSearch->SearchValue);

			// active
			$about_item->active->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$about_item->active->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$about_item->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $about_item;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($about_item->id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect integer - id";
		}
		if (!ew_CheckInteger($about_item->count->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect integer - count";
		}
		if (!ew_CheckInteger($about_item->order->AdvancedSearch->SearchValue)) {
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
		global $about_item;
		$about_item->id->AdvancedSearch->SearchValue = $about_item->getAdvancedSearch("x_id");
		$about_item->title->AdvancedSearch->SearchValue = $about_item->getAdvancedSearch("x_title");
		$about_item->title_arabic->AdvancedSearch->SearchValue = $about_item->getAdvancedSearch("x_title_arabic");
		$about_item->text->AdvancedSearch->SearchValue = $about_item->getAdvancedSearch("x_text");
		$about_item->text_arabic->AdvancedSearch->SearchValue = $about_item->getAdvancedSearch("x_text_arabic");
		$about_item->count->AdvancedSearch->SearchValue = $about_item->getAdvancedSearch("x_count");
		$about_item->order->AdvancedSearch->SearchValue = $about_item->getAdvancedSearch("x_order");
		$about_item->active->AdvancedSearch->SearchValue = $about_item->getAdvancedSearch("x_active");
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
