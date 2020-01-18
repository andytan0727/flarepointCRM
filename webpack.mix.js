const mix = require('laravel-mix');

mix
  .js('resources/assets/js/app.js', 'public/js')
  .sass('resources/assets/sass/app.scss', 'public/css')
  .options({
      processCssUrls: false
  })
  .copyDirectory(
    './node_modules/bootstrap-sass/assets/fonts/bootstrap/',
    'public/fonts/bootstrap'
  );
