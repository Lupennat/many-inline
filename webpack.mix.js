let mix = require('laravel-mix')

require('./nova.mix')

mix
  .setPublicPath('dist')
  .js('resources/js/many-inline.js', 'js')
  .vue({ version: 3 })
  .nova('lupennat/many-inline')
  .version();
