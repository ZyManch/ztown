<?php

namespace controllers\map;

use controllers\base\EventController;

class ReligyController extends EventController {
    public $mapTypeId = 6;

    public function actionView($id = 0) {
        $family = $this->user->family;
        // если женат
        if ($family) {
            if($family->Confirm) {
                return $this->render('is_maried', array('family' => $family));
            }else{
                $allWhoTry = Friends::model()->with('userTo.group')->findAllByAttributes(array(
                    'User1' => $this->user->id,
                    'Type'  => 'family'
                ));
                return $this->render('try_maried', array(
                    "user"      => $this->user,
                    'allWhoTry' => $allWhoTry
                ));
            }
            // если идет запрос о женитьбе
        } else if ($id) {
            $user = User::model()->findByPk($id);
            if(!$user || $user->family || $this->user->sex == User::MALE) {
                throw new CHttpException(404, 'Пользователь не найден');
            }
            $friend = $user->getFriend();
            if ($friend && $friend->Confirm) {
                $friend = new Friends();
                $friend->setAttributes(array(
                    'User1' => $this->user->id,
                    'User2' => $user->id,
                    'Type'  => 'family'
                ));
                $friend->save();
                $message = $this->renderPartial('_weddingStartLetter', array(
                    'user' => $this->user
                ), true);
                Messages::sendMessage('Свадьба', $message, $user, null, true);
                $message = $this->renderPartial('_weddingStatusLetter', array(
                    'user' => $user
                ), true);
                Messages::sendMessage('Свадьба', $message, $this->user);
                $this->redirect(array('view'));
            }else{
                throw new CHttpException(404, 'Добавте пользователя в список друзей для продолжения.');
            }
            // если не женился еще
        }else{
            return $this->render('no_maried', array(
                'user'    => $this->user
            ));
        }
    }

    public function actionDecline($id) {
        $family = Friends::model()->findByAttributes(array(
            'User1' => $this->user->id,
            'User2' => $id,
            'Type'  => 'family'
        ));
        if(!$family) {
            throw new CHttpException(404, 'Пользователь не найден');
        }
        $message = $this->renderPartial('_weddingDeclineLetter', array(
            'family' => $family
        ), true);
        Messages::sendMessage('Свадьба', $message, $family->userTo);
        $family->delete();
        return $this->render('decline_maried', array(
            'user'    => $this->user,
            'map'     => $this->map
        ));
    }

    public function actionAccept($id) {
        $family = Friends::model()->findByAttributes(array(
            'User1' => $this->user->id,
            'User2' => $id,
            'Type'  => 'family'
        ));
        if(!$family && !$family->Confirm) {
            throw new CHttpException(404, 'Пользователь не найден');
        }
        $message = $this->renderPartial('_weddingAcceptLetter', array(), true);
        Messages::sendMessage('Свадьба', $message, $family->userTo);
        Messages::sendMessage('Свадьба', $message, $family->userFrom);
        $family->Confirm = 1;
        $family->save();
        return $this->render('accept_maried', array(
            'map'     => $this->map
        ));
    }
}