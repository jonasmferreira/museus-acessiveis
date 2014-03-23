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
				'agenda_id':id
			}
			deleteItem(
					"Deseja excluir esse Item?"
					,"controller/agenda.controller.php?action=deleteItem"
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
		$("#agenda_sob_demanda").click(function(){
			if($(this).prop('checked')){
				$("#agenda_dt_ini").attr('disabled','disabled');
				$("#agenda_dt_fim").attr('disabled','disabled');
			}else{
				$("#agenda_dt_ini").removeAttr('disabled');
				$("#agenda_dt_fim").removeAttr('disabled');
			}
		});
		
		$(".delImg").click(function(){
			var obj = $(this);
			var img = $(this).attr('rel');
			var id = $("#agenda_id").val();
			
			var param = {
				'agenda_id':id
				,'img':img
			}
			deleteItem(
					"Deseja remover essa imagem?"
					,"controller/agenda.controller.php?action=removeImage"
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
	});
})(jQuery);