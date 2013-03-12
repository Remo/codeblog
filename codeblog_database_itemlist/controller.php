<?php

defined('C5_EXECUTE') or die('Access Denied.');

class CodeblogDatabaseItemlistPackage extends Package {

    protected $pkgHandle = 'codeblog_database_itemlist';
    protected $appVersionRequired = '5.6.1';
    protected $pkgVersion = '0.0.1';
    protected $package;

    public function getPackageName() {
        return t("Codeblog Database Itemlist");
    }

    public function getPackageDescription() {
        return t("Installs the Codeblog Database Itemlist example package.");
    }

    private function addSinglePage($path, $name, $description = '', $icon = '') {
        Loader::model('single_page');
        $page = Page::getByPath($path);
        if (is_object($page) && $page->getCollectionID() > 0) {
            return;
        }
        $sp = SinglePage::add($path, $this->package);
        $sp->update(array('cName' => $name, 'cDescription' => $description));

        if ($icon != '') {
            $sp->setAttribute('icon_dashboard', $icon);
        }
    }

    public function install() {
        $this->package = parent::install();
        
        $db = Loader::db();
        $this->addSinglePage('/codeblog_database_itemlist', t('Database Item List'), t('Database Item List Testpage'));
    }

    public function on_start() {
        /**
         * Register our models to make them available to auto loading
         * and therefore remove the need to call Loader::model everytime
         * we need them
         */
        $classes = array(
            'Mountain' => array('model', 'mountain', 'codeblog_database_itemlist'),
            'MountainList' => array('model', 'mountain_list', 'codeblog_database_itemlist')
        );
        Loader::registerAutoload($classes);
    }

}