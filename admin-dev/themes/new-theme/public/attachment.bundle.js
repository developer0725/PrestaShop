window.attachment=function(e){function n(r){if(t[r])return t[r].exports;var o=t[r]={i:r,l:!1,exports:{}};return e[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}var t={};return n.m=e,n.c=t,n.i=function(e){return e},n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{configurable:!1,enumerable:!0,get:r})},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,n){return Object.prototype.hasOwnProperty.call(e,n)},n.p="",n(n.s=312)}({1:function(e,n){var t;t=function(){return this}();try{t=t||Function("return this")()||(0,eval)("this")}catch(e){"object"==typeof window&&(t=window)}e.exports=t},12:function(e,n,t){"use strict";function r(e,n){if(!(e instanceof n))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(n,"__esModule",{value:!0});var o=function(){function e(e,n){for(var t=0;t<n.length;t++){var r=n[t];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}return function(n,t,r){return t&&e(n.prototype,t),r&&e(n,r),n}}(),i=window.$,a=function(){function e(){r(this,e)}return o(e,[{key:"extend",value:function(e){e.getContainer().on("click",".js-submit-row-action",function(e){e.preventDefault();var n=i(e.currentTarget),t=n.data("confirm-message");if(!t.length||confirm(t)){var r=n.data("method"),o=["GET","POST"].includes(r),a=i("<form>",{action:n.data("url"),method:o?r:"POST"}).appendTo("body");o||a.append(i("<input>",{type:"_hidden",name:"_method",value:r})),a.submit()}})}}]),e}();n.default=a},13:function(e,n,t){"use strict";(function(e){function t(e,n){if(!(e instanceof n))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(n,"__esModule",{value:!0});var r=function(){function e(e,n){for(var t=0;t<n.length;t++){var r=n[t];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}return function(n,t,r){return t&&e(n.prototype,t),r&&e(n,r),n}}(),o=e.$,i=function(){function e(n){t(this,e),this.selector=".ps-sortable-column",this.columns=o(n).find(this.selector)}return r(e,[{key:"attach",value:function(){var e=this;this.columns.on("click",function(n){var t=o(n.delegateTarget);e._sortByColumn(t,e._getToggledSortDirection(t))})}},{key:"sortBy",value:function(e,n){var t=this.columns.is('[data-sort-col-name="'+e+'"]');if(!t)throw new Error('Cannot sort by "'+e+'": invalid column');this._sortByColumn(t,n)}},{key:"_sortByColumn",value:function(e,n){window.location=this._getUrl(e.data("sortColName"),"desc"===n?"desc":"asc",e.data("sortPrefix"))}},{key:"_getToggledSortDirection",value:function(e){return"asc"===e.data("sortDirection")?"desc":"asc"}},{key:"_getUrl",value:function(e,n,t){var r=new URL(window.location.href),o=r.searchParams;return t?(o.set(t+"[orderBy]",e),o.set(t+"[sortOrder]",n)):(o.set("orderBy",e),o.set("sortOrder",n)),r.toString()}}]),e}();n.default=i}).call(n,t(1))},14:function(e,n,t){"use strict";(function(e){Object.defineProperty(n,"__esModule",{value:!0});/**
 * 2007-2019 PrestaShop SA and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2019 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */
var t=e.$,r=function(e,n){t.post(e).then(function(){return window.location.assign(n)})};n.default=r}).call(n,t(1))},15:function(e,n,t){"use strict";function r(e,n){if(!(e instanceof n))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(n,"__esModule",{value:!0});var o=function(){function e(e,n){for(var t=0;t<n.length;t++){var r=n[t];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}return function(n,t,r){return t&&e(n.prototype,t),r&&e(n,r),n}}(),i=window.$,a=function(){function e(){r(this,e)}return o(e,[{key:"extend",value:function(e){e.getContainer().on("click",".js-link-row-action",function(e){var n=i(e.currentTarget).data("confirm-message");n.length&&!confirm(n)&&e.preventDefault()})}}]),e}();n.default=a},2:function(e,n,t){"use strict";function r(e,n){if(!(e instanceof n))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(n,"__esModule",{value:!0});var o=function(){function e(e,n){for(var t=0;t<n.length;t++){var r=n[t];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}return function(n,t,r){return t&&e(n.prototype,t),r&&e(n,r),n}}(),i=window.$,a=function(){function e(n){r(this,e),this.id=n,this.$container=i("#"+this.id+"_grid")}return o(e,[{key:"getId",value:function(){return this.id}},{key:"getContainer",value:function(){return this.$container}},{key:"getHeaderContainer",value:function(){return this.$container.closest(".js-grid-panel").find(".js-grid-header")}},{key:"addExtension",value:function(e){e.extend(this)}}]),e}();n.default=a},3:function(e,n,t){"use strict";function r(e,n){if(!(e instanceof n))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(n,"__esModule",{value:!0});var o=function(){function e(e,n){for(var t=0;t<n.length;t++){var r=n[t];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}return function(n,t,r){return t&&e(n.prototype,t),r&&e(n,r),n}}(),i=t(14),a=function(e){return e&&e.__esModule?e:{default:e}}(i),u=window.$,c=function(){function e(){r(this,e)}return o(e,[{key:"extend",value:function(e){e.getContainer().on("click",".js-reset-search",function(e){(0,a.default)(u(e.currentTarget).data("url"),u(e.currentTarget).data("redirect"))})}}]),e}();n.default=c},312:function(e,n,t){"use strict";function r(e){return e&&e.__esModule?e:{default:e}}var o=t(2),i=r(o),a=t(3),u=r(a),c=t(5),l=r(c),f=t(7),s=r(f),d=t(4),v=r(d),b=t(6),h=r(b),y=t(8),m=r(y),p=t(12),g=r(p),_=t(15),w=r(_);/**
                   * 2007-2019 PrestaShop and Contributors
                   *
                   * NOTICE OF LICENSE
                   *
                   * This source file is subject to the Open Software License (OSL 3.0)
                   * that is bundled with this package in the file LICENSE.txt.
                   * It is also available through the world-wide-web at this URL:
                   * https://opensource.org/licenses/OSL-3.0
                   * If you did not receive a copy of the license and are unable to
                   * obtain it through the world-wide-web, please send an email
                   * to license@prestashop.com so we can send you a copy immediately.
                   *
                   * DISCLAIMER
                   *
                   * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
                   * versions in the future. If you wish to customize PrestaShop for your
                   * needs please refer to https://www.prestashop.com for more information.
                   *
                   * @author    PrestaShop SA <contact@prestashop.com>
                   * @copyright 2007-2019 PrestaShop SA and Contributors
                   * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
                   * International Registered Trademark & Property of PrestaShop SA
                   */
(0,window.$)(function(){var e=new i.default("attachment");e.addExtension(new u.default),e.addExtension(new l.default),e.addExtension(new s.default),e.addExtension(new v.default),e.addExtension(new h.default),e.addExtension(new m.default),e.addExtension(new g.default),e.addExtension(new w.default)})},4:function(e,n,t){"use strict";function r(e,n){if(!(e instanceof n))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(n,"__esModule",{value:!0});var o=function(){function e(e,n){for(var t=0;t<n.length;t++){var r=n[t];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}return function(n,t,r){return t&&e(n.prototype,t),r&&e(n,r),n}}(),i=function(){function e(){r(this,e)}return o(e,[{key:"extend",value:function(e){e.getHeaderContainer().on("click",".js-common_refresh_list-grid-action",function(){location.reload()})}}]),e}();n.default=i},5:function(e,n,t){"use strict";function r(e,n){if(!(e instanceof n))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(n,"__esModule",{value:!0});var o=function(){function e(e,n){for(var t=0;t<n.length;t++){var r=n[t];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}return function(n,t,r){return t&&e(n.prototype,t),r&&e(n,r),n}}(),i=t(13),a=function(e){return e&&e.__esModule?e:{default:e}}(i),u=function(){function e(){r(this,e)}return o(e,[{key:"extend",value:function(e){var n=e.getContainer().find("table.table");new a.default(n).attach()}}]),e}();n.default=u},6:function(e,n,t){"use strict";function r(e,n){if(!(e instanceof n))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(n,"__esModule",{value:!0});var o=function(){function e(e,n){for(var t=0;t<n.length;t++){var r=n[t];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}return function(n,t,r){return t&&e(n.prototype,t),r&&e(n,r),n}}(),i=window.$,a=function(){function e(){r(this,e)}return o(e,[{key:"extend",value:function(e){this._handleBulkActionCheckboxSelect(e),this._handleBulkActionSelectAllCheckbox(e)}},{key:"_handleBulkActionSelectAllCheckbox",value:function(e){var n=this;e.getContainer().on("change",".js-bulk-action-select-all",function(t){var r=i(t.currentTarget),o=r.is(":checked");o?n._enableBulkActionsBtn(e):n._disableBulkActionsBtn(e),e.getContainer().find(".js-bulk-action-checkbox").prop("checked",o)})}},{key:"_handleBulkActionCheckboxSelect",value:function(e){var n=this;e.getContainer().on("change",".js-bulk-action-checkbox",function(){e.getContainer().find(".js-bulk-action-checkbox:checked").length>0?n._enableBulkActionsBtn(e):n._disableBulkActionsBtn(e)})}},{key:"_enableBulkActionsBtn",value:function(e){e.getContainer().find(".js-bulk-actions-btn").prop("disabled",!1)}},{key:"_disableBulkActionsBtn",value:function(e){e.getContainer().find(".js-bulk-actions-btn").prop("disabled",!0)}}]),e}();n.default=a},7:function(e,n,t){"use strict";function r(e,n){if(!(e instanceof n))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(n,"__esModule",{value:!0});var o=function(){function e(e,n){for(var t=0;t<n.length;t++){var r=n[t];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}return function(n,t,r){return t&&e(n.prototype,t),r&&e(n,r),n}}(),i=window.$,a=function(){function e(){r(this,e)}return o(e,[{key:"extend",value:function(e){var n=this;e.getHeaderContainer().on("click",".js-common_show_query-grid-action",function(){return n._onShowSqlQueryClick(e)}),e.getHeaderContainer().on("click",".js-common_export_sql_manager-grid-action",function(){return n._onExportSqlManagerClick(e)})}},{key:"_onShowSqlQueryClick",value:function(e){var n=i("#"+e.getId()+"_common_show_query_modal_form");this._fillExportForm(n,e);var t=i("#"+e.getId()+"_grid_common_show_query_modal");t.modal("show"),t.on("click",".btn-sql-submit",function(){return n.submit()})}},{key:"_onExportSqlManagerClick",value:function(e){var n=i("#"+e.getId()+"_common_show_query_modal_form");this._fillExportForm(n,e),n.submit()}},{key:"_fillExportForm",value:function(e,n){var t=n.getContainer().find(".js-grid-table").data("query");e.find('textarea[name="sql"]').val(t),e.find('input[name="name"]').val(this._getNameFromBreadcrumb())}},{key:"_getNameFromBreadcrumb",value:function(){var e=i(".header-toolbar").find(".breadcrumb-item"),n="";return e.each(function(e,t){var r=i(t),o=0<r.find("a").length?r.find("a").text():r.text();0<n.length&&(n=n.concat(" > ")),n=n.concat(o)}),n}}]),e}();n.default=a},8:function(e,n,t){"use strict";function r(e,n){if(!(e instanceof n))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(n,"__esModule",{value:!0});var o=function(){function e(e,n){for(var t=0;t<n.length;t++){var r=n[t];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}return function(n,t,r){return t&&e(n.prototype,t),r&&e(n,r),n}}(),i=window.$,a=function(){function e(){var n=this;return r(this,e),{extend:function(e){return n.extend(e)}}}return o(e,[{key:"extend",value:function(e){var n=this;e.getContainer().on("click",".js-bulk-action-submit-btn",function(t){n.submit(t,e)})}},{key:"submit",value:function(e,n){var t=i(e.currentTarget),r=t.data("confirm-message");if(!(void 0!==r&&0<r.length)||confirm(r)){var o=i("#"+n.getId()+"_filter_form");o.attr("action",t.data("form-url")),o.attr("method",t.data("form-method")),o.submit()}}}]),e}();n.default=a}});