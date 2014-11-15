<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php 

		$path_root_page = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_page = "{$path_root_page}{$DS}";
		include_once("{$path_root_page}head.php"); 

		//Carregando os conteúdos da página
		
		include_once("{$path_root_page}adm{$DS}class{$DS}clipping.class.php");
		$objClipping = new clipping();

		//LISTA DE ARQUIVOS DE GLOSSARIOS RELACIONADOS 
		$aGloss= array();
		$aGl=array();

		//LISTA DE ARQUIVOS DE DOWNLOAD RELACIONADOS
		$aDown= array();
		
		//LISTA DE ARQUIVOS DE TAGS RELACIONADOS
		$aTag= array();
		$aTg=array();

		//LISTA DE ARQUIVOS DE EXTRAS RELACIONADOS
		$aExtra= array();
		
		$nId = (isset($_REQUEST['clipping_id'])?$_REQUEST['clipping_id']:0);
		$objClipping->setValues(
			array(
				'clipping_id'=>$nId
			)
		);
		$aClipping = $objClipping->getOne();
		//$objClipping->debug($aClipping);

		//Verificando se há tags para exibir
		if(is_array($aClipping['tag_list']) && count($aClipping['tag_list'])>0){
			$aTag = $aClipping['tag_list'];
			//$objProjeto->debug($aTag);
		}

		//Verificando se há glossários para exibir
		if(is_array($aClipping['glossario_list']) && count($aClipping['glossario_list'])>0){
			$aGloss = $aClipping['glossario_list'];
		}
		
		//Verificando se há extras para exibir
		if(is_array($aClipping['extra_list']) && count($aClipping['extra_list'])>0){
			$aExtra = $aClipping['extra_list'];
			//$objProjeto->debug($aExtra);
		}

		//Verificando se há downloads para exibir
		if(is_array($aClipping['download_list']) && count($aClipping['download_list'])>0){
			$aDown = $aClipping['download_list'];
			//$objProjeto->debug($aDown);
		}

		//Verificando se a página foi aberta a partir do Newsletter
		$nNewsId = (isset($_REQUEST['emailmkt_id'])?$_REQUEST['emailmkt_id']:0);

		//variáveis para a lista de download
		$downPage = 'clipping';
		$downId = $nId;
		
		//CARREGANDO AS GALERIAS
		$aGaleria = $objClipping->getClippingGaleriaItem($nId);
		//$objClipping->debug($aGaleria);
		
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
			<div id="news360">
           	  <h1 tabIndex="31" class="orange-color">
				  Clipping <a id="news-list" class="orange-color" href="<?=$linkAbsolute;?>clipping">| Lista de Clippings</a>
			  </h1>
					<div id="content-news" class="content-box">
                        <div class="date">
							<span class="orange-color" tabIndex="32">
								<?=$objClipping->dateDB2BR($aClipping['clipping_dt']);?>
							</span>
						</div>
						<h2 id="title-news" tabIndex="33"><?=$aClipping['clipping_titulo'];?></h2>
						
						<p id="news-spotlight"  tabIndex="34">
							<b><?=$aClipping['clipping_resumo'];?></b>
						</p>
						
						<!-- AQUI A GALERIA DE IMAGENS -->			  
						<?php include_once("{$path_root_page}includeGaleria.php"); ?>
						
						<div id="project-content">
							<?=$aClipping['clipping_conteudo'];?>
						</div>
						<div class="clear"></div>
						
						<!-- EXTRAS -->
						<div>
						<?php
							foreach($aExtra as $k => $v){					
						?>
								<span class="orange-color"><?php echo $v['extra_nome_campo'] ;?></span>
								<p><?php echo $v['clipping_extra_valor'] ;?></p><br />
						<?php } ?>	
						</div>
						<div class="clear"></div>
					
						<!-- FONTE -->
						<div>
							<?php
								if(trim($aClipping['clipping_link_fonte'])){
									echo '<span class="purple-color">fonte: </span><a target="_blank" class="orange-color" class="orange-color" href="' . $aClipping['clipping_link_fonte'] . '">'. $aClipping['clipping_fonte'] .'</a>';
								}elseif(trim($aClipping['clipping_fonte'])){
									echo '<span class="purple-color">fonte: </span><span  class="purple-color">' . $aClipping['clipping_fonte'] . '</span>';
								}
							?>
						</div>

					<!-- TAGS -->
					<?php include_once("{$path_root_page}includeTags.php"); ?>

					<!-- GLOSSÁRIO -->
					<?php include_once("{$path_root_page}includeGlossario.php"); ?>

					<!-- AQUI FICAM OS DOWNLOADS QUANDO EXISTIREM -->			  
					<?php include_once("{$path_root_page}includeDownload.php"); ?>
					
						<div class="social-media" style="text-align: right;">
							<?php 
								$urlPost = $linkAbsolute . 'clipping/' . $aClipping['clipping_id'] . '/'. $objClipping->toNormaliza($aClipping['clipping_titulo']);
								$titlePost = $aClipping['clipping_titulo'];
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
					
        	</div>
        	<div class="clear"></div>
        </div>
        <div class="clear"></div>

		<?php include_once("{$path_root_page}newsletterVoltar.php"); ?>
		
  </div>
  </div>

	<?php include_once("{$path_root_page}contentRight.php"); ?>
	<?php include_once("{$path_root_page}footer.php"); ?>
</div>
</body>
</html>
