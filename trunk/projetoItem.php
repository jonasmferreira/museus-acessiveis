<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php 

		$path_root_page = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_page = "{$path_root_page}{$DS}";
		include_once("{$path_root_page}head.php"); 

		//Carregando os conteúdos da página
		include_once("{$path_root_page}adm{$DS}class{$DS}projeto.class.php");
		$objProjeto = new projeto();

		//LISTA DE ARQUIVOS DE DOWNLOAD RELACIONADOS COM O PROJETO
		include_once("{$path_root_page}adm{$DS}class{$DS}download.class.php");
		$objDown = new download();
		$aDown= array();
		
		$nId = (isset($_REQUEST['projeto_id'])?$_REQUEST['projeto_id']:0);
		$objProjeto->setValues(
			array(
				'projeto_id'=>$nId
			)
		);
		$aProjeto = $objProjeto->getOne();

		//$objProjeto->debug($aProjeto);

		
		//Verificando se há downloads para exibir
		if(is_array($aProjeto['downloads']) && count($aProjeto['downloads'])>0){
			$objDown->setValues(array(
				'page'=>'1'
				,'rows'=>'1'
				,'download_list_id'=>implode(',',$aProjeto['downloads'])
			));
			$objDown->setAOrderBy(array(
				't.download_dt' => 'DESC'
				,'t.download_hr' => 'DESC'
				,'t.download_titulo'=> 'ASC'
			));
			$aDown = $objDown->getDownsByProject();
			//$objDown->debug($aDown);
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
				<h1 tabIndex="31" class="orange-color">Projeto <a id="news-list" class="orange-color" href="<?=$linkAbsolute;?>projetos">| Lista de Projetos</a></h1>
				<div id="content-news" class="content-box">
					<div class="date">
						<span class="orange-color" tabIndex="32"><?=$aProjeto['projeto_agenda'];?></span>
					</div>
					<h2 id="title-news" tabIndex="33"><?=$aProjeto['projeto_titulo'];?></h2>
					<span class="curso-info orange-color">
					<?php if($v['projeto_sob_demanda']=='N'){  ?>
						Período: de <?=$v['projeto_dt_ini'];?> até <?=$v['projeto_dt_fim'];?>
					<?php }else { ?>
						Período: Sob demanda
					<?php } ?>
					</span>
					<p id="news-spotlight"  tabIndex="34">
						<?=$aProjeto['projeto_resumo'];?>
					</p>
					<div id="project-content">
						<?=$aProjeto['projeto_conteudo'];?>
					</div>
					<div class="clear"></div>
					<div>
						<?php
							if(trim($aProjeto['projeto_link_fonte'])){
								echo '<span class="purple-color">fonte: </span><a class="orange-color" class="orange-color" href="' . $aProjeto['projeto_link_fonte'] . '">'. $aProjeto['projeto_fonte'] .'</a>';
							}elseif(trim($aProjeto['projeto_fonte'])){
								echo '<span class="purple-color">fonte: </span><span  class="purple-color">' . $aProjeto['projeto_fonte'] . '</span>';
							}
						?>
					</div>

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
					foreach($aDown['rows'] as $k => $v){
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
