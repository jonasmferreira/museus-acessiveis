<?php
	$path_root_DefaultClass = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_DefaultClass = "{$path_root_DefaultClass}{$DS}..{$DS}..{$DS}";
	require_once "{$path_root_DefaultClass}adm{$DS}class{$DS}default.class.php";
	$obj = new defaultClass();
	$obj->verifyLogin();
	$session = $obj->getSessions();
	$seqAleatoria = str_replace(".","",microtime(true));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Painel Administrativo - Dashboard</title>
		<link href="admstyle.css" type="text/css" media="screen" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="../plugins/jquery.loadmask.css" />
		<link rel="stylesheet" type="text/css" href="../plugins/jquery.multiselect.css" />
		<link rel="stylesheet" type="text/css" href="../plugins/jquery.multiselect.filter.css" />
		<link rel="stylesheet" type="text/css" href="../plugins/jqueryFileTree.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="../plugins/css/south-street/jquery-ui-1.10.4.custom.min.css" />
		
		<script src="../plugins/jquery-1.10.2.min.js?rnd=<?=$seqAleatoria?>" type="text/javascript"></script>
		<script src="../plugins/jquery-migrate.js?rnd=<?=$seqAleatoria?>" type="text/javascript"></script>
		<script src="../plugins/jquery-ui-1.10.4.custom.min.js?rnd=<?=$seqAleatoria?>" type="text/javascript"></script>
		<script src="../plugins/jquery-ui-i18n.js?rnd=<?=$seqAleatoria?>" type="text/javascript"></script>
		<script src="../plugins/jquery-ui-timepicker-addon.js?rnd=<?=$seqAleatoria?>" type="text/javascript"></script>
		<script src="../plugins/themeroller.js?rnd=<?=$seqAleatoria?>" type="text/javascript"></script>
		<script src="../plugins/jquery.resizeTable.js?rnd=<?=$seqAleatoria?>" type="text/javascript"></script>
		<script src='../plugins/jquery.loadmask.js?rnd=<?=$seqAleatoria?>' type="text/javascript"></script>
		<script src="../plugins/jquery.multiselect.js?rnd=<?=$seqAleatoria?>" type="text/javascript"></script>
		<script src="../plugins/jquery.multiselect.br.js?rnd=<?=$seqAleatoria?>" type="text/javascript"></script>
		<script src="../plugins/jquery.multiselect.filter.js?rnd=<?=$seqAleatoria?>" type="text/javascript"></script>
		<script src="../plugins/jquery.meiomask.min.js?rnd=<?=$seqAleatoria?>" type="text/javascript"></script>
		<script src="../plugins/jquery.maskmoney.js?rnd=<?=$seqAleatoria?>" type="text/javascript"></script>
		<script src="../plugins/izzyColor.js?rnd=<?=$seqAleatoria?>" type="text/javascript"></script>
		<script src="../plugins/date.js?rnd=<?=$seqAleatoria?>" type="text/javascript"></script>
		<script src="../lib/ckeditor/ckeditor.js?rnd=<?=$seqAleatoria?>" type="text/javascript"></script>
		<script src="../lib/ckeditor/adapters/jquery.js?rnd=<?=$seqAleatoria?>" type="text/javascript"></script>
		<script src="../lib/ckfinder/ckfinder.js?rnd=<?=$seqAleatoria?>" type="text/javascript"></script> 
		<script src="../plugins/i18n/grid.locale-pt-br.js?rnd=<?=$seqAleatoria?>" type="text/javascript"></script>
		<script src="../plugins/jquery.jqGrid.min.js?rnd=<?=$seqAleatoria?>" type="text/javascript"></script>
		<script src="js/funcoes.js?rnd=<?=$seqAleatoria?>" type="text/javascript"></script>
	</head>
	<body>
	<div id="wrapper">
    	<div id="topo">
	        <img src="imgs/logo_contrast.png" width="288" />
            <hr />
	    	<div class="left">
           		<span class="catHead" style="background-image:url(imgs/icon-config.png)">
                	Institucional
                	<div>
                    	<a href="quemSomosEdicao.php?texto_id=1" style="background-image:url(imgs/icon-videos.png);">Quem Somos</a><br />
                    	<a href="downloadsLista.php" style="background-image:url(imgs/icon-jogos.png);">Downloads</a><br />
                    	<a href="imprensaLista.php" style="background-image:url(imgs/icon-videos.png);">Imprensa</a><br />
		           		<a href="acessibilidadeEdicao.php?texto_id=2" style="background-image:url(imgs/icon-blog.png);">Acessibilidade</a><br />
                        <a href="newsletterLista.php" style="background-image:url(imgs/icon-jogos.png);">Newsletter</a><br />
                        <a href="emktLista.php" style="background-image:url(imgs/icon-jogos.png);">E-mail MKT</a><br />
                        <a href="contatosLista.php" style="background-image:url(imgs/icon-blog.png);">Contatos</a>
                    </div>
                </span>
				<span class="catHead" style="background-image:url(imgs/icon-config.png)">
                	Produtos
                	<div>
						<a href="tagLista.php" style="background-image:url(imgs/icon-jogos.png);">Tags</a><br />
						<a href="glossarioLista.php" style="background-image:url(imgs/icon-jogos.png);">Glossário</a><br />
						<a href="cursoLista.php" style="background-image:url(imgs/icon-videos.png);">Cursos</a><br />
                    	<a href="listajogos.html" style="background-image:url(imgs/icon-jogos.png);">Serviços</a><br />
                    	<a href="listajogos.html" style="background-image:url(imgs/icon-jogos.png);">Projetos</a><br />
						<a href="listajogos.html" style="background-image:url(imgs/icon-jogos.png);">Informações Extras</a>                        
                    </div>
                </span>                
           		<a href="listajogos.html" style="background-image:url(imgs/icon-jogos.png);">Novidades 360º</a>
                <a href="listajogos.html" style="background-image:url(imgs/icon-jogos.png);">Agenda</a>
           		<a href="listaposts.html" style="background-image:url(imgs/icon-blog.png);">Banners</a>
				<span class="catHead" style="background-image:url(imgs/icon-config.png)">
                	Configurações
                	<div>
						<a href="listaposts.html" style="background-image:url(imgs/icon-blog.png);">Configurações Gerais</a><br />
                    	<a href="usuarioLista.php" style="background-image:url(imgs/icon-blog.png);">Usuários</a>
                    </div>
                </span> 
                
			</div> 
    		<div class="right">
            	<a href="logoff.php" style="background-image:url(imgs/icon-sair.png);"> Sair</a>
	    	</div>
            <br clear="all" />
        </div>