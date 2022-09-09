<?php

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
?>
<p><span class="phpmaker">Master Record: products<br>
<a href="<?php echo $gsMasterReturnUrl ?>">Back to master page</a></span></p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader">id</td>
			<td class="ewTableHeader">name</td>
			<td class="ewTableHeader">name arabic</td>
			<td class="ewTableHeader">level</td>
			<td class="ewTableHeader">image</td>
			<td class="ewTableHeader">image 2</td>
			<td class="ewTableHeader">image 3</td>
			<td class="ewTableHeader">special</td>
			<td class="ewTableHeader">order</td>
			<td class="ewTableHeader">active</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td<?php echo $products->id->CellAttributes() ?>>
<div<?php echo $products->id->ViewAttributes() ?>><?php echo $products->id->ListViewValue() ?></div></td>
			<td<?php echo $products->name->CellAttributes() ?>>
<div<?php echo $products->name->ViewAttributes() ?>><?php echo $products->name->ListViewValue() ?></div></td>
			<td<?php echo $products->name_arabic->CellAttributes() ?>>
<div<?php echo $products->name_arabic->ViewAttributes() ?>><?php echo $products->name_arabic->ListViewValue() ?></div></td>
			<td<?php echo $products->level->CellAttributes() ?>>
<div<?php echo $products->level->ViewAttributes() ?>><?php echo $products->level->ListViewValue() ?></div></td>
			<td<?php echo $products->image->CellAttributes() ?>>
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
</td>
			<td<?php echo $products->image2->CellAttributes() ?>>
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
</td>
			<td<?php echo $products->image3->CellAttributes() ?>>
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
</td>
			<td<?php echo $products->special->CellAttributes() ?>>
<div<?php echo $products->special->ViewAttributes() ?>><?php echo $products->special->ListViewValue() ?></div></td>
			<td<?php echo $products->order->CellAttributes() ?>>
<div<?php echo $products->order->ViewAttributes() ?>><?php echo $products->order->ListViewValue() ?></div></td>
			<td<?php echo $products->active->CellAttributes() ?>>
<div<?php echo $products->active->ViewAttributes() ?>><?php echo $products->active->ListViewValue() ?></div></td>
		</tr>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
