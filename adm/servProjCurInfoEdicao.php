<?php
	$path_root_servProjCurInfoEdicao = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_servProjCurInfoEdicao = "{$path_root_servProjCurInfoEdicao}{$DS}..{$DS}";
	include_once "{$path_root_servProjCurInfoEdicao}adm{$DS}includes{$DS}header.php";
	include_once("{$path_root_servProjCurInfoEdicao}adm{$DS}class{$DS}servProjCurInfo.class.php");
	$obj = new servProjCurInfo();
	$obj->setValues($_REQUEST);
	$aRow = $obj->getOne();
	$session = $obj->getSessions();
	if(trim($session['erro'])!='' && isset($session['erro'])){
		$obj->alert($session['erro']);
		$erro = $session['erro'];
		$aErro['erro'] =  $erro;
		$obj->unRegisterSession($aErro);
	}
	
?>
<script type="text/javascript" src="js/servProjCurInfo.js"></script>
<div id="contentWrapper">
	<div id="breadCrumbs">
		Painel Administrativo / Descrição Produtos <strong>/ <?=isset($aRow['serv_proj_cur_id'])?'Editar':'Cadastrar'?> Descrição Produtos</strong>
	</div>
	<form action="controller/servProjCurInfo.controller.php" method="post" id="formSalvar" name="formSalvar" enctype="multipart/form-data">
		<input type="hidden" name="action" id="action" value="edit-item" />
		<input type="hidden" name="serv_proj_cur_id" id="servico_id" value="<?=$aRow['serv_proj_cur_id']?>" />
		<input type="hidden" name="voltar" id="voltar" value="servProjCurInfoEdicao.php" />
		<table cellpadding="0" cellspacing="0" id="formCadastro">
			<tbody>
				<tr class="tableHead">
					<td colspan="3">
						<strong>Dados de Descrição de Produtos</strong>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Descrição Serviços<br />
						<textarea name="servico_descr" id="servico_descr" rows="5" style="width:99%"><?=$aRow['servico_descr']?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Descrição Projetos<br />
						<textarea name="projeto_descr" id="projeto_descr" rows="5" style="width:99%"><?=$aRow['projeto_descr']?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						Descrição Curso<br />
						<textarea name="curso_descr" id="curso_descr" rows="5" style="width:99%"><?=$aRow['curso_descr']?></textarea>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right">
						<input type="button" value="Salvar" id="salvar" class="butSalvar" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php include_once "{$path_root_servProjCurInfoEdicao}adm{$DS}includes{$DS}footer.php"; ?>
