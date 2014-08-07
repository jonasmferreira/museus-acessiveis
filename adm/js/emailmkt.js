(function($){
	$(document).ready(function(){
		var dialog_disparo, form, emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
		name = $( "#nome_teste_disparo" ),
		email = $( "#email_teste_disparo" ),
		allFields = $( [] ).add( name ).add( email ),emailmkt_id_email;
		dialog_disparo = $( "#dialog-form" ).dialog({
			autoOpen: false,
			height: 300,
			width: 350,
			modal: true,
			buttons: {
				"Disparar": function(){
					$.ajax({
						type:'POST'
						,url:"controller/emailmkt.controller.php?action=disparoTeste"
						,async:false
						,data:{
							'emailmkt_id':emailmkt_id_email
							,'nome':name.val()
							,'email':email.val()
						}
						,success:function(resp){
							resp = resp.toString();
							resp = resp.split("|");
							newAlert(trim(resp[1]));

						}
					});
					dialog_disparo.dialog( "close" );
				},
				"Cancelar": function() {
					dialog_disparo.dialog( "close" );
				}
			},
			close: function() {
				$("#dialog-form form").reset();
				allFields.removeClass( "ui-state-error" );
			}
		});
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
		$(".btDisparo").click(function(){
			emailmkt_id_email = $(this).attr('rel');
			dialog_disparo.dialog('open');
		});
	});
})(jQuery);