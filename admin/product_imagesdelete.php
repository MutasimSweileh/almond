<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "product_imagesinfo.php" ?>
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
$product_images_delete = new cproduct_images_delete();
$Page =& $product_images_delete;

// Page init processing
$product_images_delete->Page_Init();

// Page main processing
$product_images_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var product_images_delete = new ew_Page("product_images_delete");

// page properties
product_images_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = product_images_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
product_images_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
product_images_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
product_images_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
product_images_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
product_images_delete.ShowHighlightText = "Show highlight"; 
product_images_delete.HideHighlightText = "Hide highlight";

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
$rs = $product_images_delete->LoadRecordset();
$product_images_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($product_images_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$product_images_delete->Page_Terminate("product_imageslist.php"); // Return to list
}
?>
<p><span class="phpmaker">Delete From TABLE: product images<br><br>
<a href="<?php echo $product_images->getReturnUrl() ?>">Go Back</a></span></p>
<?php $product_images_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="product_images">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($product_images_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $product_images->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">id</td>
		<td valign="top">image</td>
		<td valign="top">name</td>
		<td valign="top">name arabic</td>
		<td valign="top">product</td>
		<td valign="top">order</td>
		<td valign="top">active</td>
	</tr>
	</thead>
	<tbody>
<?php
$product_images_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$product_images_delete->lRecCnt++;

	// Set row properties
	$product_images->CssClass = "";
	$product_images->CssStyle = "";
	$product_images->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$product_images_delete->LoadRowValues($rs);

	// Render row
	$product_images_delete->RenderRow();
?>
	<tr<?php echo $product_images->RowAttributes() ?>>
		<td<?php echo $product_images->id->CellAttributes() ?>>
<div<?php echo $product_images->id->ViewAttributes() ?>><?php echo $product_images->id->ListViewValue() ?></div></td>
		<td<?php echo $product_images->image->CellAttributes() ?>>
<?php if ($product_images->image->HrefValue <> "") { ?>
<?php if (!is_null($product_images->image->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $product_images->image->Upload->DbValue ?>" border=0<?php echo $product_images->image->ViewAttributes() ?>>
<?php } elseif (!in_array($product_images->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($product_images->image->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $product_images->image->Upload->DbValue ?>" border=0<?php echo $product_images->image->ViewAttributes() ?>>
<?php } elseif (!in_array($product_images->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
		<td<?php echo $product_images->name->CellAttributes() ?>>
<div<?php echo $product_images->name->ViewAttributes() ?>><?php echo $product_images->name->ListViewValue() ?></div></td>
		<td<?php echo $product_images->name_arabic->CellAttributes() ?>>
<div<?php echo $product_images->name_arabic->ViewAttributes() ?>><?php echo $product_images->name_arabic->ListViewValue() ?></div></td>
		<td<?php echo $product_images->product_id->CellAttributes() ?>>
<div<?php echo $product_images->product_id->ViewAttributes() ?>><?php echo $product_images->product_id->ListViewValue() ?></div></td>
		<td<?php echo $product_images->order->CellAttributes() ?>>
<div<?php echo $product_images->order->ViewAttributes() ?>><?php echo $product_images->order->ListViewValue() ?></div></td>
		<td<?php echo $product_images->active->CellAttributes() ?>>
<div<?php echo $product_images->active->ViewAttributes() ?>><?php echo $product_images->active->ListViewValue() ?></div></td>
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
$product_images_delete->Page_Terminate();
?>
<?php

//
// Page Class
//
class cproduct_images_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'product_images';

	// Page Object Name
	var $PageObjName = 'product_images_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $product_images;
		if ($product_images->UseTokenInUrl) $PageUrl .= "t=" . $product_images->TableVar . "&"; // add page token
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
		global $objForm, $product_images;
		if ($product_images->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($product_images->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($product_images->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cproduct_images_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["product_images"] = new cproduct_images();

		// Initialize other table object
		$GLOBALS['products'] = new cproducts();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'product_images', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $product_images;
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
		global $product_images;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$product_images->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($product_images->id->QueryStringValue))
				$this->Page_Terminate("product_imageslist.php"); // Prevent SQL injection, exit
			$sKey .= $product_images->id->QueryStringValue;
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
			$this->Page_Terminate("product_imageslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("product_imageslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in product_images class, product_imagesinfo.php

		$product_images->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$product_images->CurrentAction = $_POST["a_delete"];
		} else {
			$product_images->CurrentAction = "D"; // Delete record directly
		}
		switch ($product_images->CurrentAction) {
			case "D": // Delete
				$product_images->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($product_images->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $product_images;
		$DeleteRows = TRUE;
		$sWrkFilter = $product_images->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in product_images class, product_imagesinfo.php

		$product_images->CurrentFilter = $sWrkFilter;
		$sSql = $product_images->SQL();
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
				$DeleteRows = $product_images->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($product_images->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($product_images->CancelMessage <> "") {
				$this->setMessage($product_images->CancelMessage);
				$product_images->CancelMessage = "";
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
				$product_images->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $product_images;

		// Call Recordset Selecting event
		$product_images->Recordset_Selecting($product_images->CurrentFilter);

		// Load list page SQL
		$sSql = $product_images->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$product_images->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $product_images;
		$sFilter = $product_images->KeyFilter();

		// Call Row Selecting event
		$product_images->Row_Selecting($sFilter);

		// Load sql based on filter
		$product_images->CurrentFilter = $sFilter;
		$sSql = $product_images->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$product_images->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $product_images;
		$product_images->id->setDbValue($rs->fields('id'));
		$product_images->image->Upload->DbValue = $rs->fields('image');
		$product_images->name->setDbValue($rs->fields('name'));
		$product_images->name_arabic->setDbValue($rs->fields('name_arabic'));
		$product_images->product_id->setDbValue($rs->fields('product_id'));
		$product_images->order->setDbValue($rs->fields('order'));
		$product_images->active->setDbValue($rs->fields('active'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $product_images;

		// Call Row_Rendering event
		$product_images->Row_Rendering();

		// Common render codes for all row types
		// id

		$product_images->id->CellCssStyle = "";
		$product_images->id->CellCssClass = "";

		// image
		$product_images->image->CellCssStyle = "";
		$product_images->image->CellCssClass = "";

		// name
		$product_images->name->CellCssStyle = "";
		$product_images->name->CellCssClass = "";

		// name_arabic
		$product_images->name_arabic->CellCssStyle = "";
		$product_images->name_arabic->CellCssClass = "";

		// product_id
		$product_images->product_id->CellCssStyle = "";
		$product_images->product_id->CellCssClass = "";

		// order
		$product_images->order->CellCssStyle = "";
		$product_images->order->CellCssClass = "";

		// active
		$product_images->active->CellCssStyle = "";
		$product_images->active->CellCssClass = "";
		if ($product_images->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$product_images->id->ViewValue = $product_images->id->CurrentValue;
			$product_images->id->CssStyle = "";
			$product_images->id->CssClass = "";
			$product_images->id->ViewCustomAttributes = "";

			// image
			if (!is_null($product_images->image->Upload->DbValue)) {
				$product_images->image->ViewValue = $product_images->image->Upload->DbValue;
				$product_images->image->ImageWidth = 100;
				$product_images->image->ImageHeight = 0;
				$product_images->image->ImageAlt = "";
			} else {
				$product_images->image->ViewValue = "";
			}
			$product_images->image->CssStyle = "";
			$product_images->image->CssClass = "";
			$product_images->image->ViewCustomAttributes = "";

			// name
			$product_images->name->ViewValue = $product_images->name->CurrentValue;
			$product_images->name->CssStyle = "";
			$product_images->name->CssClass = "";
			$product_images->name->ViewCustomAttributes = "";

			// name_arabic
			$product_images->name_arabic->ViewValue = $product_images->name_arabic->CurrentValue;
			$product_images->name_arabic->CssStyle = "";
			$product_images->name_arabic->CssClass = "";
			$product_images->name_arabic->ViewCustomAttributes = "";

			// product_id
			if (strval($product_images->product_id->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `name`, `name_arabic` FROM `products` WHERE `id` = " . ew_AdjustSql($product_images->product_id->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$product_images->product_id->ViewValue = $rswrk->fields('name');
					$product_images->product_id->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('name_arabic');
					$rswrk->Close();
				} else {
					$product_images->product_id->ViewValue = $product_images->product_id->CurrentValue;
				}
			} else {
				$product_images->product_id->ViewValue = NULL;
			}
			$product_images->product_id->CssStyle = "";
			$product_images->product_id->CssClass = "";
			$product_images->product_id->ViewCustomAttributes = "";

			// order
			$product_images->order->ViewValue = $product_images->order->CurrentValue;
			$product_images->order->CssStyle = "";
			$product_images->order->CssClass = "";
			$product_images->order->ViewCustomAttributes = "";

			// active
			if (strval($product_images->active->CurrentValue) <> "") {
				switch ($product_images->active->CurrentValue) {
					case "0":
						$product_images->active->ViewValue = "No";
						break;
					case "1":
						$product_images->active->ViewValue = "Yes";
						break;
					default:
						$product_images->active->ViewValue = $product_images->active->CurrentValue;
				}
			} else {
				$product_images->active->ViewValue = NULL;
			}
			$product_images->active->CssStyle = "";
			$product_images->active->CssClass = "";
			$product_images->active->ViewCustomAttributes = "";

			// id
			$product_images->id->HrefValue = "";

			// image
			$product_images->image->HrefValue = "";

			// name
			$product_images->name->HrefValue = "";

			// name_arabic
			$product_images->name_arabic->HrefValue = "";

			// product_id
			$product_images->product_id->HrefValue = "";

			// order
			$product_images->order->HrefValue = "";

			// active
			$product_images->active->HrefValue = "";
		}

		// Call Row Rendered event
		$product_images->Row_Rendered();
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
