<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "phpbb_groups".
 *
 * @property string $group_id
 * @property integer $group_type
 * @property integer $group_founder_manage
 * @property integer $group_skip_auth
 * @property string $group_name
 * @property string $group_desc
 * @property string $group_desc_bitfield
 * @property string $group_desc_options
 * @property string $group_desc_uid
 * @property integer $group_display
 * @property string $group_avatar
 * @property string $group_avatar_type
 * @property integer $group_avatar_width
 * @property integer $group_avatar_height
 * @property string $group_rank
 * @property string $group_colour
 * @property string $group_sig_chars
 * @property integer $group_receive_pm
 * @property string $group_message_limit
 * @property string $group_legend
 * @property string $group_max_recipients
 */
class Groups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phpbb_groups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_type', 'group_founder_manage', 'group_skip_auth', 'group_desc_options', 'group_display', 'group_avatar_width', 'group_avatar_height', 'group_rank', 'group_sig_chars', 'group_receive_pm', 'group_message_limit', 'group_legend', 'group_max_recipients'], 'integer'],
            [['group_desc'], 'required'],
            [['group_desc'], 'string'],
            [['group_name', 'group_desc_bitfield', 'group_avatar', 'group_avatar_type'], 'string', 'max' => 255],
            [['group_desc_uid'], 'string', 'max' => 8],
            [['group_colour'], 'string', 'max' => 6],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'group_id' => 'Group ID',
            'group_type' => 'Group Type',
            'group_founder_manage' => 'Group Founder Manage',
            'group_skip_auth' => 'Group Skip Auth',
            'group_name' => 'Group Name',
            'group_desc' => 'Group Desc',
            'group_desc_bitfield' => 'Group Desc Bitfield',
            'group_desc_options' => 'Group Desc Options',
            'group_desc_uid' => 'Group Desc Uid',
            'group_display' => 'Group Display',
            'group_avatar' => 'Group Avatar',
            'group_avatar_type' => 'Group Avatar Type',
            'group_avatar_width' => 'Group Avatar Width',
            'group_avatar_height' => 'Group Avatar Height',
            'group_rank' => 'Group Rank',
            'group_colour' => 'Group Colour',
            'group_sig_chars' => 'Group Sig Chars',
            'group_receive_pm' => 'Group Receive Pm',
            'group_message_limit' => 'Group Message Limit',
            'group_legend' => 'Group Legend',
            'group_max_recipients' => 'Group Max Recipients',
        ];
    }
}
