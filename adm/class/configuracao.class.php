<?php

$path_root_ConfiguracaoClass = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_ConfiguracaoClass = "{$path_root_ConfiguracaoClass}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_ConfiguracaoClass}adm{$DS}class{$DS}default.class.php";

class configuracao extends defaultClass {

	protected $dbConn;
	protected $pathImg;
	protected $pathLogo;

	public function __construct() {
		$path_root_ConfiguracaoClass = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_ConfiguracaoClass = "{$path_root_ConfiguracaoClass}{$DS}..{$DS}..{$DS}";
		$this->dbConn = new DataBaseClass();
		$this->pathImg = "{$path_root_ConfiguracaoClass}configuracaoFiles{$DS}";
		if (!is_dir($this->pathImg)) {
			@mkdir($this->pathImg, 0777, true);
		}
		@chmod($this->pathImg, 0777);
		
		$this->pathLogo = "{$path_root_ConfiguracaoClass}configuracaoLogo{$DS}";
		if (!is_dir($this->pathLogo)) {
			@mkdir($this->pathLogo, 0777, true);
		}
		@chmod($this->pathLogo, 0777);
	}

	public function getOne() {
		$sql = array();
		$sql[] = "
				SELECT	*
				FROM	tb_configuracao
				WHERE	1 = 1
				AND		configuracao_id = '1'
			";
		$result = $this->dbConn->db_query(implode("\n", $sql));
		$rs = array();
		if ($result['success']) {
			if ($result['total'] > 0) {
				$rs = $this->dbConn->db_fetch_assoc($result['result']);
			}
		}
		return $this->utf8_array_encode($rs);
	}

	public function update() {
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			UPDATE	tb_configuracao SET
					configuracao_baseurl = '{$this->values['configuracao_baseurl']}'
					,configuracao_baseurl_ckfinder = '{$this->values['configuracao_baseurl_ckfinder']}'
		";
		$sql[] = "WHERE	configuracao_id = '1'";
		$result = $this->dbConn->db_execute(implode("\n", $sql));
		if ($result['success'] === false) {
			$this->dbConn->db_rollback();
		} else {
			$this->dbConn->db_commit();
		}
		return $result;
	}
}