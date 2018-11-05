<?php
namespace controllers\wiki;

use ActiveGenerator\Criteria;
use controllers\base\Controller;
use models\MapType;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;

class WikiMapController extends Controller {


    public $modelClass = MapType::class;

    public function behaviors() {
        return array_merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index','view'],
                        'roles'   => ['*'],
                    ]
                ]
            ]
        ]);
    }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)	{
		return $this->render('view', array(
			'model'=>$this->loadModel($id),
		));
	}


	/**
	 * Lists all models.
	 */
	public function actionIndex($tab = 'house') {
		$dataProvider=new ActiveDataProvider([
		    'query' => MapType::find()->
                filterByType((string)$tab)->
                filterByBuildTypeId(null,Criteria::ISNULL)->
                orderByMapTypeId(),
            'pagination' => false
        ]);
		return $this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

    public function getViewFolder() {
        return 'wiki';
    }
}
