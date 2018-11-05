<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ренат
 * Date: 19.06.12
 * Time: 7:40
 * To change this template use File | Settings | File Templates.
 */
class Graph {

    protected $width;
    protected $height;
    protected $blank;
    protected $template;

    protected $minX;
    protected $maxX;
    protected $minY;
    protected $maxY;

    protected $lastX;
    protected $lastY;

    const PADDING_LEFT = 30;
    const PADDING_RIGHT = 10;
    const PADDING_TOP = 10;
    const PADDING_BOTTOM = 30;

    const TEXT_IN_GRAPH = 5;

    public function __construct($blank) {
        $this->blank = imagecreatefrompng($blank);
        imageAlphaBlending($this->blank, false);
        imageSaveAlpha($this->blank, true);
        $this->width = imagesx($this->blank);
        $this->height = imagesy($this->blank);
    }

    public function startDraw() {
        $this->template = clone $this->blank;
    }

    public function draw($data, $r, $g, $b) {
        $color = imagecolorallocate($this->template, $r, $g, $b);
        if (!$data) {
            $this->minX = 0;
            $this->maxX = 1;
            $this->minY = 0;
            $this->maxY = 1;
            $this->setPoint(0, 0);
            $this->setPoint(1, 0, $color);
            return;
        }
        $this->minX = null;
        $this->maxX = null;
        $this->minY = null;
        $this->maxY = null;
        $text_color = imagecolorallocate($this->template,0,0,0);
        foreach ($data as $pos => $value) {
            if (is_null($this->minX)|| $pos < $this->minX) {
                $this->minX = $pos;
            }
            if (is_null($this->maxX)|| $pos > $this->maxX) {
                $this->maxX = $pos;
            }
            if (is_null($this->minY)|| $value < $this->minY) {
                $this->minY = $value;
            }
            if (is_null($this->maxY)|| $value > $this->maxY) {
                $this->maxY = $value;
            }
        }

        $this->setPoint(0, $data[$this->minX]);
        $textIndex = 0;
        $textDelta = ($this->maxX - $this->minX)/self::TEXT_IN_GRAPH;
        foreach ($data as $x => $y) {
            $this->setPoint($x, $y, $color);
            if (floor(($x-$this->minX)/$textDelta) != $textIndex) {
                $this->setText($x, $y, sprintf('%.2f',$y),$text_color);
                $textIndex = floor(($x-$this->minX)/$textDelta);
            }
        }
    }

    protected function setText($x, $y, $text, $color) {
        imagestring(
            $this->template,
            3,
            $this->getClientX($x)-15,
            $this->getClientY($y)-12,
            $text,
            $color
        );
    }

    protected function setPoint($x, $y, $color = false) {
        $clientX = $this->getClientX($x);
        $clientY = $this->getClientX($y);
        if ($color) {
            imageline($this->template, $clientX, $clientY, $this->lastX, $this->lastY, $color);
        }
        $this->lastX = $clientX;
        $this->lastY = $clientX;;
    }

    protected function getClientX($x) {
        return self::PADDING_LEFT + ($this->maxX - $x)/($this->maxX - $this->minX) *
            ($this->width - self::PADDING_LEFT - self::PADDING_RIGHT);
    }

    protected function getClientY($y) {
        return self::PADDING_TOP + ($y - $this->minY)/($this->maxY - $this->minY) *
            ($this->height - self::PADDING_TOP - self::PADDING_BOTTOM);
    }

    public function save($fileName) {
        imagepng($this->template, $fileName);
    }
}