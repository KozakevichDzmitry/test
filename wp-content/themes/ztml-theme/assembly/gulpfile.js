const gulp = require("gulp");
const { src, dest } = require("gulp");
const concat = require("gulp-concat");
const scss = require("gulp-sass")(require("sass"));
const browser_sync = require("browser-sync").create();

const paths = {
	src: {
		css: "../assets/styles",
	},
	watch: {
		css: "../assets/styles/**/*.scss",
	},
	build: {
		css: "../",
	},
};

const browsersync = () => {
	browser_sync.init({
		proxy: "www.minsknews.com",
		notify: false,
	});
};

const css = () => {
	return src(paths.watch.css)
		.pipe(concat("style.css"))
		.pipe(
			scss({
				outputStyle: "expanded",
			}).on("error", scss.logError)
		)
		.pipe(dest(paths.build.css))
		.pipe(browser_sync.stream());
};

const watchFiles = () => {
	gulp.watch([paths.watch.css], css);
};

const build = gulp.parallel(css);
const watch = gulp.parallel(build, watchFiles, browsersync);

exports.css = css;
exports.build = build;
exports.watch = watch;
exports.default = watch;
