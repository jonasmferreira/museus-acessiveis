<?php
	$path_root_imprensaEdicao = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_imprensaEdicao = "{$path_root_imprensaEdicao}{$DS}..{$DS}";
	include_once "{$path_root_imprensaEdicao}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_imprensaEdicao}adm{$DS}class{$DS}imprensa.class.php");
	$obj = new imprensa();

	$aNovidadeIds = $obj->getNovidade360();
	
	$obj->setValues($_REQUEST);
	$aRow = $obj->getOne();
	$session = $obj->getSessions();
	if(trim($session['erro'])!='' && isset($session['erro'])){
		$obj->alert($session['erro']);
		$erro = $session['erro'];
		$aErro['erro'] =  $erro;
		$obj->unRegisterSession($aErro);
	}
	//$obj->debug($aRow);
?>
<script type="text/javascript" src="js/imprensa.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
		Painel Administrativo / Notícias <strong>/ <?=isset($aRow['imprensa_id'])?'Editar':'Cadastrar'?> Imprensa</strong>
	</div>
	<form action="controller/imprensa.controller.php" method="post" id="formSalvar" name="formSalvar" enctype="multipart/form-data">
		<input type="hidden" name="action" id="action" value="edit-item" />
		<input type="hidden" name="imprensa_id" id="imprensa_id" value="<?=$aRow['imprensa_id']?>" />
		<input type="hidden" name="voltar" id="voltar" value="imprensaEdicao.php" />
		<table cellpadding="0" cellspacing="0" id="formCadastro">
			<tbody>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Dados de Imprensa</strong>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Nome da Assessoria<br />
						<input type="text" class="formTxt obrigatorio" name="imprensa_assessoria_nome" id="imprensa_assessoria_nome" style="width:98%" value="<?=$aRow['imprensa_assessoria_nome']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Telefone da Assessoria<br />
						<input type="text" class="formTxt obrigatorio" name="imprensa_assessoria_telefone" id="imprensa_assessoria_telefone" style="width:98%" value="<?=$aRow['imprensa_assessoria_telefone']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						E-mail da Assessoria<br />
						<input type="text" class="formTxt obrigatorio" name="imprensa_assessoria_email" id="imprensa_assessoria_email" style="width:98%" value="<?=$aRow['imprensa_assessoria_email']?>" />
					</td>
				</tr>

				<tr>
					<td colspan="3">
						Novidades 360º (Destaque)<br />
						<select class="formTxt obrigatorio" name="novidade_360_id" style="width:98%" id="novidade_360_id">
							<?	
								foreach($aNovidadeIds AS $k=>$v):
									$selected = ($v['novidade_360_id']==$aRow['novidade_360_id'])?' selected="selected"':'';
							?>
							<option value="<?=$v['novidade_360_id']?>"<?=$selected?>><?=$v['novidade_360_titulo']?></option>
							<?	endforeach;?>
						</select>
					</td>
				</tr>

				<tr>
					<td colspan="3">
						Nossos Números<br />
						<textarea name="imprensa_nossos_numeros" id="imprensa_nossos_numeros" class="editor" rows="5" style="width:99%"><?=$aRow['imprensa_nossos_numeros']?></textarea>
					</td>
				</tr>
				
				<tr>
					<td align="right" colspan="3">
						<input type="button" value="Salvar" id="salvar" class="butSalvar" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include_once "{$path_root_imprensaEdicao}adm{$DS}includes{$DS}footer.php"; ?>
