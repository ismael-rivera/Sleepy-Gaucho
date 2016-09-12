<?php 

  //--------------------------------------------------------------------------
  // Example php script for fetching data from mysql database
  // by Trystan Lea : openenergymonitor.org : GNU GPL
  //--------------------------------------------------------------------------
  $host = "localhost";
  $user = "root";
  $pass = "5es6rx6no8322zs";
  $databaseName = "rubyhills_db";
  $tableName = "lot_prices";

  //--------------------------------------------------------------------------
  // 1) Connect to mysql database
  //--------------------------------------------------------------------------
  //include 'DB.php';
  $con = mysql_connect($host,$user,$pass);
  $dbs = mysql_select_db($databaseName, $con);

  //--------------------------------------------------------------------------
  // 2) Query database for data
  //--------------------------------------------------------------------------
  $result = mysql_query("SELECT * FROM $tableName");            //query
  
  echo "<table width='932' border='1' cellpadding='2'>
  <tr>
    <th scope='col'>id</th>
    <th scope='col'>location</th>
    <th scope='col'>desc</th>
    <th scope='col'>price</th>
  </tr>";
  while ($a = mysql_fetch_array($result)) {
	  echo '<tr><td>' . $a['id'] . "</td><td>" . $a['location'] . "</td><td>" . $a['description'] . "</td>
	  <td>" . $a['price'] . "</td></tr>";
	  $rows[] = $a['id'];
	  $rows[] = $a['location'];
	  $rows[] = $a['description'];
	  $rows[] = $a['price'];
	  }
	  echo "</table>";
 
//$row = mysql_fetch_row($result);
  
                            //fetch result    

  //--------------------------------------------------------------------------
  // 3) echo result as json 
  //--------------------------------------------------------------------------
  //echo json_encode($rows);
  var_dump($rows);
  
  
 
  
  

?>
