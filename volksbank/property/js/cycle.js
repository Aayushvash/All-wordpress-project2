(function(e){function t(){window.console&&console.log&&console.log("[cycle2] "+Array.prototype.join.call(arguments," "))}function n(e){return(e||"").toLowerCase()}"use strict";var r="20121219";e.fn.cycle=function(r){var i;return this.length===0&&!e.isReady?(i={s:this.selector,c:this.context},t("requeuing slideshow (dom not ready)"),e(function(){e(i.s,i.c).cycle(r)}),this):this.each(function(){var i,s,o,u,f=e(this);if(f.data("cycle.opts"))return;if(f.data("cycle-log")===!1||r&&r.log===!1||s&&s.log===!1)t=e.noop;t("--c2 init--"),i=f.data();for(var l in i)i.hasOwnProperty(l)&&/^cycle[A-Z]+/.test(l)&&(u=i[l],o=l.match(/^cycle(.*)/)[1].replace(/^[A-Z]/,n),t(o+":",u,"("+typeof u+")"),i[o]=u);s=e.extend({},e.fn.cycle.defaults,i,r||{}),s.timeoutId=0,s.paused=s.paused||!1,s.container=f,s._maxZ=s.maxZ,s.API=e.extend({_container:f},e.fn.cycle.API),s.API.log=t,s.API.trigger=function(e,t){return s.container.trigger(e,t),s.API},f.data("cycle.opts",s),f.data("cycle.API",s.API),s.API.trigger("cycle-bootstrap",[s,s.API]),s.API.addInitialSlides(),s.API.preInitSlideshow(),s.slides.length&&s.API.initSlideshow()})},e.fn.cycle.API={opts:function(){return this._container.data("cycle.opts")},addInitialSlides:function(){var t=this.opts(),n=t.slides;t.slideCount=0,t.slides=e(),n=n.jquery?n:t.container.find(n),t.random&&n.sort(function(){return Math.random()-.5}),t.API.add(n)},preInitSlideshow:function(){var t=this.opts();t.API.trigger("cycle-pre-initialize",[t]);var n=e.fn.cycle.transitions[t.fx];n&&e.isFunction(n.preInit)&&n.preInit(t),t._preInitialized=!0},postInitSlideshow:function(){var t=this.opts();t.API.trigger("cycle-post-initialize",[t]);var n=e.fn.cycle.transitions[t.fx];n&&e.isFunction(n.postInit)&&n.postInit(t)},initSlideshow:function(){var t=this.opts(),n=t.container;t.API.calcFirstSlide(),t.container.css("position")=="static"&&t.container.css("position","relative"),e(t.slides[t.currSlide]).css("opacity",1).show(),t.API.stackSlides(t.slides[t.currSlide],t.slides[t.nextSlide],!t.reverse),t.pauseOnHover&&(t.pauseOnHover!==!0&&(n=e(t.pauseOnHover)),n.hover(function(){t.hoverPaused=!0,t.paused||t.API.trigger("cycle-paused",[t])},function(){t.hoverPaused=!1,t.paused||t.API.trigger("cycle-resumed",[t])})),t.timeout&&(t.timeoutId=setTimeout(function(){t.API.prepareTx(!1,!t.reverse)},t.timeout+t.delay)),t._initialized=!0,t.API.updateView(!0),t.container.on("cycle-paused cycle-resumed",function(e){t.container[e.type==="cycle-paused"?"addClass":"removeClass"]("cycle-paused")}),t.API.trigger("cycle-initialized",[t]),t.API.postInitSlideshow()},add:function(t,n){var r=this.opts(),i=r.slideCount,s=!1,o;e(t).each(function(t){var i,s=e(this);n?r.container.prepend(s):r.container.append(s),r.slideCount++,i=r.API.buildSlideOpts(s),n?r.slides=e(s).add(r.slides):r.slides=r.slides.add(s),r.API.initSlide(i,s,--r._maxZ),s.data("cycle.opts",i),r.API.trigger("cycle-slide-added",[r,i,s])}),r.API.updateView(!0),s=r._preInitialized&&i<2&&r.slideCount>=1,s&&(r._initialized?r.timeout&&(o=r.slides.length,r.nextSlide=r.reverse?o-1:1):r.API.initSlideshow())},calcFirstSlide:function(){var e=this.opts(),t;t=parseInt(e.startingSlide||0,10);if(t>=e.slides.length||t<0)t=0;e.currSlide=t,e.reverse?(e.nextSlide=t-1,e.nextSlide<0&&(e.nextSlide=e.slides.length-1)):(e.nextSlide=t+1,e.nextSlide==e.slides.length&&(e.nextSlide=0))},calcNextSlide:function(){var e=this.opts(),t;e.reverse?(t=e.nextSlide-1<0,e.nextSlide=t?e.slideCount-1:e.nextSlide-1,e.currSlide=t?0:e.nextSlide+1):(t=e.nextSlide+1==e.slides.length,e.nextSlide=t?0:e.nextSlide+1,e.currSlide=t?e.slides.length-1:e.nextSlide-1)},calcTx:function(n,r){var i=n,s;return r&&i.manualFx&&(s=e.fn.cycle.transitions[i.manualFx]),s||(s=e.fn.cycle.transitions[i.fx]),s||(s=e.fn.cycle.transitions.fade,t('Transition "'+i.fx+'" not found.  Using fade.')),s},prepareTx:function(e,t){var n=this.opts(),r,i,s,o,u;if(n.slideCount<2){n.timeoutId=0;return}e&&(n.API.stopTransition(),n.busy=!1,clearTimeout(n.timeoutId),n.timeoutId=0);if(n.busy)return;if(n.timeoutId===0&&!e)return;i=n.slides[n.currSlide],s=n.slides[n.nextSlide],o=n.API.getSlideOpts(n.nextSlide),u=n.API.calcTx(o,e),n._tx=u,e&&o.manualSpeed!==undefined&&(o.speed=o.manualSpeed),n.nextSlide!=n.currSlide&&(e||!n.paused&&!n.hoverPaused&&n.timeout)?(n.API.trigger("cycle-before",[o,i,s,t]),u.before&&u.before(o,i,s,t),r=function(){n.busy=!1,u.after&&u.after(o,i,s,t),n.API.trigger("cycle-after",[o,i,s,t]),n.API.queueTransition(o),n.API.updateView(!0)},n.busy=!0,u.transition?u.transition(o,i,s,t,r):n.API.doTransition(o,i,s,t,r),n.API.calcNextSlide(),n.updateView<0&&n.API.updateView()):n.API.queueTransition(o)},doTransition:function(t,n,r,i,s){var o=t,u=e(n),f=e(r),l=function(){f.animate(o.animIn||{opacity:1},o.speed,o.easeIn||o.easing,s)};f.css(o.cssBefore||{}),u.animate(o.animOut||{},o.speed,o.easeOut||o.easing,function(){u.css(o.cssAfter||{}),o.sync||l()}),o.sync&&l()},queueTransition:function(e){var t=this.opts();if(t.nextSlide===0&&--t.loop===0){t.API.log("terminating; loop=0"),t.timeout=0,t.API.trigger("cycle-finished",[t]),t.nextSlide=t.currSlide;return}e.timeout&&(t.timeoutId=setTimeout(function(){t.API.prepareTx(!1,!t.reverse)},e.timeout))},stopTransition:function(){var e=this.opts();e.slides.filter(":animated").length&&(e.slides.stop(!1,!0),e.API.trigger("cycle-transition-stopped",[e])),e._tx&&e._tx.stopTransition&&e._tx.stopTransition(e)},advanceSlide:function(e){var t=this.opts();return clearTimeout(t.timeoutId),t.timeoutId=0,t.nextSlide=t.currSlide+e,t.nextSlide<0?t.nextSlide=t.slides.length-1:t.nextSlide>=t.slides.length&&(t.nextSlide=0),t.API.prepareTx(!0,e>=0),!1},buildSlideOpts:function(r){var i=this.opts(),s,o,u=r.data()||{};for(var f in u)u.hasOwnProperty(f)&&/^cycle[A-Z]+/.test(f)&&(s=u[f],o=f.match(/^cycle(.*)/)[1].replace(/^[A-Z]/,n),t("["+(i.slideCount-1)+"]",o+":",s,"("+typeof s+")"),u[o]=s);u=e.extend({},e.fn.cycle.defaults,i,u),u.slideNum=i.slideCount;try{delete u.API,delete u.slideCount,delete u.currSlide,delete u.nextSlide,delete u.slides}catch(l){}return u},getSlideOpts:function(t){var n=this.opts();t===undefined&&(t=n.currSlide);var r=n.slides[t],i=e(r).data("cycle.opts");return e.extend({},n,i)},initSlide:function(t,n,r){var i=this.opts();n.css(t.slideCss||{}),r>0&&n.css("zIndex",r),isNaN(t.speed)&&(t.speed=e.fx.speeds[t.speed]||e.fx.speeds._default),t.sync||(t.speed=t.speed/2),n.addClass(i.slideClass)},updateView:function(e){var t=this.opts();if(!t._initialized)return;var n=t.API.getSlideOpts(),r=t.slides[t.currSlide];t.slideActiveClass&&t.slides.removeClass(t.slideActiveClass).eq(t.currSlide).addClass(t.slideActiveClass),e&&t.hideNonActive&&t.slides.filter(":not(."+t.slideActiveClass+")").hide(),t.API.trigger("cycle-update-view",[t,n,r])},getComponent:function(t){var n=this.opts(),r=n[t];return typeof r=="string"?/^\s*\>/.test(r)?n.container.find(r):e(r):r.jquery?r:e(r)},stackSlides:function(t,n,r){var i=this.opts();t||(t=i.slides[i.currSlide],n=i.slides[i.nextSlide],r=!i.reverse),e(t).css("zIndex",i.maxZ);var s,o=i.maxZ-2,u=i.slideCount;if(r){for(s=i.currSlide+1;s<u;s++)e(i.slides[s]).css("zIndex",o--);for(s=0;s<i.currSlide;s++)e(i.slides[s]).css("zIndex",o--)}else{for(s=i.currSlide-1;s>=0;s--)e(i.slides[s]).css("zIndex",o--);for(s=u-1;s>i.currSlide;s--)e(i.slides[s]).css("zIndex",o--)}e(n).css("zIndex",i.maxZ-1)},getSlideIndex:function(e){return this.opts().slides.index(e)}},e.fn.cycle.log=t,e.fn.cycle.version=function(){return"Cycle2: "+r},e.fn.cycle.transitions={custom:{},none:{before:function(e,t,n,r){e.API.stackSlides(n,t,r),e.cssBefore={opacity:1,display:"block"}}},fade:{before:function(t,n,r,i){var s=t.API.getSlideOpts(t.nextSlide).slideCss||{};t.API.stackSlides(n,r,i),t.cssBefore=e.extend(s,{opacity:0,display:"block"}),t.animIn={opacity:1},t.animOut={opacity:0}}},fadeout:{before:function(t,n,r,i){var s=t.API.getSlideOpts(t.nextSlide).slideCss||{};t.API.stackSlides(n,r,i),t.cssBefore=e.extend(s,{opacity:1,display:"block"}),t.animOut={opacity:0}}},scrollHorz:{before:function(e,t,n,r){e.API.stackSlides(t,n,r);var i=e.container.css("overflow","hidden").width();e.cssBefore={left:r?i:-i,top:0,opacity:1,display:"block"},e.cssAfter={zIndex:e._maxZ-2,left:0},e.animIn={left:0},e.animOut={left:r?-i:i}}}},e.fn.cycle.defaults={allowWrap:!0,autoSelector:".cycle-slideshow[data-cycle-auto-init!=false]",delay:0,easing:null,fx:"fade",hideNonActive:!0,loop:0,manualFx:undefined,manualSpeed:undefined,maxZ:100,pauseOnHover:!1,reverse:!1,slideActiveClass:"cycle-slide-active",slideClass:"cycle-slide",slideCss:{position:"absolute",top:0,left:0},slides:"> img",speed:500,startingSlide:0,sync:!0,timeout:4e3,updateView:-1},e(document).ready(function(){e(e.fn.cycle.defaults.autoSelector).cycle()})})(jQuery),function(e){"use strict",e.extend(e.fn.cycle.defaults,{autoHeight:0}),e(document).on("cycle-initialized",function(t,n){function r(){n.container.height(n.container.width()/u)}var i=n.autoHeight,s=-1,o,u;i==="calc"||e.type(i)=="number"&&i>=0?(i==="calc"?n.slides.each(function(t){var n=e(this).height();n>s&&(s=n,i=t)}):i>=n.slides.length&&(i=0),o=e(n.slides[i]).clone(),o.removeAttr("id").find("[id]").removeAttr("id"),o.removeAttr("name").find("[name]").removeAttr("name"),o.css({position:"static",visibility:"hidden",display:"block"}).prependTo(n.container).removeClass().addClass("cycle-sentinel cycle-slide"),o.find("*").css("visibility","hidden"),n._sentinel=o):e.type(i)=="string"&&/\d+\:\d+/.test(i)&&(u=i.match(/(\d+)\:(\d+)/),u=u[1]/u[2],e(window).on("resize",r),n._autoHeightOnResize=r,setTimeout(function(){e(window).triggerHandler("resize")},15))}),e(document).on("cycle-destroyed",function(t,n){n._sentinel&&n._sentinel.remove(),n._autoHeightOnResize&&e(window).off("resize",n._autoHeightOnResize)})}(jQuery),function(e){"use strict",e.extend(e.fn.cycle.defaults,{caption:"> .cycle-caption",captionTemplate:"{{slideNum}} / {{slideCount}}",overlay:"> .cycle-overlay",overlayTemplate:"<div>{{title}}</div><div>{{desc}}</div>"}),e(document).on("cycle-update-view",function(t,n,r,i){var s;e.each(["caption","overlay"],function(){var e=this,t=r[e+"Template"],s=n.API.getComponent(e);s.length&&t?(s.html(n.API.tmpl(t,r,n,i)),s.show()):s.hide()})}),e(document).on("cycle-destroyed",function(t,n){var r;e.each(["caption","overlay"],function(){var e=this,t=n[e+"Template"];n[e]&&t&&(r=n.API.getComponent("caption"),r.empty())})})}(jQuery),function(e){"use strict";var t=e.fn.cycle;e.fn.cycle=function(n){var r,i,s,o=e.makeArray(arguments);return e.type(n)=="number"?this.cycle("goto",n):e.type(n)=="string"?this.each(function(){var u;r=n,s=e(this).data("cycle.opts");if(s===undefined){t.log('slideshow must be initialized before sending commands; "'+r+'" ignored');return}r=r=="goto"?"jump":r,i=s.API[r];if(e.isFunction(i))return u=e.makeArray(o),u.shift(),i.apply(s.API,u);t.log("unknown command: ",r)}):t.apply(this,arguments)},e.extend(e.fn.cycle,t),e.extend(t.API,{next:function(){var e=this.opts(),t=e.reverse?-1:1;if(e.allowWrap===!1&&e.currSlide+t>=e.slideCount)return;e.API.advanceSlide(t),e.API.trigger("cycle-next",[e]).log("cycle-next")},prev:function(){var e=this.opts(),t=e.reverse?1:-1;if(e.allowWrap===!1&&e.currSlide+t<0)return;e.API.advanceSlide(t),e.API.trigger("cycle-prev",[e]).log("cycle-prev")},destroy:function(){var e=this.opts();clearTimeout(e.timeoutId),e.timeoutId=0,e.API.stop(),e.API.trigger("cycle-destroyed",[e]).log("cycle-destroyed"),e.container.removeData("cycle.opts")},jump:function(e){var t,n=this.opts(),r=parseInt(e,10);if(isNaN(r)||r<0||r>=n.slides.length){n.API.log("goto: invalid slide index: "+r);return}if(r==n.currSlide){n.API.log("goto: skipping, already on slide",r);return}n.nextSlide=r,clearTimeout(n.timeoutId),n.timeoutId=0,n.API.log("goto: ",r," (zero-index)"),t=n.currSlide<n.nextSlide,n.API.prepareTx(!0,t)},stop:function(){var t=this.opts(),n=t.container;clearTimeout(t.timeoutId),t.timeoutId=0,t.API.stopTransition(),t.pauseOnHover&&(t.pauseOnHover!==!0&&(n=e(t.pauseOnHover)),n.off("mouseenter mouseleave")),t.API.trigger("cycle-stopped",[t]).log("cycle-stopped")},pause:function(){var e=this.opts();e.paused=!0,e.API.trigger("cycle-paused",[e]).log("cycle-paused")},resume:function(){var e=this.opts();e.paused=!1,e.API.trigger("cycle-resumed",[e]).log("cycle-resumed")},reinit:function(){var e=this.opts();e.API.destroy(),e.container.cycle()},remove:function(t){var n=this.opts(),r,i,s=[],o=1;for(var u=0;u<n.slides.length;u++)r=n.slides[u],u==t?i=r:(s.push(r),e(r).data("cycle.opts").slideNum=o,o++);i&&(n.slides=e(s),n.slideCount--,e(i).remove(),t==n.currSlide&&n.API.advanceSlide(1),n.API.trigger("cycle-slide-removed",[n,t,i]).log("cycle-slide-removed"),n.API.updateView())}}),e(document).on("click.cycle","[data-cycle-cmd]",function(t){t.preventDefault();var n=e(this),r=n.data("cycle-cmd"),i=n.data("cycle-context")||".cycle-slideshow";e(i).cycle(r,n.data("cycle-arg"))})}(jQuery),function(e){function t(t,n){var r;if(t._hashFence){t._hashFence=!1;return}r=window.location.hash.substring(1),t.slides.each(function(i){if(e(this).data("cycle-hash")==r)return n===!0?t.startingSlide=i:(t.nextSlide=i,t.API.prepareTx(!0,!1)),!1})}"use strict",e(document).on("cycle-pre-initialize",function(n,r){t(r,!0),r._onHashChange=function(){t(r,!1)},e(window).on("hashchange",r._onHashChange)}),e(document).on("cycle-update-view",function(e,t,n){n.hash&&(t._hashFence=!0,window.location.hash=n.hash)}),e(document).on("cycle-destroyed",function(t,n){n._onHashChange&&e(window).off("hashchange",n._onHashChange)})}(jQuery),function(e){"use strict",e.extend(e.fn.cycle.defaults,{loader:!1}),e(document).on("cycle-bootstrap",function(t,n){function r(t,r){function s(t){var s;n.loader=="wait"?(u.push(t),f===0&&(u.sort(o),i.apply(n.API,[u,r]),n.container.removeClass("cycle-loading"))):(s=e(n.slides[n.currSlide]),i.apply(n.API,[t,r]),s.show(),n.container.removeClass("cycle-loading"))}function o(e,t){return e.data("index")-t.data("index")}var u=[];t=e(t);var f=t.length;t.hide().appendTo("body").each(function(t){function o(){--l===0&&(--f,s(p))}var l=0,p=e(this),v=p.is("img")?p:p.find("img");p.data("index",t),v=v.filter(":not(.cycle-loader-ignore)");if(!v.length){--f,u.push(p);return}l=v.length,v.each(function(){this.complete?o():e(this).load(function(){o()}).error(function(){--l===0&&(n.API.log("slide skipped; img not loaded:",this.src),--f===0&&n.loader=="wait"&&i.apply(n.API,[u,r]))})})}),f&&n.container.addClass("cycle-loading")}var i;if(!n.loader)return;i=n.API.add,n.API.add=r})}(jQuery),function(e){function t(t,n,r){var i,s=t.API.getComponent("pager");s.each(function(){var s=e(this);if(n.pagerTemplate){var o=t.API.tmpl(n.pagerTemplate,n,t,r[0]);i=e(o).appendTo(s)}else i=s.children().eq(t.slideCount-1);i.on(t.pagerEvent,function(e){e.preventDefault(),t.API.page(s,e.currentTarget)})})}function n(e,t){var n=this.opts(),r=e.children().index(t),i=r,s=n.currSlide<i;if(n.currSlide==i)return;n.nextSlide=i,n.API.prepareTx(!0,s),n.API.trigger("cycle-pager-activated",[n,e,t])}"use strict",e.extend(e.fn.cycle.defaults,{pager:"> .cycle-pager",pagerActiveClass:"cycle-pager-active",pagerEvent:"click.cycle",pagerTemplate:"<span>&bull;</span>"}),e(document).on("cycle-bootstrap",function(e,n,r){r.buildPagerLink=t}),e(document).on("cycle-slide-added",function(e,t,r,i){t.pager&&(t.API.buildPagerLink(t,r,i),t.API.page=n)}),e(document).on("cycle-slide-removed",function(t,n,r,i){if(n.pager){var s=n.API.getComponent("pager");s.each(function(){var t=e(this);e(t.children()[r]).remove()})}}),e(document).on("cycle-update-view",function(t,n,r){var i;n.pager&&(i=n.API.getComponent("pager"),i.each(function(){e(this).children().removeClass(n.pagerActiveClass).eq(n.currSlide).addClass(n.pagerActiveClass)}))}),e(document).on("cycle-destroyed",function(e,t){var n;t.pager&&t.pagerTemplate&&(n=t.API.getComponent("pager"),n.empty())})}(jQuery),function(e){"use strict",e.extend(e.fn.cycle.defaults,{next:"> .cycle-next",nextEvent:"click.cycle",disabledClass:"disabled",prev:"> .cycle-prev",prevEvent:"click.cycle",swipe:!1}),e(document).on("cycle-initialized",function(e,t){t.API.getComponent("next").off(t.nextEvent).on(t.nextEvent,function(e){e.preventDefault(),t.API.next()}),t.API.getComponent("prev").off(t.prevEvent).on(t.prevEvent,function(e){e.preventDefault(),t.API.prev()});if(t.swipe){var n=t.swipeVert?"swipeUp.cycle":"swipeLeft.cycle swipeleft.cycle",r=t.swipeVert?"swipeDown.cycle":"swipeRight.cycle swiperight.cycle";t.container.on(n,function(e){t.API.next()}),t.container.on(r,function(){t.API.prev()})}}),e(document).on("cycle-update-view",function(e,t,n,r){if(t.allowWrap)return;var i=t.disabledClass,s=t.API.getComponent("next"),o=t.API.getComponent("prev"),u=t._prevBoundry||0,a=t._nextBoundry||t.slideCount-1;t.currSlide==a?s.addClass(i).prop("disabled",!0):s.removeClass(i).prop("disabled",!1),t.currSlide===u?o.addClass(i).prop("disabled",!0):o.removeClass(i).prop("disabled",!1)}),e(document).on("cycle-destroyed",function(t,n){e(n.next).off(n.nextEvent),e(n.prev).off(n.prevEvent),n.container.off("swipeleft.cycle swiperight.cycle swipeLeft.cycle swipeRight.cycle swipeUp.cycle swipeDown.cycle")})}(jQuery),function(e){"use strict",e.extend(e.fn.cycle.defaults,{progressive:!1}),e(document).on("cycle-pre-initialize",function(t,n){if(!n.progressive)return;var r=n.API,i=r.next,s=r.prev,o=r.prepareTx,u,f=e.type(n.progressive);if(f=="array")u=n.progressive;else if(e.isFunction(n.progressive))u=n.progressive(n);else if(f=="string"){u=e(n.progressive).html();if(!e.trim(u))return;try{u=e.parseJSON(u)}catch(l){r.log("error parsing progressive slides",l);return}}o&&(r.prepareTx=function(e,t){var r,i;if(e||u.length===0){o.apply(n.API,[e,t]);return}t&&n.currSlide==n.slideCount-1?(i=u[0],u=u.slice(1),n.container.one("cycle-slide-added",function(e,t){t.API.advanceSlide(1)}),n.API.add(i)):!t&&n.currSlide===0?(r=u.length-1,i=u[r],u=u.slice(0,r),n.container.one("cycle-slide-added",function(e,t){t.currSlide=1,t.API.advanceSlide(-1)}),n.API.add(i,!0)):o.apply(n.API,[e,t])}),i&&(r.next=function(){var e=this.opts();if(u.length&&e.currSlide==e.slideCount-1){var t=u[0];u=u.slice(1),e.container.one("cycle-slide-added",function(e,t){i.apply(t.API),t.container.removeClass("cycle-loading")}),e.container.addClass("cycle-loading"),e.API.add(t)}else i.apply(e.API)}),s&&(r.prev=function(){var e=this.opts();if(u.length&&e.currSlide===0){var t=u.length-1,n=u[t];u=u.slice(0,t),e.container.one("cycle-slide-added",function(e,t){t.currSlide=1,t.API.advanceSlide(-1),t.container.removeClass("cycle-loading")}),e.container.addClass("cycle-loading"),e.API.add(n,!0)}else s.apply(e.API)})})}(jQuery),function(e){"use strict",e.extend(e.fn.cycle.defaults,{tmplRegex:"{{((.)?.*?)}}"}),e.extend(e.fn.cycle.API,{tmpl:function(t,n){var r=new RegExp(n.tmplRegex||e.fn.cycle.defaults.tmplRegex,"g"),i=e.makeArray(arguments);return i.shift(),t.replace(r,function(t,n){var r,s,o,u,f=n.split(".");for(r=0;r<i.length;r++){o=i[r];if(f.length>1){u=o;for(s=0;s<f.length;s++)o=u,u=u[f[s]]||n}else u=o[n];if(e.isFunction(u))return u.apply(o,i);if(u!==undefined&&u!==null&&u!=n)return u}return n})}})}(jQuery);(function(e){"use strict";e(document).on("cycle-bootstrap",function(e,t,n){if(t.fx!=="carousel")return;n.getSlideIndex=function(e){var t=this.opts()._carouselWrap.children();var n=t.index(e);return n%t.length};n.next=function(){var e=t.reverse?-1:1;if(t.allowWrap===false&&t.currSlide+e>t.slideCount-t.carouselVisible)return;t.API.advanceSlide(e);t.API.trigger("cycle-next",[t]).log("cycle-next")}});e.fn.cycle.transitions.carousel={preInit:function(t){t.hideNonActive=false;t.container.on("cycle-destroyed",e.proxy(this.onDestroy,t.API));t.API.stopTransition=this.stopTransition;for(var n=0;n<t.startingSlide;n++){t.container.append(t.slides[0])}},postInit:function(t){var n,r;var i=t.carouselVertical;if(t.carouselVisible&&t.carouselVisible>t.slideCount)t.carouselVisible=t.slideCount-1;var s=t.carouselVisible||t.slides.length;var o={display:i?"block":"inline-block",position:"static"};t.container.css({position:"relative",overflow:"hidden"});t.slides.css(o);t._currSlide=t.currSlide;r=e('<div class="cycle-carousel-wrap"></div').prependTo(t.container).css({margin:0,padding:0,top:0,left:0,position:"absolute"}).append(t.slides);t._carouselWrap=r;if(!i)r.css("white-space","nowrap");if(t.allowWrap!==false){t.slides.slice(0,t.slideCount).clone().css(o).appendTo(r);if(t.carouselVisible===undefined)t.slides.slice(0,t.slideCount).clone().css(o).appendTo(r);t.slides.slice(0,t.slideCount).clone().css(o).prependTo(r);if(t.carouselVisible===undefined)t.slides.slice(0,t.slideCount).clone().css(o).prependTo(r);r.find(".cycle-slide-active").removeClass("cycle-slide-active");t.slides.eq(t.startingSlide).addClass("cycle-slide-active")}if(t.pager&&t.allowWrap===false){n=t.slideCount-s;e(t.pager).children().filter(":gt("+n+")").hide()}t._nextBoundry=t.slideCount-t.carouselVisible;this.prepareDimensions(t)},prepareDimensions:function(t){var n,r,i,s;var o=t.carouselVertical;var u=t.carouselVisible||t.slides.length;if(t.carouselFluid&&t.carouselVisible){if(!t._carouselResizeThrottle){this.fluidSlides(t)}}else if(t.carouselVisible&&t.carouselSlideDimension){n=u*t.carouselSlideDimension;t.container[o?"height":"width"](n)}else if(t.carouselVisible){n=u*e(t.slides[0])[o?"outerHeight":"outerWidth"](true);t.container[o?"height":"width"](n)}r=t.carouselOffset||0;if(t.allowWrap!==false){if(t.carouselSlideDimension){r-=(t.slideCount+t.currSlide)*t.carouselSlideDimension}else{s=t._carouselWrap.children();for(var a=0;a<t.slideCount+t.currSlide;a++){r-=e(s[a])[o?"outerHeight":"outerWidth"](true)}}}t._carouselWrap.css(o?"top":"left",r)},fluidSlides:function(t){function n(){clearTimeout(i);i=setTimeout(r,20)}function r(){t._carouselWrap.stop(false,true);var e=t.container.width()/t.carouselVisible;e=Math.ceil(e-o);t._carouselWrap.children().width(e);if(t._sentinel)t._sentinel.width(e);u(t)}var i;var s=t.slides.eq(0);var o=s.outerWidth()-s.width();var u=this.prepareDimensions;e(window).on("resize",n);t._carouselResizeThrottle=n;r()},transition:function(t,n,r,i,s){var o,u={};var a=t.nextSlide-t.currSlide;var f=t.carouselVertical;var l=t.speed;if(t.allowWrap===false){i=a>0;var c=t._currSlide;var h=t.slideCount-t.carouselVisible;if(a>0&&t.nextSlide>h&&c==h){a=0}else if(a>0&&t.nextSlide>h){a=t.nextSlide-c-(t.nextSlide-h)}else if(a<0&&t.currSlide>h&&t.nextSlide>h){a=0}else if(a<0&&t.currSlide>h){a+=t.currSlide-h}else c=t.currSlide;o=this.getScroll(t,f,c,a);t.API.opts()._currSlide=t.nextSlide>h?h:t.nextSlide}else{if(i&&t.nextSlide===0){o=this.getDim(t,t.currSlide,f);s=this.genCallback(t,i,f,s)}else if(!i&&t.nextSlide==t.slideCount-1){o=this.getDim(t,t.currSlide,f);s=this.genCallback(t,i,f,s)}else{o=this.getScroll(t,f,t.currSlide,a)}}u[f?"top":"left"]=i?"-="+o:"+="+o;if(t.throttleSpeed)l=o/e(t.slides[0])[f?"height":"width"]()*t.speed;t._carouselWrap.animate(u,l,t.easing,s)},getDim:function(t,n,r){var i=e(t.slides[n]);return i[r?"outerHeight":"outerWidth"](true)},getScroll:function(e,t,n,r){var i,s=0;if(r>0){for(i=n;i<n+r;i++)s+=this.getDim(e,i,t)}else{for(i=n;i>n+r;i--)s+=this.getDim(e,i,t)}return s},genCallback:function(t,n,r,i){return function(){var n=e(t.slides[t.nextSlide]).position();var s=0-n[r?"top":"left"]+(t.carouselOffset||0);t._carouselWrap.css(t.carouselVertical?"top":"left",s);i()}},stopTransition:function(){var e=this.opts();e.slides.stop(false,true);e._carouselWrap.stop(false,true)},onDestroy:function(t){var n=this.opts();if(n._carouselResizeThrottle)e(window).off("resize",n._carouselResizeThrottle);n.slides.prependTo(n.container);n._carouselWrap.remove()}}})(jQuery);(function(e){"use strict";e.fn.cycle.transitions.scrollVert={before:function(e,t,n,r){e.API.stackSlides(e,t,n,r);var i=e.container.css("overflow","hidden").height();e.cssBefore={top:r?-i:i,left:0,opacity:1,display:"block"};e.animIn={top:0};e.animOut={top:r?i:-i}}}})(jQuery);(function(e){"use strict";e.fn.cycle.transitions.shuffle={transition:function(t,n,r,i,s){function o(e){this.stack(t,n,r,i);e()}e(r).show();var u=t.container.css("overflow","visible").width();var a=t.speed/2;var f=i?n:r;t=t.API.getSlideOpts(i?t.currSlide:t.nextSlide);var l={left:-u,top:15};var c=t.slideCss||{left:0,top:0};if(t.shuffleLeft!==undefined){l.left=l.left+parseInt(t.shuffleLeft,10)||0}else if(t.shuffleRight!==undefined){l.left=u+parseInt(t.shuffleRight,10)||0}if(t.shuffleTop){l.top=t.shuffleTop}e(f).animate(l,a,t.easeIn||t.easing).queue("fx",e.proxy(o,this)).animate(c,a,t.easeOut||t.easing,s)},stack:function(t,n,r,i){var s,o;if(i){t.API.stackSlides(r,n,i);e(n).css("zIndex",1)}else{o=1;for(s=t.nextSlide-1;s>=0;s--){e(t.slides[s]).css("zIndex",o++)}for(s=t.slideCount-1;s>t.nextSlide;s--){e(t.slides[s]).css("zIndex",o++)}e(r).css("zIndex",t.maxZ);e(n).css("zIndex",t.maxZ-1)}}}})(jQuery);(function(e){"use strict";var t="ontouchend"in document;e.event.special.swipe=e.event.special.swipe||{scrollSupressionThreshold:10,durationThreshold:1e3,horizontalDistanceThreshold:30,verticalDistanceThreshold:75,setup:function(){var t=e(this);t.bind("touchstart",function(n){function r(t){if(!o)return;var n=t.originalEvent.touches?t.originalEvent.touches[0]:t;s={time:(new Date).getTime(),coords:[n.pageX,n.pageY]},Math.abs(o.coords[0]-s.coords[0])>e.event.special.swipe.scrollSupressionThreshold&&t.preventDefault()}var i=n.originalEvent.touches?n.originalEvent.touches[0]:n,s,o={time:(new Date).getTime(),coords:[i.pageX,i.pageY],origin:e(n.target)};t.bind("touchmove",r).one("touchend",function(n){t.unbind("touchmove",r),o&&s&&s.time-o.time<e.event.special.swipe.durationThreshold&&Math.abs(o.coords[0]-s.coords[0])>e.event.special.swipe.horizontalDistanceThreshold&&Math.abs(o.coords[1]-s.coords[1])<e.event.special.swipe.verticalDistanceThreshold&&o.origin.trigger("swipe").trigger(o.coords[0]>s.coords[0]?"swipeleft":"swiperight"),o=s=undefined})})}},e.event.special.swipeleft=e.event.special.swipeleft||{setup:function(){e(this).bind("swipe",e.noop)}},e.event.special.swiperight=e.event.special.swiperight||e.event.special.swipeleft})(jQuery);(function(e){"use strict";e.fn.cycle.transitions.tileSlide=e.fn.cycle.transitions.tileBlind={before:function(t,n,r,i){t.API.stackSlides(n,r,i);e(n).show();t.container.css("overflow","hidden");t.tileDelay=t.tileDelay||t.fx=="tileSlide"?100:125;t.tileCount=t.tileCount||7;t.tileVertical=t.tileVertical!==false;if(!t.container.data("cycleTileInitialized")){t.container.on("cycle-destroyed",e.proxy(this.onDestroy,t.API));t.container.data("cycleTileInitialized",true)}},transition:function(t,n,r,i,s){function o(e){u.eq(e).animate(b,{duration:t.speed,easing:t.easing,complete:function(){if(i?v-1===e:0===e){t._tileAniCallback()}}});setTimeout(function(){if(i?v-1!==e:0!==e){o(i?e+1:e-1)}},t.tileDelay)}t.slides.not(n).not(r).hide();var u=e();var a=e(n),f=e(r);var l,c,h,p,d,v=t.tileCount,m=t.tileVertical,g=t.container.height(),y=t.container.width();if(m){c=Math.floor(y/v);p=y-c*(v-1);h=d=g}else{c=p=y;h=Math.floor(g/v);d=g-h*(v-1)}t.container.find(".cycle-tiles-container").remove();var b;var w={left:0,top:0,overflow:"hidden",position:"absolute",margin:0,padding:0};if(m){b=t.fx=="tileSlide"?{top:g}:{width:0}}else{b=t.fx=="tileSlide"?{left:y}:{height:0}}var E=e('<div class="cycle-tiles-container"></div>');E.css({zIndex:a.css("z-index"),overflow:"visible",position:"absolute",top:0});E.insertBefore(r);for(var S=0;S<v;S++){l=e("<div></div>").css(w).css({width:v-1===S?p:c,height:v-1===S?d:h,marginLeft:m?S*c:0,marginTop:m?0:S*h}).append(a.clone().css({position:"relative",maxWidth:"none",width:a.width(),margin:0,padding:0,marginLeft:m?-(S*c):0,marginTop:m?0:-(S*h)}));u=u.add(l)}E.append(u);a.hide();f.show().css("opacity",1);o(i?0:v-1);t._tileAniCallback=function(){f.show();a.hide();E.remove();s()}},stopTransition:function(e){e.container.find("*").stop(true,true);if(e._tileAniCallback)e._tileAniCallback()},onDestroy:function(e){var t=this.opts();t.container.find(".cycle-tiles-container").remove()}}})(jQuery);(function(e){"use strict",e.extend(e.fn.cycle.defaults,{centerHorz:!1,centerVert:!1}),e(document).on("cycle-pre-initialize",function(t,n){function r(){clearTimeout(a),a=setTimeout(o,50)}function i(t,n){clearTimeout(a),clearTimeout(f),e(window).off("resize",r)}function s(){n.slides.each(u)}function o(){u.apply(n.container.find(n.slideActiveClass)),clearTimeout(f),f=setTimeout(s,50)}function u(){var t=e(this),r=n.container.width(),i=n.container.height(),s=t.width(),o=t.height();n.centerHorz&&s<r&&t.css("marginLeft",(r-s)/2),n.centerVert&&o<i&&t.css("marginTop",(i-o)/2)}if(!n.centerHorz&&!n.centerVert)return;var a,f;e(window).on("resize",r),n.container.on("cycle-destroyed",i),n.container.on("cycle-slide-added",function(e,t,n,r){u.apply(r)}),o()})})(jQuery)