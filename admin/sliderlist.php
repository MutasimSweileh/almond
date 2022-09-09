<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "sliderinfo.php" ?>
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
$slider_list = new cslider_list();
$Page =& $slider_list;

// Page init processing
$slider_list->Page_Init();

// Page main processing
$slider_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($slider->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var slider_list = new ew_Page("slider_list");

// page properties
slider_list.PageID = "list"; // page ID
var EW_PAGE_ID = slider_list.PageID; // for backward compatibility

// extend page with ValidateForm function
slider_list.ValidateForm = function(fobj) {
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
slider_list.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "image")) return false;
	if (ew_ValueChanged(fobj, infix, "order")) return false;
	if (ew_ValueChanged(fobj, infix, "active")) return false;
	return true;
}

// extend page with Form_CustomValidate function
slider_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
slider_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
slider_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
slider_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
slider_list.ShowHighlightText = "Show highlight"; 
slider_list.HideHighlightText = "Hide highlight";

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
<?php if ($slider->Export == "") { ?>
<?php } ?>
<?php
if ($slider->CurrentAction == "gridadd")
	$slider->CurrentFilter = "0=1";
if ($slider->CurrentAction == "gridadd") {
	$slider_list->lStartRec = 1;
	if ($slider_list->lDisplayRecs <= 0)
		$slider_list->lDisplayRecs = 20;
	$slider_list->lTotalRecs = $slider_list->lDisplayRecs;
	$slider_list->lStopRec = $slider_list->lDisplayRecs;
} else {
	$bSelectLimit = ($slider->Export == "" && $slider->SelectLimit);
	if (!$bSelectLimit)
		$rs = $slider_list->LoadRecordset();
	$slider_list->lTotalRecs = ($bSelectLimit) ? $slider->SelectRecordCount() : $rs->RecordCount();
	$slider_list->lStartRec = 1;
	if ($slider_list->lDisplayRecs <= 0) // Display all records
		$slider_list->lDisplayRecs = $slider_list->lTotalRecs;
	if (!($slider->ExportAll && $slider->Export <> ""))
		$slider_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $slider_list->LoadRecordset($slider_list->lStartRec-1, $slider_list->lDisplayRecs);
}
?>
<p><span class="phpmaker" style="white-space: nowrap;">TABLE: slider
<?php if ($slider->Export == "" && $slider->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $slider_list->PageUrl() ?>export=print">Printer Friendly</a>
&nbsp;&nbsp;<a href="<?php echo $slider_list->PageUrl() ?>export=html">Export to HTML</a>
&nbsp;&nbsp;<a href="<?php echo $slider_list->PageUrl() ?>export=excel">Export to Excel</a>
&nbsp;&nbsp;<a href="<?php echo $slider_list->PageUrl() ?>export=word">Export to Word</a>
&nbsp;&nbsp;<a href="<?php echo $slider_list->PageUrl() ?>export=xml">Export to XML</a>
&nbsp;&nbsp;<a href="<?php echo $slider_list->PageUrl() ?>export=csv">Export to CSV</a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($slider->Export == "" && $slider->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(slider_list);" style="text-decoration: none;"><img id="slider_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="slider_list_SearchPanel">
<form name="fsliderlistsrch" id="fsliderlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="slider">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($slider->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Search (*)">&nbsp;
			<a href="<?php echo $slider_list->PageUrl() ?>cmd=reset">Show all</a>&nbsp;
			<a href="slidersrch.php">Advanced Search</a>&nbsp;
			<?php if ($slider_list->sSrchWhere <> "" && $slider_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(slider_list, this, '<?php echo $slider->HighlightName() ?>');">Hide highlight</a>
			<?php } ?>
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($slider->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>Exact phrase</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($slider->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>All words</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($slider->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>Any word</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $slider_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($slider->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($slider->CurrentAction <> "gridadd" && $slider->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($slider_list->Pager)) $slider_list->Pager = new cPrevNextPager($slider_list->lStartRec, $slider_list->lDisplayRecs, $slider_list->lTotalRecs) ?>
<?php if ($slider_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($slider_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $slider_list->PageUrl() ?>start=<?php echo $slider_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($slider_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $slider_list->PageUrl() ?>start=<?php echo $slider_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $slider_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($slider_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $slider_list->PageUrl() ?>start=<?php echo $slider_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($slider_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $slider_list->PageUrl() ?>start=<?php echo $slider_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $slider_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $slider_list->Pager->FromIndex ?> to <?php echo $slider_list->Pager->ToIndex ?> of <?php echo $slider_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($slider_list->sSrchWhere == "0=101") { ?>
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
<?php if ($slider->CurrentAction <> "gridadd" && $slider->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $slider->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<a href="<?php echo $slider_list->PageUrl() ?>a=add">Inline Add</a>&nbsp;&nbsp;
<a href="<?php echo $slider_list->PageUrl() ?>a=gridadd">Grid Add</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($slider_list->lTotalRecs > 0) { ?>
<a href="<?php echo $slider_list->PageUrl() ?>a=gridedit">Grid Edit</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if ($slider_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fsliderlist)) alert('No records selected'); else if (ew_Confirm('<?php echo $slider_list->sDeleteConfirmMsg ?>')) {document.fsliderlist.action='sliderdelete.php';document.fsliderlist.encoding='application/x-www-form-urlencoded';document.fsliderlist.submit();};return false;">Delete Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fsliderlist)) alert('No records selected'); else {document.fsliderlist.action='sliderupdate.php';document.fsliderlist.encoding='application/x-www-form-urlencoded';document.fsliderlist.submit();};return false;">Update Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($slider->CurrentAction == "gridadd") { ?>
<a href="" onclick="if (slider_list.ValidateForm(document.fsliderlist)) document.fsliderlist.submit();return false;">Insert</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($slider->CurrentAction == "gridedit") { ?>
<a href="" onclick="if (slider_list.ValidateForm(document.fsliderlist)) document.fsliderlist.submit();return false;">Save</a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php echo $slider_list->PageUrl() ?>a=cancel">Cancel</a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fsliderlist" id="fsliderlist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="t" id="t" value="slider">
<?php if ($slider_list->lTotalRecs > 0 || $slider->CurrentAction == "add" || $slider->CurrentAction == "copy") { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$slider_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$slider_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$slider_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$slider_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$slider_list->lOptionCnt++; // Multi-select
}
	$slider_list->lOptionCnt += count($slider_list->ListOptions->Items); // Custom list options
?>
<?php echo $slider->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($slider->id->Visible) { // id ?>
	<?php if ($slider->SortUrl($slider->id) == "") { ?>
		<td>id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $slider->SortUrl($slider->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>id</td><td style="width: 10px;"><?php if ($slider->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($slider->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($slider->image->Visible) { // image ?>
	<?php if ($slider->SortUrl($slider->image) == "") { ?>
		<td>image</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $slider->SortUrl($slider->image) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>image</td><td style="width: 10px;"><?php if ($slider->image->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($slider->image->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($slider->order->Visible) { // order ?>
	<?php if ($slider->SortUrl($slider->order) == "") { ?>
		<td>order</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $slider->SortUrl($slider->order) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>order</td><td style="width: 10px;"><?php if ($slider->order->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($slider->order->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($slider->active->Visible) { // active ?>
	<?php if ($slider->SortUrl($slider->active) == "") { ?>
		<td>active</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $slider->SortUrl($slider->active) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>active</td><td style="width: 10px;"><?php if ($slider->active->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($slider->active->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($slider->Export == "") { ?>
<?php if ($slider->CurrentAction <> "gridadd" && $slider->CurrentAction <> "gridedit") { ?>
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
<?php if ($slider_list->lOptionCnt == 0 && $slider->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="phpmaker" onclick="slider_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($slider_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
</thead>
<?php
	if ($slider->CurrentAction == "add" || $slider->CurrentAction == "copy") {
		$slider_list->lRowIndex = 1;
		if ($slider->CurrentAction == "copy" && !$slider_list->LoadRow())
				$slider->CurrentAction = "add";
		if ($slider->CurrentAction == "add")
			$slider_list->LoadDefaultValues();
		if ($slider->EventCancelled) // Insert failed
			$slider_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$slider->CssClass = "ewTableEditRow";
		$slider->CssStyle = "";
		$slider->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
		$slider->RowType = EW_ROWTYPE_ADD;

		// Render row
		$slider_list->RenderRow();
?>
	<tr<?php echo $slider->RowAttributes() ?>>
	<?php if ($slider->id->Visible) { // id ?>
		<td>&nbsp;</td>
	<?php } ?>
	<?php if ($slider->image->Visible) { // image ?>
		<td>
<input type="file" name="x<?php echo $slider_list->lRowIndex ?>_image" id="x<?php echo $slider_list->lRowIndex ?>_image" size="30"<?php echo $slider->image->EditAttributes() ?>>
</div>
</td>
	<?php } ?>
	<?php if ($slider->order->Visible) { // order ?>
		<td>
<input type="text" name="x<?php echo $slider_list->lRowIndex ?>_order" id="x<?php echo $slider_list->lRowIndex ?>_order" size="30" value="<?php echo $slider->order->EditValue ?>"<?php echo $slider->order->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($slider->active->Visible) { // active ?>
		<td>
<div id="tp_x<?php echo $slider_list->lRowIndex ?>_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x<?php echo $slider_list->lRowIndex ?>_active" id="x<?php echo $slider_list->lRowIndex ?>_active" value="{value}"<?php echo $slider->active->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $slider_list->lRowIndex ?>_active" repeatcolumn="5">
<?php
$arwrk = $slider->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($slider->active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $slider_list->lRowIndex ?>_active" id="x<?php echo $slider_list->lRowIndex ?>_active" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $slider->active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
if ($emptywrk) $slider->active->OldValue = "";
?>
</div>
</td>
	<?php } ?>
<td colspan="<?php echo $slider_list->lOptionCnt ?>"><span class="phpmaker">
<a href="" onclick="if (slider_list.ValidateForm(document.fsliderlist)) document.fsliderlist.submit();return false;">Insert</a>&nbsp;<a href="<?php echo $slider_list->PageUrl() ?>a=cancel">Cancel</a>
<input type="hidden" name="a_list" id="a_list" value="insert">
</span></td>
	</tr>
<?php
}
?>
<?php
if ($slider->ExportAll && $slider->Export <> "") {
	$slider_list->lStopRec = $slider_list->lTotalRecs;
} else {
	$slider_list->lStopRec = $slider_list->lStartRec + $slider_list->lDisplayRecs - 1; // Set the last record to display
}
$slider_list->lRecCount = $slider_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$slider->SelectLimit && $slider_list->lStartRec > 1)
		$rs->Move($slider_list->lStartRec - 1);
}
$slider_list->lRowCnt = 0;
$slider_list->lEditRowCnt = 0;
if ($slider->CurrentAction == "edit")
	$slider_list->lRowIndex = 1;
if ($slider->CurrentAction == "gridadd")
	$slider_list->lRowIndex = 0;
if ($slider->CurrentAction == "gridedit")
	$slider_list->lRowIndex = 0;
while (($slider->CurrentAction == "gridadd" || !$rs->EOF) &&
	$slider_list->lRecCount < $slider_list->lStopRec) {
	$slider_list->lRecCount++;
	if (intval($slider_list->lRecCount) >= intval($slider_list->lStartRec)) {
		$slider_list->lRowCnt++;
		if ($slider->CurrentAction == "gridadd" || $slider->CurrentAction == "gridedit")
			$slider_list->lRowIndex++;

	// Init row class and style
	$slider->CssClass = "";
	$slider->CssStyle = "";
	$slider->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($slider->CurrentAction == "gridadd") {
		$slider_list->LoadDefaultValues(); // Load default values
	} else {
		$slider_list->LoadRowValues($rs); // Load row values
	}
	$slider->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($slider->CurrentAction == "gridadd") // Grid add
		$slider->RowType = EW_ROWTYPE_ADD; // Render add
	if ($slider->CurrentAction == "gridadd" && $slider->EventCancelled) // Insert failed
		$slider_list->RestoreCurrentRowFormValues($slider_list->lRowIndex); // Restore form values
	if ($slider->CurrentAction == "edit") {
		if ($slider_list->CheckInlineEditKey() && $slider_list->lEditRowCnt == 0) // Inline edit
			$slider->RowType = EW_ROWTYPE_EDIT; // Render edit
	}
	if ($slider->CurrentAction == "gridedit") // Grid edit
		$slider->RowType = EW_ROWTYPE_EDIT; // Render edit
	if ($slider->RowType == EW_ROWTYPE_EDIT && $slider->EventCancelled) { // Update failed
		if ($slider->CurrentAction == "edit")
			$slider_list->RestoreFormValues(); // Restore form values
		if ($slider->CurrentAction == "gridedit")
			$slider_list->RestoreCurrentRowFormValues($slider_list->lRowIndex); // Restore form values
	}
	if ($slider->RowType == EW_ROWTYPE_EDIT) { // Edit row
		$slider_list->lEditRowCnt++;
		$slider->RowClientEvents = "onmouseover='this.edit=true;ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	}
	if ($slider->RowType == EW_ROWTYPE_ADD || $slider->RowType == EW_ROWTYPE_EDIT) // Add / Edit row
			$slider->CssClass = "ewTableEditRow";

	// Render row
	$slider_list->RenderRow();
?>
	<tr<?php echo $slider->RowAttributes() ?>>
	<?php if ($slider->id->Visible) { // id ?>
		<td<?php echo $slider->id->CellAttributes() ?>>
<?php if ($slider->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $slider_list->lRowIndex ?>_id" id="o<?php echo $slider_list->lRowIndex ?>_id" value="<?php echo ew_HtmlEncode($slider->id->OldValue) ?>">
<?php } ?>
<?php if ($slider->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $slider->id->ViewAttributes() ?>><?php echo $slider->id->EditValue ?></div><input type="hidden" name="x<?php echo $slider_list->lRowIndex ?>_id" id="x<?php echo $slider_list->lRowIndex ?>_id" value="<?php echo ew_HtmlEncode($slider->id->CurrentValue) ?>">
<?php } ?>
<?php if ($slider->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $slider->id->ViewAttributes() ?>><?php echo $slider->id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($slider->image->Visible) { // image ?>
		<td<?php echo $slider->image->CellAttributes() ?>>
<?php if ($slider->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="file" name="x<?php echo $slider_list->lRowIndex ?>_image" id="x<?php echo $slider_list->lRowIndex ?>_image" size="30"<?php echo $slider->image->EditAttributes() ?>>
</div>
<input type="hidden" name="o<?php echo $slider_list->lRowIndex ?>_image" id="o<?php echo $slider_list->lRowIndex ?>_image" value="<?php echo ew_HtmlEncode($slider->image->OldValue) ?>">
<?php } ?>
<?php if ($slider->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div id="old_x<?php echo $slider_list->lRowIndex ?>_image">
<?php if ($slider->image->HrefValue <> "") { ?>
<?php if (!is_null($slider->image->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $slider->image->Upload->DbValue ?>" border=0<?php echo $slider->image->ViewAttributes() ?>>
<?php } elseif (!in_array($slider->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($slider->image->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $slider->image->Upload->DbValue ?>" border=0<?php echo $slider->image->ViewAttributes() ?>>
<?php } elseif (!in_array($slider->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x<?php echo $slider_list->lRowIndex ?>_image">
<?php if (!is_null($slider->image->Upload->DbValue)) { ?>
<input type="radio" name="a<?php echo $slider_list->lRowIndex ?>_image" id="a<?php echo $slider_list->lRowIndex ?>_image" value="1" checked="checked">Keep&nbsp;
<input type="radio" name="a<?php echo $slider_list->lRowIndex ?>_image" id="a<?php echo $slider_list->lRowIndex ?>_image" value="2" disabled="disabled">Remove&nbsp;
<input type="radio" name="a<?php echo $slider_list->lRowIndex ?>_image" id="a<?php echo $slider_list->lRowIndex ?>_image" value="3">Replace<br>
<?php } else { ?>
<input type="hidden" name="a<?php echo $slider_list->lRowIndex ?>_image" id="a<?php echo $slider_list->lRowIndex ?>_image" value="3">
<?php } ?>
<input type="file" name="x<?php echo $slider_list->lRowIndex ?>_image" id="x<?php echo $slider_list->lRowIndex ?>_image" size="30" onchange="if (this.form.a<?php echo $slider_list->lRowIndex ?>_image[2]) this.form.a<?php echo $slider_list->lRowIndex ?>_image[2].checked=true;"<?php echo $slider->image->EditAttributes() ?>>
</div>
<?php } ?>
<?php if ($slider->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<?php if ($slider->image->HrefValue <> "") { ?>
<?php if (!is_null($slider->image->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $slider->image->Upload->DbValue ?>" border=0<?php echo $slider->image->ViewAttributes() ?>>
<?php } elseif (!in_array($slider->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($slider->image->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $slider->image->Upload->DbValue ?>" border=0<?php echo $slider->image->ViewAttributes() ?>>
<?php } elseif (!in_array($slider->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($slider->order->Visible) { // order ?>
		<td<?php echo $slider->order->CellAttributes() ?>>
<?php if ($slider->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $slider_list->lRowIndex ?>_order" id="x<?php echo $slider_list->lRowIndex ?>_order" size="30" value="<?php echo $slider->order->EditValue ?>"<?php echo $slider->order->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $slider_list->lRowIndex ?>_order" id="o<?php echo $slider_list->lRowIndex ?>_order" value="<?php echo ew_HtmlEncode($slider->order->OldValue) ?>">
<?php } ?>
<?php if ($slider->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $slider_list->lRowIndex ?>_order" id="x<?php echo $slider_list->lRowIndex ?>_order" size="30" value="<?php echo $slider->order->EditValue ?>"<?php echo $slider->order->EditAttributes() ?>>
<?php } ?>
<?php if ($slider->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $slider->order->ViewAttributes() ?>><?php echo $slider->order->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($slider->active->Visible) { // active ?>
		<td<?php echo $slider->active->CellAttributes() ?>>
<?php if ($slider->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<div id="tp_x<?php echo $slider_list->lRowIndex ?>_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x<?php echo $slider_list->lRowIndex ?>_active" id="x<?php echo $slider_list->lRowIndex ?>_active" value="{value}"<?php echo $slider->active->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $slider_list->lRowIndex ?>_active" repeatcolumn="5">
<?php
$arwrk = $slider->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($slider->active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $slider_list->lRowIndex ?>_active" id="x<?php echo $slider_list->lRowIndex ?>_active" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $slider->active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
if ($emptywrk) $slider->active->OldValue = "";
?>
</div>
<input type="hidden" name="o<?php echo $slider_list->lRowIndex ?>_active" id="o<?php echo $slider_list->lRowIndex ?>_active" value="<?php echo ew_HtmlEncode($slider->active->OldValue) ?>">
<?php } ?>
<?php if ($slider->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div id="tp_x<?php echo $slider_list->lRowIndex ?>_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x<?php echo $slider_list->lRowIndex ?>_active" id="x<?php echo $slider_list->lRowIndex ?>_active" value="{value}"<?php echo $slider->active->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $slider_list->lRowIndex ?>_active" repeatcolumn="5">
<?php
$arwrk = $slider->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($slider->active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $slider_list->lRowIndex ?>_active" id="x<?php echo $slider_list->lRowIndex ?>_active" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $slider->active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
if ($emptywrk) $slider->active->OldValue = "";
?>
</div>
<?php } ?>
<?php if ($slider->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $slider->active->ViewAttributes() ?>><?php echo $slider->active->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php if ($slider->RowType == EW_ROWTYPE_ADD || $slider->RowType == EW_ROWTYPE_EDIT) { ?>
<?php if ($slider->CurrentAction == "edit") { ?>
<td colspan="<?php echo $slider_list->lOptionCnt ?>"><span class="phpmaker">
<a href="" onclick="if (slider_list.ValidateForm(document.fsliderlist)) document.fsliderlist.submit();return false;">Update</a>&nbsp;<a href="<?php echo $slider_list->PageUrl() ?>a=cancel">Cancel</a>
<input type="hidden" name="a_list" id="a_list" value="update">
</span></td>
<?php } ?>
<?php
	if ($slider->CurrentAction == "gridedit")
		$slider_list->sMultiSelectKey .= "<input type=\"hidden\" name=\"k" . $slider_list->lRowIndex . "_key\" id=\"k" . $slider_list->lRowIndex . "_key\" value=\"" . $slider->id->CurrentValue . "\">";
?>
<?php } else { ?>
<?php if ($slider->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $slider->ViewUrl() ?>">View</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $slider->EditUrl() ?>">Edit</a><span class="ewSeparator">&nbsp;|&nbsp;</span><a href="<?php echo $slider->InlineEditUrl() ?>">Inline Edit</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $slider->CopyUrl() ?>">Copy</a><span class="ewSeparator">&nbsp;|&nbsp;</span><a href="<?php echo $slider->InlineCopyUrl() ?>">Inline Copy</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($slider_list->lOptionCnt == 0 && $slider->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($slider->id->CurrentValue) ?>" class="phpmaker" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($slider_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
<?php if ($slider->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($slider->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($slider->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($slider->CurrentAction == "add" || $slider->CurrentAction == "copy") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $slider_list->lRowIndex ?>">
<?php } ?>
<?php if ($slider->CurrentAction == "gridadd") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $slider_list->lRowIndex ?>">
<?php } ?>
<?php if ($slider->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $slider_list->lRowIndex ?>">
<?php } ?>
<?php if ($slider->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $slider_list->lRowIndex ?>">
<?php echo $slider_list->sMultiSelectKey ?>
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
<?php if ($slider_list->lTotalRecs > 0) { ?>
<?php if ($slider->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($slider->CurrentAction <> "gridadd" && $slider->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($slider_list->Pager)) $slider_list->Pager = new cPrevNextPager($slider_list->lStartRec, $slider_list->lDisplayRecs, $slider_list->lTotalRecs) ?>
<?php if ($slider_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($slider_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $slider_list->PageUrl() ?>start=<?php echo $slider_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($slider_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $slider_list->PageUrl() ?>start=<?php echo $slider_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $slider_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($slider_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $slider_list->PageUrl() ?>start=<?php echo $slider_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($slider_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $slider_list->PageUrl() ?>start=<?php echo $slider_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $slider_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $slider_list->Pager->FromIndex ?> to <?php echo $slider_list->Pager->ToIndex ?> of <?php echo $slider_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($slider_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($slider_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($slider->CurrentAction <> "gridadd" && $slider->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $slider->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<a href="<?php echo $slider_list->PageUrl() ?>a=add">Inline Add</a>&nbsp;&nbsp;
<a href="<?php echo $slider_list->PageUrl() ?>a=gridadd">Grid Add</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($slider_list->lTotalRecs > 0) { ?>
<a href="<?php echo $slider_list->PageUrl() ?>a=gridedit">Grid Edit</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if ($slider_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fsliderlist)) alert('No records selected'); else if (ew_Confirm('<?php echo $slider_list->sDeleteConfirmMsg ?>')) {document.fsliderlist.action='sliderdelete.php';document.fsliderlist.encoding='application/x-www-form-urlencoded';document.fsliderlist.submit();};return false;">Delete Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fsliderlist)) alert('No records selected'); else {document.fsliderlist.action='sliderupdate.php';document.fsliderlist.encoding='application/x-www-form-urlencoded';document.fsliderlist.submit();};return false;">Update Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($slider->CurrentAction == "gridadd") { ?>
<a href="" onclick="if (slider_list.ValidateForm(document.fsliderlist)) document.fsliderlist.submit();return false;">Insert</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($slider->CurrentAction == "gridedit") { ?>
<a href="" onclick="if (slider_list.ValidateForm(document.fsliderlist)) document.fsliderlist.submit();return false;">Save</a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php echo $slider_list->PageUrl() ?>a=cancel">Cancel</a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($slider->Export == "" && $slider->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(slider_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($slider->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$slider_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class cslider_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'slider';

	// Page Object Name
	var $PageObjName = 'slider_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $slider;
		if ($slider->UseTokenInUrl) $PageUrl .= "t=" . $slider->TableVar . "&"; // add page token
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
		global $objForm, $slider;
		if ($slider->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($slider->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($slider->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cslider_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["slider"] = new cslider();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'slider', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $slider;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$slider->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $slider->Export; // Get export parameter, used in header
	$gsExportFile = $slider->TableVar; // Get export file, used in header
	if ($slider->Export == "print" || $slider->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($slider->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($slider->Export == "word") {
		header('Content-Type: application/vnd.ms-word;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($slider->Export == "xml") {
		header('Content-Type: text/xml;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($slider->Export == "csv") {
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
		global $objForm, $gsSearchError, $Security, $slider;
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
				$slider->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($slider->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to grid edit mode
				if ($slider->CurrentAction == "gridedit")
					$this->GridEditMode();

				// Switch to inline edit mode
				if ($slider->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($slider->CurrentAction == "add" || $slider->CurrentAction == "copy")
					$this->InlineAddMode();

				// Switch to grid add mode
				if ($slider->CurrentAction == "gridadd")
					$this->GridAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$slider->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Update
					if ($slider->CurrentAction == "gridupdate" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridedit")
						$this->GridUpdate();

					// Inline Update
					if ($slider->CurrentAction == "update" && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($slider->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
						$this->InlineInsert();

					// Grid Insert
					if ($slider->CurrentAction == "gridinsert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridadd")
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
		if ($slider->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $slider->getRecordsPerPage(); // Restore from Session
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
		$slider->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$slider->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$slider->setStartRecordNumber($this->lStartRec);
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
		$slider->setSessionWhere($sFilter);
		$slider->CurrentFilter = "";

		// Export data only
		if (in_array($slider->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	//  Exit out of inline mode
	function ClearInlineMode() {
		global $slider;
		$slider->setKey("id", ""); // Clear inline edit key
		$slider->CurrentAction = ""; // Clear action
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
		global $Security, $slider;
		$bInlineEdit = TRUE;
		if (@$_GET["id"] <> "") {
			$slider->id->setQueryStringValue($_GET["id"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$slider->setKey("id", $slider->id->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to inline edit record
	function InlineUpdate() {
		global $objForm, $gsFormError, $slider;
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
				$slider->SendEmail = TRUE; // Send email on update success
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
			$slider->EventCancelled = TRUE; // Cancel event
			$slider->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check inline edit key
	function CheckInlineEditKey() {
		global $slider;

		//CheckInlineEditKey = True
		if (strval($slider->getKey("id")) <> strval($slider->id->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add Mode
	function InlineAddMode() {
		global $Security, $slider;
		if ($slider->CurrentAction == "copy") {
			if (@$_GET["id"] <> "") {
				$slider->id->setQueryStringValue($_GET["id"]);
			} else {
				$slider->CurrentAction = "add";
			}
		}
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to inline add/copy record
	function InlineInsert() {
		global $objForm, $gsFormError, $slider;
		$objForm->Index = 1;
		$this->GetUploadFiles(); // Get upload files
		$this->LoadFormValues(); // Get form values

		// Validate Form
		if (!$this->ValidateForm()) {
			$this->setMessage($gsFormError); // Set validation error message
			$slider->EventCancelled = TRUE; // Set event cancelled
			$slider->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$slider->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow()) { // Add record
			$this->setMessage("Add succeeded"); // Set add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$slider->EventCancelled = TRUE; // Set event cancelled
			$slider->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Perform update to grid
	function GridUpdate() {
		global $conn, $objForm, $gsFormError, $slider;
		$rowindex = 1;
		$bGridUpdate = TRUE;

		// Begin transaction
		$conn->BeginTrans();

		// Get old recordset
		$slider->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $slider->SQL();
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
					$slider->SendEmail = FALSE; // Do not send email on update success
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
			$slider->EventCancelled = TRUE; // Set event cancelled
			$slider->CurrentAction = "gridedit"; // Stay in gridedit mode
		}
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $slider;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $slider->KeyFilter();
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
		global $slider;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$slider->id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($slider->id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Grid Insert
	// Perform insert to grid
	function GridInsert() {
		global $conn, $objForm, $gsFormError, $slider;
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
				$slider->SendEmail = FALSE; // Do not send email on insert success

				// Validate Form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow(); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
					$sKey .= $slider->id->CurrentValue;

					// Add filter for this record
					$sFilter = $slider->KeyFilter();
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
			$slider->CurrentFilter = $sWrkFilter;
			$sSql = $slider->SQL();
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
			$slider->EventCancelled = TRUE; // Set event cancelled
			$slider->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
	}

	// Check if empty row
	function EmptyRow() {
		global $slider;
		if (!is_null($slider->image->Upload->Value))
			return FALSE;
		if ($slider->order->CurrentValue <> $slider->order->OldValue)
			return FALSE;
		if ($slider->active->CurrentValue <> $slider->active->OldValue)
			return FALSE;
		return TRUE;
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm, $slider;

		// Get row based on current index
		$objForm->Index = $idx;
		if ($slider->CurrentAction == "gridadd")
			$this->LoadFormValues(); // Load form values
		if ($slider->CurrentAction == "gridedit") {
			$sKey = strval($objForm->GetValue("k_key"));
			$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $sKey);
			if (count($arrKeyFlds) >= 1) {
				if (strval($arrKeyFlds[0]) == strval($slider->id->CurrentValue)) {
					$this->LoadFormValues(); // Load form values
				}
			}
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $slider;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $slider->id, FALSE); // Field id
		$this->BuildSearchSql($sWhere, $slider->order, FALSE); // Field order
		$this->BuildSearchSql($sWhere, $slider->active, FALSE); // Field active

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($slider->id); // Field id
			$this->SetSearchParm($slider->order); // Field order
			$this->SetSearchParm($slider->active); // Field active
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
		global $slider;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$slider->setAdvancedSearch("x_$FldParm", $FldVal);
		$slider->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$slider->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$slider->setAdvancedSearch("y_$FldParm", $FldVal2);
		$slider->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $slider;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $slider->image->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $slider;
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
			$slider->setBasicSearchKeyword($sSearchKeyword);
			$slider->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $slider;
		$this->sSrchWhere = "";
		$slider->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $slider;
		$slider->setBasicSearchKeyword("");
		$slider->setBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $slider;
		$slider->setAdvancedSearch("x_id", "");
		$slider->setAdvancedSearch("x_order", "");
		$slider->setAdvancedSearch("x_active", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $slider;
		$this->sSrchWhere = $slider->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $slider;
		 $slider->id->AdvancedSearch->SearchValue = $slider->getAdvancedSearch("x_id");
		 $slider->order->AdvancedSearch->SearchValue = $slider->getAdvancedSearch("x_order");
		 $slider->active->AdvancedSearch->SearchValue = $slider->getAdvancedSearch("x_active");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $slider;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$slider->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$slider->CurrentOrderType = @$_GET["ordertype"];
			$slider->UpdateSort($slider->id); // Field 
			$slider->UpdateSort($slider->image); // Field 
			$slider->UpdateSort($slider->order); // Field 
			$slider->UpdateSort($slider->active); // Field 
			$slider->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $slider;
		$sOrderBy = $slider->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($slider->SqlOrderBy() <> "") {
				$sOrderBy = $slider->SqlOrderBy();
				$slider->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $slider;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$slider->setSessionOrderBy($sOrderBy);
				$slider->id->setSort("");
				$slider->image->setSort("");
				$slider->order->setSort("");
				$slider->active->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$slider->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $slider;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$slider->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$slider->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $slider->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$slider->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$slider->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$slider->setStartRecordNumber($this->lStartRec);
		}
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $slider;

		// Get upload data
			$slider->image->Upload->Index = $objForm->Index;
			if ($slider->image->Upload->UploadFile()) {

				// No action required
			} else {
				echo $slider->image->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load default values
	function LoadDefaultValues() {
		global $slider;
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $slider;

		// Load search values
		// id

		$slider->id->AdvancedSearch->SearchValue = @$_GET["x_id"];
		$slider->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// order
		$slider->order->AdvancedSearch->SearchValue = @$_GET["x_order"];
		$slider->order->AdvancedSearch->SearchOperator = @$_GET["z_order"];

		// active
		$slider->active->AdvancedSearch->SearchValue = @$_GET["x_active"];
		$slider->active->AdvancedSearch->SearchOperator = @$_GET["z_active"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $slider;
		$slider->id->setFormValue($objForm->GetValue("x_id"));
		$slider->id->OldValue = $objForm->GetValue("o_id");
		$slider->order->setFormValue($objForm->GetValue("x_order"));
		$slider->order->OldValue = $objForm->GetValue("o_order");
		$slider->active->setFormValue($objForm->GetValue("x_active"));
		$slider->active->OldValue = $objForm->GetValue("o_active");
	}

	// Restore form values
	function RestoreFormValues() {
		global $slider;
		$slider->id->CurrentValue = $slider->id->FormValue;
		$slider->order->CurrentValue = $slider->order->FormValue;
		$slider->active->CurrentValue = $slider->active->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $slider;

		// Call Recordset Selecting event
		$slider->Recordset_Selecting($slider->CurrentFilter);

		// Load list page SQL
		$sSql = $slider->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$slider->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $slider;
		$sFilter = $slider->KeyFilter();

		// Call Row Selecting event
		$slider->Row_Selecting($sFilter);

		// Load sql based on filter
		$slider->CurrentFilter = $sFilter;
		$sSql = $slider->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$slider->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $slider;
		$slider->id->setDbValue($rs->fields('id'));
		$slider->image->Upload->DbValue = $rs->fields('image');
		$slider->order->setDbValue($rs->fields('order'));
		$slider->active->setDbValue($rs->fields('active'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $slider;

		// Call Row_Rendering event
		$slider->Row_Rendering();

		// Common render codes for all row types
		// id

		$slider->id->CellCssStyle = "";
		$slider->id->CellCssClass = "";

		// image
		$slider->image->CellCssStyle = "";
		$slider->image->CellCssClass = "";

		// order
		$slider->order->CellCssStyle = "";
		$slider->order->CellCssClass = "";

		// active
		$slider->active->CellCssStyle = "";
		$slider->active->CellCssClass = "";
		if ($slider->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$slider->id->ViewValue = $slider->id->CurrentValue;
			$slider->id->CssStyle = "";
			$slider->id->CssClass = "";
			$slider->id->ViewCustomAttributes = "";

			// image
			if (!is_null($slider->image->Upload->DbValue)) {
				$slider->image->ViewValue = $slider->image->Upload->DbValue;
				$slider->image->ImageWidth = 100;
				$slider->image->ImageHeight = 0;
				$slider->image->ImageAlt = "";
			} else {
				$slider->image->ViewValue = "";
			}
			$slider->image->CssStyle = "";
			$slider->image->CssClass = "";
			$slider->image->ViewCustomAttributes = "";

			// order
			$slider->order->ViewValue = $slider->order->CurrentValue;
			$slider->order->CssStyle = "";
			$slider->order->CssClass = "";
			$slider->order->ViewCustomAttributes = "";

			// active
			if (strval($slider->active->CurrentValue) <> "") {
				switch ($slider->active->CurrentValue) {
					case "0":
						$slider->active->ViewValue = "No";
						break;
					case "1":
						$slider->active->ViewValue = "Yes";
						break;
					default:
						$slider->active->ViewValue = $slider->active->CurrentValue;
				}
			} else {
				$slider->active->ViewValue = NULL;
			}
			$slider->active->CssStyle = "";
			$slider->active->CssClass = "";
			$slider->active->ViewCustomAttributes = "";

			// id
			$slider->id->HrefValue = "";

			// image
			$slider->image->HrefValue = "";

			// order
			$slider->order->HrefValue = "";

			// active
			$slider->active->HrefValue = "";
		} elseif ($slider->RowType == EW_ROWTYPE_ADD) { // Add row

			// id
			// image

			$slider->image->EditCustomAttributes = "";
			if (!is_null($slider->image->Upload->DbValue)) {
				$slider->image->EditValue = $slider->image->Upload->DbValue;
				$slider->image->ImageWidth = 100;
				$slider->image->ImageHeight = 0;
				$slider->image->ImageAlt = "";
			} else {
				$slider->image->EditValue = "";
			}

			// order
			$slider->order->EditCustomAttributes = "";
			$slider->order->EditValue = ew_HtmlEncode($slider->order->CurrentValue);

			// active
			$slider->active->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$slider->active->EditValue = $arwrk;
		} elseif ($slider->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$slider->id->EditCustomAttributes = "";
			$slider->id->EditValue = $slider->id->CurrentValue;
			$slider->id->CssStyle = "";
			$slider->id->CssClass = "";
			$slider->id->ViewCustomAttributes = "";

			// image
			$slider->image->EditCustomAttributes = "";
			if (!is_null($slider->image->Upload->DbValue)) {
				$slider->image->EditValue = $slider->image->Upload->DbValue;
				$slider->image->ImageWidth = 100;
				$slider->image->ImageHeight = 0;
				$slider->image->ImageAlt = "";
			} else {
				$slider->image->EditValue = "";
			}

			// order
			$slider->order->EditCustomAttributes = "";
			$slider->order->EditValue = ew_HtmlEncode($slider->order->CurrentValue);

			// active
			$slider->active->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$slider->active->EditValue = $arwrk;

			// Edit refer script
			// id

			$slider->id->HrefValue = "";

			// image
			$slider->image->HrefValue = "";

			// order
			$slider->order->HrefValue = "";

			// active
			$slider->active->HrefValue = "";
		}

		// Call Row Rendered event
		$slider->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $slider;

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
		global $gsFormError, $slider;

		// Initialize
		$gsFormError = "";
		if (!ew_CheckFileType($slider->image->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "File type is not allowed.";
		}
		if ($slider->image->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($slider->image->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "Max. file size (%s bytes) exceeded.");
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($slider->CurrentAction == "gridupdate" || $slider->CurrentAction == "update") {
			if ($slider->image->Upload->Action == "3" && is_null($slider->image->Upload->Value)) {
				$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
				$gsFormError .= "Please enter required field - image";
			}
		} elseif (is_null($slider->image->Upload->Value)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - image";
		}
		if ($slider->order->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - order";
		}
		if (!ew_CheckInteger($slider->order->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - order";
		}
		if ($slider->active->FormValue == "") {
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
		global $conn, $Security, $slider;
		$sFilter = $slider->KeyFilter();
		$slider->CurrentFilter = $sFilter;
		$sSql = $slider->SQL();
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

			$slider->image->Upload->SaveToSession(); // Save file value to Session
						if ($slider->image->Upload->Action == "2" || $slider->image->Upload->Action == "3") { // Update/Remove
			$slider->image->Upload->DbValue = $rs->fields('image'); // Get original value
			if (is_null($slider->image->Upload->Value)) {
				$rsnew['image'] = NULL;
			} else {
				if ($slider->image->Upload->FileName == $slider->image->Upload->DbValue) { // Upload file name same as old file name
					$rsnew['image'] = $slider->image->Upload->FileName;
				} else {
					$rsnew['image'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, "../images/"), $slider->image->Upload->FileName);
				}
			}
			}

			// Field order
			$slider->order->SetDbValueDef($slider->order->CurrentValue, 0);
			$rsnew['order'] =& $slider->order->DbValue;

			// Field active
			$slider->active->SetDbValueDef($slider->active->CurrentValue, 0);
			$rsnew['active'] =& $slider->active->DbValue;

			// Call Row Updating event
			$bUpdateRow = $slider->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {

			// Field image
			if (!is_null($slider->image->Upload->Value)) {
				if ($slider->image->Upload->FileName == $slider->image->Upload->DbValue) { // Overwrite if same file name
					$slider->image->Upload->SaveToFile("../images/", $rsnew['image'], TRUE);
					$slider->image->Upload->DbValue = ""; // No need to delete any more
				} else {
					$slider->image->Upload->SaveToFile("../images/", $rsnew['image'], FALSE);
				}
			}
			if ($slider->image->Upload->Action == "2" || $slider->image->Upload->Action == "3") { // Update/Remove
				if ($slider->image->Upload->DbValue <> "")
					@unlink(ew_UploadPathEx(TRUE, "../images/") . $slider->image->Upload->DbValue);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($slider->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($slider->CancelMessage <> "") {
					$this->setMessage($slider->CancelMessage);
					$slider->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$slider->Row_Updated($rsold, $rsnew);
		$rs->Close();

		// Field image
		$slider->image->Upload->RemoveFromSession(); // Remove file value from Session
		return $EditRow;
	}

	// Add record
	function AddRow() {
		global $conn, $Security, $slider;
		$rsnew = array();

		// Field id
		// Field image

		$slider->image->Upload->SaveToSession(); // Save file value to Session
		if (is_null($slider->image->Upload->Value)) {
			$rsnew['image'] = NULL;
		} else {
			$rsnew['image'] = ew_UploadFileNameEx(ew_UploadPathEx(True, "../images/"), $slider->image->Upload->FileName);
		}

		// Field order
		$slider->order->SetDbValueDef($slider->order->CurrentValue, 0);
		$rsnew['order'] =& $slider->order->DbValue;

		// Field active
		$slider->active->SetDbValueDef($slider->active->CurrentValue, 0);
		$rsnew['active'] =& $slider->active->DbValue;

		// Call Row Inserting event
		$bInsertRow = $slider->Row_Inserting($rsnew);
		if ($bInsertRow) {

			// Field image
			if (!is_null($slider->image->Upload->Value)) {
				if ($slider->image->Upload->FileName == $slider->image->Upload->DbValue) { // Overwrite if same file name
					$slider->image->Upload->SaveToFile("../images/", $rsnew['image'], TRUE);
					$slider->image->Upload->DbValue = ""; // No need to delete any more
				} else {
					$slider->image->Upload->SaveToFile("../images/", $rsnew['image'], FALSE);
				}
			}
			if ($slider->image->Upload->Action == "2" || $slider->image->Upload->Action == "3") { // Update/Remove
				if ($slider->image->Upload->DbValue <> "")
					@unlink(ew_UploadPathEx(TRUE, "../images/") . $slider->image->Upload->DbValue);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($slider->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($slider->CancelMessage <> "") {
				$this->setMessage($slider->CancelMessage);
				$slider->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$slider->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $slider->id->DbValue;

			// Call Row Inserted event
			$slider->Row_Inserted($rsnew);
		}

		// Field image
		$slider->image->Upload->RemoveFromSession(); // Remove file value from Session
		return $AddRow;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $slider;
		$slider->id->AdvancedSearch->SearchValue = $slider->getAdvancedSearch("x_id");
		$slider->order->AdvancedSearch->SearchValue = $slider->getAdvancedSearch("x_order");
		$slider->active->AdvancedSearch->SearchValue = $slider->getAdvancedSearch("x_active");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $slider;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($slider->ExportAll) {
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
		if ($slider->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo "\xEF\xBB\xBF";
			echo ew_ExportHeader($slider->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $slider->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id', $slider->Export);
				ew_ExportAddValue($sExportStr, 'image', $slider->Export);
				ew_ExportAddValue($sExportStr, 'order', $slider->Export);
				ew_ExportAddValue($sExportStr, 'active', $slider->Export);
				echo ew_ExportLine($sExportStr, $slider->Export);
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
				$slider->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($slider->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id', $slider->id->CurrentValue);
					$XmlDoc->AddField('image', $slider->image->CurrentValue);
					$XmlDoc->AddField('order', $slider->order->CurrentValue);
					$XmlDoc->AddField('active', $slider->active->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $slider->Export <> "csv") { // Vertical format
						echo ew_ExportField('id', $slider->id->ExportValue($slider->Export, $slider->ExportOriginalValue), $slider->Export);
						echo ew_ExportField('image', $slider->image->ExportValue($slider->Export, $slider->ExportOriginalValue), $slider->Export);
						echo ew_ExportField('order', $slider->order->ExportValue($slider->Export, $slider->ExportOriginalValue), $slider->Export);
						echo ew_ExportField('active', $slider->active->ExportValue($slider->Export, $slider->ExportOriginalValue), $slider->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $slider->id->ExportValue($slider->Export, $slider->ExportOriginalValue), $slider->Export);
						ew_ExportAddValue($sExportStr, $slider->image->ExportValue($slider->Export, $slider->ExportOriginalValue), $slider->Export);
						ew_ExportAddValue($sExportStr, $slider->order->ExportValue($slider->Export, $slider->ExportOriginalValue), $slider->Export);
						ew_ExportAddValue($sExportStr, $slider->active->ExportValue($slider->Export, $slider->ExportOriginalValue), $slider->Export);
						echo ew_ExportLine($sExportStr, $slider->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($slider->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($slider->Export);
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
