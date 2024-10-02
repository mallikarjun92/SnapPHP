// webpack.config.js
const Encore = require('@symfony/webpack-encore');

Encore
    .enableSingleRuntimeChunk()
    
    // The directory where compiled assets will be stored
    .setOutputPath('public/assets/build/')
    // Public path used by the web server to access the assets
    .setPublicPath('/assets/build')

    // Add entry for CSS (SASS in this case)
    .addStyleEntry('css/styles', './assets/scss/styles.scss')

    // Add entry for JS
    .addEntry('js/scripts', './assets/js/scripts.js')

    // Enable source maps for better debugging
    .enableSourceMaps(!Encore.isProduction())

    // Enable versioning (cache-busting) in production
    .enableVersioning(Encore.isProduction())

    // Enable Sass/SCSS support
    .enableSassLoader()

    // Clean the output before each build
    .cleanupOutputBeforeBuild()

    // Show OS notifications when builds finish/fail
    .enableBuildNotifications()
;

// Export the final configuration
module.exports = Encore.getWebpackConfig();
