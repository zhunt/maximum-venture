// source: https://markgoodyear.com/2014/01/getting-started-with-gulp/

var gulp = require('gulp');
var gutil = require('gulp-util');

var concat = require('gulp-concat');

var concatOld = require('gulp-concat'), // concat files together
    rename = require('gulp-rename'), 
   minifyCSS = require('gulp-minify-css'),
   cleanCSS = require('gulp-clean-css'),
   // minifyCSS = require('gulp-cssnano'), // new css minify
    uglify = require('gulp-uglify'); // js compress

var cssnano = require('gulp-cssnano');
var imagemin = require('gulp-imagemin');
var pngquant = require('imagemin-pngquant');  
var remoteSrc = require('gulp-remote-src');


//var minifyHTML = require('gulp-minify-html'); // html compress

/* replace minifyHTML with this? */
var htmlmin = require('gulp-htmlmin');

var debug = require('gulp-debug');

/*
gulp.task('minify', function() {
  return gulp.src('src/*.html')
    .pipe(htmlmin({collapseWhitespace: true}))
    .pipe(gulp.dest('dist'))
});
*/

var uncss = require('gulp-uncss');

var critical = require('critical'); // generate above the fold css

//var critical = require('critical').stream;

/*
var uncss = require('gulp-uncss'); // remove unused CSS

var critical = require('critical'); // generate above the fold css

var minifyCSS = require('gulp-minify-css'); // minify it

var uglify = require('gulp-uglifyjs'); // js compress

var minifyHTML = require('gulp-minify-html'); // html compress
*/


// new Usered???
gulp.task('js', function() {
    return gulp.src( [ // JS order matters!
       // "webroot/assets/js/plugins/bootstrap/js/bootstrap.min.js"
       /* "http://127.0.0.1:8092/assets/plugins/bootstrap/js/bootstrap.min.js",
        "http://127.0.0.1:8092/assets/plugins/back-to-top.js",
        "http://127.0.0.1:8092/assets/plugins/smoothScroll.js",
        "http://127.0.0.1:8092/assets/plugins/jquery.parallax.js",
        "http://127.0.0.1:8092/assets/plugins/masonry/jquery.masonry.min.js",
        "http://127.0.0.1:8092/assets/js/custom.js",
        "http://127.0.0.1:8092/assets/js/app.js",
        "http://127.0.0.1:8092/assets/js/pages/blog-masonry.js" */
        ]
        )
        .pipe(concat('dist.js'))
        .pipe(gulp.dest('dist/js'))
        .pipe(rename({suffix: '.min'}))
        .pipe(uglify())
        .pipe(gulp.dest('dist/js'));
});
// files

/*
gulp.task('js2', function() { debug('here 1');
    return gulp.src( "http://127.0.0.1:8092/assets/plugins/bootstrap/js/bootstrap.min.js").pipe(gulp.dest('dist/js')).pipe(debug({title: 'unicorn:'}));
});
*/


// css
gulp.task('css', function() {
    return gulp.src( [ // CSS order matters!
    
    "assets/plugins/bootstrap/css/bootstrap.min.css",
    "assets/css/style.css",
    "assets/css/headers/header-default.css",
    "assets/css/footers/footer-v1.css",
    "assets/plugins/animate.css",
    "assets/plugins/line-icons/line-icons.css",
    "assets/plugins/font-awesome/css/font-awesome.min.css",
    "assets/css/pages/blog_masonry_3col.css",
    "assets/css/pages/blog.css",
    "assets/css/theme-colors/default.css",
    "assets/css/theme-colors/mv-red.css",
    "assets/css/theme-skins/dark.css",
    "assets/css/custom.css"
    ]
    )
    .pipe(concat('dist.css'))
    .pipe(gulp.dest('dist/css'))
    .pipe(rename({suffix: '.min'}))
    .pipe(cleanCSS( { relativeTo: 'assets/css/'} )) // processImport 
    .pipe(gulp.dest('dist/css'));
});     

gulp.task('uncss', function() {
    var css = gulp.src('dist/css/dist.css')
        .pipe(uncss({
            html: [ 'http://www.maximumventure.ca/', 
                    'http://www.maximumventure.ca/article/bombardiers-cseries-trouble-as-republic-airways-bankruptcy', 
                    'http://www.maximumventure.ca/tag/embraer',
                    'http://www.maximumventure.ca/suggest_news'
                   ],
            ignore: [

                    // from: https://github.com/mpc-hc/mpc-hc.org/blob/master/Gruntfile.js#L70  
                    /(#|\.)fancybox(\-[a-zA-Z]+)?/,
                    // Bootstrap selectors added via JS
                    /\w\.in/,
                    ".fade",
                    ".collapse",
                    ".collapsing",
                    /(#|\.)navbar(\-[a-zA-Z]+)?/,
                    /(#|\.)dropdown(\-[a-zA-Z]+)?/,
                    /(#|\.)(open)/,
                    // currently only in a IE conditional, so uncss doesn't see it
                    ".close",
                    ".alert-dismissible",

                    // just in case
                    '.animated', '.bounce', '.pause', '.flash', '.swing', '.shake', '.wobble', '.tada', // creative-brans.js
                    '.top', '.bottom', '.left', '.right', '.arrow', '.affix', '.affixed', '.tooltip', '.tooltips',
                    /(#|\.)yamm(\-[a-zA-Z]+)?/, 
                    /(#|\.)popover(\-[a-zA-Z]+)?/,
                    /(#|\.)panel(\-[a-zA-Z]+)?/, 
                    /(#|\.)container(\-[a-zA-Z]+)?/, 
                    '.focus', '.slide', '.carousel', '.width',  '.collapsed', '.hide', '.show'

            ],            
        }));

        css.pipe(cssnano()).pipe(rename('dist.css')).pipe(gulp.dest('webroot/css'));
        
        return css.pipe(rename({suffix: '.uncss'})).pipe(gulp.dest('dist/css'));

});

// !! not working yet
// Generate & Inline Critical-path CSS
/*
gulp.task('critical', function () {
    return gulp.src('http://127.0.0.1:8092/')
        .pipe(critical({
            base: '/', 
           // src: 'http://127.0.0.1:8082/', 
            inline: false, 
            css: ['http://127.0.0.1:8092/dist/css/dist.min.css'],
            width: 375,
            height: 678,
            //dest: 'index-critical.html',
            minify: false,
            ignore: ['font-face', 'url']            
        }))
        .pipe(gulp.dest('webroot/dist/css'));
});
*/


// images
gulp.task('images', function () {
    return gulp.src('assets/images/*/*')
        .pipe(imagemin({
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            use: [pngquant()]
        }))
        .pipe(gulp.dest('dist/image'));
});

gulp.task('images2', function () {
    return gulp.src('assets/img/*/*')
        .pipe(imagemin({
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            use: [pngquant()]
        }))
        .pipe(gulp.dest('dist/img'));
});


// minify HTML 
gulp.task('minifyhtml', function() {
  var opts = {
    collapseWhitespace: true,
    removeComments: true,
    removeAttributeQuotes: true

  };
 
  return gulp.src( ['src/Template', 'src/Template/**/*'] ) // 'posts/**/*.html',
    .pipe(htmlmin(opts))
    .pipe(gulp.dest('dist/html-pages'));
});


// create a default task and just log a message
gulp.task('default', function() {
  return gutil.log('Gulp is running!')
});


gulp.task('build-js', function() {
  return gulp.src('source/javascript/**/*.js')
    .pipe(sourcemaps.init())
      .pipe(concat('bundle.js'))
      //only uglify if gulp is ran with '--type production'
      .pipe(gutil.env.type === 'production' ? uglify() : gutil.noop()) 
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('public/assets/javascript'));
});






// pull in jquery files from CDN
gulp.task('externaljs', function() {
    
    remoteSrc(['jquery-2.2.2.min.js', 'jquery-migrate-1.4.0.min.js'], {
            base: 'https://code.jquery.com/' // <-- that backslash is important
        })
        .pipe(gulp.dest('dist/js/'));
})

// compress all our JS code
gulp.task('concatjs', function() {
    return gulp.src( [ // JS order matters!
        'dist/js/jquery-2.2.2.min.js',
        'dist/js/jquery-migrate-1.4.0.min.js',
        'assets/plugins/bootstrap/js/bootstrap.min.js',
        'assets/plugins/back-to-top.js',
        'assets/plugins/smoothScroll.js',
        'assets/plugins/jquery.parallax.js',
        'assets/plugins/masonry/jquery.masonry.min.js',
        'assets/js/custom.js',
        'assets/js/pages/blog-masonry.js',
        'assets/js/app.js'
        ]
        )
        .pipe(concat('dist.js'))
        .pipe(uglify())
        .pipe(gulp.dest('webroot/js')); // 
        });


/*
* concat and compress, save to dist and webroot so can test results
*/
gulp.task('concatcss', function() {

    var css = gulp.src([

        'assets/plugins/bootstrap/css/bootstrap.min.css',

        'assets/css/ie8.css', // next 5 imported by style.css
        'assets/css/blocks.css',
        'assets/css/plugins.css',
        'assets/css/app.css',
        'assets/css/one-theme.css',
        'assets/css/style.css',

        'assets/css/headers/header-default.css',
        'assets/css/footers/footer-v1.css',
        'assets/plugins/animate.css',
        'assets/plugins/line-icons/line-icons.css',
        'assets/plugins/font-awesome/css/font-awesome.min.css',
        'assets/css/pages/blog_masonry_3col.css',
        'assets/css/pages/blog.css',
        'assets/css/theme-colors/default.css',
        'assets/css/theme-colors/mv-red.css',
        'assets/css/theme-skins/dark.css',
        'assets/css/custom.css'


        ])
        .pipe(concat('dist.css'))
        .pipe(cssnano());

        css.pipe(gulp.dest('webroot/css'));

        return css.pipe(gulp.dest('dist/css'));

});


gulp.task('critical', function() {
   
    critical.generate({
        inline: false,
        base: 'C:/xampp3/htdocs/maximumventure-dist/webroot/',
        src: 'test.html',
        dest: 'dist/css/critical.css',
        width: 375,
        height: 678,
        minify: false,
        ignore: ['@font-face',/url\(/, '@import', 'a', 'form-control']    
    }); 

});   

gulp.task('cssmin2', function() {
   return gulp.src([ 'dist/css/critical.css'])        
    .pipe(cssnano())
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('dist/css'));     
});


/* Steps: 


1. concat and compress javascript:

gulp externaljs  -> sends to dist/js folder as dist.js

gulp concatjs -> webroot/js folder as dist.js

(js is now in webroot/js/dist.js)

2. concat css

gulp concatcss -> compresses CSS to dist/css and webroot/css folders

gulp uncss -> using dist/css/dist.css, remove unused css, save to dist/css/dist.uncss.css and webroot/css flders

gulp critical -> using dist/css/dist.uncss.css generate critical css on dummy page (copy of homepage)

gulp cssmin2 -> compress the critical css to new file

gulp minifyhtml -> minify Template files in dist/

*/