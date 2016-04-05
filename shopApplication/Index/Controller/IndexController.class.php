<?php
namespace Index\Controller;
use Think\Controller;
class IndexController extends MyController {
        public function __construct() {
        parent::__construct();
    }


    public function index(){
        //SEO
        $ident ="Indexindex";
        $idents =$this->seo($ident);
        $this->assign("title",$idents['title']);
        $this->assign("keywords",$idents['keywords']);
        $this->assign("description",$idents['description']);
        $db = M("index_mainlogo");
        $list = $db->find();
        $dbnav = M("index_mainnav");
        $navs = $dbnav->order('orderlist')->select();
        $this->assign("navs",$navs);
        $this->assign("data",$list);
    	$this->display();
        }

    public function ajaxContact(){
        // require('badword.src.php');
        $badword=M('badwords')->getField('badword',true);
        $badword1 = array_combine($badword,array_fill(0,count($badword),'*'));
        $data=I('post.');
        $data['subject']=strtr($data['subject'],$badword1);
        $data['content']=strtr($data['content'],$badword1);
        $data['contact_time']=time();
        $db=M('index_contact');
        $res=$db->add($data);
        if($res){
            $this->ajaxReturn(1);
            exit;
            }else{
            $this->ajaxReturn(0);
            exit;
            }
        }
}