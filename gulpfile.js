	var gulp = require('gulp');
	var concatCSS = require('gulp-concat-css');
	var autoprefixer = require('gulp-autoprefixer');
	var livereload = require('gulp-livereload');
	var connect = require('gulp-connect');
	var sass = require('gulp-sass');
	var minifyCss = require('gulp-minify-css');
  var plumber = require('gulp-plumber');


gulp.task('connect', function() {
  connect.server({

    livereload: true
  });
});



gulp.task('css', function () {
  return gulp.src('app/scss/style.scss')
    .pipe(plumber())
  	.pipe(sass({includePaths: ['app/scss/base']}).on('error', sass.logError))
    .pipe(autoprefixer('last 5 versions'))
//  .pipe(minifyCss())
    .pipe(gulp.dest('app/css'))
    .pipe(connect.reload());
});

gulp.task('html', function () {
  return gulp.src('app/*.html')
    .pipe(connect.reload());
});

gulp.task('js', function () {
  return gulp.src('app/js/*.js')
    .pipe(connect.reload());
});


gulp.task('watch', function() {
	gulp.watch('app/scss/base/*.scss', ['css']);
  gulp.watch('app/*.html', ['html']);
  gulp.watch('app/js/*.js', ['js']);
});

gulp.task('default', ['connect', 'css', 'watch', 'html', 'js']);