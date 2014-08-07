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
	<link rel="stylesheet" href="<?=$linkAbsolute?>css/newsletter.css?<?=$seqAleatoria?>" type="text/css" media="screen" />
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

</head>

<body>
<div id="root">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
    	<tr>
        	<td align="center" class="news-info" height="30">
            	Se você não consegue visualizar este e-mail, <a href="<?=$linkAbsolute?>newsletter/<?=$aNewsletter['emailmkt_id'];?>/<?=$aNewsletter['emailmkt_emkt'];?>" target="_blank">clique aqui!</a>
            </td>
        </tr>
    </table>

	<!-- ACCESSBAR -->
	<div href="access-bar" accesskey="1" id="access-bar" class="fixedSize">
    	<span class="title fixedSize" style="padding-right:30px;">opções de acessibilidade</span>

    	<span class="title fixedSize">tipo de contraste:</span>
    	<span class="option fixedSize"><a id="normal-view" href="javascript:void(0);" tabIndex="1">Contraste Padrão</a></span>
    	<span class="option fixedSize"><a id="contrast-view" href="javascript:void(0);" tabIndex="2">Contraste Invertido</a></span>

    	<span class="title fixedSize">tamanho da fonte</span>
        <p id="fontSize">
            <span class="option"><a tabIndex="3" href="javascript:void(0);" id="font-minus">A-</a></span>
            <span class="option"><a tabIndex="4" href="javascript:void(0);" id="font-plus">A+</a></span>
        </p>
    </div>
	
	<div id="header">
		<table border="0" cellpadding="0" cellspacing="0" width="654">
		  <tr>
			<td width="248" valign="middle" align="right"><img src="<?=$linkAbsolute?>img/emkt_logo_museus.png" width="248" height="255"  alt="Museus Acessíveis - Cultura + Acessibilidade 360º" title="Museus Acessíveis - Cultura + Acessibilidade 360º"/></td>
			<td class="title" valign="middle" align="center">
				<?php
					$sDt = $aNewsletter['emailmkt_dt_agendada'];
					$aDt = explode('-',$sDt);
					$sMes = $objEmkt->getMes($aDt[1]);
				?>
				<span id="edicao"><a href="#" target="_blank">Edição <?php echo $sMes;?> | <?php echo $aDt[0];?></a></span>
			</td>
		  </tr>

		</table>
	</div>

	<?php
		$aProj = $objEmkt->getProjetosByIds($aNewsletter['emailmkt_projeto_ids']);
		//$objEmkt->debug($aProj);
		foreach($aProj as $k => $v){
	?>
	<div id="project">

		<div class="outdoor">
			<img src="<?=$linkAbsolute?>images/<?=$v['projeto_thumb']?>" width="569" height="227"  alt=""/>
		</div>
		<h1 class="project-title"><?=$v['projeto_titulo']?></h1>
		<div class="description">
		<p><?=$v['projeto_resumo']?></p>
		<a href="<?=$linkAbsolute;?>projeto/<?=$v['projeto_id'];?>/<?=$objEmkt->toNormaliza($v['projeto_titulo']);?>" class="saibamais">Leia mais</a>
		</div>
	</div>
	<?php } ?>

	<img class="separator" src="<?=$linkAbsolute?>img/emkt_bg_separator.png" width="564" height="19"  alt=""/> 

	<?php
		$aGloss = $objEmkt->getGlossariosByIds($aNewsletter['emailmkt_glossario_ids']);
		//$objEmkt->debug($aGloss);
		foreach($aGloss as $k => $v){
	?>
	<div id="acessibilidade">
		<div class="box">
			<div class="word-box">
				<h2 class="word"><?=$v['glossario_palavra'];?></h2>
				<p class="description">
					<?=$v['glossario_definicao'];?>
				</p>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td align="center">
						<a href="<?=$linkAbsolute;?>glossario/<?=$v['glossario_id'];?>/<?=$objEmkt->toNormaliza($v['glossario_palavra']);?>" class="glossario">Conheça o Glossário da Acessibilidade</a>
					</td>
				</tr>
			</table>
			</div>
		</div>
	</div> 
	<?php } ?>

	<img class="separator" src="img/emkt_bg_separator.png" width="564" height="19"  alt=""/> 


	<div id="news">
		<h1 class="news-title">Novidades 360º</h1>
		<table cellpading="0" cellspacing="0" border="0" width="87%">
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
				<td width="403" class="news-resumo">
					<h3 class="title"><?=$v['novidade_360_titulo'];?></h3>
					<br class="clear" />
					<p class="description">
						<?=$v['novidade_360_resumo'];?>
					</p>
					<a href="<?=$linkAbsolute;?>novidade360/<?=$v['novidade_360_id'];?>/<?=$objEmkt->toNormaliza($v['novidade_360_titulo']);?>" class="saibamais">Saiba mais</a>                
				</td>
			</tr>
		  <?php } ?>

			<tr>
				<td>&nbsp;</td>
				<td align="left" valign="top">
					<ul class="news-list">
						<?php
							$aNovidades360 = $objEmkt->getNovidadesByIds($aNewsletter['emailmkt_novidade360_ids']);
							//$objEmkt->debug($aNew);
							foreach($aNovidades360 as $k => $v){
						?>
						<li>
							<h3 class="title">
								<a href="<?=$linkAbsolute;?>novidade360/<?=$v['novidade_360_id'];?>/<?=$objEmkt->toNormaliza($v['novidade_360_titulo']);?>"><?=$v['novidade_360_titulo'];?></a>
							</h3>  
						</li>
						<?php } ?>
					</ul>
					<br class="clear" />            
					<a href="<?=$linkAbsolute;?>novidade360" class="saibamais" class="saibamais">Mais novidades</a>
				</td>
			</tr>
		</table>
	</div>

	<img class="separator" src="img/emkt_bg_separator.png" width="564" height="19"  alt=""/>

	<div id="aquitem">
		<h1 class="news-title">Aqui tem Acessibilidade</h1>
		<table cellpading="0" cellspacing="0" border="0" width="87%">
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td width="185" align="left" valign="top">
					<img src="<?=$linkAbsolute;?>imgEmkt/<?=$aNewsletter['emailmkt_aqui_tem_thumb'];?>" alt="" />
				</td>
				<td width="362" class="news-resumo">
					<h3 class="title"><?=$aNewsletter['emailmkt_aqui_tem_titulo'];?></h3>
					<br class="clear" />
					<p class="description">
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
					<a target="_blank" href="<?=$sLink;?>" class="saibamais">Saiba mais</a>                
				</td>
			</tr>
			<tr>
				<td colspan="2" valign="middle" align="center" height="350"><a href="mailto:viviane@museusacessiveis.com.br"><img src="img/emkt_contact_bt.png" width="261" height="269"  alt=""/></a></td>
			</tr>
		</table>
	</div>

	<div id="schedule">
		<h1 class="title">Agenda Brasil<br />de Acessibilidade</h1>
		<div id="schedule-box">
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
						<div class="day-box">
							<span class="day"><?=$v['item_dt_agenda_dia']?></span>
							<span class="month"><?=$v['item_dt_agenda_mes_label']?></span>
						</div>                
						<div class="title"><a href="<?=$v['item_link']?>"><?=$v['item_titulo']?></a></div>
					</td>
					<?	endforeach;?>
				</tr>
				<?	endforeach;?>
				<tr>
					<td align="center" colspan="3" style="padding-top: 10px">
						<a class="saibamais" href="javascript:void(0);">Fique por dentro da Agenda Brasil de Acessibilidade</a>
					</td>
				</tr>
			</table>
		</div>
	</div>  

	<div id="propaganda"><br />
		<a href="#"><br />
			<img src="<?=$linkAbsolute;?>imgEmkt/<?=$aNewsletter['emailmkt_propaganda_img'];?>" width="634" height="634"  alt=""/>
		</a> 
	</div> 
	<div id="footer" href="footer" accesskey="5">
		<table>
			<tr>
				<td class="contact">
					<div id="contact">
						<strong tabIndex="114">Contatos</strong>
						<div id="devices">
							<span tabIndex="117" class="facebook"><a href="#">facebook.com\museusacessiveis</a></span>
						</div>
						<div id="web">
							<a tabIndex="118" href="">viviane@museusacessiveis.com.br</a>
							<a tabIndex="119" href="">www.museusacessiveis.com.br</a>
						</div>
					</div>
				</td>
				<td class="opcoes">opções de acessibilidade</td>
			</tr>
			<tr>
				<td align="center">
					<?php
						$aContato = $objEmkt->getContatos();
						$devices=array();
						$sites=array();
						foreach($aContato as $k => $v){
							$tipo=strtolower($v['contato_tipo']);
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
					?>
					<a href="#"><img class="ico" src="img/emkt_facebook_ico.png" width="25" height="25"  alt=""/></a>
					<a href="#"><img class="ico" src="img/emkt_linkedin_ico.png" width="25" height="25"  alt=""/></a>
					<a href="#"><img class="ico" src="img/emkt_twitter_ico.png" width="25" height="25"  alt=""/></a>
					<a href="#"><img class="ico" src="img/emkt_googleplus_ico.png" width="25" height="25"  alt=""/></a>
					<a href="#"><img class="ico" src="img/emkt_paper_ico.png" width="25" height="25"  alt=""/></a>
					<a href="#"><img class="ico" src="img/emkt_star_ico.png" width="25" height="25"  alt=""/></a>
					<a href="#"><img class="ico" src="img/emkt_email_ico.png" width="25" height="25"  alt=""/></a>
				</td>
				<td align="center">&nbsp</td>
			</tr>
		</table>
		<div class="clear"></div>
	</div>  
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td align="center" class="news-info" height="30">
				Política anti-spam: Se você não deseja mais receber este e-mail, <a href="#" target="_blank">clique aqui!</a>
			</td>
		</tr>
	</table>
</div>
</body>
</html>
