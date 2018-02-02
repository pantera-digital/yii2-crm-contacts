<?php

use yii\db\Migration;

/**
 * Handles the creation of table `client_params`.
 * Has foreign keys to the tables:
 *
 * - `client_params_groups`
 */
class m170828_050225_create_client_params_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('client_params', [
            'id' => $this->primaryKey(),
            'group_id' => $this->integer()->notNull(),
            'name' => $this->string(255)->notNull(),
        ]);

        // creates index for column `group_id`
        $this->createIndex(
            'idx-client_params-group_id',
            'client_params',
            'group_id'
        );

        // add foreign key for table `client_params_groups`
        $this->addForeignKey(
            'fk-client_params-group_id',
            'client_params',
            'group_id',
            'client_params_groups',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `client_params_groups`
        $this->dropForeignKey(
            'fk-client_params-group_id',
            'client_params'
        );

        // drops index for column `group_id`
        $this->dropIndex(
            'idx-client_params-group_id',
            'client_params'
        );

        $this->dropTable('client_params');
    }
}
