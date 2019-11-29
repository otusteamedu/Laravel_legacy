<?php
namespace app\controllers;

use Yii;
use app\models\Sla;
use app\models\SlaQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Projects;
use app\models\Products;
use app\models\Modules;
use yii\helpers\ArrayHelper;
use app\models\Messages;
use yii\helpers\Html;
use app\models\Users;
use yii\helpers\Url;
use app\models\Ticket;
ini_set('error_reporting', E_ALL);
//namespace app\controllers;

//use Yii;
use app\models\Messages;
use app\models\MessagesQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
echo "dsf";
$fp = fopen('D:\counter.txt', 'a');
var_dump($fp);
fopen("info.txt", "r");
echo "dfsdfds";
$searchModel = new MessagesQuery();
echo "<hr>";
var_dump($searchModel);
