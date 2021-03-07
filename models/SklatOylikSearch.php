<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sklat;

/**
 * SklatOylikSearch represents the model behind the search form of `app\models\Sklat`.
 */
class SklatOylikSearch extends Sklat
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'kirim_miqdor', 'chiqim_miqdor', 'qoldiq'], 'integer'],
            [['nomi', 'sana'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Sklat::find();

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
            'id' => $this->id,
            'kirim_miqdor' => $this->kirim_miqdor,
            'chiqim_miqdor' => $this->chiqim_miqdor,
            'qoldiq' => $this->qoldiq,
            'sana' => $this->sana,
        ]);

        $query->andFilterWhere(['like', 'nomi', $this->nomi]);

        return $dataProvider;
    }
}
