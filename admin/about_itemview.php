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
$about_item_view = new cabout_item_view();
$Page =& $about_item_view;

// Page init processing
$about_item_view->Page_Init();

// Page main processing
$about_item_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($about_item->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var about_item_view = new ew_Page("about_item_view");

// page properties
about_item_view.PageID = "view"; // page ID
var EW_PAGE_ID = about_item_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
about_item_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
about_item_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
about_item_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
about_item_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
about_item_view.ShowHighlightText = "Show highlight"; 
about_item_view.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">View TABLE: about item
<?php if ($about_item->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $about_item_view->PageUrl() ?>export=print&id=<?php echo ew_HtmlEncode($about_item->id->CurrentValue) ?>">Printer Friendly</a>
&nbsp;&nbsp;<a href="<?php echo $about_item_view->PageUrl() ?>export=html&id=<?php echo ew_HtmlEncode($about_item->id->CurrentValue) ?>">Export to HTML</a>
&nbsp;&nbsp;<a href="<?php echo $about_item_view->PageUrl() ?>export=excel&id=<?php echo ew_HtmlEncode($about_item->id->CurrentValue) ?>">Export to Excel</a>
&nbsp;&nbsp;<a href="<?php echo $about_item_view->PageUrl() ?>export=word&id=<?php echo ew_HtmlEncode($about_item->id->CurrentValue) ?>">Export to Word</a>
&nbsp;&nbsp;<a href="<?php echo $about_item_view->PageUrl() ?>export=xml&id=<?php echo ew_HtmlEncode($about_item->id->CurrentValue) ?>">Export to XML</a>
&nbsp;&nbsp;<a href="<?php echo $about_item_view->PageUrl() ?>export=csv&id=<?php echo ew_HtmlEncode($about_item->id->CurrentValue) ?>">Export to CSV</a>
<?php } ?>
<br><br>
<?php if ($about_item->Export == "") { ?>
<a href="about_itemlist.php">Back to List</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $about_item->AddUrl() ?>">Add</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $about_item->EditUrl() ?>">Edit</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $about_item->CopyUrl() ?>">Copy</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a onclick="return ew_Confirm('Do you want to delete this record?');" href="<?php echo $about_item->DeleteUrl() ?>">Delete</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $about_item_view->ShowMessage() ?>
<p>
<?php if ($about_item->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($about_item_view->Pager)) $about_item_view->Pager = new cPrevNextPager($about_item_view->lStartRec, $about_item_view->lDisplayRecs, $about_item_view->lTotalRecs) ?>
<?php if ($about_item_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($about_item_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $about_item_view->PageUrl() ?>start=<?php echo $about_item_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($about_item_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $about_item_view->PageUrl() ?>start=<?php echo $about_item_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $about_item_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($about_item_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $about_item_view->PageUrl() ?>start=<?php echo $about_item_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($about_item_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $about_item_view->PageUrl() ?>start=<?php echo $about_item_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $about_item_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($about_item_view->sSrchWhere == "0=101") { ?>
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
<?php if ($about_item->id->Visible) { // id ?>
	<tr<?php echo $about_item->id->RowAttributes ?>>
		<td class="ewTableHeader">id</td>
		<td<?php echo $about_item->id->CellAttributes() ?>>
<div<?php echo $about_item->id->ViewAttributes() ?>><?php echo $about_item->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($about_item->title->Visible) { // title ?>
	<tr<?php echo $about_item->title->RowAttributes ?>>
		<td class="ewTableHeader">title</td>
		<td<?php echo $about_item->title->CellAttributes() ?>>
<div<?php echo $about_item->title->ViewAttributes() ?>><?php echo $about_item->title->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($about_item->title_arabic->Visible) { // title_arabic ?>
	<tr<?php echo $about_item->title_arabic->RowAttributes ?>>
		<td class="ewTableHeader">title arabic</td>
		<td<?php echo $about_item->title_arabic->CellAttributes() ?>>
<div<?php echo $about_item->title_arabic->ViewAttributes() ?>><?php echo $about_item->title_arabic->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($about_item->text->Visible) { // text ?>
	<tr<?php echo $about_item->text->RowAttributes ?>>
		<td class="ewTableHeader">text</td>
		<td<?php echo $about_item->text->CellAttributes() ?>>
<div<?php echo $about_item->text->ViewAttributes() ?>><?php echo $about_item->text->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($about_item->text_arabic->Visible) { // text_arabic ?>
	<tr<?php echo $about_item->text_arabic->RowAttributes ?>>
		<td class="ewTableHeader">text arabic</td>
		<td<?php echo $about_item->text_arabic->CellAttributes() ?>>
<div<?php echo $about_item->text_arabic->ViewAttributes() ?>><?php echo $about_item->text_arabic->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($about_item->count->Visible) { // count ?>
	<tr<?php echo $about_item->count->RowAttributes ?>>
		<td class="ewTableHeader">count</td>
		<td<?php echo $about_item->count->CellAttributes() ?>>
<div<?php echo $about_item->count->ViewAttributes() ?>><?php echo $about_item->count->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($about_item->order->Visible) { // order ?>
	<tr<?php echo $about_item->order->RowAttributes ?>>
		<td class="ewTableHeader">order</td>
		<td<?php echo $about_item->order->CellAttributes() ?>>
<div<?php echo $about_item->order->ViewAttributes() ?>><?php echo $about_item->order->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($about_item->active->Visible) { // active ?>
	<tr<?php echo $about_item->active->RowAttributes ?>>
		<td class="ewTableHeader">active</td>
		<td<?php echo $about_item->active->CellAttributes() ?>>
<div<?php echo $about_item->active->ViewAttributes() ?>><?php echo $about_item->active->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($about_item->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($about_item_view->Pager)) $about_item_view->Pager = new cPrevNextPager($about_item_view->lStartRec, $about_item_view->lDisplayRecs, $about_item_view->lTotalRecs) ?>
<?php if ($about_item_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($about_item_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $about_item_view->PageUrl() ?>start=<?php echo $about_item_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($about_item_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $about_item_view->PageUrl() ?>start=<?php echo $about_item_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $about_item_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($about_item_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $about_item_view->PageUrl() ?>start=<?php echo $about_item_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($about_item_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $about_item_view->PageUrl() ?>start=<?php echo $about_item_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $about_item_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($about_item_view->sSrchWhere == "0=101") { ?>
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
<?php if ($about_item->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$about_item_view->Page_Terminate();
?>
<?php

//
// Page Class
//
class cabout_item_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'about_item';

	// Page Object Name
	var $PageObjName = 'about_item_view';

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
	function cabout_item_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["about_item"] = new cabout_item();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

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
	$about_item->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $about_item->Export; // Get export parameter, used in header
	$gsExportFile = $about_item->TableVar; // Get export file, used in header
	if (@$_GET["id"] <> "") {
		if ($gsExportFile <> "") $gsExportFile .= "_";
		$gsExportFile .= ew_StripSlashes($_GET["id"]);
	}
	if ($about_item->Export == "print" || $about_item->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($about_item->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($about_item->Export == "word") {
		header('Content-Type: application/vnd.ms-word;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($about_item->Export == "xml") {
		header('Content-Type: text/xml;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($about_item->Export == "csv") {
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
		global $about_item;

		// Paging variables
		$this->lDisplayRecs = 1;
		$this->lRecRange = 10;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$about_item->id->setQueryStringValue($_GET["id"]);
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$about_item->CurrentAction = "I"; // Display form
			switch ($about_item->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					$rs = $this->LoadRecordset(); // Load records
					$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage("No records found"); // Set no record message
						$this->Page_Terminate("about_itemlist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($about_item->id->CurrentValue) == strval($rs->fields('id'))) {
								$about_item->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "about_itemlist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}

			// Export data only
			if ($about_item->Export == "html" || $about_item->Export == "csv" ||
				$about_item->Export == "word" || $about_item->Export == "excel" ||
				$about_item->Export == "xml") {
				$this->ExportData();
				$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "about_itemlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$about_item->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $about_item;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$about_item->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$about_item->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $about_item->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$about_item->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$about_item->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$about_item->setStartRecordNumber($this->lStartRec);
		}
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

		// text
		$about_item->text->CellCssStyle = "";
		$about_item->text->CellCssClass = "";

		// text_arabic
		$about_item->text_arabic->CellCssStyle = "";
		$about_item->text_arabic->CellCssClass = "";

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

			// text
			$about_item->text->HrefValue = "";

			// text_arabic
			$about_item->text_arabic->HrefValue = "";

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

	// Export data in XML or CSV format
	function ExportData() {
		global $about_item;
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
		if ($about_item->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo "\xEF\xBB\xBF";
			echo ew_ExportHeader($about_item->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $about_item->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id', $about_item->Export);
				ew_ExportAddValue($sExportStr, 'title', $about_item->Export);
				ew_ExportAddValue($sExportStr, 'title_arabic', $about_item->Export);
				ew_ExportAddValue($sExportStr, 'text', $about_item->Export);
				ew_ExportAddValue($sExportStr, 'text_arabic', $about_item->Export);
				ew_ExportAddValue($sExportStr, 'count', $about_item->Export);
				ew_ExportAddValue($sExportStr, 'order', $about_item->Export);
				ew_ExportAddValue($sExportStr, 'active', $about_item->Export);
				echo ew_ExportLine($sExportStr, $about_item->Export);
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
				$about_item->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($about_item->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id', $about_item->id->CurrentValue);
					$XmlDoc->AddField('title', $about_item->title->CurrentValue);
					$XmlDoc->AddField('title_arabic', $about_item->title_arabic->CurrentValue);
					$XmlDoc->AddField('text', $about_item->text->CurrentValue);
					$XmlDoc->AddField('text_arabic', $about_item->text_arabic->CurrentValue);
					$XmlDoc->AddField('count', $about_item->count->CurrentValue);
					$XmlDoc->AddField('order', $about_item->order->CurrentValue);
					$XmlDoc->AddField('active', $about_item->active->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $about_item->Export <> "csv") { // Vertical format
						echo ew_ExportField('id', $about_item->id->ExportValue($about_item->Export, $about_item->ExportOriginalValue), $about_item->Export);
						echo ew_ExportField('title', $about_item->title->ExportValue($about_item->Export, $about_item->ExportOriginalValue), $about_item->Export);
						echo ew_ExportField('title_arabic', $about_item->title_arabic->ExportValue($about_item->Export, $about_item->ExportOriginalValue), $about_item->Export);
						echo ew_ExportField('text', $about_item->text->ExportValue($about_item->Export, $about_item->ExportOriginalValue), $about_item->Export);
						echo ew_ExportField('text_arabic', $about_item->text_arabic->ExportValue($about_item->Export, $about_item->ExportOriginalValue), $about_item->Export);
						echo ew_ExportField('count', $about_item->count->ExportValue($about_item->Export, $about_item->ExportOriginalValue), $about_item->Export);
						echo ew_ExportField('order', $about_item->order->ExportValue($about_item->Export, $about_item->ExportOriginalValue), $about_item->Export);
						echo ew_ExportField('active', $about_item->active->ExportValue($about_item->Export, $about_item->ExportOriginalValue), $about_item->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $about_item->id->ExportValue($about_item->Export, $about_item->ExportOriginalValue), $about_item->Export);
						ew_ExportAddValue($sExportStr, $about_item->title->ExportValue($about_item->Export, $about_item->ExportOriginalValue), $about_item->Export);
						ew_ExportAddValue($sExportStr, $about_item->title_arabic->ExportValue($about_item->Export, $about_item->ExportOriginalValue), $about_item->Export);
						ew_ExportAddValue($sExportStr, $about_item->text->ExportValue($about_item->Export, $about_item->ExportOriginalValue), $about_item->Export);
						ew_ExportAddValue($sExportStr, $about_item->text_arabic->ExportValue($about_item->Export, $about_item->ExportOriginalValue), $about_item->Export);
						ew_ExportAddValue($sExportStr, $about_item->count->ExportValue($about_item->Export, $about_item->ExportOriginalValue), $about_item->Export);
						ew_ExportAddValue($sExportStr, $about_item->order->ExportValue($about_item->Export, $about_item->ExportOriginalValue), $about_item->Export);
						ew_ExportAddValue($sExportStr, $about_item->active->ExportValue($about_item->Export, $about_item->ExportOriginalValue), $about_item->Export);
						echo ew_ExportLine($sExportStr, $about_item->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($about_item->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($about_item->Export);
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
