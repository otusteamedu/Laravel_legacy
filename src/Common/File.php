<?php

namespace App\Common;

class File {
	const REWRITE = 0;
	const APPEND = 1;	
	
	const MODE_READ = "r";
	const MODE_WRITE = "w";
	const MODE_APPEND = "a";	
	
	private $filePath;
	
	protected $pointer;
	
	public function __construct($filePath = '') {
		$this->filePath = $filePath;
	}
	
	/**
	 * Открыть файл
	 *
	 * @param string $mode
	 * @return resource
	 * @throws FileOpenException
	 */
	public function open($mode)
	{
		$this->pointer = fopen($this->filePath, $mode."b");
		if (!$this->pointer)
			throw new FileOpenException($this->filePath);

		return $this->pointer;
	}	

	/**
	 * Закрыть файл
	 *
	 * @throws FileNotOpenedException
	 */
	public function close()
	{
		if(!$this->pointer)
			throw new FileNotOpenedException($this->filePath);

		fclose($this->pointer);
		$this->pointer = null;
	}
	
	/**
	 * Возвращает указатель на ресурс файла
	 * @return resource
	 *
	 */
	public function getHandle()
	{
		return $this->pointer;
	}

    /**
     * Путь к файлу
     * @return string
     */
	public function getFilePath()
	{
		return $this->filePath;
	}

    /**
     * @return string расширение файла
     */
	public function getExtension()
	{
		return self::getFileExtension($this->getFilePath());
	}
	
	public static function getFileExtension($filePath) {
		$path = self::getName($filePath);
		if ($path != '')
		{
			$pos = strrpos($path, '.');
			if ($pos !== false)
				return substr($path, $pos + 1);
		}
		return '';
	}

	public static function getName($filePath)
	{
        return self::getFileName($filePath);
	}

	public static function getFileName($path)
	{
        $fileName = str_replace('\\', '/', $path);
        $pos = strrpos($fileName, '/');
        $fileName = ($pos === false )? $fileName : substr($fileName, $pos + 1);

        return $fileName;
	}
	
	public function isExists() {
		return file_exists($this->getFilePath()) && (is_file($this->getFilePath()) || is_link($this->getFilePath()));
	}

	public function getContents()
	{
		if (!$this->isExists())
			throw new FileNotFoundException($this->getFilePath());

		return file_get_contents($this->getFilePath());
	}

	public function putContents($data, $flags = self::REWRITE)
	{
		$dir = $this->getDirectory();
		if (!$dir->isExists())
			$dir->create();

		if ($this->isExists() && !$this->isWritable())
			$this->markWritable();

		return $flags & self::APPEND
			? file_put_contents($this->getPhysicalPath(), $data, FILE_APPEND)
			: file_put_contents($this->getPhysicalPath(), $data);
	}

	public function getSize() {
		if (!$this->isExists()) 
			throw new FileNotFoundException($this->getFilePath());

		$size = 0;
		if(PHP_INT_SIZE < 8) {
			// 32bit
			$this->open(self::READ);
			if(fseek($this->getHandle(), 0, SEEK_END) === 0) {
				$size = 0.0;
				$step = 0x7FFFFFFF;
				while($step > 0) {
					if (fseek($this->getHandle(), -$step, SEEK_CUR) === 0)
						$size += floatval($step);
					else
						$step >>= 1;
				}
			}
			$this->close();
		}
		else {
			// 64bit
			$size = filesize($this->getFilePath());
		}
		
		return $size;
	}

	
	/**
	 * Seeks on the file pointer from the beginning (SEEK_SET only).
	 *
	 * @param int|float $position
	 * @return int
	 * @throws FileNotOpenedException
	 */
	public function seek($position) {
		if(!$this->pointer)
			throw new FileNotOpenedException($this->getFilePath());

		if($position <= PHP_INT_MAX)
			return fseek($this->pointer, $position, SEEK_SET);

		$res = fseek($this->pointer, 0, SEEK_SET);
		if($res === 0) {
			do {
				$offset = ($position < PHP_INT_MAX ? $position : PHP_INT_MAX);
				$res = fseek($this->pointer, $offset, SEEK_CUR);
				if($res !== 0)
					break;

				$position -= PHP_INT_MAX;
			}
			while($position > 0);
		}
		return $res;
	}
	
	public function isWritable()
	{
		if (!$this->isExists())
			throw new FileNotFoundException($this->getFilePath());

		return is_writable($this->getFilePath());
	}

	public function isReadable()
	{
		if (!$this->isExists())
			throw new FileNotFoundException($this->getFilePath());

		return is_readable($this->getFilePath());
	}

	public function readFile()
	{
		if (!$this->isExists())
			throw new FileNotFoundException($this->getFilePath());

		return readfile($this->getFilePath());
	}

	public function getCreationTime()
	{
		if (!$this->isExists())
			throw new FileNotFoundException($this->getFilePath());

		return filectime($this->getFilePath());
	}

	public function getLastAccessTime()
	{
		if (!$this->isExists())
			throw new FileNotFoundException($this->getFilePath());

		return fileatime($this->getFilePath());
	}

	public function getModificationTime()
	{
		if (!$this->isExists())
			throw new FileNotFoundException($this->getFilePath());

		return filemtime($this->getFilePath());
	}

	public function markWritable()
	{
		if (!$this->isExists())
			throw new FileNotFoundException($this->getFilePath());

		@chmod($this->getFilePath(), BX_FILE_PERMISSIONS);
	}

	public function getPermissions()
	{
		if (!$this->isExists())
			throw new FileNotFoundException($this->getFilePath());

		return fileperms($this->getFilePath());
	}

	public function delete()
	{
		if ($this->isExists())
			return unlink($this->getFilePath());

		return true;
	}

	public function getContentType()
	{
		if (!$this->isExists())
			throw new FileNotFoundException($this->getFilePath());

		$finfo = \finfo_open(FILEINFO_MIME_TYPE);
		$contentType = \finfo_file($finfo, $this->getFilePath());
		\finfo_close($finfo);

		return $contentType;
	}

	public static function checkPath($path) {

    }
}
