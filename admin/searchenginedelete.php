<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "searchengineinfo.php" ?>
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
$searchengine_delete = new csearchengine_delete();
$Page =& $searchengine_delete;

// Page init processing
$searchengine_delete->Page_Init();

// Page main processing
$searchengine_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var searchengine_delete = new ew_Page("searchengine_delete");

// page properties
searchengine_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = searchengine_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
searchengine_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
searchengine_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
searchengine_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
searchengine_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
searchengine_delete.ShowHighlightText = "Show highlight"; 
searchengine_delete.HideHighlightText = "Hide highlight";

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
$rs = $searchengine_delete->LoadRecordset();
$searchengine_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($searchengine_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$searchengine_delete->Page_Terminate("searchenginelist.php"); // Return to list
}
?>
<p><span class="phpmaker">Delete From TABLE: searchengine<br><br>
<a href="<?php echo $searchengine->getReturnUrl() ?>">Go Back</a></span></p>
<?php $searchengine_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="searchengine">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($searchengine_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $searchengine->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">id</td>
		<td valign="top">page</td>
		<td valign="top">title</td>
	</tr>
	</thead>
	<tbody>
<?php
$searchengine_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$searchengine_delete->lRecCnt++;

	// Set row properties
	$searchengine->CssClass = "";
	$searchengine->CssStyle = "";
	$searchengine->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$searchengine_delete->LoadRowValues($rs);

	// Render row
	$searchengine_delete->RenderRow();
?>
	<tr<?php echo $searchengine->RowAttributes() ?>>
		<td<?php echo $searchengine->id->CellAttributes() ?>>
<div<?php echo $searchengine->id->ViewAttributes() ?>><?php echo $searchengine->id->ListViewValue() ?></div></td>
		<td<?php echo $searchengine->zpage->CellAttributes() ?>>
<div<?php echo $searchengine->zpage->ViewAttributes() ?>><?php echo $searchengine->zpage->ListViewValue() ?></div></td>
		<td<?php echo $searchengine->title->CellAttributes() ?>>
<div<?php echo $searchengine->title->ViewAttributes() ?>><?php echo $searchengine->title->ListViewValue() ?></div></td>
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
$searchengine_delete->Page_Terminate();
?>
<?php

//
// Page Class
//
class csearchengine_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'searchengine';

	// Page Object Name
	var $PageObjName = 'searchengine_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $searchengine;
		if ($searchengine->UseTokenInUrl) $PageUrl .= "t=" . $searchengine->TableVar . "&"; // add page token
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
		global $objForm, $searchengine;
		if ($searchengine->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($searchengine->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($searchengine->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function csearchengine_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["searchengine"] = new csearchengine();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'searchengine', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $searchengine;
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
		global $searchengine;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$searchengine->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($searchengine->id->QueryStringValue))
				$this->Page_Terminate("searchenginelist.php"); // Prevent SQL injection, exit
			$sKey .= $searchengine->id->QueryStringValue;
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
			$this->Page_Terminate("searchenginelist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("searchenginelist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in searchengine class, searchengineinfo.php

		$searchengine->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$searchengine->CurrentAction = $_POST["a_delete"];
		} else {
			$searchengine->CurrentAction = "D"; // Delete record directly
		}
		switch ($searchengine->CurrentAction) {
			case "D": // Delete
				$searchengine->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($searchengine->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $searchengine;
		$DeleteRows = TRUE;
		$sWrkFilter = $searchengine->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in searchengine class, searchengineinfo.php

		$searchengine->CurrentFilter = $sWrkFilter;
		$sSql = $searchengine->SQL();
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
				$DeleteRows = $searchengine->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($searchengine->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($searchengine->CancelMessage <> "") {
				$this->setMessage($searchengine->CancelMessage);
				$searchengine->CancelMessage = "";
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
				$searchengine->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $searchengine;

		// Call Recordset Selecting event
		$searchengine->Recordset_Selecting($searchengine->CurrentFilter);

		// Load list page SQL
		$sSql = $searchengine->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$searchengine->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $searchengine;
		$sFilter = $searchengine->KeyFilter();

		// Call Row Selecting event
		$searchengine->Row_Selecting($sFilter);

		// Load sql based on filter
		$searchengine->CurrentFilter = $sFilter;
		$sSql = $searchengine->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$searchengine->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $searchengine;
		$searchengine->id->setDbValue($rs->fields('id'));
		$searchengine->zpage->setDbValue($rs->fields('page'));
		$searchengine->description->setDbValue($rs->fields('description'));
		$searchengine->keywords->setDbValue($rs->fields('keywords'));
		$searchengine->title->setDbValue($rs->fields('title'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $searchengine;

		// Call Row_Rendering event
		$searchengine->Row_Rendering();

		// Common render codes for all row types
		// id

		$searchengine->id->CellCssStyle = "";
		$searchengine->id->CellCssClass = "";

		// page
		$searchengine->zpage->CellCssStyle = "";
		$searchengine->zpage->CellCssClass = "";

		// title
		$searchengine->title->CellCssStyle = "";
		$searchengine->title->CellCssClass = "";
		if ($searchengine->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$searchengine->id->ViewValue = $searchengine->id->CurrentValue;
			$searchengine->id->CssStyle = "";
			$searchengine->id->CssClass = "";
			$searchengine->id->ViewCustomAttributes = "";

			// page
			$searchengine->zpage->ViewValue = $searchengine->zpage->CurrentValue;
			$searchengine->zpage->CssStyle = "";
			$searchengine->zpage->CssClass = "";
			$searchengine->zpage->ViewCustomAttributes = "";

			// description
			$searchengine->description->ViewValue = $searchengine->description->CurrentValue;
			$searchengine->description->CssStyle = "";
			$searchengine->description->CssClass = "";
			$searchengine->description->ViewCustomAttributes = "";

			// keywords
			$searchengine->keywords->ViewValue = $searchengine->keywords->CurrentValue;
			$searchengine->keywords->CssStyle = "";
			$searchengine->keywords->CssClass = "";
			$searchengine->keywords->ViewCustomAttributes = "";

			// title
			$searchengine->title->ViewValue = $searchengine->title->CurrentValue;
			$searchengine->title->CssStyle = "";
			$searchengine->title->CssClass = "";
			$searchengine->title->ViewCustomAttributes = "";

			// id
			$searchengine->id->HrefValue = "";

			// page
			$searchengine->zpage->HrefValue = "";

			// title
			$searchengine->title->HrefValue = "";
		}

		// Call Row Rendered event
		$searchengine->Row_Rendered();
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
