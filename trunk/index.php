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
				<img tabIndex="15" src="<?=$linkAbsolute;?>img/logo_transparent.png" alt="Logo Museus Acessíveis, cultura + acessibilidade 360º" width="288" height="152" title="Logo Museus Acessíveis, cultura + acessibilidade 360º" />            
            </div>
            <div id="outdoor">
            	<div id="item-box">
					<ul id="outdoor-lista">
<?php
						foreach($aOutdoor['rows'] as $k =>$v){
?>
						<li><a id="outl_<?=$k?>" tabIndex="" href=""><?=($k+1)?></a></li>
<?php
						}
?>
                    </ul>
                    <div id="item">
<?php
						foreach($aOutdoor['rows'] as $k =>$v){
?>
						<img <?=($k!=0) ? 'style="display:none;"' : '';?> id="outi_<?=$k?>" src="<?=$linkAbsolute;?>images/<?=$v['novidade_360_banner'];?>" width="515" height="226" alt="<?=$v['novidade_360_destaque_home_desc'];?>" title="<?=$v['novidade_360_destaque_home_desc'];?>" /> 
						<dl <?=($k!=0) ? 'style="display:none;"' : '';?> id="outdd_<?=$k?>">
							<dt><span tabIndex=""><a href="<?=$linkAbsolute;?>novidade/<?=$v['novidade_360_id'];?>/<?=$objNovidade->toNormaliza($v['novidade_360_titulo']);?>"><?=$v['novidade_360_titulo'];?></a></span></dt>
							<dd><i tabIndex=""><a href="<?=$linkAbsolute;?>novidade/<?=$v['novidade_360_id'];?>/<?=$objNovidade->toNormaliza($v['novidade_360_titulo']);?>"><?=$v['novidade_360_resumo'];?></a></i></dd>
						</dl>
<?php
						}
?>
                    </div>
                </div>
            </div>
            <div id="destaque">
            	<h1 tabIndex="22" class="purple-color">Destaque!</h1>
                <div class="content-box">
                	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="auto">
                    	<tr>
                        	<td valign="top" align="left" width="264"><img tabIndex="26" src="<?=$linkAbsolute;?>images/<?=$aDestaque['novidade_360_destaque_home'];?>" width="264" height="262"  alt="<?=$aDestaque['novidade_360_destaque_home_desc'];?>" title="<?=$aDestaque['novidade_360_destaque_home_desc'];?>"/></td>
                            <td valign="top" align="left">
                                <div class="info-head">
                                                        <div class="date"><span tabIndex="23" class="purple-color"><?=$aDestaque['novidade_360_dt_agenda'];?></span></div>
                                                        <div class="social-media">
                                                            <span class="purple-color"><a class="purple-color" href="" tabIndex="28">facebook</a></span>
                                                            <span class="separator">|</span>
                                                            <span class="purple-color"><a tabIndex="29" class="purple-color" href="">twitter</a></span>
                                                        </div>
                                                        <div class="clear"></div>
                              </div>  
                              <dl>
                              	<dt>
                                	<strong><a tabIndex="24" href="<?=$linkAbsolute;?>novidade/<?=$aDestaque['novidade_360_id'];?>/<?=$objNovidade->toNormaliza($aDestaque['novidade_360_titulo']);?>"><?=$aDestaque['novidade_360_titulo'];?></a></strong>
                                </dt>
                              	<dd>
                                <i tabIndex="25">
                                <?=$aDestaque['novidade_360_resumo'];?>
                                </i>
                                </dd>
                              </dl>   
                              <p id="frase" tabIndex="27"><i>
                              <?=$aDestaque['novidade_360_destaque_home_frase'];?>
                              </i></p>
                              <strong class="more"><a tabIndex="30" href="<?=$linkAbsolute;?>novidade/<?=$aDestaque['novidade_360_id'];?>/<?=$objNovidade->toNormaliza($aDestaque['novidade_360_titulo']);?>">ver mais +</a></strong>                       
                            </td>
                        </tr>
                    </table>
                    
                    
                </div>
           </div>
            <div id="news360">
            	<h1 tabIndex="31" class="orange-color">Novidades 360º</h1>
					
<?php
						foreach($aNovidades['rows'] as $k =>$v){
?>
				
				<div class="content-box">
                	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="auto">
                    	<tr>
                        	<td valign="top" align="left" width="152"><img tabIndex="35" src="<?=$linkAbsolute;?>images/<?=$v['novidade_360_thumb'];?>" width="152" height="116"  alt="<?=$v['novidade_360_thumb_desc'];?>" title="<?=$v['novidade_360_thumb_desc'];?>"/></td>
                          <td valign="top" align="left">
                                <div class="info-head">
									<div class="date"><span class="purple-color" tabIndex="32"><?=$v['novidade_360_dt_agenda'];?></span></div>
									<div class="social-media">
										<span class="purple-color"><a tabIndex="36" class="purple-color" href="">facebook</a></span>
										<span class="separator">|</span>
										<span class="purple-color"><a tabIndex="37" class="purple-color" href="">twitter</a></span>
									</div>
									<div class="clear"></div>
                              </div>  
                            <dl>
                              	<dt>
                                	<strong><a tabIndex="33" href="<?=$linkAbsolute;?>novidade/<?=$v['novidade_360_id'];?>/<?=$objNovidade->toNormaliza($v['novidade_360_titulo']);?>"><?=$v['novidade_360_titulo'];?></a></strong>
                                </dt>
                              	<dd tabIndex="34">
                                <i>
                                <?=$v['novidade_360_resumo'];?>
                                </i>
                                </dd>
                            </dl>
                            </td>
                        </tr>
                        <tr>
                        	<td colspan="2"><strong class="more"><a tabIndex="38" href="<?=$linkAbsolute;?>novidade/<?=$v['novidade_360_id'];?>/<?=$objNovidade->toNormaliza($v['novidade_360_titulo']);?>">ver mais +</a></strong></td>
                        </tr>
                    </table>
                </div>  
				<?php } ?>
				<h1 class="orange-color"><a tabIndex="53" class="orange-color" href="<?=$linkAbsolute;?>/novidade;?>">demais notícias</a></h1>
            </div>
            <div id="banners">
            	<div class="button">
                	<a tabIndex="54" href=""><img src="img/banner_item.jpg"  alt="banner" width="276" height="188" title="banner"/></a>
                </div>
            	<div class="button">
                	<a tabIndex="55" href=""><img src="img/banner_item.jpg"  alt="banner" width="276" height="188" title="banner"/></a>
                </div>
                <div class="clear"></div>
            	<div class="fullbanner">
                	<a tabIndex="56" href=""><img src="img/fullbanner.jpg"  alt="banner" width="577" height="188" title="banner"/></a>
                </div>
                <div class="clear"></div>
          </div>
            <div class="clear"></div>
        </div>
            <div class="clear"></div>
  </div>

	<div id="content-r" href="content-r" accesskey="4">
    	<form action="" method="GET" id="search">
        	<h1 tabIndex="57">Busca</h1>
            <p tabIndex="58" class="description"><i>Saiba mais sobre inclusão sem complicação!!!</i></p>
            <input tabIndex="59" type="text" class="field" value="" />
			<input tabIndex="60" type="image" class="bt-search" src="img/search-bt_transparent.png" style="" />            <div class="clear"></div>
        </form>
        <div id="diary">
        	<h1 tabIndex="61">Agenda Brasil de Acessibilidade</h1>
            <p tabIndex="62" class="description">
				Clique e saiba mais sobreos principais eventosda área de acessibilidade!!!
                </p>
                <div id="calendar">
                	<div id="month-info">
                    	<table cellpadding="0" cellspacing="0" width="100%">
							<tr>
                            	<td><a tabIndex="63" href="" class="arrow-l"><strong>&lt;&lt;</strong></a></td>
                                <td><a tabIndex="64" href=""><strong>agosto</strong></a></td>
                                <td><span>|</span></td>
                                <td><a tabIndex="65" href=""><strong>2013</strong></a></td>
                                <td><a tabIndex="66" href="" class="arrow-r"><strong>&gt;&gt;</strong></a></td>
                            </tr>
                        </table>
                 </div>
                 <div id="month-days">
                        <table cellpadding="0" cellspacing="0" width="100%">
                        	<thead>
                            	<tr>
                                	<td align="center" valign="middle">D</td>
                                	<td align="center" valign="middle">S</td>
                                	<td align="center" valign="middle">T</td>
                                	<td align="center" valign="middle">Q</td>
                                	<td align="center" valign="middle">Q</td>
                                	<td align="center" valign="middle">S</td>
                                	<td align="center" valign="middle">S</td>
                                </tr>
                            </thead>
                        	<tbody>
                            	<tr>
                                	<td tabIndex="67" align="center" valign="middle"></td>
                                	<td tabIndex="68" align="center" valign="middle"></td>
                                	<td tabIndex="69" align="center" valign="middle"></td>
                                	<td tabIndex="70" align="center" valign="middle"><span>1</span></td>
                                	<td tabIndex="71" align="center" valign="middle"><span>2</span></td>
                                	<td tabIndex="72" align="center" valign="middle"><span class="event-day">3</span></td>
                                	<td tabIndex="73" align="center" valign="middle"><span>4</span></td>
                                </tr>
                            	<tr>
                                	<td align="center" valign="middle"><span>5</span></td>
                                	<td align="center" valign="middle"><span>6</span></td>
                                	<td align="center" valign="middle">
                                    <span class="event-day">7<span class="event-info">Início da Reatec</span></span>
                                    
                                    </td>
                                	<td align="center" valign="middle"><span>8</span></td>
                                	<td align="center" valign="middle"><span>9</span></td>
                                	<td align="center" valign="middle"><span>10</span></td>
                                	<td align="center" valign="middle"><span>11</span></td>
                                </tr>
                            	<tr>
                            	<tr>
                                	<td align="center" valign="middle"><span>12</span></td>
                                	<td align="center" valign="middle"><span>13</span></td>
                                	<td align="center" valign="middle"><span>14</span></td>
                                	<td align="center" valign="middle"><span>15</span></td>
                                	<td align="center" valign="middle"><span>16</span></td>
                                	<td align="center" valign="middle"><span>17</span></td>
                                	<td align="center" valign="middle"><span class="event-day">18</span></td>
                                </tr>
                                </tr>
                            	<tr>
                            	<tr>
                                	<td align="center" valign="middle"><span>19</span></td>
                                	<td align="center" valign="middle"><span>20</span></td>
                                	<td align="center" valign="middle"><span>21</span></td>
                                	<td align="center" valign="middle"><span>22</span></td>
                                	<td align="center" valign="middle"><span>23</span></td>
                                	<td align="center" valign="middle"><span>24</span></td>
                                	<td align="center" valign="middle"><span>25</span></td>
                                </tr>
                                </tr>
                            	<tr>
                            	<tr>
                                	<td align="center" valign="middle"><span>26</span></td>
                                	<td align="center" valign="middle"><span>27</span></td>
                                	<td align="center" valign="middle"><span>28</span></td>
                                	<td align="center" valign="middle"><span class="event-day">29</span></td>
                                	<td align="center" valign="middle"><span>30</span></td>
                                	<td align="center" valign="middle"></td>
                                	<td align="center" valign="middle"></td>
                                </tr>
                                </tr>
                            </tbody>
                            
                        </table>
                    </div>
                </div>
        </div>
        <div id="atento">
        	<h1 tabIndex="102">Fique atento!</h1>
            <div tabIndex="103" id="day">15</div>
            <h3 tabIndex="104" id="month">Agosto</h3>
            <span tabIndex="105" id="event">Início da Reatec</span>
        </div>
        <form action="" method="POST" id="newsletter">
        	<h1 tabIndex="106" >Cadastro</h1>
            <p tabIndex="107" class="description">
            Cadastre-se para recebernossas novidades!!!
            </p>
            <input tabIndex="108" type="text" class="field" value="" />
			<input tabIndex="109" type="image" class="bt-newsletter" src="img/newsletter-bt_transparent.png" />            <div class="clear"></div>            
        </form>
        <form action="" method="POST" id="glossary-search">
        	<h1 tabIndex="110">Glossário da <br />Acessibilidade</h1>
            <p tabIndex="111" class="description">
            Saiba mais sobre inclusãosem complicação!!!
            </p>
            <input tabIndex="112" type="text" class="field" value="" />
			<input tabIndex="113" type="image" class="bt-search" src="img/search-bt_transparent.png" style="" />
            <div class="clear"></div>
        </form>
    </div>
	<?php include_once("{$path_root_page}footer.php"); ?>
</div>
</body>
</html>
