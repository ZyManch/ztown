<?php
namespace controllers\map;

use controllers\base\EventController;
/**
 * Created by JetBrains PhpStorm.
 * User: Ренат
 * Date: 29.06.12
 * Time: 8:32
 * To change this template use File | Settings | File Templates.
 */
class BarController extends EventController {

    public $mapTypeId = 7;

    public function getPages() {
        return array(
            'Нанять' => 'bay',
            'Список' => 'list'
        );
    }

    public function actionBay() {
        $group = $this->user->group;
        $army = $this->user->army;
        $buiedArmy = Yii::$app->request->getParam('army');
        if($buiedArmy && is_array($buiedArmy) && $this->user->changeMoney(-Config::ARMY_PRICE, true)){
            $maxCount = $this->user->stat->getSumm(6) - sizeof($army);
            if($maxCount <= 0){
                $this->setUserMessage('Для найма большего количества людей, прокачайте лидерство.');
            }else{
                try {
                    foreach ($buiedArmy as $armyName) {
                        $ids = explode(' ', $armyName);
                        if (sizeof($ids)!=2) {
                            throw new Exception('Invalid name');
                        }
                        $name = ArmyNames::model()->findByPk($ids[0]);
                        $surname = ArmyNames::model()->findByPk($ids[1]);
                        if (is_null($name) || is_null($surname)) {
                            throw new Exception('Name not find');
                        }
                        $newArmy = new Army();
                        $newArmy->setAttributes(array(
                            'parent_id' => $this->user->id,
                            'stat'      => Config::ARMY_STAT_DEFAULT,
                            'name'      => $name->name . ' ' . $surname->name,
                        ));
                        $newArmy->save();
                    }
                } catch (Exception $e) {
                    // hacker ?
                }
                $this->redirect(array('bay'));
            }
        }
        $condition = new CDbCriteria();
        $condition->compare('type', $group->Type);
        $condition->addCondition('position=:position');
        $names = ArmyNames::model()->findAllByRand(5, $condition, array(':position' => 0));
        $surnames = ArmyNames::model()->findAllByRand(5, $condition, array(':position' => 1));
        shuffle($names);
        shuffle($surnames);
        $armyNames = array();
        foreach ($names as $name) {
            if ($surnames) {
                $armyNames[] = array($name, array_shift($surnames));
            }
        }
        return $this->render('bay', array(
            'group'     => $group,
            'armyNames' => $armyNames,
            'army'      => $army
        ));
    }

    public function actionList() {
        return $this->render('list', array(
            'group' => $this->user->group,
            'army'  => $this->user->army
        ));
    }

    public function actionDelete($id) {
        $crit = new CDbCriteria();
        $crit->compare('parent_id', $this->user->id);
        $crit->compare('id', $id);
        $army = Army::model()->find($crit);
        if (!$army) {
            throw new CHttpException('Не найден');
        }
        $army->delete();
        $this->redirect(array('list'));
    }
}