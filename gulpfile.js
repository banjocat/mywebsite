var gulp = require('gulp');
var rename = require('gulp-rename');

var files = {
    css: [
        './node_modules/**/bootstrap.min.css',
    ],
    js: [
        './node_modules/jquery/dist/jquery.min.js',
        './node_modules/bootstrap/dist/js/bootstrap.js',
        './node_modules/underscore/underscore.js'
    ]
};

gulp.task('css', function() {
    return gulp.src(files.css)
    .pipe(rename({dirname: ''}))
    .pipe(gulp.dest('./static/css/.'))
});

gulp.task('js', function() {
    return gulp
    .src(files.js)
    .pipe(rename({dirname: ''}))
    .pipe(gulp.dest('./static/js/'));
});





