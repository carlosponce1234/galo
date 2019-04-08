$(document).foundation()

$(document).ready(function(){
	$(document).on('click', '#subir-file', function(event){
		$('#e_subir').attr('style', 'background-color: #00011E; color: white;')
		$('#myform').attr('style','display:none');
		$('#pre-load').attr('style','display:block');
		//$('#myform').submit();
		//uploadFile();
		//this.reset();
	    	    });

});

