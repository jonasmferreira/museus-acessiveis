<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php 

		$path_root_page = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_page = "{$path_root_page}{$DS}";
		include_once("{$path_root_page}head.php"); 

		//Carregando os conteúdos da página
		
		include_once("{$path_root_page}adm{$DS}class{$DS}novidade.class.php");
		$objNovidade = new novidade();

		//Novidades 360 - Lista
		$objNovidade->setValues(array(
			'page'=>'1'
			,'rows'=>'100000'
			,'novidade_360_exibir_listagem' => 'S'
		));
		$objNovidade->setAOrderBy(array(
			't.novidade_360_dt_agenda' => 'DESC'
			,'t.novidade_360_dt' => 'DESC'
			,'t.novidade_360_hr' => 'DESC'
		));
		$aRows = $objNovidade->getLista();
		//$objNovidade->debug($aRows);

		$aMeses = $objNovidade->getMeses();
		//$objNovidade->debug($aRows);

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
           	  <h1 tabIndex="31" class="orange-color">Novidades 360º</h1>
              <ul id="list-itens">
              	
<?php

		//montando o array com os dados por mês/ano
		//$aNovidades = array();
		$nAno = 0;
		$nMes = 0;
		$nPos=0;
		$sCloseLi = '';
		foreach($aRows['rows'] as $k => $v){
			$aData = explode('/',$v['novidade_360_dt_agenda']);
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
					<h3>
						<a class="orange-color news-list" href="">
							<?php 
								if($nAno!=0){
									echo $aMeses[$nMes] .'/'. $nAno;
								}else{
									echo 'Sob Demanda';
								}
							?>
						</a>
					</h3>
					<div class="itens <?=($k!=0)? ' inactive': '';?>">
<?php				
				
				}
			}
?>
					<div class="content-box">
                	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="auto">
                    	<tr>
                        	<td valign="top" align="left" width="152"><img tabIndex="35" src="<?=$linkAbsolute;?>images/<?=$v['novidade_360_thumb'];?>" width="152" height="116"  alt="<?=$v['novidade_360_thumb_desc'];?>" title="<?=$v['novidade_360_titulo'];?>"/></td>
	                        <td valign="top" align="left">
                                <div class="info-head">
									<div class="date">
										<span class="purple-color" tabIndex="32">
											<?=($v['novidade_360_dt_agenda']!='00/00/0000')?$v['novidade_360_dt_agenda']:'';?>
										</span>
									</div>
									<div class="social-media">
										<span class="purple-color"><a tabIndex="36" class="purple-color" href="">facebook</a></span>
										<span class="separator">|</span>
										<span class="purple-color"><a tabIndex="37" class="purple-color" href="">twitter</a></span>
									</div>
									<div class="clear"></div>
                              </div>  
                            <dl>
                              	<dt>
                                	<strong><a tabIndex="33" href="<?=$linkAbsolute;?>novidade360/<?=$v['novidade_360_id'];?>/<?=$objNovidade->toNormaliza($v['novidade_360_titulo']);?>"><?=$v['novidade_360_titulo'];?></a></strong>
                                </dt>
                              	<dd tabIndex="34">
                                <i>
                                <?=$v['novidade_360_resumo'];?>
                                </i>
                                </dd>
                            </dl>
                            </td>
                        </tr>
                        <tr>
                        	<td colspan="2"><strong class="more"><a tabIndex="38" href="<?=$linkAbsolute;?>novidade360/<?=$v['novidade_360_id'];?>/<?=$objNovidade->toNormaliza($v['novidade_360_titulo']);?>">ver mais +</a></strong></td>
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
	<div class="clear"></div>
	<?php include_once("{$path_root_page}footer.php"); ?>
</div>
</body>
</html>
