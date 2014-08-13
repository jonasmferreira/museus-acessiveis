<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php 

		$path_root_page = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_page = "{$path_root_page}{$DS}";
		include_once("{$path_root_page}head.php"); 

		//Carregando os conteúdos da página
		
		include_once("{$path_root_page}adm{$DS}class{$DS}curso.class.php");
		include_once("{$path_root_page}adm{$DS}class{$DS}tipo_curso.class.php");
		include_once("{$path_root_page}adm{$DS}class{$DS}servProjCurInfo.class.php");

		$objCurso = new curso();
		$objTipoCurso = new tipo_curso();
		$objServProjCurInfo = new servProjCurInfo();

		$sTipo = (isset($_REQUEST['tipo_curso_titulo'])?$_REQUEST['tipo_curso_titulo']:'');
		$nTipoId = (isset($_REQUEST['tipo_curso_id'])?$_REQUEST['tipo_curso_id']:'');
		if(trim($nTipoId)!=''){
			$objTipoCurso->setValues(
				array(
					'tipo_curso_id'=>$nTipoId
				)
			);
		
			$aTipo = $objTipoCurso->getOne();
			//$objTipoCurso->debug($aTipo);

			//Cursos - Lista
			$objCurso->setValues(array(
				'tipo_curso_id'=>$nTipoId
				,'page'=>'1'
				,'rows'=>'100000'
			));
			
		}else{
			//Cursos - Lista
			$objCurso->setValues(array(
				'page'=>'1'
				,'rows'=>'100000'
			));
			
		}
		
		//Projetos - Lista
		$objCurso->setAOrderBy(array(
			'tc.tipo_curso_titulo' => 'ASC'
			,'t.curso_agenda' => 'DESC'
			,'t.curso_dt_ini' => 'DESC'
		));
		
		$aRows = $objCurso->getLista();

		$aMeses = $objCurso->getMeses();
		//$objCurso->debug($aRows);

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
           	  <h1 tabIndex="31" class="orange-color">Cursos</h1>
			  <div class="news-spotlight">
				  <?php 
						echo $aServProjCurInfo['curso_descr'];
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
			}
?>
					<div class="content-box">
                	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="auto">
                    	<tr>
	                        <td valign="top" align="left" width="152"><img tabIndex="35" src="<?=$linkAbsolute;?>images/<?=$v['curso_thumb'];?>" width="152" height="116"  alt="<?=$v['curso_thumb_desc'];?>" title="<?=$v['curso_titulo'];?>"/></td>
							<td valign="top" align="left">
                                <div class="info-head">
									<div class="date">
										<span class="purple-color" tabIndex="32">
											<?=($v['curso_agenda']!='00/00/0000')?$v['curso_agenda']:'';?>
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
											<strong><a tabIndex="33" href="<?=$linkAbsolute;?>curso/<?=$v['curso_id'];?>/<?=$objCurso->toNormaliza($v['curso_titulo']);?>"><?=$v['curso_titulo'];?></a></strong>
										</span>
										<div class="purple-color">
											<?php
													echo 'categoria: ' . $v['tipo_curso_titulo'];
											?>
											<span class="curso-info orange-color">
											<?php if($v['curso_sob_demanda']=='N' && $v['curso_dt_ini']!='00/00/0000'){  ?>
												Período: de <?=$v['curso_dt_ini'];?> até <?=$v['curso_dt_fim'];?>
											<?php }else { ?>
												Período: Sob demanda
											<?php } ?>
											</span>
										</div>
									</dt>
									<dd tabIndex="34">
										<i>
										<?=$v['curso_resumo'];?>
										</i>
									</dd>
								</dl>
                            </td>
                        </tr>
                        <tr>
                        	<td colspan="2"><strong class="more"><a tabIndex="38" href="<?=$linkAbsolute;?>curso/<?=$v['curso_id'];?>/<?=$objCurso->toNormaliza($v['curso_titulo']);?>">ver mais +</a></strong></td>
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
