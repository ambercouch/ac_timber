module.exports = function (grunt) {

  // 1. All configuration goes here
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    watch: {
      css: {
        files: 'assets/scss/**/*.scss',
        tasks: ['sass', 'postcss']
      },
      svg: {
        files: 'assets/images/svg/*.svg',
        tasks: ['svgstore']
      },
        js: {
            files: 'assets/js/*.js',
            tasks: ['uglify']
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
      uglify: {
          my_target: {
              files: {
                  'assets/dist/js/main.js': [
                      '../_s/assets/dist/js/main.js',
                      'assets/js/cm.js'
                  ]
              }
          }
      },
      browserSync: {
          dev: {
              bsFiles: {
                  src : [
                      'style.css',
                      '*.php'
                  ]
              },
              options: {
                  proxy: 'paintinganddecoratingtips.local',
                  proxy: 'paintinganddecoratingtips.local',
                  watchTask: true
              }
          }
      },
      svgstore: {
          options: {
              svg: {
                  style: "display:none",
                  viewBox: '0 0 101 101'
              },
              fixedSizeVersion: {
                  width: 50,
                  height: 50,
                  suffix: '-fix',
                  maxDigits: {
                      translation: 4,
                      scale: 4,
                  },
              },
              prefix: 'icon-', // This will prefix each ID
          },
          default: {
              files: {
                  'assets/img/defs.svg': ['assets/img/svg/*.svg']
              }
              //your_target: {

          }
      },//svgstore
    criticalcss: {
        custom: {
            options: {
                url: "http://ambercouch.local/",
                    width: 1200,
                    height: 900,
                    outputfile: "assets/css/critical.css",
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
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-svgstore');
    grunt.loadNpmTasks('grunt-browser-sync');
    grunt.loadNpmTasks('grunt-postcss');
    grunt.loadNpmTasks('grunt-criticalcss');

  // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
    grunt.registerTask('default', ['sass', 'postcss', 'uglify', 'svgstore']);
    grunt.registerTask('serve', ['browserSync', 'watch']);

};