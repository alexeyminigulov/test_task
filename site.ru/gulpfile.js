var gulp           = require('gulp'),
    gutil          = require('gulp-util' ),
    sass           = require('gulp-sass'),
    concat         = require('gulp-concat'),
    uglify         = require('gulp-uglify'),
    cleanCSS       = require('gulp-clean-css'),
    rename         = require('gulp-rename'),
    del            = require('del'),
    imagemin       = require('gulp-imagemin'),
    cache          = require('gulp-cache'),
    autoprefixer   = require('gulp-autoprefixer'),
    ftp            = require('vinyl-ftp'),
    notify         = require("gulp-notify"),
    babel          = require('gulp-babel'),
    watch          = require('gulp-watch'),
    browserify     = require('gulp-browserify');



// Скрипты проекта

gulp.task('common-js', function() {
    return gulp.src([
        'resources/assets/src/index.js',
    ])
        .pipe(browserify({
          insertGlobals : true,
          debug : !gulp.env.production
        }))
        .pipe(babel({ presets: ['es2015'] }))
        .pipe(concat('common.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('resources/assets/js'));
});

gulp.task('js', ['common-js'], function() {
    return gulp.src([
        'node_modules/js-polyfills/polyfill.min.js',
        'node_modules/systemjs/dist/system.js',
        'node_modules/babel-polyfill/dist/polyfill.min.js',
        'node_modules/jquery/dist/jquery.min.js',
        'node_modules/materialize-css/dist/js/materialize.min.js',
        'node_modules/lightbox2/dist/js/lightbox.min.js',

        'resources/assets/js/common.min.js', // Всегда в конце
    ])
        .pipe(concat('common.min.js'))
        // .pipe(uglify()) // Минимизировать весь js (на выбор)
        .pipe(gulp.dest('public/js'));
});

gulp.task('sass', function() {
    return gulp.src('resources/assets/sass/**/*.sass')
        .pipe(sass({outputStyle: 'expand'}).on("error", notify.onError()))
        .pipe(rename({suffix: '.min', prefix : ''}))
        .pipe(autoprefixer(['last 15 versions']))
        //.pipe(cleanCSS())
        .pipe(gulp.dest('resources/assets/css'));
});

gulp.task('css', ['sass'], function() {
    return gulp.src([
        'node_modules/lightbox2/dist/css/lightbox.min.css',
        'node_modules/materialize-css/dist/css/materialize.min.css',
        'node_modules/font-awesome/css/font-awesome.min.css',

        'resources/assets/css/app.min.css', // Всегда в конце
    ])
        .pipe(concat('main.min.css'))
        .pipe(gulp.dest('public/css'));
});

gulp.task('icons', function() {
    return gulp.src( [  'node_modules/font-awesome/fonts/**.*', ])
        .pipe(gulp.dest('./public/fonts'));
});

gulp.task('fonts-materialize', function() {
    return gulp.src( [ 'node_modules/materialize-css/dist/fonts/roboto/**.*' ])
        .pipe(gulp.dest('./public/fonts/roboto'));
});

gulp.task('imagemin', function() {
    return gulp.src('resources/assets/img/**/*')
        .pipe(cache(imagemin()))
        .pipe(gulp.dest('public/img'));
});

gulp.task('removedist', function() { return del.sync(['public/js', 'public/css']); });
gulp.task('clearcache', function () { return cache.clearAll(); });

gulp.task('build', ['removedist', 'imagemin', 'css', 'js', 'icons', 'fonts-materialize'], function() {

    var buildCss = gulp.src([
        'resources/assets/css/main.min.css',
    ]).pipe(gulp.dest('public/css'));

    var buildFonts = gulp.src([
        'resources/assets/fonts/**/*',
    ]).pipe(gulp.dest('public/fonts'));

});

gulp.task('watch', ['removedist', 'imagemin', 'css', 'js'], function(){
    gulp.watch('resources/assets/sass/**/*.sass', ['build']);
    gulp.watch('resources/assets/src/**/*.js', ['build']); 
})
