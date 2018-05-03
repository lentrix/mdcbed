<?php
use yii\helpers\Html;
?>


<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?= Html::a(Yii::$app->name, ['/site/index'],['class'=>'navbar-brand']) ?>
    </div>

    <div class="collapse navbar-collapse" id="navbar-collapse-1">
      
      <ul class="nav navbar-nav navbar-right">
        <li>
          <?= Html::a('<i class="glyphicon glyphicon-exclamation-sign"></i> Notifications', ['/notifications/index']);?>
        </li>
        <li><?= Html::a('<i class="glyphicon glyphicon-envelope"></i> Messages', ['/messages/index']);?></li>
        <li><?= Html::a('<i class="glyphicon glyphicon-question-sign"></i> About', ['/site/about']);?></li>
        <li>
          <?= Html::a('<i class="glyphicon glyphicon-log-out"></i> Logout', ['/site/logout'],
          [
            'data'=>[
              'method' => ['post']
            ]
          ]) ?>
        </li>
      </ul>
    </div>
  </div>
</nav>