<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
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
$products_search = new cproducts_search();
$Page =& $products_search;

// Page init processing
$products_search->Page_Init();

// Page main processing
$products_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var products_search = new ew_Page("products_search");

// page properties
products_search.PageID = "search"; // page ID
var EW_PAGE_ID = products_search.PageID; // for backward compatibility

// extend page with validate function for search
products_search.ValidateSearch = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var infix = "";
	elm = fobj.elements["x" + infix + "_id"];
	if (elm && !ew_CheckInteger(elm.value))
		return ew_OnError(this, elm, "Incorrect integer - id");
	elm = fobj.elements["x" + infix + "_level"];
	if (elm && !ew_CheckInteger(elm.value))
		return ew_OnError(this, elm, "Incorrect integer - level");
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
products_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
products_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
products_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
products_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
products_search.ShowHighlightText = "Show highlight"; 
products_search.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">Search TABLE: products<br><br>
<a href="<?php echo $products->getReturnUrl() ?>">Back to List</a></span></p>
<?php $products_search->ShowMessage() ?>
<form name="fproductssearch" id="fproductssearch" action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="products">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $products->id->RowAttributes ?>>
		<td class="ewTableHeader">id</td>
		<td<?php echo $products->id->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_id" id="z_id" value="="></span></td>
		<td<?php echo $products->id->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_id" id="x_id" value="<?php echo $products->id->EditValue ?>"<?php echo $products->id->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $products->name->RowAttributes ?>>
		<td class="ewTableHeader">name</td>
		<td<?php echo $products->name->CellAttributes() ?>><span class="ewSearchOpr">contains<input type="hidden" name="z_name" id="z_name" value="LIKE"></span></td>
		<td<?php echo $products->name->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_name" id="x_name" size="30" maxlength="200" value="<?php echo $products->name->EditValue ?>"<?php echo $products->name->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $products->name_arabic->RowAttributes ?>>
		<td class="ewTableHeader">name arabic</td>
		<td<?php echo $products->name_arabic->CellAttributes() ?>><span class="ewSearchOpr">contains<input type="hidden" name="z_name_arabic" id="z_name_arabic" value="LIKE"></span></td>
		<td<?php echo $products->name_arabic->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_name_arabic" id="x_name_arabic" size="30" maxlength="200" value="<?php echo $products->name_arabic->EditValue ?>"<?php echo $products->name_arabic->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $products->level->RowAttributes ?>>
		<td class="ewTableHeader">level</td>
		<td<?php echo $products->level->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_level" id="z_level" value="="></span></td>
		<td<?php echo $products->level->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_level" id="x_level" size="30" value="<?php echo $products->level->EditValue ?>"<?php echo $products->level->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $products->description->RowAttributes ?>>
		<td class="ewTableHeader">description</td>
		<td<?php echo $products->description->CellAttributes() ?>><span class="ewSearchOpr">contains<input type="hidden" name="z_description" id="z_description" value="LIKE"></span></td>
		<td<?php echo $products->description->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<textarea name="x_description" id="x_description" cols="40" rows="10"<?php echo $products->description->EditAttributes() ?>><?php echo $products->description->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_description", function() {
	var sBasePath = 'fckeditor/';
	var oFCKeditor = new FCKeditor('x_description', 40*_width_multiplier, 10*_height_multiplier);
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
	<tr<?php echo $products->description_arabic->RowAttributes ?>>
		<td class="ewTableHeader">description arabic</td>
		<td<?php echo $products->description_arabic->CellAttributes() ?>><span class="ewSearchOpr">contains<input type="hidden" name="z_description_arabic" id="z_description_arabic" value="LIKE"></span></td>
		<td<?php echo $products->description_arabic->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<textarea name="x_description_arabic" id="x_description_arabic" cols="40" rows="10"<?php echo $products->description_arabic->EditAttributes() ?>><?php echo $products->description_arabic->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_description_arabic", function() {
	var sBasePath = 'fckeditor/';
	var oFCKeditor = new FCKeditor('x_description_arabic', 40*_width_multiplier, 10*_height_multiplier);
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
	<tr<?php echo $products->video->RowAttributes ?>>
		<td class="ewTableHeader">video</td>
		<td<?php echo $products->video->CellAttributes() ?>><span class="ewSearchOpr">contains<input type="hidden" name="z_video" id="z_video" value="LIKE"></span></td>
		<td<?php echo $products->video->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_video" id="x_video" size="30" maxlength="150" value="<?php echo $products->video->EditValue ?>"<?php echo $products->video->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $products->special->RowAttributes ?>>
		<td class="ewTableHeader">special</td>
		<td<?php echo $products->special->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_special" id="z_special" value="="></span></td>
		<td<?php echo $products->special->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<div id="tp_x_special" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_special" id="x_special" value="{value}"<?php echo $products->special->EditAttributes() ?>></div>
<div id="dsl_x_special" repeatcolumn="5">
<?php
$arwrk = $products->special->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($products->special->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_special" id="x_special" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $products->special->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
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
	<tr<?php echo $products->order->RowAttributes ?>>
		<td class="ewTableHeader">order</td>
		<td<?php echo $products->order->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_order" id="z_order" value="="></span></td>
		<td<?php echo $products->order->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_order" id="x_order" size="30" value="<?php echo $products->order->EditValue ?>"<?php echo $products->order->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr<?php echo $products->active->RowAttributes ?>>
		<td class="ewTableHeader">active</td>
		<td<?php echo $products->active->CellAttributes() ?>><span class="ewSearchOpr">=<input type="hidden" name="z_active" id="z_active" value="="></span></td>
		<td<?php echo $products->active->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<div id="tp_x_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_active" id="x_active" value="{value}"<?php echo $products->active->EditAttributes() ?>></div>
<div id="dsl_x_active" repeatcolumn="5">
<?php
$arwrk = $products->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($products->active->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_active" id="x_active" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $products->active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
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
<input type="button" name="Action" id="Action" value="  Search  " onclick="ew_SubmitSearch(products_search, this.form);">
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
$products_search->Page_Terminate();
?>
<?php

//
// Page Class
//
class cproducts_search {

	// Page ID
	var $PageID = 'search';

	// Table Name
	var $TableName = 'products';

	// Page Object Name
	var $PageObjName = 'products_search';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $products;
		if ($products->UseTokenInUrl) $PageUrl .= "t=" . $products->TableVar . "&"; // add page token
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
		global $objForm, $products;
		if ($products->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($products->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($products->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cproducts_search() {
		global $conn;

		// Initialize table object
		$GLOBALS["products"] = new cproducts();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'products', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $products;
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
		global $objForm, $gsSearchError, $products;
		$objForm = new cFormObj();
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$products->CurrentAction = $objForm->GetValue("a_search");
			switch ($products->CurrentAction) {
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
						$sSrchStr = $products->UrlParm($sSrchStr);
						$this->Page_Terminate("productslist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$products->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $products;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $products->id); // id
	$this->BuildSearchUrl($sSrchUrl, $products->name); // name
	$this->BuildSearchUrl($sSrchUrl, $products->name_arabic); // name_arabic
	$this->BuildSearchUrl($sSrchUrl, $products->level); // level
	$this->BuildSearchUrl($sSrchUrl, $products->description); // description
	$this->BuildSearchUrl($sSrchUrl, $products->description_arabic); // description_arabic
	$this->BuildSearchUrl($sSrchUrl, $products->video); // video
	$this->BuildSearchUrl($sSrchUrl, $products->special); // special
	$this->BuildSearchUrl($sSrchUrl, $products->order); // order
	$this->BuildSearchUrl($sSrchUrl, $products->active); // active
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
		global $objForm, $products;

		// Load search values
		// id

		$products->id->AdvancedSearch->SearchValue = $objForm->GetValue("x_id");
		$products->id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_id");

		// name
		$products->name->AdvancedSearch->SearchValue = $objForm->GetValue("x_name");
		$products->name->AdvancedSearch->SearchOperator = $objForm->GetValue("z_name");

		// name_arabic
		$products->name_arabic->AdvancedSearch->SearchValue = $objForm->GetValue("x_name_arabic");
		$products->name_arabic->AdvancedSearch->SearchOperator = $objForm->GetValue("z_name_arabic");

		// level
		$products->level->AdvancedSearch->SearchValue = $objForm->GetValue("x_level");
		$products->level->AdvancedSearch->SearchOperator = $objForm->GetValue("z_level");

		// description
		$products->description->AdvancedSearch->SearchValue = $objForm->GetValue("x_description");
		$products->description->AdvancedSearch->SearchOperator = $objForm->GetValue("z_description");

		// description_arabic
		$products->description_arabic->AdvancedSearch->SearchValue = $objForm->GetValue("x_description_arabic");
		$products->description_arabic->AdvancedSearch->SearchOperator = $objForm->GetValue("z_description_arabic");

		// video
		$products->video->AdvancedSearch->SearchValue = $objForm->GetValue("x_video");
		$products->video->AdvancedSearch->SearchOperator = $objForm->GetValue("z_video");

		// special
		$products->special->AdvancedSearch->SearchValue = $objForm->GetValue("x_special");
		$products->special->AdvancedSearch->SearchOperator = $objForm->GetValue("z_special");

		// order
		$products->order->AdvancedSearch->SearchValue = $objForm->GetValue("x_order");
		$products->order->AdvancedSearch->SearchOperator = $objForm->GetValue("z_order");

		// active
		$products->active->AdvancedSearch->SearchValue = $objForm->GetValue("x_active");
		$products->active->AdvancedSearch->SearchOperator = $objForm->GetValue("z_active");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $products;

		// Call Row_Rendering event
		$products->Row_Rendering();

		// Common render codes for all row types
		// id

		$products->id->CellCssStyle = "";
		$products->id->CellCssClass = "";

		// name
		$products->name->CellCssStyle = "";
		$products->name->CellCssClass = "";

		// name_arabic
		$products->name_arabic->CellCssStyle = "";
		$products->name_arabic->CellCssClass = "";

		// level
		$products->level->CellCssStyle = "";
		$products->level->CellCssClass = "";

		// image
		$products->image->CellCssStyle = "";
		$products->image->CellCssClass = "";

		// image2
		$products->image2->CellCssStyle = "";
		$products->image2->CellCssClass = "";

		// image3
		$products->image3->CellCssStyle = "";
		$products->image3->CellCssClass = "";

		// description
		$products->description->CellCssStyle = "";
		$products->description->CellCssClass = "";

		// description_arabic
		$products->description_arabic->CellCssStyle = "";
		$products->description_arabic->CellCssClass = "";

		// video
		$products->video->CellCssStyle = "";
		$products->video->CellCssClass = "";

		// file
		$products->file->CellCssStyle = "";
		$products->file->CellCssClass = "";

		// special
		$products->special->CellCssStyle = "";
		$products->special->CellCssClass = "";

		// order
		$products->order->CellCssStyle = "";
		$products->order->CellCssClass = "";

		// active
		$products->active->CellCssStyle = "";
		$products->active->CellCssClass = "";
		if ($products->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$products->id->ViewValue = $products->id->CurrentValue;
			$products->id->CssStyle = "";
			$products->id->CssClass = "";
			$products->id->ViewCustomAttributes = "";

			// name
			$products->name->ViewValue = $products->name->CurrentValue;
			$products->name->CssStyle = "";
			$products->name->CssClass = "";
			$products->name->ViewCustomAttributes = "";

			// name_arabic
			$products->name_arabic->ViewValue = $products->name_arabic->CurrentValue;
			$products->name_arabic->CssStyle = "";
			$products->name_arabic->CssClass = "";
			$products->name_arabic->ViewCustomAttributes = "";

			// level
			$products->level->ViewValue = $products->level->CurrentValue;
			$products->level->CssStyle = "";
			$products->level->CssClass = "";
			$products->level->ViewCustomAttributes = "";

			// image
			if (!is_null($products->image->Upload->DbValue)) {
				$products->image->ViewValue = $products->image->Upload->DbValue;
				$products->image->ImageWidth = 100;
				$products->image->ImageHeight = 0;
				$products->image->ImageAlt = "";
			} else {
				$products->image->ViewValue = "";
			}
			$products->image->CssStyle = "";
			$products->image->CssClass = "";
			$products->image->ViewCustomAttributes = "";

			// image2
			if (!is_null($products->image2->Upload->DbValue)) {
				$products->image2->ViewValue = $products->image2->Upload->DbValue;
				$products->image2->ImageWidth = 100;
				$products->image2->ImageHeight = 0;
				$products->image2->ImageAlt = "";
			} else {
				$products->image2->ViewValue = "";
			}
			$products->image2->CssStyle = "";
			$products->image2->CssClass = "";
			$products->image2->ViewCustomAttributes = "";

			// image3
			if (!is_null($products->image3->Upload->DbValue)) {
				$products->image3->ViewValue = $products->image3->Upload->DbValue;
				$products->image3->ImageWidth = 100;
				$products->image3->ImageHeight = 0;
				$products->image3->ImageAlt = "";
			} else {
				$products->image3->ViewValue = "";
			}
			$products->image3->CssStyle = "";
			$products->image3->CssClass = "";
			$products->image3->ViewCustomAttributes = "";

			// description
			$products->description->ViewValue = $products->description->CurrentValue;
			$products->description->CssStyle = "";
			$products->description->CssClass = "";
			$products->description->ViewCustomAttributes = "";

			// description_arabic
			$products->description_arabic->ViewValue = $products->description_arabic->CurrentValue;
			$products->description_arabic->CssStyle = "";
			$products->description_arabic->CssClass = "";
			$products->description_arabic->ViewCustomAttributes = "";

			// video
			$products->video->ViewValue = $products->video->CurrentValue;
			$products->video->CssStyle = "";
			$products->video->CssClass = "";
			$products->video->ViewCustomAttributes = "";

			// file
			if (!is_null($products->file->Upload->DbValue)) {
				$products->file->ViewValue = $products->file->Upload->DbValue;
			} else {
				$products->file->ViewValue = "";
			}
			$products->file->CssStyle = "";
			$products->file->CssClass = "";
			$products->file->ViewCustomAttributes = "";

			// special
			if (strval($products->special->CurrentValue) <> "") {
				switch ($products->special->CurrentValue) {
					case "0":
						$products->special->ViewValue = "No";
						break;
					case "1":
						$products->special->ViewValue = "Yes";
						break;
					default:
						$products->special->ViewValue = $products->special->CurrentValue;
				}
			} else {
				$products->special->ViewValue = NULL;
			}
			$products->special->CssStyle = "";
			$products->special->CssClass = "";
			$products->special->ViewCustomAttributes = "";

			// order
			$products->order->ViewValue = $products->order->CurrentValue;
			$products->order->CssStyle = "";
			$products->order->CssClass = "";
			$products->order->ViewCustomAttributes = "";

			// active
			if (strval($products->active->CurrentValue) <> "") {
				switch ($products->active->CurrentValue) {
					case "0":
						$products->active->ViewValue = "No";
						break;
					case "1":
						$products->active->ViewValue = "Yes";
						break;
					default:
						$products->active->ViewValue = $products->active->CurrentValue;
				}
			} else {
				$products->active->ViewValue = NULL;
			}
			$products->active->CssStyle = "";
			$products->active->CssClass = "";
			$products->active->ViewCustomAttributes = "";

			// id
			$products->id->HrefValue = "";

			// name
			$products->name->HrefValue = "";

			// name_arabic
			$products->name_arabic->HrefValue = "";

			// level
			$products->level->HrefValue = "";

			// image
			$products->image->HrefValue = "";

			// image2
			$products->image2->HrefValue = "";

			// image3
			$products->image3->HrefValue = "";

			// description
			$products->description->HrefValue = "";

			// description_arabic
			$products->description_arabic->HrefValue = "";

			// video
			$products->video->HrefValue = "";

			// file
			if (!is_null($products->file->Upload->DbValue)) {
				$products->file->HrefValue = ew_UploadPathEx(FALSE, "../images/") . ((!empty($products->file->ViewValue)) ? $products->file->ViewValue : $products->file->CurrentValue);
				if ($products->Export <> "") $products->file->HrefValue = ew_ConvertFullUrl($products->file->HrefValue);
			} else {
				$products->file->HrefValue = "";
			}

			// special
			$products->special->HrefValue = "";

			// order
			$products->order->HrefValue = "";

			// active
			$products->active->HrefValue = "";
		} elseif ($products->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id
			$products->id->EditCustomAttributes = "";
			$products->id->EditValue = ew_HtmlEncode($products->id->AdvancedSearch->SearchValue);

			// name
			$products->name->EditCustomAttributes = "";
			$products->name->EditValue = ew_HtmlEncode($products->name->AdvancedSearch->SearchValue);

			// name_arabic
			$products->name_arabic->EditCustomAttributes = "";
			$products->name_arabic->EditValue = ew_HtmlEncode($products->name_arabic->AdvancedSearch->SearchValue);

			// level
			$products->level->EditCustomAttributes = "";
			$products->level->EditValue = ew_HtmlEncode($products->level->AdvancedSearch->SearchValue);

			// image
			$products->image->EditCustomAttributes = "";
			if (!is_null($products->image->Upload->DbValue)) {
				$products->image->EditValue = $products->image->Upload->DbValue;
				$products->image->ImageWidth = 100;
				$products->image->ImageHeight = 0;
				$products->image->ImageAlt = "";
			} else {
				$products->image->EditValue = "";
			}

			// image2
			$products->image2->EditCustomAttributes = "";
			if (!is_null($products->image2->Upload->DbValue)) {
				$products->image2->EditValue = $products->image2->Upload->DbValue;
				$products->image2->ImageWidth = 100;
				$products->image2->ImageHeight = 0;
				$products->image2->ImageAlt = "";
			} else {
				$products->image2->EditValue = "";
			}

			// image3
			$products->image3->EditCustomAttributes = "";
			if (!is_null($products->image3->Upload->DbValue)) {
				$products->image3->EditValue = $products->image3->Upload->DbValue;
				$products->image3->ImageWidth = 100;
				$products->image3->ImageHeight = 0;
				$products->image3->ImageAlt = "";
			} else {
				$products->image3->EditValue = "";
			}

			// description
			$products->description->EditCustomAttributes = "";
			$products->description->EditValue = ew_HtmlEncode($products->description->AdvancedSearch->SearchValue);

			// description_arabic
			$products->description_arabic->EditCustomAttributes = "";
			$products->description_arabic->EditValue = ew_HtmlEncode($products->description_arabic->AdvancedSearch->SearchValue);

			// video
			$products->video->EditCustomAttributes = "";
			$products->video->EditValue = ew_HtmlEncode($products->video->AdvancedSearch->SearchValue);

			// file
			$products->file->EditCustomAttributes = "";
			if (!is_null($products->file->Upload->DbValue)) {
				$products->file->EditValue = $products->file->Upload->DbValue;
			} else {
				$products->file->EditValue = "";
			}

			// special
			$products->special->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$products->special->EditValue = $arwrk;

			// order
			$products->order->EditCustomAttributes = "";
			$products->order->EditValue = ew_HtmlEncode($products->order->AdvancedSearch->SearchValue);

			// active
			$products->active->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$products->active->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$products->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $products;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($products->id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect integer - id";
		}
		if (!ew_CheckInteger($products->level->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect integer - level";
		}
		if (!ew_CheckInteger($products->order->AdvancedSearch->SearchValue)) {
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
		global $products;
		$products->id->AdvancedSearch->SearchValue = $products->getAdvancedSearch("x_id");
		$products->name->AdvancedSearch->SearchValue = $products->getAdvancedSearch("x_name");
		$products->name_arabic->AdvancedSearch->SearchValue = $products->getAdvancedSearch("x_name_arabic");
		$products->level->AdvancedSearch->SearchValue = $products->getAdvancedSearch("x_level");
		$products->description->AdvancedSearch->SearchValue = $products->getAdvancedSearch("x_description");
		$products->description_arabic->AdvancedSearch->SearchValue = $products->getAdvancedSearch("x_description_arabic");
		$products->video->AdvancedSearch->SearchValue = $products->getAdvancedSearch("x_video");
		$products->special->AdvancedSearch->SearchValue = $products->getAdvancedSearch("x_special");
		$products->order->AdvancedSearch->SearchValue = $products->getAdvancedSearch("x_order");
		$products->active->AdvancedSearch->SearchValue = $products->getAdvancedSearch("x_active");
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
