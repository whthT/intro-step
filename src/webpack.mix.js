const mix = require("laravel-mix");
mix.setResourceRoot("./resources");
mix.setPublicPath("./public");
const TakeAShot = require("take-a-shot");

var shell = require('shelljs');

new TakeAShot({
    cssEngine: "sass",
    resourcePath: "resources/assets/vue/",
    publicPath: "public/vue",
    mixes: [
        {in: "app", blades: ["index"]},
    ]
});

mix.js("resources/assets/intro-step.js", "public");

mix.then(ok => {
    shell.exec("php ../../../../artisan vendor:publish --all --force");
});