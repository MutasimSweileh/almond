<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "staticinfo.php" ?>
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
$static_list = new cstatic_list();
$Page =& $static_list;

// Page init processing
$static_list->Page_Init();

// Page main processing
$static_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($static->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var static_list = new ew_Page("static_list");

// page properties
static_list.PageID = "list"; // page ID
var EW_PAGE_ID = static_list.PageID; // for backward compatibility

// extend page with ValidateForm function
static_list.ValidateForm = function(fobj) {
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
static_list.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "code")) return false;
	return true;
}

// extend page with Form_CustomValidate function
static_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
static_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
static_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
static_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
static_list.ShowHighlightText = "Show highlight"; 
static_list.HideHighlightText = "Hide highlight";

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
<?php if ($static->Export == "") { ?>
<?php } ?>
<?php
if ($static->CurrentAction == "gridadd")
	$static->CurrentFilter = "0=1";
if ($static->CurrentAction == "gridadd") {
	$static_list->lStartRec = 1;
	if ($static_list->lDisplayRecs <= 0)
		$static_list->lDisplayRecs = 20;
	$static_list->lTotalRecs = $static_list->lDisplayRecs;
	$static_list->lStopRec = $static_list->lDisplayRecs;
} else {
	$bSelectLimit = ($static->Export == "" && $static->SelectLimit);
	if (!$bSelectLimit)
		$rs = $static_list->LoadRecordset();
	$static_list->lTotalRecs = ($bSelectLimit) ? $static->SelectRecordCount() : $rs->RecordCount();
	$static_list->lStartRec = 1;
	if ($static_list->lDisplayRecs <= 0) // Display all records
		$static_list->lDisplayRecs = $static_list->lTotalRecs;
	if (!($static->ExportAll && $static->Export <> ""))
		$static_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $static_list->LoadRecordset($static_list->lStartRec-1, $static_list->lDisplayRecs);
}
?>
<p><span class="phpmaker" style="white-space: nowrap;">TABLE: static
<?php if ($static->Export == "" && $static->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $static_list->PageUrl() ?>export=print">Printer Friendly</a>
&nbsp;&nbsp;<a href="<?php echo $static_list->PageUrl() ?>export=html">Export to HTML</a>
&nbsp;&nbsp;<a href="<?php echo $static_list->PageUrl() ?>export=excel">Export to Excel</a>
&nbsp;&nbsp;<a href="<?php echo $static_list->PageUrl() ?>export=word">Export to Word</a>
&nbsp;&nbsp;<a href="<?php echo $static_list->PageUrl() ?>export=xml">Export to XML</a>
&nbsp;&nbsp;<a href="<?php echo $static_list->PageUrl() ?>export=csv">Export to CSV</a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($static->Export == "" && $static->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(static_list);" style="text-decoration: none;"><img id="static_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="static_list_SearchPanel">
<form name="fstaticlistsrch" id="fstaticlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="static">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($static->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Search (*)">&nbsp;
			<a href="<?php echo $static_list->PageUrl() ?>cmd=reset">Show all</a>&nbsp;
			<a href="staticsrch.php">Advanced Search</a>&nbsp;
			<?php if ($static_list->sSrchWhere <> "" && $static_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(static_list, this, '<?php echo $static->HighlightName() ?>');">Hide highlight</a>
			<?php } ?>
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($static->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>Exact phrase</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($static->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>All words</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($static->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>Any word</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $static_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($static->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($static->CurrentAction <> "gridadd" && $static->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($static_list->Pager)) $static_list->Pager = new cPrevNextPager($static_list->lStartRec, $static_list->lDisplayRecs, $static_list->lTotalRecs) ?>
<?php if ($static_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($static_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $static_list->PageUrl() ?>start=<?php echo $static_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($static_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $static_list->PageUrl() ?>start=<?php echo $static_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $static_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($static_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $static_list->PageUrl() ?>start=<?php echo $static_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($static_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $static_list->PageUrl() ?>start=<?php echo $static_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $static_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $static_list->Pager->FromIndex ?> to <?php echo $static_list->Pager->ToIndex ?> of <?php echo $static_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($static_list->sSrchWhere == "0=101") { ?>
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
<?php if ($static->CurrentAction <> "gridadd" && $static->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $static->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<a href="<?php echo $static_list->PageUrl() ?>a=add">Inline Add</a>&nbsp;&nbsp;
<a href="<?php echo $static_list->PageUrl() ?>a=gridadd">Grid Add</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($static_list->lTotalRecs > 0) { ?>
<a href="<?php echo $static_list->PageUrl() ?>a=gridedit">Grid Edit</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if ($static_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fstaticlist)) alert('No records selected'); else if (ew_Confirm('<?php echo $static_list->sDeleteConfirmMsg ?>')) {document.fstaticlist.action='staticdelete.php';document.fstaticlist.encoding='application/x-www-form-urlencoded';document.fstaticlist.submit();};return false;">Delete Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fstaticlist)) alert('No records selected'); else {document.fstaticlist.action='staticupdate.php';document.fstaticlist.encoding='application/x-www-form-urlencoded';document.fstaticlist.submit();};return false;">Update Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($static->CurrentAction == "gridadd") { ?>
<a href="" onclick="if (static_list.ValidateForm(document.fstaticlist)) document.fstaticlist.submit();return false;">Insert</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($static->CurrentAction == "gridedit") { ?>
<a href="" onclick="if (static_list.ValidateForm(document.fstaticlist)) document.fstaticlist.submit();return false;">Save</a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php echo $static_list->PageUrl() ?>a=cancel">Cancel</a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fstaticlist" id="fstaticlist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="static">
<?php if ($static_list->lTotalRecs > 0 || $static->CurrentAction == "add" || $static->CurrentAction == "copy") { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$static_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$static_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$static_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$static_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$static_list->lOptionCnt++; // Multi-select
}
	$static_list->lOptionCnt += count($static_list->ListOptions->Items); // Custom list options
?>
<?php echo $static->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($static->id->Visible) { // id ?>
	<?php if ($static->SortUrl($static->id) == "") { ?>
		<td>id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $static->SortUrl($static->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>id</td><td style="width: 10px;"><?php if ($static->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($static->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($static->code->Visible) { // code ?>
	<?php if ($static->SortUrl($static->code) == "") { ?>
		<td>code</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $static->SortUrl($static->code) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>code&nbsp;(*)</td><td style="width: 10px;"><?php if ($static->code->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($static->code->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($static->Export == "") { ?>
<?php if ($static->CurrentAction <> "gridadd" && $static->CurrentAction <> "gridedit") { ?>
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
<?php if ($static_list->lOptionCnt == 0 && $static->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="phpmaker" onclick="static_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($static_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
</thead>
<?php
	if ($static->CurrentAction == "add" || $static->CurrentAction == "copy") {
		$static_list->lRowIndex = 1;
		if ($static->CurrentAction == "copy" && !$static_list->LoadRow())
				$static->CurrentAction = "add";
		if ($static->CurrentAction == "add")
			$static_list->LoadDefaultValues();
		if ($static->EventCancelled) // Insert failed
			$static_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$static->CssClass = "ewTableEditRow";
		$static->CssStyle = "";
		$static->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
		$static->RowType = EW_ROWTYPE_ADD;

		// Render row
		$static_list->RenderRow();
?>
	<tr<?php echo $static->RowAttributes() ?>>
	<?php if ($static->id->Visible) { // id ?>
		<td>&nbsp;</td>
	<?php } ?>
	<?php if ($static->code->Visible) { // code ?>
		<td>
<input type="text" name="x<?php echo $static_list->lRowIndex ?>_code" id="x<?php echo $static_list->lRowIndex ?>_code" size="30" maxlength="100" value="<?php echo $static->code->EditValue ?>"<?php echo $static->code->EditAttributes() ?>>
</td>
	<?php } ?>
<td colspan="<?php echo $static_list->lOptionCnt ?>"><span class="phpmaker">
<a href="" onclick="if (static_list.ValidateForm(document.fstaticlist)) document.fstaticlist.submit();return false;">Insert</a>&nbsp;<a href="<?php echo $static_list->PageUrl() ?>a=cancel">Cancel</a>
<input type="hidden" name="a_list" id="a_list" value="insert">
</span></td>
	</tr>
<?php
}
?>
<?php
if ($static->ExportAll && $static->Export <> "") {
	$static_list->lStopRec = $static_list->lTotalRecs;
} else {
	$static_list->lStopRec = $static_list->lStartRec + $static_list->lDisplayRecs - 1; // Set the last record to display
}
$static_list->lRecCount = $static_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$static->SelectLimit && $static_list->lStartRec > 1)
		$rs->Move($static_list->lStartRec - 1);
}
$static_list->lRowCnt = 0;
$static_list->lEditRowCnt = 0;
if ($static->CurrentAction == "edit")
	$static_list->lRowIndex = 1;
if ($static->CurrentAction == "gridadd")
	$static_list->lRowIndex = 0;
if ($static->CurrentAction == "gridedit")
	$static_list->lRowIndex = 0;
while (($static->CurrentAction == "gridadd" || !$rs->EOF) &&
	$static_list->lRecCount < $static_list->lStopRec) {
	$static_list->lRecCount++;
	if (intval($static_list->lRecCount) >= intval($static_list->lStartRec)) {
		$static_list->lRowCnt++;
		if ($static->CurrentAction == "gridadd" || $static->CurrentAction == "gridedit")
			$static_list->lRowIndex++;

	// Init row class and style
	$static->CssClass = "";
	$static->CssStyle = "";
	$static->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($static->CurrentAction == "gridadd") {
		$static_list->LoadDefaultValues(); // Load default values
	} else {
		$static_list->LoadRowValues($rs); // Load row values
	}
	$static->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($static->CurrentAction == "gridadd") // Grid add
		$static->RowType = EW_ROWTYPE_ADD; // Render add
	if ($static->CurrentAction == "gridadd" && $static->EventCancelled) // Insert failed
		$static_list->RestoreCurrentRowFormValues($static_list->lRowIndex); // Restore form values
	if ($static->CurrentAction == "edit") {
		if ($static_list->CheckInlineEditKey() && $static_list->lEditRowCnt == 0) // Inline edit
			$static->RowType = EW_ROWTYPE_EDIT; // Render edit
	}
	if ($static->CurrentAction == "gridedit") // Grid edit
		$static->RowType = EW_ROWTYPE_EDIT; // Render edit
	if ($static->RowType == EW_ROWTYPE_EDIT && $static->EventCancelled) { // Update failed
		if ($static->CurrentAction == "edit")
			$static_list->RestoreFormValues(); // Restore form values
		if ($static->CurrentAction == "gridedit")
			$static_list->RestoreCurrentRowFormValues($static_list->lRowIndex); // Restore form values
	}
	if ($static->RowType == EW_ROWTYPE_EDIT) { // Edit row
		$static_list->lEditRowCnt++;
		$static->RowClientEvents = "onmouseover='this.edit=true;ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	}
	if ($static->RowType == EW_ROWTYPE_ADD || $static->RowType == EW_ROWTYPE_EDIT) // Add / Edit row
			$static->CssClass = "ewTableEditRow";

	// Render row
	$static_list->RenderRow();
?>
	<tr<?php echo $static->RowAttributes() ?>>
	<?php if ($static->id->Visible) { // id ?>
		<td<?php echo $static->id->CellAttributes() ?>>
<?php if ($static->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $static_list->lRowIndex ?>_id" id="o<?php echo $static_list->lRowIndex ?>_id" value="<?php echo ew_HtmlEncode($static->id->OldValue) ?>">
<?php } ?>
<?php if ($static->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $static->id->ViewAttributes() ?>><?php echo $static->id->EditValue ?></div><input type="hidden" name="x<?php echo $static_list->lRowIndex ?>_id" id="x<?php echo $static_list->lRowIndex ?>_id" value="<?php echo ew_HtmlEncode($static->id->CurrentValue) ?>">
<?php } ?>
<?php if ($static->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $static->id->ViewAttributes() ?>><?php echo $static->id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($static->code->Visible) { // code ?>
		<td<?php echo $static->code->CellAttributes() ?>>
<?php if ($static->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $static_list->lRowIndex ?>_code" id="x<?php echo $static_list->lRowIndex ?>_code" size="30" maxlength="100" value="<?php echo $static->code->EditValue ?>"<?php echo $static->code->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $static_list->lRowIndex ?>_code" id="o<?php echo $static_list->lRowIndex ?>_code" value="<?php echo ew_HtmlEncode($static->code->OldValue) ?>">
<?php } ?>
<?php if ($static->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $static_list->lRowIndex ?>_code" id="x<?php echo $static_list->lRowIndex ?>_code" size="30" maxlength="100" value="<?php echo $static->code->EditValue ?>"<?php echo $static->code->EditAttributes() ?>>
<?php } ?>
<?php if ($static->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $static->code->ViewAttributes() ?>><?php echo $static->code->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php if ($static->RowType == EW_ROWTYPE_ADD || $static->RowType == EW_ROWTYPE_EDIT) { ?>
<?php if ($static->CurrentAction == "edit") { ?>
<td colspan="<?php echo $static_list->lOptionCnt ?>"><span class="phpmaker">
<a href="" onclick="if (static_list.ValidateForm(document.fstaticlist)) document.fstaticlist.submit();return false;">Update</a>&nbsp;<a href="<?php echo $static_list->PageUrl() ?>a=cancel">Cancel</a>
<input type="hidden" name="a_list" id="a_list" value="update">
</span></td>
<?php } ?>
<?php
	if ($static->CurrentAction == "gridedit")
		$static_list->sMultiSelectKey .= "<input type=\"hidden\" name=\"k" . $static_list->lRowIndex . "_key\" id=\"k" . $static_list->lRowIndex . "_key\" value=\"" . $static->id->CurrentValue . "\">";
?>
<?php } else { ?>
<?php if ($static->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $static->ViewUrl() ?>">View</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $static->EditUrl() ?>">Edit</a><span class="ewSeparator">&nbsp;|&nbsp;</span><a href="<?php echo $static->InlineEditUrl() ?>">Inline Edit</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $static->CopyUrl() ?>">Copy</a><span class="ewSeparator">&nbsp;|&nbsp;</span><a href="<?php echo $static->InlineCopyUrl() ?>">Inline Copy</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($static_list->lOptionCnt == 0 && $static->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($static->id->CurrentValue) ?>" class="phpmaker" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($static_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
<?php if ($static->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($static->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($static->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($static->CurrentAction == "add" || $static->CurrentAction == "copy") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $static_list->lRowIndex ?>">
<?php } ?>
<?php if ($static->CurrentAction == "gridadd") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $static_list->lRowIndex ?>">
<?php } ?>
<?php if ($static->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $static_list->lRowIndex ?>">
<?php } ?>
<?php if ($static->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $static_list->lRowIndex ?>">
<?php echo $static_list->sMultiSelectKey ?>
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
<?php if ($static_list->lTotalRecs > 0) { ?>
<?php if ($static->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($static->CurrentAction <> "gridadd" && $static->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($static_list->Pager)) $static_list->Pager = new cPrevNextPager($static_list->lStartRec, $static_list->lDisplayRecs, $static_list->lTotalRecs) ?>
<?php if ($static_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($static_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $static_list->PageUrl() ?>start=<?php echo $static_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($static_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $static_list->PageUrl() ?>start=<?php echo $static_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $static_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($static_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $static_list->PageUrl() ?>start=<?php echo $static_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($static_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $static_list->PageUrl() ?>start=<?php echo $static_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $static_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $static_list->Pager->FromIndex ?> to <?php echo $static_list->Pager->ToIndex ?> of <?php echo $static_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($static_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($static_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($static->CurrentAction <> "gridadd" && $static->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $static->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<a href="<?php echo $static_list->PageUrl() ?>a=add">Inline Add</a>&nbsp;&nbsp;
<a href="<?php echo $static_list->PageUrl() ?>a=gridadd">Grid Add</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($static_list->lTotalRecs > 0) { ?>
<a href="<?php echo $static_list->PageUrl() ?>a=gridedit">Grid Edit</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if ($static_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fstaticlist)) alert('No records selected'); else if (ew_Confirm('<?php echo $static_list->sDeleteConfirmMsg ?>')) {document.fstaticlist.action='staticdelete.php';document.fstaticlist.encoding='application/x-www-form-urlencoded';document.fstaticlist.submit();};return false;">Delete Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fstaticlist)) alert('No records selected'); else {document.fstaticlist.action='staticupdate.php';document.fstaticlist.encoding='application/x-www-form-urlencoded';document.fstaticlist.submit();};return false;">Update Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($static->CurrentAction == "gridadd") { ?>
<a href="" onclick="if (static_list.ValidateForm(document.fstaticlist)) document.fstaticlist.submit();return false;">Insert</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($static->CurrentAction == "gridedit") { ?>
<a href="" onclick="if (static_list.ValidateForm(document.fstaticlist)) document.fstaticlist.submit();return false;">Save</a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php echo $static_list->PageUrl() ?>a=cancel">Cancel</a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($static->Export == "" && $static->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(static_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($static->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$static_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class cstatic_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'static';

	// Page Object Name
	var $PageObjName = 'static_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $static;
		if ($static->UseTokenInUrl) $PageUrl .= "t=" . $static->TableVar . "&"; // add page token
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
		global $objForm, $static;
		if ($static->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($static->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($static->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cstatic_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["static"] = new cstatic();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'static', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $static;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$static->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $static->Export; // Get export parameter, used in header
	$gsExportFile = $static->TableVar; // Get export file, used in header
	if ($static->Export == "print" || $static->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($static->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($static->Export == "word") {
		header('Content-Type: application/vnd.ms-word;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($static->Export == "xml") {
		header('Content-Type: text/xml;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($static->Export == "csv") {
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
		global $objForm, $gsSearchError, $Security, $static;
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
				$static->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($static->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to grid edit mode
				if ($static->CurrentAction == "gridedit")
					$this->GridEditMode();

				// Switch to inline edit mode
				if ($static->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($static->CurrentAction == "add" || $static->CurrentAction == "copy")
					$this->InlineAddMode();

				// Switch to grid add mode
				if ($static->CurrentAction == "gridadd")
					$this->GridAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$static->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Update
					if ($static->CurrentAction == "gridupdate" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridedit")
						$this->GridUpdate();

					// Inline Update
					if ($static->CurrentAction == "update" && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($static->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
						$this->InlineInsert();

					// Grid Insert
					if ($static->CurrentAction == "gridinsert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridadd")
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
		if ($static->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $static->getRecordsPerPage(); // Restore from Session
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
		$static->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$static->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$static->setStartRecordNumber($this->lStartRec);
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
		$static->setSessionWhere($sFilter);
		$static->CurrentFilter = "";

		// Export data only
		if (in_array($static->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	//  Exit out of inline mode
	function ClearInlineMode() {
		global $static;
		$static->setKey("id", ""); // Clear inline edit key
		$static->CurrentAction = ""; // Clear action
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
		global $Security, $static;
		$bInlineEdit = TRUE;
		if (@$_GET["id"] <> "") {
			$static->id->setQueryStringValue($_GET["id"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$static->setKey("id", $static->id->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to inline edit record
	function InlineUpdate() {
		global $objForm, $gsFormError, $static;
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
				$static->SendEmail = TRUE; // Send email on update success
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
			$static->EventCancelled = TRUE; // Cancel event
			$static->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check inline edit key
	function CheckInlineEditKey() {
		global $static;

		//CheckInlineEditKey = True
		if (strval($static->getKey("id")) <> strval($static->id->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add Mode
	function InlineAddMode() {
		global $Security, $static;
		if ($static->CurrentAction == "copy") {
			if (@$_GET["id"] <> "") {
				$static->id->setQueryStringValue($_GET["id"]);
			} else {
				$static->CurrentAction = "add";
			}
		}
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to inline add/copy record
	function InlineInsert() {
		global $objForm, $gsFormError, $static;
		$objForm->Index = 1;
		$this->LoadFormValues(); // Get form values

		// Validate Form
		if (!$this->ValidateForm()) {
			$this->setMessage($gsFormError); // Set validation error message
			$static->EventCancelled = TRUE; // Set event cancelled
			$static->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$static->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow()) { // Add record
			$this->setMessage("Add succeeded"); // Set add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$static->EventCancelled = TRUE; // Set event cancelled
			$static->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Perform update to grid
	function GridUpdate() {
		global $conn, $objForm, $gsFormError, $static;
		$rowindex = 1;
		$bGridUpdate = TRUE;

		// Begin transaction
		$conn->BeginTrans();

		// Get old recordset
		$static->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $static->SQL();
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
					$static->SendEmail = FALSE; // Do not send email on update success
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
			$static->EventCancelled = TRUE; // Set event cancelled
			$static->CurrentAction = "gridedit"; // Stay in gridedit mode
		}
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $static;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $static->KeyFilter();
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
		global $static;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$static->id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($static->id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Grid Insert
	// Perform insert to grid
	function GridInsert() {
		global $conn, $objForm, $gsFormError, $static;
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
				$static->SendEmail = FALSE; // Do not send email on insert success

				// Validate Form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow(); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
					$sKey .= $static->id->CurrentValue;

					// Add filter for this record
					$sFilter = $static->KeyFilter();
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
			$static->CurrentFilter = $sWrkFilter;
			$sSql = $static->SQL();
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
			$static->EventCancelled = TRUE; // Set event cancelled
			$static->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
	}

	// Check if empty row
	function EmptyRow() {
		global $static;
		if ($static->code->CurrentValue <> $static->code->OldValue)
			return FALSE;
		return TRUE;
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm, $static;

		// Get row based on current index
		$objForm->Index = $idx;
		if ($static->CurrentAction == "gridadd")
			$this->LoadFormValues(); // Load form values
		if ($static->CurrentAction == "gridedit") {
			$sKey = strval($objForm->GetValue("k_key"));
			$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $sKey);
			if (count($arrKeyFlds) >= 1) {
				if (strval($arrKeyFlds[0]) == strval($static->id->CurrentValue)) {
					$this->LoadFormValues(); // Load form values
				}
			}
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $static;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $static->id, FALSE); // Field id
		$this->BuildSearchSql($sWhere, $static->code, FALSE); // Field code
		$this->BuildSearchSql($sWhere, $static->english, FALSE); // Field english
		$this->BuildSearchSql($sWhere, $static->arabic, FALSE); // Field arabic

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($static->id); // Field id
			$this->SetSearchParm($static->code); // Field code
			$this->SetSearchParm($static->english); // Field english
			$this->SetSearchParm($static->arabic); // Field arabic
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
		global $static;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$static->setAdvancedSearch("x_$FldParm", $FldVal);
		$static->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$static->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$static->setAdvancedSearch("y_$FldParm", $FldVal2);
		$static->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $static;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $static->code->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $static->english->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $static->arabic->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $static;
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
			$static->setBasicSearchKeyword($sSearchKeyword);
			$static->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $static;
		$this->sSrchWhere = "";
		$static->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $static;
		$static->setBasicSearchKeyword("");
		$static->setBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $static;
		$static->setAdvancedSearch("x_id", "");
		$static->setAdvancedSearch("x_code", "");
		$static->setAdvancedSearch("x_english", "");
		$static->setAdvancedSearch("x_arabic", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $static;
		$this->sSrchWhere = $static->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $static;
		 $static->id->AdvancedSearch->SearchValue = $static->getAdvancedSearch("x_id");
		 $static->code->AdvancedSearch->SearchValue = $static->getAdvancedSearch("x_code");
		 $static->english->AdvancedSearch->SearchValue = $static->getAdvancedSearch("x_english");
		 $static->arabic->AdvancedSearch->SearchValue = $static->getAdvancedSearch("x_arabic");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $static;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$static->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$static->CurrentOrderType = @$_GET["ordertype"];
			$static->UpdateSort($static->id); // Field 
			$static->UpdateSort($static->code); // Field 
			$static->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $static;
		$sOrderBy = $static->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($static->SqlOrderBy() <> "") {
				$sOrderBy = $static->SqlOrderBy();
				$static->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $static;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$static->setSessionOrderBy($sOrderBy);
				$static->id->setSort("");
				$static->code->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$static->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $static;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$static->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$static->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $static->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$static->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$static->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$static->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $static;
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $static;

		// Load search values
		// id

		$static->id->AdvancedSearch->SearchValue = @$_GET["x_id"];
		$static->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// code
		$static->code->AdvancedSearch->SearchValue = @$_GET["x_code"];
		$static->code->AdvancedSearch->SearchOperator = @$_GET["z_code"];

		// english
		$static->english->AdvancedSearch->SearchValue = @$_GET["x_english"];
		$static->english->AdvancedSearch->SearchOperator = @$_GET["z_english"];

		// arabic
		$static->arabic->AdvancedSearch->SearchValue = @$_GET["x_arabic"];
		$static->arabic->AdvancedSearch->SearchOperator = @$_GET["z_arabic"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $static;
		$static->id->setFormValue($objForm->GetValue("x_id"));
		$static->id->OldValue = $objForm->GetValue("o_id");
		$static->code->setFormValue($objForm->GetValue("x_code"));
		$static->code->OldValue = $objForm->GetValue("o_code");
	}

	// Restore form values
	function RestoreFormValues() {
		global $static;
		$static->id->CurrentValue = $static->id->FormValue;
		$static->code->CurrentValue = $static->code->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $static;

		// Call Recordset Selecting event
		$static->Recordset_Selecting($static->CurrentFilter);

		// Load list page SQL
		$sSql = $static->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$static->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $static;
		$sFilter = $static->KeyFilter();

		// Call Row Selecting event
		$static->Row_Selecting($sFilter);

		// Load sql based on filter
		$static->CurrentFilter = $sFilter;
		$sSql = $static->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$static->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $static;
		$static->id->setDbValue($rs->fields('id'));
		$static->code->setDbValue($rs->fields('code'));
		$static->english->setDbValue($rs->fields('english'));
		$static->arabic->setDbValue($rs->fields('arabic'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $static;

		// Call Row_Rendering event
		$static->Row_Rendering();

		// Common render codes for all row types
		// id

		$static->id->CellCssStyle = "";
		$static->id->CellCssClass = "";

		// code
		$static->code->CellCssStyle = "";
		$static->code->CellCssClass = "";
		if ($static->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$static->id->ViewValue = $static->id->CurrentValue;
			$static->id->CssStyle = "";
			$static->id->CssClass = "";
			$static->id->ViewCustomAttributes = "";

			// code
			$static->code->ViewValue = $static->code->CurrentValue;
			if ($static->Export == "")
				$static->code->ViewValue = ew_Highlight($static->HighlightName(), $static->code->ViewValue, $static->getBasicSearchKeyword(), $static->getBasicSearchType(), $static->getAdvancedSearch("x_code"));
			$static->code->CssStyle = "";
			$static->code->CssClass = "";
			$static->code->ViewCustomAttributes = "";

			// english
			$static->english->ViewValue = $static->english->CurrentValue;
			if ($static->Export == "")
				$static->english->ViewValue = ew_Highlight($static->HighlightName(), $static->english->ViewValue, $static->getBasicSearchKeyword(), $static->getBasicSearchType(), $static->getAdvancedSearch("x_english"));
			$static->english->CssStyle = "";
			$static->english->CssClass = "";
			$static->english->ViewCustomAttributes = "";

			// arabic
			$static->arabic->ViewValue = $static->arabic->CurrentValue;
			if ($static->Export == "")
				$static->arabic->ViewValue = ew_Highlight($static->HighlightName(), $static->arabic->ViewValue, $static->getBasicSearchKeyword(), $static->getBasicSearchType(), $static->getAdvancedSearch("x_arabic"));
			$static->arabic->CssStyle = "";
			$static->arabic->CssClass = "";
			$static->arabic->ViewCustomAttributes = "";

			// id
			$static->id->HrefValue = "";

			// code
			$static->code->HrefValue = "";
		} elseif ($static->RowType == EW_ROWTYPE_ADD) { // Add row

			// id
			// code

			$static->code->EditCustomAttributes = "";
			$static->code->EditValue = ew_HtmlEncode($static->code->CurrentValue);
		} elseif ($static->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$static->id->EditCustomAttributes = "";
			$static->id->EditValue = $static->id->CurrentValue;
			$static->id->CssStyle = "";
			$static->id->CssClass = "";
			$static->id->ViewCustomAttributes = "";

			// code
			$static->code->EditCustomAttributes = "";
			$static->code->EditValue = ew_HtmlEncode($static->code->CurrentValue);

			// Edit refer script
			// id

			$static->id->HrefValue = "";

			// code
			$static->code->HrefValue = "";
		}

		// Call Row Rendered event
		$static->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $static;

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
		global $gsFormError, $static;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($static->code->FormValue == "") {
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
		global $conn, $Security, $static;
		$sFilter = $static->KeyFilter();
		$static->CurrentFilter = $sFilter;
		$sSql = $static->SQL();
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

			$static->code->SetDbValueDef($static->code->CurrentValue, "");
			$rsnew['code'] =& $static->code->DbValue;

			// Call Row Updating event
			$bUpdateRow = $static->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($static->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($static->CancelMessage <> "") {
					$this->setMessage($static->CancelMessage);
					$static->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$static->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow() {
		global $conn, $Security, $static;
		$rsnew = array();

		// Field id
		// Field code

		$static->code->SetDbValueDef($static->code->CurrentValue, "");
		$rsnew['code'] =& $static->code->DbValue;

		// Call Row Inserting event
		$bInsertRow = $static->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($static->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($static->CancelMessage <> "") {
				$this->setMessage($static->CancelMessage);
				$static->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$static->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $static->id->DbValue;

			// Call Row Inserted event
			$static->Row_Inserted($rsnew);
		}
		return $AddRow;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $static;
		$static->id->AdvancedSearch->SearchValue = $static->getAdvancedSearch("x_id");
		$static->code->AdvancedSearch->SearchValue = $static->getAdvancedSearch("x_code");
		$static->english->AdvancedSearch->SearchValue = $static->getAdvancedSearch("x_english");
		$static->arabic->AdvancedSearch->SearchValue = $static->getAdvancedSearch("x_arabic");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $static;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($static->ExportAll) {
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
		if ($static->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo "\xEF\xBB\xBF";
			echo ew_ExportHeader($static->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $static->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id', $static->Export);
				ew_ExportAddValue($sExportStr, 'code', $static->Export);
				ew_ExportAddValue($sExportStr, 'english', $static->Export);
				ew_ExportAddValue($sExportStr, 'arabic', $static->Export);
				echo ew_ExportLine($sExportStr, $static->Export);
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
				$static->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($static->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id', $static->id->CurrentValue);
					$XmlDoc->AddField('code', $static->code->CurrentValue);
					$XmlDoc->AddField('english', $static->english->CurrentValue);
					$XmlDoc->AddField('arabic', $static->arabic->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $static->Export <> "csv") { // Vertical format
						echo ew_ExportField('id', $static->id->ExportValue($static->Export, $static->ExportOriginalValue), $static->Export);
						echo ew_ExportField('code', $static->code->ExportValue($static->Export, $static->ExportOriginalValue), $static->Export);
						echo ew_ExportField('english', $static->english->ExportValue($static->Export, $static->ExportOriginalValue), $static->Export);
						echo ew_ExportField('arabic', $static->arabic->ExportValue($static->Export, $static->ExportOriginalValue), $static->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $static->id->ExportValue($static->Export, $static->ExportOriginalValue), $static->Export);
						ew_ExportAddValue($sExportStr, $static->code->ExportValue($static->Export, $static->ExportOriginalValue), $static->Export);
						ew_ExportAddValue($sExportStr, $static->english->ExportValue($static->Export, $static->ExportOriginalValue), $static->Export);
						ew_ExportAddValue($sExportStr, $static->arabic->ExportValue($static->Export, $static->ExportOriginalValue), $static->Export);
						echo ew_ExportLine($sExportStr, $static->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($static->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($static->Export);
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
