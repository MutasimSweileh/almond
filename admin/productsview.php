<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
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
$products_view = new cproducts_view();
$Page =& $products_view;

// Page init processing
$products_view->Page_Init();

// Page main processing
$products_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($products->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var products_view = new ew_Page("products_view");

// page properties
products_view.PageID = "view"; // page ID
var EW_PAGE_ID = products_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
products_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
products_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
products_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
products_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
products_view.ShowHighlightText = "Show highlight"; 
products_view.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">View TABLE: products
<?php if ($products->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $products_view->PageUrl() ?>export=print&id=<?php echo ew_HtmlEncode($products->id->CurrentValue) ?>">Printer Friendly</a>
&nbsp;&nbsp;<a href="<?php echo $products_view->PageUrl() ?>export=html&id=<?php echo ew_HtmlEncode($products->id->CurrentValue) ?>">Export to HTML</a>
&nbsp;&nbsp;<a href="<?php echo $products_view->PageUrl() ?>export=excel&id=<?php echo ew_HtmlEncode($products->id->CurrentValue) ?>">Export to Excel</a>
&nbsp;&nbsp;<a href="<?php echo $products_view->PageUrl() ?>export=word&id=<?php echo ew_HtmlEncode($products->id->CurrentValue) ?>">Export to Word</a>
&nbsp;&nbsp;<a href="<?php echo $products_view->PageUrl() ?>export=xml&id=<?php echo ew_HtmlEncode($products->id->CurrentValue) ?>">Export to XML</a>
&nbsp;&nbsp;<a href="<?php echo $products_view->PageUrl() ?>export=csv&id=<?php echo ew_HtmlEncode($products->id->CurrentValue) ?>">Export to CSV</a>
<?php } ?>
<br><br>
<?php if ($products->Export == "") { ?>
<a href="productslist.php">Back to List</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $products->AddUrl() ?>">Add</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $products->EditUrl() ?>">Edit</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $products->CopyUrl() ?>">Copy</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a onclick="return ew_Confirm('Do you want to delete this record?');" href="<?php echo $products->DeleteUrl() ?>">Delete</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="product_imageslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=products&id=<?php echo urlencode(strval($products->id->CurrentValue)) ?>">product images...</a>
&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="product_videoslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=products&id=<?php echo urlencode(strval($products->id->CurrentValue)) ?>">product videos...</a>
&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $products_view->ShowMessage() ?>
<p>
<?php if ($products->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($products_view->Pager)) $products_view->Pager = new cPrevNextPager($products_view->lStartRec, $products_view->lDisplayRecs, $products_view->lTotalRecs) ?>
<?php if ($products_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($products_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $products_view->PageUrl() ?>start=<?php echo $products_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($products_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $products_view->PageUrl() ?>start=<?php echo $products_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $products_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($products_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $products_view->PageUrl() ?>start=<?php echo $products_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($products_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $products_view->PageUrl() ?>start=<?php echo $products_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $products_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($products_view->sSrchWhere == "0=101") { ?>
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
<?php if ($products->id->Visible) { // id ?>
	<tr<?php echo $products->id->RowAttributes ?>>
		<td class="ewTableHeader">id</td>
		<td<?php echo $products->id->CellAttributes() ?>>
<div<?php echo $products->id->ViewAttributes() ?>><?php echo $products->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($products->name->Visible) { // name ?>
	<tr<?php echo $products->name->RowAttributes ?>>
		<td class="ewTableHeader">name</td>
		<td<?php echo $products->name->CellAttributes() ?>>
<div<?php echo $products->name->ViewAttributes() ?>><?php echo $products->name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($products->name_arabic->Visible) { // name_arabic ?>
	<tr<?php echo $products->name_arabic->RowAttributes ?>>
		<td class="ewTableHeader">name arabic</td>
		<td<?php echo $products->name_arabic->CellAttributes() ?>>
<div<?php echo $products->name_arabic->ViewAttributes() ?>><?php echo $products->name_arabic->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($products->level->Visible) { // level ?>
	<tr<?php echo $products->level->RowAttributes ?>>
		<td class="ewTableHeader">level</td>
		<td<?php echo $products->level->CellAttributes() ?>>
<div<?php echo $products->level->ViewAttributes() ?>><?php echo $products->level->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($products->image->Visible) { // image ?>
	<tr<?php echo $products->image->RowAttributes ?>>
		<td class="ewTableHeader">image</td>
		<td<?php echo $products->image->CellAttributes() ?>>
<?php if ($products->image->HrefValue <> "") { ?>
<?php if (!is_null($products->image->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $products->image->Upload->DbValue ?>" border=0<?php echo $products->image->ViewAttributes() ?>>
<?php } elseif (!in_array($products->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($products->image->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $products->image->Upload->DbValue ?>" border=0<?php echo $products->image->ViewAttributes() ?>>
<?php } elseif (!in_array($products->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($products->image2->Visible) { // image2 ?>
	<tr<?php echo $products->image2->RowAttributes ?>>
		<td class="ewTableHeader">image 2</td>
		<td<?php echo $products->image2->CellAttributes() ?>>
<?php if ($products->image2->HrefValue <> "") { ?>
<?php if (!is_null($products->image2->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $products->image2->Upload->DbValue ?>" border=0<?php echo $products->image2->ViewAttributes() ?>>
<?php } elseif (!in_array($products->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($products->image2->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $products->image2->Upload->DbValue ?>" border=0<?php echo $products->image2->ViewAttributes() ?>>
<?php } elseif (!in_array($products->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($products->image3->Visible) { // image3 ?>
	<tr<?php echo $products->image3->RowAttributes ?>>
		<td class="ewTableHeader">image 3</td>
		<td<?php echo $products->image3->CellAttributes() ?>>
<?php if ($products->image3->HrefValue <> "") { ?>
<?php if (!is_null($products->image3->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $products->image3->Upload->DbValue ?>" border=0<?php echo $products->image3->ViewAttributes() ?>>
<?php } elseif (!in_array($products->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($products->image3->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $products->image3->Upload->DbValue ?>" border=0<?php echo $products->image3->ViewAttributes() ?>>
<?php } elseif (!in_array($products->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($products->description->Visible) { // description ?>
	<tr<?php echo $products->description->RowAttributes ?>>
		<td class="ewTableHeader">description</td>
		<td<?php echo $products->description->CellAttributes() ?>>
<div<?php echo $products->description->ViewAttributes() ?>><?php echo $products->description->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($products->description_arabic->Visible) { // description_arabic ?>
	<tr<?php echo $products->description_arabic->RowAttributes ?>>
		<td class="ewTableHeader">description arabic</td>
		<td<?php echo $products->description_arabic->CellAttributes() ?>>
<div<?php echo $products->description_arabic->ViewAttributes() ?>><?php echo $products->description_arabic->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($products->video->Visible) { // video ?>
	<tr<?php echo $products->video->RowAttributes ?>>
		<td class="ewTableHeader">video</td>
		<td<?php echo $products->video->CellAttributes() ?>>
<div<?php echo $products->video->ViewAttributes() ?>><?php echo $products->video->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($products->file->Visible) { // file ?>
	<tr<?php echo $products->file->RowAttributes ?>>
		<td class="ewTableHeader">file</td>
		<td<?php echo $products->file->CellAttributes() ?>>
<?php if ($products->file->HrefValue <> "") { ?>
<?php if (!is_null($products->file->Upload->DbValue)) { ?>
<a href="<?php echo $products->file->HrefValue ?>"><?php echo $products->file->ViewValue ?></a>
<?php } elseif (!in_array($products->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($products->file->Upload->DbValue)) { ?>
<?php echo $products->file->ViewValue ?>
<?php } elseif (!in_array($products->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($products->special->Visible) { // special ?>
	<tr<?php echo $products->special->RowAttributes ?>>
		<td class="ewTableHeader">special</td>
		<td<?php echo $products->special->CellAttributes() ?>>
<div<?php echo $products->special->ViewAttributes() ?>><?php echo $products->special->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($products->order->Visible) { // order ?>
	<tr<?php echo $products->order->RowAttributes ?>>
		<td class="ewTableHeader">order</td>
		<td<?php echo $products->order->CellAttributes() ?>>
<div<?php echo $products->order->ViewAttributes() ?>><?php echo $products->order->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($products->active->Visible) { // active ?>
	<tr<?php echo $products->active->RowAttributes ?>>
		<td class="ewTableHeader">active</td>
		<td<?php echo $products->active->CellAttributes() ?>>
<div<?php echo $products->active->ViewAttributes() ?>><?php echo $products->active->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($products->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($products_view->Pager)) $products_view->Pager = new cPrevNextPager($products_view->lStartRec, $products_view->lDisplayRecs, $products_view->lTotalRecs) ?>
<?php if ($products_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($products_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $products_view->PageUrl() ?>start=<?php echo $products_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($products_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $products_view->PageUrl() ?>start=<?php echo $products_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $products_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($products_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $products_view->PageUrl() ?>start=<?php echo $products_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($products_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $products_view->PageUrl() ?>start=<?php echo $products_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $products_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($products_view->sSrchWhere == "0=101") { ?>
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
<?php if ($products->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$products_view->Page_Terminate();
?>
<?php

//
// Page Class
//
class cproducts_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'products';

	// Page Object Name
	var $PageObjName = 'products_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $products;
		if ($products->UseTokenInUrl) $PageUrl .= "t=" . $products->TableVar . "&"; // add page token
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
		global $objForm, $products;
		if ($products->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($products->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($products->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cproducts_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["products"] = new cproducts();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'products', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $products;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$products->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $products->Export; // Get export parameter, used in header
	$gsExportFile = $products->TableVar; // Get export file, used in header
	if (@$_GET["id"] <> "") {
		if ($gsExportFile <> "") $gsExportFile .= "_";
		$gsExportFile .= ew_StripSlashes($_GET["id"]);
	}
	if ($products->Export == "print" || $products->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($products->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($products->Export == "word") {
		header('Content-Type: application/vnd.ms-word;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($products->Export == "xml") {
		header('Content-Type: text/xml;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($products->Export == "csv") {
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
		global $products;

		// Paging variables
		$this->lDisplayRecs = 1;
		$this->lRecRange = 10;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$products->id->setQueryStringValue($_GET["id"]);
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$products->CurrentAction = "I"; // Display form
			switch ($products->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					$rs = $this->LoadRecordset(); // Load records
					$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage("No records found"); // Set no record message
						$this->Page_Terminate("productslist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($products->id->CurrentValue) == strval($rs->fields('id'))) {
								$products->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "productslist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}

			// Export data only
			if ($products->Export == "html" || $products->Export == "csv" ||
				$products->Export == "word" || $products->Export == "excel" ||
				$products->Export == "xml") {
				$this->ExportData();
				$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "productslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$products->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $products;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$products->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$products->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $products->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$products->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$products->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$products->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $products;

		// Call Recordset Selecting event
		$products->Recordset_Selecting($products->CurrentFilter);

		// Load list page SQL
		$sSql = $products->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$products->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $products;
		$sFilter = $products->KeyFilter();

		// Call Row Selecting event
		$products->Row_Selecting($sFilter);

		// Load sql based on filter
		$products->CurrentFilter = $sFilter;
		$sSql = $products->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$products->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $products;
		$products->id->setDbValue($rs->fields('id'));
		$products->name->setDbValue($rs->fields('name'));
		$products->name_arabic->setDbValue($rs->fields('name_arabic'));
		$products->level->setDbValue($rs->fields('level'));
		$products->image->Upload->DbValue = $rs->fields('image');
		$products->image2->Upload->DbValue = $rs->fields('image2');
		$products->image3->Upload->DbValue = $rs->fields('image3');
		$products->description->setDbValue($rs->fields('description'));
		$products->description_arabic->setDbValue($rs->fields('description_arabic'));
		$products->video->setDbValue($rs->fields('video'));
		$products->file->Upload->DbValue = $rs->fields('file');
		$products->special->setDbValue($rs->fields('special'));
		$products->order->setDbValue($rs->fields('order'));
		$products->active->setDbValue($rs->fields('active'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $products;

		// Call Row_Rendering event
		$products->Row_Rendering();

		// Common render codes for all row types
		// id

		$products->id->CellCssStyle = "";
		$products->id->CellCssClass = "";

		// name
		$products->name->CellCssStyle = "";
		$products->name->CellCssClass = "";

		// name_arabic
		$products->name_arabic->CellCssStyle = "";
		$products->name_arabic->CellCssClass = "";

		// level
		$products->level->CellCssStyle = "";
		$products->level->CellCssClass = "";

		// image
		$products->image->CellCssStyle = "";
		$products->image->CellCssClass = "";

		// image2
		$products->image2->CellCssStyle = "";
		$products->image2->CellCssClass = "";

		// image3
		$products->image3->CellCssStyle = "";
		$products->image3->CellCssClass = "";

		// description
		$products->description->CellCssStyle = "";
		$products->description->CellCssClass = "";

		// description_arabic
		$products->description_arabic->CellCssStyle = "";
		$products->description_arabic->CellCssClass = "";

		// video
		$products->video->CellCssStyle = "";
		$products->video->CellCssClass = "";

		// file
		$products->file->CellCssStyle = "";
		$products->file->CellCssClass = "";

		// special
		$products->special->CellCssStyle = "";
		$products->special->CellCssClass = "";

		// order
		$products->order->CellCssStyle = "";
		$products->order->CellCssClass = "";

		// active
		$products->active->CellCssStyle = "";
		$products->active->CellCssClass = "";
		if ($products->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$products->id->ViewValue = $products->id->CurrentValue;
			$products->id->CssStyle = "";
			$products->id->CssClass = "";
			$products->id->ViewCustomAttributes = "";

			// name
			$products->name->ViewValue = $products->name->CurrentValue;
			$products->name->CssStyle = "";
			$products->name->CssClass = "";
			$products->name->ViewCustomAttributes = "";

			// name_arabic
			$products->name_arabic->ViewValue = $products->name_arabic->CurrentValue;
			$products->name_arabic->CssStyle = "";
			$products->name_arabic->CssClass = "";
			$products->name_arabic->ViewCustomAttributes = "";

			// level
			$products->level->ViewValue = $products->level->CurrentValue;
			$products->level->CssStyle = "";
			$products->level->CssClass = "";
			$products->level->ViewCustomAttributes = "";

			// image
			if (!is_null($products->image->Upload->DbValue)) {
				$products->image->ViewValue = $products->image->Upload->DbValue;
				$products->image->ImageWidth = 100;
				$products->image->ImageHeight = 0;
				$products->image->ImageAlt = "";
			} else {
				$products->image->ViewValue = "";
			}
			$products->image->CssStyle = "";
			$products->image->CssClass = "";
			$products->image->ViewCustomAttributes = "";

			// image2
			if (!is_null($products->image2->Upload->DbValue)) {
				$products->image2->ViewValue = $products->image2->Upload->DbValue;
				$products->image2->ImageWidth = 100;
				$products->image2->ImageHeight = 0;
				$products->image2->ImageAlt = "";
			} else {
				$products->image2->ViewValue = "";
			}
			$products->image2->CssStyle = "";
			$products->image2->CssClass = "";
			$products->image2->ViewCustomAttributes = "";

			// image3
			if (!is_null($products->image3->Upload->DbValue)) {
				$products->image3->ViewValue = $products->image3->Upload->DbValue;
				$products->image3->ImageWidth = 100;
				$products->image3->ImageHeight = 0;
				$products->image3->ImageAlt = "";
			} else {
				$products->image3->ViewValue = "";
			}
			$products->image3->CssStyle = "";
			$products->image3->CssClass = "";
			$products->image3->ViewCustomAttributes = "";

			// description
			$products->description->ViewValue = $products->description->CurrentValue;
			$products->description->CssStyle = "";
			$products->description->CssClass = "";
			$products->description->ViewCustomAttributes = "";

			// description_arabic
			$products->description_arabic->ViewValue = $products->description_arabic->CurrentValue;
			$products->description_arabic->CssStyle = "";
			$products->description_arabic->CssClass = "";
			$products->description_arabic->ViewCustomAttributes = "";

			// video
			$products->video->ViewValue = $products->video->CurrentValue;
			$products->video->CssStyle = "";
			$products->video->CssClass = "";
			$products->video->ViewCustomAttributes = "";

			// file
			if (!is_null($products->file->Upload->DbValue)) {
				$products->file->ViewValue = $products->file->Upload->DbValue;
			} else {
				$products->file->ViewValue = "";
			}
			$products->file->CssStyle = "";
			$products->file->CssClass = "";
			$products->file->ViewCustomAttributes = "";

			// special
			if (strval($products->special->CurrentValue) <> "") {
				switch ($products->special->CurrentValue) {
					case "0":
						$products->special->ViewValue = "No";
						break;
					case "1":
						$products->special->ViewValue = "Yes";
						break;
					default:
						$products->special->ViewValue = $products->special->CurrentValue;
				}
			} else {
				$products->special->ViewValue = NULL;
			}
			$products->special->CssStyle = "";
			$products->special->CssClass = "";
			$products->special->ViewCustomAttributes = "";

			// order
			$products->order->ViewValue = $products->order->CurrentValue;
			$products->order->CssStyle = "";
			$products->order->CssClass = "";
			$products->order->ViewCustomAttributes = "";

			// active
			if (strval($products->active->CurrentValue) <> "") {
				switch ($products->active->CurrentValue) {
					case "0":
						$products->active->ViewValue = "No";
						break;
					case "1":
						$products->active->ViewValue = "Yes";
						break;
					default:
						$products->active->ViewValue = $products->active->CurrentValue;
				}
			} else {
				$products->active->ViewValue = NULL;
			}
			$products->active->CssStyle = "";
			$products->active->CssClass = "";
			$products->active->ViewCustomAttributes = "";

			// id
			$products->id->HrefValue = "";

			// name
			$products->name->HrefValue = "";

			// name_arabic
			$products->name_arabic->HrefValue = "";

			// level
			$products->level->HrefValue = "";

			// image
			$products->image->HrefValue = "";

			// image2
			$products->image2->HrefValue = "";

			// image3
			$products->image3->HrefValue = "";

			// description
			$products->description->HrefValue = "";

			// description_arabic
			$products->description_arabic->HrefValue = "";

			// video
			$products->video->HrefValue = "";

			// file
			if (!is_null($products->file->Upload->DbValue)) {
				$products->file->HrefValue = ew_UploadPathEx(FALSE, "../images/") . ((!empty($products->file->ViewValue)) ? $products->file->ViewValue : $products->file->CurrentValue);
				if ($products->Export <> "") $products->file->HrefValue = ew_ConvertFullUrl($products->file->HrefValue);
			} else {
				$products->file->HrefValue = "";
			}

			// special
			$products->special->HrefValue = "";

			// order
			$products->order->HrefValue = "";

			// active
			$products->active->HrefValue = "";
		}

		// Call Row Rendered event
		$products->Row_Rendered();
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $products;
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
		if ($products->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo "\xEF\xBB\xBF";
			echo ew_ExportHeader($products->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $products->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id', $products->Export);
				ew_ExportAddValue($sExportStr, 'name', $products->Export);
				ew_ExportAddValue($sExportStr, 'name_arabic', $products->Export);
				ew_ExportAddValue($sExportStr, 'level', $products->Export);
				ew_ExportAddValue($sExportStr, 'image', $products->Export);
				ew_ExportAddValue($sExportStr, 'image2', $products->Export);
				ew_ExportAddValue($sExportStr, 'image3', $products->Export);
				ew_ExportAddValue($sExportStr, 'description', $products->Export);
				ew_ExportAddValue($sExportStr, 'description_arabic', $products->Export);
				ew_ExportAddValue($sExportStr, 'video', $products->Export);
				ew_ExportAddValue($sExportStr, 'file', $products->Export);
				ew_ExportAddValue($sExportStr, 'special', $products->Export);
				ew_ExportAddValue($sExportStr, 'order', $products->Export);
				ew_ExportAddValue($sExportStr, 'active', $products->Export);
				echo ew_ExportLine($sExportStr, $products->Export);
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
				$products->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($products->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id', $products->id->CurrentValue);
					$XmlDoc->AddField('name', $products->name->CurrentValue);
					$XmlDoc->AddField('name_arabic', $products->name_arabic->CurrentValue);
					$XmlDoc->AddField('level', $products->level->CurrentValue);
					$XmlDoc->AddField('image', $products->image->CurrentValue);
					$XmlDoc->AddField('image2', $products->image2->CurrentValue);
					$XmlDoc->AddField('image3', $products->image3->CurrentValue);
					$XmlDoc->AddField('description', $products->description->CurrentValue);
					$XmlDoc->AddField('description_arabic', $products->description_arabic->CurrentValue);
					$XmlDoc->AddField('video', $products->video->CurrentValue);
					$XmlDoc->AddField('file', $products->file->CurrentValue);
					$XmlDoc->AddField('special', $products->special->CurrentValue);
					$XmlDoc->AddField('order', $products->order->CurrentValue);
					$XmlDoc->AddField('active', $products->active->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $products->Export <> "csv") { // Vertical format
						echo ew_ExportField('id', $products->id->ExportValue($products->Export, $products->ExportOriginalValue), $products->Export);
						echo ew_ExportField('name', $products->name->ExportValue($products->Export, $products->ExportOriginalValue), $products->Export);
						echo ew_ExportField('name_arabic', $products->name_arabic->ExportValue($products->Export, $products->ExportOriginalValue), $products->Export);
						echo ew_ExportField('level', $products->level->ExportValue($products->Export, $products->ExportOriginalValue), $products->Export);
						echo ew_ExportField('image', $products->image->ExportValue($products->Export, $products->ExportOriginalValue), $products->Export);
						echo ew_ExportField('image2', $products->image2->ExportValue($products->Export, $products->ExportOriginalValue), $products->Export);
						echo ew_ExportField('image3', $products->image3->ExportValue($products->Export, $products->ExportOriginalValue), $products->Export);
						echo ew_ExportField('description', $products->description->ExportValue($products->Export, $products->ExportOriginalValue), $products->Export);
						echo ew_ExportField('description_arabic', $products->description_arabic->ExportValue($products->Export, $products->ExportOriginalValue), $products->Export);
						echo ew_ExportField('video', $products->video->ExportValue($products->Export, $products->ExportOriginalValue), $products->Export);
						echo ew_ExportField('file', $products->file->ExportValue($products->Export, $products->ExportOriginalValue), $products->Export);
						echo ew_ExportField('special', $products->special->ExportValue($products->Export, $products->ExportOriginalValue), $products->Export);
						echo ew_ExportField('order', $products->order->ExportValue($products->Export, $products->ExportOriginalValue), $products->Export);
						echo ew_ExportField('active', $products->active->ExportValue($products->Export, $products->ExportOriginalValue), $products->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $products->id->ExportValue($products->Export, $products->ExportOriginalValue), $products->Export);
						ew_ExportAddValue($sExportStr, $products->name->ExportValue($products->Export, $products->ExportOriginalValue), $products->Export);
						ew_ExportAddValue($sExportStr, $products->name_arabic->ExportValue($products->Export, $products->ExportOriginalValue), $products->Export);
						ew_ExportAddValue($sExportStr, $products->level->ExportValue($products->Export, $products->ExportOriginalValue), $products->Export);
						ew_ExportAddValue($sExportStr, $products->image->ExportValue($products->Export, $products->ExportOriginalValue), $products->Export);
						ew_ExportAddValue($sExportStr, $products->image2->ExportValue($products->Export, $products->ExportOriginalValue), $products->Export);
						ew_ExportAddValue($sExportStr, $products->image3->ExportValue($products->Export, $products->ExportOriginalValue), $products->Export);
						ew_ExportAddValue($sExportStr, $products->description->ExportValue($products->Export, $products->ExportOriginalValue), $products->Export);
						ew_ExportAddValue($sExportStr, $products->description_arabic->ExportValue($products->Export, $products->ExportOriginalValue), $products->Export);
						ew_ExportAddValue($sExportStr, $products->video->ExportValue($products->Export, $products->ExportOriginalValue), $products->Export);
						ew_ExportAddValue($sExportStr, $products->file->ExportValue($products->Export, $products->ExportOriginalValue), $products->Export);
						ew_ExportAddValue($sExportStr, $products->special->ExportValue($products->Export, $products->ExportOriginalValue), $products->Export);
						ew_ExportAddValue($sExportStr, $products->order->ExportValue($products->Export, $products->ExportOriginalValue), $products->Export);
						ew_ExportAddValue($sExportStr, $products->active->ExportValue($products->Export, $products->ExportOriginalValue), $products->Export);
						echo ew_ExportLine($sExportStr, $products->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($products->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($products->Export);
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
