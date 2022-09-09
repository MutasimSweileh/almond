<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
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
$users_view = new cusers_view();
$Page =& $users_view;

// Page init processing
$users_view->Page_Init();

// Page main processing
$users_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($users->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var users_view = new ew_Page("users_view");

// page properties
users_view.PageID = "view"; // page ID
var EW_PAGE_ID = users_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
users_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
users_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
users_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
users_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
users_view.ShowHighlightText = "Show highlight"; 
users_view.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">View TABLE: users
<?php if ($users->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $users_view->PageUrl() ?>export=print&id=<?php echo ew_HtmlEncode($users->id->CurrentValue) ?>">Printer Friendly</a>
&nbsp;&nbsp;<a href="<?php echo $users_view->PageUrl() ?>export=html&id=<?php echo ew_HtmlEncode($users->id->CurrentValue) ?>">Export to HTML</a>
&nbsp;&nbsp;<a href="<?php echo $users_view->PageUrl() ?>export=excel&id=<?php echo ew_HtmlEncode($users->id->CurrentValue) ?>">Export to Excel</a>
&nbsp;&nbsp;<a href="<?php echo $users_view->PageUrl() ?>export=word&id=<?php echo ew_HtmlEncode($users->id->CurrentValue) ?>">Export to Word</a>
&nbsp;&nbsp;<a href="<?php echo $users_view->PageUrl() ?>export=xml&id=<?php echo ew_HtmlEncode($users->id->CurrentValue) ?>">Export to XML</a>
&nbsp;&nbsp;<a href="<?php echo $users_view->PageUrl() ?>export=csv&id=<?php echo ew_HtmlEncode($users->id->CurrentValue) ?>">Export to CSV</a>
<?php } ?>
<br><br>
<?php if ($users->Export == "") { ?>
<a href="userslist.php">Back to List</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $users->AddUrl() ?>">Add</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $users->EditUrl() ?>">Edit</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $users->CopyUrl() ?>">Copy</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a onclick="return ew_Confirm('Do you want to delete this record?');" href="<?php echo $users->DeleteUrl() ?>">Delete</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $users_view->ShowMessage() ?>
<p>
<?php if ($users->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($users_view->Pager)) $users_view->Pager = new cPrevNextPager($users_view->lStartRec, $users_view->lDisplayRecs, $users_view->lTotalRecs) ?>
<?php if ($users_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($users_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $users_view->PageUrl() ?>start=<?php echo $users_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($users_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $users_view->PageUrl() ?>start=<?php echo $users_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $users_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($users_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $users_view->PageUrl() ?>start=<?php echo $users_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($users_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $users_view->PageUrl() ?>start=<?php echo $users_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $users_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($users_view->sSrchWhere == "0=101") { ?>
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
<?php if ($users->id->Visible) { // id ?>
	<tr<?php echo $users->id->RowAttributes ?>>
		<td class="ewTableHeader">id</td>
		<td<?php echo $users->id->CellAttributes() ?>>
<div<?php echo $users->id->ViewAttributes() ?>><?php echo $users->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($users->username->Visible) { // username ?>
	<tr<?php echo $users->username->RowAttributes ?>>
		<td class="ewTableHeader">username</td>
		<td<?php echo $users->username->CellAttributes() ?>>
<div<?php echo $users->username->ViewAttributes() ?>><?php echo $users->username->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($users->password->Visible) { // password ?>
	<tr<?php echo $users->password->RowAttributes ?>>
		<td class="ewTableHeader">password</td>
		<td<?php echo $users->password->CellAttributes() ?>>
<div<?php echo $users->password->ViewAttributes() ?>><?php echo $users->password->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($users->zemail->Visible) { // email ?>
	<tr<?php echo $users->zemail->RowAttributes ?>>
		<td class="ewTableHeader">email</td>
		<td<?php echo $users->zemail->CellAttributes() ?>>
<div<?php echo $users->zemail->ViewAttributes() ?>><?php echo $users->zemail->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($users->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($users_view->Pager)) $users_view->Pager = new cPrevNextPager($users_view->lStartRec, $users_view->lDisplayRecs, $users_view->lTotalRecs) ?>
<?php if ($users_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($users_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $users_view->PageUrl() ?>start=<?php echo $users_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($users_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $users_view->PageUrl() ?>start=<?php echo $users_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $users_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($users_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $users_view->PageUrl() ?>start=<?php echo $users_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($users_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $users_view->PageUrl() ?>start=<?php echo $users_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $users_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($users_view->sSrchWhere == "0=101") { ?>
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
<?php if ($users->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$users_view->Page_Terminate();
?>
<?php

//
// Page Class
//
class cusers_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'users';

	// Page Object Name
	var $PageObjName = 'users_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $users;
		if ($users->UseTokenInUrl) $PageUrl .= "t=" . $users->TableVar . "&"; // add page token
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
		global $objForm, $users;
		if ($users->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($users->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($users->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cusers_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["users"] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'users', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $users;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$users->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $users->Export; // Get export parameter, used in header
	$gsExportFile = $users->TableVar; // Get export file, used in header
	if (@$_GET["id"] <> "") {
		if ($gsExportFile <> "") $gsExportFile .= "_";
		$gsExportFile .= ew_StripSlashes($_GET["id"]);
	}
	if ($users->Export == "print" || $users->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($users->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($users->Export == "word") {
		header('Content-Type: application/vnd.ms-word;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($users->Export == "xml") {
		header('Content-Type: text/xml;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($users->Export == "csv") {
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
		global $users;

		// Paging variables
		$this->lDisplayRecs = 1;
		$this->lRecRange = 10;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$users->id->setQueryStringValue($_GET["id"]);
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$users->CurrentAction = "I"; // Display form
			switch ($users->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					$rs = $this->LoadRecordset(); // Load records
					$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage("No records found"); // Set no record message
						$this->Page_Terminate("userslist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($users->id->CurrentValue) == strval($rs->fields('id'))) {
								$users->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "userslist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}

			// Export data only
			if ($users->Export == "html" || $users->Export == "csv" ||
				$users->Export == "word" || $users->Export == "excel" ||
				$users->Export == "xml") {
				$this->ExportData();
				$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "userslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$users->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $users;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$users->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$users->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $users->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$users->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$users->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$users->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $users;

		// Call Recordset Selecting event
		$users->Recordset_Selecting($users->CurrentFilter);

		// Load list page SQL
		$sSql = $users->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$users->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $users;
		$sFilter = $users->KeyFilter();

		// Call Row Selecting event
		$users->Row_Selecting($sFilter);

		// Load sql based on filter
		$users->CurrentFilter = $sFilter;
		$sSql = $users->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$users->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $users;
		$users->id->setDbValue($rs->fields('id'));
		$users->username->setDbValue($rs->fields('username'));
		$users->password->setDbValue($rs->fields('password'));
		$users->zemail->setDbValue($rs->fields('email'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $users;

		// Call Row_Rendering event
		$users->Row_Rendering();

		// Common render codes for all row types
		// id

		$users->id->CellCssStyle = "";
		$users->id->CellCssClass = "";

		// username
		$users->username->CellCssStyle = "";
		$users->username->CellCssClass = "";

		// password
		$users->password->CellCssStyle = "";
		$users->password->CellCssClass = "";

		// email
		$users->zemail->CellCssStyle = "";
		$users->zemail->CellCssClass = "";
		if ($users->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$users->id->ViewValue = $users->id->CurrentValue;
			$users->id->CssStyle = "";
			$users->id->CssClass = "";
			$users->id->ViewCustomAttributes = "";

			// username
			$users->username->ViewValue = $users->username->CurrentValue;
			$users->username->CssStyle = "";
			$users->username->CssClass = "";
			$users->username->ViewCustomAttributes = "";

			// password
			$users->password->ViewValue = $users->password->CurrentValue;
			$users->password->CssStyle = "";
			$users->password->CssClass = "";
			$users->password->ViewCustomAttributes = "";

			// email
			$users->zemail->ViewValue = $users->zemail->CurrentValue;
			$users->zemail->CssStyle = "";
			$users->zemail->CssClass = "";
			$users->zemail->ViewCustomAttributes = "";

			// id
			$users->id->HrefValue = "";

			// username
			$users->username->HrefValue = "";

			// password
			$users->password->HrefValue = "";

			// email
			$users->zemail->HrefValue = "";
		}

		// Call Row Rendered event
		$users->Row_Rendered();
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $users;
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
		if ($users->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo "\xEF\xBB\xBF";
			echo ew_ExportHeader($users->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $users->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id', $users->Export);
				ew_ExportAddValue($sExportStr, 'username', $users->Export);
				ew_ExportAddValue($sExportStr, 'password', $users->Export);
				ew_ExportAddValue($sExportStr, 'email', $users->Export);
				echo ew_ExportLine($sExportStr, $users->Export);
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
				$users->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($users->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id', $users->id->CurrentValue);
					$XmlDoc->AddField('username', $users->username->CurrentValue);
					$XmlDoc->AddField('password', $users->password->CurrentValue);
					$XmlDoc->AddField('zemail', $users->zemail->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $users->Export <> "csv") { // Vertical format
						echo ew_ExportField('id', $users->id->ExportValue($users->Export, $users->ExportOriginalValue), $users->Export);
						echo ew_ExportField('username', $users->username->ExportValue($users->Export, $users->ExportOriginalValue), $users->Export);
						echo ew_ExportField('password', $users->password->ExportValue($users->Export, $users->ExportOriginalValue), $users->Export);
						echo ew_ExportField('email', $users->zemail->ExportValue($users->Export, $users->ExportOriginalValue), $users->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $users->id->ExportValue($users->Export, $users->ExportOriginalValue), $users->Export);
						ew_ExportAddValue($sExportStr, $users->username->ExportValue($users->Export, $users->ExportOriginalValue), $users->Export);
						ew_ExportAddValue($sExportStr, $users->password->ExportValue($users->Export, $users->ExportOriginalValue), $users->Export);
						ew_ExportAddValue($sExportStr, $users->zemail->ExportValue($users->Export, $users->ExportOriginalValue), $users->Export);
						echo ew_ExportLine($sExportStr, $users->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($users->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($users->Export);
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
