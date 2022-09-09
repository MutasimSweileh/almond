<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
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
$categories_list = new ccategories_list();
$Page =& $categories_list;

// Page init processing
$categories_list->Page_Init();

// Page main processing
$categories_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($categories->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var categories_list = new ew_Page("categories_list");

// page properties
categories_list.PageID = "list"; // page ID
var EW_PAGE_ID = categories_list.PageID; // for backward compatibility

// extend page with ValidateForm function
categories_list.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_name"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - name");
		elm = fobj.elements["x" + infix + "_name_arabic"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - name arabic");
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
categories_list.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "name")) return false;
	if (ew_ValueChanged(fobj, infix, "name_arabic")) return false;
	if (ew_ValueChanged(fobj, infix, "order")) return false;
	if (ew_ValueChanged(fobj, infix, "active")) return false;
	return true;
}

// extend page with Form_CustomValidate function
categories_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
categories_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
categories_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
categories_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
categories_list.ShowHighlightText = "Show highlight"; 
categories_list.HideHighlightText = "Hide highlight";

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
<?php if ($categories->Export == "") { ?>
<?php } ?>
<?php
if ($categories->CurrentAction == "gridadd")
	$categories->CurrentFilter = "0=1";
if ($categories->CurrentAction == "gridadd") {
	$categories_list->lStartRec = 1;
	if ($categories_list->lDisplayRecs <= 0)
		$categories_list->lDisplayRecs = 20;
	$categories_list->lTotalRecs = $categories_list->lDisplayRecs;
	$categories_list->lStopRec = $categories_list->lDisplayRecs;
} else {
	$bSelectLimit = ($categories->Export == "" && $categories->SelectLimit);
	if (!$bSelectLimit)
		$rs = $categories_list->LoadRecordset();
	$categories_list->lTotalRecs = ($bSelectLimit) ? $categories->SelectRecordCount() : $rs->RecordCount();
	$categories_list->lStartRec = 1;
	if ($categories_list->lDisplayRecs <= 0) // Display all records
		$categories_list->lDisplayRecs = $categories_list->lTotalRecs;
	if (!($categories->ExportAll && $categories->Export <> ""))
		$categories_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $categories_list->LoadRecordset($categories_list->lStartRec-1, $categories_list->lDisplayRecs);
}
?>
<p><span class="phpmaker" style="white-space: nowrap;">TABLE: categories
<?php if ($categories->Export == "" && $categories->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $categories_list->PageUrl() ?>export=print">Printer Friendly</a>
&nbsp;&nbsp;<a href="<?php echo $categories_list->PageUrl() ?>export=html">Export to HTML</a>
&nbsp;&nbsp;<a href="<?php echo $categories_list->PageUrl() ?>export=excel">Export to Excel</a>
&nbsp;&nbsp;<a href="<?php echo $categories_list->PageUrl() ?>export=word">Export to Word</a>
&nbsp;&nbsp;<a href="<?php echo $categories_list->PageUrl() ?>export=xml">Export to XML</a>
&nbsp;&nbsp;<a href="<?php echo $categories_list->PageUrl() ?>export=csv">Export to CSV</a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($categories->Export == "" && $categories->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(categories_list);" style="text-decoration: none;"><img id="categories_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="categories_list_SearchPanel">
<form name="fcategorieslistsrch" id="fcategorieslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="categories">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($categories->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Search (*)">&nbsp;
			<a href="<?php echo $categories_list->PageUrl() ?>cmd=reset">Show all</a>&nbsp;
			<a href="categoriessrch.php">Advanced Search</a>&nbsp;
			<?php if ($categories_list->sSrchWhere <> "" && $categories_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(categories_list, this, '<?php echo $categories->HighlightName() ?>');">Hide highlight</a>
			<?php } ?>
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($categories->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>Exact phrase</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($categories->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>All words</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($categories->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>Any word</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $categories_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($categories->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($categories->CurrentAction <> "gridadd" && $categories->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($categories_list->Pager)) $categories_list->Pager = new cPrevNextPager($categories_list->lStartRec, $categories_list->lDisplayRecs, $categories_list->lTotalRecs) ?>
<?php if ($categories_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($categories_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $categories_list->PageUrl() ?>start=<?php echo $categories_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($categories_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $categories_list->PageUrl() ?>start=<?php echo $categories_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $categories_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($categories_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $categories_list->PageUrl() ?>start=<?php echo $categories_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($categories_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $categories_list->PageUrl() ?>start=<?php echo $categories_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $categories_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $categories_list->Pager->FromIndex ?> to <?php echo $categories_list->Pager->ToIndex ?> of <?php echo $categories_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($categories_list->sSrchWhere == "0=101") { ?>
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
<?php if ($categories->CurrentAction <> "gridadd" && $categories->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $categories->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<a href="<?php echo $categories_list->PageUrl() ?>a=add">Inline Add</a>&nbsp;&nbsp;
<a href="<?php echo $categories_list->PageUrl() ?>a=gridadd">Grid Add</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($categories_list->lTotalRecs > 0) { ?>
<a href="<?php echo $categories_list->PageUrl() ?>a=gridedit">Grid Edit</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if ($categories_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fcategorieslist)) alert('No records selected'); else if (ew_Confirm('<?php echo $categories_list->sDeleteConfirmMsg ?>')) {document.fcategorieslist.action='categoriesdelete.php';document.fcategorieslist.encoding='application/x-www-form-urlencoded';document.fcategorieslist.submit();};return false;">Delete Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fcategorieslist)) alert('No records selected'); else {document.fcategorieslist.action='categoriesupdate.php';document.fcategorieslist.encoding='application/x-www-form-urlencoded';document.fcategorieslist.submit();};return false;">Update Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($categories->CurrentAction == "gridadd") { ?>
<a href="" onclick="if (categories_list.ValidateForm(document.fcategorieslist)) document.fcategorieslist.submit();return false;">Insert</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($categories->CurrentAction == "gridedit") { ?>
<a href="" onclick="if (categories_list.ValidateForm(document.fcategorieslist)) document.fcategorieslist.submit();return false;">Save</a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php echo $categories_list->PageUrl() ?>a=cancel">Cancel</a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fcategorieslist" id="fcategorieslist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="categories">
<?php if ($categories_list->lTotalRecs > 0 || $categories->CurrentAction == "add" || $categories->CurrentAction == "copy") { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$categories_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$categories_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$categories_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$categories_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$categories_list->lOptionCnt++; // Detail
}
if ($Security->IsLoggedIn()) {
	$categories_list->lOptionCnt++; // Multi-select
}
	$categories_list->lOptionCnt += count($categories_list->ListOptions->Items); // Custom list options
?>
<?php echo $categories->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($categories->id->Visible) { // id ?>
	<?php if ($categories->SortUrl($categories->id) == "") { ?>
		<td>id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $categories->SortUrl($categories->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>id</td><td style="width: 10px;"><?php if ($categories->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($categories->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($categories->name->Visible) { // name ?>
	<?php if ($categories->SortUrl($categories->name) == "") { ?>
		<td>name</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $categories->SortUrl($categories->name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>name&nbsp;(*)</td><td style="width: 10px;"><?php if ($categories->name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($categories->name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($categories->name_arabic->Visible) { // name_arabic ?>
	<?php if ($categories->SortUrl($categories->name_arabic) == "") { ?>
		<td>name arabic</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $categories->SortUrl($categories->name_arabic) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>name arabic&nbsp;(*)</td><td style="width: 10px;"><?php if ($categories->name_arabic->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($categories->name_arabic->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($categories->order->Visible) { // order ?>
	<?php if ($categories->SortUrl($categories->order) == "") { ?>
		<td>order</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $categories->SortUrl($categories->order) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>order</td><td style="width: 10px;"><?php if ($categories->order->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($categories->order->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($categories->active->Visible) { // active ?>
	<?php if ($categories->SortUrl($categories->active) == "") { ?>
		<td>active</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $categories->SortUrl($categories->active) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>active</td><td style="width: 10px;"><?php if ($categories->active->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($categories->active->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($categories->Export == "") { ?>
<?php if ($categories->CurrentAction <> "gridadd" && $categories->CurrentAction <> "gridedit") { ?>
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
<?php if ($categories_list->lOptionCnt == 0 && $categories->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="phpmaker" onclick="categories_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($categories_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
</thead>
<?php
	if ($categories->CurrentAction == "add" || $categories->CurrentAction == "copy") {
		$categories_list->lRowIndex = 1;
		if ($categories->CurrentAction == "copy" && !$categories_list->LoadRow())
				$categories->CurrentAction = "add";
		if ($categories->CurrentAction == "add")
			$categories_list->LoadDefaultValues();
		if ($categories->EventCancelled) // Insert failed
			$categories_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$categories->CssClass = "ewTableEditRow";
		$categories->CssStyle = "";
		$categories->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
		$categories->RowType = EW_ROWTYPE_ADD;

		// Render row
		$categories_list->RenderRow();
?>
	<tr<?php echo $categories->RowAttributes() ?>>
	<?php if ($categories->id->Visible) { // id ?>
		<td>&nbsp;</td>
	<?php } ?>
	<?php if ($categories->name->Visible) { // name ?>
		<td>
<textarea name="x<?php echo $categories_list->lRowIndex ?>_name" id="x<?php echo $categories_list->lRowIndex ?>_name" cols="35" rows="4"<?php echo $categories->name->EditAttributes() ?>><?php echo $categories->name->EditValue ?></textarea>
</td>
	<?php } ?>
	<?php if ($categories->name_arabic->Visible) { // name_arabic ?>
		<td>
<textarea name="x<?php echo $categories_list->lRowIndex ?>_name_arabic" id="x<?php echo $categories_list->lRowIndex ?>_name_arabic" cols="35" rows="4"<?php echo $categories->name_arabic->EditAttributes() ?>><?php echo $categories->name_arabic->EditValue ?></textarea>
</td>
	<?php } ?>
	<?php if ($categories->order->Visible) { // order ?>
		<td>
<input type="text" name="x<?php echo $categories_list->lRowIndex ?>_order" id="x<?php echo $categories_list->lRowIndex ?>_order" size="30" value="<?php echo $categories->order->EditValue ?>"<?php echo $categories->order->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($categories->active->Visible) { // active ?>
		<td>
<div id="tp_x<?php echo $categories_list->lRowIndex ?>_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x<?php echo $categories_list->lRowIndex ?>_active" id="x<?php echo $categories_list->lRowIndex ?>_active" value="{value}"<?php echo $categories->active->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $categories_list->lRowIndex ?>_active" repeatcolumn="5">
<?php
$arwrk = $categories->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($categories->active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $categories_list->lRowIndex ?>_active" id="x<?php echo $categories_list->lRowIndex ?>_active" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $categories->active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
if ($emptywrk) $categories->active->OldValue = "";
?>
</div>
</td>
	<?php } ?>
<td colspan="<?php echo $categories_list->lOptionCnt ?>"><span class="phpmaker">
<a href="" onclick="if (categories_list.ValidateForm(document.fcategorieslist)) document.fcategorieslist.submit();return false;">Insert</a>&nbsp;<a href="<?php echo $categories_list->PageUrl() ?>a=cancel">Cancel</a>
<input type="hidden" name="a_list" id="a_list" value="insert">
</span></td>
	</tr>
<?php
}
?>
<?php
if ($categories->ExportAll && $categories->Export <> "") {
	$categories_list->lStopRec = $categories_list->lTotalRecs;
} else {
	$categories_list->lStopRec = $categories_list->lStartRec + $categories_list->lDisplayRecs - 1; // Set the last record to display
}
$categories_list->lRecCount = $categories_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$categories->SelectLimit && $categories_list->lStartRec > 1)
		$rs->Move($categories_list->lStartRec - 1);
}
$categories_list->lRowCnt = 0;
$categories_list->lEditRowCnt = 0;
if ($categories->CurrentAction == "edit")
	$categories_list->lRowIndex = 1;
if ($categories->CurrentAction == "gridadd")
	$categories_list->lRowIndex = 0;
if ($categories->CurrentAction == "gridedit")
	$categories_list->lRowIndex = 0;
while (($categories->CurrentAction == "gridadd" || !$rs->EOF) &&
	$categories_list->lRecCount < $categories_list->lStopRec) {
	$categories_list->lRecCount++;
	if (intval($categories_list->lRecCount) >= intval($categories_list->lStartRec)) {
		$categories_list->lRowCnt++;
		if ($categories->CurrentAction == "gridadd" || $categories->CurrentAction == "gridedit")
			$categories_list->lRowIndex++;

	// Init row class and style
	$categories->CssClass = "";
	$categories->CssStyle = "";
	$categories->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($categories->CurrentAction == "gridadd") {
		$categories_list->LoadDefaultValues(); // Load default values
	} else {
		$categories_list->LoadRowValues($rs); // Load row values
	}
	$categories->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($categories->CurrentAction == "gridadd") // Grid add
		$categories->RowType = EW_ROWTYPE_ADD; // Render add
	if ($categories->CurrentAction == "gridadd" && $categories->EventCancelled) // Insert failed
		$categories_list->RestoreCurrentRowFormValues($categories_list->lRowIndex); // Restore form values
	if ($categories->CurrentAction == "edit") {
		if ($categories_list->CheckInlineEditKey() && $categories_list->lEditRowCnt == 0) // Inline edit
			$categories->RowType = EW_ROWTYPE_EDIT; // Render edit
	}
	if ($categories->CurrentAction == "gridedit") // Grid edit
		$categories->RowType = EW_ROWTYPE_EDIT; // Render edit
	if ($categories->RowType == EW_ROWTYPE_EDIT && $categories->EventCancelled) { // Update failed
		if ($categories->CurrentAction == "edit")
			$categories_list->RestoreFormValues(); // Restore form values
		if ($categories->CurrentAction == "gridedit")
			$categories_list->RestoreCurrentRowFormValues($categories_list->lRowIndex); // Restore form values
	}
	if ($categories->RowType == EW_ROWTYPE_EDIT) { // Edit row
		$categories_list->lEditRowCnt++;
		$categories->RowClientEvents = "onmouseover='this.edit=true;ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	}
	if ($categories->RowType == EW_ROWTYPE_ADD || $categories->RowType == EW_ROWTYPE_EDIT) // Add / Edit row
			$categories->CssClass = "ewTableEditRow";

	// Render row
	$categories_list->RenderRow();
?>
	<tr<?php echo $categories->RowAttributes() ?>>
	<?php if ($categories->id->Visible) { // id ?>
		<td<?php echo $categories->id->CellAttributes() ?>>
<?php if ($categories->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $categories_list->lRowIndex ?>_id" id="o<?php echo $categories_list->lRowIndex ?>_id" value="<?php echo ew_HtmlEncode($categories->id->OldValue) ?>">
<?php } ?>
<?php if ($categories->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $categories->id->ViewAttributes() ?>><?php echo $categories->id->EditValue ?></div><input type="hidden" name="x<?php echo $categories_list->lRowIndex ?>_id" id="x<?php echo $categories_list->lRowIndex ?>_id" value="<?php echo ew_HtmlEncode($categories->id->CurrentValue) ?>">
<?php } ?>
<?php if ($categories->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $categories->id->ViewAttributes() ?>><?php echo $categories->id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($categories->name->Visible) { // name ?>
		<td<?php echo $categories->name->CellAttributes() ?>>
<?php if ($categories->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<textarea name="x<?php echo $categories_list->lRowIndex ?>_name" id="x<?php echo $categories_list->lRowIndex ?>_name" cols="35" rows="4"<?php echo $categories->name->EditAttributes() ?>><?php echo $categories->name->EditValue ?></textarea>
<input type="hidden" name="o<?php echo $categories_list->lRowIndex ?>_name" id="o<?php echo $categories_list->lRowIndex ?>_name" value="<?php echo ew_HtmlEncode($categories->name->OldValue) ?>">
<?php } ?>
<?php if ($categories->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<textarea name="x<?php echo $categories_list->lRowIndex ?>_name" id="x<?php echo $categories_list->lRowIndex ?>_name" cols="35" rows="4"<?php echo $categories->name->EditAttributes() ?>><?php echo $categories->name->EditValue ?></textarea>
<?php } ?>
<?php if ($categories->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $categories->name->ViewAttributes() ?>><?php echo $categories->name->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($categories->name_arabic->Visible) { // name_arabic ?>
		<td<?php echo $categories->name_arabic->CellAttributes() ?>>
<?php if ($categories->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<textarea name="x<?php echo $categories_list->lRowIndex ?>_name_arabic" id="x<?php echo $categories_list->lRowIndex ?>_name_arabic" cols="35" rows="4"<?php echo $categories->name_arabic->EditAttributes() ?>><?php echo $categories->name_arabic->EditValue ?></textarea>
<input type="hidden" name="o<?php echo $categories_list->lRowIndex ?>_name_arabic" id="o<?php echo $categories_list->lRowIndex ?>_name_arabic" value="<?php echo ew_HtmlEncode($categories->name_arabic->OldValue) ?>">
<?php } ?>
<?php if ($categories->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<textarea name="x<?php echo $categories_list->lRowIndex ?>_name_arabic" id="x<?php echo $categories_list->lRowIndex ?>_name_arabic" cols="35" rows="4"<?php echo $categories->name_arabic->EditAttributes() ?>><?php echo $categories->name_arabic->EditValue ?></textarea>
<?php } ?>
<?php if ($categories->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $categories->name_arabic->ViewAttributes() ?>><?php echo $categories->name_arabic->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($categories->order->Visible) { // order ?>
		<td<?php echo $categories->order->CellAttributes() ?>>
<?php if ($categories->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $categories_list->lRowIndex ?>_order" id="x<?php echo $categories_list->lRowIndex ?>_order" size="30" value="<?php echo $categories->order->EditValue ?>"<?php echo $categories->order->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $categories_list->lRowIndex ?>_order" id="o<?php echo $categories_list->lRowIndex ?>_order" value="<?php echo ew_HtmlEncode($categories->order->OldValue) ?>">
<?php } ?>
<?php if ($categories->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $categories_list->lRowIndex ?>_order" id="x<?php echo $categories_list->lRowIndex ?>_order" size="30" value="<?php echo $categories->order->EditValue ?>"<?php echo $categories->order->EditAttributes() ?>>
<?php } ?>
<?php if ($categories->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $categories->order->ViewAttributes() ?>><?php echo $categories->order->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($categories->active->Visible) { // active ?>
		<td<?php echo $categories->active->CellAttributes() ?>>
<?php if ($categories->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<div id="tp_x<?php echo $categories_list->lRowIndex ?>_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x<?php echo $categories_list->lRowIndex ?>_active" id="x<?php echo $categories_list->lRowIndex ?>_active" value="{value}"<?php echo $categories->active->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $categories_list->lRowIndex ?>_active" repeatcolumn="5">
<?php
$arwrk = $categories->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($categories->active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $categories_list->lRowIndex ?>_active" id="x<?php echo $categories_list->lRowIndex ?>_active" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $categories->active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
if ($emptywrk) $categories->active->OldValue = "";
?>
</div>
<input type="hidden" name="o<?php echo $categories_list->lRowIndex ?>_active" id="o<?php echo $categories_list->lRowIndex ?>_active" value="<?php echo ew_HtmlEncode($categories->active->OldValue) ?>">
<?php } ?>
<?php if ($categories->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div id="tp_x<?php echo $categories_list->lRowIndex ?>_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x<?php echo $categories_list->lRowIndex ?>_active" id="x<?php echo $categories_list->lRowIndex ?>_active" value="{value}"<?php echo $categories->active->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $categories_list->lRowIndex ?>_active" repeatcolumn="5">
<?php
$arwrk = $categories->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($categories->active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $categories_list->lRowIndex ?>_active" id="x<?php echo $categories_list->lRowIndex ?>_active" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $categories->active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
if ($emptywrk) $categories->active->OldValue = "";
?>
</div>
<?php } ?>
<?php if ($categories->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $categories->active->ViewAttributes() ?>><?php echo $categories->active->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php if ($categories->RowType == EW_ROWTYPE_ADD || $categories->RowType == EW_ROWTYPE_EDIT) { ?>
<?php if ($categories->CurrentAction == "edit") { ?>
<td colspan="<?php echo $categories_list->lOptionCnt ?>"><span class="phpmaker">
<a href="" onclick="if (categories_list.ValidateForm(document.fcategorieslist)) document.fcategorieslist.submit();return false;">Update</a>&nbsp;<a href="<?php echo $categories_list->PageUrl() ?>a=cancel">Cancel</a>
<input type="hidden" name="a_list" id="a_list" value="update">
</span></td>
<?php } ?>
<?php
	if ($categories->CurrentAction == "gridedit")
		$categories_list->sMultiSelectKey .= "<input type=\"hidden\" name=\"k" . $categories_list->lRowIndex . "_key\" id=\"k" . $categories_list->lRowIndex . "_key\" value=\"" . $categories->id->CurrentValue . "\">";
?>
<?php } else { ?>
<?php if ($categories->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $categories->ViewUrl() ?>">View</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $categories->EditUrl() ?>">Edit</a><span class="ewSeparator">&nbsp;|&nbsp;</span><a href="<?php echo $categories->InlineEditUrl() ?>">Inline Edit</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $categories->CopyUrl() ?>">Copy</a><span class="ewSeparator">&nbsp;|&nbsp;</span><a href="<?php echo $categories->InlineCopyUrl() ?>">Inline Copy</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($categories_list->lOptionCnt == 0 && $categories->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="gallerylist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=categories&id=<?php echo urlencode(strval($categories->id->CurrentValue)) ?>">gallery...</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($categories->id->CurrentValue) ?>" class="phpmaker" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($categories_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
<?php if ($categories->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($categories->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($categories->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($categories->CurrentAction == "add" || $categories->CurrentAction == "copy") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $categories_list->lRowIndex ?>">
<?php } ?>
<?php if ($categories->CurrentAction == "gridadd") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $categories_list->lRowIndex ?>">
<?php } ?>
<?php if ($categories->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $categories_list->lRowIndex ?>">
<?php } ?>
<?php if ($categories->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $categories_list->lRowIndex ?>">
<?php echo $categories_list->sMultiSelectKey ?>
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
<?php if ($categories_list->lTotalRecs > 0) { ?>
<?php if ($categories->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($categories->CurrentAction <> "gridadd" && $categories->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($categories_list->Pager)) $categories_list->Pager = new cPrevNextPager($categories_list->lStartRec, $categories_list->lDisplayRecs, $categories_list->lTotalRecs) ?>
<?php if ($categories_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($categories_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $categories_list->PageUrl() ?>start=<?php echo $categories_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($categories_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $categories_list->PageUrl() ?>start=<?php echo $categories_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $categories_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($categories_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $categories_list->PageUrl() ?>start=<?php echo $categories_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($categories_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $categories_list->PageUrl() ?>start=<?php echo $categories_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $categories_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $categories_list->Pager->FromIndex ?> to <?php echo $categories_list->Pager->ToIndex ?> of <?php echo $categories_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($categories_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($categories_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($categories->CurrentAction <> "gridadd" && $categories->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $categories->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<a href="<?php echo $categories_list->PageUrl() ?>a=add">Inline Add</a>&nbsp;&nbsp;
<a href="<?php echo $categories_list->PageUrl() ?>a=gridadd">Grid Add</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($categories_list->lTotalRecs > 0) { ?>
<a href="<?php echo $categories_list->PageUrl() ?>a=gridedit">Grid Edit</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if ($categories_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fcategorieslist)) alert('No records selected'); else if (ew_Confirm('<?php echo $categories_list->sDeleteConfirmMsg ?>')) {document.fcategorieslist.action='categoriesdelete.php';document.fcategorieslist.encoding='application/x-www-form-urlencoded';document.fcategorieslist.submit();};return false;">Delete Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fcategorieslist)) alert('No records selected'); else {document.fcategorieslist.action='categoriesupdate.php';document.fcategorieslist.encoding='application/x-www-form-urlencoded';document.fcategorieslist.submit();};return false;">Update Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($categories->CurrentAction == "gridadd") { ?>
<a href="" onclick="if (categories_list.ValidateForm(document.fcategorieslist)) document.fcategorieslist.submit();return false;">Insert</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($categories->CurrentAction == "gridedit") { ?>
<a href="" onclick="if (categories_list.ValidateForm(document.fcategorieslist)) document.fcategorieslist.submit();return false;">Save</a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php echo $categories_list->PageUrl() ?>a=cancel">Cancel</a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($categories->Export == "" && $categories->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(categories_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($categories->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$categories_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class ccategories_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'categories';

	// Page Object Name
	var $PageObjName = 'categories_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $categories;
		if ($categories->UseTokenInUrl) $PageUrl .= "t=" . $categories->TableVar . "&"; // add page token
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
		global $objForm, $categories;
		if ($categories->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($categories->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($categories->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccategories_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["categories"] = new ccategories();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'categories', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $categories;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$categories->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $categories->Export; // Get export parameter, used in header
	$gsExportFile = $categories->TableVar; // Get export file, used in header
	if ($categories->Export == "print" || $categories->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($categories->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($categories->Export == "word") {
		header('Content-Type: application/vnd.ms-word;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($categories->Export == "xml") {
		header('Content-Type: text/xml;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($categories->Export == "csv") {
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
		global $objForm, $gsSearchError, $Security, $categories;
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
				$categories->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($categories->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to grid edit mode
				if ($categories->CurrentAction == "gridedit")
					$this->GridEditMode();

				// Switch to inline edit mode
				if ($categories->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($categories->CurrentAction == "add" || $categories->CurrentAction == "copy")
					$this->InlineAddMode();

				// Switch to grid add mode
				if ($categories->CurrentAction == "gridadd")
					$this->GridAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$categories->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Update
					if ($categories->CurrentAction == "gridupdate" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridedit")
						$this->GridUpdate();

					// Inline Update
					if ($categories->CurrentAction == "update" && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($categories->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
						$this->InlineInsert();

					// Grid Insert
					if ($categories->CurrentAction == "gridinsert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridadd")
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
		if ($categories->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $categories->getRecordsPerPage(); // Restore from Session
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
		$categories->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$categories->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$categories->setStartRecordNumber($this->lStartRec);
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
		$categories->setSessionWhere($sFilter);
		$categories->CurrentFilter = "";

		// Export data only
		if (in_array($categories->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	//  Exit out of inline mode
	function ClearInlineMode() {
		global $categories;
		$categories->setKey("id", ""); // Clear inline edit key
		$categories->CurrentAction = ""; // Clear action
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
		global $Security, $categories;
		$bInlineEdit = TRUE;
		if (@$_GET["id"] <> "") {
			$categories->id->setQueryStringValue($_GET["id"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$categories->setKey("id", $categories->id->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to inline edit record
	function InlineUpdate() {
		global $objForm, $gsFormError, $categories;
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
				$categories->SendEmail = TRUE; // Send email on update success
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
			$categories->EventCancelled = TRUE; // Cancel event
			$categories->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check inline edit key
	function CheckInlineEditKey() {
		global $categories;

		//CheckInlineEditKey = True
		if (strval($categories->getKey("id")) <> strval($categories->id->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add Mode
	function InlineAddMode() {
		global $Security, $categories;
		if ($categories->CurrentAction == "copy") {
			if (@$_GET["id"] <> "") {
				$categories->id->setQueryStringValue($_GET["id"]);
			} else {
				$categories->CurrentAction = "add";
			}
		}
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to inline add/copy record
	function InlineInsert() {
		global $objForm, $gsFormError, $categories;
		$objForm->Index = 1;
		$this->LoadFormValues(); // Get form values

		// Validate Form
		if (!$this->ValidateForm()) {
			$this->setMessage($gsFormError); // Set validation error message
			$categories->EventCancelled = TRUE; // Set event cancelled
			$categories->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$categories->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow()) { // Add record
			$this->setMessage("Add succeeded"); // Set add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$categories->EventCancelled = TRUE; // Set event cancelled
			$categories->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Perform update to grid
	function GridUpdate() {
		global $conn, $objForm, $gsFormError, $categories;
		$rowindex = 1;
		$bGridUpdate = TRUE;

		// Begin transaction
		$conn->BeginTrans();

		// Get old recordset
		$categories->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $categories->SQL();
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
					$categories->SendEmail = FALSE; // Do not send email on update success
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
			$categories->EventCancelled = TRUE; // Set event cancelled
			$categories->CurrentAction = "gridedit"; // Stay in gridedit mode
		}
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $categories;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $categories->KeyFilter();
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
		global $categories;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$categories->id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($categories->id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Grid Insert
	// Perform insert to grid
	function GridInsert() {
		global $conn, $objForm, $gsFormError, $categories;
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
				$categories->SendEmail = FALSE; // Do not send email on insert success

				// Validate Form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow(); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
					$sKey .= $categories->id->CurrentValue;

					// Add filter for this record
					$sFilter = $categories->KeyFilter();
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
			$categories->CurrentFilter = $sWrkFilter;
			$sSql = $categories->SQL();
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
			$categories->EventCancelled = TRUE; // Set event cancelled
			$categories->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
	}

	// Check if empty row
	function EmptyRow() {
		global $categories;
		if ($categories->name->CurrentValue <> $categories->name->OldValue)
			return FALSE;
		if ($categories->name_arabic->CurrentValue <> $categories->name_arabic->OldValue)
			return FALSE;
		if ($categories->order->CurrentValue <> $categories->order->OldValue)
			return FALSE;
		if ($categories->active->CurrentValue <> $categories->active->OldValue)
			return FALSE;
		return TRUE;
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm, $categories;

		// Get row based on current index
		$objForm->Index = $idx;
		if ($categories->CurrentAction == "gridadd")
			$this->LoadFormValues(); // Load form values
		if ($categories->CurrentAction == "gridedit") {
			$sKey = strval($objForm->GetValue("k_key"));
			$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $sKey);
			if (count($arrKeyFlds) >= 1) {
				if (strval($arrKeyFlds[0]) == strval($categories->id->CurrentValue)) {
					$this->LoadFormValues(); // Load form values
				}
			}
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $categories;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $categories->id, FALSE); // Field id
		$this->BuildSearchSql($sWhere, $categories->name, FALSE); // Field name
		$this->BuildSearchSql($sWhere, $categories->name_arabic, FALSE); // Field name_arabic
		$this->BuildSearchSql($sWhere, $categories->order, FALSE); // Field order
		$this->BuildSearchSql($sWhere, $categories->active, FALSE); // Field active

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($categories->id); // Field id
			$this->SetSearchParm($categories->name); // Field name
			$this->SetSearchParm($categories->name_arabic); // Field name_arabic
			$this->SetSearchParm($categories->order); // Field order
			$this->SetSearchParm($categories->active); // Field active
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
		global $categories;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$categories->setAdvancedSearch("x_$FldParm", $FldVal);
		$categories->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$categories->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$categories->setAdvancedSearch("y_$FldParm", $FldVal2);
		$categories->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $categories;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $categories->name->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $categories->name_arabic->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $categories;
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
			$categories->setBasicSearchKeyword($sSearchKeyword);
			$categories->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $categories;
		$this->sSrchWhere = "";
		$categories->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $categories;
		$categories->setBasicSearchKeyword("");
		$categories->setBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $categories;
		$categories->setAdvancedSearch("x_id", "");
		$categories->setAdvancedSearch("x_name", "");
		$categories->setAdvancedSearch("x_name_arabic", "");
		$categories->setAdvancedSearch("x_order", "");
		$categories->setAdvancedSearch("x_active", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $categories;
		$this->sSrchWhere = $categories->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $categories;
		 $categories->id->AdvancedSearch->SearchValue = $categories->getAdvancedSearch("x_id");
		 $categories->name->AdvancedSearch->SearchValue = $categories->getAdvancedSearch("x_name");
		 $categories->name_arabic->AdvancedSearch->SearchValue = $categories->getAdvancedSearch("x_name_arabic");
		 $categories->order->AdvancedSearch->SearchValue = $categories->getAdvancedSearch("x_order");
		 $categories->active->AdvancedSearch->SearchValue = $categories->getAdvancedSearch("x_active");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $categories;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$categories->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$categories->CurrentOrderType = @$_GET["ordertype"];
			$categories->UpdateSort($categories->id); // Field 
			$categories->UpdateSort($categories->name); // Field 
			$categories->UpdateSort($categories->name_arabic); // Field 
			$categories->UpdateSort($categories->order); // Field 
			$categories->UpdateSort($categories->active); // Field 
			$categories->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $categories;
		$sOrderBy = $categories->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($categories->SqlOrderBy() <> "") {
				$sOrderBy = $categories->SqlOrderBy();
				$categories->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $categories;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$categories->setSessionOrderBy($sOrderBy);
				$categories->id->setSort("");
				$categories->name->setSort("");
				$categories->name_arabic->setSort("");
				$categories->order->setSort("");
				$categories->active->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$categories->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $categories;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$categories->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$categories->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $categories->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$categories->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$categories->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$categories->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $categories;
		$categories->order->CurrentValue = 0;
		$categories->order->OldValue = $categories->order->CurrentValue;
		$categories->active->CurrentValue = 0;
		$categories->active->OldValue = $categories->active->CurrentValue;
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $categories;

		// Load search values
		// id

		$categories->id->AdvancedSearch->SearchValue = @$_GET["x_id"];
		$categories->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// name
		$categories->name->AdvancedSearch->SearchValue = @$_GET["x_name"];
		$categories->name->AdvancedSearch->SearchOperator = @$_GET["z_name"];

		// name_arabic
		$categories->name_arabic->AdvancedSearch->SearchValue = @$_GET["x_name_arabic"];
		$categories->name_arabic->AdvancedSearch->SearchOperator = @$_GET["z_name_arabic"];

		// order
		$categories->order->AdvancedSearch->SearchValue = @$_GET["x_order"];
		$categories->order->AdvancedSearch->SearchOperator = @$_GET["z_order"];

		// active
		$categories->active->AdvancedSearch->SearchValue = @$_GET["x_active"];
		$categories->active->AdvancedSearch->SearchOperator = @$_GET["z_active"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $categories;
		$categories->id->setFormValue($objForm->GetValue("x_id"));
		$categories->id->OldValue = $objForm->GetValue("o_id");
		$categories->name->setFormValue($objForm->GetValue("x_name"));
		$categories->name->OldValue = $objForm->GetValue("o_name");
		$categories->name_arabic->setFormValue($objForm->GetValue("x_name_arabic"));
		$categories->name_arabic->OldValue = $objForm->GetValue("o_name_arabic");
		$categories->order->setFormValue($objForm->GetValue("x_order"));
		$categories->order->OldValue = $objForm->GetValue("o_order");
		$categories->active->setFormValue($objForm->GetValue("x_active"));
		$categories->active->OldValue = $objForm->GetValue("o_active");
	}

	// Restore form values
	function RestoreFormValues() {
		global $categories;
		$categories->id->CurrentValue = $categories->id->FormValue;
		$categories->name->CurrentValue = $categories->name->FormValue;
		$categories->name_arabic->CurrentValue = $categories->name_arabic->FormValue;
		$categories->order->CurrentValue = $categories->order->FormValue;
		$categories->active->CurrentValue = $categories->active->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $categories;

		// Call Recordset Selecting event
		$categories->Recordset_Selecting($categories->CurrentFilter);

		// Load list page SQL
		$sSql = $categories->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$categories->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $categories;
		$sFilter = $categories->KeyFilter();

		// Call Row Selecting event
		$categories->Row_Selecting($sFilter);

		// Load sql based on filter
		$categories->CurrentFilter = $sFilter;
		$sSql = $categories->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$categories->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $categories;
		$categories->id->setDbValue($rs->fields('id'));
		$categories->name->setDbValue($rs->fields('name'));
		$categories->name_arabic->setDbValue($rs->fields('name_arabic'));
		$categories->order->setDbValue($rs->fields('order'));
		$categories->active->setDbValue($rs->fields('active'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $categories;

		// Call Row_Rendering event
		$categories->Row_Rendering();

		// Common render codes for all row types
		// id

		$categories->id->CellCssStyle = "";
		$categories->id->CellCssClass = "";

		// name
		$categories->name->CellCssStyle = "";
		$categories->name->CellCssClass = "";

		// name_arabic
		$categories->name_arabic->CellCssStyle = "";
		$categories->name_arabic->CellCssClass = "";

		// order
		$categories->order->CellCssStyle = "";
		$categories->order->CellCssClass = "";

		// active
		$categories->active->CellCssStyle = "";
		$categories->active->CellCssClass = "";
		if ($categories->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$categories->id->ViewValue = $categories->id->CurrentValue;
			$categories->id->CssStyle = "";
			$categories->id->CssClass = "";
			$categories->id->ViewCustomAttributes = "";

			// name
			$categories->name->ViewValue = $categories->name->CurrentValue;
			if ($categories->Export == "")
				$categories->name->ViewValue = ew_Highlight($categories->HighlightName(), $categories->name->ViewValue, $categories->getBasicSearchKeyword(), $categories->getBasicSearchType(), $categories->getAdvancedSearch("x_name"));
			$categories->name->CssStyle = "";
			$categories->name->CssClass = "";
			$categories->name->ViewCustomAttributes = "";

			// name_arabic
			$categories->name_arabic->ViewValue = $categories->name_arabic->CurrentValue;
			if ($categories->Export == "")
				$categories->name_arabic->ViewValue = ew_Highlight($categories->HighlightName(), $categories->name_arabic->ViewValue, $categories->getBasicSearchKeyword(), $categories->getBasicSearchType(), $categories->getAdvancedSearch("x_name_arabic"));
			$categories->name_arabic->CssStyle = "";
			$categories->name_arabic->CssClass = "";
			$categories->name_arabic->ViewCustomAttributes = "";

			// order
			$categories->order->ViewValue = $categories->order->CurrentValue;
			$categories->order->CssStyle = "";
			$categories->order->CssClass = "";
			$categories->order->ViewCustomAttributes = "";

			// active
			if (strval($categories->active->CurrentValue) <> "") {
				switch ($categories->active->CurrentValue) {
					case "0":
						$categories->active->ViewValue = "No";
						break;
					case "1":
						$categories->active->ViewValue = "Yes";
						break;
					default:
						$categories->active->ViewValue = $categories->active->CurrentValue;
				}
			} else {
				$categories->active->ViewValue = NULL;
			}
			$categories->active->CssStyle = "";
			$categories->active->CssClass = "";
			$categories->active->ViewCustomAttributes = "";

			// id
			$categories->id->HrefValue = "";

			// name
			$categories->name->HrefValue = "";

			// name_arabic
			$categories->name_arabic->HrefValue = "";

			// order
			$categories->order->HrefValue = "";

			// active
			$categories->active->HrefValue = "";
		} elseif ($categories->RowType == EW_ROWTYPE_ADD) { // Add row

			// id
			// name

			$categories->name->EditCustomAttributes = "";
			$categories->name->EditValue = ew_HtmlEncode($categories->name->CurrentValue);

			// name_arabic
			$categories->name_arabic->EditCustomAttributes = "";
			$categories->name_arabic->EditValue = ew_HtmlEncode($categories->name_arabic->CurrentValue);

			// order
			$categories->order->EditCustomAttributes = "";
			$categories->order->EditValue = ew_HtmlEncode($categories->order->CurrentValue);

			// active
			$categories->active->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$categories->active->EditValue = $arwrk;
		} elseif ($categories->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$categories->id->EditCustomAttributes = "";
			$categories->id->EditValue = $categories->id->CurrentValue;
			$categories->id->CssStyle = "";
			$categories->id->CssClass = "";
			$categories->id->ViewCustomAttributes = "";

			// name
			$categories->name->EditCustomAttributes = "";
			$categories->name->EditValue = ew_HtmlEncode($categories->name->CurrentValue);

			// name_arabic
			$categories->name_arabic->EditCustomAttributes = "";
			$categories->name_arabic->EditValue = ew_HtmlEncode($categories->name_arabic->CurrentValue);

			// order
			$categories->order->EditCustomAttributes = "";
			$categories->order->EditValue = ew_HtmlEncode($categories->order->CurrentValue);

			// active
			$categories->active->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$categories->active->EditValue = $arwrk;

			// Edit refer script
			// id

			$categories->id->HrefValue = "";

			// name
			$categories->name->HrefValue = "";

			// name_arabic
			$categories->name_arabic->HrefValue = "";

			// order
			$categories->order->HrefValue = "";

			// active
			$categories->active->HrefValue = "";
		}

		// Call Row Rendered event
		$categories->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $categories;

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
		global $gsFormError, $categories;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($categories->name->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - name";
		}
		if ($categories->name_arabic->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - name arabic";
		}
		if ($categories->order->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - order";
		}
		if (!ew_CheckInteger($categories->order->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - order";
		}
		if ($categories->active->FormValue == "") {
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
		global $conn, $Security, $categories;
		$sFilter = $categories->KeyFilter();
		$categories->CurrentFilter = $sFilter;
		$sSql = $categories->SQL();
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
			// Field name

			$categories->name->SetDbValueDef($categories->name->CurrentValue, "");
			$rsnew['name'] =& $categories->name->DbValue;

			// Field name_arabic
			$categories->name_arabic->SetDbValueDef($categories->name_arabic->CurrentValue, "");
			$rsnew['name_arabic'] =& $categories->name_arabic->DbValue;

			// Field order
			$categories->order->SetDbValueDef($categories->order->CurrentValue, 0);
			$rsnew['order'] =& $categories->order->DbValue;

			// Field active
			$categories->active->SetDbValueDef($categories->active->CurrentValue, 0);
			$rsnew['active'] =& $categories->active->DbValue;

			// Call Row Updating event
			$bUpdateRow = $categories->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($categories->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($categories->CancelMessage <> "") {
					$this->setMessage($categories->CancelMessage);
					$categories->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$categories->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow() {
		global $conn, $Security, $categories;
		$rsnew = array();

		// Field id
		// Field name

		$categories->name->SetDbValueDef($categories->name->CurrentValue, "");
		$rsnew['name'] =& $categories->name->DbValue;

		// Field name_arabic
		$categories->name_arabic->SetDbValueDef($categories->name_arabic->CurrentValue, "");
		$rsnew['name_arabic'] =& $categories->name_arabic->DbValue;

		// Field order
		$categories->order->SetDbValueDef($categories->order->CurrentValue, 0);
		$rsnew['order'] =& $categories->order->DbValue;

		// Field active
		$categories->active->SetDbValueDef($categories->active->CurrentValue, 0);
		$rsnew['active'] =& $categories->active->DbValue;

		// Call Row Inserting event
		$bInsertRow = $categories->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($categories->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($categories->CancelMessage <> "") {
				$this->setMessage($categories->CancelMessage);
				$categories->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$categories->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $categories->id->DbValue;

			// Call Row Inserted event
			$categories->Row_Inserted($rsnew);
		}
		return $AddRow;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $categories;
		$categories->id->AdvancedSearch->SearchValue = $categories->getAdvancedSearch("x_id");
		$categories->name->AdvancedSearch->SearchValue = $categories->getAdvancedSearch("x_name");
		$categories->name_arabic->AdvancedSearch->SearchValue = $categories->getAdvancedSearch("x_name_arabic");
		$categories->order->AdvancedSearch->SearchValue = $categories->getAdvancedSearch("x_order");
		$categories->active->AdvancedSearch->SearchValue = $categories->getAdvancedSearch("x_active");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $categories;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($categories->ExportAll) {
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
		if ($categories->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo "\xEF\xBB\xBF";
			echo ew_ExportHeader($categories->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $categories->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id', $categories->Export);
				ew_ExportAddValue($sExportStr, 'name', $categories->Export);
				ew_ExportAddValue($sExportStr, 'name_arabic', $categories->Export);
				ew_ExportAddValue($sExportStr, 'order', $categories->Export);
				ew_ExportAddValue($sExportStr, 'active', $categories->Export);
				echo ew_ExportLine($sExportStr, $categories->Export);
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
				$categories->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($categories->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id', $categories->id->CurrentValue);
					$XmlDoc->AddField('name', $categories->name->CurrentValue);
					$XmlDoc->AddField('name_arabic', $categories->name_arabic->CurrentValue);
					$XmlDoc->AddField('order', $categories->order->CurrentValue);
					$XmlDoc->AddField('active', $categories->active->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $categories->Export <> "csv") { // Vertical format
						echo ew_ExportField('id', $categories->id->ExportValue($categories->Export, $categories->ExportOriginalValue), $categories->Export);
						echo ew_ExportField('name', $categories->name->ExportValue($categories->Export, $categories->ExportOriginalValue), $categories->Export);
						echo ew_ExportField('name_arabic', $categories->name_arabic->ExportValue($categories->Export, $categories->ExportOriginalValue), $categories->Export);
						echo ew_ExportField('order', $categories->order->ExportValue($categories->Export, $categories->ExportOriginalValue), $categories->Export);
						echo ew_ExportField('active', $categories->active->ExportValue($categories->Export, $categories->ExportOriginalValue), $categories->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $categories->id->ExportValue($categories->Export, $categories->ExportOriginalValue), $categories->Export);
						ew_ExportAddValue($sExportStr, $categories->name->ExportValue($categories->Export, $categories->ExportOriginalValue), $categories->Export);
						ew_ExportAddValue($sExportStr, $categories->name_arabic->ExportValue($categories->Export, $categories->ExportOriginalValue), $categories->Export);
						ew_ExportAddValue($sExportStr, $categories->order->ExportValue($categories->Export, $categories->ExportOriginalValue), $categories->Export);
						ew_ExportAddValue($sExportStr, $categories->active->ExportValue($categories->Export, $categories->ExportOriginalValue), $categories->Export);
						echo ew_ExportLine($sExportStr, $categories->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($categories->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($categories->Export);
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
