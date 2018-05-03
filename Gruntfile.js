/**
 * USAGE:
 * grunt watch --target=RpcTest.php
 */
module.exports = function(grunt) {
    var target = grunt.option('target') || '';
    grunt.initConfig({
		phpunit: {
		    classes: {
		        dir: './test/'+target
		    },
		    options: {
		        bin: './vendor/bin/phpunit',
		        bootstrap: './test/bootstrap.php',
		        colors: true
		    }
		},
		watch: {
			scripts: {
				files: ['./**/*.php','!./node/**','!./assets/**','!../vendor/**'],
				tasks: ['phpunit'],
				options: {
					atBegin: true,
					spawn: true
				},
			},
		},  	
  });
  grunt.loadNpmTasks('grunt-phpunit');
  grunt.loadNpmTasks('grunt-contrib-watch');
};