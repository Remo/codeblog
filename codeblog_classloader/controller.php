<?php

defined('C5_EXECUTE') or die('Access Denied.');

class CodeblogClassloaderPackage extends Package {

    protected $pkgHandle = 'codeblog_classloader';
    protected $appVersionRequired = '5.6.0';
    protected $pkgVersion = '0.0.1';

    public function getPackageName() {
        return t("Classloader Test");
    }

    public function getPackageDescription() {
        return t("Installs the Classloader Example package.");
    }

    public function on_start() {
        // register our package classes
        $classes = array(
            'TestClass' => array('model', 'test_class', $this->pkgHandle),
        );
        Loader::registerAutoload($classes);
    }

}