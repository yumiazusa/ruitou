<?php
namespace Index\Controller;
use Think\Controller;
class AboutusController extends MyController {

    public function __construct() {
        parent::__construct();
    }

    public function index(){
        //SEO
        $ident ="News";
        $idents =$this->seo($ident);
        $this->assign("title",$idents['title']);
        $this->assign("keywords",$idents['keywords']);
        $this->assign("description",$idents['description']);
        $consultantDb=M('index_consultant');
        $consultants=$consultantDb->where(array('is_show'=>1))->order('orderlist ASC')->select();
        $this->assign('consultants',$consultants);
        $caseDb=M('case');
        $cases=$caseDb->where(array('is_show'=>1))->order('orderlist DESC')->select();
        $this->assign('cases',$cases);
        $this->display();
    }

    
}

