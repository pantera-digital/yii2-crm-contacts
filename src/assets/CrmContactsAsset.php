<?php

namespace pantera\crm\contacts\assets;

use yii\web\AssetBundle;

class CrmContactsAsset extends AssetBundle
{
    public $depends = [];

    public $js = [
        'crm-contacts.js',
    ];

    public $css = [
        'crm-contacts.css',
    ];

    public function init()
    {
        $this->sourcePath = __DIR__;
        parent::init();
    }
}
