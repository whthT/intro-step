<?php

return [
    "web_middleware" => ["web","auth"],
    "api_middleware" => ["web", "auth"],
    "user_table" => "users",
    "user_column" => "user_id",
    "user_model" => "\\App\\User",


    "default_options" => [
        "nextLabel" => [
            "value" => "nextLabelValue",
            "rule" => "required|string|max:50",
            "attribute" => "nextLabelAttribute",
            "type" => "text"
        ],
        "prevLabel" => [
            "value" => "prevLabelValue",
            "rule" => "nullable|string|max:50",
            "attribute" => "prevLabelAttribute",
            "type" => "text"
        ],
        "skipLabel" => [
            "value" => "skipLabelValue",
            "rule" => "nullable|string|max:50",
            "attribute" => "skipLabelAttribute",
            "type" => "text"
        ],
        "doneLabel" => [
            "value" => "doneLabelValue",
            "rule" => "nullable|string|max:50",
            "attribute" => "doneLabelAttribute",
            "type" => "text"
        ],
        "hintButtonLabel" => [
            "value" => "hintButtonLabelValue",
            "rule" => "nullable|string|max:50",
            "attribute" => "hintButtonLabelAttribute",
            "type" => "text"
        ],
        "tooltipPosition" => [
            "value" => "bottom",
            "rule" => "nullable|string|in:top,bottom,left,right",
            "attribute" => "tooltipPositionAttribute",
            "type" => "enum",
            "options" => ["top", "bottom", "left", "right"]
        ],
        "tooltipClass" => [
            "value" => "",
            "rule" => "nullable|string|max:250",
            "attribute" => "tooltipClassAttribute",
            "type" => "text"
        ],
        "highlightClass" => [
            "value" => "",
            "rule" => "nullable|string|max:250",
            "attribute" => "highlightClassAttribute",
            "type" => "text"
        ],
        "hidePrev" => [
            "value" => false,
            "rule" => "boolean",
            "attribute" => "hidePrevAttribute",
            "type" => "boolean"
        ],
        "hideNext" => [
            "value" => false,
            "rule" => "boolean",
            "attribute" => "hideNextAttribute",
            "type" => "boolean"
        ],
        "showStepNumbers" => [
            "value" => true,
            "rule" => "boolean",
            "attribute" => "showStepNumbersAttribute",
            "type" => "boolean"
        ],
        "keyboardNavigation" => [
            "value" => true,
            "rule" => "boolean",
            "attribute" => "keyboardNavigationAttribute",
            "type" => "boolean"
        ],
        "showButtons" => [
            "value" => true,
            "rule" => "boolean",
            "attribute" => "showButtonsAttribute",
            "type" => "boolean"
        ],
        "showBullets" => [
            "value" => true,
            "rule" => "boolean",
            "attribute" => "showBulletsAttribute",
            "type" => "boolean"
        ],
        "showProgress" => [
            "value" => false,
            "rule" => "boolean",
            "attribute" => "showProgressAttribute",
            "type" => "boolean"
        ],
        "scrollToElement" => [
            "value" => true,
            "rule" => "boolean",
            "attribute" => "scrollToElementAttribute",
            "type" => "boolean"
        ],
        "scrollPadding" => [
            "value" => 30,
            "rule" => "nullable|integer",
            "attribute" => "scrollPaddingAttribute",
            "type" => "numeric"
        ],
        "overlayOpacity" => [
            "value" => 0.8,
            "rule" => "nullable|numeric|max:1|min:0",
            "attribute" => "overlayOpacityAttribute",
            "type" => "numeric"
        ],
        "disableInteraction" => [
            "value" => false,
            "rule" => "boolean",
            "attribute" => "disableInteractionAttribute",
            "type" => "boolean"
        ],
        "helperElementPadding" => [
            "value" => 10,
            "rule" => "nullable|integer|min:0",
            "attribute" => "helperElementPaddingAttribute",
            "type" => "numeric"
        ],
        "hintPosition" => [
            "value" => "top-middle",
            "rule" => "required",
            "attribute" => "hintPositionAttribute",
            "type" => "enum",
            "options" => ["top-left","top-middle","top-right","bottom-left","bottom-middle","bottom-right"]
        ],
        "hintAnimation" => [
            "value" => true,
            "rule" => "boolean",
            "attribute" => "hintAnimationAttribute",
            "type" => "boolean"
        ],
        "buttonClass" => [
            "value" => "introjs-button",
            "rule" => "nullable|string|max:250",
            "attribute" => "buttonClassAttribute",
            "type" => "text"
        ],
        "exitOnEsc" => [
            "value" => false,
            "rule" => "boolean",
            "attribute" => "exitOnEscAttribute",
            "type" => "boolean"
        ],
        "exitOnOverlayClick" => [
            "value" => false,
            "rule" => "boolean",
            "attribute" => "exitOnOverlayClickAttribute",
            "type" => "boolean"
        ]
    ]
];