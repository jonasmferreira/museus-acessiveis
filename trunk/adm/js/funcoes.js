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
$(".logoff").live('click',function(){
	$.fx.speeds._default = 400;
	$('<div class="newAlert2"></div>').dialog({
		'modal':true,
		'title':'A L E R T A',
		'show': "explode",
		'hide': 'explode',
		'buttons':{
			'Sim':function(){
				window.location.href = "logoff.php";
			}
			,
			'Não': function() {
				$(this).dialog('close');
			}
		}
	}).html("Deseja realmente sair do sistema?");

});

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

(function($){
	var icons = {
		header: "ui-icon-circle-arrow-e",
		headerSelected: "ui-icon-circle-arrow-s"
	};
	$(document).ready(function(){
		$.fx.speeds._default = 500;
		$.datepicker.setDefaults($.datepicker.regional['pt-BR']);
		$( "#accordion" ).accordion({
			autoHeight: false,
			navigation: true,
			collapsible: true,
			icons: icons
		});
		if($('textarea.editor').length > 0){
			$('textarea.editor').ckeditor();
			var editor = $('textarea.editor').ckeditorGet();
			CKFinder.setupCKEditor(editor, '../lib/ckfinder/') ;
		}
		$(".telefone").setMask('phone');
		$(".inteiro").maskMoney({
			allowZero:true
			,allowNegative:true
			,defaultZero:false
			, thousands:'.'
			, decimal:','
			,precision:0
		}).addClass('al-r');
		
		$(".dinheiro").setMask('decimal');
		$(".dt").setMask('date');
		$(".hr").setMask('time');
		$(".cep").setMask('cep');
		$(".cpf").setMask('cpf');
		$(".cnpj").setMask('cnpj');
		$(".datepicker").datepicker({
			showButtonPanel: true
		});
		
		
		$('.popups').magnificPopup({
			disableOn: 700,
			type: 'iframe',
			mainClass: 'mfp-fade',
			removalDelay: 160,
			preloader: false,
			fixedContentPos: false
		});
		
		$("#antPage").click(function(){
			var pagAtual = $("#paginacao span").text();
			var pagAnterior = pagAtual-1;
			pagAnterior = (pagAnterior < 1)?1:pagAnterior;
			$("#pagePag").val(pagAnterior);
			$("#formBusca").submit();
		});
		$("#antProx").click(function(){
			var pagAtual = $("#paginacao span").text();
			var pagUlt = $(".linkPag:last").text();
			var pagProx = pagAtual+1;
			pagProx = (pagProx >pagUlt)?pagUlt:pagProx;
			$("#pagePag").val(pagProx);
			$("#formBusca").submit();
		});
		$(".linkPag").click(function(){
			var pagProx = $(this).text();
			$("#pagePag").val(pagProx);
			$("#formBusca").submit();
		});
		
		if($("#breadCrumbs").length > 0){
			var titPag = trim($("#breadCrumbs").text());
			if(titPag!=""){
				titPag = titPag.split("/");
				$("title").html("Painel Adminstrativo - "+trim(titPag[titPag.length-1]));
			}
		}
	});
})(jQuery);
