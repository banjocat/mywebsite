var gulp = require('gulp');
var rename = require('gulp-rename');
var less = require('gulp-less');
var minifycss = require('gulp-minify-css');

var files = {
    less: [
        './static/less/style.less',
    ],
    js: [
        './node_modules/jquery/dist/jquery.min.js',
        './node_modules/bootstrap/dist/js/bootstrap.js',
        './node_modules/underscore/underscore.js'
    ]
};

gulp.task('js', function() {
    return gulp
    .src(files.js)
    .pipe(rename({dirname: ''}))
    .pipe(gulp.dest('./static/js/'));
});


gulp.task('less', function() {
    return gulp.src(files.less)
    .pipe(less())
    .pipe(minifycss())
    .pipe(gulp.dest('./static/css/.'));
});





