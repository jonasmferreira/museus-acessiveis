(function($){
	$(document).ready(function(){
		
		$("#enviar").click(function(e){
			e.preventDefault();
			if(verifyObrigatorio()){
				$("#frmlogin").submit();
			}else{
				newAlert("Preencha os campos em destaque");
			}
		});
		
		$("#pass").keypress(function( e ) {
			if ( e.which == 13 ) {
				$('#enviar').click();
			}
		});		
		
	});
})(jQuery);

