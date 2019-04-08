$(document).foundation()

$(document).ready(function(){
	$(document).on('click', '#subir-file', function(event){
		$('#e_subir').attr('class', 'loader')
		$('#myform').attr('style','display:none');
		$('#trert').attr('style','display:none');
		$('#pre-load').attr('style','display:block');

		//$('#myform').submit();
		//uploadFile();
		//this.reset();
	    	    });

});

