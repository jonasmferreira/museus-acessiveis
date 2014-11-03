function generateUUID(){
    var d = new Date().getTime();
    var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        var r = (d + Math.random()*16)%16 | 0;
        d = Math.floor(d/16);
        return (c=='x' ? r : (r&0x7|0x8)).toString(16);
    });
    return uuid;
};
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
		$("#butAddImg").click(function(){
			var aHtml = new Array();
			var id = generateUUID();
			
			aHtml.push('<tr>');
			aHtml.push('<td>');
			aHtml.push('<input type="hidden" name="galeria_imagem_id['+id+']" value="" class="galeria_imagem_id" />');
			aHtml.push('</td>');
			aHtml.push('<td>');
			aHtml.push('<input type="text" name="galeria_imagem_titulo['+id+']" value="" class="formTxt" />');
			aHtml.push('</td>');
			aHtml.push('<td>');
			aHtml.push('<input type="text" name="galeria_imagem_descricao['+id+']" value="" class="formTxt" />');
			aHtml.push('</td>');
			aHtml.push('<td>');
			aHtml.push('<input type="file" name="galeria_imagem_arq['+id+']" value="" class="formTxt" />');
			aHtml.push('</td>');
			
			aHtml.push('<td>');
			aHtml.push('<a href="javascript:void(0);" class="btDel delImg">Excluir</a>');
			aHtml.push('</td>')
			aHtml.push('</tr>');
			$("#formCadastroImagem tbody").append(aHtml.join("\n"));
		});
		$(".delImg").live('click',function(){
			var obj = $(this);
			var id = obj.parent().parent().find(".galeria_imagem_id").val();
			if(id==""){
				obj.parent().parent().remove();
				return;
			}
			var param = {
				'galeria_imagem_id':id
			}
			deleteItem(
				"Deseja excluir essa imagem?"
				,"controller/galeria.controller.php?action=deleteItem"
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
			);
		});
		$(".btDel:not(delImg)").live('click',function(){
			var obj = $(this);
			var id = trim($(this).attr('rel'));
			var param = {
				'galeria_id':id
			}
			deleteItem(
					"Deseja excluir esse item?"
					,"controller/galeria.controller.php?action=deleteItem"
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
		
	});
})(jQuery);

