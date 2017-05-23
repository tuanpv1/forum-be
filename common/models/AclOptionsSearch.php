<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AclOptions;

/**
 * AclOptionsSearch represents the model behind the search form about `common\models\AclOptions`.
 */
class AclOptionsSearch extends AclOptions
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['auth_option_id', 'is_global', 'is_local', 'founder_only'], 'integer'],
            [['auth_option', 'description'], 'safe'],
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
        $query = AclOptions::find();

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
            'auth_option_id' => $this->auth_option_id,
            'is_global' => $this->is_global,
            'is_local' => $this->is_local,
            'founder_only' => $this->founder_only,
        ]);

        $query->andFilterWhere(['like', 'auth_option', $this->auth_option])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
