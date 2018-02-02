<?php

use pantera\crm\contacts\models\ParamGroup;
use yii\db\Migration;

/**
 * Handles the creation of table `client_params_groups`.
 */
class m170828_050214_create_client_params_groups_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable(ParamGroup::tableName(), [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable(ParamGroup::tableName());
    }
}
