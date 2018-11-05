<?php
namespace components;
/**
 * Created by JetBrains PhpStorm.
 * User: Ренат
 * Date: 01.07.12
 * Time: 9:12
 * To change this template use File | Settings | File Templates.
 */
class DbConnection extends CDbConnection {

    public $driverMap=array(
        'mysql'=> 'MysqlSchema'
    );

}