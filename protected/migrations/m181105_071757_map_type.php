<?php

use yii\db\Migration;

/**
 * Class m181105_071757_map_type
 */
class m181105_071757_map_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('map_type','model',$this->string('16')->notNull()->defaultValue('')->after('controller'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('map_type','model');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181105_071757_map_type cannot be reverted.\n";

        return false;
    }
    */
}
