var gulp = require('gulp');
var browserSync = require('browser-sync');

// Static server
gulp.task('server', function() {
    browserSync.init({                    //или с этого сайта (https://browsersync.io/docs/gulp)    
        server: {
            baseDir: "stav-panteleimon-biblioteka/"
        }
    });
});