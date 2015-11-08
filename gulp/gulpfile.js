var gulp        = require('gulp');
var browserSync = require('browser-sync');
var sourcemaps  = require('gulp-sourcemaps');
var sass        = require('gulp-sass');
// var jshint      = require('gulp-jshint');
var concat      = require('gulp-concat');
var uglify      = require('gulp-uglify');
var plumber     = require('gulp-plumber');
var notify      = require('gulp-notify');
var reload      = browserSync.reload;
var rename      = require('gulp-rename');

var plumberErrorHandler = { errorHandler: notify.onError({
    title: 'Gulp',
    message: 'Error: <%= error.message %>'
})
};

var src = {
    scss:   '../stylesheets/**/*.scss',
    cssdist: '../dist/css',
    js:     '../javascript/**/*.js',
    jsdist: '../dist/js',    
    html:   '../',    
    php:    '../**/*.php'
};

// Proxy Server + watching scss/php/js files
gulp.task('serve', ['sass', 'js'], function() {
    browserSync({
        proxy: "www.jp-gen-starter-bp.dev",
        // tunnel: "genesis-bourbon"
    });

    gulp.watch(src.scss, ['sass']);
    gulp.watch(src.js, ['js']);
    gulp.watch(src.php).on('change', reload);
});

// Compile sass into CSS
gulp.task('sass', function() {
    return gulp.src(src.scss)
        .pipe(plumber(plumberErrorHandler))
        .pipe(sourcemaps.init())
            .pipe(sass())
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(src.cssdist))
        .pipe(reload({stream: true}));
});

// JS Hint and Concat Javascript
gulp.task('js', function () {
    return gulp.src(src.js)
        .pipe(plumber(plumberErrorHandler))
        // .pipe(jshint())
        // .pipe(jshint.reporter('fail'))
        .pipe(sourcemaps.init())
            .pipe(concat(src.js))
            .pipe(uglify())
            .pipe(rename('site.min.js'))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(src.jsdist))
        .pipe(reload({stream:true}));        
 
});

gulp.task('default', ['serve']);