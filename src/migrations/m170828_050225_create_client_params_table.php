<?php

use pantera\crm\contacts\models\Param;
use pantera\crm\contacts\models\ParamGroup;
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
        $this->createTable(Param::tableName(), [
            'id' => $this->primaryKey(),
            'group_id' => $this->integer()->notNull(),
            'name' => $this->string(255)->notNull(),
        ]);

        // creates index for column `group_id`
        $this->createIndex(
            'idx-client_params-group_id',
                   Param::tableName(),
           'group_id'
        );

        // add foreign key for table `client_params_groups`
        $this->addForeignKey(
            'fk-client_params-group_id',
                   Param::tableName(),
            'group_id',
                    ParamGroup::tableName(),
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
            Param::tableName()
        );

        // drops index for column `group_id`
        $this->dropIndex(
            'idx-client_params-group_id',
            Param::tableName()
        );

        $this->dropTable(Param::tableName());
    }
}
