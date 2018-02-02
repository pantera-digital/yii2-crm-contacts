<?php

use pantera\crm\contacts\models\ParamGroup;
use pantera\crm\contacts\models\Param;
use pantera\crm\contacts\models\Contact;
use pantera\crm\contacts\models\ParamRegistry;
use yii\db\Migration;

/**
 * Class m000000_000000_crm_contacts_initial_migration
 */
class m000000_000000_crm_contacts_initial_migration extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /////////////////////////////////////////
        $this->createTable(ParamGroup::tableName(), [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
        ]);

        /////////////////////////////////////////
        $this->createTable(Param::tableName(), [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'group_id' => $this->integer()->null(),
            'default_values' => $this->text()->null(),
        ]);

        // creates index for column `group_id`
        $this->createIndex(
            'idx-contact_param-group_id',
            Param::tableName(),
           'group_id'
        );

        // add foreign key for table `contact_param`
        $this->addForeignKey(
            'fk-contact_param-group_id',
            Param::tableName(),
            'group_id',
            ParamGroup::tableName(),
            'id',
            'CASCADE'
        );

        /////////////////////////////////////////
        $this->createTable(Contact::tableName(), [
           'id' => $this->primaryKey(),
           'first_name' => $this->string(255),
           'last_name' => $this->string(255),
           'middle_name' => $this->string(255),
           'phone' => $this->string(50),
           'email' => $this->string(50),
           'birth_date' => $this->date(),
           'gender' => "ENUM('NO','MALE','FEMALE') NOT NULL DEFAULT 'NO'",
           'comment' => $this->text()->null(),
           'created_at' => $this->timestamp()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
        ]);

        /////////////////////////////////////////
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

        /////////////////////////////////////////
        $this->dropTable(ParamRegistry::tableName());

        /////////////////////////////////////////
        $this->dropTable(Contact::tableName());

        // drops foreign key for table `contact_param`
        $this->dropForeignKey(
            'fk-contact_param-group_id',
            Param::tableName()
        );

        /////////////////////////////////////////
        // drops index for column `group_id`
        $this->dropIndex(
            'idx-contact_param-group_id',
            Param::tableName()
        );

        $this->dropTable(Param::tableName());

        /////////////////////////////////////////
        $this->dropTable(ParamGroup::tableName());
    }
}
