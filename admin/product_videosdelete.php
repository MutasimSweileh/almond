<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "product_videosinfo.php" ?>
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
$product_videos_delete = new cproduct_videos_delete();
$Page =& $product_videos_delete;

// Page init processing
$product_videos_delete->Page_Init();

// Page main processing
$product_videos_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var product_videos_delete = new ew_Page("product_videos_delete");

// page properties
product_videos_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = product_videos_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
product_videos_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
product_videos_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
product_videos_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
product_videos_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
product_videos_delete.ShowHighlightText = "Show highlight"; 
product_videos_delete.HideHighlightText = "Hide highlight";

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
$rs = $product_videos_delete->LoadRecordset();
$product_videos_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($product_videos_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$product_videos_delete->Page_Terminate("product_videoslist.php"); // Return to list
}
?>
<p><span class="phpmaker">Delete From TABLE: product videos<br><br>
<a href="<?php echo $product_videos->getReturnUrl() ?>">Go Back</a></span></p>
<?php $product_videos_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="product_videos">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($product_videos_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $product_videos->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">id</td>
		<td valign="top">video</td>
		<td valign="top">product</td>
		<td valign="top">order</td>
		<td valign="top">active</td>
	</tr>
	</thead>
	<tbody>
<?php
$product_videos_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$product_videos_delete->lRecCnt++;

	// Set row properties
	$product_videos->CssClass = "";
	$product_videos->CssStyle = "";
	$product_videos->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$product_videos_delete->LoadRowValues($rs);

	// Render row
	$product_videos_delete->RenderRow();
?>
	<tr<?php echo $product_videos->RowAttributes() ?>>
		<td<?php echo $product_videos->id->CellAttributes() ?>>
<div<?php echo $product_videos->id->ViewAttributes() ?>><?php echo $product_videos->id->ListViewValue() ?></div></td>
		<td<?php echo $product_videos->video->CellAttributes() ?>>
<div<?php echo $product_videos->video->ViewAttributes() ?>><?php echo $product_videos->video->ListViewValue() ?></div></td>
		<td<?php echo $product_videos->product_id->CellAttributes() ?>>
<div<?php echo $product_videos->product_id->ViewAttributes() ?>><?php echo $product_videos->product_id->ListViewValue() ?></div></td>
		<td<?php echo $product_videos->order->CellAttributes() ?>>
<div<?php echo $product_videos->order->ViewAttributes() ?>><?php echo $product_videos->order->ListViewValue() ?></div></td>
		<td<?php echo $product_videos->active->CellAttributes() ?>>
<div<?php echo $product_videos->active->ViewAttributes() ?>><?php echo $product_videos->active->ListViewValue() ?></div></td>
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
$product_videos_delete->Page_Terminate();
?>
<?php

//
// Page Class
//
class cproduct_videos_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'product_videos';

	// Page Object Name
	var $PageObjName = 'product_videos_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $product_videos;
		if ($product_videos->UseTokenInUrl) $PageUrl .= "t=" . $product_videos->TableVar . "&"; // add page token
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
		global $objForm, $product_videos;
		if ($product_videos->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($product_videos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($product_videos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cproduct_videos_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["product_videos"] = new cproduct_videos();

		// Initialize other table object
		$GLOBALS['products'] = new cproducts();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'product_videos', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $product_videos;
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
		global $product_videos;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$product_videos->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($product_videos->id->QueryStringValue))
				$this->Page_Terminate("product_videoslist.php"); // Prevent SQL injection, exit
			$sKey .= $product_videos->id->QueryStringValue;
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
			$this->Page_Terminate("product_videoslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("product_videoslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in product_videos class, product_videosinfo.php

		$product_videos->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$product_videos->CurrentAction = $_POST["a_delete"];
		} else {
			$product_videos->CurrentAction = "D"; // Delete record directly
		}
		switch ($product_videos->CurrentAction) {
			case "D": // Delete
				$product_videos->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($product_videos->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $product_videos;
		$DeleteRows = TRUE;
		$sWrkFilter = $product_videos->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in product_videos class, product_videosinfo.php

		$product_videos->CurrentFilter = $sWrkFilter;
		$sSql = $product_videos->SQL();
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
				$DeleteRows = $product_videos->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($product_videos->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($product_videos->CancelMessage <> "") {
				$this->setMessage($product_videos->CancelMessage);
				$product_videos->CancelMessage = "";
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
				$product_videos->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $product_videos;

		// Call Recordset Selecting event
		$product_videos->Recordset_Selecting($product_videos->CurrentFilter);

		// Load list page SQL
		$sSql = $product_videos->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$product_videos->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $product_videos;
		$sFilter = $product_videos->KeyFilter();

		// Call Row Selecting event
		$product_videos->Row_Selecting($sFilter);

		// Load sql based on filter
		$product_videos->CurrentFilter = $sFilter;
		$sSql = $product_videos->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$product_videos->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $product_videos;
		$product_videos->id->setDbValue($rs->fields('id'));
		$product_videos->video->setDbValue($rs->fields('video'));
		$product_videos->product_id->setDbValue($rs->fields('product_id'));
		$product_videos->order->setDbValue($rs->fields('order'));
		$product_videos->active->setDbValue($rs->fields('active'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $product_videos;

		// Call Row_Rendering event
		$product_videos->Row_Rendering();

		// Common render codes for all row types
		// id

		$product_videos->id->CellCssStyle = "";
		$product_videos->id->CellCssClass = "";

		// video
		$product_videos->video->CellCssStyle = "";
		$product_videos->video->CellCssClass = "";

		// product_id
		$product_videos->product_id->CellCssStyle = "";
		$product_videos->product_id->CellCssClass = "";

		// order
		$product_videos->order->CellCssStyle = "";
		$product_videos->order->CellCssClass = "";

		// active
		$product_videos->active->CellCssStyle = "";
		$product_videos->active->CellCssClass = "";
		if ($product_videos->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$product_videos->id->ViewValue = $product_videos->id->CurrentValue;
			$product_videos->id->CssStyle = "";
			$product_videos->id->CssClass = "";
			$product_videos->id->ViewCustomAttributes = "";

			// video
			$product_videos->video->ViewValue = $product_videos->video->CurrentValue;
			$product_videos->video->CssStyle = "";
			$product_videos->video->CssClass = "";
			$product_videos->video->ViewCustomAttributes = "";

			// product_id
			if (strval($product_videos->product_id->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `name`, `name_arabic` FROM `products` WHERE `id` = " . ew_AdjustSql($product_videos->product_id->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$product_videos->product_id->ViewValue = $rswrk->fields('name');
					$product_videos->product_id->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('name_arabic');
					$rswrk->Close();
				} else {
					$product_videos->product_id->ViewValue = $product_videos->product_id->CurrentValue;
				}
			} else {
				$product_videos->product_id->ViewValue = NULL;
			}
			$product_videos->product_id->CssStyle = "";
			$product_videos->product_id->CssClass = "";
			$product_videos->product_id->ViewCustomAttributes = "";

			// order
			$product_videos->order->ViewValue = $product_videos->order->CurrentValue;
			$product_videos->order->CssStyle = "";
			$product_videos->order->CssClass = "";
			$product_videos->order->ViewCustomAttributes = "";

			// active
			if (strval($product_videos->active->CurrentValue) <> "") {
				switch ($product_videos->active->CurrentValue) {
					case "0":
						$product_videos->active->ViewValue = "No";
						break;
					case "1":
						$product_videos->active->ViewValue = "Yes";
						break;
					default:
						$product_videos->active->ViewValue = $product_videos->active->CurrentValue;
				}
			} else {
				$product_videos->active->ViewValue = NULL;
			}
			$product_videos->active->CssStyle = "";
			$product_videos->active->CssClass = "";
			$product_videos->active->ViewCustomAttributes = "";

			// id
			$product_videos->id->HrefValue = "";

			// video
			$product_videos->video->HrefValue = "";

			// product_id
			$product_videos->product_id->HrefValue = "";

			// order
			$product_videos->order->HrefValue = "";

			// active
			$product_videos->active->HrefValue = "";
		}

		// Call Row Rendered event
		$product_videos->Row_Rendered();
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
