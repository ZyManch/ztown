<?php

use yii\db\Migration;

/**
 * Class m181105_120120_construction_type
 */
class m181105_120120_construction_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('map_type','main_type_id',$this->integer()->unsigned()->null()->after('build_type_id'));
        $this->addForeignKey('fk_map_type_main_type','map_type','main_type_id','map_type','map_type_id','CASCADE','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('map_type','main_type_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181105_120120_construction_type cannot be reverted.\n";

        return false;
    }
    */
}
