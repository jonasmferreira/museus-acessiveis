<?php
$path_root_usuarioClass = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_usuarioClass = "{$path_root_usuarioClass}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_usuarioClass}adm{$DS}class{$DS}default.class.php";
class usuario extends defaultClass{
	protected $dbConn;
	protected $filterFieldName = array(
		'a.usuario_nome'=>array(
			'fieldNameId'=>'a.usuario_nome'
			,'fieldNameLabel'=>'Nome'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
		,'a.usuario_login'=>array(
			'fieldNameId'=>'a.usuario_login'
			,'fieldNameLabel'=>'Login'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
	);
	protected $nivel = array(
		'A'=>'Administrador'
		,'AS'=>'Adm - Sistema'
		,'U'=>'Usuário'
	);
	public function __construct() {
		$this->dbConn = new DataBaseClass();
	}
	
	public function getNivel() {
		return $this->nivel;
	}
		
	public function getFilterFieldName() {
		return $this->filterFieldName;
	}
		
	protected function getSql(){
		$sql = array();
		$sql[] = "
			SELECT	a.*
			FROM	tb_usuario a
			WHERE	1 = 1
		";
		return implode("\n",$sql);
	}
	public function getLista(){
		$page = $this->values['page']; 
		// get the requested page 
		$limit = $this->values['rows']; 
		
		$sql = array();
		$sql[] = $this->getSql();
		if(isset($this->values['fieldName'])&&trim($this->values['fieldName'])!=''){
			if(isset($this->values['txtPesquisar'])&&trim($this->values['txtPesquisar'])!=''){
				$sql[] = "AND {$this->values['fieldName']} LIKE '%{$this->values['txtPesquisar']}%'";
			}
		}
		if(isset($this->values['usuario_status'])&&trim($this->values['usuario_status'])!=''){
			$sql[] = "AND a.usuario_status IN ({$this->values['usuario_status']})";
		}
		$count = $this->getTotalData(implode("\n",$sql));
		$page = ($page < 1)?1:$page;
		if($count>0) {
			$total_pages = ceil($count/$limit);
		} else {
			$total_pages = 0;
		}
		if ($page > $total_pages){
			$page=$total_pages; 
		}
		$start = ($limit * $page) - $limit;
		$start = ($start < 0)?0:$start;
		$sql[] = "ORDER BY a.usuario_nome ASC";
		$sql[] = "LIMIT {$start},{$limit}";
		
		$aRet = array(
			'page'=>$page
			,'total'=>$total_pages	
			,'records'=>$count
			,'rows'=>$limit
		);
		$arr = array();
		$result = $this->dbConn->db_query(implode("\n",$sql));
		if($result['success']){
			if($result['total'] > 0){
				while($rs = $this->dbConn->db_fetch_assoc($result['result'])){
					$rs['usuario_status_label'] = $rs['usuario_status']=='A'?'Ativo':'Inativo';
					array_push($arr,$this->utf8_array_encode($rs));
				}
			}
		}
		$aRet['rows'] = $arr;
		return $aRet;
	}

	public function getOne(){
		$sql = array();
		$sql[] = $this->getSql();
		$sql[] = "AND		a.usuario_id = '{$this->values['usuario_id']}'";
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
		if(isset($this->values['usuario_id'])&&trim($this->values['usuario_id'])!=''){
			$result = $this->update();
		}else{
			$result = $this->insert();
		}
		return $result;
	}

	private function update(){
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			UPDATE	tb_usuario SET
					usuario_nome = '{$this->values['usuario_nome']}'
					,usuario_login = '{$this->values['usuario_login']}'
					,usuario_senha = '{$this->values['usuario_senha']}'
					,usuario_status = '{$this->values['usuario_status']}'
					,usuario_nivel = '{$this->values['usuario_nivel']}'
					,usuario_email = '{$this->values['usuario_email']}'
			WHERE	usuario_id = '{$this->values['usuario_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
		}else{
			$this->dbConn->db_commit();
		}
		return $result;
	}

	private function insert(){
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			INSERT INTO	tb_usuario SET
				usuario_nome = '{$this->values['usuario_nome']}'
				,usuario_login = '{$this->values['usuario_login']}'
				,usuario_senha = '{$this->values['usuario_senha']}'
				,usuario_status = '{$this->values['usuario_status']}'
				,usuario_email = '{$this->values['usuario_email']}'
				,usuario_nivel = '{$this->values['usuario_nivel']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
		}else{
			$this->dbConn->db_commit();
		}
		return $result;
	}
	public function deleteItem(){
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			DELETE FROM tb_usuario
			WHERE usuario_id = '{$this->values['usuario_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
		}else{
			$this->dbConn->db_commit();
		}
		return $result;
	}
}