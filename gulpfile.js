const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('gulp-autoprefixer');
const cleanCSS = require('gulp-clean-css');
const rename = require('gulp-rename');

// Paths
const paths = {
    scss: './assets/scss/**/*.scss',
    css: './assets/css',
    js: './assets/js',
    bootstrap: './node_modules/bootstrap'
};

// Copy Bootstrap files
function copyBootstrap() {
    return gulp.src([
        paths.bootstrap + '/dist/css/bootstrap.min.css',
        paths.bootstrap + '/dist/js/bootstrap.bundle.min.js'
    ])
    .pipe(gulp.dest(function(file) {
        return file.extname === '.css' ? paths.css : paths.js;
    }));
}

// Compile SCSS to CSS
function buildStyles() {
    return gulp.src('./assets/scss/main.scss')
        .pipe(sass({
            includePaths: [paths.bootstrap + '/scss'],
            outputStyle: 'compressed',
            quietDeps: true
        }).on('error', sass.logError))
        .pipe(autoprefixer({
            cascade: false
        }))
        .pipe(cleanCSS())
        .pipe(rename('tax-calculator.min.css'))
        .pipe(gulp.dest(paths.css));
}

// Watch for changes
function watch() {
    gulp.watch(paths.scss, buildStyles);
}

// Export tasks
exports.copyBootstrap = copyBootstrap;
exports.build = gulp.series(copyBootstrap, buildStyles);
exports.watch = watch;
exports.default = gulp.series(copyBootstrap, buildStyles, watch); 