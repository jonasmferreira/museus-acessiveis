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

		include_once("{$path_root_page}adm{$DS}class{$DS}emailmktSmart.class.php");
		$objEmkt = new emailmkt();

		//$nId = (isset($_REQUEST['emailmkt_id'])?$_REQUEST['emailmkt_id']:0);
		//$nEmkt = (isset($_REQUEST['emailmkt_emkt'])?$_REQUEST['emailmkt_emkt']:0);

		//$objEmkt->setValues(
		//	array(
		//		'emailmkt_id'=>$nId
		//	)
		//);
		//$aNewsletter = $objEmkt->getOne();
		//$objEmkt->debug($aNewsletter);
		$aIds = $_REQUEST['ids'];
		
		include_once("{$path_root_page}adm{$DS}class{$DS}contato.class.php");
		$objContato = new contato();
		$objContato->setValues(array(
			'contato_exibir'=>'S'
			,'page'=>'1'
			,'rows'=>'10'
		));

		$aContato = $objContato->getLista();
		//$objContato->debug($aContato);

		/*Organizando os contados por categoria;
		1 - Telefones e Celulares
		2 - Emails e Sites
		3 - Facebook
		4 - Redes Sociais (Social Media)

		*/

		$aCel=array();
		$celPos=0;
		$aSite=array();
		$sitePos=0;
		$aEmail = array();
		$emailPos=0;
		$aFacebook = array();
		$facePos=0;
		$aSkype = array();
		$skypePos=0;
		$aSocialMedia = array();
		$socialPos=0;
		$arr = array();
		foreach($aContato['rows'] as $k => $v){
			$tipo=strtolower($v['contato_tipo']);

			if($tipo=='celular' || $tipo=='telefone'){
				$arr = $objContato->createContactGroup($v);
				array_push($aCel,$arr);
				$celPos++;
			}else if($tipo=='skype'){
				$arr = $objContato->createContactGroup($v);
				array_push($aSkype,$arr);
				$skypePos++;
			}else if($tipo=='site'){
				$arr = $objContato->createContactGroup($v);
				array_push($aSite,$arr);
				$sitePos++;
			}else if($tipo=='e-mail'){
				$arr = $objContato->createContactGroup($v);
				array_push($aEmail,$arr);
				$emailPos++;

			}else if($tipo=='facebook'){
				$arr = $objContato->createContactGroup($v);
				array_push($aFacebook,$arr);
				$facePos++;
			}else if(substr ($tipo, 0, 12)=='social media'){
				$arr = $objContato->createContactGroup($v);
				array_push($aSocialMedia,$arr);
				$socialPos++;
			}
		}
	
		
		
	?>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Museus Acessíveis - Seu amigo @@NOME_AMIGO@@ enviou esta notícia.</title>

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
	<link rel="stylesheet" href="<?=$linkAbsolute?>css/newsletter_contrast.css?<?=$seqAleatoria?>" type="text/css" media="screen" />

</head>
<body style="margin:0; padding:0; border:0; background: #FFF url('<?=$linkAbsolute;?>img/emkt_bg.gif') left top repeat; font-family:Verdana, Helvetica, sans-serif; color: #565652;">
<div id="root" style="width:680px; margin:0 auto; background-color:#FFF;">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
    	<tr>
        	<td align="center" class="news-info" height="30" style="font-size:11px; color:#000;">
            	<span style="font-weight:bold;">Acessibilidade 360º: </span>Se você não consegue visualizar este e-mail, <a style="color: #FF0000; text-decoration: none !important;" href="<?=$linkAbsolute?>boletim/<?=$aNewsletter['emailmkt_id'];?>" target="_blank"><b>clique aqui!</b></a>
            </td>
        </tr>
    </table>
	
	<div id="header" style="height: 255px;background: #FFF url('<?=$linkAbsolute;?>img/emkt_bg_top.gif') left top repeat-x;">
		<table border="0" cellpadding="0" cellspacing="0" width="654">
		  <tr>
			<td width="248" valign="middle" align="right">
				<a href="<?=$linkAbsolute;?>home" target="_blank">
					<img id="logo" style="height: 255px;background: url('<?=$linkAbsolute;?>img/emkt_logo_museus.png') left top no-repeat;" src="<?=$linkAbsolute;?>img/emkt_logo_transparent.png" width="248" height="255"  alt="Museus Acessíveis - Cultura + Acessibilidade 360º" title="Museus Acessíveis - Cultura + Acessibilidade 360º"/>
				</a>				
			</td>
			<td style="background: url('<?=$linkAbsolute;?>img/emkt_title.png') left 35px no-repeat;padding:200px 0 0 0;" class="title" valign="middle" align="center">
			</td>
		  </tr>
		</table>
	</div>

	<?php
			$aEmktNews = $objEmkt->getNovidadesByIds($aIds);
			//$objEmkt->debug($aEmktNews);
			foreach($aEmktNews as $k => $v){
	?>
	<div id="project" style="padding: 34px 31px 30px 16px;">
		<h1 style="margin:0; font-size:28px; display: block; background: url('<?=$linkAbsolute;?>img/emkt_projeto_ico.png') left top no-repeat; padding: 7px 0 0 56px;color: #632d8b;height: 48px;overflow: visible;" class="project-title">
			<?=$v['novidade_360_titulo']?>
		</h1>
		<div class="description" style="padding: 18px 0 0 40px;">
			<p style="font-size: 14px;color: #565652;line-height: 21px;padding: 0 0 20px 0;margin:0;">
				<?=$v['novidade_360_resumo']?>
			</p>
			<a style="text-decoration: none !important;padding: 5px;background: #000;font-weight: bold;font-size: 14px;color: #FFF;" href="<?=$linkAbsolute;?>novidade360/<?=$v['novidade_360_id'];?>/<?=$objContato->toNormaliza($v['novidade_360_titulo']);?>" class="saibamais">
				Leia mais
			</a>
		</div>
	</div>

    <?php } ?>
	<div class="separator" style="margin: 30px 0 30px 30px; height: 19px;background: url('<?=$linkAbsolute;?>img/emkt_bg_separator.png') left top no-repeat;" ></div>
	
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
    	<tr>
        	<td align="center" class="news-info" height="30" style="font-size:11px; color:#000;">
            	<a style="color: #000; text-decoration: none !important;" href="<?=$linkAbsolute?>" target="_blank"><b>museusacessiveis.com.br</b></a>
				<br /><br />
            </td>
        </tr>
    </table>
	
	
</div>
</body>
</html>
