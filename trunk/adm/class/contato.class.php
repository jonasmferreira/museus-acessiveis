<?php
$path_root_contatoClass = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_contatoClass = "{$path_root_contatoClass}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_contatoClass}adm{$DS}class{$DS}default.class.php";
class contato extends defaultClass{
	protected $dbConn;
	protected $filterFieldName = array(
		't.contato_nome'=>array(
			'fieldNameId'=>'t.contato_nome'
			,'fieldNameLabel'=>'Nome'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
		,'tc.contato_tipo'=>array(
			'fieldNameId'=>'tc.contato_tipo'
			,'fieldNameLabel'=>'Tipo'
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
					,tc.contato_tipo
			FROM	tb_contato t
			JOIN	tb_contato_tipo tc
			ON		t.contato_tipo_id = tc.contato_tipo_id
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
		if(isset($this->values['contato_exibir'])&&trim($this->values['contato_exibir'])!=''){
			$sql[] = "AND t.contato_exibir IN ({$this->values['contato_exibir']})";
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
		$sql[] = "ORDER BY tc.contato_tipo ASC, t.contato_nome ASC ";
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
					$rs['contato_exibir_label'] = $rs['contato_exibir']=='S'?'Sim':'Não';
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
		$sql[] = "AND		t.contato_id = '{$this->values['contato_id']}'";
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
		if(isset($this->values['contato_id'])&&trim($this->values['contato_id'])!=''){
			$result = $this->update();
		}else{
			$result = $this->insert();
		}
		return $result;
	}

	private function update(){
		$this->values['contato_exibir'] = trim($this->values['contato_exibir'])!=''?$this->values['contato_exibir']:'N';
		$this->values['contato_dt'] = date('Y-m-d');
		$this->values['contato_hr'] = date('H:i:s');
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			UPDATE	tb_contato SET
					contato_dt = '{$this->values['contato_dt']}'
					,contato_hr = '{$this->values['contato_dt']}'
					,contato_tipo_id = '{$this->values['contato_tipo_id']}'
					,contato_nome = '{$this->values['contato_nome']}'
					,contato_link = '{$this->values['contato_link']}'
					,contato_exibir = '{$this->values['contato_exibir']}'
			WHERE	contato_id = '{$this->values['contato_id']}'
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
		$this->values['contato_exibir'] = trim($this->values['contato_exibir'])!=''?$this->values['contato_exibir']:'N';
		$this->values['contato_dt'] = date('Y-m-d');
		$this->values['contato_hr'] = date('H:i:s');
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			INSERT	INTO tb_contato SET
					contato_dt = '{$this->values['contato_dt']}'
					,contato_hr = '{$this->values['contato_dt']}'
					,contato_tipo_id = '{$this->values['contato_tipo_id']}'
					,contato_nome = '{$this->values['contato_nome']}'
					,contato_link = '{$this->values['contato_link']}'
					,contato_exibir = '{$this->values['contato_exibir']}'
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
			DELETE FROM tb_contato
			WHERE contato_id = '{$this->values['contato_id']}'
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


