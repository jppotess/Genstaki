#Genstaki

### A WordPress starter theme for custom development

#### Features

* [SCSS](http://sass-lang.com/) for CSS
* [Jade](http://jade-lang.com/) for html and php templating
* ES6([JavaScript 2015](https://babeljs.io/docs/learn-es2015/)) using Babel to compile
* [Browsersync](https://www.browsersync.io/)

#### What is it?

This is currently set up for a custom WordPress starter theme, specifically as a [Genesis framework](http://my.studiopress.com/themes/)(by StudioPress) child theme. If you don't want to use Genesis, just delete the contents of the functions.php file and you're good to go.

### Dependencies

* [npm](https://www.npmjs.com/)
* [Gulp](http://gulpjs.com/)

#### Installation

- run `npm install` in the theme root after dependencies are installed
- configure browsersync to point to your local dev site

#### Use

`gulp` - default task 
- cleans existing app folder 
- compiles .jade, .scss, .js(ES6) to respective folders in app
- serves files with broswersync
- sets watch task to .jade, .scss, .js, and functions.php files

CSS folder structure is inteneded for a modular CSS approach. Currently you have to import each new .scss file into the main _index.scss file for that folder. I'll be workin on a way around this in the future.

#### To Do

* elegant way for normalize/bourbon/neat/ and css modules without imports for each new file created
