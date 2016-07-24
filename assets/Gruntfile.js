module.exports = function(grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        styleDir      : '../dist/css',
        mainStyleFile : '<%= styleDir %>/<%= pkg.name %>.css',
        jsDir         : '../dist/js',
        mainJSFile    : '<%= jsDir %>/<%= pkg.name %>.js',
        
        less: {
            devAdmin: {
                options: {
                    compress: false,
                    sourceMap: true,
                    sourceMapFilename: '<%= styleDir %>/<%= pkg.name %>.css.map',
                    sourceMapURL: '<%= pkg.name %>.css.map'
                },
                files: {
                    '<%= mainStyleFile %>': [
                        'less/admin.less'
                    ]
                }
            },
            
            devPres: {
                options: {
                    compress: false,
                    sourceMap: true,
                    sourceMapFilename: '<%= styleDir %>/<%= pkg.name %>.css.map',
                    sourceMapURL: '<%= pkg.name %>.css.map'
                },
                files: {
                    '<%= mainStyleFile %>': [
                        'less/on-tap.less'
                    ]
                }
            },

            distAdmin: {
                options: {
                    compress: true,
                    sourceMap: false
                },
                files: {
                    '<%= mainStyleFile %>': [
                        'less/admin.less'
                    ]
                }
            },

            distPres: {
                options: {
                    compress: true,
                    sourceMap: false
                },
                files: {
                    '<%= mainStyleFile %>': [
                        'less/on-tap.less'
                    ]
                }
            }
        },

        uglify: {
            dev: {
                options: {
                    sourceMap: true
                },
                files: {
                    '<%= mainJSFile %>': [

                    ]
                }
            },
            dist: {
                files: {
                    '<%= mainJSFile %>': [

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
                    'less:devMain',
                    'postcss:dev'
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
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-qunit');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('dev', ['less:devAdmin', 'less:devPres', 'uglify:dev']);
    grunt.registerTask('dist', ['less:distAdmin', 'less:distPres', 'uglify:dist']);

    grunt.registerTask('default', ['less:devAdmin', 'less:devPres', 'uglify:dev']);

};