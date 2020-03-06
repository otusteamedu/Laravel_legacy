(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[13],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/custom_components/Tables/ImageTableActions.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/custom_components/Tables/ImageTableActions.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************************************************************************************************/
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
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  name: "ImageTableActions",
  props: {
    item: {
      type: Object,
      "default": null
    },
    remove: {
      type: Boolean,
      "default": false
    },
    page: {
      type: Number,
      "default": null
    }
  },
  methods: {
    onDelete: function onDelete() {
      this.$emit('delete', this.item);
    },
    onRemove: function onRemove() {
      this.$emit('remove', this.item.id);
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Catalog/SubCategories/ImageList.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/pages/Dashboard/Catalog/SubCategories/ImageList.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
/* harmony import */ var _mixins_base__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @/mixins/base */ "./resources/manager/js/mixins/base.js");
/* harmony import */ var _mixins_crudMethods__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @/mixins/crudMethods */ "./resources/manager/js/mixins/crudMethods.js");
/* harmony import */ var _custom_components_Tables_ImageListTable__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @/custom_components/Tables/ImageListTable */ "./resources/manager/js/custom_components/Tables/ImageListTable.vue");
/* harmony import */ var _custom_components_Tables_ImageTableActions__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @/custom_components/Tables/ImageTableActions */ "./resources/manager/js/custom_components/Tables/ImageTableActions.vue");
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





/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'ImageList',
  mixins: [_mixins_base__WEBPACK_IMPORTED_MODULE_1__["pageTitle"], _mixins_crudMethods__WEBPACK_IMPORTED_MODULE_2__["deleteMethod"], _mixins_crudMethods__WEBPACK_IMPORTED_MODULE_2__["uploadMethod"]],
  components: {
    ImageListTable: _custom_components_Tables_ImageListTable__WEBPACK_IMPORTED_MODULE_3__["default"],
    ImageTableActions: _custom_components_Tables_ImageTableActions__WEBPACK_IMPORTED_MODULE_4__["default"]
  },
  props: {
    category_type: {
      type: String,
      "default": 'images'
    },
    id: {
      type: [Number, String],
      "default": null
    }
  },
  data: function data() {
    return {
      responseData: false,
      storeModule: 'images',
      redirectRoute: {
        name: 'manager.catalog.subcategories.list',
        params: {
          category_type: this.category_type
        }
      }
    };
  },
  computed: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapState"])({
    searchQuery: function searchQuery(state) {
      return state.searchQuery;
    },
    searchedData: function searchedData(state) {
      return state.searchedData;
    },
    category: function category(state) {
      return state.subCategories.item;
    },
    items: function items(state) {
      return state.images.items;
    },
    fileProgress: function fileProgress(state) {
      return state.images.fileProgress;
    },
    pagination: function pagination(state) {
      return state.images.pagination;
    },
    previousPage: function previousPage(state) {
      return state.images.previousPage;
    }
  }), {
    paginationData: function paginationData() {
      return {
        current_page: this.pagination.current_page,
        per_page: this.pagination.per_page,
        sort_by: this.pagination.sort_by,
        sort_order: this.pagination.sort_order
      };
    }
  }),
  methods: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapActions"])({
    publishAction: 'images/publish',
    resetPaginationAction: 'images/resetPagination',
    updatePaginationAction: 'images/updatePaginationFields',
    setPreviousPageAction: 'images/setPreviousPage',
    removeImageAction: 'subCategories/removeImage',
    getItemWithImagesAction: 'subCategories/getItemWithImages',
    getImagesAction: 'subCategories/getImages'
  }), {
    init: function init(category_type) {
      var _this = this;

      this.getItemWithImagesAction({
        type: category_type,
        id: this.id,
        paginationData: this.paginationData
      }).then(function () {
        _this.setPageTitle("\u0418\u0437\u043E\u0431\u0440\u0430\u0436\u0435\u043D\u0438\u044F \u043A\u0430\u0442\u0435\u0433\u043E\u0440\u0438\u0438 \xAB".concat(_this.category.title, "\xBB"));

        _this.responseData = true;
      })["catch"](function () {
        return _this.$router.push(_this.redirectRoute);
      });
    },
    fileInputChange: function fileInputChange(event) {
      this.upload({
        uploadFiles: event.target.files,
        type: this.category_type,
        id: this.id,
        storeModule: 'subCategories',
        paginationData: this.paginationData
      });
    },
    onRemove: function onRemove(id) {
      var _this2 = this;

      var paginationData = this.preparePaginationData();
      this.removeImageAction({
        type: this.category_type,
        category_id: this.id,
        image_id: id,
        paginationData: paginationData
      }).then(function () {
        return _this2.checkGoToPreviousPage() ? _this2.goToPreviousPage() : _this2.rebootImageList(true);
      });
    },
    onDelete: function onDelete(item) {
      var _this3 = this;

      var paginationData = this.preparePaginationData();
      this["delete"]({
        payload: item.id,
        title: item.id,
        alertText: "\u0438\u0437\u043E\u0431\u0440\u0430\u0436\u0435\u043D\u0438\u0435 \xAB".concat(item.id, "\xBB"),
        successText: 'Изображение удалено!',
        storeModule: this.storeModule,
        categoryId: this.id || null,
        paginationData: paginationData
      }).then(function () {
        return _this3.checkGoToPreviousPage() ? _this3.goToPreviousPage() : _this3.rebootImageList(true);
      });
    },
    changePage: function changePage(item) {
      this.changePaginationSetting({
        current_page: item
      });
    },
    changeSort: function changeSort(sortOrder) {
      this.changePaginationSetting({
        sort_order: sortOrder
      });
    },
    changePaginationSetting: function changePaginationSetting(settingObject) {
      this.updatePaginationAction(settingObject);
      !!this.searchQuery && this.searchedData.length ? this.search(this.searchQuery) : this.rebootImageList();
    },
    search: function search(query) {
      var currentPageFirst = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
      var paginationData = Object.assign({
        query: query
      }, this.paginationData);

      if (currentPageFirst) {
        paginationData.current_page = 1;
      }

      this.getImagesAction({
        id: this.id,
        type: this.category_type,
        paginationData: paginationData
      });
    },
    handleSearch: function handleSearch(query) {
      query ? this.search(query, true) : this.rebootImageList(true);
    },
    rebootImageList: function rebootImageList() {
      var currentPageFirst = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
      var paginationData = Object.assign({}, this.paginationData);

      if (currentPageFirst) {
        paginationData.current_page = 1;
      }

      return this.getImagesAction({
        id: this.id,
        type: this.category_type,
        paginationData: paginationData
      });
    },
    preparePaginationData: function preparePaginationData() {
      return this.searchQuery ? Object.assign({
        query: this.searchQuery
      }, this.paginationData) : Object.assign({}, this.paginationData);
    },
    paginationReset: function paginationReset() {
      this.resetPaginationAction();

      if (this.previousPage) {
        this.updatePaginationAction({
          current_page: this.previousPage
        });
      }
    },
    onPublishChange: function onPublishChange(id) {
      this.publishAction(id);
    },
    checkGoToPreviousPage: function checkGoToPreviousPage() {
      return this.checkItemsLength() ? this.pagination.current_page > 1 : false;
    },
    checkItemsLength: function checkItemsLength() {
      return !this.items.length || this.isSearchDataEmpty;
    },
    goToPreviousPage: function goToPreviousPage() {
      this.changePaginationSetting({
        current_page: this.pagination.current_page - 1
      });
    },
    isSearchDataEmpty: function isSearchDataEmpty() {
      return !!this.searchQuery && !this.searchedData.length;
    }
  }),
  created: function created() {
    this.init(this.category_type);
  },
  beforeDestroy: function beforeDestroy() {
    this.paginationReset();
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Catalog/SubCategories/ImageList.vue?vue&type=style&index=0&id=d1d32c44&lang=scss&scoped=true&":
/*!******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--8-2!./node_modules/sass-loader/dist/cjs.js??ref--8-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/pages/Dashboard/Catalog/SubCategories/ImageList.vue?vue&type=style&index=0&id=d1d32c44&lang=scss&scoped=true& ***!
  \******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".md-between[data-v-d1d32c44] {\n  display: -webkit-box;\n  display: -ms-flexbox;\n  display: flex;\n  -webkit-box-pack: justify;\n      -ms-flex-pack: justify;\n          justify-content: space-between;\n}\n.md-progress-bar__container[data-v-d1d32c44] {\n  height: 4px;\n}", ""]);

// exports


/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/custom_components/Tables/ImageTableActions.vue?vue&type=style&index=0&id=022c19c7&scoped=true&lang=css&":
/*!*********************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--7-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/custom_components/Tables/ImageTableActions.vue?vue&type=style&index=0&id=022c19c7&scoped=true&lang=css& ***!
  \*********************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.table-actions[data-v-022c19c7] {\n    display: -webkit-box;\n    display: -ms-flexbox;\n    display: flex;\n    -webkit-box-pack: end;\n        -ms-flex-pack: end;\n            justify-content: flex-end;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Catalog/SubCategories/ImageList.vue?vue&type=style&index=0&id=d1d32c44&lang=scss&scoped=true&":
/*!**********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--8-2!./node_modules/sass-loader/dist/cjs.js??ref--8-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/pages/Dashboard/Catalog/SubCategories/ImageList.vue?vue&type=style&index=0&id=d1d32c44&lang=scss&scoped=true& ***!
  \**********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var api = __webpack_require__(/*! ../../../../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
            var content = __webpack_require__(/*! !../../../../../../../node_modules/css-loader!../../../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../../../node_modules/postcss-loader/src??ref--8-2!../../../../../../../node_modules/sass-loader/dist/cjs.js??ref--8-3!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./ImageList.vue?vue&type=style&index=0&id=d1d32c44&lang=scss&scoped=true& */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Catalog/SubCategories/ImageList.vue?vue&type=style&index=0&id=d1d32c44&lang=scss&scoped=true&");

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

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/custom_components/Tables/ImageTableActions.vue?vue&type=style&index=0&id=022c19c7&scoped=true&lang=css&":
/*!*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader??ref--7-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--7-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/custom_components/Tables/ImageTableActions.vue?vue&type=style&index=0&id=022c19c7&scoped=true&lang=css& ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var api = __webpack_require__(/*! ../../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
            var content = __webpack_require__(/*! !../../../../../node_modules/css-loader??ref--7-1!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--7-2!../../../../../node_modules/vue-loader/lib??vue-loader-options!./ImageTableActions.vue?vue&type=style&index=0&id=022c19c7&scoped=true&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/custom_components/Tables/ImageTableActions.vue?vue&type=style&index=0&id=022c19c7&scoped=true&lang=css&");

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

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/custom_components/Tables/ImageTableActions.vue?vue&type=template&id=022c19c7&scoped=true&":
/*!******************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/custom_components/Tables/ImageTableActions.vue?vue&type=template&id=022c19c7&scoped=true& ***!
  \******************************************************************************************************************************************************************************************************************************************************/
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
          _vm.remove
            ? _c("control-button", {
                attrs: { title: "Отвязать", icon: "remove", color: "md-info" },
                on: { click: _vm.onRemove }
              })
            : _vm._e(),
          _vm._v(" "),
          _c("router-button-link", {
            attrs: {
              title: "Редактировать",
              icon: "edit",
              color: "md-success",
              route: "manager.images.edit",
              params: { id: _vm.item.id, page: _vm.page }
            }
          }),
          _vm._v(" "),
          _c("control-button", {
            attrs: { title: "Удалить", icon: "delete", color: "md-danger" },
            on: { click: _vm.onDelete }
          })
        ],
        1
      )
    : _vm._e()
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Catalog/SubCategories/ImageList.vue?vue&type=template&id=d1d32c44&scoped=true&":
/*!***********************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/manager/js/pages/Dashboard/Catalog/SubCategories/ImageList.vue?vue&type=template&id=d1d32c44&scoped=true& ***!
  \***********************************************************************************************************************************************************************************************************************************************************/
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
                          _c("router-button-link", {
                            attrs: {
                              icon: "add",
                              color: "md-success",
                              title: "Добавить изображения",
                              route:
                                "manager.catalog.subcategories.images.excluded",
                              params: { id: _vm.id }
                            }
                          }),
                          _vm._v(" "),
                          _c("upload-button", {
                            on: { change: _vm.fileInputChange }
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
            { staticClass: "md-layout-item" },
            [
              _c(
                "div",
                { staticClass: "md-layout-item md-progress-bar__container" },
                [
                  _vm.fileProgress
                    ? _c("md-progress-bar", {
                        staticClass: "md-info",
                        attrs: { "md-value": _vm.fileProgress }
                      })
                    : _vm._e()
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "md-card",
                [
                  _c("card-icon-header", {
                    attrs: { title: "Каталог изображений", icon: "image" }
                  }),
                  _vm._v(" "),
                  _c(
                    "md-card-content",
                    [
                      _vm.items.length
                        ? _c("image-list-table", {
                            attrs: { items: _vm.items },
                            on: {
                              search: _vm.handleSearch,
                              changePage: _vm.changePage,
                              changeSort: _vm.changeSort,
                              publish: _vm.onPublishChange
                            },
                            scopedSlots: _vm._u(
                              [
                                {
                                  key: "actions-column",
                                  fn: function(ref) {
                                    var item = ref.item
                                    return [
                                      item
                                        ? _c(
                                            "md-table-cell",
                                            {
                                              attrs: { "md-label": "Действия" }
                                            },
                                            [
                                              _c("image-table-actions", {
                                                attrs: {
                                                  item: item,
                                                  remove: true,
                                                  page:
                                                    _vm.pagination.current_page
                                                },
                                                on: {
                                                  remove: _vm.onRemove,
                                                  delete: _vm.onDelete
                                                }
                                              })
                                            ],
                                            1
                                          )
                                        : _vm._e()
                                    ]
                                  }
                                }
                              ],
                              null,
                              false,
                              3861898785
                            )
                          })
                        : [
                            _c("div", { staticClass: "alert alert-info" }, [
                              _c("span", [
                                _c("h3", [_vm._v("Пока нет изображений!")])
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
      ])
    : _vm._e()
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/manager/js/custom_components/Tables/ImageTableActions.vue":
/*!*****************************************************************************!*\
  !*** ./resources/manager/js/custom_components/Tables/ImageTableActions.vue ***!
  \*****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ImageTableActions_vue_vue_type_template_id_022c19c7_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ImageTableActions.vue?vue&type=template&id=022c19c7&scoped=true& */ "./resources/manager/js/custom_components/Tables/ImageTableActions.vue?vue&type=template&id=022c19c7&scoped=true&");
/* harmony import */ var _ImageTableActions_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ImageTableActions.vue?vue&type=script&lang=js& */ "./resources/manager/js/custom_components/Tables/ImageTableActions.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _ImageTableActions_vue_vue_type_style_index_0_id_022c19c7_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./ImageTableActions.vue?vue&type=style&index=0&id=022c19c7&scoped=true&lang=css& */ "./resources/manager/js/custom_components/Tables/ImageTableActions.vue?vue&type=style&index=0&id=022c19c7&scoped=true&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _ImageTableActions_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ImageTableActions_vue_vue_type_template_id_022c19c7_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ImageTableActions_vue_vue_type_template_id_022c19c7_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "022c19c7",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/manager/js/custom_components/Tables/ImageTableActions.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/manager/js/custom_components/Tables/ImageTableActions.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************!*\
  !*** ./resources/manager/js/custom_components/Tables/ImageTableActions.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageTableActions_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./ImageTableActions.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/custom_components/Tables/ImageTableActions.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageTableActions_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/manager/js/custom_components/Tables/ImageTableActions.vue?vue&type=style&index=0&id=022c19c7&scoped=true&lang=css&":
/*!**************************************************************************************************************************************!*\
  !*** ./resources/manager/js/custom_components/Tables/ImageTableActions.vue?vue&type=style&index=0&id=022c19c7&scoped=true&lang=css& ***!
  \**************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageTableActions_vue_vue_type_style_index_0_id_022c19c7_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/style-loader/dist/cjs.js!../../../../../node_modules/css-loader??ref--7-1!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--7-2!../../../../../node_modules/vue-loader/lib??vue-loader-options!./ImageTableActions.vue?vue&type=style&index=0&id=022c19c7&scoped=true&lang=css& */ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/custom_components/Tables/ImageTableActions.vue?vue&type=style&index=0&id=022c19c7&scoped=true&lang=css&");
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageTableActions_vue_vue_type_style_index_0_id_022c19c7_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_cjs_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageTableActions_vue_vue_type_style_index_0_id_022c19c7_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageTableActions_vue_vue_type_style_index_0_id_022c19c7_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageTableActions_vue_vue_type_style_index_0_id_022c19c7_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_dist_cjs_js_node_modules_css_loader_index_js_ref_7_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_7_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageTableActions_vue_vue_type_style_index_0_id_022c19c7_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/manager/js/custom_components/Tables/ImageTableActions.vue?vue&type=template&id=022c19c7&scoped=true&":
/*!************************************************************************************************************************!*\
  !*** ./resources/manager/js/custom_components/Tables/ImageTableActions.vue?vue&type=template&id=022c19c7&scoped=true& ***!
  \************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageTableActions_vue_vue_type_template_id_022c19c7_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./ImageTableActions.vue?vue&type=template&id=022c19c7&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/custom_components/Tables/ImageTableActions.vue?vue&type=template&id=022c19c7&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageTableActions_vue_vue_type_template_id_022c19c7_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageTableActions_vue_vue_type_template_id_022c19c7_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Catalog/SubCategories/ImageList.vue":
/*!**********************************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Catalog/SubCategories/ImageList.vue ***!
  \**********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ImageList_vue_vue_type_template_id_d1d32c44_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ImageList.vue?vue&type=template&id=d1d32c44&scoped=true& */ "./resources/manager/js/pages/Dashboard/Catalog/SubCategories/ImageList.vue?vue&type=template&id=d1d32c44&scoped=true&");
/* harmony import */ var _ImageList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ImageList.vue?vue&type=script&lang=js& */ "./resources/manager/js/pages/Dashboard/Catalog/SubCategories/ImageList.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _ImageList_vue_vue_type_style_index_0_id_d1d32c44_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./ImageList.vue?vue&type=style&index=0&id=d1d32c44&lang=scss&scoped=true& */ "./resources/manager/js/pages/Dashboard/Catalog/SubCategories/ImageList.vue?vue&type=style&index=0&id=d1d32c44&lang=scss&scoped=true&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _ImageList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ImageList_vue_vue_type_template_id_d1d32c44_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ImageList_vue_vue_type_template_id_d1d32c44_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "d1d32c44",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/manager/js/pages/Dashboard/Catalog/SubCategories/ImageList.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Catalog/SubCategories/ImageList.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Catalog/SubCategories/ImageList.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./ImageList.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Catalog/SubCategories/ImageList.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Catalog/SubCategories/ImageList.vue?vue&type=style&index=0&id=d1d32c44&lang=scss&scoped=true&":
/*!********************************************************************************************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Catalog/SubCategories/ImageList.vue?vue&type=style&index=0&id=d1d32c44&lang=scss&scoped=true& ***!
  \********************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageList_vue_vue_type_style_index_0_id_d1d32c44_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/style-loader/dist/cjs.js!../../../../../../../node_modules/css-loader!../../../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../../../node_modules/postcss-loader/src??ref--8-2!../../../../../../../node_modules/sass-loader/dist/cjs.js??ref--8-3!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./ImageList.vue?vue&type=style&index=0&id=d1d32c44&lang=scss&scoped=true& */ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Catalog/SubCategories/ImageList.vue?vue&type=style&index=0&id=d1d32c44&lang=scss&scoped=true&");
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageList_vue_vue_type_style_index_0_id_d1d32c44_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_cjs_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageList_vue_vue_type_style_index_0_id_d1d32c44_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageList_vue_vue_type_style_index_0_id_d1d32c44_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageList_vue_vue_type_style_index_0_id_d1d32c44_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_dist_cjs_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageList_vue_vue_type_style_index_0_id_d1d32c44_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/manager/js/pages/Dashboard/Catalog/SubCategories/ImageList.vue?vue&type=template&id=d1d32c44&scoped=true&":
/*!*****************************************************************************************************************************!*\
  !*** ./resources/manager/js/pages/Dashboard/Catalog/SubCategories/ImageList.vue?vue&type=template&id=d1d32c44&scoped=true& ***!
  \*****************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageList_vue_vue_type_template_id_d1d32c44_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./ImageList.vue?vue&type=template&id=d1d32c44&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/manager/js/pages/Dashboard/Catalog/SubCategories/ImageList.vue?vue&type=template&id=d1d32c44&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageList_vue_vue_type_template_id_d1d32c44_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ImageList_vue_vue_type_template_id_d1d32c44_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);