<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "galleryinfo.php" ?>
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
$gallery_update = new cgallery_update();
$Page =& $gallery_update;

// Page init processing
$gallery_update->Page_Init();

// Page main processing
$gallery_update->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var gallery_update = new ew_Page("gallery_update");

// page properties
gallery_update.PageID = "update"; // page ID
var EW_PAGE_ID = gallery_update.PageID; // for backward compatibility

// extend page with ValidateForm function
gallery_update.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	if (!ew_UpdateSelected(fobj)) {
		alert('No field selected for update');
		return false;
	}
	var uelm;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_name"];
		uelm = fobj.elements["u" + infix + "_name"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - name");
		}
		elm = fobj.elements["x" + infix + "_name_arabic"];
		uelm = fobj.elements["u" + infix + "_name_arabic"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - name arabic");
		}
		elm = fobj.elements["x" + infix + "_image"];
		uelm = fobj.elements["u" + infix + "_image"];
		aelm = fobj.elements["a" + infix + "_image"];
		var chk_image = (aelm && aelm[0])?(aelm[2].checked):true;
		if (uelm && uelm.checked) {
			if (elm && chk_image && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - image");
		}
		elm = fobj.elements["x" + infix + "_image"];
		uelm = fobj.elements["u" + infix + "_image"];
		if (uelm && uelm.checked) {
			if (elm && !ew_CheckFileType(elm.value))
				return ew_OnError(this, elm, "File type is not allowed.");
		}
		elm = fobj.elements["x" + infix + "_category"];
		uelm = fobj.elements["u" + infix + "_category"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - category");
		}
		elm = fobj.elements["x" + infix + "_link"];
		uelm = fobj.elements["u" + infix + "_link"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - link");
		}
		elm = fobj.elements["x" + infix + "_special"];
		uelm = fobj.elements["u" + infix + "_special"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - special");
		}
		elm = fobj.elements["x" + infix + "_order"];
		uelm = fobj.elements["u" + infix + "_order"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - order");
		}
		elm = fobj.elements["x" + infix + "_order"];
		uelm = fobj.elements["u" + infix + "_order"];
		if (uelm && uelm.checked) {
			if (elm && !ew_CheckInteger(elm.value))
				return ew_OnError(this, elm, "Incorrect integer - order");
		}
		elm = fobj.elements["x" + infix + "_active"];
		uelm = fobj.elements["u" + infix + "_active"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - active");
		}

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
gallery_update.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
gallery_update.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
gallery_update.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
gallery_update.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
gallery_update.ShowHighlightText = "Show highlight"; 
gallery_update.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">Update TABLE: gallery<br><br>
<a href="<?php echo $gallery->getReturnUrl() ?>">Back to List</a></span></p>
<?php $gallery_update->ShowMessage() ?>
<form name="fgalleryupdate" id="fgalleryupdate" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return gallery_update.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="gallery">
<input type="hidden" name="a_update" id="a_update" value="U">
<?php for ($i = 0; $i < $gallery_update->nKeySelected; $i++) { ?>
<input type="hidden" name="k<?php echo $i+1 ?>_key" id="key<?php echo $i+1 ?>" value="<?php echo ew_HtmlEncode($gallery_update->arRecKeys[$i]) ?>">
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr class="ewTableHeader">
		<td>Update<input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"></td>
		<td>Field Name</td>
		<td>New Value</td>
	</tr>
<?php if ($gallery->name->Visible) { // name ?>
	<tr<?php echo $gallery->name->RowAttributes ?>>
		<td<?php echo $gallery->name->CellAttributes() ?>>
<input type="checkbox" name="u_name" id="u_name" value="1"<?php echo ($gallery->name->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $gallery->name->CellAttributes() ?>>name</td>
		<td<?php echo $gallery->name->CellAttributes() ?>><span id="el_name">
<input type="text" name="x_name" id="x_name" size="30" maxlength="250" value="<?php echo $gallery->name->EditValue ?>"<?php echo $gallery->name->EditAttributes() ?>>
</span><?php echo $gallery->name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($gallery->name_arabic->Visible) { // name_arabic ?>
	<tr<?php echo $gallery->name_arabic->RowAttributes ?>>
		<td<?php echo $gallery->name_arabic->CellAttributes() ?>>
<input type="checkbox" name="u_name_arabic" id="u_name_arabic" value="1"<?php echo ($gallery->name_arabic->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $gallery->name_arabic->CellAttributes() ?>>name arabic</td>
		<td<?php echo $gallery->name_arabic->CellAttributes() ?>><span id="el_name_arabic">
<input type="text" name="x_name_arabic" id="x_name_arabic" size="30" maxlength="250" value="<?php echo $gallery->name_arabic->EditValue ?>"<?php echo $gallery->name_arabic->EditAttributes() ?>>
</span><?php echo $gallery->name_arabic->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($gallery->image->Visible) { // image ?>
	<tr<?php echo $gallery->image->RowAttributes ?>>
		<td<?php echo $gallery->image->CellAttributes() ?>>
<input type="checkbox" name="u_image" id="u_image" value="1"<?php echo ($gallery->image->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $gallery->image->CellAttributes() ?>>image</td>
		<td<?php echo $gallery->image->CellAttributes() ?>><span id="el_image">
<div id="old_x_image">
<?php if ($gallery->image->HrefValue <> "") { ?>
<?php if (!is_null($gallery->image->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $gallery->image->Upload->DbValue ?>" border=0<?php echo $gallery->image->ViewAttributes() ?>>
<?php } elseif (!in_array($gallery->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($gallery->image->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $gallery->image->Upload->DbValue ?>" border=0<?php echo $gallery->image->ViewAttributes() ?>>
<?php } elseif (!in_array($gallery->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_image">
<?php if (!is_null($gallery->image->Upload->DbValue)) { ?>
<input type="radio" name="a_image" id="a_image" value="1" checked="checked">Keep&nbsp;
<input type="radio" name="a_image" id="a_image" value="2" disabled="disabled">Remove&nbsp;
<input type="radio" name="a_image" id="a_image" value="3">Replace<br>
<?php } else { ?>
<input type="hidden" name="a_image" id="a_image" value="3">
<?php } ?>
<input type="file" name="x_image" id="x_image" size="30" onchange="if (this.form.a_image[2]) this.form.a_image[2].checked=true;"<?php echo $gallery->image->EditAttributes() ?>>
</div>
</span><?php echo $gallery->image->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($gallery->category->Visible) { // category ?>
	<tr<?php echo $gallery->category->RowAttributes ?>>
		<td<?php echo $gallery->category->CellAttributes() ?>>
<input type="checkbox" name="u_category" id="u_category" value="1"<?php echo ($gallery->category->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $gallery->category->CellAttributes() ?>>category</td>
		<td<?php echo $gallery->category->CellAttributes() ?>><span id="el_category">
<?php if ($gallery->category->getSessionValue() <> "") { ?>
<div<?php echo $gallery->category->ViewAttributes() ?>><?php echo $gallery->category->ViewValue ?></div>
<input type="hidden" id="x_category" name="x_category" value="<?php echo ew_HtmlEncode($gallery->category->CurrentValue) ?>">
<?php } else { ?>
<select id="x_category" name="x_category"<?php echo $gallery->category->EditAttributes() ?>>
<?php
if (is_array($gallery->category->EditValue)) {
	$arwrk = $gallery->category->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($gallery->category->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $gallery->category->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($gallery->link->Visible) { // link ?>
	<tr<?php echo $gallery->link->RowAttributes ?>>
		<td<?php echo $gallery->link->CellAttributes() ?>>
<input type="checkbox" name="u_link" id="u_link" value="1"<?php echo ($gallery->link->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $gallery->link->CellAttributes() ?>>link</td>
		<td<?php echo $gallery->link->CellAttributes() ?>><span id="el_link">
<input type="text" name="x_link" id="x_link" size="30" maxlength="250" value="<?php echo $gallery->link->EditValue ?>"<?php echo $gallery->link->EditAttributes() ?>>
</span><?php echo $gallery->link->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($gallery->special->Visible) { // special ?>
	<tr<?php echo $gallery->special->RowAttributes ?>>
		<td<?php echo $gallery->special->CellAttributes() ?>>
<input type="checkbox" name="u_special" id="u_special" value="1"<?php echo ($gallery->special->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $gallery->special->CellAttributes() ?>>special</td>
		<td<?php echo $gallery->special->CellAttributes() ?>><span id="el_special">
<div id="tp_x_special" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_special" id="x_special" value="{value}"<?php echo $gallery->special->EditAttributes() ?>></div>
<div id="dsl_x_special" repeatcolumn="5">
<?php
$arwrk = $gallery->special->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($gallery->special->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_special" id="x_special" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $gallery->special->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $gallery->special->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($gallery->order->Visible) { // order ?>
	<tr<?php echo $gallery->order->RowAttributes ?>>
		<td<?php echo $gallery->order->CellAttributes() ?>>
<input type="checkbox" name="u_order" id="u_order" value="1"<?php echo ($gallery->order->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $gallery->order->CellAttributes() ?>>order</td>
		<td<?php echo $gallery->order->CellAttributes() ?>><span id="el_order">
<input type="text" name="x_order" id="x_order" size="30" value="<?php echo $gallery->order->EditValue ?>"<?php echo $gallery->order->EditAttributes() ?>>
</span><?php echo $gallery->order->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($gallery->active->Visible) { // active ?>
	<tr<?php echo $gallery->active->RowAttributes ?>>
		<td<?php echo $gallery->active->CellAttributes() ?>>
<input type="checkbox" name="u_active" id="u_active" value="1"<?php echo ($gallery->active->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $gallery->active->CellAttributes() ?>>active</td>
		<td<?php echo $gallery->active->CellAttributes() ?>><span id="el_active">
<div id="tp_x_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_active" id="x_active" value="{value}"<?php echo $gallery->active->EditAttributes() ?>></div>
<div id="dsl_x_active" repeatcolumn="5">
<?php
$arwrk = $gallery->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($gallery->active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_active" id="x_active" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $gallery->active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $gallery->active->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="  Update  ">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$gallery_update->Page_Terminate();
?>
<?php

//
// Page Class
//
class cgallery_update {

	// Page ID
	var $PageID = 'update';

	// Table Name
	var $TableName = 'gallery';

	// Page Object Name
	var $PageObjName = 'gallery_update';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $gallery;
		if ($gallery->UseTokenInUrl) $PageUrl .= "t=" . $gallery->TableVar . "&"; // add page token
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
		global $objForm, $gallery;
		if ($gallery->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($gallery->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($gallery->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cgallery_update() {
		global $conn;

		// Initialize table object
		$GLOBALS["gallery"] = new cgallery();

		// Initialize other table object
		$GLOBALS['categories'] = new ccategories();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'update', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'gallery', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $gallery;
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
	var $nKeySelected;
	var $arRecKeys;
	var $sDisabled;

	//
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsFormError, $gallery;

		// Try to load keys from list form
		$this->nKeySelected = 0;
		if (ew_IsHttpPost()) {
			if (isset($_POST["key_m"])) { // Key count > 0
				$this->nKeySelected = count($_POST["key_m"]); // Get number of keys
				$this->arRecKeys = ew_StripSlashes($_POST["key_m"]);
				$this->LoadMultiUpdateValues(); // Load initial values to form
			}
		}

		// Try to load key from update form
		if ($this->nKeySelected == 0) {
			$this->arRecKeys = array();

			// Create form object
			$objForm = new cFormObj();
			if (@$_POST["a_update"] <> "") {

				// Get action
				$gallery->CurrentAction = $_POST["a_update"];

				// Get record keys
				$sKey = @$_POST["k" . strval($this->nKeySelected+1) . "_key"];
				while ($sKey <> "") {
					$this->arRecKeys[$this->nKeySelected] = ew_StripSlashes($sKey);
					$this->nKeySelected++;
					$sKey = @$_POST["k" . strval($this->nKeySelected+1) . "_key"];
				}
				$this->GetUploadFiles(); // Get upload files
				$this->LoadFormValues(); // Get form values

				// Validate Form
				if (!$this->ValidateForm()) {
					$gallery->CurrentAction = "I"; // Form error, reset action
					$this->setMessage($gsFormError);
				}
			}
		}
		if ($this->nKeySelected <= 0)
			$this->Page_Terminate("gallerylist.php"); // No records selected, return to list
		switch ($gallery->CurrentAction) {
			case "U": // Update
				if ($this->UpdateRows()) { // Update Records based on key
					$this->setMessage("Update succeeded"); // Set update success message
					$this->Page_Terminate($gallery->getReturnUrl()); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values
				}
		}

		// Render row
		$gallery->RowType = EW_ROWTYPE_EDIT; // Render edit
		$this->RenderRow();
	}

	// Load initial values to form if field values are identical in all selected records
	function LoadMultiUpdateValues() {
		global $gallery;
		$gallery->CurrentFilter = $this->BuildKeyFilter();

		// Load recordset
		$rs = $this->LoadRecordset();
		$i = 1;
		while (!$rs->EOF) {
			if ($i == 1) {
				$gallery->name->setDbValue($rs->fields('name'));
				$gallery->name_arabic->setDbValue($rs->fields('name_arabic'));
				$gallery->category->setDbValue($rs->fields('category'));
				$gallery->link->setDbValue($rs->fields('link'));
				$gallery->special->setDbValue($rs->fields('special'));
				$gallery->order->setDbValue($rs->fields('order'));
				$gallery->active->setDbValue($rs->fields('active'));
			} else {
				if (!ew_CompareValue($gallery->name->DbValue, $rs->fields('name')))
					$gallery->name->CurrentValue = NULL;
				if (!ew_CompareValue($gallery->name_arabic->DbValue, $rs->fields('name_arabic')))
					$gallery->name_arabic->CurrentValue = NULL;
				if (!ew_CompareValue($gallery->category->DbValue, $rs->fields('category')))
					$gallery->category->CurrentValue = NULL;
				if (!ew_CompareValue($gallery->link->DbValue, $rs->fields('link')))
					$gallery->link->CurrentValue = NULL;
				if (!ew_CompareValue($gallery->special->DbValue, $rs->fields('special')))
					$gallery->special->CurrentValue = NULL;
				if (!ew_CompareValue($gallery->order->DbValue, $rs->fields('order')))
					$gallery->order->CurrentValue = NULL;
				if (!ew_CompareValue($gallery->active->DbValue, $rs->fields('active')))
					$gallery->active->CurrentValue = NULL;
			}
			$i++;
			$rs->MoveNext();
		}
		$rs->Close();
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $gallery;
		$sWrkFilter = "";
		foreach ($this->arRecKeys as $sKey) {
			$sKey = trim($sKey);
			if ($this->SetupKeyValues($sKey)) {
				$sFilter = $gallery->KeyFilter();
				if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
				$sWrkFilter .= $sFilter;
			} else {
				$sWrkFilter = "0=1";
				break;
			}
		}
		return $sWrkFilter;
	}

	// Set up key value
	function SetupKeyValues($key) {
		global $gallery;
		$sKeyFld = $key;
		if (!is_numeric($sKeyFld))
			return FALSE;
		$gallery->id->CurrentValue = $sKeyFld;
		return TRUE;
	}

	// Update all selected rows
	function UpdateRows() {
		global $conn, $gallery;
		$conn->BeginTrans();

		// Get old recordset
		$gallery->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $gallery->SQL();
		$rsold = $conn->Execute($sSql);

		// Update all rows
		$sKey = "";
		foreach ($this->arRecKeys as $sThisKey) {
			$sThisKey = trim($sThisKey);
			if ($this->SetupKeyValues($sThisKey)) {
				$gallery->SendEmail = FALSE; // Do not send email on update success
				$UpdateRows = $this->EditRow(); // Update this row
			} else {
				$UpdateRows = FALSE;
			}
			if (!$UpdateRows)
				return; // Update failed
			if ($sKey <> "") $sKey .= ", ";
			$sKey .= $sThisKey;
		}

		// Field image
		$gallery->image->Upload->RemoveFromSession(); // Remove file value from Session

		// Check if all rows updated
		if ($UpdateRows) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			$rsnew = $conn->Execute($sSql);
		} else {
			$conn->RollbackTrans(); // Rollback transaction
		}
		return $UpdateRows;
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $gallery;

		// Get upload data
			$gallery->image->Upload->Index = $objForm->Index;
			if ($gallery->image->Upload->UploadFile()) {

				// No action required
			} else {
				echo $gallery->image->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
		$gallery->image->MultiUpdate = $objForm->GetValue("u_image");
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $gallery;
		$gallery->name->setFormValue($objForm->GetValue("x_name"));
		$gallery->name->MultiUpdate = $objForm->GetValue("u_name");
		$gallery->name_arabic->setFormValue($objForm->GetValue("x_name_arabic"));
		$gallery->name_arabic->MultiUpdate = $objForm->GetValue("u_name_arabic");
		$gallery->category->setFormValue($objForm->GetValue("x_category"));
		$gallery->category->MultiUpdate = $objForm->GetValue("u_category");
		$gallery->link->setFormValue($objForm->GetValue("x_link"));
		$gallery->link->MultiUpdate = $objForm->GetValue("u_link");
		$gallery->special->setFormValue($objForm->GetValue("x_special"));
		$gallery->special->MultiUpdate = $objForm->GetValue("u_special");
		$gallery->order->setFormValue($objForm->GetValue("x_order"));
		$gallery->order->MultiUpdate = $objForm->GetValue("u_order");
		$gallery->active->setFormValue($objForm->GetValue("x_active"));
		$gallery->active->MultiUpdate = $objForm->GetValue("u_active");
		$gallery->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $gallery;
		$gallery->id->CurrentValue = $gallery->id->FormValue;
		$gallery->name->CurrentValue = $gallery->name->FormValue;
		$gallery->name_arabic->CurrentValue = $gallery->name_arabic->FormValue;
		$gallery->category->CurrentValue = $gallery->category->FormValue;
		$gallery->link->CurrentValue = $gallery->link->FormValue;
		$gallery->special->CurrentValue = $gallery->special->FormValue;
		$gallery->order->CurrentValue = $gallery->order->FormValue;
		$gallery->active->CurrentValue = $gallery->active->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $gallery;

		// Call Recordset Selecting event
		$gallery->Recordset_Selecting($gallery->CurrentFilter);

		// Load list page SQL
		$sSql = $gallery->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$gallery->Recordset_Selected($rs);
		return $rs;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $gallery;

		// Call Row_Rendering event
		$gallery->Row_Rendering();

		// Common render codes for all row types
		// name

		$gallery->name->CellCssStyle = "";
		$gallery->name->CellCssClass = "";

		// name_arabic
		$gallery->name_arabic->CellCssStyle = "";
		$gallery->name_arabic->CellCssClass = "";

		// image
		$gallery->image->CellCssStyle = "";
		$gallery->image->CellCssClass = "";

		// category
		$gallery->category->CellCssStyle = "";
		$gallery->category->CellCssClass = "";

		// link
		$gallery->link->CellCssStyle = "";
		$gallery->link->CellCssClass = "";

		// special
		$gallery->special->CellCssStyle = "";
		$gallery->special->CellCssClass = "";

		// order
		$gallery->order->CellCssStyle = "";
		$gallery->order->CellCssClass = "";

		// active
		$gallery->active->CellCssStyle = "";
		$gallery->active->CellCssClass = "";
		if ($gallery->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$gallery->id->ViewValue = $gallery->id->CurrentValue;
			$gallery->id->CssStyle = "";
			$gallery->id->CssClass = "";
			$gallery->id->ViewCustomAttributes = "";

			// name
			$gallery->name->ViewValue = $gallery->name->CurrentValue;
			$gallery->name->CssStyle = "";
			$gallery->name->CssClass = "";
			$gallery->name->ViewCustomAttributes = "";

			// name_arabic
			$gallery->name_arabic->ViewValue = $gallery->name_arabic->CurrentValue;
			$gallery->name_arabic->CssStyle = "";
			$gallery->name_arabic->CssClass = "";
			$gallery->name_arabic->ViewCustomAttributes = "";

			// image
			if (!is_null($gallery->image->Upload->DbValue)) {
				$gallery->image->ViewValue = $gallery->image->Upload->DbValue;
				$gallery->image->ImageWidth = 100;
				$gallery->image->ImageHeight = 0;
				$gallery->image->ImageAlt = "";
			} else {
				$gallery->image->ViewValue = "";
			}
			$gallery->image->CssStyle = "";
			$gallery->image->CssClass = "";
			$gallery->image->ViewCustomAttributes = "";

			// category
			if (strval($gallery->category->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `name`, `name_arabic` FROM `categories` WHERE `id` = " . ew_AdjustSql($gallery->category->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$gallery->category->ViewValue = $rswrk->fields('name');
					$gallery->category->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('name_arabic');
					$rswrk->Close();
				} else {
					$gallery->category->ViewValue = $gallery->category->CurrentValue;
				}
			} else {
				$gallery->category->ViewValue = NULL;
			}
			$gallery->category->CssStyle = "";
			$gallery->category->CssClass = "";
			$gallery->category->ViewCustomAttributes = "";

			// link
			$gallery->link->ViewValue = $gallery->link->CurrentValue;
			$gallery->link->CssStyle = "";
			$gallery->link->CssClass = "";
			$gallery->link->ViewCustomAttributes = "";

			// special
			if (strval($gallery->special->CurrentValue) <> "") {
				switch ($gallery->special->CurrentValue) {
					case "0":
						$gallery->special->ViewValue = "No";
						break;
					case "1":
						$gallery->special->ViewValue = "Yes";
						break;
					default:
						$gallery->special->ViewValue = $gallery->special->CurrentValue;
				}
			} else {
				$gallery->special->ViewValue = NULL;
			}
			$gallery->special->CssStyle = "";
			$gallery->special->CssClass = "";
			$gallery->special->ViewCustomAttributes = "";

			// order
			$gallery->order->ViewValue = $gallery->order->CurrentValue;
			$gallery->order->CssStyle = "";
			$gallery->order->CssClass = "";
			$gallery->order->ViewCustomAttributes = "";

			// active
			if (strval($gallery->active->CurrentValue) <> "") {
				switch ($gallery->active->CurrentValue) {
					case "0":
						$gallery->active->ViewValue = "No";
						break;
					case "1":
						$gallery->active->ViewValue = "Yes";
						break;
					default:
						$gallery->active->ViewValue = $gallery->active->CurrentValue;
				}
			} else {
				$gallery->active->ViewValue = NULL;
			}
			$gallery->active->CssStyle = "";
			$gallery->active->CssClass = "";
			$gallery->active->ViewCustomAttributes = "";

			// name
			$gallery->name->HrefValue = "";

			// name_arabic
			$gallery->name_arabic->HrefValue = "";

			// image
			$gallery->image->HrefValue = "";

			// category
			$gallery->category->HrefValue = "";

			// link
			$gallery->link->HrefValue = "";

			// special
			$gallery->special->HrefValue = "";

			// order
			$gallery->order->HrefValue = "";

			// active
			$gallery->active->HrefValue = "";
		} elseif ($gallery->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// name
			$gallery->name->EditCustomAttributes = "";
			$gallery->name->EditValue = ew_HtmlEncode($gallery->name->CurrentValue);

			// name_arabic
			$gallery->name_arabic->EditCustomAttributes = "";
			$gallery->name_arabic->EditValue = ew_HtmlEncode($gallery->name_arabic->CurrentValue);

			// image
			$gallery->image->EditCustomAttributes = "";
			if (!is_null($gallery->image->Upload->DbValue)) {
				$gallery->image->EditValue = $gallery->image->Upload->DbValue;
				$gallery->image->ImageWidth = 100;
				$gallery->image->ImageHeight = 0;
				$gallery->image->ImageAlt = "";
			} else {
				$gallery->image->EditValue = "";
			}

			// category
			$gallery->category->EditCustomAttributes = "";
			if ($gallery->category->getSessionValue() <> "") {
				$gallery->category->CurrentValue = $gallery->category->getSessionValue();
			if (strval($gallery->category->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `name`, `name_arabic` FROM `categories` WHERE `id` = " . ew_AdjustSql($gallery->category->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$gallery->category->ViewValue = $rswrk->fields('name');
					$gallery->category->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('name_arabic');
					$rswrk->Close();
				} else {
					$gallery->category->ViewValue = $gallery->category->CurrentValue;
				}
			} else {
				$gallery->category->ViewValue = NULL;
			}
			$gallery->category->CssStyle = "";
			$gallery->category->CssClass = "";
			$gallery->category->ViewCustomAttributes = "";
			} else {
			$sSqlWrk = "SELECT `id`, `name`, `name_arabic`, '' AS SelectFilterFld FROM `categories`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select", ""));
			$gallery->category->EditValue = $arwrk;
			}

			// link
			$gallery->link->EditCustomAttributes = "";
			$gallery->link->EditValue = ew_HtmlEncode($gallery->link->CurrentValue);

			// special
			$gallery->special->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$gallery->special->EditValue = $arwrk;

			// order
			$gallery->order->EditCustomAttributes = "";
			$gallery->order->EditValue = ew_HtmlEncode($gallery->order->CurrentValue);

			// active
			$gallery->active->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$gallery->active->EditValue = $arwrk;

			// Edit refer script
			// name

			$gallery->name->HrefValue = "";

			// name_arabic
			$gallery->name_arabic->HrefValue = "";

			// image
			$gallery->image->HrefValue = "";

			// category
			$gallery->category->HrefValue = "";

			// link
			$gallery->link->HrefValue = "";

			// special
			$gallery->special->HrefValue = "";

			// order
			$gallery->order->HrefValue = "";

			// active
			$gallery->active->HrefValue = "";
		}

		// Call Row Rendered event
		$gallery->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $gallery;

		// Initialize
		$gsFormError = "";
		$lUpdateCnt = 0;
		if ($gallery->name->MultiUpdate == "1") $lUpdateCnt++;
		if ($gallery->name_arabic->MultiUpdate == "1") $lUpdateCnt++;
		if ($gallery->image->MultiUpdate == "1") $lUpdateCnt++;
		if ($gallery->category->MultiUpdate == "1") $lUpdateCnt++;
		if ($gallery->link->MultiUpdate == "1") $lUpdateCnt++;
		if ($gallery->special->MultiUpdate == "1") $lUpdateCnt++;
		if ($gallery->order->MultiUpdate == "1") $lUpdateCnt++;
		if ($gallery->active->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = "No field selected for update";
			return FALSE;
		}
		if ($gallery->image->MultiUpdate <> "") {
			if (!ew_CheckFileType($gallery->image->Upload->FileName)) {
				$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
				$gsFormError .= "File type is not allowed.";
			}
			if ($gallery->image->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
				if ($gallery->image->Upload->FileSize > EW_MAX_FILE_SIZE)
					$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "Max. file size (%s bytes) exceeded.");
			}
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($gallery->name->MultiUpdate <> "" && $gallery->name->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - name";
		}
		if ($gallery->name_arabic->MultiUpdate <> "" && $gallery->name_arabic->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - name arabic";
		}
		if ($gallery->image->MultiUpdate <> "" && is_null($gallery->image->Upload->Value)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - image";
		}
		if ($gallery->category->MultiUpdate <> "" && $gallery->category->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - category";
		}
		if ($gallery->link->MultiUpdate <> "" && $gallery->link->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - link";
		}
		if ($gallery->special->MultiUpdate <> "" && $gallery->special->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - special";
		}
		if ($gallery->order->MultiUpdate <> "" && $gallery->order->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - order";
		}
		if ($gallery->order->MultiUpdate <> "") {
			if (!ew_CheckInteger($gallery->order->FormValue)) {
				if ($gsFormError <> "") $gsFormError .= "<br>";
				$gsFormError .= "Incorrect integer - order";
			}
		}
		if ($gallery->active->MultiUpdate <> "" && $gallery->active->FormValue == "") {
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

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $gallery;
		$sFilter = $gallery->KeyFilter();
		$gallery->CurrentFilter = $sFilter;
		$sSql = $gallery->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// Field name
						if ($gallery->name->MultiUpdate == "1") {
			$gallery->name->SetDbValueDef($gallery->name->CurrentValue, "");
			$rsnew['name'] =& $gallery->name->DbValue;
			}

			// Field name_arabic
						if ($gallery->name_arabic->MultiUpdate == "1") {
			$gallery->name_arabic->SetDbValueDef($gallery->name_arabic->CurrentValue, "");
			$rsnew['name_arabic'] =& $gallery->name_arabic->DbValue;
			}

			// Field image
			$gallery->image->Upload->SaveToSession(); // Save file value to Session
						if ($gallery->image->MultiUpdate == "1") {
if ($gallery->image->Upload->Action == "2" || $gallery->image->Upload->Action == "3") { // Update/Remove
			$gallery->image->Upload->DbValue = $rs->fields('image'); // Get original value
			if (is_null($gallery->image->Upload->Value)) {
				$rsnew['image'] = NULL;
			} else {
				if ($gallery->image->Upload->FileName == $gallery->image->Upload->DbValue) { // Upload file name same as old file name
					$rsnew['image'] = $gallery->image->Upload->FileName;
				} else {
					$rsnew['image'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, "../images/"), $gallery->image->Upload->FileName);
				}
			}
			}
}

			// Field category
						if ($gallery->category->MultiUpdate == "1") {
			$gallery->category->SetDbValueDef($gallery->category->CurrentValue, 0);
			$rsnew['category'] =& $gallery->category->DbValue;
			}

			// Field link
						if ($gallery->link->MultiUpdate == "1") {
			$gallery->link->SetDbValueDef($gallery->link->CurrentValue, "");
			$rsnew['link'] =& $gallery->link->DbValue;
			}

			// Field special
						if ($gallery->special->MultiUpdate == "1") {
			$gallery->special->SetDbValueDef($gallery->special->CurrentValue, 0);
			$rsnew['special'] =& $gallery->special->DbValue;
			}

			// Field order
						if ($gallery->order->MultiUpdate == "1") {
			$gallery->order->SetDbValueDef($gallery->order->CurrentValue, 0);
			$rsnew['order'] =& $gallery->order->DbValue;
			}

			// Field active
						if ($gallery->active->MultiUpdate == "1") {
			$gallery->active->SetDbValueDef($gallery->active->CurrentValue, 0);
			$rsnew['active'] =& $gallery->active->DbValue;
			}

			// Call Row Updating event
			$bUpdateRow = $gallery->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {

			// Field image
			if (!is_null($gallery->image->Upload->Value)) {
				if ($gallery->image->Upload->FileName == $gallery->image->Upload->DbValue) { // Overwrite if same file name
					$gallery->image->Upload->SaveToFile("../images/", $rsnew['image'], TRUE);
					$gallery->image->Upload->DbValue = ""; // No need to delete any more
				} else {
					$gallery->image->Upload->SaveToFile("../images/", $rsnew['image'], FALSE);
				}
			}
			if ($gallery->image->Upload->Action == "2" || $gallery->image->Upload->Action == "3") { // Update/Remove
				if ($gallery->image->Upload->DbValue <> "")
					@unlink(ew_UploadPathEx(TRUE, "../images/") . $gallery->image->Upload->DbValue);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($gallery->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($gallery->CancelMessage <> "") {
					$this->setMessage($gallery->CancelMessage);
					$gallery->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$gallery->Row_Updated($rsold, $rsnew);
		$rs->Close();

		// Field image
		$gallery->image->Upload->RemoveFromSession(); // Remove file value from Session
		return $EditRow;
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
