<?php

namespace pantera\crm\contacts\models;

use Yii;

/**
 * This is the model class for table "crm_contacts_params".
 *
 * @property int $id
 * @property int $group_id
 * @property string $name
 */
class Param extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%crm_contact_param}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'name'], 'required'],
            [['group_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['default_values'],'safe'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => ParamGroup::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_id' => 'Group ID',
            'name' => 'Name',
            'default_values' => 'Default values'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(ParamGroup::className(), ['id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientParamsRegistries()
    {
        return $this->hasMany(ParamRegistry::className(), ['param_id' => 'id']);
    }
}
