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
		include_once("{$path_root_page}adm{$DS}class{$DS}emktNoticia.class.php");
		$objEmktNoticia = new emktNoticia();
		
		$nId = (isset($_REQUEST['emkt_noticia_id'])?$_REQUEST['emkt_noticia_id']:0);
		$objEmktNoticia->setValues(
			array(
				'emkt_noticia_id'=>$nId
			)
		);
		$aEmktNoticia = $objEmktNoticia->getOne();
		$objEmktNoticia->debug($aEmktNoticia);
		
		$sConteudo = $aEmktNoticia['emkt_noticia_conteudo'];
		$caracEspeciais = array(
			"!"
			,"?"
			,","
			,";"
			,":"
			," "
			,"."
		);

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
           	  <h1 tabIndex="31" class="orange-color">Newsletter - Notícia</h1>
					<div id="content-news" class="content-box">
						<?php if($aEmktNoticia['emkt_noticia_dt']!='00/00/0000'){ ?>
                        <div class="date">
							<span class="orange-color" tabIndex="32"><?=$aEmktNoticia['emkt_noticia_dt'];?></span>
						</div>
						<?php } ?>
						
						<h2 id="title-news" tabIndex="33"><?=$aEmktNoticia['emkt_noticia_titulo'];?></h2>
						<p id="news-spotlight"  tabIndex="34"><strong><?=$aEmktNoticia['emkt_noticia_resumo'];?></strong></p>
						<div id="project-content" class="novidade360Content">
							<?php echo $sConteudo; ?>
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
