var siteLocalUrl = 'angharadbridal.local';
var defaultBrowser = ['C:\\Program Files (x86)\\Firefox Developer Edition\\firefox.exe', 'Chrome'];

var gulp = require('gulp');
var gutil = require('gulp-util');
var uglify = require('gulp-uglify');
var pump = require('pump');
var concat = require('gulp-concat');
// var browserify = require('gulp-browserify');
var sass = require('gulp-sass');
var merge = require('merge-stream');
var postcss = require('gulp-postcss');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('autoprefixer');
var cssnano = require('cssnano');
var pixrem = require('pixrem');
var browserSync = require('browser-sync').create();
var svgstore = require('gulp-svgstore');
var svgmin = require('gulp-svgmin');
var critical = require('critical');
var stripDebug = require('gulp-strip-debug');

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
    //'flickity/dist/flickity.css'
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

//TASK: log - Just a test
gulp.task('log', function () {
    gutil.log('bleen it to the max');
    gutil.log(jsScripts);
});

//TASK: scripts - Concat and uglify all the vendor and custom javascript
gulp.task('scripts', function (cb) {
    pump([
            gulp.src(jsScripts),
            concat('main.js'),
            // browserify(),
            uglify(),
            gulp.dest('dist/js/')
        ],
        cb
    );
});

//TASK: sass - Concat and uglify all the vendor and custom javascript
gulp.task('sass', function (cb) {

    var sassStream,
        cssStream;

    sassStream =  gulp.src('assets/scss/main.scss')
        .pipe(sass().on('error', sass.logError))

    cssStream = gulp.src(cssNpmScripts)

    return merge(sassStream, cssStream)
        .pipe(concat('style.css'))
        .pipe(postcss([ autoprefixer(), cssnano() ]))
        .pipe(gulp.dest(''))
        .pipe(browserSync.stream());

});


// Static Server + watching scss/html files
gulp.task('serve', ['sass','scripts','svgstore'], function () {

    browserSync.init({
        proxy: siteLocalUrl,
        browser: defaultBrowser
    });

    gulp.watch("assets/scss/**/*.scss", ['sass']);
    gulp.watch("assets/images/svg/**/*.svg", ['svgstore']).on('change', browserSync.reload);
    gulp.watch("templates/**/*.twig").on('change', browserSync.reload);
    gulp.watch("assets/js/**/*.js",['scripts']).on('change', browserSync.reload);
});

gulp.task('svgstore', function () {
    return gulp
        .src('assets/images/svg/*.svg')
        .pipe(svgmin(function (file) {
            //var prefix = path.basename(file.relative, path.extname(file.relative));
            var prefix = 'tester';
            return {
                plugins: [{
                    cleanupIDs: {
                        prefix: prefix + '-',
                        minify: true
                    }
                }]
            }
        }))
        .pipe(svgstore())
        .pipe(gulp.dest('templates/inc'));
});