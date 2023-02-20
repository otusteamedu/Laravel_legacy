<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UsersRoles */

$this->title = 'Добавление ролей пользователю';

?>
<div style='width:500px;'>
<div class="users-roles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
    </div>
