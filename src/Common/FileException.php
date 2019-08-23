<?php
namespace App\Common;

class FileException extends \Exception {
	
	private $path;
	
	/**
	 * Creates new exception object.
	 *
	 * @param string $message Exception message
	 * @param string $path Path that generated exception.
	 * @param \Exception $previous
	 */
	public function __construct($message = "", $path = "", \Exception $previous = null) {
		parent::__construct($message, 120, '', 0, $previous);
		$this->path = $path;
	}

	/**
	 * Path that generated exception.
	 *
	 * @return string
	 */
	public function getPath() {
		return $this->path;
	}
}

class InvalidPathException extends FileException
{
	public function __construct($path, \Exception $previous = null)
	{
		$message = sprintf("Path '%s' is invalid.", $path);
		parent::__construct($message, $path, $previous);
	}
}

class FileNotFoundException extends FileException
{
	public function __construct($path, \Exception $previous = null)
	{
		$message = sprintf("Path '%s' is not found.", $path);
		parent::__construct($message, $path, $previous);
	}
}

