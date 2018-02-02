<?php

use yii\db\Migration;

class m170906_133815_init_contacts_schema_table extends Migration
{
    public function up()
    {
        $this->createTable('{{crm_contacts}}',[
           'id' => $this->primaryKey(),
           'first_name' => $this->string(255),
           'last_name' => $this->string(255),
           'middle_name' => $this->string(255),
           'phone' => $this->string(50),
           'email' => $this->string(50),
           'birth_date' => $this->date(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{crm_contacts}}');
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
