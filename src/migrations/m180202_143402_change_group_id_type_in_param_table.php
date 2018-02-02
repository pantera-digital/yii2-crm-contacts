<?php

use pantera\crm\contacts\models\Param;
use yii\db\Migration;

/**
 * Class m180202_143402_change_group_id_type_in_param_table
 */
class m180202_143402_change_group_id_type_in_param_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn(Param::tableName(),'group_id',$this->integer()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn(Param::tableName(),'group_id',$this->integer()->notNull());

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180202_143402_change_group_id_type_in_param_table cannot be reverted.\n";

        return false;
    }
    */
}
