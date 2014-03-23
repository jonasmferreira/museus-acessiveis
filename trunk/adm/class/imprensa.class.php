<?php
$path_root_imprensaClass = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_imprensaClass = "{$path_root_imprensaClass}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_imprensaClass}adm{$DS}class{$DS}default.class.php";
class imprensa extends defaultClass{
	protected $dbConn;
	protected $pathImg;
	protected $filterFieldName = array(
		't.imprensa_titulo'=>array(
			'fieldNameId'=>'t.imprensa_titulo'
			,'fieldNameLabel'=>'Nome'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
		,'t.imprensa_arquivo'=>array(
			'fieldNameId'=>'t.imprensa_arquivo'
			,'fieldNameLabel'=>'Arquivo'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
	);
	
	protected $tipoImprensa = array(
		1=>array(
			'tipo_imprensa_id'=>1
			,'tipo_imprensa_titulo'=>'PDF'
		)
		,2=>array(
			'tipo_imprensa_id'=>2
			,'tipo_imprensa_titulo'=>'DOC'
		)
		,3=>array(
			'tipo_imprensa_id'=>3
			,'tipo_imprensa_titulo'=>'PPT'
		)
		,4=>array(
			'tipo_imprensa_id'=>4
			,'tipo_imprensa_titulo'=>'IMG'
		)
		,5=>array(
			'tipo_imprensa_id'=>5
			,'tipo_imprensa_titulo'=>'Excel'
		)
		,6=>array(
			'tipo_imprensa_id'=>6
			,'tipo_imprensa_titulo'=>'Vídeo'
		)
	);
	
	public function __construct() {
		$path_root_imprensaClass = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_imprensaClass = "{$path_root_imprensaClass}{$DS}..{$DS}..{$DS}";
		$this->pathImg = "{$path_root_imprensaClass}arquivosDown{$DS}";
		if(!is_dir($this->pathImg)){
			@mkdir($this->pathImg, 0777,true);
		}
		@chmod($this->pathImg, 0777);
		$this->dbConn = new DataBaseClass();
	}
	
	public function getFilterFieldName() {
		return $this->filterFieldName;
	}
	
	public function getTipoImprensa() {
		return $this->tipoImprensa;
	}
		
	protected function getSql(){
		$sql = array();
		$sql[] = "
			SELECT	t.*
			FROM	tb_imprensa t
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
		$sql[] = "ORDER BY t.imprensa_tipo ASC, t.imprensa_titulo ASC ";
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
					$rs['imprensa_tipo_label'] = $this->tipoImprensa[$rs['imprensa_tipo']]['tipo_imprensa_titulo'];
					$rs['imprensa_dt_hr'] = $this->dateDB2BR($rs['imprensa_dt'])." às ".$rs['imprensa_hr'];
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
		$sql[] = "AND		t.imprensa_id = '{$this->values['imprensa_id']}'";
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
		if(isset($this->values['imprensa_id'])&&trim($this->values['imprensa_id'])!=''){
			$result = $this->update();
		}else{
			$result = $this->insert();
		}
		return $result;
	}

	private function update(){
		$this->values['imprensa_arquivo'] = $this->uploadFile($this->pathImg, $this->files['imprensa_arquivo']);
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			UPDATE	tb_imprensa SET
					imprensa_titulo = '{$this->values['imprensa_titulo']}'
					,imprensa_tipo = '{$this->values['imprensa_tipo']}'
		";
		if(trim($this->values['imprensa_arquivo'])!=""){
			$this->values['imprensa_tamanho'] = filesize("{$this->pathImg}{$this->values['imprensa_arquivo']}");
			$sql[] = "
				,imprensa_tamanho = '{$this->values['imprensa_tamanho']}'
				,imprensa_arquivo = '{$this->values['imprensa_arquivo']}'
			";
		}
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
		$this->values['imprensa_arquivo'] = $this->uploadFile($this->pathImg, $this->files['imprensa_arquivo']);
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			INSERT	INTO tb_imprensa SET
					imprensa_titulo = '{$this->values['imprensa_titulo']}'
					,imprensa_tipo = '{$this->values['imprensa_tipo']}'
					,imprensa_dt = CURDATE()
					,imprensa_hr = CURTIME()
		";
		if(trim($this->values['imprensa_arquivo'])!=""){
			$this->values['imprensa_tamanho'] = filesize("{$this->pathImg}{$this->values['imprensa_arquivo']}");
			$sql[] = "
				,imprensa_tamanho = '{$this->values['imprensa_tamanho']}'
				,imprensa_arquivo = '{$this->values['imprensa_arquivo']}'
			";
		}
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