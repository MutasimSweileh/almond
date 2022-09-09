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
$about_item_delete = new cabout_item_delete();
$Page =& $about_item_delete;

// Page init processing
$about_item_delete->Page_Init();

// Page main processing
$about_item_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var about_item_delete = new ew_Page("about_item_delete");

// page properties
about_item_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = about_item_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
about_item_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
about_item_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
about_item_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
about_item_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
about_item_delete.ShowHighlightText = "Show highlight"; 
about_item_delete.HideHighlightText = "Hide highlight";

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
$rs = $about_item_delete->LoadRecordset();
$about_item_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($about_item_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$about_item_delete->Page_Terminate("about_itemlist.php"); // Return to list
}
?>
<p><span class="phpmaker">Delete From TABLE: about item<br><br>
<a href="<?php echo $about_item->getReturnUrl() ?>">Go Back</a></span></p>
<?php $about_item_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="about_item">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($about_item_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $about_item->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">id</td>
		<td valign="top">title</td>
		<td valign="top">title arabic</td>
		<td valign="top">count</td>
		<td valign="top">order</td>
		<td valign="top">active</td>
	</tr>
	</thead>
	<tbody>
<?php
$about_item_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$about_item_delete->lRecCnt++;

	// Set row properties
	$about_item->CssClass = "";
	$about_item->CssStyle = "";
	$about_item->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$about_item_delete->LoadRowValues($rs);

	// Render row
	$about_item_delete->RenderRow();
?>
	<tr<?php echo $about_item->RowAttributes() ?>>
		<td<?php echo $about_item->id->CellAttributes() ?>>
<div<?php echo $about_item->id->ViewAttributes() ?>><?php echo $about_item->id->ListViewValue() ?></div></td>
		<td<?php echo $about_item->title->CellAttributes() ?>>
<div<?php echo $about_item->title->ViewAttributes() ?>><?php echo $about_item->title->ListViewValue() ?></div></td>
		<td<?php echo $about_item->title_arabic->CellAttributes() ?>>
<div<?php echo $about_item->title_arabic->ViewAttributes() ?>><?php echo $about_item->title_arabic->ListViewValue() ?></div></td>
		<td<?php echo $about_item->count->CellAttributes() ?>>
<div<?php echo $about_item->count->ViewAttributes() ?>><?php echo $about_item->count->ListViewValue() ?></div></td>
		<td<?php echo $about_item->order->CellAttributes() ?>>
<div<?php echo $about_item->order->ViewAttributes() ?>><?php echo $about_item->order->ListViewValue() ?></div></td>
		<td<?php echo $about_item->active->CellAttributes() ?>>
<div<?php echo $about_item->active->ViewAttributes() ?>><?php echo $about_item->active->ListViewValue() ?></div></td>
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
$about_item_delete->Page_Terminate();
?>
<?php

//
// Page Class
//
class cabout_item_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'about_item';

	// Page Object Name
	var $PageObjName = 'about_item_delete';

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
	function cabout_item_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["about_item"] = new cabout_item();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs;
	var $lRecCnt;
	var $arRecKeys = array();

	// Page main processing
	function Page_Main() {
		global $about_item;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$about_item->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($about_item->id->QueryStringValue))
				$this->Page_Terminate("about_itemlist.php"); // Prevent SQL injection, exit
			$sKey .= $about_item->id->QueryStringValue;
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
			$this->Page_Terminate("about_itemlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("about_itemlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in about_item class, about_iteminfo.php

		$about_item->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$about_item->CurrentAction = $_POST["a_delete"];
		} else {
			$about_item->CurrentAction = "D"; // Delete record directly
		}
		switch ($about_item->CurrentAction) {
			case "D": // Delete
				$about_item->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($about_item->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $about_item;
		$DeleteRows = TRUE;
		$sWrkFilter = $about_item->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in about_item class, about_iteminfo.php

		$about_item->CurrentFilter = $sWrkFilter;
		$sSql = $about_item->SQL();
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
				$DeleteRows = $about_item->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($about_item->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($about_item->CancelMessage <> "") {
				$this->setMessage($about_item->CancelMessage);
				$about_item->CancelMessage = "";
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
				$about_item->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $about_item;

		// Call Recordset Selecting event
		$about_item->Recordset_Selecting($about_item->CurrentFilter);

		// Load list page SQL
		$sSql = $about_item->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$about_item->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $about_item;
		$sFilter = $about_item->KeyFilter();

		// Call Row Selecting event
		$about_item->Row_Selecting($sFilter);

		// Load sql based on filter
		$about_item->CurrentFilter = $sFilter;
		$sSql = $about_item->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$about_item->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $about_item;
		$about_item->id->setDbValue($rs->fields('id'));
		$about_item->title->setDbValue($rs->fields('title'));
		$about_item->title_arabic->setDbValue($rs->fields('title_arabic'));
		$about_item->text->setDbValue($rs->fields('text'));
		$about_item->text_arabic->setDbValue($rs->fields('text_arabic'));
		$about_item->count->setDbValue($rs->fields('count'));
		$about_item->order->setDbValue($rs->fields('order'));
		$about_item->active->setDbValue($rs->fields('active'));
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

			// count
			$about_item->count->HrefValue = "";

			// order
			$about_item->order->HrefValue = "";

			// active
			$about_item->active->HrefValue = "";
		}

		// Call Row Rendered event
		$about_item->Row_Rendered();
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
