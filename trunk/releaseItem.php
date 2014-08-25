<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php 

		$path_root_page = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_page = "{$path_root_page}{$DS}";
		include_once("{$path_root_page}head.php"); 

		//Carregando os conteúdos da página
		
		include_once("{$path_root_page}adm{$DS}class{$DS}release.class.php");
		$objRelease = new release();

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
		
		$nId = (isset($_REQUEST['release_id'])?$_REQUEST['release_id']:0);
		$objRelease->setValues(
			array(
				'release_id'=>$nId
			)
		);
		$aRelease = $objRelease->getOne();
		//$objRelease->debug($aRelease);

		//Verificando se há tags para exibir
		if(is_array($aRelease['tag_list']) && count($aRelease['tag_list'])>0){
			$aTag = $aRelease['tag_list'];
			//$objProjeto->debug($aTag);
		}

		//Verificando se há glossários para exibir
		if(is_array($aRelease['glossario_list']) && count($aRelease['glossario_list'])>0){
			$aGloss = $aRelease['glossario_list'];
		}
		
		//Verificando se há extras para exibir
		if(is_array($aRelease['extra_list']) && count($aRelease['extra_list'])>0){
			$aExtra = $aRelease['extra_list'];
			//$objProjeto->debug($aExtra);
		}

		//Verificando se há downloads para exibir
		if(is_array($aRelease['download_list']) && count($aRelease['download_list'])>0){
			$aDown = $aRelease['download_list'];
			//$objProjeto->debug($aDown);
		}

		//Verificando se a página foi aberta a partir do Newsletter
		$nNewsId = (isset($_REQUEST['emailmkt_id'])?$_REQUEST['emailmkt_id']:0);

		//variáveis para a lista de download
		$downPage = 'release';
		$downId = $nId;
		
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
				  Release <a id="news-list" class="orange-color" href="<?=$linkAbsolute;?>release">| Lista de Releases</a>
			  </h1>
					<div id="content-news" class="content-box">
                        <div class="date">
							<span class="orange-color" tabIndex="32">
								<?=$objRelease->dateDB2BR($aRelease['release_dt']);?>
							</span>
						</div>
						<h2 id="title-news" tabIndex="33"><?=$aRelease['release_titulo'];?></h2>
						
						<p id="news-spotlight"  tabIndex="34">
							<b><?=$aRelease['release_resumo'];?></b>
						</p>
						<div id="project-content">
							<?=$aRelease['release_conteudo'];?>
						</div>
						<div class="clear"></div>
						
						<!-- EXTRAS -->
						<div>
						<?php
							foreach($aExtra as $k => $v){					
						?>
								<span class="orange-color"><?php echo $v['extra_nome_campo'] ;?></span>
								<p><?php echo $v['release_extra_valor'] ;?></p><br />
						<?php } ?>	
						</div>
						<div class="clear"></div>
					
						<!-- FONTE -->
						<div>
							<?php
								if(trim($aRelease['release_link_fonte'])){
									echo '<span class="purple-color">fonte: </span><a target="_blank" class="orange-color" class="orange-color" href="' . $aRelease['release_link_fonte'] . '">'. $aRelease['release_fonte'] .'</a>';
								}elseif(trim($aRelease['release_fonte'])){
									echo '<span class="purple-color">fonte: </span><span  class="purple-color">' . $aRelease['release_fonte'] . '</span>';
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
								$urlPost = $linkAbsolute . 'release/' . $aRelease['release_id'] . '/'. $objRelease->toNormaliza($aRelease['release_titulo']);
								$titlePost = $aRelease['release_titulo'];
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
