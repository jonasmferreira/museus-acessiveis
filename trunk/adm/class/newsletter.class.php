<?php
$path_root_newsletterClass = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_newsletterClass = "{$path_root_newsletterClass}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_newsletterClass}adm{$DS}class{$DS}default.class.php";
class newsletter extends defaultClass{
	protected $dbConn;
	protected $filterFieldName = array(
		'n.newsletter_nome'=>array(
			'fieldNameId'=>'n.newsletter_nome'
			,'fieldNameLabel'=>'Nome'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
		,'n.newsletter_email'=>array(
			'fieldNameId'=>'n.newsletter_email'
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
			SELECT	n.*
			FROM	tb_newsletter n
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
		if(isset($this->values['newsletter_receber_informacoes'])&&trim($this->values['newsletter_receber_informacoes'])!=''){
			$sql[] = "AND n.newsletter_receber_informacoes IN ({$this->values['newsletter_receber_informacoes']})";
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
		$sql[] = "ORDER BY n.newsletter_nome ASC";
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
					$rs['newsletter_receber_informacoes_label'] = $rs['newsletter_receber_informacoes']=='S'?'Sim':'Não';
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
		$sql[] = "AND		n.newsletter_id = '{$this->values['newsletter_id']}'";
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
		if(isset($this->values['newsletter_id'])&&trim($this->values['newsletter_id'])!=''){
			$result = $this->update();
		}else{
			$result = $this->insert();
		}
		return $result;
	}

	private function update(){
		$this->values['newsletter_receber_informacoes'] = trim($this->values['newsletter_receber_informacoes'])!=''?$this->values['newsletter_receber_informacoes']:'N';
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			UPDATE	tb_newsletter SET
					newsletter_nome = '{$this->values['newsletter_nome']}'
					,newsletter_receber_informacoes = '{$this->values['newsletter_receber_informacoes']}'
					,newsletter_email = '{$this->values['newsletter_email']}'
			WHERE	newsletter_id = '{$this->values['newsletter_id']}'
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
		$this->values['newsletter_receber_informacoes'] = trim($this->values['newsletter_receber_informacoes'])!=''?$this->values['newsletter_receber_informacoes']:'N';
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			INSERT INTO	tb_newsletter SET
					newsletter_nome = '{$this->values['newsletter_nome']}'
					,newsletter_receber_informacoes = '{$this->values['newsletter_receber_informacoes']}'
					,newsletter_email = '{$this->values['newsletter_email']}'
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
			DELETE FROM tb_newsletter
			WHERE newsletter_id = '{$this->values['newsletter_id']}'
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


