<?php
namespace Home\Controller;

use Think\Controller;
use Think\Controller\RestController;

class IndexController extends RestController
{
    public function index()
    {
//        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');

        if (true) {
            $User = M('player');

            $count = $User->where('true')->count();

            $Page = new \Think\Page($count, 5);
//            $Page->setConfig('header', 'asdffsd');
            $Page->setConfig('prev', '上一页');
            $Page->setConfig('next', '下一页');
            $Page->setConfig('theme', "共 %TOTAL_ROW% 条记录 %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%");

            $show = $Page->show();
            $list = $User->where('true')->limit($Page->firstRow . ',' . $Page->listRows)->select();

            $this->assign('list', $list);
            $this->assign('page', $show);

            $this->display('./index');

        }
        if (IS_POST) {

//            实例化传入
            $config = array(
                'maxSize' => 324534728,
                'rootPath' => './Uploads/',
                'savePath' => '',
                'saveName' => array('uniqid', ''),
                'exts' => array('jpg', 'gif', 'png', 'jpeg', 'xmind'),
                'autoSub' => array('date', 'Ymd')
            );
            $upload = new \Think\Upload($config);

//             动态赋值
//            $upload = new \Think\Upload();
//            $upload->maxSize = 21412412;
//            $upload->rootPath = '/.Uploads/';
//            $upload->savePath = '';
//            $upload->saveName = array('uniqid', '');
//            $upload->exts = array('jpeg', 'gif', 'png', 'jpeg', 'xmind');
//            $upload->autoSub = true;
//            $upload->subName = array('date', 'Ymd');

            $info = $upload->upload();
            if (!$info) { // 上传失败
                $this->error($upload->getError());
            } else { // 上传成功
                $this->success('上传成功');
            }
//            $this->display('./index');

        }

    }

    public function update()
    {
        if (IS_GET) {
            $username = I('get.id');
            $item = M('player')->where('username="' . $username . '"')->select();
            $this->assign('item', $item);
            $this->display('./update');
        } elseif (IS_POST) {
            $User = M('player');
            $data['username'] = I('post.username');
            $data['password'] = I('post.password');
            $data['id'] = I('post.id');
            $User->where('username="' . $data['id'] . '"')->save($data);
        }
    }

    public function delete()
    {
        if (IS_POST) {
            $Player = M('player');
            $username = I('post.id');
            $Player->where('username="' . $username . '"')->delete();
        }
    }

    public function insert()
    {
        if (IS_GET) {
            $this->display('./insert');
        } elseif (IS_POST) {
            $User = M('player');
            $data['username'] = I('post.username');
            $data['password'] = I('post.password');
            $User->add($data);
//            $this->redirect();

            // todo 多表查询
//            $result = M('product')
//                ->join('left join t_comp on t_product.pid=t_comp.id')
//                ->field('t_product.pid, pname, count(t_comp.compid) as cc')
//                ->group('pid')
//                ->select();
        }
    }
}