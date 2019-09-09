<?php


namespace Solyaris\App;


final class AppIO
{
    private $stream_in = null;
    private $stream_out = null;
    private $stream_err = null;

    public function __construct($in = null, $out = null, $err = null)
    {
        $this->setStreamIn($in);
        $this->setStreamOut($out);
        $this->setStreamErr($err);
    }

    public function setStreamIn($stream) {
        if(is_resource($this->stream_in))
            fclose($this->stream_in);
        $this->stream_in = is_resource($stream) ? $stream : fopen('php://stdin', 'r');
    }
    public function setStreamOut($stream) {
        if(is_resource($this->stream_out))
            fclose($this->stream_out);
        $this->stream_out = is_resource($stream) ? $stream : fopen('php://stdout', 'w');
    }
    public function setStreamErr($stream) {
        if(is_resource($this->stream_err))
            fclose($this->stream_err);
        $this->stream_err = is_resource($stream) ? $stream : fopen('php://stderr', 'w');
    }
    public function write(string $string) {
        fwrite($this->stream_out, $string);
    }
    public function writeLn(string $string) {
        $this->write($string . PHP_EOL);
    }
    public function read(int $length = 0) : string {
        if($length <= 0)
            return $this->readLn();

        return fgets($this->stream_in, $length);
    }
    public function readLn() : string {
        $string  = fgets($this->stream_in);
        return trim($string);
    }

    public function error(string $string) {
        fwrite($this->stream_err, $string);
    }
    public function errorLn(string $string) {
        $this->error($string . PHP_EOL);
    }
}