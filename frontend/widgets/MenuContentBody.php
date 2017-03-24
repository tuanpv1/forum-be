<?php
/**
 * Created by PhpStorm.
 * User: TuanPham
 * Date: 11/19/2016
 * Time: 9:09 PM
 */
namespace frontend\widgets;

use common\models\Category;
use yii\base\Widget;
use Yii;

class MenuContentBody extends Widget{

    public $message;

    public  function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }

    public  function run()
    {

    }

    public function GetMenuBody($id){
        $cat = Category::findAll(['parent_id'=>$id]);
        return $this->render('menu-content-body',[
            'cat' => $cat
        ]);
    }
}