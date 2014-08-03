<?php

	//itens dos contatos no footer
	include_once("{$path_root_page}adm{$DS}class{$DS}contato.class.php");
	include_once("{$path_root_page}adm{$DS}class{$DS}tipo_servico.class.php");
	include_once("{$path_root_page}adm{$DS}class{$DS}tipo_curso.class.php");
	include_once("{$path_root_page}adm{$DS}class{$DS}tipoProjeto.class.php");

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
				<?php 
					foreach($devices as $k => $v){
						$tipo=strtolower($v['contato_tipo']);
						if($tipo=='celular' || $tipo=='telefone'){
				?>	
						<span tabIndex="" class="fone"><?=$v['contato_nome'];?></span>
				<?php
						}elseif($tipo=='skype'){
				?>	
						<span tabIndex="" class="skype"><?=$v['contato_nome'];?></span>
				<?php
						}else{
				?>	
						<a tabIndex="" class="facebook" href="<?=$v['contato_link'];?>" target="_BLANK"><?=$v['contato_nome'];?></a>
				<?php
						}
					}
				?>
            </div>
            <div id="web">
				<?php 
					foreach($sites as $k => $v){
						$tipo=strtolower($v['contato_tipo']);
						if($tipo=='e-mail'){
							$link='mailto:';
						}else{
							$link='';
						}
				?>	
				<a tabIndex="" href="<?=$link.$v['contato_link'];?>" target="_BLANK"><?=$v['contato_nome'];?></a>
				<?php
					}
				?>	
            </div>
            <strong id="access-option"><a tabIndex="120" href="<?=$linkAbsolute;?>acessibilidade">opções de acessibilidade</a></strong>
        </div>
        <div id="sitemap">
        	<strong tabIndex="121">Mapa do Site</strong>
            <ul>
            	<li><a tabIndex="122" href="<?=$linkAbsolute;?>home">Home</a></li>
            	<li><a tabIndex="123" href="<?=$linkAbsolute;?>quem_somos">Quem Somos</a></li>

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
							<li><a tabIndex="125" href="<?=$linkAbsolute;?>servicos/<?=$objTipoServico->toNormaliza($v['tipo_servico_titulo']);?>"><?php echo $v['tipo_servico_titulo'];?></a></li>
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
							<li><a tabIndex="125" href="<?=$linkAbsolute;?>projetos/<?=$objTipoProjeto->toNormaliza($v['tipo_projeto_titulo']);?>"><?php echo $v['tipo_projeto_titulo'];?></a></li>
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
							<li><a tabIndex="125" href="<?=$linkAbsolute;?>cursos/<?=$objTipoCurso->toNormaliza($v['tipo_curso_titulo']);?>"><?php echo $v['tipo_curso_titulo'];?></a></li>
<?php
						}
				}
?>
                    </ul>
                </li>
            	<li><a tabIndex="130" href="<?=$linkAbsolute;?>downloads">Downloads</a></li>
                <li><a tabIndex="131" href="<?=$linkAbsolute;?>imprensa">Imprensa</a></li>
            </ul>
        </div>
    	<div class="clear"></div>
    </div>
