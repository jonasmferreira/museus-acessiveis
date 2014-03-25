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
	
	//itens dos contatos no footer
	include_once("{$path_root_page}adm{$DS}class{$DS}contato.class.php");
	$objContato = new contato();
	$objContato->setValues(array(
		'contato_exibir'=>'S'
		,'page'=>'1'
		,'rows'=>'10'
	));
	$aContato = $objContato->getLista();

	
	
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Museus Acessíveis</title>

<meta name="description" content="<?=$description;?>">
<meta name="keywords" content="<?=$keywords;?>">
<meta name="author" content="<?=$author;?>">

<link rel="shortcut icon" href="<?=$linkAbsolute?>img/favicon.ico?<?=$seqAleatoria?>" type="image/x-icon" />
<link rel="stylesheet" href="<?=$linkAbsolute?>plugins/lightbox/css/lightbox.css?<?=$seqAleatoria?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=$linkAbsolute?>css/style.css?<?=$seqAleatoria?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=$linkAbsolute?>css/style_contrast.css?<?=$seqAleatoria?>" type="text/css" media="screen" />
<script src="<?=$linkAbsolute?>plugins/jquery-1.10.2.min.js?<?=$seqAleatoria?>"></script>
<script src="<?=$linkAbsolute?>plugins/lightbox/js/lightbox-2.6.min.js?<?=$seqAleatoria?>"></script>

<script src="<?=$linkAbsolute?>plugins/shortcut.js?<?=$seqAleatoria?>"></script>
<script src="<?=$linkAbsolute?>plugins/cookie.js?<?=$seqAleatoria?>"></script>
<script src="<?=$linkAbsolute?>plugins/fontSize.js?<?=$seqAleatoria?>"></script>

<script src="<?=$linkAbsolute?>js/functions.js?<?=$seqAleatoria?>"></script>

