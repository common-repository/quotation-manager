/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./src/index.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/css-loader/dist/cjs.js!./node_modules/less-loader/dist/cjs.js?!./src/frontEndAzure.less":
/*!***********************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js!./node_modules/less-loader/dist/cjs.js??ref--4-2!./src/frontEndAzure.less ***!
  \***********************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../node_modules/css-loader/dist/runtime/api.js */ \"./node_modules/css-loader/dist/runtime/api.js\");\n/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__);\n// Imports\n\nvar ___CSS_LOADER_EXPORT___ = _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default()(false);\n// Module\n___CSS_LOADER_EXPORT___.push([module.i, \".azure {\\n  /* Create a custom checkbox */\\n  /* On mouse-over, add a grey background color */\\n  /* When the checkbox is checked, add a blue background */\\n  /* Hide the browser's default checkbox */\\n  /* Create a custom checkbox */\\n  /* Style the checkmark/indicator */\\n}\\n.azure .qmAddNewRowBtn,\\n.azure .qmRemoveRowBtn {\\n  color: white;\\n  background: #4fafe3;\\n}\\n.azure .container {\\n  padding-left: 2em;\\n}\\n.azure .checkmark {\\n  border: 1px solid #4fafe3;\\n}\\n.azure .container:hover input ~ .checkmark {\\n  background-color: #ccc;\\n}\\n.azure .container input:checked ~ .checkmark {\\n  background-color: #4fafe3;\\n}\\n.azure .container input {\\n  position: absolute;\\n  opacity: 0;\\n  cursor: pointer;\\n  height: 0;\\n  width: 0;\\n}\\n.azure span.checkmark {\\n  position: absolute;\\n  top: 0.2em;\\n  left: 0;\\n  height: 1.25em;\\n  width: 1.25em;\\n  opacity: 1;\\n}\\n.azure .container .checkmark:after {\\n  border: solid white;\\n  border-width: 0 2px 2px 0;\\n}\\n.azure :focus {\\n  outline: 1px solid #4fafe3;\\n}\\n.azure input[type=\\\"radio\\\"]:checked {\\n  -webkit-appearance: none;\\n  -moz-appearance: none;\\n  appearance: none;\\n  background-color: #4fafe3;\\n  border: 1px solid white;\\n}\\n.azure form {\\n  border: 2px dashed #4fafe3;\\n  padding: 1rem;\\n}\\n.azure label {\\n  position: relative;\\n  top: -1px;\\n}\\n.azure span.title {\\n  padding: 0.25rem 1rem;\\n  margin-left: 0.5rem;\\n  background-color: #4fafe3;\\n  color: white;\\n  border-top-left-radius: 4px;\\n  border-top-right-radius: 4px;\\n  letter-spacing: 0.05rem;\\n}\\n.azure input[type=submit] {\\n  background-color: #4fafe3;\\n  color: white;\\n  border: 1px solid white;\\n  text-decoration: underline;\\n  text-underline-position: under;\\n  outline: white;\\n}\\n\", \"\"]);\n// Exports\n/* harmony default export */ __webpack_exports__[\"default\"] = (___CSS_LOADER_EXPORT___);\n\n\n//# sourceURL=webpack:///./src/frontEndAzure.less?./node_modules/css-loader/dist/cjs.js!./node_modules/less-loader/dist/cjs.js??ref--4-2");

/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js!./node_modules/less-loader/dist/cjs.js?!./src/frontEndIndustrial.less":
/*!****************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js!./node_modules/less-loader/dist/cjs.js??ref--4-2!./src/frontEndIndustrial.less ***!
  \****************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../node_modules/css-loader/dist/runtime/api.js */ \"./node_modules/css-loader/dist/runtime/api.js\");\n/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__);\n// Imports\n\nvar ___CSS_LOADER_EXPORT___ = _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default()(false);\n// Module\n___CSS_LOADER_EXPORT___.push([module.i, \".industrial {\\n  /* Create a custom checkbox */\\n  /* On mouse-over, add a grey background color */\\n  /* When the checkbox is checked, add a blue background */\\n  /* Style the checkmark/indicator */\\n  /* Create a custom checkbox */\\n}\\n.industrial .container {\\n  padding-left: 2em;\\n}\\n.industrial .checkmark {\\n  border: 1px solid #ffffff;\\n}\\n.industrial .container input ~ .checkmark {\\n  background: white;\\n}\\n.industrial input[type=checkbox] {\\n  display: none;\\n}\\n.industrial .container:hover input ~ .checkmark {\\n  background-color: #ccc;\\n}\\n.industrial .container input:checked ~ .checkmark {\\n  display: block;\\n  background-color: #ffffff;\\n}\\n.industrial .container .checkmark:after {\\n  border: solid #202020;\\n  border-width: 0 2px 2px 0;\\n}\\n.industrial span.checkmark {\\n  position: absolute;\\n  top: 0.2em;\\n  left: 0;\\n  height: 1.25em;\\n  width: 1.25em;\\n  opacity: 1;\\n}\\n.industrial :focus {\\n  outline: 1px solid #ffffff;\\n}\\n.industrial input[type=\\\"radio\\\"]:checked {\\n  -webkit-appearance: none;\\n  -moz-appearance: none;\\n  appearance: none;\\n  background-color: #202020;\\n  border: 1px solid white;\\n}\\n.industrial form {\\n  border: 1px dashed #a0a0a0;\\n  padding: 1rem;\\n}\\n.industrial label {\\n  position: relative;\\n  top: -1px;\\n}\\n.industrial span.title {\\n  padding: 0.25rem 1rem;\\n  margin-left: 0.5rem;\\n  color: #202020;\\n  border-top: 1px solid #a0a0a0;\\n  border-left: 1px solid #a0a0a0;\\n  border-right: 1px solid #a0a0a0;\\n  border-top-left-radius: 4px;\\n  border-top-right-radius: 4px;\\n  letter-spacing: 0.05rem;\\n}\\n.industrial input[type=submit] {\\n  background-color: #ffffff;\\n  color: #202020;\\n  border: 1px solid white;\\n  text-decoration: underline;\\n  text-underline-position: under;\\n  outline: white;\\n}\\n\", \"\"]);\n// Exports\n/* harmony default export */ __webpack_exports__[\"default\"] = (___CSS_LOADER_EXPORT___);\n\n\n//# sourceURL=webpack:///./src/frontEndIndustrial.less?./node_modules/css-loader/dist/cjs.js!./node_modules/less-loader/dist/cjs.js??ref--4-2");

/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js!./node_modules/less-loader/dist/cjs.js?!./src/frontEndSparkling.less":
/*!***************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js!./node_modules/less-loader/dist/cjs.js??ref--4-2!./src/frontEndSparkling.less ***!
  \***************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../node_modules/css-loader/dist/runtime/api.js */ \"./node_modules/css-loader/dist/runtime/api.js\");\n/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__);\n// Imports\n\nvar ___CSS_LOADER_EXPORT___ = _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default()(false);\n// Module\n___CSS_LOADER_EXPORT___.push([module.i, \".sparkling .container input {\\n  position: absolute;\\n  opacity: 0;\\n  cursor: pointer;\\n  height: 0;\\n  width: 0;\\n}\\n.sparkling .container {\\n  padding-left: 2em;\\n}\\n.sparkling .checkmark {\\n  border: 1px solid #e44546;\\n}\\n.sparkling .container:hover input ~ .checkmark {\\n  background-color: #ccc;\\n}\\n.sparkling .container input:checked ~ .checkmark {\\n  background-color: #e44546;\\n}\\n.sparkling .container .checkmark:after {\\n  border: solid white;\\n  border-width: 0 2px 2px 0;\\n}\\n.sparkling span.checkmark {\\n  position: absolute;\\n  top: 0.2em;\\n  left: 0;\\n  height: 1.25em;\\n  width: 1.25em;\\n  opacity: 1;\\n}\\n.sparkling :focus {\\n  outline: 1px solid #e44546;\\n}\\n.sparkling input[type=\\\"radio\\\"]:checked {\\n  -webkit-appearance: none;\\n  -moz-appearance: none;\\n  appearance: none;\\n  border: 1px solid white;\\n  background-color: #e44546;\\n}\\n.sparkling form {\\n  border: 2px dashed #e44546;\\n  padding: 1rem;\\n}\\n.sparkling label {\\n  position: relative;\\n  top: -1px;\\n}\\n.sparkling span.title {\\n  padding: 0.25rem 1rem;\\n  margin-left: 0.5rem;\\n  background-color: #e44546;\\n  color: white;\\n  border-top-left-radius: 4px;\\n  border-top-right-radius: 4px;\\n  letter-spacing: 0.05rem;\\n}\\n.sparkling input[type=submit] {\\n  background-color: #e44546;\\n  color: white;\\n  border: 1px solid white;\\n  text-decoration: underline;\\n  text-underline-position: under;\\n  outline: white;\\n}\\n\", \"\"]);\n// Exports\n/* harmony default export */ __webpack_exports__[\"default\"] = (___CSS_LOADER_EXPORT___);\n\n\n//# sourceURL=webpack:///./src/frontEndSparkling.less?./node_modules/css-loader/dist/cjs.js!./node_modules/less-loader/dist/cjs.js??ref--4-2");

/***/ }),

/***/ "./node_modules/css-loader/dist/runtime/api.js":
/*!*****************************************************!*\
  !*** ./node_modules/css-loader/dist/runtime/api.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval("\n\n/*\n  MIT License http://www.opensource.org/licenses/mit-license.php\n  Author Tobias Koppers @sokra\n*/\n// css base code, injected by the css-loader\n// eslint-disable-next-line func-names\nmodule.exports = function (useSourceMap) {\n  var list = []; // return the list of modules as css string\n\n  list.toString = function toString() {\n    return this.map(function (item) {\n      var content = cssWithMappingToString(item, useSourceMap);\n\n      if (item[2]) {\n        return \"@media \".concat(item[2], \" {\").concat(content, \"}\");\n      }\n\n      return content;\n    }).join('');\n  }; // import a list of modules into the list\n  // eslint-disable-next-line func-names\n\n\n  list.i = function (modules, mediaQuery, dedupe) {\n    if (typeof modules === 'string') {\n      // eslint-disable-next-line no-param-reassign\n      modules = [[null, modules, '']];\n    }\n\n    var alreadyImportedModules = {};\n\n    if (dedupe) {\n      for (var i = 0; i < this.length; i++) {\n        // eslint-disable-next-line prefer-destructuring\n        var id = this[i][0];\n\n        if (id != null) {\n          alreadyImportedModules[id] = true;\n        }\n      }\n    }\n\n    for (var _i = 0; _i < modules.length; _i++) {\n      var item = [].concat(modules[_i]);\n\n      if (dedupe && alreadyImportedModules[item[0]]) {\n        // eslint-disable-next-line no-continue\n        continue;\n      }\n\n      if (mediaQuery) {\n        if (!item[2]) {\n          item[2] = mediaQuery;\n        } else {\n          item[2] = \"\".concat(mediaQuery, \" and \").concat(item[2]);\n        }\n      }\n\n      list.push(item);\n    }\n  };\n\n  return list;\n};\n\nfunction cssWithMappingToString(item, useSourceMap) {\n  var content = item[1] || ''; // eslint-disable-next-line prefer-destructuring\n\n  var cssMapping = item[3];\n\n  if (!cssMapping) {\n    return content;\n  }\n\n  if (useSourceMap && typeof btoa === 'function') {\n    var sourceMapping = toComment(cssMapping);\n    var sourceURLs = cssMapping.sources.map(function (source) {\n      return \"/*# sourceURL=\".concat(cssMapping.sourceRoot || '').concat(source, \" */\");\n    });\n    return [content].concat(sourceURLs).concat([sourceMapping]).join('\\n');\n  }\n\n  return [content].join('\\n');\n} // Adapted from convert-source-map (MIT)\n\n\nfunction toComment(sourceMap) {\n  // eslint-disable-next-line no-undef\n  var base64 = btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap))));\n  var data = \"sourceMappingURL=data:application/json;charset=utf-8;base64,\".concat(base64);\n  return \"/*# \".concat(data, \" */\");\n}\n\n//# sourceURL=webpack:///./node_modules/css-loader/dist/runtime/api.js?");

/***/ }),

/***/ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js":
/*!****************************************************************************!*\
  !*** ./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js ***!
  \****************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval("\n\nvar isOldIE = function isOldIE() {\n  var memo;\n  return function memorize() {\n    if (typeof memo === 'undefined') {\n      // Test for IE <= 9 as proposed by Browserhacks\n      // @see http://browserhacks.com/#hack-e71d8692f65334173fee715c222cb805\n      // Tests for existence of standard globals is to allow style-loader\n      // to operate correctly into non-standard environments\n      // @see https://github.com/webpack-contrib/style-loader/issues/177\n      memo = Boolean(window && document && document.all && !window.atob);\n    }\n\n    return memo;\n  };\n}();\n\nvar getTarget = function getTarget() {\n  var memo = {};\n  return function memorize(target) {\n    if (typeof memo[target] === 'undefined') {\n      var styleTarget = document.querySelector(target); // Special case to return head of iframe instead of iframe itself\n\n      if (window.HTMLIFrameElement && styleTarget instanceof window.HTMLIFrameElement) {\n        try {\n          // This will throw an exception if access to iframe is blocked\n          // due to cross-origin restrictions\n          styleTarget = styleTarget.contentDocument.head;\n        } catch (e) {\n          // istanbul ignore next\n          styleTarget = null;\n        }\n      }\n\n      memo[target] = styleTarget;\n    }\n\n    return memo[target];\n  };\n}();\n\nvar stylesInDom = [];\n\nfunction getIndexByIdentifier(identifier) {\n  var result = -1;\n\n  for (var i = 0; i < stylesInDom.length; i++) {\n    if (stylesInDom[i].identifier === identifier) {\n      result = i;\n      break;\n    }\n  }\n\n  return result;\n}\n\nfunction modulesToDom(list, options) {\n  var idCountMap = {};\n  var identifiers = [];\n\n  for (var i = 0; i < list.length; i++) {\n    var item = list[i];\n    var id = options.base ? item[0] + options.base : item[0];\n    var count = idCountMap[id] || 0;\n    var identifier = \"\".concat(id, \" \").concat(count);\n    idCountMap[id] = count + 1;\n    var index = getIndexByIdentifier(identifier);\n    var obj = {\n      css: item[1],\n      media: item[2],\n      sourceMap: item[3]\n    };\n\n    if (index !== -1) {\n      stylesInDom[index].references++;\n      stylesInDom[index].updater(obj);\n    } else {\n      stylesInDom.push({\n        identifier: identifier,\n        updater: addStyle(obj, options),\n        references: 1\n      });\n    }\n\n    identifiers.push(identifier);\n  }\n\n  return identifiers;\n}\n\nfunction insertStyleElement(options) {\n  var style = document.createElement('style');\n  var attributes = options.attributes || {};\n\n  if (typeof attributes.nonce === 'undefined') {\n    var nonce =  true ? __webpack_require__.nc : undefined;\n\n    if (nonce) {\n      attributes.nonce = nonce;\n    }\n  }\n\n  Object.keys(attributes).forEach(function (key) {\n    style.setAttribute(key, attributes[key]);\n  });\n\n  if (typeof options.insert === 'function') {\n    options.insert(style);\n  } else {\n    var target = getTarget(options.insert || 'head');\n\n    if (!target) {\n      throw new Error(\"Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.\");\n    }\n\n    target.appendChild(style);\n  }\n\n  return style;\n}\n\nfunction removeStyleElement(style) {\n  // istanbul ignore if\n  if (style.parentNode === null) {\n    return false;\n  }\n\n  style.parentNode.removeChild(style);\n}\n/* istanbul ignore next  */\n\n\nvar replaceText = function replaceText() {\n  var textStore = [];\n  return function replace(index, replacement) {\n    textStore[index] = replacement;\n    return textStore.filter(Boolean).join('\\n');\n  };\n}();\n\nfunction applyToSingletonTag(style, index, remove, obj) {\n  var css = remove ? '' : obj.media ? \"@media \".concat(obj.media, \" {\").concat(obj.css, \"}\") : obj.css; // For old IE\n\n  /* istanbul ignore if  */\n\n  if (style.styleSheet) {\n    style.styleSheet.cssText = replaceText(index, css);\n  } else {\n    var cssNode = document.createTextNode(css);\n    var childNodes = style.childNodes;\n\n    if (childNodes[index]) {\n      style.removeChild(childNodes[index]);\n    }\n\n    if (childNodes.length) {\n      style.insertBefore(cssNode, childNodes[index]);\n    } else {\n      style.appendChild(cssNode);\n    }\n  }\n}\n\nfunction applyToTag(style, options, obj) {\n  var css = obj.css;\n  var media = obj.media;\n  var sourceMap = obj.sourceMap;\n\n  if (media) {\n    style.setAttribute('media', media);\n  } else {\n    style.removeAttribute('media');\n  }\n\n  if (sourceMap && btoa) {\n    css += \"\\n/*# sourceMappingURL=data:application/json;base64,\".concat(btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))), \" */\");\n  } // For old IE\n\n  /* istanbul ignore if  */\n\n\n  if (style.styleSheet) {\n    style.styleSheet.cssText = css;\n  } else {\n    while (style.firstChild) {\n      style.removeChild(style.firstChild);\n    }\n\n    style.appendChild(document.createTextNode(css));\n  }\n}\n\nvar singleton = null;\nvar singletonCounter = 0;\n\nfunction addStyle(obj, options) {\n  var style;\n  var update;\n  var remove;\n\n  if (options.singleton) {\n    var styleIndex = singletonCounter++;\n    style = singleton || (singleton = insertStyleElement(options));\n    update = applyToSingletonTag.bind(null, style, styleIndex, false);\n    remove = applyToSingletonTag.bind(null, style, styleIndex, true);\n  } else {\n    style = insertStyleElement(options);\n    update = applyToTag.bind(null, style, options);\n\n    remove = function remove() {\n      removeStyleElement(style);\n    };\n  }\n\n  update(obj);\n  return function updateStyle(newObj) {\n    if (newObj) {\n      if (newObj.css === obj.css && newObj.media === obj.media && newObj.sourceMap === obj.sourceMap) {\n        return;\n      }\n\n      update(obj = newObj);\n    } else {\n      remove();\n    }\n  };\n}\n\nmodule.exports = function (list, options) {\n  options = options || {}; // Force single-tag solution on IE6-9, which has a hard limit on the # of <style>\n  // tags it will allow on a page\n\n  if (!options.singleton && typeof options.singleton !== 'boolean') {\n    options.singleton = isOldIE();\n  }\n\n  list = list || [];\n  var lastIdentifiers = modulesToDom(list, options);\n  return function update(newList) {\n    newList = newList || [];\n\n    if (Object.prototype.toString.call(newList) !== '[object Array]') {\n      return;\n    }\n\n    for (var i = 0; i < lastIdentifiers.length; i++) {\n      var identifier = lastIdentifiers[i];\n      var index = getIndexByIdentifier(identifier);\n      stylesInDom[index].references--;\n    }\n\n    var newLastIdentifiers = modulesToDom(newList, options);\n\n    for (var _i = 0; _i < lastIdentifiers.length; _i++) {\n      var _identifier = lastIdentifiers[_i];\n\n      var _index = getIndexByIdentifier(_identifier);\n\n      if (stylesInDom[_index].references === 0) {\n        stylesInDom[_index].updater();\n\n        stylesInDom.splice(_index, 1);\n      }\n    }\n\n    lastIdentifiers = newLastIdentifiers;\n  };\n};\n\n//# sourceURL=webpack:///./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js?");

/***/ }),

/***/ "./src/frontEndAzure.less":
/*!********************************!*\
  !*** ./src/frontEndAzure.less ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("var api = __webpack_require__(/*! ../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ \"./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js\");\n            var content = __webpack_require__(/*! !../node_modules/css-loader/dist/cjs.js!../node_modules/less-loader/dist/cjs.js??ref--4-2!./frontEndAzure.less */ \"./node_modules/css-loader/dist/cjs.js!./node_modules/less-loader/dist/cjs.js?!./src/frontEndAzure.less\");\n\n            content = content.__esModule ? content.default : content;\n\n            if (typeof content === 'string') {\n              content = [[module.i, content, '']];\n            }\n\nvar options = {};\n\noptions.insert = \"head\";\noptions.singleton = false;\n\nvar update = api(content, options);\n\n\n\nmodule.exports = content.locals || {};\n\n//# sourceURL=webpack:///./src/frontEndAzure.less?");

/***/ }),

/***/ "./src/frontEndIndustrial.less":
/*!*************************************!*\
  !*** ./src/frontEndIndustrial.less ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("var api = __webpack_require__(/*! ../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ \"./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js\");\n            var content = __webpack_require__(/*! !../node_modules/css-loader/dist/cjs.js!../node_modules/less-loader/dist/cjs.js??ref--4-2!./frontEndIndustrial.less */ \"./node_modules/css-loader/dist/cjs.js!./node_modules/less-loader/dist/cjs.js?!./src/frontEndIndustrial.less\");\n\n            content = content.__esModule ? content.default : content;\n\n            if (typeof content === 'string') {\n              content = [[module.i, content, '']];\n            }\n\nvar options = {};\n\noptions.insert = \"head\";\noptions.singleton = false;\n\nvar update = api(content, options);\n\n\n\nmodule.exports = content.locals || {};\n\n//# sourceURL=webpack:///./src/frontEndIndustrial.less?");

/***/ }),

/***/ "./src/frontEndSparkling.less":
/*!************************************!*\
  !*** ./src/frontEndSparkling.less ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("var api = __webpack_require__(/*! ../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ \"./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js\");\n            var content = __webpack_require__(/*! !../node_modules/css-loader/dist/cjs.js!../node_modules/less-loader/dist/cjs.js??ref--4-2!./frontEndSparkling.less */ \"./node_modules/css-loader/dist/cjs.js!./node_modules/less-loader/dist/cjs.js?!./src/frontEndSparkling.less\");\n\n            content = content.__esModule ? content.default : content;\n\n            if (typeof content === 'string') {\n              content = [[module.i, content, '']];\n            }\n\nvar options = {};\n\noptions.insert = \"head\";\noptions.singleton = false;\n\nvar update = api(content, options);\n\n\n\nmodule.exports = content.locals || {};\n\n//# sourceURL=webpack:///./src/frontEndSparkling.less?");

/***/ }),

/***/ "./src/index.js":
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _frontEndSparkling_less__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./frontEndSparkling.less */ \"./src/frontEndSparkling.less\");\n/* harmony import */ var _frontEndSparkling_less__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_frontEndSparkling_less__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _frontEndIndustrial_less__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./frontEndIndustrial.less */ \"./src/frontEndIndustrial.less\");\n/* harmony import */ var _frontEndIndustrial_less__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_frontEndIndustrial_less__WEBPACK_IMPORTED_MODULE_1__);\n/* harmony import */ var _frontEndAzure_less__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./frontEndAzure.less */ \"./src/frontEndAzure.less\");\n/* harmony import */ var _frontEndAzure_less__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_frontEndAzure_less__WEBPACK_IMPORTED_MODULE_2__);\n\r\n\r\n\r\n\r\n\r\n(function(){\r\n\r\n    function addRow( evnt ){\r\n        var row = evnt.target.parentNode.childNodes[ 0 ],\r\n            newRow = row.cloneNode( true );\r\n        \r\n        var inps = newRow.querySelectorAll( 'input' ),\r\n            rowNbr = row.parentNode.querySelectorAll( '.wp-block-quotation-manager-row' ).length + 1,\r\n            spans = newRow.querySelectorAll( 'span' );\r\n\r\n        spans.forEach( ( sp ) => {\r\n            sp.parentNode.removeChild( sp )\r\n        })\r\n\r\n        inps.forEach( ( inp ) => {\r\n            var name = inp.getAttribute( 'name' )\r\n            inp.setAttribute( 'name',  name + rowNbr )\r\n            inp.setAttribute( 'value', '' )\r\n            inp.removeAttribute( 'selected' )\r\n        })\r\n\r\n        var _mBtn = evnt.target.parentNode.querySelector( '.qmRemoveRowBtn' )\r\n        if( _mBtn)\r\n            _mBtn.parentNode.removeChild( _mBtn )\r\n\r\n        var mBtn = createMinBtn()\r\n        mBtn.addEventListener( 'click', removeRow )\r\n        row.parentNode.appendChild( mBtn)\r\n\r\n        row.parentNode.insertBefore( newRow, row.nextElementSibling)\r\n    }\r\n\r\n    function removeRow( evnt ){\r\n        var row = evnt.target.parentNode.querySelector( '.wp-block-quotation-manager-row:last-of-type' ),\r\n            me = evnt.target;\r\n\r\n        row.parentNode.removeChild( row )\r\n\r\n        if( evnt.target.parentNode.querySelectorAll( '.wp-block-quotation-manager-row' ).length == 1)\r\n            me.parentNode.removeChild( me )\r\n\r\n    }\r\n\r\n    function addPlusBtns(){\r\n        var forms = document.querySelectorAll( 'form' );\r\n\r\n        forms.forEach( ( form ) => {\r\n            var rows = form.querySelectorAll( '.wp-block-quotation-manager-row' )\r\n\r\n            if( rows ){\r\n                rows.forEach( ( dup ) => {\r\n                    if( dup && dup.getAttribute( 'dup' ) == '1' ){\r\n                        dup.parentNode.insertBefore( createPlusBtn(), dup.nextElementSibling )\r\n                    }\r\n                })\r\n            }\r\n \r\n        })\r\n    }\r\n\r\n    function createPlusBtn( ){\r\n        return createBtn( \"+\", 'qmAddNewRowBtn' )\r\n    }\r\n\r\n    function createBtn( what, cls ){\r\n        var el = document.createElement( 'span' );\r\n        el.innerText = what\r\n        el.classList.add( cls )\r\n        return el\r\n    }\r\n\r\n    function createMinBtn( ){\r\n        return createBtn( \"-\",  'qmRemoveRowBtn' )\r\n    }\r\n\r\n    window.addEventListener('DOMContentLoaded', ( ) => {\r\n\r\n        addPlusBtns()\r\n\r\n        var plusEls = document.querySelectorAll( '.qmAddNewRowBtn' );\r\n        if( plusEls ){\r\n            plusEls.forEach( ( el ) => { \r\n                el.addEventListener( 'click', addRow );\r\n            })\r\n        }\r\n\r\n    });\r\n\r\n})()\n\n//# sourceURL=webpack:///./src/index.js?");

/***/ })

/******/ });