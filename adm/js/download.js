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
				'download_id':id
			}
			deleteItem(
					"Deseja excluir esse item?"
					,"controller/download.controller.php?action=deleteItem"
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
		
		$('#download_tipo').change(function() {
			//Link de Internet
			if($(this).val()!=7){
				$("#download_link").attr('disabled','disabled');
			}else{
				$("#download_link").removeAttr('disabled');
			}
		});
		$('#download_tipo').change();
		
	});
})(jQuery);

