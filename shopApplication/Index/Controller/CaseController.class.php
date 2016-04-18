<?php
namespace Index\Controller;
use Think\Controller;
class CaseController extends MyController {
    public function __construct() {
        parent::__construct();
    }

    public function casepage(){
    	$id=I('get.id');
        $title=M('case')->where(array('id'=>$id))->getField('name');
        $this->assign('title',$title);
    	switch ($id) {
    		case 1:
    			$this->display('case1');
    			break;
    		case 2:
                $this->display('case2');
                break;
            case 3:
                $this->display('case3');
                break;
    		default:
    			$this->error();
    			break;
    	}
        
    }

   
}

