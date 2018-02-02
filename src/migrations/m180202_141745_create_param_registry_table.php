<?php

use pantera\crm\contacts\models\ParamRegistry;
use yii\db\Migration;

/**
 * Handles the creation of table `param_registry`.
 */
class m180202_141745_create_param_registry_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(ParamRegistry::tableName(), [
            'id' => $this->primaryKey(),
            'param_id' => $this->integer()->notNull(),
            'value' => $this->text()->null(),
            'contact_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(ParamRegistry::tableName());
    }
}
