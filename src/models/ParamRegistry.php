<?php

namespace pantera\crm\contacts\models;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "crm_contact_param_registry".
 *
 * @property int $id
 * @property int $contact_id
 * @property int $param_id
 * @property int $value_int
 * @property int $user_id
 *
 * @property Param $param
 * @property ActiveRecord $user
 */
class ParamRegistry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%crm_contact_param_registry}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contact_id', 'param_id', 'user_id'], 'required'],
            [['contact_id', 'param_id'], 'unique', 'attribute' => ['param_id', 'contact_id']],
            [['value'], 'safe'],
            [['contact_id', 'param_id', 'value_int', 'user_id'], 'integer'],
            [['contact_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contact::className(), 'targetAttribute' => ['contact_Id' => 'id']],
            [['param_id'], 'exist', 'skipOnError' => true, 'targetClass' => Param::className(), 'targetAttribute' => ['param_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Yii::$app->getModule('user')->userModel->className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ИД',
            'client_id' => 'Контакт',
            'param_id' => 'Параметр',
            'value' => 'Значение',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParam()
    {
        return $this->hasOne(Param::className(), ['id' => 'param_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Yii::$app->getModule('user')->userModel->className(), ['id' => 'user_id']);
    }
}
