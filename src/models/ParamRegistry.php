<?php

namespace pantera\crm\contacts\models;

use dektrium\user\models\User;
use Yii;

/**
 * This is the model class for table "crm_contact_param_registry".
 *
 * @property int $id
 * @property int $client_id
 * @property int $param_id
 * @property int $value_int
 * @property string $value_varchar
 * @property string $value_decimal
 * @property string $value_date
 * @property resource $value_binary
 * @property string $value_text
 * @property string $created_at
 * @property string $updated_at
 * @property int $user_id
 *
 * @property ClientParams $param
 * @property User $user
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
            [['client_id', 'param_id', 'user_id'], 'required'],
            [['client_id', 'param_id', 'value_int', 'user_id'], 'integer'],
            [['value_decimal'], 'number'],
            [['value_date', 'created_at', 'updated_at'], 'safe'],
            [['value_binary', 'value_text'], 'string'],
            [['value_varchar'], 'string', 'max' => 255],
            [['param_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClientParams::className(), 'targetAttribute' => ['param_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client ID',
            'param_id' => 'Param ID',
            'value_int' => 'Value Int',
            'value_varchar' => 'Value Varchar',
            'value_decimal' => 'Value Decimal',
            'value_date' => 'Value Date',
            'value_binary' => 'Value Binary',
            'value_text' => 'Value Text',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
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
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
