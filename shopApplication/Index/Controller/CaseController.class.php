<?php
namespace Index\Controller;
use Think\Controller;
class CaseController extends MyController {
    public function __construct() {
        parent::__construct();
    }

    public function casepage(){
    	$id=I('get.id');
    	switch ($id) {
    		case 1:
    			$this->display('case1');
    			break;
    		
    		default:
    			$this->error();
    			break;
    	}
        
    }
}

