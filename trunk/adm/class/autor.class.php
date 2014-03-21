<?php
$path_root_autorClass = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_autorClass = "{$path_root_autorClass}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_autorClass}adm{$DS}class{$DS}default.class.php";
class autor extends defaultClass{
	protected $dbConn;
	protected $filterFieldName = array(
		'a.autor_nome'=>array(
			'fieldNameId'=>'a.autor_nome'
			,'fieldNameLabel'=>'Nome'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
		,'a.autor_login'=>array(
			'fieldNameId'=>'a.autor_login'
			,'fieldNameLabel'=>'Login'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
	);
	public function __construct() {
		$this->dbConn = new DataBaseClass();
	}
	
	public function getFilterFieldName() {
		return $this->filterFieldName;
	}
		
	protected function getSql(){
		$sql = array();
		$sql[] = "
			SELECT	a.autor_id
					,a.autor_nome
					,a.autor_login
					,a.autor_senha
					,a.autor_email
					,a.autor_status
			FROM	tb_autor a
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
		if(isset($this->values['autor_status'])&&trim($this->values['autor_status'])!=''){
			$sql[] = "AND a.autor_status IN ({$this->values['autor_status']})";
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
		$sql[] = "ORDER BY a.autor_nome ASC";
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
					$rs['autor_status_label'] = $rs['autor_status']=='A'?'Ativo':'Inativo';
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
		$sql[] = "AND		a.autor_id = '{$this->values['autor_id']}'";
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
		if(isset($this->values['autor_id'])&&trim($this->values['autor_id'])!=''){
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
			UPDATE	tb_autor SET
					autor_nome = '{$this->values['autor_nome']}'
					,autor_login = '{$this->values['autor_login']}'
					,autor_senha = '{$this->values['autor_senha']}'
					,autor_status = '{$this->values['autor_status']}'
					,autor_email = '{$this->values['autor_email']}'
			WHERE	autor_id = '{$this->values['autor_id']}'
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
			INSERT INTO	tb_autor SET
				autor_nome = '{$this->values['autor_nome']}'
				,autor_login = '{$this->values['autor_login']}'
				,autor_senha = '{$this->values['autor_senha']}'
				,autor_status = '{$this->values['autor_status']}'
				,autor_email = '{$this->values['autor_email']}'
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
			DELETE FROM tb_autor
			WHERE autor_id = '{$this->values['autor_id']}'
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