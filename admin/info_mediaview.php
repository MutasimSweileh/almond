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
$info_media_view = new cinfo_media_view();
$Page =& $info_media_view;

// Page init processing
$info_media_view->Page_Init();

// Page main processing
$info_media_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($info_media->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var info_media_view = new ew_Page("info_media_view");

// page properties
info_media_view.PageID = "view"; // page ID
var EW_PAGE_ID = info_media_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
info_media_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
info_media_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
info_media_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
info_media_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
info_media_view.ShowHighlightText = "Show highlight"; 
info_media_view.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">View TABLE: info media
<?php if ($info_media->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $info_media_view->PageUrl() ?>export=print&id=<?php echo ew_HtmlEncode($info_media->id->CurrentValue) ?>">Printer Friendly</a>
&nbsp;&nbsp;<a href="<?php echo $info_media_view->PageUrl() ?>export=html&id=<?php echo ew_HtmlEncode($info_media->id->CurrentValue) ?>">Export to HTML</a>
&nbsp;&nbsp;<a href="<?php echo $info_media_view->PageUrl() ?>export=excel&id=<?php echo ew_HtmlEncode($info_media->id->CurrentValue) ?>">Export to Excel</a>
&nbsp;&nbsp;<a href="<?php echo $info_media_view->PageUrl() ?>export=word&id=<?php echo ew_HtmlEncode($info_media->id->CurrentValue) ?>">Export to Word</a>
&nbsp;&nbsp;<a href="<?php echo $info_media_view->PageUrl() ?>export=xml&id=<?php echo ew_HtmlEncode($info_media->id->CurrentValue) ?>">Export to XML</a>
&nbsp;&nbsp;<a href="<?php echo $info_media_view->PageUrl() ?>export=csv&id=<?php echo ew_HtmlEncode($info_media->id->CurrentValue) ?>">Export to CSV</a>
<?php } ?>
<br><br>
<?php if ($info_media->Export == "") { ?>
<a href="info_medialist.php">Back to List</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $info_media->AddUrl() ?>">Add</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $info_media->EditUrl() ?>">Edit</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $info_media->CopyUrl() ?>">Copy</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a onclick="return ew_Confirm('Do you want to delete this record?');" href="<?php echo $info_media->DeleteUrl() ?>">Delete</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $info_media_view->ShowMessage() ?>
<p>
<?php if ($info_media->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($info_media_view->Pager)) $info_media_view->Pager = new cPrevNextPager($info_media_view->lStartRec, $info_media_view->lDisplayRecs, $info_media_view->lTotalRecs) ?>
<?php if ($info_media_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($info_media_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $info_media_view->PageUrl() ?>start=<?php echo $info_media_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($info_media_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $info_media_view->PageUrl() ?>start=<?php echo $info_media_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $info_media_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($info_media_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $info_media_view->PageUrl() ?>start=<?php echo $info_media_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($info_media_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $info_media_view->PageUrl() ?>start=<?php echo $info_media_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $info_media_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($info_media_view->sSrchWhere == "0=101") { ?>
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
<?php if ($info_media->id->Visible) { // id ?>
	<tr<?php echo $info_media->id->RowAttributes ?>>
		<td class="ewTableHeader">id</td>
		<td<?php echo $info_media->id->CellAttributes() ?>>
<div<?php echo $info_media->id->ViewAttributes() ?>><?php echo $info_media->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($info_media->code->Visible) { // code ?>
	<tr<?php echo $info_media->code->RowAttributes ?>>
		<td class="ewTableHeader">code</td>
		<td<?php echo $info_media->code->CellAttributes() ?>>
<div<?php echo $info_media->code->ViewAttributes() ?>><?php echo $info_media->code->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($info_media->link->Visible) { // link ?>
	<tr<?php echo $info_media->link->RowAttributes ?>>
		<td class="ewTableHeader">link</td>
		<td<?php echo $info_media->link->CellAttributes() ?>>
<div<?php echo $info_media->link->ViewAttributes() ?>><?php echo $info_media->link->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($info_media->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($info_media_view->Pager)) $info_media_view->Pager = new cPrevNextPager($info_media_view->lStartRec, $info_media_view->lDisplayRecs, $info_media_view->lTotalRecs) ?>
<?php if ($info_media_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($info_media_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $info_media_view->PageUrl() ?>start=<?php echo $info_media_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($info_media_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $info_media_view->PageUrl() ?>start=<?php echo $info_media_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $info_media_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($info_media_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $info_media_view->PageUrl() ?>start=<?php echo $info_media_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($info_media_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $info_media_view->PageUrl() ?>start=<?php echo $info_media_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $info_media_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($info_media_view->sSrchWhere == "0=101") { ?>
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
<?php if ($info_media->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$info_media_view->Page_Terminate();
?>
<?php

//
// Page Class
//
class cinfo_media_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'info_media';

	// Page Object Name
	var $PageObjName = 'info_media_view';

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
	function cinfo_media_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["info_media"] = new cinfo_media();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

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
	$info_media->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $info_media->Export; // Get export parameter, used in header
	$gsExportFile = $info_media->TableVar; // Get export file, used in header
	if (@$_GET["id"] <> "") {
		if ($gsExportFile <> "") $gsExportFile .= "_";
		$gsExportFile .= ew_StripSlashes($_GET["id"]);
	}
	if ($info_media->Export == "print" || $info_media->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($info_media->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($info_media->Export == "word") {
		header('Content-Type: application/vnd.ms-word;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($info_media->Export == "xml") {
		header('Content-Type: text/xml;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($info_media->Export == "csv") {
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
		global $info_media;

		// Paging variables
		$this->lDisplayRecs = 1;
		$this->lRecRange = 10;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$info_media->id->setQueryStringValue($_GET["id"]);
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$info_media->CurrentAction = "I"; // Display form
			switch ($info_media->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					$rs = $this->LoadRecordset(); // Load records
					$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage("No records found"); // Set no record message
						$this->Page_Terminate("info_medialist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($info_media->id->CurrentValue) == strval($rs->fields('id'))) {
								$info_media->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "info_medialist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}

			// Export data only
			if ($info_media->Export == "html" || $info_media->Export == "csv" ||
				$info_media->Export == "word" || $info_media->Export == "excel" ||
				$info_media->Export == "xml") {
				$this->ExportData();
				$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "info_medialist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$info_media->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $info_media;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$info_media->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$info_media->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $info_media->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$info_media->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$info_media->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$info_media->setStartRecordNumber($this->lStartRec);
		}
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

		// link
		$info_media->link->CellCssStyle = "";
		$info_media->link->CellCssClass = "";
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

			// link
			$info_media->link->HrefValue = "";
		}

		// Call Row Rendered event
		$info_media->Row_Rendered();
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $info_media;
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
		if ($info_media->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo "\xEF\xBB\xBF";
			echo ew_ExportHeader($info_media->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $info_media->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id', $info_media->Export);
				ew_ExportAddValue($sExportStr, 'code', $info_media->Export);
				ew_ExportAddValue($sExportStr, 'link', $info_media->Export);
				echo ew_ExportLine($sExportStr, $info_media->Export);
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
				$info_media->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($info_media->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id', $info_media->id->CurrentValue);
					$XmlDoc->AddField('code', $info_media->code->CurrentValue);
					$XmlDoc->AddField('link', $info_media->link->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $info_media->Export <> "csv") { // Vertical format
						echo ew_ExportField('id', $info_media->id->ExportValue($info_media->Export, $info_media->ExportOriginalValue), $info_media->Export);
						echo ew_ExportField('code', $info_media->code->ExportValue($info_media->Export, $info_media->ExportOriginalValue), $info_media->Export);
						echo ew_ExportField('link', $info_media->link->ExportValue($info_media->Export, $info_media->ExportOriginalValue), $info_media->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $info_media->id->ExportValue($info_media->Export, $info_media->ExportOriginalValue), $info_media->Export);
						ew_ExportAddValue($sExportStr, $info_media->code->ExportValue($info_media->Export, $info_media->ExportOriginalValue), $info_media->Export);
						ew_ExportAddValue($sExportStr, $info_media->link->ExportValue($info_media->Export, $info_media->ExportOriginalValue), $info_media->Export);
						echo ew_ExportLine($sExportStr, $info_media->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($info_media->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($info_media->Export);
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
