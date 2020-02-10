<?php

use yii\helpers\Html;
use yii\web\View;

/** @var $this View */
/** @var $id string */
/** @var $services stdClass[] See EAuth::getServices() */
/** @var $action string */
/** @var $popup bool */
/** @var $assetBundle string Alias to AssetBundle */

Yii::createObject(['class' => $assetBundle])->register($this);

// Open the authorization dilalog in popup window.
if ($popup) {
    $options = [];
    foreach ($services as $name => $service) {
        $options[$service->id] = $service->jsArguments;
    }
    $this->registerJs('$("#' . $id . '").eauth(' . json_encode($options) . ');');
}

?>
<div class="eauth" id="<?php echo $id; ?>">
    <ul class="eauth-list">
        <?php
        foreach ($services as $name => $service) {
            $icname = $name == 'google_oauth' ? 'google-plus' : $name;
            echo '<li class="eauth-service eauth-service-id-' . $service->id . '">';
            echo Html::a('<i class="fa fa-'.$icname.'"></i>'.$service->title, [$action, 'service' => $name], [
                'class' => 'eauth-service-link',
                'data-eauth-service' => $service->id,
            ]);
            echo '</li>';
        }
        ?>
    </ul>
</div>
