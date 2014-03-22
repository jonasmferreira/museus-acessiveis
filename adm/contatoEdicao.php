<?php
	$path_root_contatoEdicao = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_contatoEdicao = "{$path_root_contatoEdicao}{$DS}..{$DS}";
	include_once "{$path_root_contatoEdicao}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_contatoEdicao}adm{$DS}class{$DS}contato.class.php");
	include_once("{$path_root_contatoEdicao}adm{$DS}class{$DS}contatoTipo.class.php");

	$objTipo = new contatoTipo();
	$objTipo->setValues(array(
			'contato_tipo_status'=>'S'
			,'page'=>'1'
			,'rows'=>'10000000000'		
	));
	$aTipo=$objTipo->getLista();
	
	$obj = new contato();
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
<script type="text/javascript" src="js/contato.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
		Painel Administrativo / Institucional / Contato <strong>/ <?=isset($aRow['contato_id'])?'Editar':'Cadastrar'?> Contato</strong>
	</div>
	<form action="controller/contato.controller.php" method="post" id="formSalvar" name="formSalvar">
		<input type="hidden" name="action" id="action" value="edit-item" />
		<input type="hidden" name="contato_id" id="autor_id" value="<?=$aRow['contato_id']?>" />
		<input type="hidden" name="voltar" id="voltar" value="contatoEdicao.php" />
		<table cellpadding="0" cellspacing="0" id="formCadastro">
			<tbody>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Dados do Contato</strong>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<input type="checkbox" name="contato_exibir" value="S" <?=$aRow['contato_exibir']=='S'?' checked="checked"':''?> /> Exibir
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Tipo Contato<br />
						<select class="formTxt obrigatorio" name="contato_tipo_id" id="contato_tipo_id">
							<?	foreach($aTipo['rows'] AS $k=>$v):
									$selected = $aRow['contato_tipo_id']==$v['contato_tipo_id']?' selected="selected"':'';
							?>
							<option value="<?=$v['contato_tipo_id']?>"<?=$selected?>><?=$v['contato_tipo']?></option>
							<?	endforeach;?>
						</select>
					</td>
				</tr>

				<tr>
					<td colspan="3">
						Nome<br />
						<input type="text" class="formTxt obrigatorio" name="contato_nome" id="contato_nome" style="width:98%" value="<?=$aRow['contato_nome']?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Link<br />
						<input type="text" class="formTxt" name="contato_link" id="contato_link" style="width:98%" value="<?=$aRow['contato_link']?>" />
					</td>
				</tr>
				<tr>
					<td align="right" colspan="3">
						<a href="contatoLista.php" class="butVoltar">Voltar</a>&nbsp;
						<input type="button" value="Salvar" id="salvar" class="butSalvar" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include_once "{$path_root_contatoEdicao}adm{$DS}includes{$DS}footer.php"; ?>
