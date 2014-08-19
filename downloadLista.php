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
		include_once("{$path_root_page}adm{$DS}class{$DS}download.class.php");
		$objDown = new download();

		//itens do outdoor
		$objDown->setValues(array(
			'page'=>'1'
			,'rows'=>'500000'
		));
		$objDown->setAOrderBy(array(
			't.download_dt' => 'DESC'
			,'t.download_hr' => 'DESC'
			,'t.download_titulo'=> 'ASC'
		));
		$aDown = $objDown->getLista();

		//$objDown->debug($aDown);

		//variáveis para a lista de download
		$downPage = 'download';
		$downId = 0;
		
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
            <div id="download-box">
           	  <h1 tabIndex="31" class="orange-color">Downloads</h1>
              <table id="list" width="100%" cellpading="0" cellspacing="0" downPage="<?=$downPage;?>" downId="<?=$downId;?>">
              		<thead>
                    	<tr>
                        	<td tabIndex="" id="DT">
								<a class="down_ordem" href="javascript:void(0);">Data</a>
                            </td>
                        	<td tabIndex="" id="CT">
								<a class="down_ordem" href="javascript:void(0);">Categoria</a>
                            </td>
							<td tabIndex="7" id="D">
                            	<a class="down_ordem" href="javascript:void(0);"><span>Descrição</span></a>
                            </td>
                        	<td tabIndex="" id="F">
								<a class="down_ordem" href="javascript:void(0);">Formato</a>
                            </td>
                        	<td tabIndex="19" id="S">
								<a class="down_ordem" href="javascript:void(0);">Tamanho</a>
                            </td>
                        </tr>
                    </thead>
              		<tbody>
<?php 
					foreach($aDown['rows'] as $k => $v){
						$sLinkFile='';
						if($v['download_tipo']!=7){
							$sLinkFile = $linkAbsolute .'arquivosDown/';
						}
			
?>
						<tr>
                        	<td>
                            	<span><?=$v['download_dt'];?></span>
                            </td>
                        	<td>
                            	<span><?=$v['download_categoria_titulo'];?></span>
                            </td>
							<td>
                            	<span><a target="_BLANK" href="<?=$sLinkFile;?><?=$v['download_arquivo'];?>"><?=$v['download_titulo'];?></a></span>
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
