var gulp        = require('gulp');
var browserSync = require('browser-sync');
var sourcemaps  = require('gulp-sourcemaps');
var sass        = require('gulp-sass');
var jade        = require('jade');
var gulpJade    = require('gulp-jade');
var phpJade     = require('gulp-jade-php');
// var jshint      = require('gulp-jshint');
var concat      = require('gulp-concat');
var uglify      = require('gulp-uglify');
var plumber     = require('gulp-plumber');
var notify      = require('gulp-notify');
var rename      = require('gulp-rename');
var reload      = browserSync.reload;
var plumberErrorHandler = { errorHandler: notify.onError({
    title: 'Gulp',
    message: 'Error: <%= error.message %>'
    })
};


// Jade to PHP
gulp.task('jade', function() {
     gulp.src('src/templates/**/*.jade')
        .pipe(plumber(plumberErrorHandler))
        .pipe(phpJade({
            jade: jade,
            pretty: true
        }))
        .pipe(gulp.dest('app/dist'))
        .pipe(reload({stream: true}));
});



// var src = {
//     scss:   '/stylesheets/**/*.scss',
//     cssdist: '/dist/css',
//     js:     '/javascript/**/*.js',
//     jsdist: '/dist/js',    
//     // html:   '/',
//     php:     '/*.php',
//     templates:    '/templates/**/*.jade',
//     templatesDist: '/testywesty'
// };

// Proxy Server + watching scss/php/js files
gulp.task('serve', function() {

    // browserSync({
    //     proxy: "www.jp-gen-starter-bp.dev",
    //     // tunnel: "genesis-bourbon"
    // });

    gulp.watch('src/styles/**/*.sass', ['sass']);
    // gulp.watch('/src/scripts/**/*.js'.js, ['js']);
    gulp.watch('src/**/*.jade', ['jade']);
    // gulp.watch('/src/*.php').on('change', reload);
}); 

// Compile Sass into CSS
gulp.task('sass', function() {
    return gulp.src('src/styles/**/*.sass')
        .pipe(plumber(plumberErrorHandler))
        .pipe(sourcemaps.init())
            .pipe(sass({indentedSyntax: 'true'}))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('app/dist/css/'))
        .pipe(reload({stream: true}));
});



// // JS Hint and Concat Javascript
// // gulp.task('js', function () {
// //     return gulp.src(src.js)
// //         .pipe(plumber(plumberErrorHandler))
// //         // .pipe(jshint())
// //         // .pipe(jshint.reporter('fail'))
// //         .pipe(sourcemaps.init())
// //             .pipe(concat(src.js))
// //             .pipe(uglify())
// //             .pipe(rename('site.min.js'))
// //         .pipe(sourcemaps.write('./'))
// //         .pipe(gulp.dest(src.jsdist))
// //         .pipe(reload({stream:true}));        
 
// // });

gulp.task('default', ['serve']);