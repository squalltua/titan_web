/**
 * Kendo UI v2024.1.130 (http://www.telerik.com/kendo-ui)
 * Copyright 2024 Progress Software Corporation and/or one of its subsidiaries or affiliates. All rights reserved.
 *
 * Kendo UI commercial licenses may be obtained at
 * http://www.telerik.com/purchase/license-agreement/kendo-ui-complete
 * If you do not own a commercial license, this file shall be governed by the trial license terms.
 */
import"./kendo.draganddrop.js";var __meta__={id:"sortable",name:"Sortable",category:"framework",depends:["draganddrop"]};!function(e,t){var n=window.kendo,r=n.ui.Widget,i=n._outerWidth,o=n._outerHeight,s="start",l="beforeMove",a="move",d="end",h="change",c="cancel",g="sort",u="remove",f="receive";function p(e){return e.clone()}function m(e){return e.clone().removeAttr("id").css("visibility","hidden")}var _=r.extend({init:function(e,t){var n=this;r.fn.init.call(n,e,t),n.options.placeholder||(n.options.placeholder=m),n.options.hint||(n.options.hint=p),n.draggable=n._createDraggable()},events:[s,l,a,d,h,c],options:{name:"Sortable",hint:null,placeholder:null,filter:">*",holdToDrag:!1,disabled:null,container:null,connectWith:null,handler:null,cursorOffset:null,axis:null,ignore:null,autoScroll:!1,cursor:"auto",moveOnDragEnter:!1},destroy:function(){this.draggable.destroy(),r.fn.destroy.call(this)},_createDraggable:function(){var t=this,r=t.element,i=t.options;return new n.ui.Draggable(r,{filter:i.filter,hint:n.isFunction(i.hint)?i.hint:e(i.hint),holdToDrag:i.holdToDrag,container:i.container?e(i.container):null,cursorOffset:i.cursorOffset,axis:i.axis,ignore:i.ignore,autoScroll:i.autoScroll,dragstart:t._dragstart.bind(t),dragcancel:t._dragcancel.bind(t),drag:t._drag.bind(t),dragend:t._dragend.bind(t)})},_dragstart:function(t){var r=this.draggedElement=t.currentTarget,i=this.options.disabled,o=this.options.handler,l=this.options.placeholder,a=this.placeholder=n.isFunction(l)?e(l.call(this,r)):e(l);i&&r.is(i)||o&&!e(t.initialTarget).is(o)||this.trigger(s,{item:r,draggableEvent:t})?t.preventDefault():(r.css("display","none"),r.before(a),this._setCursor())},_dragcancel:function(){this._cancel(),this.trigger(c,{item:this.draggedElement}),this._resetCursor()},_drag:function(t){var n,r,i,o,s,l=this.draggedElement,a=this._findTarget(t),d={left:t.x.location,top:t.y.location},h={x:t.x.delta,y:t.y.delta},c=this.options.axis,g=this.options.moveOnDragEnter,u={item:l,list:this,draggableEvent:t};if("x"!==c&&"y"!==c){if(a){if(n=this._getElementCenter(a.element),r={left:Math.round(d.left-n.left),top:Math.round(d.top-n.top)},e.extend(u,{target:a.element}),a.appendToBottom)return void this._movePlaceholder(a,null,u);if(a.appendAfterHidden&&this._movePlaceholder(a,"next",u),this._isFloating(a.element)?h.x<0&&g||!g&&r.left<0?i="prev":(h.x>0&&g||!g&&r.left>0)&&(i="next"):h.y<0&&g||!g&&r.top<0?i="prev":(h.y>0&&g||!g&&r.top>0)&&(i="next"),i){for(o=(s="prev"===i?jQuery.fn.prev:jQuery.fn.next).call(a.element);o.length&&!o.is(":visible");)o=s.call(o);o[0]!=this.placeholder[0]&&this._movePlaceholder(a,i,u)}}}else this._movementByAxis(c,d,h[c],u)},_dragend:function(t){var n,r,i,o,s=this.placeholder,l=this.draggedElement,a=this.indexOf(l),c=this.indexOf(s),p=this.options.connectWith;this._resetCursor(),i={action:g,item:l,oldIndex:a,newIndex:c,draggableEvent:t},c>=0?r=this.trigger(d,i):(n=s.parents(p).getKendoSortable(),i.action=u,o=e.extend({},i,{action:f,oldIndex:-1,newIndex:n.indexOf(s)}),r=!(!this.trigger(d,i)&&!n.trigger(d,o))),r||c===a?this._cancel():(s.replaceWith(l),l.show(),this.draggable.dropped=!0,i={action:-1!=this.indexOf(l)?g:u,item:l,oldIndex:a,newIndex:this.indexOf(l),draggableEvent:t},this.trigger(h,i),n&&(o=e.extend({},i,{action:f,oldIndex:-1,newIndex:n.indexOf(l)}),n.trigger(h,o)))},_findTarget:function(t){var n,r,i=this._findElementUnderCursor(t),o=this.options.connectWith;return e.contains(this.element[0],i)?(r=(n=this.items()).filter(i)[0]||n.has(i)[0])?{element:e(r),sortable:this}:null:this.element[0]==i&&this._isEmpty()?{element:this.element,sortable:this,appendToBottom:!0}:this.element[0]==i&&this._isLastHidden()?{element:r=this.items().eq(0),sortable:this,appendAfterHidden:!0}:o?this._searchConnectedTargets(i,t):void 0},_findElementUnderCursor:function(t){var r=n.elementUnderCursor(t),i=t.sender;return function(t,n){try{return e.contains(t,n)||t==n}catch(e){return!1}}(i.hint[0],r)&&(i.hint.hide(),(r=n.elementUnderCursor(t))||(r=n.elementUnderCursor(t)),i.hint.show()),r},_searchConnectedTargets:function(t,n){for(var r,i,o,s=e(this.options.connectWith),l=0;l<s.length;l++)if(r=s.eq(l).getKendoSortable(),e.contains(s[l],t)){if(r)return(o=(i=r.items()).filter(t)[0]||i.has(t)[0])?(r.placeholder=this.placeholder,{element:e(o),sortable:r}):null}else if(s[l]==t){if(r&&r._isEmpty())return{element:s.eq(l),sortable:r,appendToBottom:!0};if(this._isCursorAfterLast(r,n))return{element:o=r.items().last(),sortable:r}}},_isCursorAfterLast:function(e,t){var r,s=e.items().last(),l=t.x.location,a=t.y.location;return(r=n.getOffset(s)).top+=o(s),r.left+=i(s),(this._isFloating(s)?r.left-l:r.top-a)<0},_movementByAxis:function(t,n,r,i){var o,s="x"===t?n.left:n.top,l=r<0?this.placeholder.prev():this.placeholder.next(),a=this.items();l.length&&!l.is(":visible")&&(l=r<0?l.prev():l.next()),a.filter(l).length&&(e.extend(i,{target:l}),(o=this._getElementCenter(l))&&(o="x"===t?o.left:o.top),l.length&&r<0&&s-o<0?this._movePlaceholder({element:l,sortable:this},"prev",i):l.length&&r>0&&s-o>0&&this._movePlaceholder({element:l,sortable:this},"next",i))},_movePlaceholder:function(e,t,n){var r=this.placeholder;e.sortable.trigger(l,n)||(t?"prev"===t?e.element.before(r):"next"===t&&e.element.after(r):e.element.append(r),e.sortable.trigger(a,n))},_setCursor:function(){var t,n=this.options.cursor;n&&"auto"!==n&&(t=e(document.body),this._originalCursorType=t.css("cursor"),t.css({cursor:n}),this._cursorStylesheet||(this._cursorStylesheet=e("<style>* { cursor: "+n+" !important; }</style>")),this._cursorStylesheet.appendTo(t))},_resetCursor:function(){this._originalCursorType&&(e(document.body).css("cursor",this._originalCursorType),this._originalCursorType=null,this._cursorStylesheet.remove())},_getElementCenter:function(e){var t=e.length?n.getOffset(e):null;return t&&(t.top+=o(e)/2,t.left+=i(e)/2),t},_isFloating:function(e){var t=/left|right/.test(e.css("float")),n=/inline|table-cell/.test(e.css("display")),r=/flex/.test(e.parent().css("display"))&&(/row|row-reverse/.test(e.parent().css("flex-direction"))||!e.parent().css("flex-direction"));return t||n||r},_cancel:function(){this.draggedElement&&(this.draggedElement.show(),this.placeholder.remove(),this.draggable.dropped=!0)},_items:function(){var e=this.options.filter;return e?this.element.find(e):this.element.children()},indexOf:function(e){var t=this._items(),n=this.placeholder,r=this.draggedElement;return n&&e[0]==n[0]?t.not(r).index(e):t.not(n).index(e)},items:function(){var e=this.placeholder,t=this._items();return e&&(t=t.not(e)),t},_isEmpty:function(){return!this.items().length},_isLastHidden:function(){return 1===this.items().length&&this.items().is(":hidden")}});n.ui.plugin(_)}(window.kendo.jQuery);var kendo$1=kendo;export{kendo$1 as default};
//# sourceMappingURL=kendo.sortable.js.map
