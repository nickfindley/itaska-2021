//
// All compiling task minifys all files

const gulp = require('gulp');
const sass = require('gulp-sass');
const maps = require('gulp-sourcemaps');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify-es').default;
const rename = require('gulp-rename');

// Compile Custom Sass Files To CSS Minified Directory
gulp.task('compile-custom-sass', function(){
    return gulp.src("./src/scss/main.scss")
    .pipe(maps.init())
    .pipe(sass({outputStyle: 'compressed'}))
    .pipe(rename('main.min.css'))
    .pipe(maps.write('./'))
    .pipe(gulp.dest('./dist/css'));
});

gulp.task('compile-amp-sass', function(){
    return gulp.src("./src/scss/amp.scss")
    .pipe(maps.init())
    .pipe(sass({outputStyle: 'compressed'}))
    .pipe(rename('amp.min.css'))
    .pipe(maps.write('./'))
    .pipe(gulp.dest('./dist/css'));
});

gulp.task('compile-dwna-sass', function(){
    return gulp.src("./src/scss/dwna.scss")
    .pipe(maps.init())
    .pipe(sass({outputStyle: 'compressed'}))
    .pipe(rename('dwna.min.css'))
    .pipe(maps.write('./'))
    .pipe(gulp.dest('./dist/css'));
});

gulp.task('compile-marquette-sass', function(){
    return gulp.src("./src/scss/marquette.scss")
    .pipe(maps.init())
    .pipe(sass({outputStyle: 'compressed'}))
    .pipe(rename('marquette.min.css'))
    .pipe(maps.write('./'))
    .pipe(gulp.dest('./dist/css'));
});

gulp.task('compile-dt2-sass', function(){
    return gulp.src("./src/scss/dt2.scss")
    .pipe(maps.init())
    .pipe(sass({outputStyle: 'compressed'}))
    .pipe(rename('dt2.min.css'))
    .pipe(maps.write('./'))
    .pipe(gulp.dest('./dist/css'));
});

gulp.task('compile-calendar-sass', function(){
    return gulp.src("./src/scss/calendar.scss")
    .pipe(maps.init())
    .pipe(sass({outputStyle: 'compressed'}))
    .pipe(rename('calendar.min.css'))
    .pipe(maps.write('./'))
    .pipe(gulp.dest('./dist/css'));
});

gulp.task('compile-gf-sass', function(){
    return gulp.src("./src/scss/gravityforms.scss")
    .pipe(maps.init())
    .pipe(sass({outputStyle: 'compressed'}))
    .pipe(rename('gravityforms.min.css'))
    .pipe(maps.write('./'))
    .pipe(gulp.dest('./dist/css'));
});

gulp.task('javascript', () => {
   return gulp.src(['./src/js/**.*', '!./src/js/forminator.js', '!./src/js/index.js'])
       .pipe(uglify())
       .pipe(concat('scripts.min.js'))
       .pipe(gulp.dest('./dist/js'));
});

gulp.task('javascript-masonry', () => {
   return gulp.src('./src/js/masonry/**.*')
       .pipe(uglify())
       .pipe(concat('masonry.min.js'))
       .pipe(gulp.dest('./dist/js'));
});

gulp.task('javascript-bootstrap', () => {
   return gulp.src('./dist/main.js')
       .pipe(uglify())
       .pipe(concat('bootstrap.dt.min.js'))
       .pipe(gulp.dest('./dist/js'));
});

// If you add a new file to either bootstrap 4 or custom dir,
// run compile-boostrap OR custom-sass first then this task
// gulp.task('watchFile', ['compile-custom-sass', 'compile-amp-sass', 'compile-dt2-sass', 'compile-dwna-sass', 'criticalcss'], function() {
//     gulp.watch('./src/scss/**/**.*', ['compile-custom-sass', 'compile-amp-sass', 'compile-dt2-sass', 'compile-dwna-sass', 'criticalcss']);
//     gulp.watch('./src/js/**.*', ['javascript']);
// });
gulp.task('watchFile', ['compile-custom-sass'], function() {
    gulp.watch('./src/scss/calendar.scss', ['compile-calendar-sass']);
    gulp.watch('./src/scss/**/**.*', ['compile-custom-sass']);
    gulp.watch('./src/js/**.*', ['javascript']);
    gulp.watch('./src/js/masonry/**.*', ['javascript-masonry']);
});

gulp.task('default', ['watchFile']);

// gulp.task('default', function() {
//     gulp.watch('./scss')
// });