<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<option value="" disabled<?php if (count($data) > 1) echo ' selected' ?>>—</option>
<?php
  foreach ($data as $item): ?>
<option value="<?=$item->{$fieldid} ?>"><?=Html::encode("{$item->name}") ?></option>
<?php
  endforeach ?>