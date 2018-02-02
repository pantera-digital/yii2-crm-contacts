<?php

namespace pantera\crm\contacts;

use yii\base\Application;
use yii\web\View;

class Bootstrap implements \yii\base\BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->on(Application::EVENT_BEFORE_REQUEST, function () use ($app) {
            $app->getView()->on(View::EVENT_BEGIN_PAGE, function($e){
            	\pantera\crm\contacts\assets\CrmContactsAsset::register($e->sender);
            });
        });
    }
}
