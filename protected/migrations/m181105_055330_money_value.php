<?php

use yii\db\Migration;

/**
 * Class m181105_055330_money_value
 */
class m181105_055330_money_value extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('money','map_id',$this->integer()->unsigned()->null()->after('user_id'));
        $this->addColumn('currency','weight',$this->smallInteger()->unsigned()->notNull()->defaultValue(0)->after('course'));
        $this->addForeignKey('fk_money_map','money','map_id','map','map_id','CASCADE','CASCADE');
        $this->addColumn('price','level',$this->smallInteger()->unsigned()->null()->after('object_id'));
        $this->addColumn('map_type','level_max',$this->smallInteger()->unsigned()->notNull()->defaultValue(1)->after('markup_max'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181105_055330_money_value cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181105_055330_money_value cannot be reverted.\n";

        return false;
    }
    */
}
