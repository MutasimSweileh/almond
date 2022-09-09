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
$product_videos_view = new cproduct_videos_view();
$Page =& $product_videos_view;

// Page init processing
$product_videos_view->Page_Init();

// Page main processing
$product_videos_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($product_videos->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var product_videos_view = new ew_Page("product_videos_view");

// page properties
product_videos_view.PageID = "view"; // page ID
var EW_PAGE_ID = product_videos_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
product_videos_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
product_videos_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
product_videos_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
product_videos_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
product_videos_view.ShowHighlightText = "Show highlight"; 
product_videos_view.HideHighlightText = "Hide highlight";

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<p><span class="phpmaker">View TABLE: product videos
<?php if ($product_videos->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $product_videos_view->PageUrl() ?>export=print&id=<?php echo ew_HtmlEncode($product_videos->id->CurrentValue) ?>">Printer Friendly</a>
&nbsp;&nbsp;<a href="<?php echo $product_videos_view->PageUrl() ?>export=html&id=<?php echo ew_HtmlEncode($product_videos->id->CurrentValue) ?>">Export to HTML</a>
&nbsp;&nbsp;<a href="<?php echo $product_videos_view->PageUrl() ?>export=excel&id=<?php echo ew_HtmlEncode($product_videos->id->CurrentValue) ?>">Export to Excel</a>
&nbsp;&nbsp;<a href="<?php echo $product_videos_view->PageUrl() ?>export=word&id=<?php echo ew_HtmlEncode($product_videos->id->CurrentValue) ?>">Export to Word</a>
&nbsp;&nbsp;<a href="<?php echo $product_videos_view->PageUrl() ?>export=xml&id=<?php echo ew_HtmlEncode($product_videos->id->CurrentValue) ?>">Export to XML</a>
&nbsp;&nbsp;<a href="<?php echo $product_videos_view->PageUrl() ?>export=csv&id=<?php echo ew_HtmlEncode($product_videos->id->CurrentValue) ?>">Export to CSV</a>
<?php } ?>
<br><br>
<?php if ($product_videos->Export == "") { ?>
<a href="product_videoslist.php">Back to List</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $product_videos->AddUrl() ?>">Add</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $product_videos->EditUrl() ?>">Edit</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $product_videos->CopyUrl() ?>">Copy</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a onclick="return ew_Confirm('Do you want to delete this record?');" href="<?php echo $product_videos->DeleteUrl() ?>">Delete</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $product_videos_view->ShowMessage() ?>
<p>
<?php if ($product_videos->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($product_videos_view->Pager)) $product_videos_view->Pager = new cPrevNextPager($product_videos_view->lStartRec, $product_videos_view->lDisplayRecs, $product_videos_view->lTotalRecs) ?>
<?php if ($product_videos_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($product_videos_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $product_videos_view->PageUrl() ?>start=<?php echo $product_videos_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($product_videos_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $product_videos_view->PageUrl() ?>start=<?php echo $product_videos_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $product_videos_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($product_videos_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $product_videos_view->PageUrl() ?>start=<?php echo $product_videos_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($product_videos_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $product_videos_view->PageUrl() ?>start=<?php echo $product_videos_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $product_videos_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($product_videos_view->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<br>
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($product_videos->id->Visible) { // id ?>
	<tr<?php echo $product_videos->id->RowAttributes ?>>
		<td class="ewTableHeader">id</td>
		<td<?php echo $product_videos->id->CellAttributes() ?>>
<div<?php echo $product_videos->id->ViewAttributes() ?>><?php echo $product_videos->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($product_videos->video->Visible) { // video ?>
	<tr<?php echo $product_videos->video->RowAttributes ?>>
		<td class="ewTableHeader">video</td>
		<td<?php echo $product_videos->video->CellAttributes() ?>>
<div<?php echo $product_videos->video->ViewAttributes() ?>><?php echo $product_videos->video->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($product_videos->product_id->Visible) { // product_id ?>
	<tr<?php echo $product_videos->product_id->RowAttributes ?>>
		<td class="ewTableHeader">product</td>
		<td<?php echo $product_videos->product_id->CellAttributes() ?>>
<div<?php echo $product_videos->product_id->ViewAttributes() ?>><?php echo $product_videos->product_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($product_videos->order->Visible) { // order ?>
	<tr<?php echo $product_videos->order->RowAttributes ?>>
		<td class="ewTableHeader">order</td>
		<td<?php echo $product_videos->order->CellAttributes() ?>>
<div<?php echo $product_videos->order->ViewAttributes() ?>><?php echo $product_videos->order->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($product_videos->active->Visible) { // active ?>
	<tr<?php echo $product_videos->active->RowAttributes ?>>
		<td class="ewTableHeader">active</td>
		<td<?php echo $product_videos->active->CellAttributes() ?>>
<div<?php echo $product_videos->active->ViewAttributes() ?>><?php echo $product_videos->active->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($product_videos->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($product_videos_view->Pager)) $product_videos_view->Pager = new cPrevNextPager($product_videos_view->lStartRec, $product_videos_view->lDisplayRecs, $product_videos_view->lTotalRecs) ?>
<?php if ($product_videos_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($product_videos_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $product_videos_view->PageUrl() ?>start=<?php echo $product_videos_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($product_videos_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $product_videos_view->PageUrl() ?>start=<?php echo $product_videos_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $product_videos_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($product_videos_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $product_videos_view->PageUrl() ?>start=<?php echo $product_videos_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($product_videos_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $product_videos_view->PageUrl() ?>start=<?php echo $product_videos_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $product_videos_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($product_videos_view->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<p>
<?php if ($product_videos->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$product_videos_view->Page_Terminate();
?>
<?php

//
// Page Class
//
class cproduct_videos_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'product_videos';

	// Page Object Name
	var $PageObjName = 'product_videos_view';

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
	function cproduct_videos_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["product_videos"] = new cproduct_videos();

		// Initialize other table object
		$GLOBALS['products'] = new cproducts();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

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
	$product_videos->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $product_videos->Export; // Get export parameter, used in header
	$gsExportFile = $product_videos->TableVar; // Get export file, used in header
	if (@$_GET["id"] <> "") {
		if ($gsExportFile <> "") $gsExportFile .= "_";
		$gsExportFile .= ew_StripSlashes($_GET["id"]);
	}
	if ($product_videos->Export == "print" || $product_videos->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($product_videos->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($product_videos->Export == "word") {
		header('Content-Type: application/vnd.ms-word;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($product_videos->Export == "xml") {
		header('Content-Type: text/xml;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($product_videos->Export == "csv") {
		header('Content-Type: application/csv;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.csv');
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
	var $lDisplayRecs; // Number of display records
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs;
	var $lRecRange;
	var $lRecCnt;

	//
	// Page main processing
	//
	function Page_Main() {
		global $product_videos;

		// Paging variables
		$this->lDisplayRecs = 1;
		$this->lRecRange = 10;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$product_videos->id->setQueryStringValue($_GET["id"]);
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$product_videos->CurrentAction = "I"; // Display form
			switch ($product_videos->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					$rs = $this->LoadRecordset(); // Load records
					$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage("No records found"); // Set no record message
						$this->Page_Terminate("product_videoslist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($product_videos->id->CurrentValue) == strval($rs->fields('id'))) {
								$product_videos->setStartRecordNumber($this->lStartRec); // Save record position
								$bMatchRecord = TRUE;
								break;
							} else {
								$this->lStartRec++;
								$rs->MoveNext();
							}
						}
					}
					if (!$bMatchRecord) {
						$this->setMessage("No records found"); // Set no record message
						$sReturnUrl = "product_videoslist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}

			// Export data only
			if ($product_videos->Export == "html" || $product_videos->Export == "csv" ||
				$product_videos->Export == "word" || $product_videos->Export == "excel" ||
				$product_videos->Export == "xml") {
				$this->ExportData();
				$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "product_videoslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$product_videos->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $product_videos;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$product_videos->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$product_videos->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $product_videos->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$product_videos->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$product_videos->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$product_videos->setStartRecordNumber($this->lStartRec);
		}
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

	// Export data in XML or CSV format
	function ExportData() {
		global $product_videos;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "v";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;
			$this->SetUpStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->lDisplayRecs < 0) {
				$this->lStopRec = $this->lTotalRecs;
			} else {
				$this->lStopRec = $this->lStartRec + $this->lDisplayRecs - 1;
			}
		if ($product_videos->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo "\xEF\xBB\xBF";
			echo ew_ExportHeader($product_videos->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $product_videos->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id', $product_videos->Export);
				ew_ExportAddValue($sExportStr, 'video', $product_videos->Export);
				ew_ExportAddValue($sExportStr, 'product_id', $product_videos->Export);
				ew_ExportAddValue($sExportStr, 'order', $product_videos->Export);
				ew_ExportAddValue($sExportStr, 'active', $product_videos->Export);
				echo ew_ExportLine($sExportStr, $product_videos->Export);
			}
		}

		// Move to first record
		$this->lRecCnt = $this->lStartRec - 1;
		if (!$rs->EOF) {
			$rs->MoveFirst();
			$rs->Move($this->lStartRec - 1);
		}
		while (!$rs->EOF && $this->lRecCnt < $this->lStopRec) {
			$this->lRecCnt++;
			if (intval($this->lRecCnt) >= intval($this->lStartRec)) {
				$this->LoadRowValues($rs);

				// Render row for display
				$product_videos->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($product_videos->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id', $product_videos->id->CurrentValue);
					$XmlDoc->AddField('video', $product_videos->video->CurrentValue);
					$XmlDoc->AddField('product_id', $product_videos->product_id->CurrentValue);
					$XmlDoc->AddField('order', $product_videos->order->CurrentValue);
					$XmlDoc->AddField('active', $product_videos->active->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $product_videos->Export <> "csv") { // Vertical format
						echo ew_ExportField('id', $product_videos->id->ExportValue($product_videos->Export, $product_videos->ExportOriginalValue), $product_videos->Export);
						echo ew_ExportField('video', $product_videos->video->ExportValue($product_videos->Export, $product_videos->ExportOriginalValue), $product_videos->Export);
						echo ew_ExportField('product_id', $product_videos->product_id->ExportValue($product_videos->Export, $product_videos->ExportOriginalValue), $product_videos->Export);
						echo ew_ExportField('order', $product_videos->order->ExportValue($product_videos->Export, $product_videos->ExportOriginalValue), $product_videos->Export);
						echo ew_ExportField('active', $product_videos->active->ExportValue($product_videos->Export, $product_videos->ExportOriginalValue), $product_videos->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $product_videos->id->ExportValue($product_videos->Export, $product_videos->ExportOriginalValue), $product_videos->Export);
						ew_ExportAddValue($sExportStr, $product_videos->video->ExportValue($product_videos->Export, $product_videos->ExportOriginalValue), $product_videos->Export);
						ew_ExportAddValue($sExportStr, $product_videos->product_id->ExportValue($product_videos->Export, $product_videos->ExportOriginalValue), $product_videos->Export);
						ew_ExportAddValue($sExportStr, $product_videos->order->ExportValue($product_videos->Export, $product_videos->ExportOriginalValue), $product_videos->Export);
						ew_ExportAddValue($sExportStr, $product_videos->active->ExportValue($product_videos->Export, $product_videos->ExportOriginalValue), $product_videos->Export);
						echo ew_ExportLine($sExportStr, $product_videos->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($product_videos->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($product_videos->Export);
		}
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
