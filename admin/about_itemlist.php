<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "about_iteminfo.php" ?>
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
$about_item_list = new cabout_item_list();
$Page =& $about_item_list;

// Page init processing
$about_item_list->Page_Init();

// Page main processing
$about_item_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($about_item->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var about_item_list = new ew_Page("about_item_list");

// page properties
about_item_list.PageID = "list"; // page ID
var EW_PAGE_ID = about_item_list.PageID; // for backward compatibility

// extend page with ValidateForm function
about_item_list.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_title"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - title");
		elm = fobj.elements["x" + infix + "_title_arabic"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - title arabic");
		elm = fobj.elements["x" + infix + "_count"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - count");
		elm = fobj.elements["x" + infix + "_count"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "Incorrect integer - count");
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
about_item_list.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "title")) return false;
	if (ew_ValueChanged(fobj, infix, "title_arabic")) return false;
	if (ew_ValueChanged(fobj, infix, "count")) return false;
	if (ew_ValueChanged(fobj, infix, "order")) return false;
	if (ew_ValueChanged(fobj, infix, "active")) return false;
	return true;
}

// extend page with Form_CustomValidate function
about_item_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
about_item_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
about_item_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
about_item_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
about_item_list.ShowHighlightText = "Show highlight"; 
about_item_list.HideHighlightText = "Hide highlight";

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
<?php if ($about_item->Export == "") { ?>
<?php } ?>
<?php
if ($about_item->CurrentAction == "gridadd")
	$about_item->CurrentFilter = "0=1";
if ($about_item->CurrentAction == "gridadd") {
	$about_item_list->lStartRec = 1;
	if ($about_item_list->lDisplayRecs <= 0)
		$about_item_list->lDisplayRecs = 20;
	$about_item_list->lTotalRecs = $about_item_list->lDisplayRecs;
	$about_item_list->lStopRec = $about_item_list->lDisplayRecs;
} else {
	$bSelectLimit = ($about_item->Export == "" && $about_item->SelectLimit);
	if (!$bSelectLimit)
		$rs = $about_item_list->LoadRecordset();
	$about_item_list->lTotalRecs = ($bSelectLimit) ? $about_item->SelectRecordCount() : $rs->RecordCount();
	$about_item_list->lStartRec = 1;
	if ($about_item_list->lDisplayRecs <= 0) // Display all records
		$about_item_list->lDisplayRecs = $about_item_list->lTotalRecs;
	if (!($about_item->ExportAll && $about_item->Export <> ""))
		$about_item_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $about_item_list->LoadRecordset($about_item_list->lStartRec-1, $about_item_list->lDisplayRecs);
}
?>
<p><span class="phpmaker" style="white-space: nowrap;">TABLE: about item
<?php if ($about_item->Export == "" && $about_item->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $about_item_list->PageUrl() ?>export=print">Printer Friendly</a>
&nbsp;&nbsp;<a href="<?php echo $about_item_list->PageUrl() ?>export=html">Export to HTML</a>
&nbsp;&nbsp;<a href="<?php echo $about_item_list->PageUrl() ?>export=excel">Export to Excel</a>
&nbsp;&nbsp;<a href="<?php echo $about_item_list->PageUrl() ?>export=word">Export to Word</a>
&nbsp;&nbsp;<a href="<?php echo $about_item_list->PageUrl() ?>export=xml">Export to XML</a>
&nbsp;&nbsp;<a href="<?php echo $about_item_list->PageUrl() ?>export=csv">Export to CSV</a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($about_item->Export == "" && $about_item->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(about_item_list);" style="text-decoration: none;"><img id="about_item_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="about_item_list_SearchPanel">
<form name="fabout_itemlistsrch" id="fabout_itemlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="about_item">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($about_item->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Search (*)">&nbsp;
			<a href="<?php echo $about_item_list->PageUrl() ?>cmd=reset">Show all</a>&nbsp;
			<a href="about_itemsrch.php">Advanced Search</a>&nbsp;
			<?php if ($about_item_list->sSrchWhere <> "" && $about_item_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(about_item_list, this, '<?php echo $about_item->HighlightName() ?>');">Hide highlight</a>
			<?php } ?>
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($about_item->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>Exact phrase</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($about_item->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>All words</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($about_item->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>Any word</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $about_item_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($about_item->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($about_item->CurrentAction <> "gridadd" && $about_item->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($about_item_list->Pager)) $about_item_list->Pager = new cPrevNextPager($about_item_list->lStartRec, $about_item_list->lDisplayRecs, $about_item_list->lTotalRecs) ?>
<?php if ($about_item_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($about_item_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $about_item_list->PageUrl() ?>start=<?php echo $about_item_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($about_item_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $about_item_list->PageUrl() ?>start=<?php echo $about_item_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $about_item_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($about_item_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $about_item_list->PageUrl() ?>start=<?php echo $about_item_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($about_item_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $about_item_list->PageUrl() ?>start=<?php echo $about_item_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $about_item_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $about_item_list->Pager->FromIndex ?> to <?php echo $about_item_list->Pager->ToIndex ?> of <?php echo $about_item_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($about_item_list->sSrchWhere == "0=101") { ?>
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
<?php if ($about_item->CurrentAction <> "gridadd" && $about_item->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $about_item->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<a href="<?php echo $about_item_list->PageUrl() ?>a=add">Inline Add</a>&nbsp;&nbsp;
<a href="<?php echo $about_item_list->PageUrl() ?>a=gridadd">Grid Add</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($about_item_list->lTotalRecs > 0) { ?>
<a href="<?php echo $about_item_list->PageUrl() ?>a=gridedit">Grid Edit</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if ($about_item_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fabout_itemlist)) alert('No records selected'); else if (ew_Confirm('<?php echo $about_item_list->sDeleteConfirmMsg ?>')) {document.fabout_itemlist.action='about_itemdelete.php';document.fabout_itemlist.encoding='application/x-www-form-urlencoded';document.fabout_itemlist.submit();};return false;">Delete Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fabout_itemlist)) alert('No records selected'); else {document.fabout_itemlist.action='about_itemupdate.php';document.fabout_itemlist.encoding='application/x-www-form-urlencoded';document.fabout_itemlist.submit();};return false;">Update Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($about_item->CurrentAction == "gridadd") { ?>
<a href="" onclick="if (about_item_list.ValidateForm(document.fabout_itemlist)) document.fabout_itemlist.submit();return false;">Insert</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($about_item->CurrentAction == "gridedit") { ?>
<a href="" onclick="if (about_item_list.ValidateForm(document.fabout_itemlist)) document.fabout_itemlist.submit();return false;">Save</a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php echo $about_item_list->PageUrl() ?>a=cancel">Cancel</a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fabout_itemlist" id="fabout_itemlist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="about_item">
<?php if ($about_item_list->lTotalRecs > 0 || $about_item->CurrentAction == "add" || $about_item->CurrentAction == "copy") { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$about_item_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$about_item_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$about_item_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$about_item_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$about_item_list->lOptionCnt++; // Multi-select
}
	$about_item_list->lOptionCnt += count($about_item_list->ListOptions->Items); // Custom list options
?>
<?php echo $about_item->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($about_item->id->Visible) { // id ?>
	<?php if ($about_item->SortUrl($about_item->id) == "") { ?>
		<td>id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $about_item->SortUrl($about_item->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>id</td><td style="width: 10px;"><?php if ($about_item->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($about_item->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($about_item->title->Visible) { // title ?>
	<?php if ($about_item->SortUrl($about_item->title) == "") { ?>
		<td>title</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $about_item->SortUrl($about_item->title) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>title&nbsp;(*)</td><td style="width: 10px;"><?php if ($about_item->title->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($about_item->title->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($about_item->title_arabic->Visible) { // title_arabic ?>
	<?php if ($about_item->SortUrl($about_item->title_arabic) == "") { ?>
		<td>title arabic</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $about_item->SortUrl($about_item->title_arabic) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>title arabic&nbsp;(*)</td><td style="width: 10px;"><?php if ($about_item->title_arabic->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($about_item->title_arabic->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($about_item->count->Visible) { // count ?>
	<?php if ($about_item->SortUrl($about_item->count) == "") { ?>
		<td>count</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $about_item->SortUrl($about_item->count) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>count</td><td style="width: 10px;"><?php if ($about_item->count->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($about_item->count->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($about_item->order->Visible) { // order ?>
	<?php if ($about_item->SortUrl($about_item->order) == "") { ?>
		<td>order</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $about_item->SortUrl($about_item->order) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>order</td><td style="width: 10px;"><?php if ($about_item->order->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($about_item->order->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($about_item->active->Visible) { // active ?>
	<?php if ($about_item->SortUrl($about_item->active) == "") { ?>
		<td>active</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $about_item->SortUrl($about_item->active) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>active</td><td style="width: 10px;"><?php if ($about_item->active->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($about_item->active->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($about_item->Export == "") { ?>
<?php if ($about_item->CurrentAction <> "gridadd" && $about_item->CurrentAction <> "gridedit") { ?>
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
<?php if ($about_item_list->lOptionCnt == 0 && $about_item->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="phpmaker" onclick="about_item_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($about_item_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
</thead>
<?php
	if ($about_item->CurrentAction == "add" || $about_item->CurrentAction == "copy") {
		$about_item_list->lRowIndex = 1;
		if ($about_item->CurrentAction == "copy" && !$about_item_list->LoadRow())
				$about_item->CurrentAction = "add";
		if ($about_item->CurrentAction == "add")
			$about_item_list->LoadDefaultValues();
		if ($about_item->EventCancelled) // Insert failed
			$about_item_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$about_item->CssClass = "ewTableEditRow";
		$about_item->CssStyle = "";
		$about_item->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
		$about_item->RowType = EW_ROWTYPE_ADD;

		// Render row
		$about_item_list->RenderRow();
?>
	<tr<?php echo $about_item->RowAttributes() ?>>
	<?php if ($about_item->id->Visible) { // id ?>
		<td>&nbsp;</td>
	<?php } ?>
	<?php if ($about_item->title->Visible) { // title ?>
		<td>
<textarea name="x<?php echo $about_item_list->lRowIndex ?>_title" id="x<?php echo $about_item_list->lRowIndex ?>_title" cols="35" rows="4"<?php echo $about_item->title->EditAttributes() ?>><?php echo $about_item->title->EditValue ?></textarea>
</td>
	<?php } ?>
	<?php if ($about_item->title_arabic->Visible) { // title_arabic ?>
		<td>
<textarea name="x<?php echo $about_item_list->lRowIndex ?>_title_arabic" id="x<?php echo $about_item_list->lRowIndex ?>_title_arabic" cols="35" rows="4"<?php echo $about_item->title_arabic->EditAttributes() ?>><?php echo $about_item->title_arabic->EditValue ?></textarea>
</td>
	<?php } ?>
	<?php if ($about_item->count->Visible) { // count ?>
		<td>
<input type="text" name="x<?php echo $about_item_list->lRowIndex ?>_count" id="x<?php echo $about_item_list->lRowIndex ?>_count" size="30" value="<?php echo $about_item->count->EditValue ?>"<?php echo $about_item->count->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($about_item->order->Visible) { // order ?>
		<td>
<input type="text" name="x<?php echo $about_item_list->lRowIndex ?>_order" id="x<?php echo $about_item_list->lRowIndex ?>_order" size="30" value="<?php echo $about_item->order->EditValue ?>"<?php echo $about_item->order->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($about_item->active->Visible) { // active ?>
		<td>
<div id="tp_x<?php echo $about_item_list->lRowIndex ?>_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x<?php echo $about_item_list->lRowIndex ?>_active" id="x<?php echo $about_item_list->lRowIndex ?>_active" value="{value}"<?php echo $about_item->active->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $about_item_list->lRowIndex ?>_active" repeatcolumn="5">
<?php
$arwrk = $about_item->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($about_item->active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $about_item_list->lRowIndex ?>_active" id="x<?php echo $about_item_list->lRowIndex ?>_active" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $about_item->active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
if ($emptywrk) $about_item->active->OldValue = "";
?>
</div>
</td>
	<?php } ?>
<td colspan="<?php echo $about_item_list->lOptionCnt ?>"><span class="phpmaker">
<a href="" onclick="if (about_item_list.ValidateForm(document.fabout_itemlist)) document.fabout_itemlist.submit();return false;">Insert</a>&nbsp;<a href="<?php echo $about_item_list->PageUrl() ?>a=cancel">Cancel</a>
<input type="hidden" name="a_list" id="a_list" value="insert">
</span></td>
	</tr>
<?php
}
?>
<?php
if ($about_item->ExportAll && $about_item->Export <> "") {
	$about_item_list->lStopRec = $about_item_list->lTotalRecs;
} else {
	$about_item_list->lStopRec = $about_item_list->lStartRec + $about_item_list->lDisplayRecs - 1; // Set the last record to display
}
$about_item_list->lRecCount = $about_item_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$about_item->SelectLimit && $about_item_list->lStartRec > 1)
		$rs->Move($about_item_list->lStartRec - 1);
}
$about_item_list->lRowCnt = 0;
$about_item_list->lEditRowCnt = 0;
if ($about_item->CurrentAction == "edit")
	$about_item_list->lRowIndex = 1;
if ($about_item->CurrentAction == "gridadd")
	$about_item_list->lRowIndex = 0;
if ($about_item->CurrentAction == "gridedit")
	$about_item_list->lRowIndex = 0;
while (($about_item->CurrentAction == "gridadd" || !$rs->EOF) &&
	$about_item_list->lRecCount < $about_item_list->lStopRec) {
	$about_item_list->lRecCount++;
	if (intval($about_item_list->lRecCount) >= intval($about_item_list->lStartRec)) {
		$about_item_list->lRowCnt++;
		if ($about_item->CurrentAction == "gridadd" || $about_item->CurrentAction == "gridedit")
			$about_item_list->lRowIndex++;

	// Init row class and style
	$about_item->CssClass = "";
	$about_item->CssStyle = "";
	$about_item->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($about_item->CurrentAction == "gridadd") {
		$about_item_list->LoadDefaultValues(); // Load default values
	} else {
		$about_item_list->LoadRowValues($rs); // Load row values
	}
	$about_item->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($about_item->CurrentAction == "gridadd") // Grid add
		$about_item->RowType = EW_ROWTYPE_ADD; // Render add
	if ($about_item->CurrentAction == "gridadd" && $about_item->EventCancelled) // Insert failed
		$about_item_list->RestoreCurrentRowFormValues($about_item_list->lRowIndex); // Restore form values
	if ($about_item->CurrentAction == "edit") {
		if ($about_item_list->CheckInlineEditKey() && $about_item_list->lEditRowCnt == 0) // Inline edit
			$about_item->RowType = EW_ROWTYPE_EDIT; // Render edit
	}
	if ($about_item->CurrentAction == "gridedit") // Grid edit
		$about_item->RowType = EW_ROWTYPE_EDIT; // Render edit
	if ($about_item->RowType == EW_ROWTYPE_EDIT && $about_item->EventCancelled) { // Update failed
		if ($about_item->CurrentAction == "edit")
			$about_item_list->RestoreFormValues(); // Restore form values
		if ($about_item->CurrentAction == "gridedit")
			$about_item_list->RestoreCurrentRowFormValues($about_item_list->lRowIndex); // Restore form values
	}
	if ($about_item->RowType == EW_ROWTYPE_EDIT) { // Edit row
		$about_item_list->lEditRowCnt++;
		$about_item->RowClientEvents = "onmouseover='this.edit=true;ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	}
	if ($about_item->RowType == EW_ROWTYPE_ADD || $about_item->RowType == EW_ROWTYPE_EDIT) // Add / Edit row
			$about_item->CssClass = "ewTableEditRow";

	// Render row
	$about_item_list->RenderRow();
?>
	<tr<?php echo $about_item->RowAttributes() ?>>
	<?php if ($about_item->id->Visible) { // id ?>
		<td<?php echo $about_item->id->CellAttributes() ?>>
<?php if ($about_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $about_item_list->lRowIndex ?>_id" id="o<?php echo $about_item_list->lRowIndex ?>_id" value="<?php echo ew_HtmlEncode($about_item->id->OldValue) ?>">
<?php } ?>
<?php if ($about_item->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $about_item->id->ViewAttributes() ?>><?php echo $about_item->id->EditValue ?></div><input type="hidden" name="x<?php echo $about_item_list->lRowIndex ?>_id" id="x<?php echo $about_item_list->lRowIndex ?>_id" value="<?php echo ew_HtmlEncode($about_item->id->CurrentValue) ?>">
<?php } ?>
<?php if ($about_item->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $about_item->id->ViewAttributes() ?>><?php echo $about_item->id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($about_item->title->Visible) { // title ?>
		<td<?php echo $about_item->title->CellAttributes() ?>>
<?php if ($about_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<textarea name="x<?php echo $about_item_list->lRowIndex ?>_title" id="x<?php echo $about_item_list->lRowIndex ?>_title" cols="35" rows="4"<?php echo $about_item->title->EditAttributes() ?>><?php echo $about_item->title->EditValue ?></textarea>
<input type="hidden" name="o<?php echo $about_item_list->lRowIndex ?>_title" id="o<?php echo $about_item_list->lRowIndex ?>_title" value="<?php echo ew_HtmlEncode($about_item->title->OldValue) ?>">
<?php } ?>
<?php if ($about_item->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<textarea name="x<?php echo $about_item_list->lRowIndex ?>_title" id="x<?php echo $about_item_list->lRowIndex ?>_title" cols="35" rows="4"<?php echo $about_item->title->EditAttributes() ?>><?php echo $about_item->title->EditValue ?></textarea>
<?php } ?>
<?php if ($about_item->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $about_item->title->ViewAttributes() ?>><?php echo $about_item->title->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($about_item->title_arabic->Visible) { // title_arabic ?>
		<td<?php echo $about_item->title_arabic->CellAttributes() ?>>
<?php if ($about_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<textarea name="x<?php echo $about_item_list->lRowIndex ?>_title_arabic" id="x<?php echo $about_item_list->lRowIndex ?>_title_arabic" cols="35" rows="4"<?php echo $about_item->title_arabic->EditAttributes() ?>><?php echo $about_item->title_arabic->EditValue ?></textarea>
<input type="hidden" name="o<?php echo $about_item_list->lRowIndex ?>_title_arabic" id="o<?php echo $about_item_list->lRowIndex ?>_title_arabic" value="<?php echo ew_HtmlEncode($about_item->title_arabic->OldValue) ?>">
<?php } ?>
<?php if ($about_item->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<textarea name="x<?php echo $about_item_list->lRowIndex ?>_title_arabic" id="x<?php echo $about_item_list->lRowIndex ?>_title_arabic" cols="35" rows="4"<?php echo $about_item->title_arabic->EditAttributes() ?>><?php echo $about_item->title_arabic->EditValue ?></textarea>
<?php } ?>
<?php if ($about_item->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $about_item->title_arabic->ViewAttributes() ?>><?php echo $about_item->title_arabic->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($about_item->count->Visible) { // count ?>
		<td<?php echo $about_item->count->CellAttributes() ?>>
<?php if ($about_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $about_item_list->lRowIndex ?>_count" id="x<?php echo $about_item_list->lRowIndex ?>_count" size="30" value="<?php echo $about_item->count->EditValue ?>"<?php echo $about_item->count->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $about_item_list->lRowIndex ?>_count" id="o<?php echo $about_item_list->lRowIndex ?>_count" value="<?php echo ew_HtmlEncode($about_item->count->OldValue) ?>">
<?php } ?>
<?php if ($about_item->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $about_item_list->lRowIndex ?>_count" id="x<?php echo $about_item_list->lRowIndex ?>_count" size="30" value="<?php echo $about_item->count->EditValue ?>"<?php echo $about_item->count->EditAttributes() ?>>
<?php } ?>
<?php if ($about_item->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $about_item->count->ViewAttributes() ?>><?php echo $about_item->count->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($about_item->order->Visible) { // order ?>
		<td<?php echo $about_item->order->CellAttributes() ?>>
<?php if ($about_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $about_item_list->lRowIndex ?>_order" id="x<?php echo $about_item_list->lRowIndex ?>_order" size="30" value="<?php echo $about_item->order->EditValue ?>"<?php echo $about_item->order->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $about_item_list->lRowIndex ?>_order" id="o<?php echo $about_item_list->lRowIndex ?>_order" value="<?php echo ew_HtmlEncode($about_item->order->OldValue) ?>">
<?php } ?>
<?php if ($about_item->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $about_item_list->lRowIndex ?>_order" id="x<?php echo $about_item_list->lRowIndex ?>_order" size="30" value="<?php echo $about_item->order->EditValue ?>"<?php echo $about_item->order->EditAttributes() ?>>
<?php } ?>
<?php if ($about_item->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $about_item->order->ViewAttributes() ?>><?php echo $about_item->order->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($about_item->active->Visible) { // active ?>
		<td<?php echo $about_item->active->CellAttributes() ?>>
<?php if ($about_item->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<div id="tp_x<?php echo $about_item_list->lRowIndex ?>_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x<?php echo $about_item_list->lRowIndex ?>_active" id="x<?php echo $about_item_list->lRowIndex ?>_active" value="{value}"<?php echo $about_item->active->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $about_item_list->lRowIndex ?>_active" repeatcolumn="5">
<?php
$arwrk = $about_item->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($about_item->active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $about_item_list->lRowIndex ?>_active" id="x<?php echo $about_item_list->lRowIndex ?>_active" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $about_item->active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
if ($emptywrk) $about_item->active->OldValue = "";
?>
</div>
<input type="hidden" name="o<?php echo $about_item_list->lRowIndex ?>_active" id="o<?php echo $about_item_list->lRowIndex ?>_active" value="<?php echo ew_HtmlEncode($about_item->active->OldValue) ?>">
<?php } ?>
<?php if ($about_item->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div id="tp_x<?php echo $about_item_list->lRowIndex ?>_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x<?php echo $about_item_list->lRowIndex ?>_active" id="x<?php echo $about_item_list->lRowIndex ?>_active" value="{value}"<?php echo $about_item->active->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $about_item_list->lRowIndex ?>_active" repeatcolumn="5">
<?php
$arwrk = $about_item->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($about_item->active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $about_item_list->lRowIndex ?>_active" id="x<?php echo $about_item_list->lRowIndex ?>_active" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $about_item->active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
if ($emptywrk) $about_item->active->OldValue = "";
?>
</div>
<?php } ?>
<?php if ($about_item->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $about_item->active->ViewAttributes() ?>><?php echo $about_item->active->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php if ($about_item->RowType == EW_ROWTYPE_ADD || $about_item->RowType == EW_ROWTYPE_EDIT) { ?>
<?php if ($about_item->CurrentAction == "edit") { ?>
<td colspan="<?php echo $about_item_list->lOptionCnt ?>"><span class="phpmaker">
<a href="" onclick="if (about_item_list.ValidateForm(document.fabout_itemlist)) document.fabout_itemlist.submit();return false;">Update</a>&nbsp;<a href="<?php echo $about_item_list->PageUrl() ?>a=cancel">Cancel</a>
<input type="hidden" name="a_list" id="a_list" value="update">
</span></td>
<?php } ?>
<?php
	if ($about_item->CurrentAction == "gridedit")
		$about_item_list->sMultiSelectKey .= "<input type=\"hidden\" name=\"k" . $about_item_list->lRowIndex . "_key\" id=\"k" . $about_item_list->lRowIndex . "_key\" value=\"" . $about_item->id->CurrentValue . "\">";
?>
<?php } else { ?>
<?php if ($about_item->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $about_item->ViewUrl() ?>">View</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $about_item->EditUrl() ?>">Edit</a><span class="ewSeparator">&nbsp;|&nbsp;</span><a href="<?php echo $about_item->InlineEditUrl() ?>">Inline Edit</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $about_item->CopyUrl() ?>">Copy</a><span class="ewSeparator">&nbsp;|&nbsp;</span><a href="<?php echo $about_item->InlineCopyUrl() ?>">Inline Copy</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($about_item_list->lOptionCnt == 0 && $about_item->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($about_item->id->CurrentValue) ?>" class="phpmaker" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($about_item_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
<?php if ($about_item->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($about_item->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($about_item->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($about_item->CurrentAction == "add" || $about_item->CurrentAction == "copy") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $about_item_list->lRowIndex ?>">
<?php } ?>
<?php if ($about_item->CurrentAction == "gridadd") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $about_item_list->lRowIndex ?>">
<?php } ?>
<?php if ($about_item->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $about_item_list->lRowIndex ?>">
<?php } ?>
<?php if ($about_item->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $about_item_list->lRowIndex ?>">
<?php echo $about_item_list->sMultiSelectKey ?>
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
<?php if ($about_item_list->lTotalRecs > 0) { ?>
<?php if ($about_item->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($about_item->CurrentAction <> "gridadd" && $about_item->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($about_item_list->Pager)) $about_item_list->Pager = new cPrevNextPager($about_item_list->lStartRec, $about_item_list->lDisplayRecs, $about_item_list->lTotalRecs) ?>
<?php if ($about_item_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($about_item_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $about_item_list->PageUrl() ?>start=<?php echo $about_item_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($about_item_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $about_item_list->PageUrl() ?>start=<?php echo $about_item_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $about_item_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($about_item_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $about_item_list->PageUrl() ?>start=<?php echo $about_item_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($about_item_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $about_item_list->PageUrl() ?>start=<?php echo $about_item_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $about_item_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $about_item_list->Pager->FromIndex ?> to <?php echo $about_item_list->Pager->ToIndex ?> of <?php echo $about_item_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($about_item_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($about_item_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($about_item->CurrentAction <> "gridadd" && $about_item->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $about_item->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<a href="<?php echo $about_item_list->PageUrl() ?>a=add">Inline Add</a>&nbsp;&nbsp;
<a href="<?php echo $about_item_list->PageUrl() ?>a=gridadd">Grid Add</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($about_item_list->lTotalRecs > 0) { ?>
<a href="<?php echo $about_item_list->PageUrl() ?>a=gridedit">Grid Edit</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if ($about_item_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fabout_itemlist)) alert('No records selected'); else if (ew_Confirm('<?php echo $about_item_list->sDeleteConfirmMsg ?>')) {document.fabout_itemlist.action='about_itemdelete.php';document.fabout_itemlist.encoding='application/x-www-form-urlencoded';document.fabout_itemlist.submit();};return false;">Delete Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fabout_itemlist)) alert('No records selected'); else {document.fabout_itemlist.action='about_itemupdate.php';document.fabout_itemlist.encoding='application/x-www-form-urlencoded';document.fabout_itemlist.submit();};return false;">Update Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($about_item->CurrentAction == "gridadd") { ?>
<a href="" onclick="if (about_item_list.ValidateForm(document.fabout_itemlist)) document.fabout_itemlist.submit();return false;">Insert</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($about_item->CurrentAction == "gridedit") { ?>
<a href="" onclick="if (about_item_list.ValidateForm(document.fabout_itemlist)) document.fabout_itemlist.submit();return false;">Save</a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php echo $about_item_list->PageUrl() ?>a=cancel">Cancel</a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($about_item->Export == "" && $about_item->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(about_item_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($about_item->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$about_item_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class cabout_item_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'about_item';

	// Page Object Name
	var $PageObjName = 'about_item_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $about_item;
		if ($about_item->UseTokenInUrl) $PageUrl .= "t=" . $about_item->TableVar . "&"; // add page token
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
		global $objForm, $about_item;
		if ($about_item->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($about_item->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($about_item->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cabout_item_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["about_item"] = new cabout_item();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'about_item', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $about_item;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$about_item->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $about_item->Export; // Get export parameter, used in header
	$gsExportFile = $about_item->TableVar; // Get export file, used in header
	if ($about_item->Export == "print" || $about_item->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($about_item->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($about_item->Export == "word") {
		header('Content-Type: application/vnd.ms-word;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($about_item->Export == "xml") {
		header('Content-Type: text/xml;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($about_item->Export == "csv") {
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
		global $objForm, $gsSearchError, $Security, $about_item;
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

			// Check QueryString parameters
			if (@$_GET["a"] <> "") {
				$about_item->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($about_item->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to grid edit mode
				if ($about_item->CurrentAction == "gridedit")
					$this->GridEditMode();

				// Switch to inline edit mode
				if ($about_item->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($about_item->CurrentAction == "add" || $about_item->CurrentAction == "copy")
					$this->InlineAddMode();

				// Switch to grid add mode
				if ($about_item->CurrentAction == "gridadd")
					$this->GridAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$about_item->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Update
					if ($about_item->CurrentAction == "gridupdate" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridedit")
						$this->GridUpdate();

					// Inline Update
					if ($about_item->CurrentAction == "update" && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($about_item->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
						$this->InlineInsert();

					// Grid Insert
					if ($about_item->CurrentAction == "gridinsert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridadd")
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
		if ($about_item->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $about_item->getRecordsPerPage(); // Restore from Session
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
		$about_item->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$about_item->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$about_item->setStartRecordNumber($this->lStartRec);
		} else {
			$this->RestoreSearchParms();
		}

		// Build filter
		$sTblDefaultFilter = "";
		$sFilter = $sTblDefaultFilter;
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in Session
		$about_item->setSessionWhere($sFilter);
		$about_item->CurrentFilter = "";

		// Export data only
		if (in_array($about_item->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	//  Exit out of inline mode
	function ClearInlineMode() {
		global $about_item;
		$about_item->setKey("id", ""); // Clear inline edit key
		$about_item->CurrentAction = ""; // Clear action
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
		global $Security, $about_item;
		$bInlineEdit = TRUE;
		if (@$_GET["id"] <> "") {
			$about_item->id->setQueryStringValue($_GET["id"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$about_item->setKey("id", $about_item->id->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to inline edit record
	function InlineUpdate() {
		global $objForm, $gsFormError, $about_item;
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
				$about_item->SendEmail = TRUE; // Send email on update success
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
			$about_item->EventCancelled = TRUE; // Cancel event
			$about_item->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check inline edit key
	function CheckInlineEditKey() {
		global $about_item;

		//CheckInlineEditKey = True
		if (strval($about_item->getKey("id")) <> strval($about_item->id->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add Mode
	function InlineAddMode() {
		global $Security, $about_item;
		if ($about_item->CurrentAction == "copy") {
			if (@$_GET["id"] <> "") {
				$about_item->id->setQueryStringValue($_GET["id"]);
			} else {
				$about_item->CurrentAction = "add";
			}
		}
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to inline add/copy record
	function InlineInsert() {
		global $objForm, $gsFormError, $about_item;
		$objForm->Index = 1;
		$this->LoadFormValues(); // Get form values

		// Validate Form
		if (!$this->ValidateForm()) {
			$this->setMessage($gsFormError); // Set validation error message
			$about_item->EventCancelled = TRUE; // Set event cancelled
			$about_item->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$about_item->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow()) { // Add record
			$this->setMessage("Add succeeded"); // Set add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$about_item->EventCancelled = TRUE; // Set event cancelled
			$about_item->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Perform update to grid
	function GridUpdate() {
		global $conn, $objForm, $gsFormError, $about_item;
		$rowindex = 1;
		$bGridUpdate = TRUE;

		// Begin transaction
		$conn->BeginTrans();

		// Get old recordset
		$about_item->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $about_item->SQL();
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
					$about_item->SendEmail = FALSE; // Do not send email on update success
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
			$about_item->EventCancelled = TRUE; // Set event cancelled
			$about_item->CurrentAction = "gridedit"; // Stay in gridedit mode
		}
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $about_item;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $about_item->KeyFilter();
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
		global $about_item;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$about_item->id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($about_item->id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Grid Insert
	// Perform insert to grid
	function GridInsert() {
		global $conn, $objForm, $gsFormError, $about_item;
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
				$about_item->SendEmail = FALSE; // Do not send email on insert success

				// Validate Form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow(); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
					$sKey .= $about_item->id->CurrentValue;

					// Add filter for this record
					$sFilter = $about_item->KeyFilter();
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
			$about_item->CurrentFilter = $sWrkFilter;
			$sSql = $about_item->SQL();
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
			$about_item->EventCancelled = TRUE; // Set event cancelled
			$about_item->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
	}

	// Check if empty row
	function EmptyRow() {
		global $about_item;
		if ($about_item->title->CurrentValue <> $about_item->title->OldValue)
			return FALSE;
		if ($about_item->title_arabic->CurrentValue <> $about_item->title_arabic->OldValue)
			return FALSE;
		if ($about_item->count->CurrentValue <> $about_item->count->OldValue)
			return FALSE;
		if ($about_item->order->CurrentValue <> $about_item->order->OldValue)
			return FALSE;
		if ($about_item->active->CurrentValue <> $about_item->active->OldValue)
			return FALSE;
		return TRUE;
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm, $about_item;

		// Get row based on current index
		$objForm->Index = $idx;
		if ($about_item->CurrentAction == "gridadd")
			$this->LoadFormValues(); // Load form values
		if ($about_item->CurrentAction == "gridedit") {
			$sKey = strval($objForm->GetValue("k_key"));
			$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $sKey);
			if (count($arrKeyFlds) >= 1) {
				if (strval($arrKeyFlds[0]) == strval($about_item->id->CurrentValue)) {
					$this->LoadFormValues(); // Load form values
				}
			}
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $about_item;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $about_item->id, FALSE); // Field id
		$this->BuildSearchSql($sWhere, $about_item->title, FALSE); // Field title
		$this->BuildSearchSql($sWhere, $about_item->title_arabic, FALSE); // Field title_arabic
		$this->BuildSearchSql($sWhere, $about_item->text, FALSE); // Field text
		$this->BuildSearchSql($sWhere, $about_item->text_arabic, FALSE); // Field text_arabic
		$this->BuildSearchSql($sWhere, $about_item->count, FALSE); // Field count
		$this->BuildSearchSql($sWhere, $about_item->order, FALSE); // Field order
		$this->BuildSearchSql($sWhere, $about_item->active, FALSE); // Field active

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($about_item->id); // Field id
			$this->SetSearchParm($about_item->title); // Field title
			$this->SetSearchParm($about_item->title_arabic); // Field title_arabic
			$this->SetSearchParm($about_item->text); // Field text
			$this->SetSearchParm($about_item->text_arabic); // Field text_arabic
			$this->SetSearchParm($about_item->count); // Field count
			$this->SetSearchParm($about_item->order); // Field order
			$this->SetSearchParm($about_item->active); // Field active
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
		global $about_item;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$about_item->setAdvancedSearch("x_$FldParm", $FldVal);
		$about_item->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$about_item->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$about_item->setAdvancedSearch("y_$FldParm", $FldVal2);
		$about_item->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $about_item;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $about_item->title->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $about_item->title_arabic->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $about_item->text->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $about_item->text_arabic->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $about_item;
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
			$about_item->setBasicSearchKeyword($sSearchKeyword);
			$about_item->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $about_item;
		$this->sSrchWhere = "";
		$about_item->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $about_item;
		$about_item->setBasicSearchKeyword("");
		$about_item->setBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $about_item;
		$about_item->setAdvancedSearch("x_id", "");
		$about_item->setAdvancedSearch("x_title", "");
		$about_item->setAdvancedSearch("x_title_arabic", "");
		$about_item->setAdvancedSearch("x_text", "");
		$about_item->setAdvancedSearch("x_text_arabic", "");
		$about_item->setAdvancedSearch("x_count", "");
		$about_item->setAdvancedSearch("x_order", "");
		$about_item->setAdvancedSearch("x_active", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $about_item;
		$this->sSrchWhere = $about_item->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $about_item;
		 $about_item->id->AdvancedSearch->SearchValue = $about_item->getAdvancedSearch("x_id");
		 $about_item->title->AdvancedSearch->SearchValue = $about_item->getAdvancedSearch("x_title");
		 $about_item->title_arabic->AdvancedSearch->SearchValue = $about_item->getAdvancedSearch("x_title_arabic");
		 $about_item->text->AdvancedSearch->SearchValue = $about_item->getAdvancedSearch("x_text");
		 $about_item->text_arabic->AdvancedSearch->SearchValue = $about_item->getAdvancedSearch("x_text_arabic");
		 $about_item->count->AdvancedSearch->SearchValue = $about_item->getAdvancedSearch("x_count");
		 $about_item->order->AdvancedSearch->SearchValue = $about_item->getAdvancedSearch("x_order");
		 $about_item->active->AdvancedSearch->SearchValue = $about_item->getAdvancedSearch("x_active");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $about_item;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$about_item->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$about_item->CurrentOrderType = @$_GET["ordertype"];
			$about_item->UpdateSort($about_item->id); // Field 
			$about_item->UpdateSort($about_item->title); // Field 
			$about_item->UpdateSort($about_item->title_arabic); // Field 
			$about_item->UpdateSort($about_item->count); // Field 
			$about_item->UpdateSort($about_item->order); // Field 
			$about_item->UpdateSort($about_item->active); // Field 
			$about_item->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $about_item;
		$sOrderBy = $about_item->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($about_item->SqlOrderBy() <> "") {
				$sOrderBy = $about_item->SqlOrderBy();
				$about_item->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $about_item;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$about_item->setSessionOrderBy($sOrderBy);
				$about_item->id->setSort("");
				$about_item->title->setSort("");
				$about_item->title_arabic->setSort("");
				$about_item->count->setSort("");
				$about_item->order->setSort("");
				$about_item->active->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$about_item->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $about_item;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$about_item->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$about_item->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $about_item->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$about_item->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$about_item->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$about_item->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $about_item;
		$about_item->order->CurrentValue = 0;
		$about_item->order->OldValue = $about_item->order->CurrentValue;
		$about_item->active->CurrentValue = 0;
		$about_item->active->OldValue = $about_item->active->CurrentValue;
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $about_item;

		// Load search values
		// id

		$about_item->id->AdvancedSearch->SearchValue = @$_GET["x_id"];
		$about_item->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// title
		$about_item->title->AdvancedSearch->SearchValue = @$_GET["x_title"];
		$about_item->title->AdvancedSearch->SearchOperator = @$_GET["z_title"];

		// title_arabic
		$about_item->title_arabic->AdvancedSearch->SearchValue = @$_GET["x_title_arabic"];
		$about_item->title_arabic->AdvancedSearch->SearchOperator = @$_GET["z_title_arabic"];

		// text
		$about_item->text->AdvancedSearch->SearchValue = @$_GET["x_text"];
		$about_item->text->AdvancedSearch->SearchOperator = @$_GET["z_text"];

		// text_arabic
		$about_item->text_arabic->AdvancedSearch->SearchValue = @$_GET["x_text_arabic"];
		$about_item->text_arabic->AdvancedSearch->SearchOperator = @$_GET["z_text_arabic"];

		// count
		$about_item->count->AdvancedSearch->SearchValue = @$_GET["x_count"];
		$about_item->count->AdvancedSearch->SearchOperator = @$_GET["z_count"];

		// order
		$about_item->order->AdvancedSearch->SearchValue = @$_GET["x_order"];
		$about_item->order->AdvancedSearch->SearchOperator = @$_GET["z_order"];

		// active
		$about_item->active->AdvancedSearch->SearchValue = @$_GET["x_active"];
		$about_item->active->AdvancedSearch->SearchOperator = @$_GET["z_active"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $about_item;
		$about_item->id->setFormValue($objForm->GetValue("x_id"));
		$about_item->id->OldValue = $objForm->GetValue("o_id");
		$about_item->title->setFormValue($objForm->GetValue("x_title"));
		$about_item->title->OldValue = $objForm->GetValue("o_title");
		$about_item->title_arabic->setFormValue($objForm->GetValue("x_title_arabic"));
		$about_item->title_arabic->OldValue = $objForm->GetValue("o_title_arabic");
		$about_item->count->setFormValue($objForm->GetValue("x_count"));
		$about_item->count->OldValue = $objForm->GetValue("o_count");
		$about_item->order->setFormValue($objForm->GetValue("x_order"));
		$about_item->order->OldValue = $objForm->GetValue("o_order");
		$about_item->active->setFormValue($objForm->GetValue("x_active"));
		$about_item->active->OldValue = $objForm->GetValue("o_active");
	}

	// Restore form values
	function RestoreFormValues() {
		global $about_item;
		$about_item->id->CurrentValue = $about_item->id->FormValue;
		$about_item->title->CurrentValue = $about_item->title->FormValue;
		$about_item->title_arabic->CurrentValue = $about_item->title_arabic->FormValue;
		$about_item->count->CurrentValue = $about_item->count->FormValue;
		$about_item->order->CurrentValue = $about_item->order->FormValue;
		$about_item->active->CurrentValue = $about_item->active->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $about_item;

		// Call Recordset Selecting event
		$about_item->Recordset_Selecting($about_item->CurrentFilter);

		// Load list page SQL
		$sSql = $about_item->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$about_item->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $about_item;
		$sFilter = $about_item->KeyFilter();

		// Call Row Selecting event
		$about_item->Row_Selecting($sFilter);

		// Load sql based on filter
		$about_item->CurrentFilter = $sFilter;
		$sSql = $about_item->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$about_item->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $about_item;
		$about_item->id->setDbValue($rs->fields('id'));
		$about_item->title->setDbValue($rs->fields('title'));
		$about_item->title_arabic->setDbValue($rs->fields('title_arabic'));
		$about_item->text->setDbValue($rs->fields('text'));
		$about_item->text_arabic->setDbValue($rs->fields('text_arabic'));
		$about_item->count->setDbValue($rs->fields('count'));
		$about_item->order->setDbValue($rs->fields('order'));
		$about_item->active->setDbValue($rs->fields('active'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $about_item;

		// Call Row_Rendering event
		$about_item->Row_Rendering();

		// Common render codes for all row types
		// id

		$about_item->id->CellCssStyle = "";
		$about_item->id->CellCssClass = "";

		// title
		$about_item->title->CellCssStyle = "";
		$about_item->title->CellCssClass = "";

		// title_arabic
		$about_item->title_arabic->CellCssStyle = "";
		$about_item->title_arabic->CellCssClass = "";

		// count
		$about_item->count->CellCssStyle = "";
		$about_item->count->CellCssClass = "";

		// order
		$about_item->order->CellCssStyle = "";
		$about_item->order->CellCssClass = "";

		// active
		$about_item->active->CellCssStyle = "";
		$about_item->active->CellCssClass = "";
		if ($about_item->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$about_item->id->ViewValue = $about_item->id->CurrentValue;
			$about_item->id->CssStyle = "";
			$about_item->id->CssClass = "";
			$about_item->id->ViewCustomAttributes = "";

			// title
			$about_item->title->ViewValue = $about_item->title->CurrentValue;
			if ($about_item->Export == "")
				$about_item->title->ViewValue = ew_Highlight($about_item->HighlightName(), $about_item->title->ViewValue, $about_item->getBasicSearchKeyword(), $about_item->getBasicSearchType(), $about_item->getAdvancedSearch("x_title"));
			$about_item->title->CssStyle = "";
			$about_item->title->CssClass = "";
			$about_item->title->ViewCustomAttributes = "";

			// title_arabic
			$about_item->title_arabic->ViewValue = $about_item->title_arabic->CurrentValue;
			if ($about_item->Export == "")
				$about_item->title_arabic->ViewValue = ew_Highlight($about_item->HighlightName(), $about_item->title_arabic->ViewValue, $about_item->getBasicSearchKeyword(), $about_item->getBasicSearchType(), $about_item->getAdvancedSearch("x_title_arabic"));
			$about_item->title_arabic->CssStyle = "";
			$about_item->title_arabic->CssClass = "";
			$about_item->title_arabic->ViewCustomAttributes = "";

			// text
			$about_item->text->ViewValue = $about_item->text->CurrentValue;
			if ($about_item->Export == "")
				$about_item->text->ViewValue = ew_Highlight($about_item->HighlightName(), $about_item->text->ViewValue, $about_item->getBasicSearchKeyword(), $about_item->getBasicSearchType(), $about_item->getAdvancedSearch("x_text"));
			$about_item->text->CssStyle = "";
			$about_item->text->CssClass = "";
			$about_item->text->ViewCustomAttributes = "";

			// text_arabic
			$about_item->text_arabic->ViewValue = $about_item->text_arabic->CurrentValue;
			if ($about_item->Export == "")
				$about_item->text_arabic->ViewValue = ew_Highlight($about_item->HighlightName(), $about_item->text_arabic->ViewValue, $about_item->getBasicSearchKeyword(), $about_item->getBasicSearchType(), $about_item->getAdvancedSearch("x_text_arabic"));
			$about_item->text_arabic->CssStyle = "";
			$about_item->text_arabic->CssClass = "";
			$about_item->text_arabic->ViewCustomAttributes = "";

			// count
			$about_item->count->ViewValue = $about_item->count->CurrentValue;
			$about_item->count->CssStyle = "";
			$about_item->count->CssClass = "";
			$about_item->count->ViewCustomAttributes = "";

			// order
			$about_item->order->ViewValue = $about_item->order->CurrentValue;
			$about_item->order->CssStyle = "";
			$about_item->order->CssClass = "";
			$about_item->order->ViewCustomAttributes = "";

			// active
			if (strval($about_item->active->CurrentValue) <> "") {
				switch ($about_item->active->CurrentValue) {
					case "0":
						$about_item->active->ViewValue = "No";
						break;
					case "1":
						$about_item->active->ViewValue = "Yes";
						break;
					default:
						$about_item->active->ViewValue = $about_item->active->CurrentValue;
				}
			} else {
				$about_item->active->ViewValue = NULL;
			}
			$about_item->active->CssStyle = "";
			$about_item->active->CssClass = "";
			$about_item->active->ViewCustomAttributes = "";

			// id
			$about_item->id->HrefValue = "";

			// title
			$about_item->title->HrefValue = "";

			// title_arabic
			$about_item->title_arabic->HrefValue = "";

			// count
			$about_item->count->HrefValue = "";

			// order
			$about_item->order->HrefValue = "";

			// active
			$about_item->active->HrefValue = "";
		} elseif ($about_item->RowType == EW_ROWTYPE_ADD) { // Add row

			// id
			// title

			$about_item->title->EditCustomAttributes = "";
			$about_item->title->EditValue = ew_HtmlEncode($about_item->title->CurrentValue);

			// title_arabic
			$about_item->title_arabic->EditCustomAttributes = "";
			$about_item->title_arabic->EditValue = ew_HtmlEncode($about_item->title_arabic->CurrentValue);

			// count
			$about_item->count->EditCustomAttributes = "";
			$about_item->count->EditValue = ew_HtmlEncode($about_item->count->CurrentValue);

			// order
			$about_item->order->EditCustomAttributes = "";
			$about_item->order->EditValue = ew_HtmlEncode($about_item->order->CurrentValue);

			// active
			$about_item->active->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$about_item->active->EditValue = $arwrk;
		} elseif ($about_item->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$about_item->id->EditCustomAttributes = "";
			$about_item->id->EditValue = $about_item->id->CurrentValue;
			$about_item->id->CssStyle = "";
			$about_item->id->CssClass = "";
			$about_item->id->ViewCustomAttributes = "";

			// title
			$about_item->title->EditCustomAttributes = "";
			$about_item->title->EditValue = ew_HtmlEncode($about_item->title->CurrentValue);

			// title_arabic
			$about_item->title_arabic->EditCustomAttributes = "";
			$about_item->title_arabic->EditValue = ew_HtmlEncode($about_item->title_arabic->CurrentValue);

			// count
			$about_item->count->EditCustomAttributes = "";
			$about_item->count->EditValue = ew_HtmlEncode($about_item->count->CurrentValue);

			// order
			$about_item->order->EditCustomAttributes = "";
			$about_item->order->EditValue = ew_HtmlEncode($about_item->order->CurrentValue);

			// active
			$about_item->active->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$about_item->active->EditValue = $arwrk;

			// Edit refer script
			// id

			$about_item->id->HrefValue = "";

			// title
			$about_item->title->HrefValue = "";

			// title_arabic
			$about_item->title_arabic->HrefValue = "";

			// count
			$about_item->count->HrefValue = "";

			// order
			$about_item->order->HrefValue = "";

			// active
			$about_item->active->HrefValue = "";
		}

		// Call Row Rendered event
		$about_item->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $about_item;

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
		global $gsFormError, $about_item;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($about_item->title->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - title";
		}
		if ($about_item->title_arabic->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - title arabic";
		}
		if ($about_item->count->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - count";
		}
		if (!ew_CheckInteger($about_item->count->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - count";
		}
		if ($about_item->order->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - order";
		}
		if (!ew_CheckInteger($about_item->order->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - order";
		}
		if ($about_item->active->FormValue == "") {
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
		global $conn, $Security, $about_item;
		$sFilter = $about_item->KeyFilter();
		$about_item->CurrentFilter = $sFilter;
		$sSql = $about_item->SQL();
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
			// Field title

			$about_item->title->SetDbValueDef($about_item->title->CurrentValue, "");
			$rsnew['title'] =& $about_item->title->DbValue;

			// Field title_arabic
			$about_item->title_arabic->SetDbValueDef($about_item->title_arabic->CurrentValue, "");
			$rsnew['title_arabic'] =& $about_item->title_arabic->DbValue;

			// Field count
			$about_item->count->SetDbValueDef($about_item->count->CurrentValue, 0);
			$rsnew['count'] =& $about_item->count->DbValue;

			// Field order
			$about_item->order->SetDbValueDef($about_item->order->CurrentValue, 0);
			$rsnew['order'] =& $about_item->order->DbValue;

			// Field active
			$about_item->active->SetDbValueDef($about_item->active->CurrentValue, 0);
			$rsnew['active'] =& $about_item->active->DbValue;

			// Call Row Updating event
			$bUpdateRow = $about_item->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($about_item->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($about_item->CancelMessage <> "") {
					$this->setMessage($about_item->CancelMessage);
					$about_item->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$about_item->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow() {
		global $conn, $Security, $about_item;
		$rsnew = array();

		// Field id
		// Field title

		$about_item->title->SetDbValueDef($about_item->title->CurrentValue, "");
		$rsnew['title'] =& $about_item->title->DbValue;

		// Field title_arabic
		$about_item->title_arabic->SetDbValueDef($about_item->title_arabic->CurrentValue, "");
		$rsnew['title_arabic'] =& $about_item->title_arabic->DbValue;

		// Field count
		$about_item->count->SetDbValueDef($about_item->count->CurrentValue, 0);
		$rsnew['count'] =& $about_item->count->DbValue;

		// Field order
		$about_item->order->SetDbValueDef($about_item->order->CurrentValue, 0);
		$rsnew['order'] =& $about_item->order->DbValue;

		// Field active
		$about_item->active->SetDbValueDef($about_item->active->CurrentValue, 0);
		$rsnew['active'] =& $about_item->active->DbValue;

		// Call Row Inserting event
		$bInsertRow = $about_item->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($about_item->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($about_item->CancelMessage <> "") {
				$this->setMessage($about_item->CancelMessage);
				$about_item->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$about_item->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $about_item->id->DbValue;

			// Call Row Inserted event
			$about_item->Row_Inserted($rsnew);
		}
		return $AddRow;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $about_item;
		$about_item->id->AdvancedSearch->SearchValue = $about_item->getAdvancedSearch("x_id");
		$about_item->title->AdvancedSearch->SearchValue = $about_item->getAdvancedSearch("x_title");
		$about_item->title_arabic->AdvancedSearch->SearchValue = $about_item->getAdvancedSearch("x_title_arabic");
		$about_item->text->AdvancedSearch->SearchValue = $about_item->getAdvancedSearch("x_text");
		$about_item->text_arabic->AdvancedSearch->SearchValue = $about_item->getAdvancedSearch("x_text_arabic");
		$about_item->count->AdvancedSearch->SearchValue = $about_item->getAdvancedSearch("x_count");
		$about_item->order->AdvancedSearch->SearchValue = $about_item->getAdvancedSearch("x_order");
		$about_item->active->AdvancedSearch->SearchValue = $about_item->getAdvancedSearch("x_active");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $about_item;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($about_item->ExportAll) {
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
		if ($about_item->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo "\xEF\xBB\xBF";
			echo ew_ExportHeader($about_item->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $about_item->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id', $about_item->Export);
				ew_ExportAddValue($sExportStr, 'title', $about_item->Export);
				ew_ExportAddValue($sExportStr, 'title_arabic', $about_item->Export);
				ew_ExportAddValue($sExportStr, 'text', $about_item->Export);
				ew_ExportAddValue($sExportStr, 'text_arabic', $about_item->Export);
				ew_ExportAddValue($sExportStr, 'count', $about_item->Export);
				ew_ExportAddValue($sExportStr, 'order', $about_item->Export);
				ew_ExportAddValue($sExportStr, 'active', $about_item->Export);
				echo ew_ExportLine($sExportStr, $about_item->Export);
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
				$about_item->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($about_item->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id', $about_item->id->CurrentValue);
					$XmlDoc->AddField('title', $about_item->title->CurrentValue);
					$XmlDoc->AddField('title_arabic', $about_item->title_arabic->CurrentValue);
					$XmlDoc->AddField('text', $about_item->text->CurrentValue);
					$XmlDoc->AddField('text_arabic', $about_item->text_arabic->CurrentValue);
					$XmlDoc->AddField('count', $about_item->count->CurrentValue);
					$XmlDoc->AddField('order', $about_item->order->CurrentValue);
					$XmlDoc->AddField('active', $about_item->active->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $about_item->Export <> "csv") { // Vertical format
						echo ew_ExportField('id', $about_item->id->ExportValue($about_item->Export, $about_item->ExportOriginalValue), $about_item->Export);
						echo ew_ExportField('title', $about_item->title->ExportValue($about_item->Export, $about_item->ExportOriginalValue), $about_item->Export);
						echo ew_ExportField('title_arabic', $about_item->title_arabic->ExportValue($about_item->Export, $about_item->ExportOriginalValue), $about_item->Export);
						echo ew_ExportField('text', $about_item->text->ExportValue($about_item->Export, $about_item->ExportOriginalValue), $about_item->Export);
						echo ew_ExportField('text_arabic', $about_item->text_arabic->ExportValue($about_item->Export, $about_item->ExportOriginalValue), $about_item->Export);
						echo ew_ExportField('count', $about_item->count->ExportValue($about_item->Export, $about_item->ExportOriginalValue), $about_item->Export);
						echo ew_ExportField('order', $about_item->order->ExportValue($about_item->Export, $about_item->ExportOriginalValue), $about_item->Export);
						echo ew_ExportField('active', $about_item->active->ExportValue($about_item->Export, $about_item->ExportOriginalValue), $about_item->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $about_item->id->ExportValue($about_item->Export, $about_item->ExportOriginalValue), $about_item->Export);
						ew_ExportAddValue($sExportStr, $about_item->title->ExportValue($about_item->Export, $about_item->ExportOriginalValue), $about_item->Export);
						ew_ExportAddValue($sExportStr, $about_item->title_arabic->ExportValue($about_item->Export, $about_item->ExportOriginalValue), $about_item->Export);
						ew_ExportAddValue($sExportStr, $about_item->text->ExportValue($about_item->Export, $about_item->ExportOriginalValue), $about_item->Export);
						ew_ExportAddValue($sExportStr, $about_item->text_arabic->ExportValue($about_item->Export, $about_item->ExportOriginalValue), $about_item->Export);
						ew_ExportAddValue($sExportStr, $about_item->count->ExportValue($about_item->Export, $about_item->ExportOriginalValue), $about_item->Export);
						ew_ExportAddValue($sExportStr, $about_item->order->ExportValue($about_item->Export, $about_item->ExportOriginalValue), $about_item->Export);
						ew_ExportAddValue($sExportStr, $about_item->active->ExportValue($about_item->Export, $about_item->ExportOriginalValue), $about_item->Export);
						echo ew_ExportLine($sExportStr, $about_item->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($about_item->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($about_item->Export);
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
