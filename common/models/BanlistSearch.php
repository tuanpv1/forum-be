<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Banlist;

/**
 * BanlistSearch represents the model behind the search form about `common\models\Banlist`.
 */
class BanlistSearch extends Banlist
{
    public $type;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ban_id', 'ban_userid', 'ban_start', 'ban_end', 'ban_exclude'], 'integer'],
            [['ban_ip', 'ban_email', 'ban_reason', 'ban_give_reason','type'], 'safe'],
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
        $query = Banlist::find();

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
        if($this->type){
            if($this->type == Banlist::TYPE_USER){
                $query->andWhere('ban_userid <> :ban_userid_pa',['ban_userid_pa'=>0]);
            }
            if($this->type == Banlist::TYPE_IP){
                $query->andWhere('ban_ip <> :ban_ip_pa',['ban_ip_pa'=>'']);
            }
            if($this->type == Banlist::TYPE_EMAIL){
                $query->andWhere('ban_email <> :ban_email_pa',['ban_email_pa'=>'']);
            }
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'ban_start' => $this->ban_start,
            'ban_end' => $this->ban_end,
            'ban_exclude' => $this->ban_exclude,
        ]);

        $query->andFilterWhere(['like', 'ban_ip', $this->ban_ip])
            ->andFilterWhere(['like', 'ban_email', $this->ban_email])
            ->andFilterWhere(['like', 'ban_reason', $this->ban_reason])
            ->andFilterWhere(['like', 'ban_give_reason', $this->ban_give_reason]);

        return $dataProvider;
    }
}
