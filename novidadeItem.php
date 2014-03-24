<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php 

		$path_root_page = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_page = "{$path_root_page}{$DS}";
		include_once("{$path_root_page}head.php"); 

		//Carregando os conteúdos da página
		
		//itens do Outdoor / Destaque e Novidades 360º
		include_once("{$path_root_page}adm{$DS}class{$DS}novidade.class.php");
		$objNovidade = new novidade();

		$nId = (isset($_REQUEST['novidade_360_id'])?$_REQUEST['novidade_360_id']:0);
		$objNovidade->setValues(
			array(
				'novidade_360_id'=>$nId
			)
		);
		$aNovidade = $objNovidade->getOne();
		
		$objNovidade->debug($aNovidade);
		
	?>	
</head>
<body>
<div id="root">
	<?php include_once("{$path_root_page}accessbar.php"); ?>
	<div class="clear"></div>    
	<div id="content-l">
		<?php include_once("{$path_root_page}menu.php"); ?>
        <div id="content" href="content" accesskey="3">
        	<div id="logo">
<img tabIndex="15" src="img/logo_transparent.png" alt="Logo Museus Acessíveis, cultura + acessibilidade 360º" width="288" height="152" title="Logo Museus Acessíveis, cultura + acessibilidade 360º" />            
            </div>
        	<div id="news360">
           	  <h1 tabIndex="31" class="orange-color">Novidades 360º <a id="news-list" class="orange-color" href="novidade_lista.html">| Lista de Notícias</a></h1>
					<div id="content-news" class="content-box">
                                                        <div class="date"><span class="orange-color" tabIndex="32">13/08/2013</span></div>
                      <h2 id="title-news" tabIndex="33">Aniversário de Helen Keller</h2>
<p id="news-spotlight"  tabIndex="34">
                                Conheça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas, Paginações, eça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas paginações.
</p>
Conheça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas,Paginações, eça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas paginações.
Conheça os revestimentos da coleção Patchwork DecorTiles, a marca premimEliane, explore a sua criatividade com variadas,Paginações, eça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas paginações.
Conheça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas,Paginações, eça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas paginações.
<br />
<br />
<img src="img/news_img01.jpg" width="342" height="260"  alt="aqui vai o título" title="aqui vai o title"/> <br />
Conheça os revestimentos da coleção Patchwork DecorTiles, a marca premimEliane, explore a sua criatividade com variadas,Paginações, eça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas paginações.
Conheça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas,Paginações, eça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas paginações.
Conheça os revestimentos da coleção Patchwork DecorTiles, a marca premimEliane, explore a sua criatividade com variadas,Paginações, eça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas paginações.
Conheça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas,Paginações, eça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas paginações.
Conheça os revestimentos da coleção Patchwork DecorTiles, a marca premimEliane, explore a sua criatividade com variadas,Paginações, eça os revestimentos da coleção Patchwork DecorTiles, a marca premim Eliane, explore a sua criatividade com variadas paginações.       
</div>
        	</div>
        	<div class="clear"></div>
        </div>
            <div class="clear"></div>
  </div>

	<div id="content-r" href="content-r" accesskey="4">
		<?php include_once("{$path_root_page}boxBusca.php"); ?>
		<?php include_once("{$path_root_page}boxAgenda.php"); ?>
		<?php include_once("{$path_root_page}boxNewsletter.php"); ?>
		<?php include_once("{$path_root_page}boxGlossario.php"); ?>
    </div>	
	<?php include_once("{$path_root_page}footer.php"); ?>
</div>
</body>
</html>
