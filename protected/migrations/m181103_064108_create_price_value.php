<?php

use yii\db\Migration;

/**
 * Class m181103_064108_create_price_value
 */
class m181103_064108_create_price_value extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('price_value',[
            'price_value_id' => $this->primaryKey()->unsigned(),
            'price_id' => $this->integer()->unsigned()->notNull(),
            'currency_id' => $this->integer()->unsigned()->notNull(),
            'value' => $this->integer()->notNull(),
            'status' => 'enum("active","blocked","deleted") default "active"',
            'changed' => $this->timestamp(),
        ]);
        $this->addForeignKey('fk_price_value_price','price_value','price_id','price','price_id','CASCADE','CASCADE');
        $this->addForeignKey('fk_price_value_currency','price_value','currency_id','currency','currency_id','CASCADE','CASCADE');
        $this->dropForeignKey('fk_price_currency_id','price');
        $this->dropColumn('price','currency_id');
        $this->dropColumn('price','value');
        $this->addColumn('price','action',$this->string(16)->after('price_id')->notNull());
        $this->alterColumn('price','object_type',$this->string(16)->notNull()->after('action'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181103_064108_create_price_value cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181103_064108_create_price_value cannot be reverted.\n";

        return false;
    }
    */
}
