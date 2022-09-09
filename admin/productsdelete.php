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
$products_delete = new cproducts_delete();
$Page =& $products_delete;

// Page init processing
$products_delete->Page_Init();

// Page main processing
$products_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var products_delete = new ew_Page("products_delete");

// page properties
products_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = products_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
products_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
products_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
products_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
products_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
products_delete.ShowHighlightText = "Show highlight"; 
products_delete.HideHighlightText = "Hide highlight";

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
$rs = $products_delete->LoadRecordset();
$products_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($products_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$products_delete->Page_Terminate("productslist.php"); // Return to list
}
?>
<p><span class="phpmaker">Delete From TABLE: products<br><br>
<a href="<?php echo $products->getReturnUrl() ?>">Go Back</a></span></p>
<?php $products_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="products">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($products_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $products->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">id</td>
		<td valign="top">name</td>
		<td valign="top">name arabic</td>
		<td valign="top">level</td>
		<td valign="top">image</td>
		<td valign="top">image 2</td>
		<td valign="top">image 3</td>
		<td valign="top">special</td>
		<td valign="top">order</td>
		<td valign="top">active</td>
	</tr>
	</thead>
	<tbody>
<?php
$products_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$products_delete->lRecCnt++;

	// Set row properties
	$products->CssClass = "";
	$products->CssStyle = "";
	$products->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$products_delete->LoadRowValues($rs);

	// Render row
	$products_delete->RenderRow();
?>
	<tr<?php echo $products->RowAttributes() ?>>
		<td<?php echo $products->id->CellAttributes() ?>>
<div<?php echo $products->id->ViewAttributes() ?>><?php echo $products->id->ListViewValue() ?></div></td>
		<td<?php echo $products->name->CellAttributes() ?>>
<div<?php echo $products->name->ViewAttributes() ?>><?php echo $products->name->ListViewValue() ?></div></td>
		<td<?php echo $products->name_arabic->CellAttributes() ?>>
<div<?php echo $products->name_arabic->ViewAttributes() ?>><?php echo $products->name_arabic->ListViewValue() ?></div></td>
		<td<?php echo $products->level->CellAttributes() ?>>
<div<?php echo $products->level->ViewAttributes() ?>><?php echo $products->level->ListViewValue() ?></div></td>
		<td<?php echo $products->image->CellAttributes() ?>>
<?php if ($products->image->HrefValue <> "") { ?>
<?php if (!is_null($products->image->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $products->image->Upload->DbValue ?>" border=0<?php echo $products->image->ViewAttributes() ?>>
<?php } elseif (!in_array($products->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($products->image->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $products->image->Upload->DbValue ?>" border=0<?php echo $products->image->ViewAttributes() ?>>
<?php } elseif (!in_array($products->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
		<td<?php echo $products->image2->CellAttributes() ?>>
<?php if ($products->image2->HrefValue <> "") { ?>
<?php if (!is_null($products->image2->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $products->image2->Upload->DbValue ?>" border=0<?php echo $products->image2->ViewAttributes() ?>>
<?php } elseif (!in_array($products->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($products->image2->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $products->image2->Upload->DbValue ?>" border=0<?php echo $products->image2->ViewAttributes() ?>>
<?php } elseif (!in_array($products->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
		<td<?php echo $products->image3->CellAttributes() ?>>
<?php if ($products->image3->HrefValue <> "") { ?>
<?php if (!is_null($products->image3->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $products->image3->Upload->DbValue ?>" border=0<?php echo $products->image3->ViewAttributes() ?>>
<?php } elseif (!in_array($products->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($products->image3->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $products->image3->Upload->DbValue ?>" border=0<?php echo $products->image3->ViewAttributes() ?>>
<?php } elseif (!in_array($products->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
		<td<?php echo $products->special->CellAttributes() ?>>
<div<?php echo $products->special->ViewAttributes() ?>><?php echo $products->special->ListViewValue() ?></div></td>
		<td<?php echo $products->order->CellAttributes() ?>>
<div<?php echo $products->order->ViewAttributes() ?>><?php echo $products->order->ListViewValue() ?></div></td>
		<td<?php echo $products->active->CellAttributes() ?>>
<div<?php echo $products->active->ViewAttributes() ?>><?php echo $products->active->ListViewValue() ?></div></td>
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
$products_delete->Page_Terminate();
?>
<?php

//
// Page Class
//
class cproducts_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'products';

	// Page Object Name
	var $PageObjName = 'products_delete';

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
	function cproducts_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["products"] = new cproducts();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs;
	var $lRecCnt;
	var $arRecKeys = array();

	// Page main processing
	function Page_Main() {
		global $products;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$products->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($products->id->QueryStringValue))
				$this->Page_Terminate("productslist.php"); // Prevent SQL injection, exit
			$sKey .= $products->id->QueryStringValue;
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
			$this->Page_Terminate("productslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("productslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in products class, productsinfo.php

		$products->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$products->CurrentAction = $_POST["a_delete"];
		} else {
			$products->CurrentAction = "D"; // Delete record directly
		}
		switch ($products->CurrentAction) {
			case "D": // Delete
				$products->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($products->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $products;
		$DeleteRows = TRUE;
		$sWrkFilter = $products->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in products class, productsinfo.php

		$products->CurrentFilter = $sWrkFilter;
		$sSql = $products->SQL();
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
				$DeleteRows = $products->Row_Deleting($row);
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
				@unlink(ew_UploadPathEx(TRUE, "../images/") . $row['image2']);
				@unlink(ew_UploadPathEx(TRUE, "../images/") . $row['image3']);
				@unlink(ew_UploadPathEx(TRUE, "../images/") . $row['file']);
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($products->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($products->CancelMessage <> "") {
				$this->setMessage($products->CancelMessage);
				$products->CancelMessage = "";
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
				$products->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $products;

		// Call Recordset Selecting event
		$products->Recordset_Selecting($products->CurrentFilter);

		// Load list page SQL
		$sSql = $products->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$products->Recordset_Selected($rs);
		return $rs;
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

			// special
			$products->special->HrefValue = "";

			// order
			$products->order->HrefValue = "";

			// active
			$products->active->HrefValue = "";
		}

		// Call Row Rendered event
		$products->Row_Rendered();
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
