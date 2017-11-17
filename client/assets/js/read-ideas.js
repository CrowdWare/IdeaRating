$( document ).ready(function() 
{
	showIdeas();
});

function showIdeas()
{
 	$.getJSON("https://idearating-186209.appspot.com/ideas/ideas.php", function(data)
	{
 		// html for listing products
		read_products_html="";
 
		// when clicked, it will load the create product form
		read_products_html+="<div id='create-idea' class='btn btn-primary pull-right m-b-15px create-idea-button'>";
    	read_products_html+="<span class='glyphicon glyphicon-plus'></span> Create Idea";
		read_products_html+="</div>";
		// start table
		read_products_html+="<table class='table table-bordered table-hover'>";
 
    	// creating our table heading
    	read_products_html+="<tr>";
        read_products_html+="<th class='w-25-pct'>Name</th>";
 		read_products_html+="<th class='w-25-pct'>Description</th>";
		read_products_html+="<th class='w-25-pct'>Votes</th>";
 
   		read_products_html+="</tr>";
     
    	// loop through returned list of data
		$.each(data.idea, function(key, val) {
 
    		// creating new table row per record
    		read_products_html+="<tr>";
 
        	read_products_html+="<td>" + val.name + "</td>";
			read_products_html+="<td>" + val.description + "</td>";
			read_products_html+="<td>" + val.votes + "</td>";
        	
        	// 'action' buttons
        	read_products_html+="<td>";
            // vote button
            read_products_html+="<button class='btn btn-primary m-r-10px read-one-product-button' data-id='" + val.id + "'>";
            read_products_html+="<span class='glyphicon glyphicon-eye-open'></span> Vote";
            read_products_html+="</button>";
 
        	read_products_html+="</td>";
 
    		read_products_html+="</tr>";
 
		});
 
		// end table
		read_products_html+="</table>";
		// inject to 'page-content' of our app
		$("#page-content").html(read_products_html);

		// chage page title
		changePageTitle("Ideas loaded");
	})
	.error(function(jqXHR, textStatus, errorThrown) {
        console.log("error " + textStatus);
        console.log("incoming Text " + jqXHR.responseText);
    })
}


