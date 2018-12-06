<?php

use Illuminate\Database\Seeder;

use App\Models\IntroStepSettings;

class IntroStepSettingsTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $options = [
            "nextLabel" => "Next &rarr;",
            "prevLabel" => "&larr; Back",
            "skipLabel" => "Skip",
            "doneLabel" => "Done",
            "hidePrev" => "false",
            "hideNext" => "false",
            "tooltipPosition" => 'bottom',
            "tooltipClass" => '',
            "highlightClass" => '',
            "showStepNumbers" => "true",
            "keyboardNavigation" => "true",
            "showButtons" => "true",
            "showBullets" => "true",
            "showProgress" => "false",
            "scrollToElement" => "true",
            "scrollTo" => 'element',
            "scrollPadding" => 30,
            "overlayOpacity" => 0.8,
            "disableInteraction" => "false",
            "helperElementPadding" => 10,
            "hintPosition" => 'top-middle',
            "hintButtonLabel" => 'Got it',
            "hintAnimation" => "true",
            "buttonClass" => 'introjs-button',
            "exitOnEsc" => "false",
            "exitOnOverlayClick" => "false"
        ];

        foreach($options as $optK => $optV) {
            IntroStepSettings::create([
                "key" => $optK,
                "value" => $optV
            ]);
        }
    }
}
