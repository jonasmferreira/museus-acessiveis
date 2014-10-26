<?php
$row = 1;
$handle = fopen("Pasta1.csv","r");
$aSql = array();
while (($data = fgetcsv($handle, 4096, ";")) !== FALSE) {
	$aArr = array();
	$aArr["nome"] = trim(trim("{$data[1]} {$data[2]}"));
	$aArr["email"] = trim($data[0]);
	$aArr["nome"] = trim($aArr["nome"])!=""?$aArr["nome"]:$aArr["email"];
	
	
	$aSql[] = "
		INSERT INTO	tb_mailing SET
			mailing_nome = '{$aArr['nome']}'
			,mailing_enviar = 'S'
			,mailing_email = '{$aArr['email']}';
	";
}
fclose ($handle);
file_put_contents("../emailsImportados.sql",implode("\n",$aSql));
?>