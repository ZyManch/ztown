<?php

namespace controllers\map;

use controllers\base\EventController;
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 19.01.14
 * Time: 12:59
 */
class MaterialController extends EventController {

    public $mapTypeId = 20;

    public function getPages() {
        return [
             'Материалы'       => 'materials',
        ];
    }

    public function actionMaterials() {
        return $this->render('list',array(
            'items' => $this->_getMaterials(),
            'counts' => array(1,5,20)
        ));
    }

    public function actionBuy($id, $count) {
        $materials = $this->_getMaterials();
        if (!isset($materials[$id])) {
            throw new CHttpException('Неизвестный вид материала', 404);
        }
        /** @var Currency $material */
        $material = $materials[$id];
        $count = (int)$count;
        if (!$this->user->changeMoney(-round($material->course*$this->getMarkUp()*$count))) {
            throw new CHttpException('Недостаточно денег', 404);
        }
        if (!$this->user->changeMoney($count, false, $id)) {
            throw new CHttpException('Ошибка зачисления денег', 404);
        }
        $this->redirect(array('materials'));
    }

    protected function _getMaterials() {
        $criteria = new CDbCriteria();
        $criteria->compare('type','Material');
        $criteria->addCondition('level <= :level');
        $criteria->params[':level'] = $this->map->level;
        $criteria->index = 'id';
        return Currency::model()->findAll($criteria);
    }

}