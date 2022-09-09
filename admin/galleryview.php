<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "galleryinfo.php" ?>
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
$gallery_view = new cgallery_view();
$Page =& $gallery_view;

// Page init processing
$gallery_view->Page_Init();

// Page main processing
$gallery_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($gallery->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var gallery_view = new ew_Page("gallery_view");

// page properties
gallery_view.PageID = "view"; // page ID
var EW_PAGE_ID = gallery_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
gallery_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
gallery_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
gallery_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
gallery_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
gallery_view.ShowHighlightText = "Show highlight"; 
gallery_view.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">View TABLE: gallery
<?php if ($gallery->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $gallery_view->PageUrl() ?>export=print&id=<?php echo ew_HtmlEncode($gallery->id->CurrentValue) ?>">Printer Friendly</a>
&nbsp;&nbsp;<a href="<?php echo $gallery_view->PageUrl() ?>export=html&id=<?php echo ew_HtmlEncode($gallery->id->CurrentValue) ?>">Export to HTML</a>
&nbsp;&nbsp;<a href="<?php echo $gallery_view->PageUrl() ?>export=excel&id=<?php echo ew_HtmlEncode($gallery->id->CurrentValue) ?>">Export to Excel</a>
&nbsp;&nbsp;<a href="<?php echo $gallery_view->PageUrl() ?>export=word&id=<?php echo ew_HtmlEncode($gallery->id->CurrentValue) ?>">Export to Word</a>
&nbsp;&nbsp;<a href="<?php echo $gallery_view->PageUrl() ?>export=xml&id=<?php echo ew_HtmlEncode($gallery->id->CurrentValue) ?>">Export to XML</a>
&nbsp;&nbsp;<a href="<?php echo $gallery_view->PageUrl() ?>export=csv&id=<?php echo ew_HtmlEncode($gallery->id->CurrentValue) ?>">Export to CSV</a>
<?php } ?>
<br><br>
<?php if ($gallery->Export == "") { ?>
<a href="gallerylist.php">Back to List</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $gallery->AddUrl() ?>">Add</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $gallery->EditUrl() ?>">Edit</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $gallery->CopyUrl() ?>">Copy</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a onclick="return ew_Confirm('Do you want to delete this record?');" href="<?php echo $gallery->DeleteUrl() ?>">Delete</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $gallery_view->ShowMessage() ?>
<p>
<?php if ($gallery->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($gallery_view->Pager)) $gallery_view->Pager = new cPrevNextPager($gallery_view->lStartRec, $gallery_view->lDisplayRecs, $gallery_view->lTotalRecs) ?>
<?php if ($gallery_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($gallery_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $gallery_view->PageUrl() ?>start=<?php echo $gallery_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($gallery_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $gallery_view->PageUrl() ?>start=<?php echo $gallery_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $gallery_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($gallery_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $gallery_view->PageUrl() ?>start=<?php echo $gallery_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($gallery_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $gallery_view->PageUrl() ?>start=<?php echo $gallery_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $gallery_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($gallery_view->sSrchWhere == "0=101") { ?>
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
<?php if ($gallery->id->Visible) { // id ?>
	<tr<?php echo $gallery->id->RowAttributes ?>>
		<td class="ewTableHeader">id</td>
		<td<?php echo $gallery->id->CellAttributes() ?>>
<div<?php echo $gallery->id->ViewAttributes() ?>><?php echo $gallery->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($gallery->name->Visible) { // name ?>
	<tr<?php echo $gallery->name->RowAttributes ?>>
		<td class="ewTableHeader">name</td>
		<td<?php echo $gallery->name->CellAttributes() ?>>
<div<?php echo $gallery->name->ViewAttributes() ?>><?php echo $gallery->name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($gallery->name_arabic->Visible) { // name_arabic ?>
	<tr<?php echo $gallery->name_arabic->RowAttributes ?>>
		<td class="ewTableHeader">name arabic</td>
		<td<?php echo $gallery->name_arabic->CellAttributes() ?>>
<div<?php echo $gallery->name_arabic->ViewAttributes() ?>><?php echo $gallery->name_arabic->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($gallery->image->Visible) { // image ?>
	<tr<?php echo $gallery->image->RowAttributes ?>>
		<td class="ewTableHeader">image</td>
		<td<?php echo $gallery->image->CellAttributes() ?>>
<?php if ($gallery->image->HrefValue <> "") { ?>
<?php if (!is_null($gallery->image->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $gallery->image->Upload->DbValue ?>" border=0<?php echo $gallery->image->ViewAttributes() ?>>
<?php } elseif (!in_array($gallery->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($gallery->image->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $gallery->image->Upload->DbValue ?>" border=0<?php echo $gallery->image->ViewAttributes() ?>>
<?php } elseif (!in_array($gallery->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($gallery->category->Visible) { // category ?>
	<tr<?php echo $gallery->category->RowAttributes ?>>
		<td class="ewTableHeader">category</td>
		<td<?php echo $gallery->category->CellAttributes() ?>>
<div<?php echo $gallery->category->ViewAttributes() ?>><?php echo $gallery->category->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($gallery->link->Visible) { // link ?>
	<tr<?php echo $gallery->link->RowAttributes ?>>
		<td class="ewTableHeader">link</td>
		<td<?php echo $gallery->link->CellAttributes() ?>>
<div<?php echo $gallery->link->ViewAttributes() ?>><?php echo $gallery->link->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($gallery->special->Visible) { // special ?>
	<tr<?php echo $gallery->special->RowAttributes ?>>
		<td class="ewTableHeader">special</td>
		<td<?php echo $gallery->special->CellAttributes() ?>>
<div<?php echo $gallery->special->ViewAttributes() ?>><?php echo $gallery->special->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($gallery->order->Visible) { // order ?>
	<tr<?php echo $gallery->order->RowAttributes ?>>
		<td class="ewTableHeader">order</td>
		<td<?php echo $gallery->order->CellAttributes() ?>>
<div<?php echo $gallery->order->ViewAttributes() ?>><?php echo $gallery->order->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($gallery->active->Visible) { // active ?>
	<tr<?php echo $gallery->active->RowAttributes ?>>
		<td class="ewTableHeader">active</td>
		<td<?php echo $gallery->active->CellAttributes() ?>>
<div<?php echo $gallery->active->ViewAttributes() ?>><?php echo $gallery->active->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($gallery->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($gallery_view->Pager)) $gallery_view->Pager = new cPrevNextPager($gallery_view->lStartRec, $gallery_view->lDisplayRecs, $gallery_view->lTotalRecs) ?>
<?php if ($gallery_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($gallery_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $gallery_view->PageUrl() ?>start=<?php echo $gallery_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($gallery_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $gallery_view->PageUrl() ?>start=<?php echo $gallery_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $gallery_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($gallery_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $gallery_view->PageUrl() ?>start=<?php echo $gallery_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($gallery_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $gallery_view->PageUrl() ?>start=<?php echo $gallery_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $gallery_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($gallery_view->sSrchWhere == "0=101") { ?>
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
<?php if ($gallery->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$gallery_view->Page_Terminate();
?>
<?php

//
// Page Class
//
class cgallery_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'gallery';

	// Page Object Name
	var $PageObjName = 'gallery_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $gallery;
		if ($gallery->UseTokenInUrl) $PageUrl .= "t=" . $gallery->TableVar . "&"; // add page token
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
		global $objForm, $gallery;
		if ($gallery->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($gallery->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($gallery->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cgallery_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["gallery"] = new cgallery();

		// Initialize other table object
		$GLOBALS['categories'] = new ccategories();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'gallery', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $gallery;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$gallery->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $gallery->Export; // Get export parameter, used in header
	$gsExportFile = $gallery->TableVar; // Get export file, used in header
	if (@$_GET["id"] <> "") {
		if ($gsExportFile <> "") $gsExportFile .= "_";
		$gsExportFile .= ew_StripSlashes($_GET["id"]);
	}
	if ($gallery->Export == "print" || $gallery->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($gallery->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($gallery->Export == "word") {
		header('Content-Type: application/vnd.ms-word;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($gallery->Export == "xml") {
		header('Content-Type: text/xml;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($gallery->Export == "csv") {
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
		global $gallery;

		// Paging variables
		$this->lDisplayRecs = 1;
		$this->lRecRange = 10;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$gallery->id->setQueryStringValue($_GET["id"]);
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$gallery->CurrentAction = "I"; // Display form
			switch ($gallery->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					$rs = $this->LoadRecordset(); // Load records
					$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage("No records found"); // Set no record message
						$this->Page_Terminate("gallerylist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($gallery->id->CurrentValue) == strval($rs->fields('id'))) {
								$gallery->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "gallerylist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}

			// Export data only
			if ($gallery->Export == "html" || $gallery->Export == "csv" ||
				$gallery->Export == "word" || $gallery->Export == "excel" ||
				$gallery->Export == "xml") {
				$this->ExportData();
				$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "gallerylist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$gallery->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $gallery;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$gallery->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$gallery->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $gallery->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$gallery->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$gallery->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$gallery->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $gallery;

		// Call Recordset Selecting event
		$gallery->Recordset_Selecting($gallery->CurrentFilter);

		// Load list page SQL
		$sSql = $gallery->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$gallery->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $gallery;
		$sFilter = $gallery->KeyFilter();

		// Call Row Selecting event
		$gallery->Row_Selecting($sFilter);

		// Load sql based on filter
		$gallery->CurrentFilter = $sFilter;
		$sSql = $gallery->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$gallery->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $gallery;
		$gallery->id->setDbValue($rs->fields('id'));
		$gallery->name->setDbValue($rs->fields('name'));
		$gallery->name_arabic->setDbValue($rs->fields('name_arabic'));
		$gallery->image->Upload->DbValue = $rs->fields('image');
		$gallery->category->setDbValue($rs->fields('category'));
		$gallery->link->setDbValue($rs->fields('link'));
		$gallery->special->setDbValue($rs->fields('special'));
		$gallery->order->setDbValue($rs->fields('order'));
		$gallery->active->setDbValue($rs->fields('active'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $gallery;

		// Call Row_Rendering event
		$gallery->Row_Rendering();

		// Common render codes for all row types
		// id

		$gallery->id->CellCssStyle = "";
		$gallery->id->CellCssClass = "";

		// name
		$gallery->name->CellCssStyle = "";
		$gallery->name->CellCssClass = "";

		// name_arabic
		$gallery->name_arabic->CellCssStyle = "";
		$gallery->name_arabic->CellCssClass = "";

		// image
		$gallery->image->CellCssStyle = "";
		$gallery->image->CellCssClass = "";

		// category
		$gallery->category->CellCssStyle = "";
		$gallery->category->CellCssClass = "";

		// link
		$gallery->link->CellCssStyle = "";
		$gallery->link->CellCssClass = "";

		// special
		$gallery->special->CellCssStyle = "";
		$gallery->special->CellCssClass = "";

		// order
		$gallery->order->CellCssStyle = "";
		$gallery->order->CellCssClass = "";

		// active
		$gallery->active->CellCssStyle = "";
		$gallery->active->CellCssClass = "";
		if ($gallery->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$gallery->id->ViewValue = $gallery->id->CurrentValue;
			$gallery->id->CssStyle = "";
			$gallery->id->CssClass = "";
			$gallery->id->ViewCustomAttributes = "";

			// name
			$gallery->name->ViewValue = $gallery->name->CurrentValue;
			$gallery->name->CssStyle = "";
			$gallery->name->CssClass = "";
			$gallery->name->ViewCustomAttributes = "";

			// name_arabic
			$gallery->name_arabic->ViewValue = $gallery->name_arabic->CurrentValue;
			$gallery->name_arabic->CssStyle = "";
			$gallery->name_arabic->CssClass = "";
			$gallery->name_arabic->ViewCustomAttributes = "";

			// image
			if (!is_null($gallery->image->Upload->DbValue)) {
				$gallery->image->ViewValue = $gallery->image->Upload->DbValue;
				$gallery->image->ImageWidth = 100;
				$gallery->image->ImageHeight = 0;
				$gallery->image->ImageAlt = "";
			} else {
				$gallery->image->ViewValue = "";
			}
			$gallery->image->CssStyle = "";
			$gallery->image->CssClass = "";
			$gallery->image->ViewCustomAttributes = "";

			// category
			if (strval($gallery->category->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `name`, `name_arabic` FROM `categories` WHERE `id` = " . ew_AdjustSql($gallery->category->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$gallery->category->ViewValue = $rswrk->fields('name');
					$gallery->category->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('name_arabic');
					$rswrk->Close();
				} else {
					$gallery->category->ViewValue = $gallery->category->CurrentValue;
				}
			} else {
				$gallery->category->ViewValue = NULL;
			}
			$gallery->category->CssStyle = "";
			$gallery->category->CssClass = "";
			$gallery->category->ViewCustomAttributes = "";

			// link
			$gallery->link->ViewValue = $gallery->link->CurrentValue;
			$gallery->link->CssStyle = "";
			$gallery->link->CssClass = "";
			$gallery->link->ViewCustomAttributes = "";

			// special
			if (strval($gallery->special->CurrentValue) <> "") {
				switch ($gallery->special->CurrentValue) {
					case "0":
						$gallery->special->ViewValue = "No";
						break;
					case "1":
						$gallery->special->ViewValue = "Yes";
						break;
					default:
						$gallery->special->ViewValue = $gallery->special->CurrentValue;
				}
			} else {
				$gallery->special->ViewValue = NULL;
			}
			$gallery->special->CssStyle = "";
			$gallery->special->CssClass = "";
			$gallery->special->ViewCustomAttributes = "";

			// order
			$gallery->order->ViewValue = $gallery->order->CurrentValue;
			$gallery->order->CssStyle = "";
			$gallery->order->CssClass = "";
			$gallery->order->ViewCustomAttributes = "";

			// active
			if (strval($gallery->active->CurrentValue) <> "") {
				switch ($gallery->active->CurrentValue) {
					case "0":
						$gallery->active->ViewValue = "No";
						break;
					case "1":
						$gallery->active->ViewValue = "Yes";
						break;
					default:
						$gallery->active->ViewValue = $gallery->active->CurrentValue;
				}
			} else {
				$gallery->active->ViewValue = NULL;
			}
			$gallery->active->CssStyle = "";
			$gallery->active->CssClass = "";
			$gallery->active->ViewCustomAttributes = "";

			// id
			$gallery->id->HrefValue = "";

			// name
			$gallery->name->HrefValue = "";

			// name_arabic
			$gallery->name_arabic->HrefValue = "";

			// image
			$gallery->image->HrefValue = "";

			// category
			$gallery->category->HrefValue = "";

			// link
			$gallery->link->HrefValue = "";

			// special
			$gallery->special->HrefValue = "";

			// order
			$gallery->order->HrefValue = "";

			// active
			$gallery->active->HrefValue = "";
		}

		// Call Row Rendered event
		$gallery->Row_Rendered();
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $gallery;
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
		if ($gallery->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo "\xEF\xBB\xBF";
			echo ew_ExportHeader($gallery->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $gallery->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id', $gallery->Export);
				ew_ExportAddValue($sExportStr, 'name', $gallery->Export);
				ew_ExportAddValue($sExportStr, 'name_arabic', $gallery->Export);
				ew_ExportAddValue($sExportStr, 'image', $gallery->Export);
				ew_ExportAddValue($sExportStr, 'category', $gallery->Export);
				ew_ExportAddValue($sExportStr, 'link', $gallery->Export);
				ew_ExportAddValue($sExportStr, 'special', $gallery->Export);
				ew_ExportAddValue($sExportStr, 'order', $gallery->Export);
				ew_ExportAddValue($sExportStr, 'active', $gallery->Export);
				echo ew_ExportLine($sExportStr, $gallery->Export);
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
				$gallery->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($gallery->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id', $gallery->id->CurrentValue);
					$XmlDoc->AddField('name', $gallery->name->CurrentValue);
					$XmlDoc->AddField('name_arabic', $gallery->name_arabic->CurrentValue);
					$XmlDoc->AddField('image', $gallery->image->CurrentValue);
					$XmlDoc->AddField('category', $gallery->category->CurrentValue);
					$XmlDoc->AddField('link', $gallery->link->CurrentValue);
					$XmlDoc->AddField('special', $gallery->special->CurrentValue);
					$XmlDoc->AddField('order', $gallery->order->CurrentValue);
					$XmlDoc->AddField('active', $gallery->active->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $gallery->Export <> "csv") { // Vertical format
						echo ew_ExportField('id', $gallery->id->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						echo ew_ExportField('name', $gallery->name->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						echo ew_ExportField('name_arabic', $gallery->name_arabic->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						echo ew_ExportField('image', $gallery->image->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						echo ew_ExportField('category', $gallery->category->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						echo ew_ExportField('link', $gallery->link->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						echo ew_ExportField('special', $gallery->special->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						echo ew_ExportField('order', $gallery->order->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						echo ew_ExportField('active', $gallery->active->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $gallery->id->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						ew_ExportAddValue($sExportStr, $gallery->name->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						ew_ExportAddValue($sExportStr, $gallery->name_arabic->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						ew_ExportAddValue($sExportStr, $gallery->image->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						ew_ExportAddValue($sExportStr, $gallery->category->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						ew_ExportAddValue($sExportStr, $gallery->link->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						ew_ExportAddValue($sExportStr, $gallery->special->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						ew_ExportAddValue($sExportStr, $gallery->order->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						ew_ExportAddValue($sExportStr, $gallery->active->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						echo ew_ExportLine($sExportStr, $gallery->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($gallery->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($gallery->Export);
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
