module.exports = function(grunt) {

  grunt.initConfig({
  //  Config
    pkg: grunt.file.readJSON('package.json')
   ,dir: {
      theme: 'content/themes/digitalhub'  // <%= dir.theme %>/
     ,plugin: 'content/plugins'  // <%= dir.plugin %>/
   }
  //  Build Site

   ,watch: {
      css: {
        files: ['<%= dir.theme %>/style.css']
      }
     ,image: {
        files: ['<%= dir.theme %>/gui/**/*']
      }
     ,theme: {
        files: ['<%= dir.theme %>/**/*.php']
      }
     ,plugin: {
        files: ['<%= dir.plugin %>/*']
      }
     ,options: {
        livereload: true
      }
    }

  // Compile

   ,less: {
      theme: {
        files: {
          '<%= dir.theme %>/style.css': ['<%= dir.theme %>/less/style.less']
        }
      }
    }

  // Validate

   ,htmlhint: {
      options: {
        'tag-pair': true
       ,'tagname-lowercase': true
       ,'attr-lowercase': true
       ,'attr-value-double-quotes': true
       ,'doctype-first': true
       ,'spec-char-escape': true
       ,'id-unique': true
       ,'head-script-disabled': true
       ,'style-disabled': true
       ,'src-not-empty': true
       ,'img-alt-require': true
      },
      theme: {
        src: ['<%= dir.theme %>/**/*.php']
      }

    }

   ,csslint: {
      options: {
        'adjoining-classes': false
       ,'box-model': false
       ,'box-sizing': false
       ,'regex-selectors': false
       ,'universal-selector': false
       ,'unqualified-attributes': false
       ,'font-sizes': false  //  Until CSSLint has the option to set an amount
      },
      src: [
        '<%= dir.theme %>/style.css'
       ,'<%= dir.theme %>/rtl.css'
       ,'<%= dir.theme %>/content-sidebar.css'
       ,'<%= dir.theme %>/sidebar-content.css'
      ]
    }

   ,cssmetrics: {
      theme: {
        src: [
          '<%= dir.theme %>/style.css'
         ,'<%= dir.theme %>/rtl.css'
         ,'<%= dir.theme %>/layouts/content-sidebar.css'
         ,'<%= dir.theme %>/layouts/sidebar-content.css'
        ]
       ,options: {
          quiet: false
         ,maxSelectors: 4096
         ,maxFileSize: 10240000
        }
      }
    }

   ,jshint: {
      options: {
        browser: true
       ,curly: true
       ,eqeqeq: true
       ,eqnull: true
       ,indent: 2
       ,laxbreak: true
       ,laxcomma: true
       ,quotmark: 'single'
       ,trailing: true
       ,undef: true
       ,globals: {
          console: true
         ,module: true
         ,jQuery: true
         ,'wp': false
        }
      },
      src: ['gruntfile.js','<%= dir.theme %>/**/*.js']
    }

   ,phplint: {
      theme: ['<%= dir.theme %>/**/*.php']
  //   ,plugin: ['<%= dir.plugin %>/**/*.php']
    }

  // Optimise

   ,imagemin: {
      options: {
        optimizationLevel: 3
      }
     ,production: {
        files: [{
          expand: true
         ,cwd: '<%= dir.theme %>/gui'
         ,src: ['**/*.{png,jpg,gif,svg}']
         ,dest: '<%= dir.theme %>/gui'
        }]
      }
    }

  });

  // Tasks

  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-htmlhint');
  grunt.loadNpmTasks('grunt-contrib-csslint');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-imagemin');
  grunt.loadNpmTasks('grunt-css-metrics');
  grunt.loadNpmTasks('grunt-phplint');

  // Options

  grunt.registerTask('default', ['dev', 'serve']);
  grunt.registerTask('test', ['phplint','cssmetrics', 'csslint', 'jshint']);
  grunt.registerTask('optim', ['imagemin']);
  grunt.registerTask('dev', []);
  grunt.registerTask('build', ['less', 'optim']);
  grunt.registerTask('serve', ['watch']);

};
