﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php 

		$path_root_page = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_page = "{$path_root_page}{$DS}";
		include_once("{$path_root_page}head.php"); 

		//Carregando os conteúdos da página
		
		include_once("{$path_root_page}adm{$DS}class{$DS}curso.class.php");
		$objCurso = new curso();

		$nId = (isset($_REQUEST['curso_id'])?$_REQUEST['curso_id']:0);
		$objCurso->setValues(
			array(
				'curso_id'=>$nId
			)
		);
		$aCurso = $objCurso->getOne();

		//$objCurso->debug($aCurso);
		
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
           	  <h1 tabIndex="31" class="orange-color">Curso <a id="news-list" class="orange-color" href="<?=$linkAbsolute;?>cursos">| Lista de Cursos</a></h1>
					<div id="content-news" class="content-box">
                        <div class="date">
							<span class="orange-color" tabIndex="32"><?=$aCurso['curso_agenda'];?></span>
						</div>
						<h2 id="title-news" tabIndex="33"><?=$aCurso['curso_titulo'];?></h2>
						<span class="curso-info orange-color">
						<?php if($v['curso_sob_demanda']=='N'){  ?>
							Período: de <?=$v['curso_dt_ini'];?> até <?=$v['curso_dt_fim'];?>
						<?php }else { ?>
							Período: Sob demanda
						<?php } ?>
						</span>
						<p id="news-spotlight"  tabIndex="34"><?=$aCurso['curso_resumo'];?></p>
						<?=$aCurso['curso_conteudo'];?>
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