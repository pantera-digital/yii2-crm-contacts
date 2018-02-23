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
 * @property  $clientParamsRegistries
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

    /**
    *   Возвращает человекопонятное название пола текущего контакта
    */
    public function getGenderName()
    {
        return $this->getGenders()[$this->gender];
    }

    /**
    *   Возвращает список полов
    */
    public function getGenders()
    {
        return [
            static::GENDER_NO => 'Не выбран',
            static::GENDER_MALE => 'Mужской',
            static::GENDER_FEMALE => 'Женский',
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
            [['Params'],'each', 'rule' =>  ['string']],
            [['birth_date','comment','created_at','gender'], 'safe'],
            [['first_name', 'last_name', 'middle_name'], 'string', 'max' => 255],
            [['phone', 'email'], 'string', 'max' => 50],
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
        $paramIds = array_keys($this->Params);
        if(!empty($paramIds)) {
            $params = Param::findAll($paramIds);
            foreach ($params as $param) {
                if(isset($this->Params[$param->id])) {
                    //Сохраним параметр в регистр
                    if($record = $this->getParamsRegistry()->where(['param_id' => $param->id])->one()) {
                        $record->value = $this->Params[$param->id];
                    } else {
                        $record = new ParamRegistry();
                        $record->user_id = Yii::$app->user->id ?: 0;
                        $record->contact_id = $this->id;
                        $record->param_id = $param->id;
                        $record->value = $this->Params[$param->id];
                    }
                    $record->save();
                }
            }
        }
    }

    /**
    *   Возвращает полное имя контакта, сформированное из имени и фамилии
    */
    public function getFullName()
    {
        return $this->last_name . ' ' . $this->first_name;
    }

    public function afterFind()
    {
        parent::afterFind(); // TODO: Change the autogenerated stub
        foreach (Param::find()->all() as $param) {
            if($record = $this->getParamsRegistry()->where(['param_id' => $param->id,'contact_id' => $this->id])->one()) {
                $this->Params[$param->id]  = $record->value;
            } else {
                $this->Params[$param->id] = null;
            }
        }

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParamsRegistry() {
        return $this->hasMany(ParamRegistry::className(),['contact_id' => 'id']);
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
            'gender' => 'Пол',
            'birth_date' => 'Дата рождения',
            'comment' => 'Примечание',
        ];
    }
}
