<?php
$path_root_releaseClass = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_releaseClass = "{$path_root_releaseClass}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_releaseClass}adm{$DS}class{$DS}default.class.php";
class release extends defaultClass{
	protected $dbConn;
	protected $pathImg;
	protected $filterFieldName = array(
		't.release_titulo'=>array(
			'fieldNameId'=>'t.release_titulo'
			,'fieldNameLabel'=>'Título'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
		,'t.release_titulo_sintese'=>array(
			'fieldNameId'=>'t.release_titulo_sintese'
			,'fieldNameLabel'=>'Título Síntese'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
		,'t.release_resumo'=>array(
			'fieldNameId'=>'t.release_resumo'
			,'fieldNameLabel'=>'Resumo'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
		,'t.release_fonte'=>array(
			'fieldNameId'=>'t.release_fonte'
			,'fieldNameLabel'=>'Fonte'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
		
	);
	
	public function __construct() {
		$path_root_releaseClass = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_releaseClass = "{$path_root_releaseClass}{$DS}..{$DS}..{$DS}";
		$this->pathImg = "{$path_root_releaseClass}images{$DS}";
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
			FROM	tb_release t
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
		if(isset($this->values['release_dt_ini'])&&trim($this->values['release_dt_ini'])!=''){
			$this->values['release_dt_ini'] = $this->dateBR2DB($this->values['release_dt_ini']);
			$sql[] = "AND t.release_dt >= '{$this->values['release_dt_ini']}'";
		}
		if(isset($this->values['release_dt_fim'])&&trim($this->values['release_dt_fim'])!=''){
			$this->values['release_dt_fim'] = $this->dateBR2DB($this->values['release_dt_fim']);
			$sql[] = "AND t.release_dt <= '{$this->values['release_dt_fim']}'";
		}

		if(isset($this->values['release_exibir_banner'])&&trim($this->values['release_exibir_banner'])!=''){
			$this->values['release_exibir_banner'] = $this->values['release_exibir_banner'];
			$sql[] = "AND t.release_exibir_banner = '{$this->values['release_exibir_banner']}'";
		}
		
		if(isset($this->values['release_exibir_destaque_home'])&&trim($this->values['release_exibir_destaque_home'])!=''){
			$this->values['release_exibir_destaque_home'] = $this->values['release_exibir_destaque_home'];
			$sql[] = "AND t.release_exibir_destaque_home = '{$this->values['release_exibir_destaque_home']}'";
		}

		if(isset($this->values['release_exibir_listagem'])&&trim($this->values['release_exibir_listagem'])!=''){
			$this->values['release_exibir_listagem'] = $this->values['release_exibir_listagem'];
			$sql[] = "AND t.release_exibir_listagem = '{$this->values['release_exibir_listagem']}'";
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
			$sql[] = "ORDER BY t.release_dt ASC";
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
					$rs['release_dthr'] = $this->dateDB2BR($rs['release_dt'])." às ".$rs['release_hr'];
					$rs['release_dt_agenda'] = $this->dateDB2BR($rs['release_dt_agenda']);
					$rs['release_exibir_destaque_home_label'] = $rs['release_exibir_destaque_home']=='S'?'Sim':'Não';
					$rs['release_exibir_banner_label'] = $rs['release_exibir_banner']=='S'?'Sim':'Não';
					$rs['release_exibir_listagem_label'] = $rs['release_exibir_listagem']=='S'?'Sim':'Não';
					$rs['tags'] = $this->getTagsCadatradas($rs['release_id']);
					$rs['tags_list'] = $this->getTagsByRelease($rs['release_id']);
					$rs['downloads'] = $this->getDownloadCadastrados($rs['release_id']);
					$rs['download_list'] = $this->getDownloadByRelease($rs['release_id']);
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
		$sql[] = "AND		t.release_id = '{$this->values['release_id']}'";
		$result = $this->dbConn->db_query(implode("\n",$sql));
		$rs = array();
		if($result['success']){
			if($result['total'] > 0){
				$rs = $this->dbConn->db_fetch_assoc($result['result']);
				$rs['release_dthr'] = $this->dateDB2BR($rs['release_dt'])." às ".$rs['release_hr'];
				$rs['release_dt_agenda'] = $this->dateDB2BR($rs['release_dt_agenda']);
				$rs['tags'] = $this->getTagsCadatradas($rs['release_id']);
				$rs['tags_list'] = $this->getTagsByRelease($rs['release_id']);
				$rs['downloads'] = $this->getDownloadCadastrados($rs['release_id']);
				$rs['download_list'] = $this->getDownloadByRelease($rs['release_id']);
			}
		}
		return $this->utf8_array_encode($rs);
	}

	public function edit(){
		if(isset($this->values['release_id'])&&trim($this->values['release_id'])!=''){
			$result = $this->update();
		}else{
			$result = $this->insert();
		}
		return $result;
	}

	private function update(){
		$this->values['release_dt_agenda'] = $this->dateBR2DB($this->values['release_dt_agenda']);
		$this->values['release_dt'] = $this->dateBR2DB($this->values['release_dt']);
		//$this->values['release_dt'] = date('Y-m-d');
		$this->values['release_hr'] = date('H:i:s');		
		$this->values['releasecol'] = $this->escape_string($this->values['releasecol']);
		$this->values['release_titulo'] = $this->escape_string($this->values['release_titulo']);
		$this->values['release_titulo_sintese'] = $this->escape_string($this->values['release_titulo_sintese']);
		$this->values['release_resumo'] = $this->escape_string($this->values['release_resumo']);
		$this->values['release_conteudo'] = $this->escape_string($this->values['release_conteudo']);
		$this->values['release_thumb'] = $this->uploadFile($this->pathImg, $this->files['release_thumb']);
		$this->values['release_thumb_desc'] = $this->escape_string($this->values['release_thumb_desc']);
		$this->values['release_fonte'] = $this->escape_string($this->values['release_fonte']);
		$this->values['release_exibir_banner'] = trim($this->values['release_exibir_banner'])!=''?$this->values['release_exibir_banner']:'N';
		$this->values['release_banner'] = $this->uploadFile($this->pathImg, $this->files['release_banner']);
		$this->values['release_banner_desc'] = $this->escape_string($this->values['release_banner_desc']);
		$this->values['release_exibir_destaque_home'] = trim($this->values['release_exibir_destaque_home'])!=''?$this->values['release_exibir_destaque_home']:'N';
		$this->values['release_destaque_home'] = $this->uploadFile($this->pathImg, $this->files['release_destaque_home']);
		$this->values['release_destaque_home_desc'] = $this->escape_string($this->values['release_destaque_home_desc']);
		$this->values['release_destaque_home_frase'] = $this->escape_string($this->values['release_destaque_home_frase']);
		$this->values['release_exibir_listagem'] = trim($this->values['release_exibir_listagem'])!=''?$this->values['release_exibir_listagem']:'N';
		
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			UPDATE	tb_release SET
					release_dt_agenda = '{$this->values['release_dt_agenda']}'
					,release_dt = '{$this->values['release_dt']}'
					,release_hr = '{$this->values['release_hr']}'
					,release_titulo = '{$this->values['release_titulo']}'
					,release_titulo_sintese = '{$this->values['release_titulo_sintese']}'
					,release_resumo = '{$this->values['release_resumo']}'
					,release_thumb_desc = '{$this->values['release_thumb_desc']}'
					,release_fonte = '{$this->values['release_fonte']}'
					,release_url_fonte = '{$this->values['release_url_fonte']}'
					,release_conteudo = '{$this->values['release_conteudo']}'
					,release_exibir_banner = '{$this->values['release_exibir_banner']}'
					,release_banner_desc = '{$this->values['release_banner_desc']}'
					,release_exibir_destaque_home = '{$this->values['release_exibir_destaque_home']}'
					,release_destaque_home_desc = '{$this->values['release_destaque_home_desc']}'
					,release_destaque_home_frase = '{$this->values['release_destaque_home_frase']}'
					,release_exibir_listagem = '{$this->values['release_exibir_listagem']}'
					
		";
		if(trim($this->values['release_thumb'])!=""){
			$sql[] = ",release_thumb = '{$this->values['release_thumb']}'";
		}
		if(trim($this->values['release_banner'])!=""){
			$sql[] = ",release_banner = '{$this->values['release_banner']}'";
		}
		if(trim($this->values['release_destaque_home'])!=""){
			$sql[] = ",release_destaque_home = '{$this->values['release_destaque_home']}'";
		}
		
		$sql[] = "WHERE	release_id = '{$this->values['release_id']}'";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->deleteTags();
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->deleteDownload();
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		
		$release_id = $this->values['release_id'];
		$result = $this->insertTags($this->values['tags'], $release_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		
		$result = $this->insertDownload($this->values['downloads'], $release_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		
		$this->dbConn->db_commit();
		return $result;
	}

	private function insert(){
		$this->values['release_dt_agenda'] = $this->dateBR2DB($this->values['release_dt_agenda']);
		$this->values['release_dt'] = $this->dateBR2DB($this->values['release_dt']);
		//$this->values['release_dt'] = date('Y-m-d');
		$this->values['release_hr'] = date('H:i:s');		
		$this->values['releasecol'] = $this->escape_string($this->values['releasecol']);
		$this->values['release_titulo'] = $this->escape_string($this->values['release_titulo']);
		$this->values['release_titulo_sintese'] = $this->escape_string($this->values['release_titulo_sintese']);
		$this->values['release_resumo'] = $this->escape_string($this->values['release_resumo']);
		$this->values['release_conteudo'] = $this->escape_string($this->values['release_conteudo']);
		$this->values['release_thumb'] = $this->uploadFile($this->pathImg, $this->files['release_thumb']);
		$this->values['release_thumb_desc'] = $this->escape_string($this->values['release_thumb_desc']);
		$this->values['release_fonte'] = $this->escape_string($this->values['release_fonte']);
		$this->values['release_exibir_banner'] = trim($this->values['release_exibir_banner'])!=''?$this->values['release_exibir_banner']:'N';
		$this->values['release_banner'] = $this->uploadFile($this->pathImg, $this->files['release_banner']);
		$this->values['release_banner_desc'] = $this->escape_string($this->values['release_banner_desc']);
		$this->values['release_exibir_destaque_home'] = trim($this->values['release_exibir_destaque_home'])!=''?$this->values['release_exibir_destaque_home']:'N';
		$this->values['release_destaque_home'] = $this->uploadFile($this->pathImg, $this->files['release_destaque_home']);
		$this->values['release_destaque_home_desc'] = $this->escape_string($this->values['release_destaque_home_desc']);
		$this->values['release_destaque_home_frase'] = $this->escape_string($this->values['release_destaque_home_frase']);
		$this->values['release_exibir_listagem'] = trim($this->values['release_exibir_listagem'])!=''?$this->values['release_exibir_listagem']:'N';
		
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			INSERT INTO	tb_release SET
					release_dt_agenda = '{$this->values['release_dt_agenda']}'
					release_dt = '{$this->values['release_dt']}'
					,release_hr = CURTIME()
					,release_titulo = '{$this->values['release_titulo']}'
					,release_titulo_sintese = '{$this->values['release_titulo_sintese']}'
					,release_resumo = '{$this->values['release_resumo']}'
					,release_thumb = '{$this->values['release_thumb']}'
					,release_thumb_desc = '{$this->values['release_thumb_desc']}'
					,release_fonte = '{$this->values['release_fonte']}'
					,release_url_fonte = '{$this->values['release_url_fonte']}'
					,release_conteudo = '{$this->values['release_conteudo']}'
					,release_exibir_banner = '{$this->values['release_exibir_banner']}'
					,release_banner = '{$this->values['release_banner']}'
					,release_banner_desc = '{$this->values['release_banner_desc']}'
					,release_exibir_destaque_home = '{$this->values['release_exibir_destaque_home']}'
					,release_destaque_home = '{$this->values['release_destaque_home']}'
					,release_destaque_home_desc = '{$this->values['release_destaque_home_desc']}'
					,release_destaque_home_frase = '{$this->values['release_destaque_home_frase']}'
					,release_exibir_listagem = '{$this->values['release_exibir_listagem']}'
					
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$release_id = $result['last_id'];
		$result = $this->insertTags($this->values['tags'], $release_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		
		$result = $this->insertDownload($this->values['downloads'], $release_id);
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
			DELETE FROM tb_release_tag
			WHERE	release_id = '{$this->values['release_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		return $result;
	}
	protected function insertTags($tags,$release_id){
		if(count($tags) > 0){
			foreach($tags AS $tag){
				$sql = array();
				$sql[] = "
					INSERT INTO tb_release_tag SET
						release_id = '{$release_id}'
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
	public function deleteItem(){
		$this->dbConn->db_start_transaction();
		$result = $this->deleteTags();
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$sql = array();
		$sql[] = "
			DELETE FROM tb_release
			WHERE release_id = '{$this->values['release_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
		}else{
			$this->dbConn->db_commit();
		}
		return $result;
	}
	
	public function getTagsCadatradas($release_id){
		$sql = array();
		$sql[] = "
			SELECT	tag_id
			FROM	tb_release_tag
			WHERE	1 = 1
			AND		release_id = '{$release_id}'
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
	
	public function removeImage(){
		$aReg = $this->getOne();
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			UPDATE tb_release SET
				{$this->values['img']} = ''
			WHERE	release_id = '{$this->values['release_id']}'
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
	
	protected function deleteDownload(){
		$sql = array();
		$sql[] = "
			DELETE FROM tb_release_download
			WHERE	release_id = '{$this->values['release_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		return $result;
	}
	protected function insertDownload($downloads,$release_id){
		if(count($downloads) > 0){
			foreach($downloads AS $download){
				$sql = array();
				$sql[] = "
					INSERT INTO tb_release_download SET
						release_id = '{$release_id}'
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

	public function getDownloadByRelease($release_id, $sOrder='', $direction=''){
		$sql = array();
		
		if(trim($direction=='')){
			$direction = 'DESC';
		}
		
		if(trim($sOrder=='')){
			$sOrder = 't.download_dt';
		}
		
		$sql[] = "
			SELECT	pd.release_id, t.*, tc.download_categoria_titulo
			FROM	tb_release_download pd
			JOIN	tb_download t
			ON		pd.download_id = t.download_id
			JOIN	tb_download_categoria tc
			ON		t.download_categoria_id = tc.download_categoria_id			
			WHERE	1 = 1
			AND		release_id = {$release_id}
			ORDER BY {$sOrder} {$direction}
		";
		$arr = array();
		$result = $this->dbConn->db_query(implode("\n",$sql));
		if($result['success']){
			if($result['total'] > 0){
				while($rs = $this->dbConn->db_fetch_assoc($result['result'])){
					$rs['download_dt'] = $this->dateDB2BR($rs['download_dt']);
					$rs['download_tamanho_label'] = $this->getSizeName($rs['download_tamanho']);					
					array_push($arr,$this->utf8_array_encode($rs));					
				}
			}
		}
		return $arr;
	}
	
	public function getDownloadCadastrados($release_id){
		$sql = array();
		$sql[] = "
			SELECT	download_id
			FROM	tb_release_download
			WHERE	1 = 1
			AND		release_id = '{$release_id}'
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
	
	public function getTagsByRelease($release_id){
		$sql = array();
		$sql[] = "
			SELECT	tp.tag_id, t.tag_titulo
			FROM	tb_release_tag tp
			JOIN	tb_tag t
			ON		tp.tag_id = t.tag_id
			WHERE	1 = 1
			AND		release_id = '{$release_id}'
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
	
	
}

