<?php
	$path_root_usuarioEdicao = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_usuarioEdicao = "{$path_root_usuarioEdicao}{$DS}..{$DS}";
	include_once "{$path_root_usuarioEdicao}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_usuarioEdicao}adm{$DS}class{$DS}usuario.class.php");
	$obj = new usuario();
	$obj->setValues($_REQUEST);
	$aRow = $obj->getOne();
	$session = $obj->getSessions();
	if(trim($session['erro'])!='' && isset($session['erro'])){
		$obj->alert($session['erro']);
		$erro = $session['erro'];
		$aErro['erro'] =  $erro;
		$obj->unRegisterSession($aErro);
	}
	$aNivel = $obj->getNivel();
?>
<script type="text/javascript" src="js/usuario.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
		Painel Administrativo / Usuários <strong>/ <?=isset($aRow['usuario_id'])?'Editar':'Cadastrar'?> Autor</strong>
	</div>
	<form action="controller/usuario.controller.php" method="post" id="formSalvar" name="formSalvar">
		<input type="hidden" name="action" id="action" value="edit-item" />
		<input type="hidden" name="usuario_id" id="usuario_id" value="<?=$aRow['usuario_id']?>" />
		<input type="hidden" name="voltar" id="voltar" value="editarusuario.php" />
		<table cellpadding="0" cellspacing="0" id="formCadastro">
			<tbody>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Dados do Autor</strong>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						Nome<br />
						<input type="text" class="formTxt obrigatorio" name="usuario_nome" id="usuario_nome" style="width:98%" value="<?=$aRow['usuario_nome']?>" />
					</td>
					<td width="170">
						Status<br />
						<select class="formTxt obrigatorio" name="usuario_status" id="usuario_status">
							<option value="A"<?=$aRow['usuario_status']=='A'?' selected="selected"':''?>>Ativo</option>
							<option value="I"<?=$aRow['usuario_status']=='I'?' selected="selected"':''?>>Inativo</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						E-mail<br />
						<input type="text" class="formTxt obrigatorio" name="usuario_email" id="usuario_email" style="width:98%" value="<?=$aRow['usuario_email']?>" />
					</td>
					<td width="170">
						Nível<br />
						<select class="formTxt obrigatorio" name="usuario_nivel" id="usuario_nivel">
							<option value="A"<?=$aRow['usuario_status']=='A'?' selected="selected"':''?>>Ativo</option>
							<option value="I"<?=$aRow['usuario_status']=='I'?' selected="selected"':''?>>Inativo</option>
						</select>
					</td>
				</tr>
				<tr>
					<td width="170">
						Usuário<br />
						<input type="text" class="formTxt obrigatorio" name="usuario_login" id="usuario_login" style="width:98%" value="<?=$aRow['usuario_login']?>" />
					</td>
					<td width="170">
						Senha<br />
						<input type="password" class="formTxt obrigatorio" name="usuario_senha" id="usuario_senha" style="width:98%" value="<?=$aRow['usuario_senha']?>" />
					</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right">
						<a href="listausuario.php" class="butVoltar">Voltar</a>&nbsp;
						<input type="button" value="Salvar" id="salvar" class="butSalvar" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include_once "{$path_root_usuarioEdicao}adm{$DS}includes{$DS}footer.php"; ?>
