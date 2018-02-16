<?php

namespace pantera\crm\contacts;

use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;

class Module extends \yii\base\Module
{
    /**
     * @property ActiveRecord|null $userModel
     * Обязательная для заполнения модель пользователя.
     */
    public $userModel = null;

    /**
     * @property string $defaultRoute
     * Дефолтный экшен - грид контактов
     */
    public $defaultRoute = 'contacts/index';

    /**
     * @var array $permissions
     * Переменная будет оперировать доступом к контроллерам модуля
     */
    public $permissions = [];


    /**
     * @throws ConfigurationException
     */
    public function init()
    {
        parent::init();
        if(empty($this->userModel)) {
            throw new InvalidConfigException('Пожалуйста, укажите модель пользователя в настройках модуля. Деректива userModel.');
        }
    }
}
