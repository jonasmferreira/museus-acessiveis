<?php
$path_root_tipo_servicoClass = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_tipo_servicoClass = "{$path_root_tipo_servicoClass}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_tipo_servicoClass}adm{$DS}class{$DS}default.class.php";
class tipo_servico extends defaultClass{
	protected $dbConn;
	protected $filterFieldName = array(
		't.tipo_servico_titulo'=>array(
			'fieldNameId'=>'t.tipo_servico_titulo'
			,'fieldNameLabel'=>'Nome'
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
			SELECT	t.*
			FROM	tb_tipo_servico t
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
		$sql[] = "ORDER BY t.tipo_servico_titulo ASC";
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

		if(isset($this->values['tipo_servico_id'])&&trim($this->values['tipo_servico_id'])!=''){
			$sql[] = "AND		t.tipo_servico_id = '{$this->values['tipo_servico_id']}'";
		}
		if(isset($this->values['tipo_servico_titulo'])&&trim($this->values['tipo_servico_titulo'])!=''){
			$sql[] = "AND		t.tipo_servico_titulo = '{$this->values['tipo_servico_titulo']}'";
		}
		
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
		if(isset($this->values['tipo_servico_id'])&&trim($this->values['tipo_servico_id'])!=''){
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
			UPDATE	tb_tipo_servico SET
					tipo_servico_titulo = '{$this->values['tipo_servico_titulo']}'
			WHERE	tipo_servico_id = '{$this->values['tipo_servico_id']}'
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
			INSERT INTO	tb_tipo_servico SET
				tipo_servico_titulo = '{$this->values['tipo_servico_titulo']}'
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
			DELETE FROM tb_tipo_servico
			WHERE tipo_servico_id = '{$this->values['tipo_servico_id']}'
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