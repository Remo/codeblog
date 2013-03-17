<?php

defined('C5_EXECUTE') or die('Access Denied.');

$bvt = new BlockViewTemplate($b);
$bvt->setBlockCustomTemplate(false);

function nav_tree_callback($buffer) {
    return str_replace('<ul class="nav">', '<ul class="nav-tree">', $buffer);
}

ob_start("nav_tree_callback");
include($bvt->getTemplate());
ob_end_flush();