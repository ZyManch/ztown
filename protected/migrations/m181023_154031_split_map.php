<?php

use yii\db\Migration;

/**
 * Class m181023_154031_split_map
 */
class m181023_154031_split_map extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('map','land_type_id',$this->integer()->unsigned()->notNull()->after('map_id'));
        $this->addForeignKey(
            'fk_map_land_type_id',
            'map',
            'land_type_id',
            'map_type',
            'map_type_id',
            'CASCADE',
            'CASCADE'
        );
        $this->alterColumn('map','map_type_id',$this->integer()->unsigned()->null());
        $this->renameColumn('currency','default','default_course');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_map_land_type_id','map');
        $this->dropColumn('map','land_type_id');
        $this->alterColumn('map','map_type_id',$this->integer()->unsigned()->notNull());
        $this->renameColumn('currency','default_course','default');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181023_154031_split_map cannot be reverted.\n";

        return false;
    }
    */
}
