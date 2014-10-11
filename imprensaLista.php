<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php 

		$path_root_page = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_page = "{$path_root_page}{$DS}";
		include_once("{$path_root_page}head.php"); 

		include_once("{$path_root_page}adm{$DS}class{$DS}imprensa.class.php");
		include_once("{$path_root_page}adm{$DS}class{$DS}release.class.php");
		include_once("{$path_root_page}adm{$DS}class{$DS}clipping.class.php");
		include_once("{$path_root_page}adm{$DS}class{$DS}novidade.class.php");

		//Carregando os conteúdos da página
		$objImprensa = new imprensa();
		$objNovidade = new novidade();
		$objRelease = new release();
		$objClipping = new clipping();

		//Informações de Imprensa
		$objImprensa->setValues(array(
			'imprensa_id'=>1
		));
		$aRow = $objImprensa->getOne();
		//$objImprensa->debug($aRow);
		
		//Novidades 360 - Destaque
		$objNovidade->setValues(array(
			'novidade_360_exibir_destaque_home'=>'S'
			//,'page'=>'1'
			//,'rows'=>'1'
			,'novidade_360_id'=> $aRow['novidade_360_id']
		));
		$aNovidade = $objNovidade->getOne();
		$aDestaque = $aNovidade;
		//$objNovidade->debug($aDestaque);
		
		//Release
		$objRelease->setValues(array(
			'page'=>'1'
			,'rows'=>'3'
		));
		$objRelease->setAOrderBy(array(
			't.release_dt_agenda' => 'DESC'
			,'t.release_dt' => 'DESC'
			,'t.release_hr' => 'DESC'
		));
		$aRelease = $objRelease->getLista();
		//$objRelease->debug($aRelease);
		
		//Clipping
		$objClipping->setValues(array(
			'page'=>'1'
			,'rows'=>'3'
		));
		$objClipping->setAOrderBy(array(
			't.clipping_dt_agenda' => 'DESC'
			,'t.clipping_dt' => 'DESC'
			,'t.clipping_hr' => 'DESC'
		));
		$aClipping = $objClipping->getLista();
		//$objClipping->debug($aClipping);
		
		
	?>	
</head>
<body>
<div id="root">
	<?php include_once("{$path_root_page}accessbar.php"); ?>
	<div class="clear"></div>    
	<div id="content-l">
		<?php include_once("{$path_root_page}menu.php"); ?>
        <div id="content" class="imprensa" href="content" accesskey="3">
			<?php include_once("{$path_root_page}logo.php"); ?>

            <div id="outdoor"></div>
			
			<div id="imprensa-info">
           	  <h1 tabIndex="31" class="orange-color">Imprensa</h1>
				<div id="content-news" class="content-box">
						<h3 class="orange-color"  tabIndex="33">Assessoria: <?php echo $aRow['imprensa_assessoria_nome'];?></h3>
						<span class="curso-info">
							<?php echo $aRow['imprensa_assessoria_telefone'];?>
							<br />
							<?php echo $aRow['imprensa_assessoria_email'];?>
						</span>
						<div class="clear"></div>
					</div>
        	</div>
        	<div class="clear"></div>

			<!-- NOVIDADE 360º -->
            <div id="destaque">
            	<h1 tabIndex="22" class="orange-color">Destaque!</h1>
                <div class="content-box">
                	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="auto">
                    	<tr>
                        	<td valign="top" align="left" width="274">
								<img tabIndex="26" src="<?=$linkAbsolute;?>images/<?=$aDestaque['novidade_360_destaque_home'];?>" width="264" height="262"  alt="<?=$aDestaque['novidade_360_destaque_home_desc'];?>" title="<?=$aDestaque['novidade_360_destaque_home_desc'];?>" />
							</td>
                            <td valign="top" align="left">
                                <div class="info-head">
									<div class="date">
										<span tabIndex="23" class="purple-color">
											<?=($aDestaque['novidade_360_dt_agenda']!='00/00/0000')?$aDestaque['novidade_360_dt_agenda']:'';?>
										</span>
									</div>
									<div class="social-media">
										<?php 
											$urlPost = $linkAbsolute . 'novidade360/' . $v['novidade_360_id'] . '/'. $objNovidade->toNormaliza($v['novidade_360_titulo']);
											$titlePost = $aNovidade['novidade_360_titulo'];
										?>
										<div class="fb-share-button" data-href="<?=$urlPost;?>"></div>										
										<span class="purple-color">
											<a tabIndex="36" class="purple-color" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?=$urlPost;?>">facebook</a>
										</span>
										<span class="separator">|</span>
										<span class="purple-color">
											<a tabIndex="37" class="purple-color" href="http://twitter.com/share?text=<?=$urlTitle;?>&url=<?=$urlPost;?>&counturl=<?=$urlPost;?>&via=joynilson" target="_blank">
												twitter
											</a>										
										</span>
									</div>
									<div class="clear"></div>
                              </div>  
                              <dl>
                              	<dt>
                                	<strong>
										<a tabIndex="24" href="<?=$linkAbsolute;?>novidade360/<?=$aDestaque['novidade_360_id'];?>/<?=$objNovidade->toNormaliza($aDestaque['novidade_360_titulo']);?>">
											<?php echo $aDestaque['novidade_360_titulo']; ?>
										</a>
									</strong>
                                </dt>
                              	<dd>
                                <i tabIndex="25">
                                <?=$aDestaque['novidade_360_resumo'];?>
                                </i>
                                </dd>
                              </dl>   
                            </td>
                        </tr>
                    </table>
                    
                    
                </div>
           </div>

			<!-- NOSSOS NÚMEROS -->
			<div id="nossos-numeros">
				<h1 tabIndex="22" class="orange-color">Nossos Números</h1>
				<div class="content-box">
						<div id="project-content">
							<?=$aRow['imprensa_nossos_numeros'];?>
						</div>
						<div class="clear"></div>
				</div>
			</div>
			
			<!-- RELEASE -->
            <div class="release-clipping">
            	<h1 tabIndex="31" class="orange-color">Release</h1>
				<?php foreach($aRelease['rows'] as $k =>$v){ ?>
				<div class="content-box">
                	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="auto">
                    	<tr>
                          <td valign="top" align="left">
                                <div class="info-head">
									<div class="date">
										<span class="gray-color" tabIndex="32">
											<?=($v['release_dt']!='00/00/0000')?$v['release_dt']:'';?>
										</span>
									</div>
									<div class="clear"></div>
                              </div>  
                            <div class="title-imp">
								<strong>
									<a class="gray-color" tabIndex="33" href="<?=$linkAbsolute;?>release/<?=$v['release_id'];?>/<?=$objRelease->toNormaliza($v['release_titulo']);?>">
										<?=$v['release_titulo'];?>
									</a>
								</strong>
                            </div>
                            </td>
                        </tr>
                        <tr>
                        	<td align="right">
								<strong class="more"></strong>
							</td>
                        </tr>
                    </table>
                </div>  
				<?php } ?>
				<div class="gray-color more">
					<a tabIndex="53" class="gray-color" href="<?=$linkAbsolute;?>release/">
						ver todos
					</a>
				</div>
            </div>
            <div class="clear"></div>
			
			<!-- CLIPPING -->
            <div class="release-clipping">
            	<h1 tabIndex="31" class="orange-color">Clipping</h1>
				<?php foreach($aClipping['rows'] as $k =>$v){ ?>
				<div class="content-box">
                	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="auto">
                    	<tr>
                          <td valign="top" align="left">
                                <div class="info-head">
									<div class="date">
										<span class="gray-color" tabIndex="32">
											<?=$v['clipping_dt'];?>
										</span>
									</div>
									<div class="clear"></div>
                              </div>  
                            <div class="title-imp">
								<strong>
									<a class="gray-color" tabIndex="33" href="<?=$linkAbsolute;?>clipping/<?=$v['clipping_id'];?>/<?=$objClipping->toNormaliza($v['clipping_titulo']);?>">
										<?=$v['clipping_titulo'];?>
									</a>
								</strong>
                            </div>
                            </td>
                        </tr>
                        <tr>
                        	<td align="right">
								<strong class="more"></strong>
							</td>
                        </tr>
                    </table>
                </div>  
				<?php } ?>
				<div class="gray-color more">
					<a tabIndex="53" class="gray-color" href="<?=$linkAbsolute;?>clipping/">
						ver todos
					</a>
				</div>
            </div>
            <div class="clear"></div>
			
        </div>
            <div class="clear"></div>
  </div>

	<?php include_once("{$path_root_page}contentRight.php"); ?>
	<?php include_once("{$path_root_page}footer.php"); ?>
</div>
</body>
</html>
