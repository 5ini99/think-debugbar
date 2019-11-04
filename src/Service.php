<?php

namespace think\debugbar;

use think\debugbar\controller\AssetController;
use think\debugbar\middleware\InjectDebugbar;
use think\Route;

class Service extends \think\Service
{
    public function boot()
    {
        // 当非 ajax 请求环境时开启调试信息追加【byron sampson 2019-11-04】
        if (!$this->app->request->isAjax()) {
            $this->app->middleware->add(InjectDebugbar::class);
        }
        $this->registerRoutes(function (Route $route) {
            $route->get("debugbar/:path", AssetController::class . "@index")->pattern(['path' => '[\w\.\/\-_]+']);
        });
    }
}
