

var gulp 		= require('gulp'),
	concat 		= require('gulp-concat'),
	uglify 		= require('gulp-uglify'),
	rename 		= require('gulp-rename'),
	maps 		= require('gulp-sourcemaps'),
	sass		= require('gulp-sass'),
	del 		= require('del');
	browserSync = require('browser-sync')
	reload		= browserSync.reload;

// Concat JS Scripts
gulp.task("concatScripts", function () {
	return gulp.src([	
		'js/site.js'
		])
		.pipe(maps.init())
		.pipe(concat("app.js"))
		.pipe(maps.write('./'))
		.pipe(gulp.dest("js"));
});

// Minify JS Scripts - with concatScripts as dependency
gulp.task("minifyScripts", ['concatScripts'], function(){
	return gulp.src("js/app.js")
		.pipe(uglify())
		.pipe(rename('app.min.js'))
		.pipe(gulp.dest('js'));	
});

// Compile Sass into CSS
gulp.task('compileSass', function() {
	return gulp.src('scss/style.scss')
		.pipe(maps.init())
			.pipe(sass())
		.pipe(maps.write('./'))
		.pipe(gulp.dest('./'));
});


// Watch Files - Sass and JS files
gulp.task('watchFiles', function(){
	gulp.watch('scss/**/*.scss', ['compileSass']);
	gulp.watch('js/main.js', ['concatScripts']);
})

// Clean Tast
gulp.task('clean', function(){
	del(['dist', 'css/style.css*', 'js/app*.js*']);
});


// Build Task
gulp.task('build', ['minifyScripts', 'compileSass'], function() {
	return gulp.src(["css/style.css", "js/app.min.js", "images/**"])
	.pipe(gulp.dest('dist'), {base: './'});
});

// Serve
gulp.task('serve', ['watchFiles']);

// Default Task
gulp.task("default", ["clean"], function() {
	gulp.start('build');
});