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
				'curso_id':id
			}
			deleteItem(
					"Deseja Mesmo Excluir esse Item?"
					,"controller/curso.controller.php?action=deleteItem"
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
		$("#curso_sob_demanda").click(function(){
			if($(this).prop('checked')){
				$("#curso_dt_ini").attr('disabled','disabled');
				$("#curso_dt_fim").attr('disabled','disabled');
			}else{
				$("#curso_dt_ini").removeAttr('disabled');
				$("#curso_dt_fim").removeAttr('disabled');
			}
		});
	});
})(jQuery);