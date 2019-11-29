<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<option value="" selected disabled>—</option>
<?php
  foreach ($data as $item): ?>
<option value="<?=$item->{$fieldid} ?>" data-up="<?=$item->{$parent_fieldid} ?>"><?=Html::encode("{$item->Name}") ?></option>
<?php
  endforeach ?>