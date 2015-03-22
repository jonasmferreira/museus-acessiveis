<?php
	$path_root_anuncianteEdicao = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_anuncianteEdicao = "{$path_root_anuncianteEdicao}{$DS}..{$DS}";
	include_once "{$path_root_anuncianteEdicao}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_anuncianteEdicao}adm{$DS}class{$DS}anunciante.class.php");
	$obj = new anunciante();
	$obj->setValues($_REQUEST);
	$aRow = $obj->getOne();
	$session = $obj->getSessions();
	if(trim($session['erro'])!='' && isset($session['erro'])){
		$obj->alert($session['erro']);
		$erro = $session['erro'];
		$aErro['erro'] =  $erro;
		$obj->unRegisterSession($aErro);
	}
	$aTags = $obj->getTags();
?>
<script type="text/javascript" src="js/anunciante.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
		Painel Administrativo / Anunciantes <strong>/ <?=isset($aRow['anunciante_id'])?'Editar':'Cadastrar'?> Anunciante</strong>
	</div>
	<form action="controller/anunciante.controller.php" method="post" id="formSalvar" name="formSalvar" enctype="multipart/form-data">
		<input type="hidden" name="action" id="action" value="edit-item" />
		<input type="hidden" name="anunciante_id" id="anunciante_id" value="<?=$aRow['anunciante_id']?>" />
		<input type="hidden" name="voltar" id="voltar" value="anuncianteEdicao.php" />
		<table cellpadding="0" cellspacing="0" id="formCadastro">
			<tbody>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Dados do Anunciante</strong>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Nome<br />
						<input type="text" class="formTxt obrigatorio" name="anunciante_nome" id="anunciante_nome" style="width:98%" value="<?=$aRow['anunciante_nome']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Descrição<br />
						<textarea name="anunciante_descricao" id="anunciante_descricao" rows="5" style="width:99%"><?=$aRow['anunciante_descricao']?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Tipo Banner<br />
						<select class="formTxt obrigatorio" name="anunciante_tipo_banner" id="anunciante_tipo_banner">
							<option value="FB"<?=$aRow['anunciante_tipo_banner']=='FB'?' selected="selected"':''?>>Full Banner</option>
							<option value="RE"<?=$aRow['anunciante_tipo_banner']=='RE'?' selected="selected"':''?>>Retângulo</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Banner (277x187 - Retângulo ou 576x187 - Full banner)<br />
						<?	if(is_file("../images/{$aRow['anunciante_banner']}")):?>
						<span>(<a href="javascript:void(0)" rel="anunciante_banner" class="delImg">Remover Imagem</a>)</span>
						<br />
						<?	endif;?>
						<input type="file" name="anunciante_banner" id="anunciante_banner" />
						<?	if(is_file("../images/{$aRow['anunciante_banner']}")):?>
						<br />
						<div class="images">
                        	<img src="../images/<?=$aRow['anunciante_banner']?>" />
                        </div>
						<?	endif;?>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Descrição do Banner<br />
						<textarea name="anunciante_banner_desc" id="anunciante_banner_desc" rows="5" style="width:99%"><?=$aRow['anunciante_banner_desc']?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Link<br />
						<input type="text" class="formTxt obrigatorio" name="anuncianete_banner_link" id="anuncianete_banner_link" style="width:98%" value="<?=$aRow['anuncianete_banner_link']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Tags<br />
						<select class="formTxt" name="tags[]" id="tags" multiple="yes" style="width:99%;">
							<?	foreach($aTags AS $k=>$v):
									if(is_array($aRow['tags'])){
										$selected = in_array($v['tag_id'], $aRow['tags'])!==false?' selected="selected"':'';
									}else{
										$selected = "";
									}
							?>
							<option value="<?=$v['tag_id']?>"<?=$selected?>><?=$v['tag_titulo']?></option>
							<?	endforeach;?>
						</select>
					</td>
                </tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right">
						<a href="anuncianteLista.php" class="butVoltar">Voltar</a>&nbsp;
						<input type="button" value="Salvar" id="salvar" class="butSalvar" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include_once "{$path_root_anuncianteEdicao}adm{$DS}includes{$DS}footer.php"; ?>
