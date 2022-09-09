<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "info_mediainfo.php" ?>
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
$info_media_list = new cinfo_media_list();
$Page =& $info_media_list;

// Page init processing
$info_media_list->Page_Init();

// Page main processing
$info_media_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($info_media->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var info_media_list = new ew_Page("info_media_list");

// page properties
info_media_list.PageID = "list"; // page ID
var EW_PAGE_ID = info_media_list.PageID; // for backward compatibility

// extend page with ValidateForm function
info_media_list.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_code"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - code");

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
info_media_list.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "code")) return false;
	return true;
}

// extend page with Form_CustomValidate function
info_media_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
info_media_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
info_media_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
info_media_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
info_media_list.ShowHighlightText = "Show highlight"; 
info_media_list.HideHighlightText = "Hide highlight";

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
<?php if ($info_media->Export == "") { ?>
<?php } ?>
<?php
if ($info_media->CurrentAction == "gridadd")
	$info_media->CurrentFilter = "0=1";
if ($info_media->CurrentAction == "gridadd") {
	$info_media_list->lStartRec = 1;
	if ($info_media_list->lDisplayRecs <= 0)
		$info_media_list->lDisplayRecs = 20;
	$info_media_list->lTotalRecs = $info_media_list->lDisplayRecs;
	$info_media_list->lStopRec = $info_media_list->lDisplayRecs;
} else {
	$bSelectLimit = ($info_media->Export == "" && $info_media->SelectLimit);
	if (!$bSelectLimit)
		$rs = $info_media_list->LoadRecordset();
	$info_media_list->lTotalRecs = ($bSelectLimit) ? $info_media->SelectRecordCount() : $rs->RecordCount();
	$info_media_list->lStartRec = 1;
	if ($info_media_list->lDisplayRecs <= 0) // Display all records
		$info_media_list->lDisplayRecs = $info_media_list->lTotalRecs;
	if (!($info_media->ExportAll && $info_media->Export <> ""))
		$info_media_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $info_media_list->LoadRecordset($info_media_list->lStartRec-1, $info_media_list->lDisplayRecs);
}
?>
<p><span class="phpmaker" style="white-space: nowrap;">TABLE: info media
<?php if ($info_media->Export == "" && $info_media->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $info_media_list->PageUrl() ?>export=print">Printer Friendly</a>
&nbsp;&nbsp;<a href="<?php echo $info_media_list->PageUrl() ?>export=html">Export to HTML</a>
&nbsp;&nbsp;<a href="<?php echo $info_media_list->PageUrl() ?>export=excel">Export to Excel</a>
&nbsp;&nbsp;<a href="<?php echo $info_media_list->PageUrl() ?>export=word">Export to Word</a>
&nbsp;&nbsp;<a href="<?php echo $info_media_list->PageUrl() ?>export=xml">Export to XML</a>
&nbsp;&nbsp;<a href="<?php echo $info_media_list->PageUrl() ?>export=csv">Export to CSV</a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($info_media->Export == "" && $info_media->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(info_media_list);" style="text-decoration: none;"><img id="info_media_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="info_media_list_SearchPanel">
<form name="finfo_medialistsrch" id="finfo_medialistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="info_media">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($info_media->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Search (*)">&nbsp;
			<a href="<?php echo $info_media_list->PageUrl() ?>cmd=reset">Show all</a>&nbsp;
			<a href="info_mediasrch.php">Advanced Search</a>&nbsp;
			<?php if ($info_media_list->sSrchWhere <> "" && $info_media_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(info_media_list, this, '<?php echo $info_media->HighlightName() ?>');">Hide highlight</a>
			<?php } ?>
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($info_media->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>Exact phrase</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($info_media->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>All words</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($info_media->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>Any word</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $info_media_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($info_media->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($info_media->CurrentAction <> "gridadd" && $info_media->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($info_media_list->Pager)) $info_media_list->Pager = new cPrevNextPager($info_media_list->lStartRec, $info_media_list->lDisplayRecs, $info_media_list->lTotalRecs) ?>
<?php if ($info_media_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($info_media_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $info_media_list->PageUrl() ?>start=<?php echo $info_media_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($info_media_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $info_media_list->PageUrl() ?>start=<?php echo $info_media_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $info_media_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($info_media_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $info_media_list->PageUrl() ?>start=<?php echo $info_media_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($info_media_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $info_media_list->PageUrl() ?>start=<?php echo $info_media_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $info_media_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $info_media_list->Pager->FromIndex ?> to <?php echo $info_media_list->Pager->ToIndex ?> of <?php echo $info_media_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($info_media_list->sSrchWhere == "0=101") { ?>
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
<?php if ($info_media->CurrentAction <> "gridadd" && $info_media->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $info_media->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<a href="<?php echo $info_media_list->PageUrl() ?>a=add">Inline Add</a>&nbsp;&nbsp;
<a href="<?php echo $info_media_list->PageUrl() ?>a=gridadd">Grid Add</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($info_media_list->lTotalRecs > 0) { ?>
<a href="<?php echo $info_media_list->PageUrl() ?>a=gridedit">Grid Edit</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if ($info_media_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.finfo_medialist)) alert('No records selected'); else if (ew_Confirm('<?php echo $info_media_list->sDeleteConfirmMsg ?>')) {document.finfo_medialist.action='info_mediadelete.php';document.finfo_medialist.encoding='application/x-www-form-urlencoded';document.finfo_medialist.submit();};return false;">Delete Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.finfo_medialist)) alert('No records selected'); else {document.finfo_medialist.action='info_mediaupdate.php';document.finfo_medialist.encoding='application/x-www-form-urlencoded';document.finfo_medialist.submit();};return false;">Update Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($info_media->CurrentAction == "gridadd") { ?>
<a href="" onclick="if (info_media_list.ValidateForm(document.finfo_medialist)) document.finfo_medialist.submit();return false;">Insert</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($info_media->CurrentAction == "gridedit") { ?>
<a href="" onclick="if (info_media_list.ValidateForm(document.finfo_medialist)) document.finfo_medialist.submit();return false;">Save</a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php echo $info_media_list->PageUrl() ?>a=cancel">Cancel</a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="finfo_medialist" id="finfo_medialist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="info_media">
<?php if ($info_media_list->lTotalRecs > 0 || $info_media->CurrentAction == "add" || $info_media->CurrentAction == "copy") { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$info_media_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$info_media_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$info_media_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$info_media_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$info_media_list->lOptionCnt++; // Multi-select
}
	$info_media_list->lOptionCnt += count($info_media_list->ListOptions->Items); // Custom list options
?>
<?php echo $info_media->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($info_media->id->Visible) { // id ?>
	<?php if ($info_media->SortUrl($info_media->id) == "") { ?>
		<td>id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $info_media->SortUrl($info_media->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>id</td><td style="width: 10px;"><?php if ($info_media->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($info_media->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($info_media->code->Visible) { // code ?>
	<?php if ($info_media->SortUrl($info_media->code) == "") { ?>
		<td>code</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $info_media->SortUrl($info_media->code) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>code&nbsp;(*)</td><td style="width: 10px;"><?php if ($info_media->code->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($info_media->code->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($info_media->Export == "") { ?>
<?php if ($info_media->CurrentAction <> "gridadd" && $info_media->CurrentAction <> "gridedit") { ?>
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
<?php if ($info_media_list->lOptionCnt == 0 && $info_media->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="phpmaker" onclick="info_media_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($info_media_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
</thead>
<?php
	if ($info_media->CurrentAction == "add" || $info_media->CurrentAction == "copy") {
		$info_media_list->lRowIndex = 1;
		if ($info_media->CurrentAction == "copy" && !$info_media_list->LoadRow())
				$info_media->CurrentAction = "add";
		if ($info_media->CurrentAction == "add")
			$info_media_list->LoadDefaultValues();
		if ($info_media->EventCancelled) // Insert failed
			$info_media_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$info_media->CssClass = "ewTableEditRow";
		$info_media->CssStyle = "";
		$info_media->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
		$info_media->RowType = EW_ROWTYPE_ADD;

		// Render row
		$info_media_list->RenderRow();
?>
	<tr<?php echo $info_media->RowAttributes() ?>>
	<?php if ($info_media->id->Visible) { // id ?>
		<td>&nbsp;</td>
	<?php } ?>
	<?php if ($info_media->code->Visible) { // code ?>
		<td>
<input type="text" name="x<?php echo $info_media_list->lRowIndex ?>_code" id="x<?php echo $info_media_list->lRowIndex ?>_code" size="30" maxlength="200" value="<?php echo $info_media->code->EditValue ?>"<?php echo $info_media->code->EditAttributes() ?>>
</td>
	<?php } ?>
<td colspan="<?php echo $info_media_list->lOptionCnt ?>"><span class="phpmaker">
<a href="" onclick="if (info_media_list.ValidateForm(document.finfo_medialist)) document.finfo_medialist.submit();return false;">Insert</a>&nbsp;<a href="<?php echo $info_media_list->PageUrl() ?>a=cancel">Cancel</a>
<input type="hidden" name="a_list" id="a_list" value="insert">
</span></td>
	</tr>
<?php
}
?>
<?php
if ($info_media->ExportAll && $info_media->Export <> "") {
	$info_media_list->lStopRec = $info_media_list->lTotalRecs;
} else {
	$info_media_list->lStopRec = $info_media_list->lStartRec + $info_media_list->lDisplayRecs - 1; // Set the last record to display
}
$info_media_list->lRecCount = $info_media_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$info_media->SelectLimit && $info_media_list->lStartRec > 1)
		$rs->Move($info_media_list->lStartRec - 1);
}
$info_media_list->lRowCnt = 0;
$info_media_list->lEditRowCnt = 0;
if ($info_media->CurrentAction == "edit")
	$info_media_list->lRowIndex = 1;
if ($info_media->CurrentAction == "gridadd")
	$info_media_list->lRowIndex = 0;
if ($info_media->CurrentAction == "gridedit")
	$info_media_list->lRowIndex = 0;
while (($info_media->CurrentAction == "gridadd" || !$rs->EOF) &&
	$info_media_list->lRecCount < $info_media_list->lStopRec) {
	$info_media_list->lRecCount++;
	if (intval($info_media_list->lRecCount) >= intval($info_media_list->lStartRec)) {
		$info_media_list->lRowCnt++;
		if ($info_media->CurrentAction == "gridadd" || $info_media->CurrentAction == "gridedit")
			$info_media_list->lRowIndex++;

	// Init row class and style
	$info_media->CssClass = "";
	$info_media->CssStyle = "";
	$info_media->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($info_media->CurrentAction == "gridadd") {
		$info_media_list->LoadDefaultValues(); // Load default values
	} else {
		$info_media_list->LoadRowValues($rs); // Load row values
	}
	$info_media->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($info_media->CurrentAction == "gridadd") // Grid add
		$info_media->RowType = EW_ROWTYPE_ADD; // Render add
	if ($info_media->CurrentAction == "gridadd" && $info_media->EventCancelled) // Insert failed
		$info_media_list->RestoreCurrentRowFormValues($info_media_list->lRowIndex); // Restore form values
	if ($info_media->CurrentAction == "edit") {
		if ($info_media_list->CheckInlineEditKey() && $info_media_list->lEditRowCnt == 0) // Inline edit
			$info_media->RowType = EW_ROWTYPE_EDIT; // Render edit
	}
	if ($info_media->CurrentAction == "gridedit") // Grid edit
		$info_media->RowType = EW_ROWTYPE_EDIT; // Render edit
	if ($info_media->RowType == EW_ROWTYPE_EDIT && $info_media->EventCancelled) { // Update failed
		if ($info_media->CurrentAction == "edit")
			$info_media_list->RestoreFormValues(); // Restore form values
		if ($info_media->CurrentAction == "gridedit")
			$info_media_list->RestoreCurrentRowFormValues($info_media_list->lRowIndex); // Restore form values
	}
	if ($info_media->RowType == EW_ROWTYPE_EDIT) { // Edit row
		$info_media_list->lEditRowCnt++;
		$info_media->RowClientEvents = "onmouseover='this.edit=true;ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	}
	if ($info_media->RowType == EW_ROWTYPE_ADD || $info_media->RowType == EW_ROWTYPE_EDIT) // Add / Edit row
			$info_media->CssClass = "ewTableEditRow";

	// Render row
	$info_media_list->RenderRow();
?>
	<tr<?php echo $info_media->RowAttributes() ?>>
	<?php if ($info_media->id->Visible) { // id ?>
		<td<?php echo $info_media->id->CellAttributes() ?>>
<?php if ($info_media->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $info_media_list->lRowIndex ?>_id" id="o<?php echo $info_media_list->lRowIndex ?>_id" value="<?php echo ew_HtmlEncode($info_media->id->OldValue) ?>">
<?php } ?>
<?php if ($info_media->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $info_media->id->ViewAttributes() ?>><?php echo $info_media->id->EditValue ?></div><input type="hidden" name="x<?php echo $info_media_list->lRowIndex ?>_id" id="x<?php echo $info_media_list->lRowIndex ?>_id" value="<?php echo ew_HtmlEncode($info_media->id->CurrentValue) ?>">
<?php } ?>
<?php if ($info_media->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $info_media->id->ViewAttributes() ?>><?php echo $info_media->id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($info_media->code->Visible) { // code ?>
		<td<?php echo $info_media->code->CellAttributes() ?>>
<?php if ($info_media->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $info_media_list->lRowIndex ?>_code" id="x<?php echo $info_media_list->lRowIndex ?>_code" size="30" maxlength="200" value="<?php echo $info_media->code->EditValue ?>"<?php echo $info_media->code->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $info_media_list->lRowIndex ?>_code" id="o<?php echo $info_media_list->lRowIndex ?>_code" value="<?php echo ew_HtmlEncode($info_media->code->OldValue) ?>">
<?php } ?>
<?php if ($info_media->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $info_media_list->lRowIndex ?>_code" id="x<?php echo $info_media_list->lRowIndex ?>_code" size="30" maxlength="200" value="<?php echo $info_media->code->EditValue ?>"<?php echo $info_media->code->EditAttributes() ?>>
<?php } ?>
<?php if ($info_media->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $info_media->code->ViewAttributes() ?>><?php echo $info_media->code->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php if ($info_media->RowType == EW_ROWTYPE_ADD || $info_media->RowType == EW_ROWTYPE_EDIT) { ?>
<?php if ($info_media->CurrentAction == "edit") { ?>
<td colspan="<?php echo $info_media_list->lOptionCnt ?>"><span class="phpmaker">
<a href="" onclick="if (info_media_list.ValidateForm(document.finfo_medialist)) document.finfo_medialist.submit();return false;">Update</a>&nbsp;<a href="<?php echo $info_media_list->PageUrl() ?>a=cancel">Cancel</a>
<input type="hidden" name="a_list" id="a_list" value="update">
</span></td>
<?php } ?>
<?php
	if ($info_media->CurrentAction == "gridedit")
		$info_media_list->sMultiSelectKey .= "<input type=\"hidden\" name=\"k" . $info_media_list->lRowIndex . "_key\" id=\"k" . $info_media_list->lRowIndex . "_key\" value=\"" . $info_media->id->CurrentValue . "\">";
?>
<?php } else { ?>
<?php if ($info_media->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $info_media->ViewUrl() ?>">View</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $info_media->EditUrl() ?>">Edit</a><span class="ewSeparator">&nbsp;|&nbsp;</span><a href="<?php echo $info_media->InlineEditUrl() ?>">Inline Edit</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $info_media->CopyUrl() ?>">Copy</a><span class="ewSeparator">&nbsp;|&nbsp;</span><a href="<?php echo $info_media->InlineCopyUrl() ?>">Inline Copy</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($info_media_list->lOptionCnt == 0 && $info_media->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($info_media->id->CurrentValue) ?>" class="phpmaker" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($info_media_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
<?php if ($info_media->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($info_media->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($info_media->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($info_media->CurrentAction == "add" || $info_media->CurrentAction == "copy") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $info_media_list->lRowIndex ?>">
<?php } ?>
<?php if ($info_media->CurrentAction == "gridadd") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $info_media_list->lRowIndex ?>">
<?php } ?>
<?php if ($info_media->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $info_media_list->lRowIndex ?>">
<?php } ?>
<?php if ($info_media->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $info_media_list->lRowIndex ?>">
<?php echo $info_media_list->sMultiSelectKey ?>
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
<?php if ($info_media_list->lTotalRecs > 0) { ?>
<?php if ($info_media->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($info_media->CurrentAction <> "gridadd" && $info_media->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($info_media_list->Pager)) $info_media_list->Pager = new cPrevNextPager($info_media_list->lStartRec, $info_media_list->lDisplayRecs, $info_media_list->lTotalRecs) ?>
<?php if ($info_media_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($info_media_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $info_media_list->PageUrl() ?>start=<?php echo $info_media_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($info_media_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $info_media_list->PageUrl() ?>start=<?php echo $info_media_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $info_media_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($info_media_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $info_media_list->PageUrl() ?>start=<?php echo $info_media_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($info_media_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $info_media_list->PageUrl() ?>start=<?php echo $info_media_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $info_media_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $info_media_list->Pager->FromIndex ?> to <?php echo $info_media_list->Pager->ToIndex ?> of <?php echo $info_media_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($info_media_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($info_media_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($info_media->CurrentAction <> "gridadd" && $info_media->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $info_media->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<a href="<?php echo $info_media_list->PageUrl() ?>a=add">Inline Add</a>&nbsp;&nbsp;
<a href="<?php echo $info_media_list->PageUrl() ?>a=gridadd">Grid Add</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($info_media_list->lTotalRecs > 0) { ?>
<a href="<?php echo $info_media_list->PageUrl() ?>a=gridedit">Grid Edit</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if ($info_media_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.finfo_medialist)) alert('No records selected'); else if (ew_Confirm('<?php echo $info_media_list->sDeleteConfirmMsg ?>')) {document.finfo_medialist.action='info_mediadelete.php';document.finfo_medialist.encoding='application/x-www-form-urlencoded';document.finfo_medialist.submit();};return false;">Delete Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.finfo_medialist)) alert('No records selected'); else {document.finfo_medialist.action='info_mediaupdate.php';document.finfo_medialist.encoding='application/x-www-form-urlencoded';document.finfo_medialist.submit();};return false;">Update Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($info_media->CurrentAction == "gridadd") { ?>
<a href="" onclick="if (info_media_list.ValidateForm(document.finfo_medialist)) document.finfo_medialist.submit();return false;">Insert</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($info_media->CurrentAction == "gridedit") { ?>
<a href="" onclick="if (info_media_list.ValidateForm(document.finfo_medialist)) document.finfo_medialist.submit();return false;">Save</a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php echo $info_media_list->PageUrl() ?>a=cancel">Cancel</a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($info_media->Export == "" && $info_media->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(info_media_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($info_media->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$info_media_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class cinfo_media_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'info_media';

	// Page Object Name
	var $PageObjName = 'info_media_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $info_media;
		if ($info_media->UseTokenInUrl) $PageUrl .= "t=" . $info_media->TableVar . "&"; // add page token
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
		global $objForm, $info_media;
		if ($info_media->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($info_media->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($info_media->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cinfo_media_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["info_media"] = new cinfo_media();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'info_media', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $info_media;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$info_media->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $info_media->Export; // Get export parameter, used in header
	$gsExportFile = $info_media->TableVar; // Get export file, used in header
	if ($info_media->Export == "print" || $info_media->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($info_media->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($info_media->Export == "word") {
		header('Content-Type: application/vnd.ms-word;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($info_media->Export == "xml") {
		header('Content-Type: text/xml;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($info_media->Export == "csv") {
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
		global $objForm, $gsSearchError, $Security, $info_media;
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
				$info_media->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($info_media->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to grid edit mode
				if ($info_media->CurrentAction == "gridedit")
					$this->GridEditMode();

				// Switch to inline edit mode
				if ($info_media->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($info_media->CurrentAction == "add" || $info_media->CurrentAction == "copy")
					$this->InlineAddMode();

				// Switch to grid add mode
				if ($info_media->CurrentAction == "gridadd")
					$this->GridAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$info_media->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Update
					if ($info_media->CurrentAction == "gridupdate" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridedit")
						$this->GridUpdate();

					// Inline Update
					if ($info_media->CurrentAction == "update" && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($info_media->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
						$this->InlineInsert();

					// Grid Insert
					if ($info_media->CurrentAction == "gridinsert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridadd")
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
		if ($info_media->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $info_media->getRecordsPerPage(); // Restore from Session
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
		$info_media->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$info_media->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$info_media->setStartRecordNumber($this->lStartRec);
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
		$info_media->setSessionWhere($sFilter);
		$info_media->CurrentFilter = "";

		// Export data only
		if (in_array($info_media->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	//  Exit out of inline mode
	function ClearInlineMode() {
		global $info_media;
		$info_media->setKey("id", ""); // Clear inline edit key
		$info_media->CurrentAction = ""; // Clear action
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
		global $Security, $info_media;
		$bInlineEdit = TRUE;
		if (@$_GET["id"] <> "") {
			$info_media->id->setQueryStringValue($_GET["id"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$info_media->setKey("id", $info_media->id->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to inline edit record
	function InlineUpdate() {
		global $objForm, $gsFormError, $info_media;
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
				$info_media->SendEmail = TRUE; // Send email on update success
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
			$info_media->EventCancelled = TRUE; // Cancel event
			$info_media->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check inline edit key
	function CheckInlineEditKey() {
		global $info_media;

		//CheckInlineEditKey = True
		if (strval($info_media->getKey("id")) <> strval($info_media->id->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add Mode
	function InlineAddMode() {
		global $Security, $info_media;
		if ($info_media->CurrentAction == "copy") {
			if (@$_GET["id"] <> "") {
				$info_media->id->setQueryStringValue($_GET["id"]);
			} else {
				$info_media->CurrentAction = "add";
			}
		}
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to inline add/copy record
	function InlineInsert() {
		global $objForm, $gsFormError, $info_media;
		$objForm->Index = 1;
		$this->LoadFormValues(); // Get form values

		// Validate Form
		if (!$this->ValidateForm()) {
			$this->setMessage($gsFormError); // Set validation error message
			$info_media->EventCancelled = TRUE; // Set event cancelled
			$info_media->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$info_media->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow()) { // Add record
			$this->setMessage("Add succeeded"); // Set add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$info_media->EventCancelled = TRUE; // Set event cancelled
			$info_media->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Perform update to grid
	function GridUpdate() {
		global $conn, $objForm, $gsFormError, $info_media;
		$rowindex = 1;
		$bGridUpdate = TRUE;

		// Begin transaction
		$conn->BeginTrans();

		// Get old recordset
		$info_media->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $info_media->SQL();
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
					$info_media->SendEmail = FALSE; // Do not send email on update success
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
			$info_media->EventCancelled = TRUE; // Set event cancelled
			$info_media->CurrentAction = "gridedit"; // Stay in gridedit mode
		}
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $info_media;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $info_media->KeyFilter();
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
		global $info_media;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$info_media->id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($info_media->id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Grid Insert
	// Perform insert to grid
	function GridInsert() {
		global $conn, $objForm, $gsFormError, $info_media;
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
				$info_media->SendEmail = FALSE; // Do not send email on insert success

				// Validate Form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow(); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
					$sKey .= $info_media->id->CurrentValue;

					// Add filter for this record
					$sFilter = $info_media->KeyFilter();
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
			$info_media->CurrentFilter = $sWrkFilter;
			$sSql = $info_media->SQL();
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
			$info_media->EventCancelled = TRUE; // Set event cancelled
			$info_media->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
	}

	// Check if empty row
	function EmptyRow() {
		global $info_media;
		if ($info_media->code->CurrentValue <> $info_media->code->OldValue)
			return FALSE;
		return TRUE;
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm, $info_media;

		// Get row based on current index
		$objForm->Index = $idx;
		if ($info_media->CurrentAction == "gridadd")
			$this->LoadFormValues(); // Load form values
		if ($info_media->CurrentAction == "gridedit") {
			$sKey = strval($objForm->GetValue("k_key"));
			$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $sKey);
			if (count($arrKeyFlds) >= 1) {
				if (strval($arrKeyFlds[0]) == strval($info_media->id->CurrentValue)) {
					$this->LoadFormValues(); // Load form values
				}
			}
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $info_media;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $info_media->id, FALSE); // Field id
		$this->BuildSearchSql($sWhere, $info_media->code, FALSE); // Field code
		$this->BuildSearchSql($sWhere, $info_media->link, FALSE); // Field link

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($info_media->id); // Field id
			$this->SetSearchParm($info_media->code); // Field code
			$this->SetSearchParm($info_media->link); // Field link
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
		global $info_media;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$info_media->setAdvancedSearch("x_$FldParm", $FldVal);
		$info_media->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$info_media->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$info_media->setAdvancedSearch("y_$FldParm", $FldVal2);
		$info_media->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $info_media;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $info_media->code->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $info_media->link->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $info_media;
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
			$info_media->setBasicSearchKeyword($sSearchKeyword);
			$info_media->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $info_media;
		$this->sSrchWhere = "";
		$info_media->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $info_media;
		$info_media->setBasicSearchKeyword("");
		$info_media->setBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $info_media;
		$info_media->setAdvancedSearch("x_id", "");
		$info_media->setAdvancedSearch("x_code", "");
		$info_media->setAdvancedSearch("x_link", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $info_media;
		$this->sSrchWhere = $info_media->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $info_media;
		 $info_media->id->AdvancedSearch->SearchValue = $info_media->getAdvancedSearch("x_id");
		 $info_media->code->AdvancedSearch->SearchValue = $info_media->getAdvancedSearch("x_code");
		 $info_media->link->AdvancedSearch->SearchValue = $info_media->getAdvancedSearch("x_link");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $info_media;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$info_media->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$info_media->CurrentOrderType = @$_GET["ordertype"];
			$info_media->UpdateSort($info_media->id); // Field 
			$info_media->UpdateSort($info_media->code); // Field 
			$info_media->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $info_media;
		$sOrderBy = $info_media->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($info_media->SqlOrderBy() <> "") {
				$sOrderBy = $info_media->SqlOrderBy();
				$info_media->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $info_media;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$info_media->setSessionOrderBy($sOrderBy);
				$info_media->id->setSort("");
				$info_media->code->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$info_media->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $info_media;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$info_media->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$info_media->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $info_media->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$info_media->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$info_media->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$info_media->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $info_media;
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $info_media;

		// Load search values
		// id

		$info_media->id->AdvancedSearch->SearchValue = @$_GET["x_id"];
		$info_media->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// code
		$info_media->code->AdvancedSearch->SearchValue = @$_GET["x_code"];
		$info_media->code->AdvancedSearch->SearchOperator = @$_GET["z_code"];

		// link
		$info_media->link->AdvancedSearch->SearchValue = @$_GET["x_link"];
		$info_media->link->AdvancedSearch->SearchOperator = @$_GET["z_link"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $info_media;
		$info_media->id->setFormValue($objForm->GetValue("x_id"));
		$info_media->id->OldValue = $objForm->GetValue("o_id");
		$info_media->code->setFormValue($objForm->GetValue("x_code"));
		$info_media->code->OldValue = $objForm->GetValue("o_code");
	}

	// Restore form values
	function RestoreFormValues() {
		global $info_media;
		$info_media->id->CurrentValue = $info_media->id->FormValue;
		$info_media->code->CurrentValue = $info_media->code->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $info_media;

		// Call Recordset Selecting event
		$info_media->Recordset_Selecting($info_media->CurrentFilter);

		// Load list page SQL
		$sSql = $info_media->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$info_media->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $info_media;
		$sFilter = $info_media->KeyFilter();

		// Call Row Selecting event
		$info_media->Row_Selecting($sFilter);

		// Load sql based on filter
		$info_media->CurrentFilter = $sFilter;
		$sSql = $info_media->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$info_media->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $info_media;
		$info_media->id->setDbValue($rs->fields('id'));
		$info_media->code->setDbValue($rs->fields('code'));
		$info_media->link->setDbValue($rs->fields('link'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $info_media;

		// Call Row_Rendering event
		$info_media->Row_Rendering();

		// Common render codes for all row types
		// id

		$info_media->id->CellCssStyle = "";
		$info_media->id->CellCssClass = "";

		// code
		$info_media->code->CellCssStyle = "";
		$info_media->code->CellCssClass = "";
		if ($info_media->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$info_media->id->ViewValue = $info_media->id->CurrentValue;
			$info_media->id->CssStyle = "";
			$info_media->id->CssClass = "";
			$info_media->id->ViewCustomAttributes = "";

			// code
			$info_media->code->ViewValue = $info_media->code->CurrentValue;
			if ($info_media->Export == "")
				$info_media->code->ViewValue = ew_Highlight($info_media->HighlightName(), $info_media->code->ViewValue, $info_media->getBasicSearchKeyword(), $info_media->getBasicSearchType(), $info_media->getAdvancedSearch("x_code"));
			$info_media->code->CssStyle = "";
			$info_media->code->CssClass = "";
			$info_media->code->ViewCustomAttributes = "";

			// link
			$info_media->link->ViewValue = $info_media->link->CurrentValue;
			if ($info_media->Export == "")
				$info_media->link->ViewValue = ew_Highlight($info_media->HighlightName(), $info_media->link->ViewValue, $info_media->getBasicSearchKeyword(), $info_media->getBasicSearchType(), $info_media->getAdvancedSearch("x_link"));
			$info_media->link->CssStyle = "";
			$info_media->link->CssClass = "";
			$info_media->link->ViewCustomAttributes = "";

			// id
			$info_media->id->HrefValue = "";

			// code
			$info_media->code->HrefValue = "";
		} elseif ($info_media->RowType == EW_ROWTYPE_ADD) { // Add row

			// id
			// code

			$info_media->code->EditCustomAttributes = "";
			$info_media->code->EditValue = ew_HtmlEncode($info_media->code->CurrentValue);
		} elseif ($info_media->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$info_media->id->EditCustomAttributes = "";
			$info_media->id->EditValue = $info_media->id->CurrentValue;
			$info_media->id->CssStyle = "";
			$info_media->id->CssClass = "";
			$info_media->id->ViewCustomAttributes = "";

			// code
			$info_media->code->EditCustomAttributes = "";
			$info_media->code->EditValue = ew_HtmlEncode($info_media->code->CurrentValue);

			// Edit refer script
			// id

			$info_media->id->HrefValue = "";

			// code
			$info_media->code->HrefValue = "";
		}

		// Call Row Rendered event
		$info_media->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $info_media;

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
		global $gsFormError, $info_media;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($info_media->code->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - code";
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
		global $conn, $Security, $info_media;
		$sFilter = $info_media->KeyFilter();
		$info_media->CurrentFilter = $sFilter;
		$sSql = $info_media->SQL();
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
			// Field code

			$info_media->code->SetDbValueDef($info_media->code->CurrentValue, "");
			$rsnew['code'] =& $info_media->code->DbValue;

			// Call Row Updating event
			$bUpdateRow = $info_media->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($info_media->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($info_media->CancelMessage <> "") {
					$this->setMessage($info_media->CancelMessage);
					$info_media->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$info_media->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow() {
		global $conn, $Security, $info_media;
		$rsnew = array();

		// Field id
		// Field code

		$info_media->code->SetDbValueDef($info_media->code->CurrentValue, "");
		$rsnew['code'] =& $info_media->code->DbValue;

		// Call Row Inserting event
		$bInsertRow = $info_media->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($info_media->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($info_media->CancelMessage <> "") {
				$this->setMessage($info_media->CancelMessage);
				$info_media->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$info_media->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $info_media->id->DbValue;

			// Call Row Inserted event
			$info_media->Row_Inserted($rsnew);
		}
		return $AddRow;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $info_media;
		$info_media->id->AdvancedSearch->SearchValue = $info_media->getAdvancedSearch("x_id");
		$info_media->code->AdvancedSearch->SearchValue = $info_media->getAdvancedSearch("x_code");
		$info_media->link->AdvancedSearch->SearchValue = $info_media->getAdvancedSearch("x_link");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $info_media;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($info_media->ExportAll) {
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
		if ($info_media->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo "\xEF\xBB\xBF";
			echo ew_ExportHeader($info_media->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $info_media->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id', $info_media->Export);
				ew_ExportAddValue($sExportStr, 'code', $info_media->Export);
				ew_ExportAddValue($sExportStr, 'link', $info_media->Export);
				echo ew_ExportLine($sExportStr, $info_media->Export);
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
				$info_media->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($info_media->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id', $info_media->id->CurrentValue);
					$XmlDoc->AddField('code', $info_media->code->CurrentValue);
					$XmlDoc->AddField('link', $info_media->link->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $info_media->Export <> "csv") { // Vertical format
						echo ew_ExportField('id', $info_media->id->ExportValue($info_media->Export, $info_media->ExportOriginalValue), $info_media->Export);
						echo ew_ExportField('code', $info_media->code->ExportValue($info_media->Export, $info_media->ExportOriginalValue), $info_media->Export);
						echo ew_ExportField('link', $info_media->link->ExportValue($info_media->Export, $info_media->ExportOriginalValue), $info_media->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $info_media->id->ExportValue($info_media->Export, $info_media->ExportOriginalValue), $info_media->Export);
						ew_ExportAddValue($sExportStr, $info_media->code->ExportValue($info_media->Export, $info_media->ExportOriginalValue), $info_media->Export);
						ew_ExportAddValue($sExportStr, $info_media->link->ExportValue($info_media->Export, $info_media->ExportOriginalValue), $info_media->Export);
						echo ew_ExportLine($sExportStr, $info_media->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($info_media->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($info_media->Export);
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
