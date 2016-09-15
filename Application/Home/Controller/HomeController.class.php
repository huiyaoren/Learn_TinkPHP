<?php
namespace Home\Controller;

use \THink\Controller;
use \Think\Controller\RestController;

class homeController extends RestController
{

    protected $allowMethod = ['get', 'post', 'put', 'delete'];
    protected $allowType = ['html', 'json'];

    Public function main_get_html()
    {
//        $this->response([123,123], 'json');
        $this->display('./index');
    }

}