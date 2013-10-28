<?php

defined('C5_EXECUTE') or die('Access Denied.');

class CodeblogDatabaseItemlistController extends Controller {

    public function view() {        
        $ml = new MountainList();
        $ml->setItemsPerPage(5);
        $ml->sortByMountainName();
        // $ml->filterByHeight(4000, '>');
        $html = Loader::helper('html');
        
        $this->addHeaderItem($html->css('mountain_style.css', 'codeblog_database_itemlist'));

        $this->set('mountains', $ml->getPage());
        $this->set('mountainsPagination', $ml->displayPaging(Loader::helper('navigation')->getLinkToCollection($currentPage), true));
    }
    
    public function add() {
        $th = Loader::helper('text');
        
        $data = array(
            'mountainName' => $th->sanitize($this->post('mountainName')),
            'mountainHeight' => $th->sanitize($this->post('mountainHeight'))
        );
        
        Mountain::add($data);
        
        $this->set('message', t('Mountain added'));
        $this->view();
    }
    
    public function remove($mountainID) {
        $mountain = new Mountain(intval($mountainID));
        $mountain->remove();
        
        $this->set('message', t('Mountain removed'));
        $this->view();        
    }

}
