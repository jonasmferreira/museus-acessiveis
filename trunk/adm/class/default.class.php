<?php

if (session_id() == '') {
	session_name("CMSMUSEUSACESSIVEIS_2014");
	session_start();
}
error_reporting(E_ALL & ~E_NOTICE);
$path_root_dbClass = dirname(__FILE__);
$DS = DIRECTORY_SEPARATOR;
$path_root_dbClass = "{$path_root_dbClass}{$DS}..{$DS}..{$DS}";
require_once "{$path_root_dbClass}lib{$DS}DataBaseClass.php";
class defaultClass {
	protected $dbConn;
	protected $values;
	protected $files;
	protected $sort_field;
	protected $sort_direction;
	protected $limit_start;
	protected $limit_max;
	protected $post;
	protected $uf = array(
		"AC" => "Acre"
		, "AL" => "Alagoas"
		, "AM" => "Amazonas"
		, "AP" => "Amapa"
		, "BA" => "Bahia"
		, "CE" => "Ceará"
		, "DF" => "Distrito Federal"
		, "ES" => "Espirito Santo"
		, "GO" => "Goiás"
		, "MA" => "Maranhão"
		, "MG" => "Minas Gerais"
		, "MS" => "Mato Grosso do Sul"
		, "MT" => "Mato Grosso"
		, "PA" => "Pará"
		, "PB" => "Paraíba"
		, "PE" => "Pernambuco"
		, "PI" => "Piauí"
		, "PR" => "Parana"
		, "RJ" => "Rio de Janeiro"
		, "RN" => "Rio Grande do Norte"
		, "RO" => "Rondônia"
		, "RR" => "Roraima"
		, "RS" => "Rio Grande do Sul"
		, "SC" => "Santa Catarina"
		, "SE" => "Sergipe"
		, "SP" => "São Paulo"
		, "TO" => "Tocantins"
	);
	protected $meses = array(
		"01" => "Janeiro"
		, "02" => "Fevereiro"
		, "03" => "Março"
		, "04" => "Abril"
		, "05" => "Maio"
		, "06" => "Junho"
		, "07" => "Julho"
		, "08" => "Agosto"
		, "09" => "Setembro"
		, "10" => "Outubro"
		, "11" => "Novembro"
		, "12" => "Dezembro"
	);

	private $aOrderBy = array();
	private $oWheres;
	
	public function setAOrderBy($aOrderBy) {
		$this->aOrderBy = $aOrderBy;
	}
	public function setOWheres($oWheres) {
		$this->oWheres = $oWheres;
	}

	public function getAOrderBy() {
		if(count($this->aOrderBy) && isset($this->aOrderBy)):
			$aOrder = array();
			foreach($this->aOrderBy as $k => $v):
				if($k!=''):
					$aOrder[] = "{$k} {$v}";
				endif;
			endforeach;
			$aOrder = implode(",\n",$aOrder);
			$aOrder = "ORDER BY {$aOrder}";
			return $aOrder;
		endif;
		
		return false;
	}
	
	public function getOWheres() {
		if(count($this->oWheres) && isset($this->oWheres)):
			$aWheres = array();
			foreach($this->oWheres as $k => $v):
				if(trim($v)!=''):
					$key = (stripos($k,' ')!==false)?trim(reset(explode(' ',$k))):trim($k);
				
					$tipo = (stripos($k,' ')!==false)?trim(end(explode($key,$k))):'=';
					
					$v = (stripos($k,'LIKE')!==false)?"%{$v}%":$v;
					
					$v = $this->antiInjection($v);
					$aWheres[] = " AND {$key} {$tipo} '{$v}'";
				endif;
			endforeach;
			$aWheres = implode("\n",$aWheres);
			return $aWheres;
		endif;
		
		return false;
	}

	public function registerSession($arr) {
		if (is_array($arr) && count($arr) > 0) {
			foreach ($arr AS $k => $v) {
				$_SESSION['CMSMUSEUSACESSIVEIS'][$k] = $v;
			}
		}
	}

	public function unRegisterSession($arr) {
		if (is_array($arr) && count($arr) > 0) {
			foreach ($arr AS $k => $v) {
				unset($_SESSION['CMSMUSEUSACESSIVEIS'][$k]);
			}
		}
	}

	public function getSessions() {
		return $_SESSION['CMSMUSEUSACESSIVEIS'];
	}

	public function verifyLogon() {
		$session = $this->getSessions();
		if (isset($session['usuario_login']) && trim($session['usuario_login']) != '') {
			header('Location: home.php');
		}
	}

	public function verifyLogin() {
		$session = $this->getSessions();
		if (!isset($session['usuario_login']) && trim($session['usuario_login']) == '') {
			header('Location: index.php');
		}
	}

	public function __construct() {
		$this->dbConn = new DataBaseClass();
	}

	public function setValues($values) {
		$this->values = $values;
	}

	public function setPost($post) {
		$this->post = $post;
	}

	public function getUf() {
		return $this->uf;
	}

	public function getMeses() {
		return $this->meses;
	}

	public function setFiles($files) {
		$this->files = $files;
	}

	public function utf8Encode2Decode($string) {
		if (strtoupper(mb_detect_encoding($string . "x", 'UTF-8, ISO-8859-1')) == 'UTF-8') {
			return str_replace(array("\'",'\"'),array("'",'"'),$string);
		} else {
			return utf8_encode(str_replace(array("\'",'\"'),array("'",'"'),$string));
		}
	}

	public function utf8_array_encode($input) {
		$return = array();
		foreach ($input as $key => $val) {
			if (is_array($val)) {
				$return[$key] = $this->utf8_array_encode($val);
			} else {
				$return[$key] = $this->utf8Encode2Decode($val);
			}
		}
		return $return;
	}

	public function antiInjection($input) {
		if (is_array($input)) {
			foreach ($input as $key => $val) {
				$sql = preg_replace("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/", "", $val);
				$sql = trim($sql);
				$sql = (get_magic_quotes_gpc()) ? $sql : addslashes($sql);
				$input[$key] = $sql;
			}
			return $input;
		}
		$sql = preg_replace("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/", "", $input);
		$sql = trim($sql);
		$sql = (get_magic_quotes_gpc()) ? $sql : addslashes($sql);
		return $sql;
	}

	public function alert($msg, $url='') {
		$aScript = array();
		$aScript[] = '<script type="text/javascript">';
		$aScript[] = "newAlert('{$msg}');";
		$aScript[] = (!is_null($url) && trim($url) != '') ? "window.location.href = '{$url}';" : '';
		$aScript[] = '</script>';
		echo implode("\r\n", $aScript);
	}

	public function consoleLog($mixed='') {
		$msg = print_r($mixed, true);
		$aScript = array();
		$aScript[] = '<script type="text/javascript">';
		$aScript[] = "console.log('{$msg}');";
		$aScript[] = '</script>';
		echo implode("\r\n", $aScript);
	}

	public function debug($mixed) {
		echo "<pre>" . print_r($mixed, true) . "</pre>";
	}

	public function dateDB2BR($date, $separete="/") {
		return preg_replace(
						"/([0-9]{4})-([0-9]{2})-([0-9]{2})/i", "$3{$separete}$2{$separete}$1", $date
		);
	}

	public function dateBR2DB($date, $separete="-") {
		return preg_replace(
						"/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/i", "$3{$separete}$2{$separete}$1", $date
		);
	}

	public function dateDB2BRTime($date, $separete="/") {
		return preg_replace(
						"/([0-9]{4})-([0-9]{2})-([0-9]{2}) ([0-9]{2}):([0-9]{2}):([0-9]{2})/i", "$3{$separete}$2{$separete}$1 $4:$5:$6", $date
		);
	}

	public function dateBR2DBTime($date, $separete="/") {
		return preg_replace(
						"/([0-9]{2})\/([0-9]{2})\/([0-9]{4}) ([0-9]{2}):([0-9]{2}):([0-9]{2})/i", "$3{$separete}$2{$separete}$1 $4:$5:$6", $date
		);
	}
	
	public function formatFields($string,$type="") {
		$output = trim(preg_replace("[' '-./ t]", '', str_replace(array('(',')'),'',$string)));
		switch(strtolower($type)){
			case 'cnpj':
				return preg_replace(
						"/([0-9]{3})([0-9]{3})([0-9]{3})([0-9]{2})/i", "$1.$2.$3-$4", $output
				);
			break;
			case 'cpf':
				return preg_replace(
						"/([0-9]{2})([0-9]{3})([0-9]{3})([0-9]{4})([0-9]{2})/i", "$1.$2.$3/$4-$5", $output
				);
			break;
			case 'cep':
				return preg_replace(
						"/([0-9]{5})([0-9]{3})/i", "$1-$2", $output
				);
			break;
			case 'rg':
				return preg_replace(
						"/([0-9]{2})([0-9]{3})([0-9]{3})([0-9a-zA-Z]{1})/i", "$1.$2.$3-$4", $output
				);
			break;
			case 'tel':
				if(strlen($output)==10){
					return preg_replace(
							"/([0-9]{2})([0-9]{4})([0-9]{4})/i", "($1)$2-$3", $output
					);
				}else if(strlen($output)==11){
					return preg_replace(
							"/([0-9]{2})([0-9]{5})([0-9]{4})/i", "($1)$2-$3", $output
					);
				}
			break;
			
		}
		return $string;
	}

	public function timeSum($aHora) {
		$hora = 0;
		$minuto = 0;
		$segundo = 0;
		if (is_array($aHora) && count($aHora)) {
			foreach ($aHora as $v) {
				$tem = explode(":", $v);
				$hora+=$tem[0];
				$minuto+=$tem[1];
				$segundo+=(isset($tem[2])) ? $tem[2] : 0;
			}
		}
		$secMin = floor($segundo / 60);
		$segundo = $segundo - ($secMin * 60);

		$minuto += $secMin;
		$horaMin = floor($minuto / 60);
		$hora+= $horaMin;
		$minuto = $minuto - ($horaMin * 60);

		$hora = str_pad($hora, 2, '0', STR_PAD_LEFT);
		$minuto = str_pad($minuto, 2, '0', STR_PAD_LEFT);
		$segundo = str_pad($segundo, 2, '0', STR_PAD_LEFT);

		return "{$hora}:{$minuto}:{$segundo}";
	}

	public function SecToTime($sec, $bStyle=false) {
		$style = 'style="color:#00F !important;"';
		$sinal = '+';
		if ($sec < 0) {
			$sec = $sec * -1;
			$style = 'style="color:#F00 !important;"';
			$sinal = '-';
		}

		$sql = "SELECT SEC_TO_TIME({$sec}) AS hora";
		$qry = $this->dbConn->db_query($sql);
		$rs = $this->dbConn->db_fetch_assoc($qry['result']);
		if ($bStyle) {
			return "<span {$style}>{$sinal} {$rs['hora']}</span>";
		} else {
			return $rs['hora'];
		}
	}

	public function diasemana($data) {
		$data = explode("-", $data);
		$ano = $data[0];
		$mes = $data[1];
		$dia = $data[2];
		$diasemana = date("w", mktime(0, 0, 0, $mes, $dia, $ano));
		switch ($diasemana) {
			case"0": $diasemana = "Domingo";
				break;
			case"1": $diasemana = "Segunda-Feira";
				break;
			case"2": $diasemana = "Terça-Feira";
				break;
			case"3": $diasemana = "Quarta-Feira";
				break;
			case"4": $diasemana = "Quinta-Feira";
				break;
			case"5": $diasemana = "Sexta-Feira";
				break;
			case"6": $diasemana = "Sábado";
				break;
		}

		echo $diasemana;
	}

	public function escape_string($string) {
		return $this->dbConn->db_escape_string($string);
	}

	public function escape_string_array_encode($input) {
		$return = array();
		foreach ($input as $key => $val) {
			if (is_array($val)) {
				$return[$key] = $this->escape_string_array_encode($val);
			} else {
				$return[$key] = $this->escape_string($val);
			}
		}
		return $return;
	}

	public function normaliza($string) {
		$a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕç';
		$b = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRrc';
		$string = $this->utf8Encode2Decode($string);
		$string = strtr($string, $this->utf8Encode2Decode($a), $b);
		$string = str_replace(' ', '_', $string);
		$string = strtolower($string);
		return $this->utf8Encode2Decode($string);
	}

	public function toNormaliza($string) {
		$array1 = array("á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç"
			, "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç",'º','ª','-');
		$array2 = array("a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c"
			, "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C",'','','');
		$string = str_replace(' ', '_', $string);
		$string = str_replace('/', '.', $string);
		return strtolower(str_replace($array1, $array2, $string));
	}

	public function cutHTML($text, $length=100, $ending=' ...', $cutWords=false, $considerHtml=true) {
		if ($considerHtml) {
			// se o texto for mais curto que $length, retornar o texto na totalidade
			if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
				return $text;
			}

			// separa todas as tags html em linhas pesquisáveis
			preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);

			$total_length = strlen($ending);
			$open_tags = array();
			$truncate = '';

			foreach ($lines as $line_matchings) {
				// se existir uma tag html nesta linha, considerá-la e adicioná-la ao output (sem contar com ela)
				if (!empty($line_matchings[1])) {
					// se for um "elemento vazio" com ou sem barra de auto-fecho xhtml (ex. <br />)
					if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
						// não fazer nada
						// se a tag for de fecho (ex. </b>)
					} else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
						// apagar a tag do array $open_tags
						$pos = array_search($tag_matchings[1], $open_tags);
						if ($pos !== false) {
							unset($open_tags[$pos]);
						}
						// se a tag é uma tag inicial (ex. <b>)
					} else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
						// adicionar tag ao início do array $open_tags
						array_unshift($open_tags, strtolower($tag_matchings[1]));
					}
					// adicionar tag html ao texto $truncate
					$truncate .= $line_matchings[1];
				}

				// calcular a largura da parte do texto da linha; considerar entidades como um caracter
				$content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
				if ($total_length + $content_length > $length) {
					// o número dos caracteres que faltam
					$left = $length - $total_length;
					$entities_length = 0;
					// pesquisar por entidades html
					if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
						// calcular a largura real de todas as entidades no alcance "legal"
						foreach ($entities[0] as $entity) {
							if ($entity[1] + 1 - $entities_length <= $left) {
								$left--;
								$entities_length += strlen($entity[0]);
							} else {
								// não existem mais caracteres
								break;
							}
						}
					}
					$truncate .= substr($line_matchings[2], 0, $left + $entities_length);
					// chegamos à largura máxima, por isso saímos do loop
					break;
				} else {
					$truncate .= $line_matchings[2];
					$total_length += $content_length;
				}

				// se chegarmos à largura máxima, saímos do loop
				if ($total_length >= $length) {
					break;
				}
			}
		} else {
			if (strlen($text) <= $length) {
				return $text;
			} else {
				$truncate = substr($text, 0, $length - strlen($ending));
			}
		}

		// se as palavras não puderem ser cortadas a meio...
		if (!$cutWords) {
			// ...procurar a última ocorrência de um espaço...
			$spacepos = strrpos($truncate, ' ');
			if (isset($spacepos)) {
				// ...e cortar o texto nesta posição
				$truncate = substr($truncate, 0, $spacepos);
			}
		}

		// adicionar $ending no final do texto
		$truncate .= $ending;

		if ($considerHtml) {
			// fechar todas as tags html não fechadas
			foreach ($open_tags as $tag) {
				$truncate .= '</' . $tag . '>';
			}
		}
		return $truncate;
	}
	public function getSeqAleatoria($numcarac=8){
		$CaracteresAceitos = 'abcdefghijklmnopqrstuvwxyz';
		$CaracteresAceitos .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$CaracteresAceitos .= '0123456789';
		$max = strlen($CaracteresAceitos)-1;
		$password = null;
		for($i=0; $i < $numcarac; $i++) {
			$password .= $CaracteresAceitos{mt_rand(0, $max)};
		}
		return $password;
	}
	
	public function simple_curl($url,$post=array(),$get=array()){
		$url = explode('?',$url,2);
		if(count($url)===2){
			$temp_get = array();
			parse_str($url[1],$temp_get);
			$get = array_merge($get,$temp_get);
		}

		$ch = curl_init($url[0]."?".http_build_query($get));
		curl_setopt ($ch, CURLOPT_POST, 1);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, http_build_query($post));
		curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		return curl_exec ($ch);
	}
	public function busca_cep($cep){  
		$retorno = array();
		$resultado = @file_get_contents('http://republicavirtual.com.br/web_cep.php?cep='.urlencode($cep).'&formato=query_string');  
		if(!$resultado){  
			$resultado = "&resultado=0&resultado_txt=erro+ao+buscar+cep";  
		}  
		parse_str($resultado, $retorno);

		return $this->utf8_array_encode($retorno);  
	}  
	public function getEnderecoByCep($cep){
		$path_root_dbClass = dirname(__FILE__);
		$DS = DIRECTORY_SEPARATOR;
		$path_root_dbClass = "{$path_root_dbClass}{$DS}..{$DS}..{$DS}";
		include_once("{$path_root_dbClass}lib{$DS}phpQuery-onefile.php");
		$aDados = $this->getSavedEnderecoByCep(str_replace("-","",$cep));
		if(count($aDados)<1){
			$html = $this->simple_curl('http://m.correios.com.br/movel/buscaCepConfirma.do',array(
				'cepEntrada'=>$cep,
				'tipoCep'=>'',
				'cepTemp'=>'',
				'metodo'=>'buscarCep'
			));

			phpQuery::newDocumentHTML($html, $charset = 'utf-8');
			$dados = 
				array(
					'logradouro'=> utf8_decode(trim(pq('.caixacampobranco .resposta:contains("Logradouro: ") + .respostadestaque:eq(0)')->html())),
					'bairro'=> utf8_decode(trim(pq('.caixacampobranco .resposta:contains("Bairro: ") + .respostadestaque:eq(0)')->html())),
					'cidade/uf'=> utf8_decode(trim(pq('.caixacampobranco .resposta:contains("Localidade / UF: ") + .respostadestaque:eq(0)')->html())),
					'cep'=> utf8_decode(trim(pq('.caixacampobranco .resposta:contains("CEP: ") + .respostadestaque:eq(0)')->html()))
				);
			$dados['cidade/uf'] = explode('/',$dados['cidade/uf']);
			$dados['cidade'] = trim($dados['cidade/uf'][0]);
			$dados['uf'] = trim($dados['cidade/uf'][1]);
			if(trim($dados['logradouro'])==""){
				$resultado_busca = $this->busca_cep(str_replace("-","",$cep));
				$dados = 
					array(
						'logradouro'=> "{$resultado_busca['tipo_logradouro']} {$resultado_busca['logradouro']}",
						'bairro'=> $resultado_busca['bairro'],
						'cidade/uf'=> "{$resultado_busca['cidade']}/{$resultado_busca['uf']}",
						'cep'=> $cep
					);
				$dados['cidade/uf'] = explode('/',$dados['cidade/uf']);
				$dados['cidade'] = trim($dados['cidade/uf'][0]);
				$dados['uf'] = trim($dados['cidade/uf'][1]);
			}
			$this->insertCep($dados);
		}else{
			$dados = array(
				'logradouro'=> $aDados['cep_logradouro'],
				'bairro'=> $aDados['cep_bairro'],
				'cidade/uf'=> $aDados['cep_cidade']."/".$aDados['cep_estado'],
				'cep'=>  $aDados['cep_cod'],
			);
			$dados['cidade/uf'] = explode('/',$dados['cidade/uf']);
			$dados['cidade'] = trim($dados['cidade/uf'][0]);
			$dados['uf'] = trim($dados['cidade/uf'][1]);
		}
		return $this->utf8_array_encode($dados);
	}
	public function insertCep($dados){
		$sql = array();
		$dados['cep'] = $this->dbConn->db_escape_string($dados['cep']);
		$dados['logradouro'] = $this->dbConn->db_escape_string($dados['logradouro']);
		$dados['bairro'] = $this->dbConn->db_escape_string($dados['bairro']);
		$dados['cidade'] = $this->dbConn->db_escape_string($dados['cidade']);
		$dados['uf'] = $this->dbConn->db_escape_string($dados['uf']);
		$sql[] = "
			INSERT INTO gc_cep SET
				cep_cod = '{$dados['cep']}'
				,cep_logradouro = '{$dados['logradouro']}'
				,cep_bairro = '{$dados['bairro']}'
				,cep_cidade = '{$dados['cidade']}'
				,cep_estado = '{$dados['uf']}'
		";
		$this->dbConn->db_execute(implode('\n',$sql));
	}
	public function getSavedEnderecoByCep($cep){
		$rs = array();
		$sql = array();
		$sql[] = "
			SELECT	*
			FROM	gc_cep
			WHERE	cep_cod = '{$cep}'
		";
		$result = $this->dbConn->db_query(implode('\n',$sql));
		if($result['total'] > 0){
			$rs=$this->dbConn->db_fetch_assoc($result['result']);
		}
		return $this->utf8_array_encode($rs);
	}
	
	public function limpaDoc($doc){
		return str_replace(array(".","/","-"),"",$doc);
	}
	public function limpaMoeda($moeda){
		$moeda = str_replace(".","",$moeda);
		$moeda = str_replace(",",".",$moeda);
		return $moeda;
	}
	public function limpaTel($tel){
		return str_replace(array("(",")"," ","-"),"",$tel);
	}
	public function limpaCep($cep){
		return str_replace(array("(",")"," ","-"),"",$cep);
	}
	
	public function getTotalData($sqlEx){
		$sql = array();
		$sql[] = "
			SELECT count(*) as qtde
			FROM	(
				{$sqlEx}
			)as A
		";
		$result = $this->dbConn->db_query(implode('\n',$sql));
		if($result['total'] > 0){
			$rs=$this->dbConn->db_fetch_assoc($result['result']);
			return $rs['qtde'];
		}
		return 0;
	}
	public function getCell($cell){
		$aArr = array();
		if(count($cell) > 0){
			foreach($cell AS $v){
				array_push($aArr,$v);
			}
		}
		return $aArr;
	}
	public function uploadFile($path,$aFile){
		$fileName = date('YmdHis')."_".$this->normaliza($aFile['name']);
		if(!is_dir($path)){
			@mkdir($path,0777,true);
		}
		@chmod($path,0777);
		if(move_uploaded_file($aFile["tmp_name"],"{$path}{$fileName}")){
			@chmod("{$path}{$fileName}",0777);
			return $fileName;
		}
		return '';
	}
	
	public function getBaseUrl(){
		$sql = array();
		$sql[] = "
			SELECT	*
			FROM	admin_configuracao
			WHERE	1 = 1
			AND		configuracao_id = '1'
		";
		$result = $this->dbConn->db_query(implode("\n",$sql));
		$rs = array();
		if($result['success']){
			if($result['total'] > 0){
				$rs = $this->dbConn->db_fetch_assoc($result['result']);
			}
		}
		return $this->utf8_array_encode($rs['configuracao_baseurl']);
	}
	
	
	public function controlePaginacao($aRows){
		$aControlePaginacao = array();
		$aControlePaginacaoTmp = array();
		$nCeil4 = ceil($aRows['page']/4);
		$start = ($nCeil4 < 2)?$nCeil4:4*($nCeil4-1)+1;
		for($i=$start;$i<=$aRows['total'];$i++){
			$link = ($aRows['page']!=$i)?"<a href='javascript:void(0);' class='linkPag'>{$i}</a>":"<span>{$i}</span>";
			$aControlePaginacaoTmp[] = $link;
		}
		$totalPaginasTmp = count($aControlePaginacaoTmp);
		if($totalPaginasTmp > 8){
			$aControlePaginacao[] = $aControlePaginacaoTmp[0];
			$aControlePaginacao[] = $aControlePaginacaoTmp[1];
			$aControlePaginacao[] = $aControlePaginacaoTmp[2];
			$aControlePaginacao[] = $aControlePaginacaoTmp[3];
			$aControlePaginacao[] = "...";
			$aControlePaginacao[] = $aControlePaginacaoTmp[$totalPaginasTmp-4];
			$aControlePaginacao[] = $aControlePaginacaoTmp[$totalPaginasTmp-3];
			$aControlePaginacao[] = $aControlePaginacaoTmp[$totalPaginasTmp-2];
			$aControlePaginacao[] = $aControlePaginacaoTmp[$totalPaginasTmp-1];
		}else{
			$aControlePaginacao = $aControlePaginacaoTmp;
		}
		return $aControlePaginacao;
	}
	
	public function getMonthName($nMonth){
		switch ($nMonth){
			case 1:
				return 'JAN';
				break;
			case 2:
				return 'FEV';
				break;
			case 3:
				return 'MAR';
				break;
			case 4:
				return 'ABR';
				break;
			case 5:
				return 'MAI';
				break;
			case 6:
				return 'JUN';
				break;
			case 7:
				return 'JUL';
				break;
			case 8:
				return 'AGO';
				break;
			case 9:
				return 'SET';
				break;
			case 10:
				return 'OUT';
				break;
			case 11:
				return 'NOV';
				break;
			case 12:
				return 'DEZ';
				break;
		}
	}
	
	public function getSizeName($value){
		//13824.00
		$sLabel='';
		$nVal=0;
		if($value<1024){
			$nVal = $value;
			$sLabel='b';
		}elseif($value/1024 <=1024){
			$nVal = $value/1024;
			$sLabel='kb';
		}else{
			$sLabel='mb';	
			$nVal = $value/1024;
		}
		return number_format($nVal,2) . $sLabel;
	}
	
	
}
