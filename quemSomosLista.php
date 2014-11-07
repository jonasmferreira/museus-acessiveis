<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php 

		$path_root_page = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_page = "{$path_root_page}{$DS}";
		include_once("{$path_root_page}head.php"); 

		//Carregando os conteúdos da página
		
		include_once("{$path_root_page}adm{$DS}class{$DS}quemSomos.class.php");
		$objQuemSomos = new quemSomos();

		$nId = (isset($_REQUEST['quemsomos_id'])?$_REQUEST['quemsomos_id']:'');
		$sTitulo = (isset($_REQUEST['quemsomos_titulo'])?$_REQUEST['quemsomos_titulo']:'');
		
		//echo 'ID = ' .$nId . ' Título = ' .$sTitulo;
		
		$objQuemSomos->setValues(
			array(
				'quemsomos_id'=>$nId
				,'quemsomos_exibir'=>'S'
				,'page'=>'1'
				,'rows'=>'100000'
			)
		);
		$aRows = $objQuemSomos->getLista();
		//$objQuemSomos->debug($aRows);
		
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
				<h1 tabIndex="31" class="orange-color">Quem Somos</h1>
				<div id="content-news" class="content-box">
					
					<?php
						foreach($aRows['rows'] as $k => $v){
					?>
					<div  tabIndex="31" class="quemsomos_item">
						<h3 tabIndex="31" class="title"><?php echo $v['quemsomos_titulo'];?></h3>
						<div tabIndex="31" class="quemsomos_texto"><?php echo $v['quemsomos_conteudo'];?></div>
					</div>
					<?php } ?>
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
