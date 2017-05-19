<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "phpbb_rh_topictags_tag".
 *
 * @property string $id
 * @property string $tag
 * @property string $count
 * @property string $tag_lowercase
 * @property integer $tag_status
 */
class Tags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phpbb_rh_topictags_tag';
    }
    public $viewAttr = [];
    const STATUS_ACTIVE = 10;
    const STATUS_BLOCK = 1;
    const STATUS_INACTIVE = 0;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag'], 'required', 'on' => 'adminModify', 'message' => '{attribute} không được để trống'],
            [['count', 'tag_status'], 'integer'],
            [['tag', 'tag_lowercase'], 'string', 'max' => 30],
            ['tag', 'validateUnique','on' => 'adminModify'],
            ['tag', 'validateSpecial','on' => 'adminModify'],
        ];
    }

    public static function getListStatus($type = 'all')
    {
        return ['all' => [
            self::STATUS_INACTIVE => Yii::t('app', 'Chưa duyệt'),
            self::STATUS_ACTIVE => Yii::t('app', 'Hiển thị'),
            self::STATUS_BLOCK => Yii::t('app', "Khóa")
        ],
            'filter' => [
                self::STATUS_INACTIVE => Yii::t('app', 'Chưa duyệt'),
                self::STATUS_ACTIVE => Yii::t('app', 'Hiển thị'),
                self::STATUS_BLOCK => Yii::t('app', "Khóa")
            ],
        ][$type];
    }

    public function validateUnique($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $tag = Tags::findTags($this->tag);
            if($tag){
                $this->addError($attribute, 'tag đã tồn tại trong hệ thống');
            }
        }
    }

    public function validateSpecial($attribute, $params){
        if(preg_match('/[^a-zA-Z0-9 -]+/i', $this->tag)){
            $this->addError($attribute,'Tag không được chứa ký tự đặc biệt, chỉ được chứa các ký tự -, 0-9, a-z, A-Z, spaces');
        }
    }

    public static function findTags($tag)
    {
        return static::findOne(['tag' => $tag, 'tag_status' => [self::STATUS_ACTIVE,self::STATUS_INACTIVE,self::STATUS_BLOCK]]);
    }

    public static function getStatus()
    {
        $ls = [
            self::STATUS_INACTIVE => Yii::t('app', 'Chưa duyệt'),
            self::STATUS_ACTIVE => Yii::t('app', "Hiển thị"),
            self::STATUS_BLOCK => Yii::t('app', "Khóa")

        ];
        return $ls;
    }

    public function getStatusName()
    {
        $lst = self::getStatus();
        if (array_key_exists($this->tag_status, $lst)) {
            return $lst[$this->tag_status];
        }
        return $this->tag_status;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tag' => 'Tag',
            'count' => 'Số lượt sử dụng',
            'tag_lowercase' => 'Tag Lowercase',
            'tag_status' => 'Trạng thái',
        ];
    }

    public function approve($status)
    {
        $this->tag_status = $status;

        return $this->update(false);
    }

    public function getCssStatus()
    {
        switch ($this->tag_status) {
            case self::STATUS_ACTIVE:
                return 'label label-primary';
            case self::STATUS_INACTIVE:
                return 'label label-warning';
            case self::STATUS_BLOCK:
                return 'label label-danger';
            default:
                return 'label label-primary';
        }
    }
}
