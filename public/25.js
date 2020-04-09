(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[25],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Errors/ErrorsLayout.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/pages/Dashboard/Errors/ErrorsLayout.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vue2_transitions__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue2-transitions */ "./node_modules/vue2-transitions/dist/vue2-transitions.m.js");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  components: {
    ZoomCenterTransition: vue2_transitions__WEBPACK_IMPORTED_MODULE_0__["ZoomCenterTransition"]
  },
  props: {
    backgroundColor: {
      type: String,
      "default": 'black'
    }
  },
  inject: {
    autoClose: {
      "default": true
    }
  },
  data: function data() {
    return {
      responsive: false,
      showMenu: false,
      menuTransitionDuration: 250,
      pageTransitionDuration: 300,
      year: new Date().getFullYear()
    };
  },
  computed: {
    setBgImage: function setBgImage() {
      var images = {
        Pricing: './img/bg-pricing.jpg',
        Login: './img/login.jpg',
        Register: './img/register.jpg',
        Lock: './img/lock.jpg'
      };
      return {
        backgroundImage: "url(".concat(images[this.$route.name], ")")
      };
    },
    setPageClass: function setPageClass() {
      return "".concat(this.$route.name, "-page").toLowerCase();
    }
  },
  methods: {
    toggleSidebarPage: function toggleSidebarPage() {
      if (this.$sidebar.showSidebar) {
        this.$sidebar.displaySidebar(false);
      }
    },
    linkClick: function linkClick() {
      if (this.autoClose && this.$sidebar && this.$sidebar.showSidebar === true) {
        this.$sidebar.displaySidebar(false);
      }
    },
    toggleSidebar: function toggleSidebar() {
      this.$sidebar.displaySidebar(!this.$sidebar.showSidebar);
    },
    toggleNavbar: function toggleNavbar() {
      document.body.classList.toggle('nav-open');
      this.showMenu = !this.showMenu;
    },
    closeMenu: function closeMenu() {
      document.body.classList.remove('nav-open');
      this.showMenu = false;
    },
    onResponsiveInverted: function onResponsiveInverted() {
      if (window.innerWidth < 991) {
        this.responsive = true;
      } else {
        this.responsive = false;
      }
    }
  },
  mounted: function mounted() {
    this.onResponsiveInverted();
    window.addEventListener('resize', this.onResponsiveInverted);
  },
  beforeDestroy: function beforeDestroy() {
    this.closeMenu();
    window.removeEventListener('resize', this.onResponsiveInverted);
  },
  beforeRouteUpdate: function beforeRouteUpdate(to, from, next) {
    // Close the mobile menu first then transition to next page
    if (this.showMenu) {
      this.closeMenu();
      setTimeout(function () {
        next();
      }, this.menuTransitionDuration);
    } else {
      next();
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Errors/ErrorsLayout.vue?vue&type=style&index=0&id=7ec37a87&lang=scss&scoped=true&":
/*!******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--8-2!./node_modules/sass-loader/dist/cjs.js??ref--8-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/pages/Dashboard/Errors/ErrorsLayout.vue?vue&type=style&index=0&id=7ec37a87&lang=scss&scoped=true& ***!
  \******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "@-webkit-keyframes zoomIn8-data-v-7ec37a87 {\nfrom {\n    opacity: 0;\n    -webkit-transform: scale3d(0.1, 0.1, 0.1);\n            transform: scale3d(0.1, 0.1, 0.1);\n}\n100% {\n    opacity: 1;\n}\n}\n@keyframes zoomIn8-data-v-7ec37a87 {\nfrom {\n    opacity: 0;\n    -webkit-transform: scale3d(0.1, 0.1, 0.1);\n            transform: scale3d(0.1, 0.1, 0.1);\n}\n100% {\n    opacity: 1;\n}\n}\n.wrapper-full-page .zoomIn[data-v-7ec37a87] {\n  -webkit-animation-name: zoomIn8-data-v-7ec37a87;\n          animation-name: zoomIn8-data-v-7ec37a87;\n}\n@-webkit-keyframes zoomOut8-data-v-7ec37a87 {\nfrom {\n    opacity: 1;\n    -webkit-transform: scale3d(0.7, 0.7, 0.7);\n            transform: scale3d(0.7, 0.7, 0.7);\n}\nto {\n    opacity: 0;\n    -webkit-transform: scale3d(0.46, 0.46, 0.46);\n            transform: scale3d(0.46, 0.46, 0.46);\n}\n}\n@keyframes zoomOut8-data-v-7ec37a87 {\nfrom {\n    opacity: 1;\n    -webkit-transform: scale3d(0.7, 0.7, 0.7);\n            transform: scale3d(0.7, 0.7, 0.7);\n}\nto {\n    opacity: 0;\n    -webkit-transform: scale3d(0.46, 0.46, 0.46);\n            transform: scale3d(0.46, 0.46, 0.46);\n}\n}\n.wrapper-full-page .zoomOut[data-v-7ec37a87] {\n  -webkit-animation-name: zoomOut8-data-v-7ec37a87;\n          animation-name: zoomOut8-data-v-7ec37a87;\n}", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Errors/ErrorsLayout.vue?vue&type=style&index=0&id=7ec37a87&lang=scss&scoped=true&":
/*!**********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--8-2!./node_modules/sass-loader/dist/cjs.js??ref--8-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/pages/Dashboard/Errors/ErrorsLayout.vue?vue&type=style&index=0&id=7ec37a87&lang=scss&scoped=true& ***!
  \**********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var api = __webpack_require__(/*! ../../../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
            var content = __webpack_require__(/*! !../../../../../../node_modules/css-loader!../../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../../node_modules/postcss-loader/src??ref--8-2!../../../../../../node_modules/sass-loader/dist/cjs.js??ref--8-3!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./ErrorsLayout.vue?vue&type=style&index=0&id=7ec37a87&lang=scss&scoped=true& */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Errors/ErrorsLayout.vue?vue&type=style&index=0&id=7ec37a87&lang=scss&scoped=true&");

            content = content.__esModule ? content.default : content;

            if (typeof content === 'string') {
              content = [[module.i, content, '']];
            }

var options = {};

options.insert = "head";
options.singleton = false;

var update = api(content, options);

var exported = content.locals ? content.locals : {};



module.exports = exported;

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Errors/ErrorsLayout.vue?vue&type=template&id=7ec37a87&scoped=true&":
/*!***********************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/pages/Dashboard/Errors/ErrorsLayout.vue?vue&type=template&id=7ec37a87&scoped=true& ***!
  \***********************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    {
      staticClass: "full-page",
      class: { "nav-open": _vm.$sidebar.showSidebar }
    },
    [
      _c(
        "md-toolbar",
        {
          staticClass: "md-transparent md-toolbar-absolute",
          attrs: { "md-elevation": "0" }
        },
        [
          _c("div", { staticClass: "md-toolbar-row md-offset" }, [
            _c("div", { staticClass: "md-toolbar-section-start" }, [
              _c("h3", { staticClass: "md-title" }, [
                _vm._v(_vm._s(_vm.$route.name))
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "md-toolbar-section-end" }, [
              _c(
                "div",
                {
                  staticClass: "md-collapse",
                  class: { "off-canvas-sidebar": _vm.responsive }
                },
                [
                  _c(
                    "md-list",
                    [
                      _c(
                        "md-list-item",
                        { attrs: { to: "/" } },
                        [
                          _c("md-icon", [_vm._v("dashboard")]),
                          _vm._v("\n                Dashboard\n            ")
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "md-list-item",
                        {
                          attrs: { to: "/pricing" },
                          on: { click: _vm.linkClick }
                        },
                        [
                          _c("md-icon", [_vm._v("attach_money")]),
                          _vm._v("\n                Pricing\n            ")
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "md-list-item",
                        {
                          attrs: { to: "/register" },
                          on: { click: _vm.linkClick }
                        },
                        [
                          _c("md-icon", [_vm._v("person_add")]),
                          _vm._v("\n              Register\n            ")
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "md-list-item",
                        {
                          attrs: { to: "/login" },
                          on: { click: _vm.linkClick }
                        },
                        [
                          _c("md-icon", [_vm._v("fingerprint")]),
                          _vm._v("\n              login\n            ")
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "md-list-item",
                        {
                          attrs: { to: "/lock" },
                          on: { click: _vm.linkClick }
                        },
                        [
                          _c("md-icon", [_vm._v("lock_open")]),
                          _vm._v("\n              lock\n            ")
                        ],
                        1
                      )
                    ],
                    1
                  )
                ],
                1
              )
            ])
          ])
        ]
      ),
      _vm._v(" "),
      _c(
        "div",
        {
          staticClass: "wrapper wrapper-full-page",
          on: { click: _vm.toggleSidebarPage }
        },
        [
          _c(
            "div",
            {
              staticClass: "page-header header-filter",
              class: _vm.setPageClass,
              style: _vm.setBgImage,
              attrs: { "filter-color": "black" }
            },
            [
              _c(
                "div",
                { staticClass: "container md-offset" },
                [
                  _c(
                    "zoom-center-transition",
                    {
                      attrs: {
                        duration: _vm.pageTransitionDuration,
                        mode: "out-in"
                      }
                    },
                    [_c("router-view")],
                    1
                  )
                ],
                1
              ),
              _vm._v(" "),
              _c("footer", { staticClass: "footer" }, [
                _c("div", { staticClass: "container md-offset" }, [
                  _c("nav", [
                    _c("ul", [
                      _c(
                        "li",
                        [
                          _c(
                            "router-link",
                            { attrs: { to: { path: "/dashboard" } } },
                            [_vm._v("Home")]
                          )
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _vm._m(0),
                      _vm._v(" "),
                      _vm._m(1),
                      _vm._v(" "),
                      _vm._m(2)
                    ])
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "copyright text-center" }, [
                    _vm._v(
                      "\n              © " +
                        _vm._s(new Date().getFullYear()) +
                        " "
                    ),
                    _c(
                      "a",
                      {
                        attrs: {
                          href: "https://www.creative-tim.com/?ref=mdf-vuejs",
                          target: "_blank"
                        }
                      },
                      [_vm._v("Creative Tim")]
                    ),
                    _vm._v(", made with "),
                    _c("i", { staticClass: "fa fa-heart heart" }),
                    _vm._v(" for a better web\n            ")
                  ])
                ])
              ])
            ]
          )
        ]
      )
    ],
    1
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("li", [
      _c("a", { attrs: { href: "#" } }, [
        _vm._v(
          "\n                            Company\n                        "
        )
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("li", [
      _c("a", { attrs: { href: "#" } }, [
        _vm._v(
          "\n                            Portfolio\n                        "
        )
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("li", [
      _c("a", { attrs: { href: "#" } }, [
        _vm._v("\n                            Blog\n                        ")
      ])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Errors/ErrorsLayout.vue":
/*!**********************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Errors/ErrorsLayout.vue ***!
  \**********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ErrorsLayout_vue_vue_type_template_id_7ec37a87_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ErrorsLayout.vue?vue&type=template&id=7ec37a87&scoped=true& */ "./resources/manager/js/pages/Dashboard/Errors/ErrorsLayout.vue?vue&type=template&id=7ec37a87&scoped=true&");
/* harmony import */ var _ErrorsLayout_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ErrorsLayout.vue?vue&type=script&lang=js& */ "./resources/manager/js/pages/Dashboard/Errors/ErrorsLayout.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _ErrorsLayout_vue_vue_type_style_index_0_id_7ec37a87_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./ErrorsLayout.vue?vue&type=style&index=0&id=7ec37a87&lang=scss&scoped=true& */ "./resources/manager/js/pages/Dashboard/Errors/ErrorsLayout.vue?vue&type=style&index=0&id=7ec37a87&lang=scss&scoped=true&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _ErrorsLayout_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ErrorsLayout_vue_vue_type_template_id_7ec37a87_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ErrorsLayout_vue_vue_type_template_id_7ec37a87_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "7ec37a87",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/manager/js/pages/Dashboard/Errors/ErrorsLayout.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Errors/ErrorsLayout.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Errors/ErrorsLayout.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ErrorsLayout_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./ErrorsLayout.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Errors/ErrorsLayout.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ErrorsLayout_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Errors/ErrorsLayout.vue?vue&type=style&index=0&id=7ec37a87&lang=scss&scoped=true&":
/*!********************************************************************************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Errors/ErrorsLayout.vue?vue&type=style&index=0&id=7ec37a87&lang=scss&scoped=true& ***!
  \********************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_ErrorsLayout_vue_vue_type_style_index_0_id_7ec37a87_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/style-loader/dist/cjs.js!../../../../../../node_modules/css-loader!../../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../../node_modules/postcss-loader/src??ref--8-2!../../../../../../node_modules/sass-loader/dist/cjs.js??ref--8-3!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./ErrorsLayout.vue?vue&type=style&index=0&id=7ec37a87&lang=scss&scoped=true& */ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Errors/ErrorsLayout.vue?vue&type=style&index=0&id=7ec37a87&lang=scss&scoped=true&");
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_ErrorsLayout_vue_vue_type_style_index_0_id_7ec37a87_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_cjs_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_ErrorsLayout_vue_vue_type_style_index_0_id_7ec37a87_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_ErrorsLayout_vue_vue_type_style_index_0_id_7ec37a87_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_ErrorsLayout_vue_vue_type_style_index_0_id_7ec37a87_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_dist_cjs_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_ErrorsLayout_vue_vue_type_style_index_0_id_7ec37a87_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Errors/ErrorsLayout.vue?vue&type=template&id=7ec37a87&scoped=true&":
/*!*****************************************************************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Errors/ErrorsLayout.vue?vue&type=template&id=7ec37a87&scoped=true& ***!
  \*****************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ErrorsLayout_vue_vue_type_template_id_7ec37a87_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./ErrorsLayout.vue?vue&type=template&id=7ec37a87&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Errors/ErrorsLayout.vue?vue&type=template&id=7ec37a87&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ErrorsLayout_vue_vue_type_template_id_7ec37a87_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ErrorsLayout_vue_vue_type_template_id_7ec37a87_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);