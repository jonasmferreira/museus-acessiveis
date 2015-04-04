<?php

	//itens dos contatos no footer
	include_once("{$path_root_page}adm{$DS}class{$DS}glossario.class.php");
	$objGlossario = new glossario();
	$objGlossario->setValues(array(
		'glossario_exibir'=>'S'
		,'page'=>'1'
		,'rows'=>'500000'
	));
	
	$objGlossario->setAOrderBy(array(
		'glossario_letra' => 'ASC'
		,'t.glossario_palavra' => 'ASC'
	));
	
	
	$aRows = $objGlossario->getLista();
	//$objGlossario->debug($aRows);
	
?>

		<div id="glossary-search">
        	<h1 tabIndex="110">Glossário da <br />Acessibilidade</h1>
            <p tabIndex="111" class="description">
            Saiba mais sobre inclusão<br />sem complicação!!!
            </p>
			<div class="clear"></div>
            <div class="tag-box">
			<?php
				$sLetra = '';
				$sCloseUl = '';
				foreach($aRows['rows'] as $k => $v){
					if($sLetra != $v['glossario_letra']){
						$sLetra=$v['glossario_letra'];
						if(trim($sCloseUl)!=''){
							echo '</ul>';
							echo '<h3>'.strtoupper($sLetra).'</h3>';
							echo '<ul class="tag">';
						}else{
							$sCloseUl='_';	
							echo '<h3>'.$sLetra.'</h3>';
							echo '<ul class="tag">';
						}
					}
?>
				        <li>
										<a href="<?=$linkAbsolute;?>glossario/<?=$v['glossario_id'];?>/<?=$objGlossario->toNormaliza($v['glossario_palavra']);?>">
												<?=$v['glossario_palavra'];?>
										</a>
								</li>
<?php				
				}
			
			?>
            </div>
			<div class="clear"></div>
        </div>
		<div class="clear"></div>
