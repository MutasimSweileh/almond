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
$searchengine_view = new csearchengine_view();
$Page =& $searchengine_view;

// Page init processing
$searchengine_view->Page_Init();

// Page main processing
$searchengine_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($searchengine->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var searchengine_view = new ew_Page("searchengine_view");

// page properties
searchengine_view.PageID = "view"; // page ID
var EW_PAGE_ID = searchengine_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
searchengine_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
searchengine_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
searchengine_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
searchengine_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
searchengine_view.ShowHighlightText = "Show highlight"; 
searchengine_view.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">View TABLE: searchengine
<?php if ($searchengine->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $searchengine_view->PageUrl() ?>export=print&id=<?php echo ew_HtmlEncode($searchengine->id->CurrentValue) ?>">Printer Friendly</a>
&nbsp;&nbsp;<a href="<?php echo $searchengine_view->PageUrl() ?>export=html&id=<?php echo ew_HtmlEncode($searchengine->id->CurrentValue) ?>">Export to HTML</a>
&nbsp;&nbsp;<a href="<?php echo $searchengine_view->PageUrl() ?>export=excel&id=<?php echo ew_HtmlEncode($searchengine->id->CurrentValue) ?>">Export to Excel</a>
&nbsp;&nbsp;<a href="<?php echo $searchengine_view->PageUrl() ?>export=word&id=<?php echo ew_HtmlEncode($searchengine->id->CurrentValue) ?>">Export to Word</a>
&nbsp;&nbsp;<a href="<?php echo $searchengine_view->PageUrl() ?>export=xml&id=<?php echo ew_HtmlEncode($searchengine->id->CurrentValue) ?>">Export to XML</a>
&nbsp;&nbsp;<a href="<?php echo $searchengine_view->PageUrl() ?>export=csv&id=<?php echo ew_HtmlEncode($searchengine->id->CurrentValue) ?>">Export to CSV</a>
<?php } ?>
<br><br>
<?php if ($searchengine->Export == "") { ?>
<a href="searchenginelist.php">Back to List</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $searchengine->AddUrl() ?>">Add</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $searchengine->EditUrl() ?>">Edit</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $searchengine->CopyUrl() ?>">Copy</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a onclick="return ew_Confirm('Do you want to delete this record?');" href="<?php echo $searchengine->DeleteUrl() ?>">Delete</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $searchengine_view->ShowMessage() ?>
<p>
<?php if ($searchengine->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($searchengine_view->Pager)) $searchengine_view->Pager = new cPrevNextPager($searchengine_view->lStartRec, $searchengine_view->lDisplayRecs, $searchengine_view->lTotalRecs) ?>
<?php if ($searchengine_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($searchengine_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $searchengine_view->PageUrl() ?>start=<?php echo $searchengine_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($searchengine_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $searchengine_view->PageUrl() ?>start=<?php echo $searchengine_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $searchengine_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($searchengine_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $searchengine_view->PageUrl() ?>start=<?php echo $searchengine_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($searchengine_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $searchengine_view->PageUrl() ?>start=<?php echo $searchengine_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $searchengine_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($searchengine_view->sSrchWhere == "0=101") { ?>
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
<?php if ($searchengine->id->Visible) { // id ?>
	<tr<?php echo $searchengine->id->RowAttributes ?>>
		<td class="ewTableHeader">id</td>
		<td<?php echo $searchengine->id->CellAttributes() ?>>
<div<?php echo $searchengine->id->ViewAttributes() ?>><?php echo $searchengine->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($searchengine->zpage->Visible) { // page ?>
	<tr<?php echo $searchengine->zpage->RowAttributes ?>>
		<td class="ewTableHeader">page</td>
		<td<?php echo $searchengine->zpage->CellAttributes() ?>>
<div<?php echo $searchengine->zpage->ViewAttributes() ?>><?php echo $searchengine->zpage->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($searchengine->description->Visible) { // description ?>
	<tr<?php echo $searchengine->description->RowAttributes ?>>
		<td class="ewTableHeader">description</td>
		<td<?php echo $searchengine->description->CellAttributes() ?>>
<div<?php echo $searchengine->description->ViewAttributes() ?>><?php echo $searchengine->description->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($searchengine->keywords->Visible) { // keywords ?>
	<tr<?php echo $searchengine->keywords->RowAttributes ?>>
		<td class="ewTableHeader">keywords</td>
		<td<?php echo $searchengine->keywords->CellAttributes() ?>>
<div<?php echo $searchengine->keywords->ViewAttributes() ?>><?php echo $searchengine->keywords->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($searchengine->title->Visible) { // title ?>
	<tr<?php echo $searchengine->title->RowAttributes ?>>
		<td class="ewTableHeader">title</td>
		<td<?php echo $searchengine->title->CellAttributes() ?>>
<div<?php echo $searchengine->title->ViewAttributes() ?>><?php echo $searchengine->title->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($searchengine->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($searchengine_view->Pager)) $searchengine_view->Pager = new cPrevNextPager($searchengine_view->lStartRec, $searchengine_view->lDisplayRecs, $searchengine_view->lTotalRecs) ?>
<?php if ($searchengine_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($searchengine_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $searchengine_view->PageUrl() ?>start=<?php echo $searchengine_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($searchengine_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $searchengine_view->PageUrl() ?>start=<?php echo $searchengine_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $searchengine_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($searchengine_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $searchengine_view->PageUrl() ?>start=<?php echo $searchengine_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($searchengine_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $searchengine_view->PageUrl() ?>start=<?php echo $searchengine_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $searchengine_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($searchengine_view->sSrchWhere == "0=101") { ?>
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
<?php if ($searchengine->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$searchengine_view->Page_Terminate();
?>
<?php

//
// Page Class
//
class csearchengine_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'searchengine';

	// Page Object Name
	var $PageObjName = 'searchengine_view';

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
	function csearchengine_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["searchengine"] = new csearchengine();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

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
	$searchengine->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $searchengine->Export; // Get export parameter, used in header
	$gsExportFile = $searchengine->TableVar; // Get export file, used in header
	if (@$_GET["id"] <> "") {
		if ($gsExportFile <> "") $gsExportFile .= "_";
		$gsExportFile .= ew_StripSlashes($_GET["id"]);
	}
	if ($searchengine->Export == "print" || $searchengine->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($searchengine->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($searchengine->Export == "word") {
		header('Content-Type: application/vnd.ms-word;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($searchengine->Export == "xml") {
		header('Content-Type: text/xml;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($searchengine->Export == "csv") {
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
		global $searchengine;

		// Paging variables
		$this->lDisplayRecs = 1;
		$this->lRecRange = 10;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$searchengine->id->setQueryStringValue($_GET["id"]);
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$searchengine->CurrentAction = "I"; // Display form
			switch ($searchengine->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					$rs = $this->LoadRecordset(); // Load records
					$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage("No records found"); // Set no record message
						$this->Page_Terminate("searchenginelist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($searchengine->id->CurrentValue) == strval($rs->fields('id'))) {
								$searchengine->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "searchenginelist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}

			// Export data only
			if ($searchengine->Export == "html" || $searchengine->Export == "csv" ||
				$searchengine->Export == "word" || $searchengine->Export == "excel" ||
				$searchengine->Export == "xml") {
				$this->ExportData();
				$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "searchenginelist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$searchengine->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $searchengine;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$searchengine->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$searchengine->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $searchengine->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$searchengine->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$searchengine->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$searchengine->setStartRecordNumber($this->lStartRec);
		}
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

		// description
		$searchengine->description->CellCssStyle = "";
		$searchengine->description->CellCssClass = "";

		// keywords
		$searchengine->keywords->CellCssStyle = "";
		$searchengine->keywords->CellCssClass = "";

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

			// description
			$searchengine->description->HrefValue = "";

			// keywords
			$searchengine->keywords->HrefValue = "";

			// title
			$searchengine->title->HrefValue = "";
		}

		// Call Row Rendered event
		$searchengine->Row_Rendered();
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $searchengine;
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
		if ($searchengine->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo "\xEF\xBB\xBF";
			echo ew_ExportHeader($searchengine->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $searchengine->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id', $searchengine->Export);
				ew_ExportAddValue($sExportStr, 'page', $searchengine->Export);
				ew_ExportAddValue($sExportStr, 'description', $searchengine->Export);
				ew_ExportAddValue($sExportStr, 'keywords', $searchengine->Export);
				ew_ExportAddValue($sExportStr, 'title', $searchengine->Export);
				echo ew_ExportLine($sExportStr, $searchengine->Export);
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
				$searchengine->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($searchengine->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id', $searchengine->id->CurrentValue);
					$XmlDoc->AddField('zpage', $searchengine->zpage->CurrentValue);
					$XmlDoc->AddField('description', $searchengine->description->CurrentValue);
					$XmlDoc->AddField('keywords', $searchengine->keywords->CurrentValue);
					$XmlDoc->AddField('title', $searchengine->title->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $searchengine->Export <> "csv") { // Vertical format
						echo ew_ExportField('id', $searchengine->id->ExportValue($searchengine->Export, $searchengine->ExportOriginalValue), $searchengine->Export);
						echo ew_ExportField('page', $searchengine->zpage->ExportValue($searchengine->Export, $searchengine->ExportOriginalValue), $searchengine->Export);
						echo ew_ExportField('description', $searchengine->description->ExportValue($searchengine->Export, $searchengine->ExportOriginalValue), $searchengine->Export);
						echo ew_ExportField('keywords', $searchengine->keywords->ExportValue($searchengine->Export, $searchengine->ExportOriginalValue), $searchengine->Export);
						echo ew_ExportField('title', $searchengine->title->ExportValue($searchengine->Export, $searchengine->ExportOriginalValue), $searchengine->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $searchengine->id->ExportValue($searchengine->Export, $searchengine->ExportOriginalValue), $searchengine->Export);
						ew_ExportAddValue($sExportStr, $searchengine->zpage->ExportValue($searchengine->Export, $searchengine->ExportOriginalValue), $searchengine->Export);
						ew_ExportAddValue($sExportStr, $searchengine->description->ExportValue($searchengine->Export, $searchengine->ExportOriginalValue), $searchengine->Export);
						ew_ExportAddValue($sExportStr, $searchengine->keywords->ExportValue($searchengine->Export, $searchengine->ExportOriginalValue), $searchengine->Export);
						ew_ExportAddValue($sExportStr, $searchengine->title->ExportValue($searchengine->Export, $searchengine->ExportOriginalValue), $searchengine->Export);
						echo ew_ExportLine($sExportStr, $searchengine->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($searchengine->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($searchengine->Export);
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
