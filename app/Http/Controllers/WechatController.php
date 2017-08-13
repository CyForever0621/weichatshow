<?php

namespace App\Http\Controllers;

use EasyWeChat\Foundation\Application;
use GuzzleHttp\Psr7\Request;
use Log;

class WechatController extends Controller
{
    private $wechat;

    public function __construct(Application $wechat)
    {
        $this->wechat = $wechat;
    }
    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {

        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $wechat = app('wechat');

        $wechat->server->setMessageHandler(function($message){
//            return 'http://liucheng.nat300.top/test';

            /*Log::info('location位置:' . $message->Latitude . $message->Longitude);
            if ($message->MsgType == 'EVENT'){
                if($message->EVENT == 'location'){
                    Log::info('location位置:' . $message->Latitude . $message->Longitude);
                }
            }*/
            switch ($message->MsgType) {
                case 'event':
                    return '收到事件消息';
                    break;
                case 'text':
                    //$text = new Text(['content' => '您好！overtrue。']);
                    $templateId = 'mbNYY_i4uwgLwVSCwAWzexI3ozpBBvAVQrxBI0FnYic';
                    $url = 'http://liucheng.nat300.top/api/detail/factory?factory_id=800080';
                    $data = [];

                    $userId = $message->FromUserName;
                    //return $userId;
                    $notice = $this->wechat->notice;
                    $result = $notice->uses($templateId)->withUrl($url)->andData($data)->andReceiver($userId)->send();

                    return '^_^';
                    break;
                case 'image':
                    return '收到图片消息';
                    break;
                case 'voice':
                    return '收到语音消息';
                    break;
                case 'video':
                    return '收到视频消息';
                    break;
                case 'location':
                    return '收到坐标消息';
                    break;
                case 'link':
                    return '收到链接消息';
                    break;
                // ... 其它消息
                default:
                    return '收到其它消息';
                    break;
            }
            return json_encode($message);
            return "欢迎关注 sdfsdfsdsdf！";
        });

        Log::info('return response.');

        return $wechat->server->serve();
    }
}