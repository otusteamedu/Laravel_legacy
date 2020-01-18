(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[17],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Catalog/Categories/CategoryEdit.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/pages/Dashboard/Catalog/Categories/CategoryEdit.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
/* harmony import */ var vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vuelidate/lib/validators */ "./node_modules/vuelidate/lib/validators/index.js");
/* harmony import */ var vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _mixins_categories__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @/mixins/categories */ "./resources/manager/js/mixins/categories.js");
/* harmony import */ var _mixins_base__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @/mixins/base */ "./resources/manager/js/mixins/base.js");
/* harmony import */ var _mixins_crudMethods__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @/mixins/crudMethods */ "./resources/manager/js/mixins/crudMethods.js");
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

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
  name: 'CategoryEdit',
  props: {
    id: {
      type: [Number, String],
      required: true
    },
    result: []
  },
  mixins: [_mixins_categories__WEBPACK_IMPORTED_MODULE_2__["categoryPage"], _mixins_base__WEBPACK_IMPORTED_MODULE_3__["pageTitle"], _mixins_crudMethods__WEBPACK_IMPORTED_MODULE_4__["updateMethod"], _mixins_crudMethods__WEBPACK_IMPORTED_MODULE_4__["deleteMethod"]],
  data: function data() {
    return {
      responseData: false
    };
  },
  validations: {
    title: {
      required: vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["required"],
      touch: false,
      minLength: Object(vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["minLength"])(2),
      isUnique: function isUnique(value) {
        return value.trim() === '' && !this.$v.title.$dirty ? true : !this.isUniqueTitleEdit;
      }
    },
    alias: {
      required: vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["required"],
      touch: false,
      minLength: Object(vuelidate_lib_validators__WEBPACK_IMPORTED_MODULE_1__["minLength"])(2),
      isUnique: function isUnique(value) {
        return value.trim() === '' && !this.$v.alias.$dirty ? true : !this.isUniqueAliasEdit;
      },
      testAlias: function testAlias(value) {
        return value.trim() === '' ? true : /^([a-z0-9]+[-]?)+[a-z0-9]$/.test(value);
      }
    },
    image: {
      touch: false
    },
    publish: {
      touch: false
    },
    description: {
      touch: false
    },
    keywords: {
      touch: false
    }
  },
  computed: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapState"])('categories', {
    title: function title(state) {
      return state.fields.title;
    },
    alias: function alias(state) {
      return state.fields.alias;
    },
    image: function image(state) {
      return state.fields.image;
    },
    imagePath: function imagePath(state) {
      return state.fields.image_path;
    },
    publish: function publish(state) {
      return state.fields.publish;
    },
    description: function description(state) {
      return state.fields.description;
    },
    keywords: function keywords(state) {
      return state.fields.keywords;
    }
  }), {
    isUniqueTitleEdit: function isUniqueTitleEdit() {
      return !!this.$store.getters['categories/isUniqueTitleEdit'](this.title, this.id);
    },
    isUniqueAliasEdit: function isUniqueAliasEdit() {
      return !!this.$store.getters['categories/isUniqueAliasEdit'](this.alias, this.id);
    }
  }),
  methods: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapActions"])('categories', {
    showAction: 'show',
    indexAction: 'index'
  }), {
    onUpdate: function onUpdate() {
      return this.update({
        sendData: {
          category_id: this.id,
          formData: {
            type: this.category_type,
            title: this.title,
            alias: this.alias,
            image: this.image,
            publish: +this.publish,
            description: this.description,
            keywords: this.keywords
          }
        },
        title: this.title,
        successText: 'Категория обновлена!',
        storeModule: this.storeModule,
        redirectRoute: this.redirectRoute
      });
    },
    onDelete: function onDelete() {
      return this["delete"]({
        payload: this.id,
        title: this.title,
        alertText: "\u043A\u0430\u0442\u0435\u0433\u043E\u0440\u0438\u044E \xAB".concat(this.title, "\xBB"),
        successText: 'Категория удалена!',
        storeModule: this.storeModule,
        redirectRoute: this.redirectRoute
      });
    }
  }),
  created: function created() {
    var _this = this;

    this.indexAction().then(function () {
      return _this.showAction(_this.id);
    }).then(function () {
      _this.setPageTitle(_this.title);

      _this.responseData = true;
    })["catch"](function () {
      return _this.$router.push(_this.redirectRoute);
    });
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Catalog/Categories/CategoryEdit.vue?vue&type=style&index=0&lang=scss&":
/*!******************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--8-2!./node_modules/sass-loader/dist/cjs.js??ref--8-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/pages/Dashboard/Catalog/Categories/CategoryEdit.vue?vue&type=style&index=0&lang=scss& ***!
  \******************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".md-color-sample {\n  -webkit-box-flex: 0;\n      -ms-flex: none;\n          flex: none;\n  width: 100%;\n  height: 120px;\n  border-radius: 3px;\n  will-change: background-color;\n  background-color: gray;\n  -webkit-box-shadow: 0 12px 20px -10px rgba(153, 153, 153, 0.14), 0 4px 20px 0px rgba(153, 153, 153, 0.2), 0 7px 8px -5px rgba(153, 153, 153, 0.12);\n          box-shadow: 0 12px 20px -10px rgba(153, 153, 153, 0.14), 0 4px 20px 0px rgba(153, 153, 153, 0.2), 0 7px 8px -5px rgba(153, 153, 153, 0.12);\n}", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Catalog/Categories/CategoryEdit.vue?vue&type=style&index=0&lang=scss&":
/*!**********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--8-2!./node_modules/sass-loader/dist/cjs.js??ref--8-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/pages/Dashboard/Catalog/Categories/CategoryEdit.vue?vue&type=style&index=0&lang=scss& ***!
  \**********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var api = __webpack_require__(/*! ../../../../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
            var content = __webpack_require__(/*! !../../../../../../../node_modules/css-loader!../../../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../../../node_modules/postcss-loader/src??ref--8-2!../../../../../../../node_modules/sass-loader/dist/cjs.js??ref--8-3!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./CategoryEdit.vue?vue&type=style&index=0&lang=scss& */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Catalog/Categories/CategoryEdit.vue?vue&type=style&index=0&lang=scss&");

            content = content.__esModule ? content.default : content;

            if (typeof content === 'string') {
              content = [[module.i, content, '']];
            }

var options = {};

options.insert = "head";
options.singleton = false;

var update = api(module.i, content, options);

var exported = content.locals ? content.locals : {};



module.exports = exported;

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Catalog/Categories/CategoryEdit.vue?vue&type=template&id=7017d213&":
/*!***********************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/pages/Dashboard/Catalog/Categories/CategoryEdit.vue?vue&type=template&id=7017d213& ***!
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
  return _vm.responseData
    ? _c("div", [
        _c("div", { staticClass: "md-layout" }, [
          _c(
            "div",
            { staticClass: "md-layout-item" },
            [
              _c(
                "md-card",
                { staticClass: "mt-0" },
                [
                  _c(
                    "md-card-content",
                    { staticClass: "md-between" },
                    [
                      _c("router-button-link", {
                        attrs: {
                          route: _vm.redirectRoute.name,
                          params: _vm.redirectRoute.params
                        }
                      }),
                      _vm._v(" "),
                      _c(
                        "div",
                        [
                          _c(
                            "slide-y-down-transition",
                            {
                              directives: [
                                {
                                  name: "show",
                                  rawName: "v-show",
                                  value: _vm.$v.$anyDirty && !_vm.$v.$invalid,
                                  expression: "$v.$anyDirty && !$v.$invalid"
                                }
                              ]
                            },
                            [
                              _c("control-button", {
                                attrs: { title: "Сохранить" },
                                on: { click: _vm.onUpdate }
                              })
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c("control-button", {
                            staticClass: "md-danger",
                            attrs: { title: "Удалить", icon: "delete" },
                            on: {
                              click: function($event) {
                                return _vm.onDelete()
                              }
                            }
                          })
                        ],
                        1
                      )
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          )
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "md-layout" }, [
          _c(
            "div",
            {
              staticClass: "md-layout-item md-medium-size-50 md-small-size-100"
            },
            [
              _c(
                "md-card",
                [
                  _c("card-icon-header"),
                  _vm._v(" "),
                  _c(
                    "md-card-content",
                    [
                      _c("v-input", {
                        attrs: {
                          title: "Заголовок",
                          icon: "title",
                          name: "title",
                          value: _vm.title,
                          differ: true,
                          vField: _vm.$v.title,
                          module: _vm.storeModule,
                          vRules: {
                            required: true,
                            unique: true,
                            minLength: true
                          }
                        }
                      }),
                      _vm._v(" "),
                      _c("v-input", {
                        attrs: {
                          title: "Алиас",
                          icon: "code",
                          name: "alias",
                          value: _vm.alias,
                          differ: true,
                          vDelay: true,
                          vField: _vm.$v.alias,
                          module: _vm.storeModule,
                          vRules: {
                            required: true,
                            unique: true,
                            minLength: true,
                            alias: true
                          }
                        }
                      }),
                      _vm._v(" "),
                      _vm.category_type === "colors"
                        ? _c("div", [
                            _c("h4", { staticClass: "card-title" }, [
                              _vm._v("Цвет")
                            ]),
                            _vm._v(" "),
                            _c("div", {
                              staticClass: "md-color-sample mt-2",
                              style: "background-color: " + _vm.alias
                            })
                          ])
                        : _vm._e(),
                      _vm._v(" "),
                      _c("v-image", {
                        attrs: {
                          name: "image",
                          imgDefault: _vm.imagePath,
                          differ: true,
                          vField: _vm.$v.image,
                          vRules: { required: true },
                          module: _vm.storeModule
                        }
                      }),
                      _vm._v(" "),
                      _c("v-switch", {
                        attrs: {
                          vField: _vm.$v.publish,
                          differ: true,
                          value: _vm.publish,
                          module: _vm.storeModule
                        }
                      })
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "div",
            {
              staticClass: "md-layout-item md-medium-size-50 md-small-size-100"
            },
            [
              _c(
                "md-card",
                [
                  _c("card-icon-header", {
                    attrs: { icon: "timeline", title: "SEO" }
                  }),
                  _vm._v(" "),
                  _c(
                    "md-card-content",
                    [
                      _c("v-textarea", {
                        attrs: {
                          name: "description",
                          value: _vm.description,
                          differ: true,
                          vField: _vm.$v.description,
                          module: _vm.storeModule
                        }
                      }),
                      _vm._v(" "),
                      _c("v-textarea", {
                        attrs: {
                          title: "Ключевые слова",
                          name: "keywords",
                          value: _vm.keywords,
                          differ: true,
                          vField: _vm.$v.keywords,
                          module: _vm.storeModule
                        }
                      }),
                      _vm._v(" "),
                      _c("div", { staticClass: "space-30" })
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
    : _vm._e()
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/manager/js/lib/CatalogPageProps/index.js":
/*!************************************************************!*\
  !*** ./resources/manager/js/lib/CatalogPageProps/index.js ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
  topics: {
    PAGE_TITLE: 'Темы',
    CREATE_PAGE_TITLE: 'Новая тема',
    TABLE_TITLE: 'Список тем'
  },
  colors: {
    PAGE_TITLE: 'Цвета',
    CREATE_PAGE_TITLE: 'Новый цвет',
    TABLE_TITLE: 'Список цветов'
  },
  interiors: {
    PAGE_TITLE: 'Интерьеры',
    CREATE_PAGE_TITLE: 'Новый интерьер',
    TABLE_TITLE: 'Список интерьеров'
  },
  tags: {
    PAGE_TITLE: 'Теги',
    CREATE_PAGE_TITLE: 'Новый тег',
    TABLE_TITLE: 'Список тегов',
    DELETE_CONFIRM_TEXT: function DELETE_CONFIRM_TEXT(title) {
      return "\u0442\u044D\u0433 \xAB".concat(title, "\xBB");
    },
    DELETE_SUCCESS_TEXT: 'Тег удален!',
    CREATE_SUCCESS_TEXT: 'Тег создан!',
    UPDATE_SUCCESS_TEXT: 'Тег обновлен!'
  },
  owners: {
    PAGE_TITLE: 'Владельцы',
    CREATE_PAGE_TITLE: 'Новый владелец',
    TABLE_TITLE: 'Список владельцев',
    DELETE_CONFIRM_TEXT: function DELETE_CONFIRM_TEXT(title) {
      return "\u0432\u043B\u0430\u0434\u0435\u043B\u044C\u0446\u0430 \xAB".concat(title, "\xBB");
    },
    DELETE_SUCCESS_TEXT: 'Владелец удален!',
    CREATE_SUCCESS_TEXT: 'Владелец создан!',
    UPDATE_SUCCESS_TEXT: 'Владелец обновлен!'
  }
});

/***/ }),

/***/ "./resources/manager/js/mixins/categories.js":
/*!***************************************************!*\
  !*** ./resources/manager/js/mixins/categories.js ***!
  \***************************************************/
/*! exports provided: categoryPage, subCategoryPage, tableTitle */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "categoryPage", function() { return categoryPage; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "subCategoryPage", function() { return subCategoryPage; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "tableTitle", function() { return tableTitle; });
/* harmony import */ var _lib_CatalogPageProps__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @/lib/CatalogPageProps */ "./resources/manager/js/lib/CatalogPageProps/index.js");
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }



var categoryPage = {
  props: {
    category_type: {
      type: String,
      require: true
    }
  },
  data: function data() {
    return {
      pageProps: _lib_CatalogPageProps__WEBPACK_IMPORTED_MODULE_0__["default"],
      storeModule: 'categories',
      redirectRoute: {
        name: 'manager.catalog.categories.list',
        params: {
          category_type: this.category_type
        }
      }
    };
  },
  computed: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_1__["mapState"])({
    pageTitle: function pageTitle(state) {
      return state.pageTitle;
    }
  })),
  methods: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_1__["mapActions"])(['setPageTitle']))
};
var subCategoryPage = {
  props: {
    category_type: {
      type: String,
      require: true
    }
  },
  data: function data() {
    return {
      pageProps: _lib_CatalogPageProps__WEBPACK_IMPORTED_MODULE_0__["default"],
      storeModule: 'subCategories',
      redirectRoute: {
        name: 'manager.catalog.subcategories.list',
        params: {
          category_type: this.category_type
        }
      }
    };
  },
  computed: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_1__["mapState"])({
    pageTitle: function pageTitle(state) {
      return state.pageTitle;
    }
  }))
};
var tableTitle = {
  computed: {
    tableTitle: function tableTitle() {
      return _lib_CatalogPageProps__WEBPACK_IMPORTED_MODULE_0__["default"][this.category_type].TABLE_TITLE;
    }
  }
};

/***/ }),

/***/ "./resources/manager/js/mixins/crudMethods.js":
/*!****************************************************!*\
  !*** ./resources/manager/js/mixins/crudMethods.js ***!
  \****************************************************/
/*! exports provided: createMethod, updateMethod, deleteMethod, uploadMethod, imageAddMethod, subCategoryImageAddMethod */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "createMethod", function() { return createMethod; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "updateMethod", function() { return updateMethod; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "deleteMethod", function() { return deleteMethod; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "uploadMethod", function() { return uploadMethod; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "imageAddMethod", function() { return imageAddMethod; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "subCategoryImageAddMethod", function() { return subCategoryImageAddMethod; });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var sweetalert2__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! sweetalert2 */ "./node_modules/sweetalert2/dist/sweetalert2.all.js");
/* harmony import */ var sweetalert2__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(sweetalert2__WEBPACK_IMPORTED_MODULE_1__);


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }


var createMethod = {
  methods: {
    create: function create(_ref) {
      var _this = this;

      var sendData = _ref.sendData,
          title = _ref.title,
          successText = _ref.successText,
          redirectRoute = _ref.redirectRoute,
          _ref$storeModule = _ref.storeModule,
          storeModule = _ref$storeModule === void 0 ? null : _ref$storeModule;
      var module = storeModule ? "".concat(storeModule, "/") : '';
      return this.$store.dispatch("".concat(module, "store"), sendData).then(function () {
        _this.$router.go(-1) ? _this.$router.go(-1) : _this.$router.push(redirectRoute);
        return sweetalert2__WEBPACK_IMPORTED_MODULE_1___default.a.fire({
          title: successText,
          text: "\xAB".concat(title, "\xBB"),
          timer: 2000,
          showConfirmButton: false,
          type: 'success'
        });
      });
    }
  }
};
var updateMethod = {
  methods: {
    update: function update(_ref2) {
      var _this2 = this;

      var sendData = _ref2.sendData,
          title = _ref2.title,
          redirectRoute = _ref2.redirectRoute,
          successText = _ref2.successText,
          _ref2$storeModule = _ref2.storeModule,
          storeModule = _ref2$storeModule === void 0 ? null : _ref2$storeModule;
      var module = storeModule ? "".concat(storeModule, "/") : '';
      return this.$store.dispatch("".concat(module, "update"), sendData).then(function () {
        _this2.$router.go(-1) ? _this2.$router.go(-1) : _this2.$router.push(redirectRoute);
        return sweetalert2__WEBPACK_IMPORTED_MODULE_1___default.a.fire({
          title: successText,
          text: "\xAB".concat(title, "\xBB"),
          timer: 2000,
          showConfirmButton: false,
          type: 'success'
        });
      });
    }
  }
};
var deleteMethod = {
  methods: {
    "delete": function _delete(_ref3) {
      var _this3 = this;

      var payload = _ref3.payload,
          title = _ref3.title,
          alertText = _ref3.alertText,
          successText = _ref3.successText,
          _ref3$storeModule = _ref3.storeModule,
          storeModule = _ref3$storeModule === void 0 ? null : _ref3$storeModule,
          _ref3$redirectRoute = _ref3.redirectRoute,
          redirectRoute = _ref3$redirectRoute === void 0 ? null : _ref3$redirectRoute;
      var module = storeModule ? "".concat(storeModule, "/") : '';
      return deleteSwalFireConfirm(alertText).then(function (result) {
        if (result.value) {
          return _this3.$store.dispatch("".concat(module, "destroy"), payload).then(function () {
            if (redirectRoute) {
              _this3.$router.go(-1) ? _this3.$router.go(-1) : _this3.$router.push(redirectRoute);
            }

            return deleteSwalFireAlert(successText, title);
          });
        }
      });
    }
  }
};

var deleteSwalFireConfirm = function deleteSwalFireConfirm(alertText) {
  return sweetalert2__WEBPACK_IMPORTED_MODULE_1___default.a.fire({
    title: 'Вы уверены?',
    text: "\u0414\u0430\u043D\u043D\u043E\u0435 \u0434\u0435\u0439\u0441\u0442\u0432\u0438\u0435 \u0443\u0434\u0430\u043B\u0438\u0442 ".concat(alertText, " \u0431\u0435\u0437\u0432\u043E\u0437\u0432\u0440\u0430\u0442\u043D\u043E!"),
    type: 'warning',
    showCancelButton: true,
    confirmButtonClass: 'md-button md-success btn-fill',
    cancelButtonClass: 'md-button md-danger btn-fill',
    confirmButtonText: 'Удалить',
    cancelButtonText: 'Отменить',
    buttonsStyling: false
  });
};

var deleteSwalFireAlert = function deleteSwalFireAlert(successText, title) {
  return sweetalert2__WEBPACK_IMPORTED_MODULE_1___default.a.fire({
    title: successText,
    text: "\xAB".concat(title, "\xBB"),
    timer: 2000,
    type: 'success',
    showConfirmButton: false
  });
};

var uploadMethod = {
  methods: {
    upload: function () {
      var _upload = _asyncToGenerator(
      /*#__PURE__*/
      _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee(_ref4) {
        var uploadFiles, _ref4$type, type, _ref4$id, id, _ref4$storeModule, storeModule, files, module;

        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                uploadFiles = _ref4.uploadFiles, _ref4$type = _ref4.type, type = _ref4$type === void 0 ? null : _ref4$type, _ref4$id = _ref4.id, id = _ref4$id === void 0 ? null : _ref4$id, _ref4$storeModule = _ref4.storeModule, storeModule = _ref4$storeModule === void 0 ? null : _ref4$storeModule;
                files = Array.from(uploadFiles);
                module = storeModule ? storeModule : 'categories';

                if (!id) {
                  _context.next = 8;
                  break;
                }

                _context.next = 6;
                return this.$store.dispatch("".concat(module, "/uploadImages"), {
                  files: files,
                  id: id,
                  type: type
                });

              case 6:
                _context.next = 10;
                break;

              case 8:
                _context.next = 10;
                return this.$store.dispatch('images/store', files);

              case 10:
                _context.next = 12;
                return sweetalert2__WEBPACK_IMPORTED_MODULE_1___default.a.fire({
                  title: 'Изображения загружены!',
                  text: '',
                  timer: 2000,
                  showConfirmButton: false,
                  type: 'success'
                });

              case 12:
                return _context.abrupt("return", _context.sent);

              case 13:
              case "end":
                return _context.stop();
            }
          }
        }, _callee, this);
      }));

      function upload(_x) {
        return _upload.apply(this, arguments);
      }

      return upload;
    }()
  }
};
var imageAddMethod = {
  methods: {
    addImages: function addImages(_ref5) {
      var _this4 = this;

      var category = _ref5.category,
          selected = _ref5.selected;
      this.$store.dispatch('categories/addSelectedImages', {
        category_id: category.id,
        selected_images: selected
      }).then(function () {
        _this4.$router.push({
          name: 'manager.catalog.categories.images',
          params: {
            id: category.id
          }
        });

        return sweetalert2__WEBPACK_IMPORTED_MODULE_1___default.a.fire({
          title: 'Изображения добавлены!',
          text: '',
          timer: 2000,
          showConfirmButton: false,
          type: 'success'
        });
      });
    }
  }
};
var subCategoryImageAddMethod = {
  methods: {
    addImages: function addImages(_ref6) {
      var _this5 = this;

      var type = _ref6.type,
          id = _ref6.id,
          selected = _ref6.selected,
          redirectRoute = _ref6.redirectRoute;
      this.$store.dispatch('subCategories/addSelectedImages', {
        type: type,
        id: id,
        selected_images: selected
      }).then(function () {
        _this5.$router.push(redirectRoute);

        return sweetalert2__WEBPACK_IMPORTED_MODULE_1___default.a.fire({
          title: 'Изображения добавлены!',
          text: '',
          timer: 2000,
          showConfirmButton: false,
          type: 'success'
        });
      });
    }
  }
};

/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Catalog/Categories/CategoryEdit.vue":
/*!**********************************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Catalog/Categories/CategoryEdit.vue ***!
  \**********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _CategoryEdit_vue_vue_type_template_id_7017d213___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./CategoryEdit.vue?vue&type=template&id=7017d213& */ "./resources/manager/js/pages/Dashboard/Catalog/Categories/CategoryEdit.vue?vue&type=template&id=7017d213&");
/* harmony import */ var _CategoryEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./CategoryEdit.vue?vue&type=script&lang=js& */ "./resources/manager/js/pages/Dashboard/Catalog/Categories/CategoryEdit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _CategoryEdit_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./CategoryEdit.vue?vue&type=style&index=0&lang=scss& */ "./resources/manager/js/pages/Dashboard/Catalog/Categories/CategoryEdit.vue?vue&type=style&index=0&lang=scss&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _CategoryEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _CategoryEdit_vue_vue_type_template_id_7017d213___WEBPACK_IMPORTED_MODULE_0__["render"],
  _CategoryEdit_vue_vue_type_template_id_7017d213___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/manager/js/pages/Dashboard/Catalog/Categories/CategoryEdit.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Catalog/Categories/CategoryEdit.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Catalog/Categories/CategoryEdit.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CategoryEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./CategoryEdit.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Catalog/Categories/CategoryEdit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CategoryEdit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Catalog/Categories/CategoryEdit.vue?vue&type=style&index=0&lang=scss&":
/*!********************************************************************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Catalog/Categories/CategoryEdit.vue?vue&type=style&index=0&lang=scss& ***!
  \********************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_CategoryEdit_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/style-loader/dist/cjs.js!../../../../../../../node_modules/css-loader!../../../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../../../node_modules/postcss-loader/src??ref--8-2!../../../../../../../node_modules/sass-loader/dist/cjs.js??ref--8-3!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./CategoryEdit.vue?vue&type=style&index=0&lang=scss& */ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Catalog/Categories/CategoryEdit.vue?vue&type=style&index=0&lang=scss&");
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_CategoryEdit_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_cjs_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_CategoryEdit_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_CategoryEdit_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_CategoryEdit_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_dist_cjs_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_CategoryEdit_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Catalog/Categories/CategoryEdit.vue?vue&type=template&id=7017d213&":
/*!*****************************************************************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Catalog/Categories/CategoryEdit.vue?vue&type=template&id=7017d213& ***!
  \*****************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CategoryEdit_vue_vue_type_template_id_7017d213___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./CategoryEdit.vue?vue&type=template&id=7017d213& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Catalog/Categories/CategoryEdit.vue?vue&type=template&id=7017d213&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CategoryEdit_vue_vue_type_template_id_7017d213___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CategoryEdit_vue_vue_type_template_id_7017d213___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);