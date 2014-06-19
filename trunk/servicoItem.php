<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php 

		$path_root_page = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_page = "{$path_root_page}{$DS}";
		include_once("{$path_root_page}head.php"); 

		//Carregando os conteúdos da página
		
		include_once("{$path_root_page}adm{$DS}class{$DS}servico.class.php");
		$objServico = new servico();

		$nId = (isset($_REQUEST['servico_id'])?$_REQUEST['servico_id']:0);
		$objServico->setValues(
			array(
				'servico_id'=>$nId
			)
		);
		$aServicos = $objServico->getOne();
		//$objServico->debug($aServico);
		
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
           	  <h1 tabIndex="31" class="orange-color">Servico <a id="news-list" class="orange-color" href="<?=$linkAbsolute;?>servicos">| Lista de Serviços</a></h1>
					<div id="content-news" class="content-box">
                        <div class="date">
							<span class="orange-color" tabIndex="32"><?=$aServicos['servico_agenda'];?></span>
						</div>
						<h2 id="title-news" tabIndex="33"><?=$aServicos['servico_titulo'];?></h2>
						<span class="curso-info orange-color">
						<?php if($aServicos['servico_sob_demanda']=='N'){  ?>
							Período: de <?=$aServicos['servico_dt_ini'];?> até <?=$aServicos['servico_dt_fim'];?>
						<?php }else { ?>
							Período: Sob demanda
						<?php } ?>
						</span>
						<div class="news-spotlight"  tabIndex="34"><?=$aServicos['servico_resumo'];?></p>
						<?=$aServicos['servico_conteudo'];?>
						<div class="clear"><br /><br /></div>
						<div>
							<?php
								if(trim($aServicos['servico_link_fonte'])){
									echo '<span class="purple-color">fonte: </span><a class="orange-color" class="orange-color" href="' . $aServicos['servico_link_fonte'] . '">'. $aServico['servico_fonte'] .'</a>';
								}elseif(trim($aServicos['servico_fonte'])){
									echo '<span class="purple-color">fonte: </span><span  class="purple-color">' . $aServicos['servico_fonte'] . '</span>';
								}
							?>
						</div>
						
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
