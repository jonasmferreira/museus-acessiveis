<?php
$path_root_quemSomosClass = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_quemSomosClass = "{$path_root_quemSomosClass}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_quemSomosClass}adm{$DS}class{$DS}default.class.php";
class quemSomos extends defaultClass{
	protected $dbConn;
	protected $pathImg;
	protected $filterFieldName = array(
		't.curso_titulo'=>array(
			'fieldNameId'=>'t.quemsomos_titulo'
			,'fieldNameLabel'=>'Título'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
	);
	public function __construct() {
		$path_root_quemSomosClass = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_quemSomosClass = "{$path_root_quemSomosClass}{$DS}..{$DS}..{$DS}";
		$this->pathImg = "{$path_root_quemSomosClass}images{$DS}";
		if(!is_dir($this->pathImg)){
			@mkdir($this->pathImg, 0777,true);
		}
		@chmod($this->pathImg, 0777);
		$this->dbConn = new DataBaseClass();
	}
		
	public function getFilterFieldName() {
		return $this->filterFieldName;
	}
		
	protected function getSql(){
		$sql = array();
		$sql[] = "
			SELECT	t.*
			FROM	tb_quemsomos t
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
		if(isset($this->values['data_ini'])&&trim($this->values['data_ini'])!=''){
			$this->values['data_ini'] = $this->dateBR2DB($this->values['data_ini']);
			$sql[] = "AND t.quemsomos_dt_cadastro >= '{$this->values['data_ini']}'";
		}
		if(isset($this->values['data_fim'])&&trim($this->values['data_fim'])!=''){
			$this->values['data_fim'] = $this->dateBR2DB($this->values['data_fim']);
			$sql[] = "AND t.quemsomos_dt_cadastro <= '{$this->values['data_fim']}'";
		}
		
		if(isset($this->values['quemsomos_id'])&&trim($this->values['quemsomos_id'])!=''){
			$sql[] = "AND t.quemsomos_id = '{$this->values['quemsomos_id']}'";
		}

		if(isset($this->values['quemsomos_titulo'])&&trim($this->values['quemsomos_titulo'])!=''){
			$sql[] = "AND t.quemsomos_titulo = '{$this->values['quemsomos_titulo']}'";
		}

		if(isset($this->values['quemsomos_exibir'])&&trim($this->values['quemsomos_exibir'])!=''){
			$sql[] = "AND t.quemsomos_exibir = '{$this->values['quemsomos_exibir']}'";
		}

		if(isset($this->values['quemsomos_id'])&&trim($this->values['quemsomos_id'])!=''){
			$sql[] = "AND t.quemsomos_id = {$this->values['quemsomos_id']}";
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
		
		$sOrder = $this->getAOrderBy();
		if(isset($sOrder)&&trim($sOrder)!=''){
			$sql[] = $sOrder;
		}else{
			$sql[] = "ORDER BY t.quemsomos_dt_cadastro ASC";
		}
		
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
					$rs['quemsomos_exibir_label'] = $rs['quemsomos_exibir']=='S'?'Sim':'Não';
					$rs['quemsomos_dt_cadastro'] = $this->dateDB2BR($rs['quemsomos_dt_cadastro']);
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
		$sql[] = "AND		t.quemsomos_id = '{$this->values['quemsomos_id']}'";
		$result = $this->dbConn->db_query(implode("\n",$sql));
		$rs = array();
		if($result['success']){
			if($result['total'] > 0){
				$rs = $this->dbConn->db_fetch_assoc($result['result']);
				$rs['quemsomos_exibir_label'] = $rs['quemsomos_exibir']=='S'?'Sim':'Não';
				$rs['quemsomos_dt_cadastro'] = $this->dateDB2BR($rs['quemsomos_dt_cadastro']);
			}
		}
		return $this->utf8_array_encode($rs);
	}

	public function edit(){
		if(isset($this->values['quemsomos_id'])&&trim($this->values['quemsomos_id'])!=''){
			$result = $this->update();
		}else{
			$result = $this->insert();
		}
		return $result;
	}

	private function update(){
		$this->values['quemsomos_exibir'] = trim($this->values['quemsomos_exibir'])!=''?$this->values['quemsomos_exibir']:'N';
		$this->values['quemsomos_conteudo'] = $this->escape_string($this->values['quemsomos_conteudo']);
		$this->values['quemsomos_dt_cadastro'] = $this->dateBR2DB($this->values['quemsomos_dt_cadastro']);
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			UPDATE	tb_quemsomos SET
					quemsomos_dt_cadastro = '{$this->values['quemsomos_dt_cadastro']}'
					,quemsomos_exibir = '{$this->values['quemsomos_exibir']}'
					,quemsomos_titulo = '{$this->values['quemsomos_titulo']}'
					,quemsomos_conteudo = '{$this->values['quemsomos_conteudo']}'
		";
		
		$sql[] = "WHERE	quemsomos_id = '{$this->values['quemsomos_id']}'";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
		}else{
			$this->dbConn->db_commit();
		}
		return $result;
	}

	private function insert(){
		$this->values['quemsomos_exibir'] = trim($this->values['quemsomos_exibir'])!=''?$this->values['quemsomos_exibir']:'N';
		$this->values['quemsomos_conteudo'] = $this->escape_string($this->values['quemsomos_conteudo']);
		$this->values['quemsomos_dt_cadastro'] = $this->dateBR2DB($this->values['quemsomos_dt_cadastro']);
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			INSERT INTO	tb_quemsomos SET
					quemsomos_dt_cadastro = CURDATE()
					,quemsomos_exibir = '{$this->values['quemsomos_exibir']}'
					,quemsomos_titulo = '{$this->values['quemsomos_titulo']}'
					,quemsomos_conteudo = '{$this->values['quemsomos_conteudo']}'
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
			DELETE FROM tb_quemsomos
			WHERE quemsomos_id = '{$this->values['quemsomos_id']}'
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

?>