

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
		.pipe(gulp.dest("js"))
		.pipe(reload({stream:true}));
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
			.pipe(sass().on('error', sass.logError))
		.pipe(maps.write('./'))
		.pipe(gulp.dest('./'))
		.pipe(reload({stream:true}));
});


// Proxy Server and Wach scss/php/js
gulp.task('serve', ['compileSass'], function(){
	browserSync({
		proxy: "www.jp-gen-starter-bp.dev",
		notify: false
	});
	gulp.watch('scss/**/*.scss', ['compileSass']);
	gulp.watch('js/**/*.js', ['concatScripts']);
	gulp.watch('**/*.php').on('change', reload);
});

// Default Dev Task
gulp.task('default', ['serve']);



// Production ========================




// Clean Tast
gulp.task('clean', function(){
	del(['dist', 'css/style.css*', 'js/app*.js*' ]);
});

// Build Task
gulp.task('build', ['minifyScripts', 'compileSass'], function() {
	return gulp.src([
			"style.css", 
			"style.css.map",
			"js/app.min.js", 
			"js/app.js.map", 
			"images/**"])
	.pipe(gulp.dest('dist'), {base: './'});
});

// Production Build Task
gulp.task('production', ["clean"], function() {
	gulp.start('build');
});