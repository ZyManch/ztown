<?php
namespace controllers\map;

use controllers\base\EventController;

class CurrencyController extends EventController {

    public $mapTypeId = 13;

    public $currencies = array();

    public function init() {
        parent::init();
        $this->currencies = array();
        foreach (Currency::getValutes() as $valute) {
            if ($valute->can_buy == Config::YES_VALUE) {
                $this->currencies[] = $valute;
            }
        }
    }

    public function getPages() {
        return [
            'Обмен валюты' => 'bay'
        ];
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionBay() {
//        print Yii::$app->cron->getSecondsToRun('currencies');die();
        return $this->render('view', array(
            'currencies' => $this->currencies,
        ));
    }

    public function actionAjax() {
        return $this->renderPartial('ajax', array(
            'currencies' => $this->currencies,
        ));
    }

    public function actionImages(){
        Yii::$app->db->createCommand()->delete(
            'courses','date<:date', array('date' => Yii::$app->config->curTime() - 2*3600
        ));
        $delay = config('valutdelay')*config('valutpixels');
        foreach($this->currencies as $pos => $currency) {
            $q = '
		SELECT *
		FROM (
			(
				SELECT *
				FROM courses
				WHERE currency='.$arr[$i]['id'].'
				AND date<'.template::get()->time().'-'.$delay.'
				ORDER BY date DESC LIMIT 1
			)UNION ALL(
				SELECT * FROM courses
				WHERE currency='.$arr[$i]['id'].'
				AND date>='.template::get()->time().'-'.$delay.'
			)
		) AS c
		ORDER BY c.date ASC';
            $dates = db::get()->get_all($q);
            $p = sizeof($dates)-1;
            if(template::get()->time()-config('valutdelay')>=$dates[$p]['date']){
                $price = $dates[$p]['price'];
                $date = max($dates[$p]['date']+config('valutdelay'),template::get()->time()-$delay-config('valutdelay'));
                for(;$date<=template::get()->time();$date+=config('valutdelay')){
                    if($arr[$i]['default']<$dates[$p]['price']){
                        $price = $dates[$p]['price']*rand(98,101)/100;
                    }else{
                        $price = $dates[$p]['price']*rand(99,102)/100;
                    }
                    $temp = array('currency'=>$arr[$i]['id'],
                                  'date'=>$date,
                                  'price'=>$price);
                    db::get()->insert('courses',$temp);
                    $dates[] = $temp;
                    $p++;
                }
                $file = 'images/templates/currency.png';
                $out = 'images/download/currency'.$arr[$i]['id'].'.png';
                //        left,top,right,bottom
                $margin = array(10,10,10,10);
                $im = imagecreatefrompng($file);
                imageAlphaBlending($im, false);
                imageSaveAlpha($im, true);
                //$im = imagecreatetruecolor(300,200);
                //imagefill($im,0,0,imagecolorallocate($im,255,255,255));
                $size = getimagesize($file);
                $w = $size[0];
                $h = $size[1];
                $start_x = $margin[0];
                $start_y = $margin[1];
                $clien_w = $w - $margin[0]-$margin[2];
                $clien_h = $h - $margin[1]-$margin[3];
                $color = imagecolorallocate($im,$arr[$i]['r'],$arr[$i]['g'],$arr[$i]['b']);
                $text_color = imagecolorallocate($im,0,0,0);
                $sizer_y = $arr[$i]['default'];//$dates[0]['price'];
                $last_x = $clien_w*($dates[0]['date']+$delay-template::get()->time())/$delay;
                if($last_x < 0) $last_x = 0;
                $last_y = $clien_h/2 + 2*$clien_h*($sizer_y-$dates[0]['price'])/$sizer_y;
                for($j=0,$m=sizeof($dates);$j<$m;$j++){
                    $x = $clien_w*($dates[$j]['date']+$delay-template::get()->time())/$delay;
                    if($x < 0) $x = 0;
                    $y = $clien_h/2 + 2*$clien_h*($sizer_y-$dates[$j]['price'])/$sizer_y;
                    //printf('%3d %3d <br>',$x,$y);
                    if($x){
                        imageline($im,$start_x+$last_x,$start_y+$last_y,
                            $start_x+$x,$start_y+$y,$color);
                        if(($j+1)%10==0){
                            imagestring($im,3,$start_x+$x-15,$start_y+$y-12,sprintf('%.2f',$dates[$j]['price']),$text_color);
                        }
                    }
                    $last_x = $x;
                    $last_y = $y;
                }
                imagepng($im,$out);
                db::get()->update('currencies',array('course'=>$dates[sizeof($dates)-1]['price']),$arr[$i]['id']);
            }
            $arr[$i]['lastchange'] = config('valutdelay')-template::get()->time()+$dates[sizeof($dates)-1]['date'];
        }
    }

    public function actionCreate () {
        $model = new Currency;

        if (isset($_POST['Currency'])) {
            $model->attributes = $_POST['Currency'];
            if ($model->save()) {
                $this->redirect(array('view',
                    'id'=> $model->id));
            }
        }

        return $this->render('create', array(
            'model'=> $model,
        ));
    }

    /**
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate ($id) {
        $model = $this->loadModel($id);

        if (isset($_POST['Currency'])) {
            $model->attributes = $_POST['Currency'];
            if ($model->save()) {
                $this->redirect(array('view',
                    'id'=> $model->id));
            }
        }

        return $this->render('update', array(
            'model'=> $model,
        ));
    }

    /**
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete ($id) {
        if (Yii::$app->request->isPostRequest) {
            $this->loadModel($id)->delete();

            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex () {
        $dataProvider = new CActiveDataProvider('Currency');
        return $this->render('index', array(
            'dataProvider'=> $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin () {
        $model = new Currency('search');
        $model->unsetAttributes();
        if (isset($_GET['Currency'])) {
            $model->attributes = $_GET['Currency'];
        }

        return $this->render('admin', array(
            'model'=> $model,
        ));
    }


}
