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

});

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

