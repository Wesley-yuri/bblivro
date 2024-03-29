<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\book;

/**
 * BookSearch represents the model behind the search form of `common\models\book`.
 */
class BookSearch extends book
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'launch_date', 'created_at', 'updated_at'], 'integer'],
            [['title', 'author_book', 'genre_book'], 'safe'],
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
        $query = book::find();

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
            'launch_date' => $this->launch_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'author_book', $this->author_book])
            ->andFilterWhere(['like', 'genre_book', $this->genre_book]);

        return $dataProvider;
    }
}
