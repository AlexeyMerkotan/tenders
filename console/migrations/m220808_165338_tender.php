<?php

use yii\db\Migration;

/**
 * Class m220808_165338_tender
 */
class m220808_165338_tender extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tender}}', [
            'id' => $this->primaryKey(),
            'tenderID' => $this->string(255)->notNull(),
            'description' => $this->text()->notNull(),
            'amount' => $this->float(),
            'dateModified' => $this->integer(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tender}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220808_165338_tender cannot be reverted.\n";

        return false;
    }
    */
}
