<?php


namespace Solyaris\App;


final class ConsoleIO
{
    private $stream_in;
    private $stream_out;
    private $stream_err;

    public function __construct($in = null, $out = null, $err = null)
    {
        $this->setStreamIn($in);
        $this->setStreamOut($out);
        $this->setStreamErr($err);
    }

    public function setStreamIn($stream) {
        $this->stream_in = is_resource($stream) ? $stream : fopen('php://stdin', 'r');
    }
    public function setStreamOut($stream) {
        $this->stream_out = is_resource($stream) ? $stream : fopen('php://stdout', 'w');
    }
    public function setStreamErr($stream) {
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