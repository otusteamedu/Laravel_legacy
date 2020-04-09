(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[15],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/custom_components/Tables/TableActions.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/custom_components/Tables/TableActions.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
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
  name: "TableActions",
  props: {
    item: {
      type: Object,
      "default": null
    },
    subPath: {
      type: String,
      required: true
    }
  },
  methods: {
    onDelete: function onDelete(item) {
      this.$emit('delete', item);
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Permissions/PermissionList.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/pages/Dashboard/Permissions/PermissionList.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
/* harmony import */ var _custom_components_Tables_TableActions__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @/custom_components/Tables/TableActions */ "./resources/manager/js/custom_components/Tables/TableActions.vue");
/* harmony import */ var _mixins_base__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @/mixins/base */ "./resources/manager/js/mixins/base.js");
/* harmony import */ var _mixins_crudMethods__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @/mixins/crudMethods */ "./resources/manager/js/mixins/crudMethods.js");
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




/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'PermissionList',
  components: {
    TableActions: _custom_components_Tables_TableActions__WEBPACK_IMPORTED_MODULE_1__["default"]
  },
  mixins: [_mixins_base__WEBPACK_IMPORTED_MODULE_2__["pageTitle"], _mixins_crudMethods__WEBPACK_IMPORTED_MODULE_3__["deleteMethod"]],
  data: function data() {
    return {
      responseData: false,
      storeModule: 'permissions'
    };
  },
  computed: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapState"])('permissions', ['items'])),
  methods: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapActions"])('permissions', {
    getItemsAction: 'getItems'
  }), {
    onDelete: function onDelete(item) {
      return this["delete"]({
        payload: item.id,
        title: item.display_name,
        alertText: "\u043F\u0440\u0438\u0432\u0438\u043B\u0435\u0433\u0438\u044E \xAB".concat(item.display_name, "\xBB"),
        storeModule: this.storeModule,
        successText: 'Привилегия удалена!'
      });
    }
  }),
  created: function created() {
    var _this = this;

    this.getItemsAction().then(function () {
      _this.setPageTitle('Привилегии');

      _this.responseData = true;
    })["catch"](function () {
      return _this.$router.push({
        name: 'manager.dashboard'
      });
    });
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/custom_components/Tables/TableActions.vue?vue&type=style&index=0&id=0f288b62&scoped=true&lang=css&":
/*!****************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--7-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/custom_components/Tables/TableActions.vue?vue&type=style&index=0&id=0f288b62&scoped=true&lang=css& ***!
  \****************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.table-actions[data-v-0f288b62] {\n    display: -webkit-box;\n    display: -ms-flexbox;\n    display: flex;\n    -webkit-box-pack: end;\n        -ms-flex-pack: end;\n            justify-content: flex-end;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/custom_components/Tables/TableActions.vue?vue&type=style&index=0&id=0f288b62&scoped=true&lang=css&":
/*!********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader??ref--7-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/custom_components/Tables/TableActions.vue?vue&type=style&index=0&id=0f288b62&scoped=true&lang=css& ***!
  \********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var api = __webpack_require__(/*! ../../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
            var content = __webpack_require__(/*! !../../../../../node_modules/css-loader??ref--7-1!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--7-2!../../../../../node_modules/vue-loader/lib??vue-loader-options!./TableActions.vue?vue&type=style&index=0&id=0f288b62&scoped=true&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/custom_components/Tables/TableActions.vue?vue&type=style&index=0&id=0f288b62&scoped=true&lang=css&");

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

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/custom_components/Tables/TableActions.vue?vue&type=template&id=0f288b62&scoped=true&":
/*!*************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/custom_components/Tables/TableActions.vue?vue&type=template&id=0f288b62&scoped=true& ***!
  \*************************************************************************************************************************************************************************************************************************************************/
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
  return _vm.item
    ? _c(
        "div",
        { staticClass: "table-actions" },
        [
          _c("router-button-link", {
            attrs: {
              title: "Редактировать",
              icon: "edit",
              color: "md-success",
              route: "manager." + _vm.subPath + ".edit",
              params: { id: _vm.item.id }
            }
          }),
          _vm._v(" "),
          _c("control-button", {
            attrs: { title: "Удалить", icon: "delete", color: "md-danger" },
            on: {
              click: function($event) {
                return _vm.onDelete(_vm.item)
              }
            }
          })
        ],
        1
      )
    : _vm._e()
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Permissions/PermissionList.vue?vue&type=template&id=588fa43a&":
/*!******************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/pages/Dashboard/Permissions/PermissionList.vue?vue&type=template&id=588fa43a& ***!
  \******************************************************************************************************************************************************************************************************************************************/
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
    ? _c("div", { staticClass: "md-layout" }, [
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
                      attrs: { title: "В панель управления" }
                    }),
                    _vm._v(" "),
                    _c("router-button-link", {
                      attrs: {
                        title: "Создать привилегию",
                        icon: "add",
                        color: "md-success",
                        route: "manager.permissions.create"
                      }
                    })
                  ],
                  1
                )
              ],
              1
            ),
            _vm._v(" "),
            _c("div", { staticClass: "space-1" }),
            _vm._v(" "),
            _c(
              "md-card",
              [
                _c("card-icon-header", {
                  attrs: { title: "Список Привилегий", icon: "assignment" }
                }),
                _vm._v(" "),
                _c(
                  "md-card-content",
                  [
                    _vm.items.length
                      ? [
                          _c("md-table", {
                            staticClass:
                              "paginated-table table-striped table-hover",
                            scopedSlots: _vm._u(
                              [
                                {
                                  key: "md-table-row",
                                  fn: function(ref) {
                                    var item = ref.item
                                    return _c(
                                      "md-table-row",
                                      {},
                                      [
                                        _c(
                                          "md-table-cell",
                                          {
                                            staticStyle: { width: "50px" },
                                            attrs: { "md-label": "#" }
                                          },
                                          [
                                            _vm._v(
                                              "\n                                " +
                                                _vm._s(item.id) +
                                                "\n                            "
                                            )
                                          ]
                                        ),
                                        _vm._v(" "),
                                        _c(
                                          "md-table-cell",
                                          { attrs: { "md-label": "Имя" } },
                                          [
                                            _c(
                                              "span",
                                              { staticClass: "md-subheading" },
                                              [
                                                _vm._v(
                                                  _vm._s(item.display_name)
                                                )
                                              ]
                                            )
                                          ]
                                        ),
                                        _vm._v(" "),
                                        _c(
                                          "md-table-cell",
                                          { attrs: { "md-label": "Алиас" } },
                                          [
                                            _vm._v(
                                              "\n                                " +
                                                _vm._s(item.name) +
                                                "\n                            "
                                            )
                                          ]
                                        ),
                                        _vm._v(" "),
                                        _c(
                                          "md-table-cell",
                                          { attrs: { "md-label": "Описание" } },
                                          [
                                            _vm._v(
                                              "\n                                " +
                                                _vm._s(item.description) +
                                                "\n                            "
                                            )
                                          ]
                                        ),
                                        _vm._v(" "),
                                        _c(
                                          "md-table-cell",
                                          { attrs: { "md-label": "Действия" } },
                                          [
                                            _c("table-actions", {
                                              attrs: {
                                                item: item,
                                                subPath: _vm.storeModule
                                              },
                                              on: { delete: _vm.onDelete }
                                            })
                                          ],
                                          1
                                        )
                                      ],
                                      1
                                    )
                                  }
                                }
                              ],
                              null,
                              false,
                              3396054559
                            ),
                            model: {
                              value: _vm.items,
                              callback: function($$v) {
                                _vm.items = $$v
                              },
                              expression: "items"
                            }
                          })
                        ]
                      : [
                          _c("div", { staticClass: "alert alert-info" }, [
                            _c("span", [
                              _c("h3", [_vm._v("У Вас еще нет привилегий!")])
                            ])
                          ])
                        ]
                  ],
                  2
                )
              ],
              1
            )
          ],
          1
        )
      ])
    : _vm._e()
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/manager/js/custom_components/Tables/TableActions.vue":
/*!************************************************************************!*\
  !*** ./resources/manager/js/custom_components/Tables/TableActions.vue ***!
  \************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _TableActions_vue_vue_type_template_id_0f288b62_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./TableActions.vue?vue&type=template&id=0f288b62&scoped=true& */ "./resources/manager/js/custom_components/Tables/TableActions.vue?vue&type=template&id=0f288b62&scoped=true&");
/* harmony import */ var _TableActions_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./TableActions.vue?vue&type=script&lang=js& */ "./resources/manager/js/custom_components/Tables/TableActions.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _TableActions_vue_vue_type_style_index_0_id_0f288b62_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./TableActions.vue?vue&type=style&index=0&id=0f288b62&scoped=true&lang=css& */ "./resources/manager/js/custom_components/Tables/TableActions.vue?vue&type=style&index=0&id=0f288b62&scoped=true&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _TableActions_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _TableActions_vue_vue_type_template_id_0f288b62_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _TableActions_vue_vue_type_template_id_0f288b62_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "0f288b62",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/manager/js/custom_components/Tables/TableActions.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/manager/js/custom_components/Tables/TableActions.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************!*\
  !*** ./resources/manager/js/custom_components/Tables/TableActions.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_TableActions_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./TableActions.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/custom_components/Tables/TableActions.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_TableActions_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/manager/js/custom_components/Tables/TableActions.vue?vue&type=style&index=0&id=0f288b62&scoped=true&lang=css&":
/*!*********************************************************************************************************************************!*\
  !*** ./resources/manager/js/custom_components/Tables/TableActions.vue?vue&type=style&index=0&id=0f288b62&scoped=true&lang=css& ***!
  \*********************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_TableActions_vue_vue_type_style_index_0_id_0f288b62_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/style-loader/dist/cjs.js!../../../../../node_modules/css-loader??ref--7-1!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--7-2!../../../../../node_modules/vue-loader/lib??vue-loader-options!./TableActions.vue?vue&type=style&index=0&id=0f288b62&scoped=true&lang=css& */ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/custom_components/Tables/TableActions.vue?vue&type=style&index=0&id=0f288b62&scoped=true&lang=css&");
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_TableActions_vue_vue_type_style_index_0_id_0f288b62_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_cjs_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_TableActions_vue_vue_type_style_index_0_id_0f288b62_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_TableActions_vue_vue_type_style_index_0_id_0f288b62_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_TableActions_vue_vue_type_style_index_0_id_0f288b62_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_dist_cjs_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_TableActions_vue_vue_type_style_index_0_id_0f288b62_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/manager/js/custom_components/Tables/TableActions.vue?vue&type=template&id=0f288b62&scoped=true&":
/*!*******************************************************************************************************************!*\
  !*** ./resources/manager/js/custom_components/Tables/TableActions.vue?vue&type=template&id=0f288b62&scoped=true& ***!
  \*******************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TableActions_vue_vue_type_template_id_0f288b62_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./TableActions.vue?vue&type=template&id=0f288b62&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/custom_components/Tables/TableActions.vue?vue&type=template&id=0f288b62&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TableActions_vue_vue_type_template_id_0f288b62_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TableActions_vue_vue_type_template_id_0f288b62_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



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
          icon: 'success'
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
          icon: 'success'
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
          redirectRoute = _ref3$redirectRoute === void 0 ? null : _ref3$redirectRoute,
          _ref3$categoryId = _ref3.categoryId,
          categoryId = _ref3$categoryId === void 0 ? null : _ref3$categoryId,
          _ref3$paginationData = _ref3.paginationData,
          paginationData = _ref3$paginationData === void 0 ? null : _ref3$paginationData;
      var module = storeModule ? "".concat(storeModule, "/") : '';
      return deleteSwalFireConfirm(alertText).then(function (result) {
        if (result.value) {
          return _this3.$store.dispatch("".concat(module, "destroy"), payload).then(function () {
            if (redirectRoute) {
              _this3.$router.go(-1) ? _this3.$router.go(-1) : _this3.$router.push(redirectRoute);
            }

            if (paginationData) {
              categoryId ? _this3.$store.dispatch('categories/getImages', {
                id: categoryId,
                data: paginationData
              }) : _this3.$store.dispatch('images/getItems', paginationData);
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
    icon: 'warning',
    showCancelButton: true,
    customClass: {
      confirmButton: 'md-button md-success btn-fill',
      cancelButton: 'md-button md-danger btn-fill'
    },
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
    icon: 'success',
    showConfirmButton: false
  });
};

var uploadMethod = {
  methods: {
    upload: function upload(_ref4) {
      var _this4 = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {
        var uploadFiles, _ref4$type, type, _ref4$id, id, _ref4$storeModule, storeModule, paginationData, files, module;

        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                uploadFiles = _ref4.uploadFiles, _ref4$type = _ref4.type, type = _ref4$type === void 0 ? null : _ref4$type, _ref4$id = _ref4.id, id = _ref4$id === void 0 ? null : _ref4$id, _ref4$storeModule = _ref4.storeModule, storeModule = _ref4$storeModule === void 0 ? null : _ref4$storeModule, paginationData = _ref4.paginationData;
                files = Array.from(uploadFiles);
                module = storeModule ? storeModule : 'categories';

                if (!id) {
                  _context.next = 8;
                  break;
                }

                _context.next = 6;
                return _this4.$store.dispatch("".concat(module, "/uploadImages"), {
                  files: files,
                  id: id,
                  type: type,
                  paginationData: paginationData
                });

              case 6:
                _context.next = 10;
                break;

              case 8:
                _context.next = 10;
                return _this4.$store.dispatch('images/store', {
                  files: files,
                  paginationData: paginationData
                });

              case 10:
                _context.next = 12;
                return sweetalert2__WEBPACK_IMPORTED_MODULE_1___default.a.fire({
                  title: 'Изображения загружены!',
                  text: '',
                  timer: 2000,
                  showConfirmButton: false,
                  icon: 'success'
                });

              case 12:
                return _context.abrupt("return", _context.sent);

              case 13:
              case "end":
                return _context.stop();
            }
          }
        }, _callee);
      }))();
    }
  }
};
var imageAddMethod = {
  methods: {
    addImages: function addImages(_ref5) {
      var _this5 = this;

      var category = _ref5.category,
          selected = _ref5.selected;
      this.$store.dispatch('categories/addSelectedImages', {
        category_id: category.id,
        selected_images: selected
      }).then(function () {
        _this5.$router.push({
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
          icon: 'success'
        });
      });
    }
  }
};
var subCategoryImageAddMethod = {
  methods: {
    addImages: function addImages(_ref6) {
      var _this6 = this;

      var type = _ref6.type,
          id = _ref6.id,
          selected = _ref6.selected,
          redirectRoute = _ref6.redirectRoute;
      this.$store.dispatch('subCategories/addSelectedImages', {
        type: type,
        id: id,
        selected_images: selected
      }).then(function () {
        _this6.$router.push(redirectRoute);

        return sweetalert2__WEBPACK_IMPORTED_MODULE_1___default.a.fire({
          title: 'Изображения добавлены!',
          text: '',
          timer: 2000,
          showConfirmButton: false,
          icon: 'success'
        });
      });
    }
  }
};

/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Permissions/PermissionList.vue":
/*!*****************************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Permissions/PermissionList.vue ***!
  \*****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _PermissionList_vue_vue_type_template_id_588fa43a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./PermissionList.vue?vue&type=template&id=588fa43a& */ "./resources/manager/js/pages/Dashboard/Permissions/PermissionList.vue?vue&type=template&id=588fa43a&");
/* harmony import */ var _PermissionList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./PermissionList.vue?vue&type=script&lang=js& */ "./resources/manager/js/pages/Dashboard/Permissions/PermissionList.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _PermissionList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _PermissionList_vue_vue_type_template_id_588fa43a___WEBPACK_IMPORTED_MODULE_0__["render"],
  _PermissionList_vue_vue_type_template_id_588fa43a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/manager/js/pages/Dashboard/Permissions/PermissionList.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Permissions/PermissionList.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Permissions/PermissionList.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PermissionList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./PermissionList.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Permissions/PermissionList.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PermissionList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Permissions/PermissionList.vue?vue&type=template&id=588fa43a&":
/*!************************************************************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Permissions/PermissionList.vue?vue&type=template&id=588fa43a& ***!
  \************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PermissionList_vue_vue_type_template_id_588fa43a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./PermissionList.vue?vue&type=template&id=588fa43a& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Permissions/PermissionList.vue?vue&type=template&id=588fa43a&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PermissionList_vue_vue_type_template_id_588fa43a___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PermissionList_vue_vue_type_template_id_588fa43a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);