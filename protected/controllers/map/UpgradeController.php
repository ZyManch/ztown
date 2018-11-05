<?php

namespace controllers\map;

use controllers\base\EventController;

class UpgradeController extends EventController {

    public $mapTypeId = 11;

    public $layout='columnTabs';

    public function getPages() {
        return [
                'Оружейник' => 'weapon',
                'Портной'   => 'cloth',
                'Умелец'    => 'handyman'
        ];
    }

    protected function getUpgradeTypes() {
        return array(
            'weapon' => array(
                'types'  => array('Weapon'),
                'groups' => array(0, 1)
            ),
            'cloth' => array(
                'types'  => array('Helmet','Bots','Dress','Gloves'),
                'groups' => array(0)
            ),
            'handyman' => array(
                'types'  => array('Glass','Neclase','Ring','Weapon'),
                'groups' => array(0, 2, 3)
            )
        );
    }

	public function actionWeapon() {
        $this->_action();
	}

    public function actionCloth() {
        $this->_action();
    }

    public function actionHandyman() {
        $this->_action();
    }

    protected function _action() {
        $this->includeCss('profile');
        $upgradeTypes = $this->getUpgradeTypes();
        $upgradeTypes = $upgradeTypes[$this->action->id];
        $crit = new CDbCriteria();
        $crit->compare('item.type', $upgradeTypes['types']);
        $crit->compare('item.group', $upgradeTypes['groups']);
        $items = ItemBuied::model()->with('item.stat')->findAll($crit);
        return $this->render('view', array(
            'items' => $items
        ));
    }

    public function actionUpgrade($item, $type) {
        /** @var $item ItemBuied */
        $item = ItemBuied::model()->with('item.stat')->findByPk($item);
        if (in_array($type, array(
            ItemBuied::UPGRADE_ADVANCED,
            ItemBuied::UPGRADE_VIP,
            ItemBuied::UPGRADE_GOLD
        )) && in_array($item->light, array(
            ItemBuied::UPGRADE_STANDART,
            $type
        ))) {
            $prices = Yii::$app->config->getUpgradePrice($item, $type);
            if($this->user->removeMoney($prices, 1, true)) {
                $item->upgrade($type);
                $item->save();
                $this->setUserMessage('Апргрейд успешно совершен');
            } else {
                $this->setUserMessage('Недостаточно средств');
            }
        }
        $upgradeTypes = $this->getUpgradeTypes();
        foreach ($upgradeTypes as $key => $type) {
            if (in_array($item->item->type, $type['types']) &&
                in_array($item->item->group, $type['groups'])
            ) {
                $this->redirect(array($key));
            }
        }
        $this->redirect(array('view'));
    }

}