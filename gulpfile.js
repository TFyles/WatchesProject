// Using gulp for Sass compilation, available from https://github.com/dlmanning/gulp-sass (TF)
var gulp = require('gulp');
var sass = require('gulp-sass');
 
gulp.task('sass', function () {
  return gulp.src('./sass/index.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./css'));
});


gulp.task('default', ['sass']);