<?php
namespace   Admin\Controller;
use         Think\Controller;

/**
 * 后台主页
 */
class IndexsController extends MyController {

    /**
     * 构造方法：对该模块进行一些初始化操作
     * 实现父类的构造方法，可对用户登录进行验证
     * 设置该控制器下共有的标题
     */
    public function __construct() {
        parent::__construct();
    }

    // 后台首页
    public function mainLogo() {
        $db = M("index_mainlogo");
        $list = $db->find();
        $this->assign("data",$list);
        $this->display();
    }

    public function editMainlogo(){
        $db = M("index_mainlogo");
        $list = $db->find();
        $this->assign("data",$list);
        $this->display();
    }

   public function doEditmainlogo(){
        $data=I('post.');
        if($_FILES['img']['name']!=""){
            $data['img']=$this->uploadone();
            }
        $mdl = M("index_mainlogo");

            $rt=$mdl->where(array('id'=>$data['id']))->save($data);
            if($rt){
                $this->success("修改成功",U("Indexs/mainLogo"));
                exit;
            }
        $this->error("修改失败");
   }

   //单图片上传
    public function uploadone(){
        $upload = new \Think\Upload();
        $upload->maxSize = 3145728;
        $upload->exts    =array('jpg','gif','png','jpeg');
         $upload->rootPath="Public/Index/images/";
         $upload->savePath="";
         $info=$upload->upload();
         if(!$info) {
                  $this->error($upload->getError());
          }else{                                                 // 上传成功 获取上传文件信息
             foreach($info as $file){
               return '/Public/Index/images/'.$file['savepath'].$file['savename'];
             }
         }
    }

   // 后台首页
    public function backgroundList() {
        $db = M("index_background");
        $list = $db->select();
        $this->assign("data",$list);
        $this->display();
    }

    public function editBackground(){
        $id=I('get.id');
        $db = M("index_background");
        $list = $db->where(array('id'=>$id))->find();
        $this->assign("data",$list);
        $this->display();
    }

    public function doEditbackground(){
        $data=I('post.');
        if($_FILES['img']['name']!=""){
            $data['img']=$this->uploadoneback($data['id']);
            }
        $mdl = M("index_background");

            $rt=$mdl->where(array('id'=>$data['id']))->save($data);
            if($rt){
                $this->success("修改成功",U("Indexs/backgroundList"));
                exit;
            }
        $this->error("修改失败");
   }

   //单图片上传
    public function uploadoneback($id){
        $upload = new \Think\Upload();
        $upload->maxSize = 3145728;
        $upload->exts    =array('jpg','gif','png','jpeg');
         $upload->rootPath="Public/Index/Aboutus/index/images/";
         $upload->savePath="";
         $upload->saveName = $id;
         $upload->autoSub = false;
         $upload->replace = true;
         $info=$upload->upload();
         if(!$info) {
                  $this->error($upload->getError());
          }else{                                                 // 上传成功 获取上传文件信息
             foreach($info as $file){
               return '/Public/Index/Aboutus/index/images/'.$file['savepath'].$file['savename'];
             }
         }
    }

    public function mainNav(){
        $db = M("index_mainnav");
        $data = $db->order('orderlist')->select();
        $this->assign("list",$data);
        $this->display();
    }

    public function editMainnav(){
        $id=I('get.id');
        $db = M("index_mainnav");
        $list = $db->where(array('id'=>$id))->find();
        $this->assign("data",$list);
        $this->display();
    }

    public function doEditmainnav(){
        $data=$_POST;
        if($_FILES['image']['name']!=""){
            $data['image']=$this->uploadone();
            }
        $mdl = M("index_mainnav");

            $rt=$mdl->where(array('id'=>$data['id']))->save($data);
            if($rt){
                $this->success("修改成功",U("Indexs/mainNav"));
                exit;
            }
        $this->error("修改失败");
   }

   public function addMainnav(){
        $this->display();
   }


   public function doAddmainnav(){
        $data=$_POST;
        if($_FILES['image']['name']!=""){
            $data['image']=$this->uploadone();
            }
        $mdl = M("index_mainnav");

            $rt=$mdl->where(array('id'=>$data['id']))->add($data);
            if($rt){
                $this->success("添加成功",U("Indexs/mainNav"));
                exit;
            }
        $this->error("添加失败");
   }

   /**
     * 顾问列表
     */
    public function consultantList(){
        $Model=M('index_consultant');
        $count = $Model->count();
        $page = new \Think\Page($count,10);
        $list = $Model -> limit($page->firstRow.','.$page->listRows)->order('orderlist ASC')->select();        
        $this->assign("list",$list);
        $show  = $page->show();
        $this->assign("page",$show);
        $this->display();
    }

    /**
     * 顾问添加
     */
    public function addConsultant(){
        $this->display();
    }

    public function doAddConsultant(){
        $post = $_POST;

        $post['name']=trim($post['name']);
        if(empty($post['name'])){
            $this->error('顾问姓名不能为空，添加失败！');
            exit;
        }
        $modelGoods = M('index_consultant');
        if ($modelGoods->create($post)) {
            $getGoodsId = $modelGoods->add($post);
            if (!$getGoodsId) {
                $this->error('顾问添加失败');
                exit;
            }else{
                if ($getGoodsId) {
                // 写入日志
                $this->success('顾问添加成功', 'consultantList');
                exit;
             }
            }
        }else{
            $this->error('上传出错。');
        }

    }

    /**
     * 上传图片
     *产品上传缩略图所使用
     */
    public function uploadGoods(){
        $upload = new \Think\Upload();  // 实例化上传类
        $upload->maxSize = 3145728;             // 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');   // 设置附件上传类型
        $upload->rootPath = "Public/Index/Consultant/";
        $upload->savePath = '';                         // 设置附件上传目录    // 上传文件
        $info = $upload->upload();
        $src=$info['Filedata']['savepath'] . $info['Filedata']['savename'];
        $this->ajaxReturn($src);
    }

    /**
     * 顾问信息修改
     */
    public function editConsultant(){
        $getGoodId = I('get.id');
        // 获取产品详细信息
        $modelGoods = M('index_consultant');
        $productRes = $modelGoods->find($getGoodId);
        $this->assign('good',$productRes);
        $this->display();
    }

    /**
     * 执行顾问信息修改
     */
    public function doEditConsultant(){
        $getId = I('post.id');
       $post = $_POST;
        // dump($post);
        // die;
        $post['name']=trim($post['name']);
        if (empty($post['name'])) {
            $this->error('顾问信息更改无效');
            exit;
        }
        $modelGoods = M('index_consultant');
        $updateGoods = 0;
        if ($modelGoods->create($post)) {
            $updateGoods = $modelGoods ->where(array('id'=>$getId))->save();
        }
        if ($updateGoods) {
            // 写入日志
            $this->success('顾问信息修改成功','consultantList');
            exit;
        } else {
            $this->error('顾问信息修改失败');
        }
    }

    /**
     * 删除产品
     */
    public function delCase(){
        $getId = I('get.id');
        $modelGoods = M('case');
        $affectedRows = $modelGoods->where(array('id'=>$getId))->delete();
    
        if ($affectedRows) {
            // 写入日志
            $this->success('案例已删除');
        } else {
            $this->error('操作失败');
        }
    }


    /**
     * 案例列表
     */
    public function caseList(){
        $Model=M('case');
        $count = $Model->count();
        $page = new \Think\Page($count,10);
        $list = $Model -> limit($page->firstRow.','.$page->listRows)->select();        
        $this->assign("list",$list);
        $show  = $page->show();
        $this->assign("page",$show);
        $this->display();
    }


    /**
     * 案例添加
     */
    public function addCase(){
        $this->display();
    }

    public function doAddCase(){
        $post = $_POST;

        $post['name']=trim($post['name']);
        if(empty($post['name'])){
            $this->error('案例名不能为空，添加失败！');
            exit;
        }
        $modelGoods = M('case');
        if ($modelGoods->create($post)) {
            $getGoodsId = $modelGoods->add($post);
            if (!$getGoodsId) {
                $this->error('案例添加失败');
                exit;
            }else{
                if ($getGoodsId) {
                // 写入日志
                $this->success('案例添加成功', 'caseList');
                exit;
             }
            }
        }else{
            $this->error('上传出错。');
        }

    }

    /**
     * 上传图片
     *产品上传缩略图所使用
     */
    public function uploadCase(){
        $upload = new \Think\Upload();  // 实例化上传类
        $upload->maxSize = 3145728;             // 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');   // 设置附件上传类型
        $upload->rootPath = "Public/Index/Case/images/";
        $upload->savePath = '';                         // 设置附件上传目录    // 上传文件
        $info = $upload->upload();
        $src=$info['Filedata']['savepath'] . $info['Filedata']['savename'];
        $this->ajaxReturn($src);
    }

    /**
     * 案例信息修改
     */
    public function editCase(){
        $getGoodId = I('get.id');
        // 获取产品详细信息
        $modelGoods = M('case');
        $productRes = $modelGoods->find($getGoodId);
        $this->assign('good',$productRes);
        $this->display();
    }

    /**
     * 执行案例信息修改
     */
    public function doEditCase(){
        $getId = I('post.id');
        $post = $_POST;
        // dump($post);
        // die;
        $post['name']=trim($post['name']);
        if (empty($post['name'])) {
            $this->error('顾问信息更改无效');
            exit;
        }
        $modelGoods = M('case');
        $updateGoods = 0;
        if ($modelGoods->create($post)) {
            $updateGoods = $modelGoods ->where(array('id'=>$getId))->save();
        }
        if ($updateGoods) {
            // 写入日志
            $this->success('案例信息修改成功','caseList');
            exit;
        } else {
            $this->error('案例信息修改失败');
        }
    }
}

