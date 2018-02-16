<?php

namespace pantera\crm\contacts\controllers;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller as BaseController;
/**
 * ContactsController implements the CRUD actions for Contact model.
 */
class Controller extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => $this->module->permissions,
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulkdelete' => ['post'],
                ],
            ],
        ];
    }

}
