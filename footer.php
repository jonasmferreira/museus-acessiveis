<?php

	//itens dos contatos no footer
	include_once("{$path_root_page}adm{$DS}class{$DS}contato.class.php");
	include_once("{$path_root_page}adm{$DS}class{$DS}tipo_servico.class.php");
	include_once("{$path_root_page}adm{$DS}class{$DS}tipo_curso.class.php");
	include_once("{$path_root_page}adm{$DS}class{$DS}tipoProjeto.class.php");
	include_once("{$path_root_page}adm{$DS}class{$DS}quemSomos.class.php");

	$objContato = new contato();
	$objTipoServico = new tipo_servico();
	$objTipoCurso = new tipo_curso();
	$objTipoProjeto = new tipoProjeto();

	
	$objContato->setValues(array(
		'contato_exibir'=>'S'
		,'page'=>'1'
		,'rows'=>'10'
	));

	$aContato = $objContato->getLista();
	//$objContato->debug($aContato);

	$objTipoServico->setValues(array(
		'page'=>'1'
		,'rows'=>'10000'
	));
	$aTipoServico = $objTipoServico->getLista();
	
	$objTipoCurso->setValues(array(
		'page'=>'1'
		,'rows'=>'10000'
	));
	$aTipoCurso = $objTipoCurso->getLista();
	
	$objTipoProjeto->setValues(array(
		'page'=>'1'
		,'rows'=>'10000'
	));
	$aTipoProjeto = $objTipoProjeto->getLista();
	
	$objQuemSomos = new quemSomos();
	$objQuemSomos->setValues(array(
		'quemsomos_exibir'=>'S'
		,'page'=>'1'
		,'rows'=>'100000'
	));
	$aQuemSomos = $objQuemSomos->getLista();
	//$objQuemSomos->debug($aQuemSomos);

	
	/*Organizando os contados por categoria;
	1 - Telefones e Celulares
	2 - Emails e Sites
	3 - Facebook
	4 - Redes Sociais (Social Media)
	
	*/

	echo substr('Social Media (Linkedin)',0,12);
	
	
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
/*
	$objContato->debug($aCel);
	$objContato->debug($aEmail);
	$objContato->debug($aSkype);
	$objContato->debug($aSite);
	$objContato->debug($aFacebook);
	$objContato->debug($aSocialMedia);
*/
	
?>
<div class="clear"></div>    
	<div id="footer" href="footer" accesskey="5">
    	<div id="contact">
        	<strong tabIndex="114">Contatos</strong>

<?php
	$devices=array();
	$sites=array();
	foreach($aContato['rows'] as $k => $v){
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
	//$objContato->debug($devices);

?>
		
			<div id="devices">
				<?php  foreach($aCel as $k => $v){ ?>
					<span tabIndex="">
						<img class="normal" src="<?=$linkAbsolute;?>images/<?=$v['contato_tipo_icone'];?>" title="<?=$v['contato_nome'];?>" alt="<?=$v['contato_nome'];?>" />
						<img class="contrast" src="<?=$linkAbsolute;?>images/<?=$v['contato_tipo_icone_contraste'];?>" title="<?=$v['contato_nome'];?>" alt="<?=$v['contato_nome'];?>" />
						<?=$v['contato_nome'];?>
					</span>
				<?php } ?>

				<?php  foreach($aSkype as $k => $v){ ?>
					<span tabIndex="">
						<br />
						<img class="normal" src="<?=$linkAbsolute;?>images/<?=$v['contato_tipo_icone'];?>" title="<?=$v['contato_nome'];?>" alt="<?=$v['contato_nome'];?>" />
						<img class="contrast" src="<?=$linkAbsolute;?>images/<?=$v['contato_tipo_icone_contraste'];?>" title="<?=$v['contato_nome'];?>" alt="<?=$v['contato_nome'];?>" />
						<?=$v['contato_nome'];?>
					</span>
				<?php } ?>

				<?php  foreach($aFacebook as $k => $v){ ?>
						<br />
						<img class="normal" src="<?=$linkAbsolute;?>images/<?=$v['contato_tipo_icone'];?>" title="<?=$v['contato_nome'];?>" alt="<?=$v['contato_nome'];?>" />
						<img class="contrast" src="<?=$linkAbsolute;?>images/<?=$v['contato_tipo_icone_contraste'];?>" title="<?=$v['contato_nome'];?>" alt="<?=$v['contato_nome'];?>" />
						<a tabIndex="" href="<?=$v['contato_link'];?>" target="_BLANK"><?=$v['contato_nome'];?></a>
				<?php } ?>

				<?php  foreach($aEmail as $k => $v){ ?>
						<br />
						<img class="normal" src="<?=$linkAbsolute;?>images/<?=$v['contato_tipo_icone'];?>" title="<?=$v['contato_nome'];?>" alt="<?=$v['contato_nome'];?>" />
						<img class="contrast" src="<?=$linkAbsolute;?>images/<?=$v['contato_tipo_icone_contraste'];?>" title="<?=$v['contato_nome'];?>" alt="<?=$v['contato_nome'];?>" />
						<a tabIndex="" href="mailto:<?=$v['contato_link'];?>" target="_BLANK"><?=$v['contato_nome'];?></a>
				<?php } ?>

				<?php  foreach($aSite as $k => $v){ ?>
						<br />
						<img class="normal" src="<?=$linkAbsolute;?>images/<?=$v['contato_tipo_icone'];?>" title="<?=$v['contato_nome'];?>" alt="<?=$v['contato_nome'];?>" />
						<img class="contrast" src="<?=$linkAbsolute;?>images/<?=$v['contato_tipo_icone_contraste'];?>" title="<?=$v['contato_nome'];?>" alt="<?=$v['contato_nome'];?>" />
						<a tabIndex="" href="<?=$v['contato_link'];?>" target="_BLANK"><?=$v['contato_nome'];?></a>
				<?php } ?>
					
				<?php  foreach($aSocialMedia as $k => $v){ ?>
						<br />
						<img class="normal" src="<?=$linkAbsolute;?>images/<?=$v['contato_tipo_icone'];?>" title="<?=$v['contato_nome'];?>" alt="<?=$v['contato_nome'];?>" />
						<img class="contrast" src="<?=$linkAbsolute;?>images/<?=$v['contato_tipo_icone_contraste'];?>" title="<?=$v['contato_nome'];?>" alt="<?=$v['contato_nome'];?>" />
						<a tabIndex="" href="<?=$v['contato_link'];?>" target="_BLANK"><?=$v['contato_nome'];?></a>
				<?php } ?>
					
				<!-- RSS -->
				<a tabIndex="" class="rss" href="<?=$linkAbsolute;?>rss" target="_BLANK">RSS</a>					
				<br />
				
				<!-- FAVORITOS -->
				<a tabIndex="" class="favorite" href="<?=$linkAbsolute;?>rss" target="_BLANK">Inserir nos favoritos</a>					
				<!-- IMPRIMIR -->
				<a tabIndex="" class="print" href="<?=$linkAbsolute;?>rss" target="_BLANK">Imprimir</a>					
				<!-- ENVIAR POR E-MAIL -->
				<a tabIndex="" class="sendmail" href="<?=$linkAbsolute;?>rss" target="_BLANK">Enviar por e-mail</a>					
				
				
				
            </div>
            <strong id="access-option"><a tabIndex="120" href="<?=$linkAbsolute;?>acessibilidade">atalhos de teclado para facilitar a navegação</a></strong>
        </div>
        <div id="sitemap">
        	<strong tabIndex="121">Mapa do Site</strong>
            <ul>
            	<li><a tabIndex="122" href="<?=$linkAbsolute;?>home">Home</a></li>
				<!-- CARREGAR QUEM SOMOS -->
<?php 
				if($aQuemSomos['records']==0){
?>
					<li><a tabIndex="123" href="<?=$linkAbsolute;?>quem_somos">Quem Somos</a></li>
<?php			}else{
?>
					<li tabIndex="124">
						<a tabIndex="125" href="<?=$linkAbsolute;?>quem_somos">Quem Somos</a>
						<ul>
<?php					
						foreach($aQuemSomos['rows'] as $k => $v){
?>						
							<li><a tabIndex="126" href="<?=$linkAbsolute;?>quem_somos/<?=$v['quemsomos_id'];?>/<?=$objQuemSomos->toNormaliza($v['quemsomos_titulo']);?>"><?php echo $v['quemsomos_titulo'];?></a></li>
<?php
						}
				}
?>
						</ul>
					</li>
				
				<!-- CARREGAR OS TIPOS DE SERVIÇOS -->
<?php 
				if($aTipoServico['records']==0){
?>
					<li><a tabIndex="129" href="<?=$linkAbsolute;?>servicos">Serviços</a></li>
<?php			}else{
?>
					<li tabIndex="124">
						<a tabIndex="129" href="<?=$linkAbsolute;?>servicos">Serviços</a>
						<ul>
<?php					
						foreach($aTipoServico['rows'] as $k => $v){
?>						
							<li><a tabIndex="125" href="<?=$linkAbsolute;?>servicos/<?=$v['tipo_servico_id'];?>/<?=$objTipoServico->toNormaliza($v['tipo_servico_titulo']);?>"><?php echo $v['tipo_servico_titulo'];?></a></li>
<?php
						}
				}
?>
						</ul>
					</li>

					
				<!-- CARREGAR OS TIPOS DE PROJETOS -->
<?php 
				if($aTipoProjeto['records']==0){
?>
					<li><a tabIndex="129" href="<?=$linkAbsolute;?>projetos">Projetos</a></li>
<?php			}else{
?>
					<li tabIndex="124">
						<a tabIndex="129" href="<?=$linkAbsolute;?>projetos">Projetos</a>
						<ul>
<?php					
						foreach($aTipoProjeto['rows'] as $k => $v){
?>						
							<li><a tabIndex="125" href="<?=$linkAbsolute;?>projetos/<?=$v['tipo_projeto_id'];?>/<?=$objTipoProjeto->toNormaliza($v['tipo_projeto_titulo']);?>"><?php echo $v['tipo_projeto_titulo'];?></a></li>
<?php
						}
				}
?>
						</ul>
					</li>
					
					
					
				<!-- CARREGAR OS TIPOS DE CURSOS -->
<?php 
				if($aTipoCurso['records']==0){
?>
					<li><a tabIndex="129" href="<?=$linkAbsolute;?>cursos">Cursos</a></li>
<?php			}else{
?>
					<li tabIndex="124">
						<a tabIndex="129" href="<?=$linkAbsolute;?>cursos">Cursos</a>
						<ul>
<?php					
						foreach($aTipoCurso['rows'] as $k => $v){
?>						
							<li><a tabIndex="125" href="<?=$linkAbsolute;?>cursos/<?=$v['tipo_curso_id'];?>/<?=$objTipoCurso->toNormaliza($v['tipo_curso_titulo']);?>"><?php echo $v['tipo_curso_titulo'];?></a></li>
<?php
						}
				}
?>
                    </ul>
                </li>
            	<li><a tabIndex="130" href="<?=$linkAbsolute;?>downloads">Downloads</a></li>
                <li>
					<a tabIndex="131" href="<?=$linkAbsolute;?>imprensa">Imprensa</a>
					<ul>
						<li><a tabIndex="132" href="<?=$linkAbsolute;?>novidade360">Novidades 360º</a></li>
						<li><a tabIndex="132" href="<?=$linkAbsolute;?>agenda">Agenda</a></li>
						<li><a tabIndex="132" href="<?=$linkAbsolute;?>imprensa">Imprensa</a></li>
						<li><a tabIndex="132" href="<?=$linkAbsolute;?>release">Release</a></li>
						<li><a tabIndex="132" href="<?=$linkAbsolute;?>clipping">Clipping</a></li>
					</ul>
				</li>
            </ul>
        </div>
    	<div class="clear"></div>
    </div>
