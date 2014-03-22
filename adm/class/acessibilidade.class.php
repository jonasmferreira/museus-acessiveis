<?php
$path_root_acessibilidadeClass = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_acessibilidadeClass = "{$path_root_acessibilidadeClass}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_acessibilidadeClass}adm{$DS}class{$DS}default.class.php";
class acessibilidade extends defaultClass{
	protected $dbConn;
	protected $pathImg;
	public function __construct() {
		$path_root_acessibilidadeClass = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_acessibilidadeClass = "{$path_root_acessibilidadeClass}{$DS}..{$DS}..{$DS}";
		$this->pathImg = "{$path_root_acessibilidadeClass}images{$DS}";
		if(!is_dir($this->pathImg)){
			@mkdir($this->pathImg, 0777,true);
		}
		@chmod($this->pathImg, 0777);
		$this->dbConn = new DataBaseClass();
	}
	
	protected function getSql(){
		$sql = array();
		$sql[] = "
			SELECT	t.texto_id
					,DATE_FORMAT(t.texto_dt,'%Y-%m-%d') AS texto_dt
					,DATE_FORMAT(t.texto_hr,'%H:%i:%s') AS texto_hr
					,t.texto_conteudo
			FROM	tb_texto t
			WHERE	1 = 1
		";
		return implode("\n",$sql);
	}

	public function getOne(){
		$sql = array();
		$sql[] = $this->getSql();
		$sql[] = "AND		t.texto_id = '{$this->values['texto_id']}'";
		$result = $this->dbConn->db_query(implode("\n",$sql));
		$rs = array();
		if($result['success']){
			if($result['total'] > 0){
				$rs = $this->dbConn->db_fetch_assoc($result['result']);
			}
		}
		return $this->utf8_array_encode($rs);
	}

	public function edit(){
		if(isset($this->values['texto_id'])&&trim($this->values['texto_id'])!=''){
			$result = $this->update();
		}
		return $result;
	}

	private function update(){
		$this->values['texto_conteudo'] = $this->escape_string($this->values['texto_conteudo']);
		$this->values['texto_dt'] = date('Y-m-d');
		$this->values['texto_hr'] = date('H:i:s');
		
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			UPDATE	tb_texto SET
					texto_conteudo = '{$this->values['texto_conteudo']}'
					,texto_dt = '{$this->values['texto_dt']}'
					,texto_hr = '{$this->values['texto_hr']}'
		";
		$sql[] = "WHERE	texto_id = '{$this->values['texto_id']}'";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
		}else{
			$this->dbConn->db_commit();
		}
		return $result;
	}
	
}

