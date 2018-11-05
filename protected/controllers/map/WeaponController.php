<?php

namespace controllers\map;

use controllers\base\EventController;

class WeaponController extends EventController {

    public $mapTypeId = 14;

    public $layout='columnTabs';

    public function getPages() {
        return [
            'Оружие'                   => 'weapon',
            'Офисные принадлежности'   => 'office',
            'Украшения'                => 'glocery'
        ];
    }
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionWeapon () {
        $this->_showGroupShop(1);
    }

    public function actionOffice () {
        $this->_showGroupShop(2);
    }

    public function actionGlocery() {
        $this->_showGroupShop(3);
    }

    protected function _showGroupShop($groupId) {
        return $this->render('view', array(
            'weapons' => $this->_getWeapons($groupId),
            'group'   => $groupId
        ));
    }

    protected function _getWeapons($groupId) {
        $groupedWeapons = array();
        foreach ($this->user->weaponsOpened as $weapon) {
            if ($weapon->group == $groupId && $weapon->level <= $this->map->level) {
                $groupedWeapons[$weapon->id] = $weapon;
            }
        }
        $items = Items::model()->
            with(array('stat','price'))->
            findAllByAttributes(array('type'=>'Weapon'));
        foreach ($items as $weapon) {
            if ($weapon->group == $groupId && $weapon->level <= $this->map->level) {
                $groupedWeapons[$weapon->id] = $weapon;
            }
        }
        return $groupedWeapons;
    }

    public function actionBuy($group_id, $id) {
        $weapons = $this->_getWeapons($group_id);
        if (!isset($weapons[$id])) {
            throw new CHttpException('Not access to bay item', 404);
        }
        $item = $weapons[$id];
        if($this->user->spendMoneyByItem($item, $this->getMarkUp())){
            $stat = new Stat();
            $stat->joinStat($item->stat);
            $stat->save();
            $itemBuied = new ItemBuied();
            $itemBuied->setAttributes(array(
                'item_id' => $item->id,
                'user_id' => $this->user->id,
                'stat_id' => $stat->id
            ));
            $itemBuied->save();
            $this->setUserMessage('<img src="images/info/shop.jpg"><br>Спасибо за покупку. Прихотите к нам еще раз.');
        }
        $pages = array_values($this->getPages());
        $this->redirect(array($pages[$item->group]));
    }

}
