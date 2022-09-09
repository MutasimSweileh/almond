<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "categoriesinfo.php" ?>
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
$categories_view = new ccategories_view();
$Page =& $categories_view;

// Page init processing
$categories_view->Page_Init();

// Page main processing
$categories_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($categories->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var categories_view = new ew_Page("categories_view");

// page properties
categories_view.PageID = "view"; // page ID
var EW_PAGE_ID = categories_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
categories_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
categories_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
categories_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
categories_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
categories_view.ShowHighlightText = "Show highlight"; 
categories_view.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">View TABLE: categories
<?php if ($categories->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $categories_view->PageUrl() ?>export=print&id=<?php echo ew_HtmlEncode($categories->id->CurrentValue) ?>">Printer Friendly</a>
&nbsp;&nbsp;<a href="<?php echo $categories_view->PageUrl() ?>export=html&id=<?php echo ew_HtmlEncode($categories->id->CurrentValue) ?>">Export to HTML</a>
&nbsp;&nbsp;<a href="<?php echo $categories_view->PageUrl() ?>export=excel&id=<?php echo ew_HtmlEncode($categories->id->CurrentValue) ?>">Export to Excel</a>
&nbsp;&nbsp;<a href="<?php echo $categories_view->PageUrl() ?>export=word&id=<?php echo ew_HtmlEncode($categories->id->CurrentValue) ?>">Export to Word</a>
&nbsp;&nbsp;<a href="<?php echo $categories_view->PageUrl() ?>export=xml&id=<?php echo ew_HtmlEncode($categories->id->CurrentValue) ?>">Export to XML</a>
&nbsp;&nbsp;<a href="<?php echo $categories_view->PageUrl() ?>export=csv&id=<?php echo ew_HtmlEncode($categories->id->CurrentValue) ?>">Export to CSV</a>
<?php } ?>
<br><br>
<?php if ($categories->Export == "") { ?>
<a href="categorieslist.php">Back to List</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $categories->AddUrl() ?>">Add</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $categories->EditUrl() ?>">Edit</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $categories->CopyUrl() ?>">Copy</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a onclick="return ew_Confirm('Do you want to delete this record?');" href="<?php echo $categories->DeleteUrl() ?>">Delete</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="gallerylist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=categories&id=<?php echo urlencode(strval($categories->id->CurrentValue)) ?>">gallery...</a>
&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $categories_view->ShowMessage() ?>
<p>
<?php if ($categories->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($categories_view->Pager)) $categories_view->Pager = new cPrevNextPager($categories_view->lStartRec, $categories_view->lDisplayRecs, $categories_view->lTotalRecs) ?>
<?php if ($categories_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($categories_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $categories_view->PageUrl() ?>start=<?php echo $categories_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($categories_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $categories_view->PageUrl() ?>start=<?php echo $categories_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $categories_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($categories_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $categories_view->PageUrl() ?>start=<?php echo $categories_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($categories_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $categories_view->PageUrl() ?>start=<?php echo $categories_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $categories_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($categories_view->sSrchWhere == "0=101") { ?>
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
<?php if ($categories->id->Visible) { // id ?>
	<tr<?php echo $categories->id->RowAttributes ?>>
		<td class="ewTableHeader">id</td>
		<td<?php echo $categories->id->CellAttributes() ?>>
<div<?php echo $categories->id->ViewAttributes() ?>><?php echo $categories->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($categories->name->Visible) { // name ?>
	<tr<?php echo $categories->name->RowAttributes ?>>
		<td class="ewTableHeader">name</td>
		<td<?php echo $categories->name->CellAttributes() ?>>
<div<?php echo $categories->name->ViewAttributes() ?>><?php echo $categories->name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($categories->name_arabic->Visible) { // name_arabic ?>
	<tr<?php echo $categories->name_arabic->RowAttributes ?>>
		<td class="ewTableHeader">name arabic</td>
		<td<?php echo $categories->name_arabic->CellAttributes() ?>>
<div<?php echo $categories->name_arabic->ViewAttributes() ?>><?php echo $categories->name_arabic->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($categories->order->Visible) { // order ?>
	<tr<?php echo $categories->order->RowAttributes ?>>
		<td class="ewTableHeader">order</td>
		<td<?php echo $categories->order->CellAttributes() ?>>
<div<?php echo $categories->order->ViewAttributes() ?>><?php echo $categories->order->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($categories->active->Visible) { // active ?>
	<tr<?php echo $categories->active->RowAttributes ?>>
		<td class="ewTableHeader">active</td>
		<td<?php echo $categories->active->CellAttributes() ?>>
<div<?php echo $categories->active->ViewAttributes() ?>><?php echo $categories->active->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($categories->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($categories_view->Pager)) $categories_view->Pager = new cPrevNextPager($categories_view->lStartRec, $categories_view->lDisplayRecs, $categories_view->lTotalRecs) ?>
<?php if ($categories_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($categories_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $categories_view->PageUrl() ?>start=<?php echo $categories_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($categories_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $categories_view->PageUrl() ?>start=<?php echo $categories_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $categories_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($categories_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $categories_view->PageUrl() ?>start=<?php echo $categories_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($categories_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $categories_view->PageUrl() ?>start=<?php echo $categories_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $categories_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($categories_view->sSrchWhere == "0=101") { ?>
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
<?php if ($categories->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$categories_view->Page_Terminate();
?>
<?php

//
// Page Class
//
class ccategories_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'categories';

	// Page Object Name
	var $PageObjName = 'categories_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $categories;
		if ($categories->UseTokenInUrl) $PageUrl .= "t=" . $categories->TableVar . "&"; // add page token
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
		global $objForm, $categories;
		if ($categories->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($categories->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($categories->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccategories_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["categories"] = new ccategories();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'categories', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $categories;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$categories->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $categories->Export; // Get export parameter, used in header
	$gsExportFile = $categories->TableVar; // Get export file, used in header
	if (@$_GET["id"] <> "") {
		if ($gsExportFile <> "") $gsExportFile .= "_";
		$gsExportFile .= ew_StripSlashes($_GET["id"]);
	}
	if ($categories->Export == "print" || $categories->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($categories->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($categories->Export == "word") {
		header('Content-Type: application/vnd.ms-word;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($categories->Export == "xml") {
		header('Content-Type: text/xml;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($categories->Export == "csv") {
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
		global $categories;

		// Paging variables
		$this->lDisplayRecs = 1;
		$this->lRecRange = 10;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$categories->id->setQueryStringValue($_GET["id"]);
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$categories->CurrentAction = "I"; // Display form
			switch ($categories->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					$rs = $this->LoadRecordset(); // Load records
					$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage("No records found"); // Set no record message
						$this->Page_Terminate("categorieslist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($categories->id->CurrentValue) == strval($rs->fields('id'))) {
								$categories->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "categorieslist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}

			// Export data only
			if ($categories->Export == "html" || $categories->Export == "csv" ||
				$categories->Export == "word" || $categories->Export == "excel" ||
				$categories->Export == "xml") {
				$this->ExportData();
				$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "categorieslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$categories->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $categories;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$categories->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$categories->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $categories->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$categories->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$categories->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$categories->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $categories;

		// Call Recordset Selecting event
		$categories->Recordset_Selecting($categories->CurrentFilter);

		// Load list page SQL
		$sSql = $categories->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$categories->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $categories;
		$sFilter = $categories->KeyFilter();

		// Call Row Selecting event
		$categories->Row_Selecting($sFilter);

		// Load sql based on filter
		$categories->CurrentFilter = $sFilter;
		$sSql = $categories->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$categories->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $categories;
		$categories->id->setDbValue($rs->fields('id'));
		$categories->name->setDbValue($rs->fields('name'));
		$categories->name_arabic->setDbValue($rs->fields('name_arabic'));
		$categories->order->setDbValue($rs->fields('order'));
		$categories->active->setDbValue($rs->fields('active'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $categories;

		// Call Row_Rendering event
		$categories->Row_Rendering();

		// Common render codes for all row types
		// id

		$categories->id->CellCssStyle = "";
		$categories->id->CellCssClass = "";

		// name
		$categories->name->CellCssStyle = "";
		$categories->name->CellCssClass = "";

		// name_arabic
		$categories->name_arabic->CellCssStyle = "";
		$categories->name_arabic->CellCssClass = "";

		// order
		$categories->order->CellCssStyle = "";
		$categories->order->CellCssClass = "";

		// active
		$categories->active->CellCssStyle = "";
		$categories->active->CellCssClass = "";
		if ($categories->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$categories->id->ViewValue = $categories->id->CurrentValue;
			$categories->id->CssStyle = "";
			$categories->id->CssClass = "";
			$categories->id->ViewCustomAttributes = "";

			// name
			$categories->name->ViewValue = $categories->name->CurrentValue;
			$categories->name->CssStyle = "";
			$categories->name->CssClass = "";
			$categories->name->ViewCustomAttributes = "";

			// name_arabic
			$categories->name_arabic->ViewValue = $categories->name_arabic->CurrentValue;
			$categories->name_arabic->CssStyle = "";
			$categories->name_arabic->CssClass = "";
			$categories->name_arabic->ViewCustomAttributes = "";

			// order
			$categories->order->ViewValue = $categories->order->CurrentValue;
			$categories->order->CssStyle = "";
			$categories->order->CssClass = "";
			$categories->order->ViewCustomAttributes = "";

			// active
			if (strval($categories->active->CurrentValue) <> "") {
				switch ($categories->active->CurrentValue) {
					case "0":
						$categories->active->ViewValue = "No";
						break;
					case "1":
						$categories->active->ViewValue = "Yes";
						break;
					default:
						$categories->active->ViewValue = $categories->active->CurrentValue;
				}
			} else {
				$categories->active->ViewValue = NULL;
			}
			$categories->active->CssStyle = "";
			$categories->active->CssClass = "";
			$categories->active->ViewCustomAttributes = "";

			// id
			$categories->id->HrefValue = "";

			// name
			$categories->name->HrefValue = "";

			// name_arabic
			$categories->name_arabic->HrefValue = "";

			// order
			$categories->order->HrefValue = "";

			// active
			$categories->active->HrefValue = "";
		}

		// Call Row Rendered event
		$categories->Row_Rendered();
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $categories;
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
		if ($categories->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo "\xEF\xBB\xBF";
			echo ew_ExportHeader($categories->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $categories->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id', $categories->Export);
				ew_ExportAddValue($sExportStr, 'name', $categories->Export);
				ew_ExportAddValue($sExportStr, 'name_arabic', $categories->Export);
				ew_ExportAddValue($sExportStr, 'order', $categories->Export);
				ew_ExportAddValue($sExportStr, 'active', $categories->Export);
				echo ew_ExportLine($sExportStr, $categories->Export);
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
				$categories->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($categories->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id', $categories->id->CurrentValue);
					$XmlDoc->AddField('name', $categories->name->CurrentValue);
					$XmlDoc->AddField('name_arabic', $categories->name_arabic->CurrentValue);
					$XmlDoc->AddField('order', $categories->order->CurrentValue);
					$XmlDoc->AddField('active', $categories->active->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $categories->Export <> "csv") { // Vertical format
						echo ew_ExportField('id', $categories->id->ExportValue($categories->Export, $categories->ExportOriginalValue), $categories->Export);
						echo ew_ExportField('name', $categories->name->ExportValue($categories->Export, $categories->ExportOriginalValue), $categories->Export);
						echo ew_ExportField('name_arabic', $categories->name_arabic->ExportValue($categories->Export, $categories->ExportOriginalValue), $categories->Export);
						echo ew_ExportField('order', $categories->order->ExportValue($categories->Export, $categories->ExportOriginalValue), $categories->Export);
						echo ew_ExportField('active', $categories->active->ExportValue($categories->Export, $categories->ExportOriginalValue), $categories->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $categories->id->ExportValue($categories->Export, $categories->ExportOriginalValue), $categories->Export);
						ew_ExportAddValue($sExportStr, $categories->name->ExportValue($categories->Export, $categories->ExportOriginalValue), $categories->Export);
						ew_ExportAddValue($sExportStr, $categories->name_arabic->ExportValue($categories->Export, $categories->ExportOriginalValue), $categories->Export);
						ew_ExportAddValue($sExportStr, $categories->order->ExportValue($categories->Export, $categories->ExportOriginalValue), $categories->Export);
						ew_ExportAddValue($sExportStr, $categories->active->ExportValue($categories->Export, $categories->ExportOriginalValue), $categories->Export);
						echo ew_ExportLine($sExportStr, $categories->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($categories->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($categories->Export);
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
