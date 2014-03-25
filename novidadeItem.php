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
		
		//Glossario
		include_once("{$path_root_page}adm{$DS}class{$DS}glossario.class.php");
		$objGlossario = new glossario();
		$aGlossario = array();
		$aTodosGlossario = $objGlossario->getAll();
		
		$nId = (isset($_REQUEST['novidade_360_id'])?$_REQUEST['novidade_360_id']:0);
		$objNovidade->setValues(
			array(
				'novidade_360_id'=>$nId
			)
		);
		$aNovidade = $objNovidade->getOne();
		//$objNovidade->debug($aNovidade);
		$sConteudo = $aNovidade['novidade_360_conteudo'];
		if(count($aTodosGlossario) > 0){
			foreach($aTodosGlossario AS $v){
				$linkGlossario = '<a href="javascript:void(0);" glossario_id="'.$v['glossario_id'].'" class="glossario_def"> '.$v['glossario_palavra'].' </a>';
				$sConteudo = str_replace(" {$v['glossario_palavra']} ",$linkGlossario,$sConteudo);
			}
		}
		
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
           	  <h1 tabIndex="31" class="orange-color">Novidades 360º <a id="news-list" class="orange-color" href="<?=$linkAbsolute;?>novidade360">| Lista de Notícias</a></h1>
					<div id="content-news" class="content-box">
                        <div class="date">
							<span class="orange-color" tabIndex="32"><?=$aNovidade['novidade_360_dt_agenda'];?></span>
						</div>
						<h2 id="title-news" tabIndex="33"><?=$aNovidade['novidade_360_titulo'];?></h2>
						<p id="news-spotlight"  tabIndex="34"><?=$aNovidade['novidade_360_resumo'];?></p>
						<?=$sConteudo;?>
					</div>
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
