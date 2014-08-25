<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php 

		$path_root_page = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_page = "{$path_root_page}{$DS}";
		include_once("{$path_root_page}head.php"); 

		//Carregando os conteúdos da página
		
		include_once("{$path_root_page}adm{$DS}class{$DS}release.class.php");

		$objRelease = new release();

		//Lista
		$objRelease->setValues(array(
			'page'=>'1'
			,'rows'=>'100000'
		));
		
		$objRelease->setAOrderBy(array(
			't.release_dt' => 'DESC'
			,'t.release_titulo' => 'ASC'
		));

		$aRows = $objRelease->getLista();
		//$objRelease->debug($aRows);

		$aMeses = $objRelease->getMeses();
		//$objRelease->debug($aRows);

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
           	  <h1 tabIndex="31" class="orange-color">Release</h1>
              <ul id="list-itens">
              	
<?php

		//montando o array com os dados por mês/ano
		//$aRowss = array();
		$nAno = 0;
		$nMes = 0;
		$nPos=0;
		$sCloseLi = '';
		foreach($aRows['rows'] as $k => $v){
			$aData = explode('-',$v['release_dt']);
			if($nAno!=$aData[2]||$nMes!=$aData[1]){
				$nAno = $aData[0];
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
	                        <td valign="top" align="left" width="152">
								<img tabIndex="35" src="<?=$linkAbsolute;?>images/<?=$v['release_thumb'];?>" width="152" height="116"  alt="<?=$v['release_thumb_desc'];?>" title="<?=$v['release_titulo'];?>"/>
							</td>
							<td valign="top" align="left">
                                <div class="info-head">
									<div class="date">
										<span class="purple-color" tabIndex="32">
											<?=$objRelease->dateDB2BR($v['release_dt']);?>
										</span>
									</div>
									<div class="social-media">
										<?php 
											$urlPost = $linkAbsolute . 'release/' . $v['release_id'] . '/'. $objRelease->toNormaliza($v['release_titulo']);
											$titlePost = $aRows['release_titulo'];
										?>
										<div class="fb-share-button" data-href="<?=$urlPost;?>"></div>										
										<span class="purple-color">
											<a tabIndex="36" class="purple-color" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?=$urlPost;?>">facebook</a>
										</span>
										<span class="separator">|</span>
										<span class="purple-color">
											<a tabIndex="37" class="purple-color" href="http://twitter.com/share?text=<?=$urlTitle;?>&url=<?=$urlPost;?>&counturl=<?=$urlPost;?>&via=joynilson" target="_blank">
												twitter
											</a>										
										</span>
									</div>
									<div class="clear"></div>
								</div> 
								<dl class="content-list-itens">
									<dt>
										<span class="orange-color" tabIndex="32">
											<strong>
												<a tabIndex="33" href="<?=$linkAbsolute;?>release/<?=$v['release_id'];?>/<?=$objRelease->toNormaliza($v['release_titulo']);?>">
													<?=$v['release_titulo'];?>
												</a>
											</strong>
										</span>
									</dt>
									<dd tabIndex="34">
										<i>
										<?=$v['release_resumo'];?>
										</i>
									</dd>
								</dl>
                            </td>
                        </tr>
                        <tr>
                        	<td colspan="2">
								<strong class="more">
									<a tabIndex="38" href="<?=$linkAbsolute;?>release/<?=$v['release_id'];?>/<?=$objRelease->toNormaliza($v['release_titulo']);?>">
										ver mais +
									</a>
								</strong>
							</td>
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
