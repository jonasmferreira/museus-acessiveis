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
		include_once("{$path_root_page}adm{$DS}class{$DS}tipo_servico.class.php");
		include_once("{$path_root_page}adm{$DS}class{$DS}servProjCurInfo.class.php");

		$objServico = new servico();
		$objTipoServico = new tipo_servico();
		$objServProjCurInfo = new servProjCurInfo();

		$sTipo = (isset($_REQUEST['tipo_servico_titulo'])?$_REQUEST['tipo_servico_titulo']:'');
		$nTipoId = (isset($_REQUEST['tipo_servico_id'])?$_REQUEST['tipo_servico_id']:'');
		if(trim($nTipoId)!=''){
			$objTipoServico->setValues(
				array(
					'tipo_servico_id'=>$nTipoId
				)
			);
		
			$aTipo = $objTipoServico->getOne();
			//$objTipoServico->debug($aTipo);

			//Serviços - Lista
			$objServico->setValues(array(
				'tipo_servico_id'=>$nTipoId
				,'page'=>'1'
				,'rows'=>'100000'
			));
			
		}else{
			//Serviços - Lista
			$objServico->setValues(array(
				'page'=>'1'
				,'rows'=>'100000'
			));
			
		}
		
		//Serviços - Lista
		$objServico->setAOrderBy(array(
			'tc.tipo_servico_titulo' => 'ASC'
			,'t.servico_agenda' => 'DESC'
			,'t.servico_dt_ini' => 'DESC'
		));

		$aRows = $objServico->getLista();
		//$objServico->debug($aRows);

		$aMeses = $objServico->getMeses();
		//$objServico->debug($aRows);

		$objServProjCurInfo->setValues(
			array(
				'serv_proj_cur_id'=>1
			)
		);
		$aServProjCurInfo = $objServProjCurInfo->getOne();
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
           	  <h1 tabIndex="31" class="orange-color">Serviços <?=$sTipoLabel;?></h1>
			  <div class="news-spotlight">
				  <?php 
						echo $aServProjCurInfo['servico_descr'];
				  ?>
			  </div>
              <ul id="list-itens">
              	
<?php

		//montando o array com os dados por mês/ano
		//$aNovidades = array();
		$nAno = 0;
		$nMes = 0;
		$nPos=0;
		$sCloseLi = '';
		foreach($aRows['rows'] as $k => $v){
			$aData = explode('/',$v['curso_agenda']);
			if($nAno!=$aData[2]||$nMes!=$aData[1]){
				$nAno = $aData[2];
				$nMes = $aData[1];
				$nPos=0;
				if(trim($sCloseLi)!=''){
					$sCloseLi .='</li>';
					echo $sCloseLi;
				}else{
?>				
				<li class="month-list">
					<h3><a class="orange-color news-list" href=""><?=$aMeses[$nMes];?>/<?=$nAno?></a></h3>
					<div class="itens <?=($k!=0)? ' inactive': '';?>">
<?php				
				}
			}
?>
					<div class="content-box">
                	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="auto">
                    	<tr>
	                        <td valign="top" align="left" width="152"><img tabIndex="35" src="<?=$linkAbsolute;?>images/<?=$v['servico_thumb'];?>" width="152" height="116"  alt="<?=$v['servico_thumb_desc'];?>" title="<?=$v['servico_titulo'];?>"/></td>
							<td valign="top" align="left">
                                <div class="info-head">
									<div class="date">
										<span class="purple-color" tabIndex="32">
											<?=($v['servico_agenda']!='00/00/0000')?$v['servico_agenda']:'';?>
										</span>
									</div>
									<div class="social-media">
										<span class="purple-color">
											<a tabIndex="36" class="purple-color" href="">facebook</a>
										</span>
										<span class="separator">|</span>
										<span class="purple-color">
											<a tabIndex="37" class="purple-color" href="">twitter</a>
										</span>
									</div>
									<div class="clear"></div>
								</div> 
								<dl class="content-list-itens">
									<dt>
										<span class="orange-color" tabIndex="32">
											<strong><a tabIndex="33" href="<?=$linkAbsolute;?>servico/<?=$v['servico_id'];?>/<?=$objServico->toNormaliza($v['servico_titulo']);?>"><?=$v['servico_titulo'];?></a></strong>
										</span>
										<div class="purple-color">
											<?php
													echo 'categoria: ' . $v['tipo_servico_titulo'];
											?>
											<span class="curso-info orange-color">
											<?php if($v['servico_sob_demanda']=='N' && $v['servico_agenda']!='00/00/0000'){  ?>
												Período: de <?=$v['servico_dt_ini'];?> até <?=$v['servico_dt_fim'];?>
											<?php }else { ?>
												Período: Sob demanda
											<?php } ?>
											</span>
										</div>
									</dt>
									<dd tabIndex="34">
										<i>
										<?=$v['servico_resumo'];?>
										</i>
									</dd>
								</dl>
                            </td>
                        </tr>
                        <tr>
                        	<td colspan="2"><strong class="more"><a tabIndex="38" href="<?=$linkAbsolute;?>servico/<?=$v['servico_id'];?>/<?=$objServico->toNormaliza($v['servico_titulo']);?>">ver mais +</a></strong></td>
                        </tr>
                    </table>
                </div>  
						
<?php						
			$nPos++;
		}
?>
				  
              </ul>
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
