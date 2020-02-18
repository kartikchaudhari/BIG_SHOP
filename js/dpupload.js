$(document).ready(function (e) {
	$("#uploaddpicon").click(function(){
		$("#propicinput").click();
	});
	$("#propicinput").on('change',(function(e) {
		e.preventDefault();
		$("#dpudtfrm").submit();
	}));
	$("#dpudtfrm").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
        	url: "dpupload.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			beforeSend : function()
			{
				//$("#preview").fadeOut();
				$("#err").fadeOut();
			},
			success: function(data)
		    {
				if(data=='invalid')
				{
					// invalid file format.
					$("#err").html("Invalid File !").fadeIn();
				}
				else
				{
					// view uploaded file.
					$("#dpcontainer").html(data).fadeIn();
					$("#dpudtfrm")[0].reset();	
				}
		    },
		  	error: function(e) 
	    	{
				$("#err").html(e).fadeIn();
				$("#err").css("color","red")
	    	} 	        
	   });
	}));
});

