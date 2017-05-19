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

    const STATUS_ACTIVE = 10;
    const STATUS_BLOCK = 1;
    const STATUS_INACTIVE = 0;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['count', 'tag_status'], 'integer'],
            [['tag', 'tag_lowercase'], 'string', 'max' => 30],
            [['tag'], 'unique'],
        ];
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
}
