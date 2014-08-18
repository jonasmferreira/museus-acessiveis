<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php 

		$path_root_page = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_page = "{$path_root_page}{$DS}";
		include_once("{$path_root_page}head.php"); 

		//Carregando os conteúdos da página
		
		include_once("{$path_root_page}adm{$DS}class{$DS}depoimento.class.php");

		$objDepoimento = new depoimento();

		$objDepoimento->setValues(array(
			'page'=>'1'
			,'rows'=>'100000'
		));
		
		$objDepoimento->setAOrderBy(array(
			't.depoimento_dt'=>'DESC'
		));

		$aRows = $objDepoimento->getLista();
		//$objDepoimento->debug($aRows);

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
           	  <h1 tabIndex="31" class="orange-color">Depoimentos</h1>
			  <!--div class="news-spotlight">
			  </div-->
<?php	foreach($aRows['rows'] as $k => $v){ ?>				
					<div class="content-box">
                	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="auto">
                    	<tr>
							<td valign="top" align="left">
                                <div class="info-head">
									<div class="date">
										<span class="purple-color" tabIndex="32">
											<?=($v['depoimento_dt']!='00/00/0000')?$v['depoimento_dt']:'';?>
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
											<strong><?=$v['depoimento_autor'];?></strong>
										</span>
										<span class="orange-color" tabIndex="32">
											<strong><?=$v['depoimento_empresa'];?></strong>
										</span>
									</dt>
									<dd tabIndex="34">
										<div>
										<?=$v['depoimento_conteudo'];?>
										<div>
									</dd>
								</dl>
                            </td>
                        </tr>
                    </table>
                </div>  
						
<?php						
		}
?>
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
