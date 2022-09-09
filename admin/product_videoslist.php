<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "product_videosinfo.php" ?>
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
$product_videos_list = new cproduct_videos_list();
$Page =& $product_videos_list;

// Page init processing
$product_videos_list->Page_Init();

// Page main processing
$product_videos_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($product_videos->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var product_videos_list = new ew_Page("product_videos_list");

// page properties
product_videos_list.PageID = "list"; // page ID
var EW_PAGE_ID = product_videos_list.PageID; // for backward compatibility

// extend page with ValidateForm function
product_videos_list.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	var addcnt = 0;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		var chkthisrow = true;
		if (fobj.a_list && fobj.a_list.value == "gridinsert")
			chkthisrow = !(this.EmptyRow(fobj, infix));
		else
			chkthisrow = true;
		if (chkthisrow) {
			addcnt += 1;
		elm = fobj.elements["x" + infix + "_video"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - video");
		elm = fobj.elements["x" + infix + "_product_id"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - product");
		elm = fobj.elements["x" + infix + "_order"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - order");
		elm = fobj.elements["x" + infix + "_order"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "Incorrect integer - order");
		elm = fobj.elements["x" + infix + "_active"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - active");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
		} // End Grid Add checking
	}
	if (fobj.a_list && fobj.a_list.value == "gridinsert" && addcnt == 0) { // No row added
		alert("No records to be added");
		return false;
	}
	return true;
}

// Extend page with empty row check
product_videos_list.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "video")) return false;
	if (ew_ValueChanged(fobj, infix, "product_id")) return false;
	if (ew_ValueChanged(fobj, infix, "order")) return false;
	if (ew_ValueChanged(fobj, infix, "active")) return false;
	return true;
}

// extend page with Form_CustomValidate function
product_videos_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
product_videos_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
product_videos_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
product_videos_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
product_videos_list.ShowHighlightText = "Show highlight"; 
product_videos_list.HideHighlightText = "Hide highlight";

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

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
<?php if ($product_videos->Export == "") { ?>
<?php
$gsMasterReturnUrl = "productslist.php";
if ($product_videos_list->sDbMasterFilter <> "" && $product_videos->getCurrentMasterTable() == "products") {
	if ($product_videos_list->bMasterRecordExists) {
		if ($product_videos->getCurrentMasterTable() == $product_videos->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "productsmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
if ($product_videos->CurrentAction == "gridadd")
	$product_videos->CurrentFilter = "0=1";
if ($product_videos->CurrentAction == "gridadd") {
	$product_videos_list->lStartRec = 1;
	if ($product_videos_list->lDisplayRecs <= 0)
		$product_videos_list->lDisplayRecs = 20;
	$product_videos_list->lTotalRecs = $product_videos_list->lDisplayRecs;
	$product_videos_list->lStopRec = $product_videos_list->lDisplayRecs;
} else {
	$bSelectLimit = ($product_videos->Export == "" && $product_videos->SelectLimit);
	if (!$bSelectLimit)
		$rs = $product_videos_list->LoadRecordset();
	$product_videos_list->lTotalRecs = ($bSelectLimit) ? $product_videos->SelectRecordCount() : $rs->RecordCount();
	$product_videos_list->lStartRec = 1;
	if ($product_videos_list->lDisplayRecs <= 0) // Display all records
		$product_videos_list->lDisplayRecs = $product_videos_list->lTotalRecs;
	if (!($product_videos->ExportAll && $product_videos->Export <> ""))
		$product_videos_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $product_videos_list->LoadRecordset($product_videos_list->lStartRec-1, $product_videos_list->lDisplayRecs);
}
?>
<p><span class="phpmaker" style="white-space: nowrap;">TABLE: product videos
<?php if ($product_videos->Export == "" && $product_videos->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $product_videos_list->PageUrl() ?>export=print">Printer Friendly</a>
&nbsp;&nbsp;<a href="<?php echo $product_videos_list->PageUrl() ?>export=html">Export to HTML</a>
&nbsp;&nbsp;<a href="<?php echo $product_videos_list->PageUrl() ?>export=excel">Export to Excel</a>
&nbsp;&nbsp;<a href="<?php echo $product_videos_list->PageUrl() ?>export=word">Export to Word</a>
&nbsp;&nbsp;<a href="<?php echo $product_videos_list->PageUrl() ?>export=xml">Export to XML</a>
&nbsp;&nbsp;<a href="<?php echo $product_videos_list->PageUrl() ?>export=csv">Export to CSV</a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($product_videos->Export == "" && $product_videos->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(product_videos_list);" style="text-decoration: none;"><img id="product_videos_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="product_videos_list_SearchPanel">
<form name="fproduct_videoslistsrch" id="fproduct_videoslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="product_videos">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($product_videos->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Search (*)">&nbsp;
			<a href="<?php echo $product_videos_list->PageUrl() ?>cmd=reset">Show all</a>&nbsp;
			<a href="product_videossrch.php">Advanced Search</a>&nbsp;
			<?php if ($product_videos_list->sSrchWhere <> "" && $product_videos_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(product_videos_list, this, '<?php echo $product_videos->HighlightName() ?>');">Hide highlight</a>
			<?php } ?>
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($product_videos->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>Exact phrase</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($product_videos->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>All words</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($product_videos->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>Any word</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $product_videos_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($product_videos->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($product_videos->CurrentAction <> "gridadd" && $product_videos->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($product_videos_list->Pager)) $product_videos_list->Pager = new cPrevNextPager($product_videos_list->lStartRec, $product_videos_list->lDisplayRecs, $product_videos_list->lTotalRecs) ?>
<?php if ($product_videos_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($product_videos_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $product_videos_list->PageUrl() ?>start=<?php echo $product_videos_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($product_videos_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $product_videos_list->PageUrl() ?>start=<?php echo $product_videos_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $product_videos_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($product_videos_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $product_videos_list->PageUrl() ?>start=<?php echo $product_videos_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($product_videos_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $product_videos_list->PageUrl() ?>start=<?php echo $product_videos_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $product_videos_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $product_videos_list->Pager->FromIndex ?> to <?php echo $product_videos_list->Pager->ToIndex ?> of <?php echo $product_videos_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($product_videos_list->sSrchWhere == "0=101") { ?>
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
<span class="phpmaker">
<?php if ($product_videos->CurrentAction <> "gridadd" && $product_videos->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $product_videos->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<a href="<?php echo $product_videos_list->PageUrl() ?>a=add">Inline Add</a>&nbsp;&nbsp;
<a href="<?php echo $product_videos_list->PageUrl() ?>a=gridadd">Grid Add</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($product_videos_list->lTotalRecs > 0) { ?>
<a href="<?php echo $product_videos_list->PageUrl() ?>a=gridedit">Grid Edit</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if ($product_videos_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fproduct_videoslist)) alert('No records selected'); else if (ew_Confirm('<?php echo $product_videos_list->sDeleteConfirmMsg ?>')) {document.fproduct_videoslist.action='product_videosdelete.php';document.fproduct_videoslist.encoding='application/x-www-form-urlencoded';document.fproduct_videoslist.submit();};return false;">Delete Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fproduct_videoslist)) alert('No records selected'); else {document.fproduct_videoslist.action='product_videosupdate.php';document.fproduct_videoslist.encoding='application/x-www-form-urlencoded';document.fproduct_videoslist.submit();};return false;">Update Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($product_videos->CurrentAction == "gridadd") { ?>
<a href="" onclick="if (product_videos_list.ValidateForm(document.fproduct_videoslist)) document.fproduct_videoslist.submit();return false;">Insert</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($product_videos->CurrentAction == "gridedit") { ?>
<a href="" onclick="if (product_videos_list.ValidateForm(document.fproduct_videoslist)) document.fproduct_videoslist.submit();return false;">Save</a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php echo $product_videos_list->PageUrl() ?>a=cancel">Cancel</a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fproduct_videoslist" id="fproduct_videoslist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="product_videos">
<?php if ($product_videos_list->lTotalRecs > 0 || $product_videos->CurrentAction == "add" || $product_videos->CurrentAction == "copy") { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$product_videos_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$product_videos_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$product_videos_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$product_videos_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$product_videos_list->lOptionCnt++; // Multi-select
}
	$product_videos_list->lOptionCnt += count($product_videos_list->ListOptions->Items); // Custom list options
?>
<?php echo $product_videos->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($product_videos->id->Visible) { // id ?>
	<?php if ($product_videos->SortUrl($product_videos->id) == "") { ?>
		<td>id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $product_videos->SortUrl($product_videos->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>id</td><td style="width: 10px;"><?php if ($product_videos->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($product_videos->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($product_videos->video->Visible) { // video ?>
	<?php if ($product_videos->SortUrl($product_videos->video) == "") { ?>
		<td>video</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $product_videos->SortUrl($product_videos->video) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>video&nbsp;(*)</td><td style="width: 10px;"><?php if ($product_videos->video->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($product_videos->video->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($product_videos->product_id->Visible) { // product_id ?>
	<?php if ($product_videos->SortUrl($product_videos->product_id) == "") { ?>
		<td>product</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $product_videos->SortUrl($product_videos->product_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>product</td><td style="width: 10px;"><?php if ($product_videos->product_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($product_videos->product_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($product_videos->order->Visible) { // order ?>
	<?php if ($product_videos->SortUrl($product_videos->order) == "") { ?>
		<td>order</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $product_videos->SortUrl($product_videos->order) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>order</td><td style="width: 10px;"><?php if ($product_videos->order->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($product_videos->order->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($product_videos->active->Visible) { // active ?>
	<?php if ($product_videos->SortUrl($product_videos->active) == "") { ?>
		<td>active</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $product_videos->SortUrl($product_videos->active) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>active</td><td style="width: 10px;"><?php if ($product_videos->active->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($product_videos->active->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($product_videos->Export == "") { ?>
<?php if ($product_videos->CurrentAction <> "gridadd" && $product_videos->CurrentAction <> "gridedit") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($product_videos_list->lOptionCnt == 0 && $product_videos->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="phpmaker" onclick="product_videos_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($product_videos_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
</thead>
<?php
	if ($product_videos->CurrentAction == "add" || $product_videos->CurrentAction == "copy") {
		$product_videos_list->lRowIndex = 1;
		if ($product_videos->CurrentAction == "copy" && !$product_videos_list->LoadRow())
				$product_videos->CurrentAction = "add";
		if ($product_videos->CurrentAction == "add")
			$product_videos_list->LoadDefaultValues();
		if ($product_videos->EventCancelled) // Insert failed
			$product_videos_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$product_videos->CssClass = "ewTableEditRow";
		$product_videos->CssStyle = "";
		$product_videos->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
		$product_videos->RowType = EW_ROWTYPE_ADD;

		// Render row
		$product_videos_list->RenderRow();
?>
	<tr<?php echo $product_videos->RowAttributes() ?>>
	<?php if ($product_videos->id->Visible) { // id ?>
		<td>&nbsp;</td>
	<?php } ?>
	<?php if ($product_videos->video->Visible) { // video ?>
		<td>
<input type="text" name="x<?php echo $product_videos_list->lRowIndex ?>_video" id="x<?php echo $product_videos_list->lRowIndex ?>_video" size="30" maxlength="200" value="<?php echo $product_videos->video->EditValue ?>"<?php echo $product_videos->video->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($product_videos->product_id->Visible) { // product_id ?>
		<td>
<?php if ($product_videos->product_id->getSessionValue() <> "") { ?>
<div<?php echo $product_videos->product_id->ViewAttributes() ?>><?php echo $product_videos->product_id->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $product_videos_list->lRowIndex ?>_product_id" name="x<?php echo $product_videos_list->lRowIndex ?>_product_id" value="<?php echo ew_HtmlEncode($product_videos->product_id->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $product_videos_list->lRowIndex ?>_product_id" name="x<?php echo $product_videos_list->lRowIndex ?>_product_id"<?php echo $product_videos->product_id->EditAttributes() ?>>
<?php
if (is_array($product_videos->product_id->EditValue)) {
	$arwrk = $product_videos->product_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($product_videos->product_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
if ($emptywrk) $product_videos->product_id->OldValue = "";
?>
</select>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($product_videos->order->Visible) { // order ?>
		<td>
<input type="text" name="x<?php echo $product_videos_list->lRowIndex ?>_order" id="x<?php echo $product_videos_list->lRowIndex ?>_order" size="30" value="<?php echo $product_videos->order->EditValue ?>"<?php echo $product_videos->order->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($product_videos->active->Visible) { // active ?>
		<td>
<div id="tp_x<?php echo $product_videos_list->lRowIndex ?>_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x<?php echo $product_videos_list->lRowIndex ?>_active" id="x<?php echo $product_videos_list->lRowIndex ?>_active" value="{value}"<?php echo $product_videos->active->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $product_videos_list->lRowIndex ?>_active" repeatcolumn="5">
<?php
$arwrk = $product_videos->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($product_videos->active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $product_videos_list->lRowIndex ?>_active" id="x<?php echo $product_videos_list->lRowIndex ?>_active" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $product_videos->active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
if ($emptywrk) $product_videos->active->OldValue = "";
?>
</div>
</td>
	<?php } ?>
<td colspan="<?php echo $product_videos_list->lOptionCnt ?>"><span class="phpmaker">
<a href="" onclick="if (product_videos_list.ValidateForm(document.fproduct_videoslist)) document.fproduct_videoslist.submit();return false;">Insert</a>&nbsp;<a href="<?php echo $product_videos_list->PageUrl() ?>a=cancel">Cancel</a>
<input type="hidden" name="a_list" id="a_list" value="insert">
</span></td>
	</tr>
<?php
}
?>
<?php
if ($product_videos->ExportAll && $product_videos->Export <> "") {
	$product_videos_list->lStopRec = $product_videos_list->lTotalRecs;
} else {
	$product_videos_list->lStopRec = $product_videos_list->lStartRec + $product_videos_list->lDisplayRecs - 1; // Set the last record to display
}
$product_videos_list->lRecCount = $product_videos_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$product_videos->SelectLimit && $product_videos_list->lStartRec > 1)
		$rs->Move($product_videos_list->lStartRec - 1);
}
$product_videos_list->lRowCnt = 0;
$product_videos_list->lEditRowCnt = 0;
if ($product_videos->CurrentAction == "edit")
	$product_videos_list->lRowIndex = 1;
if ($product_videos->CurrentAction == "gridadd")
	$product_videos_list->lRowIndex = 0;
if ($product_videos->CurrentAction == "gridedit")
	$product_videos_list->lRowIndex = 0;
while (($product_videos->CurrentAction == "gridadd" || !$rs->EOF) &&
	$product_videos_list->lRecCount < $product_videos_list->lStopRec) {
	$product_videos_list->lRecCount++;
	if (intval($product_videos_list->lRecCount) >= intval($product_videos_list->lStartRec)) {
		$product_videos_list->lRowCnt++;
		if ($product_videos->CurrentAction == "gridadd" || $product_videos->CurrentAction == "gridedit")
			$product_videos_list->lRowIndex++;

	// Init row class and style
	$product_videos->CssClass = "";
	$product_videos->CssStyle = "";
	$product_videos->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($product_videos->CurrentAction == "gridadd") {
		$product_videos_list->LoadDefaultValues(); // Load default values
	} else {
		$product_videos_list->LoadRowValues($rs); // Load row values
	}
	$product_videos->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($product_videos->CurrentAction == "gridadd") // Grid add
		$product_videos->RowType = EW_ROWTYPE_ADD; // Render add
	if ($product_videos->CurrentAction == "gridadd" && $product_videos->EventCancelled) // Insert failed
		$product_videos_list->RestoreCurrentRowFormValues($product_videos_list->lRowIndex); // Restore form values
	if ($product_videos->CurrentAction == "edit") {
		if ($product_videos_list->CheckInlineEditKey() && $product_videos_list->lEditRowCnt == 0) // Inline edit
			$product_videos->RowType = EW_ROWTYPE_EDIT; // Render edit
	}
	if ($product_videos->CurrentAction == "gridedit") // Grid edit
		$product_videos->RowType = EW_ROWTYPE_EDIT; // Render edit
	if ($product_videos->RowType == EW_ROWTYPE_EDIT && $product_videos->EventCancelled) { // Update failed
		if ($product_videos->CurrentAction == "edit")
			$product_videos_list->RestoreFormValues(); // Restore form values
		if ($product_videos->CurrentAction == "gridedit")
			$product_videos_list->RestoreCurrentRowFormValues($product_videos_list->lRowIndex); // Restore form values
	}
	if ($product_videos->RowType == EW_ROWTYPE_EDIT) { // Edit row
		$product_videos_list->lEditRowCnt++;
		$product_videos->RowClientEvents = "onmouseover='this.edit=true;ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	}
	if ($product_videos->RowType == EW_ROWTYPE_ADD || $product_videos->RowType == EW_ROWTYPE_EDIT) // Add / Edit row
			$product_videos->CssClass = "ewTableEditRow";

	// Render row
	$product_videos_list->RenderRow();
?>
	<tr<?php echo $product_videos->RowAttributes() ?>>
	<?php if ($product_videos->id->Visible) { // id ?>
		<td<?php echo $product_videos->id->CellAttributes() ?>>
<?php if ($product_videos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $product_videos_list->lRowIndex ?>_id" id="o<?php echo $product_videos_list->lRowIndex ?>_id" value="<?php echo ew_HtmlEncode($product_videos->id->OldValue) ?>">
<?php } ?>
<?php if ($product_videos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $product_videos->id->ViewAttributes() ?>><?php echo $product_videos->id->EditValue ?></div><input type="hidden" name="x<?php echo $product_videos_list->lRowIndex ?>_id" id="x<?php echo $product_videos_list->lRowIndex ?>_id" value="<?php echo ew_HtmlEncode($product_videos->id->CurrentValue) ?>">
<?php } ?>
<?php if ($product_videos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $product_videos->id->ViewAttributes() ?>><?php echo $product_videos->id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($product_videos->video->Visible) { // video ?>
		<td<?php echo $product_videos->video->CellAttributes() ?>>
<?php if ($product_videos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $product_videos_list->lRowIndex ?>_video" id="x<?php echo $product_videos_list->lRowIndex ?>_video" size="30" maxlength="200" value="<?php echo $product_videos->video->EditValue ?>"<?php echo $product_videos->video->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $product_videos_list->lRowIndex ?>_video" id="o<?php echo $product_videos_list->lRowIndex ?>_video" value="<?php echo ew_HtmlEncode($product_videos->video->OldValue) ?>">
<?php } ?>
<?php if ($product_videos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $product_videos_list->lRowIndex ?>_video" id="x<?php echo $product_videos_list->lRowIndex ?>_video" size="30" maxlength="200" value="<?php echo $product_videos->video->EditValue ?>"<?php echo $product_videos->video->EditAttributes() ?>>
<?php } ?>
<?php if ($product_videos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $product_videos->video->ViewAttributes() ?>><?php echo $product_videos->video->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($product_videos->product_id->Visible) { // product_id ?>
		<td<?php echo $product_videos->product_id->CellAttributes() ?>>
<?php if ($product_videos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($product_videos->product_id->getSessionValue() <> "") { ?>
<div<?php echo $product_videos->product_id->ViewAttributes() ?>><?php echo $product_videos->product_id->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $product_videos_list->lRowIndex ?>_product_id" name="x<?php echo $product_videos_list->lRowIndex ?>_product_id" value="<?php echo ew_HtmlEncode($product_videos->product_id->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $product_videos_list->lRowIndex ?>_product_id" name="x<?php echo $product_videos_list->lRowIndex ?>_product_id"<?php echo $product_videos->product_id->EditAttributes() ?>>
<?php
if (is_array($product_videos->product_id->EditValue)) {
	$arwrk = $product_videos->product_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($product_videos->product_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
if ($emptywrk) $product_videos->product_id->OldValue = "";
?>
</select>
<?php } ?>
<input type="hidden" name="o<?php echo $product_videos_list->lRowIndex ?>_product_id" id="o<?php echo $product_videos_list->lRowIndex ?>_product_id" value="<?php echo ew_HtmlEncode($product_videos->product_id->OldValue) ?>">
<?php } ?>
<?php if ($product_videos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($product_videos->product_id->getSessionValue() <> "") { ?>
<div<?php echo $product_videos->product_id->ViewAttributes() ?>><?php echo $product_videos->product_id->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $product_videos_list->lRowIndex ?>_product_id" name="x<?php echo $product_videos_list->lRowIndex ?>_product_id" value="<?php echo ew_HtmlEncode($product_videos->product_id->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $product_videos_list->lRowIndex ?>_product_id" name="x<?php echo $product_videos_list->lRowIndex ?>_product_id"<?php echo $product_videos->product_id->EditAttributes() ?>>
<?php
if (is_array($product_videos->product_id->EditValue)) {
	$arwrk = $product_videos->product_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($product_videos->product_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
if ($emptywrk) $product_videos->product_id->OldValue = "";
?>
</select>
<?php } ?>
<?php } ?>
<?php if ($product_videos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $product_videos->product_id->ViewAttributes() ?>><?php echo $product_videos->product_id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($product_videos->order->Visible) { // order ?>
		<td<?php echo $product_videos->order->CellAttributes() ?>>
<?php if ($product_videos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $product_videos_list->lRowIndex ?>_order" id="x<?php echo $product_videos_list->lRowIndex ?>_order" size="30" value="<?php echo $product_videos->order->EditValue ?>"<?php echo $product_videos->order->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $product_videos_list->lRowIndex ?>_order" id="o<?php echo $product_videos_list->lRowIndex ?>_order" value="<?php echo ew_HtmlEncode($product_videos->order->OldValue) ?>">
<?php } ?>
<?php if ($product_videos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $product_videos_list->lRowIndex ?>_order" id="x<?php echo $product_videos_list->lRowIndex ?>_order" size="30" value="<?php echo $product_videos->order->EditValue ?>"<?php echo $product_videos->order->EditAttributes() ?>>
<?php } ?>
<?php if ($product_videos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $product_videos->order->ViewAttributes() ?>><?php echo $product_videos->order->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($product_videos->active->Visible) { // active ?>
		<td<?php echo $product_videos->active->CellAttributes() ?>>
<?php if ($product_videos->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<div id="tp_x<?php echo $product_videos_list->lRowIndex ?>_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x<?php echo $product_videos_list->lRowIndex ?>_active" id="x<?php echo $product_videos_list->lRowIndex ?>_active" value="{value}"<?php echo $product_videos->active->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $product_videos_list->lRowIndex ?>_active" repeatcolumn="5">
<?php
$arwrk = $product_videos->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($product_videos->active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $product_videos_list->lRowIndex ?>_active" id="x<?php echo $product_videos_list->lRowIndex ?>_active" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $product_videos->active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
if ($emptywrk) $product_videos->active->OldValue = "";
?>
</div>
<input type="hidden" name="o<?php echo $product_videos_list->lRowIndex ?>_active" id="o<?php echo $product_videos_list->lRowIndex ?>_active" value="<?php echo ew_HtmlEncode($product_videos->active->OldValue) ?>">
<?php } ?>
<?php if ($product_videos->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div id="tp_x<?php echo $product_videos_list->lRowIndex ?>_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x<?php echo $product_videos_list->lRowIndex ?>_active" id="x<?php echo $product_videos_list->lRowIndex ?>_active" value="{value}"<?php echo $product_videos->active->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $product_videos_list->lRowIndex ?>_active" repeatcolumn="5">
<?php
$arwrk = $product_videos->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($product_videos->active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $product_videos_list->lRowIndex ?>_active" id="x<?php echo $product_videos_list->lRowIndex ?>_active" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $product_videos->active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
if ($emptywrk) $product_videos->active->OldValue = "";
?>
</div>
<?php } ?>
<?php if ($product_videos->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $product_videos->active->ViewAttributes() ?>><?php echo $product_videos->active->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php if ($product_videos->RowType == EW_ROWTYPE_ADD || $product_videos->RowType == EW_ROWTYPE_EDIT) { ?>
<?php if ($product_videos->CurrentAction == "edit") { ?>
<td colspan="<?php echo $product_videos_list->lOptionCnt ?>"><span class="phpmaker">
<a href="" onclick="if (product_videos_list.ValidateForm(document.fproduct_videoslist)) document.fproduct_videoslist.submit();return false;">Update</a>&nbsp;<a href="<?php echo $product_videos_list->PageUrl() ?>a=cancel">Cancel</a>
<input type="hidden" name="a_list" id="a_list" value="update">
</span></td>
<?php } ?>
<?php
	if ($product_videos->CurrentAction == "gridedit")
		$product_videos_list->sMultiSelectKey .= "<input type=\"hidden\" name=\"k" . $product_videos_list->lRowIndex . "_key\" id=\"k" . $product_videos_list->lRowIndex . "_key\" value=\"" . $product_videos->id->CurrentValue . "\">";
?>
<?php } else { ?>
<?php if ($product_videos->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $product_videos->ViewUrl() ?>">View</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $product_videos->EditUrl() ?>">Edit</a><span class="ewSeparator">&nbsp;|&nbsp;</span><a href="<?php echo $product_videos->InlineEditUrl() ?>">Inline Edit</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $product_videos->CopyUrl() ?>">Copy</a><span class="ewSeparator">&nbsp;|&nbsp;</span><a href="<?php echo $product_videos->InlineCopyUrl() ?>">Inline Copy</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($product_videos_list->lOptionCnt == 0 && $product_videos->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($product_videos->id->CurrentValue) ?>" class="phpmaker" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($product_videos_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
<?php if ($product_videos->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($product_videos->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($product_videos->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($product_videos->CurrentAction == "add" || $product_videos->CurrentAction == "copy") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $product_videos_list->lRowIndex ?>">
<?php } ?>
<?php if ($product_videos->CurrentAction == "gridadd") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $product_videos_list->lRowIndex ?>">
<?php } ?>
<?php if ($product_videos->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $product_videos_list->lRowIndex ?>">
<?php } ?>
<?php if ($product_videos->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $product_videos_list->lRowIndex ?>">
<?php echo $product_videos_list->sMultiSelectKey ?>
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
<?php if ($product_videos_list->lTotalRecs > 0) { ?>
<?php if ($product_videos->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($product_videos->CurrentAction <> "gridadd" && $product_videos->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($product_videos_list->Pager)) $product_videos_list->Pager = new cPrevNextPager($product_videos_list->lStartRec, $product_videos_list->lDisplayRecs, $product_videos_list->lTotalRecs) ?>
<?php if ($product_videos_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($product_videos_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $product_videos_list->PageUrl() ?>start=<?php echo $product_videos_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($product_videos_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $product_videos_list->PageUrl() ?>start=<?php echo $product_videos_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $product_videos_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($product_videos_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $product_videos_list->PageUrl() ?>start=<?php echo $product_videos_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($product_videos_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $product_videos_list->PageUrl() ?>start=<?php echo $product_videos_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $product_videos_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $product_videos_list->Pager->FromIndex ?> to <?php echo $product_videos_list->Pager->ToIndex ?> of <?php echo $product_videos_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($product_videos_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($product_videos_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($product_videos->CurrentAction <> "gridadd" && $product_videos->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $product_videos->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<a href="<?php echo $product_videos_list->PageUrl() ?>a=add">Inline Add</a>&nbsp;&nbsp;
<a href="<?php echo $product_videos_list->PageUrl() ?>a=gridadd">Grid Add</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($product_videos_list->lTotalRecs > 0) { ?>
<a href="<?php echo $product_videos_list->PageUrl() ?>a=gridedit">Grid Edit</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if ($product_videos_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fproduct_videoslist)) alert('No records selected'); else if (ew_Confirm('<?php echo $product_videos_list->sDeleteConfirmMsg ?>')) {document.fproduct_videoslist.action='product_videosdelete.php';document.fproduct_videoslist.encoding='application/x-www-form-urlencoded';document.fproduct_videoslist.submit();};return false;">Delete Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fproduct_videoslist)) alert('No records selected'); else {document.fproduct_videoslist.action='product_videosupdate.php';document.fproduct_videoslist.encoding='application/x-www-form-urlencoded';document.fproduct_videoslist.submit();};return false;">Update Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($product_videos->CurrentAction == "gridadd") { ?>
<a href="" onclick="if (product_videos_list.ValidateForm(document.fproduct_videoslist)) document.fproduct_videoslist.submit();return false;">Insert</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($product_videos->CurrentAction == "gridedit") { ?>
<a href="" onclick="if (product_videos_list.ValidateForm(document.fproduct_videoslist)) document.fproduct_videoslist.submit();return false;">Save</a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php echo $product_videos_list->PageUrl() ?>a=cancel">Cancel</a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($product_videos->Export == "" && $product_videos->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(product_videos_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($product_videos->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$product_videos_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class cproduct_videos_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'product_videos';

	// Page Object Name
	var $PageObjName = 'product_videos_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $product_videos;
		if ($product_videos->UseTokenInUrl) $PageUrl .= "t=" . $product_videos->TableVar . "&"; // add page token
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
		global $objForm, $product_videos;
		if ($product_videos->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($product_videos->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($product_videos->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cproduct_videos_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["product_videos"] = new cproduct_videos();

		// Initialize other table object
		$GLOBALS['products'] = new cproducts();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'product_videos', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $product_videos;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$product_videos->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $product_videos->Export; // Get export parameter, used in header
	$gsExportFile = $product_videos->TableVar; // Get export file, used in header
	if ($product_videos->Export == "print" || $product_videos->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($product_videos->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($product_videos->Export == "word") {
		header('Content-Type: application/vnd.ms-word;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($product_videos->Export == "xml") {
		header('Content-Type: text/xml;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($product_videos->Export == "csv") {
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
	var $sSrchWhere;
	var $lRecCnt;
	var $lEditRowCnt;
	var $lRowCnt;
	var $lRowIndex;
	var $lOptionCnt;
	var $lRecPerRow;
	var $lColCnt;
	var $sDeleteConfirmMsg; // Delete confirm message
	var $sDbMasterFilter;
	var $sDbDetailFilter;
	var $bMasterRecordExists;	
	var $ListOptions;
	var $sMultiSelectKey;

	//
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsSearchError, $Security, $product_videos;
		$this->lDisplayRecs = 20;
		$this->lRecRange = 10;
		$this->lRecCnt = 0; // Record count

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		$this->sSrchWhere = ""; // Search WHERE clause
		$this->sDeleteConfirmMsg = "Do you want to delete the selected records?"; // Delete confirm message

		// Master/Detail
		$this->sDbMasterFilter = ""; // Master filter
		$this->sDbDetailFilter = ""; // Detail filter

		// Create form object
		$objForm = new cFormObj();
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Set up master detail parameters
			$this->SetUpMasterDetail();

			// Check QueryString parameters
			if (@$_GET["a"] <> "") {
				$product_videos->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($product_videos->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to grid edit mode
				if ($product_videos->CurrentAction == "gridedit")
					$this->GridEditMode();

				// Switch to inline edit mode
				if ($product_videos->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($product_videos->CurrentAction == "add" || $product_videos->CurrentAction == "copy")
					$this->InlineAddMode();

				// Switch to grid add mode
				if ($product_videos->CurrentAction == "gridadd")
					$this->GridAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$product_videos->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Update
					if ($product_videos->CurrentAction == "gridupdate" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridedit")
						$this->GridUpdate();

					// Inline Update
					if ($product_videos->CurrentAction == "update" && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($product_videos->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
						$this->InlineInsert();

					// Grid Insert
					if ($product_videos->CurrentAction == "gridinsert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridadd")
						$this->GridInsert();
				}
			}

			// Get search criteria for advanced search
			$this->LoadSearchValues(); // Get search values
			if ($this->ValidateSearch()) {
				$sSrchAdvanced = $this->AdvancedSearchWhere();
			} else {
				$this->setMessage($gsSearchError);
			}

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();

			// Set Up Sorting Order
			$this->SetUpSortOrder();
		} // End Validate Request

		// Restore display records
		if ($product_videos->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $product_videos->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		if ($sSrchAdvanced <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "($this->sSrchWhere) AND ($sSrchAdvanced)" : $sSrchAdvanced;
		if ($sSrchBasic <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "($this->sSrchWhere) AND ($sSrchBasic)" : $sSrchBasic;

		// Call Recordset_Searching event
		$product_videos->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$product_videos->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$product_videos->setStartRecordNumber($this->lStartRec);
		} else {
			$this->RestoreSearchParms();
		}

		// Build filter
		$sTblDefaultFilter = "";
		$sFilter = $sTblDefaultFilter;

		// Restore master/detail filter
		$this->sDbMasterFilter = $product_videos->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $product_videos->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($product_videos->getMasterFilter() <> "" && $product_videos->getCurrentMasterTable() == "products") {
			global $products;
			$rsmaster = $products->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$product_videos->setMasterFilter(""); // Clear master filter
				$product_videos->setDetailFilter(""); // Clear detail filter
				$this->setMessage("No records found"); // Set no record found
				$this->Page_Terminate($product_videos->getReturnUrl()); // Return to caller
			} else {
				$products->LoadListRowValues($rsmaster);
				$products->RowType = EW_ROWTYPE_MASTER; // Master row
				$products->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in Session
		$product_videos->setSessionWhere($sFilter);
		$product_videos->CurrentFilter = "";

		// Export data only
		if (in_array($product_videos->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	//  Exit out of inline mode
	function ClearInlineMode() {
		global $product_videos;
		$product_videos->setKey("id", ""); // Clear inline edit key
		$product_videos->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Add Mode
	function GridAddMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridadd"; // Enabled grid add
	}

	// Switch to Grid Edit Mode
	function GridEditMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridedit"; // Enable grid edit
	}

	// Switch to Inline Edit Mode
	function InlineEditMode() {
		global $Security, $product_videos;
		$bInlineEdit = TRUE;
		if (@$_GET["id"] <> "") {
			$product_videos->id->setQueryStringValue($_GET["id"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$product_videos->setKey("id", $product_videos->id->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to inline edit record
	function InlineUpdate() {
		global $objForm, $gsFormError, $product_videos;
		$objForm->Index = 1; 
		$this->LoadFormValues(); // Get form values

		// Validate Form
		$bInlineUpdate = TRUE;
		if (!$this->ValidateForm()) {	
			$bInlineUpdate = FALSE; // Form error, reset action
			$this->setMessage($gsFormError);
		} else {
			$bInlineUpdate = FALSE;	
			if ($this->CheckInlineEditKey()) { // Check key
				$product_videos->SendEmail = TRUE; // Send email on update success
				$bInlineUpdate = $this->EditRow(); // Update record
			} else {
				$bInlineUpdate = FALSE;
			}
		}
		if ($bInlineUpdate) { // Update success
			$this->setMessage("Update succeeded"); // Set success message
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->getMessage() == "")
				$this->setMessage("Update failed"); // Set update failed message
			$product_videos->EventCancelled = TRUE; // Cancel event
			$product_videos->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check inline edit key
	function CheckInlineEditKey() {
		global $product_videos;

		//CheckInlineEditKey = True
		if (strval($product_videos->getKey("id")) <> strval($product_videos->id->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add Mode
	function InlineAddMode() {
		global $Security, $product_videos;
		if ($product_videos->CurrentAction == "copy") {
			if (@$_GET["id"] <> "") {
				$product_videos->id->setQueryStringValue($_GET["id"]);
			} else {
				$product_videos->CurrentAction = "add";
			}
		}
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to inline add/copy record
	function InlineInsert() {
		global $objForm, $gsFormError, $product_videos;
		$objForm->Index = 1;
		$this->LoadFormValues(); // Get form values

		// Validate Form
		if (!$this->ValidateForm()) {
			$this->setMessage($gsFormError); // Set validation error message
			$product_videos->EventCancelled = TRUE; // Set event cancelled
			$product_videos->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$product_videos->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow()) { // Add record
			$this->setMessage("Add succeeded"); // Set add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$product_videos->EventCancelled = TRUE; // Set event cancelled
			$product_videos->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Perform update to grid
	function GridUpdate() {
		global $conn, $objForm, $gsFormError, $product_videos;
		$rowindex = 1;
		$bGridUpdate = TRUE;

		// Begin transaction
		$conn->BeginTrans();

		// Get old recordset
		$product_videos->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $product_videos->SQL();
		if ($rs = $conn->Execute($sSql)) {
			$rsold = $rs->GetRows();
			$rs->Close();
		}
		$sKey = "";

		// Update row index and get row key
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));

		// Update all rows based on key
		while ($sThisKey <> "") {

			// Load all values & keys
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$bGridUpdate = FALSE; // Form error, reset action
				$this->setMessage($gsFormError);
			} else {
				if ($this->SetupKeyValues($sThisKey)) { // Set up key values
					$product_videos->SendEmail = FALSE; // Do not send email on update success
					$bGridUpdate = $this->EditRow(); // Update this row
				} else {
					$bGridUpdate = FALSE; // update failed
				}
			}
			if ($bGridUpdate) {
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			} else {
				break;
			}

			// Update row index and get row key
			$rowindex++; // next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue("k_key"));
		}
		if ($bGridUpdate) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}
			$this->setMessage("Update succeeded"); // Set update success message
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			$conn->RollbackTrans(); // Rollback transaction
			if ($this->getMessage() == "")
				$this->setMessage("Update failed"); // Set update failed message
			$product_videos->EventCancelled = TRUE; // Set event cancelled
			$product_videos->CurrentAction = "gridedit"; // Stay in gridedit mode
		}
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $product_videos;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $product_videos->KeyFilter();
				if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
				$sWrkFilter .= $sFilter;
			} else {
				$sWrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue("k_key"));
		}
		return $sWrkFilter;
	}

	// Set up key values
	function SetupKeyValues($key) {
		global $product_videos;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$product_videos->id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($product_videos->id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Grid Insert
	// Perform insert to grid
	function GridInsert() {
		global $conn, $objForm, $gsFormError, $product_videos;
		$rowindex = 1;
		$bGridInsert = FALSE;

		// Begin transaction
		$conn->BeginTrans();

		// Init key filter
		$sWrkFilter = "";
		$addcnt = 0;
		$sKey = "";

		// Get row count
		$objForm->Index = 0;
		$rowcnt = strval($objForm->GetValue("key_count"));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Insert all rows
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$this->LoadFormValues(); // Get form values
			if (!$this->EmptyRow()) {
				$addcnt++;
				$product_videos->SendEmail = FALSE; // Do not send email on insert success

				// Validate Form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow(); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
					$sKey .= $product_videos->id->CurrentValue;

					// Add filter for this record
					$sFilter = $product_videos->KeyFilter();
					if ($sWrkFilter <> "")
						$sWrkFilter .= " OR ";
					$sWrkFilter .= $sFilter;
				} else {
					break;
				}
			}
		}
		if ($bGridInsert) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			$product_videos->CurrentFilter = $sWrkFilter;
			$sSql = $product_videos->SQL();
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}
			$this->setMessage("Insert succeeded"); // Set insert success message
			$this->ClearInlineMode(); // Clear grid add mode
		} else {
			$conn->RollbackTrans(); // Rollback transaction
			if ($addcnt == 0) { // No record inserted
				$this->setMessage("No records to be added");
			} elseif ($this->getMessage() == "") {
				$this->setMessage("Insert failed"); // Set insert failed message
			}
			$product_videos->EventCancelled = TRUE; // Set event cancelled
			$product_videos->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
	}

	// Check if empty row
	function EmptyRow() {
		global $product_videos;
		if ($product_videos->video->CurrentValue <> $product_videos->video->OldValue)
			return FALSE;
		if ($product_videos->product_id->CurrentValue <> $product_videos->product_id->OldValue)
			return FALSE;
		if ($product_videos->order->CurrentValue <> $product_videos->order->OldValue)
			return FALSE;
		if ($product_videos->active->CurrentValue <> $product_videos->active->OldValue)
			return FALSE;
		return TRUE;
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm, $product_videos;

		// Get row based on current index
		$objForm->Index = $idx;
		if ($product_videos->CurrentAction == "gridadd")
			$this->LoadFormValues(); // Load form values
		if ($product_videos->CurrentAction == "gridedit") {
			$sKey = strval($objForm->GetValue("k_key"));
			$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $sKey);
			if (count($arrKeyFlds) >= 1) {
				if (strval($arrKeyFlds[0]) == strval($product_videos->id->CurrentValue)) {
					$this->LoadFormValues(); // Load form values
				}
			}
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $product_videos;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $product_videos->id, FALSE); // Field id
		$this->BuildSearchSql($sWhere, $product_videos->video, FALSE); // Field video
		$this->BuildSearchSql($sWhere, $product_videos->product_id, FALSE); // Field product_id
		$this->BuildSearchSql($sWhere, $product_videos->order, FALSE); // Field order
		$this->BuildSearchSql($sWhere, $product_videos->active, FALSE); // Field active

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($product_videos->id); // Field id
			$this->SetSearchParm($product_videos->video); // Field video
			$this->SetSearchParm($product_videos->product_id); // Field product_id
			$this->SetSearchParm($product_videos->order); // Field order
			$this->SetSearchParm($product_videos->active); // Field active
		}
		return $sWhere;
	}

	// Build search SQL
	function BuildSearchSql(&$Where, &$Fld, $MultiValue) {
		$FldParm = substr($Fld->FldVar, 2);		
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldOpr = $Fld->AdvancedSearch->SearchOperator; // @$_GET["z_$FldParm"]
		$FldCond = $Fld->AdvancedSearch->SearchCondition; // @$_GET["v_$FldParm"]
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldOpr2 = $Fld->AdvancedSearch->SearchOperator2; // @$_GET["w_$FldParm"]
		$sWrk = "";
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$FldOpr = strtoupper(trim($FldOpr));
		if ($FldOpr == "") $FldOpr = "=";
		$FldOpr2 = strtoupper(trim($FldOpr2));
		if ($FldOpr2 == "") $FldOpr2 = "=";
		if (EW_SEARCH_MULTI_VALUE_OPTION == 1 || $FldOpr <> "LIKE" ||
			($FldOpr2 <> "LIKE" && $FldVal2 <> ""))
			$MultiValue = FALSE;
		if ($MultiValue) {
			$sWrk1 = ($FldVal <> "") ? ew_GetMultiSearchSql($Fld, $FldVal) : ""; // Field value 1
			$sWrk2 = ($FldVal2 <> "") ? ew_GetMultiSearchSql($Fld, $FldVal2) : ""; // Field value 2
			$sWrk = $sWrk1; // Build final SQL
			if ($sWrk2 <> "")
				$sWrk = ($sWrk <> "") ? "($sWrk) $FldCond ($sWrk2)" : $sWrk2;
		} else {
			$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			$sWrk = ew_GetSearchSql($Fld, $FldVal, $FldOpr, $FldCond, $FldVal2, $FldOpr2);
		}
		if ($sWrk <> "") {
			if ($Where <> "") $Where .= " AND ";
			$Where .= "(" . $sWrk . ")";
		}
	}

	// Set search parameters
	function SetSearchParm(&$Fld) {
		global $product_videos;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$product_videos->setAdvancedSearch("x_$FldParm", $FldVal);
		$product_videos->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$product_videos->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$product_videos->setAdvancedSearch("y_$FldParm", $FldVal2);
		$product_videos->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Convert search value
	function ConvertSearchValue(&$Fld, $FldVal) {
		$Value = $FldVal;
		if ($Fld->FldDataType == EW_DATATYPE_BOOLEAN) {
			if ($FldVal <> "") $Value = ($FldVal == "1") ? $Fld->TrueValue : $Fld->FalseValue;
		} elseif ($Fld->FldDataType == EW_DATATYPE_DATE) {
			if ($FldVal <> "") $Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
		}
		return $Value;
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $product_videos;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $product_videos->video->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $product_videos;
		$sSearchStr = "";
		$sSearchKeyword = ew_StripSlashes(@$_GET[EW_TABLE_BASIC_SEARCH]);
		$sSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "") {
				while (strpos($sSearch, "  ") !== FALSE)
					$sSearch = str_replace("  ", " ", $sSearch);
				$arKeyword = explode(" ", trim($sSearch));
				foreach ($arKeyword as $sKeyword) {
					if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
					$sSearchStr .= "(" . $this->BasicSearchSQL($sKeyword) . ")";
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($sSearch);
			}
		}
		if ($sSearchKeyword <> "") {
			$product_videos->setBasicSearchKeyword($sSearchKeyword);
			$product_videos->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $product_videos;
		$this->sSrchWhere = "";
		$product_videos->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $product_videos;
		$product_videos->setBasicSearchKeyword("");
		$product_videos->setBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $product_videos;
		$product_videos->setAdvancedSearch("x_id", "");
		$product_videos->setAdvancedSearch("x_video", "");
		$product_videos->setAdvancedSearch("x_product_id", "");
		$product_videos->setAdvancedSearch("x_order", "");
		$product_videos->setAdvancedSearch("x_active", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $product_videos;
		$this->sSrchWhere = $product_videos->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $product_videos;
		 $product_videos->id->AdvancedSearch->SearchValue = $product_videos->getAdvancedSearch("x_id");
		 $product_videos->video->AdvancedSearch->SearchValue = $product_videos->getAdvancedSearch("x_video");
		 $product_videos->product_id->AdvancedSearch->SearchValue = $product_videos->getAdvancedSearch("x_product_id");
		 $product_videos->order->AdvancedSearch->SearchValue = $product_videos->getAdvancedSearch("x_order");
		 $product_videos->active->AdvancedSearch->SearchValue = $product_videos->getAdvancedSearch("x_active");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $product_videos;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$product_videos->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$product_videos->CurrentOrderType = @$_GET["ordertype"];
			$product_videos->UpdateSort($product_videos->id); // Field 
			$product_videos->UpdateSort($product_videos->video); // Field 
			$product_videos->UpdateSort($product_videos->product_id); // Field 
			$product_videos->UpdateSort($product_videos->order); // Field 
			$product_videos->UpdateSort($product_videos->active); // Field 
			$product_videos->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $product_videos;
		$sOrderBy = $product_videos->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($product_videos->SqlOrderBy() <> "") {
				$sOrderBy = $product_videos->SqlOrderBy();
				$product_videos->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $product_videos;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$product_videos->getCurrentMasterTable = ""; // Clear master table
				$product_videos->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$product_videos->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$product_videos->product_id->setSessionValue("");
			}

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$product_videos->setSessionOrderBy($sOrderBy);
				$product_videos->id->setSort("");
				$product_videos->video->setSort("");
				$product_videos->product_id->setSort("");
				$product_videos->order->setSort("");
				$product_videos->active->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$product_videos->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $product_videos;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$product_videos->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$product_videos->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $product_videos->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$product_videos->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$product_videos->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$product_videos->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $product_videos;
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $product_videos;

		// Load search values
		// id

		$product_videos->id->AdvancedSearch->SearchValue = @$_GET["x_id"];
		$product_videos->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// video
		$product_videos->video->AdvancedSearch->SearchValue = @$_GET["x_video"];
		$product_videos->video->AdvancedSearch->SearchOperator = @$_GET["z_video"];

		// product_id
		$product_videos->product_id->AdvancedSearch->SearchValue = @$_GET["x_product_id"];
		$product_videos->product_id->AdvancedSearch->SearchOperator = @$_GET["z_product_id"];

		// order
		$product_videos->order->AdvancedSearch->SearchValue = @$_GET["x_order"];
		$product_videos->order->AdvancedSearch->SearchOperator = @$_GET["z_order"];

		// active
		$product_videos->active->AdvancedSearch->SearchValue = @$_GET["x_active"];
		$product_videos->active->AdvancedSearch->SearchOperator = @$_GET["z_active"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $product_videos;
		$product_videos->id->setFormValue($objForm->GetValue("x_id"));
		$product_videos->id->OldValue = $objForm->GetValue("o_id");
		$product_videos->video->setFormValue($objForm->GetValue("x_video"));
		$product_videos->video->OldValue = $objForm->GetValue("o_video");
		$product_videos->product_id->setFormValue($objForm->GetValue("x_product_id"));
		$product_videos->product_id->OldValue = $objForm->GetValue("o_product_id");
		$product_videos->order->setFormValue($objForm->GetValue("x_order"));
		$product_videos->order->OldValue = $objForm->GetValue("o_order");
		$product_videos->active->setFormValue($objForm->GetValue("x_active"));
		$product_videos->active->OldValue = $objForm->GetValue("o_active");
	}

	// Restore form values
	function RestoreFormValues() {
		global $product_videos;
		$product_videos->id->CurrentValue = $product_videos->id->FormValue;
		$product_videos->video->CurrentValue = $product_videos->video->FormValue;
		$product_videos->product_id->CurrentValue = $product_videos->product_id->FormValue;
		$product_videos->order->CurrentValue = $product_videos->order->FormValue;
		$product_videos->active->CurrentValue = $product_videos->active->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $product_videos;

		// Call Recordset Selecting event
		$product_videos->Recordset_Selecting($product_videos->CurrentFilter);

		// Load list page SQL
		$sSql = $product_videos->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$product_videos->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $product_videos;
		$sFilter = $product_videos->KeyFilter();

		// Call Row Selecting event
		$product_videos->Row_Selecting($sFilter);

		// Load sql based on filter
		$product_videos->CurrentFilter = $sFilter;
		$sSql = $product_videos->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$product_videos->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $product_videos;
		$product_videos->id->setDbValue($rs->fields('id'));
		$product_videos->video->setDbValue($rs->fields('video'));
		$product_videos->product_id->setDbValue($rs->fields('product_id'));
		$product_videos->order->setDbValue($rs->fields('order'));
		$product_videos->active->setDbValue($rs->fields('active'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $product_videos;

		// Call Row_Rendering event
		$product_videos->Row_Rendering();

		// Common render codes for all row types
		// id

		$product_videos->id->CellCssStyle = "";
		$product_videos->id->CellCssClass = "";

		// video
		$product_videos->video->CellCssStyle = "";
		$product_videos->video->CellCssClass = "";

		// product_id
		$product_videos->product_id->CellCssStyle = "";
		$product_videos->product_id->CellCssClass = "";

		// order
		$product_videos->order->CellCssStyle = "";
		$product_videos->order->CellCssClass = "";

		// active
		$product_videos->active->CellCssStyle = "";
		$product_videos->active->CellCssClass = "";
		if ($product_videos->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$product_videos->id->ViewValue = $product_videos->id->CurrentValue;
			$product_videos->id->CssStyle = "";
			$product_videos->id->CssClass = "";
			$product_videos->id->ViewCustomAttributes = "";

			// video
			$product_videos->video->ViewValue = $product_videos->video->CurrentValue;
			if ($product_videos->Export == "")
				$product_videos->video->ViewValue = ew_Highlight($product_videos->HighlightName(), $product_videos->video->ViewValue, $product_videos->getBasicSearchKeyword(), $product_videos->getBasicSearchType(), $product_videos->getAdvancedSearch("x_video"));
			$product_videos->video->CssStyle = "";
			$product_videos->video->CssClass = "";
			$product_videos->video->ViewCustomAttributes = "";

			// product_id
			if (strval($product_videos->product_id->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `name`, `name_arabic` FROM `products` WHERE `id` = " . ew_AdjustSql($product_videos->product_id->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$product_videos->product_id->ViewValue = $rswrk->fields('name');
					$product_videos->product_id->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('name_arabic');
					$rswrk->Close();
				} else {
					$product_videos->product_id->ViewValue = $product_videos->product_id->CurrentValue;
				}
			} else {
				$product_videos->product_id->ViewValue = NULL;
			}
			$product_videos->product_id->CssStyle = "";
			$product_videos->product_id->CssClass = "";
			$product_videos->product_id->ViewCustomAttributes = "";

			// order
			$product_videos->order->ViewValue = $product_videos->order->CurrentValue;
			$product_videos->order->CssStyle = "";
			$product_videos->order->CssClass = "";
			$product_videos->order->ViewCustomAttributes = "";

			// active
			if (strval($product_videos->active->CurrentValue) <> "") {
				switch ($product_videos->active->CurrentValue) {
					case "0":
						$product_videos->active->ViewValue = "No";
						break;
					case "1":
						$product_videos->active->ViewValue = "Yes";
						break;
					default:
						$product_videos->active->ViewValue = $product_videos->active->CurrentValue;
				}
			} else {
				$product_videos->active->ViewValue = NULL;
			}
			$product_videos->active->CssStyle = "";
			$product_videos->active->CssClass = "";
			$product_videos->active->ViewCustomAttributes = "";

			// id
			$product_videos->id->HrefValue = "";

			// video
			$product_videos->video->HrefValue = "";

			// product_id
			$product_videos->product_id->HrefValue = "";

			// order
			$product_videos->order->HrefValue = "";

			// active
			$product_videos->active->HrefValue = "";
		} elseif ($product_videos->RowType == EW_ROWTYPE_ADD) { // Add row

			// id
			// video

			$product_videos->video->EditCustomAttributes = "";
			$product_videos->video->EditValue = ew_HtmlEncode($product_videos->video->CurrentValue);

			// product_id
			$product_videos->product_id->EditCustomAttributes = "";
			if ($product_videos->product_id->getSessionValue() <> "") {
				$product_videos->product_id->CurrentValue = $product_videos->product_id->getSessionValue();
				$product_videos->product_id->OldValue = $product_videos->product_id->CurrentValue;
			if (strval($product_videos->product_id->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `name`, `name_arabic` FROM `products` WHERE `id` = " . ew_AdjustSql($product_videos->product_id->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$product_videos->product_id->ViewValue = $rswrk->fields('name');
					$product_videos->product_id->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('name_arabic');
					$rswrk->Close();
				} else {
					$product_videos->product_id->ViewValue = $product_videos->product_id->CurrentValue;
				}
			} else {
				$product_videos->product_id->ViewValue = NULL;
			}
			$product_videos->product_id->CssStyle = "";
			$product_videos->product_id->CssClass = "";
			$product_videos->product_id->ViewCustomAttributes = "";
			} else {
			$sSqlWrk = "SELECT `id`, `name`, `name_arabic`, '' AS SelectFilterFld FROM `products`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select", ""));
			$product_videos->product_id->EditValue = $arwrk;
			}

			// order
			$product_videos->order->EditCustomAttributes = "";
			$product_videos->order->EditValue = ew_HtmlEncode($product_videos->order->CurrentValue);

			// active
			$product_videos->active->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$product_videos->active->EditValue = $arwrk;
		} elseif ($product_videos->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$product_videos->id->EditCustomAttributes = "";
			$product_videos->id->EditValue = $product_videos->id->CurrentValue;
			$product_videos->id->CssStyle = "";
			$product_videos->id->CssClass = "";
			$product_videos->id->ViewCustomAttributes = "";

			// video
			$product_videos->video->EditCustomAttributes = "";
			$product_videos->video->EditValue = ew_HtmlEncode($product_videos->video->CurrentValue);

			// product_id
			$product_videos->product_id->EditCustomAttributes = "";
			if ($product_videos->product_id->getSessionValue() <> "") {
				$product_videos->product_id->CurrentValue = $product_videos->product_id->getSessionValue();
				$product_videos->product_id->OldValue = $product_videos->product_id->CurrentValue;
			if (strval($product_videos->product_id->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `name`, `name_arabic` FROM `products` WHERE `id` = " . ew_AdjustSql($product_videos->product_id->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$product_videos->product_id->ViewValue = $rswrk->fields('name');
					$product_videos->product_id->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('name_arabic');
					$rswrk->Close();
				} else {
					$product_videos->product_id->ViewValue = $product_videos->product_id->CurrentValue;
				}
			} else {
				$product_videos->product_id->ViewValue = NULL;
			}
			$product_videos->product_id->CssStyle = "";
			$product_videos->product_id->CssClass = "";
			$product_videos->product_id->ViewCustomAttributes = "";
			} else {
			$sSqlWrk = "SELECT `id`, `name`, `name_arabic`, '' AS SelectFilterFld FROM `products`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select", ""));
			$product_videos->product_id->EditValue = $arwrk;
			}

			// order
			$product_videos->order->EditCustomAttributes = "";
			$product_videos->order->EditValue = ew_HtmlEncode($product_videos->order->CurrentValue);

			// active
			$product_videos->active->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$product_videos->active->EditValue = $arwrk;

			// Edit refer script
			// id

			$product_videos->id->HrefValue = "";

			// video
			$product_videos->video->HrefValue = "";

			// product_id
			$product_videos->product_id->HrefValue = "";

			// order
			$product_videos->order->HrefValue = "";

			// active
			$product_videos->active->HrefValue = "";
		}

		// Call Row Rendered event
		$product_videos->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $product_videos;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sFormCustomError;
		}
		return $ValidateSearch;
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $product_videos;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($product_videos->video->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - video";
		}
		if ($product_videos->product_id->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - product";
		}
		if ($product_videos->order->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - order";
		}
		if (!ew_CheckInteger($product_videos->order->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - order";
		}
		if ($product_videos->active->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - active";
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $product_videos;
		$sFilter = $product_videos->KeyFilter();
		$product_videos->CurrentFilter = $sFilter;
		$sSql = $product_videos->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// Field id
			// Field video

			$product_videos->video->SetDbValueDef($product_videos->video->CurrentValue, "");
			$rsnew['video'] =& $product_videos->video->DbValue;

			// Field product_id
			$product_videos->product_id->SetDbValueDef($product_videos->product_id->CurrentValue, 0);
			$rsnew['product_id'] =& $product_videos->product_id->DbValue;

			// Field order
			$product_videos->order->SetDbValueDef($product_videos->order->CurrentValue, 0);
			$rsnew['order'] =& $product_videos->order->DbValue;

			// Field active
			$product_videos->active->SetDbValueDef($product_videos->active->CurrentValue, 0);
			$rsnew['active'] =& $product_videos->active->DbValue;

			// Call Row Updating event
			$bUpdateRow = $product_videos->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($product_videos->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($product_videos->CancelMessage <> "") {
					$this->setMessage($product_videos->CancelMessage);
					$product_videos->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$product_videos->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow() {
		global $conn, $Security, $product_videos;
		$rsnew = array();

		// Field id
		// Field video

		$product_videos->video->SetDbValueDef($product_videos->video->CurrentValue, "");
		$rsnew['video'] =& $product_videos->video->DbValue;

		// Field product_id
		$product_videos->product_id->SetDbValueDef($product_videos->product_id->CurrentValue, 0);
		$rsnew['product_id'] =& $product_videos->product_id->DbValue;

		// Field order
		$product_videos->order->SetDbValueDef($product_videos->order->CurrentValue, 0);
		$rsnew['order'] =& $product_videos->order->DbValue;

		// Field active
		$product_videos->active->SetDbValueDef($product_videos->active->CurrentValue, 0);
		$rsnew['active'] =& $product_videos->active->DbValue;

		// Call Row Inserting event
		$bInsertRow = $product_videos->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($product_videos->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($product_videos->CancelMessage <> "") {
				$this->setMessage($product_videos->CancelMessage);
				$product_videos->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$product_videos->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $product_videos->id->DbValue;

			// Call Row Inserted event
			$product_videos->Row_Inserted($rsnew);
		}
		return $AddRow;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $product_videos;
		$product_videos->id->AdvancedSearch->SearchValue = $product_videos->getAdvancedSearch("x_id");
		$product_videos->video->AdvancedSearch->SearchValue = $product_videos->getAdvancedSearch("x_video");
		$product_videos->product_id->AdvancedSearch->SearchValue = $product_videos->getAdvancedSearch("x_product_id");
		$product_videos->order->AdvancedSearch->SearchValue = $product_videos->getAdvancedSearch("x_order");
		$product_videos->active->AdvancedSearch->SearchValue = $product_videos->getAdvancedSearch("x_active");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $product_videos;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($product_videos->ExportAll) {
			$this->lStopRec = $this->lTotalRecs;
		} else { // Export 1 page only
			$this->SetUpStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->lDisplayRecs < 0) {
				$this->lStopRec = $this->lTotalRecs;
			} else {
				$this->lStopRec = $this->lStartRec + $this->lDisplayRecs - 1;
			}
		}
		if ($product_videos->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo "\xEF\xBB\xBF";
			echo ew_ExportHeader($product_videos->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $product_videos->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id', $product_videos->Export);
				ew_ExportAddValue($sExportStr, 'video', $product_videos->Export);
				ew_ExportAddValue($sExportStr, 'product_id', $product_videos->Export);
				ew_ExportAddValue($sExportStr, 'order', $product_videos->Export);
				ew_ExportAddValue($sExportStr, 'active', $product_videos->Export);
				echo ew_ExportLine($sExportStr, $product_videos->Export);
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
				$product_videos->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($product_videos->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id', $product_videos->id->CurrentValue);
					$XmlDoc->AddField('video', $product_videos->video->CurrentValue);
					$XmlDoc->AddField('product_id', $product_videos->product_id->CurrentValue);
					$XmlDoc->AddField('order', $product_videos->order->CurrentValue);
					$XmlDoc->AddField('active', $product_videos->active->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $product_videos->Export <> "csv") { // Vertical format
						echo ew_ExportField('id', $product_videos->id->ExportValue($product_videos->Export, $product_videos->ExportOriginalValue), $product_videos->Export);
						echo ew_ExportField('video', $product_videos->video->ExportValue($product_videos->Export, $product_videos->ExportOriginalValue), $product_videos->Export);
						echo ew_ExportField('product_id', $product_videos->product_id->ExportValue($product_videos->Export, $product_videos->ExportOriginalValue), $product_videos->Export);
						echo ew_ExportField('order', $product_videos->order->ExportValue($product_videos->Export, $product_videos->ExportOriginalValue), $product_videos->Export);
						echo ew_ExportField('active', $product_videos->active->ExportValue($product_videos->Export, $product_videos->ExportOriginalValue), $product_videos->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $product_videos->id->ExportValue($product_videos->Export, $product_videos->ExportOriginalValue), $product_videos->Export);
						ew_ExportAddValue($sExportStr, $product_videos->video->ExportValue($product_videos->Export, $product_videos->ExportOriginalValue), $product_videos->Export);
						ew_ExportAddValue($sExportStr, $product_videos->product_id->ExportValue($product_videos->Export, $product_videos->ExportOriginalValue), $product_videos->Export);
						ew_ExportAddValue($sExportStr, $product_videos->order->ExportValue($product_videos->Export, $product_videos->ExportOriginalValue), $product_videos->Export);
						ew_ExportAddValue($sExportStr, $product_videos->active->ExportValue($product_videos->Export, $product_videos->ExportOriginalValue), $product_videos->Export);
						echo ew_ExportLine($sExportStr, $product_videos->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($product_videos->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($product_videos->Export);
		}
	}

	// Set up Master Detail based on querystring parameter
	function SetUpMasterDetail() {
		global $product_videos;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "products") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $product_videos->SqlMasterFilter_products();
				$this->sDbDetailFilter = $product_videos->SqlDetailFilter_products();
				if (@$_GET["id"] <> "") {
					$GLOBALS["products"]->id->setQueryStringValue($_GET["id"]);
					$product_videos->product_id->setQueryStringValue($GLOBALS["products"]->id->QueryStringValue);
					$product_videos->product_id->setSessionValue($product_videos->product_id->QueryStringValue);
					if (!is_numeric($GLOBALS["products"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["products"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@product_id@", ew_AdjustSql($GLOBALS["products"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$product_videos->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$product_videos->setStartRecordNumber($this->lStartRec);
			$product_videos->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$product_videos->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master session values
			if ($sMasterTblVar <> "products") {
				if ($product_videos->product_id->QueryStringValue == "") $product_videos->product_id->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $product_videos->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $product_videos->getDetailFilter(); // Restore detail filter
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
