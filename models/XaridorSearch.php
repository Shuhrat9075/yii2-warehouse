<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use app\models\Xaridor;
use app\models\Chiqim;

/**
 * XaridorSearch represents the model behind the search form of `app\models\Xaridor`.
 */
class XaridorSearch extends Xaridor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['xaridor_id'], 'integer'],
            [['ismi', 'sana'], 'safe'],
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
        $query = Xaridor::find();
        
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
            'xaridor_id' => $this->xaridor_id,
            'sana' => $this->sana,
        ]);

        $query->andFilterWhere(['like', 'ismi', $this->ismi])
              ->andFilterWhere(['like', 'sana', $this->sana]);

        return $dataProvider;
    }
     
}
