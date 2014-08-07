<?php
$path_root_emailmktClass = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_emailmktClass = "{$path_root_emailmktClass}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_emailmktClass}adm{$DS}class{$DS}default.class.php";
class emailmkt extends defaultClass{
	protected $dbConn;
	protected $pathImg;
	protected $filterFieldName = array(
		'a.emailmkt_titulo'=>array(
			'fieldNameId'=>'a.emailmkt_titulo'
			,'fieldNameLabel'=>'Titulo'
			,'fieldNameType'=>'text'
			,'fieldNameOp'=>'LIKE'
		)
	);
	protected $status = array(
		'P'=>array(
			'id'=>'P'
			,'titulo'=>'Pendente'
		)
		,'X'=>array(
			'id'=>'X'
			,'titulo'=>'Enviando'
		)
		,'E'=>array(
			'id'=>'E'
			,'titulo'=>'Enviado'
		)
		,'C'=>array(
			'id'=>'C'
			,'titulo'=>'Cancelado'
		)
	);
	public function __construct() {
		$path_root_emailmktClass = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_emailmktClass = "{$path_root_emailmktClass}{$DS}..{$DS}..{$DS}";
		
		$this->pathImg = "{$path_root_emailmktClass}imgEmkt{$DS}";
		if(!is_dir($this->pathImg)){
			@mkdir($this->pathImg,0777,true);
		}
		@chmod($this->pathImg,0777);
		$this->dbConn = new DataBaseClass();
	}
	public function getFilterFieldName() {
		return $this->filterFieldName;
	}	
	
	public function getStatus() {
		return $this->status;
	}
		
	protected function getSql(){
		$sql = array();
		$sql[] = "
			SELECT	a.*
			FROM	tb_emailmkt a
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
		if(isset($this->values['emailmkt_status'])&&trim($this->values['emailmkt_status'])!=''){
			$sql[] = "AND a.emailmkt_status IN ('{$this->values['emailmkt_status']}')";
		}
		if(isset($this->values['data_ini'])&&trim($this->values['data_ini'])!=''){
			$this->values['data_ini'] = $this->dateBR2DB($this->values['data_ini']);
			$sql[] = "AND a.emailmkt_dt_agendada >= '{$this->values['data_ini']}'";
		}
		if(isset($this->values['data_fim'])&&trim($this->values['data_fim'])!=''){
			$this->values['data_fim'] = $this->dateBR2DB($this->values['data_fim']);
			$sql[] = "AND a.emailmkt_dt_agendada <= '{$this->values['data_fim']}'";
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
		$sql[] = "ORDER BY a.emailmkt_titulo ASC";
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
					//$rs['emailmkt_status_label'] = $rs['emailmkt_status']=='A'?'Ativo':'Inativo';
					$rs['emailmkt_status_label'] = $this->status[$rs['emailmkt_status']]['titulo'];
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
		$sql[] = "AND		a.emailmkt_id = '{$this->values['emailmkt_id']}'";
		$result = $this->dbConn->db_query(implode("\n",$sql));
		$rs = array();
		if($result['success']){
			if($result['total'] > 0){
				$rs = $this->dbConn->db_fetch_assoc($result['result']);
				$rs['emailmkt_status_label'] = $this->status[$rs['emailmkt_status']]['titulo'];
			}
		}
		return $this->utf8_array_encode($rs);
	}
	
	public function getServico(){
		$path_root_servicoLista = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_servicoLista = "{$path_root_servicoLista}{$DS}..{$DS}..{$DS}";
		include_once("{$path_root_servicoLista}adm{$DS}class{$DS}servico.class.php");
		$obj = new servico();
		$obj->setValues(array(
			'page'=>'1'
			,'rows'=>'10000000000000'
		));
		$aRet = $obj->getLista();
		return $aRet['rows'];
	}
	
	public function getProjeto(){
		$path_root_servicoLista = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_servicoLista = "{$path_root_servicoLista}{$DS}..{$DS}..{$DS}";
		include_once("{$path_root_servicoLista}adm{$DS}class{$DS}projeto.class.php");
		$obj = new projeto();
		$obj->setValues(array(
			'page'=>'1'
			,'rows'=>'10000000000000'
		));
		$aRet = $obj->getLista();
		return $aRet['rows'];
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
		));
		$aRet = $obj->getLista();
		return $aRet['rows'];
	}
	
	public function getGlossario(){
		$path_root_servicoLista = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_servicoLista = "{$path_root_servicoLista}{$DS}..{$DS}..{$DS}";
		include_once("{$path_root_servicoLista}adm{$DS}class{$DS}glossario.class.php");
		$obj = new glossario();
		$obj->setValues(array(
			'page'=>'1'
			,'rows'=>'10000000000000'
		));
		$aRet = $obj->getLista();
		return $aRet['rows'];
	}

	public function getProjetosByIds($projeto_list_id){
		$sql = array();
		$sql[] = "
			SELECT	*
			FROM	tb_projeto t
			WHERE	1 = 1
			AND		projeto_id IN ({$projeto_list_id})
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
	
	
	
	
	public function edit(){
		if(isset($this->values['emailmkt_id'])&&trim($this->values['emailmkt_id'])!=''){
			$result = $this->update();
		}else{
			$result = $this->insert();
		}
		return $result;
	}

	private function update(){
		$this->values['emailmkt_servico_ids'] = @implode(",",$this->values['emailmkt_servico_ids']);
		$this->values['emailmkt_projeto_ids'] = @implode(",",$this->values['emailmkt_projeto_ids']);
		$this->values['emailmkt_glossario_ids'] = @implode(",",$this->values['emailmkt_glossario_ids']);
		$this->values['emailmkt_novidade360_ids'] = @implode(",",$this->values['emailmkt_novidade360_ids']);
		$this->values['emailmkt_aqui_tem_thumb'] = $this->uploadFile($this->pathImg, $this->files['emailmkt_aqui_tem_thumb']);
		$this->values['emailmkt_propaganda_img'] = $this->uploadFile($this->pathImg, $this->files['emailmkt_propaganda_img']);
		$this->values['emailmkt_dt_agendada'] = $this->dateBR2DB($this->values['emailmkt_dt_agendada']);
		$this->values['emailmkt_agenda_ids'] = @implode(",",$this->values['emailmkt_agenda_ids']);
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			UPDATE	tb_emailmkt SET
					emailmkt_titulo = '{$this->values['emailmkt_titulo']}'
					,emailmkt_dt_agendada = '{$this->values['emailmkt_dt_agendada']}'
					,emailmkt_hr_agendada = '{$this->values['emailmkt_hr_agendada']}'
					,emailmkt_status = '{$this->values['emailmkt_status']}'
					,emailmkt_servico_ids = '{$this->values['emailmkt_servico_ids']}'
					,emailmkt_projeto_ids = '{$this->values['emailmkt_projeto_ids']}'
					,emailmkt_glossario_ids = '{$this->values['emailmkt_glossario_ids']}'
					,emailmkt_novidade360_id = '{$this->values['emailmkt_novidade360_id']}'
					,emailmkt_novidade360_ids = '{$this->values['emailmkt_novidade360_ids']}'
					,emailmkt_agenda_ids = '{$this->values['emailmkt_agenda_ids']}'
					,emailmkt_arq_fisico = '{$this->values['emailmkt_arq_fisico']}'
					,emailmkt_aqui_tem_titulo = '{$this->values['emailmkt_aqui_tem_titulo']}'
					,emailmkt_aqui_tem_resumo = '{$this->values['emailmkt_aqui_tem_resumo']}'
					,emailmkt_aqui_tem_url = '{$this->values['emailmkt_aqui_tem_url']}'
		";
		if(trim($this->values['emailmkt_aqui_tem_thumb'])!=''){
			$sql[] = ",emailmkt_aqui_tem_thumb = '{$this->values['emailmkt_aqui_tem_thumb']}'";
		}
		if(trim($this->values['emailmkt_propaganda_img'])!=''){
			$sql[] = ",emailmkt_propaganda_img = '{$this->values['emailmkt_propaganda_img']}'	";
		}
		$sql[] = "WHERE	emailmkt_id = '{$this->values['emailmkt_id']}'";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
		}else{
			$this->dbConn->db_commit();
		}
		return $result;
	}

	private function insert(){
		$this->values['emailmkt_servico_ids'] = @implode(",",$this->values['emailmkt_servico_ids']);
		$this->values['emailmkt_projeto_ids'] = @implode(",",$this->values['emailmkt_projeto_ids']);
		$this->values['emailmkt_glossario_ids'] = @implode(",",$this->values['emailmkt_glossario_ids']);
		$this->values['emailmkt_novidade360_ids'] = @implode(",",$this->values['emailmkt_novidade360_ids']);
		$this->values['emailmkt_agenda_ids'] = @implode(",",$this->values['emailmkt_agenda_ids']);
		$this->values['emailmkt_aqui_tem_thumb'] = $this->uploadFile($this->pathImg, $this->files['emailmkt_aqui_tem_thumb']);
		$this->values['emailmkt_propaganda_img'] = $this->uploadFile($this->pathImg, $this->files['emailmkt_propaganda_img']);
		$this->values['emailmkt_dt_agendada'] = $this->dateBR2DB($this->values['emailmkt_dt_agendada']);
		$this->dbConn->db_start_transaction();
		$sql = array();
		$sql[] = "
			INSERT INTO	tb_emailmkt SET
				emailmkt_titulo = '{$this->values['emailmkt_titulo']}'
				,emailmkt_dt_agendada = '{$this->values['emailmkt_dt_agendada']}'
				,emailmkt_hr_agendada = '{$this->values['emailmkt_hr_agendada']}'
				,emailmkt_status = '{$this->values['emailmkt_status']}'
				,emailmkt_servico_ids = '{$this->values['emailmkt_servico_ids']}'
				,emailmkt_projeto_ids = '{$this->values['emailmkt_projeto_ids']}'
				,emailmkt_glossario_ids = '{$this->values['emailmkt_glossario_ids']}'
				,emailmkt_novidade360_id = '{$this->values['emailmkt_novidade360_id']}'
				,emailmkt_novidade360_ids = '{$this->values['emailmkt_novidade360_ids']}'
				,emailmkt_agenda_ids = '{$this->values['emailmkt_agenda_ids']}'
				,emailmkt_arq_fisico = '{$this->values['emailmkt_arq_fisico']}'
				,emailmkt_aqui_tem_titulo = '{$this->values['emailmkt_aqui_tem_titulo']}'
				,emailmkt_aqui_tem_resumo = '{$this->values['emailmkt_aqui_tem_resumo']}'
				,emailmkt_aqui_tem_url = '{$this->values['emailmkt_aqui_tem_url']}'
		";
		if(trim($this->values['emailmkt_aqui_tem_thumb'])!=''){
			$sql[] = ",emailmkt_aqui_tem_thumb = '{$this->values['emailmkt_aqui_tem_thumb']}'";
		}
		if(trim($this->values['emailmkt_propaganda_img'])!=''){
			$sql[] = ",emailmkt_propaganda_img = '{$this->values['emailmkt_propaganda_img']}'	";
		}
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
		}else{
			$this->dbConn->db_commit();
		}
		return $result;
	}
	protected function deleteParentItem(){
		$sql = array();
		$sql[] = "
			DELETE FROM tb_emailmkt_conferencia
			WHERE emailmkt_id = '{$this->values['emailmkt_id']}'
		";
		
		return $this->dbConn->db_execute(implode("\n",$sql));
	}
	public function deleteItem(){
		$this->dbConn->db_start_transaction();
		$result = $this->deleteParentItem();
		if(!$result['success']){
			$this->dbConn->db_rollback();
			return $result;
		}
		$sql = array();
		$sql[] = "
			DELETE FROM tb_emailmkt
			WHERE emailmkt_id = '{$this->values['emailmkt_id']}'
		";
		$result = $this->dbConn->db_execute(implode("\n",$sql));
		if($result['success']===false){
			$this->dbConn->db_rollback();
		}else{
			$this->dbConn->db_commit();
		}
		return $result;
	}
	public function getAgenda(){
		$path_root_agendaClass = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_agendaClass = "{$path_root_agendaClass}{$DS}..{$DS}..{$DS}";
		include_once("{$path_root_agendaClass}adm{$DS}class{$DS}configuracao.class.php");
		$objConfig = new configuracao();
		$aConfig = $objConfig->getOne();

		//$objConfig->debug($aConfig);
		$linkAbsolute=$aConfig['configuracao_baseurl'];
		$sql = array();
		$dataPadrao = date("Y-m-01");
		//novidade 360
		$sql[] = "
			SELECT	
					t.novidade_360_id as item_id
					,'novidade360' as item_tipo_link
					,t.novidade_360_titulo as item_titulo
					,t.novidade_360_dt_agenda as item_dt_agenda
					,DAY(t.novidade_360_dt_agenda) as item_dt_agenda_dia
					,'N' AS item_tipo
					,'Novidade 360º' AS item_tipo_label
			FROM	tb_novidade_360 t
			WHERE	1 = 1 
			#AND		t.novidade_360_dt_agenda >= '{$dataPadrao}'
			AND		t.novidade_360_dt_agenda IS NOT NULL
			AND		t.novidade_360_dt_agenda !='0000-00-00'
		";
		//Projetos
		$sql[] = "
			SELECT	
					t.projeto_id as item_id
					,'projeto' as item_tipo_link
					,t.projeto_titulo as item_titulo
					,t.projeto_agenda as item_dt_agenda
					,DAY(t.projeto_agenda) as item_dt_agenda_dia
					,'P' AS item_tipo
					,'Projeto' AS item_tipo_label
			FROM	tb_projeto t
			WHERE	1 = 1 
			#AND		t.projeto_agenda >= '{$dataPadrao}'
			AND		t.projeto_agenda IS NOT NULL
			AND		t.projeto_agenda !='0000-00-00'
		";

		//cursos
		$sql[] = "
			SELECT	
					t.curso_id as item_id
					,'curso' as item_tipo_link
					,t.curso_titulo as item_titulo
					,t.curso_agenda as item_dt_agenda
					,DAY(t.curso_agenda) as item_dt_agenda_dia
					,'C' AS item_tipo
					,'Curso' AS item_tipo_label
			FROM	tb_curso t
			WHERE	1 = 1 
			#AND		t.curso_agenda >= '{$dataPadrao}'
			AND		t.curso_agenda IS NOT NULL
			AND		t.curso_agenda !='0000-00-00'
		";

		//servicos
		$sql[] = "
			SELECT	
					t.servico_id as item_id
					,'servico' as item_tipo_link
					,t.servico_titulo as item_titulo
					,t.servico_agenda as item_dt_agenda
					,DAY(t.servico_agenda) as item_dt_agenda_dia
					,'S' AS item_tipo
					,'Serviço' AS item_tipo_label
			FROM	tb_servico t
			WHERE	1 = 1 
			#AND		t.servico_agenda >= '{$dataPadrao}'
			AND		t.servico_agenda IS NOT NULL
			AND		t.servico_agenda !='0000-00-00'
		";
			
		$aSql = Array();
		$aSql[] = "SELECT * FROM (";
		$aSql[] = implode(" UNION \n",$sql);
		$aSql[] = ") AS item_busca ";
		$aSql[] = "
			WHERE 1 = 1 
			ORDER BY item_dt_agenda ASC, item_titulo ASC
		";
		$arr = array();
		$result = $this->dbConn->db_query(implode("\n",$aSql));
		if($result['success']){
			if($result['total'] > 0){
				while($rs = $this->dbConn->db_fetch_assoc($result['result'])){
					$sLink = "{$linkAbsolute}{$rs['item_tipo_link']}/{$rs['item_id']}/{$rs['item_titulo']}";
					$rs['item_link'] = $sLink;
					$rs['item_dt_agenda_label'] = $this->dateDB2BR($rs['item_dt_agenda']);
					$rs = $this->utf8_array_encode($rs);
					array_push($arr,$rs);
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
			UPDATE tb_emailmkt SET
				{$this->values['img']} = ''
			WHERE	emailmkt_id = '{$this->values['emailmkt_id']}'
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