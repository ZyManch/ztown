<?php
/**
 * @var string $userLeft
 * @var string $userRight
 * @var int $damage
 * @var int $text
 */
$userLeft = '<span class="red_text">'.$userLeft.'</span>';
$userRight = '<span class="red_text">'.$userRight.'</span>';
$damage = '<span class="lime_text">'.$damage.'</span>';
switch ($text):
    case 0:?>
	<?=$userLeft;?> наглядно сравнил площади поверхности своего правого кулака и щеки <?=$userRight;?>, нанеся при этом <?=$damage;?> урона.
<?php break;
    case 1:?>
    <?=$userLeft;?> сделал подножку <?=$userRight;?>, больно - очень больно, <?=$userRight;?> теряет <?=$damage;?> жизней.
<?php break;
    case 2:?>
    Сколько бы <?=$userRight;?> не пытался уклониться, хаотичное махания руками <?=$userLeft;?> настигают свою цель, и отнимают <?=$damage;?> жизней.
<?php break;
    case 3:?>
    <?=$userLeft;?> давно не стриг ногти, и в этом бою против <?=$userRight;?> они очень пригодились - расцарапав его лицо на <?=$damage;?> урона.
<?php break;
    case 4:?>
    <?=$userLeft;?> ударил апперкотом <?=$userRight;?> по подбородку на <?=$damage;?> урона.
<?php break;
    case 5:?>
    <?=$userLeft;?> в прыжке ударил коленом <?=$userRight;?> по лбу, тем самым потратив <?=$damage;?> жизней.
<?php break;
    case 6:?>
    <?=$userLeft;?> возомнил себя сумо, разогнался и пузом сумел столкнуть <?=$userRight;?>. <?=$userLeft;?> получает <?=$damage;?> урона, а <?=$userLeft;?> остаеться с пивным пузом.
<?php break;
    case 7:?>
    <?=$userLeft;?> искустно показал себя мастером дзюдо, сумел сделать ошеломляющий трюк, и перебросил <?=$userRight;?> через себя, нанеся тем самым <?=$damage;?> урона.
<?php break;
    case 8:?>
    <?=$userLeft;?> пнул <?=$userRight;?> на <?=$damage;?> урона.
<?php break;
    case 9:?>
    <?=$userLeft;?> мощным ударом руки выбил зуб <?=$userRight;?>, потерял зуб - потерял <?=$damage;?> жизней.
<?php break;
    case 10:?>
    <?=$userLeft;?> попытался ударить <?=$userRight;?>, но мимо.
<?php break;
    case 11:?>
    Подножка <?=$userLeft;?> закончилась неудачно.
<?php break;
    case 12:?>
    <?=$userLeft;?> не смог пробить защиту <?=$userRight;?>.
<?php break;
    case 13:?>
    Хаотическое махание руками <?=$userLeft;?> даже не задело <?=$userRight;?>.
<?php break;
    case 14:?>
    <?=$userLeft;?> попытался пнуть <?=$userRight;?>, но был достаточно слаб, чтобы нанести хоть какой-то вред.
<?php break;
    case 15:?>
    <?=$userLeft;?> попытался перекинуть через себя <?=$userRight;?>, но <?=$userLeft;?> оказался слишком тяжолым.
<?php break;
    case 16:?>
    Харчок <?=$userLeft;?> по <?=$userRight;?> нанес только моральный урон, но не физический.
<?php break;
    case 17:?>
    <?=$userLeft;?> побоялся атаковать <?=$userRight;?>.
<?php break;
    case 18:?>
    <?=$userLeft;?> не решил ударить <?=$userRight;?>.
<?php break;
    case 19:?>
    <?=$userLeft;?> испугался зловещей ауры <?=$userRight;?> и остался стоять на месте.
<?php break;
    case 20:?>
    <?=$userLeft;?> сделал удар рукой по <?=$userRight;?>, но даже и не думал что попадет по челюсти. <?=$userRight;?> теряет <?=$damage;?> здоровья.
<?php break;
    case 21:?>
    <?=$userLeft;?> сделал подножку <?=$userRight;?> и <?=$userRight;?> неудачно упал, потеряв при этом <?=$damage;?> жизней.
<?php break;
    case 22:?>
    <?=$userLeft;?> ударил головой по носу <?=$userRight;?>. Нос сломался - <?=$damage;?> жизней потеряно.
<?php break;
    case 23:?>
    <?=$userLeft;?> ловко кинул сотовый в <?=$userRight;?>. Сотовый ударился об лоб <?=$userRight;?>, и потратил <?=$damage;?> жизней.
<?php break;
    case 24:?>
    <?=$userLeft;?> ударил <?=$userRight;?> по синяку на руке. Удар по синяку оказался болезненым и потратил <?=$damage;?> жизней.
<?php break;
    case 25:?>
    <?=$userRight;?> разбежался для удара и упал, вывихнув ногу. Вот как можно нанести самому себе <?=$damage;?> урону.
<?php break;
    case 26:?>
    <?=$userLeft;?> нечаяно ударил по болевой точке <?=$userRight;?> и потратил, тем самым, <?=$damage;?> жизней.
<?php break;
    case 27:?>
    <?=$userLeft;?> выкрутил руку <?=$userRight;?>. Последовал хруст. Перелом? наверное нет, но <?=$damage;?> жизней <?=$userRight;?> все же теряет.
<?php break;
    case 28:?>
    <?=$userRight;?> попытался атаковать <?=$userLeft;?>, но промахнулся и попал по стене. Стена и <?=$userRight;?> теряют по <?=$damage;?> жизней.
<?php break;
    case 29:?>
    <?=$userRight;?> при атаке вывихнул плечо. Плечо отняло своему обладателю <?=$damage;?>` урону.
<?php endswitch; ?>