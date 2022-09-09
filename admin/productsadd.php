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
$products_add = new cproducts_add();
$Page =& $products_add;

// Page init processing
$products_add->Page_Init();

// Page main processing
$products_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var products_add = new ew_Page("products_add");

// page properties
products_add.PageID = "add"; // page ID
var EW_PAGE_ID = products_add.PageID; // for backward compatibility

// extend page with ValidateForm function
products_add.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_name"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - name");
		elm = fobj.elements["x" + infix + "_name_arabic"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - name arabic");
		elm = fobj.elements["x" + infix + "_level"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - level");
		elm = fobj.elements["x" + infix + "_level"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "Incorrect integer - level");
		elm = fobj.elements["x" + infix + "_image"];
		aelm = fobj.elements["a" + infix + "_image"];
		var chk_image = (aelm && aelm[0])?(aelm[2].checked):true;
		if (elm && chk_image && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - image");
		elm = fobj.elements["x" + infix + "_image"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, "File type is not allowed.");
		elm = fobj.elements["x" + infix + "_image2"];
		aelm = fobj.elements["a" + infix + "_image2"];
		var chk_image2 = (aelm && aelm[0])?(aelm[2].checked):true;
		if (elm && chk_image2 && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - image 2");
		elm = fobj.elements["x" + infix + "_image2"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, "File type is not allowed.");
		elm = fobj.elements["x" + infix + "_image3"];
		aelm = fobj.elements["a" + infix + "_image3"];
		var chk_image3 = (aelm && aelm[0])?(aelm[2].checked):true;
		if (elm && chk_image3 && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - image 3");
		elm = fobj.elements["x" + infix + "_image3"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, "File type is not allowed.");
		elm = fobj.elements["x" + infix + "_file"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, "File type is not allowed.");
		elm = fobj.elements["x" + infix + "_special"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - special");
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
products_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
products_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
products_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
products_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
products_add.ShowHighlightText = "Show highlight"; 
products_add.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">Add to TABLE: products<br><br>
<a href="<?php echo $products->getReturnUrl() ?>">Go Back</a></span></p>
<?php $products_add->ShowMessage() ?>
<form name="fproductsadd" id="fproductsadd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data">
<p>
<input type="hidden" name="t" id="t" value="products">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($products->name->Visible) { // name ?>
	<tr<?php echo $products->name->RowAttributes ?>>
		<td class="ewTableHeader">name<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $products->name->CellAttributes() ?>><span id="el_name">
<input type="text" name="x_name" id="x_name" size="30" maxlength="200" value="<?php echo $products->name->EditValue ?>"<?php echo $products->name->EditAttributes() ?>>
</span><?php echo $products->name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($products->name_arabic->Visible) { // name_arabic ?>
	<tr<?php echo $products->name_arabic->RowAttributes ?>>
		<td class="ewTableHeader">name arabic<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $products->name_arabic->CellAttributes() ?>><span id="el_name_arabic">
<input type="text" name="x_name_arabic" id="x_name_arabic" size="30" maxlength="200" value="<?php echo $products->name_arabic->EditValue ?>"<?php echo $products->name_arabic->EditAttributes() ?>>
</span><?php echo $products->name_arabic->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($products->level->Visible) { // level ?>
	<tr<?php echo $products->level->RowAttributes ?>>
		<td class="ewTableHeader">level<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $products->level->CellAttributes() ?>><span id="el_level">
<input type="text" name="x_level" id="x_level" size="30" value="<?php echo $products->level->EditValue ?>"<?php echo $products->level->EditAttributes() ?>>
</span><?php echo $products->level->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($products->image->Visible) { // image ?>
	<tr<?php echo $products->image->RowAttributes ?>>
		<td class="ewTableHeader">image<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $products->image->CellAttributes() ?>><span id="el_image">
<input type="file" name="x_image" id="x_image" size="30"<?php echo $products->image->EditAttributes() ?>>
</div>
</span><?php echo $products->image->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($products->image2->Visible) { // image2 ?>
	<tr<?php echo $products->image2->RowAttributes ?>>
		<td class="ewTableHeader">image 2<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $products->image2->CellAttributes() ?>><span id="el_image2">
<input type="file" name="x_image2" id="x_image2" size="30"<?php echo $products->image2->EditAttributes() ?>>
</div>
</span><?php echo $products->image2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($products->image3->Visible) { // image3 ?>
	<tr<?php echo $products->image3->RowAttributes ?>>
		<td class="ewTableHeader">image 3<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $products->image3->CellAttributes() ?>><span id="el_image3">
<input type="file" name="x_image3" id="x_image3" size="30"<?php echo $products->image3->EditAttributes() ?>>
</div>
</span><?php echo $products->image3->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($products->description->Visible) { // description ?>
	<tr<?php echo $products->description->RowAttributes ?>>
		<td class="ewTableHeader">description</td>
		<td<?php echo $products->description->CellAttributes() ?>><span id="el_description">
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
</span><?php echo $products->description->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($products->description_arabic->Visible) { // description_arabic ?>
	<tr<?php echo $products->description_arabic->RowAttributes ?>>
		<td class="ewTableHeader">description arabic</td>
		<td<?php echo $products->description_arabic->CellAttributes() ?>><span id="el_description_arabic">
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
</span><?php echo $products->description_arabic->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($products->video->Visible) { // video ?>
	<tr<?php echo $products->video->RowAttributes ?>>
		<td class="ewTableHeader">video</td>
		<td<?php echo $products->video->CellAttributes() ?>><span id="el_video">
<input type="text" name="x_video" id="x_video" size="30" maxlength="150" value="<?php echo $products->video->EditValue ?>"<?php echo $products->video->EditAttributes() ?>>
</span><?php echo $products->video->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($products->file->Visible) { // file ?>
	<tr<?php echo $products->file->RowAttributes ?>>
		<td class="ewTableHeader">file</td>
		<td<?php echo $products->file->CellAttributes() ?>><span id="el_file">
<input type="file" name="x_file" id="x_file" size="30"<?php echo $products->file->EditAttributes() ?>>
</div>
</span><?php echo $products->file->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($products->special->Visible) { // special ?>
	<tr<?php echo $products->special->RowAttributes ?>>
		<td class="ewTableHeader">special<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $products->special->CellAttributes() ?>><span id="el_special">
<div id="tp_x_special" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_special" id="x_special" value="{value}"<?php echo $products->special->EditAttributes() ?>></div>
<div id="dsl_x_special" repeatcolumn="5">
<?php
$arwrk = $products->special->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($products->special->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
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
</span><?php echo $products->special->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($products->order->Visible) { // order ?>
	<tr<?php echo $products->order->RowAttributes ?>>
		<td class="ewTableHeader">order<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $products->order->CellAttributes() ?>><span id="el_order">
<input type="text" name="x_order" id="x_order" size="30" value="<?php echo $products->order->EditValue ?>"<?php echo $products->order->EditAttributes() ?>>
</span><?php echo $products->order->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($products->active->Visible) { // active ?>
	<tr<?php echo $products->active->RowAttributes ?>>
		<td class="ewTableHeader">active<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $products->active->CellAttributes() ?>><span id="el_active">
<div id="tp_x_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_active" id="x_active" value="{value}"<?php echo $products->active->EditAttributes() ?>></div>
<div id="dsl_x_active" repeatcolumn="5">
<?php
$arwrk = $products->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($products->active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
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
</span><?php echo $products->active->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="button" name="btnAction" id="btnAction" value="    Add    " onclick="ew_SubmitForm(products_add, this.form);">
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
$products_add->Page_Terminate();
?>
<?php

//
// Page Class
//
class cproducts_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'products';

	// Page Object Name
	var $PageObjName = 'products_add';

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
	function cproducts_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["products"] = new cproducts();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $x_ewPriv = 0;

	// 
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsFormError, $products;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $products->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $products->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->GetUploadFiles(); // Get upload files
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$products->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $products->CurrentAction = "C"; // Copy Record
		  } else {
		    $products->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($products->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("No records found"); // No record found
		      $this->Page_Terminate("productslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$products->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("Add succeeded"); // Set up success message
					$sReturnUrl = $products->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "productsview.php")
						$sReturnUrl = $products->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$products->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $products;

		// Get upload data
			$products->image->Upload->Index = $objForm->Index;
			if ($products->image->Upload->UploadFile()) {

				// No action required
			} else {
				echo $products->image->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
			$products->image2->Upload->Index = $objForm->Index;
			if ($products->image2->Upload->UploadFile()) {

				// No action required
			} else {
				echo $products->image2->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
			$products->image3->Upload->Index = $objForm->Index;
			if ($products->image3->Upload->UploadFile()) {

				// No action required
			} else {
				echo $products->image3->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
			$products->file->Upload->Index = $objForm->Index;
			if ($products->file->Upload->UploadFile()) {

				// No action required
			} else {
				echo $products->file->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load default values
	function LoadDefaultValues() {
		global $products;
		$products->image->CurrentValue = NULL; // Clear file related field
		$products->image2->CurrentValue = NULL; // Clear file related field
		$products->image3->CurrentValue = NULL; // Clear file related field
		$products->file->CurrentValue = NULL; // Clear file related field
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $products;
		$products->name->setFormValue($objForm->GetValue("x_name"));
		$products->name_arabic->setFormValue($objForm->GetValue("x_name_arabic"));
		$products->level->setFormValue($objForm->GetValue("x_level"));
		$products->description->setFormValue($objForm->GetValue("x_description"));
		$products->description_arabic->setFormValue($objForm->GetValue("x_description_arabic"));
		$products->video->setFormValue($objForm->GetValue("x_video"));
		$products->special->setFormValue($objForm->GetValue("x_special"));
		$products->order->setFormValue($objForm->GetValue("x_order"));
		$products->active->setFormValue($objForm->GetValue("x_active"));
		$products->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $products;
		$products->id->CurrentValue = $products->id->FormValue;
		$products->name->CurrentValue = $products->name->FormValue;
		$products->name_arabic->CurrentValue = $products->name_arabic->FormValue;
		$products->level->CurrentValue = $products->level->FormValue;
		$products->description->CurrentValue = $products->description->FormValue;
		$products->description_arabic->CurrentValue = $products->description_arabic->FormValue;
		$products->video->CurrentValue = $products->video->FormValue;
		$products->special->CurrentValue = $products->special->FormValue;
		$products->order->CurrentValue = $products->order->FormValue;
		$products->active->CurrentValue = $products->active->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $products;
		$sFilter = $products->KeyFilter();

		// Call Row Selecting event
		$products->Row_Selecting($sFilter);

		// Load sql based on filter
		$products->CurrentFilter = $sFilter;
		$sSql = $products->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$products->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $products;
		$products->id->setDbValue($rs->fields('id'));
		$products->name->setDbValue($rs->fields('name'));
		$products->name_arabic->setDbValue($rs->fields('name_arabic'));
		$products->level->setDbValue($rs->fields('level'));
		$products->image->Upload->DbValue = $rs->fields('image');
		$products->image2->Upload->DbValue = $rs->fields('image2');
		$products->image3->Upload->DbValue = $rs->fields('image3');
		$products->description->setDbValue($rs->fields('description'));
		$products->description_arabic->setDbValue($rs->fields('description_arabic'));
		$products->video->setDbValue($rs->fields('video'));
		$products->file->Upload->DbValue = $rs->fields('file');
		$products->special->setDbValue($rs->fields('special'));
		$products->order->setDbValue($rs->fields('order'));
		$products->active->setDbValue($rs->fields('active'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $products;

		// Call Row_Rendering event
		$products->Row_Rendering();

		// Common render codes for all row types
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
		} elseif ($products->RowType == EW_ROWTYPE_ADD) { // Add row

			// name
			$products->name->EditCustomAttributes = "";
			$products->name->EditValue = ew_HtmlEncode($products->name->CurrentValue);

			// name_arabic
			$products->name_arabic->EditCustomAttributes = "";
			$products->name_arabic->EditValue = ew_HtmlEncode($products->name_arabic->CurrentValue);

			// level
			$products->level->EditCustomAttributes = "";
			$products->level->EditValue = ew_HtmlEncode($products->level->CurrentValue);

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
			$products->description->EditValue = ew_HtmlEncode($products->description->CurrentValue);

			// description_arabic
			$products->description_arabic->EditCustomAttributes = "";
			$products->description_arabic->EditValue = ew_HtmlEncode($products->description_arabic->CurrentValue);

			// video
			$products->video->EditCustomAttributes = "";
			$products->video->EditValue = ew_HtmlEncode($products->video->CurrentValue);

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
			$products->order->EditValue = ew_HtmlEncode($products->order->CurrentValue);

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

	// Validate form
	function ValidateForm() {
		global $gsFormError, $products;

		// Initialize
		$gsFormError = "";
		if (!ew_CheckFileType($products->image->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "File type is not allowed.";
		}
		if ($products->image->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($products->image->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "Max. file size (%s bytes) exceeded.");
		}
		if (!ew_CheckFileType($products->image2->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "File type is not allowed.";
		}
		if ($products->image2->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($products->image2->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "Max. file size (%s bytes) exceeded.");
		}
		if (!ew_CheckFileType($products->image3->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "File type is not allowed.";
		}
		if ($products->image3->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($products->image3->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "Max. file size (%s bytes) exceeded.");
		}
		if (!ew_CheckFileType($products->file->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "File type is not allowed.";
		}
		if ($products->file->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($products->file->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "Max. file size (%s bytes) exceeded.");
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($products->name->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - name";
		}
		if ($products->name_arabic->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - name arabic";
		}
		if ($products->level->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - level";
		}
		if (!ew_CheckInteger($products->level->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - level";
		}
		if (is_null($products->image->Upload->Value)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - image";
		}
		if (is_null($products->image2->Upload->Value)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - image 2";
		}
		if (is_null($products->image3->Upload->Value)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - image 3";
		}
		if ($products->special->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - special";
		}
		if ($products->order->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - order";
		}
		if (!ew_CheckInteger($products->order->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - order";
		}
		if ($products->active->FormValue == "") {
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
		global $conn, $Security, $products;
		$rsnew = array();

		// Field name
		$products->name->SetDbValueDef($products->name->CurrentValue, "");
		$rsnew['name'] =& $products->name->DbValue;

		// Field name_arabic
		$products->name_arabic->SetDbValueDef($products->name_arabic->CurrentValue, "");
		$rsnew['name_arabic'] =& $products->name_arabic->DbValue;

		// Field level
		$products->level->SetDbValueDef($products->level->CurrentValue, 0);
		$rsnew['level'] =& $products->level->DbValue;

		// Field image
		$products->image->Upload->SaveToSession(); // Save file value to Session
		if (is_null($products->image->Upload->Value)) {
			$rsnew['image'] = NULL;
		} else {
			$rsnew['image'] = ew_UploadFileNameEx(ew_UploadPathEx(True, "../images/"), $products->image->Upload->FileName);
		}

		// Field image2
		$products->image2->Upload->SaveToSession(); // Save file value to Session
		if (is_null($products->image2->Upload->Value)) {
			$rsnew['image2'] = NULL;
		} else {
			$rsnew['image2'] = ew_UploadFileNameEx(ew_UploadPathEx(True, "../images/"), $products->image2->Upload->FileName);
		}

		// Field image3
		$products->image3->Upload->SaveToSession(); // Save file value to Session
		if (is_null($products->image3->Upload->Value)) {
			$rsnew['image3'] = NULL;
		} else {
			$rsnew['image3'] = ew_UploadFileNameEx(ew_UploadPathEx(True, "../images/"), $products->image3->Upload->FileName);
		}

		// Field description
		$products->description->SetDbValueDef($products->description->CurrentValue, NULL);
		$rsnew['description'] =& $products->description->DbValue;

		// Field description_arabic
		$products->description_arabic->SetDbValueDef($products->description_arabic->CurrentValue, NULL);
		$rsnew['description_arabic'] =& $products->description_arabic->DbValue;

		// Field video
		$products->video->SetDbValueDef($products->video->CurrentValue, NULL);
		$rsnew['video'] =& $products->video->DbValue;

		// Field file
		$products->file->Upload->SaveToSession(); // Save file value to Session
		if (is_null($products->file->Upload->Value)) {
			$rsnew['file'] = NULL;
		} else {
			$rsnew['file'] = ew_UploadFileNameEx(ew_UploadPathEx(True, "../images/"), $products->file->Upload->FileName);
		}

		// Field special
		$products->special->SetDbValueDef($products->special->CurrentValue, 0);
		$rsnew['special'] =& $products->special->DbValue;

		// Field order
		$products->order->SetDbValueDef($products->order->CurrentValue, 0);
		$rsnew['order'] =& $products->order->DbValue;

		// Field active
		$products->active->SetDbValueDef($products->active->CurrentValue, 0);
		$rsnew['active'] =& $products->active->DbValue;

		// Call Row Inserting event
		$bInsertRow = $products->Row_Inserting($rsnew);
		if ($bInsertRow) {

			// Field image
			if (!is_null($products->image->Upload->Value)) {
				if ($products->image->Upload->FileName == $products->image->Upload->DbValue) { // Overwrite if same file name
					$products->image->Upload->SaveToFile("../images/", $rsnew['image'], TRUE);
					$products->image->Upload->DbValue = ""; // No need to delete any more
				} else {
					$products->image->Upload->SaveToFile("../images/", $rsnew['image'], FALSE);
				}
			}
			if ($products->image->Upload->Action == "2" || $products->image->Upload->Action == "3") { // Update/Remove
				if ($products->image->Upload->DbValue <> "")
					@unlink(ew_UploadPathEx(TRUE, "../images/") . $products->image->Upload->DbValue);
			}

			// Field image2
			if (!is_null($products->image2->Upload->Value)) {
				if ($products->image2->Upload->FileName == $products->image2->Upload->DbValue) { // Overwrite if same file name
					$products->image2->Upload->SaveToFile("../images/", $rsnew['image2'], TRUE);
					$products->image2->Upload->DbValue = ""; // No need to delete any more
				} else {
					$products->image2->Upload->SaveToFile("../images/", $rsnew['image2'], FALSE);
				}
			}
			if ($products->image2->Upload->Action == "2" || $products->image2->Upload->Action == "3") { // Update/Remove
				if ($products->image2->Upload->DbValue <> "")
					@unlink(ew_UploadPathEx(TRUE, "../images/") . $products->image2->Upload->DbValue);
			}

			// Field image3
			if (!is_null($products->image3->Upload->Value)) {
				if ($products->image3->Upload->FileName == $products->image3->Upload->DbValue) { // Overwrite if same file name
					$products->image3->Upload->SaveToFile("../images/", $rsnew['image3'], TRUE);
					$products->image3->Upload->DbValue = ""; // No need to delete any more
				} else {
					$products->image3->Upload->SaveToFile("../images/", $rsnew['image3'], FALSE);
				}
			}
			if ($products->image3->Upload->Action == "2" || $products->image3->Upload->Action == "3") { // Update/Remove
				if ($products->image3->Upload->DbValue <> "")
					@unlink(ew_UploadPathEx(TRUE, "../images/") . $products->image3->Upload->DbValue);
			}

			// Field file
			if (!is_null($products->file->Upload->Value)) {
				if ($products->file->Upload->FileName == $products->file->Upload->DbValue) { // Overwrite if same file name
					$products->file->Upload->SaveToFile("../images/", $rsnew['file'], TRUE);
					$products->file->Upload->DbValue = ""; // No need to delete any more
				} else {
					$products->file->Upload->SaveToFile("../images/", $rsnew['file'], FALSE);
				}
			}
			if ($products->file->Upload->Action == "2" || $products->file->Upload->Action == "3") { // Update/Remove
				if ($products->file->Upload->DbValue <> "")
					@unlink(ew_UploadPathEx(TRUE, "../images/") . $products->file->Upload->DbValue);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($products->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($products->CancelMessage <> "") {
				$this->setMessage($products->CancelMessage);
				$products->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$products->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $products->id->DbValue;

			// Call Row Inserted event
			$products->Row_Inserted($rsnew);
		}

		// Field image
		$products->image->Upload->RemoveFromSession(); // Remove file value from Session

		// Field image2
		$products->image2->Upload->RemoveFromSession(); // Remove file value from Session

		// Field image3
		$products->image3->Upload->RemoveFromSession(); // Remove file value from Session

		// Field file
		$products->file->Upload->RemoveFromSession(); // Remove file value from Session
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
