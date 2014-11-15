<?php 
	if(count($aGaleria['rows'])>0){
		$arrImagem = array();
		$arrDescr = array();
		foreach($aGaleria['rows'] as $k => $v){ 
			$class = ($k==0)?'show':'hide';
			$arrImagem[]='<img class="' . $class . '" id="gal-item_'. ($k+1) . '" src="'. $linkAbsolute . 'galeriaImagem/' . $v['galeria_imagem_arq'] . '" title="' . $v['galeria_imagem_titulo'] . '" alt="'. $v['galeria_imagem_titulo'] . '" width="458" height="400" />';
			$arrDescr[]= '								
				<div  class="' . $class . '" id="gal-info_'. ($k+1) .'">
					<strong class="title">'. $v['galeria_imagem_titulo'] .'</strong>
					<br />
					<span>'. $v['galeria_imagem_descricao'] .' </span>
				</div>';
		}
?>

		<div id="galeria">
			<h3>Galeria de Imagens</h3>
			<div id="galeria-box">
				<table id="img-lista" width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td id="img-total" align="center" valign="middle" colspan="3">
							<span id="img-pos">1</span> de <span id="img-count"><?php echo count($aGaleria['rows']); ?></span> fotos
						</td>
					</tr>
					<tr>
						<td class="bt">
							<a href="javascript:void(0);" id="galeria-prev">
								<img class="normal" src="<?=$linkAbsolute;?>img/gallery_bt_prev.png" title="Anterior" alt="Anterior" />
								<img class="contrast" src="<?=$linkAbsolute;?>img/gallery_bt_prev_contrast.png" title="Anterior" alt="Anterior" />
							</a>
						</td>
						<td id="imagens" align="center" valign="middle">
							<?php echo implode('',$arrImagem); ?>
						</td>
						<td class="bt">
							<a href="javascript:void(0);" id="galeria-next">
								<img class="normal" src="<?=$linkAbsolute;?>img/gallery_bt_next.png" title="Próximo" alt="Próximo" />
								<img class="contrast" src="<?=$linkAbsolute;?>img/gallery_bt_next_contrast.png" title="Próximo" alt="Próximo" />
							</a>
						</td>
					</tr>
					<tr>
						<td class="info" align="left" valign="middle" colspan="3">
							<?php echo implode('',$arrDescr); ?>
						</td>
					</tr>
				</table>
			</div>
		</div>
<?php } ?>


