﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
		
		$nId = (isset($_REQUEST['servico_id'])?$_REQUEST['servico_id']:0);
		$objServico->setValues(
			array(
				'servico_id'=>$nId
			)
		);
		$aServicos = $objServico->getOne();
		//$objServico->debug($aServicos);

		//Verificando se há tags para exibir
		if(is_array($aServicos['tag_list']) && count($aServicos['tag_list'])>0){
			$aTag = $aServicos['tag_list'];
			//$objProjeto->debug($aTag);
		}

		//Verificando se há glossários para exibir
		if(is_array($aServicos['glossario_list']) && count($aServicos['glossario_list'])>0){
			$aGloss = $aServicos['glossario_list'];
		}
		
		//Verificando se há extras para exibir
		if(is_array($aServicos['extra_list']) && count($aServicos['extra_list'])>0){
			$aExtra = $aServicos['extra_list'];
			//$objProjeto->debug($aExtra);
		}

		//Verificando se há downloads para exibir
		if(is_array($aServicos['download_list']) && count($aServicos['download_list'])>0){
			$aDown = $aServicos['download_list'];
			//$objProjeto->debug($aDown);
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
						
						<p id="news-spotlight"  tabIndex="34">
							<b><?=$aServicos['servico_resumo'];?></b>
						</p>
						<div id="project-content">
							<?=$aServicos['servico_conteudo'];?>
						</div>
						<div class="clear"></div>
						
						<!-- EXTRAS -->
						<div>
						<?php
							foreach($aExtra as $k => $v){					
						?>
								<span class="orange-color"><?php echo $v['extra_nome_campo'] ;?></span>
								<p><?php echo $v['servico_extra_valor'] ;?></p><br />
						<?php } ?>	
						</div>
						<div class="clear"></div>
					
						<!-- FONTE -->
						<div>
							<?php
								if(trim($aServicos['servico_link_fonte'])){
									echo '<span class="purple-color">fonte: </span><a target="_blank" class="orange-color" class="orange-color" href="' . $aServicos['servico_link_fonte'] . '">'. $aServicos['servico_fonte'] .'</a>';
								}elseif(trim($aServicos['servico_fonte'])){
									echo '<span class="purple-color">fonte: </span><span  class="purple-color">' . $aServicos['servico_fonte'] . '</span>';
								}
							?>
						</div>

						<!-- TAGS -->
						<div>
						<?php
							if(is_array($aTag) && count($aTag)>0){
						?>
								<div class="clear"><br /></div>
								<span class="orange-color">Tags: </span>
								<span>
						<?php	
								foreach($aTag as $k => $v){					
									$aTg[] = $v['tag_titulo'];
								} 

								echo implode(', ',$aTg);
							}

						?>	
							</span>
						</div>

						<!-- GLOSSÁRIO -->
						<div>
						<?php
							if(count($aGloss)>0){
						?>
								<div class="clear"><br /></div>
								<span class="orange-color">Glossário: </span>
								<span>
						<?php	
								foreach($aGloss as $k => $v){					
									$aGl[] = $v['glossario_palavra'];
								} 
								echo implode(', ',$aGl);
							}

						?>	
							</span>
						</div>
						<div class="clear"><br /></div>
					
						<!-- AQUI FICAM OS DOWNLOADS QUANDO EXISTIREM -->			  
						<?php 
							if(count($aDown)>0){
						?>	

							<div id="download-box" style="padding-left:0 !important;">
								<h3 tabIndex="31" class="orange-color">Downloads</h2>
								<table id="list" width="100%" cellpading="0" cellspacing="0">
										<thead>
											<tr>
												<td tabIndex="">
													<span>Data</span>
												</td>
												<td tabIndex="7">
													Descrição
												</td>
												<td tabIndex="">
													Formato
												</td>
												<td tabIndex="19">
													Tamanho
												</td>
											</tr>
										</thead>
										<tbody>
					<?php 
										foreach($aDown as $k => $v){
					?>
											<tr>
												<td>
													<span><?=$v['download_dt'];?></span>
												</td>
												<td>
													<span><a target="_BLANK" href="<?=$linkAbsolute;?>arquivosDown/<?=$v['download_arquivo'];?>"><?=$v['download_titulo'];?></a></span>
												</td>
												<td>
													<span><?=$v['download_tipo_label'];?></span>
												</td>
												<td>
													<span><?=$v['download_tamanho_label'];?></span>
												</td>
											</tr>
					<?php
							}
					?>						
										</tbody>
								</table>
								</div>
					<?php } ?>
								<div class="clear"></div>
					<!-- FIM DOWNLOADS -->
					
        	</div>
        	<div class="clear"></div>
        </div>
        <div class="clear"></div>

		<?php include_once("{$path_root_page}newsletterVoltar.php"); ?>
		
  </div>
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
