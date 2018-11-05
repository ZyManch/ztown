<?php
namespace components;
/**
 * Created by JetBrains PhpStorm.
 * User: Ренат
 * Date: 01.07.12
 * Time: 9:15
 * To change this template use File | Settings | File Templates.
 */
class MysqlSchema extends CMysqlSchema {

    protected function createCommandBuilder () {
        return new DbCommandBuilder($this);
    }

}