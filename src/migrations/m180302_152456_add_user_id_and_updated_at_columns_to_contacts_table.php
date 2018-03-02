<?php

use pantera\crm\contacts\models\Contact;
use yii\db\Migration;

/**
 * Handles adding user_id_and_updated_at to table `contacts`.
 */
class m180302_152456_add_user_id_and_updated_at_columns_to_contacts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(Contact::tableName(),'user_id',$this->integer()->null());
        $this->addColumn(Contact::tableName(),'updated_at', $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP on UPDATE CURRENT_TIMESTAMP'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(Contact::tableName(),'updated_at');
        $this->dropColumn(Contact::tableName(),'user_id');
    }
}
