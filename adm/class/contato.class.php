<?php
$path_root_mailingClass = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_mailingClass = "{$path_root_mailingClass}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_mailingClass}adm{$DS}class{$DS}default.class.php";
class mailing extends defaultClass{
	protected $dbConn;
	protected $filterFieldName = array(
		'm.mailing_nome'=>array(
			'fieldNameId'=>'m.mailing_nome'
			,'fieldNameLabel'=>'Nome'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
		,'m.mailing_email'=>array(
			'fieldNameId'=>'m.mailing_email'
			,'fieldNameLabel'=>'E-mail'
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
			SELECT	m.*
			FROM	tb_mailing m
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
		if(isset($this->values['mailing_enviar'])&&trim($this->values['mailing_enviar'])!=''){
			$sql[] = "AND m.mailing_enviar IN ({$this->values['mailing_enviar']})";
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
		$sql[] = "ORDER BY m.mailing_nome ASC";
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
					$rs['mailing_enviar_label'] = $rs['mailing_enviar']=='S'?'Sim':'Não';
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
		$sql[] = "AND		m.mailing_id = '{$this->values['mailing_id']}'";
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
		if(isset($this->values['mailing_id'])&&trim($this->values['mailing_id'])!=''){
			$result = $this->update();
		}else{
			$result = $this->insert();
		}
		return $result;
	}

	private function update(){
		$this->values['mailing_enviar'] = trim($this->values['mailing_enviar'])!=''?$this->values['mailing_enviar']:'N';
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			UPDATE	tb_mailing SET
					mailing_nome = '{$this->values['mailing_nome']}'
					,mailing_enviar = '{$this->values['mailing_enviar']}'
					,mailing_email = '{$this->values['mailing_email']}'
			WHERE	mailing_id = '{$this->values['mailing_id']}'
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
		$this->values['mailing_enviar'] = trim($this->values['mailing_enviar'])!=''?$this->values['mailing_enviar']:'N';
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			INSERT INTO	tb_mailing SET
					mailing_nome = '{$this->values['mailing_nome']}'
					,mailing_enviar = '{$this->values['mailing_enviar']}'
					,mailing_email = '{$this->values['mailing_email']}'
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
			DELETE FROM tb_mailing
			WHERE mailing_id = '{$this->values['mailing_id']}'
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


