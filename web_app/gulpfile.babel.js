'use strict';

import gulp from 'gulp';
import gulpLoadPlugins from 'gulp-load-plugins';
import browserSync from 'browser-sync';
import del from 'del';
import {stream as wiredep} from 'wiredep';
import concat from 'gulp-concat';
import revdel from 'gulp-rev-delete-original';

const $ = gulpLoadPlugins();
const reload = browserSync.reload;

gulp.task('styles', () => {
  return gulp.src('app/styles/*.scss', {sourcemap:false})
    .pipe($.plumber())
    .pipe($.sourcemaps.init())
    .pipe($.sass.sync({
      outputStyle: 'expanded',
      precision: 10,
      includePaths: ['.']
    }).on('error', $.sass.logError))
    .pipe($.autoprefixer({browsers: ['> 1%', 'last 2 versions', 'Firefox ESR']}))
    .pipe($.sourcemaps.write())
    .pipe(gulp.dest('.tmp/styles'))
    .pipe(reload({stream: true}))
    .pipe($.notify({ message: 'Estilos - OK'}));
});


function lint(files, options) {
  return () => {
    return gulp.src(files)
      .pipe(reload({stream: true, once: true}))
      .pipe($.eslint.format())
      .pipe($.if(!browserSync.active, $.eslint.failAfterError()))
      .pipe($.notify({ message: 'Scripts - OK'}));
  };
}
const testLintOptions = {
  env: {
    mocha: true
  }
};

gulp.task('lint', lint('app/scripts/**/*.js'));
gulp.task('lint:test', lint('test/spec/**/*.js', testLintOptions));

gulp.task('html', ['styles'], () => {
  return gulp.src('app/*.html')
    .pipe($.useref({searchPath: ['.tmp', 'app', '.']}))
    .pipe($.if('*.js', $.uglify()))
    .pipe($.if('*.css', $.cssnano()))
    .pipe(gulp.dest('dist'));
});

var manifest = gulp.src("./dist/rev-manifest.json");

gulp.task("revision", ['html'], function(){
  return gulp.src(["dist/**/*.css", "dist/**/*.js"])
      .pipe($.rev())
      .pipe(revdel())
      .pipe(gulp.dest('dist'))
      .pipe($.rev.manifest())
      .pipe(gulp.dest('dist'))
});

gulp.task("revreplace", function(){
  return gulp.src("dist/*.html")
      .pipe($.revReplace({manifest: manifest}))
      .pipe(gulp.dest('dist'));
});

gulp.task('images', () => {
  return gulp.src('app/images/**/*')
    .pipe($.cache($.imagemin({
      progressive: true,
      interlaced: true,
      svgoPlugins: [{cleanupIDs: false}]
    })))
    .pipe(gulp.dest('dist/images'));
});

gulp.task('fonts', () => {
  return gulp.src(require('main-bower-files')('**/*.{eot,svg,ttf,woff,woff2}', function (err) {})
    .concat('app/fonts/**/*'))
    .pipe(gulp.dest('.tmp/fonts'))
    .pipe(gulp.dest('dist/fonts'));
});

gulp.task('extras', () => {
  return gulp.src([
    'app/*.*',
    '!app/*.html'
  ], {
    dot: true
  }).pipe(gulp.dest('dist'));
});

gulp.task('video', () => {
  return gulp.src('app/video/**/*')
      .pipe(gulp.dest('dist/video'));
});

gulp.task('clean', del.bind(null, ['.tmp', 'dist']));

gulp.task('serve', ['styles', 'fonts'], () => {
  browserSync({
    notify: true,
    port: 9000,
    server: {
      baseDir: ['.tmp', 'app'],
      routes: {
        '/bower_components': 'bower_components'
      }
    }
  });
  gulp.watch([
    'app/*.html',
    'app/scripts/**/*.js',
    'app/images/**/*',
    '.tmp/fonts/**/*'
  ]).on('change', reload);

  gulp.watch('app/styles/**/*.scss', ['styles']);
  gulp.watch('app/fonts/**/*', ['fonts']);
  // gulp.watch('bower.json', ['wiredep', 'fonts']);
});

gulp.task('serve:dist', () => {
  browserSync({
    notify: true,
    port: 9000,
    server: {
      baseDir: ['dist']
    }
  });
});

gulp.task('serve:test', () => {
  browserSync({
    notify: true,
    port: 9000,
    ui: false,
    server: {
      baseDir: 'test',
      routes: {
        '/scripts': 'app/scripts',
        '/bower_components': 'bower_components'
      }
    }
  });
  gulp.watch('test/spec/**/*.js').on('change', reload);
  gulp.watch('test/spec/**/*.js', ['lint:test']);
});

// inject bower components
gulp.task('wiredep', () => {
  // gulp.src('app/styles/*.scss')
  //   .pipe(wiredep({
  //     ignorePath: /^(\.\.\/)+/
  //   }))
  //   .pipe(gulp.dest('app/styles'));
  //
  // gulp.src('app/*.html')
  //   .pipe(wiredep({
  //     exclude: ['bootstrap-sass'],
  //     ignorePath: /^(\.\.\/)*\.\./
  //   }))
  //   .pipe(gulp.dest('app'));
});

gulp.task('build', ['lint', 'images', 'video', 'fonts', 'extras'], () => {
  return gulp.src('dist/**/*')
      .pipe($.size({title: 'build', gzip: true}));
});

gulp.task('jsconcat', function () {
    return gulp.src('app/scripts/**/*.js')
        .pipe($.sourcemaps.init())
        .pipe(concat('all.js'))
        .pipe($.sourcemaps.write())
        .pipe($.if('*.js', $.uglify()))
        .pipe(gulp.dest('dist'));
});

gulp.task('default', ['clean'], () => {
  gulp.start('build');
  // gulp.start('jsconcat');
  gulp.start('revision');
});