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
		
		$nId = (isset($_REQUEST['glossario_id'])?$_REQUEST['glossario_id']:0);
		$objGlossario->setValues(
			array(
				'glossario_id'=>$nId
			)
		);
		$aGlossario = $objGlossario->getOne();
		//$objGlossario->debug($aGlossario);

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
					</div>
        	</div>
        	<div class="clear"></div>

			<?php include_once("{$path_root_page}newsletterVoltar.php"); ?>

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
