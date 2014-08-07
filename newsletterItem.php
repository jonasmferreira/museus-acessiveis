<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php
		//configuração de url absoluta
		include_once("{$path_root_page}adm{$DS}class{$DS}configuracao.class.php");
		$objConfig = new configuracao();
		$aConfig = $objConfig->getOne();

		//$objConfig->debug($aConfig);
		$linkAbsolute=$aConfig['configuracao_baseurl'];
		$seqAleatoria = "rnd=".str_replace(".","",microtime(true));

		$author = $aConfig['configuracao_meta_author'];
		$keywords = $aConfig['configuracao_meta_keywords'];
		$description = $aConfig['configuracao_meta_description'];

	?>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Museus Acessíveis</title>

	<meta name="description" content="<?=$description;?>">
	<meta name="keywords" content="<?=$keywords;?>">
	<meta name="author" content="<?=$author;?>">

	<link rel="shortcut icon" href="<?=$linkAbsolute?>img/favicon.ico?<?=$seqAleatoria?>" type="image/x-icon" />
	<link rel="stylesheet" href="<?=$linkAbsolute?>plugins/lightbox/css/lightbox.css?<?=$seqAleatoria?>" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?=$linkAbsolute?>css/newsletter.css?<?=$seqAleatoria?>" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?=$linkAbsolute?>plugins/css/south-street/jquery-ui-1.10.4.custom.min.css?<?=$seqAleatoria?>" />
	<script src="<?=$linkAbsolute?>plugins/jquery-1.10.2.min.js?<?=$seqAleatoria?>"></script>
	<script src="<?=$linkAbsolute?>plugins/jquery-migrate.js?rnd=<?=$seqAleatoria?>" type="text/javascript"></script>
	<script src="<?=$linkAbsolute?>plugins/lightbox/js/lightbox-2.6.min.js?<?=$seqAleatoria?>"></script>

	<script src="<?=$linkAbsolute?>plugins/shortcut.js?<?=$seqAleatoria?>"></script>
	<script src="<?=$linkAbsolute?>plugins/cookie.js?<?=$seqAleatoria?>"></script>
	<script src="<?=$linkAbsolute?>plugins/fontSize.js?<?=$seqAleatoria?>"></script>
	<script src="<?=$linkAbsolute?>plugins/jquery-ui-1.10.4.custom.min.js?rnd=<?=$seqAleatoria?>" type="text/javascript"></script>
	<script src="<?=$linkAbsolute?>plugins/jquery-ui-i18n.js?rnd=<?=$seqAleatoria?>" type="text/javascript"></script>
	<script src="<?=$linkAbsolute?>plugins/jquery-ui-timepicker-addon.js?rnd=<?=$seqAleatoria?>" type="text/javascript"></script>
	<script src="<?=$linkAbsolute?>plugins/jquery.cycle.all.js?rnd=<?=$seqAleatoria?>" type="text/javascript"></script>
	<script type="text/javascript">
		linkAbsolute = '<?=$linkAbsolute?>';
	</script>
	<script src="<?=$linkAbsolute?>js/functions.js?<?=$seqAleatoria?>"></script>

</head>

<body>
<div id="root">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
    	<tr>
        	<td align="center" class="news-info" height="30">
            	Se você não consegue visualizar este e-mail, <a href="#" target="_blank">clique aqui!</a>
            </td>
        </tr>
    </table>

	<!-- ACCESSBAR -->
	<div href="access-bar" accesskey="1" id="access-bar" class="fixedSize">
    	<span class="title fixedSize" style="padding-right:30px;">opções de acessibilidade</span>

    	<span class="title fixedSize">tipo de contraste:</span>
    	<span class="option fixedSize"><a id="normal-view" href="javascript:void(0);" tabIndex="1">Contraste Padrão</a></span>
    	<span class="option fixedSize"><a id="contrast-view" href="javascript:void(0);" tabIndex="2">Contraste Invertido</a></span>

    	<span class="title fixedSize">tamanho da fonte</span>
        <p id="fontSize">
            <span class="option"><a tabIndex="3" href="javascript:void(0);" id="font-minus">A-</a></span>
            <span class="option"><a tabIndex="4" href="javascript:void(0);" id="font-plus">A+</a></span>
        </p>
    </div>
	
<div id="header">
	<table border="0" cellpadding="0" cellspacing="0" width="654">
	  <tr>
        	<td width="248" valign="middle" align="right"><img src="img/emkt_logo_museus.png" width="248" height="255"  alt="Museus Acessíveis - Cultura + Acessibilidade 360º" title="Museus Acessíveis - Cultura + Acessibilidade 360º"/></td>
        <td class="title" valign="middle" align="center">
        	<span id="edicao"><a href="#" target="_blank">Edição Junho | 2014</a></span>
        </td>
      </tr>
   		
    </table>
</div>
	
<div id="project">
	<div class="outdoor">
    	<img src="img/emkt_projeto_img.jpg" width="569" height="227"  alt=""/>
	</div>
    <h1 class="project-title">Título do projeto</h1>
    <div class="description">
<p>O MAM oferece dispositivos acessíveis para pessoas com deficiência. Nas exposições as pessoas com deficiência visual podem realizar visitas com audiodescrição, através do audioguia, ou acompanhados por educadores preparados para recebê-los. Além disso, há obras em exposição podem ser tocadas mediante acompanhamento e uso de luvas.</p>
<p>As pessoas surdas podem fazer visitas educativas agendadas em Libras com educador surdo ou utilizando o videoguia em Libras disponível na recepção.
A programação de cursos do museu oferece oportunidades inclusivas nas áreas de artes, história e crítica de arte.</p>
<p>Na exposição em cartaz “A Vontade Construtiva na Coleção Fadel” há esculturas e relevos de artistas brasileiros concretos e neoconcretos para serem apreciados pelo tato sob orientação de educadores do museu. </p>
<p>Os audioguias com audiodescrição das exposições do MAM são elaborados pela Museus Acessíveis desde 2009 e a seleção de obras para toque são selecionadas pela equipe educativa do museu em conjunto com a Museus Acessíveis e aprovação do departamento de acervo do museu ou do responsável pela coleção particular em cartaz.</p>    
    <a href="#" class="saibamais">Leia mais</a>
    </div>
  </div>   
  <img class="separator" src="img/emkt_bg_separator.png" width="564" height="19"  alt=""/> 
<div id="acessibilidade">
	<div class="box">
    	<div class="word-box">
        	<h2 class="word">Acessibilidade</h2>
            <p class="description">
O MAM oferece dispositivos acessíveis para pessoas com deficiência. Nas exposições as pessoas com deficiência visual podem realizar visitas com audiodescrição, através do audioguia, ou acompanhadospor educadores preparados para recebê-los. Além disso...há obras em exposição podem ser tocadas mediante acompanhamento e uso de luvas.
            </p>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
        	<tr>
            	<td align="center">
    				<a href="#" class="glossario">Conheça o Glossário da Acessibilidade</a>
                </td>
            </tr>
        </table>
        </div>
    </div>
</div> 
<img class="separator" src="img/emkt_bg_separator.png" width="564" height="19"  alt=""/> 
<div id="news">
	<h1 class="news-title">Novidades 360º</h1>
    <table cellpading="0" cellspacing="0" border="0" width="87%">
    	<tr>
        	<td colspan="2">&nbsp;</td>
        </tr>
      <tr>
        	<td width="171" align="left" valign="top">
       	  <img src="img/emkt_news360_imagem.jpg" alt="" width="158" height="157"/></td>
        	<td width="403" class="news-resumo">
            	<h3 class="title">Reatec apresenta novos produtose discute conceitos sobre deficiência</h3>
				<br class="clear" />
                <p class="description">
O MAM oferece dispositivos acessíveis para pessoas com deficiência. Nas exposições as pessoas com deficiência visual podem realizar visitas. O MAM oferece dispositivos acessíveis para pessoas com deficiência. Nas exposições as pessoas com deficiência visual podem realizar visitas.                
                </p>
				<a href="#" class="saibamais">Saiba mais</a>                
            </td>
      </tr>
        <tr>
        	<td>&nbsp;</td>
            <td align="left" valign="top">
                <ul class="news-list">
                	<li>
                        <h3 class="title">
                        	<a href="#">Reatec apresenta novos produtose discute conceitos sobre deficiência</a>
                        </h3>                    
                    </li>
                	<li>
                        <h3 class="title">
                        	<a href="#">Reatec apresenta novos produtose discute conceitos sobre deficiência</a>
                        </h3>                    
                    </li>
                </ul>
                <br class="clear" />            
				<a href="#" class="saibamais">Mais novidades</a>
            </td>
        </tr>
    </table>
</div>
<img class="separator" src="img/emkt_bg_separator.png" width="564" height="19"  alt=""/>
<div id="aquitem">
	<h1 class="news-title">Aqui tem Acessibilidade</h1>
    <table cellpading="0" cellspacing="0" border="0" width="87%">
    	<tr>
        	<td colspan="2">&nbsp;</td>
        </tr>
      <tr>
        	<td width="185" align="left" valign="top">
       	  <img src="img/emkt_aquitem_imagem.jpg" alt="" /></td>
        	<td width="362" class="news-resumo">
            	<h3 class="title">Reatec apresenta novos produtose discute conceitos sobre deficiência</h3>
				<br class="clear" />
                <p class="description">
O MAM oferece dispositivos acessíveis para pessoas com deficiência. Nas exposições as pessoas com deficiência visual podem realizar visitas. O MAM oferece dispositivos acessíveis para pessoas com deficiência. Nas exposições as pessoas com deficiência visual podem realizar visitas.                
                </p>
				<a href="#" class="saibamais">Saiba mais</a>                
            </td>
      </tr>
        <tr>
        	<td colspan="2" valign="middle" align="center" height="350"><a href="#"><img src="img/emkt_contact_bt.png" width="261" height="269"  alt=""/></a></td>
        </tr>
    </table>
</div>
  
<div id="schedule">
	<h1 class="title">Agenda Brasil<br />de Acessibilidade</h1>
	<div id="schedule-box">
   	  <table width=100% cellpadding="0" cellspacing="0" border="0">
        	<tr>
            	<td valign="top" align="center" width="33%" height="240">
<div class="day-box">
	<span class="day">15</span>
	<span class="month">agosto</span>
</div>                
<div class="title"><a href="#">Dia da Bengala Branca</a></div>                
              </td>
            	<td valign="top" align="center" width="33%" height="240">
<div class="day-box">
	<span class="day">15</span>
	<span class="month">agosto</span>
</div>                
<div class="title"><a href="#">Dia da Bengala Branca</a></div>                
              </td>
            	<td valign="top" align="center" width="33%" height="240">
<div class="day-box">
	<span class="day">15</span>
	<span class="month">agosto</span>
</div>                
<div class="title"><a href="#">Dia da Bengala Branca</a></div>                
              </td>
            </tr>
        	<tr>
            	<td align="center" colspan="3">
					<a class="saibamais" href="#">Fique por dentro da Agenda Brasil de Acessibilidade</a>
              </td>
            </tr>
      </table>
    </div>

</div>  
 
<div id="propaganda"><br />
	<a href="#"><br />
		<img src="img/emkt_imagem.png" width="634" height="634"  alt=""/>
    </a> 
</div> 
<div id="footer" href="footer" accesskey="5">
   	<table>
    	<tr>
        	<td class="contact">
<div id="contact">
        	<strong tabIndex="114">Contatos</strong>
        	<div id="devices"><span tabIndex="117" class="facebook"><a href="#">facebook.com\museusacessiveis</a></span>
            </div>
            <div id="web">
            	<a tabIndex="118" href="">viviane@museusacessiveis.com.br</a>
            	<a tabIndex="119" href="">www.museusacessiveis.com.br</a>
            </div>
</div>            
            
            </td>
       	  <td class="opcoes">opções de acessibilidade</td>
        </tr>
        <tr>
        	<td align="center">
            	<a href="#"><img class="ico" src="img/emkt_facebook_ico.png" width="25" height="25"  alt=""/></a>
            	<a href="#"><img class="ico" src="img/emkt_linkedin_ico.png" width="25" height="25"  alt=""/></a>
            	<a href="#"><img class="ico" src="img/emkt_twitter_ico.png" width="25" height="25"  alt=""/></a>
            	<a href="#"><img class="ico" src="img/emkt_googleplus_ico.png" width="25" height="25"  alt=""/></a>
            	<a href="#"><img class="ico" src="img/emkt_paper_ico.png" width="25" height="25"  alt=""/></a>
            	<a href="#"><img class="ico" src="img/emkt_star_ico.png" width="25" height="25"  alt=""/></a>
            	<a href="#"><img class="ico" src="img/emkt_email_ico.png" width="25" height="25"  alt=""/></a>
            </td>
            <td align="center">&nbsp</td>
        </tr>
    </table>
    
    	<div class="clear"></div>
  </div>  
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
    	<tr>
        	<td align="center" class="news-info" height="30">
            	Política anti-spam: Se você não deseja mais receber este e-mail, <a href="#" target="_blank">clique aqui!</a>
            </td>
        </tr>
    </table>

</div>
</body>
</html>
