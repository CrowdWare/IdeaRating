$(document).ready(function(){
 
	var server = "https://idearating-186209.appspot.com";
	//var server = "http://localhost:8080";

	$(document).on('click', '.add-idea-button', function()
	{
		createIdea();
    });

	$(document).on('click', '#add-idea-cancel', function()
	{
		showIdeas();
    });

	$(document).on('click', '.vote-idea-button', function()
	{
		$.post(server + "/ideas/vote.php",
		{
			app: 'FlatSiteBuilder',
			idea: $(this).attr('data-id'),
			email: 'artanidos@gmail.com'
		}
		,
    	function(data, status)
		{
			console.log(data);
			console.log(status);
			showIdeas();
   	 	})
		.fail(function(data, status) 
		{	
			console.log(data);
			console.log(status);
  		});
		
		return false;
    });

	
	$(document).on('submit', '#add-idea-form', function()
	{
		$.post(server + "/ideas/create_idea.php",
		$("#add-idea-form").serialize()
		,
    	function(data, status)
		{
			console.log(data);
			console.log(status);
			showIdeas();
   	 	})
		.fail(function(data, status) 
		{	
			console.log(data);
			console.log(status);
  		});
		
		return false;
	});

    // app html
    app_html="";
    app_html+="<div class='container'>";
    app_html+="<div class='page-header'>";
    app_html+="<h1 id='page-title'>Read Ideas</h1>";
    app_html+="</div>";
 
    // this is where the contents will be shown.
    app_html+="<div id='page-content'></div>";
    app_html+="</div>";
 
    // inject to 'app' in index.html
    $("#app").html(app_html);

	showIdeas();
});
 
// change page title
function changePageTitle(page_title){
 
    // change page title
    $('#page-title').text(page_title);
 
    // change title tag
    document.title=page_title;
}
 
// function to make form values to json format
$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

