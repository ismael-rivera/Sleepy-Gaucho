<!DOCTYPE html>
<html>
<head>
<script language="javascript" type="text/javascript" src="jquery.js"></script>
<!--<script src="looptest.js"></script>-->
<link href="looptest.css" rel="stylesheet" type="text/css">

</head>
<body>

<!--------------------------------------------------------------------------------------------------------------
EXAMPLE 1
-------------------------------------------------------------------------------------------------------------->


 <!--------------------------------------------------------------------------------------------->
 <!-- 1) Create some html content that can be accessed by jquery-->
 <!------------------------------------------------------------------------------------------------>
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
      success: function dataloop(data)          //on recieve of reply
      {
        var id = data[0];              //get id
        var vname = data[1];
		var description = data[2];
		var price = data[3];           //get name
		
		var counter=0;
        //--------------------------------------------------------------------------------------
        // 3) Update html content. Q: how do I output into a Loop.
        //--------------------------------------------------------------------------------------
       // $('#output').html("<td>" + id + "</td><td>" + vname + "</td><td>" + description + "</td><td>" + price + "</td>");
		for (counter=0; counter<data.length; counter++) 
		document.write(data[counter] + "<br>");
		//Set output element html
        //recommend reading up on jquery selectors they are awesome http://api.jquery.com/category/selectors/
      } 
    });
  
  }); 
  </script>


 
  <h3>Output: </h3>
  
  <table width="700" cellpadding="5" cellspacing="0" class="shadowout">
  
  	<thead>
		<tr>
			<th width="114" id="..." scope="col">Lot#</th>
            <th width="114" id="..." scope="col">Location</th>
            <th width="114" id="..." scope="col">Decription</th>
            <th width="114" id="..." scope="col">Price</th>
		</tr>    
	</thead>
        <tbody>
  <tr id="output"></tr>
  		</tbody>
   
   </table>     

<!--------------------------------------------------------------------------------------------------------------
EXAMPLE 2
-------------------------------------------------------------------------------------------------------------->        

 <br />
 <br />
 <br />
 <table width="456" cellpadding="5" cellspacing="0" class="shadowout">
  
  	<thead>
		<tr>
			<th width="58" id="..." scope="col">Lot#</th>
            <th width="58" id="..." scope="col">Location</th>
            <th width="58" id="..." scope="col">Price</th>
		</tr>    
	</thead>
        <tbody>
  <tr id="output"></tr>
  		</tbody>
   
   </table>          

<script type="text/javascript">

//We initialize the array using the array() constructor.
var data = new Array();

data[0] = "This is an element";
data[1] = 5;
data[2] = "JavaScript - Tutorial";
data[3] = 16;



//var id = data[0];
//var location = data[1];
//var description = data[2];
//var price = data[3];


//var counter=0;

//Let's print out the elements of the array.
//for (counter=0; counter<data.length; counter++)
//   document.write(data[counter] + "<br>");

</script>        
        

<!--------------------------------------------------------------------------------------------------------------
EXAMPLE 3
-------------------------------------------------------------------------------------------------------------->
 <br />
 <br />
 <br />
 <table width="456" cellpadding="5" cellspacing="0" class="shadowout">
  
  	<thead>
		<tr>
			<th width="58" id="..." scope="col">Lot#</th>
            <th width="58" id="..." scope="col">Location</th>
            <th width="58" id="..." scope="col">Price</th>
		</tr>    
	</thead>
        <tbody>
  <tr id="output"></tr>
  		</tbody>
   
   </table>  
  
  <div id="one"></div>
  <div id="two"></div>
  <div id="three"></div>
  <div id="four"></div>
  <div id="five"></div>
  
 <script type="text/javascript">

   var arr = [ "one", "two", "three", "four", "five" ];
    var obj = { one:1, two:2, three:3, four:4, five:5 };

    jQuery.each(arr, function() {
      $("#" + this).text("Mine is " + this);
       return (this); // will stop running after "three"
   });

    jQuery.each(obj, function(i, val) {
      $("#" + i).append(document.createTextNode(" - " + val));
    });

</script> 


</body>
</html>