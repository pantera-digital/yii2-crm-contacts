<?php

use common\modules\crm\models\CrmContacts;
use pantera\crm\contacts\models\Contact;
use yii\db\Migration;

/**
 * Class m180115_151751_add_column_gender_to_crm_contacts_table
 */
class m180115_151751_add_column_gender_to_crm_contacts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn(Contact::tableName(),'gender', "ENUM('NO','MALE','FEMALE') NOT NULL DEFAULT 'NO'");
        $this->alterColumn(Contact::tableName(),'created_at',$this->timestamp()->notNull()->defaultExpression("CURRENT_TIMESTAMP"));

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn(Contact::tableName(),'gender');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180115_151751_add_column_gender_to_crm_contacts_table cannot be reverted.\n";

        return false;
    }
    */
}
