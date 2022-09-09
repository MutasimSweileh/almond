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
$products_list = new cproducts_list();
$Page =& $products_list;

// Page init processing
$products_list->Page_Init();

// Page main processing
$products_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($products->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var products_list = new ew_Page("products_list");

// page properties
products_list.PageID = "list"; // page ID
var EW_PAGE_ID = products_list.PageID; // for backward compatibility

// extend page with ValidateForm function
products_list.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_level"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - level");
		elm = fobj.elements["x" + infix + "_level"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "Incorrect integer - level");
		elm = fobj.elements["x" + infix + "_image"];
		aelm = fobj.elements["a" + infix + "_image"];
		var chk_image = (aelm && aelm[0])?(aelm[2].checked):true;
		if (elm && chk_image && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - image");
		elm = fobj.elements["x" + infix + "_image"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, "File type is not allowed.");
		elm = fobj.elements["x" + infix + "_image2"];
		aelm = fobj.elements["a" + infix + "_image2"];
		var chk_image2 = (aelm && aelm[0])?(aelm[2].checked):true;
		if (elm && chk_image2 && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - image 2");
		elm = fobj.elements["x" + infix + "_image2"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, "File type is not allowed.");
		elm = fobj.elements["x" + infix + "_image3"];
		aelm = fobj.elements["a" + infix + "_image3"];
		var chk_image3 = (aelm && aelm[0])?(aelm[2].checked):true;
		if (elm && chk_image3 && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - image 3");
		elm = fobj.elements["x" + infix + "_image3"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, "File type is not allowed.");
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
products_list.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "name")) return false;
	if (ew_ValueChanged(fobj, infix, "name_arabic")) return false;
	if (ew_ValueChanged(fobj, infix, "level")) return false;
	if (ew_ValueChanged(fobj, infix, "image")) return false;
	if (ew_ValueChanged(fobj, infix, "image2")) return false;
	if (ew_ValueChanged(fobj, infix, "image3")) return false;
	if (ew_ValueChanged(fobj, infix, "special")) return false;
	if (ew_ValueChanged(fobj, infix, "order")) return false;
	if (ew_ValueChanged(fobj, infix, "active")) return false;
	return true;
}

// extend page with Form_CustomValidate function
products_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
products_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
products_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
products_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
products_list.ShowHighlightText = "Show highlight"; 
products_list.HideHighlightText = "Hide highlight";

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
<?php if ($products->Export == "") { ?>
<?php } ?>
<?php
if ($products->CurrentAction == "gridadd")
	$products->CurrentFilter = "0=1";
if ($products->CurrentAction == "gridadd") {
	$products_list->lStartRec = 1;
	if ($products_list->lDisplayRecs <= 0)
		$products_list->lDisplayRecs = 20;
	$products_list->lTotalRecs = $products_list->lDisplayRecs;
	$products_list->lStopRec = $products_list->lDisplayRecs;
} else {
	$bSelectLimit = ($products->Export == "" && $products->SelectLimit);
	if (!$bSelectLimit)
		$rs = $products_list->LoadRecordset();
	$products_list->lTotalRecs = ($bSelectLimit) ? $products->SelectRecordCount() : $rs->RecordCount();
	$products_list->lStartRec = 1;
	if ($products_list->lDisplayRecs <= 0) // Display all records
		$products_list->lDisplayRecs = $products_list->lTotalRecs;
	if (!($products->ExportAll && $products->Export <> ""))
		$products_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $products_list->LoadRecordset($products_list->lStartRec-1, $products_list->lDisplayRecs);
}
?>
<p><span class="phpmaker" style="white-space: nowrap;">TABLE: products
<?php if ($products->Export == "" && $products->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $products_list->PageUrl() ?>export=print">Printer Friendly</a>
&nbsp;&nbsp;<a href="<?php echo $products_list->PageUrl() ?>export=html">Export to HTML</a>
&nbsp;&nbsp;<a href="<?php echo $products_list->PageUrl() ?>export=excel">Export to Excel</a>
&nbsp;&nbsp;<a href="<?php echo $products_list->PageUrl() ?>export=word">Export to Word</a>
&nbsp;&nbsp;<a href="<?php echo $products_list->PageUrl() ?>export=xml">Export to XML</a>
&nbsp;&nbsp;<a href="<?php echo $products_list->PageUrl() ?>export=csv">Export to CSV</a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($products->Export == "" && $products->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(products_list);" style="text-decoration: none;"><img id="products_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="products_list_SearchPanel">
<form name="fproductslistsrch" id="fproductslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="products">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($products->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Search (*)">&nbsp;
			<a href="<?php echo $products_list->PageUrl() ?>cmd=reset">Show all</a>&nbsp;
			<a href="productssrch.php">Advanced Search</a>&nbsp;
			<?php if ($products_list->sSrchWhere <> "" && $products_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(products_list, this, '<?php echo $products->HighlightName() ?>');">Hide highlight</a>
			<?php } ?>
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($products->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>Exact phrase</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($products->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>All words</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($products->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>Any word</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $products_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($products->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($products->CurrentAction <> "gridadd" && $products->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($products_list->Pager)) $products_list->Pager = new cPrevNextPager($products_list->lStartRec, $products_list->lDisplayRecs, $products_list->lTotalRecs) ?>
<?php if ($products_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($products_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $products_list->PageUrl() ?>start=<?php echo $products_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($products_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $products_list->PageUrl() ?>start=<?php echo $products_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $products_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($products_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $products_list->PageUrl() ?>start=<?php echo $products_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($products_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $products_list->PageUrl() ?>start=<?php echo $products_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $products_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $products_list->Pager->FromIndex ?> to <?php echo $products_list->Pager->ToIndex ?> of <?php echo $products_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($products_list->sSrchWhere == "0=101") { ?>
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
<?php if ($products->CurrentAction <> "gridadd" && $products->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $products->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<a href="<?php echo $products_list->PageUrl() ?>a=add">Inline Add</a>&nbsp;&nbsp;
<a href="<?php echo $products_list->PageUrl() ?>a=gridadd">Grid Add</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($products_list->lTotalRecs > 0) { ?>
<a href="<?php echo $products_list->PageUrl() ?>a=gridedit">Grid Edit</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if ($products_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fproductslist)) alert('No records selected'); else if (ew_Confirm('<?php echo $products_list->sDeleteConfirmMsg ?>')) {document.fproductslist.action='productsdelete.php';document.fproductslist.encoding='application/x-www-form-urlencoded';document.fproductslist.submit();};return false;">Delete Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fproductslist)) alert('No records selected'); else {document.fproductslist.action='productsupdate.php';document.fproductslist.encoding='application/x-www-form-urlencoded';document.fproductslist.submit();};return false;">Update Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($products->CurrentAction == "gridadd") { ?>
<a href="" onclick="if (products_list.ValidateForm(document.fproductslist)) document.fproductslist.submit();return false;">Insert</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($products->CurrentAction == "gridedit") { ?>
<a href="" onclick="if (products_list.ValidateForm(document.fproductslist)) document.fproductslist.submit();return false;">Save</a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php echo $products_list->PageUrl() ?>a=cancel">Cancel</a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fproductslist" id="fproductslist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="t" id="t" value="products">
<?php if ($products_list->lTotalRecs > 0 || $products->CurrentAction == "add" || $products->CurrentAction == "copy") { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$products_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$products_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$products_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$products_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$products_list->lOptionCnt++; // Detail
}
if ($Security->IsLoggedIn()) {
	$products_list->lOptionCnt++; // Detail
}
if ($Security->IsLoggedIn()) {
	$products_list->lOptionCnt++; // Multi-select
}
	$products_list->lOptionCnt += count($products_list->ListOptions->Items); // Custom list options
?>
<?php echo $products->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($products->id->Visible) { // id ?>
	<?php if ($products->SortUrl($products->id) == "") { ?>
		<td>id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $products->SortUrl($products->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>id</td><td style="width: 10px;"><?php if ($products->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($products->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($products->name->Visible) { // name ?>
	<?php if ($products->SortUrl($products->name) == "") { ?>
		<td>name</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $products->SortUrl($products->name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>name&nbsp;(*)</td><td style="width: 10px;"><?php if ($products->name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($products->name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($products->name_arabic->Visible) { // name_arabic ?>
	<?php if ($products->SortUrl($products->name_arabic) == "") { ?>
		<td>name arabic</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $products->SortUrl($products->name_arabic) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>name arabic&nbsp;(*)</td><td style="width: 10px;"><?php if ($products->name_arabic->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($products->name_arabic->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($products->level->Visible) { // level ?>
	<?php if ($products->SortUrl($products->level) == "") { ?>
		<td>level</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $products->SortUrl($products->level) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>level</td><td style="width: 10px;"><?php if ($products->level->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($products->level->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($products->image->Visible) { // image ?>
	<?php if ($products->SortUrl($products->image) == "") { ?>
		<td>image</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $products->SortUrl($products->image) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>image</td><td style="width: 10px;"><?php if ($products->image->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($products->image->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($products->image2->Visible) { // image2 ?>
	<?php if ($products->SortUrl($products->image2) == "") { ?>
		<td>image 2</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $products->SortUrl($products->image2) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>image 2</td><td style="width: 10px;"><?php if ($products->image2->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($products->image2->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($products->image3->Visible) { // image3 ?>
	<?php if ($products->SortUrl($products->image3) == "") { ?>
		<td>image 3</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $products->SortUrl($products->image3) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>image 3</td><td style="width: 10px;"><?php if ($products->image3->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($products->image3->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($products->special->Visible) { // special ?>
	<?php if ($products->SortUrl($products->special) == "") { ?>
		<td>special</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $products->SortUrl($products->special) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>special</td><td style="width: 10px;"><?php if ($products->special->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($products->special->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($products->order->Visible) { // order ?>
	<?php if ($products->SortUrl($products->order) == "") { ?>
		<td>order</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $products->SortUrl($products->order) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>order</td><td style="width: 10px;"><?php if ($products->order->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($products->order->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($products->active->Visible) { // active ?>
	<?php if ($products->SortUrl($products->active) == "") { ?>
		<td>active</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $products->SortUrl($products->active) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>active</td><td style="width: 10px;"><?php if ($products->active->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($products->active->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($products->Export == "") { ?>
<?php if ($products->CurrentAction <> "gridadd" && $products->CurrentAction <> "gridedit") { ?>
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
<?php if ($products_list->lOptionCnt == 0 && $products->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="phpmaker" onclick="products_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($products_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
</thead>
<?php
	if ($products->CurrentAction == "add" || $products->CurrentAction == "copy") {
		$products_list->lRowIndex = 1;
		if ($products->CurrentAction == "copy" && !$products_list->LoadRow())
				$products->CurrentAction = "add";
		if ($products->CurrentAction == "add")
			$products_list->LoadDefaultValues();
		if ($products->EventCancelled) // Insert failed
			$products_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$products->CssClass = "ewTableEditRow";
		$products->CssStyle = "";
		$products->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
		$products->RowType = EW_ROWTYPE_ADD;

		// Render row
		$products_list->RenderRow();
?>
	<tr<?php echo $products->RowAttributes() ?>>
	<?php if ($products->id->Visible) { // id ?>
		<td>&nbsp;</td>
	<?php } ?>
	<?php if ($products->name->Visible) { // name ?>
		<td>
<input type="text" name="x<?php echo $products_list->lRowIndex ?>_name" id="x<?php echo $products_list->lRowIndex ?>_name" size="30" maxlength="200" value="<?php echo $products->name->EditValue ?>"<?php echo $products->name->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($products->name_arabic->Visible) { // name_arabic ?>
		<td>
<input type="text" name="x<?php echo $products_list->lRowIndex ?>_name_arabic" id="x<?php echo $products_list->lRowIndex ?>_name_arabic" size="30" maxlength="200" value="<?php echo $products->name_arabic->EditValue ?>"<?php echo $products->name_arabic->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($products->level->Visible) { // level ?>
		<td>
<input type="text" name="x<?php echo $products_list->lRowIndex ?>_level" id="x<?php echo $products_list->lRowIndex ?>_level" size="30" value="<?php echo $products->level->EditValue ?>"<?php echo $products->level->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($products->image->Visible) { // image ?>
		<td>
<input type="file" name="x<?php echo $products_list->lRowIndex ?>_image" id="x<?php echo $products_list->lRowIndex ?>_image" size="30"<?php echo $products->image->EditAttributes() ?>>
</div>
</td>
	<?php } ?>
	<?php if ($products->image2->Visible) { // image2 ?>
		<td>
<input type="file" name="x<?php echo $products_list->lRowIndex ?>_image2" id="x<?php echo $products_list->lRowIndex ?>_image2" size="30"<?php echo $products->image2->EditAttributes() ?>>
</div>
</td>
	<?php } ?>
	<?php if ($products->image3->Visible) { // image3 ?>
		<td>
<input type="file" name="x<?php echo $products_list->lRowIndex ?>_image3" id="x<?php echo $products_list->lRowIndex ?>_image3" size="30"<?php echo $products->image3->EditAttributes() ?>>
</div>
</td>
	<?php } ?>
	<?php if ($products->special->Visible) { // special ?>
		<td>
<div id="tp_x<?php echo $products_list->lRowIndex ?>_special" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x<?php echo $products_list->lRowIndex ?>_special" id="x<?php echo $products_list->lRowIndex ?>_special" value="{value}"<?php echo $products->special->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $products_list->lRowIndex ?>_special" repeatcolumn="5">
<?php
$arwrk = $products->special->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($products->special->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $products_list->lRowIndex ?>_special" id="x<?php echo $products_list->lRowIndex ?>_special" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $products->special->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
if ($emptywrk) $products->special->OldValue = "";
?>
</div>
</td>
	<?php } ?>
	<?php if ($products->order->Visible) { // order ?>
		<td>
<input type="text" name="x<?php echo $products_list->lRowIndex ?>_order" id="x<?php echo $products_list->lRowIndex ?>_order" size="30" value="<?php echo $products->order->EditValue ?>"<?php echo $products->order->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($products->active->Visible) { // active ?>
		<td>
<div id="tp_x<?php echo $products_list->lRowIndex ?>_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x<?php echo $products_list->lRowIndex ?>_active" id="x<?php echo $products_list->lRowIndex ?>_active" value="{value}"<?php echo $products->active->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $products_list->lRowIndex ?>_active" repeatcolumn="5">
<?php
$arwrk = $products->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($products->active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $products_list->lRowIndex ?>_active" id="x<?php echo $products_list->lRowIndex ?>_active" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $products->active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
if ($emptywrk) $products->active->OldValue = "";
?>
</div>
</td>
	<?php } ?>
<td colspan="<?php echo $products_list->lOptionCnt ?>"><span class="phpmaker">
<a href="" onclick="if (products_list.ValidateForm(document.fproductslist)) document.fproductslist.submit();return false;">Insert</a>&nbsp;<a href="<?php echo $products_list->PageUrl() ?>a=cancel">Cancel</a>
<input type="hidden" name="a_list" id="a_list" value="insert">
</span></td>
	</tr>
<?php
}
?>
<?php
if ($products->ExportAll && $products->Export <> "") {
	$products_list->lStopRec = $products_list->lTotalRecs;
} else {
	$products_list->lStopRec = $products_list->lStartRec + $products_list->lDisplayRecs - 1; // Set the last record to display
}
$products_list->lRecCount = $products_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$products->SelectLimit && $products_list->lStartRec > 1)
		$rs->Move($products_list->lStartRec - 1);
}
$products_list->lRowCnt = 0;
$products_list->lEditRowCnt = 0;
if ($products->CurrentAction == "edit")
	$products_list->lRowIndex = 1;
if ($products->CurrentAction == "gridadd")
	$products_list->lRowIndex = 0;
if ($products->CurrentAction == "gridedit")
	$products_list->lRowIndex = 0;
while (($products->CurrentAction == "gridadd" || !$rs->EOF) &&
	$products_list->lRecCount < $products_list->lStopRec) {
	$products_list->lRecCount++;
	if (intval($products_list->lRecCount) >= intval($products_list->lStartRec)) {
		$products_list->lRowCnt++;
		if ($products->CurrentAction == "gridadd" || $products->CurrentAction == "gridedit")
			$products_list->lRowIndex++;

	// Init row class and style
	$products->CssClass = "";
	$products->CssStyle = "";
	$products->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($products->CurrentAction == "gridadd") {
		$products_list->LoadDefaultValues(); // Load default values
	} else {
		$products_list->LoadRowValues($rs); // Load row values
	}
	$products->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($products->CurrentAction == "gridadd") // Grid add
		$products->RowType = EW_ROWTYPE_ADD; // Render add
	if ($products->CurrentAction == "gridadd" && $products->EventCancelled) // Insert failed
		$products_list->RestoreCurrentRowFormValues($products_list->lRowIndex); // Restore form values
	if ($products->CurrentAction == "edit") {
		if ($products_list->CheckInlineEditKey() && $products_list->lEditRowCnt == 0) // Inline edit
			$products->RowType = EW_ROWTYPE_EDIT; // Render edit
	}
	if ($products->CurrentAction == "gridedit") // Grid edit
		$products->RowType = EW_ROWTYPE_EDIT; // Render edit
	if ($products->RowType == EW_ROWTYPE_EDIT && $products->EventCancelled) { // Update failed
		if ($products->CurrentAction == "edit")
			$products_list->RestoreFormValues(); // Restore form values
		if ($products->CurrentAction == "gridedit")
			$products_list->RestoreCurrentRowFormValues($products_list->lRowIndex); // Restore form values
	}
	if ($products->RowType == EW_ROWTYPE_EDIT) { // Edit row
		$products_list->lEditRowCnt++;
		$products->RowClientEvents = "onmouseover='this.edit=true;ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	}
	if ($products->RowType == EW_ROWTYPE_ADD || $products->RowType == EW_ROWTYPE_EDIT) // Add / Edit row
			$products->CssClass = "ewTableEditRow";

	// Render row
	$products_list->RenderRow();
?>
	<tr<?php echo $products->RowAttributes() ?>>
	<?php if ($products->id->Visible) { // id ?>
		<td<?php echo $products->id->CellAttributes() ?>>
<?php if ($products->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $products_list->lRowIndex ?>_id" id="o<?php echo $products_list->lRowIndex ?>_id" value="<?php echo ew_HtmlEncode($products->id->OldValue) ?>">
<?php } ?>
<?php if ($products->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $products->id->ViewAttributes() ?>><?php echo $products->id->EditValue ?></div><input type="hidden" name="x<?php echo $products_list->lRowIndex ?>_id" id="x<?php echo $products_list->lRowIndex ?>_id" value="<?php echo ew_HtmlEncode($products->id->CurrentValue) ?>">
<?php } ?>
<?php if ($products->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $products->id->ViewAttributes() ?>><?php echo $products->id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($products->name->Visible) { // name ?>
		<td<?php echo $products->name->CellAttributes() ?>>
<?php if ($products->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $products_list->lRowIndex ?>_name" id="x<?php echo $products_list->lRowIndex ?>_name" size="30" maxlength="200" value="<?php echo $products->name->EditValue ?>"<?php echo $products->name->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $products_list->lRowIndex ?>_name" id="o<?php echo $products_list->lRowIndex ?>_name" value="<?php echo ew_HtmlEncode($products->name->OldValue) ?>">
<?php } ?>
<?php if ($products->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $products_list->lRowIndex ?>_name" id="x<?php echo $products_list->lRowIndex ?>_name" size="30" maxlength="200" value="<?php echo $products->name->EditValue ?>"<?php echo $products->name->EditAttributes() ?>>
<?php } ?>
<?php if ($products->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $products->name->ViewAttributes() ?>><?php echo $products->name->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($products->name_arabic->Visible) { // name_arabic ?>
		<td<?php echo $products->name_arabic->CellAttributes() ?>>
<?php if ($products->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $products_list->lRowIndex ?>_name_arabic" id="x<?php echo $products_list->lRowIndex ?>_name_arabic" size="30" maxlength="200" value="<?php echo $products->name_arabic->EditValue ?>"<?php echo $products->name_arabic->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $products_list->lRowIndex ?>_name_arabic" id="o<?php echo $products_list->lRowIndex ?>_name_arabic" value="<?php echo ew_HtmlEncode($products->name_arabic->OldValue) ?>">
<?php } ?>
<?php if ($products->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $products_list->lRowIndex ?>_name_arabic" id="x<?php echo $products_list->lRowIndex ?>_name_arabic" size="30" maxlength="200" value="<?php echo $products->name_arabic->EditValue ?>"<?php echo $products->name_arabic->EditAttributes() ?>>
<?php } ?>
<?php if ($products->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $products->name_arabic->ViewAttributes() ?>><?php echo $products->name_arabic->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($products->level->Visible) { // level ?>
		<td<?php echo $products->level->CellAttributes() ?>>
<?php if ($products->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $products_list->lRowIndex ?>_level" id="x<?php echo $products_list->lRowIndex ?>_level" size="30" value="<?php echo $products->level->EditValue ?>"<?php echo $products->level->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $products_list->lRowIndex ?>_level" id="o<?php echo $products_list->lRowIndex ?>_level" value="<?php echo ew_HtmlEncode($products->level->OldValue) ?>">
<?php } ?>
<?php if ($products->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $products_list->lRowIndex ?>_level" id="x<?php echo $products_list->lRowIndex ?>_level" size="30" value="<?php echo $products->level->EditValue ?>"<?php echo $products->level->EditAttributes() ?>>
<?php } ?>
<?php if ($products->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $products->level->ViewAttributes() ?>><?php echo $products->level->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($products->image->Visible) { // image ?>
		<td<?php echo $products->image->CellAttributes() ?>>
<?php if ($products->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="file" name="x<?php echo $products_list->lRowIndex ?>_image" id="x<?php echo $products_list->lRowIndex ?>_image" size="30"<?php echo $products->image->EditAttributes() ?>>
</div>
<input type="hidden" name="o<?php echo $products_list->lRowIndex ?>_image" id="o<?php echo $products_list->lRowIndex ?>_image" value="<?php echo ew_HtmlEncode($products->image->OldValue) ?>">
<?php } ?>
<?php if ($products->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div id="old_x<?php echo $products_list->lRowIndex ?>_image">
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
</div>
<div id="new_x<?php echo $products_list->lRowIndex ?>_image">
<?php if (!is_null($products->image->Upload->DbValue)) { ?>
<input type="radio" name="a<?php echo $products_list->lRowIndex ?>_image" id="a<?php echo $products_list->lRowIndex ?>_image" value="1" checked="checked">Keep&nbsp;
<input type="radio" name="a<?php echo $products_list->lRowIndex ?>_image" id="a<?php echo $products_list->lRowIndex ?>_image" value="2" disabled="disabled">Remove&nbsp;
<input type="radio" name="a<?php echo $products_list->lRowIndex ?>_image" id="a<?php echo $products_list->lRowIndex ?>_image" value="3">Replace<br>
<?php } else { ?>
<input type="hidden" name="a<?php echo $products_list->lRowIndex ?>_image" id="a<?php echo $products_list->lRowIndex ?>_image" value="3">
<?php } ?>
<input type="file" name="x<?php echo $products_list->lRowIndex ?>_image" id="x<?php echo $products_list->lRowIndex ?>_image" size="30" onchange="if (this.form.a<?php echo $products_list->lRowIndex ?>_image[2]) this.form.a<?php echo $products_list->lRowIndex ?>_image[2].checked=true;"<?php echo $products->image->EditAttributes() ?>>
</div>
<?php } ?>
<?php if ($products->RowType == EW_ROWTYPE_VIEW) { // View record ?>
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
<?php } ?>
</td>
	<?php } ?>
	<?php if ($products->image2->Visible) { // image2 ?>
		<td<?php echo $products->image2->CellAttributes() ?>>
<?php if ($products->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="file" name="x<?php echo $products_list->lRowIndex ?>_image2" id="x<?php echo $products_list->lRowIndex ?>_image2" size="30"<?php echo $products->image2->EditAttributes() ?>>
</div>
<input type="hidden" name="o<?php echo $products_list->lRowIndex ?>_image2" id="o<?php echo $products_list->lRowIndex ?>_image2" value="<?php echo ew_HtmlEncode($products->image2->OldValue) ?>">
<?php } ?>
<?php if ($products->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div id="old_x<?php echo $products_list->lRowIndex ?>_image2">
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
</div>
<div id="new_x<?php echo $products_list->lRowIndex ?>_image2">
<?php if (!is_null($products->image2->Upload->DbValue)) { ?>
<input type="radio" name="a<?php echo $products_list->lRowIndex ?>_image2" id="a<?php echo $products_list->lRowIndex ?>_image2" value="1" checked="checked">Keep&nbsp;
<input type="radio" name="a<?php echo $products_list->lRowIndex ?>_image2" id="a<?php echo $products_list->lRowIndex ?>_image2" value="2" disabled="disabled">Remove&nbsp;
<input type="radio" name="a<?php echo $products_list->lRowIndex ?>_image2" id="a<?php echo $products_list->lRowIndex ?>_image2" value="3">Replace<br>
<?php } else { ?>
<input type="hidden" name="a<?php echo $products_list->lRowIndex ?>_image2" id="a<?php echo $products_list->lRowIndex ?>_image2" value="3">
<?php } ?>
<input type="file" name="x<?php echo $products_list->lRowIndex ?>_image2" id="x<?php echo $products_list->lRowIndex ?>_image2" size="30" onchange="if (this.form.a<?php echo $products_list->lRowIndex ?>_image2[2]) this.form.a<?php echo $products_list->lRowIndex ?>_image2[2].checked=true;"<?php echo $products->image2->EditAttributes() ?>>
</div>
<?php } ?>
<?php if ($products->RowType == EW_ROWTYPE_VIEW) { // View record ?>
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
<?php } ?>
</td>
	<?php } ?>
	<?php if ($products->image3->Visible) { // image3 ?>
		<td<?php echo $products->image3->CellAttributes() ?>>
<?php if ($products->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="file" name="x<?php echo $products_list->lRowIndex ?>_image3" id="x<?php echo $products_list->lRowIndex ?>_image3" size="30"<?php echo $products->image3->EditAttributes() ?>>
</div>
<input type="hidden" name="o<?php echo $products_list->lRowIndex ?>_image3" id="o<?php echo $products_list->lRowIndex ?>_image3" value="<?php echo ew_HtmlEncode($products->image3->OldValue) ?>">
<?php } ?>
<?php if ($products->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div id="old_x<?php echo $products_list->lRowIndex ?>_image3">
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
</div>
<div id="new_x<?php echo $products_list->lRowIndex ?>_image3">
<?php if (!is_null($products->image3->Upload->DbValue)) { ?>
<input type="radio" name="a<?php echo $products_list->lRowIndex ?>_image3" id="a<?php echo $products_list->lRowIndex ?>_image3" value="1" checked="checked">Keep&nbsp;
<input type="radio" name="a<?php echo $products_list->lRowIndex ?>_image3" id="a<?php echo $products_list->lRowIndex ?>_image3" value="2" disabled="disabled">Remove&nbsp;
<input type="radio" name="a<?php echo $products_list->lRowIndex ?>_image3" id="a<?php echo $products_list->lRowIndex ?>_image3" value="3">Replace<br>
<?php } else { ?>
<input type="hidden" name="a<?php echo $products_list->lRowIndex ?>_image3" id="a<?php echo $products_list->lRowIndex ?>_image3" value="3">
<?php } ?>
<input type="file" name="x<?php echo $products_list->lRowIndex ?>_image3" id="x<?php echo $products_list->lRowIndex ?>_image3" size="30" onchange="if (this.form.a<?php echo $products_list->lRowIndex ?>_image3[2]) this.form.a<?php echo $products_list->lRowIndex ?>_image3[2].checked=true;"<?php echo $products->image3->EditAttributes() ?>>
</div>
<?php } ?>
<?php if ($products->RowType == EW_ROWTYPE_VIEW) { // View record ?>
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
<?php } ?>
</td>
	<?php } ?>
	<?php if ($products->special->Visible) { // special ?>
		<td<?php echo $products->special->CellAttributes() ?>>
<?php if ($products->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<div id="tp_x<?php echo $products_list->lRowIndex ?>_special" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x<?php echo $products_list->lRowIndex ?>_special" id="x<?php echo $products_list->lRowIndex ?>_special" value="{value}"<?php echo $products->special->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $products_list->lRowIndex ?>_special" repeatcolumn="5">
<?php
$arwrk = $products->special->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($products->special->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $products_list->lRowIndex ?>_special" id="x<?php echo $products_list->lRowIndex ?>_special" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $products->special->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
if ($emptywrk) $products->special->OldValue = "";
?>
</div>
<input type="hidden" name="o<?php echo $products_list->lRowIndex ?>_special" id="o<?php echo $products_list->lRowIndex ?>_special" value="<?php echo ew_HtmlEncode($products->special->OldValue) ?>">
<?php } ?>
<?php if ($products->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div id="tp_x<?php echo $products_list->lRowIndex ?>_special" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x<?php echo $products_list->lRowIndex ?>_special" id="x<?php echo $products_list->lRowIndex ?>_special" value="{value}"<?php echo $products->special->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $products_list->lRowIndex ?>_special" repeatcolumn="5">
<?php
$arwrk = $products->special->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($products->special->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $products_list->lRowIndex ?>_special" id="x<?php echo $products_list->lRowIndex ?>_special" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $products->special->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
if ($emptywrk) $products->special->OldValue = "";
?>
</div>
<?php } ?>
<?php if ($products->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $products->special->ViewAttributes() ?>><?php echo $products->special->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($products->order->Visible) { // order ?>
		<td<?php echo $products->order->CellAttributes() ?>>
<?php if ($products->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $products_list->lRowIndex ?>_order" id="x<?php echo $products_list->lRowIndex ?>_order" size="30" value="<?php echo $products->order->EditValue ?>"<?php echo $products->order->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $products_list->lRowIndex ?>_order" id="o<?php echo $products_list->lRowIndex ?>_order" value="<?php echo ew_HtmlEncode($products->order->OldValue) ?>">
<?php } ?>
<?php if ($products->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $products_list->lRowIndex ?>_order" id="x<?php echo $products_list->lRowIndex ?>_order" size="30" value="<?php echo $products->order->EditValue ?>"<?php echo $products->order->EditAttributes() ?>>
<?php } ?>
<?php if ($products->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $products->order->ViewAttributes() ?>><?php echo $products->order->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($products->active->Visible) { // active ?>
		<td<?php echo $products->active->CellAttributes() ?>>
<?php if ($products->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<div id="tp_x<?php echo $products_list->lRowIndex ?>_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x<?php echo $products_list->lRowIndex ?>_active" id="x<?php echo $products_list->lRowIndex ?>_active" value="{value}"<?php echo $products->active->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $products_list->lRowIndex ?>_active" repeatcolumn="5">
<?php
$arwrk = $products->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($products->active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $products_list->lRowIndex ?>_active" id="x<?php echo $products_list->lRowIndex ?>_active" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $products->active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
if ($emptywrk) $products->active->OldValue = "";
?>
</div>
<input type="hidden" name="o<?php echo $products_list->lRowIndex ?>_active" id="o<?php echo $products_list->lRowIndex ?>_active" value="<?php echo ew_HtmlEncode($products->active->OldValue) ?>">
<?php } ?>
<?php if ($products->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div id="tp_x<?php echo $products_list->lRowIndex ?>_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x<?php echo $products_list->lRowIndex ?>_active" id="x<?php echo $products_list->lRowIndex ?>_active" value="{value}"<?php echo $products->active->EditAttributes() ?>></div>
<div id="dsl_x<?php echo $products_list->lRowIndex ?>_active" repeatcolumn="5">
<?php
$arwrk = $products->active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($products->active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $products_list->lRowIndex ?>_active" id="x<?php echo $products_list->lRowIndex ?>_active" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $products->active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
if ($emptywrk) $products->active->OldValue = "";
?>
</div>
<?php } ?>
<?php if ($products->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $products->active->ViewAttributes() ?>><?php echo $products->active->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php if ($products->RowType == EW_ROWTYPE_ADD || $products->RowType == EW_ROWTYPE_EDIT) { ?>
<?php if ($products->CurrentAction == "edit") { ?>
<td colspan="<?php echo $products_list->lOptionCnt ?>"><span class="phpmaker">
<a href="" onclick="if (products_list.ValidateForm(document.fproductslist)) document.fproductslist.submit();return false;">Update</a>&nbsp;<a href="<?php echo $products_list->PageUrl() ?>a=cancel">Cancel</a>
<input type="hidden" name="a_list" id="a_list" value="update">
</span></td>
<?php } ?>
<?php
	if ($products->CurrentAction == "gridedit")
		$products_list->sMultiSelectKey .= "<input type=\"hidden\" name=\"k" . $products_list->lRowIndex . "_key\" id=\"k" . $products_list->lRowIndex . "_key\" value=\"" . $products->id->CurrentValue . "\">";
?>
<?php } else { ?>
<?php if ($products->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $products->ViewUrl() ?>">View</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $products->EditUrl() ?>">Edit</a><span class="ewSeparator">&nbsp;|&nbsp;</span><a href="<?php echo $products->InlineEditUrl() ?>">Inline Edit</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $products->CopyUrl() ?>">Copy</a><span class="ewSeparator">&nbsp;|&nbsp;</span><a href="<?php echo $products->InlineCopyUrl() ?>">Inline Copy</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($products_list->lOptionCnt == 0 && $products->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="product_imageslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=products&id=<?php echo urlencode(strval($products->id->CurrentValue)) ?>">product images...</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="product_videoslist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=products&id=<?php echo urlencode(strval($products->id->CurrentValue)) ?>">product videos...</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($products->id->CurrentValue) ?>" class="phpmaker" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($products_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
<?php if ($products->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($products->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($products->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($products->CurrentAction == "add" || $products->CurrentAction == "copy") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $products_list->lRowIndex ?>">
<?php } ?>
<?php if ($products->CurrentAction == "gridadd") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $products_list->lRowIndex ?>">
<?php } ?>
<?php if ($products->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $products_list->lRowIndex ?>">
<?php } ?>
<?php if ($products->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $products_list->lRowIndex ?>">
<?php echo $products_list->sMultiSelectKey ?>
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
<?php if ($products_list->lTotalRecs > 0) { ?>
<?php if ($products->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($products->CurrentAction <> "gridadd" && $products->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($products_list->Pager)) $products_list->Pager = new cPrevNextPager($products_list->lStartRec, $products_list->lDisplayRecs, $products_list->lTotalRecs) ?>
<?php if ($products_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($products_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $products_list->PageUrl() ?>start=<?php echo $products_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($products_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $products_list->PageUrl() ?>start=<?php echo $products_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $products_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($products_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $products_list->PageUrl() ?>start=<?php echo $products_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($products_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $products_list->PageUrl() ?>start=<?php echo $products_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $products_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $products_list->Pager->FromIndex ?> to <?php echo $products_list->Pager->ToIndex ?> of <?php echo $products_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($products_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($products_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($products->CurrentAction <> "gridadd" && $products->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $products->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<a href="<?php echo $products_list->PageUrl() ?>a=add">Inline Add</a>&nbsp;&nbsp;
<a href="<?php echo $products_list->PageUrl() ?>a=gridadd">Grid Add</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($products_list->lTotalRecs > 0) { ?>
<a href="<?php echo $products_list->PageUrl() ?>a=gridedit">Grid Edit</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if ($products_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fproductslist)) alert('No records selected'); else if (ew_Confirm('<?php echo $products_list->sDeleteConfirmMsg ?>')) {document.fproductslist.action='productsdelete.php';document.fproductslist.encoding='application/x-www-form-urlencoded';document.fproductslist.submit();};return false;">Delete Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fproductslist)) alert('No records selected'); else {document.fproductslist.action='productsupdate.php';document.fproductslist.encoding='application/x-www-form-urlencoded';document.fproductslist.submit();};return false;">Update Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($products->CurrentAction == "gridadd") { ?>
<a href="" onclick="if (products_list.ValidateForm(document.fproductslist)) document.fproductslist.submit();return false;">Insert</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($products->CurrentAction == "gridedit") { ?>
<a href="" onclick="if (products_list.ValidateForm(document.fproductslist)) document.fproductslist.submit();return false;">Save</a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php echo $products_list->PageUrl() ?>a=cancel">Cancel</a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($products->Export == "" && $products->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(products_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
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
$products_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class cproducts_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'products';

	// Page Object Name
	var $PageObjName = 'products_list';

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
	function cproducts_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["products"] = new cproducts();

		// Initialize other table object
		$GLOBALS['users'] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'products', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
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
		global $objForm, $gsSearchError, $Security, $products;
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
				$products->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($products->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to grid edit mode
				if ($products->CurrentAction == "gridedit")
					$this->GridEditMode();

				// Switch to inline edit mode
				if ($products->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($products->CurrentAction == "add" || $products->CurrentAction == "copy")
					$this->InlineAddMode();

				// Switch to grid add mode
				if ($products->CurrentAction == "gridadd")
					$this->GridAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$products->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Update
					if ($products->CurrentAction == "gridupdate" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridedit")
						$this->GridUpdate();

					// Inline Update
					if ($products->CurrentAction == "update" && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($products->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
						$this->InlineInsert();

					// Grid Insert
					if ($products->CurrentAction == "gridinsert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridadd")
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
		if ($products->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $products->getRecordsPerPage(); // Restore from Session
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
		$products->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$products->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$products->setStartRecordNumber($this->lStartRec);
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
		$products->setSessionWhere($sFilter);
		$products->CurrentFilter = "";

		// Export data only
		if (in_array($products->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	//  Exit out of inline mode
	function ClearInlineMode() {
		global $products;
		$products->setKey("id", ""); // Clear inline edit key
		$products->CurrentAction = ""; // Clear action
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
		global $Security, $products;
		$bInlineEdit = TRUE;
		if (@$_GET["id"] <> "") {
			$products->id->setQueryStringValue($_GET["id"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$products->setKey("id", $products->id->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to inline edit record
	function InlineUpdate() {
		global $objForm, $gsFormError, $products;
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
				$products->SendEmail = TRUE; // Send email on update success
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
			$products->EventCancelled = TRUE; // Cancel event
			$products->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check inline edit key
	function CheckInlineEditKey() {
		global $products;

		//CheckInlineEditKey = True
		if (strval($products->getKey("id")) <> strval($products->id->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add Mode
	function InlineAddMode() {
		global $Security, $products;
		if ($products->CurrentAction == "copy") {
			if (@$_GET["id"] <> "") {
				$products->id->setQueryStringValue($_GET["id"]);
			} else {
				$products->CurrentAction = "add";
			}
		}
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to inline add/copy record
	function InlineInsert() {
		global $objForm, $gsFormError, $products;
		$objForm->Index = 1;
		$this->GetUploadFiles(); // Get upload files
		$this->LoadFormValues(); // Get form values

		// Validate Form
		if (!$this->ValidateForm()) {
			$this->setMessage($gsFormError); // Set validation error message
			$products->EventCancelled = TRUE; // Set event cancelled
			$products->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$products->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow()) { // Add record
			$this->setMessage("Add succeeded"); // Set add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$products->EventCancelled = TRUE; // Set event cancelled
			$products->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Perform update to grid
	function GridUpdate() {
		global $conn, $objForm, $gsFormError, $products;
		$rowindex = 1;
		$bGridUpdate = TRUE;

		// Begin transaction
		$conn->BeginTrans();

		// Get old recordset
		$products->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $products->SQL();
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
					$products->SendEmail = FALSE; // Do not send email on update success
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
			$products->EventCancelled = TRUE; // Set event cancelled
			$products->CurrentAction = "gridedit"; // Stay in gridedit mode
		}
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $products;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $products->KeyFilter();
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
		global $products;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$products->id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($products->id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Grid Insert
	// Perform insert to grid
	function GridInsert() {
		global $conn, $objForm, $gsFormError, $products;
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
				$products->SendEmail = FALSE; // Do not send email on insert success

				// Validate Form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow(); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
					$sKey .= $products->id->CurrentValue;

					// Add filter for this record
					$sFilter = $products->KeyFilter();
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
			$products->CurrentFilter = $sWrkFilter;
			$sSql = $products->SQL();
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
			$products->EventCancelled = TRUE; // Set event cancelled
			$products->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
	}

	// Check if empty row
	function EmptyRow() {
		global $products;
		if ($products->name->CurrentValue <> $products->name->OldValue)
			return FALSE;
		if ($products->name_arabic->CurrentValue <> $products->name_arabic->OldValue)
			return FALSE;
		if ($products->level->CurrentValue <> $products->level->OldValue)
			return FALSE;
		if (!is_null($products->image->Upload->Value))
			return FALSE;
		if (!is_null($products->image2->Upload->Value))
			return FALSE;
		if (!is_null($products->image3->Upload->Value))
			return FALSE;
		if ($products->special->CurrentValue <> $products->special->OldValue)
			return FALSE;
		if ($products->order->CurrentValue <> $products->order->OldValue)
			return FALSE;
		if ($products->active->CurrentValue <> $products->active->OldValue)
			return FALSE;
		return TRUE;
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm, $products;

		// Get row based on current index
		$objForm->Index = $idx;
		if ($products->CurrentAction == "gridadd")
			$this->LoadFormValues(); // Load form values
		if ($products->CurrentAction == "gridedit") {
			$sKey = strval($objForm->GetValue("k_key"));
			$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $sKey);
			if (count($arrKeyFlds) >= 1) {
				if (strval($arrKeyFlds[0]) == strval($products->id->CurrentValue)) {
					$this->LoadFormValues(); // Load form values
				}
			}
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $products;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $products->id, FALSE); // Field id
		$this->BuildSearchSql($sWhere, $products->name, FALSE); // Field name
		$this->BuildSearchSql($sWhere, $products->name_arabic, FALSE); // Field name_arabic
		$this->BuildSearchSql($sWhere, $products->level, FALSE); // Field level
		$this->BuildSearchSql($sWhere, $products->description, FALSE); // Field description
		$this->BuildSearchSql($sWhere, $products->description_arabic, FALSE); // Field description_arabic
		$this->BuildSearchSql($sWhere, $products->video, FALSE); // Field video
		$this->BuildSearchSql($sWhere, $products->special, FALSE); // Field special
		$this->BuildSearchSql($sWhere, $products->order, FALSE); // Field order
		$this->BuildSearchSql($sWhere, $products->active, FALSE); // Field active

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($products->id); // Field id
			$this->SetSearchParm($products->name); // Field name
			$this->SetSearchParm($products->name_arabic); // Field name_arabic
			$this->SetSearchParm($products->level); // Field level
			$this->SetSearchParm($products->description); // Field description
			$this->SetSearchParm($products->description_arabic); // Field description_arabic
			$this->SetSearchParm($products->video); // Field video
			$this->SetSearchParm($products->special); // Field special
			$this->SetSearchParm($products->order); // Field order
			$this->SetSearchParm($products->active); // Field active
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
		global $products;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$products->setAdvancedSearch("x_$FldParm", $FldVal);
		$products->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$products->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$products->setAdvancedSearch("y_$FldParm", $FldVal2);
		$products->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $products;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $products->name->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $products->name_arabic->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $products->image->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $products->image2->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $products->image3->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $products->description->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $products->description_arabic->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $products->video->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $products->file->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $products;
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
			$products->setBasicSearchKeyword($sSearchKeyword);
			$products->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $products;
		$this->sSrchWhere = "";
		$products->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $products;
		$products->setBasicSearchKeyword("");
		$products->setBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $products;
		$products->setAdvancedSearch("x_id", "");
		$products->setAdvancedSearch("x_name", "");
		$products->setAdvancedSearch("x_name_arabic", "");
		$products->setAdvancedSearch("x_level", "");
		$products->setAdvancedSearch("x_description", "");
		$products->setAdvancedSearch("x_description_arabic", "");
		$products->setAdvancedSearch("x_video", "");
		$products->setAdvancedSearch("x_special", "");
		$products->setAdvancedSearch("x_order", "");
		$products->setAdvancedSearch("x_active", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $products;
		$this->sSrchWhere = $products->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $products;
		 $products->id->AdvancedSearch->SearchValue = $products->getAdvancedSearch("x_id");
		 $products->name->AdvancedSearch->SearchValue = $products->getAdvancedSearch("x_name");
		 $products->name_arabic->AdvancedSearch->SearchValue = $products->getAdvancedSearch("x_name_arabic");
		 $products->level->AdvancedSearch->SearchValue = $products->getAdvancedSearch("x_level");
		 $products->description->AdvancedSearch->SearchValue = $products->getAdvancedSearch("x_description");
		 $products->description_arabic->AdvancedSearch->SearchValue = $products->getAdvancedSearch("x_description_arabic");
		 $products->video->AdvancedSearch->SearchValue = $products->getAdvancedSearch("x_video");
		 $products->special->AdvancedSearch->SearchValue = $products->getAdvancedSearch("x_special");
		 $products->order->AdvancedSearch->SearchValue = $products->getAdvancedSearch("x_order");
		 $products->active->AdvancedSearch->SearchValue = $products->getAdvancedSearch("x_active");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $products;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$products->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$products->CurrentOrderType = @$_GET["ordertype"];
			$products->UpdateSort($products->id); // Field 
			$products->UpdateSort($products->name); // Field 
			$products->UpdateSort($products->name_arabic); // Field 
			$products->UpdateSort($products->level); // Field 
			$products->UpdateSort($products->image); // Field 
			$products->UpdateSort($products->image2); // Field 
			$products->UpdateSort($products->image3); // Field 
			$products->UpdateSort($products->special); // Field 
			$products->UpdateSort($products->order); // Field 
			$products->UpdateSort($products->active); // Field 
			$products->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $products;
		$sOrderBy = $products->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($products->SqlOrderBy() <> "") {
				$sOrderBy = $products->SqlOrderBy();
				$products->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $products;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$products->setSessionOrderBy($sOrderBy);
				$products->id->setSort("");
				$products->name->setSort("");
				$products->name_arabic->setSort("");
				$products->level->setSort("");
				$products->image->setSort("");
				$products->image2->setSort("");
				$products->image3->setSort("");
				$products->special->setSort("");
				$products->order->setSort("");
				$products->active->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$products->setStartRecordNumber($this->lStartRec);
		}
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

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $products;

		// Get upload data
			$products->image->Upload->Index = $objForm->Index;
			if ($products->image->Upload->UploadFile()) {

				// No action required
			} else {
				echo $products->image->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
			$products->image2->Upload->Index = $objForm->Index;
			if ($products->image2->Upload->UploadFile()) {

				// No action required
			} else {
				echo $products->image2->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
			$products->image3->Upload->Index = $objForm->Index;
			if ($products->image3->Upload->UploadFile()) {

				// No action required
			} else {
				echo $products->image3->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load default values
	function LoadDefaultValues() {
		global $products;
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $products;

		// Load search values
		// id

		$products->id->AdvancedSearch->SearchValue = @$_GET["x_id"];
		$products->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// name
		$products->name->AdvancedSearch->SearchValue = @$_GET["x_name"];
		$products->name->AdvancedSearch->SearchOperator = @$_GET["z_name"];

		// name_arabic
		$products->name_arabic->AdvancedSearch->SearchValue = @$_GET["x_name_arabic"];
		$products->name_arabic->AdvancedSearch->SearchOperator = @$_GET["z_name_arabic"];

		// level
		$products->level->AdvancedSearch->SearchValue = @$_GET["x_level"];
		$products->level->AdvancedSearch->SearchOperator = @$_GET["z_level"];

		// description
		$products->description->AdvancedSearch->SearchValue = @$_GET["x_description"];
		$products->description->AdvancedSearch->SearchOperator = @$_GET["z_description"];

		// description_arabic
		$products->description_arabic->AdvancedSearch->SearchValue = @$_GET["x_description_arabic"];
		$products->description_arabic->AdvancedSearch->SearchOperator = @$_GET["z_description_arabic"];

		// video
		$products->video->AdvancedSearch->SearchValue = @$_GET["x_video"];
		$products->video->AdvancedSearch->SearchOperator = @$_GET["z_video"];

		// special
		$products->special->AdvancedSearch->SearchValue = @$_GET["x_special"];
		$products->special->AdvancedSearch->SearchOperator = @$_GET["z_special"];

		// order
		$products->order->AdvancedSearch->SearchValue = @$_GET["x_order"];
		$products->order->AdvancedSearch->SearchOperator = @$_GET["z_order"];

		// active
		$products->active->AdvancedSearch->SearchValue = @$_GET["x_active"];
		$products->active->AdvancedSearch->SearchOperator = @$_GET["z_active"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $products;
		$products->id->setFormValue($objForm->GetValue("x_id"));
		$products->id->OldValue = $objForm->GetValue("o_id");
		$products->name->setFormValue($objForm->GetValue("x_name"));
		$products->name->OldValue = $objForm->GetValue("o_name");
		$products->name_arabic->setFormValue($objForm->GetValue("x_name_arabic"));
		$products->name_arabic->OldValue = $objForm->GetValue("o_name_arabic");
		$products->level->setFormValue($objForm->GetValue("x_level"));
		$products->level->OldValue = $objForm->GetValue("o_level");
		$products->special->setFormValue($objForm->GetValue("x_special"));
		$products->special->OldValue = $objForm->GetValue("o_special");
		$products->order->setFormValue($objForm->GetValue("x_order"));
		$products->order->OldValue = $objForm->GetValue("o_order");
		$products->active->setFormValue($objForm->GetValue("x_active"));
		$products->active->OldValue = $objForm->GetValue("o_active");
	}

	// Restore form values
	function RestoreFormValues() {
		global $products;
		$products->id->CurrentValue = $products->id->FormValue;
		$products->name->CurrentValue = $products->name->FormValue;
		$products->name_arabic->CurrentValue = $products->name_arabic->FormValue;
		$products->level->CurrentValue = $products->level->FormValue;
		$products->special->CurrentValue = $products->special->FormValue;
		$products->order->CurrentValue = $products->order->FormValue;
		$products->active->CurrentValue = $products->active->FormValue;
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
			if ($products->Export == "")
				$products->name->ViewValue = ew_Highlight($products->HighlightName(), $products->name->ViewValue, $products->getBasicSearchKeyword(), $products->getBasicSearchType(), $products->getAdvancedSearch("x_name"));
			$products->name->CssStyle = "";
			$products->name->CssClass = "";
			$products->name->ViewCustomAttributes = "";

			// name_arabic
			$products->name_arabic->ViewValue = $products->name_arabic->CurrentValue;
			if ($products->Export == "")
				$products->name_arabic->ViewValue = ew_Highlight($products->HighlightName(), $products->name_arabic->ViewValue, $products->getBasicSearchKeyword(), $products->getBasicSearchType(), $products->getAdvancedSearch("x_name_arabic"));
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
			if ($products->Export == "")
				$products->description->ViewValue = ew_Highlight($products->HighlightName(), $products->description->ViewValue, $products->getBasicSearchKeyword(), $products->getBasicSearchType(), $products->getAdvancedSearch("x_description"));
			$products->description->CssStyle = "";
			$products->description->CssClass = "";
			$products->description->ViewCustomAttributes = "";

			// description_arabic
			$products->description_arabic->ViewValue = $products->description_arabic->CurrentValue;
			if ($products->Export == "")
				$products->description_arabic->ViewValue = ew_Highlight($products->HighlightName(), $products->description_arabic->ViewValue, $products->getBasicSearchKeyword(), $products->getBasicSearchType(), $products->getAdvancedSearch("x_description_arabic"));
			$products->description_arabic->CssStyle = "";
			$products->description_arabic->CssClass = "";
			$products->description_arabic->ViewCustomAttributes = "";

			// video
			$products->video->ViewValue = $products->video->CurrentValue;
			if ($products->Export == "")
				$products->video->ViewValue = ew_Highlight($products->HighlightName(), $products->video->ViewValue, $products->getBasicSearchKeyword(), $products->getBasicSearchType(), $products->getAdvancedSearch("x_video"));
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

			// special
			$products->special->HrefValue = "";

			// order
			$products->order->HrefValue = "";

			// active
			$products->active->HrefValue = "";
		} elseif ($products->RowType == EW_ROWTYPE_ADD) { // Add row

			// id
			// name

			$products->name->EditCustomAttributes = "";
			$products->name->EditValue = ew_HtmlEncode($products->name->CurrentValue);

			// name_arabic
			$products->name_arabic->EditCustomAttributes = "";
			$products->name_arabic->EditValue = ew_HtmlEncode($products->name_arabic->CurrentValue);

			// level
			$products->level->EditCustomAttributes = "";
			$products->level->EditValue = ew_HtmlEncode($products->level->CurrentValue);

			// image
			$products->image->EditCustomAttributes = "";
			if (!is_null($products->image->Upload->DbValue)) {
				$products->image->EditValue = $products->image->Upload->DbValue;
				$products->image->ImageWidth = 100;
				$products->image->ImageHeight = 0;
				$products->image->ImageAlt = "";
			} else {
				$products->image->EditValue = "";
			}

			// image2
			$products->image2->EditCustomAttributes = "";
			if (!is_null($products->image2->Upload->DbValue)) {
				$products->image2->EditValue = $products->image2->Upload->DbValue;
				$products->image2->ImageWidth = 100;
				$products->image2->ImageHeight = 0;
				$products->image2->ImageAlt = "";
			} else {
				$products->image2->EditValue = "";
			}

			// image3
			$products->image3->EditCustomAttributes = "";
			if (!is_null($products->image3->Upload->DbValue)) {
				$products->image3->EditValue = $products->image3->Upload->DbValue;
				$products->image3->ImageWidth = 100;
				$products->image3->ImageHeight = 0;
				$products->image3->ImageAlt = "";
			} else {
				$products->image3->EditValue = "";
			}

			// special
			$products->special->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$products->special->EditValue = $arwrk;

			// order
			$products->order->EditCustomAttributes = "";
			$products->order->EditValue = ew_HtmlEncode($products->order->CurrentValue);

			// active
			$products->active->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$products->active->EditValue = $arwrk;
		} elseif ($products->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$products->id->EditCustomAttributes = "";
			$products->id->EditValue = $products->id->CurrentValue;
			$products->id->CssStyle = "";
			$products->id->CssClass = "";
			$products->id->ViewCustomAttributes = "";

			// name
			$products->name->EditCustomAttributes = "";
			$products->name->EditValue = ew_HtmlEncode($products->name->CurrentValue);

			// name_arabic
			$products->name_arabic->EditCustomAttributes = "";
			$products->name_arabic->EditValue = ew_HtmlEncode($products->name_arabic->CurrentValue);

			// level
			$products->level->EditCustomAttributes = "";
			$products->level->EditValue = ew_HtmlEncode($products->level->CurrentValue);

			// image
			$products->image->EditCustomAttributes = "";
			if (!is_null($products->image->Upload->DbValue)) {
				$products->image->EditValue = $products->image->Upload->DbValue;
				$products->image->ImageWidth = 100;
				$products->image->ImageHeight = 0;
				$products->image->ImageAlt = "";
			} else {
				$products->image->EditValue = "";
			}

			// image2
			$products->image2->EditCustomAttributes = "";
			if (!is_null($products->image2->Upload->DbValue)) {
				$products->image2->EditValue = $products->image2->Upload->DbValue;
				$products->image2->ImageWidth = 100;
				$products->image2->ImageHeight = 0;
				$products->image2->ImageAlt = "";
			} else {
				$products->image2->EditValue = "";
			}

			// image3
			$products->image3->EditCustomAttributes = "";
			if (!is_null($products->image3->Upload->DbValue)) {
				$products->image3->EditValue = $products->image3->Upload->DbValue;
				$products->image3->ImageWidth = 100;
				$products->image3->ImageHeight = 0;
				$products->image3->ImageAlt = "";
			} else {
				$products->image3->EditValue = "";
			}

			// special
			$products->special->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$products->special->EditValue = $arwrk;

			// order
			$products->order->EditCustomAttributes = "";
			$products->order->EditValue = ew_HtmlEncode($products->order->CurrentValue);

			// active
			$products->active->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$products->active->EditValue = $arwrk;

			// Edit refer script
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

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $products;

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
		global $gsFormError, $products;

		// Initialize
		$gsFormError = "";
		if (!ew_CheckFileType($products->image->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "File type is not allowed.";
		}
		if ($products->image->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($products->image->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "Max. file size (%s bytes) exceeded.");
		}
		if (!ew_CheckFileType($products->image2->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "File type is not allowed.";
		}
		if ($products->image2->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($products->image2->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "Max. file size (%s bytes) exceeded.");
		}
		if (!ew_CheckFileType($products->image3->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "File type is not allowed.";
		}
		if ($products->image3->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($products->image3->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "Max. file size (%s bytes) exceeded.");
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($products->name->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - name";
		}
		if ($products->name_arabic->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - name arabic";
		}
		if ($products->level->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - level";
		}
		if (!ew_CheckInteger($products->level->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - level";
		}
		if ($products->CurrentAction == "gridupdate" || $products->CurrentAction == "update") {
			if ($products->image->Upload->Action == "3" && is_null($products->image->Upload->Value)) {
				$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
				$gsFormError .= "Please enter required field - image";
			}
		} elseif (is_null($products->image->Upload->Value)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - image";
		}
		if ($products->CurrentAction == "gridupdate" || $products->CurrentAction == "update") {
			if ($products->image2->Upload->Action == "3" && is_null($products->image2->Upload->Value)) {
				$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
				$gsFormError .= "Please enter required field - image 2";
			}
		} elseif (is_null($products->image2->Upload->Value)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - image 2";
		}
		if ($products->CurrentAction == "gridupdate" || $products->CurrentAction == "update") {
			if ($products->image3->Upload->Action == "3" && is_null($products->image3->Upload->Value)) {
				$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
				$gsFormError .= "Please enter required field - image 3";
			}
		} elseif (is_null($products->image3->Upload->Value)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - image 3";
		}
		if ($products->special->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - special";
		}
		if ($products->order->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - order";
		}
		if (!ew_CheckInteger($products->order->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - order";
		}
		if ($products->active->FormValue == "") {
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
		global $conn, $Security, $products;
		$sFilter = $products->KeyFilter();
		$products->CurrentFilter = $sFilter;
		$sSql = $products->SQL();
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

			$products->name->SetDbValueDef($products->name->CurrentValue, "");
			$rsnew['name'] =& $products->name->DbValue;

			// Field name_arabic
			$products->name_arabic->SetDbValueDef($products->name_arabic->CurrentValue, "");
			$rsnew['name_arabic'] =& $products->name_arabic->DbValue;

			// Field level
			$products->level->SetDbValueDef($products->level->CurrentValue, 0);
			$rsnew['level'] =& $products->level->DbValue;

			// Field image
			$products->image->Upload->SaveToSession(); // Save file value to Session
						if ($products->image->Upload->Action == "2" || $products->image->Upload->Action == "3") { // Update/Remove
			$products->image->Upload->DbValue = $rs->fields('image'); // Get original value
			if (is_null($products->image->Upload->Value)) {
				$rsnew['image'] = NULL;
			} else {
				if ($products->image->Upload->FileName == $products->image->Upload->DbValue) { // Upload file name same as old file name
					$rsnew['image'] = $products->image->Upload->FileName;
				} else {
					$rsnew['image'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, "../images/"), $products->image->Upload->FileName);
				}
			}
			}

			// Field image2
			$products->image2->Upload->SaveToSession(); // Save file value to Session
						if ($products->image2->Upload->Action == "2" || $products->image2->Upload->Action == "3") { // Update/Remove
			$products->image2->Upload->DbValue = $rs->fields('image2'); // Get original value
			if (is_null($products->image2->Upload->Value)) {
				$rsnew['image2'] = NULL;
			} else {
				if ($products->image2->Upload->FileName == $products->image2->Upload->DbValue) { // Upload file name same as old file name
					$rsnew['image2'] = $products->image2->Upload->FileName;
				} else {
					$rsnew['image2'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, "../images/"), $products->image2->Upload->FileName);
				}
			}
			}

			// Field image3
			$products->image3->Upload->SaveToSession(); // Save file value to Session
						if ($products->image3->Upload->Action == "2" || $products->image3->Upload->Action == "3") { // Update/Remove
			$products->image3->Upload->DbValue = $rs->fields('image3'); // Get original value
			if (is_null($products->image3->Upload->Value)) {
				$rsnew['image3'] = NULL;
			} else {
				if ($products->image3->Upload->FileName == $products->image3->Upload->DbValue) { // Upload file name same as old file name
					$rsnew['image3'] = $products->image3->Upload->FileName;
				} else {
					$rsnew['image3'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, "../images/"), $products->image3->Upload->FileName);
				}
			}
			}

			// Field special
			$products->special->SetDbValueDef($products->special->CurrentValue, 0);
			$rsnew['special'] =& $products->special->DbValue;

			// Field order
			$products->order->SetDbValueDef($products->order->CurrentValue, 0);
			$rsnew['order'] =& $products->order->DbValue;

			// Field active
			$products->active->SetDbValueDef($products->active->CurrentValue, 0);
			$rsnew['active'] =& $products->active->DbValue;

			// Call Row Updating event
			$bUpdateRow = $products->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {

			// Field image
			if (!is_null($products->image->Upload->Value)) {
				if ($products->image->Upload->FileName == $products->image->Upload->DbValue) { // Overwrite if same file name
					$products->image->Upload->SaveToFile("../images/", $rsnew['image'], TRUE);
					$products->image->Upload->DbValue = ""; // No need to delete any more
				} else {
					$products->image->Upload->SaveToFile("../images/", $rsnew['image'], FALSE);
				}
			}
			if ($products->image->Upload->Action == "2" || $products->image->Upload->Action == "3") { // Update/Remove
				if ($products->image->Upload->DbValue <> "")
					@unlink(ew_UploadPathEx(TRUE, "../images/") . $products->image->Upload->DbValue);
			}

			// Field image2
			if (!is_null($products->image2->Upload->Value)) {
				if ($products->image2->Upload->FileName == $products->image2->Upload->DbValue) { // Overwrite if same file name
					$products->image2->Upload->SaveToFile("../images/", $rsnew['image2'], TRUE);
					$products->image2->Upload->DbValue = ""; // No need to delete any more
				} else {
					$products->image2->Upload->SaveToFile("../images/", $rsnew['image2'], FALSE);
				}
			}
			if ($products->image2->Upload->Action == "2" || $products->image2->Upload->Action == "3") { // Update/Remove
				if ($products->image2->Upload->DbValue <> "")
					@unlink(ew_UploadPathEx(TRUE, "../images/") . $products->image2->Upload->DbValue);
			}

			// Field image3
			if (!is_null($products->image3->Upload->Value)) {
				if ($products->image3->Upload->FileName == $products->image3->Upload->DbValue) { // Overwrite if same file name
					$products->image3->Upload->SaveToFile("../images/", $rsnew['image3'], TRUE);
					$products->image3->Upload->DbValue = ""; // No need to delete any more
				} else {
					$products->image3->Upload->SaveToFile("../images/", $rsnew['image3'], FALSE);
				}
			}
			if ($products->image3->Upload->Action == "2" || $products->image3->Upload->Action == "3") { // Update/Remove
				if ($products->image3->Upload->DbValue <> "")
					@unlink(ew_UploadPathEx(TRUE, "../images/") . $products->image3->Upload->DbValue);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($products->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($products->CancelMessage <> "") {
					$this->setMessage($products->CancelMessage);
					$products->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$products->Row_Updated($rsold, $rsnew);
		$rs->Close();

		// Field image
		$products->image->Upload->RemoveFromSession(); // Remove file value from Session

		// Field image2
		$products->image2->Upload->RemoveFromSession(); // Remove file value from Session

		// Field image3
		$products->image3->Upload->RemoveFromSession(); // Remove file value from Session
		return $EditRow;
	}

	// Add record
	function AddRow() {
		global $conn, $Security, $products;
		$rsnew = array();

		// Field id
		// Field name

		$products->name->SetDbValueDef($products->name->CurrentValue, "");
		$rsnew['name'] =& $products->name->DbValue;

		// Field name_arabic
		$products->name_arabic->SetDbValueDef($products->name_arabic->CurrentValue, "");
		$rsnew['name_arabic'] =& $products->name_arabic->DbValue;

		// Field level
		$products->level->SetDbValueDef($products->level->CurrentValue, 0);
		$rsnew['level'] =& $products->level->DbValue;

		// Field image
		$products->image->Upload->SaveToSession(); // Save file value to Session
		if (is_null($products->image->Upload->Value)) {
			$rsnew['image'] = NULL;
		} else {
			$rsnew['image'] = ew_UploadFileNameEx(ew_UploadPathEx(True, "../images/"), $products->image->Upload->FileName);
		}

		// Field image2
		$products->image2->Upload->SaveToSession(); // Save file value to Session
		if (is_null($products->image2->Upload->Value)) {
			$rsnew['image2'] = NULL;
		} else {
			$rsnew['image2'] = ew_UploadFileNameEx(ew_UploadPathEx(True, "../images/"), $products->image2->Upload->FileName);
		}

		// Field image3
		$products->image3->Upload->SaveToSession(); // Save file value to Session
		if (is_null($products->image3->Upload->Value)) {
			$rsnew['image3'] = NULL;
		} else {
			$rsnew['image3'] = ew_UploadFileNameEx(ew_UploadPathEx(True, "../images/"), $products->image3->Upload->FileName);
		}

		// Field special
		$products->special->SetDbValueDef($products->special->CurrentValue, 0);
		$rsnew['special'] =& $products->special->DbValue;

		// Field order
		$products->order->SetDbValueDef($products->order->CurrentValue, 0);
		$rsnew['order'] =& $products->order->DbValue;

		// Field active
		$products->active->SetDbValueDef($products->active->CurrentValue, 0);
		$rsnew['active'] =& $products->active->DbValue;

		// Call Row Inserting event
		$bInsertRow = $products->Row_Inserting($rsnew);
		if ($bInsertRow) {

			// Field image
			if (!is_null($products->image->Upload->Value)) {
				if ($products->image->Upload->FileName == $products->image->Upload->DbValue) { // Overwrite if same file name
					$products->image->Upload->SaveToFile("../images/", $rsnew['image'], TRUE);
					$products->image->Upload->DbValue = ""; // No need to delete any more
				} else {
					$products->image->Upload->SaveToFile("../images/", $rsnew['image'], FALSE);
				}
			}
			if ($products->image->Upload->Action == "2" || $products->image->Upload->Action == "3") { // Update/Remove
				if ($products->image->Upload->DbValue <> "")
					@unlink(ew_UploadPathEx(TRUE, "../images/") . $products->image->Upload->DbValue);
			}

			// Field image2
			if (!is_null($products->image2->Upload->Value)) {
				if ($products->image2->Upload->FileName == $products->image2->Upload->DbValue) { // Overwrite if same file name
					$products->image2->Upload->SaveToFile("../images/", $rsnew['image2'], TRUE);
					$products->image2->Upload->DbValue = ""; // No need to delete any more
				} else {
					$products->image2->Upload->SaveToFile("../images/", $rsnew['image2'], FALSE);
				}
			}
			if ($products->image2->Upload->Action == "2" || $products->image2->Upload->Action == "3") { // Update/Remove
				if ($products->image2->Upload->DbValue <> "")
					@unlink(ew_UploadPathEx(TRUE, "../images/") . $products->image2->Upload->DbValue);
			}

			// Field image3
			if (!is_null($products->image3->Upload->Value)) {
				if ($products->image3->Upload->FileName == $products->image3->Upload->DbValue) { // Overwrite if same file name
					$products->image3->Upload->SaveToFile("../images/", $rsnew['image3'], TRUE);
					$products->image3->Upload->DbValue = ""; // No need to delete any more
				} else {
					$products->image3->Upload->SaveToFile("../images/", $rsnew['image3'], FALSE);
				}
			}
			if ($products->image3->Upload->Action == "2" || $products->image3->Upload->Action == "3") { // Update/Remove
				if ($products->image3->Upload->DbValue <> "")
					@unlink(ew_UploadPathEx(TRUE, "../images/") . $products->image3->Upload->DbValue);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($products->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($products->CancelMessage <> "") {
				$this->setMessage($products->CancelMessage);
				$products->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$products->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $products->id->DbValue;

			// Call Row Inserted event
			$products->Row_Inserted($rsnew);
		}

		// Field image
		$products->image->Upload->RemoveFromSession(); // Remove file value from Session

		// Field image2
		$products->image2->Upload->RemoveFromSession(); // Remove file value from Session

		// Field image3
		$products->image3->Upload->RemoveFromSession(); // Remove file value from Session
		return $AddRow;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $products;
		$products->id->AdvancedSearch->SearchValue = $products->getAdvancedSearch("x_id");
		$products->name->AdvancedSearch->SearchValue = $products->getAdvancedSearch("x_name");
		$products->name_arabic->AdvancedSearch->SearchValue = $products->getAdvancedSearch("x_name_arabic");
		$products->level->AdvancedSearch->SearchValue = $products->getAdvancedSearch("x_level");
		$products->description->AdvancedSearch->SearchValue = $products->getAdvancedSearch("x_description");
		$products->description_arabic->AdvancedSearch->SearchValue = $products->getAdvancedSearch("x_description_arabic");
		$products->video->AdvancedSearch->SearchValue = $products->getAdvancedSearch("x_video");
		$products->special->AdvancedSearch->SearchValue = $products->getAdvancedSearch("x_special");
		$products->order->AdvancedSearch->SearchValue = $products->getAdvancedSearch("x_order");
		$products->active->AdvancedSearch->SearchValue = $products->getAdvancedSearch("x_active");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $products;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($products->ExportAll) {
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
