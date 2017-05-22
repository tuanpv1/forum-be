<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "phpbb_forums".
 *
 * @property string $forum_id
 * @property string $parent_id
 * @property string $left_id
 * @property string $right_id
 * @property string $forum_parents
 * @property string $forum_name
 * @property string $forum_desc
 * @property string $forum_desc_bitfield
 * @property string $forum_desc_options
 * @property string $forum_desc_uid
 * @property string $forum_link
 * @property string $forum_password
 * @property string $forum_style
 * @property string $forum_image
 * @property string $forum_rules
 * @property string $forum_rules_link
 * @property string $forum_rules_bitfield
 * @property string $forum_rules_options
 * @property string $forum_rules_uid
 * @property integer $forum_topics_per_page
 * @property integer $forum_type
 * @property integer $forum_status
 * @property string $forum_last_post_id
 * @property string $forum_last_poster_id
 * @property string $forum_last_post_subject
 * @property string $forum_last_post_time
 * @property string $forum_last_poster_name
 * @property string $forum_last_poster_colour
 * @property integer $forum_flags
 * @property integer $display_on_index
 * @property integer $enable_indexing
 * @property integer $enable_icons
 * @property integer $enable_prune
 * @property string $prune_next
 * @property string $prune_days
 * @property string $prune_viewed
 * @property string $prune_freq
 * @property integer $display_subforum_list
 * @property string $forum_options
 * @property string $forum_posts_approved
 * @property string $forum_posts_unapproved
 * @property string $forum_posts_softdeleted
 * @property string $forum_topics_approved
 * @property string $forum_topics_unapproved
 * @property string $forum_topics_softdeleted
 * @property integer $enable_shadow_prune
 * @property string $prune_shadow_days
 * @property string $prune_shadow_freq
 * @property integer $prune_shadow_next
 * @property integer $rh_topictags_enabled
 * @property integer $forum_status_display
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phpbb_forums';
    }

    const STATUS_ACTIVE = 10;
    const STATUS_INACTIVE = 0;
    const STATUS_BLOCK = 1;

    const CHILD_NODE_PREFIX = '|--';

    private static $catTree = array();

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['forum_name','forum_parents','forum_desc'], 'required', 'message' => '{attribute} không được để trống', 'on' => 'admin_create_update'],
            [['parent_id', 'left_id', 'right_id', 'forum_desc_options',
                'forum_style', 'forum_rules_options', 'forum_topics_per_page',
                'forum_type', 'forum_status', 'forum_last_post_id', 'forum_last_poster_id',
                'forum_last_post_time', 'forum_flags', 'display_on_index', 'enable_indexing',
                'enable_icons', 'enable_prune', 'prune_next', 'prune_days', 'prune_viewed',
                'prune_freq', 'display_subforum_list', 'forum_options', 'forum_posts_approved',
                'forum_posts_unapproved', 'forum_posts_softdeleted', 'forum_topics_approved',
                'forum_topics_unapproved', 'forum_topics_softdeleted', 'enable_shadow_prune',
                'prune_shadow_days', 'prune_shadow_freq', 'prune_shadow_next',
                'rh_topictags_enabled', 'forum_status_display'
            ], 'integer'],
            [['forum_parents', 'forum_desc', 'forum_rules'], 'string'],
            [['forum_name', 'forum_desc_bitfield', 'forum_link', 'forum_password', 'forum_image', 'forum_rules_link', 'forum_rules_bitfield', 'forum_last_post_subject', 'forum_last_poster_name'], 'string', 'max' => 255],
            [['forum_desc_uid', 'forum_rules_uid'], 'string', 'max' => 8],
            [['forum_last_poster_colour'], 'string', 'max' => 6],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'forum_id' => 'Forum ID',
            'parent_id' => 'Danh mục cha',
            'left_id' => 'Left ID',
            'right_id' => 'Right ID',
            'forum_parents' => 'Forum Parents',
            'forum_name' => 'Tên danh mục',
            'forum_desc' => 'Mô tả danh mục',
            'forum_desc_bitfield' => 'Forum Desc Bitfield',
            'forum_desc_options' => 'Forum Desc Options',
            'forum_desc_uid' => 'Forum Desc Uid',
            'forum_link' => 'Forum Link',
            'forum_password' => 'Forum Password',
            'forum_style' => 'Forum Style',
            'forum_image' => 'Forum Image',
            'forum_rules' => 'Forum Rules',
            'forum_rules_link' => 'Forum Rules Link',
            'forum_rules_bitfield' => 'Forum Rules Bitfield',
            'forum_rules_options' => 'Forum Rules Options',
            'forum_rules_uid' => 'Forum Rules Uid',
            'forum_topics_per_page' => 'Số hiển thị trên 1 trang',
            'forum_type' => 'Forum Type',
            'forum_status' => 'Forum Status',
            'forum_last_post_id' => 'Forum Last Post ID',
            'forum_last_poster_id' => 'Forum Last Poster ID',
            'forum_last_post_subject' => 'Forum Last Post Subject',
            'forum_last_post_time' => 'Forum Last Post Time',
            'forum_last_poster_name' => 'Forum Last Poster Name',
            'forum_last_poster_colour' => 'Forum Last Poster Colour',
            'forum_flags' => 'Forum Flags',
            'display_on_index' => 'Display On Index',
            'enable_indexing' => 'Enable Indexing',
            'enable_icons' => 'Enable Icons',
            'enable_prune' => 'Enable Prune',
            'prune_next' => 'Prune Next',
            'prune_days' => 'Prune Days',
            'prune_viewed' => 'Prune Viewed',
            'prune_freq' => 'Prune Freq',
            'display_subforum_list' => 'Display Subforum List',
            'forum_options' => 'Forum Options',
            'forum_posts_approved' => 'Forum Posts Approved',
            'forum_posts_unapproved' => 'Forum Posts Unapproved',
            'forum_posts_softdeleted' => 'Forum Posts Softdeleted',
            'forum_topics_approved' => 'Forum Topics Approved',
            'forum_topics_unapproved' => 'Forum Topics Unapproved',
            'forum_topics_softdeleted' => 'Forum Topics Softdeleted',
            'enable_shadow_prune' => 'Enable Shadow Prune',
            'prune_shadow_days' => 'Prune Shadow Days',
            'prune_shadow_freq' => 'Prune Shadow Freq',
            'prune_shadow_next' => 'Prune Shadow Next',
            'rh_topictags_enabled' => 'Rh Topictags Enabled',
            'forum_status_display' => 'Trạng thái',
        ];
    }

    public static function getListStatus()
    {
        return [
            self::STATUS_ACTIVE => 'Đang hoạt động',
            self::STATUS_INACTIVE => 'Xóa',
            self::STATUS_BLOCK => 'Tạm khóa',
        ];
    }

    public function getStatusName()
    {
        $listStatus = self::getListStatus();
        if (isset($listStatus[$this->forum_status_d])) {
            return $listStatus[$this->status];
        }
        return '';
    }

    public static function getAllCategories($cat_id = null, $recursive = true)
    {
        $res = [];
        if ($cat_id != null) {
            $model = Category::findOne(['forum_id' => $cat_id]);

            if ($model === null) {
                throw new NotFoundHttpException(404, "The requested Vod Category (#$cat_id) does not exist.");
            }

            //Thuc: them 'order'=>'order_number ASC' trong ham relations
            $children = $model->getBECategories();

            if ($children) {
                foreach ($children as $child) {
                    /** @var  $child Category */
                    $path = "";
                    $path .= Category::CHILD_NODE_PREFIX;
//                    $child->name = $path . $child->name;
                    $child->forum_name = $path . $child->forum_name;
                    $res[] = $child;
                    if ($recursive) {
                        $res = ArrayHelper::merge($res,
                            Category::getAllCategories($child->forum_id, $recursive));
                    }
                }
            }
        } else {
            $root_cats = Category::find()->andWhere(['parent_id' => 0])
                ->orderBy(['right_id' => SORT_DESC])->all();
            if ($root_cats) {
                foreach ($root_cats as $cat) {
                    /* @var $cat Category */
                    $res[] = $cat;
                    if ($recursive) {
                        $res = ArrayHelper::merge($res,
                            Category::getAllCategories($cat->forum_id, $recursive));
                    }
                }
            }
        }

        return $res;
    }

    public function getBECategories()
    {
        return $this->hasMany(Category::className(), ['parent_id' => 'forum_id'])
            ->orderBy(['right_id' => SORT_DESC])->all();

    }


    public static function getTreeCategories()
    {
        return ArrayHelper::map(Category::getAllCategories(null, true), 'forum_id', 'forum_name');
    }

    public static function getAllChildCats($parent = null)
    {
        if ($parent === null) {
            return [];
        }

        static $listCat = [];

        $cats = self::findAll(['parent_id' => $parent]);

        if (!empty($cats)) {
            foreach ($cats as $cat) {

                $listCat[$cat->forum_id] = ['disabled' => true];
                self::getAllChildCats($cat->forum_id);
            }
        }

        return $listCat;
    }
}
