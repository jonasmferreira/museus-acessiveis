<?php
	$path_root_tipo_servicoEdicao = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_tipo_servicoEdicao = "{$path_root_tipo_servicoEdicao}{$DS}..{$DS}";
	include_once "{$path_root_tipo_servicoEdicao}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_tipo_servicoEdicao}adm{$DS}class{$DS}tipo_servico.class.php");
	$obj = new tipo_servico();

	//CORRIGINDO BUG DE CARREGAR UM ITEM QUANDO CLICAMOS EM 'CADASTRAR NOVO'
	if(isset($_REQUEST['tipo_servico_id']) && trim($_REQUEST['tipo_servico_id'])!=''){
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
<script type="text/javascript" src="js/tipo_servico.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
		Painel Administrativo / Tipo de Cursos <strong>/ <?=isset($aRow['tipo_servico_id'])?'Editar':'Cadastrar'?> Tipo de Curso</strong>
	</div>
	<form action="controller/tipo_servico.controller.php" method="post" id="formSalvar" name="formSalvar">
		<input type="hidden" name="action" id="action" value="edit-item" />
		<input type="hidden" name="tipo_servico_id" id="tipo_servico_id" value="<?=$aRow['tipo_servico_id']?>" />
		<input type="hidden" name="voltar" id="voltar" value="tipo_servicoEdicao.php" />
		<table cellpadding="0" cellspacing="0" id="formCadastro">
			<tbody>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Dados do Tipo de serviço</strong>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						Titulo<br />
						<input type="text" class="formTxt obrigatorio" name="tipo_servico_titulo" id="tipo_servico_titulo" style="width:98%" value="<?=$aRow['tipo_servico_titulo']?>" />
					</td>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right">
						<a href="tipo_servicoLista.php" class="butVoltar">Voltar</a>&nbsp;
						<input type="button" value="Salvar" id="salvar" class="butSalvar" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include_once "{$path_root_tipo_servicoEdicao}adm{$DS}includes{$DS}footer.php"; ?>
