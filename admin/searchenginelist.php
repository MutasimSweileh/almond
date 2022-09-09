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
$searchengine_list = new csearchengine_list();
$Page =& $searchengine_list;

// Page init processing
$searchengine_list->Page_Init();

// Page main processing
$searchengine_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($searchengine->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var searchengine_list = new ew_Page("searchengine_list");

// page properties
searchengine_list.PageID = "list"; // page ID
var EW_PAGE_ID = searchengine_list.PageID; // for backward compatibility

// extend page with ValidateForm function
searchengine_list.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_zpage"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - page");
		elm = fobj.elements["x" + infix + "_title"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - title");

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
searchengine_list.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "zpage")) return false;
	if (ew_ValueChanged(fobj, infix, "title")) return false;
	return true;
}

// extend page with Form_CustomValidate function
searchengine_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
searchengine_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
searchengine_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
searchengine_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
searchengine_list.ShowHighlightText = "Show highlight"; 
searchengine_list.HideHighlightText = "Hide highlight";

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
<?php if ($searchengine->Export == "") { ?>
<?php } ?>
<?php
if ($searchengine->CurrentAction == "gridadd")
	$searchengine->CurrentFilter = "0=1";
if ($searchengine->CurrentAction == "gridadd") {
	$searchengine_list->lStartRec = 1;
	if ($searchengine_list->lDisplayRecs <= 0)
		$searchengine_list->lDisplayRecs = 20;
	$searchengine_list->lTotalRecs = $searchengine_list->lDisplayRecs;
	$searchengine_list->lStopRec = $searchengine_list->lDisplayRecs;
} else {
	$bSelectLimit = ($searchengine->Export == "" && $searchengine->SelectLimit);
	if (!$bSelectLimit)
		$rs = $searchengine_list->LoadRecordset();
	$searchengine_list->lTotalRecs = ($bSelectLimit) ? $searchengine->SelectRecordCount() : $rs->RecordCount();
	$searchengine_list->lStartRec = 1;
	if ($searchengine_list->lDisplayRecs <= 0) // Display all records
		$searchengine_list->lDisplayRecs = $searchengine_list->lTotalRecs;
	if (!($searchengine->ExportAll && $searchengine->Export <> ""))
		$searchengine_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $searchengine_list->LoadRecordset($searchengine_list->lStartRec-1, $searchengine_list->lDisplayRecs);
}
?>
<p><span class="phpmaker" style="white-space: nowrap;">TABLE: searchengine
<?php if ($searchengine->Export == "" && $searchengine->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $searchengine_list->PageUrl() ?>export=print">Printer Friendly</a>
&nbsp;&nbsp;<a href="<?php echo $searchengine_list->PageUrl() ?>export=html">Export to HTML</a>
&nbsp;&nbsp;<a href="<?php echo $searchengine_list->PageUrl() ?>export=excel">Export to Excel</a>
&nbsp;&nbsp;<a href="<?php echo $searchengine_list->PageUrl() ?>export=word">Export to Word</a>
&nbsp;&nbsp;<a href="<?php echo $searchengine_list->PageUrl() ?>export=xml">Export to XML</a>
&nbsp;&nbsp;<a href="<?php echo $searchengine_list->PageUrl() ?>export=csv">Export to CSV</a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($searchengine->Export == "" && $searchengine->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(searchengine_list);" style="text-decoration: none;"><img id="searchengine_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="searchengine_list_SearchPanel">
<form name="fsearchenginelistsrch" id="fsearchenginelistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="searchengine">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($searchengine->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Search (*)">&nbsp;
			<a href="<?php echo $searchengine_list->PageUrl() ?>cmd=reset">Show all</a>&nbsp;
			<a href="searchenginesrch.php">Advanced Search</a>&nbsp;
			<?php if ($searchengine_list->sSrchWhere <> "" && $searchengine_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(searchengine_list, this, '<?php echo $searchengine->HighlightName() ?>');">Hide highlight</a>
			<?php } ?>
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($searchengine->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>Exact phrase</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($searchengine->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>All words</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($searchengine->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>Any word</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $searchengine_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($searchengine->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($searchengine->CurrentAction <> "gridadd" && $searchengine->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($searchengine_list->Pager)) $searchengine_list->Pager = new cPrevNextPager($searchengine_list->lStartRec, $searchengine_list->lDisplayRecs, $searchengine_list->lTotalRecs) ?>
<?php if ($searchengine_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($searchengine_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $searchengine_list->PageUrl() ?>start=<?php echo $searchengine_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($searchengine_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $searchengine_list->PageUrl() ?>start=<?php echo $searchengine_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $searchengine_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($searchengine_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $searchengine_list->PageUrl() ?>start=<?php echo $searchengine_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($searchengine_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $searchengine_list->PageUrl() ?>start=<?php echo $searchengine_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $searchengine_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $searchengine_list->Pager->FromIndex ?> to <?php echo $searchengine_list->Pager->ToIndex ?> of <?php echo $searchengine_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($searchengine_list->sSrchWhere == "0=101") { ?>
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
<?php if ($searchengine->CurrentAction <> "gridadd" && $searchengine->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $searchengine->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<a href="<?php echo $searchengine_list->PageUrl() ?>a=add">Inline Add</a>&nbsp;&nbsp;
<a href="<?php echo $searchengine_list->PageUrl() ?>a=gridadd">Grid Add</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($searchengine_list->lTotalRecs > 0) { ?>
<a href="<?php echo $searchengine_list->PageUrl() ?>a=gridedit">Grid Edit</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if ($searchengine_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fsearchenginelist)) alert('No records selected'); else if (ew_Confirm('<?php echo $searchengine_list->sDeleteConfirmMsg ?>')) {document.fsearchenginelist.action='searchenginedelete.php';document.fsearchenginelist.encoding='application/x-www-form-urlencoded';document.fsearchenginelist.submit();};return false;">Delete Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fsearchenginelist)) alert('No records selected'); else {document.fsearchenginelist.action='searchengineupdate.php';document.fsearchenginelist.encoding='application/x-www-form-urlencoded';document.fsearchenginelist.submit();};return false;">Update Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($searchengine->CurrentAction == "gridadd") { ?>
<a href="" onclick="if (searchengine_list.ValidateForm(document.fsearchenginelist)) document.fsearchenginelist.submit();return false;">Insert</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($searchengine->CurrentAction == "gridedit") { ?>
<a href="" onclick="if (searchengine_list.ValidateForm(document.fsearchenginelist)) document.fsearchenginelist.submit();return false;">Save</a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php echo $searchengine_list->PageUrl() ?>a=cancel">Cancel</a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fsearchenginelist" id="fsearchenginelist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="searchengine">
<?php if ($searchengine_list->lTotalRecs > 0 || $searchengine->CurrentAction == "add" || $searchengine->CurrentAction == "copy") { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$searchengine_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$searchengine_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$searchengine_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$searchengine_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$searchengine_list->lOptionCnt++; // Multi-select
}
	$searchengine_list->lOptionCnt += count($searchengine_list->ListOptions->Items); // Custom list options
?>
<?php echo $searchengine->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($searchengine->id->Visible) { // id ?>
	<?php if ($searchengine->SortUrl($searchengine->id) == "") { ?>
		<td>id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $searchengine->SortUrl($searchengine->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>id</td><td style="width: 10px;"><?php if ($searchengine->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($searchengine->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($searchengine->zpage->Visible) { // page ?>
	<?php if ($searchengine->SortUrl($searchengine->zpage) == "") { ?>
		<td>page</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $searchengine->SortUrl($searchengine->zpage) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>page&nbsp;(*)</td><td style="width: 10px;"><?php if ($searchengine->zpage->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($searchengine->zpage->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($searchengine->title->Visible) { // title ?>
	<?php if ($searchengine->SortUrl($searchengine->title) == "") { ?>
		<td>title</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $searchengine->SortUrl($searchengine->title) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>title&nbsp;(*)</td><td style="width: 10px;"><?php if ($searchengine->title->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($searchengine->title->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($searchengine->Export == "") { ?>
<?php if ($searchengine->CurrentAction <> "gridadd" && $searchengine->CurrentAction <> "gridedit") { ?>
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
<?php if ($searchengine_list->lOptionCnt == 0 && $searchengine->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="phpmaker" onclick="searchengine_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($searchengine_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
</thead>
<?php
	if ($searchengine->CurrentAction == "add" || $searchengine->CurrentAction == "copy") {
		$searchengine_list->lRowIndex = 1;
		if ($searchengine->CurrentAction == "copy" && !$searchengine_list->LoadRow())
				$searchengine->CurrentAction = "add";
		if ($searchengine->CurrentAction == "add")
			$searchengine_list->LoadDefaultValues();
		if ($searchengine->EventCancelled) // Insert failed
			$searchengine_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$searchengine->CssClass = "ewTableEditRow";
		$searchengine->CssStyle = "";
		$searchengine->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
		$searchengine->RowType = EW_ROWTYPE_ADD;

		// Render row
		$searchengine_list->RenderRow();
?>
	<tr<?php echo $searchengine->RowAttributes() ?>>
	<?php if ($searchengine->id->Visible) { // id ?>
		<td>&nbsp;</td>
	<?php } ?>
	<?php if ($searchengine->zpage->Visible) { // page ?>
		<td>
<input type="text" name="x<?php echo $searchengine_list->lRowIndex ?>_zpage" id="x<?php echo $searchengine_list->lRowIndex ?>_zpage" size="30" maxlength="50" value="<?php echo $searchengine->zpage->EditValue ?>"<?php echo $searchengine->zpage->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($searchengine->title->Visible) { // title ?>
		<td>
<input type="text" name="x<?php echo $searchengine_list->lRowIndex ?>_title" id="x<?php echo $searchengine_list->lRowIndex ?>_title" size="30" maxlength="250" value="<?php echo $searchengine->title->EditValue ?>"<?php echo $searchengine->title->EditAttributes() ?>>
</td>
	<?php } ?>
<td colspan="<?php echo $searchengine_list->lOptionCnt ?>"><span class="phpmaker">
<a href="" onclick="if (searchengine_list.ValidateForm(document.fsearchenginelist)) document.fsearchenginelist.submit();return false;">Insert</a>&nbsp;<a href="<?php echo $searchengine_list->PageUrl() ?>a=cancel">Cancel</a>
<input type="hidden" name="a_list" id="a_list" value="insert">
</span></td>
	</tr>
<?php
}
?>
<?php
if ($searchengine->ExportAll && $searchengine->Export <> "") {
	$searchengine_list->lStopRec = $searchengine_list->lTotalRecs;
} else {
	$searchengine_list->lStopRec = $searchengine_list->lStartRec + $searchengine_list->lDisplayRecs - 1; // Set the last record to display
}
$searchengine_list->lRecCount = $searchengine_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$searchengine->SelectLimit && $searchengine_list->lStartRec > 1)
		$rs->Move($searchengine_list->lStartRec - 1);
}
$searchengine_list->lRowCnt = 0;
$searchengine_list->lEditRowCnt = 0;
if ($searchengine->CurrentAction == "edit")
	$searchengine_list->lRowIndex = 1;
if ($searchengine->CurrentAction == "gridadd")
	$searchengine_list->lRowIndex = 0;
if ($searchengine->CurrentAction == "gridedit")
	$searchengine_list->lRowIndex = 0;
while (($searchengine->CurrentAction == "gridadd" || !$rs->EOF) &&
	$searchengine_list->lRecCount < $searchengine_list->lStopRec) {
	$searchengine_list->lRecCount++;
	if (intval($searchengine_list->lRecCount) >= intval($searchengine_list->lStartRec)) {
		$searchengine_list->lRowCnt++;
		if ($searchengine->CurrentAction == "gridadd" || $searchengine->CurrentAction == "gridedit")
			$searchengine_list->lRowIndex++;

	// Init row class and style
	$searchengine->CssClass = "";
	$searchengine->CssStyle = "";
	$searchengine->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($searchengine->CurrentAction == "gridadd") {
		$searchengine_list->LoadDefaultValues(); // Load default values
	} else {
		$searchengine_list->LoadRowValues($rs); // Load row values
	}
	$searchengine->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($searchengine->CurrentAction == "gridadd") // Grid add
		$searchengine->RowType = EW_ROWTYPE_ADD; // Render add
	if ($searchengine->CurrentAction == "gridadd" && $searchengine->EventCancelled) // Insert failed
		$searchengine_list->RestoreCurrentRowFormValues($searchengine_list->lRowIndex); // Restore form values
	if ($searchengine->CurrentAction == "edit") {
		if ($searchengine_list->CheckInlineEditKey() && $searchengine_list->lEditRowCnt == 0) // Inline edit
			$searchengine->RowType = EW_ROWTYPE_EDIT; // Render edit
	}
	if ($searchengine->CurrentAction == "gridedit") // Grid edit
		$searchengine->RowType = EW_ROWTYPE_EDIT; // Render edit
	if ($searchengine->RowType == EW_ROWTYPE_EDIT && $searchengine->EventCancelled) { // Update failed
		if ($searchengine->CurrentAction == "edit")
			$searchengine_list->RestoreFormValues(); // Restore form values
		if ($searchengine->CurrentAction == "gridedit")
			$searchengine_list->RestoreCurrentRowFormValues($searchengine_list->lRowIndex); // Restore form values
	}
	if ($searchengine->RowType == EW_ROWTYPE_EDIT) { // Edit row
		$searchengine_list->lEditRowCnt++;
		$searchengine->RowClientEvents = "onmouseover='this.edit=true;ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	}
	if ($searchengine->RowType == EW_ROWTYPE_ADD || $searchengine->RowType == EW_ROWTYPE_EDIT) // Add / Edit row
			$searchengine->CssClass = "ewTableEditRow";

	// Render row
	$searchengine_list->RenderRow();
?>
	<tr<?php echo $searchengine->RowAttributes() ?>>
	<?php if ($searchengine->id->Visible) { // id ?>
		<td<?php echo $searchengine->id->CellAttributes() ?>>
<?php if ($searchengine->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $searchengine_list->lRowIndex ?>_id" id="o<?php echo $searchengine_list->lRowIndex ?>_id" value="<?php echo ew_HtmlEncode($searchengine->id->OldValue) ?>">
<?php } ?>
<?php if ($searchengine->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $searchengine->id->ViewAttributes() ?>><?php echo $searchengine->id->EditValue ?></div><input type="hidden" name="x<?php echo $searchengine_list->lRowIndex ?>_id" id="x<?php echo $searchengine_list->lRowIndex ?>_id" value="<?php echo ew_HtmlEncode($searchengine->id->CurrentValue) ?>">
<?php } ?>
<?php if ($searchengine->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $searchengine->id->ViewAttributes() ?>><?php echo $searchengine->id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($searchengine->zpage->Visible) { // page ?>
		<td<?php echo $searchengine->zpage->CellAttributes() ?>>
<?php if ($searchengine->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $searchengine_list->lRowIndex ?>_zpage" id="x<?php echo $searchengine_list->lRowIndex ?>_zpage" size="30" maxlength="50" value="<?php echo $searchengine->zpage->EditValue ?>"<?php echo $searchengine->zpage->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $searchengine_list->lRowIndex ?>_zpage" id="o<?php echo $searchengine_list->lRowIndex ?>_zpage" value="<?php echo ew_HtmlEncode($searchengine->zpage->OldValue) ?>">
<?php } ?>
<?php if ($searchengine->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $searchengine_list->lRowIndex ?>_zpage" id="x<?php echo $searchengine_list->lRowIndex ?>_zpage" size="30" maxlength="50" value="<?php echo $searchengine->zpage->EditValue ?>"<?php echo $searchengine->zpage->EditAttributes() ?>>
<?php } ?>
<?php if ($searchengine->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $searchengine->zpage->ViewAttributes() ?>><?php echo $searchengine->zpage->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($searchengine->title->Visible) { // title ?>
		<td<?php echo $searchengine->title->CellAttributes() ?>>
<?php if ($searchengine->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $searchengine_list->lRowIndex ?>_title" id="x<?php echo $searchengine_list->lRowIndex ?>_title" size="30" maxlength="250" value="<?php echo $searchengine->title->EditValue ?>"<?php echo $searchengine->title->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $searchengine_list->lRowIndex ?>_title" id="o<?php echo $searchengine_list->lRowIndex ?>_title" value="<?php echo ew_HtmlEncode($searchengine->title->OldValue) ?>">
<?php } ?>
<?php if ($searchengine->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $searchengine_list->lRowIndex ?>_title" id="x<?php echo $searchengine_list->lRowIndex ?>_title" size="30" maxlength="250" value="<?php echo $searchengine->title->EditValue ?>"<?php echo $searchengine->title->EditAttributes() ?>>
<?php } ?>
<?php if ($searchengine->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $searchengine->title->ViewAttributes() ?>><?php echo $searchengine->title->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php if ($searchengine->RowType == EW_ROWTYPE_ADD || $searchengine->RowType == EW_ROWTYPE_EDIT) { ?>
<?php if ($searchengine->CurrentAction == "edit") { ?>
<td colspan="<?php echo $searchengine_list->lOptionCnt ?>"><span class="phpmaker">
<a href="" onclick="if (searchengine_list.ValidateForm(document.fsearchenginelist)) document.fsearchenginelist.submit();return false;">Update</a>&nbsp;<a href="<?php echo $searchengine_list->PageUrl() ?>a=cancel">Cancel</a>
<input type="hidden" name="a_list" id="a_list" value="update">
</span></td>
<?php } ?>
<?php
	if ($searchengine->CurrentAction == "gridedit")
		$searchengine_list->sMultiSelectKey .= "<input type=\"hidden\" name=\"k" . $searchengine_list->lRowIndex . "_key\" id=\"k" . $searchengine_list->lRowIndex . "_key\" value=\"" . $searchengine->id->CurrentValue . "\">";
?>
<?php } else { ?>
<?php if ($searchengine->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $searchengine->ViewUrl() ?>">View</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $searchengine->EditUrl() ?>">Edit</a><span class="ewSeparator">&nbsp;|&nbsp;</span><a href="<?php echo $searchengine->InlineEditUrl() ?>">Inline Edit</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $searchengine->CopyUrl() ?>">Copy</a><span class="ewSeparator">&nbsp;|&nbsp;</span><a href="<?php echo $searchengine->InlineCopyUrl() ?>">Inline Copy</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($searchengine_list->lOptionCnt == 0 && $searchengine->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($searchengine->id->CurrentValue) ?>" class="phpmaker" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($searchengine_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
<?php if ($searchengine->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($searchengine->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($searchengine->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($searchengine->CurrentAction == "add" || $searchengine->CurrentAction == "copy") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $searchengine_list->lRowIndex ?>">
<?php } ?>
<?php if ($searchengine->CurrentAction == "gridadd") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $searchengine_list->lRowIndex ?>">
<?php } ?>
<?php if ($searchengine->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $searchengine_list->lRowIndex ?>">
<?php } ?>
<?php if ($searchengine->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $searchengine_list->lRowIndex ?>">
<?php echo $searchengine_list->sMultiSelectKey ?>
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
<?php if ($searchengine_list->lTotalRecs > 0) { ?>
<?php if ($searchengine->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($searchengine->CurrentAction <> "gridadd" && $searchengine->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($searchengine_list->Pager)) $searchengine_list->Pager = new cPrevNextPager($searchengine_list->lStartRec, $searchengine_list->lDisplayRecs, $searchengine_list->lTotalRecs) ?>
<?php if ($searchengine_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($searchengine_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $searchengine_list->PageUrl() ?>start=<?php echo $searchengine_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($searchengine_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $searchengine_list->PageUrl() ?>start=<?php echo $searchengine_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $searchengine_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($searchengine_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $searchengine_list->PageUrl() ?>start=<?php echo $searchengine_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($searchengine_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $searchengine_list->PageUrl() ?>start=<?php echo $searchengine_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $searchengine_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $searchengine_list->Pager->FromIndex ?> to <?php echo $searchengine_list->Pager->ToIndex ?> of <?php echo $searchengine_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($searchengine_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($searchengine_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($searchengine->CurrentAction <> "gridadd" && $searchengine->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $searchengine->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<a href="<?php echo $searchengine_list->PageUrl() ?>a=add">Inline Add</a>&nbsp;&nbsp;
<a href="<?php echo $searchengine_list->PageUrl() ?>a=gridadd">Grid Add</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($searchengine_list->lTotalRecs > 0) { ?>
<a href="<?php echo $searchengine_list->PageUrl() ?>a=gridedit">Grid Edit</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if ($searchengine_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fsearchenginelist)) alert('No records selected'); else if (ew_Confirm('<?php echo $searchengine_list->sDeleteConfirmMsg ?>')) {document.fsearchenginelist.action='searchenginedelete.php';document.fsearchenginelist.encoding='application/x-www-form-urlencoded';document.fsearchenginelist.submit();};return false;">Delete Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fsearchenginelist)) alert('No records selected'); else {document.fsearchenginelist.action='searchengineupdate.php';document.fsearchenginelist.encoding='application/x-www-form-urlencoded';document.fsearchenginelist.submit();};return false;">Update Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($searchengine->CurrentAction == "gridadd") { ?>
<a href="" onclick="if (searchengine_list.ValidateForm(document.fsearchenginelist)) document.fsearchenginelist.submit();return false;">Insert</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($searchengine->CurrentAction == "gridedit") { ?>
<a href="" onclick="if (searchengine_list.ValidateForm(document.fsearchenginelist)) document.fsearchenginelist.submit();return false;">Save</a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php echo $searchengine_list->PageUrl() ?>a=cancel">Cancel</a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($searchengine->Export == "" && $searchengine->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(searchengine_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
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
$searchengine_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class csearchengine_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'searchengine';

	// Page Object Name
	var $PageObjName = 'searchengine_list';

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
	function csearchengine_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["searchengine"] = new csearchengine();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'searchengine', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
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
		global $objForm, $gsSearchError, $Security, $searchengine;
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
				$searchengine->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($searchengine->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to grid edit mode
				if ($searchengine->CurrentAction == "gridedit")
					$this->GridEditMode();

				// Switch to inline edit mode
				if ($searchengine->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($searchengine->CurrentAction == "add" || $searchengine->CurrentAction == "copy")
					$this->InlineAddMode();

				// Switch to grid add mode
				if ($searchengine->CurrentAction == "gridadd")
					$this->GridAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$searchengine->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Update
					if ($searchengine->CurrentAction == "gridupdate" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridedit")
						$this->GridUpdate();

					// Inline Update
					if ($searchengine->CurrentAction == "update" && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($searchengine->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
						$this->InlineInsert();

					// Grid Insert
					if ($searchengine->CurrentAction == "gridinsert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridadd")
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
		if ($searchengine->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $searchengine->getRecordsPerPage(); // Restore from Session
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
		$searchengine->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$searchengine->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$searchengine->setStartRecordNumber($this->lStartRec);
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
		$searchengine->setSessionWhere($sFilter);
		$searchengine->CurrentFilter = "";

		// Export data only
		if (in_array($searchengine->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	//  Exit out of inline mode
	function ClearInlineMode() {
		global $searchengine;
		$searchengine->setKey("id", ""); // Clear inline edit key
		$searchengine->CurrentAction = ""; // Clear action
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
		global $Security, $searchengine;
		$bInlineEdit = TRUE;
		if (@$_GET["id"] <> "") {
			$searchengine->id->setQueryStringValue($_GET["id"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$searchengine->setKey("id", $searchengine->id->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to inline edit record
	function InlineUpdate() {
		global $objForm, $gsFormError, $searchengine;
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
				$searchengine->SendEmail = TRUE; // Send email on update success
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
			$searchengine->EventCancelled = TRUE; // Cancel event
			$searchengine->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check inline edit key
	function CheckInlineEditKey() {
		global $searchengine;

		//CheckInlineEditKey = True
		if (strval($searchengine->getKey("id")) <> strval($searchengine->id->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add Mode
	function InlineAddMode() {
		global $Security, $searchengine;
		if ($searchengine->CurrentAction == "copy") {
			if (@$_GET["id"] <> "") {
				$searchengine->id->setQueryStringValue($_GET["id"]);
			} else {
				$searchengine->CurrentAction = "add";
			}
		}
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to inline add/copy record
	function InlineInsert() {
		global $objForm, $gsFormError, $searchengine;
		$objForm->Index = 1;
		$this->LoadFormValues(); // Get form values

		// Validate Form
		if (!$this->ValidateForm()) {
			$this->setMessage($gsFormError); // Set validation error message
			$searchengine->EventCancelled = TRUE; // Set event cancelled
			$searchengine->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$searchengine->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow()) { // Add record
			$this->setMessage("Add succeeded"); // Set add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$searchengine->EventCancelled = TRUE; // Set event cancelled
			$searchengine->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Perform update to grid
	function GridUpdate() {
		global $conn, $objForm, $gsFormError, $searchengine;
		$rowindex = 1;
		$bGridUpdate = TRUE;

		// Begin transaction
		$conn->BeginTrans();

		// Get old recordset
		$searchengine->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $searchengine->SQL();
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
					$searchengine->SendEmail = FALSE; // Do not send email on update success
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
			$searchengine->EventCancelled = TRUE; // Set event cancelled
			$searchengine->CurrentAction = "gridedit"; // Stay in gridedit mode
		}
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $searchengine;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $searchengine->KeyFilter();
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
		global $searchengine;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$searchengine->id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($searchengine->id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Grid Insert
	// Perform insert to grid
	function GridInsert() {
		global $conn, $objForm, $gsFormError, $searchengine;
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
				$searchengine->SendEmail = FALSE; // Do not send email on insert success

				// Validate Form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow(); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
					$sKey .= $searchengine->id->CurrentValue;

					// Add filter for this record
					$sFilter = $searchengine->KeyFilter();
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
			$searchengine->CurrentFilter = $sWrkFilter;
			$sSql = $searchengine->SQL();
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
			$searchengine->EventCancelled = TRUE; // Set event cancelled
			$searchengine->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
	}

	// Check if empty row
	function EmptyRow() {
		global $searchengine;
		if ($searchengine->zpage->CurrentValue <> $searchengine->zpage->OldValue)
			return FALSE;
		if ($searchengine->title->CurrentValue <> $searchengine->title->OldValue)
			return FALSE;
		return TRUE;
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm, $searchengine;

		// Get row based on current index
		$objForm->Index = $idx;
		if ($searchengine->CurrentAction == "gridadd")
			$this->LoadFormValues(); // Load form values
		if ($searchengine->CurrentAction == "gridedit") {
			$sKey = strval($objForm->GetValue("k_key"));
			$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $sKey);
			if (count($arrKeyFlds) >= 1) {
				if (strval($arrKeyFlds[0]) == strval($searchengine->id->CurrentValue)) {
					$this->LoadFormValues(); // Load form values
				}
			}
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $searchengine;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $searchengine->id, FALSE); // Field id
		$this->BuildSearchSql($sWhere, $searchengine->zpage, FALSE); // Field page
		$this->BuildSearchSql($sWhere, $searchengine->description, FALSE); // Field description
		$this->BuildSearchSql($sWhere, $searchengine->keywords, FALSE); // Field keywords
		$this->BuildSearchSql($sWhere, $searchengine->title, FALSE); // Field title

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($searchengine->id); // Field id
			$this->SetSearchParm($searchengine->zpage); // Field page
			$this->SetSearchParm($searchengine->description); // Field description
			$this->SetSearchParm($searchengine->keywords); // Field keywords
			$this->SetSearchParm($searchengine->title); // Field title
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
		global $searchengine;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$searchengine->setAdvancedSearch("x_$FldParm", $FldVal);
		$searchengine->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$searchengine->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$searchengine->setAdvancedSearch("y_$FldParm", $FldVal2);
		$searchengine->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $searchengine;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $searchengine->zpage->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $searchengine->description->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $searchengine->keywords->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $searchengine->title->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $searchengine;
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
			$searchengine->setBasicSearchKeyword($sSearchKeyword);
			$searchengine->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $searchengine;
		$this->sSrchWhere = "";
		$searchengine->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $searchengine;
		$searchengine->setBasicSearchKeyword("");
		$searchengine->setBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $searchengine;
		$searchengine->setAdvancedSearch("x_id", "");
		$searchengine->setAdvancedSearch("x_zpage", "");
		$searchengine->setAdvancedSearch("x_description", "");
		$searchengine->setAdvancedSearch("x_keywords", "");
		$searchengine->setAdvancedSearch("x_title", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $searchengine;
		$this->sSrchWhere = $searchengine->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $searchengine;
		 $searchengine->id->AdvancedSearch->SearchValue = $searchengine->getAdvancedSearch("x_id");
		 $searchengine->zpage->AdvancedSearch->SearchValue = $searchengine->getAdvancedSearch("x_zpage");
		 $searchengine->description->AdvancedSearch->SearchValue = $searchengine->getAdvancedSearch("x_description");
		 $searchengine->keywords->AdvancedSearch->SearchValue = $searchengine->getAdvancedSearch("x_keywords");
		 $searchengine->title->AdvancedSearch->SearchValue = $searchengine->getAdvancedSearch("x_title");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $searchengine;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$searchengine->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$searchengine->CurrentOrderType = @$_GET["ordertype"];
			$searchengine->UpdateSort($searchengine->id); // Field 
			$searchengine->UpdateSort($searchengine->zpage); // Field 
			$searchengine->UpdateSort($searchengine->title); // Field 
			$searchengine->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $searchengine;
		$sOrderBy = $searchengine->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($searchengine->SqlOrderBy() <> "") {
				$sOrderBy = $searchengine->SqlOrderBy();
				$searchengine->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $searchengine;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$searchengine->setSessionOrderBy($sOrderBy);
				$searchengine->id->setSort("");
				$searchengine->zpage->setSort("");
				$searchengine->title->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$searchengine->setStartRecordNumber($this->lStartRec);
		}
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

	// Load default values
	function LoadDefaultValues() {
		global $searchengine;
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $searchengine;

		// Load search values
		// id

		$searchengine->id->AdvancedSearch->SearchValue = @$_GET["x_id"];
		$searchengine->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// page
		$searchengine->zpage->AdvancedSearch->SearchValue = @$_GET["x_zpage"];
		$searchengine->zpage->AdvancedSearch->SearchOperator = @$_GET["z_zpage"];

		// description
		$searchengine->description->AdvancedSearch->SearchValue = @$_GET["x_description"];
		$searchengine->description->AdvancedSearch->SearchOperator = @$_GET["z_description"];

		// keywords
		$searchengine->keywords->AdvancedSearch->SearchValue = @$_GET["x_keywords"];
		$searchengine->keywords->AdvancedSearch->SearchOperator = @$_GET["z_keywords"];

		// title
		$searchengine->title->AdvancedSearch->SearchValue = @$_GET["x_title"];
		$searchengine->title->AdvancedSearch->SearchOperator = @$_GET["z_title"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $searchengine;
		$searchengine->id->setFormValue($objForm->GetValue("x_id"));
		$searchengine->id->OldValue = $objForm->GetValue("o_id");
		$searchengine->zpage->setFormValue($objForm->GetValue("x_zpage"));
		$searchengine->zpage->OldValue = $objForm->GetValue("o_zpage");
		$searchengine->title->setFormValue($objForm->GetValue("x_title"));
		$searchengine->title->OldValue = $objForm->GetValue("o_title");
	}

	// Restore form values
	function RestoreFormValues() {
		global $searchengine;
		$searchengine->id->CurrentValue = $searchengine->id->FormValue;
		$searchengine->zpage->CurrentValue = $searchengine->zpage->FormValue;
		$searchengine->title->CurrentValue = $searchengine->title->FormValue;
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
			if ($searchengine->Export == "")
				$searchengine->zpage->ViewValue = ew_Highlight($searchengine->HighlightName(), $searchengine->zpage->ViewValue, $searchengine->getBasicSearchKeyword(), $searchengine->getBasicSearchType(), $searchengine->getAdvancedSearch("x_zpage"));
			$searchengine->zpage->CssStyle = "";
			$searchengine->zpage->CssClass = "";
			$searchengine->zpage->ViewCustomAttributes = "";

			// description
			$searchengine->description->ViewValue = $searchengine->description->CurrentValue;
			if ($searchengine->Export == "")
				$searchengine->description->ViewValue = ew_Highlight($searchengine->HighlightName(), $searchengine->description->ViewValue, $searchengine->getBasicSearchKeyword(), $searchengine->getBasicSearchType(), $searchengine->getAdvancedSearch("x_description"));
			$searchengine->description->CssStyle = "";
			$searchengine->description->CssClass = "";
			$searchengine->description->ViewCustomAttributes = "";

			// keywords
			$searchengine->keywords->ViewValue = $searchengine->keywords->CurrentValue;
			if ($searchengine->Export == "")
				$searchengine->keywords->ViewValue = ew_Highlight($searchengine->HighlightName(), $searchengine->keywords->ViewValue, $searchengine->getBasicSearchKeyword(), $searchengine->getBasicSearchType(), $searchengine->getAdvancedSearch("x_keywords"));
			$searchengine->keywords->CssStyle = "";
			$searchengine->keywords->CssClass = "";
			$searchengine->keywords->ViewCustomAttributes = "";

			// title
			$searchengine->title->ViewValue = $searchengine->title->CurrentValue;
			if ($searchengine->Export == "")
				$searchengine->title->ViewValue = ew_Highlight($searchengine->HighlightName(), $searchengine->title->ViewValue, $searchengine->getBasicSearchKeyword(), $searchengine->getBasicSearchType(), $searchengine->getAdvancedSearch("x_title"));
			$searchengine->title->CssStyle = "";
			$searchengine->title->CssClass = "";
			$searchengine->title->ViewCustomAttributes = "";

			// id
			$searchengine->id->HrefValue = "";

			// page
			$searchengine->zpage->HrefValue = "";

			// title
			$searchengine->title->HrefValue = "";
		} elseif ($searchengine->RowType == EW_ROWTYPE_ADD) { // Add row

			// id
			// page

			$searchengine->zpage->EditCustomAttributes = "";
			$searchengine->zpage->EditValue = ew_HtmlEncode($searchengine->zpage->CurrentValue);

			// title
			$searchengine->title->EditCustomAttributes = "";
			$searchengine->title->EditValue = ew_HtmlEncode($searchengine->title->CurrentValue);
		} elseif ($searchengine->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$searchengine->id->EditCustomAttributes = "";
			$searchengine->id->EditValue = $searchengine->id->CurrentValue;
			$searchengine->id->CssStyle = "";
			$searchengine->id->CssClass = "";
			$searchengine->id->ViewCustomAttributes = "";

			// page
			$searchengine->zpage->EditCustomAttributes = "";
			$searchengine->zpage->EditValue = ew_HtmlEncode($searchengine->zpage->CurrentValue);

			// title
			$searchengine->title->EditCustomAttributes = "";
			$searchengine->title->EditValue = ew_HtmlEncode($searchengine->title->CurrentValue);

			// Edit refer script
			// id

			$searchengine->id->HrefValue = "";

			// page
			$searchengine->zpage->HrefValue = "";

			// title
			$searchengine->title->HrefValue = "";
		}

		// Call Row Rendered event
		$searchengine->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $searchengine;

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
		global $gsFormError, $searchengine;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($searchengine->zpage->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - page";
		}
		if ($searchengine->title->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - title";
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
		global $conn, $Security, $searchengine;
		$sFilter = $searchengine->KeyFilter();
		$searchengine->CurrentFilter = $sFilter;
		$sSql = $searchengine->SQL();
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
			// Field page

			$searchengine->zpage->SetDbValueDef($searchengine->zpage->CurrentValue, "");
			$rsnew['page'] =& $searchengine->zpage->DbValue;

			// Field title
			$searchengine->title->SetDbValueDef($searchengine->title->CurrentValue, "");
			$rsnew['title'] =& $searchengine->title->DbValue;

			// Call Row Updating event
			$bUpdateRow = $searchengine->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($searchengine->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($searchengine->CancelMessage <> "") {
					$this->setMessage($searchengine->CancelMessage);
					$searchengine->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$searchengine->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow() {
		global $conn, $Security, $searchengine;
		$rsnew = array();

		// Field id
		// Field page

		$searchengine->zpage->SetDbValueDef($searchengine->zpage->CurrentValue, "");
		$rsnew['page'] =& $searchengine->zpage->DbValue;

		// Field title
		$searchengine->title->SetDbValueDef($searchengine->title->CurrentValue, "");
		$rsnew['title'] =& $searchengine->title->DbValue;

		// Call Row Inserting event
		$bInsertRow = $searchengine->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($searchengine->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($searchengine->CancelMessage <> "") {
				$this->setMessage($searchengine->CancelMessage);
				$searchengine->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$searchengine->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $searchengine->id->DbValue;

			// Call Row Inserted event
			$searchengine->Row_Inserted($rsnew);
		}
		return $AddRow;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $searchengine;
		$searchengine->id->AdvancedSearch->SearchValue = $searchengine->getAdvancedSearch("x_id");
		$searchengine->zpage->AdvancedSearch->SearchValue = $searchengine->getAdvancedSearch("x_zpage");
		$searchengine->description->AdvancedSearch->SearchValue = $searchengine->getAdvancedSearch("x_description");
		$searchengine->keywords->AdvancedSearch->SearchValue = $searchengine->getAdvancedSearch("x_keywords");
		$searchengine->title->AdvancedSearch->SearchValue = $searchengine->getAdvancedSearch("x_title");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $searchengine;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($searchengine->ExportAll) {
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
