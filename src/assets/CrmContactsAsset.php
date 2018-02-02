<?php

namespace pantera\crm\contacts\assets;

use yii\web\AssetBundle;

class CrmContactsAsset extends AssetBundle
{
    public $depends = [];

    public $js = [
        'script.js',
    ];

    public $css = [
        'style.css',
    ];

    public function init()
    {
        $this->sourcePath = __DIR__;
        parent::init();
    }
}
