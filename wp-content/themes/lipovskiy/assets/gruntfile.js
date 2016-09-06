module.exports = function(grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    concat: {
      distscss: {
        src: ['scss/*.scss'],
        dest: 'scss/main.scss'
      }
    },
    sass: {
      dist: {
        options: {
          style: 'compressed'
        },
        files: {
          'css/main.css': 'scss/main.scss'
        }
      }
    },
    uglify: {
      dist: {
        files: {
          'js/main.js' : 'js/dev/main.js'
        }
      }
    },
    postcss: {
      options: {
        map: false,
        processors: [
          require('autoprefixer')({
              browsers: ['last 2 versions']
          })
        ]
      },
      dist: {
        src: 'css/*.css'
      }
    },
    watch: {
      dev: {
        files: ['scss/**/*.scss', 'scss/*.scss'],
        tasks: ['sass', 'postcss']
      },
    }
  });

  grunt.loadNpmTasks('grunt-postcss');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-sass');

  grunt.registerTask('default', ['concat', 'uglify', 'postcss']);

};