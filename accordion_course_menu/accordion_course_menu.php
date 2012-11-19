	<style>
	accordion_column {width:250px;}
	dl { width: 250px; font-family:Arial, Helvetica, sans-serif; font-weight:normal;}
	dl,dd { margin: 0;}
	dt { background: #1F65AA; font-size: 16px; padding: 0px; margin-bottom: 1px;}
	dt a { color: #FFF; display:block; margin:0px; padding:3px;}
	dt a:hover { text-decoration: none; background: #216db7;}
	dd a,dd a:visited { color: #000; display:block; background:#333333; margin-bottom: 1px; font-size:12px; padding:3px;}
	dd a:hover { background:#444444; text-decoration:none;}
	ul { list-style: none; padding: 0px; display:block; margin-left:0px;}
	</style>

<table align="center"><tr>
<?php

//Print all categories for HEADER

$result = get_records_sql("SELECT * FROM {$CFG->prefix}course_categories WHERE parent = '0' AND visible = '1'");
foreach ($result as $course_category) {
	$category_name = $course_category->name;
	$category_id = $course_category->id;
	?>
    <td class="accordion_column" valign="top">
	<div style="background: #C32D2E; font-size: 18px; color: #fff; padding: 3px; margin-bottom: 1px; width:auto;">
    <a style="color:#ffffff; display:block;" href="<?php print $CFG->wwwroot; ?>/course/category.php?id=<?php print $category_id; ?>"><?php print $category_name; ?></a>
    </div>
   
<?php   
	
//Print all subcatetories for expandable subheadings

	$result2 = get_records_sql("SELECT * FROM {$CFG->prefix}course_categories WHERE parent = '$category_id' AND visible = '1' ORDER BY name ASC");
	foreach ($result2 as $course_category2) {
		$category_name2 = $course_category2->name;
		$category_id2 = $course_category2->id;
		?>
        <dl>
		<dt>
        <a style="color:#ffffff;" href="<?php print $CFG->wwwroot; ?>/course/category.php?id=<?php print $category_id; ?>">
        <?php print $category_name2; ?>
		</a></dt>
		<dd>

		<?php

//Print all courses off subcategories

		$result3 = get_records_sql("SELECT * FROM {$CFG->prefix}course WHERE category = '$category_id2' AND visible = '1' ORDER BY fullname ASC");
		?>
        <ul>
		<?php 
		foreach ($result3 as $course_category3) {
			$course_name = $course_category3->fullname;
			$course_id = $course_category3->id;
		?>
			<li>
			<a style="color:#dddddd;" href="<?php print $CFG->wwwroot; ?>/course/view.php?id=<?php print $course_id; ?>"><?php print $course_name; ?></a>
			</li>
    	<?php
		}
//Print any remaining sub-categories and highlist to indicate a category rather than course
		
		$result4 = get_records_sql("SELECT * FROM {$CFG->prefix}course_categories WHERE parent = '$category_id2' AND visible = '1' ORDER BY name ASC");
		foreach ($result4 as $course_category4) {
			$category_name4 = $course_category4->name;
			$category_id4 = $course_category4->id;
		?>
           	<li>
			<a style="color:#dddddd;" href="<?php print $CFG->wwwroot; ?>/course/category.php?id=<?php print $category_id4; ?>"><?php print $category_name4; ?></a>
           	</li>


    	<?php
		
	}
	
	print "</ul>";
	print "</dd>";
	print "</dl>";
	
	}
	

print "</td>";

}

?>

</tr></table><br />

