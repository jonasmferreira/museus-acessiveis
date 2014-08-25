(function($){
	$(document).ready(function(){
		$("#filtrar").click(function(){
			$("#formbusca").submit();
		});
		$("#salvar").click(function(){
			if(verifyObrigatorioForm("#formSalvar")){
				$("#formSalvar").submit();
			}else{
				newAlert("Preencha os campos em destaque");
			}
		});
		$(".btDel").live('click',function(){
			var obj = $(this);
			var id = trim($(this).attr('rel'));
			var param = {
				'release_id':id
			}
			deleteItem(
					"Deseja excluir esse Item?"
					,"controller/release.controller.php?action=deleteItem"
					,param
					,function(msg,oDialog){
						oDialog.dialog('close');
						oDialog.dialog('destroy');
						obj.parent().parent().remove();
						newAlert(msg);
					}
					,function(msg,oDialog){
						oDialog.dialog('close');
						oDialog.dialog('destroy');
						newAlert(msg);
					}
			)
		});
		
		$(".delImg").click(function(){
			var obj = $(this);
			var img = $(this).attr('rel');
			var id = $("#release_id").val();
			
			var param = {
				'release_id':id
				,'img':img
			}
			deleteItem(
					"Deseja remover essa imagem?"
					,"controller/release.controller.php?action=removeImage"
					,param
					,function(msg,oDialog){
						oDialog.dialog('close');
						oDialog.dialog('destroy');
						obj.parent().parent().find('.images').remove();
						obj.parent().remove();
						newAlert(msg);
					}
					,function(msg,oDialog){
						oDialog.dialog('close');
						oDialog.dialog('destroy');
						newAlert(msg);
					}
			)
		});
		
		$('#release_exibir_banner').click(function () {
			//console.log($(this).prop("checked"));
			if($(this).prop("checked")){
				$('#release_banner_desc').removeAttr('readonly');
			}else{
				$('#release_banner_desc').attr('readonly','yes');
			}
			
		});		

		$('#release_exibir_destaque_home').click(function () {
			//console.log($(this).prop("checked"));
			if($(this).prop("checked")){
				$('#release_destaque_home_desc').removeAttr('readonly');
				$('#release_destaque_home_frase').removeAttr('readonly');
			}else{
				$('#release_destaque_home_desc').attr('readonly','yes');
				$('#release_destaque_home_frase').attr('readonly','yes');
			}
			
		});		


		
	});
	
})(jQuery);