<?php
$path_root_BuscaController = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_BuscaController = "{$path_root_BuscaController}{$DS}";
require_once "{$path_root_BuscaController}adm{$DS}class{$DS}busca.class.php";
include_once("{$path_root_BuscaController}adm{$DS}class{$DS}configuracao.class.php");
$objConfig = new configuracao();
$aConfig = $objConfig->getOne();
//$objConfig->debug($aConfig);
$linkAbsolute=$aConfig['configuracao_baseurl'];
$obj = new busca();

$aArr = array();
$aRss = $obj->getInfoRss();
if(count($aRss)>0){
	foreach($aRss AS $v){
		$link = "{$linkAbsolute}{$v['item_tipo_link']}/{$v['item_id']}/".$obj->toNormaliza($v['item_titulo']);
		$pubDate =  date('r', strtotime($v['item_dtPub']));
		$aArr[] = array(
			'categoria'=>$v['item_tipo_link']
			,'titulo'=>$v['item_titulo']
			,'pubDate'=>$pubDate
			,'link'=>$link
			,'texto'=>$v['item_resumo']
		);
	}
}
$obj->createRss($aArr);