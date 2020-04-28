<?php

/**
 * Handles the creation of table `{{%record}}`.
 */
class m200317_063840_create_record_table extends console\migrations\BaseMigration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%record}}', [
            'id' => $this->primaryKey(),
            'location' => $this->string()->notNull(),
            'data' => $this->text()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%record}}');
    }
}
