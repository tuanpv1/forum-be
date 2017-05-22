<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PhpbbGroups;

/**
 * PhpbbGroupsSearch represents the model behind the search form about `common\models\PhpbbGroups`.
 */
class PhpbbGroupsSearch extends PhpbbGroups
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'group_type', 'group_founder_manage', 'group_skip_auth', 'group_desc_options', 'group_display', 'group_avatar_width', 'group_avatar_height', 'group_rank', 'group_sig_chars', 'group_receive_pm', 'group_message_limit', 'group_legend', 'group_max_recipients'], 'integer'],
            [['group_name', 'group_desc', 'group_desc_bitfield', 'group_desc_uid', 'group_avatar', 'group_avatar_type', 'group_colour'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PhpbbGroups::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'group_id' => $this->group_id,
            'group_type' => $this->group_type,
            'group_founder_manage' => $this->group_founder_manage,
            'group_skip_auth' => $this->group_skip_auth,
            'group_desc_options' => $this->group_desc_options,
            'group_display' => $this->group_display,
            'group_avatar_width' => $this->group_avatar_width,
            'group_avatar_height' => $this->group_avatar_height,
            'group_rank' => $this->group_rank,
            'group_sig_chars' => $this->group_sig_chars,
            'group_receive_pm' => $this->group_receive_pm,
            'group_message_limit' => $this->group_message_limit,
            'group_legend' => $this->group_legend,
            'group_max_recipients' => $this->group_max_recipients,
        ]);

        $query->andFilterWhere(['like', 'group_name', $this->group_name])
            ->andFilterWhere(['like', 'group_desc', $this->group_desc])
            ->andFilterWhere(['like', 'group_desc_bitfield', $this->group_desc_bitfield])
            ->andFilterWhere(['like', 'group_desc_uid', $this->group_desc_uid])
            ->andFilterWhere(['like', 'group_avatar', $this->group_avatar])
            ->andFilterWhere(['like', 'group_avatar_type', $this->group_avatar_type])
            ->andFilterWhere(['like', 'group_colour', $this->group_colour]);

        return $dataProvider;
    }
}
