<?php

namespace controllers\profile;

use controllers\base\Controller;
/**
 * Created by JetBrains PhpStorm.
 * User: ZyManch
 * Date: 13.01.13
 * Time: 9:52
 */
class RegisterController extends Controller {

    public function actionIndex() {
        $avatars = \models\Avatar::find()->all();
        $form = new \forms\RegisterForm();
        if($form->load(\Yii::$app->request->post()) && $form->validate()) {
            if (!$form->register()) {
                throw new \Exception('Ошибка регистрации нового юзера');
            }
            return $this->redirect(['maps/index']);
        }
        return $this->render('index', [
            'avatars' => $avatars,
            'model' => $form
        ]);
    }

}