<!---------------------------------------------------------------------------------------------
Example client script for JQUERY:AJAX -> PHP:MYSQL example
by Trystan Lea : openenergymonitor.org : GNU GPL

I recommend going to http://jquery.com/ for the great documentation there about all of this
---------------------------------------------------------------------------------------------->
<html>
  <head>
    <script language="javascript" type="text/javascript" src="jquery.js"></script>
  <style type="text/css">
.shadowout {
	-moz-box-shadow: 3px 3px 8px #ccc;
	-webkit-box-shadow: 3px 3px 8px #ccc;
	box-shadow: 3px 3px 8px #ccc;
	/* For IE 8 */
	-ms-filter: "progid:DXImageTransform.Microsoft.Shadow(Strength=4, Direction=135, Color='#000000')";
	/* For IE 5.5 - 7 */
	filter: progid:DXImageTransform.Microsoft.Shadow(Strength=4, Direction=135, Color='#000000');
}
table {
	border: 1px solid #8CB7BD;	
	}
td {
	text-align: center;
}
thead tr th {
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #066;
	background-color: #92CCCC;
	}
tbody tr td {
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #9ED7D9;
	}
</style>

  </head>
  <body>



  <!---------------------------------------------------------------------------------------------
  1) Create some html content that can be accessed by jquery
  ---------------------------------------------------------------------------------------------->
  <h2> Client example </h2>
 
 <script id="source" language="javascript" type="text/javascript">
 

  $(function ajaxReq() 
  {

    //-------------------------------------------------------------------------------------------
    // 2) Send a http request with AJAX http://api.jquery.com/jQuery.ajax/
    //-------------------------------------------------------------------------------------------
    $.ajax({                                      
      url: 'api.php',                  //the script to call to get data          
      data: "",                        //you can insert url argumnets here to pass to api.php for example "id=5&parent=6"
      dataType: 'json',                //data format      
      success: function getApiData(rows)          //on recieve of reply
      {
		
		var id = rows[0];              //get id
        var location = rows[1];
		var description = rows[2];
		var price = rows[3];           //get price
		

        //--------------------------------------------------------------------------------------
        // 3) Update html content. Q: how do I output into a Loop.
        //--------------------------------------------------------------------------------------
 
		
        $('#output').html("<td>" + id + "</td><td>" + location + "</td><td>" + description + "</td><td>" + price + "</td>");     
		//Set output element html
        //recommend reading up on jquery selectors they are awesome http://api.jquery.com/category/selectors/
		/*	document.write("<table width='700' cellpadding='5' cellspacing='0' class='shadowout'>");
  			document.write("<thead>");
			document.write("<tr>");
			document.write("<th width='58' id='...' scope='col'>Lot#</th>");
            document.write("<th width='58' id='...' scope='col'>Location</th>");
            document.write("<th width='114' id='...' scope='col'>Decription</th>");
            document.write("<th width='58' id='...' scope='col'>Price</th>");
			document.write("</tr>");    
			document.write("</thead>");
			document.write("<tbody>");
			for (counter=0; counter<data.length; counter++)
			{
			document.write("<tr id='output'>"); 
			document.write("<td>" + data[counter] + "</td>");
			document.write("</tr>");
			}*/
			
      } 
    });
  
  }); 
  </script>
 
  <h3>Output: </h3>
  
  <table width="700" cellpadding="5" cellspacing="0" class="shadowout">
  
  	<thead>
		<tr>
			<th width="58" id="..." scope="col">Lot#</th>
            <th width="58" id="..." scope="col">Location</th>
            <th width="114" id="..." scope="col">Decription</th>
            <th width="58" id="..." scope="col">Price</th>
		</tr>    
	</thead>
        <tbody>
  <tr id="output"></tr>
  		</tbody>
   
   </table>     
        
  </body>
</html>  
