<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>

<?= Html::beginForm($action,'post',['enctype'=>'multipart/form-data']);?>
    <input type="hidden" name="id" value="<?= $id ?>">
    <!-- input file -->
    <div class="box">
        <input type="file" id="file-input">
    </div>
    <!-- leftbox -->
    <div class="box-2">
        <div class="result"></div>
    </div>
    <!--rightbox-->
    <div class="box-2 img-result hide">
        <!-- result of crop -->
        <img class="cropped" src="" alt="">
    </div>
    <!-- input file -->
    <div class="box">
        <div class="options hide">
            <label> Width</label>
            <input type="number" class="img-w" value="300" min="100" max="1200" />
        </div>
        <input type="hidden" name="cropped" id="croppedInput" />
        <!-- save btn -->
        <button class="btn save hide">Crop</button>
        <!-- download btn -->
        <button type="submit" class="btn download hide">Submit</button>
    </div>
<?= Html::endForm(); ?>

