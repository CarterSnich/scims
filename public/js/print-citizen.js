/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/print-citizen.js":
/*!***************************************!*\
  !*** ./resources/js/print-citizen.js ***!
  \***************************************/
/***/ (() => {

eval("var _citizen$name_of_asso, _citizen$address_of_a, _citizen$date_of_memb, _citizen$term;\n\nfunction _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }\n\nfunction _nonIterableRest() { throw new TypeError(\"Invalid attempt to destructure non-iterable instance.\\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.\"); }\n\nfunction _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === \"string\") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === \"Object\" && o.constructor) n = o.constructor.name; if (n === \"Map\" || n === \"Set\") return Array.from(o); if (n === \"Arguments\" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }\n\nfunction _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }\n\nfunction _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== \"undefined\" && arr[Symbol.iterator] || arr[\"@@iterator\"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i[\"return\"] != null) _i[\"return\"](); } finally { if (_d) throw _e; } } return _arr; }\n\nfunction _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }\n\nvar ucfirst = function ucfirst(string) {\n  return string[0].toUpperCase() + string.substring(1);\n};\n\nvar citizen = JSON.parse(document.querySelector('meta[name=citizen]').getAttribute('content'));\nvar citizenId = document.querySelector('meta[name=citizen_id]').getAttribute('content');\nvar fullname = document.querySelector('meta[name=fullname]').getAttribute('content');\nvar age = document.querySelector('meta[name=age]').getAttribute('content');\nvar educational_attainment = document.querySelector('meta[name=educational_attainment]').getAttribute('content');\nvar barangay = JSON.parse(document.querySelector('meta[name=barangay]').getAttribute('content'));\nvar picture = document.querySelector('meta[name=picture]').getAttribute('content');\nvar form = document.querySelector('meta[name=form]').getAttribute('content');\nwindow.jsPDF = window.jspdf.jsPDF;\nvar doc = new jsPDF({\n  orientation: \"portrait\",\n  unit: \"in\",\n  format: [11.69, 8.27]\n});\nvar align_center = {\n  align: 'center'\n};\ndoc.setFontSize(12);\ndoc.setLineWidth(.01); // form\n\ndoc.addImage(form, form.split('.').pop().toUpperCase(), 0, 0, 8.27, 11.69);\nconsole.dir(citizen); // ------------------------------------\n//           VALUES\n// ------------------------------------\n// name\n\ndoc.text(fullname, 1.25, 2.1); // fullname\n// date of birth\n\nvar _citizen$date_of_birt = citizen['date_of_birth'].split('-'),\n    _citizen$date_of_birt2 = _slicedToArray(_citizen$date_of_birt, 3),\n    yy = _citizen$date_of_birt2[0],\n    mm = _citizen$date_of_birt2[1],\n    dd = _citizen$date_of_birt2[2];\n\ndoc.text(\"\".concat(mm, \"/\").concat(dd, \"/\").concat(yy), 2.7, 2.32, align_center); // date of birth\n// age\n\ndoc.text(age + '', 5, 2.32, align_center); // sex\n\ndoc.text(ucfirst(citizen['sex']), 6.5, 2.32, align_center); // place of birth\n\ndoc.text(citizen['place_of_birth'], 2.8, 2.525, align_center); // civil status\n\ndoc.text(ucfirst(citizen['civil_status']), 5.7, 2.525, align_center); // address\n\ndoc.text(\"\".concat(citizen.house_no, \", \").concat(citizen.street, \", \").concat(barangay.barangay_name), 2.45, 2.75, align_center); // picture ID\n\nvar pictureFormat = picture.split('.').pop().toUpperCase();\ndoc.addImage(picture, pictureFormat, 6.5, .5, 1, 1); // educational attainment\n\ndoc.text(educational_attainment, 2.3, 2.955); // occupation\n\ndoc.text(citizen['occupation'], 1.6, 3.185); // other skills\n\ndoc.text(citizen['other_skills'] || '', 1.6, 3.38); // annual income\n\ndoc.text(\"P \".concat(citizen['annual_income']), 5.9, 3.38, align_center); // family composition\n\nvar init_x = 4.7;\ncitizen['family_composition'].forEach(function (member) {\n  doc.text(member['name'], 1.7, init_x, align_center); // name\n\n  doc.text(member['relationship'], 3.4, init_x, align_center); // relationship\n\n  doc.text(member['age'], 4.35, init_x, align_center); // age\n\n  doc.text(ucfirst(member['civil_status']), 5.05, init_x, align_center); // civil_status\n\n  doc.text(ucfirst(member['occupation']), 6.15, init_x, align_center); // occupation\n\n  doc.text(ucfirst(member['income']), 7.14, init_x, align_center); // income\n\n  init_x += .25;\n}); // name of association\n\ndoc.text((_citizen$name_of_asso = citizen['name_of_association']) !== null && _citizen$name_of_asso !== void 0 ? _citizen$name_of_asso : '', 2.1, 6.75); // address of association\n\ndoc.text((_citizen$address_of_a = citizen['address_of_association']) !== null && _citizen$address_of_a !== void 0 ? _citizen$address_of_a : '', 1.3, 7); // address of association\n\ndoc.text((_citizen$date_of_memb = citizen['date_of_membership']) !== null && _citizen$date_of_memb !== void 0 ? _citizen$date_of_memb : '', 2.5, 7.25); // term\n\ndoc.text((_citizen$term = citizen['term']) !== null && _citizen$term !== void 0 ? _citizen$term : '', 3, 7.5); // set pdf to iframe\n\ndocument.querySelector('iframe').setAttribute('src', doc.output('datauristring'));\ndoc.save(\"\".concat(document.title, \".pdf\"));\nif (!!window.chrome) alert(\"On Chromium-based browsers, PDF may fail rendering, instead it will be downloaded. If there is no downloaded PDF file, please contact the system administration.\");//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvcHJpbnQtY2l0aXplbi5qcy5qcyIsIm5hbWVzIjpbInVjZmlyc3QiLCJzdHJpbmciLCJ0b1VwcGVyQ2FzZSIsInN1YnN0cmluZyIsImNpdGl6ZW4iLCJKU09OIiwicGFyc2UiLCJkb2N1bWVudCIsInF1ZXJ5U2VsZWN0b3IiLCJnZXRBdHRyaWJ1dGUiLCJjaXRpemVuSWQiLCJmdWxsbmFtZSIsImFnZSIsImVkdWNhdGlvbmFsX2F0dGFpbm1lbnQiLCJiYXJhbmdheSIsInBpY3R1cmUiLCJmb3JtIiwid2luZG93IiwianNQREYiLCJqc3BkZiIsImRvYyIsIm9yaWVudGF0aW9uIiwidW5pdCIsImZvcm1hdCIsImFsaWduX2NlbnRlciIsImFsaWduIiwic2V0Rm9udFNpemUiLCJzZXRMaW5lV2lkdGgiLCJhZGRJbWFnZSIsInNwbGl0IiwicG9wIiwiY29uc29sZSIsImRpciIsInRleHQiLCJ5eSIsIm1tIiwiZGQiLCJob3VzZV9ubyIsInN0cmVldCIsImJhcmFuZ2F5X25hbWUiLCJwaWN0dXJlRm9ybWF0IiwiaW5pdF94IiwiZm9yRWFjaCIsIm1lbWJlciIsInNldEF0dHJpYnV0ZSIsIm91dHB1dCIsInNhdmUiLCJ0aXRsZSIsImNocm9tZSIsImFsZXJ0Il0sInNvdXJjZVJvb3QiOiIiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvcHJpbnQtY2l0aXplbi5qcz9kZjhhIl0sInNvdXJjZXNDb250ZW50IjpbImNvbnN0IHVjZmlyc3QgPSBmdW5jdGlvbiAoc3RyaW5nKSB7XG4gICAgcmV0dXJuIHN0cmluZ1swXS50b1VwcGVyQ2FzZSgpICsgc3RyaW5nLnN1YnN0cmluZygxKTtcbn1cblxubGV0IGNpdGl6ZW4gPSBKU09OLnBhcnNlKGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJ21ldGFbbmFtZT1jaXRpemVuXScpLmdldEF0dHJpYnV0ZSgnY29udGVudCcpKVxubGV0IGNpdGl6ZW5JZCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJ21ldGFbbmFtZT1jaXRpemVuX2lkXScpLmdldEF0dHJpYnV0ZSgnY29udGVudCcpXG5sZXQgZnVsbG5hbWUgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCdtZXRhW25hbWU9ZnVsbG5hbWVdJykuZ2V0QXR0cmlidXRlKCdjb250ZW50JylcbmxldCBhZ2UgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCdtZXRhW25hbWU9YWdlXScpLmdldEF0dHJpYnV0ZSgnY29udGVudCcpXG5sZXQgZWR1Y2F0aW9uYWxfYXR0YWlubWVudCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJ21ldGFbbmFtZT1lZHVjYXRpb25hbF9hdHRhaW5tZW50XScpLmdldEF0dHJpYnV0ZSgnY29udGVudCcpXG5sZXQgYmFyYW5nYXkgPSBKU09OLnBhcnNlKGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJ21ldGFbbmFtZT1iYXJhbmdheV0nKS5nZXRBdHRyaWJ1dGUoJ2NvbnRlbnQnKSlcbmxldCBwaWN0dXJlID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignbWV0YVtuYW1lPXBpY3R1cmVdJykuZ2V0QXR0cmlidXRlKCdjb250ZW50JylcblxubGV0IGZvcm0gPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCdtZXRhW25hbWU9Zm9ybV0nKS5nZXRBdHRyaWJ1dGUoJ2NvbnRlbnQnKVxuXG53aW5kb3cuanNQREYgPSB3aW5kb3cuanNwZGYuanNQREY7XG5cbnZhciBkb2MgPSBuZXcganNQREYoe1xuICAgIG9yaWVudGF0aW9uOiBcInBvcnRyYWl0XCIsXG4gICAgdW5pdDogXCJpblwiLFxuICAgIGZvcm1hdDogWzExLjY5LCA4LjI3XVxufSk7XG5cbmNvbnN0IGFsaWduX2NlbnRlciA9IHtcbiAgICBhbGlnbjogJ2NlbnRlcidcbn1cblxuZG9jLnNldEZvbnRTaXplKDEyKTtcbmRvYy5zZXRMaW5lV2lkdGgoLjAxKTtcblxuLy8gZm9ybVxuZG9jLmFkZEltYWdlKGZvcm0sIGZvcm0uc3BsaXQoJy4nKS5wb3AoKS50b1VwcGVyQ2FzZSgpLCAwLCAwLCA4LjI3LCAxMS42OSk7XG5cbmNvbnNvbGUuZGlyKGNpdGl6ZW4pXG5cbi8vIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLVxuLy8gICAgICAgICAgIFZBTFVFU1xuLy8gLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG5cbi8vIG5hbWVcbmRvYy50ZXh0KGZ1bGxuYW1lLCAxLjI1LCAyLjEpIC8vIGZ1bGxuYW1lXG5cbi8vIGRhdGUgb2YgYmlydGhcbmxldCBbeXksIG1tLCBkZF0gPSBjaXRpemVuWydkYXRlX29mX2JpcnRoJ10uc3BsaXQoJy0nKVxuZG9jLnRleHQoYCR7bW19LyR7ZGR9LyR7eXl9YCwgMi43LCAyLjMyLCBhbGlnbl9jZW50ZXIpIC8vIGRhdGUgb2YgYmlydGhcblxuLy8gYWdlXG5kb2MudGV4dChhZ2UgKyAnJywgNSwgMi4zMiwgYWxpZ25fY2VudGVyKVxuXG4vLyBzZXhcbmRvYy50ZXh0KHVjZmlyc3QoY2l0aXplblsnc2V4J10pLCA2LjUsIDIuMzIsIGFsaWduX2NlbnRlcilcblxuLy8gcGxhY2Ugb2YgYmlydGhcbmRvYy50ZXh0KGNpdGl6ZW5bJ3BsYWNlX29mX2JpcnRoJ10sIDIuOCwgMi41MjUsIGFsaWduX2NlbnRlcilcblxuLy8gY2l2aWwgc3RhdHVzXG5kb2MudGV4dCh1Y2ZpcnN0KGNpdGl6ZW5bJ2NpdmlsX3N0YXR1cyddKSwgNS43LCAyLjUyNSwgYWxpZ25fY2VudGVyKVxuXG4vLyBhZGRyZXNzXG5kb2MudGV4dChgJHtjaXRpemVuLmhvdXNlX25vfSwgJHtjaXRpemVuLnN0cmVldH0sICR7YmFyYW5nYXkuYmFyYW5nYXlfbmFtZX1gLCAyLjQ1LCAyLjc1LCBhbGlnbl9jZW50ZXIpXG5cbi8vIHBpY3R1cmUgSURcbmxldCBwaWN0dXJlRm9ybWF0ID0gcGljdHVyZS5zcGxpdCgnLicpLnBvcCgpLnRvVXBwZXJDYXNlKCk7XG5kb2MuYWRkSW1hZ2UocGljdHVyZSwgcGljdHVyZUZvcm1hdCwgNi41LCAuNSwgMSwgMSk7XG5cbi8vIGVkdWNhdGlvbmFsIGF0dGFpbm1lbnRcbmRvYy50ZXh0KGVkdWNhdGlvbmFsX2F0dGFpbm1lbnQsIDIuMywgMi45NTUpXG5cbi8vIG9jY3VwYXRpb25cbmRvYy50ZXh0KGNpdGl6ZW5bJ29jY3VwYXRpb24nXSwgMS42LCAzLjE4NSlcblxuLy8gb3RoZXIgc2tpbGxzXG5kb2MudGV4dChjaXRpemVuWydvdGhlcl9za2lsbHMnXSB8fCAnJywgMS42LCAzLjM4KVxuXG4vLyBhbm51YWwgaW5jb21lXG5kb2MudGV4dChgUCAke2NpdGl6ZW5bJ2FubnVhbF9pbmNvbWUnXX1gLCA1LjksIDMuMzgsIGFsaWduX2NlbnRlcilcblxuLy8gZmFtaWx5IGNvbXBvc2l0aW9uXG5sZXQgaW5pdF94ID0gNC43O1xuY2l0aXplblsnZmFtaWx5X2NvbXBvc2l0aW9uJ10uZm9yRWFjaChtZW1iZXIgPT4ge1xuICAgIGRvYy50ZXh0KG1lbWJlclsnbmFtZSddLCAxLjcsIGluaXRfeCwgYWxpZ25fY2VudGVyKSAvLyBuYW1lXG4gICAgZG9jLnRleHQobWVtYmVyWydyZWxhdGlvbnNoaXAnXSwgMy40LCBpbml0X3gsIGFsaWduX2NlbnRlcikgLy8gcmVsYXRpb25zaGlwXG4gICAgZG9jLnRleHQobWVtYmVyWydhZ2UnXSwgNC4zNSwgaW5pdF94LCBhbGlnbl9jZW50ZXIpIC8vIGFnZVxuICAgIGRvYy50ZXh0KHVjZmlyc3QobWVtYmVyWydjaXZpbF9zdGF0dXMnXSksIDUuMDUsIGluaXRfeCwgYWxpZ25fY2VudGVyKSAvLyBjaXZpbF9zdGF0dXNcbiAgICBkb2MudGV4dCh1Y2ZpcnN0KG1lbWJlclsnb2NjdXBhdGlvbiddKSwgNi4xNSwgaW5pdF94LCBhbGlnbl9jZW50ZXIpIC8vIG9jY3VwYXRpb25cbiAgICBkb2MudGV4dCh1Y2ZpcnN0KG1lbWJlclsnaW5jb21lJ10pLCA3LjE0LCBpbml0X3gsIGFsaWduX2NlbnRlcikgLy8gaW5jb21lXG4gICAgaW5pdF94ICs9IC4yNTtcbn0pO1xuXG4vLyBuYW1lIG9mIGFzc29jaWF0aW9uXG5kb2MudGV4dChjaXRpemVuWyduYW1lX29mX2Fzc29jaWF0aW9uJ10gPz8gJycsIDIuMSwgNi43NSlcblxuLy8gYWRkcmVzcyBvZiBhc3NvY2lhdGlvblxuZG9jLnRleHQoY2l0aXplblsnYWRkcmVzc19vZl9hc3NvY2lhdGlvbiddID8/ICcnLCAxLjMsIDcpXG5cbi8vIGFkZHJlc3Mgb2YgYXNzb2NpYXRpb25cbmRvYy50ZXh0KGNpdGl6ZW5bJ2RhdGVfb2ZfbWVtYmVyc2hpcCddID8/ICcnLCAyLjUsIDcuMjUpXG5cbi8vIHRlcm1cbmRvYy50ZXh0KGNpdGl6ZW5bJ3Rlcm0nXSA/PyAnJywgMywgNy41KVxuXG4vLyBzZXQgcGRmIHRvIGlmcmFtZVxuZG9jdW1lbnQucXVlcnlTZWxlY3RvcignaWZyYW1lJykuc2V0QXR0cmlidXRlKCdzcmMnLCBkb2Mub3V0cHV0KCdkYXRhdXJpc3RyaW5nJykpXG5kb2Muc2F2ZShgJHtkb2N1bWVudC50aXRsZX0ucGRmYClcblxuaWYgKCEhd2luZG93LmNocm9tZSlcbiAgICBhbGVydChcIk9uIENocm9taXVtLWJhc2VkIGJyb3dzZXJzLCBQREYgbWF5IGZhaWwgcmVuZGVyaW5nLCBpbnN0ZWFkIGl0IHdpbGwgYmUgZG93bmxvYWRlZC4gSWYgdGhlcmUgaXMgbm8gZG93bmxvYWRlZCBQREYgZmlsZSwgcGxlYXNlIGNvbnRhY3QgdGhlIHN5c3RlbSBhZG1pbmlzdHJhdGlvbi5cIikiXSwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7Ozs7O0FBQUEsSUFBTUEsT0FBTyxHQUFHLFNBQVZBLE9BQVUsQ0FBVUMsTUFBVixFQUFrQjtFQUM5QixPQUFPQSxNQUFNLENBQUMsQ0FBRCxDQUFOLENBQVVDLFdBQVYsS0FBMEJELE1BQU0sQ0FBQ0UsU0FBUCxDQUFpQixDQUFqQixDQUFqQztBQUNILENBRkQ7O0FBSUEsSUFBSUMsT0FBTyxHQUFHQyxJQUFJLENBQUNDLEtBQUwsQ0FBV0MsUUFBUSxDQUFDQyxhQUFULENBQXVCLG9CQUF2QixFQUE2Q0MsWUFBN0Ms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\n//# sourceURL=webpack-internal:///./resources/js/print-citizen.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/print-citizen.js"]();
/******/ 	
/******/ })()
;