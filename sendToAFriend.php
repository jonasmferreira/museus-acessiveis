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

		$urlsend = $_REQUEST['urlsend'];
		$nome = $_REQUEST['nome'];
		$email = $_REQUEST['email'];
		
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

	<div id="project" style="padding: 34px 31px 30px 16px;">
		<div class="description" style="padding: 18px 0 0 40px;">
			<p style="font-size: 14px;color: #565652;line-height: 21px;padding: 0 0 20px 0;margin:0;">
				Seu amigo <?php echo $nome . '('.$email.') esteve no site Museus Acessíveis e lhe enviou esta notícia: ';?><br />
				<a style="text-decoration: underline !important;padding: 5px;;font-weight: bold;font-size: 14px;" href="<?php echo $urlsend;?>" target="_BLANK"><?php echo $urlsend;?></a>
			</p>
		</div>
	</div>

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
