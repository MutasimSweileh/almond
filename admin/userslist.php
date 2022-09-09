<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
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
$users_list = new cusers_list();
$Page =& $users_list;

// Page init processing
$users_list->Page_Init();

// Page main processing
$users_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($users->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var users_list = new ew_Page("users_list");

// page properties
users_list.PageID = "list"; // page ID
var EW_PAGE_ID = users_list.PageID; // for backward compatibility

// extend page with ValidateForm function
users_list.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_username"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - username");
		elm = fobj.elements["x" + infix + "_password"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - password");
		elm = fobj.elements["x" + infix + "_zemail"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - email");

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
users_list.EmptyRow = function(fobj, infix) {
	if (ew_ValueChanged(fobj, infix, "username")) return false;
	if (ew_ValueChanged(fobj, infix, "password")) return false;
	if (ew_ValueChanged(fobj, infix, "zemail")) return false;
	return true;
}

// extend page with Form_CustomValidate function
users_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
users_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
users_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
users_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
users_list.ShowHighlightText = "Show highlight"; 
users_list.HideHighlightText = "Hide highlight";

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
<?php if ($users->Export == "") { ?>
<?php } ?>
<?php
if ($users->CurrentAction == "gridadd")
	$users->CurrentFilter = "0=1";
if ($users->CurrentAction == "gridadd") {
	$users_list->lStartRec = 1;
	if ($users_list->lDisplayRecs <= 0)
		$users_list->lDisplayRecs = 20;
	$users_list->lTotalRecs = $users_list->lDisplayRecs;
	$users_list->lStopRec = $users_list->lDisplayRecs;
} else {
	$bSelectLimit = ($users->Export == "" && $users->SelectLimit);
	if (!$bSelectLimit)
		$rs = $users_list->LoadRecordset();
	$users_list->lTotalRecs = ($bSelectLimit) ? $users->SelectRecordCount() : $rs->RecordCount();
	$users_list->lStartRec = 1;
	if ($users_list->lDisplayRecs <= 0) // Display all records
		$users_list->lDisplayRecs = $users_list->lTotalRecs;
	if (!($users->ExportAll && $users->Export <> ""))
		$users_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $users_list->LoadRecordset($users_list->lStartRec-1, $users_list->lDisplayRecs);
}
?>
<p><span class="phpmaker" style="white-space: nowrap;">TABLE: users
<?php if ($users->Export == "" && $users->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $users_list->PageUrl() ?>export=print">Printer Friendly</a>
&nbsp;&nbsp;<a href="<?php echo $users_list->PageUrl() ?>export=html">Export to HTML</a>
&nbsp;&nbsp;<a href="<?php echo $users_list->PageUrl() ?>export=excel">Export to Excel</a>
&nbsp;&nbsp;<a href="<?php echo $users_list->PageUrl() ?>export=word">Export to Word</a>
&nbsp;&nbsp;<a href="<?php echo $users_list->PageUrl() ?>export=xml">Export to XML</a>
&nbsp;&nbsp;<a href="<?php echo $users_list->PageUrl() ?>export=csv">Export to CSV</a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($users->Export == "" && $users->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(users_list);" style="text-decoration: none;"><img id="users_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="users_list_SearchPanel">
<form name="fuserslistsrch" id="fuserslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="users">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($users->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Search (*)">&nbsp;
			<a href="<?php echo $users_list->PageUrl() ?>cmd=reset">Show all</a>&nbsp;
			<a href="userssrch.php">Advanced Search</a>&nbsp;
			<?php if ($users_list->sSrchWhere <> "" && $users_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(users_list, this, '<?php echo $users->HighlightName() ?>');">Hide highlight</a>
			<?php } ?>
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($users->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>Exact phrase</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($users->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>All words</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($users->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>Any word</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $users_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($users->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($users->CurrentAction <> "gridadd" && $users->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($users_list->Pager)) $users_list->Pager = new cPrevNextPager($users_list->lStartRec, $users_list->lDisplayRecs, $users_list->lTotalRecs) ?>
<?php if ($users_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($users_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $users_list->PageUrl() ?>start=<?php echo $users_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($users_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $users_list->PageUrl() ?>start=<?php echo $users_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $users_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($users_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $users_list->PageUrl() ?>start=<?php echo $users_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($users_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $users_list->PageUrl() ?>start=<?php echo $users_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $users_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $users_list->Pager->FromIndex ?> to <?php echo $users_list->Pager->ToIndex ?> of <?php echo $users_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($users_list->sSrchWhere == "0=101") { ?>
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
<?php if ($users->CurrentAction <> "gridadd" && $users->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $users->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<a href="<?php echo $users_list->PageUrl() ?>a=add">Inline Add</a>&nbsp;&nbsp;
<a href="<?php echo $users_list->PageUrl() ?>a=gridadd">Grid Add</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($users_list->lTotalRecs > 0) { ?>
<a href="<?php echo $users_list->PageUrl() ?>a=gridedit">Grid Edit</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if ($users_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fuserslist)) alert('No records selected'); else if (ew_Confirm('<?php echo $users_list->sDeleteConfirmMsg ?>')) {document.fuserslist.action='usersdelete.php';document.fuserslist.encoding='application/x-www-form-urlencoded';document.fuserslist.submit();};return false;">Delete Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fuserslist)) alert('No records selected'); else {document.fuserslist.action='usersupdate.php';document.fuserslist.encoding='application/x-www-form-urlencoded';document.fuserslist.submit();};return false;">Update Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($users->CurrentAction == "gridadd") { ?>
<a href="" onclick="if (users_list.ValidateForm(document.fuserslist)) document.fuserslist.submit();return false;">Insert</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($users->CurrentAction == "gridedit") { ?>
<a href="" onclick="if (users_list.ValidateForm(document.fuserslist)) document.fuserslist.submit();return false;">Save</a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php echo $users_list->PageUrl() ?>a=cancel">Cancel</a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fuserslist" id="fuserslist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="users">
<?php if ($users_list->lTotalRecs > 0 || $users->CurrentAction == "add" || $users->CurrentAction == "copy") { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$users_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$users_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$users_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$users_list->lOptionCnt++; // copy
}
if ($Security->IsLoggedIn()) {
	$users_list->lOptionCnt++; // Multi-select
}
	$users_list->lOptionCnt += count($users_list->ListOptions->Items); // Custom list options
?>
<?php echo $users->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($users->id->Visible) { // id ?>
	<?php if ($users->SortUrl($users->id) == "") { ?>
		<td>id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $users->SortUrl($users->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>id</td><td style="width: 10px;"><?php if ($users->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($users->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($users->username->Visible) { // username ?>
	<?php if ($users->SortUrl($users->username) == "") { ?>
		<td>username</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $users->SortUrl($users->username) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>username&nbsp;(*)</td><td style="width: 10px;"><?php if ($users->username->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($users->username->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($users->password->Visible) { // password ?>
	<?php if ($users->SortUrl($users->password) == "") { ?>
		<td>password</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $users->SortUrl($users->password) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>password&nbsp;(*)</td><td style="width: 10px;"><?php if ($users->password->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($users->password->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($users->zemail->Visible) { // email ?>
	<?php if ($users->SortUrl($users->zemail) == "") { ?>
		<td>email</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $users->SortUrl($users->zemail) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>email&nbsp;(*)</td><td style="width: 10px;"><?php if ($users->zemail->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($users->zemail->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($users->Export == "") { ?>
<?php if ($users->CurrentAction <> "gridadd" && $users->CurrentAction <> "gridedit") { ?>
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
<?php if ($users_list->lOptionCnt == 0 && $users->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="phpmaker" onclick="users_list.SelectAllKey(this);"></td>
<?php } ?>
<?php

// Custom list options
foreach ($users_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
</thead>
<?php
	if ($users->CurrentAction == "add" || $users->CurrentAction == "copy") {
		$users_list->lRowIndex = 1;
		if ($users->CurrentAction == "copy" && !$users_list->LoadRow())
				$users->CurrentAction = "add";
		if ($users->CurrentAction == "add")
			$users_list->LoadDefaultValues();
		if ($users->EventCancelled) // Insert failed
			$users_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$users->CssClass = "ewTableEditRow";
		$users->CssStyle = "";
		$users->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
		$users->RowType = EW_ROWTYPE_ADD;

		// Render row
		$users_list->RenderRow();
?>
	<tr<?php echo $users->RowAttributes() ?>>
	<?php if ($users->id->Visible) { // id ?>
		<td>&nbsp;</td>
	<?php } ?>
	<?php if ($users->username->Visible) { // username ?>
		<td>
<input type="text" name="x<?php echo $users_list->lRowIndex ?>_username" id="x<?php echo $users_list->lRowIndex ?>_username" size="30" maxlength="20" value="<?php echo $users->username->EditValue ?>"<?php echo $users->username->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($users->password->Visible) { // password ?>
		<td>
<input type="text" name="x<?php echo $users_list->lRowIndex ?>_password" id="x<?php echo $users_list->lRowIndex ?>_password" size="30" maxlength="100" value="<?php echo $users->password->EditValue ?>"<?php echo $users->password->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($users->zemail->Visible) { // email ?>
		<td>
<input type="text" name="x<?php echo $users_list->lRowIndex ?>_zemail" id="x<?php echo $users_list->lRowIndex ?>_zemail" size="30" maxlength="100" value="<?php echo $users->zemail->EditValue ?>"<?php echo $users->zemail->EditAttributes() ?>>
</td>
	<?php } ?>
<td colspan="<?php echo $users_list->lOptionCnt ?>"><span class="phpmaker">
<a href="" onclick="if (users_list.ValidateForm(document.fuserslist)) document.fuserslist.submit();return false;">Insert</a>&nbsp;<a href="<?php echo $users_list->PageUrl() ?>a=cancel">Cancel</a>
<input type="hidden" name="a_list" id="a_list" value="insert">
</span></td>
	</tr>
<?php
}
?>
<?php
if ($users->ExportAll && $users->Export <> "") {
	$users_list->lStopRec = $users_list->lTotalRecs;
} else {
	$users_list->lStopRec = $users_list->lStartRec + $users_list->lDisplayRecs - 1; // Set the last record to display
}
$users_list->lRecCount = $users_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$users->SelectLimit && $users_list->lStartRec > 1)
		$rs->Move($users_list->lStartRec - 1);
}
$users_list->lRowCnt = 0;
$users_list->lEditRowCnt = 0;
if ($users->CurrentAction == "edit")
	$users_list->lRowIndex = 1;
if ($users->CurrentAction == "gridadd")
	$users_list->lRowIndex = 0;
if ($users->CurrentAction == "gridedit")
	$users_list->lRowIndex = 0;
while (($users->CurrentAction == "gridadd" || !$rs->EOF) &&
	$users_list->lRecCount < $users_list->lStopRec) {
	$users_list->lRecCount++;
	if (intval($users_list->lRecCount) >= intval($users_list->lStartRec)) {
		$users_list->lRowCnt++;
		if ($users->CurrentAction == "gridadd" || $users->CurrentAction == "gridedit")
			$users_list->lRowIndex++;

	// Init row class and style
	$users->CssClass = "";
	$users->CssStyle = "";
	$users->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($users->CurrentAction == "gridadd") {
		$users_list->LoadDefaultValues(); // Load default values
	} else {
		$users_list->LoadRowValues($rs); // Load row values
	}
	$users->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($users->CurrentAction == "gridadd") // Grid add
		$users->RowType = EW_ROWTYPE_ADD; // Render add
	if ($users->CurrentAction == "gridadd" && $users->EventCancelled) // Insert failed
		$users_list->RestoreCurrentRowFormValues($users_list->lRowIndex); // Restore form values
	if ($users->CurrentAction == "edit") {
		if ($users_list->CheckInlineEditKey() && $users_list->lEditRowCnt == 0) // Inline edit
			$users->RowType = EW_ROWTYPE_EDIT; // Render edit
	}
	if ($users->CurrentAction == "gridedit") // Grid edit
		$users->RowType = EW_ROWTYPE_EDIT; // Render edit
	if ($users->RowType == EW_ROWTYPE_EDIT && $users->EventCancelled) { // Update failed
		if ($users->CurrentAction == "edit")
			$users_list->RestoreFormValues(); // Restore form values
		if ($users->CurrentAction == "gridedit")
			$users_list->RestoreCurrentRowFormValues($users_list->lRowIndex); // Restore form values
	}
	if ($users->RowType == EW_ROWTYPE_EDIT) { // Edit row
		$users_list->lEditRowCnt++;
		$users->RowClientEvents = "onmouseover='this.edit=true;ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	}
	if ($users->RowType == EW_ROWTYPE_ADD || $users->RowType == EW_ROWTYPE_EDIT) // Add / Edit row
			$users->CssClass = "ewTableEditRow";

	// Render row
	$users_list->RenderRow();
?>
	<tr<?php echo $users->RowAttributes() ?>>
	<?php if ($users->id->Visible) { // id ?>
		<td<?php echo $users->id->CellAttributes() ?>>
<?php if ($users->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" name="o<?php echo $users_list->lRowIndex ?>_id" id="o<?php echo $users_list->lRowIndex ?>_id" value="<?php echo ew_HtmlEncode($users->id->OldValue) ?>">
<?php } ?>
<?php if ($users->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $users->id->ViewAttributes() ?>><?php echo $users->id->EditValue ?></div><input type="hidden" name="x<?php echo $users_list->lRowIndex ?>_id" id="x<?php echo $users_list->lRowIndex ?>_id" value="<?php echo ew_HtmlEncode($users->id->CurrentValue) ?>">
<?php } ?>
<?php if ($users->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $users->id->ViewAttributes() ?>><?php echo $users->id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($users->username->Visible) { // username ?>
		<td<?php echo $users->username->CellAttributes() ?>>
<?php if ($users->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $users_list->lRowIndex ?>_username" id="x<?php echo $users_list->lRowIndex ?>_username" size="30" maxlength="20" value="<?php echo $users->username->EditValue ?>"<?php echo $users->username->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $users_list->lRowIndex ?>_username" id="o<?php echo $users_list->lRowIndex ?>_username" value="<?php echo ew_HtmlEncode($users->username->OldValue) ?>">
<?php } ?>
<?php if ($users->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $users_list->lRowIndex ?>_username" id="x<?php echo $users_list->lRowIndex ?>_username" size="30" maxlength="20" value="<?php echo $users->username->EditValue ?>"<?php echo $users->username->EditAttributes() ?>>
<?php } ?>
<?php if ($users->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $users->username->ViewAttributes() ?>><?php echo $users->username->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($users->password->Visible) { // password ?>
		<td<?php echo $users->password->CellAttributes() ?>>
<?php if ($users->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $users_list->lRowIndex ?>_password" id="x<?php echo $users_list->lRowIndex ?>_password" size="30" maxlength="100" value="<?php echo $users->password->EditValue ?>"<?php echo $users->password->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $users_list->lRowIndex ?>_password" id="o<?php echo $users_list->lRowIndex ?>_password" value="<?php echo ew_HtmlEncode($users->password->OldValue) ?>">
<?php } ?>
<?php if ($users->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $users_list->lRowIndex ?>_password" id="x<?php echo $users_list->lRowIndex ?>_password" size="30" maxlength="100" value="<?php echo $users->password->EditValue ?>"<?php echo $users->password->EditAttributes() ?>>
<?php } ?>
<?php if ($users->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $users->password->ViewAttributes() ?>><?php echo $users->password->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($users->zemail->Visible) { // email ?>
		<td<?php echo $users->zemail->CellAttributes() ?>>
<?php if ($users->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="text" name="x<?php echo $users_list->lRowIndex ?>_zemail" id="x<?php echo $users_list->lRowIndex ?>_zemail" size="30" maxlength="100" value="<?php echo $users->zemail->EditValue ?>"<?php echo $users->zemail->EditAttributes() ?>>
<input type="hidden" name="o<?php echo $users_list->lRowIndex ?>_zemail" id="o<?php echo $users_list->lRowIndex ?>_zemail" value="<?php echo ew_HtmlEncode($users->zemail->OldValue) ?>">
<?php } ?>
<?php if ($users->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $users_list->lRowIndex ?>_zemail" id="x<?php echo $users_list->lRowIndex ?>_zemail" size="30" maxlength="100" value="<?php echo $users->zemail->EditValue ?>"<?php echo $users->zemail->EditAttributes() ?>>
<?php } ?>
<?php if ($users->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $users->zemail->ViewAttributes() ?>><?php echo $users->zemail->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php if ($users->RowType == EW_ROWTYPE_ADD || $users->RowType == EW_ROWTYPE_EDIT) { ?>
<?php if ($users->CurrentAction == "edit") { ?>
<td colspan="<?php echo $users_list->lOptionCnt ?>"><span class="phpmaker">
<a href="" onclick="if (users_list.ValidateForm(document.fuserslist)) document.fuserslist.submit();return false;">Update</a>&nbsp;<a href="<?php echo $users_list->PageUrl() ?>a=cancel">Cancel</a>
<input type="hidden" name="a_list" id="a_list" value="update">
</span></td>
<?php } ?>
<?php
	if ($users->CurrentAction == "gridedit")
		$users_list->sMultiSelectKey .= "<input type=\"hidden\" name=\"k" . $users_list->lRowIndex . "_key\" id=\"k" . $users_list->lRowIndex . "_key\" value=\"" . $users->id->CurrentValue . "\">";
?>
<?php } else { ?>
<?php if ($users->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $users->ViewUrl() ?>">View</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $users->EditUrl() ?>">Edit</a><span class="ewSeparator">&nbsp;|&nbsp;</span><a href="<?php echo $users->InlineEditUrl() ?>">Inline Edit</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $users->CopyUrl() ?>">Copy</a><span class="ewSeparator">&nbsp;|&nbsp;</span><a href="<?php echo $users->InlineCopyUrl() ?>">Inline Copy</a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($users_list->lOptionCnt == 0 && $users->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($users->id->CurrentValue) ?>" class="phpmaker" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($users_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
<?php if ($users->RowType == EW_ROWTYPE_ADD) { ?>
<?php } ?>
<?php if ($users->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($users->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($users->CurrentAction == "add" || $users->CurrentAction == "copy") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $users_list->lRowIndex ?>">
<?php } ?>
<?php if ($users->CurrentAction == "gridadd") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $users_list->lRowIndex ?>">
<?php } ?>
<?php if ($users->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $users_list->lRowIndex ?>">
<?php } ?>
<?php if ($users->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $users_list->lRowIndex ?>">
<?php echo $users_list->sMultiSelectKey ?>
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
<?php if ($users_list->lTotalRecs > 0) { ?>
<?php if ($users->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($users->CurrentAction <> "gridadd" && $users->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($users_list->Pager)) $users_list->Pager = new cPrevNextPager($users_list->lStartRec, $users_list->lDisplayRecs, $users_list->lTotalRecs) ?>
<?php if ($users_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($users_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $users_list->PageUrl() ?>start=<?php echo $users_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($users_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $users_list->PageUrl() ?>start=<?php echo $users_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $users_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($users_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $users_list->PageUrl() ?>start=<?php echo $users_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($users_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $users_list->PageUrl() ?>start=<?php echo $users_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $users_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $users_list->Pager->FromIndex ?> to <?php echo $users_list->Pager->ToIndex ?> of <?php echo $users_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($users_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($users_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($users->CurrentAction <> "gridadd" && $users->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $users->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<a href="<?php echo $users_list->PageUrl() ?>a=add">Inline Add</a>&nbsp;&nbsp;
<a href="<?php echo $users_list->PageUrl() ?>a=gridadd">Grid Add</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($users_list->lTotalRecs > 0) { ?>
<a href="<?php echo $users_list->PageUrl() ?>a=gridedit">Grid Edit</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if ($users_list->lTotalRecs > 0) { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fuserslist)) alert('No records selected'); else if (ew_Confirm('<?php echo $users_list->sDeleteConfirmMsg ?>')) {document.fuserslist.action='usersdelete.php';document.fuserslist.encoding='application/x-www-form-urlencoded';document.fuserslist.submit();};return false;">Delete Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fuserslist)) alert('No records selected'); else {document.fuserslist.action='usersupdate.php';document.fuserslist.encoding='application/x-www-form-urlencoded';document.fuserslist.submit();};return false;">Update Selected Records</a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($users->CurrentAction == "gridadd") { ?>
<a href="" onclick="if (users_list.ValidateForm(document.fuserslist)) document.fuserslist.submit();return false;">Insert</a>&nbsp;&nbsp;
<?php } ?>
<?php if ($users->CurrentAction == "gridedit") { ?>
<a href="" onclick="if (users_list.ValidateForm(document.fuserslist)) document.fuserslist.submit();return false;">Save</a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php echo $users_list->PageUrl() ?>a=cancel">Cancel</a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($users->Export == "" && $users->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(users_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($users->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$users_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class cusers_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'users';

	// Page Object Name
	var $PageObjName = 'users_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $users;
		if ($users->UseTokenInUrl) $PageUrl .= "t=" . $users->TableVar . "&"; // add page token
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
		global $objForm, $users;
		if ($users->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($users->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($users->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cusers_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["users"] = new cusers();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'users', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $users;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$users->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $users->Export; // Get export parameter, used in header
	$gsExportFile = $users->TableVar; // Get export file, used in header
	if ($users->Export == "print" || $users->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($users->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($users->Export == "word") {
		header('Content-Type: application/vnd.ms-word;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($users->Export == "xml") {
		header('Content-Type: text/xml;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($users->Export == "csv") {
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
		global $objForm, $gsSearchError, $Security, $users;
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
				$users->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($users->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to grid edit mode
				if ($users->CurrentAction == "gridedit")
					$this->GridEditMode();

				// Switch to inline edit mode
				if ($users->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($users->CurrentAction == "add" || $users->CurrentAction == "copy")
					$this->InlineAddMode();

				// Switch to grid add mode
				if ($users->CurrentAction == "gridadd")
					$this->GridAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$users->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Update
					if ($users->CurrentAction == "gridupdate" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridedit")
						$this->GridUpdate();

					// Inline Update
					if ($users->CurrentAction == "update" && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($users->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
						$this->InlineInsert();

					// Grid Insert
					if ($users->CurrentAction == "gridinsert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridadd")
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
		if ($users->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $users->getRecordsPerPage(); // Restore from Session
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
		$users->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$users->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$users->setStartRecordNumber($this->lStartRec);
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
		$users->setSessionWhere($sFilter);
		$users->CurrentFilter = "";

		// Export data only
		if (in_array($users->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	//  Exit out of inline mode
	function ClearInlineMode() {
		global $users;
		$users->setKey("id", ""); // Clear inline edit key
		$users->CurrentAction = ""; // Clear action
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
		global $Security, $users;
		$bInlineEdit = TRUE;
		if (@$_GET["id"] <> "") {
			$users->id->setQueryStringValue($_GET["id"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$users->setKey("id", $users->id->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to inline edit record
	function InlineUpdate() {
		global $objForm, $gsFormError, $users;
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
				$users->SendEmail = TRUE; // Send email on update success
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
			$users->EventCancelled = TRUE; // Cancel event
			$users->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check inline edit key
	function CheckInlineEditKey() {
		global $users;

		//CheckInlineEditKey = True
		if (strval($users->getKey("id")) <> strval($users->id->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add Mode
	function InlineAddMode() {
		global $Security, $users;
		if ($users->CurrentAction == "copy") {
			if (@$_GET["id"] <> "") {
				$users->id->setQueryStringValue($_GET["id"]);
			} else {
				$users->CurrentAction = "add";
			}
		}
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to inline add/copy record
	function InlineInsert() {
		global $objForm, $gsFormError, $users;
		$objForm->Index = 1;
		$this->LoadFormValues(); // Get form values

		// Validate Form
		if (!$this->ValidateForm()) {
			$this->setMessage($gsFormError); // Set validation error message
			$users->EventCancelled = TRUE; // Set event cancelled
			$users->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$users->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow()) { // Add record
			$this->setMessage("Add succeeded"); // Set add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$users->EventCancelled = TRUE; // Set event cancelled
			$users->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Perform update to grid
	function GridUpdate() {
		global $conn, $objForm, $gsFormError, $users;
		$rowindex = 1;
		$bGridUpdate = TRUE;

		// Begin transaction
		$conn->BeginTrans();

		// Get old recordset
		$users->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $users->SQL();
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
					$users->SendEmail = FALSE; // Do not send email on update success
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
			$users->EventCancelled = TRUE; // Set event cancelled
			$users->CurrentAction = "gridedit"; // Stay in gridedit mode
		}
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $users;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $users->KeyFilter();
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
		global $users;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$users->id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($users->id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Grid Insert
	// Perform insert to grid
	function GridInsert() {
		global $conn, $objForm, $gsFormError, $users;
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
				$users->SendEmail = FALSE; // Do not send email on insert success

				// Validate Form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow(); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
					$sKey .= $users->id->CurrentValue;

					// Add filter for this record
					$sFilter = $users->KeyFilter();
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
			$users->CurrentFilter = $sWrkFilter;
			$sSql = $users->SQL();
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
			$users->EventCancelled = TRUE; // Set event cancelled
			$users->CurrentAction = "gridadd"; // Stay in gridadd mode
		}
	}

	// Check if empty row
	function EmptyRow() {
		global $users;
		if ($users->username->CurrentValue <> $users->username->OldValue)
			return FALSE;
		if ($users->password->CurrentValue <> $users->password->OldValue)
			return FALSE;
		if ($users->zemail->CurrentValue <> $users->zemail->OldValue)
			return FALSE;
		return TRUE;
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm, $users;

		// Get row based on current index
		$objForm->Index = $idx;
		if ($users->CurrentAction == "gridadd")
			$this->LoadFormValues(); // Load form values
		if ($users->CurrentAction == "gridedit") {
			$sKey = strval($objForm->GetValue("k_key"));
			$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $sKey);
			if (count($arrKeyFlds) >= 1) {
				if (strval($arrKeyFlds[0]) == strval($users->id->CurrentValue)) {
					$this->LoadFormValues(); // Load form values
				}
			}
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $users;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $users->id, FALSE); // Field id
		$this->BuildSearchSql($sWhere, $users->username, FALSE); // Field username
		$this->BuildSearchSql($sWhere, $users->password, FALSE); // Field password
		$this->BuildSearchSql($sWhere, $users->zemail, FALSE); // Field email

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($users->id); // Field id
			$this->SetSearchParm($users->username); // Field username
			$this->SetSearchParm($users->password); // Field password
			$this->SetSearchParm($users->zemail); // Field email
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
		global $users;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$users->setAdvancedSearch("x_$FldParm", $FldVal);
		$users->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$users->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$users->setAdvancedSearch("y_$FldParm", $FldVal2);
		$users->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $users;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $users->username->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $users->password->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $users->zemail->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $users;
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
			$users->setBasicSearchKeyword($sSearchKeyword);
			$users->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $users;
		$this->sSrchWhere = "";
		$users->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $users;
		$users->setBasicSearchKeyword("");
		$users->setBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $users;
		$users->setAdvancedSearch("x_id", "");
		$users->setAdvancedSearch("x_username", "");
		$users->setAdvancedSearch("x_password", "");
		$users->setAdvancedSearch("x_zemail", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $users;
		$this->sSrchWhere = $users->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $users;
		 $users->id->AdvancedSearch->SearchValue = $users->getAdvancedSearch("x_id");
		 $users->username->AdvancedSearch->SearchValue = $users->getAdvancedSearch("x_username");
		 $users->password->AdvancedSearch->SearchValue = $users->getAdvancedSearch("x_password");
		 $users->zemail->AdvancedSearch->SearchValue = $users->getAdvancedSearch("x_zemail");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $users;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$users->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$users->CurrentOrderType = @$_GET["ordertype"];
			$users->UpdateSort($users->id); // Field 
			$users->UpdateSort($users->username); // Field 
			$users->UpdateSort($users->password); // Field 
			$users->UpdateSort($users->zemail); // Field 
			$users->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $users;
		$sOrderBy = $users->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($users->SqlOrderBy() <> "") {
				$sOrderBy = $users->SqlOrderBy();
				$users->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $users;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$users->setSessionOrderBy($sOrderBy);
				$users->id->setSort("");
				$users->username->setSort("");
				$users->password->setSort("");
				$users->zemail->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$users->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $users;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$users->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$users->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $users->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$users->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$users->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$users->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $users;
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $users;

		// Load search values
		// id

		$users->id->AdvancedSearch->SearchValue = @$_GET["x_id"];
		$users->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// username
		$users->username->AdvancedSearch->SearchValue = @$_GET["x_username"];
		$users->username->AdvancedSearch->SearchOperator = @$_GET["z_username"];

		// password
		$users->password->AdvancedSearch->SearchValue = @$_GET["x_password"];
		$users->password->AdvancedSearch->SearchOperator = @$_GET["z_password"];

		// email
		$users->zemail->AdvancedSearch->SearchValue = @$_GET["x_zemail"];
		$users->zemail->AdvancedSearch->SearchOperator = @$_GET["z_zemail"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $users;
		$users->id->setFormValue($objForm->GetValue("x_id"));
		$users->id->OldValue = $objForm->GetValue("o_id");
		$users->username->setFormValue($objForm->GetValue("x_username"));
		$users->username->OldValue = $objForm->GetValue("o_username");
		$users->password->setFormValue($objForm->GetValue("x_password"));
		$users->password->OldValue = $objForm->GetValue("o_password");
		$users->zemail->setFormValue($objForm->GetValue("x_zemail"));
		$users->zemail->OldValue = $objForm->GetValue("o_zemail");
	}

	// Restore form values
	function RestoreFormValues() {
		global $users;
		$users->id->CurrentValue = $users->id->FormValue;
		$users->username->CurrentValue = $users->username->FormValue;
		$users->password->CurrentValue = $users->password->FormValue;
		$users->zemail->CurrentValue = $users->zemail->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $users;

		// Call Recordset Selecting event
		$users->Recordset_Selecting($users->CurrentFilter);

		// Load list page SQL
		$sSql = $users->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$users->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $users;
		$sFilter = $users->KeyFilter();

		// Call Row Selecting event
		$users->Row_Selecting($sFilter);

		// Load sql based on filter
		$users->CurrentFilter = $sFilter;
		$sSql = $users->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$users->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $users;
		$users->id->setDbValue($rs->fields('id'));
		$users->username->setDbValue($rs->fields('username'));
		$users->password->setDbValue($rs->fields('password'));
		$users->zemail->setDbValue($rs->fields('email'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $users;

		// Call Row_Rendering event
		$users->Row_Rendering();

		// Common render codes for all row types
		// id

		$users->id->CellCssStyle = "";
		$users->id->CellCssClass = "";

		// username
		$users->username->CellCssStyle = "";
		$users->username->CellCssClass = "";

		// password
		$users->password->CellCssStyle = "";
		$users->password->CellCssClass = "";

		// email
		$users->zemail->CellCssStyle = "";
		$users->zemail->CellCssClass = "";
		if ($users->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$users->id->ViewValue = $users->id->CurrentValue;
			$users->id->CssStyle = "";
			$users->id->CssClass = "";
			$users->id->ViewCustomAttributes = "";

			// username
			$users->username->ViewValue = $users->username->CurrentValue;
			if ($users->Export == "")
				$users->username->ViewValue = ew_Highlight($users->HighlightName(), $users->username->ViewValue, $users->getBasicSearchKeyword(), $users->getBasicSearchType(), $users->getAdvancedSearch("x_username"));
			$users->username->CssStyle = "";
			$users->username->CssClass = "";
			$users->username->ViewCustomAttributes = "";

			// password
			$users->password->ViewValue = $users->password->CurrentValue;
			if ($users->Export == "")
				$users->password->ViewValue = ew_Highlight($users->HighlightName(), $users->password->ViewValue, $users->getBasicSearchKeyword(), $users->getBasicSearchType(), $users->getAdvancedSearch("x_password"));
			$users->password->CssStyle = "";
			$users->password->CssClass = "";
			$users->password->ViewCustomAttributes = "";

			// email
			$users->zemail->ViewValue = $users->zemail->CurrentValue;
			if ($users->Export == "")
				$users->zemail->ViewValue = ew_Highlight($users->HighlightName(), $users->zemail->ViewValue, $users->getBasicSearchKeyword(), $users->getBasicSearchType(), $users->getAdvancedSearch("x_zemail"));
			$users->zemail->CssStyle = "";
			$users->zemail->CssClass = "";
			$users->zemail->ViewCustomAttributes = "";

			// id
			$users->id->HrefValue = "";

			// username
			$users->username->HrefValue = "";

			// password
			$users->password->HrefValue = "";

			// email
			$users->zemail->HrefValue = "";
		} elseif ($users->RowType == EW_ROWTYPE_ADD) { // Add row

			// id
			// username

			$users->username->EditCustomAttributes = "";
			$users->username->EditValue = ew_HtmlEncode($users->username->CurrentValue);

			// password
			$users->password->EditCustomAttributes = "";
			$users->password->EditValue = ew_HtmlEncode($users->password->CurrentValue);

			// email
			$users->zemail->EditCustomAttributes = "";
			$users->zemail->EditValue = ew_HtmlEncode($users->zemail->CurrentValue);
		} elseif ($users->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$users->id->EditCustomAttributes = "";
			$users->id->EditValue = $users->id->CurrentValue;
			$users->id->CssStyle = "";
			$users->id->CssClass = "";
			$users->id->ViewCustomAttributes = "";

			// username
			$users->username->EditCustomAttributes = "";
			$users->username->EditValue = ew_HtmlEncode($users->username->CurrentValue);

			// password
			$users->password->EditCustomAttributes = "";
			$users->password->EditValue = ew_HtmlEncode($users->password->CurrentValue);

			// email
			$users->zemail->EditCustomAttributes = "";
			$users->zemail->EditValue = ew_HtmlEncode($users->zemail->CurrentValue);

			// Edit refer script
			// id

			$users->id->HrefValue = "";

			// username
			$users->username->HrefValue = "";

			// password
			$users->password->HrefValue = "";

			// email
			$users->zemail->HrefValue = "";
		}

		// Call Row Rendered event
		$users->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $users;

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
		global $gsFormError, $users;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($users->username->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - username";
		}
		if ($users->password->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - password";
		}
		if ($users->zemail->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - email";
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
		global $conn, $Security, $users;
		$sFilter = $users->KeyFilter();
		$users->CurrentFilter = $sFilter;
		$sSql = $users->SQL();
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
			// Field username

			$users->username->SetDbValueDef($users->username->CurrentValue, "");
			$rsnew['username'] =& $users->username->DbValue;

			// Field password
			$users->password->SetDbValueDef($users->password->CurrentValue, "");
			$rsnew['password'] =& $users->password->DbValue;

			// Field email
			$users->zemail->SetDbValueDef($users->zemail->CurrentValue, "");
			$rsnew['email'] =& $users->zemail->DbValue;

			// Call Row Updating event
			$bUpdateRow = $users->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($users->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($users->CancelMessage <> "") {
					$this->setMessage($users->CancelMessage);
					$users->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$users->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow() {
		global $conn, $Security, $users;
		$rsnew = array();

		// Field id
		// Field username

		$users->username->SetDbValueDef($users->username->CurrentValue, "");
		$rsnew['username'] =& $users->username->DbValue;

		// Field password
		$users->password->SetDbValueDef($users->password->CurrentValue, "");
		$rsnew['password'] =& $users->password->DbValue;

		// Field email
		$users->zemail->SetDbValueDef($users->zemail->CurrentValue, "");
		$rsnew['email'] =& $users->zemail->DbValue;

		// Call Row Inserting event
		$bInsertRow = $users->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($users->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($users->CancelMessage <> "") {
				$this->setMessage($users->CancelMessage);
				$users->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$users->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $users->id->DbValue;

			// Call Row Inserted event
			$users->Row_Inserted($rsnew);
		}
		return $AddRow;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $users;
		$users->id->AdvancedSearch->SearchValue = $users->getAdvancedSearch("x_id");
		$users->username->AdvancedSearch->SearchValue = $users->getAdvancedSearch("x_username");
		$users->password->AdvancedSearch->SearchValue = $users->getAdvancedSearch("x_password");
		$users->zemail->AdvancedSearch->SearchValue = $users->getAdvancedSearch("x_zemail");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $users;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($users->ExportAll) {
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
		if ($users->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo "\xEF\xBB\xBF";
			echo ew_ExportHeader($users->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $users->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id', $users->Export);
				ew_ExportAddValue($sExportStr, 'username', $users->Export);
				ew_ExportAddValue($sExportStr, 'password', $users->Export);
				ew_ExportAddValue($sExportStr, 'email', $users->Export);
				echo ew_ExportLine($sExportStr, $users->Export);
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
				$users->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($users->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id', $users->id->CurrentValue);
					$XmlDoc->AddField('username', $users->username->CurrentValue);
					$XmlDoc->AddField('password', $users->password->CurrentValue);
					$XmlDoc->AddField('zemail', $users->zemail->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $users->Export <> "csv") { // Vertical format
						echo ew_ExportField('id', $users->id->ExportValue($users->Export, $users->ExportOriginalValue), $users->Export);
						echo ew_ExportField('username', $users->username->ExportValue($users->Export, $users->ExportOriginalValue), $users->Export);
						echo ew_ExportField('password', $users->password->ExportValue($users->Export, $users->ExportOriginalValue), $users->Export);
						echo ew_ExportField('email', $users->zemail->ExportValue($users->Export, $users->ExportOriginalValue), $users->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $users->id->ExportValue($users->Export, $users->ExportOriginalValue), $users->Export);
						ew_ExportAddValue($sExportStr, $users->username->ExportValue($users->Export, $users->ExportOriginalValue), $users->Export);
						ew_ExportAddValue($sExportStr, $users->password->ExportValue($users->Export, $users->ExportOriginalValue), $users->Export);
						ew_ExportAddValue($sExportStr, $users->zemail->ExportValue($users->Export, $users->ExportOriginalValue), $users->Export);
						echo ew_ExportLine($sExportStr, $users->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($users->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($users->Export);
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
