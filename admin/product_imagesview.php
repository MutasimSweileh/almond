<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "product_imagesinfo.php" ?>
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
$product_images_view = new cproduct_images_view();
$Page =& $product_images_view;

// Page init processing
$product_images_view->Page_Init();

// Page main processing
$product_images_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($product_images->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var product_images_view = new ew_Page("product_images_view");

// page properties
product_images_view.PageID = "view"; // page ID
var EW_PAGE_ID = product_images_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
product_images_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
product_images_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
product_images_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
product_images_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
product_images_view.ShowHighlightText = "Show highlight"; 
product_images_view.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">View TABLE: product images
<?php if ($product_images->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $product_images_view->PageUrl() ?>export=print&id=<?php echo ew_HtmlEncode($product_images->id->CurrentValue) ?>">Printer Friendly</a>
&nbsp;&nbsp;<a href="<?php echo $product_images_view->PageUrl() ?>export=html&id=<?php echo ew_HtmlEncode($product_images->id->CurrentValue) ?>">Export to HTML</a>
&nbsp;&nbsp;<a href="<?php echo $product_images_view->PageUrl() ?>export=excel&id=<?php echo ew_HtmlEncode($product_images->id->CurrentValue) ?>">Export to Excel</a>
&nbsp;&nbsp;<a href="<?php echo $product_images_view->PageUrl() ?>export=word&id=<?php echo ew_HtmlEncode($product_images->id->CurrentValue) ?>">Export to Word</a>
&nbsp;&nbsp;<a href="<?php echo $product_images_view->PageUrl() ?>export=xml&id=<?php echo ew_HtmlEncode($product_images->id->CurrentValue) ?>">Export to XML</a>
&nbsp;&nbsp;<a href="<?php echo $product_images_view->PageUrl() ?>export=csv&id=<?php echo ew_HtmlEncode($product_images->id->CurrentValue) ?>">Export to CSV</a>
<?php } ?>
<br><br>
<?php if ($product_images->Export == "") { ?>
<a href="product_imageslist.php">Back to List</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $product_images->AddUrl() ?>">Add</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $product_images->EditUrl() ?>">Edit</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $product_images->CopyUrl() ?>">Copy</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a onclick="return ew_Confirm('Do you want to delete this record?');" href="<?php echo $product_images->DeleteUrl() ?>">Delete</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $product_images_view->ShowMessage() ?>
<p>
<?php if ($product_images->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($product_images_view->Pager)) $product_images_view->Pager = new cPrevNextPager($product_images_view->lStartRec, $product_images_view->lDisplayRecs, $product_images_view->lTotalRecs) ?>
<?php if ($product_images_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($product_images_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $product_images_view->PageUrl() ?>start=<?php echo $product_images_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($product_images_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $product_images_view->PageUrl() ?>start=<?php echo $product_images_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $product_images_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($product_images_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $product_images_view->PageUrl() ?>start=<?php echo $product_images_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($product_images_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $product_images_view->PageUrl() ?>start=<?php echo $product_images_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $product_images_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($product_images_view->sSrchWhere == "0=101") { ?>
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
<?php if ($product_images->id->Visible) { // id ?>
	<tr<?php echo $product_images->id->RowAttributes ?>>
		<td class="ewTableHeader">id</td>
		<td<?php echo $product_images->id->CellAttributes() ?>>
<div<?php echo $product_images->id->ViewAttributes() ?>><?php echo $product_images->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($product_images->image->Visible) { // image ?>
	<tr<?php echo $product_images->image->RowAttributes ?>>
		<td class="ewTableHeader">image</td>
		<td<?php echo $product_images->image->CellAttributes() ?>>
<?php if ($product_images->image->HrefValue <> "") { ?>
<?php if (!is_null($product_images->image->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $product_images->image->Upload->DbValue ?>" border=0<?php echo $product_images->image->ViewAttributes() ?>>
<?php } elseif (!in_array($product_images->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($product_images->image->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $product_images->image->Upload->DbValue ?>" border=0<?php echo $product_images->image->ViewAttributes() ?>>
<?php } elseif (!in_array($product_images->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($product_images->name->Visible) { // name ?>
	<tr<?php echo $product_images->name->RowAttributes ?>>
		<td class="ewTableHeader">name</td>
		<td<?php echo $product_images->name->CellAttributes() ?>>
<div<?php echo $product_images->name->ViewAttributes() ?>><?php echo $product_images->name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($product_images->name_arabic->Visible) { // name_arabic ?>
	<tr<?php echo $product_images->name_arabic->RowAttributes ?>>
		<td class="ewTableHeader">name arabic</td>
		<td<?php echo $product_images->name_arabic->CellAttributes() ?>>
<div<?php echo $product_images->name_arabic->ViewAttributes() ?>><?php echo $product_images->name_arabic->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($product_images->product_id->Visible) { // product_id ?>
	<tr<?php echo $product_images->product_id->RowAttributes ?>>
		<td class="ewTableHeader">product</td>
		<td<?php echo $product_images->product_id->CellAttributes() ?>>
<div<?php echo $product_images->product_id->ViewAttributes() ?>><?php echo $product_images->product_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($product_images->order->Visible) { // order ?>
	<tr<?php echo $product_images->order->RowAttributes ?>>
		<td class="ewTableHeader">order</td>
		<td<?php echo $product_images->order->CellAttributes() ?>>
<div<?php echo $product_images->order->ViewAttributes() ?>><?php echo $product_images->order->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($product_images->active->Visible) { // active ?>
	<tr<?php echo $product_images->active->RowAttributes ?>>
		<td class="ewTableHeader">active</td>
		<td<?php echo $product_images->active->CellAttributes() ?>>
<div<?php echo $product_images->active->ViewAttributes() ?>><?php echo $product_images->active->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($product_images->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($product_images_view->Pager)) $product_images_view->Pager = new cPrevNextPager($product_images_view->lStartRec, $product_images_view->lDisplayRecs, $product_images_view->lTotalRecs) ?>
<?php if ($product_images_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($product_images_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $product_images_view->PageUrl() ?>start=<?php echo $product_images_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($product_images_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $product_images_view->PageUrl() ?>start=<?php echo $product_images_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $product_images_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($product_images_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $product_images_view->PageUrl() ?>start=<?php echo $product_images_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($product_images_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $product_images_view->PageUrl() ?>start=<?php echo $product_images_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $product_images_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($product_images_view->sSrchWhere == "0=101") { ?>
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
<?php if ($product_images->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$product_images_view->Page_Terminate();
?>
<?php

//
// Page Class
//
class cproduct_images_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'product_images';

	// Page Object Name
	var $PageObjName = 'product_images_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $product_images;
		if ($product_images->UseTokenInUrl) $PageUrl .= "t=" . $product_images->TableVar . "&"; // add page token
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
		global $objForm, $product_images;
		if ($product_images->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($product_images->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($product_images->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cproduct_images_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["product_images"] = new cproduct_images();

		// Initialize other table object
		$GLOBALS['products'] = new cproducts();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'product_images', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $product_images;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$product_images->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $product_images->Export; // Get export parameter, used in header
	$gsExportFile = $product_images->TableVar; // Get export file, used in header
	if (@$_GET["id"] <> "") {
		if ($gsExportFile <> "") $gsExportFile .= "_";
		$gsExportFile .= ew_StripSlashes($_GET["id"]);
	}
	if ($product_images->Export == "print" || $product_images->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($product_images->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($product_images->Export == "word") {
		header('Content-Type: application/vnd.ms-word;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($product_images->Export == "xml") {
		header('Content-Type: text/xml;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($product_images->Export == "csv") {
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
		global $product_images;

		// Paging variables
		$this->lDisplayRecs = 1;
		$this->lRecRange = 10;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$product_images->id->setQueryStringValue($_GET["id"]);
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$product_images->CurrentAction = "I"; // Display form
			switch ($product_images->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					$rs = $this->LoadRecordset(); // Load records
					$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage("No records found"); // Set no record message
						$this->Page_Terminate("product_imageslist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($product_images->id->CurrentValue) == strval($rs->fields('id'))) {
								$product_images->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "product_imageslist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}

			// Export data only
			if ($product_images->Export == "html" || $product_images->Export == "csv" ||
				$product_images->Export == "word" || $product_images->Export == "excel" ||
				$product_images->Export == "xml") {
				$this->ExportData();
				$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "product_imageslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$product_images->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $product_images;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$product_images->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$product_images->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $product_images->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$product_images->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$product_images->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$product_images->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $product_images;

		// Call Recordset Selecting event
		$product_images->Recordset_Selecting($product_images->CurrentFilter);

		// Load list page SQL
		$sSql = $product_images->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$product_images->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $product_images;
		$sFilter = $product_images->KeyFilter();

		// Call Row Selecting event
		$product_images->Row_Selecting($sFilter);

		// Load sql based on filter
		$product_images->CurrentFilter = $sFilter;
		$sSql = $product_images->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$product_images->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $product_images;
		$product_images->id->setDbValue($rs->fields('id'));
		$product_images->image->Upload->DbValue = $rs->fields('image');
		$product_images->name->setDbValue($rs->fields('name'));
		$product_images->name_arabic->setDbValue($rs->fields('name_arabic'));
		$product_images->product_id->setDbValue($rs->fields('product_id'));
		$product_images->order->setDbValue($rs->fields('order'));
		$product_images->active->setDbValue($rs->fields('active'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $product_images;

		// Call Row_Rendering event
		$product_images->Row_Rendering();

		// Common render codes for all row types
		// id

		$product_images->id->CellCssStyle = "";
		$product_images->id->CellCssClass = "";

		// image
		$product_images->image->CellCssStyle = "";
		$product_images->image->CellCssClass = "";

		// name
		$product_images->name->CellCssStyle = "";
		$product_images->name->CellCssClass = "";

		// name_arabic
		$product_images->name_arabic->CellCssStyle = "";
		$product_images->name_arabic->CellCssClass = "";

		// product_id
		$product_images->product_id->CellCssStyle = "";
		$product_images->product_id->CellCssClass = "";

		// order
		$product_images->order->CellCssStyle = "";
		$product_images->order->CellCssClass = "";

		// active
		$product_images->active->CellCssStyle = "";
		$product_images->active->CellCssClass = "";
		if ($product_images->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$product_images->id->ViewValue = $product_images->id->CurrentValue;
			$product_images->id->CssStyle = "";
			$product_images->id->CssClass = "";
			$product_images->id->ViewCustomAttributes = "";

			// image
			if (!is_null($product_images->image->Upload->DbValue)) {
				$product_images->image->ViewValue = $product_images->image->Upload->DbValue;
				$product_images->image->ImageWidth = 100;
				$product_images->image->ImageHeight = 0;
				$product_images->image->ImageAlt = "";
			} else {
				$product_images->image->ViewValue = "";
			}
			$product_images->image->CssStyle = "";
			$product_images->image->CssClass = "";
			$product_images->image->ViewCustomAttributes = "";

			// name
			$product_images->name->ViewValue = $product_images->name->CurrentValue;
			$product_images->name->CssStyle = "";
			$product_images->name->CssClass = "";
			$product_images->name->ViewCustomAttributes = "";

			// name_arabic
			$product_images->name_arabic->ViewValue = $product_images->name_arabic->CurrentValue;
			$product_images->name_arabic->CssStyle = "";
			$product_images->name_arabic->CssClass = "";
			$product_images->name_arabic->ViewCustomAttributes = "";

			// product_id
			if (strval($product_images->product_id->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `name`, `name_arabic` FROM `products` WHERE `id` = " . ew_AdjustSql($product_images->product_id->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$product_images->product_id->ViewValue = $rswrk->fields('name');
					$product_images->product_id->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('name_arabic');
					$rswrk->Close();
				} else {
					$product_images->product_id->ViewValue = $product_images->product_id->CurrentValue;
				}
			} else {
				$product_images->product_id->ViewValue = NULL;
			}
			$product_images->product_id->CssStyle = "";
			$product_images->product_id->CssClass = "";
			$product_images->product_id->ViewCustomAttributes = "";

			// order
			$product_images->order->ViewValue = $product_images->order->CurrentValue;
			$product_images->order->CssStyle = "";
			$product_images->order->CssClass = "";
			$product_images->order->ViewCustomAttributes = "";

			// active
			if (strval($product_images->active->CurrentValue) <> "") {
				switch ($product_images->active->CurrentValue) {
					case "0":
						$product_images->active->ViewValue = "No";
						break;
					case "1":
						$product_images->active->ViewValue = "Yes";
						break;
					default:
						$product_images->active->ViewValue = $product_images->active->CurrentValue;
				}
			} else {
				$product_images->active->ViewValue = NULL;
			}
			$product_images->active->CssStyle = "";
			$product_images->active->CssClass = "";
			$product_images->active->ViewCustomAttributes = "";

			// id
			$product_images->id->HrefValue = "";

			// image
			$product_images->image->HrefValue = "";

			// name
			$product_images->name->HrefValue = "";

			// name_arabic
			$product_images->name_arabic->HrefValue = "";

			// product_id
			$product_images->product_id->HrefValue = "";

			// order
			$product_images->order->HrefValue = "";

			// active
			$product_images->active->HrefValue = "";
		}

		// Call Row Rendered event
		$product_images->Row_Rendered();
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $product_images;
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
		if ($product_images->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo "\xEF\xBB\xBF";
			echo ew_ExportHeader($product_images->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $product_images->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id', $product_images->Export);
				ew_ExportAddValue($sExportStr, 'image', $product_images->Export);
				ew_ExportAddValue($sExportStr, 'name', $product_images->Export);
				ew_ExportAddValue($sExportStr, 'name_arabic', $product_images->Export);
				ew_ExportAddValue($sExportStr, 'product_id', $product_images->Export);
				ew_ExportAddValue($sExportStr, 'order', $product_images->Export);
				ew_ExportAddValue($sExportStr, 'active', $product_images->Export);
				echo ew_ExportLine($sExportStr, $product_images->Export);
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
				$product_images->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($product_images->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id', $product_images->id->CurrentValue);
					$XmlDoc->AddField('image', $product_images->image->CurrentValue);
					$XmlDoc->AddField('name', $product_images->name->CurrentValue);
					$XmlDoc->AddField('name_arabic', $product_images->name_arabic->CurrentValue);
					$XmlDoc->AddField('product_id', $product_images->product_id->CurrentValue);
					$XmlDoc->AddField('order', $product_images->order->CurrentValue);
					$XmlDoc->AddField('active', $product_images->active->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $product_images->Export <> "csv") { // Vertical format
						echo ew_ExportField('id', $product_images->id->ExportValue($product_images->Export, $product_images->ExportOriginalValue), $product_images->Export);
						echo ew_ExportField('image', $product_images->image->ExportValue($product_images->Export, $product_images->ExportOriginalValue), $product_images->Export);
						echo ew_ExportField('name', $product_images->name->ExportValue($product_images->Export, $product_images->ExportOriginalValue), $product_images->Export);
						echo ew_ExportField('name_arabic', $product_images->name_arabic->ExportValue($product_images->Export, $product_images->ExportOriginalValue), $product_images->Export);
						echo ew_ExportField('product_id', $product_images->product_id->ExportValue($product_images->Export, $product_images->ExportOriginalValue), $product_images->Export);
						echo ew_ExportField('order', $product_images->order->ExportValue($product_images->Export, $product_images->ExportOriginalValue), $product_images->Export);
						echo ew_ExportField('active', $product_images->active->ExportValue($product_images->Export, $product_images->ExportOriginalValue), $product_images->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $product_images->id->ExportValue($product_images->Export, $product_images->ExportOriginalValue), $product_images->Export);
						ew_ExportAddValue($sExportStr, $product_images->image->ExportValue($product_images->Export, $product_images->ExportOriginalValue), $product_images->Export);
						ew_ExportAddValue($sExportStr, $product_images->name->ExportValue($product_images->Export, $product_images->ExportOriginalValue), $product_images->Export);
						ew_ExportAddValue($sExportStr, $product_images->name_arabic->ExportValue($product_images->Export, $product_images->ExportOriginalValue), $product_images->Export);
						ew_ExportAddValue($sExportStr, $product_images->product_id->ExportValue($product_images->Export, $product_images->ExportOriginalValue), $product_images->Export);
						ew_ExportAddValue($sExportStr, $product_images->order->ExportValue($product_images->Export, $product_images->ExportOriginalValue), $product_images->Export);
						ew_ExportAddValue($sExportStr, $product_images->active->ExportValue($product_images->Export, $product_images->ExportOriginalValue), $product_images->Export);
						echo ew_ExportLine($sExportStr, $product_images->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($product_images->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($product_images->Export);
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
