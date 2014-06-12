<?php
	$path_root_tipo_cursoEdicao = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_tipo_cursoEdicao = "{$path_root_tipo_cursoEdicao}{$DS}..{$DS}";
	include_once "{$path_root_tipo_cursoEdicao}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_tipo_cursoEdicao}adm{$DS}class{$DS}tipo_curso.class.php");
	$obj = new tipo_curso();

	//CORRIGINDO BUG DE CARREGAR UM ITEM QUANDO CLICAMOS EM 'CADASTRAR NOVO'
	if(isset($_REQUEST['tipo_curso_id']) && trim($_REQUEST['tipo_curso_id'])!=''){
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
<script type="text/javascript" src="js/tipo_curso.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
		Painel Administrativo / Tipo de Cursos <strong>/ <?=isset($aRow['tipo_curso_id'])?'Editar':'Cadastrar'?> Tipo de Curso</strong>
	</div>
	<form action="controller/tipo_curso.controller.php" method="post" id="formSalvar" name="formSalvar">
		<input type="hidden" name="action" id="action" value="edit-item" />
		<input type="hidden" name="tipo_curso_id" id="tipo_curso_id" value="<?=$aRow['tipo_curso_id']?>" />
		<input type="hidden" name="voltar" id="voltar" value="tipo_cursoEdicao.php" />
		<table cellpadding="0" cellspacing="0" id="formCadastro">
			<tbody>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Dados do Tipo de Curso</strong>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						Titulo<br />
						<input type="text" class="formTxt obrigatorio" name="tipo_curso_titulo" id="tipo_curso_titulo" style="width:98%" value="<?=$aRow['tipo_curso_titulo']?>" />
					</td>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right">
						<a href="tipo_cursoLista.php" class="butVoltar">Voltar</a>&nbsp;
						<input type="button" value="Salvar" id="salvar" class="butSalvar" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include_once "{$path_root_tipo_cursoEdicao}adm{$DS}includes{$DS}footer.php"; ?>
