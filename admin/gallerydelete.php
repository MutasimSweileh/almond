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
$gallery_delete = new cgallery_delete();
$Page =& $gallery_delete;

// Page init processing
$gallery_delete->Page_Init();

// Page main processing
$gallery_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var gallery_delete = new ew_Page("gallery_delete");

// page properties
gallery_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = gallery_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
gallery_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
gallery_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
gallery_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
gallery_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
gallery_delete.ShowHighlightText = "Show highlight"; 
gallery_delete.HideHighlightText = "Hide highlight";

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php

// Load records for display
$rs = $gallery_delete->LoadRecordset();
$gallery_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($gallery_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$gallery_delete->Page_Terminate("gallerylist.php"); // Return to list
}
?>
<p><span class="phpmaker">Delete From TABLE: gallery<br><br>
<a href="<?php echo $gallery->getReturnUrl() ?>">Go Back</a></span></p>
<?php $gallery_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="gallery">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($gallery_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $gallery->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">id</td>
		<td valign="top">name</td>
		<td valign="top">name arabic</td>
		<td valign="top">image</td>
		<td valign="top">category</td>
		<td valign="top">link</td>
		<td valign="top">special</td>
		<td valign="top">order</td>
		<td valign="top">active</td>
	</tr>
	</thead>
	<tbody>
<?php
$gallery_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$gallery_delete->lRecCnt++;

	// Set row properties
	$gallery->CssClass = "";
	$gallery->CssStyle = "";
	$gallery->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$gallery_delete->LoadRowValues($rs);

	// Render row
	$gallery_delete->RenderRow();
?>
	<tr<?php echo $gallery->RowAttributes() ?>>
		<td<?php echo $gallery->id->CellAttributes() ?>>
<div<?php echo $gallery->id->ViewAttributes() ?>><?php echo $gallery->id->ListViewValue() ?></div></td>
		<td<?php echo $gallery->name->CellAttributes() ?>>
<div<?php echo $gallery->name->ViewAttributes() ?>><?php echo $gallery->name->ListViewValue() ?></div></td>
		<td<?php echo $gallery->name_arabic->CellAttributes() ?>>
<div<?php echo $gallery->name_arabic->ViewAttributes() ?>><?php echo $gallery->name_arabic->ListViewValue() ?></div></td>
		<td<?php echo $gallery->image->CellAttributes() ?>>
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
</td>
		<td<?php echo $gallery->category->CellAttributes() ?>>
<div<?php echo $gallery->category->ViewAttributes() ?>><?php echo $gallery->category->ListViewValue() ?></div></td>
		<td<?php echo $gallery->link->CellAttributes() ?>>
<div<?php echo $gallery->link->ViewAttributes() ?>><?php echo $gallery->link->ListViewValue() ?></div></td>
		<td<?php echo $gallery->special->CellAttributes() ?>>
<div<?php echo $gallery->special->ViewAttributes() ?>><?php echo $gallery->special->ListViewValue() ?></div></td>
		<td<?php echo $gallery->order->CellAttributes() ?>>
<div<?php echo $gallery->order->ViewAttributes() ?>><?php echo $gallery->order->ListViewValue() ?></div></td>
		<td<?php echo $gallery->active->CellAttributes() ?>>
<div<?php echo $gallery->active->ViewAttributes() ?>><?php echo $gallery->active->ListViewValue() ?></div></td>
	</tr>
<?php
	$rs->MoveNext();
}
$rs->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="Confirm Delete">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$gallery_delete->Page_Terminate();
?>
<?php

//
// Page Class
//
class cgallery_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'gallery';

	// Page Object Name
	var $PageObjName = 'gallery_delete';

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
	function cgallery_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["gallery"] = new cgallery();

		// Initialize other table object
		$GLOBALS['categories'] = new ccategories();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs;
	var $lRecCnt;
	var $arRecKeys = array();

	// Page main processing
	function Page_Main() {
		global $gallery;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$gallery->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($gallery->id->QueryStringValue))
				$this->Page_Terminate("gallerylist.php"); // Prevent SQL injection, exit
			$sKey .= $gallery->id->QueryStringValue;
		} else {
			$bSingleDelete = FALSE;
		}
		if ($bSingleDelete) {
			$nKeySelected = 1; // Set up key selected count
			$this->arRecKeys[0] = $sKey;
		} else {
			if (isset($_POST["key_m"])) { // Key in form
				$nKeySelected = count($_POST["key_m"]); // Set up key selected count
				$this->arRecKeys = ew_StripSlashes($_POST["key_m"]);
			}
		}
		if ($nKeySelected <= 0)
			$this->Page_Terminate("gallerylist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("gallerylist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in gallery class, galleryinfo.php

		$gallery->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$gallery->CurrentAction = $_POST["a_delete"];
		} else {
			$gallery->CurrentAction = "D"; // Delete record directly
		}
		switch ($gallery->CurrentAction) {
			case "D": // Delete
				$gallery->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($gallery->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $gallery;
		$DeleteRows = TRUE;
		$sWrkFilter = $gallery->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in gallery class, galleryinfo.php

		$gallery->CurrentFilter = $sWrkFilter;
		$sSql = $gallery->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setMessage("No records found"); // No record found
			$rs->Close();
			return FALSE;
		}
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs) $rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $gallery->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id'];
				@unlink(ew_UploadPathEx(TRUE, "../images/") . $row['image']);
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($gallery->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($gallery->CancelMessage <> "") {
				$this->setMessage($gallery->CancelMessage);
				$gallery->CancelMessage = "";
			} else {
				$this->setMessage("Delete cancelled");
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call recordset deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$gallery->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
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

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $gallery;
		$sFilter = $gallery->KeyFilter();

		// Call Row Selecting event
		$gallery->Row_Selecting($sFilter);

		// Load sql based on filter
		$gallery->CurrentFilter = $sFilter;
		$sSql = $gallery->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$gallery->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $gallery;
		$gallery->id->setDbValue($rs->fields('id'));
		$gallery->name->setDbValue($rs->fields('name'));
		$gallery->name_arabic->setDbValue($rs->fields('name_arabic'));
		$gallery->image->Upload->DbValue = $rs->fields('image');
		$gallery->category->setDbValue($rs->fields('category'));
		$gallery->link->setDbValue($rs->fields('link'));
		$gallery->special->setDbValue($rs->fields('special'));
		$gallery->order->setDbValue($rs->fields('order'));
		$gallery->active->setDbValue($rs->fields('active'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $gallery;

		// Call Row_Rendering event
		$gallery->Row_Rendering();

		// Common render codes for all row types
		// id

		$gallery->id->CellCssStyle = "";
		$gallery->id->CellCssClass = "";

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

			// id
			$gallery->id->HrefValue = "";

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

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}
}
?>
