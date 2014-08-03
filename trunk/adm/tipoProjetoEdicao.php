<?php
	$path_root_tipoProjetoEdicao = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_tipoProjetoEdicao = "{$path_root_tipoProjetoEdicao}{$DS}..{$DS}";
	include_once "{$path_root_tipoProjetoEdicao}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_tipoProjetoEdicao}adm{$DS}class{$DS}tipoProjeto.class.php");
	$obj = new tipoProjeto();

	//CORRIGINDO BUG DE CARREGAR UM ITEM QUANDO CLICAMOS EM 'CADASTRAR NOVO'
	if(isset($_REQUEST['tipo_projeto_id']) && trim($_REQUEST['tipo_projeto_id'])!=''){
		$obj->setValues($_REQUEST);
		$aRow = $obj->getOne();
	}

	$session = $obj->getSessions();
	if(trim($session['erro'])!='' && isset($session['erro'])){
		$obj->alert($session['erro']);
		$erro = $session['erro'];
		$aErro['erro'] =  $erro;
		$obj->unRegisterSession($aErro);
	}
?>
<script type="text/javascript" src="js/tipoProjeto.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
		Painel Administrativo / Tipos de Projeto <strong>/ <?=isset($aRow['tipo_projeto_id'])?'Editar':'Cadastrar'?> Tipos de Projeto</strong>
	</div>
	<form action="controller/tipoProjeto.controller.php" method="post" id="formSalvar" name="formSalvar">
		<input type="hidden" name="action" id="action" value="edit-item" />
		<input type="hidden" name="tipo_projeto_id" id="tipo_projeto_id" value="<?=$aRow['tipo_projeto_id']?>" />
		<input type="hidden" name="voltar" id="voltar" value="tipoProjetoEdicao.php" />
		<table cellpadding="0" cellspacing="0" id="formCadastro">
			<tbody>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Dados do Tipo de Projeto</strong>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						Titulo<br />
						<input type="text" class="formTxt obrigatorio" name="tipo_projeto_titulo" id="tipo_projeto_titulo" style="width:98%" value="<?=$aRow['tipo_projeto_titulo']?>" />
					</td>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right">
						<a href="tipoProjetoLista.php" class="butVoltar">Voltar</a>&nbsp;
						<input type="button" value="Salvar" id="salvar" class="butSalvar" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include_once "{$path_root_tipoProjetoEdicao}adm{$DS}includes{$DS}footer.php"; ?>
