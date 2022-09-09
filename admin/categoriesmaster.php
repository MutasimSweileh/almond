<?php

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
?>
<p><span class="phpmaker">Master Record: categories<br>
<a href="<?php echo $gsMasterReturnUrl ?>">Back to master page</a></span></p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader">id</td>
			<td class="ewTableHeader">name</td>
			<td class="ewTableHeader">name arabic</td>
			<td class="ewTableHeader">order</td>
			<td class="ewTableHeader">active</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td<?php echo $categories->id->CellAttributes() ?>>
<div<?php echo $categories->id->ViewAttributes() ?>><?php echo $categories->id->ListViewValue() ?></div></td>
			<td<?php echo $categories->name->CellAttributes() ?>>
<div<?php echo $categories->name->ViewAttributes() ?>><?php echo $categories->name->ListViewValue() ?></div></td>
			<td<?php echo $categories->name_arabic->CellAttributes() ?>>
<div<?php echo $categories->name_arabic->ViewAttributes() ?>><?php echo $categories->name_arabic->ListViewValue() ?></div></td>
			<td<?php echo $categories->order->CellAttributes() ?>>
<div<?php echo $categories->order->ViewAttributes() ?>><?php echo $categories->order->ListViewValue() ?></div></td>
			<td<?php echo $categories->active->CellAttributes() ?>>
<div<?php echo $categories->active->ViewAttributes() ?>><?php echo $categories->active->ListViewValue() ?></div></td>
		</tr>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
