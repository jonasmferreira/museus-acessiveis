<?php
$path_root_projetoClass = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_projetoClass = "{$path_root_projetoClass}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_projetoClass}adm{$DS}class{$DS}default.class.php";
class projeto extends defaultClass{
	protected $dbConn;
	protected $pathImg;
	protected $filterFieldName = array(
		't.projeto_titulo'=>array(
			'fieldNameId'=>'t.projeto_titulo'
			,'fieldNameLabel'=>'Nome'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
	);
	protected $tipoProjeto = array(
		'A'=>array(
			'tipo_projeto_id'=>'A'
			,'tipo_projeto_titulo'=>'Aberto'
		)
		,'R'=>array(
			'tipo_projeto_id'=>'R'
			,'tipo_projeto_titulo'=>'Realizado'
		)
		,'EA'=>array(
			'tipo_projeto_id'=>'EA'
			,'tipo_projeto_titulo'=>'Em Andamento'
		)
	);
	public function __construct() {
		$path_root_projetoClass = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_projetoClass = "{$path_root_projetoClass}{$DS}..{$DS}..{$DS}";
		$this->pathImg = "{$path_root_projetoClass}images{$DS}";
		if(!is_dir($this->pathImg)){
			@mkdir($this->pathImg, 0777,true);
		}
		@chmod($this->pathImg, 0777);
		$this->dbConn = new DataBaseClass();
	}
	
	public function getTipoProjeto() {
		return $this->tipoProjeto;
	}
			
	public function getFilterFieldName() {
		return $this->filterFieldName;
	}
		
	protected function getSql(){
		$sql = array();
		$sql[] = "
			SELECT	t.*
			FROM	tb_projeto t
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
			$sql[] = "AND t.projeto_agenda >= '{$this->values['data_ini']}'";
		}
		if(isset($this->values['data_fim'])&&trim($this->values['data_fim'])!=''){
			$this->values['data_fim'] = $this->dateBR2DB($this->values['data_fim']);
			$sql[] = "AND t.projeto_agenda <= '{$this->values['data_fim']}'";
		}
		if(isset($this->values['projeto_tipo'])&&trim($this->values['projeto_tipo'])!=''){
			$sql[] = "AND t.projeto_tipo = '{$this->values['projeto_tipo']}'";
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
			$sql[] = "ORDER BY t.projeto_agenda ASC";
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
					$rs['projeto_sob_demanda_label'] = $rs['projeto_sob_demanda']=='S'?'Sim':'Não';
					$rs['projeto_dt_hr'] = $this->dateDB2BR($rs['projeto_dt_cad'])." às ".$rs['projeto_hr_cad'];
					$rs['projeto_dt_ini'] = $this->dateDB2BR($rs['projeto_dt_ini']);
					$rs['projeto_dt_fim'] = $this->dateDB2BR($rs['projeto_dt_fim']);
					$rs['projeto_agenda'] = $this->dateDB2BR($rs['projeto_agenda']);
					$rs['projeto_tipo_label'] = $this->tipoProjeto[$rs['projeto_tipo']]['tipo_projeto_titulo'];
					$rs['tags'] = $this->getTagsCadatradas($rs['projeto_id']);
					$rs['glossarios'] = $this->getGlossarioCadatradas($rs['projeto_id']);
					$rs['downloads'] = $this->getDownloadCadastrados($rs['projeto_id']);
					$rs['extras'] = $this->getExtraCadastrados($rs['projeto_id']);
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
		$sql[] = "AND		t.projeto_id = '{$this->values['projeto_id']}'";
		$result = $this->dbConn->db_query(implode("\n",$sql));
		$rs = array();
		if($result['success']){
			if($result['total'] > 0){
				$rs = $this->dbConn->db_fetch_assoc($result['result']);
				$rs['projeto_sob_demanda_label'] = $rs['projeto_sob_demanda']=='S'?'Sim':'Não';
				$rs['projeto_dt_hr'] = $this->dateDB2BR($rs['projeto_dt'])." às ".$rs['projeto_hr'];
				$rs['projeto_dt_ini'] = $this->dateDB2BR($rs['projeto_dt_ini']);
				$rs['projeto_dt_fim'] = $this->dateDB2BR($rs['projeto_dt_fim']);
				$rs['projeto_agenda'] = $this->dateDB2BR($rs['projeto_agenda']);
				$rs['projeto_tipo_label'] = $this->tipoProjeto[$rs['projeto_tipo']]['tipo_projeto_titulo'];
				$rs['tags'] = $this->getTagsCadatradas($rs['projeto_id']);
				$rs['glossarios'] = $this->getGlossarioCadatradas($rs['projeto_id']);
				$rs['downloads'] = $this->getDownloadCadastrados($rs['projeto_id']);
				$rs['extras'] = $this->getExtraCadastrados($rs['projeto_id']);
			}
		}
		return $this->utf8_array_encode($rs);
	}

	public function edit(){
		if(isset($this->values['projeto_id'])&&trim($this->values['projeto_id'])!=''){
			$result = $this->update();
		}else{
			$result = $this->insert();
		}
		return $result;
	}

	private function update(){
		$this->values['projeto_sob_demanda'] = trim($this->values['projeto_sob_demanda'])!=''?$this->values['projeto_sob_demanda']:'N';
		$this->values['projeto_conteudo'] = $this->escape_string($this->values['projeto_conteudo']);
		$this->values['projeto_resumo'] = $this->escape_string($this->values['projeto_resumo']);
		$this->values['projeto_thumb_desc'] = $this->escape_string($this->values['projeto_resumo']);
		$this->values['projeto_thumb'] = $this->uploadFile($this->pathImg, $this->files['projeto_thumb']);
		$this->values['projeto_dt_ini'] = $this->dateBR2DB($this->values['projeto_dt_ini']);
		$this->values['projeto_dt_fim'] = $this->dateBR2DB($this->values['projeto_dt_fim']);
		$this->values['projeto_agenda'] = $this->dateBR2DB($this->values['projeto_agenda']);
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			UPDATE	tb_projeto SET
					projeto_dt_ini = '{$this->values['projeto_dt_ini']}'
					,projeto_dt_fim = '{$this->values['projeto_dt_fim']}'
					,projeto_sob_demanda = '{$this->values['projeto_sob_demanda']}'
					,projeto_tipo = '{$this->values['projeto_tipo']}'
					,projeto_titulo = '{$this->values['projeto_titulo']}'
					,projeto_resumo = '{$this->values['projeto_resumo']}'
					,projeto_thumb_desc = '{$this->values['projeto_thumb_desc']}'
					,projeto_fonte = '{$this->values['projeto_fonte']}'
					,projeto_link_fonte = '{$this->values['projeto_link_fonte']}'
					,projeto_conteudo = '{$this->values['projeto_conteudo']}'
					,projeto_agenda = '{$this->values['projeto_agenda']}'
		";
		if(trim($this->values['projeto_thumb'])){
			$sql[] = ",projeto_thumb = '{$this->values['projeto_thumb']}'";
		}
		
		$sql[] = "WHERE	projeto_id = '{$this->values['projeto_id']}'";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->deleteExtras();
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		
		$result = $this->deleteDownload();
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->deleteGlossario();
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->deleteTags();
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$projeto_id = $this->values['projeto_id'];
		$result = $this->insertExtras($this->values['extras'], $projeto_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->insertDownload($this->values['downloads'], $projeto_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->insertGlossario($this->values['glossarios'], $projeto_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->insertTags($this->values['tags'], $projeto_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$this->dbConn->db_commit();
		return $result;
	}

	private function insert(){
		$this->values['projeto_sob_demanda'] = trim($this->values['projeto_sob_demanda'])!=''?$this->values['projeto_sob_demanda']:'N';
		$this->values['projeto_conteudo'] = $this->escape_string($this->values['projeto_conteudo']);
		$this->values['projeto_resumo'] = $this->escape_string($this->values['projeto_resumo']);
		$this->values['projeto_thumb_desc'] = $this->escape_string($this->values['projeto_resumo']);
		$this->values['projeto_thumb'] = $this->uploadFile($this->pathImg, $this->files['projeto_thumb']);
		$this->values['projeto_dt_ini'] = $this->dateBR2DB($this->values['projeto_dt_ini']);
		$this->values['projeto_dt_fim'] = $this->dateBR2DB($this->values['projeto_dt_fim']);
		$this->values['projeto_agenda'] = $this->dateBR2DB($this->values['projeto_agenda']);
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			INSERT INTO	tb_projeto SET
				projeto_dt_cad = CURDATE()
				,projeto_hr_cad = CURTIME()
				,projeto_dt_ini = '{$this->values['projeto_dt_ini']}'
				,projeto_dt_fim = '{$this->values['projeto_dt_fim']}'
				,projeto_sob_demanda = '{$this->values['projeto_sob_demanda']}'
				,projeto_titulo = '{$this->values['projeto_titulo']}'
				,projeto_tipo = '{$this->values['projeto_tipo']}'
				,projeto_resumo = '{$this->values['projeto_resumo']}'
				,projeto_thumb = '{$this->values['projeto_thumb']}'
				,projeto_thumb_desc = '{$this->values['projeto_thumb_desc']}'
				,projeto_fonte = '{$this->values['projeto_fonte']}'
				,projeto_link_fonte = '{$this->values['projeto_link_fonte']}'
				,projeto_conteudo = '{$this->values['projeto_conteudo']}'
				,projeto_agenda = '{$this->values['projeto_agenda']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$projeto_id = $result['last_id'];
		$result = $this->insertExtras($this->values['extras'], $projeto_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->insertDownload($this->values['downloads'], $projeto_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->insertGlossario($this->values['glossarios'], $projeto_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->insertTags($this->values['tags'], $projeto_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$this->dbConn->db_commit();
		return $result;
	}
	
	protected function deleteTags(){
		$sql = array();
		$sql[] = "
			DELETE FROM tb_projeto_tag
			WHERE	projeto_id = '{$this->values['projeto_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		return $result;
	}
	protected function insertTags($tags,$projeto_id){
		if(count($tags) > 0){
			foreach($tags AS $tag){
				$sql = array();
				$sql[] = "
					INSERT INTO tb_projeto_tag SET
						projeto_id = '{$projeto_id}'
						,tag_id = '{$tag}'
				";
				$result = $this->dbConn->db_execute(implode("\n",$sql));
				if($result['success']===false){
					return $result; 
				}
			}
			return $result;
		}
		return array('success'=>'true');
	}
	protected function deleteGlossario(){
		$sql = array();
		$sql[] = "
			DELETE FROM tb_projeto_glossario
			WHERE	projeto_id = '{$this->values['projeto_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		return $result;
	}
	protected function insertGlossario($glossarios,$projeto_id){
		if(count($glossarios) > 0){
			foreach($glossarios AS $glossario){
				$sql = array();
				$sql[] = "
					INSERT INTO tb_projeto_glossario SET
						projeto_id = '{$projeto_id}'
						,glossario_id = '{$glossario}'
				";
				$result = $this->dbConn->db_execute(implode("\n",$sql));
				if($result['success']===false){
					return $result; 
				}
			}
			return $result;
		}
		return array('success'=>'true');
	}
	protected function deleteDownload(){
		$sql = array();
		$sql[] = "
			DELETE FROM tb_projeto_download
			WHERE	projeto_id = '{$this->values['projeto_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		return $result;
	}
	protected function insertDownload($downloads,$projeto_id){
		if(count($downloads) > 0){
			foreach($downloads AS $download){
				$sql = array();
				$sql[] = "
					INSERT INTO tb_projeto_download SET
						projeto_id = '{$projeto_id}'
						,download_id = '{$download}'
				";
				$result = $this->dbConn->db_execute(implode("\n",$sql));
				if($result['success']===false){
					return $result; 
				}
			}
			return $result;
		}
		return array('success'=>'true');
	}
	protected function deleteExtras(){
		$sql = array();
		$sql[] = "
			DELETE FROM tb_projeto_extra
			WHERE	projeto_id = '{$this->values['projeto_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		return $result;
	}
	protected function insertExtras($extras,$projeto_id){
		if(count($extras) > 0){
			foreach($extras AS $k=> $extra){
				$sql = array();
				$sql[] = "
					INSERT INTO tb_projeto_extra SET
						projeto_id = '{$projeto_id}'
						,extra_id = '{$k}'
						,projeto_extra_valor = '{$extra}'
				";
				$result = $this->dbConn->db_execute(implode("\n",$sql));
				if($result['success']===false){
					return $result; 
				}
			}
			return $result;
		}
		return array('success'=>'true');
	}
	public function deleteItem(){
		$this->dbConn->db_start_transaction();
		$result = $this->deleteExtras();
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->deleteDownload();
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->deleteGlossario();
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->deleteTags();
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$sql = array();
		$sql[] = "
			DELETE FROM tb_projeto
			WHERE projeto_id = '{$this->values['projeto_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
		}else{
			$this->dbConn->db_commit();
		}
		return $result;
	}
	
	public function getTagsCadatradas($projeto_id){
		$sql = array();
		$sql[] = "
			SELECT	tag_id
			FROM	tb_projeto_tag
			WHERE	1 = 1
			AND		projeto_id = '{$projeto_id}'
		";
		$arr = array();
		$result = $this->dbConn->db_query(implode("\n",$sql));
		if($result['success']){
			if($result['total'] > 0){
				while($rs = $this->dbConn->db_fetch_assoc($result['result'])){
					$arr[] = $rs['tag_id'];
				}
			}
		}
		return $arr;
	}
	public function getDownloadCadastrados($projeto_id){
		$sql = array();
		$sql[] = "
			SELECT	download_id
			FROM	tb_projeto_download
			WHERE	1 = 1
			AND		projeto_id = '{$projeto_id}'
		";
		$arr = array();
		$result = $this->dbConn->db_query(implode("\n",$sql));
		if($result['success']){
			if($result['total'] > 0){
				while($rs = $this->dbConn->db_fetch_assoc($result['result'])){
					$arr[] = $rs['download_id'];
				}
			}
		}
		return $arr;
	}
	
	public function getGlossarioCadatradas($projeto_id){
		$sql = array();
		$sql[] = "
			SELECT	glossario_id
			FROM	tb_projeto_glossario
			WHERE	1 = 1
			AND		projeto_id = '{$projeto_id}'
		";
		$arr = array();
		$result = $this->dbConn->db_query(implode("\n",$sql));
		if($result['success']){
			if($result['total'] > 0){
				while($rs = $this->dbConn->db_fetch_assoc($result['result'])){
					$arr[] = $rs['glossario_id'];
				}
			}
		}
		return $arr;
	}
	
	public function getExtraCadastrados($projeto_id){
		$sql = array();
		$sql[] = "
			SELECT	extra_id
					,projeto_extra_valor
			FROM	tb_projeto_extra
			WHERE	1 = 1
			AND		projeto_id = '{$projeto_id}'
		";
		$arr = array();
		$result = $this->dbConn->db_query(implode("\n",$sql));
		if($result['success']){
			if($result['total'] > 0){
				while($rs = $this->dbConn->db_fetch_assoc($result['result'])){
					$arr[$rs['extra_id']] = $rs['projeto_extra_valor'];
				}
			}
		}
		return $arr;
	}
	
	public function getTags(){
		$sql = array();
		$sql[] = "
			SELECT	t.*
			FROM	tb_tag t
			WHERE	1 = 1
		";
		$arr = array();
		$result = $this->dbConn->db_query(implode("\n",$sql));
		if($result['success']){
			if($result['total'] > 0){
				while($rs = $this->dbConn->db_fetch_assoc($result['result'])){
					array_push($arr,$this->utf8_array_encode($rs));
				}
			}
		}
		return $arr;
	}
	
	public function getGlossario(){
		$sql = array();
		$sql[] = "
			SELECT	t.*
			FROM	tb_glossario t
			WHERE	1 = 1
		";
		$arr = array();
		$result = $this->dbConn->db_query(implode("\n",$sql));
		if($result['success']){
			if($result['total'] > 0){
				while($rs = $this->dbConn->db_fetch_assoc($result['result'])){
					array_push($arr,$this->utf8_array_encode($rs));
				}
			}
		}
		return $arr;
	}
	public function getDownload(){
		$sql = array();
		$sql[] = "
			SELECT	t.*
			FROM	tb_download t
			WHERE	1 = 1
		";
		$arr = array();
		$result = $this->dbConn->db_query(implode("\n",$sql));
		if($result['success']){
			if($result['total'] > 0){
				while($rs = $this->dbConn->db_fetch_assoc($result['result'])){
					array_push($arr,$this->utf8_array_encode($rs));
				}
			}
		}
		return $arr;
	}
	public function getExtra(){
		$sql = array();
		$sql[] = "
			SELECT	t.*
			FROM	tb_extra t
			WHERE	1 = 1
		";
		$arr = array();
		$result = $this->dbConn->db_query(implode("\n",$sql));
		if($result['success']){
			if($result['total'] > 0){
				while($rs = $this->dbConn->db_fetch_assoc($result['result'])){
					array_push($arr,$this->utf8_array_encode($rs));
				}
			}
		}
		return $arr;
	}
	public function removeImage(){
		$aReg = $this->getOne();
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			UPDATE tb_projeto SET
				{$this->values['img']} = ''
			WHERE	projeto_id = '{$this->values['projeto_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
		}else{
			@unlink("{$this->pathImg}{$aReg[$this->values['img']]}");
			$this->dbConn->db_commit();
		}
		return $result;
	}
}