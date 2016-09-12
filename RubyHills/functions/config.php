<?php

class config {
	
//---------------------MAIN CLASS BEGINS HERE-------------------------	
	
//function that gets the array value through $x and echoes it out.

function getInfo($x) {
//---------------------------------FUNCTION CONTENTS-----------------------------------------------------	
	//sub-function that creates, houses and returns the array
	
	function info($x){
		
		$dynamic['title'] = "Ruby Hills Country Estates";
		$dynamic['stylesheet'] = "css/styles.css";
		$dynamic['legal'] = "www.RubyHills.com Copyright 2011";
		return $dynamic[$x];
		}
	
	echo info($x);
//---------------------------------FUNCTION CONTENTS-----------------------------------------------------		
}
function dbconnect() {
//---------------------------------FUNCTION CONTENTS-----------------------------------------------------		
/* 
1: "die()" will exit the script and show an error statement if something goes wrong with the "connect" or "select" functions. 
2: A "mysql_connect()" error usually means your username/password are wrong 
3: A "mysql_select_db()" error usually means the database does not exist.
*/
$db_host = "localhost";
// Place the username for the MySQL database here
$db_user = "root"; 
// Place the password for the MySQL database here
$db_pass = "5es6rx6no8322zs"; 
// Place the name for the MySQL database here
$db_name = "rubyhills_db";

// Run the actual connection here 
mysql_connect("$db_host","$db_user","$db_pass") or die ("could not connect to mysql");
mysql_select_db("$db_name") or die ("no database");

//---------------------------------FUNCTION CONTENTS-----------------------------------------------------
	}
	
function testecho() {
	
	echo "That's Fucking Right!";
	
	}

function tables() {
//---------------------------------FUNCTION CONTENTS-----------------------------------------------------
	$result = mysql_query("SELECT * FROM lot_prices");            //query
  	echo "<table width='700' cellpadding='5' cellspacing='0' class='shadowout'>
	<thead>
		<tr>
			<th width='58' id='...' scope='col'>Lot#</th>
            <th width='58' id='...' scope='col'>Location</th>
            <th width='114' id='...' scope='col'>Decription</th>
            <th width='58' id='...' scope='col'>Price</th>
		</tr>    
	</thead>
        <tbody>";
  while ($a = mysql_fetch_array($result)) {
	  echo '<tr><td>' . $a['id'] . "</td><td>" . $a['location'] . "</td><td>" . $a['description'] . "</td>
	  <td>" . $a['price'] . "</td></tr>";
	  }
	  echo "</table>";
//---------------------------------FUNCTION CONTENTS-----------------------------------------------------
				}

//---------------------MAIN CLASS ENDS HERE-------------------------

}

