<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php

		$path_root_page = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_page = "{$path_root_page}{$DS}";

		//configuração de url absoluta
		include_once("{$path_root_page}adm{$DS}class{$DS}configuracao.class.php");
		$objConfig = new configuracao();
		$aConfig = $objConfig->getOne();
		//$objConfig->debug($aConfig);

		$linkAbsolute=$aConfig['configuracao_baseurl'];
		$seqAleatoria = "rnd=".str_replace(".","",microtime(true));

		$author = $aConfig['configuracao_meta_author'];
		$keywords = $aConfig['configuracao_meta_keywords'];
		$description = $aConfig['configuracao_meta_description'];

		
		include_once("{$path_root_page}adm{$DS}class{$DS}emailmkt.class.php");
		$objEmkt = new emailmkt();

		$nId = (isset($_REQUEST['emailmkt_id'])?$_REQUEST['emailmkt_id']:0);
		$nEmkt = (isset($_REQUEST['emailmkt_emkt'])?$_REQUEST['emailmkt_emkt']:0);

		$objEmkt->setValues(
			array(
				'emailmkt_id'=>$nId
			)
		);
		$aNewsletter = $objEmkt->getOne();
		//$objEmkt->debug($aNewsletter);
	?>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Museus Acessíveis - <?=$aNewsletter['emailmkt_titulo'];?></title>

	<meta name="description" content="<?=$description;?>">
	<meta name="keywords" content="<?=$keywords;?>">
	<meta name="author" content="<?=$author;?>">

	<link rel="shortcut icon" href="<?=$linkAbsolute?>img/favicon.ico?<?=$seqAleatoria?>" type="image/x-icon" />
	<link rel="stylesheet" href="<?=$linkAbsolute?>plugins/lightbox/css/lightbox.css?<?=$seqAleatoria?>" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?=$linkAbsolute?>plugins/css/south-street/jquery-ui-1.10.4.custom.min.css?<?=$seqAleatoria?>" />
	<script src="<?=$linkAbsolute?>plugins/jquery-1.10.2.min.js?<?=$seqAleatoria?>"></script>
	<script src="<?=$linkAbsolute?>plugins/jquery-migrate.js?rnd=<?=$seqAleatoria?>" type="text/javascript"></script>
	<script src="<?=$linkAbsolute?>plugins/lightbox/js/lightbox-2.6.min.js?<?=$seqAleatoria?>"></script>

	<script src="<?=$linkAbsolute?>plugins/shortcut.js?<?=$seqAleatoria?>"></script>
	<script src="<?=$linkAbsolute?>plugins/cookie.js?<?=$seqAleatoria?>"></script>
	<script src="<?=$linkAbsolute?>plugins/fontSize.js?<?=$seqAleatoria?>"></script>
	<script src="<?=$linkAbsolute?>plugins/jquery-ui-1.10.4.custom.min.js?rnd=<?=$seqAleatoria?>" type="text/javascript"></script>
	<script src="<?=$linkAbsolute?>plugins/jquery-ui-i18n.js?rnd=<?=$seqAleatoria?>" type="text/javascript"></script>
	<script src="<?=$linkAbsolute?>plugins/jquery-ui-timepicker-addon.js?rnd=<?=$seqAleatoria?>" type="text/javascript"></script>
	<script src="<?=$linkAbsolute?>plugins/jquery.cycle.all.js?rnd=<?=$seqAleatoria?>" type="text/javascript"></script>
	<script type="text/javascript">
		linkAbsolute = '<?=$linkAbsolute?>';
	</script>
	<script src="<?=$linkAbsolute?>js/functions2.js?<?=$seqAleatoria?>"></script>
	<!--link rel="stylesheet" href="<?=$linkAbsolute?>css/newsletter.css?<?=$seqAleatoria?>" type="text/css" media="screen" /-->
</head>
<body style="margin:0; padding:0; border:0; background: #FFF url('<?=$linkAbsolute;?>img/emkt_bg.gif') left top repeat; font-family:Verdana, Helvetica, sans-serif; color: #565652;">
<div id="root" style="width:680px; margin:0 auto; background-color:#FFF;">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
    	<tr>
        	<td align="center" class="news-info" height="30" style="font-size:11px; color:#000;">
            	<span style="font-weight:bold;">Acessibilidade 360º: </span>Se você não consegue visualizar este e-mail, <a style="color: #FF0000; text-decoration: none !important;" href="<?=$linkAbsolute?>boletim/<?=$aNewsletter['emailmkt_id'];?>" target="_blank">clique aqui!</a>
            </td>
        </tr>
    </table>

	<!-- ACCESSBAR -->
	<div style="height: 28px;padding: 11px 0 0 24px;margin: 0 auto;color:#FFF;font-size:9px;background-color: #000;" href="access-bar" accesskey="1" id="access-bar" class="fixedSize">
    	<span style="font-weight: bold;text-transform: uppercase;padding-right:30px;" class="title fixedSize">opções de acessibilidade</span>

    	<span style="font-weight: bold;text-transform: uppercase;" class="title fixedSize">tipo de contraste:</span>
    	<span style="font-weight: normal;text-decoration: underline;" class="option fixedSize"><a style="color: #FFF;padding: 0 3px 0 0;text-decoration:underline;" id="normal-view" href="javascript:void(0);" tabIndex="1">Contraste Padrão</a></span>
    	<span style="font-weight: normal;text-decoration: underline;" class="option fixedSize"><a style="color: #FFF;padding: 0 3px 0 0;text-decoration:underline;" id="contrast-view" href="javascript:void(0);" tabIndex="2">Contraste Invertido</a></span>

    	<span style="font-weight: bold;text-transform: uppercase;" class="title fixedSize">tamanho da fonte</span>
        <p style="display:inline;" id="fontSize">
            <span style="font-weight: normal;text-decoration: underline;" class="option"><a style="color: #FFF;padding: 0 3px 0 0;text-decoration:underline;" tabIndex="3" href="javascript:void(0);" id="font-minus">A-</a></span>
            <span style="font-weight: normal;text-decoration: underline;" class="option"><a style="color: #FFF;padding: 0 3px 0 0;text-decoration:underline;" tabIndex="4" href="javascript:void(0);" id="font-plus">A+</a></span>
        </p>
    </div>
	
	<div id="header" style="height: 255px;background: #FFF url('<?=$linkAbsolute;?>img/emkt_bg_top.gif') left top repeat-x;">
		<table border="0" cellpadding="0" cellspacing="0" width="654">
		  <tr>
			<td width="248" valign="middle" align="right">
				<img src="<?=$linkAbsolute?>img/emkt_logo_museus.png" width="248" height="255"  alt="Museus Acessíveis - Cultura + Acessibilidade 360º" title="Museus Acessíveis - Cultura + Acessibilidade 360º"/>
			</td>
			<td style="background: url('<?=$linkAbsolute;?>img/emkt_title.png') left 35px no-repeat;padding:200px 0 0 0;" class="title" valign="middle" align="center">
				<?php
					$sDt = $aNewsletter['emailmkt_dt_agendada'];
					$aDt = explode('-',$sDt);
					$sMes = $objEmkt->getMes($aDt[1]);
				?>
				<span style="background: #666;padding: 2px 5px;font-size: 13px;color: #FFF;margin: 0 0 0 10px;" id="edicao">
					<a style="color: #FFF;text-decoration: none !important;" href="<?=$linkAbsolute?>boletim/<?=$aNewsletter['emailmkt_id'];?>" target="_blank">
						Edição <?php echo $sMes;?> | <?php echo $aDt[0];?>
					</a>
				</span>
			</td>
		  </tr>

		</table>
	</div>

	<?php
		$aProj = $objEmkt->getProjetosByIds($aNewsletter['emailmkt_projeto_ids']);
		//$objEmkt->debug($aProj);
		foreach($aProj as $k => $v){
	?>
	<div id="project" style="padding: 34px 31px 30px 16px;">
		<div class="outdoor" style="margin: 0 0 17px 46px;background: url('<?=$linkAbsolute;?>img/emkt_projeto_bg.png') left top no-repeat;width: 568px;height: 227px;padding: 10px;">
			<img src="<?=$linkAbsolute?>images/<?=$v['projeto_thumb']?>" width="569" height="227"  alt="<?=$v['projeto_thumb_desc']?>"/>
		</div>
		<h1 style="margin:0; font-size:28px; display: block; background: url('<?=$linkAbsolute;?>img/emkt_projeto_ico.png') left top no-repeat; padding: 7px 0 0 56px;color: #632d8b;height: 48px;overflow: visible;" class="project-title">
			<?=$v['projeto_titulo']?>
		</h1>
		<div class="description" style="padding: 18px 0 0 40px;">
		<p style="font-size: 14px;color: #565652;line-height: 21px;padding: 0 0 20px 0;margin:0;">
			<?=$v['projeto_resumo']?>
		</p>
		<a style="text-decoration: none !important;padding: 5px;background: #000;font-weight: bold;font-size: 14px;color: #FFF;" href="<?=$linkAbsolute;?>projeto/<?=$v['projeto_id'];?>/<?=$objEmkt->toNormaliza($v['projeto_titulo']);?>/<?=$aNewsletter['emailmkt_id'];?>" class="saibamais">Leia mais</a>
		</div>
	</div>
	<?php } ?>

	<img class="separator" style="margin: 30px 0 30px 30px;" src="<?=$linkAbsolute?>img/emkt_bg_separator.png" width="564" height="19"  alt=""/> 

	<?php
		$aGloss = $objEmkt->getGlossariosByIds($aNewsletter['emailmkt_glossario_ids']);
		//$objEmkt->debug($aGloss);
		foreach($aGloss as $k => $v){
	?>
	<div id="acessibilidade" style="margin: 0 0 10px 47px;width: 594px;padding: 0 0 5px 0;overflow: visible;background: url('<?=$linkAbsolute;?>img/emkt_access_bg_purple2.png') left bottom no-repeat;">
		<div class="box" style="padding: 10px 0 5px 0;background: url('<?=$linkAbsolute;?>img/emkt_access_bg_purple1.png') left top no-repeat;">
			<div class="word-box" style="margin: 0px 0 0 4px;width: 565px;overflow: visible;padding: 20px 0 25px 15px;background: url('<?=$linkAbsolute;?>img/emkt_access_bg_yellow.png') left top repeat-y;">
				<h2 class="word" style="margin:0;color: #632d8b;font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;width:548px;font-size: 65px;padding: 20px 0 0 0;text-align: center;font-weight: normal;background: url('<?=$linkAbsolute;?>img/emkt_access_word_bg.png') left top no-repeat;">
					<?=$v['glossario_palavra'];?>
				</h2>
				<p class="description" style="margin:0;width: 488px;padding: 20px 0 20px 58px;text-align: center;color: #632d8b;font-size: 14px;font-weight: bold;">
					<?=$v['glossario_definicao'];?>
				</p>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td align="center">
						<a style="padding: 5px;background: #000;font-weight: bold;font-size: 14px;color: #FFF;text-decoration: none !important;" href="<?=$linkAbsolute;?>glossario/<?=$v['glossario_id'];?>/<?=$objEmkt->toNormaliza($v['glossario_palavra']);?>/<?=$aNewsletter['emailmkt_id'];?>" class="glossario">Conheça o Glossário da Acessibilidade</a>
					</td>
				</tr>
			</table>
			</div>
		</div>
	</div> 
	<?php } ?>

	<img class="separator" style="margin: 30px 0 30px 30px;" src="<?=$linkAbsolute?>img/emkt_bg_separator.png" width="564" height="19"  alt=""/> 


	<div id="news" style="padding: 0 0 30px 16px;">
		<h1 class="news-title" style="font-size:28px;display: block;margin:0;padding: 7px 0 0 56px;color: #28b297;height: 48px;overflow: visible;text-transform: uppercase;background: url('<?=$linkAbsolute;?>img/emkt_news360_ico.png') left top no-repeat;">
			Novidades 360º
		</h1>
		<table cellpading="0" cellspacing="0" border="0" width="87%" style="margin: 0 0 0 45px;padding:0; border:0;">
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<?php
				$aNovidade = $objEmkt->getNovidadesByIds($aNewsletter['emailmkt_novidade360_id']);
				foreach($aNovidade as $k => $v){
			?>
			<tr>
				<td width="171" align="left" valign="top">
					<img src="<?=$linkAbsolute;?>images/<?=$v['novidade_360_thumb'];?>" alt="<?=$v['novidade_360_thumb_desc'];?>" width="158" height="157"/>
				</td>
				<td width="403" class="news-resumo" style="padding: 0 0 50px 0;margin:0;">
					<h3 style="color: #28b297;font-size: 19px;font-style: italic;font-weight: bold;margin:0;padding:0;" class="title">
						<?=$v['novidade_360_titulo'];?>
					</h3>
					<br class="clear" style="clear:both;" />
					<p class="description" style="font-size: 14px;color: #565652;line-height: 21px;padding: 0 0 20px 0;margin:0;">
						<?=$v['novidade_360_resumo'];?>
					</p>
					<a style="text-decoration: none !important;padding: 5px;background: #000;font-weight: bold;font-size: 14px;color: #FFF;" href="<?=$linkAbsolute;?>novidade360/<?=$v['novidade_360_id'];?>/<?=$objEmkt->toNormaliza($v['novidade_360_titulo']);?>/<?=$aNewsletter['emailmkt_id'];?>" class="saibamais">Saiba mais</a>                
				</td>
			</tr>
		  <?php } ?>

			<tr>
				<td>&nbsp;</td>
				<td align="left" valign="top">
					<ul class="news-list" style="margin:0; padding:0; border:0;display: block;">
						<?php
							$aNovidades360 = $objEmkt->getNovidadesByIds($aNewsletter['emailmkt_novidade360_ids']);
							//$objEmkt->debug($aNew);
							foreach($aNovidades360 as $k => $v){
						?>
						<li style="display: block;margin: 0;padding: 10px 0;border-bottom: 1px solid #6f6f6e;">
							<h3 style="font-size:19px;font-weight:normal;margin:0;padding:0;" class="title">
								<a style="color: #28b297;font-size: 19px;font-style: italic;font-weight: bold;text-decoration: none !important;" href="<?=$linkAbsolute;?>novidade360/<?=$v['novidade_360_id'];?>/<?=$objEmkt->toNormaliza($v['novidade_360_titulo']);?>/<?=$aNewsletter['emailmkt_id'];?>"><?=$v['novidade_360_titulo'];?></a>
							</h3>  
						</li>
						<?php } ?>
					</ul>
					<br class="clear" style="clear:both;" />            
					<a style="text-decoration: none !important;padding: 5px;background: #000;font-weight: bold;font-size: 14px;color: #FFF;" href="<?=$linkAbsolute;?>novidade360/<?=$aNewsletter['emailmkt_id'];?>" class="saibamais" class="saibamais">Mais novidades</a>
				</td>
			</tr>
		</table>
	</div>

	<img class="separator" style="margin: 30px 0 30px 30px;" src="<?=$linkAbsolute?>img/emkt_bg_separator.png" width="564" height="19"  alt=""/> 

	<div id="aquitem" style="padding: 0 31px 30px 16px;background: url('<?=$linkAbsolute;?>img/emkt_bg_bottom.png') left bottom no-repeat;">
		<h1 style="font-size:28px;display: block;padding: 7px 0 0 56px;margin:0;color: #4d4d4d;height: 48px;overflow: visible;text-transform: uppercase;background: url('<?=$linkAbsolute;?>img/emkt_aquitem_ico.png') left top no-repeat;" class="news-title">Aqui tem Acessibilidade</h1>
		<table cellpading="0" cellspacing="0" border="0" width="87%" style="margin: 0 0 0 45px;padding:0;border:0;">
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td width="185" align="left" valign="top">
					<img src="<?=$linkAbsolute;?>imgEmkt/<?=$aNewsletter['emailmkt_aqui_tem_thumb'];?>" alt="" />
				</td>
				<td width="362" class="news-resumo" style="padding: 0 0 50px 0;">
					<h3 style="margin:0;padding:0;color: #4d4d4d;font-size: 19px;font-style: italic;font-weight: bold;" class="title"><?=$aNewsletter['emailmkt_aqui_tem_titulo'];?></h3>
					<br class="clear" style="clear:both;" />
					<p class="description" style="font-size: 14px;color: #565652;line-height: 21px;padding: 0 0 20px 0;margin: 0;">
						<?=$aNewsletter['emailmkt_aqui_tem_resumo'];?>
					</p>
					<?php
						$aLink = explode('http://', $aNewsletter['emailmkt_aqui_tem_url']);
						if(count($aLink)>1){
							$sLink = $aNewsletter['emailmkt_aqui_tem_url'];
						}else{
							$sLink = 'http://'.$aNewsletter['emailmkt_aqui_tem_url'];
						}
					?>
					<a style="text-decoration: none !important;padding: 5px;background: #000;font-weight: bold;font-size: 14px;color: #FFF;" target="_blank" href="<?=$sLink;?>" class="saibamais">
						Saiba mais
					</a>                
				</td>
			</tr>
			<tr>
				<td colspan="2" valign="middle" align="center" height="350">
					<a style="color: #565652;text-decoration: none !important;" href="mailto:viviane@museusacessiveis.com.br">
						<img src="<?=$linkAbsolute;?>img/emkt_contact_bt.png" width="261" height="269"  alt=""/>
					</a>
				</td>
			</tr>
		</table>
	</div>

	<div id="schedule" style="padding: 40px 31px 30px 16px;background: #f3fefe url('<?=$linkAbsolute;?>img/emkt_schedule_box_bg.gif') left bottom repeat-x;">
		<h1 style="font-size:28px;margin:0;display: block;padding: 7px 0 0 56px;color: #632d8b;height: 48px;overflow: visible;text-transform: uppercase;line-height: 32px;background: url('<?=$linkAbsolute;?>img/emkt_schedule_ico.png') left top no-repeat;" class="title">Agenda Brasil<br />de Acessibilidade</h1>
		<div id="schedule-box" style="padding: 40px 60px;">
			<?php
				$aAgendas = array();
				//Agenda
				if(trim($aNewsletter['emailmkt_agenda_ids'])!=''){
					$aAgendasId = explode(",",$aNewsletter['emailmkt_agenda_ids']);
					$aArr = array();
					foreach($aAgendasId AS $v){
						$aRepar = explode("=>",$v);
						$aArr[$aRepar[1]][] = $aRepar[0];
					}
					$aN = (isset($aArr['N']))?implode(",",$aArr['N']):"''";
					$aP = (isset($aArr['P']))?implode(",",$aArr['P']):"''";
					$aC = (isset($aArr['C']))?implode(",",$aArr['C']):"''";
					$aS = (isset($aArr['S']))?implode(",",$aArr['S']):"''";
					$aAgendaTmp = $objEmkt->getAgendaByIds($aN,$aP,$aC,$aS);
					$aAgendas = array_chunk($aAgendaTmp, 3);

				}
			?>
			<table width=100% cellpadding="0" cellspacing="0" border="0">
				<?	foreach($aAgendas AS $aAgenda):?>
				<tr>
					<?	foreach($aAgenda AS $v):?>
					<td valign="top" align="center" width="33%" height="240">
						<div class="day-box" style="width: 123px;height: 122px;	padding: 22px 0 0 0;text-align: center;margin: 0 auto;background: url('<?=$linkAbsolute;?>img/emkt_schedule_bg.png') left top no-repeat;">
							<span class="day" style="font-size: 80px;font-weight: bold;color: #f37920;"><?=$v['item_dt_agenda_dia']?></span>
							<span class="month" style="font-size: 15px;font-weight: bold;text-transform: uppercase;color: #f37920;"><?=$v['item_dt_agenda_mes_label']?></span>
						</div>                
						<div class="title">
							<a style="margin: 20px 0 0 0;font-size:17px;font-style: italic;font-weight: bold;color: #f37920;text-align: center;text-decoration: none !important;" href="<?=$v['item_link'];?>/<?=$aNewsletter['emailmkt_id'];?>">
								<?=$v['item_titulo']?>
							</a>
						</div>
					</td>
					<?	endforeach;?>
				</tr>
				<?	endforeach;?>
				<tr>
					<td align="center" colspan="3" style="padding-top: 10px">
						<a style="padding: 5px;background: #000;font-weight: bold;font-size: 14px;color: #FFF;text-decoration: none !important;" class="saibamais" href="javascript:void(0);">
							Fique por dentro da Agenda Brasil de Acessibilidade
						</a>
					</td>
				</tr>
			</table>
		</div>
	</div>  

	<div id="propaganda" style="padding: 23px 0;text-align: center;"><br />
		<a style="color: #565652;text-decoration: none !important;" href="<?=$aNewsletter['emailmkt_propaganda_url'];?>" target="_blank"><br />
			<img src="<?=$linkAbsolute;?>imgEmkt/<?=$aNewsletter['emailmkt_propaganda_img'];?>" width="634" height="634"  alt=""/>
		</a> 
	</div> 

	<div id="footer" href="footer" accesskey="5" style="background: #632d8b;padding: 65px 0 0 37px;font-size: 17px;color: #FFF;">
		<table style="border: 0;padding: 0 0 30px 0;margin: 0;background: url('<?=$linkAbsolute;?>img/emkt_footer_bg.png') 370px bottom no-repeat;">
			<tr>
				<td class="contact" style="width: 370px;font-size: 17px;">
					<div id="contact">
						<strong tabIndex="114">Contatos</strong>

					<?php
						$objEmkt->setValues(array(
							'contato_exibir'=>'S'
						));
						$aContato = $objEmkt->getContatos();
						//$objEmkt->debug($aContato);
						$devices=array();
						$sites=array();
						$aEmail = array();
						$aSite = array();
						$aFacebook = array();
						
						foreach($aContato as $k => $v){
							$tipo=strtolower($v['contato_tipo']);
							if(strtolower($v['contato_tipo'])=='e-mail'){
								$aEmail[]=$v['contato_link'];
							}elseif(strtolower($v['contato_tipo'])=='site'){
								$aSite[]=$v['contato_link'];
							}elseif(strtolower($v['contato_tipo'])=='facebook'){
								$aFacebook[$k]['contato_nome']=$v['contato_nome'];
								$aFacebook[$k]['contato_link']=$v['contato_link'];
							}
							
							if($tipo=='celular' || $tipo=='telefone' || $tipo=='facebook' || $tipo=='twitter' || $tipo=='skype'){
								$devices[$k]['contato_tipo']=$v['contato_tipo'];
								$devices[$k]['contato_nome']=$v['contato_nome'];
								$devices[$k]['contato_link']=$v['contato_link'];
								$devices[$k]['contato_tipo_icone']=$v['contato_tipo_icone'];
								$devices[$k]['contato_tipo_icone_contraste']=$v['contato_tipo_icone_contraste'];
							}else{
								$sites[$k]['contato_tipo']=$v['contato_tipo'];
								$sites[$k]['contato_nome']=$v['contato_nome'];
								$sites[$k]['contato_link']=$v['contato_link'];
								$sites[$k]['contato_tipo_icone']=$v['contato_tipo_icone'];
								$sites[$k]['contato_tipo_icone_contraste']=$v['contato_tipo_icone_contraste'];
							}

						}
						//$objEmkt->debug($devices);
					?>
						
						<div id="devices" style="padding: 25px 0 3px 0;">
							<span tabIndex="117" class="facebook" style="display: block;padding: 0 0 0 20px; background: url('<?=$linkAbsolute;?>img/ico_facebook.png') left center no-repeat;">
							<?php 
								foreach($aFacebook as $k => $v){
							?>
								<a style="color: #FFF;text-decoration: none;" href="<?php echo $v['contato_link'];?>" target="_blank">
									<?php echo $v['contato_nome'];?>
								</a>
							<?php } ?>
							</span>
						</div>
						<div id="web" style="padding: 0 0 30px 20px;">
							<?php 
								foreach($aEmail as $k => $v){
							?>
								<a style="text-decoration: none;color: #FFF;" href="mailto:<?php echo $v;?>"><?php echo $v;?></a><br />
							<?php } ?>
							<?php 
								foreach($aSite as $k => $v){
							?>
								<a style="text-decoration: none;color: #FFF;" target="_blank" href="<?php echo $v;?>"><?php echo $v;?></a><br />
							<?php } ?>
							
							
						</div>
					</div>
				</td>
				<td class="opcoes" style="width: 220px;font-size: 11px;text-transform: uppercase;text-align: right;">
					opções de acessibilidade
				</td>
			</tr>
			<tr>
				<td align="center">
					<a style="color: #FFF;text-decoration: none !important;" href="#">
						<img class="ico" style="margin: 0 5px;" src="<?=$linkAbsolute;?>img/emkt_facebook_ico.png" width="25" height="25"  alt=""/>
					</a>
					<a style="color: #FFF;text-decoration: none !important;" href="#">
						<img class="ico" style="margin: 0 5px;" src="<?=$linkAbsolute;?>img/emkt_linkedin_ico.png" width="25" height="25"  alt=""/>
					</a>
					<a style="color: #FFF;text-decoration: none !important;" href="#">
						<img class="ico" style="margin: 0 5px;" src="<?=$linkAbsolute;?>img/emkt_twitter_ico.png" width="25" height="25"  alt=""/>
					</a>
					<a style="color: #FFF;text-decoration: none !important;" href="#">
						<img class="ico" style="margin: 0 5px;" src="<?=$linkAbsolute;?>img/emkt_googleplus_ico.png" width="25" height="25"  alt=""/>
					</a>
					<a style="color: #FFF;text-decoration: none !important;" href="#">
						<img class="ico" style="margin: 0 5px;" src="<?=$linkAbsolute;?>img/emkt_paper_ico.png" width="25" height="25"  alt=""/>
					</a>
					<a style="color: #FFF;text-decoration: none !important;" href="#">
						<img class="ico" style="margin: 0 5px;" src="<?=$linkAbsolute;?>img/emkt_star_ico.png" width="25" height="25"  alt=""/>
					</a>
					<a style="color: #FFF;text-decoration: none !important;" href="#">
						<img class="ico" style="margin: 0 5px;" src="<?=$linkAbsolute;?>img/emkt_email_ico.png" width="25" height="25"  alt=""/>
					</a>
				</td>
				<td align="center">&nbsp;</td>
			</tr>
		</table>
		<div class="clear" style="clear:both;"></div>
	</div>  
	
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="center" class="news-info" height="30" style="font-size:11px; color:#000;">
				<span style="font-weight:bold;">Política anti-spam:</span> Se você não deseja mais receber este e-mail, <a style="color: #FF0000;text-decoration: none !important;" href="#" target="_blank">clique aqui!</a>
			</td>
		</tr>
	</table>
</div>
</body>
</html>
