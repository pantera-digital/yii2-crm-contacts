<?php

use common\modules\crm\models\eav\ClientParams;
use pantera\crm\contacts\models\Contact;
use yii\db\Migration;

/**
 * Class m180116_160807_add_column_default_values_to_client_params_table
 */
class m180116_160807_add_column_default_values_to_client_params_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn(Contact::tableName(),'default_values',$this->text()->null());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn(Contact::tableName(),'default_values');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180116_160807_add_column_default_values_to_client_params_table cannot be reverted.\n";

        return false;
    }
    */
}
