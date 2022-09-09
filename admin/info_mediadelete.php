<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "info_mediainfo.php" ?>
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
$info_media_delete = new cinfo_media_delete();
$Page =& $info_media_delete;

// Page init processing
$info_media_delete->Page_Init();

// Page main processing
$info_media_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var info_media_delete = new ew_Page("info_media_delete");

// page properties
info_media_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = info_media_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
info_media_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
info_media_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
info_media_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
info_media_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
info_media_delete.ShowHighlightText = "Show highlight"; 
info_media_delete.HideHighlightText = "Hide highlight";

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
$rs = $info_media_delete->LoadRecordset();
$info_media_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($info_media_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$info_media_delete->Page_Terminate("info_medialist.php"); // Return to list
}
?>
<p><span class="phpmaker">Delete From TABLE: info media<br><br>
<a href="<?php echo $info_media->getReturnUrl() ?>">Go Back</a></span></p>
<?php $info_media_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="info_media">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($info_media_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $info_media->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">id</td>
		<td valign="top">code</td>
	</tr>
	</thead>
	<tbody>
<?php
$info_media_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$info_media_delete->lRecCnt++;

	// Set row properties
	$info_media->CssClass = "";
	$info_media->CssStyle = "";
	$info_media->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$info_media_delete->LoadRowValues($rs);

	// Render row
	$info_media_delete->RenderRow();
?>
	<tr<?php echo $info_media->RowAttributes() ?>>
		<td<?php echo $info_media->id->CellAttributes() ?>>
<div<?php echo $info_media->id->ViewAttributes() ?>><?php echo $info_media->id->ListViewValue() ?></div></td>
		<td<?php echo $info_media->code->CellAttributes() ?>>
<div<?php echo $info_media->code->ViewAttributes() ?>><?php echo $info_media->code->ListViewValue() ?></div></td>
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
$info_media_delete->Page_Terminate();
?>
<?php

//
// Page Class
//
class cinfo_media_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'info_media';

	// Page Object Name
	var $PageObjName = 'info_media_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $info_media;
		if ($info_media->UseTokenInUrl) $PageUrl .= "t=" . $info_media->TableVar . "&"; // add page token
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
		global $objForm, $info_media;
		if ($info_media->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($info_media->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($info_media->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cinfo_media_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["info_media"] = new cinfo_media();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'info_media', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $info_media;
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
		global $info_media;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$info_media->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($info_media->id->QueryStringValue))
				$this->Page_Terminate("info_medialist.php"); // Prevent SQL injection, exit
			$sKey .= $info_media->id->QueryStringValue;
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
			$this->Page_Terminate("info_medialist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("info_medialist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in info_media class, info_mediainfo.php

		$info_media->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$info_media->CurrentAction = $_POST["a_delete"];
		} else {
			$info_media->CurrentAction = "D"; // Delete record directly
		}
		switch ($info_media->CurrentAction) {
			case "D": // Delete
				$info_media->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($info_media->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $info_media;
		$DeleteRows = TRUE;
		$sWrkFilter = $info_media->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in info_media class, info_mediainfo.php

		$info_media->CurrentFilter = $sWrkFilter;
		$sSql = $info_media->SQL();
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
				$DeleteRows = $info_media->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($info_media->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($info_media->CancelMessage <> "") {
				$this->setMessage($info_media->CancelMessage);
				$info_media->CancelMessage = "";
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
				$info_media->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $info_media;

		// Call Recordset Selecting event
		$info_media->Recordset_Selecting($info_media->CurrentFilter);

		// Load list page SQL
		$sSql = $info_media->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$info_media->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $info_media;
		$sFilter = $info_media->KeyFilter();

		// Call Row Selecting event
		$info_media->Row_Selecting($sFilter);

		// Load sql based on filter
		$info_media->CurrentFilter = $sFilter;
		$sSql = $info_media->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$info_media->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $info_media;
		$info_media->id->setDbValue($rs->fields('id'));
		$info_media->code->setDbValue($rs->fields('code'));
		$info_media->link->setDbValue($rs->fields('link'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $info_media;

		// Call Row_Rendering event
		$info_media->Row_Rendering();

		// Common render codes for all row types
		// id

		$info_media->id->CellCssStyle = "";
		$info_media->id->CellCssClass = "";

		// code
		$info_media->code->CellCssStyle = "";
		$info_media->code->CellCssClass = "";
		if ($info_media->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$info_media->id->ViewValue = $info_media->id->CurrentValue;
			$info_media->id->CssStyle = "";
			$info_media->id->CssClass = "";
			$info_media->id->ViewCustomAttributes = "";

			// code
			$info_media->code->ViewValue = $info_media->code->CurrentValue;
			$info_media->code->CssStyle = "";
			$info_media->code->CssClass = "";
			$info_media->code->ViewCustomAttributes = "";

			// link
			$info_media->link->ViewValue = $info_media->link->CurrentValue;
			$info_media->link->CssStyle = "";
			$info_media->link->CssClass = "";
			$info_media->link->ViewCustomAttributes = "";

			// id
			$info_media->id->HrefValue = "";

			// code
			$info_media->code->HrefValue = "";
		}

		// Call Row Rendered event
		$info_media->Row_Rendered();
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
