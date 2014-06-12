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


		//Banners de Parceiros
		include_once("{$path_root_page}adm{$DS}class{$DS}anunciante.class.php");
		$objAnunciante = new anunciante();

		$objAnunciante->setValues(array(
			'page'=>'1'
			,'rows'=>'500000'
		));
		$objAnunciante->setAOrderBy(array(
			't.anunciante_dt_agenda' => 'DESC'
			,'t.anunciante_tipo_banner' => 'ASC'
		));
		$aAnunciantes = $objAnunciante->getLista();

		//$objNovidade->debug($aAnunciantes);
		
		
	?>	
</head>
<body>
<div id="root">
	<?php include_once("{$path_root_page}accessbar.php"); ?>
	<div class="clear"></div>    
	<div id="content-l">
		<?php include_once("{$path_root_page}menu.php"); ?>
        <div id="content" href="content" accesskey="3">
			<?php include_once("{$path_root_page}logo.php"); ?>
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
							<dt><span tabIndex=""><a href="<?=$linkAbsolute;?>novidade360/<?=$v['novidade_360_id'];?>/<?=$objNovidade->toNormaliza($v['novidade_360_titulo']);?>"><?=$v['novidade_360_titulo_sintese'];?></a></span></dt>
							<!--dt><span tabIndex=""><a href="<?=$linkAbsolute;?>novidade360/<?=$v['novidade_360_id'];?>/<?=$objNovidade->toNormaliza($v['novidade_360_titulo']);?>"><?=$v['novidade_360_titulo'];?></a></span></dt-->
							<!--dd><i tabIndex=""><a href="<?=$linkAbsolute;?>novidade360/<?=$v['novidade_360_id'];?>/<?=$objNovidade->toNormaliza($v['novidade_360_titulo']);?>"><?=$v['novidade_360_resumo'];?></a></i></dd-->
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
                                	<strong><a tabIndex="24" href="<?=$linkAbsolute;?>novidade360/<?=$aDestaque['novidade_360_id'];?>/<?=$objNovidade->toNormaliza($aDestaque['novidade_360_titulo']);?>"><?=$aDestaque['novidade_360_titulo'];?></a></strong>
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
                              <strong class="more"><a tabIndex="30" href="<?=$linkAbsolute;?>novidade360/<?=$aDestaque['novidade_360_id'];?>/<?=$objNovidade->toNormaliza($aDestaque['novidade_360_titulo']);?>">ver mais +</a></strong>                       
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
                                	<strong><a tabIndex="33" href="<?=$linkAbsolute;?>novidade360/<?=$v['novidade_360_id'];?>/<?=$objNovidade->toNormaliza($v['novidade_360_titulo']);?>"><?=$v['novidade_360_titulo'];?></a></strong>
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
                        	<td colspan="2"><strong class="more"><a tabIndex="38" href="<?=$linkAbsolute;?>novidade360/<?=$v['novidade_360_id'];?>/<?=$objNovidade->toNormaliza($v['novidade_360_titulo']);?>">ver mais +</a></strong></td>
                        </tr>
                    </table>
                </div>  
				<?php } ?>
				<h1 class="orange-color"><a tabIndex="53" class="orange-color" href="<?=$linkAbsolute;?>novidade360/">demais notícias</a></h1>
            </div>
            <div id="banners">
<?php 
			foreach($aAnunciantes['rows'] as $k => $v){
				$width = ($v['anunciante_tipo_banner']=='FB')?'577':'276';
				$class = ($v['anunciante_tipo_banner']=='FB')?'fullbanner':'button';
				
				if($v['anunciante_tipo_banner']=='FB'){
?>
					<div class="clear"></div>
<?php					
				}
?>
				<div class="<?=$class;?>">
                	<a tabIndex="" href="<?=$v['anunciante_banner_link'];?>" target="_BLANK">
						<img src="<?=$linkAbsolute;?>images/<?=$v['anunciante_banner'];?>"  alt="<?=$v['anunciante_banner_desc'];?>" width="<?=$width;?>" height="188" title="<?=$v['anunciante_nome'];?>"/>
					</a>
                </div>
<?php					
				if($v['anunciante_tipo_banner']=='FB'){
?>
					<div class="clear">&nbsp;</div>
<?php					
				}

			}
?>				
                <div class="clear"></div>
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
