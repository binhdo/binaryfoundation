module.exports = function(grunt) {

	// Project configuration.
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		clean: {
			build: {
				src: ['js/foundation.min.js', 'js/custom.modernizr.min.js', 'css/binaryfoundation*']
			}
		},
		compass: {
			build: {
				options: {
					config: 'config.rb'
				}
			}
		},
		uglify: {
			build: {
				options: {
					banner: '/*\n * Foundation Responsive Library\n * http://foundation.zurb.com\n * Copyright 2013, ZURB\n * Free to use under the MIT license.\n * http://www.opensource.org/licenses/mit-license.php\n * <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %>\n*/\n'
				},
				files: {
					'js/foundation.min.js': [
						'js/foundation/foundation.js',
						'js/foundation/foundation.dropdown.js',
						'js/foundation/foundation.reveal.js',
						//'js/foundation/foundation.joyride.js',
						//'js/foundation/foundation.interchange.js',
						'js/foundation/foundation.forms.js',
						'js/foundation/foundation.placeholder.js',
						'js/foundation/foundation.tooltips.js',
						'js/foundation/foundation.clearing.js',
						'js/foundation/foundation.cookie.js',
						'js/foundation/foundation.orbit.js',
						'js/foundation/foundation.section.js',
						'js/foundation/foundation.magellan.js',
						'js/foundation/foundation.topbar.js',
						'js/foundation/foundation.alerts.js'
					]
				}
			},
			vendor: {
				files: {
					'js/custom.modernizr.min.js': [
						'js/vendor/custom.modernizr.js'
					]
				}
			}
		},
		watch: {
			build: {
				files: ['sass/*'],
				tasks: ['compass']
			}
		}
	});

	// Load the plugin that provides the "uglify" task.
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-compass');
	grunt.loadNpmTasks('grunt-contrib-watch');

	// Default task(s).
	grunt.registerTask('default', ['uglify']);
	grunt.registerTask('init', ['clean', 'uglify', 'compass']);
	grunt.registerTask('foundation', ['compass']);
};