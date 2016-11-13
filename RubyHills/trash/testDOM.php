<script type="text/javascript">

function getData () {
document.getElementById("fetchData").innerHTML = xmlhttp.responseText;
}

// Create a function that will receive data sent from the server
ajaxRequest.onreadystatechange = function(){
	// We still need to write some code here
}
// Create a function that will receive data sent from the server
ajaxRequest.onreadystatechange = function(){
	if(ajaxRequest.readyState == 4){
		// Get the data from the server's response
	}
}


</script>
<div id="fetchData">Text Hint Here</div>
<input type='button' onclick='getData()' value='Change Text'/>
