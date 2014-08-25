<?php
	$path_root_imprensaEdicao = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_imprensaEdicao = "{$path_root_imprensaEdicao}{$DS}..{$DS}";
	include_once "{$path_root_imprensaEdicao}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_imprensaEdicao}adm{$DS}class{$DS}imprensa.class.php");
	$obj = new imprensa();
	$obj->setValues($_REQUEST);
	$aRow = $obj->getOne();
	$session = $obj->getSessions();
	if(trim($session['erro'])!='' && isset($session['erro'])){
		$obj->alert($session['erro']);
		$erro = $session['erro'];
		$aErro['erro'] =  $erro;
		$obj->unRegisterSession($aErro);
	}
	$aTipoImprensa = $obj->getTipoImprensa();
	//$obj->debug($aRow);
?>
<script type="text/javascript" src="js/imprensa.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
		Painel Administrativo / Institucional / Imprensa <strong>/ <?=isset($aRow['imprensa_id'])?'Editar':'Cadastrar'?> Imprensa</strong>
	</div>
	<form action="controller/imprensa.controller.php" method="post" id="formSalvar" name="formSalvar" enctype="multipart/form-data">
		<input type="hidden" name="action" id="action" value="edit-item" />
		<input type="hidden" name="imprensa_id" id="autor_id" value="<?=$aRow['imprensa_id']?>" />
		<input type="hidden" name="voltar" id="voltar" value="imprensaEdicao.php" />
		<table cellpadding="0" cellspacing="0" id="formCadastro">
			<tbody>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Dados do Imprensa</strong>
					</td>
				</tr>
				
				<tr>
					<td colspan="3">
						Tipo Imprensa<br />
						<select class="formTxt obrigatorio" name="imprensa_tipo" id="imprensa_tipo">
							<?	foreach($aTipoImprensa AS $k=>$v):
									$selected = $aRow['imprensa_tipo']==$v['tipo_imprensa_id']?' selected="selected"':'';
							?>
							<option value="<?=$v['tipo_imprensa_id']?>"<?=$selected?>><?=$v['tipo_imprensa_titulo']?></option>
							<?	endforeach;?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Titulo<br />
						<input type="text" class="formTxt obrigatorio" name="imprensa_titulo" id="imprensa_titulo" style="width:98%" value="<?=$aRow['imprensa_titulo']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Arquivo<br />
						<input type="file" name="imprensa_arquivo" id="imprensa_arquivo" />
						<?	if(is_file("../arquivosDown/{$aRow['imprensa_arquivo']}")):?>
						<br />
						<a href="<?="../arquivosDown/{$aRow['imprensa_arquivo']}"?>" target="_blank" />Download</a>
						<?	endif;?>
					</td>
				</tr>
				<tr>
					<td align="right" colspan="3">
						<a href="imprensaLista.php" class="butVoltar">Voltar</a>&nbsp;
						<input type="button" value="Salvar" id="salvar" class="butSalvar" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include_once "{$path_root_imprensaEdicao}adm{$DS}includes{$DS}footer.php"; ?>
