<?php
/**
 * Обновляет курс валют
 * @var int $timeOfRun
 */
include '../../../init.php';
if (!isset($timeOfRun)) {
    $timeOfRun = \components\Date::timestamp();
}