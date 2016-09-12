<?php

$config->dbconnect();
$sql="SELECT * FROM nav ORDER BY id LIMIT 0,6";
$result= mysql_query($sql) or die('Query failed:' . mysql_error());

if ($result) {
	while ($row = mysql_fetch_array($result, MYSQLI_ASSOC)){
		echo "<li><a href='{$row['url']}' title='{$row['title']}'>{$row['name']}</a></li>";
		}
	}
?>	