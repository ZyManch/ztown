<?php

namespace controllers\map;

use controllers\base\EventController;

class MafiaController extends EventController {

    public $mapTypeId = 8;

    public function getPages() {
        return [
            'Форум'    => 'forum'
        ];
    }

	public function actionView() {
        if ($this->map->user_id) {
            return $this->render('info', array(
               'head'    => $this->map->parent,
               'group'   => $this->map->parent->group,
               'members' => $this->map->parent->group->members
            ));
        } elseif(Yii::$app->user->group_id) {
            return $this->renderText('В данном здании никаво нет');
        }else{
            $this->_bay();
        }
	}

    public function actionUpdate() {
        if(Yii::$app->request->isPostRequest && $this->map->isHead()){
            $group = $this->map->parent->group;
            $request = Yii::$app->request;
            $mafiaInfo = $request->getParam('MafiaInfo', array());
            $group->mafiaInfo->content = isset($mafiaInfo['content']) ? $mafiaInfo['content'] : '';
            $group->mafiaInfo->save();
            $newUserInfo = $request->getParam('user', array());
            foreach ($group->members as $member) {
                if (isset($newUserInfo[$member->id])) {
                    $member->saveAttributes(array(
                        'group_info' => htmlspecialchars($newUserInfo[$member->id])
                    ));
                }
            }
        }
        $this->redirect(array('view'));
    }

    public function actionForum() {
        return $this->renderText('Форум времено недоступен');
    }

    protected function _bay() {
        $group = new Groups();
        if(isset($_POST['Groups']) && $this->user->canBuy($this->map->mapType)) {
            $this->user->spendMoneyByItem($this->map->mapType);
            $group->attributes = array(
                'name' => $_POST['Groups']['name'],
                'Type' => 'Mafia'
            );
            if ($group->save()) {
                $this->map->saveAttributes(array('user_id' => $this->user->id));
                $this->user->saveAttributes(array('group_id' => $group->id));
                $mafia = new MafiaInfo();
                $mafia->setAttributes(array(
                    'map_id'     => $this->map->id,
                    'group_id' => $group->id,
                    'user_id'     => $this->user->id
                ));
                $mafia->save();
                $this->setUserMessage('Вы создали группировку');
                $this->redirect(array('view'));
            } else {
                $this->setUserMessage($this->extractErrors($group));
            }
        }

        return $this->render('bay', array(
            'model' => $group
        ));
    }

}