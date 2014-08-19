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
		//$objNovidade->debug($aTodosGlossario);
		
		$nId = (isset($_REQUEST['novidade_360_id'])?$_REQUEST['novidade_360_id']:0);
		$objNovidade->setValues(
			array(
				'novidade_360_id'=>$nId
			)
		);
		$aNovidade = $objNovidade->getOne();
		//$objNovidade->debug($aNovidade);
		
		$sConteudo = $aNovidade['novidade_360_conteudo'];
		$caracEspeciais = array(
			"!"
			,"?"
			,","
			,";"
			,":"
			," "
		);
		if(count($aTodosGlossario) > 0){
			foreach($aTodosGlossario AS $v){
				$v['glossario_palavra'] = trim($v['glossario_palavra']);
				$linkGlossario = '<a href="javascript:void(0);" glossario_id="'.$v['glossario_id'].'" class="glossario_def">'.$v['glossario_palavra'].'</a>';
				$linkGlossario2 = '<a href="javascript:void(0);" glossario_id="'.$v['glossario_id'].'" class="glossario_def">'.strtolower($v['glossario_palavra']).'</a>';
				$linkGlossario3 = '<a href="javascript:void(0);" glossario_id="'.$v['glossario_id'].'" class="glossario_def">'.strtoupper($v['glossario_palavra']).'</a>';
				$linkGlossario4 = '<a href="javascript:void(0);" glossario_id="'.$v['glossario_id'].'" class="glossario_def">'.strtoupper($v['glossario_palavra']).'</a>';
				foreach($caracEspeciais AS $carac){
					$sConteudo = str_replace("\t{$v['glossario_palavra']}{$carac}","\t".$linkGlossario.$carac,$sConteudo);
					$sConteudo = str_replace(" {$v['glossario_palavra']}{$carac}"," ".$linkGlossario.$carac,$sConteudo);
					
					$sConteudo = str_replace("\t".strtolower($v['glossario_palavra']).$carac,"\t".$linkGlossario2.$carac,$sConteudo);
					$sConteudo = str_replace(" ".strtolower($v['glossario_palavra']).$carac," ".$linkGlossario2.$carac,$sConteudo);
					
					$sConteudo = str_replace("\t".strtoupper($v['glossario_palavra']).$carac,"\t".$linkGlossario3.$carac,$sConteudo);
					$sConteudo = str_replace(" ".strtoupper($v['glossario_palavra']).$carac," ".$linkGlossario3.$carac,$sConteudo);
					
					$sConteudo = str_replace("\t".ucwords($v['glossario_palavra']).$carac,"\t".$linkGlossario4.$carac,$sConteudo);
					$sConteudo = str_replace(" ".ucwords($v['glossario_palavra']).$carac," ".$linkGlossario4.$carac,$sConteudo);
				}
			}
		}

		//Verificando se a página foi aberta a partir do Newsletter
		$nNewsId = (isset($_REQUEST['emailmkt_id'])?$_REQUEST['emailmkt_id']:0);

		//LISTA DE ARQUIVOS DE DOWNLOAD RELACIONADOS
		$aDown= array();
		//Verificando se há downloads para exibir
		if(is_array($aNovidade['download_list']) && count($aNovidade['download_list'])>0){
			$aDown = $aNovidade['download_list'];
			//$objProjeto->debug($aDown);
		}

		//variáveis para a lista de download
		$downPage = 'novidade';
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
           	  <h1 tabIndex="31" class="orange-color">Novidades 360º <a id="news-list" class="orange-color" href="<?=$linkAbsolute;?>novidade360">| Lista de Notícias</a></h1>
					<div id="content-news" class="content-box">
						<?php if($aNovidade['novidade_360_dt_agenda']!='00/00/0000'){ ?>
                        <div class="date">
							<span class="orange-color" tabIndex="32"><?=$aNovidade['novidade_360_dt_agenda'];?></span>
						</div>
						<?php } ?>
						<h2 id="title-news" tabIndex="33"><?=$aNovidade['novidade_360_titulo'];?></h2>
						<p id="news-spotlight"  tabIndex="34"><strong><?=$aNovidade['novidade_360_resumo'];?></strong></p>
						<div id="project-content">
							<?php echo $sConteudo; ?>
						</div>
						
						<!-- AQUI FICAM OS DOWNLOADS QUANDO EXISTIREM -->			  
						<?php include_once("{$path_root_page}includeDownload.php"); ?>
						
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
