<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "staticinfo.php" ?>
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
$static_view = new cstatic_view();
$Page =& $static_view;

// Page init processing
$static_view->Page_Init();

// Page main processing
$static_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($static->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var static_view = new ew_Page("static_view");

// page properties
static_view.PageID = "view"; // page ID
var EW_PAGE_ID = static_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
static_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
static_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
static_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
static_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
static_view.ShowHighlightText = "Show highlight"; 
static_view.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">View TABLE: static
<?php if ($static->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $static_view->PageUrl() ?>export=print&id=<?php echo ew_HtmlEncode($static->id->CurrentValue) ?>">Printer Friendly</a>
&nbsp;&nbsp;<a href="<?php echo $static_view->PageUrl() ?>export=html&id=<?php echo ew_HtmlEncode($static->id->CurrentValue) ?>">Export to HTML</a>
&nbsp;&nbsp;<a href="<?php echo $static_view->PageUrl() ?>export=excel&id=<?php echo ew_HtmlEncode($static->id->CurrentValue) ?>">Export to Excel</a>
&nbsp;&nbsp;<a href="<?php echo $static_view->PageUrl() ?>export=word&id=<?php echo ew_HtmlEncode($static->id->CurrentValue) ?>">Export to Word</a>
&nbsp;&nbsp;<a href="<?php echo $static_view->PageUrl() ?>export=xml&id=<?php echo ew_HtmlEncode($static->id->CurrentValue) ?>">Export to XML</a>
&nbsp;&nbsp;<a href="<?php echo $static_view->PageUrl() ?>export=csv&id=<?php echo ew_HtmlEncode($static->id->CurrentValue) ?>">Export to CSV</a>
<?php } ?>
<br><br>
<?php if ($static->Export == "") { ?>
<a href="staticlist.php">Back to List</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $static->AddUrl() ?>">Add</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $static->EditUrl() ?>">Edit</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $static->CopyUrl() ?>">Copy</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a onclick="return ew_Confirm('Do you want to delete this record?');" href="<?php echo $static->DeleteUrl() ?>">Delete</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $static_view->ShowMessage() ?>
<p>
<?php if ($static->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($static_view->Pager)) $static_view->Pager = new cPrevNextPager($static_view->lStartRec, $static_view->lDisplayRecs, $static_view->lTotalRecs) ?>
<?php if ($static_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($static_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $static_view->PageUrl() ?>start=<?php echo $static_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($static_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $static_view->PageUrl() ?>start=<?php echo $static_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $static_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($static_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $static_view->PageUrl() ?>start=<?php echo $static_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($static_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $static_view->PageUrl() ?>start=<?php echo $static_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $static_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($static_view->sSrchWhere == "0=101") { ?>
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
<?php if ($static->id->Visible) { // id ?>
	<tr<?php echo $static->id->RowAttributes ?>>
		<td class="ewTableHeader">id</td>
		<td<?php echo $static->id->CellAttributes() ?>>
<div<?php echo $static->id->ViewAttributes() ?>><?php echo $static->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($static->code->Visible) { // code ?>
	<tr<?php echo $static->code->RowAttributes ?>>
		<td class="ewTableHeader">code</td>
		<td<?php echo $static->code->CellAttributes() ?>>
<div<?php echo $static->code->ViewAttributes() ?>><?php echo $static->code->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($static->english->Visible) { // english ?>
	<tr<?php echo $static->english->RowAttributes ?>>
		<td class="ewTableHeader">english</td>
		<td<?php echo $static->english->CellAttributes() ?>>
<div<?php echo $static->english->ViewAttributes() ?>><?php echo $static->english->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($static->arabic->Visible) { // arabic ?>
	<tr<?php echo $static->arabic->RowAttributes ?>>
		<td class="ewTableHeader">arabic</td>
		<td<?php echo $static->arabic->CellAttributes() ?>>
<div<?php echo $static->arabic->ViewAttributes() ?>><?php echo $static->arabic->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($static->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($static_view->Pager)) $static_view->Pager = new cPrevNextPager($static_view->lStartRec, $static_view->lDisplayRecs, $static_view->lTotalRecs) ?>
<?php if ($static_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($static_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $static_view->PageUrl() ?>start=<?php echo $static_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($static_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $static_view->PageUrl() ?>start=<?php echo $static_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $static_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($static_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $static_view->PageUrl() ?>start=<?php echo $static_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($static_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $static_view->PageUrl() ?>start=<?php echo $static_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $static_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($static_view->sSrchWhere == "0=101") { ?>
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
<?php if ($static->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$static_view->Page_Terminate();
?>
<?php

//
// Page Class
//
class cstatic_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'static';

	// Page Object Name
	var $PageObjName = 'static_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $static;
		if ($static->UseTokenInUrl) $PageUrl .= "t=" . $static->TableVar . "&"; // add page token
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
		global $objForm, $static;
		if ($static->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($static->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($static->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cstatic_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["static"] = new cstatic();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'static', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $static;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$static->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $static->Export; // Get export parameter, used in header
	$gsExportFile = $static->TableVar; // Get export file, used in header
	if (@$_GET["id"] <> "") {
		if ($gsExportFile <> "") $gsExportFile .= "_";
		$gsExportFile .= ew_StripSlashes($_GET["id"]);
	}
	if ($static->Export == "print" || $static->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($static->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($static->Export == "word") {
		header('Content-Type: application/vnd.ms-word;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($static->Export == "xml") {
		header('Content-Type: text/xml;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($static->Export == "csv") {
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
		global $static;

		// Paging variables
		$this->lDisplayRecs = 1;
		$this->lRecRange = 10;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$static->id->setQueryStringValue($_GET["id"]);
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$static->CurrentAction = "I"; // Display form
			switch ($static->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					$rs = $this->LoadRecordset(); // Load records
					$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage("No records found"); // Set no record message
						$this->Page_Terminate("staticlist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($static->id->CurrentValue) == strval($rs->fields('id'))) {
								$static->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "staticlist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}

			// Export data only
			if ($static->Export == "html" || $static->Export == "csv" ||
				$static->Export == "word" || $static->Export == "excel" ||
				$static->Export == "xml") {
				$this->ExportData();
				$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "staticlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$static->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $static;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$static->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$static->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $static->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$static->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$static->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$static->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $static;

		// Call Recordset Selecting event
		$static->Recordset_Selecting($static->CurrentFilter);

		// Load list page SQL
		$sSql = $static->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$static->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $static;
		$sFilter = $static->KeyFilter();

		// Call Row Selecting event
		$static->Row_Selecting($sFilter);

		// Load sql based on filter
		$static->CurrentFilter = $sFilter;
		$sSql = $static->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$static->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $static;
		$static->id->setDbValue($rs->fields('id'));
		$static->code->setDbValue($rs->fields('code'));
		$static->english->setDbValue($rs->fields('english'));
		$static->arabic->setDbValue($rs->fields('arabic'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $static;

		// Call Row_Rendering event
		$static->Row_Rendering();

		// Common render codes for all row types
		// id

		$static->id->CellCssStyle = "";
		$static->id->CellCssClass = "";

		// code
		$static->code->CellCssStyle = "";
		$static->code->CellCssClass = "";

		// english
		$static->english->CellCssStyle = "";
		$static->english->CellCssClass = "";

		// arabic
		$static->arabic->CellCssStyle = "";
		$static->arabic->CellCssClass = "";
		if ($static->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$static->id->ViewValue = $static->id->CurrentValue;
			$static->id->CssStyle = "";
			$static->id->CssClass = "";
			$static->id->ViewCustomAttributes = "";

			// code
			$static->code->ViewValue = $static->code->CurrentValue;
			$static->code->CssStyle = "";
			$static->code->CssClass = "";
			$static->code->ViewCustomAttributes = "";

			// english
			$static->english->ViewValue = $static->english->CurrentValue;
			$static->english->CssStyle = "";
			$static->english->CssClass = "";
			$static->english->ViewCustomAttributes = "";

			// arabic
			$static->arabic->ViewValue = $static->arabic->CurrentValue;
			$static->arabic->CssStyle = "";
			$static->arabic->CssClass = "";
			$static->arabic->ViewCustomAttributes = "";

			// id
			$static->id->HrefValue = "";

			// code
			$static->code->HrefValue = "";

			// english
			$static->english->HrefValue = "";

			// arabic
			$static->arabic->HrefValue = "";
		}

		// Call Row Rendered event
		$static->Row_Rendered();
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $static;
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
		if ($static->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo "\xEF\xBB\xBF";
			echo ew_ExportHeader($static->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $static->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id', $static->Export);
				ew_ExportAddValue($sExportStr, 'code', $static->Export);
				ew_ExportAddValue($sExportStr, 'english', $static->Export);
				ew_ExportAddValue($sExportStr, 'arabic', $static->Export);
				echo ew_ExportLine($sExportStr, $static->Export);
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
				$static->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($static->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id', $static->id->CurrentValue);
					$XmlDoc->AddField('code', $static->code->CurrentValue);
					$XmlDoc->AddField('english', $static->english->CurrentValue);
					$XmlDoc->AddField('arabic', $static->arabic->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $static->Export <> "csv") { // Vertical format
						echo ew_ExportField('id', $static->id->ExportValue($static->Export, $static->ExportOriginalValue), $static->Export);
						echo ew_ExportField('code', $static->code->ExportValue($static->Export, $static->ExportOriginalValue), $static->Export);
						echo ew_ExportField('english', $static->english->ExportValue($static->Export, $static->ExportOriginalValue), $static->Export);
						echo ew_ExportField('arabic', $static->arabic->ExportValue($static->Export, $static->ExportOriginalValue), $static->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $static->id->ExportValue($static->Export, $static->ExportOriginalValue), $static->Export);
						ew_ExportAddValue($sExportStr, $static->code->ExportValue($static->Export, $static->ExportOriginalValue), $static->Export);
						ew_ExportAddValue($sExportStr, $static->english->ExportValue($static->Export, $static->ExportOriginalValue), $static->Export);
						ew_ExportAddValue($sExportStr, $static->arabic->ExportValue($static->Export, $static->ExportOriginalValue), $static->Export);
						echo ew_ExportLine($sExportStr, $static->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($static->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($static->Export);
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
