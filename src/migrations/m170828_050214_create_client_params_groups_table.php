<?php

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
        $this->createTable('client_params_groups', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('client_params_groups');
    }
}
