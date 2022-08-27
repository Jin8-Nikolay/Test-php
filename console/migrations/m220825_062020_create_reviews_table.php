<?php

use yii\db\Migration;

/**
 * Class m220825_062020_reviews
 */
class m220825_062020_create_reviews_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('reviews', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'text' => $this->text()->notNull(),
            'date' => $this->dateTime(),
            'author' => $this->integer()->notNull(),
        ]);
        $this->createIndex(
            'idx_reviews-author',
            'reviews',
            'author'
        );
        $this->addForeignKey(
            'fk_reviews-author',
            'reviews',
            'author',
            'user',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_reviews-author',
            'reviews'
        );

        $this->dropIndex(
            'idx_reviews-author',
            'reviews'
        );

        $this->dropTable('reviews');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220825_062020_reviews cannot be reverted.\n";

        return false;
    }
    */
}
