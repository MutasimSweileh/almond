<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "clientsinfo.php" ?>
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
$clients_list = new cclients_list();
$Page =& $clients_list;

// Page init processing
$clients_list->Page_Init();

// Page main processing
$clients_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($clients->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var clients_list = new ew_Page("clients_list");

// page properties
clients_list.PageID = "list"; // page ID
var EW_PAGE_ID = clients_list.PageID; // for backward compatibility

// extend page with ValidateForm function
clients_list.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_image"];
		aelm = fobj.elements["a" + infix + "_image"];
		var chk_image = (aelm && aelm[0])?(aelm[2].checked):true;
		if (elm && chk_image && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - image");
		elm = fobj.elements["x" + infix + "_image"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, "File type is not allowed.");
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
clients_list.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "image")) return false;
	if (ew_ValueChanged(fobj, infix, "order")) return false;
	if (ew_ValueChanged(fobj, infix, "active")) return false;
	return true;
}

// extend page with Form_CustomValidate function
clients_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
clients_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
clients_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
clients_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
clients_list.ShowHighlightText = "Show highlight"; 
clients_list.HideHighlightText = "Hide highlight";

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
<?php if ($clients->Export == "") { ?>
<?php } ?>
<?php
if ($clients->CurrentAction == "gridadd")
	$clients->CurrentFilter = "0=1";
if ($clients->CurrentAction == "gridadd") {
	$clients_list->lStartRec = 1;
	if ($clients_list->lDisplayRecs <= 0)
		$clients_list->lDisplayRecs = 20;
	$clients_list->lTotalRecs = $clients_list->lDisplayRecs;
	$clients_list->lStopRec = $clients_list->lDisplayRecs;
} else {
	$bSelectLimit = ($clients->Export == "" && $clients->SelectLimit);
	if (!$bSelectLimit)
		$rs = $clients_list->LoadRecordset();
	$clients_list->lTotalRecs = ($bSelectLimit) ? $clients->SelectRecordCount() : $rs->RecordCount();
	$clients_list->lStartRec = 1;
	if ($clients_list->lDisplayRecs <= 0) // Display all records
		$clients_list->lDisplayRecs = $clients_list->lTotalRecs;
	if (!($clients->ExportAll && $clients->Export <> ""))
		$clients_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $clients_list->LoadRecordset($clients_list->lStartRec-1, $clients_list->lDisplayRecs);
}
?>
<p><span class="phpmaker" style="white-space: nowrap;">TABLE: clients
<?php if ($clients->Export == "" && $clients->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $clients_list->PageUrl() ?>export=print">Printer Friendly</a>
&nbsp;&nbsp;<a href="<?php echo $clients_list->PageUrl() ?>export=html">Export to HTML</a>
&nbsp;&nbsp;<a href="<?php echo $clients_list->PageUrl() ?>export=excel">Export to Excel</a>
&nbsp;&nbsp;<a href="<?php echo $clients_list->PageUrl() ?>export=word">Export to Word</a>
&nbsp;&nbsp;<a href="<?php echo $clients_list->PageUrl() ?>export=xml">Export to XML</a>
&nbsp;&nbsp;<a href="<?php echo $clients_list->PageUrl() ?>export=csv">Export to CSV</a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($clients->Export == "" && $clients->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(clients_list);" style="text-decoration: none;"><img id="clients_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="clients_list_SearchPanel">
<form name="fclientslistsrch" id="fclientslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="clients">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($clients->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Search (*)">&nbsp;
			<a href="<?php echo $clients_list->PageUrl() ?>cmd=reset">Show all</a>&nbsp;
			<a href="clientssrch.php">Advanced Search</a>&nbsp;
			<?php if ($clients_list->sSrchWhere <> "" && $clients_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(clients_list, this, '<?php echo $clients->HighlightName() ?>');">Hide highlight</a>
			<?php } ?>
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($clients->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>Exact phrase</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($clients->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>All words</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($clients->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>Any word</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $clients_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($clients->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($clients->CurrentAction <> "gridadd" && $clients->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($clients_list->Pager)) $clients_list->Pager = new cPrevNextPager($clients_list->lStartRec, $clients_list->lDisplayRecs, $clients_list->lTotalRecs) ?>
<?php if ($clients_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($clients_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $clients_list->PageUrl() ?>start=<?php echo $clients_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($clients_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $clients_list->PageUrl() ?>start=<?php echo $clients_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $clients_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($clients_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $clients_list->PageUrl() ?>start=<?php echo $clients_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($clients_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $clients_list->PageUrl() ?>start=<?php echo $clients_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $clients_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $clients_list->Pager->FromIndex ?> to <?php echo $clients_list->Pager->ToIndex ?> of <?php echo $clients_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($clients_list->sSrchWhere == "0=101") { ?>
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
<?php if ($clients->CurrentAction <> "gridadd" && $clients->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $clients->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<a href="<?php echo $clients_list->PageUrl() ?>a=add">Inline Add</a>&nbsp;&nbsp;
<a href="<?php echo $clients_list->PageUrl() ?>a=gridadd">Grid Add</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($clients_list->lTotalRecs > 0) { ?>
<a href="<?php echo $clients_list->PageUrl() ?>a=gridedit">Grid Edit</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if ($clients_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fclientslist)) alert('No records selected'); else if (ew_Confirm('<?php echo $clients_list->sDeleteConfirmMsg ?>')) {document.fclientslist.action='clientsdelete.php';document.fclientslist.encoding='application/x-www-form-urlencoded';document.fclientslist.submit();};return false;">Delete Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fclientslist)) alert('No records selected'); else {document.fclientslist.action='clientsupdate.php';document.fclientslist.encoding='application/x-www-form-urlencoded';document.fclientslist.submit();};return false;">Update Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($clients->CurrentAction == "gridadd") { ?>
<a href="" onclick="if (clients_list.ValidateForm(document.fclientslist)) document.fclientslist.submit();return false;">Insert</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($clients->CurrentAction == "gridedit") { ?>
<a href="" onclick="if (clients_list.ValidateForm(document.fclientslist)) document.fclientslist.submit();return false;">Save</a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php echo $clients_list->PageUrl() ?>a=cancel">Cancel</a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fclientslist" id="fclientslist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="t" id="t" value="clients">
<?php if ($clients_list->lTotalRecs > 0 || $clients->CurrentAction == "add" || $clients->CurrentAction == "copy") { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$clients_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$clients_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$clients_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$clients_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$clients_list->lOptionCnt++; // Multi-select
}
	$clients_list->lOptionCnt += count($clients_list->ListOptions->Items); // Custom list options
?>
<?php echo $clients->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($clients->id->Visible) { // id ?>
	<?php if ($clients->SortUrl($clients->id) == "") { ?>
		<td>id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $clients->SortUrl($clients->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>id</td><td style="width: 10px;"><?php if ($clients->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($clients->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($clients->image->Visible) { // image ?>
	<?php if ($clients->SortUrl($clients->image) == "") { ?>
		<td>image</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $clients->SortUrl($clients->image) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>image</td><td style="width: 10px;"><?php if ($clients->image->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($clients->image->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($clients->order->Visible) { // order ?>
	<?php if ($clients->SortUrl($clients->order) == "") { ?>
		<td>order</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $clients->SortUrl($clients->order) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>order</td><td style="width: 10px;"><?php if ($clients->order->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($clients->order->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($clients->active->Visible) { // active ?>
	<?php if ($clients->SortUrl($clients->active) == "") { ?>
		<td>active</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $clients->SortUrl($clients->active) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>active</td><td style="width: 10px;"><?php if ($clients->active->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($clients->active->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($clients->Export == "") { ?>
<?php if ($clients->CurrentAction <> "gridadd" && $clients->CurrentAction <> "gridedit") { ?>
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
<?php if ($clients_list->lOptionCnt == 0 && $clients->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="phpmaker" onclick="clients_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($clients_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
</thead>
<?php
	if ($clients->CurrentAction == "add" || $clients->CurrentAction == "copy") {
		$clients_list->lRowIndex = 1;
		if ($clients->CurrentAction == "copy" && !$clients_list->LoadRow())
				$clients->CurrentAction = "add";
		if ($clients->CurrentAction == "add")
			$clients_list->LoadDefaultValues();
		if ($clients->EventCancelled) // Insert failed
			$clients_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$clients->CssClass = "ewTableEditRow";
		$clients->CssStyle = "";
		$clients->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
		$clients->RowType = EW_ROWTYPE_ADD;

		// Render row
		$clients_list->RenderRow();
?>
	<tr<?php echo $clients->RowAttributes() ?>>
	<?php if ($clients->id->Visible) { // id ?>
		<td>&nbsp;</td>
	<?php } ?>
	<?php if ($clients->image->Visible) { // image ?>
		<td>
<input type="file" name="x<?php echo $clients_list->lRowIndex ?>_image" id="x<?php echo $clients_list->lRowIndex ?>_image"<?php echo $clients->image->EditAttributes() ?>>
</div>
</td>
	<?php } ?>
	<?php if ($clients->order->Visible) { // order ?>
		<td>
<input type="text" name="x<?php echo $clients_list->lRowIndex ?>_order" id="x<?php echo $clients_list->lRowIndex ?>_order" size="30" value="<?php echo $clients->order->EditValue ?>"<?php echo $clients->order->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($clients->active->Visible) { // active ?>
		<td>
<div id="tp_x<?php echo $clients_list->lRowIndex ?>_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x<?php echo $clients_list->lRowIndex ?>_active" id="x<?php echo $clients_list->lRowIndex ?>_active" value="{value}"<?php echo $clients->active->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $clients_list->lRowIndex ?>_active" repeatcolumn="5">
<?php
$arwrk = $clients->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($clients->active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $clients_list->lRowIndex ?>_active" id="x<?php echo $clients_list->lRowIndex ?>_active" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $clients->active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
if ($emptywrk) $clients->active->OldValue = "";
?>
</div>
</td>
	<?php } ?>
<td colspan="<?php echo $clients_list->lOptionCnt ?>"><span class="phpmaker">
<a href="" onclick="if (clients_list.ValidateForm(document.fclientslist)) document.fclientslist.submit();return false;">Insert</a>&nbsp;<a href="<?php echo $clients_list->PageUrl() ?>a=cancel">Cancel</a>
<input type="hidden" name="a_list" id="a_list" value="insert">
</span></td>
	</tr>
<?php
}
?>
<?php
if ($clients->ExportAll && $clients->Export <> "") {
	$clients_list->lStopRec = $clients_list->lTotalRecs;
} else {
	$clients_list->lStopRec = $clients_list->lStartRec + $clients_list->lDisplayRecs - 1; // Set the last record to display
}
$clients_list->lRecCount = $clients_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$clients->SelectLimit && $clients_list->lStartRec > 1)
		$rs->Move($clients_list->lStartRec - 1);
}
$clients_list->lRowCnt = 0;
$clients_list->lEditRowCnt = 0;
if ($clients->CurrentAction == "edit")
	$clients_list->lRowIndex = 1;
if ($clients->CurrentAction == "gridadd")
	$clients_list->lRowIndex = 0;
if ($clients->CurrentAction == "gridedit")
	$clients_list->lRowIndex = 0;
while (($clients->CurrentAction == "gridadd" || !$rs->EOF) &&
	$clients_list->lRecCount < $clients_list->lStopRec) {
	$clients_list->lRecCount++;
	if (intval($clients_list->lRecCount) >= intval($clients_list->lStartRec)) {
		$clients_list->lRowCnt++;
		if ($clients->CurrentAction == "gridadd" || $clients->CurrentAction == "gridedit")
			$clients_list->lRowIndex++;

	// Init row class and style
	$clients->CssClass = "";
	$clients->CssStyle = "";
	$clients->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($clients->CurrentAction == "gridadd") {
		$clients_list->LoadDefaultValues(); // Load default values
	} else {
		$clients_list->LoadRowValues($rs); // Load row values
	}
	$clients->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($clients->CurrentAction == "gridadd") // Grid add
		$clients->RowType = EW_ROWTYPE_ADD; // Render add
	if ($clients->CurrentAction == "gridadd" && $clients->EventCancelled) // Insert failed
		$clients_list->RestoreCurrentRowFormValues($clients_list->lRowIndex); // Restore form values
	if ($clients->CurrentAction == "edit") {
		if ($clients_list->CheckInlineEditKey() && $clients_list->lEditRowCnt == 0) // Inline edit
			$clients->RowType = EW_ROWTYPE_EDIT; // Render edit
	}
	if ($clients->CurrentAction == "gridedit") // Grid edit
		$clients->RowType = EW_ROWTYPE_EDIT; // Render edit
	if ($clients->RowType == EW_ROWTYPE_EDIT && $clients->EventCancelled) { // Update failed
		if ($clients->CurrentAction == "edit")
			$clients_list->RestoreFormValues(); // Restore form values
		if ($clients->CurrentAction == "gridedit")
			$clients_list->RestoreCurrentRowFormValues($clients_list->lRowIndex); // Restore form values
	}
	if ($clients->RowType == EW_ROWTYPE_EDIT) { // Edit row
		$clients_list->lEditRowCnt++;
		$clients->RowClientEvents = "onmouseover='this.edit=true;ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	}
	if ($clients->RowType == EW_ROWTYPE_ADD || $clients->RowType == EW_ROWTYPE_EDIT) // Add / Edit row
			$clients->CssClass = "ewTableEditRow";

	// Render row
	$clients_list->RenderRow();
?>
	<tr<?php echo $clients->RowAttributes() ?>>
	<?php if ($clients->id->Visible) { // id ?>
		<td<?php echo $clients->id->CellAttributes() ?>>
<?php if ($clients->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $clients_list->lRowIndex ?>_id" id="o<?php echo $clients_list->lRowIndex ?>_id" value="<?php echo ew_HtmlEncode($clients->id->OldValue) ?>">
<?php } ?>
<?php if ($clients->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $clients->id->ViewAttributes() ?>><?php echo $clients->id->EditValue ?></div><input type="hidden" name="x<?php echo $clients_list->lRowIndex ?>_id" id="x<?php echo $clients_list->lRowIndex ?>_id" value="<?php echo ew_HtmlEncode($clients->id->CurrentValue) ?>">
<?php } ?>
<?php if ($clients->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $clients->id->ViewAttributes() ?>><?php echo $clients->id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($clients->image->Visible) { // image ?>
		<td<?php echo $clients->image->CellAttributes() ?>>
<?php if ($clients->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="file" name="x<?php echo $clients_list->lRowIndex ?>_image" id="x<?php echo $clients_list->lRowIndex ?>_image"<?php echo $clients->image->EditAttributes() ?>>
</div>
<input type="hidden" name="o<?php echo $clients_list->lRowIndex ?>_image" id="o<?php echo $clients_list->lRowIndex ?>_image" value="<?php echo ew_HtmlEncode($clients->image->OldValue) ?>">
<?php } ?>
<?php if ($clients->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div id="old_x<?php echo $clients_list->lRowIndex ?>_image">
<?php if ($clients->image->HrefValue <> "") { ?>
<?php if (!is_null($clients->image->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $clients->image->Upload->DbValue ?>" border=0<?php echo $clients->image->ViewAttributes() ?>>
<?php } elseif (!in_array($clients->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($clients->image->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $clients->image->Upload->DbValue ?>" border=0<?php echo $clients->image->ViewAttributes() ?>>
<?php } elseif (!in_array($clients->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x<?php echo $clients_list->lRowIndex ?>_image">
<?php if (!is_null($clients->image->Upload->DbValue)) { ?>
<input type="radio" name="a<?php echo $clients_list->lRowIndex ?>_image" id="a<?php echo $clients_list->lRowIndex ?>_image" value="1" checked="checked">Keep&nbsp;
<input type="radio" name="a<?php echo $clients_list->lRowIndex ?>_image" id="a<?php echo $clients_list->lRowIndex ?>_image" value="2" disabled="disabled">Remove&nbsp;
<input type="radio" name="a<?php echo $clients_list->lRowIndex ?>_image" id="a<?php echo $clients_list->lRowIndex ?>_image" value="3">Replace<br>
<?php } else { ?>
<input type="hidden" name="a<?php echo $clients_list->lRowIndex ?>_image" id="a<?php echo $clients_list->lRowIndex ?>_image" value="3">
<?php } ?>
<input type="file" name="x<?php echo $clients_list->lRowIndex ?>_image" id="x<?php echo $clients_list->lRowIndex ?>_image" onchange="if (this.form.a<?php echo $clients_list->lRowIndex ?>_image[2]) this.form.a<?php echo $clients_list->lRowIndex ?>_image[2].checked=true;"<?php echo $clients->image->EditAttributes() ?>>
</div>
<?php } ?>
<?php if ($clients->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<?php if ($clients->image->HrefValue <> "") { ?>
<?php if (!is_null($clients->image->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $clients->image->Upload->DbValue ?>" border=0<?php echo $clients->image->ViewAttributes() ?>>
<?php } elseif (!in_array($clients->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($clients->image->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $clients->image->Upload->DbValue ?>" border=0<?php echo $clients->image->ViewAttributes() ?>>
<?php } elseif (!in_array($clients->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($clients->order->Visible) { // order ?>
		<td<?php echo $clients->order->CellAttributes() ?>>
<?php if ($clients->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $clients_list->lRowIndex ?>_order" id="x<?php echo $clients_list->lRowIndex ?>_order" size="30" value="<?php echo $clients->order->EditValue ?>"<?php echo $clients->order->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $clients_list->lRowIndex ?>_order" id="o<?php echo $clients_list->lRowIndex ?>_order" value="<?php echo ew_HtmlEncode($clients->order->OldValue) ?>">
<?php } ?>
<?php if ($clients->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $clients_list->lRowIndex ?>_order" id="x<?php echo $clients_list->lRowIndex ?>_order" size="30" value="<?php echo $clients->order->EditValue ?>"<?php echo $clients->order->EditAttributes() ?>>
<?php } ?>
<?php if ($clients->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $clients->order->ViewAttributes() ?>><?php echo $clients->order->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($clients->active->Visible) { // active ?>
		<td<?php echo $clients->active->CellAttributes() ?>>
<?php if ($clients->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<div id="tp_x<?php echo $clients_list->lRowIndex ?>_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x<?php echo $clients_list->lRowIndex ?>_active" id="x<?php echo $clients_list->lRowIndex ?>_active" value="{value}"<?php echo $clients->active->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $clients_list->lRowIndex ?>_active" repeatcolumn="5">
<?php
$arwrk = $clients->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($clients->active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $clients_list->lRowIndex ?>_active" id="x<?php echo $clients_list->lRowIndex ?>_active" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $clients->active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
if ($emptywrk) $clients->active->OldValue = "";
?>
</div>
<input type="hidden" name="o<?php echo $clients_list->lRowIndex ?>_active" id="o<?php echo $clients_list->lRowIndex ?>_active" value="<?php echo ew_HtmlEncode($clients->active->OldValue) ?>">
<?php } ?>
<?php if ($clients->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div id="tp_x<?php echo $clients_list->lRowIndex ?>_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x<?php echo $clients_list->lRowIndex ?>_active" id="x<?php echo $clients_list->lRowIndex ?>_active" value="{value}"<?php echo $clients->active->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $clients_list->lRowIndex ?>_active" repeatcolumn="5">
<?php
$arwrk = $clients->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($clients->active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $clients_list->lRowIndex ?>_active" id="x<?php echo $clients_list->lRowIndex ?>_active" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $clients->active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
if ($emptywrk) $clients->active->OldValue = "";
?>
</div>
<?php } ?>
<?php if ($clients->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $clients->active->ViewAttributes() ?>><?php echo $clients->active->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php if ($clients->RowType == EW_ROWTYPE_ADD || $clients->RowType == EW_ROWTYPE_EDIT) { ?>
<?php if ($clients->CurrentAction == "edit") { ?>
<td colspan="<?php echo $clients_list->lOptionCnt ?>"><span class="phpmaker">
<a href="" onclick="if (clients_list.ValidateForm(document.fclientslist)) document.fclientslist.submit();return false;">Update</a>&nbsp;<a href="<?php echo $clients_list->PageUrl() ?>a=cancel">Cancel</a>
<input type="hidden" name="a_list" id="a_list" value="update">
</span></td>
<?php } ?>
<?php
	if ($clients->CurrentAction == "gridedit")
		$clients_list->sMultiSelectKey .= "<input type=\"hidden\" name=\"k" . $clients_list->lRowIndex . "_key\" id=\"k" . $clients_list->lRowIndex . "_key\" value=\"" . $clients->id->CurrentValue . "\">";
?>
<?php } else { ?>
<?php if ($clients->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $clients->ViewUrl() ?>">View</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $clients->EditUrl() ?>">Edit</a><span class="ewSeparator">&nbsp;|&nbsp;</span><a href="<?php echo $clients->InlineEditUrl() ?>">Inline Edit</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $clients->CopyUrl() ?>">Copy</a><span class="ewSeparator">&nbsp;|&nbsp;</span><a href="<?php echo $clients->InlineCopyUrl() ?>">Inline Copy</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($clients_list->lOptionCnt == 0 && $clients->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($clients->id->CurrentValue) ?>" class="phpmaker" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($clients_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
<?php if ($clients->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($clients->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($clients->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($clients->CurrentAction == "add" || $clients->CurrentAction == "copy") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $clients_list->lRowIndex ?>">
<?php } ?>
<?php if ($clients->CurrentAction == "gridadd") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $clients_list->lRowIndex ?>">
<?php } ?>
<?php if ($clients->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $clients_list->lRowIndex ?>">
<?php } ?>
<?php if ($clients->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $clients_list->lRowIndex ?>">
<?php echo $clients_list->sMultiSelectKey ?>
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
<?php if ($clients_list->lTotalRecs > 0) { ?>
<?php if ($clients->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($clients->CurrentAction <> "gridadd" && $clients->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($clients_list->Pager)) $clients_list->Pager = new cPrevNextPager($clients_list->lStartRec, $clients_list->lDisplayRecs, $clients_list->lTotalRecs) ?>
<?php if ($clients_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($clients_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $clients_list->PageUrl() ?>start=<?php echo $clients_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($clients_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $clients_list->PageUrl() ?>start=<?php echo $clients_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $clients_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($clients_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $clients_list->PageUrl() ?>start=<?php echo $clients_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($clients_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $clients_list->PageUrl() ?>start=<?php echo $clients_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $clients_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $clients_list->Pager->FromIndex ?> to <?php echo $clients_list->Pager->ToIndex ?> of <?php echo $clients_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($clients_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($clients_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($clients->CurrentAction <> "gridadd" && $clients->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $clients->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<a href="<?php echo $clients_list->PageUrl() ?>a=add">Inline Add</a>&nbsp;&nbsp;
<a href="<?php echo $clients_list->PageUrl() ?>a=gridadd">Grid Add</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($clients_list->lTotalRecs > 0) { ?>
<a href="<?php echo $clients_list->PageUrl() ?>a=gridedit">Grid Edit</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if ($clients_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fclientslist)) alert('No records selected'); else if (ew_Confirm('<?php echo $clients_list->sDeleteConfirmMsg ?>')) {document.fclientslist.action='clientsdelete.php';document.fclientslist.encoding='application/x-www-form-urlencoded';document.fclientslist.submit();};return false;">Delete Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fclientslist)) alert('No records selected'); else {document.fclientslist.action='clientsupdate.php';document.fclientslist.encoding='application/x-www-form-urlencoded';document.fclientslist.submit();};return false;">Update Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($clients->CurrentAction == "gridadd") { ?>
<a href="" onclick="if (clients_list.ValidateForm(document.fclientslist)) document.fclientslist.submit();return false;">Insert</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($clients->CurrentAction == "gridedit") { ?>
<a href="" onclick="if (clients_list.ValidateForm(document.fclientslist)) document.fclientslist.submit();return false;">Save</a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php echo $clients_list->PageUrl() ?>a=cancel">Cancel</a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($clients->Export == "" && $clients->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(clients_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($clients->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$clients_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class cclients_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'clients';

	// Page Object Name
	var $PageObjName = 'clients_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $clients;
		if ($clients->UseTokenInUrl) $PageUrl .= "t=" . $clients->TableVar . "&"; // add page token
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
		global $objForm, $clients;
		if ($clients->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($clients->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($clients->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cclients_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["clients"] = new cclients();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'clients', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $clients;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$clients->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $clients->Export; // Get export parameter, used in header
	$gsExportFile = $clients->TableVar; // Get export file, used in header
	if ($clients->Export == "print" || $clients->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($clients->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($clients->Export == "word") {
		header('Content-Type: application/vnd.ms-word;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($clients->Export == "xml") {
		header('Content-Type: text/xml;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($clients->Export == "csv") {
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
		global $objForm, $gsSearchError, $Security, $clients;
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
				$clients->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($clients->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to grid edit mode
				if ($clients->CurrentAction == "gridedit")
					$this->GridEditMode();

				// Switch to inline edit mode
				if ($clients->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($clients->CurrentAction == "add" || $clients->CurrentAction == "copy")
					$this->InlineAddMode();

				// Switch to grid add mode
				if ($clients->CurrentAction == "gridadd")
					$this->GridAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$clients->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Update
					if ($clients->CurrentAction == "gridupdate" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridedit")
						$this->GridUpdate();

					// Inline Update
					if ($clients->CurrentAction == "update" && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($clients->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
						$this->InlineInsert();

					// Grid Insert
					if ($clients->CurrentAction == "gridinsert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridadd")
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
		if ($clients->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $clients->getRecordsPerPage(); // Restore from Session
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
		$clients->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$clients->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$clients->setStartRecordNumber($this->lStartRec);
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
		$clients->setSessionWhere($sFilter);
		$clients->CurrentFilter = "";

		// Export data only
		if (in_array($clients->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	//  Exit out of inline mode
	function ClearInlineMode() {
		global $clients;
		$clients->setKey("id", ""); // Clear inline edit key
		$clients->CurrentAction = ""; // Clear action
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
		global $Security, $clients;
		$bInlineEdit = TRUE;
		if (@$_GET["id"] <> "") {
			$clients->id->setQueryStringValue($_GET["id"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$clients->setKey("id", $clients->id->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to inline edit record
	function InlineUpdate() {
		global $objForm, $gsFormError, $clients;
		$objForm->Index = 1; 
		$this->GetUploadFiles(); // Get upload files
		$this->LoadFormValues(); // Get form values

		// Validate Form
		$bInlineUpdate = TRUE;
		if (!$this->ValidateForm()) {	
			$bInlineUpdate = FALSE; // Form error, reset action
			$this->setMessage($gsFormError);
		} else {
			$bInlineUpdate = FALSE;	
			if ($this->CheckInlineEditKey()) { // Check key
				$clients->SendEmail = TRUE; // Send email on update success
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
			$clients->EventCancelled = TRUE; // Cancel event
			$clients->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check inline edit key
	function CheckInlineEditKey() {
		global $clients;

		//CheckInlineEditKey = True
		if (strval($clients->getKey("id")) <> strval($clients->id->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add Mode
	function InlineAddMode() {
		global $Security, $clients;
		if ($clients->CurrentAction == "copy") {
			if (@$_GET["id"] <> "") {
				$clients->id->setQueryStringValue($_GET["id"]);
			} else {
				$clients->CurrentAction = "add";
			}
		}
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to inline add/copy record
	function InlineInsert() {
		global $objForm, $gsFormError, $clients;
		$objForm->Index = 1;
		$this->GetUploadFiles(); // Get upload files
		$this->LoadFormValues(); // Get form values

		// Validate Form
		if (!$this->ValidateForm()) {
			$this->setMessage($gsFormError); // Set validation error message
			$clients->EventCancelled = TRUE; // Set event cancelled
			$clients->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$clients->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow()) { // Add record
			$this->setMessage("Add succeeded"); // Set add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$clients->EventCancelled = TRUE; // Set event cancelled
			$clients->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Perform update to grid
	function GridUpdate() {
		global $conn, $objForm, $gsFormError, $clients;
		$rowindex = 1;
		$bGridUpdate = TRUE;

		// Begin transaction
		$conn->BeginTrans();

		// Get old recordset
		$clients->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $clients->SQL();
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
			$this->GetUploadFiles(); // Get upload files
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$bGridUpdate = FALSE; // Form error, reset action
				$this->setMessage($gsFormError);
			} else {
				if ($this->SetupKeyValues($sThisKey)) { // Set up key values
					$clients->SendEmail = FALSE; // Do not send email on update success
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
			$clients->EventCancelled = TRUE; // Set event cancelled
			$clients->CurrentAction = "gridedit"; // Stay in gridedit mode
		}
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $clients;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $clients->KeyFilter();
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
		global $clients;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$clients->id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($clients->id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Grid Insert
	// Perform insert to grid
	function GridInsert() {
		global $conn, $objForm, $gsFormError, $clients;
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
			$this->GetUploadFiles(); // Get upload files
			$this->LoadFormValues(); // Get form values
			if (!$this->EmptyRow()) {
				$addcnt++;
				$clients->SendEmail = FALSE; // Do not send email on insert success

				// Validate Form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow(); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
					$sKey .= $clients->id->CurrentValue;

					// Add filter for this record
					$sFilter = $clients->KeyFilter();
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
			$clients->CurrentFilter = $sWrkFilter;
			$sSql = $clients->SQL();
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
			$clients->EventCancelled = TRUE; // Set event cancelled
			$clients->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
	}

	// Check if empty row
	function EmptyRow() {
		global $clients;
		if (!is_null($clients->image->Upload->Value))
			return FALSE;
		if ($clients->order->CurrentValue <> $clients->order->OldValue)
			return FALSE;
		if ($clients->active->CurrentValue <> $clients->active->OldValue)
			return FALSE;
		return TRUE;
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm, $clients;

		// Get row based on current index
		$objForm->Index = $idx;
		if ($clients->CurrentAction == "gridadd")
			$this->LoadFormValues(); // Load form values
		if ($clients->CurrentAction == "gridedit") {
			$sKey = strval($objForm->GetValue("k_key"));
			$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $sKey);
			if (count($arrKeyFlds) >= 1) {
				if (strval($arrKeyFlds[0]) == strval($clients->id->CurrentValue)) {
					$this->LoadFormValues(); // Load form values
				}
			}
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $clients;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $clients->id, FALSE); // Field id
		$this->BuildSearchSql($sWhere, $clients->order, FALSE); // Field order
		$this->BuildSearchSql($sWhere, $clients->active, FALSE); // Field active

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($clients->id); // Field id
			$this->SetSearchParm($clients->order); // Field order
			$this->SetSearchParm($clients->active); // Field active
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
		global $clients;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$clients->setAdvancedSearch("x_$FldParm", $FldVal);
		$clients->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$clients->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$clients->setAdvancedSearch("y_$FldParm", $FldVal2);
		$clients->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $clients;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $clients->image->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $clients;
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
			$clients->setBasicSearchKeyword($sSearchKeyword);
			$clients->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $clients;
		$this->sSrchWhere = "";
		$clients->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $clients;
		$clients->setBasicSearchKeyword("");
		$clients->setBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $clients;
		$clients->setAdvancedSearch("x_id", "");
		$clients->setAdvancedSearch("x_order", "");
		$clients->setAdvancedSearch("x_active", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $clients;
		$this->sSrchWhere = $clients->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $clients;
		 $clients->id->AdvancedSearch->SearchValue = $clients->getAdvancedSearch("x_id");
		 $clients->order->AdvancedSearch->SearchValue = $clients->getAdvancedSearch("x_order");
		 $clients->active->AdvancedSearch->SearchValue = $clients->getAdvancedSearch("x_active");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $clients;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$clients->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$clients->CurrentOrderType = @$_GET["ordertype"];
			$clients->UpdateSort($clients->id); // Field 
			$clients->UpdateSort($clients->image); // Field 
			$clients->UpdateSort($clients->order); // Field 
			$clients->UpdateSort($clients->active); // Field 
			$clients->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $clients;
		$sOrderBy = $clients->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($clients->SqlOrderBy() <> "") {
				$sOrderBy = $clients->SqlOrderBy();
				$clients->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $clients;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$clients->setSessionOrderBy($sOrderBy);
				$clients->id->setSort("");
				$clients->image->setSort("");
				$clients->order->setSort("");
				$clients->active->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$clients->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $clients;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$clients->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$clients->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $clients->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$clients->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$clients->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$clients->setStartRecordNumber($this->lStartRec);
		}
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $clients;

		// Get upload data
			$clients->image->Upload->Index = $objForm->Index;
			if ($clients->image->Upload->UploadFile()) {

				// No action required
			} else {
				echo $clients->image->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load default values
	function LoadDefaultValues() {
		global $clients;
		$clients->order->CurrentValue = 0;
		$clients->order->OldValue = $clients->order->CurrentValue;
		$clients->active->CurrentValue = 0;
		$clients->active->OldValue = $clients->active->CurrentValue;
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $clients;

		// Load search values
		// id

		$clients->id->AdvancedSearch->SearchValue = @$_GET["x_id"];
		$clients->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// order
		$clients->order->AdvancedSearch->SearchValue = @$_GET["x_order"];
		$clients->order->AdvancedSearch->SearchOperator = @$_GET["z_order"];

		// active
		$clients->active->AdvancedSearch->SearchValue = @$_GET["x_active"];
		$clients->active->AdvancedSearch->SearchOperator = @$_GET["z_active"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $clients;
		$clients->id->setFormValue($objForm->GetValue("x_id"));
		$clients->id->OldValue = $objForm->GetValue("o_id");
		$clients->order->setFormValue($objForm->GetValue("x_order"));
		$clients->order->OldValue = $objForm->GetValue("o_order");
		$clients->active->setFormValue($objForm->GetValue("x_active"));
		$clients->active->OldValue = $objForm->GetValue("o_active");
	}

	// Restore form values
	function RestoreFormValues() {
		global $clients;
		$clients->id->CurrentValue = $clients->id->FormValue;
		$clients->order->CurrentValue = $clients->order->FormValue;
		$clients->active->CurrentValue = $clients->active->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $clients;

		// Call Recordset Selecting event
		$clients->Recordset_Selecting($clients->CurrentFilter);

		// Load list page SQL
		$sSql = $clients->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$clients->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $clients;
		$sFilter = $clients->KeyFilter();

		// Call Row Selecting event
		$clients->Row_Selecting($sFilter);

		// Load sql based on filter
		$clients->CurrentFilter = $sFilter;
		$sSql = $clients->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$clients->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $clients;
		$clients->id->setDbValue($rs->fields('id'));
		$clients->image->Upload->DbValue = $rs->fields('image');
		$clients->order->setDbValue($rs->fields('order'));
		$clients->active->setDbValue($rs->fields('active'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $clients;

		// Call Row_Rendering event
		$clients->Row_Rendering();

		// Common render codes for all row types
		// id

		$clients->id->CellCssStyle = "";
		$clients->id->CellCssClass = "";

		// image
		$clients->image->CellCssStyle = "";
		$clients->image->CellCssClass = "";

		// order
		$clients->order->CellCssStyle = "";
		$clients->order->CellCssClass = "";

		// active
		$clients->active->CellCssStyle = "";
		$clients->active->CellCssClass = "";
		if ($clients->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$clients->id->ViewValue = $clients->id->CurrentValue;
			$clients->id->CssStyle = "";
			$clients->id->CssClass = "";
			$clients->id->ViewCustomAttributes = "";

			// image
			if (!is_null($clients->image->Upload->DbValue)) {
				$clients->image->ViewValue = $clients->image->Upload->DbValue;
				$clients->image->ImageWidth = 100;
				$clients->image->ImageHeight = 0;
				$clients->image->ImageAlt = "";
			} else {
				$clients->image->ViewValue = "";
			}
			$clients->image->CssStyle = "";
			$clients->image->CssClass = "";
			$clients->image->ViewCustomAttributes = "";

			// order
			$clients->order->ViewValue = $clients->order->CurrentValue;
			$clients->order->CssStyle = "";
			$clients->order->CssClass = "";
			$clients->order->ViewCustomAttributes = "";

			// active
			if (strval($clients->active->CurrentValue) <> "") {
				switch ($clients->active->CurrentValue) {
					case "0":
						$clients->active->ViewValue = "No";
						break;
					case "1":
						$clients->active->ViewValue = "Yes";
						break;
					default:
						$clients->active->ViewValue = $clients->active->CurrentValue;
				}
			} else {
				$clients->active->ViewValue = NULL;
			}
			$clients->active->CssStyle = "";
			$clients->active->CssClass = "";
			$clients->active->ViewCustomAttributes = "";

			// id
			$clients->id->HrefValue = "";

			// image
			$clients->image->HrefValue = "";

			// order
			$clients->order->HrefValue = "";

			// active
			$clients->active->HrefValue = "";
		} elseif ($clients->RowType == EW_ROWTYPE_ADD) { // Add row

			// id
			// image

			$clients->image->EditCustomAttributes = "";
			if (!is_null($clients->image->Upload->DbValue)) {
				$clients->image->EditValue = $clients->image->Upload->DbValue;
				$clients->image->ImageWidth = 100;
				$clients->image->ImageHeight = 0;
				$clients->image->ImageAlt = "";
			} else {
				$clients->image->EditValue = "";
			}

			// order
			$clients->order->EditCustomAttributes = "";
			$clients->order->EditValue = ew_HtmlEncode($clients->order->CurrentValue);

			// active
			$clients->active->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$clients->active->EditValue = $arwrk;
		} elseif ($clients->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$clients->id->EditCustomAttributes = "";
			$clients->id->EditValue = $clients->id->CurrentValue;
			$clients->id->CssStyle = "";
			$clients->id->CssClass = "";
			$clients->id->ViewCustomAttributes = "";

			// image
			$clients->image->EditCustomAttributes = "";
			if (!is_null($clients->image->Upload->DbValue)) {
				$clients->image->EditValue = $clients->image->Upload->DbValue;
				$clients->image->ImageWidth = 100;
				$clients->image->ImageHeight = 0;
				$clients->image->ImageAlt = "";
			} else {
				$clients->image->EditValue = "";
			}

			// order
			$clients->order->EditCustomAttributes = "";
			$clients->order->EditValue = ew_HtmlEncode($clients->order->CurrentValue);

			// active
			$clients->active->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$clients->active->EditValue = $arwrk;

			// Edit refer script
			// id

			$clients->id->HrefValue = "";

			// image
			$clients->image->HrefValue = "";

			// order
			$clients->order->HrefValue = "";

			// active
			$clients->active->HrefValue = "";
		}

		// Call Row Rendered event
		$clients->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $clients;

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
		global $gsFormError, $clients;

		// Initialize
		$gsFormError = "";
		if (!ew_CheckFileType($clients->image->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "File type is not allowed.";
		}
		if ($clients->image->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($clients->image->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "Max. file size (%s bytes) exceeded.");
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($clients->CurrentAction == "gridupdate" || $clients->CurrentAction == "update") {
			if ($clients->image->Upload->Action == "3" && is_null($clients->image->Upload->Value)) {
				$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
				$gsFormError .= "Please enter required field - image";
			}
		} elseif (is_null($clients->image->Upload->Value)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - image";
		}
		if ($clients->order->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - order";
		}
		if (!ew_CheckInteger($clients->order->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - order";
		}
		if ($clients->active->FormValue == "") {
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
		global $conn, $Security, $clients;
		$sFilter = $clients->KeyFilter();
		$clients->CurrentFilter = $sFilter;
		$sSql = $clients->SQL();
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
			// Field image

			$clients->image->Upload->SaveToSession(); // Save file value to Session
						if ($clients->image->Upload->Action == "2" || $clients->image->Upload->Action == "3") { // Update/Remove
			$clients->image->Upload->DbValue = $rs->fields('image'); // Get original value
			if (is_null($clients->image->Upload->Value)) {
				$rsnew['image'] = NULL;
			} else {
				if ($clients->image->Upload->FileName == $clients->image->Upload->DbValue) { // Upload file name same as old file name
					$rsnew['image'] = $clients->image->Upload->FileName;
				} else {
					$rsnew['image'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, "../images/"), $clients->image->Upload->FileName);
				}
			}
			}

			// Field order
			$clients->order->SetDbValueDef($clients->order->CurrentValue, 0);
			$rsnew['order'] =& $clients->order->DbValue;

			// Field active
			$clients->active->SetDbValueDef($clients->active->CurrentValue, 0);
			$rsnew['active'] =& $clients->active->DbValue;

			// Call Row Updating event
			$bUpdateRow = $clients->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {

			// Field image
			if (!is_null($clients->image->Upload->Value)) {
				if ($clients->image->Upload->FileName == $clients->image->Upload->DbValue) { // Overwrite if same file name
					$clients->image->Upload->SaveToFile("../images/", $rsnew['image'], TRUE);
					$clients->image->Upload->DbValue = ""; // No need to delete any more
				} else {
					$clients->image->Upload->SaveToFile("../images/", $rsnew['image'], FALSE);
				}
			}
			if ($clients->image->Upload->Action == "2" || $clients->image->Upload->Action == "3") { // Update/Remove
				if ($clients->image->Upload->DbValue <> "")
					@unlink(ew_UploadPathEx(TRUE, "../images/") . $clients->image->Upload->DbValue);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($clients->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($clients->CancelMessage <> "") {
					$this->setMessage($clients->CancelMessage);
					$clients->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$clients->Row_Updated($rsold, $rsnew);
		$rs->Close();

		// Field image
		$clients->image->Upload->RemoveFromSession(); // Remove file value from Session
		return $EditRow;
	}

	// Add record
	function AddRow() {
		global $conn, $Security, $clients;
		$rsnew = array();

		// Field id
		// Field image

		$clients->image->Upload->SaveToSession(); // Save file value to Session
		if (is_null($clients->image->Upload->Value)) {
			$rsnew['image'] = NULL;
		} else {
			$rsnew['image'] = ew_UploadFileNameEx(ew_UploadPathEx(True, "../images/"), $clients->image->Upload->FileName);
		}

		// Field order
		$clients->order->SetDbValueDef($clients->order->CurrentValue, 0);
		$rsnew['order'] =& $clients->order->DbValue;

		// Field active
		$clients->active->SetDbValueDef($clients->active->CurrentValue, 0);
		$rsnew['active'] =& $clients->active->DbValue;

		// Call Row Inserting event
		$bInsertRow = $clients->Row_Inserting($rsnew);
		if ($bInsertRow) {

			// Field image
			if (!is_null($clients->image->Upload->Value)) {
				if ($clients->image->Upload->FileName == $clients->image->Upload->DbValue) { // Overwrite if same file name
					$clients->image->Upload->SaveToFile("../images/", $rsnew['image'], TRUE);
					$clients->image->Upload->DbValue = ""; // No need to delete any more
				} else {
					$clients->image->Upload->SaveToFile("../images/", $rsnew['image'], FALSE);
				}
			}
			if ($clients->image->Upload->Action == "2" || $clients->image->Upload->Action == "3") { // Update/Remove
				if ($clients->image->Upload->DbValue <> "")
					@unlink(ew_UploadPathEx(TRUE, "../images/") . $clients->image->Upload->DbValue);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($clients->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($clients->CancelMessage <> "") {
				$this->setMessage($clients->CancelMessage);
				$clients->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$clients->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $clients->id->DbValue;

			// Call Row Inserted event
			$clients->Row_Inserted($rsnew);
		}

		// Field image
		$clients->image->Upload->RemoveFromSession(); // Remove file value from Session
		return $AddRow;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $clients;
		$clients->id->AdvancedSearch->SearchValue = $clients->getAdvancedSearch("x_id");
		$clients->order->AdvancedSearch->SearchValue = $clients->getAdvancedSearch("x_order");
		$clients->active->AdvancedSearch->SearchValue = $clients->getAdvancedSearch("x_active");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $clients;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($clients->ExportAll) {
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
		if ($clients->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo "\xEF\xBB\xBF";
			echo ew_ExportHeader($clients->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $clients->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id', $clients->Export);
				ew_ExportAddValue($sExportStr, 'image', $clients->Export);
				ew_ExportAddValue($sExportStr, 'order', $clients->Export);
				ew_ExportAddValue($sExportStr, 'active', $clients->Export);
				echo ew_ExportLine($sExportStr, $clients->Export);
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
				$clients->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($clients->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id', $clients->id->CurrentValue);
					$XmlDoc->AddField('image', $clients->image->CurrentValue);
					$XmlDoc->AddField('order', $clients->order->CurrentValue);
					$XmlDoc->AddField('active', $clients->active->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $clients->Export <> "csv") { // Vertical format
						echo ew_ExportField('id', $clients->id->ExportValue($clients->Export, $clients->ExportOriginalValue), $clients->Export);
						echo ew_ExportField('image', $clients->image->ExportValue($clients->Export, $clients->ExportOriginalValue), $clients->Export);
						echo ew_ExportField('order', $clients->order->ExportValue($clients->Export, $clients->ExportOriginalValue), $clients->Export);
						echo ew_ExportField('active', $clients->active->ExportValue($clients->Export, $clients->ExportOriginalValue), $clients->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $clients->id->ExportValue($clients->Export, $clients->ExportOriginalValue), $clients->Export);
						ew_ExportAddValue($sExportStr, $clients->image->ExportValue($clients->Export, $clients->ExportOriginalValue), $clients->Export);
						ew_ExportAddValue($sExportStr, $clients->order->ExportValue($clients->Export, $clients->ExportOriginalValue), $clients->Export);
						ew_ExportAddValue($sExportStr, $clients->active->ExportValue($clients->Export, $clients->ExportOriginalValue), $clients->Export);
						echo ew_ExportLine($sExportStr, $clients->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($clients->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($clients->Export);
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
