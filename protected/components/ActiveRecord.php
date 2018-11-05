<?php
namespace components;
/**
 * Created by JetBrains PhpStorm.
 * User: Ренат
 * Date: 12.06.12
 * Time: 20:51
 * To change this template use File | Settings | File Templates.
 * @var Stat $stat
 * @var array $price
 * @var array $income
 * @var array $userIncome
 */
class ActiveRecord extends CActiveRecord {

    const STATUS_ACTIVE = 'Active';
    const STATUS_BLOCKED = 'Blocked';
    const STATUS_DELETED = 'Deleted';

    const AFTER_SAVE = 'onAfterSave';
    const BEFORE_SAVE = 'onBeforeSave';
    const AFTER_DELETE = 'onAfterDelete';
    const BEFORE_DELETE = 'onBeforeDelete';

    /**
     * @static
     * @return ActiveRecord
     */
    public static function model() {
        return parent::model(get_called_class());
    }

    /**
     * @param $limit
     * @param $criteria
     * @param array $params
     * @return ActiveRecord
     */
    public function findAllByRand($limit, $criteria, $params = array()) {
        if (!is_object($criteria)) {
            $criteria = $this->getCommandBuilder()->createCriteria($criteria, $params);
        } else {
            $criteria->params = array_merge($criteria->params, $params);
        }
        $criteria->order = 't.id';
        $criteria->limit = $limit;
        $criteria->join = '
        INNER JOIN ( SELECT (RAND() *
            (SELECT MAX(id) - ' .($limit - 1). ' FROM '.$this->tableName().')
        ) AS id) AS r2
            ON t.id >= r2.id';
        return $this->query($criteria, true);
    }

    /**
     * @param $criteria
     * @return ActiveRecord
     */
    public function findByRand($criteria) {
        $rows = $this->findAllByRand(1, $criteria);
        return array_shift($rows);
    }


    public function defaultScope() {
        $t = $this->getTableAlias(false, false);
        return array(
            'condition' => $t.'.status  = "'.self::STATUS_ACTIVE.'"',
        );
    }

    /**
     * @return DbConnection
     */
    public function getDbConnection() {
        return Yii::$app->db;
    }

    public function changeStatus($status, $withChild = true) {
        if ($this->status != $status) {
            if ($status == self::STATUS_DELETED) {
                if (!$this->beforeDelete()) {
                    return false;
                }
            }
            if ($withChild) {
                foreach ($this->relations() as $relation => $config) {
                    switch ($config[0]) {
                        case self::HAS_MANY:
                            foreach ($this->$relation as $item) {
                                $item->changeStatus($status, $withChild);
                            }
                            break;
                        case self::HAS_ONE:
                            $this->$relation->changeStatus($status, $withChild);
                            break;
                        default:
                    }
                }
            }
            $this->saveAttributes(array('status'=>$status));
            if ($status == self::STATUS_DELETED) {
                $this->afterDelete();
            }
        }
        return true;
    }

    public function changed($gameTime = true) {
        $time = strtotime($this->changed);
        if ($gameTime) {
            return strtotime($this->changed);
        }
        return $time;
    }

    public function relations() {
        $class = get_called_class();
        return array(
            'stat'   => array(self::BELONGS_TO, 'Stat', 'stat_id'),
            'price'  => array(self::HAS_MANY, 'Price', 'object_id',
                              'on' => 'price.object_type="'.$class.'"'),
            'income' => array(self::HAS_MANY, 'Income', 'source_id',
                              'on' => 'income.source_type="'.$class.'"'),
            'userIncome' => array(self::HAS_MANY, 'UserIncome', 'source_id',
                                  'on' => 'userIncome.source_type="'.$class.'"'),
        );
    }

    public static function create($attributes) {
        $class = get_called_class();
        /** @var ActiveRecord $model  */
        $model = new $class();
        $model->setAttributes($attributes);
        return $model;
    }
}