<?php
	$path_root_homePage = dirname(__FILE__);
	$DS = DIRECTORY_SEPARATOR;
	$path_root_homePage = "{$path_root_homePage}{$DS}..{$DS}";
	include_once "{$path_root_homePage}adm{$DS}includes{$DS}header.php";
?>
<div id="contentWrapper">
	<table width="100%" height="200">
		<tr>
			<td valign="middle" align="center">
				<h1>Bem vindo!</h1>
				<h3>CMS - Museus Acessiveis</h3>
				<strong>Versão: 1.0</strong><br />
				<span>Desenvolvido por: Jonas Mendes e Josenilson Oliverira</span>
			</td>
		</tr>
	</table>
</div>
<?php include_once "{$path_root_homePage}adm{$DS}includes{$DS}footer.php"; ?>
