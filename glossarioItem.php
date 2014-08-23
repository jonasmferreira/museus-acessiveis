<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php 

		$path_root_page = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_page = "{$path_root_page}{$DS}";
		include_once("{$path_root_page}head.php"); 

		//Carregando os conteúdos da página
		//Glossario
		include_once("{$path_root_page}adm{$DS}class{$DS}glossario.class.php");
		$objGlossario = new glossario();
		$aGlossario = array();

		//LISTA DE ARQUIVOS DE GLOSSARIOS RELACIONADOS 
		$aGloss= array();
		$aGl=array();
		
		//LISTA DE ARQUIVOS DE TAGS RELACIONADOS
		$aTag= array();
		$aTg=array();
		
		$nId = (isset($_REQUEST['glossario_id'])?$_REQUEST['glossario_id']:0);
		$objGlossario->setValues(
			array(
				'glossario_id'=>$nId
			)
		);
		$aGlossario = $objGlossario->getOne();
		//$objGlossario->debug($aGlossario);

		//Verificando se há glossários para exibir
		if(is_array($aGlossario['glossario_list']) && count($aGlossario['glossario_list'])>0){
			$aGloss = $aGlossario['glossario_list'];
		}
		
		//Verificando se há tags para exibir
		if(is_array($aGlossario['tag_list']) && count($aGlossario['tag_list'])>0){
			$aTag = $aGlossario['tag_list'];
			//$objProjeto->debug($aTag);
		}
		
		//Verificando se a página foi aberta a partir do Newsletter
		$nNewsId = (isset($_REQUEST['emailmkt_id'])?$_REQUEST['emailmkt_id']:0);
		
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
           	  <h1 tabIndex="31" class="orange-color">Glossário</h1>
					<div id="content-news" class="content-box">
                        <!--div class="date">
							<span class="orange-color" tabIndex="32"><?=$aGlossario['glossario_dt'];?></span>
						</div-->
						<h2 id="title-news" tabIndex="33"><?=$aGlossario['glossario_palavra'];?></h2>
						<p id="news-spotlight"  tabIndex="34"><?=$aGlossario['glossario_definicao'];?></p>
						<?=$aGlossario['glossario_conteudo'];?>
						<div class="clear"><br /><br /></div>
						<div>
							<?php
								if(trim($aGlossario['glossario_link_fonte'])){
									echo '<span class="purple-color">fonte: </span><a class="orange-color" class="orange-color" href="' . $aGlossario['glossario_link_fonte'] . '">'. $aGlossario['glossario_fonte'] .'</a>';
								}else{
									echo '<span class="purple-color">fonte: </span><span  class="purple-color">' . $aGlossario['glossario_fonte'] . '</span>';
								}
							?>
						</div>
						
						<!-- TAGS -->
						<?php include_once("{$path_root_page}includeTags.php"); ?>

						<!-- GLOSSÁRIO -->
						<?php 
							$glossRel=true;
							include_once("{$path_root_page}includeGlossario.php"); 
						?>
						
						
						<div class="social-media" style="text-align: right;">
							<?php 
								$urlPost = $linkAbsolute . 'glossario/' . $aGlossario['glossario_id'] . '/'. $objGlossario->toNormaliza($aGlossario['glossario_palavra']);
								$titlePost = $aNovidade['glossario_palavra'];
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
        	</div>
        	<div class="clear"></div>

			<?php include_once("{$path_root_page}newsletterVoltar.php"); ?>

        </div>
        <div class="clear"></div>
  </div>

	<?php include_once("{$path_root_page}contentRight.php"); ?>
	<?php include_once("{$path_root_page}footer.php"); ?>
</div>
</body>
</html>
