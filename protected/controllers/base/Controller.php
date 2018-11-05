<?php
namespace controllers\base;

use behaviors\controller\RedirectBehavior;
use behaviors\controller\TimerBehavior;
use models\User;
use Yii;
use yii\db\ActiveRecord;
use \yii\web\Controller as Base;
use yii\web\HttpException;

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends Base
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='columnDefault';

    public $modelClass;

    public $pages;

    /**
     * @var User
     */
    public $user = null;

	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

    public function init() {
        $this->user = Yii::$app->user->getIdentity();
    }

    public function behaviors() {
        return array_merge(
            parent::behaviors(),
            [
                'timer'    => ['class'=>TimerBehavior::class],
                'redirect' => ['class'=>RedirectBehavior::class],
            ]
        );
    }



    protected  function extractErrors($model) {
        return implode('. ', array_map('array_shift', $model->getErrors()));
    }

    /**
     * @param integer the ID of the model to be loaded
     */
	public function loadModel($id, $with = array()) {
        $modelClass = $this->modelClass;
        /** @var ActiveRecord $modelClass */
		$model =$modelClass::findOne($id);
		if($model===null) {
			throw new HttpException(404,'The requested page does not exist.');
        }
		return $model;
	}


    protected function setUserMessage($text) {
        Yii::$app->session->setFlash('status', $text);
    }

    public function getViewFolder() {
        return '';
    }

    public function getViewPath() {
	    $folder = $this->getViewFolder();
	    if (!$folder) {
	        return parent::getViewPath();
        }
        return $this->module->getViewPath() . DIRECTORY_SEPARATOR .$folder.DIRECTORY_SEPARATOR. $this->id;
    }
}