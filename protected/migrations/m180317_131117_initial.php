<?php

use yii\db\Migration;

/**
 * Class m180317_131117_initial
 */
class m180317_131117_initial extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $addedTables = [];
        $tables = $this->_getTables();
        while ($tables) {
            foreach ($tables as $tableName => $columns) {
                $foreigns = [];
                if (isset($columns['foreigns'])) {
                    $foreigns = $columns['foreigns'];
                    unset($columns['foreigns']);
                }
                $allow = true;
                foreach ($foreigns as $foreign) {
                    if ($tableName!==$foreign['table'] && !in_array($foreign['table'], $addedTables)) {
                        $allow = false;
                    }
                }
                if ($allow) {
                    unset($tables[$tableName]);
                    $this->createTable($tableName, $columns);
                    foreach ($foreigns as $foreign) {
                        $this->addForeignKey(
                            'fk_'.$tableName.'_'.$foreign['from'],
                            $tableName,
                            $foreign['from'],
                            $foreign['table'],
                            $foreign['to'],
                            isset($foreign['delete']) ? $foreign['delete'] : 'CASCADE',
                            isset($foreign['update']) ? $foreign['update'] : 'CASCADE'
                        );
                    }
                    $addedTables[] = $tableName;
                }
            }
        }
        foreach ($this->_getData() as $table => $datas) {
            foreach ($datas as $data) {
                $this->insert($table,$data);
            }
        }
        $this->execute('update map_type set map_type_id=0 where name="Свободная площадка"');
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $deletedTables = [];
        $tables = $this->_getTables();
        while ($tables) {
            foreach ($tables as $tableName => $columns) {
                $foreigns = [];
                if (isset($columns['foreigns'])) {
                    $foreigns = $columns['foreigns'];
                    unset($columns['foreigns']);
                }
                $allow = true;
                foreach ($foreigns as $foreign) {
                    if ($tableName!==$foreign['table'] && !in_array($foreign['table'], $deletedTables)) {
                        $allow = false;
                    }
                }
                if ($allow) {
                    unset($tables[$tableName]);
                    $this->dropTable($tableName);
                    $deletedTables[] = $tableName;
                }
            }
        }
    }

    protected function _getTables() {
        return [
            'animal' => [
                'animal_id' => $this->primaryKey()->unsigned(),
                'level' => $this->smallInteger()->unsigned()->notNull()->defaultValue(1),
                'stat_id' => $this->integer()->unsigned()->notNull(),
                'name' => $this->string(32)->notNull(),
                'type' => $this->string(5)->notNull(),
                'content' => $this->string(128)->null(),
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
                'foreigns' => [
                    ['table'=>'stat','from'=>'stat_id','to'=>'stat_id']
                ]
            ],
            'arena' => [
                'arena_id' => $this->primaryKey()->unsigned(),
                'user_id' => $this->integer()->unsigned()->notNull(),
                'level' => $this->smallInteger()->unsigned()->notNull()->defaultValue(1),
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
                'foreigns' => [
                    ['table'=>'user','from'=>'user_id','to'=>'user_id']
                ]
            ],
            'army' => [
                'army_id' => $this->primaryKey()->unsigned(),
                'parent_id' => $this->integer()->unsigned()->notNull(),
                'stat' => $this->integer()->unsigned()->notNull(),
                'name' => $this->string(32)->notNull(),
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
            ],
            'army_name' => [
                'army_name_id' => $this->primaryKey()->unsigned(),
                'position' => $this->integer()->unsigned()->notNull(),
                'type' => 'enum(\'works\',\'mafia\',\'bisiness\')',
                'name' => $this->string(16)->notNull(),
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
            ],
            'avatar' => [
                'avatar_id' => $this->primaryKey()->unsigned(),
                'position' => $this->integer()->unsigned()->notNull(),
                'filename' => $this->string(32)->notNull(),
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
            ],
            'battle_army' => [
                'battle_army_id' => $this->primaryKey()->unsigned(),
                'parent_id' => $this->integer()->unsigned()->notNull(),
                'battle_id' => $this->integer()->unsigned()->notNull(),
                'stat' => $this->integer()->unsigned()->notNull(),
                'name' => $this->string(32)->notNull(),
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
                'foreigns' => [
                    ['table'=>'battle','from'=>'battle_id','to'=>'battle_id']
                ]
            ],
            'battle_attack' => [
                'battle_attack_id' => $this->primaryKey()->unsigned(),
                'battle_id' => $this->integer()->unsigned()->notNull(),
                'from_user_id' => $this->integer()->unsigned()->notNull(),
                'to_user_id' => $this->integer()->unsigned()->notNull(),
                'step' => $this->integer()->unsigned()->notNull(),
                'text' => $this->integer()->unsigned()->notNull(),
                'power' => $this->integer()->unsigned()->notNull(),
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
                'foreigns' => [
                    ['table'=>'battle','from'=>'battle_id','to'=>'battle_id'],
                    ['table'=>'user','from'=>'from_user_id','to'=>'user_id'],
                    ['table'=>'user','from'=>'to_user_id','to'=>'user_id'],
                ]
            ],
            'battle_prize' => [
                'battle_prize_id' => $this->primaryKey()->unsigned(),
                'battle_id' => $this->integer()->unsigned()->notNull(),
                'user_id' => $this->integer()->unsigned()->notNull(),
                'prize_id' => $this->integer()->unsigned()->notNull(),
                'prize_type' => 'enum("money","exp","roof") not null',
                'value' => $this->integer()->unsigned()->notNull(),
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
                'foreigns' => [
                    ['table'=>'battle','from'=>'battle_id','to'=>'battle_id'],
                    ['table'=>'user','from'=>'user_id','to'=>'user_id'],
                ]
            ],
            'battle' => [
                'battle_id' => $this->primaryKey()->unsigned(),
                'win_side' => 'enum("left","right") not null',
                'hash' => $this->string('32')->notNull(),
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
            ],
            'battle_user' => [
                'battle_user_id' => $this->primaryKey()->unsigned(),
                'battle_id' => $this->integer()->unsigned()->notNull(),
                'user_id' => $this->integer()->unsigned()->notNull(),
                'stat_id' => $this->integer()->unsigned()->notNull(),
                'side' => 'enum("left","right") not null',
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
                'foreigns' => [
                    ['table'=>'battle','from'=>'battle_id','to'=>'battle_id'],
                    ['table'=>'user','from'=>'user_id','to'=>'user_id'],
                    ['table'=>'stat','from'=>'stat_id','to'=>'stat_id'],
                ]
            ],
            'course' => [
                'course_id' => $this->primaryKey()->unsigned(),
                'currency_id' => $this->integer()->unsigned()->notNull(),
                'price' => $this->decimal(6,2)->unsigned()->notNull(),
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
                'foreigns' => [
                    ['table'=>'currency','from'=>'currency_id','to'=>'currency_id'],
                ]
            ],
            'currency' => [
                'currency_id' => $this->primaryKey()->unsigned(),
                'title' => $this->string(32)->notNull(),
                'ext' => $this->string(16)->notNull(),
                'color' => $this->string(6)->notNull(),
                'type' => $this->string(10)->notNull(),
                'level' => $this->integer()->unsigned()->notNull(),
                'default' => $this->integer()->unsigned()->notNull(),
                'course' => $this->decimal(6,2)->unsigned()->notNull(),
                'fixed_valute' => 'enum("yes","no") default "yes"',
                'can_buy' => 'enum("yes","no") default "no"',
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
            ],
            'error' => [
                'error_id' => $this->primaryKey()->unsigned(),
                'user_id' => $this->integer()->unsigned()->notNull(),
                'page' => $this->string(64)->notNull(),
                'content' => $this->string(256),
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
                'foreigns' => [
                    ['table'=>'user','from'=>'user_id','to'=>'user_id'],
                ]
            ],
            'forum' => [
                'forum_id' => $this->primaryKey()->unsigned(),
                'parent_id' => $this->integer()->unsigned()->notNull(),
                'title' => $this->string(64)->notNull(),
                'user_id' => $this->integer()->unsigned()->notNull(),
                'group_id' => $this->integer()->unsigned()->notNull(),
                'updated' => $this->integer()->unsigned()->notNull(),
                'visibled' => 'enum("yes","no") default "no"',
                'enabled' => 'enum("yes","no") default "no"',
                'is_topic' => 'enum("yes","no") default "no"',
                'position' =>  $this->integer()->unsigned()->notNull(),
                'topics' =>  $this->integer()->unsigned()->notNull(),
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
                'foreigns' => [
                    ['table'=>'forum','from'=>'parent_id','to'=>'forum_id'],
                    ['table'=>'user','from'=>'user_id','to'=>'user_id'],
                    ['table'=>'group','from'=>'group_id','to'=>'group_id'],
                ]
            ],
            'friend' => [
                'friend_id' => $this->primaryKey()->unsigned(),
                'first_user_id' => $this->integer()->unsigned()->notNull(),
                'second_user_id' => $this->integer()->unsigned()->notNull(),
                'type' => 'enum(\'friend\',\'family\')',
                'is_confirmed' => 'enum("yes","no") default "no"',
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
                'foreigns' => [
                    ['table'=>'user','from'=>'first_user_id','to'=>'user_id'],
                    ['table'=>'user','from'=>'second_user_id','to'=>'user_id'],
                ]
            ],
            'group_query' => [
                'group_query_id' => $this->primaryKey()->unsigned(),
                'author_id' => $this->integer()->unsigned()->notNull(),
                'user_id' => $this->integer()->unsigned()->notNull(),
                'group_id' => $this->integer()->unsigned()->notNull(),
                'date' => $this->timestamp()->defaultExpression('null')->null(),
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
                'foreigns' => [
                    ['table'=>'user','from'=>'author_id','to'=>'user_id'],
                    ['table'=>'user','from'=>'user_id','to'=>'user_id'],
                    ['table'=>'group','from'=>'group_id','to'=>'group_id'],
                ]
            ],
            'group' => [
                'group_id' => $this->primaryKey()->unsigned(),
                'name' => $this->string(32)->notNull(),
                'lower_name' => $this->string(32)->notNull(),
                'mens' => $this->integer()->unsigned()->notNull(),
                'taked' => $this->integer()->unsigned()->notNull(),
                'balls' => $this->integer()->unsigned()->notNull(),
                'can_take' => $this->integer()->unsigned()->notNull(),
                'type' => 'enum(\'works\',\'mafia\',\'bisiness\')',
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
            ],
            'house' => [
                'house_id' => $this->primaryKey()->unsigned(),
                'map_id' => $this->integer()->unsigned()->notNull(),
                'user_id' => $this->integer()->unsigned()->notNull(),
                'last_pay' => $this->timestamp()->null()->defaultExpression('null'),
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
                'foreigns' => [
                    ['table'=>'user','from'=>'user_id','to'=>'user_id'],
                    ['table'=>'map','from'=>'map_id','to'=>'map_id'],
                ]
            ],
            'income' => [
                'income_id' => $this->primaryKey()->unsigned(),
                'source_type' => $this->string(6)->notNull(),
                'source_id' => $this->integer()->unsigned()->notNull(),
                'map_type_id' => $this->integer()->unsigned()->notNull(),
                'currency_id' => $this->integer()->unsigned()->notNull(),
                'income_type' => $this->string(8)->notNull(),
                'value' => $this->integer()->notNull()->unsigned(),
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
                'foreigns' => [
                    ['table'=>'map_type','from'=>'map_type_id','to'=>'map_type_id'],
                    ['table'=>'currency','from'=>'currency_id','to'=>'currency_id'],
                ]
            ],
            'item_buied' => [
                'item_buied_id' => $this->primaryKey()->unsigned(),
                'item_id' => $this->integer()->unsigned()->notNull(),
                'user_id' => $this->integer()->unsigned()->notNull(),
                'stat_id' => $this->integer()->unsigned()->notNull(),
                'used' => 'enum("yes","no") default "no"',
                'level' => $this->integer()->notNull()->unsigned(),
                'light' => 'enum(\'standart\',\'advansed\',\'vip\',\'gold\')',
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
                'foreigns' => [
                    ['table'=>'item','from'=>'item_id','to'=>'item_id'],
                    ['table'=>'user','from'=>'user_id','to'=>'user_id'],
                    ['table'=>'stat','from'=>'stat_id','to'=>'stat_id'],
                ]
            ],
            'item_opened' => [
                'item_opened_id' => $this->primaryKey()->unsigned(),
                'item_id' => $this->integer()->unsigned()->notNull(),
                'user_id' => $this->integer()->unsigned()->notNull(),
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
                'foreigns' => [
                    ['table'=>'item','from'=>'item_id','to'=>'item_id'],
                    ['table'=>'user','from'=>'user_id','to'=>'user_id'],
                ]
            ],
            'item' => [
                'item_id' => $this->primaryKey()->unsigned(),
                'name' => $this->string(24)->notNull(),
                'type' => 'enum(\'glass\',\'helmet\',\'weapon\',\'gloves\',\'dress\',\'bots\',\'necklace\',\'ring\')',
                'group' => $this->integer()->unsigned()->notNull(),
                'delonuse' => $this->integer()->unsigned()->notNull(),
                'stat_id' => $this->integer()->unsigned()->notNull(),
                'level' => $this->integer()->unsigned()->notNull(),
                'selling' => 'enum("shop","shop_opened","never") default "never"',
                'content' => $this->text(),
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
                'foreigns' => [
                    ['table'=>'stat','from'=>'stat_id','to'=>'stat_id'],
                ]
            ],
            'mafia_info' => [
                'mafia_info_id' => $this->primaryKey()->unsigned(),
                'group_id' => $this->integer()->unsigned()->notNull(),
                'map_id' => $this->integer()->unsigned()->notNull(),
                'user_id' => $this->integer()->unsigned()->notNull(),
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
                'foreigns' => [
                    ['table'=>'group','from'=>'group_id','to'=>'group_id'],
                    ['table'=>'map','from'=>'map_id','to'=>'map_id'],
                    ['table'=>'user','from'=>'user_id','to'=>'user_id'],
                ]
            ],
            'map' => [
                'map_id' => $this->primaryKey()->unsigned(),
                'map_type_id' => $this->integer()->unsigned()->notNull(),
                'x' => $this->integer()->unsigned()->notNull(),
                'y' => $this->integer()->unsigned()->notNull(),
                'user_id' => $this->integer()->unsigned()->notNull(),
                'street_id' => $this->integer()->unsigned()->null()->defaultExpression('null'),
                'roof_id' => $this->integer()->unsigned()->null()->defaultExpression('null'),
                'house' => $this->integer()->unsigned()->null()->defaultExpression('null'),
                'last_sell' => $this->integer()->unsigned()->notNull()->defaultValue(0),
                'param2' => $this->integer()->unsigned()->notNull(),
                'level' => $this->integer()->unsigned()->notNull()->defaultValue(1),
                'markup' => $this->decimal(4,2)->unsigned()->notNull(),
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
                'foreigns' => [
                    ['table'=>'user','from'=>'user_id','to'=>'user_id'],
                    ['table'=>'map_type','from'=>'map_type_id','to'=>'map_type_id'],
                    ['table'=>'street','from'=>'street_id','to'=>'street_id'],
                    ['table'=>'user','from'=>'roof_id','to'=>'user_id'],
                ]
            ],
            'map_type' => [
                'map_type_id' => $this->primaryKey()->unsigned(),
                'name' => $this->string(32)->notNull(),
                'controller' => $this->string(8)->notNull(),
                'info' => $this->text()->notNull(),
                'params' => $this->text()->notNull(),
                'markup_max' => $this->tinyInteger()->unsigned()->notNull(),
                'can_build' => 'enum("yes","no") default "no"',
                'can_take' => 'enum("yes","no") default "no"',
                'type' => 'enum("nature","road","surface","house") default "house"',
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
            ],
            'map_work' => [
                'map_work_id' => $this->primaryKey()->unsigned(),
                'map_id' => $this->integer()->unsigned()->notNull(),
                'work_id' => $this->integer()->unsigned()->notNull(),
                'count' => $this->integer()->unsigned()->notNull(),
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
                'foreigns' => [
                    ['table'=>'map','from'=>'map_id','to'=>'map_id'],
                    ['table'=>'work','from'=>'work_id','to'=>'work_id'],
                ]
            ],
            'message' => [
                'message_id' => $this->primaryKey()->unsigned(),
                'user_first_id' => $this->integer()->unsigned()->notNull(),
                'user_second_id' => $this->integer()->unsigned()->notNull(),
                'title' => $this->string(32)->null(),
                'content' => $this->text()->notNull(),
                'created' => $this->timestamp()->null()->defaultExpression('null'),
                'readed' => 'enum("yes","no") default "no"',
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
                'foreigns' => [
                    ['table'=>'user','from'=>'user_first_id','to'=>'user_id'],
                    ['table'=>'user','from'=>'user_second_id','to'=>'user_id'],
                ]
            ],
            'money' => [
                'money_id' => $this->primaryKey()->unsigned(),
                'user_id' => $this->integer()->unsigned()->notNull(),
                'currency_id' => $this->integer()->unsigned()->notNull(),
                'value' => $this->integer()->unsigned()->notNull(),
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
                'foreigns' => [
                    ['table'=>'user','from'=>'user_id','to'=>'user_id'],
                    ['table'=>'currency','from'=>'currency_id','to'=>'currency_id'],
                ]
            ],
            'oauth' => [
                'oauth_id' => $this->primaryKey()->unsigned(),
                'user_id' => $this->integer()->unsigned()->notNull(),
                'server' => $this->string(8)->notNull(),
                'remote_user_id' => $this->string(10)->notNull(),
                'access_token' => $this->string(64)->notNull(),
                'access_secret' => $this->string(64)->notNull(),
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
                'foreigns' => [
                    ['table'=>'user','from'=>'user_id','to'=>'user_id'],
                ]
            ],
            'price' => [
                'price_id' => $this->primaryKey()->unsigned(),
                'object_type' => $this->string(5)->notNull(),
                'object_id' => $this->integer()->unsigned()->notNull(),
                'currency_id' => $this->integer()->unsigned()->notNull(),
                'value' => $this->integer()->unsigned()->notNull(),
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
                'foreigns' => [
                    ['table'=>'currency','from'=>'currency_id','to'=>'currency_id'],
                ]
            ],
            'report' => [
                'report_id' => $this->primaryKey()->unsigned(),
                'title' => $this->string(16)->notNull(),
                'user_first_id' => $this->integer()->unsigned()->notNull(),
                'user_second_id' => $this->integer()->unsigned()->notNull(),
                'money' => $this->integer()->unsigned()->notNull(),
                'date' => $this->timestamp()->defaultExpression('null')->null(),
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
                'foreigns' => [
                    ['table'=>'user','from'=>'user_first_id','to'=>'user_id'],
                    ['table'=>'user','from'=>'user_second_id','to'=>'user_id'],
                ]
            ],
            'smile' => [
                'smile_id' => $this->primaryKey()->unsigned(),
                'file' => $this->string(16)->notNull(),
                'bbcode' => $this->string(16)->notNull(),
                'visible' => 'enum("yes","no") default "yes"',
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
            ],
            'stat' => [
                'stat_id' => $this->primaryKey()->unsigned(),
                'stat1' => $this->integer()->unsigned()->defaultValue(0),
                'stat2' => $this->integer()->unsigned()->defaultValue(0),
                'stat3' => $this->integer()->unsigned()->defaultValue(0),
                'stat4' => $this->integer()->unsigned()->defaultValue(0),
                'stat5' => $this->integer()->unsigned()->defaultValue(0),
                'stat6' => $this->integer()->unsigned()->defaultValue(0),
                'bonus1' => $this->integer()->unsigned()->defaultValue(0),
                'bonus2' => $this->integer()->unsigned()->defaultValue(0),
                'bonus3' => $this->integer()->unsigned()->defaultValue(0),
                'bonus4' => $this->integer()->unsigned()->defaultValue(0),
                'bonus5' => $this->integer()->unsigned()->defaultValue(0),
                'bonus6' => $this->integer()->unsigned()->defaultValue(0),
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
            ],
            'street' => [
                'street_id' => $this->primaryKey()->unsigned(),
                'name' => $this->string(64)->notNull(),
                'left_x' => $this->integer()->unsigned()->notNull(),
                'right_x' => $this->integer()->unsigned()->notNull(),
                'top_y' => $this->integer()->unsigned()->notNull(),
                'bottom_y' => $this->integer()->unsigned()->notNull(),
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
            ],
            'topic' => [
                'topic_id' => $this->primaryKey()->unsigned(),
                'user_id' => $this->integer()->unsigned(),
                'forum_id' => $this->integer()->unsigned(),
                'content' => $this->text()->notNull(),
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
                'foreigns' => [
                    ['table'=>'user','from'=>'user_id','to'=>'user_id'],
                    ['table'=>'forum','from'=>'forum_id','to'=>'forum_id'],
                ]
            ],
            'user' => [
                'user_id' => $this->primaryKey()->unsigned(),
                'email' => $this->string(64)->notNull(),
                'login' => $this->string(64)->notNull(),
                'password' => $this->string(64)->notNull(),
                'first_name' => $this->string(64)->notNull(),
                'last_name' => $this->string(64)->notNull(),
                'group_info' => $this->string(64)->notNull(),
                'avatar' => $this->string(32)->notNull(),
                'lang' => $this->string(3)->notNull(),
                'info' => $this->text()->null()->defaultExpression('null'),
                'access' => 'enum("admin","player","guest") default "player"',
                'sex' => 'enum("male","female")',
                'group_id' => $this->integer()->unsigned()->null()->defaultExpression('null'),
                'stat_id' => $this->integer()->unsigned()->notNull(),
                'level' => $this->integer()->unsigned()->notNull()->defaultValue(1),
                'exp' => $this->integer()->unsigned()->notNull()->defaultValue(0),
                'x' => $this->integer()->unsigned()->notNull(),
                'y' => $this->integer()->unsigned()->notNull(),
                'last_visit' => $this->timestamp()->defaultExpression('null')->null(),
                'last_count' => $this->integer()->unsigned()->notNull()->defaultValue(0),
                'page_loaded' => $this->integer()->unsigned()->notNull()->defaultValue(0),
                'energy' => $this->integer()->unsigned()->notNull()->defaultValue(100),
                'energy_max' => $this->integer()->unsigned()->notNull()->defaultValue(0),
                'energy_date' => $this->timestamp()->null()->defaultExpression('null'),
                'url_fixed' => $this->string(64)->null()->defaultExpression('null'),
                'url_count' => 'enum("one","always","never")',
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
                'foreigns' => [
                    ['table'=>'group','from'=>'group_id','to'=>'group_id'],
                    ['table'=>'stat','from'=>'stat_id','to'=>'stat_id'],
                ]
            ],
            'user_animal' => [
                'user_animal_id' => $this->primaryKey()->unsigned(),
                'user_id' => $this->integer()->unsigned(),
                'animal_id' => $this->integer()->unsigned(),
                'stat_id' => $this->integer()->unsigned(),
                'level' => $this->integer()->unsigned(),
                'exp' => $this->integer()->unsigned(),
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
                'foreigns' => [
                    ['table'=>'user','from'=>'user_id','to'=>'user_id'],
                    ['table'=>'animal','from'=>'animal_id','to'=>'animal_id'],
                    ['table'=>'stat','from'=>'stat_id','to'=>'stat_id'],
                ]
            ],
            'user_can_change_name' => [
                'user_can_change_name_id' => $this->primaryKey()->unsigned(),
                'user_id' => $this->integer()->unsigned(),
                'expires' => $this->timestamp()->defaultExpression('null')->null(),
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
                'foreigns' => [
                    ['table'=>'user','from'=>'user_id','to'=>'user_id'],
                ]
            ],
            'user_income' => [
                'user_income_id' => $this->primaryKey()->unsigned(),
                'user_id' => $this->integer()->unsigned(),
                'currency_id' => $this->integer()->unsigned(),
                'source_type' => $this->string(10),
                'source_id' => $this->integer()->unsigned(),
                'income_type' => $this->string(9),
                'value' => $this->integer()->unsigned(),
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
                'foreigns' => [
                    ['table'=>'user','from'=>'user_id','to'=>'user_id'],
                    ['table'=>'currency','from'=>'currency_id','to'=>'currency_id'],
                ]
            ],
            'user_view_page' => [
                'user_view_page_id' => $this->primaryKey()->unsigned(),
                'user_id' => $this->integer()->unsigned(),
                'url' => $this->string(32),
                'count' => 'enum("never","one","always")',
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
                'foreigns' => [
                    ['table'=>'user','from'=>'user_id','to'=>'user_id'],
                ]
            ],
            'work' => [
                'work_id' => $this->primaryKey()->unsigned(),
                'map_type_id' => $this->integer()->unsigned(),
                'title' => $this->string(128),
                'image' => $this->string(32),
                'description' => $this->text(),
                'price_id' => $this->integer()->unsigned(),
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
                'foreigns' => [
                    ['table'=>'map_type','from'=>'map_type_id','to'=>'map_type_id'],
                    ['table'=>'price','from'=>'price_id','to'=>'price_id'],
                ]
            ],
            'work_bonus' => [
                'work_bonus_id' => $this->primaryKey()->unsigned(),
                'work_id' => $this->integer()->unsigned(),
                'add_sub_levels' => $this->integer()->unsigned(),
                'status' => 'enum("active","blocked","deleted") default "active"',
                'changed' => $this->timestamp(),
                'foreigns' => [
                    ['table'=>'work','from'=>'work_id','to'=>'work_id'],
                ]
            ],
        ];
    }

    protected function _getData() {
        return [
            'army_name' => [
                [
                    'army_name_id' => 1,
                    'type' => 'Mafia',
                    'position' => 0,
                    'name' => 'Вася',
                    'status' => 'Active',
                ],
                [
                    'army_name_id' => 2,
                    'type' => 'Mafia',
                    'position' => 0,
                    'name' => 'Петя',
                    'status' => 'Active',
                ],
                [
                    'army_name_id' => 3,
                    'type' => 'Mafia',
                    'position' => 0,
                    'name' => 'Макс',
                    'status' => 'Active',
                ],
                [
                    'army_name_id' => 4,
                    'type' => 'Mafia',
                    'position' => 0,
                    'name' => 'Амир',
                    'status' => 'Active',
                ],
                [
                    'army_name_id' => 5,
                    'type' => 'Mafia',
                    'position' => 1,
                    'name' => 'Север',
                    'status' => 'Active',
                ],
                [
                    'army_name_id' => 6,
                    'type' => 'Mafia',
                    'position' => 1,
                    'name' => 'Кирпич',
                    'status' => 'Active',
                ],
                [
                    'army_name_id' => 7,
                    'type' => 'Mafia',
                    'position' => 1,
                    'name' => 'Сивуха',
                    'status' => 'Active',
                ],
                [
                    'army_name_id' => 8,
                    'type' => 'Mafia',
                    'position' => 1,
                    'name' => 'Перец',
                    'status' => 'Active',
                ],
                [
                    'army_name_id' => 9,
                    'type' => 'Mafia',
                    'position' => 1,
                    'name' => 'Зрелый',
                    'status' => 'Active',
                ],
                [
                    'army_name_id' => 10,
                    'type' => 'Mafia',
                    'position' => 1,
                    'name' => 'Калита',
                    'status' => 'Active',
                ],
            ],
            'map_type' => [
                [
                    'map_type_id' => 1,
                    'controller' => 'arena',
                    'name' => 'Арена',
                    'info' => 'В этом здании проводятся битвы самых гнусных людей этого города.',
                    'params' => '',
                    'can_build' => 0,
                    'can_take' => 0,
                    'markup_max' => 10,
                    'status' => 'Active',
                    'changed' => '0000-00-00 00:00:00',
                ],
                [
                    'map_type_id' => 2,
                    'controller' => 'shop',
                    'name' => 'Магазин',
                    'info' => 'бал бал бла',
                    'params' => '',
                    'can_build' => 1,
                    'can_take' => 1,
                    'markup_max' => 10,
                    'status' => 'Active',
                    'changed' => '0000-00-00 00:00:00',
                ],
                [
                    'map_type_id' => 0,
                    'controller' => 'none',
                    'name' => 'Свободная площадка',
                    'info' => 'Здесь можно построить разные здания',
                    'params' => '',
                    'can_build' => 0,
                    'can_take' => 0,
                    'markup_max' => 10,
                    'type' => 'surface',
                    'status' => 'Active',
                    'changed' => '0000-00-00 00:00:00',
                ],
                [
                    'map_type_id' => 5,
                    'controller' => 'room',
                    'name' => 'Квартира',
                    'info' => 'Здсь можно купить квартиру.',
                    'params' => '',
                    'can_build' => 1,
                    'can_take' => 1,
                    'markup_max' => 10,
                    'status' => 'Active',
                    'changed' => '0000-00-00 00:00:00',
                ],
                [
                    'map_type_id' => 6,
                    'controller' => 'religy',
                    'name' => 'Церковь',
                    'info' => 'В церкви производяться бракосочетания',
                    'params' => '',
                    'can_build' => 0,
                    'can_take' => 0,
                    'markup_max' => 10,
                    'status' => 'Active',
                    'changed' => '0000-00-00 00:00:00',
                ],
                [
                    'map_type_id' => 7,
                    'controller' => 'bar',
                    'name' => 'Бар',
                    'info' => 'Здесь вы можете нанять людей.',
                    'params' => '',
                    'can_build' => 1,
                    'can_take' => 0,
                    'markup_max' => 10,
                    'status' => 'Active',
                    'changed' => '0000-00-00 00:00:00',
                ],
                [
                    'map_type_id' => 8,
                    'controller' => 'mafia',
                    'name' => 'Логово групировки',
                    'info' => 'Здание, где располагаются основные силы групировки.',
                    'params' => '',
                    'can_build' => 1,
                    'can_take' => 0,
                    'markup_max' => 10,
                    'status' => 'Active',
                    'changed' => '0000-00-00 00:00:00',
                ],
                [
                    'map_type_id' => 9,
                    'controller' => 'ipodrom',
                    'name' => 'Ипподром',
                    'info' => 'В ипподроме вы можете добыть достаточно большое количество денег. Для этого вам нужно лишь везение. Выберите лошадь на которую ставите и укажите размер ставки. Дальше Вам останется только забрать свой выигрыш, либо с пустыми карманами вернуться домой.',
                    'params' => '',
                    'can_build' => 1,
                    'can_take' => 0,
                    'markup_max' => 10,
                    'status' => 'Active',
                    'changed' => '0000-00-00 00:00:00',
                ],
                [
                    'map_type_id' => 10,
                    'controller' => 'library',
                    'name' => 'Библиотека',
                    'info' => 'В библиотеке вы можете стать умнее. Для этого вам всего лишь нужно заплатить входную плату и \'читать, читать и еще раз читать\', как сказал Ленин.',
                    'params' => '',
                    'can_build' => 1,
                    'can_take' => 1,
                    'markup_max' => 10,
                    'status' => 'Active',
                    'changed' => '0000-00-00 00:00:00',
                ],
                [
                    'map_type_id' => 11,
                    'controller' => 'upgrade',
                    'name' => 'Мастерская',
                    'info' => 'В данном здании Вы можете улучшать вещи',
                    'params' => '',
                    'can_build' => 0,
                    'can_take' => 0,
                    'markup_max' => 10,
                    'status' => 'Active',
                    'changed' => '0000-00-00 00:00:00',
                ],
                [
                    'map_type_id' => 12,
                    'controller' => 'sport',
                    'name' => 'Тренажорный зал',
                    'info' => 'Качайтесь и выигрывайте',
                    'params' => '',
                    'can_build' => 0,
                    'can_take' => 0,
                    'markup_max' => 10,
                    'status' => 'Active',
                    'changed' => '0000-00-00 00:00:00',
                ],
                [
                    'map_type_id' => 13,
                    'controller' => 'valuts',
                    'name' => 'Обмен валют',
                    'info' => 'Играйте на курсе валют',
                    'params' => '',
                    'can_build' => 0,
                    'can_take' => 0,
                    'markup_max' => 10,
                    'status' => 'Active',
                    'changed' => '0000-00-00 00:00:00',
                ],
                [
                    'map_type_id' => 14,
                    'controller' => 'weapon',
                    'name' => 'Оружейный магазин',
                    'info' => 'Покупайте оружие',
                    'params' => '',
                    'can_build' => 0,
                    'can_take' => 0,
                    'markup_max' => 10,
                    'status' => 'Active',
                    'changed' => '0000-00-00 00:00:00',
                ],
            ],
            'smile' => [
                [
                    'smile_id' => 1,
                    'file' => 'Angel',
                    'bbcode' => '(angel)',
                    'visible' => 0,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 2,
                    'file' => 'Angry',
                    'bbcode' => '(angry)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 3,
                    'file' => 'Bandit',
                    'bbcode' => '(bandit)',
                    'visible' => 0,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 4,
                    'file' => 'Bear',
                    'bbcode' => '(bear)',
                    'visible' => 0,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 5,
                    'file' => 'Beer',
                    'bbcode' => '(beer)',
                    'visible' => 0,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 6,
                    'file' => 'Blush',
                    'bbcode' => '(blush)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 7,
                    'file' => 'Broken_Heart',
                    'bbcode' => '(broken_heart)',
                    'visible' => 0,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 8,
                    'file' => 'Cake',
                    'bbcode' => '(cake)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 9,
                    'file' => 'Call',
                    'bbcode' => '(call)',
                    'visible' => 0,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 10,
                    'file' => 'Cash',
                    'bbcode' => '(cash)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 11,
                    'file' => 'Clapping',
                    'bbcode' => '(clapping)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 12,
                    'file' => 'Coffee',
                    'bbcode' => '(coffee)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 13,
                    'file' => 'Confused',
                    'bbcode' => '(confused)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 14,
                    'file' => 'Cool',
                    'bbcode' => '(cool)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 15,
                    'file' => 'Crying',
                    'bbcode' => '(crying)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 16,
                    'file' => 'Dance',
                    'bbcode' => '(dance)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 17,
                    'file' => 'Devil',
                    'bbcode' => '(devil)',
                    'visible' => 0,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 18,
                    'file' => 'Doh',
                    'bbcode' => '(doh)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 19,
                    'file' => 'Drink',
                    'bbcode' => '(drink)',
                    'visible' => 0,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 20,
                    'file' => 'Drunk',
                    'bbcode' => '(drunk)',
                    'visible' => 0,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 21,
                    'file' => 'Dull',
                    'bbcode' => '(dull)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 22,
                    'file' => 'Envy',
                    'bbcode' => '(envy)',
                    'visible' => 0,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 23,
                    'file' => 'Evil_Grin',
                    'bbcode' => '(evil_grin)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 24,
                    'file' => 'Giggle',
                    'bbcode' => '(giggle)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 25,
                    'file' => 'Grin',
                    'bbcode' => '(grin)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 26,
                    'file' => 'Hand_Shake',
                    'bbcode' => '(hand_shake)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 27,
                    'file' => 'Head_Bang',
                    'bbcode' => '(head_bang)',
                    'visible' => 0,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 28,
                    'file' => 'Heart',
                    'bbcode' => '(heart)',
                    'visible' => 0,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 29,
                    'file' => 'Hi',
                    'bbcode' => '(hi)',
                    'visible' => 0,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 30,
                    'file' => 'In_Love',
                    'bbcode' => '(in_love)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 31,
                    'file' => 'It_Wasnt_Me',
                    'bbcode' => '(it_wasnt_me)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 32,
                    'file' => 'Kiss',
                    'bbcode' => '(kiss)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 33,
                    'file' => 'Lips_Sealed',
                    'bbcode' => '(lips_sealed)',
                    'visible' => 0,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 34,
                    'file' => 'Mail',
                    'bbcode' => '(mail)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 35,
                    'file' => 'Makeup',
                    'bbcode' => '(makeup)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 36,
                    'file' => 'Middle_Finger',
                    'bbcode' => '(middle_finger)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 37,
                    'file' => 'Mooning',
                    'bbcode' => '(mooning)',
                    'visible' => 0,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 38,
                    'file' => 'Movie',
                    'bbcode' => '(movie)',
                    'visible' => 0,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 39,
                    'file' => 'Muscle',
                    'bbcode' => '(muscle)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 40,
                    'file' => 'Music',
                    'bbcode' => '(music)',
                    'visible' => 0,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 41,
                    'file' => 'Nerd',
                    'bbcode' => '(nerd)',
                    'visible' => 0,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 42,
                    'file' => 'Ninja',
                    'bbcode' => '(ninja)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 43,
                    'file' => 'No',
                    'bbcode' => '(no)',
                    'visible' => 0,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 44,
                    'file' => 'Party',
                    'bbcode' => '(party)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 45,
                    'file' => 'Phone',
                    'bbcode' => '(phone)',
                    'visible' => 0,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 46,
                    'file' => 'Pizza',
                    'bbcode' => '(pizza)',
                    'visible' => 0,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 47,
                    'file' => 'Puke',
                    'bbcode' => '(puke)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 48,
                    'file' => 'Rain',
                    'bbcode' => '(rain)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 49,
                    'file' => 'Rock',
                    'bbcode' => '(rock)',
                    'visible' => 0,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 50,
                    'file' => 'Sad',
                    'bbcode' => '(sad)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 51,
                    'file' => 'Skype',
                    'bbcode' => '(skype)',
                    'visible' => 0,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 52,
                    'file' => 'Sleepy',
                    'bbcode' => '(sleepy)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 53,
                    'file' => 'Smile',
                    'bbcode' => '(smile)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 54,
                    'file' => 'Smoke',
                    'bbcode' => '(smoke)',
                    'visible' => 0,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 55,
                    'file' => 'Speechless',
                    'bbcode' => '(speechless)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 56,
                    'file' => 'Star',
                    'bbcode' => '(star)',
                    'visible' => 0,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 57,
                    'file' => 'Sun',
                    'bbcode' => '(sun)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 58,
                    'file' => 'Surprised',
                    'bbcode' => '(surprised)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 59,
                    'file' => 'Sweating',
                    'bbcode' => '(sweating)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 60,
                    'file' => 'Talking',
                    'bbcode' => '(talking)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 61,
                    'file' => 'Think',
                    'bbcode' => '(think)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 62,
                    'file' => 'Thinking',
                    'bbcode' => '(thinking)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 63,
                    'file' => 'Time',
                    'bbcode' => '(time)',
                    'visible' => 0,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 64,
                    'file' => 'Toivo',
                    'bbcode' => '(toivo)',
                    'visible' => 0,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 65,
                    'file' => 'Tongue_Out',
                    'bbcode' => '(tongue_out)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 66,
                    'file' => 'Wait',
                    'bbcode' => '(wait)',
                    'visible' => 0,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 67,
                    'file' => 'Weird',
                    'bbcode' => '(weird)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 68,
                    'file' => 'Wink',
                    'bbcode' => '(wink)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 69,
                    'file' => 'Worried',
                    'bbcode' => '(worried)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 70,
                    'file' => 'Yawn',
                    'bbcode' => '(yawn)',
                    'visible' => 1,
                    'status' => 'Active',
                ],
                [
                    'smile_id' => 71,
                    'file' => 'Yes',
                    'bbcode' => '(yes)',
                    'visible' => 0,
                    'status' => 'Active',
                ],
            ],
            'currency' => [
                [
                    'currency_id' => 1,
                    'title' => 'Евро',
                    'ext' => '€',
                    'color' => 'ff0000',
                    'course' => 6.93946,
                    'default' => 7,
                    'fixed_valute' => 'Yes',
                    'can_buy' => 'Yes',
                    'status' => 'Active',
                ],
                [
                    'currency_id' => 2,
                    'title' => 'Рубли',
                    'ext' => 'р',
                    'color' => '00ff00',
                    'course' => 2.06245,
                    'default' => 2,
                    'fixed_valute' => 'Yes',
                    'can_buy' => 'Yes',
                    'status' => 'Active',
                ],
                [
                    'currency_id' => 3,
                    'title' => 'Доллары',
                    'ext' => '$',
                    'color' => '64960A',
                    'course' => 1,
                    'default' => 1,
                    'fixed_valute' => 'No',
                    'can_buy' => 'No',
                    'status' => 'Active',
                ]
            ]
        ];
    }


}
