# Extended slide show for webtrees

This [webtrees](https://www.webtrees.net) module extends the slide show in such a way that, in addition to the names of the people, their lifespan is also shown.

It registers a custom view for the slide show, which is based on the original view and just adds the lifespan output.

## Installation

Unzip the files into the folder of your webtrees installation.

## Building the module

You need [Composer](https://getcomposer.org) and the PHP [xdiff](https://pecl.php.net/package/xdiff) extension to build this custom webtrees module.

```sh
composer update
composer build
```

The `build` command creates the custom view by patching the original view and then packs all relevant files into a zip file.
