<?
// config.php has our database connection information so we have to call it first:
include 'functions/config.php';
 
//we assign the variable from the config.php to $link
$link = mysql_connect($db_host, $db_user, $db_pass);
mysql_select_db($db_name, $link);
 
//For this example, we're going to pull 10 records from the database (LIMIT 0 , 10):
$sql_statement = 'SELECT title, description, source FROM things ORDER BY date DESC LIMIT 0 , 
10';
$result = mysql_query($sql_statement, $link);
 
//now we create a while "loop" to fetch all 10 records:
while ($curr_row = mysql_fetch_assoc($result)) {
 
// This next line just simply pulls the title from our database and displays it:
echo $title;
echo '<br><br>';
 
//This one shows how to concantenate php variables with html.. pulling both the title and description from our database:
echo '<font size="2" face="sans-serif"><b><h5>' . $curr_row['title'] . '</h5></b>' . 
'&nbsp;&nbsp;' . $curr_row['description'] . '...</font><br><br>';
 
/*And this line is the one that we'll use to create our new page.  It's a hyperlink that is calling our new page "phptest2.php" and populating it with the title.*/  
echo "<a  href='phptest2.php?id=" . $curr_row['title'] . "'>". $curr_row['title'] ."</a>";}  
/*This closed bracket ends our while loop.  As long as there are conditions to be met above this bracket, they will run until finished and then continue past this.*/
 
mysql_free_result($result); // Release our sql query.  It's not necessary, just good programming.
?>