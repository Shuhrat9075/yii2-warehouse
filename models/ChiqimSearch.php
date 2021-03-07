<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Chiqim;

/**
 * ChiqimSearch represents the model behind the search form of `app\models\Chiqim`.
 */
class ChiqimSearch extends Chiqim
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'miqdori_kg', 'narxi', 'jami_sum', 'berilgan_sum','qolgan_sum'], 'integer'],
            [['xaridor_id', 'ismi', 'nomi', 'sana'], 'safe'],
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
    public function search($params,$xaridor_id=null)
    {
        $query = Chiqim::find();    

        
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
            'miqdori_kg' => $this->miqdori_kg,
            'narxi' => $this->narxi,
            'jami_sum' => $this->jami_sum,
            'berilgan_sum' => $this->berilgan_sum,
            'qolgan_sum' => $this->qolgan_sum,
            'sana' => $this->sana,
        ]);

        if($xaridor_id !=null)    
            $query->where(['xaridor_id'=>$xaridor_id]);
            
        $query->andFilterWhere(['like', 'xaridor_id', $this->xaridor_id])
            ->andFilterWhere(['like', 'ismi', $this->ismi   ])
            ->andFilterWhere(['like', 'nomi', $this->nomi])
            ->andFilterWhere(['like', 'sana', $this->sana]);

        return $dataProvider;
    }
   
    

}
