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
				'emailmkt_id':id
			}
			deleteItem(
					"Deseja excluir esse item?"
					,"controller/emailmkt.controller.php?action=deleteItem"
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
			var id = $("#emailmkt_id").val();
			
			var param = {
				'emailmkt_id':id
				,'img':img
			}
			deleteItem(
					"Deseja remover essa imagem?"
					,"controller/emailmkt.controller.php?action=removeImage"
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