const mix = require("laravel-mix");
const fs = require("fs");
const path = require("path");

// Define your source and destination root directories
const srcDir = "src/assets/widgets";
const distDir = "dist/assets/widgets";
const srcExtDir = "src/assets/extensions";
const distExtDir = "dist/assets/extensions";
const srcSiteDir = "src/assets/";
const distSiteDir = "dist/assets/";
const srcAdminDir = "src/assets/admin/";
const distAdminDir = "dist/assets/admin/";

// Function to get subdirectories
function getSubDirectories(directory) {
  return fs
    .readdirSync(directory, { withFileTypes: true })
    .filter((dirent) => dirent.isDirectory())
    .map((dirent) => dirent.name);
}

// Get the list of widget subfolders
const widgets = getSubDirectories(srcDir);

// Get the list of extension subfolders
const extensions = getSubDirectories(srcExtDir);

// Iterate through each widget subfolder
widgets.forEach((widget) => {
  // the input and output paths for each widget js
  const inputJSPath = path.join(srcDir, widget, `js/${widget}.js`);
  const outputJSPath = path.join(distDir, widget, `js/${widget}.min.js`);

  // the input and output paths for each widget css
  const inputCSSPath = path.join(srcDir, widget, `css/${widget}.css`);
  const outputCSSPath = path.join(distDir, widget, `css/${widget}.min.css`);

  // Use Mix only if the input js file exists
  if (fs.existsSync(inputJSPath)) {
    mix.js(inputJSPath, outputJSPath);
  }

  // Use Mix only if the input css file exists
  if (fs.existsSync(inputCSSPath)) {
    mix.css(inputCSSPath, outputCSSPath);
  }
});

// Iterate through each extension subfolder
extensions.forEach((extension) => {
  // the input and output paths for each extension js
  const inputJSPath = path.join(srcExtDir, extension, `js/${extension}.js`);
  const outputJSPath = path.join(distExtDir, extension, `js/${extension}.min.js`);

  // the input and output paths for each extension css
  const inputCSSPath = path.join(srcExtDir, extension, `css/${extension}.css`);
  const outputCSSPath = path.join(distExtDir, extension, `css/${extension}.min.css`);

  // Use Mix only if the input js file exists
  if (fs.existsSync(inputJSPath)) {
    mix.js(inputJSPath, outputJSPath);
  }

  // Use Mix only if the input css file exists
  if (fs.existsSync(inputCSSPath)) {
    mix.css(inputCSSPath, outputCSSPath);
  }
});

// Compile admin assets
mix.js(srcSiteDir + "js/banana-addons.js", distSiteDir + "js/banana-addons.min.js");
mix.js(srcAdminDir + "js/admin.js", distAdminDir + "js/admin.min.js");
mix.js(srcAdminDir + "js/theme-builder.js", distAdminDir + "js/theme-builder.min.js");
mix.css(srcSiteDir + "css/banana-addons.css", distSiteDir + "css/banana-addons.min.css");
mix.css(srcAdminDir + "css/admin-ui.css", distAdminDir + "css/admin-ui.min.css");
mix.css(srcAdminDir + "css/editor-style.css", distAdminDir + "css/editor-style.min.css");
mix.css(srcAdminDir + "css/theme-builder.css", distAdminDir + "css/theme-builder.min.css");

//Disable CSS URL processing
mix.options({
  processCssUrls: false,
});

// Optionally, add versioning for cache-busting in production
/*
if (mix.inProduction()) {
  mix.version();
}*/
