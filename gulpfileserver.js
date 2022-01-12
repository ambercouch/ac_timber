var siteLocalUrl = 'ambercouch.local';
var defaultBrowser = ['C:\\Program Files \\Firefox Developer Edition\\firefox.exe', 'Chrome'];

const gulp = require('gulp');
const { src, dest } = require('gulp');
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
const replace = require('gulp-replace');

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
    'modaal/dist/js/modaal.js',
    'flickity/dist/flickity.pkgd.js',
    'isotope-layout/dist/isotope.pkgd.js',
    'isotope-packery/packery-mode.pkgd.js'
];

var cssNpmScripts = [
    //Add any vendor css scripts here that you want to include
    'flickity/dist/flickity.css',
    'modaal/dist/css/modaal.scss',
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
        //uglify(),
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

function styleCacheBust() {
    return src('templates/inc/footer_scripts.twig')
        .pipe(replace(/actstylecache(.{15})/g, function handleReplace(match, p1, offset, string) {
            // Replace foobaz with barbaz and log a ton of information
            // See https://mdn.io/string.replace#Specifying_a_function_as_a_parameter
            let rand = Math.floor((Math.random() * 999999) + 100000);
            console.log('Found ' + match + ' with param ' + p1 + ' at ' + offset);
            const d = new Date();
            let dateString = (new Date()).toISOString().slice(0,10).replace(/-/g,"");
            return 'actstylecache' + dateString + '-' + rand;
        }))
        .pipe(dest('templates/inc/'));
};



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

exports.serve = serve;
exports.styles = styles;
exports.scripts = scripts;
exports.svgdefs = svgdefs;
exports.vendorStyles = vendorStyles;
exports.styleCacheBust = styleCacheBust;
exports.dist = gulp.series(vendorStyles, styles, scripts, svgdefs, styleCacheBust);
exports.default = gulp.series(vendorStyles, styles, scripts, svgdefs, styleCacheBust, serve);

