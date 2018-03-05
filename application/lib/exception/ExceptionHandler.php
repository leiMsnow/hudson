<?php
/**
 * Created by PhpStorm.
 * User: wecash
 * Date: 04/03/2018
 * Time: 22:06
 */

namespace app\lib\exception;


use function config;
use Exception;
use function json;
use think\exception\Handle;
use think\facade\Config;
use think\facade\Request;
use think\facade\Log;

class ExceptionHandler extends Handle
{
    private $code;
    private $msg;
    private $errorCode;

    // 返回客户端请求的URL路径
    public function render(Exception $e)
    {
        if ($e instanceof BaseException) {
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;
        } else {

//            Config::get('app_debug');
            if (config('app_debug')) {
                return parent::render($e);
            } else {
                $this->code = 500;
                $this->msg = 'INTERNAL SERVER ERROR';
                $this->errorCode = 999;
                // 日志记录
                $this->recordErrorLog($e);
            }
        }

        $request = Request::instance();
        $result = [
            'msg' => $this->msg,
            'error_code' => $this->errorCode,
            'request_url' => $request->url()
        ];
        return json($result, $this->code);
    }

    private function recordErrorLog(Exception $e)
    {
        Log::init([
            'type' => 'File',
            'level' => ['error']
        ]);
        Log::record($e->getMessage(), 'error');
    }

}