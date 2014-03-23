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
				'novidade_360_id':id
			}
			deleteItem(
					"Deseja excluir esse Item?"
					,"controller/novidade.controller.php?action=deleteItem"
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
		$("#novidade_360_exibir_banner").click(function(){
			if($(this).prop('checked')){
				$("#novidade_360_banner").removeAttr('disabled');
				$("#novidade_360_thumb_desc").removeAttr('disabled');
			}else{
				$("#novidade_360_banner").attr('disabled','disabled');
				$("#novidade_360_thumb_desc").attr('disabled','disabled');
			}
		});

		$("#novidade_360_exibir_destaque_home").click(function(){
			if($(this).prop('checked')){
				$("#novidade_360_destaque_home").removeAttr('disabled');
				$("#novidade_360_destaque_home_desc").removeAttr('disabled');
				$("#novidade_360_destaque_home_frase").removeAttr('disabled');
			}else{
				$("#novidade_360_destaque_home").attr('disabled','disabled');
				$("#novidade_360_destaque_home_desc").attr('disabled','disabled');
				$("#novidade_360_destaque_home_frase").attr('disabled','disabled');
			}
		});
		
		$("#novidade_360_exibir_banner").click();
		$("#novidade_360_exibir_destaque_home").click();
		
	});
	
})(jQuery);