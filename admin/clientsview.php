<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "clientsinfo.php" ?>
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
$clients_view = new cclients_view();
$Page =& $clients_view;

// Page init processing
$clients_view->Page_Init();

// Page main processing
$clients_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($clients->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var clients_view = new ew_Page("clients_view");

// page properties
clients_view.PageID = "view"; // page ID
var EW_PAGE_ID = clients_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
clients_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
clients_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
clients_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
clients_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
clients_view.ShowHighlightText = "Show highlight"; 
clients_view.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">View TABLE: clients
<?php if ($clients->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $clients_view->PageUrl() ?>export=print&id=<?php echo ew_HtmlEncode($clients->id->CurrentValue) ?>">Printer Friendly</a>
&nbsp;&nbsp;<a href="<?php echo $clients_view->PageUrl() ?>export=html&id=<?php echo ew_HtmlEncode($clients->id->CurrentValue) ?>">Export to HTML</a>
&nbsp;&nbsp;<a href="<?php echo $clients_view->PageUrl() ?>export=excel&id=<?php echo ew_HtmlEncode($clients->id->CurrentValue) ?>">Export to Excel</a>
&nbsp;&nbsp;<a href="<?php echo $clients_view->PageUrl() ?>export=word&id=<?php echo ew_HtmlEncode($clients->id->CurrentValue) ?>">Export to Word</a>
&nbsp;&nbsp;<a href="<?php echo $clients_view->PageUrl() ?>export=xml&id=<?php echo ew_HtmlEncode($clients->id->CurrentValue) ?>">Export to XML</a>
&nbsp;&nbsp;<a href="<?php echo $clients_view->PageUrl() ?>export=csv&id=<?php echo ew_HtmlEncode($clients->id->CurrentValue) ?>">Export to CSV</a>
<?php } ?>
<br><br>
<?php if ($clients->Export == "") { ?>
<a href="clientslist.php">Back to List</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $clients->AddUrl() ?>">Add</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $clients->EditUrl() ?>">Edit</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $clients->CopyUrl() ?>">Copy</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a onclick="return ew_Confirm('Do you want to delete this record?');" href="<?php echo $clients->DeleteUrl() ?>">Delete</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $clients_view->ShowMessage() ?>
<p>
<?php if ($clients->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($clients_view->Pager)) $clients_view->Pager = new cPrevNextPager($clients_view->lStartRec, $clients_view->lDisplayRecs, $clients_view->lTotalRecs) ?>
<?php if ($clients_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($clients_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $clients_view->PageUrl() ?>start=<?php echo $clients_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($clients_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $clients_view->PageUrl() ?>start=<?php echo $clients_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $clients_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($clients_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $clients_view->PageUrl() ?>start=<?php echo $clients_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($clients_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $clients_view->PageUrl() ?>start=<?php echo $clients_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $clients_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($clients_view->sSrchWhere == "0=101") { ?>
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
<?php if ($clients->id->Visible) { // id ?>
	<tr<?php echo $clients->id->RowAttributes ?>>
		<td class="ewTableHeader">id</td>
		<td<?php echo $clients->id->CellAttributes() ?>>
<div<?php echo $clients->id->ViewAttributes() ?>><?php echo $clients->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($clients->image->Visible) { // image ?>
	<tr<?php echo $clients->image->RowAttributes ?>>
		<td class="ewTableHeader">image</td>
		<td<?php echo $clients->image->CellAttributes() ?>>
<?php if ($clients->image->HrefValue <> "") { ?>
<?php if (!is_null($clients->image->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $clients->image->Upload->DbValue ?>" border=0<?php echo $clients->image->ViewAttributes() ?>>
<?php } elseif (!in_array($clients->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($clients->image->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $clients->image->Upload->DbValue ?>" border=0<?php echo $clients->image->ViewAttributes() ?>>
<?php } elseif (!in_array($clients->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($clients->order->Visible) { // order ?>
	<tr<?php echo $clients->order->RowAttributes ?>>
		<td class="ewTableHeader">order</td>
		<td<?php echo $clients->order->CellAttributes() ?>>
<div<?php echo $clients->order->ViewAttributes() ?>><?php echo $clients->order->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($clients->active->Visible) { // active ?>
	<tr<?php echo $clients->active->RowAttributes ?>>
		<td class="ewTableHeader">active</td>
		<td<?php echo $clients->active->CellAttributes() ?>>
<div<?php echo $clients->active->ViewAttributes() ?>><?php echo $clients->active->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($clients->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($clients_view->Pager)) $clients_view->Pager = new cPrevNextPager($clients_view->lStartRec, $clients_view->lDisplayRecs, $clients_view->lTotalRecs) ?>
<?php if ($clients_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($clients_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $clients_view->PageUrl() ?>start=<?php echo $clients_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($clients_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $clients_view->PageUrl() ?>start=<?php echo $clients_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $clients_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($clients_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $clients_view->PageUrl() ?>start=<?php echo $clients_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($clients_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $clients_view->PageUrl() ?>start=<?php echo $clients_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $clients_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($clients_view->sSrchWhere == "0=101") { ?>
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
<?php if ($clients->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$clients_view->Page_Terminate();
?>
<?php

//
// Page Class
//
class cclients_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'clients';

	// Page Object Name
	var $PageObjName = 'clients_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $clients;
		if ($clients->UseTokenInUrl) $PageUrl .= "t=" . $clients->TableVar . "&"; // add page token
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
		global $objForm, $clients;
		if ($clients->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($clients->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($clients->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cclients_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["clients"] = new cclients();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'clients', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $clients;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$clients->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $clients->Export; // Get export parameter, used in header
	$gsExportFile = $clients->TableVar; // Get export file, used in header
	if (@$_GET["id"] <> "") {
		if ($gsExportFile <> "") $gsExportFile .= "_";
		$gsExportFile .= ew_StripSlashes($_GET["id"]);
	}
	if ($clients->Export == "print" || $clients->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($clients->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($clients->Export == "word") {
		header('Content-Type: application/vnd.ms-word;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($clients->Export == "xml") {
		header('Content-Type: text/xml;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($clients->Export == "csv") {
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
		global $clients;

		// Paging variables
		$this->lDisplayRecs = 1;
		$this->lRecRange = 10;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$clients->id->setQueryStringValue($_GET["id"]);
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$clients->CurrentAction = "I"; // Display form
			switch ($clients->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					$rs = $this->LoadRecordset(); // Load records
					$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage("No records found"); // Set no record message
						$this->Page_Terminate("clientslist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($clients->id->CurrentValue) == strval($rs->fields('id'))) {
								$clients->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "clientslist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}

			// Export data only
			if ($clients->Export == "html" || $clients->Export == "csv" ||
				$clients->Export == "word" || $clients->Export == "excel" ||
				$clients->Export == "xml") {
				$this->ExportData();
				$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "clientslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$clients->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $clients;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$clients->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$clients->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $clients->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$clients->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$clients->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$clients->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $clients;

		// Call Recordset Selecting event
		$clients->Recordset_Selecting($clients->CurrentFilter);

		// Load list page SQL
		$sSql = $clients->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$clients->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $clients;
		$sFilter = $clients->KeyFilter();

		// Call Row Selecting event
		$clients->Row_Selecting($sFilter);

		// Load sql based on filter
		$clients->CurrentFilter = $sFilter;
		$sSql = $clients->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$clients->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $clients;
		$clients->id->setDbValue($rs->fields('id'));
		$clients->image->Upload->DbValue = $rs->fields('image');
		$clients->order->setDbValue($rs->fields('order'));
		$clients->active->setDbValue($rs->fields('active'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $clients;

		// Call Row_Rendering event
		$clients->Row_Rendering();

		// Common render codes for all row types
		// id

		$clients->id->CellCssStyle = "";
		$clients->id->CellCssClass = "";

		// image
		$clients->image->CellCssStyle = "";
		$clients->image->CellCssClass = "";

		// order
		$clients->order->CellCssStyle = "";
		$clients->order->CellCssClass = "";

		// active
		$clients->active->CellCssStyle = "";
		$clients->active->CellCssClass = "";
		if ($clients->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$clients->id->ViewValue = $clients->id->CurrentValue;
			$clients->id->CssStyle = "";
			$clients->id->CssClass = "";
			$clients->id->ViewCustomAttributes = "";

			// image
			if (!is_null($clients->image->Upload->DbValue)) {
				$clients->image->ViewValue = $clients->image->Upload->DbValue;
				$clients->image->ImageWidth = 100;
				$clients->image->ImageHeight = 0;
				$clients->image->ImageAlt = "";
			} else {
				$clients->image->ViewValue = "";
			}
			$clients->image->CssStyle = "";
			$clients->image->CssClass = "";
			$clients->image->ViewCustomAttributes = "";

			// order
			$clients->order->ViewValue = $clients->order->CurrentValue;
			$clients->order->CssStyle = "";
			$clients->order->CssClass = "";
			$clients->order->ViewCustomAttributes = "";

			// active
			if (strval($clients->active->CurrentValue) <> "") {
				switch ($clients->active->CurrentValue) {
					case "0":
						$clients->active->ViewValue = "No";
						break;
					case "1":
						$clients->active->ViewValue = "Yes";
						break;
					default:
						$clients->active->ViewValue = $clients->active->CurrentValue;
				}
			} else {
				$clients->active->ViewValue = NULL;
			}
			$clients->active->CssStyle = "";
			$clients->active->CssClass = "";
			$clients->active->ViewCustomAttributes = "";

			// id
			$clients->id->HrefValue = "";

			// image
			$clients->image->HrefValue = "";

			// order
			$clients->order->HrefValue = "";

			// active
			$clients->active->HrefValue = "";
		}

		// Call Row Rendered event
		$clients->Row_Rendered();
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $clients;
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
		if ($clients->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo "\xEF\xBB\xBF";
			echo ew_ExportHeader($clients->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $clients->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id', $clients->Export);
				ew_ExportAddValue($sExportStr, 'image', $clients->Export);
				ew_ExportAddValue($sExportStr, 'order', $clients->Export);
				ew_ExportAddValue($sExportStr, 'active', $clients->Export);
				echo ew_ExportLine($sExportStr, $clients->Export);
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
				$clients->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($clients->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id', $clients->id->CurrentValue);
					$XmlDoc->AddField('image', $clients->image->CurrentValue);
					$XmlDoc->AddField('order', $clients->order->CurrentValue);
					$XmlDoc->AddField('active', $clients->active->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $clients->Export <> "csv") { // Vertical format
						echo ew_ExportField('id', $clients->id->ExportValue($clients->Export, $clients->ExportOriginalValue), $clients->Export);
						echo ew_ExportField('image', $clients->image->ExportValue($clients->Export, $clients->ExportOriginalValue), $clients->Export);
						echo ew_ExportField('order', $clients->order->ExportValue($clients->Export, $clients->ExportOriginalValue), $clients->Export);
						echo ew_ExportField('active', $clients->active->ExportValue($clients->Export, $clients->ExportOriginalValue), $clients->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $clients->id->ExportValue($clients->Export, $clients->ExportOriginalValue), $clients->Export);
						ew_ExportAddValue($sExportStr, $clients->image->ExportValue($clients->Export, $clients->ExportOriginalValue), $clients->Export);
						ew_ExportAddValue($sExportStr, $clients->order->ExportValue($clients->Export, $clients->ExportOriginalValue), $clients->Export);
						ew_ExportAddValue($sExportStr, $clients->active->ExportValue($clients->Export, $clients->ExportOriginalValue), $clients->Export);
						echo ew_ExportLine($sExportStr, $clients->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($clients->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($clients->Export);
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
