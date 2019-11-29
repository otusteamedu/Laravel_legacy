<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php
  foreach ($data as $item): ?>
<option value="<?=$item->{$fieldid} ?>"<?=array_search($item->{$fieldid}, $alreadySet) === false ? '' : ' selected'?>><?=Html::encode("{$item->name}") ?></option>
<?php
  endforeach ?>