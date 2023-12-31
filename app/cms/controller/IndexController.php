<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2019 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | LeoXie <380019813@qq.com>
// +----------------------------------------------------------------------
namespace app\cms\controller;

use cmf\controller\HomeBaseController;

class IndexController extends HomeBaseController
{
    public function index()
    {
       	if(cmf_is_mobile()){
 return $this->fetch(':indexmob');
    	}else{
    		 return $this->fetch(':index');
    	}
    }
}

