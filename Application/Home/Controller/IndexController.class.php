<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {
//        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
        $something = M('player')->select();
//        $something = M('player');
//        $this ->show($something);
        $this->assign('something', $something);
        $this->display('./index');
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
//            $s = $Player->where('username="' . $username . '"')->select();
            $s = $Player->where('username="' . $username . '"')->delete();
//            $s = $Player->delete('asdasd');
//            var_dump($s);
            var_dump($username);
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
            $data['sign_time'] = 'now()';
            $data['last_login_time'] = 'now()';
//            $this->ajaxReturn('asdfasd');
//            var_dump($data);
            $User->create($data);
        }

    }
}