var gulp         = require('gulp');


var sourcemaps   = require('gulp-sourcemaps');
var sass         = require('gulp-sass');
var sassConvert  = require('sass-convert');
var minifyCss    = require('gulp-minify-css');
var autoprefixer = require('gulp-autoprefixer');

var jade         = require('jade');
var gulpJade     = require('gulp-jade');
var phpJade      = require('gulp-jade-php');

var babel        = require("gulp-babel");
var jshint       = require('gulp-jshint');

var concat       = require('gulp-concat');
var uglify       = require('gulp-uglify');
var plumber      = require('gulp-plumber');
var notify       = require('gulp-notify');
var rename       = require('gulp-rename');

var browserSync  = require('browser-sync');
var reload       = browserSync.reload;

/**
 * Options Variables
 */
var autoprefixerOptions = {
  browsers: ['last 2 versions', '> 5%', 'Firefox ESR']
};

var plumberErrorHandler = { errorHandler: notify.onError({
    title: 'Gulp',
    message: 'Error: <%= error.message %>'
    })
};


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

//Convert SCSS to Sass
gulp.task('scss2sass', function() {
    return gulp.src('src/styles/utilities/*.scss')
        .pipe(sassConvert({
            from: 'scss',
            to:   'sass',
        }))
        .pipe(concat('utilities.sass'))
        .pipe(gulp.dest('src/styles/'));
        // .pipe(gulp.dest('src/styles/utilities'));
})

// Compile Sass into CSS
gulp.task('sass', ['scss2sass'], function() {
    return gulp.src([
            'src/styles/utilities.sass',
            'src/styles/**/*.+(sass|scss)'
        ])
        .pipe(plumber(plumberErrorHandler))
        .pipe(sourcemaps.init())
        .pipe(sass({indentedSyntax: 'true'}).on('error', sass.logError))
        .pipe(concat('styles.min.css'))
        // .pipe(minifyCss())
        .pipe(autoprefixer(autoprefixerOptions))
        .pipe(sourcemaps.write('./'))        
        .pipe(gulp.dest('app/dist/css/'))
        .pipe(reload({stream: true}));
});

// Compile Babel es6 to JS
gulp.task("babel", function() {
    return gulp.src("src/scripts/**/*.js")
        // .pipe(plumber(plumberErrorHandler))
        //     .pipe(jshint())
        //     .pipe(jshint.reporter('fail'))
        .pipe(sourcemaps.init())
        .pipe(babel({
            presets: ['es2015']
        }))
        .pipe(concat('scripts.min.js'))
        // .pipe(uglify())
        .pipe(sourcemaps.write("."))
        .pipe(gulp.dest("app/dist/js/"))
        .pipe(reload({stream:true}));
})

// Proxy Server + watch PHP sass and js
gulp.task('serve', function() {

    // browserSync({
    //     proxy: "www.jp-gen-starter-bp.dev",
    //     // tunnel: "genesis-bourbon"
    // });

    gulp.watch('src/styles/**/*.sass', ['sass']);
    gulp.watch('/src/scripts/**/*.js', ['babel']);
    gulp.watch('src/**/*.jade', ['jade']);
    // gulp.watch('/src/*.php').on('change', reload);
}); 

gulp.task('default', ['serve']);