<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "sliderinfo.php" ?>
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
$slider_delete = new cslider_delete();
$Page =& $slider_delete;

// Page init processing
$slider_delete->Page_Init();

// Page main processing
$slider_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var slider_delete = new ew_Page("slider_delete");

// page properties
slider_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = slider_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
slider_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
slider_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
slider_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
slider_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
slider_delete.ShowHighlightText = "Show highlight"; 
slider_delete.HideHighlightText = "Hide highlight";

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
$rs = $slider_delete->LoadRecordset();
$slider_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($slider_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$slider_delete->Page_Terminate("sliderlist.php"); // Return to list
}
?>
<p><span class="phpmaker">Delete From TABLE: slider<br><br>
<a href="<?php echo $slider->getReturnUrl() ?>">Go Back</a></span></p>
<?php $slider_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="slider">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($slider_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $slider->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">id</td>
		<td valign="top">image</td>
		<td valign="top">order</td>
		<td valign="top">active</td>
	</tr>
	</thead>
	<tbody>
<?php
$slider_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$slider_delete->lRecCnt++;

	// Set row properties
	$slider->CssClass = "";
	$slider->CssStyle = "";
	$slider->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$slider_delete->LoadRowValues($rs);

	// Render row
	$slider_delete->RenderRow();
?>
	<tr<?php echo $slider->RowAttributes() ?>>
		<td<?php echo $slider->id->CellAttributes() ?>>
<div<?php echo $slider->id->ViewAttributes() ?>><?php echo $slider->id->ListViewValue() ?></div></td>
		<td<?php echo $slider->image->CellAttributes() ?>>
<?php if ($slider->image->HrefValue <> "") { ?>
<?php if (!is_null($slider->image->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $slider->image->Upload->DbValue ?>" border=0<?php echo $slider->image->ViewAttributes() ?>>
<?php } elseif (!in_array($slider->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($slider->image->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $slider->image->Upload->DbValue ?>" border=0<?php echo $slider->image->ViewAttributes() ?>>
<?php } elseif (!in_array($slider->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
		<td<?php echo $slider->order->CellAttributes() ?>>
<div<?php echo $slider->order->ViewAttributes() ?>><?php echo $slider->order->ListViewValue() ?></div></td>
		<td<?php echo $slider->active->CellAttributes() ?>>
<div<?php echo $slider->active->ViewAttributes() ?>><?php echo $slider->active->ListViewValue() ?></div></td>
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
$slider_delete->Page_Terminate();
?>
<?php

//
// Page Class
//
class cslider_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'slider';

	// Page Object Name
	var $PageObjName = 'slider_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $slider;
		if ($slider->UseTokenInUrl) $PageUrl .= "t=" . $slider->TableVar . "&"; // add page token
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
		global $objForm, $slider;
		if ($slider->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($slider->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($slider->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cslider_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["slider"] = new cslider();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'slider', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $slider;
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
		global $slider;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$slider->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($slider->id->QueryStringValue))
				$this->Page_Terminate("sliderlist.php"); // Prevent SQL injection, exit
			$sKey .= $slider->id->QueryStringValue;
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
			$this->Page_Terminate("sliderlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("sliderlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in slider class, sliderinfo.php

		$slider->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$slider->CurrentAction = $_POST["a_delete"];
		} else {
			$slider->CurrentAction = "D"; // Delete record directly
		}
		switch ($slider->CurrentAction) {
			case "D": // Delete
				$slider->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($slider->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $slider;
		$DeleteRows = TRUE;
		$sWrkFilter = $slider->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in slider class, sliderinfo.php

		$slider->CurrentFilter = $sWrkFilter;
		$sSql = $slider->SQL();
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
				$DeleteRows = $slider->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($slider->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($slider->CancelMessage <> "") {
				$this->setMessage($slider->CancelMessage);
				$slider->CancelMessage = "";
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
				$slider->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $slider;

		// Call Recordset Selecting event
		$slider->Recordset_Selecting($slider->CurrentFilter);

		// Load list page SQL
		$sSql = $slider->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$slider->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $slider;
		$sFilter = $slider->KeyFilter();

		// Call Row Selecting event
		$slider->Row_Selecting($sFilter);

		// Load sql based on filter
		$slider->CurrentFilter = $sFilter;
		$sSql = $slider->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$slider->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $slider;
		$slider->id->setDbValue($rs->fields('id'));
		$slider->image->Upload->DbValue = $rs->fields('image');
		$slider->order->setDbValue($rs->fields('order'));
		$slider->active->setDbValue($rs->fields('active'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $slider;

		// Call Row_Rendering event
		$slider->Row_Rendering();

		// Common render codes for all row types
		// id

		$slider->id->CellCssStyle = "";
		$slider->id->CellCssClass = "";

		// image
		$slider->image->CellCssStyle = "";
		$slider->image->CellCssClass = "";

		// order
		$slider->order->CellCssStyle = "";
		$slider->order->CellCssClass = "";

		// active
		$slider->active->CellCssStyle = "";
		$slider->active->CellCssClass = "";
		if ($slider->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$slider->id->ViewValue = $slider->id->CurrentValue;
			$slider->id->CssStyle = "";
			$slider->id->CssClass = "";
			$slider->id->ViewCustomAttributes = "";

			// image
			if (!is_null($slider->image->Upload->DbValue)) {
				$slider->image->ViewValue = $slider->image->Upload->DbValue;
				$slider->image->ImageWidth = 100;
				$slider->image->ImageHeight = 0;
				$slider->image->ImageAlt = "";
			} else {
				$slider->image->ViewValue = "";
			}
			$slider->image->CssStyle = "";
			$slider->image->CssClass = "";
			$slider->image->ViewCustomAttributes = "";

			// order
			$slider->order->ViewValue = $slider->order->CurrentValue;
			$slider->order->CssStyle = "";
			$slider->order->CssClass = "";
			$slider->order->ViewCustomAttributes = "";

			// active
			if (strval($slider->active->CurrentValue) <> "") {
				switch ($slider->active->CurrentValue) {
					case "0":
						$slider->active->ViewValue = "No";
						break;
					case "1":
						$slider->active->ViewValue = "Yes";
						break;
					default:
						$slider->active->ViewValue = $slider->active->CurrentValue;
				}
			} else {
				$slider->active->ViewValue = NULL;
			}
			$slider->active->CssStyle = "";
			$slider->active->CssClass = "";
			$slider->active->ViewCustomAttributes = "";

			// id
			$slider->id->HrefValue = "";

			// image
			$slider->image->HrefValue = "";

			// order
			$slider->order->HrefValue = "";

			// active
			$slider->active->HrefValue = "";
		}

		// Call Row Rendered event
		$slider->Row_Rendered();
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
