<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 05.11.2018
 * Time: 14:38
 * @var \yii\data\ActiveDataProvider $dataProvider
 */

use components\Html;
use yii\grid\GridView;

?>
<?php
echo GridView::widget([
  'layout' => '{items}',
  'dataProvider' => $dataProvider,
  'tableOptions' => ['class' => 'default'],
  'columns' => [
      [
          'label' => 'Вид',
          'format'=>'raw',
          'contentOptions' => ['valign'=>'top'],
          'value' => function(\models\MapType $mapType){
              return Html::img('/'.$mapType->image());
          }
      ],
      [
          'label' => 'Описание',
          'format'=>'raw',
          'contentOptions' => ['valign'=>'top'],
          'value' => function(\models\MapType $mapType){
              return Html::tag('strong', $mapType->name).
                     Html::tag('br').
                     Html::tag('p', $mapType->info).
                     Html::buttonWithHref(
                         'Описание',
                         'images/info/help.png',
                         ['wiki-map/view','id'=>$mapType->map_type_id]
                     );
          }
      ],
  ]
]);