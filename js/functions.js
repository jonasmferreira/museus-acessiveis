$(document).ready(function(){
	$('#normal-view').click(function(){
		$(document).find('body').attr('class','');
	});
	$('#contrast-view').click(function(){
		$(document).find('body').attr('class','contrast');
	});

	$(function() {
		controlerFontSize('#fontSize','body',2,'.fixedSize');
	});

/*
	$('#font-minus').click(function(){
		//a função para diminuir o texto
		$('.fontSize').each(function( index ) {
			//console.log( index + ": " + $( this ).css('font-size') );
			var s = $(this).css('font-size').replace('px','');
			s-=1;
			v = s+'px';
			$(this).css('font-size',v);
		});
	}).mouseover(function(){
		$(this).css('cursor','pointer');	
	}).mouseout(function(){
		$(this).css('cursor','normal');	
	});

	$('#font-plus').click(function(){
		//a função para diminuir o texto
		$('.fontSize').each(function( index ) {
			//console.log( index + ": " + $( this ).css('font-size') );
			var s = $(this).css('font-size').replace('px','');
			s+=1;
			v = s+'px';
			$(this).css('font-size',v);
		});
	}).mouseover(function(){
		$(this).css('cursor','pointer');	
	}).mouseout(function(){
		$(this).css('cursor','normal');	
	});
*/
	
	$('.event-day').mouseover(function(){
		$(this).css('cursor', 'pointer');
	});

	$('.event-day').click(function(){
		//aqui o ajax que busca a informação para exibir no hover
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
      location.href="#content-r";
    });
    shortcut.add("Ctrl+5",function() {
      location.href="#footer";
    });

	//REESCREVENDO O TABINDEX DOS ELEMTENTOS
	var idx = 1;
	$("*[tabindex]").each(function(){
		//console.log($(this).get(0), idx)
		$(this).removeAttr('tabindex').attr('tabindex',idx);
		idx++;
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
			
			console.log($(this).get(0),aIdx[1]);
			return false;
			
		});
	});
	

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
	$('#newsletter .bt-newsletter').click(function(){
		//Ajax para salvar os dados do newsletter
		$.ajax({
			type: "POST"
			,async:false
			,url: 'adm/controller/mailing.controller.php'
			,data: {
				action:'cad-mailing'
				,'mailing_nome': $('#mailing_nome').val()
				,'mailing_email': $('#mailing_email').val()
			}
			,success:function(msg){
				alert(msg);
			}
			,dataType: json
		});
	});




});

function showHideNews(){
	
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

