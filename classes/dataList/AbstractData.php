<?php

namespace dataList;

abstract class AbstractData {

    protected function dataList() {
        return json_decode(file_get_contents($this->getFilePath()), true);
    }
    
    private function getFilePath(){
        return dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR."data".DIRECTORY_SEPARATOR.$this->getFileName().".json";
    }

    abstract protected function getFileName();
    
}
