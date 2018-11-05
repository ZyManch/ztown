<?php

namespace controllers;

use forms\LoginForm;
use controllers\base\Controller;

class SiteController extends Controller
{

	/**
	 * Declares class-based actions.
	 */
	public function actions() {
		return array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			'page'=>array(
				'class'=>'CViewAction',
			),
            'oauth'=>array(
                'class'=>'ext.login.actions.OauthAction',
            )
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex() {
		return $this->render('index');
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::$app->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::$app->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		return $this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(\Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
	}

    public function actionChangeLogin() {
        $user = Yii::$app->user->getUser();
        if (!$user->canChangeName) {
            throw new Exception('Вы не можете редактировать логин');
        }
        $form = new ChangeLoginForm;
        if(isset($_POST['ajax']) && $_POST['ajax']==='change-login-form') {
            echo CActiveForm::validate($form);
            Yii::$app->end();
        }
        if(isset($_POST['ChangeLoginForm'])) {
            $form->attributes=$_POST['ChangeLoginForm'];
            if ($form->validate()) {
                $form->changeLogin($user);
                $this->redirect(array('maps/index'));
            }
        }
        return $this->render('changeName', array(
             'currentLogin' => $user->login,
             'model'        => $form
        ));
    }

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout() {
		\Yii::$app->user->logout();
		$this->redirect(\Yii::$app->homeUrl);
	}

}