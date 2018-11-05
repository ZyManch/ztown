<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ренат
 * Date: 17.07.12
 * Time: 7:45
 * To change this template use File | Settings | File Templates.
 * @var Friends $family
 */
?>
<?php if($family->Confirm):?>
    <?php if ($family->userFrom->sex == User::FAMALE):?>
        <?=$family->userFrom->login;?> отказалась выходить за Вас замуж
    <?php else:?>
        <?=$family->userFrom->login;?> передумал выходить за Вас замуж
    <?php endif;?>
<?php else:?>
    <?php if ($family->userFrom->sex == User::FAMALE):?>
        <?=$family->userFrom->login;?> подала на развод
    <?php else:?>
        <?=$family->userFrom->login;?> подал на развод
    <?php endif;?>
<?php endif;?>