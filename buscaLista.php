<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php 

		$path_root_page = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_page = "{$path_root_page}{$DS}";
		include_once("{$path_root_page}head.php"); 

		//Carregando os conteúdos da página
		include_once("{$path_root_page}adm{$DS}class{$DS}busca.class.php");

		$objBusca = new busca();	
		$sPesquisa = (isset($_REQUEST['busca_texto'])?$_REQUEST['busca_texto']:'');
	
		//Itens da busca
		$objBusca->setValues(
			array(
				'busca_texto'=>$sPesquisa
				,'page'=>'1'
				,'rows'=>'500000'
			)
		);

		$aBusca = $objBusca->getLista();
		//$objBusca->debug($aBusca);

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
			<div id="outdoor-news"></div>        	
            <div id="news360" class="list">
           	  <h1 tabIndex="31" class="orange-color">Busca</h1>
              <ul id="list-itens">
				<li class="month-list">
					<span class="orange-color news-list">Foram encontrados: <?=$aBusca['records'];?> resultados.</span>
					<div class="itens">
					<?php foreach($aBusca['rows'] as $k => $v){ ?>
					<div class="content-box">
                	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="auto">
                    	<tr>
	                        <td valign="top" align="left" width="152"><img tabIndex="35" src="<?=$linkAbsolute;?>images/<?=$v['item_thumb'];?>" width="152" height="116"  alt="<?=$v['item_thumb_desc'];?>" title="<?=$v['item_titulo'];?>"/></td>
							<td valign="top" align="left">
                                <div class="info-head">
									<div class="date"><span class="purple-color" tabIndex="32"><?=$v['item_dt_agenda'];?></span></div>
									<div class="social-media">
										<span class="purple-color"><a tabIndex="36" class="purple-color" href="">facebook</a></span>
										<span class="separator">|</span>
										<span class="purple-color"><a tabIndex="37" class="purple-color" href="">twitter</a></span>
									</div>
									<div class="clear"></div>
								</div> 
								<dl class="content-list-itens">
									<dt>
										<span class="orange-color" tabIndex="32">
											<strong><a tabIndex="33" href="<?=$linkAbsolute;?><?=$v['item_tipo_link'];?>/<?=$v['item_id'];?>/<?=$objBusca->toNormaliza($v['item_titulo']);?>">[<?=$v['item_tipo_link'];?>] <?=$v['item_titulo'];?></a></strong>
										</span>
									</dt>
									<dd tabIndex="34">
										<i>
										<?=$v['item_resumo'];?>
										</i>
									</dd>
								</dl>
                            </td>
                        </tr>
                        <tr>
                        	<td colspan="2"><strong class="more"><a tabIndex="38" href="<?=$linkAbsolute;?><?=$v['item_tipo_link'];?>/<?=$v['item_id'];?>/<?=$objBusca->toNormaliza($v['item_titulo']);?>">ver mais +</a></strong></td>
                        </tr>
                    </table>
                </div>  
				<?php } ?>
					</div>
				</li>  
              </ul>
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
