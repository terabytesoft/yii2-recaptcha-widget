<?php

namespace alexeevdv\recaptcha;

use \yii\helpers\Html;

class InputWidget extends \yii\widgets\InputWidget {
    
    /**
     * HTML input name
     * @var string
     */
    public $name = "recaptcha";

    /**
     * Site key
     * @var string 
     */
    public $siteKey;

    /**
     * Secret key
     * @var string
     */
    public $secret;
    
    /**
     * Html attributes
     * @var array
     */
    public $options = [];

    const JS_API = "https://www.google.com/recaptcha/api.js";
    
    public function run() {
        
        if(empty($this->siteKey)) {
            if (!\yii::$app->has("recaptcha") || empty(\yii::$app->recaptcha->siteKey)) {
                throw new \yii\base\InvalidConfigException("`siteKey` param is required");
            }
            $this->siteKey = \yii::$app->recaptcha->siteKey;
        }

        $this->view->registerJsFile(self::JS_API);
        
        $options = \yii\helpers\ArrayHelper::merge([
            "class" => "g-recapthca",
            "data-sitekey" => $this->siteKey,
        ], $this->options);

        return Html::tag("div", "", $options);
    }

}