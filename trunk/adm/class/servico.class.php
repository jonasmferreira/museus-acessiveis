<?php
$path_root_servicoClass = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_servicoClass = "{$path_root_servicoClass}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_servicoClass}adm{$DS}class{$DS}default.class.php";
class servico extends defaultClass{
	protected $dbConn;
	protected $pathImg;
	protected $filterFieldName = array(
		't.servico_titulo'=>array(
			'fieldNameId'=>'t.servico_titulo'
			,'fieldNameLabel'=>'Nome do Serviço'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
		,'tc.tipo_servico_titulo'=>array(
			'fieldNameId'=>'tc.tipo_servico_titulo'
			,'fieldNameLabel'=>'Tipo do Serviço'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
		
	);
	public function __construct() {
		$path_root_servicoClass = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_servicoClass = "{$path_root_servicoClass}{$DS}..{$DS}..{$DS}";
		$this->pathImg = "{$path_root_servicoClass}images{$DS}";
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
					,tc.tipo_servico_titulo
			FROM	tb_servico t
			JOIN	tb_tipo_servico tc
			ON		tc.tipo_servico_id = t.tipo_servico_id
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
			$sql[] = "AND t.servico_agenda >= '{$this->values['data_ini']}'";
		}
		if(isset($this->values['data_fim'])&&trim($this->values['data_fim'])!=''){
			$this->values['data_fim'] = $this->dateBR2DB($this->values['data_fim']);
			$sql[] = "AND t.servico_agenda <= '{$this->values['data_fim']}'";
		}
		
		if(isset($this->values['tipo_servico_id'])&&trim($this->values['tipo_servico_id'])!=''){
			$sql[] = "AND t.tipo_servico_id = '{$this->values['tipo_servico_id']}'";
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
			$sql[] = "ORDER BY t.servico_agenda ASC";
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
					$rs['servico_sob_demanda_label'] = $rs['servico_sob_demanda']=='S'?'Sim':'Não';
					$rs['servico_dt_hr'] = $this->dateDB2BR($rs['servico_dt_cad'])." às ".$rs['servico_hr_cad'];
					$rs['servico_dt_ini'] = $this->dateDB2BR($rs['servico_dt_ini']);
					$rs['servico_dt_fim'] = $this->dateDB2BR($rs['servico_dt_fim']);
					$rs['servico_agenda'] = $this->dateDB2BR($rs['servico_agenda']);
					$rs['tags'] = $this->getTagsCadatradas($rs['servico_id']);
					$rs['glossarios'] = $this->getGlossarioCadatradas($rs['servico_id']);
					$rs['downloads'] = $this->getDownloadCadastrados($rs['servico_id']);
					$rs['extras'] = $this->getExtraCadastrados($rs['servico_id']);
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
		$sql[] = "AND		t.servico_id = '{$this->values['servico_id']}'";
		$result = $this->dbConn->db_query(implode("\n",$sql));
		$rs = array();
		if($result['success']){
			if($result['total'] > 0){
				$rs = $this->dbConn->db_fetch_assoc($result['result']);
				$rs['servico_sob_demanda_label'] = $rs['servico_sob_demanda']=='S'?'Sim':'Não';
				$rs['servico_dt_hr'] = $this->dateDB2BR($rs['servico_dt'])." às ".$rs['servico_hr'];
				$rs['servico_dt_ini'] = $this->dateDB2BR($rs['servico_dt_ini']);
				$rs['servico_dt_fim'] = $this->dateDB2BR($rs['servico_dt_fim']);
				$rs['servico_agenda'] = $this->dateDB2BR($rs['servico_agenda']);
				$rs['tags'] = $this->getTagsCadatradas($rs['servico_id']);
				$rs['tag_list'] = $this->getTagsByServico($rs['servico_id']);
				$rs['glossarios'] = $this->getGlossarioCadatradas($rs['servico_id']);
				$rs['glossario_list'] = $this->getGlossarioByServico($rs['servico_id']);
				$rs['downloads'] = $this->getDownloadCadastrados($rs['servico_id']);
				$rs['download_list'] = $this->getDownloadByServico($rs['servico_id']);
				$rs['extras'] = $this->getExtraCadastrados($rs['servico_id']);
				$rs['extra_list'] = $this->getExtraByServico($rs['servico_id']);
			}
		}
		return $this->utf8_array_encode($rs);
	}

	public function edit(){
		if(isset($this->values['servico_id'])&&trim($this->values['servico_id'])!=''){
			$result = $this->update();
		}else{
			$result = $this->insert();
		}
		return $result;
	}

	private function update(){
		$this->values['servico_sob_demanda'] = trim($this->values['servico_sob_demanda'])!=''?$this->values['servico_sob_demanda']:'N';
		$this->values['servico_conteudo'] = $this->escape_string($this->values['servico_conteudo']);
		$this->values['servico_resumo'] = $this->escape_string($this->values['servico_resumo']);
		$this->values['servico_thumb_desc'] = $this->escape_string($this->values['servico_resumo']);
		$this->values['servico_thumb'] = $this->uploadFile($this->pathImg, $this->files['servico_thumb']);
		$this->values['servico_dt_ini'] = $this->dateBR2DB($this->values['servico_dt_ini']);
		$this->values['servico_dt_fim'] = $this->dateBR2DB($this->values['servico_dt_fim']);
		$this->values['servico_agenda'] = $this->dateBR2DB($this->values['servico_agenda']);
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			UPDATE	tb_servico SET
					servico_dt_ini = '{$this->values['servico_dt_ini']}'
					,servico_dt_fim = '{$this->values['servico_dt_fim']}'
					,servico_sob_demanda = '{$this->values['servico_sob_demanda']}'
					,servico_titulo = '{$this->values['servico_titulo']}'
					,servico_resumo = '{$this->values['servico_resumo']}'
					,servico_thumb_desc = '{$this->values['servico_thumb_desc']}'
					,servico_fonte = '{$this->values['servico_fonte']}'
					,servico_link_fonte = '{$this->values['servico_link_fonte']}'
					,servico_conteudo = '{$this->values['servico_conteudo']}'
					,servico_agenda = '{$this->values['servico_agenda']}'
					,tipo_servico_id = '{$this->values['tipo_servico_id']}'
		";
		if(trim($this->values['servico_thumb'])){
			$sql[] = ",servico_thumb = '{$this->values['servico_thumb']}'";
		}
		
		$sql[] = "WHERE	servico_id = '{$this->values['servico_id']}'";
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
		$servico_id = $this->values['servico_id'];
		$result = $this->insertExtras($this->values['extras'], $servico_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->insertDownload($this->values['downloads'], $servico_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->insertGlossario($this->values['glossarios'], $servico_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->insertTags($this->values['tags'], $servico_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$this->dbConn->db_commit();
		return $result;
	}

	private function insert(){
		$this->values['servico_sob_demanda'] = trim($this->values['servico_sob_demanda'])!=''?$this->values['servico_sob_demanda']:'N';
		$this->values['servico_conteudo'] = $this->escape_string($this->values['servico_conteudo']);
		$this->values['servico_resumo'] = $this->escape_string($this->values['servico_resumo']);
		$this->values['servico_thumb_desc'] = $this->escape_string($this->values['servico_resumo']);
		$this->values['servico_thumb'] = $this->uploadFile($this->pathImg, $this->files['servico_thumb']);
		$this->values['servico_dt_ini'] = $this->dateBR2DB($this->values['servico_dt_ini']);
		$this->values['servico_dt_fim'] = $this->dateBR2DB($this->values['servico_dt_fim']);
		$this->values['servico_agenda'] = $this->dateBR2DB($this->values['servico_agenda']);
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			INSERT INTO	tb_servico SET
				servico_dt_cad = CURDATE()
				,servico_hr_cad = CURTIME()
				,servico_dt_ini = '{$this->values['servico_dt_ini']}'
				,servico_dt_fim = '{$this->values['servico_dt_fim']}'
				,servico_sob_demanda = '{$this->values['servico_sob_demanda']}'
				,servico_titulo = '{$this->values['servico_titulo']}'
				,servico_resumo = '{$this->values['servico_resumo']}'
				,servico_thumb = '{$this->values['servico_thumb']}'
				,servico_thumb_desc = '{$this->values['servico_thumb_desc']}'
				,servico_fonte = '{$this->values['servico_fonte']}'
				,servico_link_fonte = '{$this->values['servico_link_fonte']}'
				,servico_conteudo = '{$this->values['servico_conteudo']}'
				,servico_agenda = '{$this->values['servico_agenda']}'
				,tipo_servico_id = '{$this->values['tipo_servico_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$servico_id = $result['last_id'];
		$result = $this->insertExtras($this->values['extras'], $servico_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->insertDownload($this->values['downloads'], $servico_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->insertGlossario($this->values['glossarios'], $servico_id);
		if($result['success']===false){
			$this->dbConn->db_rollback();
			return $result;
		}
		$result = $this->insertTags($this->values['tags'], $servico_id);
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
			DELETE FROM tb_servico_tag
			WHERE	servico_id = '{$this->values['servico_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		return $result;
	}
	protected function insertTags($tags,$servico_id){
		if(count($tags) > 0){
			foreach($tags AS $tag){
				$sql = array();
				$sql[] = "
					INSERT INTO tb_servico_tag SET
						servico_id = '{$servico_id}'
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
			DELETE FROM tb_servico_glossario
			WHERE	servico_id = '{$this->values['servico_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		return $result;
	}
	protected function insertGlossario($glossarios,$servico_id){
		if(count($glossarios) > 0){
			foreach($glossarios AS $glossario){
				$sql = array();
				$sql[] = "
					INSERT INTO tb_servico_glossario SET
						servico_id = '{$servico_id}'
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
			DELETE FROM tb_servico_download
			WHERE	servico_id = '{$this->values['servico_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		return $result;
	}
	protected function insertDownload($downloads,$servico_id){
		if(count($downloads) > 0){
			foreach($downloads AS $download){
				$sql = array();
				$sql[] = "
					INSERT INTO tb_servico_download SET
						servico_id = '{$servico_id}'
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
			DELETE FROM tb_servico_extra
			WHERE	servico_id = '{$this->values['servico_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		return $result;
	}
	protected function insertExtras($extras,$servico_id){
		if(count($extras) > 0){
			foreach($extras AS $k=> $extra){
				$sql = array();
				$sql[] = "
					INSERT INTO tb_servico_extra SET
						servico_id = '{$servico_id}'
						,extra_id = '{$k}'
						,servico_extra_valor = '{$extra}'
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
			DELETE FROM tb_servico
			WHERE servico_id = '{$this->values['servico_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
		}else{
			$this->dbConn->db_commit();
		}
		return $result;
	}
	
	public function getTagsCadatradas($servico_id){
		$sql = array();
		$sql[] = "
			SELECT	tag_id
			FROM	tb_servico_tag
			WHERE	1 = 1
			AND		servico_id = '{$servico_id}'
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
	
	public function getTagsByServico($servico_id){
		$sql = array();
		$sql[] = "
			SELECT	tp.tag_id, t.tag_titulo
			FROM	tb_servico_tag tp
			JOIN	tb_tag t
			ON		tp.tag_id = t.tag_id
			WHERE	1 = 1
			AND		servico_id = '{$servico_id}'
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
	
	
	public function getDownloadCadastrados($servico_id){
		$sql = array();
		$sql[] = "
			SELECT	download_id
			FROM	tb_servico_download
			WHERE	1 = 1
			AND		servico_id = '{$servico_id}'
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

	public function getDownloadByServico($servico_id){
		$sql = array();
		$sql[] = "
			SELECT	pd.servico_id, d.*
			FROM	tb_servico_download pd
			JOIN	tb_download d
			ON		pd.download_id = d.download_id
			WHERE	1 = 1
			AND		servico_id = '{$servico_id}'
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
	
	public function getGlossarioCadatradas($servico_id){
		$sql = array();
		$sql[] = "
			SELECT	glossario_id
			FROM	tb_servico_glossario
			WHERE	1 = 1
			AND		servico_id = '{$servico_id}'
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
	
	public function getGlossarioByServico($servico_id){
		$sql = array();
		$sql[] = "
			SELECT	pg.servico_id
					,pg.glossario_id
					,g.glossario_palavra
					,g.glossario_definicao
					,g.glossario_fonte
					,g.glossario_link_fonte
					,g.glossario_conteudo
					,g.glossario_exibir
			FROM	tb_servico_glossario pg
			JOIN	tb_glossario g
			ON		pg.glossario_id = g.glossario_id
			WHERE	1 = 1
			AND		g.glossario_exibir = 'S'
			AND		servico_id = '{$servico_id}'
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

	
	public function getExtraCadastrados($servico_id){
		$sql = array();
		$sql[] = "
			SELECT	extra_id
					,servico_extra_valor
			FROM	tb_servico_extra
			WHERE	1 = 1
			AND		servico_id = '{$servico_id}'
		";
		$arr = array();
		$result = $this->dbConn->db_query(implode("\n",$sql));
		if($result['success']){
			if($result['total'] > 0){
				while($rs = $this->dbConn->db_fetch_assoc($result['result'])){
					$arr[$rs['extra_id']] = $rs['servico_extra_valor'];
				}
			}
		}
		return $arr;
	}
	
	public function getExtraByServico($servico_id){
		$sql = array();
		$sql[] = "
			SELECT	e.extra_id
					,e.extra_nome_campo
					,pe.servico_extra_valor
			FROM	tb_servico_extra pe
		    JOIN	tb_extra e
			ON		pe.extra_id = e.extra_id
			WHERE	1 = 1
			AND		pe.servico_extra_valor IS NOT NULL
			AND		TRIM(pe.servico_extra_valor) != ''
			AND		servico_id = '{$servico_id}'
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
			UPDATE tb_servico SET
				{$this->values['img']} = ''
			WHERE	servico_id = '{$this->values['servico_id']}'
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
	
	public function getTipoServico(){
		$sql = array();
		$sql[] = "
			SELECT	t.*
			FROM	tb_tipo_servico t
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
}