<?php
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
	
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Museus Acessíveis</title>
<link rel="alternate" type="application/rss+xml" title="RSS" href="<?=$linkAbsolute?>rss.php" />
<meta name="description" content="<?=$description;?>">
<meta name="keywords" content="<?=$keywords;?>">
<meta name="author" content="<?=$author;?>">

<link rel="shortcut icon" href="<?=$linkAbsolute?>img/favicon.ico?<?=$seqAleatoria?>" type="image/x-icon" />
<link rel="stylesheet" href="<?=$linkAbsolute?>plugins/lightbox/css/lightbox.css?<?=$seqAleatoria?>" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?=$linkAbsolute?>plugins/css/south-street/jquery-ui-1.10.4.custom.min.css?<?=$seqAleatoria?>" />
<!--link rel="stylesheet" type="text/css" href="<?=$linkAbsolute?>js/jquery.zglossary.min.css?<?=$seqAleatoria?>" /-->
<link rel="stylesheet" type="text/css" href="<?=$linkAbsolute?>js/jquery.zglossary.css?<?=$seqAleatoria?>" />

<link rel="stylesheet" href="<?=$linkAbsolute?>css/style.css?<?=$seqAleatoria?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=$linkAbsolute?>css/style_contrast.css?<?=$seqAleatoria?>" type="text/css" media="screen" />

<link rel="stylesheet" href="<?=$linkAbsolute?>css/style_print.css?<?=$seqAleatoria?>" type="text/css" media="print" />

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
<script src="<?=$linkAbsolute?>js/jquery.zglossary.js?rnd=<?=$seqAleatoria?>" type="text/javascript"></script>
<script type="text/javascript">
	linkAbsolute = '<?=$linkAbsolute?>';
</script>
<script src="<?=$linkAbsolute?>js/functions.js?<?=$seqAleatoria?>"></script>

<?php include_once("{$path_root_page}includeSocialMedia.php"); ?>

