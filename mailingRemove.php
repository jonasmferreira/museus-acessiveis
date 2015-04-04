<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php 

		$path_root_page = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_page = "{$path_root_page}{$DS}";
		include_once("{$path_root_page}head.php"); 

		//Carregando os conteúdos da página
		
		include_once("{$path_root_page}adm{$DS}class{$DS}mailing.class.php");
		$objMailing = new mailing();

		$nId = (isset($_REQUEST['mailing_id'])?$_REQUEST['mailing_id']:'');
		$sEmail = (isset($_REQUEST['mailing_email'])?$_REQUEST['mailing_email']:'');
		
		$aRow=array();
		if(trim($nId)!=''){
			$objMailing->setValues(
				array(
					'mailing_id'=>$nId
					,'mailing_email'=>$sEmail
				)
			);
			$aRow = $objMailing->getSubscribeItem();
			//$objMailing->debug($aRow);
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
			<div id="outdoor-news"></div>        	
            <div id="news360" class="list">
           	  <h1 tabIndex="31" class="orange-color">Boletim Acessível - Descadastrar</h1>


              <ul id="list-itens">
								<li class="month-list">
									<div class="itens">
									<div class="content-box">
										<form action="javascript:void(0);" method="POST" id="remove_from_mailing">
												<?php 
													if(count($aRow)>0) {
												?>
														<p class="description" tabIndex="" >
															Confira seus dados e clique no botão "remover" para que seu e-mail seja removido dos próximos boletins acessíveis.<br /><br />
														</p>													
														<table border="0" cellpadding="0" cellspacing="0" width="95%" tabIndex="" >
																<tr>
																		<td>
																			<span><b>Nome: </b></span><?php echo $aRow['mailing_nome']; ?> <br />
																			<span><b>E-mail: </b></span><?php echo $aRow['mailing_email']; ?> <br /><br /><br />
																		</td>
																		<td>
																			<input tabIndex="" name="mailing_email" id="mailing_email" type="hidden" class="field" value="<?php echo $aRow['mailing_email']; ?>" />
																			<input tabIndex="" type="image" class="bt-newsletter" width="39" height="15" src="<?=$linkAbsolute?>img/search-bt_transparent.png" />
																		</td>
																</tr>
														</table>
													<?php } else { ?>
														<p class="description" tabIndex="" >
															Digite seu e-mail e clique no botão "remover" para que seu e-mail seja removido dos próximos boletins acessíveis.<br /><br />
														</p>													
														<table border="0" cellpadding="0" cellspacing="0" width="95%" tabIndex="" >
																<tr>
																		<td>
																			<input tabIndex="" width="150" name="mailing_email" id="mailing_email" type="text" class="field" value="Digite seu e-mail" />
																		</td>
																		<td>
																			<input tabIndex="" type="image" class="bt-newsletter" width="39" height="15" src="<?=$linkAbsolute?>img/search-bt_transparent.png" />
																		</td>
																</tr>
														</table>
												
													<?php } ?>
												<div class="clear"></div>
										</form>
									</div>  

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
