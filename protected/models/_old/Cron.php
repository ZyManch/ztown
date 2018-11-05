<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ZyManch
 * Date: 21.10.12
 * Time: 11:00
 */
class Cron extends CComponent{

    const WEEKDAY = 'weekday';
    const MONTHS = 'months';
    const DAYS = 'days';
    const HOURS = 'hours';
    const MINUTS = 'minuts';

    protected $_crontab = array();

    public $filename;

    public function init() {
        $cronTab = \Yii::$app->cache->get('crontab');
        if ($cronTab) {
            $this->_crontab = $cronTab;
        } else {
            $this->_crontab = $this->getCrontabFromFile($this->filename);
            //\Yii::$app->cache->set('crontab', $this->_crontab);
        }
    }

    public function isNotCronLine($line) {
        return $line && $line[0] != '#';
    }

    protected function getCrontabFromFile($filename) {
        $return = array();
        $lines = array_map('trim',file($filename));
        $lines = array_filter($lines, array($this, 'isNotCronLine'));
        foreach ($lines as $command) {
            $command = explode(' ', $command);
            $arg = trim(array_pop($command));
            $executer = basename(array_pop($command));
            if ($executer == 'cron.php') {
                $return[$arg][] = array(
                    self::WEEKDAY  => $this->parseCronTabParam($command[4],1, 7),
                    self::MONTHS   => $this->parseCronTabParam($command[3],1, 12),
                    self::DAYS     => $this->parseCronTabParam($command[2],1, 31),
                    self::HOURS    => $this->parseCronTabParam($command[1],0, 23),
                    self::MINUTS   => $this->parseCronTabParam($command[0],0, 59)
                );
            }
        }
        return $return;
    }

    public function getSecondsToRun($module) {
        $secondsToRun = 3600*24*7;
        if(!isset($this->_crontab[$module])) {
            return $secondsToRun;
        }
        $curentDate = date('N.m.d.H.i');
        $dates = explode('.', $curentDate);
        $weekday = $dates[0];
        $month = $dates[1];
        $day = $dates[2];
        $hour = $dates[3];
        $minute = $dates[4] + 1;
        foreach ($this->_crontab[$module] as $timeIntervals) {
            $addHour = 0;
            $addDay = 0;
            $interval = 0;
            $minutes = $this->findNextValue($minute, $timeIntervals[self::MINUTS], 60);
            $interval+=60*$minutes[1];
            if ($minutes[0] < $minute) {
                $addHour = 1;
            }
            $hours = $this->findNextValue($hour + $addHour, $timeIntervals[self::HOURS], 60);
            if ($hours[0] < $hour) {
                $addDay = 1;
            }
            if ($interval < $secondsToRun) {
                $secondsToRun = $interval;
            }
        }
        $secondsToRun+=60;
        return $secondsToRun;
    }

    protected function parseCronTabParam($value, $min, $max) {
        $result = array();
        if (strpos($value, '/')!==false) {
            $value = explode('/', $value, 2);
            for ($i=$min; $i<=$max; $i+=$value[1]) {
                $result[] = $i;
            }
        } else if ($value == '*') {
            $result = array_keys(array_fill($min, $max - $min + 1, true));
        } else {
            $value = explode(',', $value);
            foreach ($value as $time) {
                if (strpos($time, '-')!==false) {
                    $time = explode('-', $time);
                    for ($i=$time[0]; $i<=$time[1];$i++) {
                        $result[] = $i;
                    }
                } else {
                    $result[] = $time;
                }
            }
        }
        return $result;
    }

    protected function findNextValue($value, $array, $maxSize) {
        $nextValue = $value;
        $beetwen = $maxSize;
        foreach ($array as $item) {
            if ($item < $value) {
                if ($maxSize - $value + $item < $beetwen) {
                    $nextValue = $item;
                    $beetwen = $maxSize - $value + $item;
                }
            } else {
                if ($item - $value < $beetwen) {
                    $nextValue = $item;
                    $beetwen = $item - $value;
                }
            }
        }
        return array($nextValue, $beetwen);
    }
}