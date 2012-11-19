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


<?php

//Print all categories for HEADER
//COUNT (*) FROM myTable WHERE DATEDIFF(Day, DateAdded, getdate() ) <= 3
//DATE_FORMAT(event_date,'%s %b %d')


$todaydate = time() - (7 * 24 * 60 * 60 * 200);
$result = get_records_sql("SELECT MONTHNAME(time) as month, COUNT(*) as total_number FROM {$CFG->prefix}log WHERE time > $todaydate GROUP BY month ORDER BY time ASC");
foreach ($result as $activity_time) {
	$timetoday = $activity_time->total_number;
	$time = $activity_time->month;

print $timetoday;
print " ";
print $time;
print "<br />";
   

}
//print " test2 <br />";
//print $activity_time->total_number;
//print $todaydate;
?>

