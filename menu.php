<?php

	//itens dos contatos no footer
	include_once("{$path_root_page}adm{$DS}class{$DS}tipo_curso.class.php");
	include_once("{$path_root_page}adm{$DS}class{$DS}tipo_servico.class.php");

	$objCurso = new tipo_curso();
	$objCurso->setValues(array(
		'page'=>'1'
		,'rows'=>'100'
	));
	$aCurso = $objCurso->getLista();
	//$objCurso->debug($aCurso);

	$objServico = new tipo_servico();
	$objServico->setValues(array(
		'page'=>'1'
		,'rows'=>'100'
	));
	$aServico = $objServico->getLista();
	//$objCurso->debug($aCurso);
	
?>
	<div id="menu" href="menu" accesskey="2" >
        	<ul id="principal">
            	<li class="fontSize"><a tabIndex="5" href="<?=$linkAbsolute;?>home">home</a></li>
            	<li class="fontSize"><a tabIndex="6" href="<?=$linkAbsolute;?>quem_somos">quem somos</a></li>
            	<li class="sub-mn fontSize"><a tabIndex="7" href="<?=$linkAbsolute;?>servicos">serviços</a>
					<?php 
						if(count($aServico['rows']>0)){
?>
						<div class="submenu">
							<ul>
<?php
							foreach($aServico['rows'] as $k =>$v){ 
					?>
                            <li class="fontSize"><a tabIndex="9" href="<?=$linkAbsolute;?>servicos/<?=strtolower($v['tipo_servico_titulo']);?>"><?=$v['tipo_servico_titulo'];?></a></li>
					<?php 
							} 
?>
                       </ul>
                    </div>
<?php
						} 
					?>
				</li>
            	<li class="sub-mn fontSize">
					<a tabIndex="8" href="<?=$linkAbsolute;?>projetos">projetos</a>
                    <div class="submenu">
                        <ul>
                            <li class="fontSize"><a tabIndex="9" href="<?=$linkAbsolute;?>projetos/abertos">Projetos abertos para captação</a></li>
                            <li class="fontSize"><a tabIndex="10" href="<?=$linkAbsolute;?>projetos/realizados">Portifólio de projetos realizados</a></li>
                            <li class="fontSize"><a tabIndex="11" href="<?=$linkAbsolute;?>projetos/em_andamento">Projetos em andamento</a></li>
                       </ul>
                    </div>
                </li>
            	<li class="sub-mn fontSize"><a tabIndex="12" href="<?=$linkAbsolute;?>cursos">cursos</a>
					<?php 
						if(count($aCurso['rows']>0)){
?>
						<div class="submenu">
							<ul>
<?php
							foreach($aCurso['rows'] as $k =>$v){ 
					?>
                            <li class="fontSize"><a tabIndex="9" href="<?=$linkAbsolute;?>cursos/<?=strtolower($v['tipo_curso_titulo']);?>"><?=$v['tipo_curso_titulo'];?></a></li>
					<?php 
							} 
?>
                       </ul>
                    </div>
<?php
						} 
					?>
				</li>
            	<li class="fontSize"><a tabIndex="13" href="<?=$linkAbsolute;?>downloads">downloads</a></li>
            	<li class="fontSize"><a tabIndex="14" href="<?=$linkAbsolute;?>imprensa" style="padding-right:none !important;">imprensa</a></li>
            </ul>
        </div>
