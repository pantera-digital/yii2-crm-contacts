<?php

namespace pantera\crm\contacts\models;

use Yii;

/**
 * This is the model class for table "crm_contact_param_group".
 *
 * @property int $id
 * @property string $name
 *
 */
class ParamGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%crm_contact_param_group}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientParams()
    {
        return $this->hasMany(ClientParams::className(), ['group_id' => 'id']);
    }
}
