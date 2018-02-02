<?php

namespace pantera\crm\contacts\models;

use Yii;

/**
 * This is the model class for table "crm_contacts".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property string $phone
 * @property string $e-mail
 * @property string $birth_date
 */
class Contact extends \yii\db\ActiveRecord
{
    public $Params = [];
    const GENDER_MALE = 'MALE';
    const GENDER_FEMALE = 'FEMALE';
    const GENDER_NO = 'NO';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%crm_contacts}}';
    }

    public function getGenderView(){
        return $this->getGenders()[$this->gender];
    }

    public function getGenders(){
        return [
            static::GENDER_NO => Yii::t('app','Не выбран'),
            static::GENDER_MALE => Yii::t('app','Mужской'),
            static::GENDER_FEMALE => Yii::t('app','Женский'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['first_name', 'required'],
            ['email', 'email'],
            [['email', 'phone'], 'unique'],
            [['birth_date','comment','created_at','gender'], 'safe'],
            [['first_name', 'last_name', 'middle_name'], 'string', 'max' => 255],
            [['phone', 'email'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'middle_name' => 'Отчество',
            'phone' => 'Телефон',
            'email' => 'E-mail',
            'gender' => Yii::t('app','Пол'),
            'genderView' => Yii::t('app','Пол'),
            'birth_date' => 'Дата рождения',
            'comment' => 'Примечание',
        ];
    }
}
