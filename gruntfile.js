module.exports = function(grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    less: {
      development: {
        options: {
        }
       ,files: {
          'content/themes/digitalhub/style.css': ['content/themes/digitalhub/less/global.less']
        }
      }
    },

    // Code Lint

    htmlhint: {
      options: {
        'tag-pair': true,
        'tagname-lowercase': true,
        'attr-lowercase': true,
        'attr-value-double-quotes': true,
        'doctype-first': true,
        'spec-char-escape': true,
        'id-unique': true,
        'head-script-disabled': true,
        'style-disabled': true,
        'src-not-empty': true,
        'img-alt-require': true
      },
      src: ['content/themes/digitalahub/**/*.php']

    },

    csslint: {
      options: {
        'adjoining-classes': false,
        'box-model': false,
        'box-sizing': false,
        'regex-selectors': false,
        'universal-selector': false,
        'font-sizes': false  //  Until CSSLint has the option to set an amount
      },
      src: ['content/themes/digitalhub/*.css']
    },

    jshint: {
      options: {
        browser: true,
        curly: true,
        eqeqeq: true,
        eqnull: true,
        indent: 2,
        laxbreak: true,
        laxcomma: true,
        quotmark: 'single',
        trailing: true,
        undef: true,
        globals: {
          console: true,
          module: true,
          jQuery: true
        }
      },
      src: ['gruntfile.js']
    },

    watch: {
      files: ['content/themes/digitalhub/less/**/**.less'],
      tasks: ['less'],
      options: {
        livereload: true
      }
    }

  });

  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-csslint');
  grunt.loadNpmTasks('grunt-htmlhint');

  grunt.registerTask('default', 'dev');
  grunt.registerTask('dev', ['watch']);
  grunt.registerTask('test', ['jshint', 'csslint']);

};
