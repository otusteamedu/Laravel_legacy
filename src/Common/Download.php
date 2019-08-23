<?php

namespace App\Common;

/**
 * Скачивание файлов, выполнение простых запросов
 *
 * Class Download
 * @package App\Common
 */
class Download {
	private $url;
	private $user;
	private $password;
	private $tempPath;
    private $cacheTime;
	private $arInfo;

	private $_nJump;

    public function __construct($url) {
		$this->url = $this->rectrictUrl($url);
		$this->user = null;
		$this->password = null;
        $this->cacheTime = 0;
		$this->arInfo = array();

		$this->_nJump = 0;
		$this->_strReferer = "";
	}

	public function setAuth(string $user, string $pass) {
        $this->user = $user;
        $this->password = $pass;
    }

    public function setTempPath(string $path) {
        $this->tempPath = $path;
    }

    public function getTempPath() : string {
        $path = null;
        if(!empty($this->tempPath))
            $path = $this->tempPath;
        if(defined('TEMPORARY_PATH'))
            $path = TEMPORARY_PATH;
        if(!$path || !is_writable($path))
            $path = dirname(__FILE__).'/temp/';
        if(substr($path, -1, 1) != DIRECTORY_SEPARATOR)
            $path .= DIRECTORY_SEPARATOR;

        return $path;
    }

	private function rectrictUrl($url) {
		global $baseURL;
		$arUrl = parse_url($url);
		if(empty($arUrl['scheme']) && !empty($baseURL)) {
			$sbu = strlen($baseURL);
			if(substr($baseURL, $sbu-1, 1) == DIRECTORY_SEPARATOR)
				$baseURL = substr($baseURL, 0, $sbu-1);
			if(substr($url, 0, 1) != DIRECTORY_SEPARATOR)
				$url = DIRECTORY_SEPARATOR . $url;
			$url = $baseURL . $url;
		}

		//$url = str_replace("//", "/", $url);
	    $url = str_replace(" ", "%20", $url);
	    $url = str_replace("&amp;", "&", $url);
		$pos = strpos($url, "#");
		if($pos !== false) $url = substr($url, 0, $pos);

		return $url;
	}

	public function setReferer($value) {
		$this->_strReferer = $value;
	}
	public function getReferer() {
		return $this->_strReferer;
	}
	public function getInfo() {
		return $this->arInfo;
	}

	private function getCurl() {
		$curl = curl_init();

		$tempPath = $this->getTempPath();
		$arUrl = parse_url($this->url);
		$isSSL = ($arUrl['scheme'] == 'https');

	    if(strlen($this->_strReferer) <= 0) {
			$this->_strReferer = $arUrl['scheme']."://" . $arUrl['host'] . "/";
        }

		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:67.0) Gecko/20100101 Firefox/67.0");
		curl_setopt($curl, CURLOPT_TIMEOUT, 1000);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl, CURLOPT_URL, $this->url);
		curl_setopt($curl, CURLOPT_REFERER, $this->_strReferer);
		curl_setopt($curl, CURLOPT_HEADER, TRUE);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, FALSE);
		curl_setopt($curl, CURLOPT_COOKIEJAR, $tempPath."cookie.txt");
        curl_setopt($curl, CURLOPT_COOKIEFILE, $tempPath."cookie.txt");
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, $isSSL);

		if(!empty($this->user) && !empty($this->password)) {
			curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC) ;
			curl_setopt($curl, CURLOPT_USERPWD, $this->user.":".$this->password);
		}

		return $curl;
	}

	private function checkCache($cacheTime, &$fileName) {
		if(!strlen($fileName)) {
            $tempPath = $this->getTempPath();
			$fileName = $tempPath.md5($this->url).".cache";
		}

		if($cacheTime && is_file($fileName)) {
			$mTime = filemtime($fileName);
			if(time() - $mTime < $cacheTime)
				return true;
		}

		return false;
	}
	private function saveCache($cacheFile, $data) {
		$iniText = "";
		file_put_contents($cacheFile, $data);
		foreach($this->arInfo as $key => $value) $iniText .= $key."=\"".$value."\"\n";
		file_put_contents($cacheFile.".ini", $iniText);	
	}

	private static function create(string $url, Download $dwl) {
	    $downloader = new Download($url);
        $downloader->setAuth($dwl->user, $dwl->password);
        $downloader->setTempPath($dwl->getTempPath());

        return $downloader;
    }

	public function readInfo($curl) {
		$contentType = curl_getinfo($curl, CURLINFO_CONTENT_TYPE);
		$type = $encoding = '';
		if(preg_match("/([^;]+);\scharset=(.*)/is", $contentType, $m)) 
		{
			$type = $m[1];
			$encoding = $m[2];
		}
		elseif(preg_match("/([^;]+)/is", $contentType, $m))
			$type = $m[1];

		return array(
			'code' => curl_getinfo($curl, CURLINFO_HTTP_CODE),
			'type' => $type,
			'headerLen' => curl_getinfo($curl, CURLINFO_HEADER_SIZE),
			'encoding' => $encoding
		);
	}

	public function get($cacheTime = 0) {
		//if(strpos($arUrl['scheme'], 'http') !== 0)
		//	throw new Exception("Неверный протокол");
		$bCached = $this->checkCache($cacheTime, $cacheFile); 
		if($bCached) {
			if(is_file($cacheFile.".ini"))
				$this->arInfo = parse_ini_file($cacheFile.".ini");
			return file_get_contents($cacheFile);
		}

		$curl = $this->getCurl();
		$data = curl_exec($curl); 
		$this->arInfo = $this->readInfo($curl);

		$header = substr($data, 0, $this->arInfo['headerLen']);
		$data = substr($data, $this->arInfo['headerLen']);
		$redirURL = preg_match("/Location:\s([^\r\n]+)/is", $header, $m) ? $m[1] : '';

		curl_close ($curl);
		unset($curl);

		if(($this->arInfo['code'] >= 300) && ($this->arInfo['code']<400) && strlen($redirURL)) 
		{
			$dwl = Download::create($redirURL, $this);
			return $dwl->get($cacheTime);
		}
		elseif ($this->arInfo['code'] != 200) 
			return false;

		if($cacheTime > 0)
			$this->saveCache($cacheFile, $data);

		return $data;
	}

	public function post(array $arData) {
		$curl = $this->getCurl();

		$strData = http_build_query($arData);
		curl_setopt($curl, CURLOPT_POST, TRUE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Length: ' . strlen($strData))); 
		curl_setopt($curl, CURLOPT_POSTFIELDS, $strData);

		$data = curl_exec($curl);
		$this->arInfo = $this->readInfo($curl);

		//$header = substr($data, 0, $this->arInfo['headerLen']);
		$data = substr($data, $this->arInfo['headerLen']);

		curl_close ($curl);
		unset($curl);

		return $data;
	}

	public function download($fileName = '', $cacheTime = 3600) 
	{	
		$bCached = $this->checkCache($cacheTime, $fileName);
		if($bCached) return $fileName;

		$curl = $this->getCurl();

		$path = dirname($fileName);
		File::checkPath($path);

		$fp = @fopen($fileName, "wb");
        curl_setopt($curl, CURLOPT_FILE, $fp);
        curl_setopt($curl, CURLOPT_BINARYTRANSFER, true);
		curl_setopt($curl, CURLOPT_HEADER, FALSE);
		if (curl_exec($curl) === false) {
			fclose($fp);
            unlink($fileName);
			curl_close($curl);
			return null;
		}
		$this->arInfo = $this->readInfo($curl);

        fclose($fp);
        curl_close($curl);

        return $fileName;
    }

	public static function getExtByName($str) {
        return strtolower(preg_replace("~^(.*)\.([^\.]+)|()$~", "\\2\\3", $str));
	}

	public static function getExtByMime($mime) {
		$imgTypes = array( 'jpg', 'jpeg', 'gif', 'bmp', 'png' );
		foreach($imgTypes as $type) 
			if(strpos($mime, $type) !== false) {
				if($type == 'jpeg') $type = 'jpg';
				return $type;
			}

		return '';
	}
	
	public function image($cacheTime = 3600) 
	{
		$fileName = $this->download('', $cacheTime);
		if(!$fileName) return $fileName;

		$result = getimagesize($fileName);
		if($result[0] <= 0) return $fileName;
		
		$pos = strrpos($fileName, ".");
		$newName = substr($fileName, 0, $pos).".".self::getExtByMime($result['mime']);
		rename($fileName, $newName);
		
		$result['file'] = $newName;
		return $result;
	}
	
	public function gzUnzip($fileName) 
	{	
		// Распаковать файл
		$gzhandle = gzopen($fileName, 'r'); 
		$handle = fopen(substr($fileName, 0, -3), 'w');
		while (!feof($gzhandle))
		{
			$buf = gzread($gzhandle, 8192);
			fwrite($handle, $buf);
		}

		gzclose($gzhandle);
		fclose($handle);
	}
}
