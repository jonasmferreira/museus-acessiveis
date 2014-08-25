<?php

	//itens dos contatos no footer
	include_once("{$path_root_page}adm{$DS}class{$DS}tipo_curso.class.php");
	include_once("{$path_root_page}adm{$DS}class{$DS}tipo_servico.class.php");
	include_once("{$path_root_page}adm{$DS}class{$DS}tipoProjeto.class.php");
	include_once("{$path_root_page}adm{$DS}class{$DS}quemSomos.class.php");

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

	$objTipoProjeto = new tipoProjeto();
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
	
?>
	<div id="menu" href="menu" accesskey="2" >
        	<ul id="principal">
            	<li class="fontSize"><a tabIndex="5" href="<?=$linkAbsolute;?>home">home</a></li>
            	<li class="sub-mn fontSize"><a tabIndex="6" href="<?=$linkAbsolute;?>quem_somos">quem somos</a>
					<?php 
						if(count($aQuemSomos['rows']>0)){
?>
						<div class="submenu">
							<ul>
<?php
							foreach($aQuemSomos['rows'] as $k =>$v){ 
					?>
                            <li class="fontSize"><a tabIndex="9" href="<?=$linkAbsolute;?>quem_somos/<?=$v['quemsomos_id'];?>/<?=strtolower($objQuemSomos->toNormaliza($v['quemsomos_titulo']));?>"><?=$v['quemsomos_titulo'];?></a></li>
					<?php 
							} 
?>
                       </ul>
                    </div>
<?php
						} 
					?>
				</li>
				<li class="sub-mn fontSize"><a tabIndex="7" href="<?=$linkAbsolute;?>servicos">serviços</a>
					<?php 
						if(count($aServico['rows']>0)){
?>
						<div class="submenu">
							<ul>
<?php
							foreach($aServico['rows'] as $k =>$v){ 
					?>
                            <li class="fontSize"><a tabIndex="9" href="<?=$linkAbsolute;?>servicos/<?=$v['tipo_servico_id'];?>/<?=strtolower($objServico->toNormaliza($v['tipo_servico_titulo']));?>"><?=$v['tipo_servico_titulo'];?></a></li>
					<?php 
							} 
?>
                       </ul>
                    </div>
<?php
						} 
					?>
				</li>
            	<li class="sub-mn fontSize"><a tabIndex="7" href="<?=$linkAbsolute;?>projetos">projetos</a>
					<?php 
						if(count($aTipoProjeto['rows']>0)){
?>
						<div class="submenu">
							<ul>
<?php
							foreach($aTipoProjeto['rows'] as $k =>$v){ 
					?>
                            <li class="fontSize">
								<a tabIndex="9" href="<?=$linkAbsolute;?>projetos/<?=$v['tipo_projeto_id'];?>/<?=strtolower($objTipoProjeto->toNormaliza($v['tipo_projeto_titulo']));?>"><?=$v['tipo_projeto_titulo'];?></a>
							</li>
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
					<a tabIndex="12" href="<?=$linkAbsolute;?>cursos">cursos</a>
					<?php 
						if(count($aCurso['rows']>0)){
?>
						<div class="submenu">
							<ul>
<?php
							foreach($aCurso['rows'] as $k =>$v){ 
					?>
                            <li class="fontSize"><a tabIndex="9" href="<?=$linkAbsolute;?>cursos/<?=$v['tipo_curso_id'];?>/<?=strtolower($objCurso->toNormaliza($v['tipo_curso_titulo']));?>"><?=$v['tipo_curso_titulo'];?></a></li>
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
				<li class="sub-mn fontSize">
					<a tabIndex="14" href="<?=$linkAbsolute;?>imprensa" style="padding-right:none !important;">imprensa</a>
					<div class="submenu">
						<ul>
							<li class="fontSize"><a tabIndex="15" href="<?=$linkAbsolute;?>novidade360">Novidades 360º</a></li>
							<li class="fontSize"><a tabIndex="15" href="<?=$linkAbsolute;?>agenda">Agenda</a></li>
							<li class="fontSize"><a tabIndex="15" href="<?=$linkAbsolute;?>imprensa">Imprensa</a></li>
							<li class="fontSize"><a tabIndex="15" href="<?=$linkAbsolute;?>release">Release</a></li>
							<li class="fontSize"><a tabIndex="15" href="<?=$linkAbsolute;?>clipping">Clipping</a></li>
						</ul>
					</div>
				</li>
				
				
            </ul>
        </div>
