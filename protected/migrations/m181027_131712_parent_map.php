<?php

use yii\db\Migration;

/**
 * Class m181027_131712_parent_map
 */
class m181027_131712_parent_map extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('map','parent_map_id',$this->integer()->unsigned()->null()->defaultValue(null)->after('map_id'));
        $this->addColumn('map_type','build_type_id',$this->integer()->unsigned()->null()->defaultValue(null)->after('markup_max'));
        $this->addColumn('map_type','image',$this->string('32')->notNull()->after('map_type_id'));
        $this->addForeignKey(
            'fk_map_type_build_type_id',
            'map_type',
            'build_type_id',
            'map_type',
            'map_type_id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_map_parent_map_id',
            'map',
            'parent_map_id',
            'map',
            'map_id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('map','parent_map_id');
        $this->dropColumn('map_type','build_type_id');
        $this->dropColumn('map_type','image');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181027_131712_parent_map cannot be reverted.\n";

        return false;
    }
    */
}
