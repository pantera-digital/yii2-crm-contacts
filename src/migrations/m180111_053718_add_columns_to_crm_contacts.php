<?php
use pantera\crm\contacts\models\Contact;
use yii\db\Migration;

class m180111_053718_add_columns_to_crm_contacts extends Migration
{
    public function up()
    {
        $this->addColumn(Contact::tableName(),'created_at',$this->timestamp()->notNull()->defaultExpression("0"));
        $this->addColumn(Contact::tableName(),'comment',$this->text()->null());
    }

    public function down()
    {
        $this->dropColumn(Contact::tableName(),'created_at');
        $this->dropColumn(Contact::tableName(),'comment');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
