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

/***/ "./resources/js/philhealth-application.js":
/*!************************************************!*\
  !*** ./resources/js/philhealth-application.js ***!
  \************************************************/
/***/ (() => {

eval("$('#same-as-above').on('change', function () {\n  if (this.checked) {\n    $('#mailing-address > div.row.g-3 :input').attr('disabled', true);\n    $('#mailing-address > div.row.g-3 :input').addClass('disabled');\n  } else {\n    $('#mailing-address > div.row.g-3 :input').attr('disabled', false);\n    $('#mailing-address > div.row.g-3 :input').removeClass('disabled');\n  }\n});\n$('input[type=checkbox].is-required').on('change', function () {\n  var dependentField = $(\"[data-requires-field=\".concat($(this).attr('name'), \"]\"));\n  var requiredValue = dependentField.attr('data-required-value');\n\n  if (this.checked) {\n    dependentField.removeClass('disabled');\n    dependentField.attr('disabled', false);\n  } else {\n    dependentField.addClass('disabled');\n    dependentField.attr('disabled', true);\n\n    if (dependentField.attr('type') == 'checkbox') {\n      dependentField.prop(\"checked\", false);\n    } else {\n      dependentField.val('');\n    }\n  }\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvcGhpbGhlYWx0aC1hcHBsaWNhdGlvbi5qcy5qcyIsIm5hbWVzIjpbIiQiLCJvbiIsImNoZWNrZWQiLCJhdHRyIiwiYWRkQ2xhc3MiLCJyZW1vdmVDbGFzcyIsImRlcGVuZGVudEZpZWxkIiwicmVxdWlyZWRWYWx1ZSIsInByb3AiLCJ2YWwiXSwic291cmNlUm9vdCI6IiIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3Jlc291cmNlcy9qcy9waGlsaGVhbHRoLWFwcGxpY2F0aW9uLmpzPzU4NTMiXSwic291cmNlc0NvbnRlbnQiOlsiJCgnI3NhbWUtYXMtYWJvdmUnKS5vbignY2hhbmdlJywgZnVuY3Rpb24gKCkge1xuICAgIGlmICh0aGlzLmNoZWNrZWQpIHtcbiAgICAgICAgJCgnI21haWxpbmctYWRkcmVzcyA+IGRpdi5yb3cuZy0zIDppbnB1dCcpLmF0dHIoJ2Rpc2FibGVkJywgdHJ1ZSlcbiAgICAgICAgJCgnI21haWxpbmctYWRkcmVzcyA+IGRpdi5yb3cuZy0zIDppbnB1dCcpLmFkZENsYXNzKCdkaXNhYmxlZCcpXG4gICAgfSBlbHNlIHtcbiAgICAgICAgJCgnI21haWxpbmctYWRkcmVzcyA+IGRpdi5yb3cuZy0zIDppbnB1dCcpLmF0dHIoJ2Rpc2FibGVkJywgZmFsc2UpXG4gICAgICAgICQoJyNtYWlsaW5nLWFkZHJlc3MgPiBkaXYucm93LmctMyA6aW5wdXQnKS5yZW1vdmVDbGFzcygnZGlzYWJsZWQnKVxuICAgIH1cbn0pXG5cblxuJCgnaW5wdXRbdHlwZT1jaGVja2JveF0uaXMtcmVxdWlyZWQnKS5vbignY2hhbmdlJywgZnVuY3Rpb24gKCkge1xuICAgIGxldCBkZXBlbmRlbnRGaWVsZCA9ICQoYFtkYXRhLXJlcXVpcmVzLWZpZWxkPSR7JCh0aGlzKS5hdHRyKCduYW1lJyl9XWApO1xuICAgIGxldCByZXF1aXJlZFZhbHVlID0gZGVwZW5kZW50RmllbGQuYXR0cignZGF0YS1yZXF1aXJlZC12YWx1ZScpO1xuXG4gICAgaWYgKHRoaXMuY2hlY2tlZCkge1xuICAgICAgICBkZXBlbmRlbnRGaWVsZC5yZW1vdmVDbGFzcygnZGlzYWJsZWQnKVxuICAgICAgICBkZXBlbmRlbnRGaWVsZC5hdHRyKCdkaXNhYmxlZCcsIGZhbHNlKVxuICAgIH0gZWxzZSB7XG4gICAgICAgIGRlcGVuZGVudEZpZWxkLmFkZENsYXNzKCdkaXNhYmxlZCcpXG4gICAgICAgIGRlcGVuZGVudEZpZWxkLmF0dHIoJ2Rpc2FibGVkJywgdHJ1ZSlcbiAgICAgICAgaWYgKGRlcGVuZGVudEZpZWxkLmF0dHIoJ3R5cGUnKSA9PSAnY2hlY2tib3gnKSB7XG4gICAgICAgICAgICBkZXBlbmRlbnRGaWVsZC5wcm9wKFwiY2hlY2tlZFwiLCBmYWxzZSk7XG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICBkZXBlbmRlbnRGaWVsZC52YWwoJycpO1xuICAgICAgICB9XG4gICAgfVxuXG59KSJdLCJtYXBwaW5ncyI6IkFBQUFBLENBQUMsQ0FBQyxnQkFBRCxDQUFELENBQW9CQyxFQUFwQixDQUF1QixRQUF2QixFQUFpQyxZQUFZO0VBQ3pDLElBQUksS0FBS0MsT0FBVCxFQUFrQjtJQUNkRixDQUFDLENBQUMsdUNBQUQsQ0FBRCxDQUEyQ0csSUFBM0MsQ0FBZ0QsVUFBaEQsRUFBNEQsSUFBNUQ7SUFDQUgsQ0FBQyxDQUFDLHVDQUFELENBQUQsQ0FBMkNJLFFBQTNDLENBQW9ELFVBQXBEO0VBQ0gsQ0FIRCxNQUdPO0lBQ0hKLENBQUMsQ0FBQyx1Q0FBRCxDQUFELENBQTJDRyxJQUEzQyxDQUFnRCxVQUFoRCxFQUE0RCxLQUE1RDtJQUNBSCxDQUFDLENBQUMsdUNBQUQsQ0FBRCxDQUEyQ0ssV0FBM0MsQ0FBdUQsVUFBdkQ7RUFDSDtBQUNKLENBUkQ7QUFXQUwsQ0FBQyxDQUFDLGtDQUFELENBQUQsQ0FBc0NDLEVBQXRDLENBQXlDLFFBQXpDLEVBQW1ELFlBQVk7RUFDM0QsSUFBSUssY0FBYyxHQUFHTixDQUFDLGdDQUF5QkEsQ0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRRyxJQUFSLENBQWEsTUFBYixDQUF6QixPQUF0QjtFQUNBLElBQUlJLGFBQWEsR0FBR0QsY0FBYyxDQUFDSCxJQUFmLENBQW9CLHFCQUFwQixDQUFwQjs7RUFFQSxJQUFJLEtBQUtELE9BQVQsRUFBa0I7SUFDZEksY0FBYyxDQUFDRCxXQUFmLENBQTJCLFVBQTNCO0lBQ0FDLGNBQWMsQ0FBQ0gsSUFBZixDQUFvQixVQUFwQixFQUFnQyxLQUFoQztFQUNILENBSEQsTUFHTztJQUNIRyxjQUFjLENBQUNGLFFBQWYsQ0FBd0IsVUFBeEI7SUFDQUUsY0FBYyxDQUFDSCxJQUFmLENBQW9CLFVBQXBCLEVBQWdDLElBQWhDOztJQUNBLElBQUlHLGNBQWMsQ0FBQ0gsSUFBZixDQUFvQixNQUFwQixLQUErQixVQUFuQyxFQUErQztNQUMzQ0csY0FBYyxDQUFDRSxJQUFmLENBQW9CLFNBQXBCLEVBQStCLEtBQS9CO0lBQ0gsQ0FGRCxNQUVPO01BQ0hGLGNBQWMsQ0FBQ0csR0FBZixDQUFtQixFQUFuQjtJQUNIO0VBQ0o7QUFFSixDQWpCRCJ9\n//# sourceURL=webpack-internal:///./resources/js/philhealth-application.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/philhealth-application.js"]();
/******/ 	
/******/ })()
;