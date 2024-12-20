var siteLocalUrl = 'mysite.local';
var defaultBrowser = ['C:\\Program Files \\Firefox Developer Edition\\firefox.exe', 'Chrome'];

const gulp = require('gulp');
const sass = require('gulp-sass');
const concat = require('gulp-concat');
const sourcemaps = require('gulp-sourcemaps');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const browserSync = require('browser-sync').create();
const pipeline = require('readable-stream').pipeline;
const uglify = require('gulp-uglify');
const svgstore = require('gulp-svgstore');
const svgmin = require('gulp-svgmin');
const rename = require('gulp-rename');
const terser = require('gulp-terser');
const replace = require('gulp-replace');
const penthouse = require('gulp-penthouse');
const cleanCSS = require('gulp-clean-css');

/*
 SOURCE FILES
 */
var jsScripts;
var jsPath = 'assets/js/';
var jsNpmPath = 'node_modules/';
var jsCustomScripts = [
    'ac_timber.js',
    // 'custom.js',
];

var jsNpmScripts = [
    //All ready deprecated with browserify
    'fitvids/dist/fitvids.js',
    'remodal/dist/remodal.js',
    'flickity/dist/flickity.pkgd.js'
];

var cssNpmScripts = [
    //Add any vendor css scripts here that you want to include
    'flickity/dist/flickity.css',
    'remodal/dist/remodal.css',
    'remodal/dist/remodal-default-theme.css',
];

for (var i = 0; i < jsCustomScripts.length; i++) {
    //Add the default path
    jsCustomScripts[i] = jsPath + jsCustomScripts[i];
}
for (var i = 0; i < jsNpmScripts.length; i++) {
    //Add the default path
    jsNpmScripts[i] = jsNpmPath + jsNpmScripts[i];
}

for (var i = 0; i < cssNpmScripts.length; i++) {
    //Add the default path
    cssNpmScripts[i] = jsNpmPath + cssNpmScripts[i];
}

//Concat the vendor scripts with the custom scripts
jsScripts = jsNpmScripts.concat(jsCustomScripts);



/*
 GULP TASKS
 */

//TASK: scripts - Concat and uglify all the vendor and custom javascript
function scripts() {
    return pipeline(
        gulp.src(jsScripts),
        concat('main.js'),
        terser(),
        gulp.dest('dist/js/')
    );
}


function vendorStyles(){
    return gulp.src(cssNpmScripts)
        .pipe(concat('_vendor.scss'))
        .pipe(gulp.dest('assets/scss/'));

    //console.log("testing vendorStyles")

}

//compile scss into css
function styles() {
    return gulp.src('assets/scss/main.scss')
        .pipe(sourcemaps.init())
        .pipe(sass().on('error',sass.logError))
        .pipe(postcss([ autoprefixer(), cssnano() ]))
        .pipe(concat('style.css'))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('.'))
        .pipe(browserSync.stream());
}

function svgdefs() {
    return gulp
        .src('assets/images/svg/*.svg')
        .pipe(svgmin())
        .pipe(rename({prefix: 'icon-'}))
        .pipe(svgstore())
        .pipe(rename("defs.svg"))
        .pipe(gulp.dest('templates/inc/'));
}

function serve() {
    browserSync.init({
        proxy: siteLocalUrl,
        browser: defaultBrowser
    });

    gulp.watch("assets/scss/**/*.scss",  styles);
    gulp.watch("assets/images/svg/**/*.svg", svgdefs).on('change', browserSync.reload);
    gulp.watch("templates/**/*.twig").on('change', browserSync.reload);
    gulp.watch("assets/js/**/*.js", scripts ).on('change', browserSync.reload);

}

// Task to generate critical CSS
function criticalCss() {
    return gulp.src('style.css') // This should point to your main CSS file
        .pipe(penthouse({
            url: `http://${siteLocalUrl}`, // Your local site URL
            css: 'style.css', // Path to your full CSS file
            width: 1300, // Define the viewport width
            height: 900, // Define the viewport height
            // You can add more Penthouse options as necessary
        }))
        .pipe(cleanCSS())
        .pipe(rename('critical.css'))
        .pipe(gulp.dest('templates/css')); // Define your output directory
}

exports.criticalCss = criticalCss;
exports.serve = serve;
exports.styles = styles;
exports.scripts = scripts;
exports.svgdefs = svgdefs;
exports.vendorStyles = vendorStyles;
exports.default = gulp.series(vendorStyles, styles, scripts, svgdefs, serve);
