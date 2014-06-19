<?php
$path_root_servProjCurInfoEdicao = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_servProjCurInfoEdicao = "{$path_root_servProjCurInfoEdicao}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_servProjCurInfoEdicao}adm{$DS}class{$DS}default.class.php";
class servProjCurInfo extends defaultClass{
	protected $dbConn;
	public function __construct() {
		$path_root_servProjCurInfoEdicao = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_servProjCurInfoEdicao = "{$path_root_servProjCurInfoEdicao}{$DS}..{$DS}..{$DS}";
		$this->dbConn = new DataBaseClass();
	}
		
	protected function getSql(){
		$sql = array();
		$sql[] = "
			SELECT	t.*
			FROM	tb_serv_proj_cur_info t
			WHERE	1 = 1
		";
		return implode("\n",$sql);
	}

	public function getOne(){
		$sql = array();
		$sql[] = $this->getSql();
		$sql[] = "AND		t.serv_proj_cur_id = '{$this->values['serv_proj_cur_id']}'";
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
		if(isset($this->values['serv_proj_cur_id'])&&trim($this->values['serv_proj_cur_id'])!=''){
			$result = $this->update();
		}
		return $result;
	}

	private function update(){
		$this->values['servico_descr'] = $this->escape_string($this->values['servico_descr']);
		$this->values['projeto_descr'] = $this->escape_string($this->values['projeto_descr']);
		$this->values['curso_descr'] = $this->escape_string($this->values['curso_descr']);

		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			UPDATE	tb_serv_proj_cur_info SET
					servico_descr = '{$this->values['servico_descr']}'
					,projeto_descr = '{$this->values['projeto_descr']}'
					,curso_descr = '{$this->values['curso_descr']}'
		";
		$sql[] = "WHERE	serv_proj_cur_id = '{$this->values['serv_proj_cur_id']}'";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$this->dbConn->db_commit();
		return $result;
	}

}


