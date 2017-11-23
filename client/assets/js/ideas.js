function createIdea()
{
	// 'create product' html form
	create_product_html = "";
	create_product_html+="<form id='add-idea-form' action='#' method='post' border='0'>";
	create_product_html+= "<input type='hidden' name='app' value='FlatSiteBuilder'>";
    create_product_html+="<table class='table table-hover table-responsive table-bordered'>";

	// name field
    create_product_html+="<tr>";
    create_product_html+="<td>Name</td>";
    create_product_html+="<td><input type='text' name='name' class='form-control' required /></td>";
    create_product_html+="</tr>";
 
    // description field
    create_product_html+="<tr>";
    create_product_html+="<td>Description</td>";
    create_product_html+="<td><textarea name='description' class='form-control' required></textarea></td>";
    create_product_html+="</tr>";
 
    // button to submit form
    create_product_html+="<tr>";
    create_product_html+="<td></td>";
    create_product_html+="<td>";
    create_product_html+="<button type='submit' class='btn btn-success'>";
    create_product_html+="<span class='glyphicon glyphicon-plus'></span> Add Idea";
    create_product_html+="</button>";
    
    create_product_html+="<button id='add-idea-cancel' type='button' class='btn btn-primary'>";
    create_product_html+="Cancel";
    create_product_html+="</button>";
    create_product_html+="</td>";
    create_product_html+="</tr>";

    create_product_html+="</table>";
	create_product_html+="</form>";

	// inject html to 'page-content' of our app
	$("#page-content").html(create_product_html);
 
	// chage page title
	changePageTitle("Add Idea");
}

function showIdeas()
{
	var server = "https://idearating-186209.appspot.com";
	//var server = "http://localhost:8080";

 	$.getJSON(server + "/ideas/ideas.php?app=FlatSiteBuilder", function(data)
	{
 		// html for listing products
		read_products_html="";
 
		// when clicked, it will load the create product form
		read_products_html+="<div id='create-idea' class='btn btn-primary pull-right m-b-15px add-idea-button'>";
    	read_products_html+="<span class='glyphicon glyphicon-plus'></span> Add Idea";
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
            read_products_html+="<button class='btn btn-primary m-r-10px vote-idea-button' data-id='" + val.id + "'>";
            read_products_html+="<span class='glyphicon glyphicon-eye-'></span> Vote";
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


