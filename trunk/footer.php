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
            	<li><a tabIndex="122" href="">Home</a></li>
            	<li><a tabIndex="123" href="">Quem Somos</a></li>
            	<li><a tabIndex="124" href="">Serviços</a></li>
            	<li tabIndex="125">
                	Projetos
                    <ul>
                    	<li><a tabIndex="126" href="">Projetos abertos para capacitação</a></li>
                    	<li><a tabIndex="127" href="">Portifólio de projetos realizados</a></li>
                    	<li><a tabIndex="128" href="">Projetos em andamento</a></li>
                    </ul>
                </li>
            	<li><a tabIndex="129" href="">Cursos</a></li>
            	<li><a tabIndex="130" href="">Downloads</a></li>
                <li><a tabIndex="131" href="">Imprensa</a></li>
            </ul>
        </div>
    	<div class="clear"></div>
    </div>
