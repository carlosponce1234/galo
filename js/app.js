$(document).foundation()

$(document).ready(function(){
	$(document).on('submit', '#myform', function(event){
		$('#myform').attr('style','display:none');
		$('#pre-load').attr('style','display:block');
		//uploadFile();
		//this.reset();
	    	    });

});

