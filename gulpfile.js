//var elixir = require('laravel-elixir');
var gulp = require('gulp');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var ngAnnotate = require('gulp-ng-annotate');
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

//elixir(function(mix) {
//    mix.sass('app.scss');
//});

gulp.task('js', function () {
    gulp.src([
            'public/app.js',
            'public/app/**/*.module.js',
            'public/app/**/*.app.js',
            'public/app/**/*.config.js',
            'public/app/**/*.js'
        ])
        .pipe(concat('app.min.js'))
        .pipe(ngAnnotate())
        .pipe(uglify())
        .pipe(gulp.dest('public'));


});

gulp.task('delivery', function () {
    gulp.src([
            'node_modules/angular-ui-notification/dist/angular-ui-notification.min.js',
            'node_modules/ng-dialog/js/ngDialog.min.js'
        ])
        .pipe(concat('vendor.js'))
        .pipe(gulp.dest('public/vendor/js/modules'));

    gulp.src([
            'node_modules/angular-ui-notification/dist/angular-ui-notification.css',
            'node_modules/ng-dialog/css/ngDialog.min.css',
            'node_modules/ng-dialog/css/ngDialog-theme-default.min.css'
        ])
        .pipe(concat('vendor.css'))
        .pipe(gulp.dest('public/vendor/css/modules'));
});

gulp.task('default', ['js', 'delivery']);
