module.exports = function(grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        styleDir      : 'dist/css',
        mainStyleFile : '<%= styleDir %>/<%= pkg.name %>.css',
        jsDir         : 'dist/js',
        mainJSFile    : '<%= jsDir %>/<%= pkg.name %>.js',
        
        less: {
            dist: {
                options: {
                    compress: true,
                    sourceMap: false
                },
                files: {
                    '<%= mainStyleFile %>': [
                        'less/admin.less',
                        'less/on-tap.less'
                    ]
                }
            }
        },

        postcss: {
            dist: {
                options: {
                    map: false,
                    processors: [
                        require('autoprefixer')({
                            browsers: ['last 2 versions', 'ie 9', 'ie 10']
                        }),
                        require('cssnano')()
                    ]
                },
                src: '<%= styleDir %>/*.css'
            }
        },

        uglify: {
            dist: {
                files: {
                    '<%= mainJSFile %>': [
                        'js/onTapMap.js'
                    ]
                }
            }
        },
        watch: {
            options: {
                livereload: 35729
            },
            styles: {
                files: [
                    'less/**/*.less',
                    'gruntfile.js'
                ],
                tasks: [
                    'less:dist'
                ]
            },
            scripts: {
                files: [
                    'js/**/*.js',
                    'gruntfile.js'
                ],
                tasks: [
                    'uglify:dist'
                ]
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('refresh', ['less:dist', 'postcss:dist', 'uglify:dist']);
    grunt.registerTask('dist', ['less:dist', 'postcss:dist', 'uglify:dist']);
    grunt.registerTask('default', ['less:dist', 'postcss:dist', 'uglify:dist']);

    require('load-grunt-tasks')(grunt);
};