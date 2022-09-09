<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "galleryinfo.php" ?>
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
$gallery_list = new cgallery_list();
$Page =& $gallery_list;

// Page init processing
$gallery_list->Page_Init();

// Page main processing
$gallery_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($gallery->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var gallery_list = new ew_Page("gallery_list");

// page properties
gallery_list.PageID = "list"; // page ID
var EW_PAGE_ID = gallery_list.PageID; // for backward compatibility

// extend page with ValidateForm function
gallery_list.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_image"];
		aelm = fobj.elements["a" + infix + "_image"];
		var chk_image = (aelm && aelm[0])?(aelm[2].checked):true;
		if (elm && chk_image && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - image");
		elm = fobj.elements["x" + infix + "_image"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, "File type is not allowed.");
		elm = fobj.elements["x" + infix + "_category"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - category");
		elm = fobj.elements["x" + infix + "_link"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - link");
		elm = fobj.elements["x" + infix + "_special"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - special");
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
gallery_list.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "name")) return false;
	if (ew_ValueChanged(fobj, infix, "name_arabic")) return false;
	if (ew_ValueChanged(fobj, infix, "image")) return false;
	if (ew_ValueChanged(fobj, infix, "category")) return false;
	if (ew_ValueChanged(fobj, infix, "link")) return false;
	if (ew_ValueChanged(fobj, infix, "special")) return false;
	if (ew_ValueChanged(fobj, infix, "order")) return false;
	if (ew_ValueChanged(fobj, infix, "active")) return false;
	return true;
}

// extend page with Form_CustomValidate function
gallery_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
gallery_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
gallery_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
gallery_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
gallery_list.ShowHighlightText = "Show highlight"; 
gallery_list.HideHighlightText = "Hide highlight";

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
<?php if ($gallery->Export == "") { ?>
<?php
$gsMasterReturnUrl = "categorieslist.php";
if ($gallery_list->sDbMasterFilter <> "" && $gallery->getCurrentMasterTable() == "categories") {
	if ($gallery_list->bMasterRecordExists) {
		if ($gallery->getCurrentMasterTable() == $gallery->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "categoriesmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
if ($gallery->CurrentAction == "gridadd")
	$gallery->CurrentFilter = "0=1";
if ($gallery->CurrentAction == "gridadd") {
	$gallery_list->lStartRec = 1;
	if ($gallery_list->lDisplayRecs <= 0)
		$gallery_list->lDisplayRecs = 20;
	$gallery_list->lTotalRecs = $gallery_list->lDisplayRecs;
	$gallery_list->lStopRec = $gallery_list->lDisplayRecs;
} else {
	$bSelectLimit = ($gallery->Export == "" && $gallery->SelectLimit);
	if (!$bSelectLimit)
		$rs = $gallery_list->LoadRecordset();
	$gallery_list->lTotalRecs = ($bSelectLimit) ? $gallery->SelectRecordCount() : $rs->RecordCount();
	$gallery_list->lStartRec = 1;
	if ($gallery_list->lDisplayRecs <= 0) // Display all records
		$gallery_list->lDisplayRecs = $gallery_list->lTotalRecs;
	if (!($gallery->ExportAll && $gallery->Export <> ""))
		$gallery_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $gallery_list->LoadRecordset($gallery_list->lStartRec-1, $gallery_list->lDisplayRecs);
}
?>
<p><span class="phpmaker" style="white-space: nowrap;">TABLE: gallery
<?php if ($gallery->Export == "" && $gallery->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $gallery_list->PageUrl() ?>export=print">Printer Friendly</a>
&nbsp;&nbsp;<a href="<?php echo $gallery_list->PageUrl() ?>export=html">Export to HTML</a>
&nbsp;&nbsp;<a href="<?php echo $gallery_list->PageUrl() ?>export=excel">Export to Excel</a>
&nbsp;&nbsp;<a href="<?php echo $gallery_list->PageUrl() ?>export=word">Export to Word</a>
&nbsp;&nbsp;<a href="<?php echo $gallery_list->PageUrl() ?>export=xml">Export to XML</a>
&nbsp;&nbsp;<a href="<?php echo $gallery_list->PageUrl() ?>export=csv">Export to CSV</a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($gallery->Export == "" && $gallery->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(gallery_list);" style="text-decoration: none;"><img id="gallery_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="gallery_list_SearchPanel">
<form name="fgallerylistsrch" id="fgallerylistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="gallery">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($gallery->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Search (*)">&nbsp;
			<a href="<?php echo $gallery_list->PageUrl() ?>cmd=reset">Show all</a>&nbsp;
			<a href="gallerysrch.php">Advanced Search</a>&nbsp;
			<?php if ($gallery_list->sSrchWhere <> "" && $gallery_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(gallery_list, this, '<?php echo $gallery->HighlightName() ?>');">Hide highlight</a>
			<?php } ?>
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($gallery->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>Exact phrase</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($gallery->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>All words</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($gallery->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>Any word</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $gallery_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($gallery->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($gallery->CurrentAction <> "gridadd" && $gallery->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($gallery_list->Pager)) $gallery_list->Pager = new cPrevNextPager($gallery_list->lStartRec, $gallery_list->lDisplayRecs, $gallery_list->lTotalRecs) ?>
<?php if ($gallery_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($gallery_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $gallery_list->PageUrl() ?>start=<?php echo $gallery_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($gallery_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $gallery_list->PageUrl() ?>start=<?php echo $gallery_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $gallery_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($gallery_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $gallery_list->PageUrl() ?>start=<?php echo $gallery_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($gallery_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $gallery_list->PageUrl() ?>start=<?php echo $gallery_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $gallery_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $gallery_list->Pager->FromIndex ?> to <?php echo $gallery_list->Pager->ToIndex ?> of <?php echo $gallery_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($gallery_list->sSrchWhere == "0=101") { ?>
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
<?php if ($gallery->CurrentAction <> "gridadd" && $gallery->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $gallery->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<a href="<?php echo $gallery_list->PageUrl() ?>a=add">Inline Add</a>&nbsp;&nbsp;
<a href="<?php echo $gallery_list->PageUrl() ?>a=gridadd">Grid Add</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($gallery_list->lTotalRecs > 0) { ?>
<a href="<?php echo $gallery_list->PageUrl() ?>a=gridedit">Grid Edit</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if ($gallery_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fgallerylist)) alert('No records selected'); else if (ew_Confirm('<?php echo $gallery_list->sDeleteConfirmMsg ?>')) {document.fgallerylist.action='gallerydelete.php';document.fgallerylist.encoding='application/x-www-form-urlencoded';document.fgallerylist.submit();};return false;">Delete Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fgallerylist)) alert('No records selected'); else {document.fgallerylist.action='galleryupdate.php';document.fgallerylist.encoding='application/x-www-form-urlencoded';document.fgallerylist.submit();};return false;">Update Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($gallery->CurrentAction == "gridadd") { ?>
<a href="" onclick="if (gallery_list.ValidateForm(document.fgallerylist)) document.fgallerylist.submit();return false;">Insert</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($gallery->CurrentAction == "gridedit") { ?>
<a href="" onclick="if (gallery_list.ValidateForm(document.fgallerylist)) document.fgallerylist.submit();return false;">Save</a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php echo $gallery_list->PageUrl() ?>a=cancel">Cancel</a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fgallerylist" id="fgallerylist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="t" id="t" value="gallery">
<?php if ($gallery_list->lTotalRecs > 0 || $gallery->CurrentAction == "add" || $gallery->CurrentAction == "copy") { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$gallery_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$gallery_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$gallery_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$gallery_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$gallery_list->lOptionCnt++; // Multi-select
}
	$gallery_list->lOptionCnt += count($gallery_list->ListOptions->Items); // Custom list options
?>
<?php echo $gallery->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($gallery->id->Visible) { // id ?>
	<?php if ($gallery->SortUrl($gallery->id) == "") { ?>
		<td>id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $gallery->SortUrl($gallery->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>id</td><td style="width: 10px;"><?php if ($gallery->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($gallery->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($gallery->name->Visible) { // name ?>
	<?php if ($gallery->SortUrl($gallery->name) == "") { ?>
		<td>name</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $gallery->SortUrl($gallery->name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>name&nbsp;(*)</td><td style="width: 10px;"><?php if ($gallery->name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($gallery->name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($gallery->name_arabic->Visible) { // name_arabic ?>
	<?php if ($gallery->SortUrl($gallery->name_arabic) == "") { ?>
		<td>name arabic</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $gallery->SortUrl($gallery->name_arabic) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>name arabic&nbsp;(*)</td><td style="width: 10px;"><?php if ($gallery->name_arabic->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($gallery->name_arabic->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($gallery->image->Visible) { // image ?>
	<?php if ($gallery->SortUrl($gallery->image) == "") { ?>
		<td>image</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $gallery->SortUrl($gallery->image) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>image</td><td style="width: 10px;"><?php if ($gallery->image->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($gallery->image->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($gallery->category->Visible) { // category ?>
	<?php if ($gallery->SortUrl($gallery->category) == "") { ?>
		<td>category</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $gallery->SortUrl($gallery->category) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>category</td><td style="width: 10px;"><?php if ($gallery->category->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($gallery->category->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($gallery->link->Visible) { // link ?>
	<?php if ($gallery->SortUrl($gallery->link) == "") { ?>
		<td>link</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $gallery->SortUrl($gallery->link) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>link&nbsp;(*)</td><td style="width: 10px;"><?php if ($gallery->link->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($gallery->link->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($gallery->special->Visible) { // special ?>
	<?php if ($gallery->SortUrl($gallery->special) == "") { ?>
		<td>special</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $gallery->SortUrl($gallery->special) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>special</td><td style="width: 10px;"><?php if ($gallery->special->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($gallery->special->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($gallery->order->Visible) { // order ?>
	<?php if ($gallery->SortUrl($gallery->order) == "") { ?>
		<td>order</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $gallery->SortUrl($gallery->order) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>order</td><td style="width: 10px;"><?php if ($gallery->order->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($gallery->order->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($gallery->active->Visible) { // active ?>
	<?php if ($gallery->SortUrl($gallery->active) == "") { ?>
		<td>active</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $gallery->SortUrl($gallery->active) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>active</td><td style="width: 10px;"><?php if ($gallery->active->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($gallery->active->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($gallery->Export == "") { ?>
<?php if ($gallery->CurrentAction <> "gridadd" && $gallery->CurrentAction <> "gridedit") { ?>
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
<?php if ($gallery_list->lOptionCnt == 0 && $gallery->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="phpmaker" onclick="gallery_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($gallery_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
</thead>
<?php
	if ($gallery->CurrentAction == "add" || $gallery->CurrentAction == "copy") {
		$gallery_list->lRowIndex = 1;
		if ($gallery->CurrentAction == "copy" && !$gallery_list->LoadRow())
				$gallery->CurrentAction = "add";
		if ($gallery->CurrentAction == "add")
			$gallery_list->LoadDefaultValues();
		if ($gallery->EventCancelled) // Insert failed
			$gallery_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$gallery->CssClass = "ewTableEditRow";
		$gallery->CssStyle = "";
		$gallery->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
		$gallery->RowType = EW_ROWTYPE_ADD;

		// Render row
		$gallery_list->RenderRow();
?>
	<tr<?php echo $gallery->RowAttributes() ?>>
	<?php if ($gallery->id->Visible) { // id ?>
		<td>&nbsp;</td>
	<?php } ?>
	<?php if ($gallery->name->Visible) { // name ?>
		<td>
<input type="text" name="x<?php echo $gallery_list->lRowIndex ?>_name" id="x<?php echo $gallery_list->lRowIndex ?>_name" size="30" maxlength="250" value="<?php echo $gallery->name->EditValue ?>"<?php echo $gallery->name->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($gallery->name_arabic->Visible) { // name_arabic ?>
		<td>
<input type="text" name="x<?php echo $gallery_list->lRowIndex ?>_name_arabic" id="x<?php echo $gallery_list->lRowIndex ?>_name_arabic" size="30" maxlength="250" value="<?php echo $gallery->name_arabic->EditValue ?>"<?php echo $gallery->name_arabic->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($gallery->image->Visible) { // image ?>
		<td>
<input type="file" name="x<?php echo $gallery_list->lRowIndex ?>_image" id="x<?php echo $gallery_list->lRowIndex ?>_image" size="30"<?php echo $gallery->image->EditAttributes() ?>>
</div>
</td>
	<?php } ?>
	<?php if ($gallery->category->Visible) { // category ?>
		<td>
<?php if ($gallery->category->getSessionValue() <> "") { ?>
<div<?php echo $gallery->category->ViewAttributes() ?>><?php echo $gallery->category->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $gallery_list->lRowIndex ?>_category" name="x<?php echo $gallery_list->lRowIndex ?>_category" value="<?php echo ew_HtmlEncode($gallery->category->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $gallery_list->lRowIndex ?>_category" name="x<?php echo $gallery_list->lRowIndex ?>_category"<?php echo $gallery->category->EditAttributes() ?>>
<?php
if (is_array($gallery->category->EditValue)) {
	$arwrk = $gallery->category->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($gallery->category->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
if ($emptywrk) $gallery->category->OldValue = "";
?>
</select>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gallery->link->Visible) { // link ?>
		<td>
<input type="text" name="x<?php echo $gallery_list->lRowIndex ?>_link" id="x<?php echo $gallery_list->lRowIndex ?>_link" size="30" maxlength="250" value="<?php echo $gallery->link->EditValue ?>"<?php echo $gallery->link->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($gallery->special->Visible) { // special ?>
		<td>
<div id="tp_x<?php echo $gallery_list->lRowIndex ?>_special" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x<?php echo $gallery_list->lRowIndex ?>_special" id="x<?php echo $gallery_list->lRowIndex ?>_special" value="{value}"<?php echo $gallery->special->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $gallery_list->lRowIndex ?>_special" repeatcolumn="5">
<?php
$arwrk = $gallery->special->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($gallery->special->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $gallery_list->lRowIndex ?>_special" id="x<?php echo $gallery_list->lRowIndex ?>_special" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $gallery->special->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
if ($emptywrk) $gallery->special->OldValue = "";
?>
</div>
</td>
	<?php } ?>
	<?php if ($gallery->order->Visible) { // order ?>
		<td>
<input type="text" name="x<?php echo $gallery_list->lRowIndex ?>_order" id="x<?php echo $gallery_list->lRowIndex ?>_order" size="30" value="<?php echo $gallery->order->EditValue ?>"<?php echo $gallery->order->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($gallery->active->Visible) { // active ?>
		<td>
<div id="tp_x<?php echo $gallery_list->lRowIndex ?>_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x<?php echo $gallery_list->lRowIndex ?>_active" id="x<?php echo $gallery_list->lRowIndex ?>_active" value="{value}"<?php echo $gallery->active->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $gallery_list->lRowIndex ?>_active" repeatcolumn="5">
<?php
$arwrk = $gallery->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($gallery->active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $gallery_list->lRowIndex ?>_active" id="x<?php echo $gallery_list->lRowIndex ?>_active" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $gallery->active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
if ($emptywrk) $gallery->active->OldValue = "";
?>
</div>
</td>
	<?php } ?>
<td colspan="<?php echo $gallery_list->lOptionCnt ?>"><span class="phpmaker">
<a href="" onclick="if (gallery_list.ValidateForm(document.fgallerylist)) document.fgallerylist.submit();return false;">Insert</a>&nbsp;<a href="<?php echo $gallery_list->PageUrl() ?>a=cancel">Cancel</a>
<input type="hidden" name="a_list" id="a_list" value="insert">
</span></td>
	</tr>
<?php
}
?>
<?php
if ($gallery->ExportAll && $gallery->Export <> "") {
	$gallery_list->lStopRec = $gallery_list->lTotalRecs;
} else {
	$gallery_list->lStopRec = $gallery_list->lStartRec + $gallery_list->lDisplayRecs - 1; // Set the last record to display
}
$gallery_list->lRecCount = $gallery_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$gallery->SelectLimit && $gallery_list->lStartRec > 1)
		$rs->Move($gallery_list->lStartRec - 1);
}
$gallery_list->lRowCnt = 0;
$gallery_list->lEditRowCnt = 0;
if ($gallery->CurrentAction == "edit")
	$gallery_list->lRowIndex = 1;
if ($gallery->CurrentAction == "gridadd")
	$gallery_list->lRowIndex = 0;
if ($gallery->CurrentAction == "gridedit")
	$gallery_list->lRowIndex = 0;
while (($gallery->CurrentAction == "gridadd" || !$rs->EOF) &&
	$gallery_list->lRecCount < $gallery_list->lStopRec) {
	$gallery_list->lRecCount++;
	if (intval($gallery_list->lRecCount) >= intval($gallery_list->lStartRec)) {
		$gallery_list->lRowCnt++;
		if ($gallery->CurrentAction == "gridadd" || $gallery->CurrentAction == "gridedit")
			$gallery_list->lRowIndex++;

	// Init row class and style
	$gallery->CssClass = "";
	$gallery->CssStyle = "";
	$gallery->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($gallery->CurrentAction == "gridadd") {
		$gallery_list->LoadDefaultValues(); // Load default values
	} else {
		$gallery_list->LoadRowValues($rs); // Load row values
	}
	$gallery->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($gallery->CurrentAction == "gridadd") // Grid add
		$gallery->RowType = EW_ROWTYPE_ADD; // Render add
	if ($gallery->CurrentAction == "gridadd" && $gallery->EventCancelled) // Insert failed
		$gallery_list->RestoreCurrentRowFormValues($gallery_list->lRowIndex); // Restore form values
	if ($gallery->CurrentAction == "edit") {
		if ($gallery_list->CheckInlineEditKey() && $gallery_list->lEditRowCnt == 0) // Inline edit
			$gallery->RowType = EW_ROWTYPE_EDIT; // Render edit
	}
	if ($gallery->CurrentAction == "gridedit") // Grid edit
		$gallery->RowType = EW_ROWTYPE_EDIT; // Render edit
	if ($gallery->RowType == EW_ROWTYPE_EDIT && $gallery->EventCancelled) { // Update failed
		if ($gallery->CurrentAction == "edit")
			$gallery_list->RestoreFormValues(); // Restore form values
		if ($gallery->CurrentAction == "gridedit")
			$gallery_list->RestoreCurrentRowFormValues($gallery_list->lRowIndex); // Restore form values
	}
	if ($gallery->RowType == EW_ROWTYPE_EDIT) { // Edit row
		$gallery_list->lEditRowCnt++;
		$gallery->RowClientEvents = "onmouseover='this.edit=true;ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	}
	if ($gallery->RowType == EW_ROWTYPE_ADD || $gallery->RowType == EW_ROWTYPE_EDIT) // Add / Edit row
			$gallery->CssClass = "ewTableEditRow";

	// Render row
	$gallery_list->RenderRow();
?>
	<tr<?php echo $gallery->RowAttributes() ?>>
	<?php if ($gallery->id->Visible) { // id ?>
		<td<?php echo $gallery->id->CellAttributes() ?>>
<?php if ($gallery->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $gallery_list->lRowIndex ?>_id" id="o<?php echo $gallery_list->lRowIndex ?>_id" value="<?php echo ew_HtmlEncode($gallery->id->OldValue) ?>">
<?php } ?>
<?php if ($gallery->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $gallery->id->ViewAttributes() ?>><?php echo $gallery->id->EditValue ?></div><input type="hidden" name="x<?php echo $gallery_list->lRowIndex ?>_id" id="x<?php echo $gallery_list->lRowIndex ?>_id" value="<?php echo ew_HtmlEncode($gallery->id->CurrentValue) ?>">
<?php } ?>
<?php if ($gallery->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $gallery->id->ViewAttributes() ?>><?php echo $gallery->id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gallery->name->Visible) { // name ?>
		<td<?php echo $gallery->name->CellAttributes() ?>>
<?php if ($gallery->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $gallery_list->lRowIndex ?>_name" id="x<?php echo $gallery_list->lRowIndex ?>_name" size="30" maxlength="250" value="<?php echo $gallery->name->EditValue ?>"<?php echo $gallery->name->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $gallery_list->lRowIndex ?>_name" id="o<?php echo $gallery_list->lRowIndex ?>_name" value="<?php echo ew_HtmlEncode($gallery->name->OldValue) ?>">
<?php } ?>
<?php if ($gallery->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $gallery_list->lRowIndex ?>_name" id="x<?php echo $gallery_list->lRowIndex ?>_name" size="30" maxlength="250" value="<?php echo $gallery->name->EditValue ?>"<?php echo $gallery->name->EditAttributes() ?>>
<?php } ?>
<?php if ($gallery->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $gallery->name->ViewAttributes() ?>><?php echo $gallery->name->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gallery->name_arabic->Visible) { // name_arabic ?>
		<td<?php echo $gallery->name_arabic->CellAttributes() ?>>
<?php if ($gallery->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $gallery_list->lRowIndex ?>_name_arabic" id="x<?php echo $gallery_list->lRowIndex ?>_name_arabic" size="30" maxlength="250" value="<?php echo $gallery->name_arabic->EditValue ?>"<?php echo $gallery->name_arabic->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $gallery_list->lRowIndex ?>_name_arabic" id="o<?php echo $gallery_list->lRowIndex ?>_name_arabic" value="<?php echo ew_HtmlEncode($gallery->name_arabic->OldValue) ?>">
<?php } ?>
<?php if ($gallery->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $gallery_list->lRowIndex ?>_name_arabic" id="x<?php echo $gallery_list->lRowIndex ?>_name_arabic" size="30" maxlength="250" value="<?php echo $gallery->name_arabic->EditValue ?>"<?php echo $gallery->name_arabic->EditAttributes() ?>>
<?php } ?>
<?php if ($gallery->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $gallery->name_arabic->ViewAttributes() ?>><?php echo $gallery->name_arabic->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gallery->image->Visible) { // image ?>
		<td<?php echo $gallery->image->CellAttributes() ?>>
<?php if ($gallery->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="file" name="x<?php echo $gallery_list->lRowIndex ?>_image" id="x<?php echo $gallery_list->lRowIndex ?>_image" size="30"<?php echo $gallery->image->EditAttributes() ?>>
</div>
<input type="hidden" name="o<?php echo $gallery_list->lRowIndex ?>_image" id="o<?php echo $gallery_list->lRowIndex ?>_image" value="<?php echo ew_HtmlEncode($gallery->image->OldValue) ?>">
<?php } ?>
<?php if ($gallery->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div id="old_x<?php echo $gallery_list->lRowIndex ?>_image">
<?php if ($gallery->image->HrefValue <> "") { ?>
<?php if (!is_null($gallery->image->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $gallery->image->Upload->DbValue ?>" border=0<?php echo $gallery->image->ViewAttributes() ?>>
<?php } elseif (!in_array($gallery->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($gallery->image->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $gallery->image->Upload->DbValue ?>" border=0<?php echo $gallery->image->ViewAttributes() ?>>
<?php } elseif (!in_array($gallery->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x<?php echo $gallery_list->lRowIndex ?>_image">
<?php if (!is_null($gallery->image->Upload->DbValue)) { ?>
<input type="radio" name="a<?php echo $gallery_list->lRowIndex ?>_image" id="a<?php echo $gallery_list->lRowIndex ?>_image" value="1" checked="checked">Keep&nbsp;
<input type="radio" name="a<?php echo $gallery_list->lRowIndex ?>_image" id="a<?php echo $gallery_list->lRowIndex ?>_image" value="2" disabled="disabled">Remove&nbsp;
<input type="radio" name="a<?php echo $gallery_list->lRowIndex ?>_image" id="a<?php echo $gallery_list->lRowIndex ?>_image" value="3">Replace<br>
<?php } else { ?>
<input type="hidden" name="a<?php echo $gallery_list->lRowIndex ?>_image" id="a<?php echo $gallery_list->lRowIndex ?>_image" value="3">
<?php } ?>
<input type="file" name="x<?php echo $gallery_list->lRowIndex ?>_image" id="x<?php echo $gallery_list->lRowIndex ?>_image" size="30" onchange="if (this.form.a<?php echo $gallery_list->lRowIndex ?>_image[2]) this.form.a<?php echo $gallery_list->lRowIndex ?>_image[2].checked=true;"<?php echo $gallery->image->EditAttributes() ?>>
</div>
<?php } ?>
<?php if ($gallery->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<?php if ($gallery->image->HrefValue <> "") { ?>
<?php if (!is_null($gallery->image->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $gallery->image->Upload->DbValue ?>" border=0<?php echo $gallery->image->ViewAttributes() ?>>
<?php } elseif (!in_array($gallery->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($gallery->image->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../images/") . $gallery->image->Upload->DbValue ?>" border=0<?php echo $gallery->image->ViewAttributes() ?>>
<?php } elseif (!in_array($gallery->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gallery->category->Visible) { // category ?>
		<td<?php echo $gallery->category->CellAttributes() ?>>
<?php if ($gallery->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($gallery->category->getSessionValue() <> "") { ?>
<div<?php echo $gallery->category->ViewAttributes() ?>><?php echo $gallery->category->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $gallery_list->lRowIndex ?>_category" name="x<?php echo $gallery_list->lRowIndex ?>_category" value="<?php echo ew_HtmlEncode($gallery->category->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $gallery_list->lRowIndex ?>_category" name="x<?php echo $gallery_list->lRowIndex ?>_category"<?php echo $gallery->category->EditAttributes() ?>>
<?php
if (is_array($gallery->category->EditValue)) {
	$arwrk = $gallery->category->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($gallery->category->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
if ($emptywrk) $gallery->category->OldValue = "";
?>
</select>
<?php } ?>
<input type="hidden" name="o<?php echo $gallery_list->lRowIndex ?>_category" id="o<?php echo $gallery_list->lRowIndex ?>_category" value="<?php echo ew_HtmlEncode($gallery->category->OldValue) ?>">
<?php } ?>
<?php if ($gallery->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($gallery->category->getSessionValue() <> "") { ?>
<div<?php echo $gallery->category->ViewAttributes() ?>><?php echo $gallery->category->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $gallery_list->lRowIndex ?>_category" name="x<?php echo $gallery_list->lRowIndex ?>_category" value="<?php echo ew_HtmlEncode($gallery->category->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $gallery_list->lRowIndex ?>_category" name="x<?php echo $gallery_list->lRowIndex ?>_category"<?php echo $gallery->category->EditAttributes() ?>>
<?php
if (is_array($gallery->category->EditValue)) {
	$arwrk = $gallery->category->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($gallery->category->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
if ($emptywrk) $gallery->category->OldValue = "";
?>
</select>
<?php } ?>
<?php } ?>
<?php if ($gallery->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $gallery->category->ViewAttributes() ?>><?php echo $gallery->category->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gallery->link->Visible) { // link ?>
		<td<?php echo $gallery->link->CellAttributes() ?>>
<?php if ($gallery->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $gallery_list->lRowIndex ?>_link" id="x<?php echo $gallery_list->lRowIndex ?>_link" size="30" maxlength="250" value="<?php echo $gallery->link->EditValue ?>"<?php echo $gallery->link->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $gallery_list->lRowIndex ?>_link" id="o<?php echo $gallery_list->lRowIndex ?>_link" value="<?php echo ew_HtmlEncode($gallery->link->OldValue) ?>">
<?php } ?>
<?php if ($gallery->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $gallery_list->lRowIndex ?>_link" id="x<?php echo $gallery_list->lRowIndex ?>_link" size="30" maxlength="250" value="<?php echo $gallery->link->EditValue ?>"<?php echo $gallery->link->EditAttributes() ?>>
<?php } ?>
<?php if ($gallery->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $gallery->link->ViewAttributes() ?>><?php echo $gallery->link->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gallery->special->Visible) { // special ?>
		<td<?php echo $gallery->special->CellAttributes() ?>>
<?php if ($gallery->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<div id="tp_x<?php echo $gallery_list->lRowIndex ?>_special" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x<?php echo $gallery_list->lRowIndex ?>_special" id="x<?php echo $gallery_list->lRowIndex ?>_special" value="{value}"<?php echo $gallery->special->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $gallery_list->lRowIndex ?>_special" repeatcolumn="5">
<?php
$arwrk = $gallery->special->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($gallery->special->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $gallery_list->lRowIndex ?>_special" id="x<?php echo $gallery_list->lRowIndex ?>_special" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $gallery->special->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
if ($emptywrk) $gallery->special->OldValue = "";
?>
</div>
<input type="hidden" name="o<?php echo $gallery_list->lRowIndex ?>_special" id="o<?php echo $gallery_list->lRowIndex ?>_special" value="<?php echo ew_HtmlEncode($gallery->special->OldValue) ?>">
<?php } ?>
<?php if ($gallery->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div id="tp_x<?php echo $gallery_list->lRowIndex ?>_special" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x<?php echo $gallery_list->lRowIndex ?>_special" id="x<?php echo $gallery_list->lRowIndex ?>_special" value="{value}"<?php echo $gallery->special->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $gallery_list->lRowIndex ?>_special" repeatcolumn="5">
<?php
$arwrk = $gallery->special->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($gallery->special->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $gallery_list->lRowIndex ?>_special" id="x<?php echo $gallery_list->lRowIndex ?>_special" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $gallery->special->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
if ($emptywrk) $gallery->special->OldValue = "";
?>
</div>
<?php } ?>
<?php if ($gallery->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $gallery->special->ViewAttributes() ?>><?php echo $gallery->special->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gallery->order->Visible) { // order ?>
		<td<?php echo $gallery->order->CellAttributes() ?>>
<?php if ($gallery->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $gallery_list->lRowIndex ?>_order" id="x<?php echo $gallery_list->lRowIndex ?>_order" size="30" value="<?php echo $gallery->order->EditValue ?>"<?php echo $gallery->order->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $gallery_list->lRowIndex ?>_order" id="o<?php echo $gallery_list->lRowIndex ?>_order" value="<?php echo ew_HtmlEncode($gallery->order->OldValue) ?>">
<?php } ?>
<?php if ($gallery->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $gallery_list->lRowIndex ?>_order" id="x<?php echo $gallery_list->lRowIndex ?>_order" size="30" value="<?php echo $gallery->order->EditValue ?>"<?php echo $gallery->order->EditAttributes() ?>>
<?php } ?>
<?php if ($gallery->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $gallery->order->ViewAttributes() ?>><?php echo $gallery->order->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gallery->active->Visible) { // active ?>
		<td<?php echo $gallery->active->CellAttributes() ?>>
<?php if ($gallery->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<div id="tp_x<?php echo $gallery_list->lRowIndex ?>_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x<?php echo $gallery_list->lRowIndex ?>_active" id="x<?php echo $gallery_list->lRowIndex ?>_active" value="{value}"<?php echo $gallery->active->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $gallery_list->lRowIndex ?>_active" repeatcolumn="5">
<?php
$arwrk = $gallery->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($gallery->active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $gallery_list->lRowIndex ?>_active" id="x<?php echo $gallery_list->lRowIndex ?>_active" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $gallery->active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
if ($emptywrk) $gallery->active->OldValue = "";
?>
</div>
<input type="hidden" name="o<?php echo $gallery_list->lRowIndex ?>_active" id="o<?php echo $gallery_list->lRowIndex ?>_active" value="<?php echo ew_HtmlEncode($gallery->active->OldValue) ?>">
<?php } ?>
<?php if ($gallery->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div id="tp_x<?php echo $gallery_list->lRowIndex ?>_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x<?php echo $gallery_list->lRowIndex ?>_active" id="x<?php echo $gallery_list->lRowIndex ?>_active" value="{value}"<?php echo $gallery->active->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $gallery_list->lRowIndex ?>_active" repeatcolumn="5">
<?php
$arwrk = $gallery->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($gallery->active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $gallery_list->lRowIndex ?>_active" id="x<?php echo $gallery_list->lRowIndex ?>_active" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $gallery->active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
if ($emptywrk) $gallery->active->OldValue = "";
?>
</div>
<?php } ?>
<?php if ($gallery->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $gallery->active->ViewAttributes() ?>><?php echo $gallery->active->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php if ($gallery->RowType == EW_ROWTYPE_ADD || $gallery->RowType == EW_ROWTYPE_EDIT) { ?>
<?php if ($gallery->CurrentAction == "edit") { ?>
<td colspan="<?php echo $gallery_list->lOptionCnt ?>"><span class="phpmaker">
<a href="" onclick="if (gallery_list.ValidateForm(document.fgallerylist)) document.fgallerylist.submit();return false;">Update</a>&nbsp;<a href="<?php echo $gallery_list->PageUrl() ?>a=cancel">Cancel</a>
<input type="hidden" name="a_list" id="a_list" value="update">
</span></td>
<?php } ?>
<?php
	if ($gallery->CurrentAction == "gridedit")
		$gallery_list->sMultiSelectKey .= "<input type=\"hidden\" name=\"k" . $gallery_list->lRowIndex . "_key\" id=\"k" . $gallery_list->lRowIndex . "_key\" value=\"" . $gallery->id->CurrentValue . "\">";
?>
<?php } else { ?>
<?php if ($gallery->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $gallery->ViewUrl() ?>">View</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $gallery->EditUrl() ?>">Edit</a><span class="ewSeparator">&nbsp;|&nbsp;</span><a href="<?php echo $gallery->InlineEditUrl() ?>">Inline Edit</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $gallery->CopyUrl() ?>">Copy</a><span class="ewSeparator">&nbsp;|&nbsp;</span><a href="<?php echo $gallery->InlineCopyUrl() ?>">Inline Copy</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($gallery_list->lOptionCnt == 0 && $gallery->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($gallery->id->CurrentValue) ?>" class="phpmaker" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($gallery_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
<?php if ($gallery->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($gallery->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($gallery->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($gallery->CurrentAction == "add" || $gallery->CurrentAction == "copy") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $gallery_list->lRowIndex ?>">
<?php } ?>
<?php if ($gallery->CurrentAction == "gridadd") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $gallery_list->lRowIndex ?>">
<?php } ?>
<?php if ($gallery->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $gallery_list->lRowIndex ?>">
<?php } ?>
<?php if ($gallery->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $gallery_list->lRowIndex ?>">
<?php echo $gallery_list->sMultiSelectKey ?>
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
<?php if ($gallery_list->lTotalRecs > 0) { ?>
<?php if ($gallery->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($gallery->CurrentAction <> "gridadd" && $gallery->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($gallery_list->Pager)) $gallery_list->Pager = new cPrevNextPager($gallery_list->lStartRec, $gallery_list->lDisplayRecs, $gallery_list->lTotalRecs) ?>
<?php if ($gallery_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($gallery_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $gallery_list->PageUrl() ?>start=<?php echo $gallery_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($gallery_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $gallery_list->PageUrl() ?>start=<?php echo $gallery_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $gallery_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($gallery_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $gallery_list->PageUrl() ?>start=<?php echo $gallery_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($gallery_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $gallery_list->PageUrl() ?>start=<?php echo $gallery_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $gallery_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $gallery_list->Pager->FromIndex ?> to <?php echo $gallery_list->Pager->ToIndex ?> of <?php echo $gallery_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($gallery_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($gallery_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($gallery->CurrentAction <> "gridadd" && $gallery->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $gallery->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<a href="<?php echo $gallery_list->PageUrl() ?>a=add">Inline Add</a>&nbsp;&nbsp;
<a href="<?php echo $gallery_list->PageUrl() ?>a=gridadd">Grid Add</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($gallery_list->lTotalRecs > 0) { ?>
<a href="<?php echo $gallery_list->PageUrl() ?>a=gridedit">Grid Edit</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if ($gallery_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fgallerylist)) alert('No records selected'); else if (ew_Confirm('<?php echo $gallery_list->sDeleteConfirmMsg ?>')) {document.fgallerylist.action='gallerydelete.php';document.fgallerylist.encoding='application/x-www-form-urlencoded';document.fgallerylist.submit();};return false;">Delete Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fgallerylist)) alert('No records selected'); else {document.fgallerylist.action='galleryupdate.php';document.fgallerylist.encoding='application/x-www-form-urlencoded';document.fgallerylist.submit();};return false;">Update Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($gallery->CurrentAction == "gridadd") { ?>
<a href="" onclick="if (gallery_list.ValidateForm(document.fgallerylist)) document.fgallerylist.submit();return false;">Insert</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($gallery->CurrentAction == "gridedit") { ?>
<a href="" onclick="if (gallery_list.ValidateForm(document.fgallerylist)) document.fgallerylist.submit();return false;">Save</a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php echo $gallery_list->PageUrl() ?>a=cancel">Cancel</a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($gallery->Export == "" && $gallery->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(gallery_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($gallery->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$gallery_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class cgallery_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'gallery';

	// Page Object Name
	var $PageObjName = 'gallery_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $gallery;
		if ($gallery->UseTokenInUrl) $PageUrl .= "t=" . $gallery->TableVar . "&"; // add page token
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
		global $objForm, $gallery;
		if ($gallery->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($gallery->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($gallery->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cgallery_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["gallery"] = new cgallery();

		// Initialize other table object
		$GLOBALS['categories'] = new ccategories();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'gallery', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $gallery;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$gallery->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $gallery->Export; // Get export parameter, used in header
	$gsExportFile = $gallery->TableVar; // Get export file, used in header
	if ($gallery->Export == "print" || $gallery->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($gallery->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($gallery->Export == "word") {
		header('Content-Type: application/vnd.ms-word;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($gallery->Export == "xml") {
		header('Content-Type: text/xml;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($gallery->Export == "csv") {
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
		global $objForm, $gsSearchError, $Security, $gallery;
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
				$gallery->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($gallery->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to grid edit mode
				if ($gallery->CurrentAction == "gridedit")
					$this->GridEditMode();

				// Switch to inline edit mode
				if ($gallery->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($gallery->CurrentAction == "add" || $gallery->CurrentAction == "copy")
					$this->InlineAddMode();

				// Switch to grid add mode
				if ($gallery->CurrentAction == "gridadd")
					$this->GridAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$gallery->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Update
					if ($gallery->CurrentAction == "gridupdate" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridedit")
						$this->GridUpdate();

					// Inline Update
					if ($gallery->CurrentAction == "update" && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($gallery->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
						$this->InlineInsert();

					// Grid Insert
					if ($gallery->CurrentAction == "gridinsert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridadd")
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
		if ($gallery->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $gallery->getRecordsPerPage(); // Restore from Session
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
		$gallery->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$gallery->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$gallery->setStartRecordNumber($this->lStartRec);
		} else {
			$this->RestoreSearchParms();
		}

		// Build filter
		$sTblDefaultFilter = "";
		$sFilter = $sTblDefaultFilter;

		// Restore master/detail filter
		$this->sDbMasterFilter = $gallery->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $gallery->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($gallery->getMasterFilter() <> "" && $gallery->getCurrentMasterTable() == "categories") {
			global $categories;
			$rsmaster = $categories->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$gallery->setMasterFilter(""); // Clear master filter
				$gallery->setDetailFilter(""); // Clear detail filter
				$this->setMessage("No records found"); // Set no record found
				$this->Page_Terminate($gallery->getReturnUrl()); // Return to caller
			} else {
				$categories->LoadListRowValues($rsmaster);
				$categories->RowType = EW_ROWTYPE_MASTER; // Master row
				$categories->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in Session
		$gallery->setSessionWhere($sFilter);
		$gallery->CurrentFilter = "";

		// Export data only
		if (in_array($gallery->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	//  Exit out of inline mode
	function ClearInlineMode() {
		global $gallery;
		$gallery->setKey("id", ""); // Clear inline edit key
		$gallery->CurrentAction = ""; // Clear action
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
		global $Security, $gallery;
		$bInlineEdit = TRUE;
		if (@$_GET["id"] <> "") {
			$gallery->id->setQueryStringValue($_GET["id"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$gallery->setKey("id", $gallery->id->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to inline edit record
	function InlineUpdate() {
		global $objForm, $gsFormError, $gallery;
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
				$gallery->SendEmail = TRUE; // Send email on update success
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
			$gallery->EventCancelled = TRUE; // Cancel event
			$gallery->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check inline edit key
	function CheckInlineEditKey() {
		global $gallery;

		//CheckInlineEditKey = True
		if (strval($gallery->getKey("id")) <> strval($gallery->id->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add Mode
	function InlineAddMode() {
		global $Security, $gallery;
		if ($gallery->CurrentAction == "copy") {
			if (@$_GET["id"] <> "") {
				$gallery->id->setQueryStringValue($_GET["id"]);
			} else {
				$gallery->CurrentAction = "add";
			}
		}
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to inline add/copy record
	function InlineInsert() {
		global $objForm, $gsFormError, $gallery;
		$objForm->Index = 1;
		$this->GetUploadFiles(); // Get upload files
		$this->LoadFormValues(); // Get form values

		// Validate Form
		if (!$this->ValidateForm()) {
			$this->setMessage($gsFormError); // Set validation error message
			$gallery->EventCancelled = TRUE; // Set event cancelled
			$gallery->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$gallery->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow()) { // Add record
			$this->setMessage("Add succeeded"); // Set add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$gallery->EventCancelled = TRUE; // Set event cancelled
			$gallery->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Perform update to grid
	function GridUpdate() {
		global $conn, $objForm, $gsFormError, $gallery;
		$rowindex = 1;
		$bGridUpdate = TRUE;

		// Begin transaction
		$conn->BeginTrans();

		// Get old recordset
		$gallery->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $gallery->SQL();
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
					$gallery->SendEmail = FALSE; // Do not send email on update success
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
			$gallery->EventCancelled = TRUE; // Set event cancelled
			$gallery->CurrentAction = "gridedit"; // Stay in gridedit mode
		}
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $gallery;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $gallery->KeyFilter();
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
		global $gallery;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$gallery->id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($gallery->id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Grid Insert
	// Perform insert to grid
	function GridInsert() {
		global $conn, $objForm, $gsFormError, $gallery;
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
				$gallery->SendEmail = FALSE; // Do not send email on insert success

				// Validate Form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow(); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
					$sKey .= $gallery->id->CurrentValue;

					// Add filter for this record
					$sFilter = $gallery->KeyFilter();
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
			$gallery->CurrentFilter = $sWrkFilter;
			$sSql = $gallery->SQL();
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
			$gallery->EventCancelled = TRUE; // Set event cancelled
			$gallery->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
	}

	// Check if empty row
	function EmptyRow() {
		global $gallery;
		if ($gallery->name->CurrentValue <> $gallery->name->OldValue)
			return FALSE;
		if ($gallery->name_arabic->CurrentValue <> $gallery->name_arabic->OldValue)
			return FALSE;
		if (!is_null($gallery->image->Upload->Value))
			return FALSE;
		if ($gallery->category->CurrentValue <> $gallery->category->OldValue)
			return FALSE;
		if ($gallery->link->CurrentValue <> $gallery->link->OldValue)
			return FALSE;
		if ($gallery->special->CurrentValue <> $gallery->special->OldValue)
			return FALSE;
		if ($gallery->order->CurrentValue <> $gallery->order->OldValue)
			return FALSE;
		if ($gallery->active->CurrentValue <> $gallery->active->OldValue)
			return FALSE;
		return TRUE;
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm, $gallery;

		// Get row based on current index
		$objForm->Index = $idx;
		if ($gallery->CurrentAction == "gridadd")
			$this->LoadFormValues(); // Load form values
		if ($gallery->CurrentAction == "gridedit") {
			$sKey = strval($objForm->GetValue("k_key"));
			$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $sKey);
			if (count($arrKeyFlds) >= 1) {
				if (strval($arrKeyFlds[0]) == strval($gallery->id->CurrentValue)) {
					$this->LoadFormValues(); // Load form values
				}
			}
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $gallery;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $gallery->id, FALSE); // Field id
		$this->BuildSearchSql($sWhere, $gallery->name, FALSE); // Field name
		$this->BuildSearchSql($sWhere, $gallery->name_arabic, FALSE); // Field name_arabic
		$this->BuildSearchSql($sWhere, $gallery->category, FALSE); // Field category
		$this->BuildSearchSql($sWhere, $gallery->link, FALSE); // Field link
		$this->BuildSearchSql($sWhere, $gallery->special, FALSE); // Field special
		$this->BuildSearchSql($sWhere, $gallery->order, FALSE); // Field order
		$this->BuildSearchSql($sWhere, $gallery->active, FALSE); // Field active

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($gallery->id); // Field id
			$this->SetSearchParm($gallery->name); // Field name
			$this->SetSearchParm($gallery->name_arabic); // Field name_arabic
			$this->SetSearchParm($gallery->category); // Field category
			$this->SetSearchParm($gallery->link); // Field link
			$this->SetSearchParm($gallery->special); // Field special
			$this->SetSearchParm($gallery->order); // Field order
			$this->SetSearchParm($gallery->active); // Field active
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
		global $gallery;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$gallery->setAdvancedSearch("x_$FldParm", $FldVal);
		$gallery->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$gallery->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$gallery->setAdvancedSearch("y_$FldParm", $FldVal2);
		$gallery->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $gallery;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $gallery->name->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $gallery->name_arabic->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $gallery->image->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $gallery->link->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $gallery;
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
			$gallery->setBasicSearchKeyword($sSearchKeyword);
			$gallery->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $gallery;
		$this->sSrchWhere = "";
		$gallery->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $gallery;
		$gallery->setBasicSearchKeyword("");
		$gallery->setBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $gallery;
		$gallery->setAdvancedSearch("x_id", "");
		$gallery->setAdvancedSearch("x_name", "");
		$gallery->setAdvancedSearch("x_name_arabic", "");
		$gallery->setAdvancedSearch("x_category", "");
		$gallery->setAdvancedSearch("x_link", "");
		$gallery->setAdvancedSearch("x_special", "");
		$gallery->setAdvancedSearch("x_order", "");
		$gallery->setAdvancedSearch("x_active", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $gallery;
		$this->sSrchWhere = $gallery->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $gallery;
		 $gallery->id->AdvancedSearch->SearchValue = $gallery->getAdvancedSearch("x_id");
		 $gallery->name->AdvancedSearch->SearchValue = $gallery->getAdvancedSearch("x_name");
		 $gallery->name_arabic->AdvancedSearch->SearchValue = $gallery->getAdvancedSearch("x_name_arabic");
		 $gallery->category->AdvancedSearch->SearchValue = $gallery->getAdvancedSearch("x_category");
		 $gallery->link->AdvancedSearch->SearchValue = $gallery->getAdvancedSearch("x_link");
		 $gallery->special->AdvancedSearch->SearchValue = $gallery->getAdvancedSearch("x_special");
		 $gallery->order->AdvancedSearch->SearchValue = $gallery->getAdvancedSearch("x_order");
		 $gallery->active->AdvancedSearch->SearchValue = $gallery->getAdvancedSearch("x_active");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $gallery;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$gallery->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$gallery->CurrentOrderType = @$_GET["ordertype"];
			$gallery->UpdateSort($gallery->id); // Field 
			$gallery->UpdateSort($gallery->name); // Field 
			$gallery->UpdateSort($gallery->name_arabic); // Field 
			$gallery->UpdateSort($gallery->image); // Field 
			$gallery->UpdateSort($gallery->category); // Field 
			$gallery->UpdateSort($gallery->link); // Field 
			$gallery->UpdateSort($gallery->special); // Field 
			$gallery->UpdateSort($gallery->order); // Field 
			$gallery->UpdateSort($gallery->active); // Field 
			$gallery->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $gallery;
		$sOrderBy = $gallery->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($gallery->SqlOrderBy() <> "") {
				$sOrderBy = $gallery->SqlOrderBy();
				$gallery->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $gallery;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$gallery->getCurrentMasterTable = ""; // Clear master table
				$gallery->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$gallery->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$gallery->category->setSessionValue("");
			}

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$gallery->setSessionOrderBy($sOrderBy);
				$gallery->id->setSort("");
				$gallery->name->setSort("");
				$gallery->name_arabic->setSort("");
				$gallery->image->setSort("");
				$gallery->category->setSort("");
				$gallery->link->setSort("");
				$gallery->special->setSort("");
				$gallery->order->setSort("");
				$gallery->active->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$gallery->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $gallery;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$gallery->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$gallery->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $gallery->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$gallery->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$gallery->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$gallery->setStartRecordNumber($this->lStartRec);
		}
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $gallery;

		// Get upload data
			$gallery->image->Upload->Index = $objForm->Index;
			if ($gallery->image->Upload->UploadFile()) {

				// No action required
			} else {
				echo $gallery->image->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load default values
	function LoadDefaultValues() {
		global $gallery;
		$gallery->category->CurrentValue = 0;
		$gallery->category->OldValue = $gallery->category->CurrentValue;
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $gallery;

		// Load search values
		// id

		$gallery->id->AdvancedSearch->SearchValue = @$_GET["x_id"];
		$gallery->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// name
		$gallery->name->AdvancedSearch->SearchValue = @$_GET["x_name"];
		$gallery->name->AdvancedSearch->SearchOperator = @$_GET["z_name"];

		// name_arabic
		$gallery->name_arabic->AdvancedSearch->SearchValue = @$_GET["x_name_arabic"];
		$gallery->name_arabic->AdvancedSearch->SearchOperator = @$_GET["z_name_arabic"];

		// category
		$gallery->category->AdvancedSearch->SearchValue = @$_GET["x_category"];
		$gallery->category->AdvancedSearch->SearchOperator = @$_GET["z_category"];

		// link
		$gallery->link->AdvancedSearch->SearchValue = @$_GET["x_link"];
		$gallery->link->AdvancedSearch->SearchOperator = @$_GET["z_link"];

		// special
		$gallery->special->AdvancedSearch->SearchValue = @$_GET["x_special"];
		$gallery->special->AdvancedSearch->SearchOperator = @$_GET["z_special"];

		// order
		$gallery->order->AdvancedSearch->SearchValue = @$_GET["x_order"];
		$gallery->order->AdvancedSearch->SearchOperator = @$_GET["z_order"];

		// active
		$gallery->active->AdvancedSearch->SearchValue = @$_GET["x_active"];
		$gallery->active->AdvancedSearch->SearchOperator = @$_GET["z_active"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $gallery;
		$gallery->id->setFormValue($objForm->GetValue("x_id"));
		$gallery->id->OldValue = $objForm->GetValue("o_id");
		$gallery->name->setFormValue($objForm->GetValue("x_name"));
		$gallery->name->OldValue = $objForm->GetValue("o_name");
		$gallery->name_arabic->setFormValue($objForm->GetValue("x_name_arabic"));
		$gallery->name_arabic->OldValue = $objForm->GetValue("o_name_arabic");
		$gallery->category->setFormValue($objForm->GetValue("x_category"));
		$gallery->category->OldValue = $objForm->GetValue("o_category");
		$gallery->link->setFormValue($objForm->GetValue("x_link"));
		$gallery->link->OldValue = $objForm->GetValue("o_link");
		$gallery->special->setFormValue($objForm->GetValue("x_special"));
		$gallery->special->OldValue = $objForm->GetValue("o_special");
		$gallery->order->setFormValue($objForm->GetValue("x_order"));
		$gallery->order->OldValue = $objForm->GetValue("o_order");
		$gallery->active->setFormValue($objForm->GetValue("x_active"));
		$gallery->active->OldValue = $objForm->GetValue("o_active");
	}

	// Restore form values
	function RestoreFormValues() {
		global $gallery;
		$gallery->id->CurrentValue = $gallery->id->FormValue;
		$gallery->name->CurrentValue = $gallery->name->FormValue;
		$gallery->name_arabic->CurrentValue = $gallery->name_arabic->FormValue;
		$gallery->category->CurrentValue = $gallery->category->FormValue;
		$gallery->link->CurrentValue = $gallery->link->FormValue;
		$gallery->special->CurrentValue = $gallery->special->FormValue;
		$gallery->order->CurrentValue = $gallery->order->FormValue;
		$gallery->active->CurrentValue = $gallery->active->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $gallery;

		// Call Recordset Selecting event
		$gallery->Recordset_Selecting($gallery->CurrentFilter);

		// Load list page SQL
		$sSql = $gallery->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$gallery->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $gallery;
		$sFilter = $gallery->KeyFilter();

		// Call Row Selecting event
		$gallery->Row_Selecting($sFilter);

		// Load sql based on filter
		$gallery->CurrentFilter = $sFilter;
		$sSql = $gallery->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$gallery->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $gallery;
		$gallery->id->setDbValue($rs->fields('id'));
		$gallery->name->setDbValue($rs->fields('name'));
		$gallery->name_arabic->setDbValue($rs->fields('name_arabic'));
		$gallery->image->Upload->DbValue = $rs->fields('image');
		$gallery->category->setDbValue($rs->fields('category'));
		$gallery->link->setDbValue($rs->fields('link'));
		$gallery->special->setDbValue($rs->fields('special'));
		$gallery->order->setDbValue($rs->fields('order'));
		$gallery->active->setDbValue($rs->fields('active'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $gallery;

		// Call Row_Rendering event
		$gallery->Row_Rendering();

		// Common render codes for all row types
		// id

		$gallery->id->CellCssStyle = "";
		$gallery->id->CellCssClass = "";

		// name
		$gallery->name->CellCssStyle = "";
		$gallery->name->CellCssClass = "";

		// name_arabic
		$gallery->name_arabic->CellCssStyle = "";
		$gallery->name_arabic->CellCssClass = "";

		// image
		$gallery->image->CellCssStyle = "";
		$gallery->image->CellCssClass = "";

		// category
		$gallery->category->CellCssStyle = "";
		$gallery->category->CellCssClass = "";

		// link
		$gallery->link->CellCssStyle = "";
		$gallery->link->CellCssClass = "";

		// special
		$gallery->special->CellCssStyle = "";
		$gallery->special->CellCssClass = "";

		// order
		$gallery->order->CellCssStyle = "";
		$gallery->order->CellCssClass = "";

		// active
		$gallery->active->CellCssStyle = "";
		$gallery->active->CellCssClass = "";
		if ($gallery->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$gallery->id->ViewValue = $gallery->id->CurrentValue;
			$gallery->id->CssStyle = "";
			$gallery->id->CssClass = "";
			$gallery->id->ViewCustomAttributes = "";

			// name
			$gallery->name->ViewValue = $gallery->name->CurrentValue;
			if ($gallery->Export == "")
				$gallery->name->ViewValue = ew_Highlight($gallery->HighlightName(), $gallery->name->ViewValue, $gallery->getBasicSearchKeyword(), $gallery->getBasicSearchType(), $gallery->getAdvancedSearch("x_name"));
			$gallery->name->CssStyle = "";
			$gallery->name->CssClass = "";
			$gallery->name->ViewCustomAttributes = "";

			// name_arabic
			$gallery->name_arabic->ViewValue = $gallery->name_arabic->CurrentValue;
			if ($gallery->Export == "")
				$gallery->name_arabic->ViewValue = ew_Highlight($gallery->HighlightName(), $gallery->name_arabic->ViewValue, $gallery->getBasicSearchKeyword(), $gallery->getBasicSearchType(), $gallery->getAdvancedSearch("x_name_arabic"));
			$gallery->name_arabic->CssStyle = "";
			$gallery->name_arabic->CssClass = "";
			$gallery->name_arabic->ViewCustomAttributes = "";

			// image
			if (!is_null($gallery->image->Upload->DbValue)) {
				$gallery->image->ViewValue = $gallery->image->Upload->DbValue;
				$gallery->image->ImageWidth = 100;
				$gallery->image->ImageHeight = 0;
				$gallery->image->ImageAlt = "";
			} else {
				$gallery->image->ViewValue = "";
			}
			$gallery->image->CssStyle = "";
			$gallery->image->CssClass = "";
			$gallery->image->ViewCustomAttributes = "";

			// category
			if (strval($gallery->category->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `name`, `name_arabic` FROM `categories` WHERE `id` = " . ew_AdjustSql($gallery->category->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$gallery->category->ViewValue = $rswrk->fields('name');
					$gallery->category->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('name_arabic');
					$rswrk->Close();
				} else {
					$gallery->category->ViewValue = $gallery->category->CurrentValue;
				}
			} else {
				$gallery->category->ViewValue = NULL;
			}
			$gallery->category->CssStyle = "";
			$gallery->category->CssClass = "";
			$gallery->category->ViewCustomAttributes = "";

			// link
			$gallery->link->ViewValue = $gallery->link->CurrentValue;
			if ($gallery->Export == "")
				$gallery->link->ViewValue = ew_Highlight($gallery->HighlightName(), $gallery->link->ViewValue, $gallery->getBasicSearchKeyword(), $gallery->getBasicSearchType(), $gallery->getAdvancedSearch("x_link"));
			$gallery->link->CssStyle = "";
			$gallery->link->CssClass = "";
			$gallery->link->ViewCustomAttributes = "";

			// special
			if (strval($gallery->special->CurrentValue) <> "") {
				switch ($gallery->special->CurrentValue) {
					case "0":
						$gallery->special->ViewValue = "No";
						break;
					case "1":
						$gallery->special->ViewValue = "Yes";
						break;
					default:
						$gallery->special->ViewValue = $gallery->special->CurrentValue;
				}
			} else {
				$gallery->special->ViewValue = NULL;
			}
			$gallery->special->CssStyle = "";
			$gallery->special->CssClass = "";
			$gallery->special->ViewCustomAttributes = "";

			// order
			$gallery->order->ViewValue = $gallery->order->CurrentValue;
			$gallery->order->CssStyle = "";
			$gallery->order->CssClass = "";
			$gallery->order->ViewCustomAttributes = "";

			// active
			if (strval($gallery->active->CurrentValue) <> "") {
				switch ($gallery->active->CurrentValue) {
					case "0":
						$gallery->active->ViewValue = "No";
						break;
					case "1":
						$gallery->active->ViewValue = "Yes";
						break;
					default:
						$gallery->active->ViewValue = $gallery->active->CurrentValue;
				}
			} else {
				$gallery->active->ViewValue = NULL;
			}
			$gallery->active->CssStyle = "";
			$gallery->active->CssClass = "";
			$gallery->active->ViewCustomAttributes = "";

			// id
			$gallery->id->HrefValue = "";

			// name
			$gallery->name->HrefValue = "";

			// name_arabic
			$gallery->name_arabic->HrefValue = "";

			// image
			$gallery->image->HrefValue = "";

			// category
			$gallery->category->HrefValue = "";

			// link
			$gallery->link->HrefValue = "";

			// special
			$gallery->special->HrefValue = "";

			// order
			$gallery->order->HrefValue = "";

			// active
			$gallery->active->HrefValue = "";
		} elseif ($gallery->RowType == EW_ROWTYPE_ADD) { // Add row

			// id
			// name

			$gallery->name->EditCustomAttributes = "";
			$gallery->name->EditValue = ew_HtmlEncode($gallery->name->CurrentValue);

			// name_arabic
			$gallery->name_arabic->EditCustomAttributes = "";
			$gallery->name_arabic->EditValue = ew_HtmlEncode($gallery->name_arabic->CurrentValue);

			// image
			$gallery->image->EditCustomAttributes = "";
			if (!is_null($gallery->image->Upload->DbValue)) {
				$gallery->image->EditValue = $gallery->image->Upload->DbValue;
				$gallery->image->ImageWidth = 100;
				$gallery->image->ImageHeight = 0;
				$gallery->image->ImageAlt = "";
			} else {
				$gallery->image->EditValue = "";
			}

			// category
			$gallery->category->EditCustomAttributes = "";
			if ($gallery->category->getSessionValue() <> "") {
				$gallery->category->CurrentValue = $gallery->category->getSessionValue();
				$gallery->category->OldValue = $gallery->category->CurrentValue;
			if (strval($gallery->category->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `name`, `name_arabic` FROM `categories` WHERE `id` = " . ew_AdjustSql($gallery->category->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$gallery->category->ViewValue = $rswrk->fields('name');
					$gallery->category->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('name_arabic');
					$rswrk->Close();
				} else {
					$gallery->category->ViewValue = $gallery->category->CurrentValue;
				}
			} else {
				$gallery->category->ViewValue = NULL;
			}
			$gallery->category->CssStyle = "";
			$gallery->category->CssClass = "";
			$gallery->category->ViewCustomAttributes = "";
			} else {
			$sSqlWrk = "SELECT `id`, `name`, `name_arabic`, '' AS SelectFilterFld FROM `categories`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select", ""));
			$gallery->category->EditValue = $arwrk;
			}

			// link
			$gallery->link->EditCustomAttributes = "";
			$gallery->link->EditValue = ew_HtmlEncode($gallery->link->CurrentValue);

			// special
			$gallery->special->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$gallery->special->EditValue = $arwrk;

			// order
			$gallery->order->EditCustomAttributes = "";
			$gallery->order->EditValue = ew_HtmlEncode($gallery->order->CurrentValue);

			// active
			$gallery->active->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$gallery->active->EditValue = $arwrk;
		} elseif ($gallery->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$gallery->id->EditCustomAttributes = "";
			$gallery->id->EditValue = $gallery->id->CurrentValue;
			$gallery->id->CssStyle = "";
			$gallery->id->CssClass = "";
			$gallery->id->ViewCustomAttributes = "";

			// name
			$gallery->name->EditCustomAttributes = "";
			$gallery->name->EditValue = ew_HtmlEncode($gallery->name->CurrentValue);

			// name_arabic
			$gallery->name_arabic->EditCustomAttributes = "";
			$gallery->name_arabic->EditValue = ew_HtmlEncode($gallery->name_arabic->CurrentValue);

			// image
			$gallery->image->EditCustomAttributes = "";
			if (!is_null($gallery->image->Upload->DbValue)) {
				$gallery->image->EditValue = $gallery->image->Upload->DbValue;
				$gallery->image->ImageWidth = 100;
				$gallery->image->ImageHeight = 0;
				$gallery->image->ImageAlt = "";
			} else {
				$gallery->image->EditValue = "";
			}

			// category
			$gallery->category->EditCustomAttributes = "";
			if ($gallery->category->getSessionValue() <> "") {
				$gallery->category->CurrentValue = $gallery->category->getSessionValue();
				$gallery->category->OldValue = $gallery->category->CurrentValue;
			if (strval($gallery->category->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `name`, `name_arabic` FROM `categories` WHERE `id` = " . ew_AdjustSql($gallery->category->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$gallery->category->ViewValue = $rswrk->fields('name');
					$gallery->category->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('name_arabic');
					$rswrk->Close();
				} else {
					$gallery->category->ViewValue = $gallery->category->CurrentValue;
				}
			} else {
				$gallery->category->ViewValue = NULL;
			}
			$gallery->category->CssStyle = "";
			$gallery->category->CssClass = "";
			$gallery->category->ViewCustomAttributes = "";
			} else {
			$sSqlWrk = "SELECT `id`, `name`, `name_arabic`, '' AS SelectFilterFld FROM `categories`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select", ""));
			$gallery->category->EditValue = $arwrk;
			}

			// link
			$gallery->link->EditCustomAttributes = "";
			$gallery->link->EditValue = ew_HtmlEncode($gallery->link->CurrentValue);

			// special
			$gallery->special->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$gallery->special->EditValue = $arwrk;

			// order
			$gallery->order->EditCustomAttributes = "";
			$gallery->order->EditValue = ew_HtmlEncode($gallery->order->CurrentValue);

			// active
			$gallery->active->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$gallery->active->EditValue = $arwrk;

			// Edit refer script
			// id

			$gallery->id->HrefValue = "";

			// name
			$gallery->name->HrefValue = "";

			// name_arabic
			$gallery->name_arabic->HrefValue = "";

			// image
			$gallery->image->HrefValue = "";

			// category
			$gallery->category->HrefValue = "";

			// link
			$gallery->link->HrefValue = "";

			// special
			$gallery->special->HrefValue = "";

			// order
			$gallery->order->HrefValue = "";

			// active
			$gallery->active->HrefValue = "";
		}

		// Call Row Rendered event
		$gallery->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $gallery;

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
		global $gsFormError, $gallery;

		// Initialize
		$gsFormError = "";
		if (!ew_CheckFileType($gallery->image->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "File type is not allowed.";
		}
		if ($gallery->image->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($gallery->image->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "Max. file size (%s bytes) exceeded.");
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($gallery->name->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - name";
		}
		if ($gallery->name_arabic->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - name arabic";
		}
		if ($gallery->CurrentAction == "gridupdate" || $gallery->CurrentAction == "update") {
			if ($gallery->image->Upload->Action == "3" && is_null($gallery->image->Upload->Value)) {
				$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
				$gsFormError .= "Please enter required field - image";
			}
		} elseif (is_null($gallery->image->Upload->Value)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - image";
		}
		if ($gallery->category->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - category";
		}
		if ($gallery->link->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - link";
		}
		if ($gallery->special->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - special";
		}
		if ($gallery->order->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - order";
		}
		if (!ew_CheckInteger($gallery->order->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - order";
		}
		if ($gallery->active->FormValue == "") {
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
		global $conn, $Security, $gallery;
		$sFilter = $gallery->KeyFilter();
		$gallery->CurrentFilter = $sFilter;
		$sSql = $gallery->SQL();
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

			$gallery->name->SetDbValueDef($gallery->name->CurrentValue, "");
			$rsnew['name'] =& $gallery->name->DbValue;

			// Field name_arabic
			$gallery->name_arabic->SetDbValueDef($gallery->name_arabic->CurrentValue, "");
			$rsnew['name_arabic'] =& $gallery->name_arabic->DbValue;

			// Field image
			$gallery->image->Upload->SaveToSession(); // Save file value to Session
						if ($gallery->image->Upload->Action == "2" || $gallery->image->Upload->Action == "3") { // Update/Remove
			$gallery->image->Upload->DbValue = $rs->fields('image'); // Get original value
			if (is_null($gallery->image->Upload->Value)) {
				$rsnew['image'] = NULL;
			} else {
				if ($gallery->image->Upload->FileName == $gallery->image->Upload->DbValue) { // Upload file name same as old file name
					$rsnew['image'] = $gallery->image->Upload->FileName;
				} else {
					$rsnew['image'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, "../images/"), $gallery->image->Upload->FileName);
				}
			}
			}

			// Field category
			$gallery->category->SetDbValueDef($gallery->category->CurrentValue, 0);
			$rsnew['category'] =& $gallery->category->DbValue;

			// Field link
			$gallery->link->SetDbValueDef($gallery->link->CurrentValue, "");
			$rsnew['link'] =& $gallery->link->DbValue;

			// Field special
			$gallery->special->SetDbValueDef($gallery->special->CurrentValue, 0);
			$rsnew['special'] =& $gallery->special->DbValue;

			// Field order
			$gallery->order->SetDbValueDef($gallery->order->CurrentValue, 0);
			$rsnew['order'] =& $gallery->order->DbValue;

			// Field active
			$gallery->active->SetDbValueDef($gallery->active->CurrentValue, 0);
			$rsnew['active'] =& $gallery->active->DbValue;

			// Call Row Updating event
			$bUpdateRow = $gallery->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {

			// Field image
			if (!is_null($gallery->image->Upload->Value)) {
				if ($gallery->image->Upload->FileName == $gallery->image->Upload->DbValue) { // Overwrite if same file name
					$gallery->image->Upload->SaveToFile("../images/", $rsnew['image'], TRUE);
					$gallery->image->Upload->DbValue = ""; // No need to delete any more
				} else {
					$gallery->image->Upload->SaveToFile("../images/", $rsnew['image'], FALSE);
				}
			}
			if ($gallery->image->Upload->Action == "2" || $gallery->image->Upload->Action == "3") { // Update/Remove
				if ($gallery->image->Upload->DbValue <> "")
					@unlink(ew_UploadPathEx(TRUE, "../images/") . $gallery->image->Upload->DbValue);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($gallery->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($gallery->CancelMessage <> "") {
					$this->setMessage($gallery->CancelMessage);
					$gallery->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$gallery->Row_Updated($rsold, $rsnew);
		$rs->Close();

		// Field image
		$gallery->image->Upload->RemoveFromSession(); // Remove file value from Session
		return $EditRow;
	}

	// Add record
	function AddRow() {
		global $conn, $Security, $gallery;
		$rsnew = array();

		// Field id
		// Field name

		$gallery->name->SetDbValueDef($gallery->name->CurrentValue, "");
		$rsnew['name'] =& $gallery->name->DbValue;

		// Field name_arabic
		$gallery->name_arabic->SetDbValueDef($gallery->name_arabic->CurrentValue, "");
		$rsnew['name_arabic'] =& $gallery->name_arabic->DbValue;

		// Field image
		$gallery->image->Upload->SaveToSession(); // Save file value to Session
		if (is_null($gallery->image->Upload->Value)) {
			$rsnew['image'] = NULL;
		} else {
			$rsnew['image'] = ew_UploadFileNameEx(ew_UploadPathEx(True, "../images/"), $gallery->image->Upload->FileName);
		}

		// Field category
		$gallery->category->SetDbValueDef($gallery->category->CurrentValue, 0);
		$rsnew['category'] =& $gallery->category->DbValue;

		// Field link
		$gallery->link->SetDbValueDef($gallery->link->CurrentValue, "");
		$rsnew['link'] =& $gallery->link->DbValue;

		// Field special
		$gallery->special->SetDbValueDef($gallery->special->CurrentValue, 0);
		$rsnew['special'] =& $gallery->special->DbValue;

		// Field order
		$gallery->order->SetDbValueDef($gallery->order->CurrentValue, 0);
		$rsnew['order'] =& $gallery->order->DbValue;

		// Field active
		$gallery->active->SetDbValueDef($gallery->active->CurrentValue, 0);
		$rsnew['active'] =& $gallery->active->DbValue;

		// Call Row Inserting event
		$bInsertRow = $gallery->Row_Inserting($rsnew);
		if ($bInsertRow) {

			// Field image
			if (!is_null($gallery->image->Upload->Value)) {
				if ($gallery->image->Upload->FileName == $gallery->image->Upload->DbValue) { // Overwrite if same file name
					$gallery->image->Upload->SaveToFile("../images/", $rsnew['image'], TRUE);
					$gallery->image->Upload->DbValue = ""; // No need to delete any more
				} else {
					$gallery->image->Upload->SaveToFile("../images/", $rsnew['image'], FALSE);
				}
			}
			if ($gallery->image->Upload->Action == "2" || $gallery->image->Upload->Action == "3") { // Update/Remove
				if ($gallery->image->Upload->DbValue <> "")
					@unlink(ew_UploadPathEx(TRUE, "../images/") . $gallery->image->Upload->DbValue);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($gallery->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($gallery->CancelMessage <> "") {
				$this->setMessage($gallery->CancelMessage);
				$gallery->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$gallery->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $gallery->id->DbValue;

			// Call Row Inserted event
			$gallery->Row_Inserted($rsnew);
		}

		// Field image
		$gallery->image->Upload->RemoveFromSession(); // Remove file value from Session
		return $AddRow;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $gallery;
		$gallery->id->AdvancedSearch->SearchValue = $gallery->getAdvancedSearch("x_id");
		$gallery->name->AdvancedSearch->SearchValue = $gallery->getAdvancedSearch("x_name");
		$gallery->name_arabic->AdvancedSearch->SearchValue = $gallery->getAdvancedSearch("x_name_arabic");
		$gallery->category->AdvancedSearch->SearchValue = $gallery->getAdvancedSearch("x_category");
		$gallery->link->AdvancedSearch->SearchValue = $gallery->getAdvancedSearch("x_link");
		$gallery->special->AdvancedSearch->SearchValue = $gallery->getAdvancedSearch("x_special");
		$gallery->order->AdvancedSearch->SearchValue = $gallery->getAdvancedSearch("x_order");
		$gallery->active->AdvancedSearch->SearchValue = $gallery->getAdvancedSearch("x_active");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $gallery;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($gallery->ExportAll) {
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
		if ($gallery->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo "\xEF\xBB\xBF";
			echo ew_ExportHeader($gallery->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $gallery->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id', $gallery->Export);
				ew_ExportAddValue($sExportStr, 'name', $gallery->Export);
				ew_ExportAddValue($sExportStr, 'name_arabic', $gallery->Export);
				ew_ExportAddValue($sExportStr, 'image', $gallery->Export);
				ew_ExportAddValue($sExportStr, 'category', $gallery->Export);
				ew_ExportAddValue($sExportStr, 'link', $gallery->Export);
				ew_ExportAddValue($sExportStr, 'special', $gallery->Export);
				ew_ExportAddValue($sExportStr, 'order', $gallery->Export);
				ew_ExportAddValue($sExportStr, 'active', $gallery->Export);
				echo ew_ExportLine($sExportStr, $gallery->Export);
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
				$gallery->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($gallery->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id', $gallery->id->CurrentValue);
					$XmlDoc->AddField('name', $gallery->name->CurrentValue);
					$XmlDoc->AddField('name_arabic', $gallery->name_arabic->CurrentValue);
					$XmlDoc->AddField('image', $gallery->image->CurrentValue);
					$XmlDoc->AddField('category', $gallery->category->CurrentValue);
					$XmlDoc->AddField('link', $gallery->link->CurrentValue);
					$XmlDoc->AddField('special', $gallery->special->CurrentValue);
					$XmlDoc->AddField('order', $gallery->order->CurrentValue);
					$XmlDoc->AddField('active', $gallery->active->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $gallery->Export <> "csv") { // Vertical format
						echo ew_ExportField('id', $gallery->id->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						echo ew_ExportField('name', $gallery->name->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						echo ew_ExportField('name_arabic', $gallery->name_arabic->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						echo ew_ExportField('image', $gallery->image->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						echo ew_ExportField('category', $gallery->category->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						echo ew_ExportField('link', $gallery->link->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						echo ew_ExportField('special', $gallery->special->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						echo ew_ExportField('order', $gallery->order->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						echo ew_ExportField('active', $gallery->active->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $gallery->id->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						ew_ExportAddValue($sExportStr, $gallery->name->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						ew_ExportAddValue($sExportStr, $gallery->name_arabic->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						ew_ExportAddValue($sExportStr, $gallery->image->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						ew_ExportAddValue($sExportStr, $gallery->category->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						ew_ExportAddValue($sExportStr, $gallery->link->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						ew_ExportAddValue($sExportStr, $gallery->special->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						ew_ExportAddValue($sExportStr, $gallery->order->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						ew_ExportAddValue($sExportStr, $gallery->active->ExportValue($gallery->Export, $gallery->ExportOriginalValue), $gallery->Export);
						echo ew_ExportLine($sExportStr, $gallery->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($gallery->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($gallery->Export);
		}
	}

	// Set up Master Detail based on querystring parameter
	function SetUpMasterDetail() {
		global $gallery;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "categories") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $gallery->SqlMasterFilter_categories();
				$this->sDbDetailFilter = $gallery->SqlDetailFilter_categories();
				if (@$_GET["id"] <> "") {
					$GLOBALS["categories"]->id->setQueryStringValue($_GET["id"]);
					$gallery->category->setQueryStringValue($GLOBALS["categories"]->id->QueryStringValue);
					$gallery->category->setSessionValue($gallery->category->QueryStringValue);
					if (!is_numeric($GLOBALS["categories"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["categories"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@category@", ew_AdjustSql($GLOBALS["categories"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$gallery->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$gallery->setStartRecordNumber($this->lStartRec);
			$gallery->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$gallery->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master session values
			if ($sMasterTblVar <> "categories") {
				if ($gallery->category->QueryStringValue == "") $gallery->category->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $gallery->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $gallery->getDetailFilter(); // Restore detail filter
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
