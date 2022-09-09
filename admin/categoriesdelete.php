<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
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
$categories_delete = new ccategories_delete();
$Page =& $categories_delete;

// Page init processing
$categories_delete->Page_Init();

// Page main processing
$categories_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var categories_delete = new ew_Page("categories_delete");

// page properties
categories_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = categories_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
categories_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
categories_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
categories_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
categories_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
categories_delete.ShowHighlightText = "Show highlight"; 
categories_delete.HideHighlightText = "Hide highlight";

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
$rs = $categories_delete->LoadRecordset();
$categories_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($categories_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$categories_delete->Page_Terminate("categorieslist.php"); // Return to list
}
?>
<p><span class="phpmaker">Delete From TABLE: categories<br><br>
<a href="<?php echo $categories->getReturnUrl() ?>">Go Back</a></span></p>
<?php $categories_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="categories">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($categories_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $categories->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">id</td>
		<td valign="top">name</td>
		<td valign="top">name arabic</td>
		<td valign="top">order</td>
		<td valign="top">active</td>
	</tr>
	</thead>
	<tbody>
<?php
$categories_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$categories_delete->lRecCnt++;

	// Set row properties
	$categories->CssClass = "";
	$categories->CssStyle = "";
	$categories->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$categories_delete->LoadRowValues($rs);

	// Render row
	$categories_delete->RenderRow();
?>
	<tr<?php echo $categories->RowAttributes() ?>>
		<td<?php echo $categories->id->CellAttributes() ?>>
<div<?php echo $categories->id->ViewAttributes() ?>><?php echo $categories->id->ListViewValue() ?></div></td>
		<td<?php echo $categories->name->CellAttributes() ?>>
<div<?php echo $categories->name->ViewAttributes() ?>><?php echo $categories->name->ListViewValue() ?></div></td>
		<td<?php echo $categories->name_arabic->CellAttributes() ?>>
<div<?php echo $categories->name_arabic->ViewAttributes() ?>><?php echo $categories->name_arabic->ListViewValue() ?></div></td>
		<td<?php echo $categories->order->CellAttributes() ?>>
<div<?php echo $categories->order->ViewAttributes() ?>><?php echo $categories->order->ListViewValue() ?></div></td>
		<td<?php echo $categories->active->CellAttributes() ?>>
<div<?php echo $categories->active->ViewAttributes() ?>><?php echo $categories->active->ListViewValue() ?></div></td>
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
$categories_delete->Page_Terminate();
?>
<?php

//
// Page Class
//
class ccategories_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'categories';

	// Page Object Name
	var $PageObjName = 'categories_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $categories;
		if ($categories->UseTokenInUrl) $PageUrl .= "t=" . $categories->TableVar . "&"; // add page token
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
		global $objForm, $categories;
		if ($categories->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($categories->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($categories->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccategories_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["categories"] = new ccategories();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'categories', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $categories;
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
		global $categories;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$categories->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($categories->id->QueryStringValue))
				$this->Page_Terminate("categorieslist.php"); // Prevent SQL injection, exit
			$sKey .= $categories->id->QueryStringValue;
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
			$this->Page_Terminate("categorieslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("categorieslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in categories class, categoriesinfo.php

		$categories->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$categories->CurrentAction = $_POST["a_delete"];
		} else {
			$categories->CurrentAction = "D"; // Delete record directly
		}
		switch ($categories->CurrentAction) {
			case "D": // Delete
				$categories->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($categories->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $categories;
		$DeleteRows = TRUE;
		$sWrkFilter = $categories->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in categories class, categoriesinfo.php

		$categories->CurrentFilter = $sWrkFilter;
		$sSql = $categories->SQL();
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
				$DeleteRows = $categories->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($categories->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($categories->CancelMessage <> "") {
				$this->setMessage($categories->CancelMessage);
				$categories->CancelMessage = "";
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
				$categories->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $categories;

		// Call Recordset Selecting event
		$categories->Recordset_Selecting($categories->CurrentFilter);

		// Load list page SQL
		$sSql = $categories->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$categories->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $categories;
		$sFilter = $categories->KeyFilter();

		// Call Row Selecting event
		$categories->Row_Selecting($sFilter);

		// Load sql based on filter
		$categories->CurrentFilter = $sFilter;
		$sSql = $categories->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$categories->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $categories;
		$categories->id->setDbValue($rs->fields('id'));
		$categories->name->setDbValue($rs->fields('name'));
		$categories->name_arabic->setDbValue($rs->fields('name_arabic'));
		$categories->order->setDbValue($rs->fields('order'));
		$categories->active->setDbValue($rs->fields('active'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $categories;

		// Call Row_Rendering event
		$categories->Row_Rendering();

		// Common render codes for all row types
		// id

		$categories->id->CellCssStyle = "";
		$categories->id->CellCssClass = "";

		// name
		$categories->name->CellCssStyle = "";
		$categories->name->CellCssClass = "";

		// name_arabic
		$categories->name_arabic->CellCssStyle = "";
		$categories->name_arabic->CellCssClass = "";

		// order
		$categories->order->CellCssStyle = "";
		$categories->order->CellCssClass = "";

		// active
		$categories->active->CellCssStyle = "";
		$categories->active->CellCssClass = "";
		if ($categories->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$categories->id->ViewValue = $categories->id->CurrentValue;
			$categories->id->CssStyle = "";
			$categories->id->CssClass = "";
			$categories->id->ViewCustomAttributes = "";

			// name
			$categories->name->ViewValue = $categories->name->CurrentValue;
			$categories->name->CssStyle = "";
			$categories->name->CssClass = "";
			$categories->name->ViewCustomAttributes = "";

			// name_arabic
			$categories->name_arabic->ViewValue = $categories->name_arabic->CurrentValue;
			$categories->name_arabic->CssStyle = "";
			$categories->name_arabic->CssClass = "";
			$categories->name_arabic->ViewCustomAttributes = "";

			// order
			$categories->order->ViewValue = $categories->order->CurrentValue;
			$categories->order->CssStyle = "";
			$categories->order->CssClass = "";
			$categories->order->ViewCustomAttributes = "";

			// active
			if (strval($categories->active->CurrentValue) <> "") {
				switch ($categories->active->CurrentValue) {
					case "0":
						$categories->active->ViewValue = "No";
						break;
					case "1":
						$categories->active->ViewValue = "Yes";
						break;
					default:
						$categories->active->ViewValue = $categories->active->CurrentValue;
				}
			} else {
				$categories->active->ViewValue = NULL;
			}
			$categories->active->CssStyle = "";
			$categories->active->CssClass = "";
			$categories->active->ViewCustomAttributes = "";

			// id
			$categories->id->HrefValue = "";

			// name
			$categories->name->HrefValue = "";

			// name_arabic
			$categories->name_arabic->HrefValue = "";

			// order
			$categories->order->HrefValue = "";

			// active
			$categories->active->HrefValue = "";
		}

		// Call Row Rendered event
		$categories->Row_Rendered();
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
