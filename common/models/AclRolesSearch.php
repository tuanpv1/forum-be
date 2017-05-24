<?php

namespace common\models;

use common\models\AclRoles;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * AclRolesSearch represents the model behind the search form about `common\models\AclRoles`.
 */
class AclRolesSearch extends AclRoles
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'role_order'], 'integer'],
            [['role_name', 'role_description', 'role_type'], 'safe'],
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
        $query = AclRoles::find()->andWhere(['status'=>AclRoles::STATUS_ACTIVE]);

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
            'role_id' => $this->role_id,
            'role_order' => $this->role_order,
        ]);

        $query->andFilterWhere(['like', 'role_name', $this->role_name])
            ->andFilterWhere(['like', 'role_description', $this->role_description])
            ->andFilterWhere(['like', 'role_type', $this->role_type]);
        $query->orderBy(['role_name'=>SORT_ASC,'role_order'=>SORT_ASC]);
        return $dataProvider;
    }
}
