<?php
/**
 * @var User $user
 */
$itemsUsed = $user->itemsUsed();
foreach ($itemsUsed as $key => $item) {
    echo $this->render('//itemsbuied/_item', array(
        'type' => $key,
        'info' => $item
    ));
}