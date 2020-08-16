'use strict';

const gulp = require('gulp');
const zip = require('gulp-zip');

exports.default = () => (
    gulp.src('src/*.php')
        .pipe(zip('wp-updater.zip'))
        .pipe(gulp.dest('dist'))
);
