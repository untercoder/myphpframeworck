<?php

namespace mpf\libs;

class Cache
{

    protected $file;

    public function __construct()
    {

    }

    protected function setFile($key): void
    {
        $this->file = CACHE . "/" . md5($key) . ".txt";
    }

    public function get($key)
    {
        $this->setFile($key);
        if (file_exists($this->file)) {
            $content = unserialize(file_get_contents($this->file));
            if (time() <= $content['end_time']) {
                return $content['data'];
            } else {
                unlink($this->file);
            }
        } else return false;
    }

    public function set($key, $data, $seconds = 3600): bool
    {
        $this->setFile($key);
        $content['data'] = $data;
        $content['end_time'] = time() + 3600;
        if (file_put_contents($this->file, serialize($content))) {
            return true;
        } else {
            return false;
        }

    }
}