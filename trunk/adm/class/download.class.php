<?php
$path_root_downloadClass = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_downloadClass = "{$path_root_downloadClass}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_downloadClass}adm{$DS}class{$DS}default.class.php";
class download extends defaultClass{
	protected $dbConn;
	protected $pathImg;
	protected $filterFieldName = array(
		't.download_titulo'=>array(
			'fieldNameId'=>'t.download_titulo'
			,'fieldNameLabel'=>'Nome'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
		,'t.download_arquivo'=>array(
			'fieldNameId'=>'t.download_arquivo'
			,'fieldNameLabel'=>'Arquivo'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
	);
	
	protected $tipoDownload = array(
		1=>array(
			'tipo_download_id'=>1
			,'tipo_download_titulo'=>'PDF'
		)
		,2=>array(
			'tipo_download_id'=>2
			,'tipo_download_titulo'=>'DOC'
		)
		,3=>array(
			'tipo_download_id'=>3
			,'tipo_download_titulo'=>'PPT'
		)
		,4=>array(
			'tipo_download_id'=>4
			,'tipo_download_titulo'=>'IMG'
		)
		,5=>array(
			'tipo_download_id'=>5
			,'tipo_download_titulo'=>'Excel'
		)
		,6=>array(
			'tipo_download_id'=>6
			,'tipo_download_titulo'=>'Vídeo'
		)
		,7=>array(
			'tipo_download_id'=>7
			,'tipo_download_titulo'=>'Link Internet'
		)
		
	);
	
	public function __construct() {
		$path_root_downloadClass = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_downloadClass = "{$path_root_downloadClass}{$DS}..{$DS}..{$DS}";
		$this->pathImg = "{$path_root_downloadClass}arquivosDown{$DS}";
		if(!is_dir($this->pathImg)){
			@mkdir($this->pathImg, 0777,true);
		}
		@chmod($this->pathImg, 0777);
		$this->dbConn = new DataBaseClass();
	}
	
	public function getFilterFieldName() {
		return $this->filterFieldName;
	}
	
	public function getTipoDownload() {
		return $this->tipoDownload;
	}
		
	protected function getSql(){
		$sql = array();
		$sql[] = "
			SELECT	t.*
			FROM	tb_download t
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
		
		$sOrder = $this->getAOrderBy();
		if(isset($sOrder)&&trim($sOrder)!=''){
			$sql[] = $sOrder;
		}else{
			$sql[] = "ORDER BY t.download_tipo ASC, t.download_titulo ASC ";
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
					$rs['download_tipo_label'] = $this->tipoDownload[$rs['download_tipo']]['tipo_download_titulo'];
					$rs['download_dt_hr'] = $this->dateDB2BR($rs['download_dt'])." às ".$rs['download_hr'];
					$rs['download_dt'] = $this->dateDB2BR($rs['download_dt']);
					$rs['download_tamanho_label'] = $this->getSizeName($rs['download_tamanho']);					
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
		$sql[] = "AND		t.download_id = '{$this->values['download_id']}'";
		$result = $this->dbConn->db_query(implode("\n",$sql));
		$rs = array();
		if($result['success']){
			if($result['total'] > 0){
				$rs = $this->dbConn->db_fetch_assoc($result['result']);
			}
		}
		return $this->utf8_array_encode($rs);
	}

	public function getDownsByProject(){
		$page = $this->values['page']; 
		$limit = $this->values['rows']; 
		
		$sql = array();
		$sql[] = $this->getSql();
		$sql[] = "AND		t.download_id IN ('{$this->values['download_list_id']}')";

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
			$sql[] = "ORDER BY t.download_tipo ASC, t.download_titulo ASC ";
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
					$rs['download_tipo_label'] = $this->tipoDownload[$rs['download_tipo']]['tipo_download_titulo'];
					$rs['download_dt_hr'] = $this->dateDB2BR($rs['download_dt'])." às ".$rs['download_hr'];
					$rs['download_dt'] = $this->dateDB2BR($rs['download_dt']);
					$rs['download_tamanho_label'] = $this->getSizeName($rs['download_tamanho']);					
					array_push($arr,$this->utf8_array_encode($rs));
				}
			}
		}
		$aRet['rows'] = $arr;
		return $aRet;

	}
	
	public function edit(){
		if(isset($this->values['download_id'])&&trim($this->values['download_id'])!=''){
			$result = $this->update();
		}else{
			$result = $this->insert();
		}
		return $result;
	}

	private function update(){

		if($this->values['download_tipo']!=7){
			$this->values['download_arquivo'] = $this->uploadFile($this->pathImg, $this->files['download_arquivo']);
		}else{
			//Link Internet
			$this->values['download_arquivo'] = $this->values['download_link'];
		}
		
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			UPDATE	tb_download SET
					download_titulo = '{$this->values['download_titulo']}'
					,download_tipo = '{$this->values['download_tipo']}'
		";
		if(trim($this->values['download_arquivo'])!=""){
			if($this->values['download_tipo']!=7){
				$this->values['download_tamanho'] = filesize("{$this->pathImg}{$this->values['download_arquivo']}");
			}else{
				$this->values['download_tamanho']=0;
			}
			$sql[] = "
				,download_tamanho = '{$this->values['download_tamanho']}'
				,download_arquivo = '{$this->values['download_arquivo']}'
			";
		}
		$sql[] = "WHERE	download_id = '{$this->values['download_id']}'";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
		}else{
			$this->dbConn->db_commit();
		}
		return $result;
	}

	private function insert(){

		if($this->values['download_tipo']!=7){
			$this->values['download_arquivo'] = $this->uploadFile($this->pathImg, $this->files['download_arquivo']);
		}else{
			//Link Internet
			$this->values['download_arquivo'] = $this->values['download_link'];
		}
		
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			INSERT	INTO tb_download SET
					download_titulo = '{$this->values['download_titulo']}'
					,download_tipo = '{$this->values['download_tipo']}'
					,download_dt = CURDATE()
					,download_hr = CURTIME()
		";
		if(trim($this->values['download_arquivo'])!=""){
			if($this->values['download_tipo']!=7){
				$this->values['download_tamanho'] = filesize("{$this->pathImg}{$this->values['download_arquivo']}");
			}else{
				$this->values['download_tamanho']=0;
			}

			$sql[] = "
				,download_tamanho = '{$this->values['download_tamanho']}'
				,download_arquivo = '{$this->values['download_arquivo']}'
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
			DELETE FROM tb_download
			WHERE download_id = '{$this->values['download_id']}'
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