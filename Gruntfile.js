module.exports = function (grunt) {

    // 1. All configuration goes here
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        watch: {
            css: {
                files: 'assets/scss/**/*.scss',
                tasks: ['sass']
            },
            svg: {
                files: 'assets/images/svg/*.svg',
                tasks: ['svgstore']
            },
            js: {
                files: 'assets/js/*.js',
                tasks: ['jshint','uglify']
            }
        },
        sass: {
            options: {
                sourceMap: true,
                outputStyle: 'compressed'
            },
            dist: {
                files: {
                    'style.css': 'assets/scss/main.scss'
                }
            }
        },
        postcss: {
            options: {
                map: {
                    inline: false, // save all sourcemaps as separate files...
                    annotation: 'dist/css/maps/' // ...to the specified directory
                },

                processors: [
                    require('pixrem')(), // add fallbacks for rem units
                    require('autoprefixer-core')({browsers: 'last 2 versions'}), // add vendor prefixes
                    require('cssnano')() // minify the result
                ]
            },
            dist: {
                src: 'style.css'
            }
        },//postcss
        jshint: {
            src: [
                'assets/js/ac_timber.js'
            ]
        },
        uglify: {
            my_target: {
                options: {
                    beautify: false
                },
                files: {
                    'dist/js/main.js': [
                        'assets/js/ac_timber.js',
                        'assets/vendor/jquery.fitvids/jquery.fitvids.js',
                        'assets/vendor/remodal/dist/remodal.js',
                        'assets/js/wp/jquery.form.js',
                        'assets/js/wp/wpcf7.js'
                    ]
                }
            }
        },
        browserSync: {
            dev: {
                bsFiles: {
                    src: [
                        '*.{css,php,twig}',
                        '**/*.twig'
                    ]
                },
                options: {
                    proxy: 'strettonclimatecare.local',
                    watchTask: true
                }
            }
        },
        svgstore: {
            options: {
                svg: {
                    style: "display:none",
                    viewBox: '0 0 100 100'
                },
                prefix: 'icon-', // This will prefix each ID
            },
            default: {
                files: {
                    'templates/defs.svg': ['assets/images/svg/*.svg']
                }
                //your_target: {

            }
        },//svgstore
        criticalcss: {
            custom: {
                options: {
                    url: "http://strettonclimatecare.local/2015/12/you-aint-seen-nothing-yet/",
                    width: 1200,
                    height: 900,
                    outputfile: "templates/critical--page.css",
                    filename: "style.css", // Using path.resolve( path.join( ... ) ) is a good idea here
                    buffer: 800 * 1024,
                    ignoreConsole: false
                }
            }
        }



    });

    // 3. Where we tell Grunt we plan to use this plug-in.
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-jshint');grunt.loadNpmTasks('grunt-contrib-jshint');grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-svgstore');
    grunt.loadNpmTasks('grunt-browser-sync');
    grunt.loadNpmTasks('grunt-postcss');
    grunt.loadNpmTasks('grunt-criticalcss');
    grunt.loadNpmTasks('grunt-contrib-jshint');


    // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
    grunt.registerTask('default', ['sass', 'postcss', 'uglify', 'svgstore']);
    grunt.registerTask('serve', ['browserSync', 'watch']);
    grunt.registerTask('css', ['sass', 'postcss']);
    grunt.registerTask('criticalcsspage');

};