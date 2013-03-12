<?php

defined('C5_EXECUTE') or die('Access Denied.');

class MountainList extends DatabaseItemList {

    private $queryCreated;

    protected function setBaseQuery() {
        $this->setQuery('SELECT mountainID, mountainName, mountainHeight FROM CodeblogMountains');
    }

    protected function createQuery() {
        if (!$this->queryCreated) {
            $this->setBaseQuery();
            $this->queryCreated = 1;
        }
    }

    public function get($itemsToGet = 0, $offset = 0) {
        $mountains = array();
        $this->createQuery();
        $r = parent::get($itemsToGet, $offset);
        foreach ($r as $row) {
            $mountains[] = new Mountain($row['mountainID'], $row);
        }
        return $mountains;
    }

    public function filterByHeight($value, $comparison = '=') {
        $this->filter('mountainHeight', $value, $comparison);
        
    }

    public function sortByMountainName($order = 'asc') {
        $this->sortBy('mountainName', $order);
    }

    public function getTotal() {
        $this->createQuery();
        return parent::getTotal();
    }

}
