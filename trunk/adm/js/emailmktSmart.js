(function($){
	$(document).ready(function(){
		var dialog_disparo, form, emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
		name = $( "#nome_teste_disparo" ),
		email = $( "#email_teste_disparo" ),
		allFields = $( [] ).add( name ).add( email ),emailmkt_id_email;
		$( "#dialog-form-emailmkt" ).dialog({
			autoOpen: false,
			height: 300,
			width: 350,
			modal: true,
			buttons: {
				"Disparar": function(){
					$.ajax({
						type:'POST'
						,url:"controller/emailmktSmart.controller.php?action=disparoTeste"
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
					$(this).dialog( "close" );
				},
				"Cancelar": function() {
					$(this).dialog( "close" );
				}
			},
			close: function() {
				$("#nome_teste_disparo").val('');
				$("#email_teste_disparo").val('');
				//$("#dialog-form-emailmkt form").reset();
				$(this).dialog( "close" );
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
					,"controller/emailmktSmart.controller.php?action=deleteItem"
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
				,"controller/emailmktSmart.controller.php?action=removeImage"
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
			$("#dialog-form-emailmkt").dialog("open");
		});
		
		$('#emailmkt_exibe_noticia').click(function () {
			//console.log($(this).prop("checked"));
			if($(this).prop("checked")){
				$('#emailmkt_noticia_ids').addClass("obrigatorio");
			}else{
				$('#emailmkt_noticia_ids').removeClass("obrigatorio");
			}
		});		
		
		$('#emailmkt_exibe_glossario').click(function () {
			//console.log($(this).prop("checked"));
			if($(this).prop("checked")){
				$('#emailmkt_glossario_ids').addClass("obrigatorio");
			}else{
				$('#emailmkt_glossario_ids').removeClass("obrigatorio");
			}
		});		
		
		$('#emailmkt_exibe_novidade360').click(function () {
			//console.log($(this).prop("checked"));
			if($(this).prop("checked")){
				$('#emailmkt_novidade360_id').addClass("obrigatorio");
				$('#emailmkt_novidade360_ids').addClass("obrigatorio");
			}else{
				$('#emailmkt_novidade360_id').removeClass("obrigatorio");
				$('#emailmkt_novidade360_ids').addClass("obrigatorio");
			}
		});		
		
		$('#emailmkt_exibe_aquitem').click(function () {
			//console.log($(this).prop("checked"));
			if($(this).prop("checked")){
				$('#emailmkt_aqui_tem_titulo').addClass("obrigatorio");
				//$('#emailmkt_aqui_tem_thumb').addClass("obrigatorio");
				$('#emailmkt_aqui_tem_resumo').addClass("obrigatorio");
				$('#emailmkt_aqui_tem_url').addClass("obrigatorio");
				
			}else{
				$('#emailmkt_aqui_tem_titulo').removeClass("obrigatorio");
				//$('#emailmkt_aqui_tem_thumb').removeClass("obrigatorio");
				$('#emailmkt_aqui_tem_resumo').removeClass("obrigatorio");
				$('#emailmkt_aqui_tem_url').removeClass("obrigatorio");
			}
		});		
		
		$('#emailmkt_exibe_agenda').click(function () {
			//console.log($(this).prop("checked"));
			if($(this).prop("checked")){
				$('#emailmkt_agenda_ids').addClass("obrigatorio");
			}else{
				$('#emailmkt_agenda_ids').removeClass("obrigatorio");
			}
		});		

		$('#emailmkt_exibe_propaganda').click(function () {
			//console.log($(this).prop("checked"));
			if($(this).prop("checked")){
				$('#emailmkt_propaganda_url').addClass("obrigatorio");
				//$('#emailmkt_propaganda_img').addClass("obrigatorio");
			}else{
				$('#emailmkt_propaganda_url').removeClass("obrigatorio");
				//$('#emailmkt_propaganda_img').removeClass("obrigatorio");
			}
		});		

		
		$('#emailmkt_exibe_propaganda').trigger('click');
		$('#emailmkt_exibe_agenda').trigger('click');
		$('#emailmkt_exibe_aquitem').trigger('click');
		$('#emailmkt_exibe_novidade360').trigger('click');
		$('#emailmkt_exibe_glossario').trigger('click');
		$('#emailmkt_exibe_noticia').trigger('click');

	});
})(jQuery);



