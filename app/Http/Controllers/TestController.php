<?php
/**
 * Created by PhpStorm.
 * User: lc
 * Date: 2017/8/6
 * Time: 16:03
 */

namespace App\Http\Controllers;


use EasyWeChat\Foundation\Application;

class TestController extends Controller
{
    public function test()
    {
       // $openId = $this->getOpenId();
        //return view('test.test');
        $user = session('wechat.oauth_user');
        return $user;
        dd($this->getOpenId());
        /*dd($openId);
        $app = new Application();
        $userService = $app->user;
        dd($userService);*/
    }

}