<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Order_book".
 *
 * @property int $order_id
 * @property int $book_id
 */
class OrderBook extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Order_book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'book_id'], 'required'],
            [['order_id', 'book_id'], 'integer'],
            [['order_id', 'book_id'], 'unique', 'targetAttribute' => ['order_id', 'book_id']],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::className(), 'targetAttribute' => ['book_id' => 'id_book']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'book_id' => 'Book ID',
        ];
    }

    /**
     * {@inheritdoc}
     * @return OrderBookQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderBookQuery(get_called_class());
    }
}
