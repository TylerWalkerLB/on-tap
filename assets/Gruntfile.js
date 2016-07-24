module.exports = function(grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        styleDir      : 'dist/css',
        mainStyleFile : '<%= styleDir %>/<%= pkg.name %>.css',
        jsDir         : 'dist/js',
        mainJSFile    : '<%= jsDir %>/<%= pkg.name %>.js',
        
        less: {
            dev: {
                options: {
                    compress: false,
                    sourceMap: true,
                    sourceMapFilename: '<%= styleDir %>/<%= pkg.name %>.css.map',
                    sourceMapURL: '<%= pkg.name %>.css.map'
                },
                files: {
                    '<%= mainStyleFile %>': [

                        // Admin styles
                        'less/admin.less',

                        // Presentation styles
                        'less/on-tap.less'
                    ]
                }
            },

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
            dev: {
                options: {
                    map: true,
                    processors: [
                        require('autoprefixer')({
                            browsers: ['last 2 versions', 'ie 9', 'ie 10']
                        })
                    ]
                },
                src: '<%= styleDir %>/*.css'
            },
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
            dev: {
                options: {
                    sourceMap: true
                },
                files: {
                    '<%= mainJSFile %>': [
                        'js/onTapMap.js'
                    ]
                }
            },
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
                    'less:devAdmin',
                    'less:devPres'
                ]
            },
            scripts: {
                files: [
                    'js/**/*.js',
                    'gruntfile.js'
                ],
                tasks: [
                    'uglify:dev'
                ]
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('refresh', ['less:dev', 'postcss:dev', 'uglify:dev']);
    grunt.registerTask('dev', ['less:dev', 'postcss:dev', 'uglify:dev']);
    grunt.registerTask('dist', ['less:dist', 'postcss:dist', 'uglify:dist']);
    grunt.registerTask('default', ['less:dev', 'uglify:dev']);

    require('load-grunt-tasks')(grunt);
};