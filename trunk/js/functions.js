function gerarCalendario(mes,ano,tipoMes){
	$.ajax({
		type:"POST"
		,url: linkAbsolute+'adm/controller/agenda.controller.php'
		,'data':{
			'tipoMes':tipoMes
			,'mes':mes
			,'ano':ano
			,'action':'getAgendaGeral'
		}
		,success:function(resp){
			resp = $.trim(resp);
			if(resp!=""){
				$("#calendar").html(resp);
			}
		}
	});
}
jQuery.fn.validacnpj = function(){
	CNPJ = $(this).val();
	if(!CNPJ){return false;}
	erro = new String;
	if(CNPJ == "00.000.000/0000-00"){erro += "CNPJ inválido\n\n";}
	CNPJ = CNPJ.replace(".","");
	CNPJ = CNPJ.replace(".","");
	CNPJ = CNPJ.replace("-","");
	CNPJ = CNPJ.replace("/","");

	var a = [];
	var b = new Number;
	var c = [6,5,4,3,2,9,8,7,6,5,4,3,2];
	for(i=0; i<12; i++){
		a[i] = CNPJ.charAt(i);
		b += a[i] * c[i+1];
	}
	if((x = b % 11) < 2){
		a[12] = 0
	}else{
		a[12] = 11-x
	}
	b = 0;
	for(y=0; y<13; y++){
		b += (a[y] * c[y]);
	}
	if((x = b % 11) < 2){
		a[13] = 0;
	}else{
		a[13] = 11-x;
	}
	if((CNPJ.charAt(12) != a[12]) || (CNPJ.charAt(13) != a[13])){erro +="Dígito verificador com problema!";}
	if (erro.length > 0){
		return false;    
	}
	return true;
}


jQuery.fn.validacpf = function(){
	CPF = $(this).val();
	if(!CPF){return false;}
	erro  = new String;
	cpfv  = CPF;
	if(cpfv.length == 14 || cpfv.length == 11){
		cpfv = cpfv.replace('.', '');
		cpfv = cpfv.replace('.', '');
		cpfv = cpfv.replace('-', '');

		var nonNumbers = /\D/;

		if(nonNumbers.test(cpfv)){
			erro = "A verificacao de CPF suporta apenas números!";
		}else{
			if (cpfv == "00000000000" ||
				cpfv == "11111111111" ||
				cpfv == "22222222222" ||
				cpfv == "33333333333" ||
				cpfv == "44444444444" ||
				cpfv == "55555555555" ||
				cpfv == "66666666666" ||
				cpfv == "77777777777" ||
				cpfv == "88888888888" ||
				cpfv == "99999999999") {

				erro = "Número de CPF inválido!"
			}
			var a = [];
			var b = new Number;
			var c = 11;

			for(i=0; i<11; i++){
				a[i] = cpfv.charAt(i);
				if (i < 9) b += (a[i] * --c);
			}
			if((x = b % 11) < 2){
				a[9] = 0
			}else{
				a[9] = 11-x
			}
			b = 0;
			c = 11;
			for (y=0; y<10; y++) b += (a[y] * c--);

			if((x = b % 11) < 2){
				a[10] = 0;
			}else{
				a[10] = 11-x;
			}
			if((cpfv.charAt(9) != a[9]) || (cpfv.charAt(10) != a[10])){
				erro = "Número de CPF inválido.";
			}
		}
	}else{
		if(cpfv.length == 0){
			return false;
		}else{
			erro = "Número de CPF inválido.";
		}
	}
	if (erro.length > 0){
		return false;
	}
	return true;

}
function trim(txt){
	return $.trim(txt);
}
function currencyBR2US(valor){
	valor = valor.toString();
	valor = valor.replace('.', '');
	valor = valor.replace(',', '.');
	valor = valor * 1;
	return valor.toFixed(2);
}
function imageControllers(cellvalue, options, rowObject){
	var params = new Array();
	var aImg = new Array();
	params.push(options.gid);
	params.push(options.rowId);
	aImg.push("<img src='img/icon_editar.gif' attr='"+params.join(";")+"' class='editItem' style='cursor:pointer' alt='Editar' title='Editar'/>");
	aImg.push("<img src='img/icon_delete.gif' attr='"+params.join(";")+"' class='deleteItem' style='cursor:pointer' alt='Excluir' title='Excluir'/>");
	return aImg.join("");
}
var newAlert = function(mensagem,tempo,url){
	tempo = (tempo == undefined) ? 400 : tempo;
	url = (url == undefined) ? false : url;
	$.fx.speeds._default = tempo;
	jQuery('<div class="newAlert"></div>').dialog({
		'modal':true,
		'title':'A L E R T A',
		'show': "explode",
		'hide': 'explode',
		'buttons':{
			'OK':function(){
				$(this).dialog('destroy');
				window.setTimeout(function(){
					$(".newAlert").remove();
					if(url!=false){
						window.location.href=url;
					}
				},300);
			}
		}
	}).html(mensagem);
}
var verImagem = function(urlImagem,url_exclusao,idImg,callbackSuccess,callbackError){
	var bCallSuccess = true;
	var bCallError = true;
	if(callbackSuccess!=undefined){
		if (typeof callbackSuccess !== 'function') {
			bCallSuccess = false;
		}
	}else{
		bCallSuccess = false;
	}
	if(callbackError!=undefined){
		if (typeof callbackError !== 'function') {
			bCallError = false;
		}
	}else{
		bCallError = false;
	}
	var tempo = 400;
	$.fx.speeds._default = tempo;
	var di = jQuery('<div class="verImagem"></div>').dialog({
		'modal':true,
		'title':'Visualização de Imagem',
		'height':'auto',
		'width':'auto',
		'show': "explode",
		'hide': 'explode',
		'autoOpen':false,
		'buttons':{
			'OK':function(){
				$(this).dialog('close');
				$(this).dialog('destroy');
			}
			,'Excluir Imagem':function(){
				var objDialog = $(this);
				$.ajax({
					type:'POST'
					,url:url_exclusao
					,async:false
					,data:{
						'id':idImg
					}
					,success:function(resp){
						resp = resp.toString();
						resp = resp.split("|");
						if($.trim(resp[0])=='CMD_SUCCESS'){
							if(bCallSuccess){
								callbackSuccess(resp[1],objDialog);
							}else{
								$(this).dialog('close');
								$(this).dialog('destroy');
							}
						}else{
							if(bCallError){
								callbackError(resp[1],objDialog);
							}else{
								$(this).dialog('close');
								$(this).dialog('destroy');
							}
						}
					}
				});
			}
		}
	}).html('<img src="'+urlImagem+'" alt="imagem" style="border:none" />');
	window.setTimeout(function(){
		di.dialog('open');
	},500);
}
var newAlertSubmit = function(id_form,mensagem){
	var tempo = 400;
	$.fx.speeds._default = tempo;
	jQuery('<div class="newAlert"></div>').dialog({
		'modal':true,
		'title':'A L E R T A',
		'show': "explode",
		'hide': 'explode',
		'buttons':{
			'OK':function(){
				$(this).dialog('destroy');
				window.setTimeout(function(){
					$(".newAlert").remove();
					id_form.submit();
				},300);
			}
		}
	}).html(mensagem);
}


var popup = function(mensagem,titulo,tempo){
	tempo = (tempo == undefined) ? 400 : tempo;
	$.fx.speeds._default = tempo;
	var di = jQuery('<div class="popup"></div>').dialog({
		'modal':true,
		'title':titulo,
		'show': "explode",
		'hide': 'explode',
		'width':450,
		'height':450,
		'buttons':{
			'OK':function(){
				$(this).dialog('destroy');
				window.setTimeout(function(){
					$(".popup").remove();
				},300);
			}
		}
	}).html('<div style="text-align:center">'+mensagem+'</div>');
}

function soNumeros(v){
	v = v.toString();
	return v.replace(/\D/g,"")
}

function verifyObrigatorio(){
	if(jQuery(".obrigatorio").length > 0){
		jQuery(".obrigatorio").removeClass('error');
		var obj;
		var qtd = 0;
		jQuery(".obrigatorio").each(function(){
			obj = jQuery(this);
			if(jQuery.trim(obj.val())==''){
				obj.addClass("error");
				qtd++;
			}
		});
		return (qtd > 0)?false:true;
	}else{
		return true;
	}
}
function verifyObrigatorioForm(formulario){
	if(jQuery(formulario+" .obrigatorio").length > 0){
		jQuery(formulario+" .obrigatorio").removeClass('ui-state-error');
		var obj;
		var qtd = 0;
		jQuery(formulario+" .obrigatorio").each(function(){
			obj = jQuery(this);
			if(jQuery.trim(obj.val())==''){
				obj.addClass("ui-state-error");
				qtd++;
			}
		});
		return (qtd > 0)?false:true;
	}else{
		return true;
	}
}
function limparCampos(obj){
	obj.find('select').find('option:first').attr('selected','selected');
	obj.find('input[type=text]').val('');
	obj.find('input[type=file]').val('');
	obj.find('input[type=password]').val('');
	obj.find('textarea').val('');
}

function deleteItem(mensagem,url,param,callbackSuccess,callbackError){
	var bCallSuccess = true;
	var bCallError = true;
	if(callbackSuccess!=undefined){
		if (typeof callbackSuccess !== 'function') {
			bCallSuccess = false;
		}
	}else{
		bCallSuccess = false;
	}
	if(callbackError!=undefined){
		if (typeof callbackError !== 'function') {
			bCallError = false;
		}
	}else{
		bCallError = false;
	}
	var tempo = 400;
	$.fx.speeds._default = tempo;
	var di = jQuery('<div class="deleteItem"></div>').dialog({
		'modal':true,
		'title':"Confirme a Exclusão",
		'show': "explode",
		'hide': 'explode',
		'buttons':{
			'OK':function(){
				var objDialog = $(this);
				$.ajax({
					type:'POST'
					,url:url
					,async:false
					,data:param
					,success:function(resp){
						resp = resp.toString();
						resp = resp.split("|");
						if(trim(resp[0])=='CMD_SUCCESS'){
							if(bCallSuccess){
								callbackSuccess(resp[1],objDialog);
							}else{
								objDialog.dialog('close');
								objDialog.dialog('destroy');
							}
						}else{
							if(bCallError){
								callbackError(resp[1],objDialog);
							}else{
								objDialog.dialog('close');
								objDialog.dialog('destroy');
							}
						}
						
					}
				});
			}
			,'Cancelar':function(){
				$(this).dialog('destroy');
				window.setTimeout(function(){
					$(".deleteItem").remove();
				},300);
			}
		}
	}).html('<div style="text-align:center">'+mensagem+'</div>');
}


$(document).ready(function(){
	var dialog_disparo, form, emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
	name = $( "#nome_amigo" ),
	email = $( "#email_amigo" ),
	name2 = $( "#nome" ),
	email2 = $( "#email" ),
	urlsend = $( "#urlsend" ),
	allFields = $( [] ).add( name ).add( email ).add( name2 ).add( email2 ).add( urlsend ),id_not;
	$( "#dialog-form-send-to-friend" ).dialog({
		autoOpen: false,
		height: 400,
		width: 430,
		modal: true,
		buttons: {
			"Disparar": function(){
				$.ajax({
					type:'POST'
					,url:linkAbsolute+"adm/controller/emailmktSmart.controller.php?action=sendToAFriend"
					,async:false
					,data:{
						'ids':id_not
						,'nome':name.val()
						,'email':email.val()
						,'nome_amigo':name2.val()
						,'email_amigo':email2.val()
						,'urlsend':urlsend.val()
					}
					,success:function(resp){
						resp = resp.toString();
						resp = resp.split("|");
						newAlert(trim(resp[1]));
					}
					,error:function(resp){
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
			$("#nome_amigo").val('');
			$("#email_amigo").val('');
			$("#nome").val('');
			$("#email").val('');
			id_not="";
			//$("#dialog-form-emailmkt form").reset();
			$(this).dialog( "close" );
			allFields.removeClass( "ui-state-error" );
		}
	});
	
	
	if($(".novidade360Content").length > 0)
		$('.novidade360Content').glossary(linkAbsolute+'adm/controller/glossario.controller.php?action=generateGlossary');
	
	$('#normal-view').click(function(){
		$(document).find('body').attr('class','');
	});
	$('#contrast-view').click(function(){
		$(document).find('body').attr('class','contrast');
	});

	$(function() {
		controlerFontSize('#fontSize','body',2,'.fixedSize');
	});

	$('.event-day').live('mouseover',function(){
		$(this).css('cursor', 'pointer');
		
		var obj = $(this);
		$('.event-info').addClass("hidden");
		obj.find('.event-info').removeClass("hidden");
	});

	$('.event-day').live('mouseout',function(){
		$(this).css('cursor', 'normal');
		var obj = $(this);
		obj.find('.event-info').delay(5000).addClass("hidden");
	});

	//ACESSIBILIDADE POR TECLADO
    shortcut.add("Ctrl+1",function() {
      location.href="#access-bar";
    });
    shortcut.add("Ctrl+2",function() {
      location.href="#menu";
    });
    shortcut.add("Ctrl+3",function() {
      location.href="#content";
    });
    shortcut.add("Ctrl+4",function() {
      location.href="#footer";
    });

	//CONTROLANDO O OUTDOOR
	$('#outdoor #item-box #outdoor-lista li a').each(function(){
		$(this).click(function(){
			
			var idItem = $(this).attr('id');
			var aIdx = idItem.split('_');
			idItem = aIdx[1];
			
			$('#outdoor #item-box #item img').each(function(){
				$(this).css('display','none');
			});
			$('#outdoor #item-box #item dl').each(function(){
				$(this).css('display','none');
			});
			
			$('#outi_'+idItem).css('display','block');
			$('#outdd_'+idItem).css('display','block');
			return false;
			
		});
	});
	
	//Controlando a listagem de novidades
	$('.news-list').click(function(){
		var obj = $(this).parent().parent().find('div:first');
		if(obj.hasClass('inactive')){
			obj.removeClass('inactive')
		}else{
			obj.addClass('inactive')
		}
		return false;
	});
	
	//selecionando o conteúdo do campo no focus
	$('input.field').focus(function(){
		$(this).select();
	})

	//Cadastrando os dados de Mailing
	$('#newsletter .bt-newsletter').click(function(e){
		e.preventDefault();
		//Ajax para salvar os dados do newsletter
		$.ajax({
			type: "POST"
			,async:false
			,url: linkAbsolute+'adm/controller/mailing.controller.php'
			,data: {
				action:'cad-mailing'
				,'mailing_nome': $('#mailing_nome').val()
				,'mailing_email': $('#mailing_email').val()
			}
			,success:function(msg){
				if(msg.success){
					$('#mailing_nome').val('');
					$('#mailing_email').val('');
				}
				newAlert(msg.msg);
			}
			,dataType: 'json'
		});
	});
	
	$(".glossario_def").click(function(e){
		var id = $(this).attr("glossario_id");
		e.preventDefault();
		$.ajax({
			type: "POST"
			,async:false
			,url: linkAbsolute+'adm/controller/glossario.controller.php'
			,data: {
				action:'getOne'
				,'glossario_id':id
			}
			,success:function(msg){
				popup(msg.glossario_conteudo,"Glossário: "+msg.glossario_palavra,400);
			}
			,dataType: 'json'
		});
	});

	//Formulário de busca
	$('#search .bt-search').click(function(e){
		e.preventDefault();
		window.location.href=linkAbsolute+'busca/'+$('#busca_texto').val()
	});

	$("#mes_anterior").live('click',function(){
		var obj = $(this);
		gerarCalendario(obj.attr("mes"),obj.attr("ano"),"mes_anterior");
	});
	$("#mes_posterior").live('click',function(){
		var obj = $(this);
		gerarCalendario(obj.attr("mes"),obj.attr("ano"),"mes_posterior");
	});
	if($('.atento-item ul').length > 0){
		//SLIDER do Fique Atento
		$('.atento-item ul').cycle({
			fx:      'scrollLeft'
			,speed:    1000
			,timeout:  3000
		});
	}
	if($('.depoimento-box ul').length > 0){
		//SLIDER do Depoimentos
		$('.depoimento-box ul').cycle({
			fx:      'scrollLeft'
			,speed:    1000
			,timeout:  5000
		});
	}
	
	//controlando tamanho dos conteudos (content-r e content-l)
	if($('#content').length > 0){
		resizeContent();
	}

	//REESCREVENDO O TABINDEX DOS ELEMTENTOS
	var idx = 1;
	$("*[tabindex]").each(function(){
		//console.log($(this).get(0), idx)
		$(this).removeAttr('tabindex').attr('tabindex',idx);
		idx++;
	});
	
	//recarregando os downloads na ordem desejada
	$(".down_ordem").click(function(){
		var val = '';
		var downPage = '';
		var downId = 0;
		var urlController = '';
		
		downPage = $('table#list').attr('downpage');
		downId = $('table#list').attr('downid');
		urlController = linkAbsolute + 'adm/controller/'+ downPage + '.controller.php';

		val = $('table#list thead tr td a span').text();
		$('table#list thead tr td a span').parent().html(val);

		val = $(this).html();
		$(this).html('<span>'+val+'</span>');



		//Ajax para recarregar a tabela de downloads
		$.ajax({
			type: "POST"
			,async:false
			,url: urlController
			,data: {
				action:'down-order'
				,'order_field': $(this).parent('td').attr('id')
				,'linkAbsolute': linkAbsolute
				,'downPage': downPage
				,'downId': downId
			}
			,success:function(msg){
				if(msg.success){
					$('table#list tbody').html(msg.rows);
				}else{
					alert('Ocorreu um erro, por favor, tente novamente!');
				}
			}
			,dataType: 'json'
		});
		
		
	});
	
	
	//Adicionando aos favoritos
	$('#bookmarkme').click(function(){
		alert('Pressione ' + (navigator.userAgent.toLowerCase().indexOf('mac') != - 1 ? 'Command/Cmd' : 'CTRL') + ' + D para adicionar esta página aos seus Favoritos.');
	});	
	
	//corrigindo bug de exibição das listas (novidades, projetos, cursos etc ao expandir um mês oculto
	$('.month-list a.news-list').click(function(){
		resizeContentList();
	});
	
	//Navegando na galeria de imagens
	$('#galeria-prev').click(function(){
		var pos = parseInt($('#img-pos').html());
		var tot = parseInt($('#img-count').html());
		var newPos = pos-1;
		if(pos>1){
			
			$('#galeria-next').css('display','block');
			
			$('#gal-item_'+pos).removeClass('show');
			$('#gal-item_'+pos).addClass('hide');
			$('#gal-item_'+newPos).removeClass('hide');
			$('#gal-item_'+newPos).addClass('show');
			
			$('#gal-info_'+pos).removeClass('show');
			$('#gal-info_'+pos).addClass('hide');
			$('#gal-info_'+newPos).removeClass('hide');
			$('#gal-info_'+newPos).addClass('show');
		
			$('#img-pos').html(newPos);
			
		}else{
			$('#galeria-next').css('display','none');
		}
		
		if(newPos==1){
			$('#galeria-prev').css('display','none');			
		}
		
	});

	$('#galeria-next').click(function(){
		var pos = parseInt($('#img-pos').html());
		var tot = parseInt($('#img-count').html());
		var newPos = pos+1;
		if(pos<tot){
			
			$('#galeria-prev').css('display','block');
			
			$('#gal-item_'+pos).removeClass('show');
			$('#gal-item_'+pos).addClass('hide');
			$('#gal-item_'+newPos).removeClass('hide');
			$('#gal-item_'+newPos).addClass('show');
			
			$('#gal-info_'+pos).removeClass('show');
			$('#gal-info_'+pos).addClass('hide');
			$('#gal-info_'+newPos).removeClass('hide');
			$('#gal-info_'+newPos).addClass('show');
		
			$('#img-pos').html(newPos);
			
		}else{
			$('#galeria-next').css('display','none');
		}

		if(newPos==tot){
			$('#galeria-next').css('display','none');			
		}

	});
	
	$('#sendmail').click(function(){
	//alert('Tchoi, finaliza esta parte, please!');
		$("#urlsend").val(window.location.href);
		id_not = $(this).data('id');
		$("#dialog-form-send-to-friend").dialog("open");
	});
	

});

function resizeContent(){
	$('#content-l').css('display','block');
	$('#content-l').css('overflow','visible');
	var cr = $('#content-r').css('height');
	var cl = $('#content').css('height');
	
	cr=cr.split('px');
	tr=parseInt(cr[0]);
	cl=cl.split('px');
	tl=parseInt(cl[0]);

	if(tl <= tr){
		$('#content').css('height',tr+'px');
	}
	$('#content').css('overflow','visible');
	//$('#content').css('height','auto');

}

function resizeContentList(){
	$('#content').css('overflow','visible');
	$('#content').css('height','auto');

	$('#content-l').css('display','block');
	$('#content-l').css('overflow','visible');
	var cr = $('#content-r').css('height');
	var cl = $('#content').css('height');
	
	cr=cr.split('px');
	tr=parseInt(cr[0]);
	cl=cl.split('px');
	tl=parseInt(cl[0]);

	if(tl <= tr){
		$('#content').css('height',tr+'px');
	}
	$('#content').css('overflow','visible');

}



function controlerFontSize(obj,container,multipleSize,dontChangeMe){
	//inicializo os valores
	var lastSize = 0;
	var size = 0;
 
	$(obj).find('a').click(function(){
		//guardo todos os objetos da lista
		var objs = $(this).parents(obj).find(this.tagName);
		//guardo o indice do intem selecionado
		var actualIndex = $(objs).index(this);
		//guardo na variavel size o tamanho selecionado
		for(var i=0; i<objs.length; i++){
			if(actualIndex > $(objs).index($(objs).eq(i)))
				size = size + multipleSize;
		}
 
		//altero o valor do font size subtraindo o ultimo valor
		$(container).find('*:not(dontChangeMe *)').animate({
					fontSize: '+=' + (size - lastSize) + 'px'
		},'fast')
 
				//atualizo as variaveis
		lastSize = size;
		size = 0;
	})
}



function fontRezise(a, padrao, min, max) {
	var min = min || 8, max = max || 17, d = padrao || 11;
	var o = getElementsByClassName('fontSize');
	for(i = o.length; i--;) {
		for(var j = o[i].getElementsByTagName("*"), c = j.length; c--;) {
			var e = j[c], s = e.style.fontSize ? +e.style.fontSize.replace("px","") : d;
			a && (s < max) ? s++ : !a && (s > min && s--);
			e.style.fontSize = s + "px";
		}
	}
	window.SimpleScroll && window.SimpleScroll.refresh();
}

