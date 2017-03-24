<?php
/**
 * Created by PhpStorm.
 * User: TuanPham
 * Date: 11/19/2016
 * Time: 9:09 PM
 */
namespace frontend\widgets;

use common\models\Category;
use common\models\Slide;
use yii\base\Widget;
use Yii;

class HomeSlide extends Widget{

    public $message;

    public  function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }

    public  function run()
    {
        $slide = Slide::find()
            ->andWhere(['status' => Slide::STATUS_ACTIVE])
            ->andWhere(['type'=> Slide::SLIDE_HOME])
            ->all();
        return $this->render('home-slide',[
            'slide'=>$slide
        ]);
    }
}