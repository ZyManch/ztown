<?php
namespace components;
/**
 * Created by JetBrains PhpStorm.
 * User: Ренат
 * Date: 01.07.12
 * Time: 9:16
 * To change this template use File | Settings | File Templates.
 */
class DbCommandBuilder extends CDbCommandBuilder {

    public function createDeleteCommand ($table, $criteria) {
        $this->ensureTable($table);
        $sql = "UPDATE {$table->rawName} SET status = 'Deleted' ";
        $sql = $this->applyJoin($sql, $criteria->join);
        $sql = $this->applyCondition($sql, $criteria->condition);
        $sql = $this->applyGroup($sql, $criteria->group);
        $sql = $this->applyHaving($sql, $criteria->having);
        $sql = $this->applyOrder($sql, $criteria->order);
        $sql = $this->applyLimit($sql, $criteria->limit, $criteria->offset);
        $command = $this->getDbConnection()->createCommand($sql);
        $this->bindValues($command, $criteria->params);
        return $command;
    }

}