<?php

namespace app\models;

use Yii;

class TicketWithTime extends Ticket {
  public $totalEffort;
  public $indexator;
  public $executor_ID;
  
  /**
   * @return \yii\db\ActiveQuery
   */
  public function getExecutor()
  {
      return $this->hasOne(users::className(), ['user_id' => 'executor_ID']);
  }
}

