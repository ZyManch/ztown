<?php
/**
 * @var Messages $data
 * @var string   $userKey
 */
$isReaded = $data->readed == 'Y';
?>

<tr<?php if (!$isReaded):?> class="notreaded"<?php endif;?>>
    <td><?=$data->id;?></td>
    <td>
        <?=Html::a($data->title ? $data->title : '&lt;без темы&gt;', array('messages/view', 'id' => $data->id));?>
    </td>
    <td>
        <?=Html::a($data->$userKey->userName(), array('user/view', 'id'=>$data->$userKey->id));?>
   </td>
    <td>
        <?=Yii::$app->dateFormatter->formatDateTime($data->created);?>
    </td>
</tr>