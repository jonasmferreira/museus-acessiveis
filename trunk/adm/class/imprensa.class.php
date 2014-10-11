<?php
$path_root_imprensaClass = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_imprensaClass = "{$path_root_imprensaClass}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_imprensaClass}adm{$DS}class{$DS}default.class.php";
class imprensa extends defaultClass{
	protected $dbConn;
	protected $pathImg;
	protected $filterFieldName = array(
		'a.emailmkt_titulo'=>array(
			'fieldNameId'=>'a.imprensa_assessoria_nome'
			,'fieldNameLabel'=>'Nome da Assessoria'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
	);
	public function __construct() {
		$path_root_imprensaClass = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_imprensaClass = "{$path_root_imprensaClass}{$DS}..{$DS}..{$DS}";
		
		$this->pathImg = "{$path_root_imprensaClass}img{$DS}";
		if(!is_dir($this->pathImg)){
			@mkdir($this->pathImg,0777,true);
		}
		@chmod($this->pathImg,0777);
		$this->dbConn = new DataBaseClass();
	}
	public function getFilterFieldName() {
		return $this->filterFieldName;
	}	
	
	protected function getSql(){
		$sql = array();
		$sql[] = "
			SELECT	a.*
			FROM	tb_imprensa a
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

		if(isset($this->values['novidade_360_exibir_destaque_home'])&&trim($this->values['novidade_360_exibir_destaque_home'])!=''){
			$sql[] = "AND a.novidade_360_exibir_destaque_home = '{$this->values['novidade_360_exibir_destaque_home']}'";
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
		$sql[] = "ORDER BY a.imprensa_assessoria_nome ASC";
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
		$sql[] = "AND		a.imprensa_id = '{$this->values['imprensa_id']}'";
		$result = $this->dbConn->db_query(implode("\n",$sql));
		$rs = array();
		if($result['success']){
			if($result['total'] > 0){
				$rs = $this->dbConn->db_fetch_assoc($result['result']);
			}
		}
		return $this->utf8_array_encode($rs);
	}
	
	public function getNovidade360(){
		$path_root_servicoLista = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_servicoLista = "{$path_root_servicoLista}{$DS}..{$DS}..{$DS}";
		include_once("{$path_root_servicoLista}adm{$DS}class{$DS}novidade.class.php");
		$obj = new novidade();
		$obj->setValues(array(
			'page'=>'1'
			,'rows'=>'10000000000000'
			,'novidade_360_exibir_destaque_home' => 'S'
		));
		$aRet = $obj->getLista();
		return $aRet['rows'];
	}
	
	public function edit(){
		if(isset($this->values['imprensa_id'])&&trim($this->values['imprensa_id'])!=''){
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
			UPDATE	tb_imprensa SET
				imprensa_assessoria_nome = '{$this->values['imprensa_assessoria_nome']}'
				,imprensa_assessoria_telefone = '{$this->values['imprensa_assessoria_telefone']}'
				,imprensa_assessoria_email = '{$this->values['imprensa_assessoria_email']}'
				,imprensa_nossos_numeros = '{$this->values['imprensa_nossos_numeros']}'
				,novidade_360_id = {$this->values['novidade_360_id']}
		";
		$sql[] = "WHERE	imprensa_id = '{$this->values['imprensa_id']}'";
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
			INSERT INTO	tb_imprensa SET
				imprensa_assessoria_nome = '{$this->values['imprensa_assessoria_nome']}'
				,imprensa_assessoria_telefone = '{$this->values['imprensa_assessoria_telefone']}'
				,imprensa_assessoria_email = '{$this->values['imprensa_assessoria_email']}'
				,imprensa_nossos_numeros = '{$this->values['imprensa_nossos_numeros']}'
				,novidade_360_id = {$this->values['novidade_360_id']}
				
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
			DELETE FROM tb_imprensa
			WHERE imprensa_id = '{$this->values['imprensa_id']}'
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

