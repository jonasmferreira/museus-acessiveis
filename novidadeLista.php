<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php 

		$path_root_page = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_page = "{$path_root_page}{$DS}";
		include_once("{$path_root_page}head.php"); 

		//Carregando os conteúdos da página
		
		//itens do Outdoor / Destaque e Novidades 360º
		include_once("{$path_root_page}adm{$DS}class{$DS}novidade.class.php");
		$objNovidade = new novidade();

		//itens do outdoor
		$objNovidade->setValues(array(
			'novidade_360_exibir_banner'=>'S'
			,'page'=>'1'
			,'rows'=>'4'
		));
		$objNovidade->setAOrderBy(array(
			't.novidade_360_dt_agenda' => 'DESC'
			,'t.novidade_360_dt' => 'DESC'
			,'t.novidade_360_hr' => 'DESC'
		));
		$aOutdoor = $objNovidade->getLista();

		//Novidades 360 - Destaque
		$objNovidade->setValues(array(
			'novidade_360_exibir_destaque_home'=>'S'
			,'page'=>'1'
			,'rows'=>'1'
		));
		$objNovidade->setAOrderBy(array(
			't.novidade_360_dt_agenda' => 'DESC'
			,'t.novidade_360_dt' => 'DESC'
			,'t.novidade_360_hr' => 'DESC'
		));
		$aDestaque = $objNovidade->getLista();
		$aDestaque = $aDestaque['rows'][0];
		
		//Novidades 360 - Lista
		$objNovidade->setValues(array(
			'page'=>'1'
			,'rows'=>'3'
		));
		$objNovidade->setAOrderBy(array(
			't.novidade_360_dt_agenda' => 'DESC'
			,'t.novidade_360_dt' => 'DESC'
			,'t.novidade_360_hr' => 'DESC'
		));
		$aNovidades = $objNovidade->getLista();

		//$objNovidade->debug($aDestaque);
		
	?>	
</head>
<body>
<div id="root">
	<?php include_once("{$path_root_page}accessbar.php"); ?>
	<div class="clear"></div>    
	<div id="content-l">
		<?php include_once("{$path_root_page}menu.php"); ?>
        <div id="content" href="content" accesskey="3">
        	<div id="logo">
<img tabIndex="15" src="img/logo_transparent.png" alt="Logo Museus Acessíveis, cultura + acessibilidade 360º" width="288" height="152" title="Logo Museus Acessíveis, cultura + acessibilidade 360º" />            
            </div>
		  <div id="outdoor-news"></div>        	
            <div id="news360" class="list">
           	  <h1 tabIndex="31" class="orange-color">Novidades 360º</h1>
              <ul id="list-itens">
              	<li class="month-list">
               	  <h3><a class="orange-color" href="">Junho/2013</a></h3>
                    <div class="itens">
<div class="content-box">
                	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="auto">
                    	<tr>
                        	<td valign="top" align="left" width="152"><img tabIndex="35" src="img/novidades.jpg" width="152" height="116"  alt="mulher sorrindo, de chapéu e roupa preta, com colar. Cabelos cacheados" title="mulher sorrindo, de chapéu e roupa preta, com colar. Cabelos cacheados"/></td>
                          <td valign="top" align="left">
                                <div class="info-head">
                                                        <div class="date"><span class="purple-color" tabIndex="32">13/08/2013</span></div>
                                                        <div class="social-media">
                                                            <span class="purple-color"><a tabIndex="36" class="purple-color" href="">facebook</a></span>
                                                            <span class="separator">|</span>
                                                            <span class="purple-color"><a tabIndex="37" class="purple-color" href="">twitter</a></span>
                                                        </div>
                                                        <div class="clear"></div>
                              </div>  
                            <dl>
                              	<dt>
                                	<strong><a tabIndex="33" href="novidade.html">Aniversário de Helen Keller</a></strong>
                                </dt>
                              	<dd tabIndex="34">
                                <i>
                                Conheça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas, Paginações, eça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas paginações.
                                </i>
                                </dd>
                            </dl>
                            </td>
                        </tr>
                        <tr>
                        	<td colspan="2"><strong class="more"><a tabIndex="38" href="novidade.html">ver mais +</a></strong></td>
                        </tr>
                    </table>
                </div>  
<div class="content-box">
                	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="auto">
                    	<tr>
                        	<td valign="top" align="left" width="152"><img tabIndex="35" src="img/novidades.jpg" width="152" height="116"  alt="mulher sorrindo, de chapéu e roupa preta, com colar. Cabelos cacheados" title="mulher sorrindo, de chapéu e roupa preta, com colar. Cabelos cacheados"/></td>
                          <td valign="top" align="left">
                                <div class="info-head">
                                                        <div class="date"><span class="purple-color" tabIndex="32">13/08/2013</span></div>
                                                        <div class="social-media">
                                                            <span class="purple-color"><a tabIndex="36" class="purple-color" href="">facebook</a></span>
                                                            <span class="separator">|</span>
                                                            <span class="purple-color"><a tabIndex="37" class="purple-color" href="">twitter</a></span>
                                                        </div>
                                                        <div class="clear"></div>
                              </div>  
                            <dl>
                              	<dt>
                                	<strong><a tabIndex="33" href="">Aniversário de Helen Keller</a></strong>
                                </dt>
                              	<dd tabIndex="34">
                                <i>
                                Conheça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas, Paginações, eça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas paginações.
                                </i>
                                </dd>
                            </dl>
                          </td>
                        </tr>
                        <tr>
                        	<td colspan="2"><strong class="more"><a tabIndex="38" href="">ver mais +</a></strong></td>
                        </tr>
                    </table>
                </div>
<div class="content-box">
                	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="auto">
                    	<tr>
                        	<td valign="top" align="left" width="152"><img tabIndex="35" src="img/novidades.jpg" width="152" height="116"  alt="mulher sorrindo, de chapéu e roupa preta, com colar. Cabelos cacheados" title="mulher sorrindo, de chapéu e roupa preta, com colar. Cabelos cacheados"/></td>
                          <td valign="top" align="left">
                                <div class="info-head">
                                                        <div class="date"><span class="purple-color" tabIndex="32">13/08/2013</span></div>
                                                        <div class="social-media">
                                                            <span class="purple-color"><a tabIndex="36" class="purple-color" href="">facebook</a></span>
                                                            <span class="separator">|</span>
                                                            <span class="purple-color"><a tabIndex="37" class="purple-color" href="">twitter</a></span>
                                                        </div>
                                                        <div class="clear"></div>
                              </div>  
                            <dl>
                              	<dt>
                                	<strong><a tabIndex="33" href="">Aniversário de Helen Keller</a></strong>
                                </dt>
                              	<dd tabIndex="34">
                                <i>
                                Conheça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas, Paginações, eça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas paginações.
                                </i>
                                </dd>
                            </dl>
                          </td>
                        </tr>
                        <tr>
                        	<td colspan="2"><strong class="more"><a tabIndex="38" href="">ver mais +</a></strong></td>
                        </tr>
                    </table>
                </div>                                                  
                    </div>
                </li>
<li class="month-list">
               	  <h3><a class="orange-color" href="">Julho/2013</a></h3>
                    <div class="itens inactive">
<div class="content-box">
                	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="auto">
                    	<tr>
                        	<td valign="top" align="left" width="152"><img tabIndex="35" src="img/novidades.jpg" width="152" height="116"  alt="mulher sorrindo, de chapéu e roupa preta, com colar. Cabelos cacheados" title="mulher sorrindo, de chapéu e roupa preta, com colar. Cabelos cacheados"/></td>
                          <td valign="top" align="left">
                                <div class="info-head">
                                                        <div class="date"><span class="purple-color" tabIndex="32">13/08/2013</span></div>
                                                        <div class="social-media">
                                                            <span class="purple-color"><a tabIndex="36" class="purple-color" href="">facebook</a></span>
                                                            <span class="separator">|</span>
                                                            <span class="purple-color"><a tabIndex="37" class="purple-color" href="">twitter</a></span>
                                                        </div>
                                                        <div class="clear"></div>
                              </div>  
                            <dl>
                              	<dt>
                                	<strong><a tabIndex="33" href="">Aniversário de Helen Keller</a></strong>
                                </dt>
                              	<dd tabIndex="34">
                                <i>
                                Conheça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas, Paginações, eça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas paginações.
                                </i>
                                </dd>
                            </dl>
                            </td>
                        </tr>
                        <tr>
                        	<td colspan="2"><strong class="more"><a tabIndex="38" href="">ver mais +</a></strong></td>
                        </tr>
                    </table>
                </div>  
<div class="content-box">
                	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="auto">
                    	<tr>
                        	<td valign="top" align="left" width="152"><img tabIndex="35" src="img/novidades.jpg" width="152" height="116"  alt="mulher sorrindo, de chapéu e roupa preta, com colar. Cabelos cacheados" title="mulher sorrindo, de chapéu e roupa preta, com colar. Cabelos cacheados"/></td>
                          <td valign="top" align="left">
                                <div class="info-head">
                                                        <div class="date"><span class="purple-color" tabIndex="32">13/08/2013</span></div>
                                                        <div class="social-media">
                                                            <span class="purple-color"><a tabIndex="36" class="purple-color" href="">facebook</a></span>
                                                            <span class="separator">|</span>
                                                            <span class="purple-color"><a tabIndex="37" class="purple-color" href="">twitter</a></span>
                                                        </div>
                                                        <div class="clear"></div>
                              </div>  
                            <dl>
                              	<dt>
                                	<strong><a tabIndex="33" href="">Aniversário de Helen Keller</a></strong>
                                </dt>
                              	<dd tabIndex="34">
                                <i>
                                Conheça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas, Paginações, eça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas paginações.
                                </i>
                                </dd>
                            </dl>
                          </td>
                        </tr>
                        <tr>
                        	<td colspan="2"><strong class="more"><a tabIndex="38" href="">ver mais +</a></strong></td>
                        </tr>
                    </table>
                </div>
<div class="content-box">
                	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="auto">
                    	<tr>
                        	<td valign="top" align="left" width="152"><img tabIndex="35" src="img/novidades.jpg" width="152" height="116"  alt="mulher sorrindo, de chapéu e roupa preta, com colar. Cabelos cacheados" title="mulher sorrindo, de chapéu e roupa preta, com colar. Cabelos cacheados"/></td>
                          <td valign="top" align="left">
                                <div class="info-head">
                                                        <div class="date"><span class="purple-color" tabIndex="32">13/08/2013</span></div>
                                                        <div class="social-media">
                                                            <span class="purple-color"><a tabIndex="36" class="purple-color" href="">facebook</a></span>
                                                            <span class="separator">|</span>
                                                            <span class="purple-color"><a tabIndex="37" class="purple-color" href="">twitter</a></span>
                                                        </div>
                                                        <div class="clear"></div>
                              </div>  
                            <dl>
                              	<dt>
                                	<strong><a tabIndex="33" href="">Aniversário de Helen Keller</a></strong>
                                </dt>
                              	<dd tabIndex="34">
                                <i>
                                Conheça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas, Paginações, eça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas paginações.
                                </i>
                                </dd>
                            </dl>
                          </td>
                        </tr>
                        <tr>
                        	<td colspan="2"><strong class="more"><a tabIndex="38" href="">ver mais +</a></strong></td>
                        </tr>
                    </table>
                </div>                                                  
                    </div>
                </li>
<li class="month-list">
               	  <h3><a class="orange-color" href="">Agosto/2013</a></h3>
                    <div class="itens inactive">
<div class="content-box">
                	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="auto">
                    	<tr>
                        	<td valign="top" align="left" width="152"><img tabIndex="35" src="img/novidades.jpg" width="152" height="116"  alt="mulher sorrindo, de chapéu e roupa preta, com colar. Cabelos cacheados" title="mulher sorrindo, de chapéu e roupa preta, com colar. Cabelos cacheados"/></td>
                          <td valign="top" align="left">
                                <div class="info-head">
                                                        <div class="date"><span class="purple-color" tabIndex="32">13/08/2013</span></div>
                                                        <div class="social-media">
                                                            <span class="purple-color"><a tabIndex="36" class="purple-color" href="">facebook</a></span>
                                                            <span class="separator">|</span>
                                                            <span class="purple-color"><a tabIndex="37" class="purple-color" href="">twitter</a></span>
                                                        </div>
                                                        <div class="clear"></div>
                              </div>  
                            <dl>
                              	<dt>
                                	<strong><a tabIndex="33" href="">Aniversário de Helen Keller</a></strong>
                                </dt>
                              	<dd tabIndex="34">
                                <i>
                                Conheça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas, Paginações, eça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas paginações.
                                </i>
                                </dd>
                            </dl>
                            </td>
                        </tr>
                        <tr>
                        	<td colspan="2"><strong class="more"><a tabIndex="38" href="">ver mais +</a></strong></td>
                        </tr>
                    </table>
                </div>  
<div class="content-box">
                	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="auto">
                    	<tr>
                        	<td valign="top" align="left" width="152"><img tabIndex="35" src="img/novidades.jpg" width="152" height="116"  alt="mulher sorrindo, de chapéu e roupa preta, com colar. Cabelos cacheados" title="mulher sorrindo, de chapéu e roupa preta, com colar. Cabelos cacheados"/></td>
                          <td valign="top" align="left">
                                <div class="info-head">
                                                        <div class="date"><span class="purple-color" tabIndex="32">13/08/2013</span></div>
                                                        <div class="social-media">
                                                            <span class="purple-color"><a tabIndex="36" class="purple-color" href="">facebook</a></span>
                                                            <span class="separator">|</span>
                                                            <span class="purple-color"><a tabIndex="37" class="purple-color" href="">twitter</a></span>
                                                        </div>
                                                        <div class="clear"></div>
                              </div>  
                            <dl>
                              	<dt>
                                	<strong><a tabIndex="33" href="">Aniversário de Helen Keller</a></strong>
                                </dt>
                              	<dd tabIndex="34">
                                <i>
                                Conheça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas, Paginações, eça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas paginações.
                                </i>
                                </dd>
                            </dl>
                          </td>
                        </tr>
                        <tr>
                        	<td colspan="2"><strong class="more"><a tabIndex="38" href="">ver mais +</a></strong></td>
                        </tr>
                    </table>
                </div>
<div class="content-box">
                	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="auto">
                    	<tr>
                        	<td valign="top" align="left" width="152"><img tabIndex="35" src="img/novidades.jpg" width="152" height="116"  alt="mulher sorrindo, de chapéu e roupa preta, com colar. Cabelos cacheados" title="mulher sorrindo, de chapéu e roupa preta, com colar. Cabelos cacheados"/></td>
                          <td valign="top" align="left">
                                <div class="info-head">
                                                        <div class="date"><span class="purple-color" tabIndex="32">13/08/2013</span></div>
                                                        <div class="social-media">
                                                            <span class="purple-color"><a tabIndex="36" class="purple-color" href="">facebook</a></span>
                                                            <span class="separator">|</span>
                                                            <span class="purple-color"><a tabIndex="37" class="purple-color" href="">twitter</a></span>
                                                        </div>
                                                        <div class="clear"></div>
                              </div>  
                            <dl>
                              	<dt>
                                	<strong><a tabIndex="33" href="">Aniversário de Helen Keller</a></strong>
                                </dt>
                              	<dd tabIndex="34">
                                <i>
                                Conheça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas, Paginações, eça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas paginações.
                                </i>
                                </dd>
                            </dl>
                          </td>
                        </tr>
                        <tr>
                        	<td colspan="2"><strong class="more"><a tabIndex="38" href="">ver mais +</a></strong></td>
                        </tr>
                    </table>
                </div>                                                  
                    </div>
                </li>
<li class="month-list">
               	  <h3><a class="orange-color" href="">Setembro/2013</a></h3>
                    <div class="itens inactive">
<div class="content-box">
                	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="auto">
                    	<tr>
                        	<td valign="top" align="left" width="152"><img tabIndex="35" src="img/novidades.jpg" width="152" height="116"  alt="mulher sorrindo, de chapéu e roupa preta, com colar. Cabelos cacheados" title="mulher sorrindo, de chapéu e roupa preta, com colar. Cabelos cacheados"/></td>
                          <td valign="top" align="left">
                                <div class="info-head">
                                                        <div class="date"><span class="purple-color" tabIndex="32">13/08/2013</span></div>
                                                        <div class="social-media">
                                                            <span class="purple-color"><a tabIndex="36" class="purple-color" href="">facebook</a></span>
                                                            <span class="separator">|</span>
                                                            <span class="purple-color"><a tabIndex="37" class="purple-color" href="">twitter</a></span>
                                                        </div>
                                                        <div class="clear"></div>
                              </div>  
                            <dl>
                              	<dt>
                                	<strong><a tabIndex="33" href="">Aniversário de Helen Keller</a></strong>
                                </dt>
                              	<dd tabIndex="34">
                                <i>
                                Conheça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas, Paginações, eça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas paginações.
                                </i>
                                </dd>
                            </dl>
                            </td>
                        </tr>
                        <tr>
                        	<td colspan="2"><strong class="more"><a tabIndex="38" href="">ver mais +</a></strong></td>
                        </tr>
                    </table>
                </div>  
<div class="content-box">
                	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="auto">
                    	<tr>
                        	<td valign="top" align="left" width="152"><img tabIndex="35" src="img/novidades.jpg" width="152" height="116"  alt="mulher sorrindo, de chapéu e roupa preta, com colar. Cabelos cacheados" title="mulher sorrindo, de chapéu e roupa preta, com colar. Cabelos cacheados"/></td>
                          <td valign="top" align="left">
                                <div class="info-head">
                                                        <div class="date"><span class="purple-color" tabIndex="32">13/08/2013</span></div>
                                                        <div class="social-media">
                                                            <span class="purple-color"><a tabIndex="36" class="purple-color" href="">facebook</a></span>
                                                            <span class="separator">|</span>
                                                            <span class="purple-color"><a tabIndex="37" class="purple-color" href="">twitter</a></span>
                                                        </div>
                                                        <div class="clear"></div>
                              </div>  
                            <dl>
                              	<dt>
                                	<strong><a tabIndex="33" href="">Aniversário de Helen Keller</a></strong>
                                </dt>
                              	<dd tabIndex="34">
                                <i>
                                Conheça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas, Paginações, eça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas paginações.
                                </i>
                                </dd>
                            </dl>
                          </td>
                        </tr>
                        <tr>
                        	<td colspan="2"><strong class="more"><a tabIndex="38" href="">ver mais +</a></strong></td>
                        </tr>
                    </table>
                </div>
<div class="content-box">
                	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="auto">
                    	<tr>
                        	<td valign="top" align="left" width="152"><img tabIndex="35" src="img/novidades.jpg" width="152" height="116"  alt="mulher sorrindo, de chapéu e roupa preta, com colar. Cabelos cacheados" title="mulher sorrindo, de chapéu e roupa preta, com colar. Cabelos cacheados"/></td>
                          <td valign="top" align="left">
                                <div class="info-head">
                                                        <div class="date"><span class="purple-color" tabIndex="32">13/08/2013</span></div>
                                                        <div class="social-media">
                                                            <span class="purple-color"><a tabIndex="36" class="purple-color" href="">facebook</a></span>
                                                            <span class="separator">|</span>
                                                            <span class="purple-color"><a tabIndex="37" class="purple-color" href="">twitter</a></span>
                                                        </div>
                                                        <div class="clear"></div>
                              </div>  
                            <dl>
                              	<dt>
                                	<strong><a tabIndex="33" href="">Aniversário de Helen Keller</a></strong>
                                </dt>
                              	<dd tabIndex="34">
                                <i>
                                Conheça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas, Paginações, eça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas paginações.
                                </i>
                                </dd>
                            </dl>
                          </td>
                        </tr>
                        <tr>
                        	<td colspan="2"><strong class="more"><a tabIndex="38" href="">ver mais +</a></strong></td>
                        </tr>
                    </table>
                </div>                                                  
                    </div>
                </li>                                                
              </ul>
        	</div>
            <div class="clear"></div>
        </div>
            <div class="clear"></div>
  </div>

	<div id="content-r" href="content-r" accesskey="4">
		<?php include_once("{$path_root_page}boxBusca.php"); ?>
		<?php include_once("{$path_root_page}boxAgenda.php"); ?>
		<?php include_once("{$path_root_page}boxNewsletter.php"); ?>
		<?php include_once("{$path_root_page}boxGlossario.php"); ?>
    </div>	
	<?php include_once("{$path_root_page}footer.php"); ?>
</div>
</body>
</html>
