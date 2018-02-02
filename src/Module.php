<?php

namespace pantera\crm\contacts;

use Codeception\Exception\ConfigurationException;

class Module extends \yii\base\Module
{
    public $userModel = null;

    public function init()
    {
        parent::init();
        if(empty($this->userModel)) {
            throw new ConfigurationException('Пожалуйста, укажите модель пользователя в настройках модуля. Деректива userModel.');
        }
    }
}
