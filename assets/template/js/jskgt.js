// request Animation Frame JS
(function() {
    var lastTime = 0;
    var vendors = ['ms', 'moz', 'webkit', 'o'];
    for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
        window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
        window.cancelAnimationFrame = window[vendors[x]+'CancelAnimationFrame'] 
                                   || window[vendors[x]+'CancelRequestAnimationFrame'];
    }
 
    if (!window.requestAnimationFrame)
        window.requestAnimationFrame = function(callback, element) {
            var currTime = new Date().getTime();
            var timeToCall = Math.max(0, 16 - (currTime - lastTime));
            var id = window.setTimeout(function() { callback(currTime + timeToCall); }, 
              timeToCall);
            lastTime = currTime + timeToCall;
            return id;
        };
 
    if (!window.cancelAnimationFrame)
        window.cancelAnimationFrame = function(id) {
            clearTimeout(id);
        };
}());
// ---------------------------------------------------------------------------------------------

// Globe JS
var globeSpeed = -30; //reduce the value in negitive to increase the speed of the globe (-20 means slowers than -30)
var lastSpeed = 0;
var globeHovered = false;
$(document).ready(function () {

	var $sph = $('#sphere');
	var $shadows =$('#sphere');
	$shadows.mousemove(function(e){});
	$shadows.mouseout(function(){});
});
// ---------------------------------------------------------------------------------------------

// SPHERE JS


(function() {
  "use strict";

  var opts = { tilt: 40
    , turn: 20
  };

  
  var tiling = {
    horizontal: 1,
    vertical: 1
  };

  
  var gCtx;
  var gImage, gCtxImg;

  
  var size;

  var canvasImageData, textureImageData;

  
  var X=0, Y=1, Z=2;

  var textureWidth, textureHeight;

  var hs=30;            
  var vs=30;            

  

  var F = [0,0,0];    
  var S = [0,30,0];    

  var r=12;            

  
  var f = 30;




  
  var RX = 0,RY,RZ;
  
  var rx,ry,rz;

  var a;
  var b;
  var b2;            
  var bx=F[X]-S[X];    
  var by=F[Y]-S[Y];
  var bz=F[Z]-S[Z];    
 

  var c = F[X]*F[X] + S[X]*S[X]
      + F[Y]*F[Y] + S[Y]*S[Y]
      + F[Z]*F[Z] + S[Z]*S[Z]
      - 2*(F[X]*S[X] + F[Y]*S[Y] + F[Z]*S[Z])
      - r*r
    ;

  var c4 = c*4;        

  var s;

  var m1 = 0;
  

  var hs_ch;                
  var vs_cv;               
  var hhs = 0.5*hs;    
  var hvs = 0.5*vs;   

  var V = new Array(3);    
  var L = new Array(3);    

  var VY2=f*f;           


  var rotCache = {};


  var calculateVector = function(h,v) {

   
    V[X]=(hs_ch*h)-hhs;

    
    V[Z]=(vs_cv*v)-hvs;

    

    a=V[X]*V[X]+VY2+V[Z]*V[Z];


    s=(b2-a*c4);    

    

    if (s > 0) {

      m1 = ((-b)-(Math.sqrt(s)))/(2*a);

      L[X]=m1*V[X];        
      L[Y]=by+(m1*V[Y]);
      L[Z]=m1*V[Z];       

      

      var lx=L[X];
      var srz = Math.sin(rz);
      var crz = Math.cos(rz);
      L[X]=lx*crz-L[Y]*srz;
      L[Y]=lx*srz+L[Y]*crz;

      var lz;
      lz=L[Z];
      var sry = Math.sin(ry);
      var cry = Math.cos(ry);
      L[Z]=lz*cry-L[Y]*sry;
      L[Y]=lz*sry+L[Y]*cry;


      

      var lh = textureWidth + textureWidth * (  Math.atan2(L[Y],L[X]) + Math.PI ) / (2*Math.PI);

      

      var lv = textureWidth * Math.floor(textureHeight-1-(textureHeight*(Math.acos(L[Z]/r)/Math.PI)%textureHeight));
      return {lv:lv,lh:lh};
    }
    return null;
  };


  
  var sphere = function(){

    var textureData = textureImageData.data;
    var canvasData = canvasImageData.data;

    var copyFnc;

    if (canvasData.splice){
      
      copyFnc = function(idxC, idxT){
        canvasData.splice(idxC, 4  , textureData[idxT + 0]
          , textureData[idxT + 1]
          , textureData[idxT + 2]
          , 255);
      };
    } else {
      copyFnc = function(idxC, idxT){
        canvasData[idxC + 0] = textureData[idxT + 0];
        canvasData[idxC + 1] = textureData[idxT + 1];
        canvasData[idxC + 2] = textureData[idxT + 2];
        canvasData[idxC + 3] = 255;
      };
    }

    var getVector = (function(){
      var cache = new Array(size*size);
      return function(pixel){
        if (cache[pixel] === undefined){
          var v = Math.floor(pixel / size);
          var h = pixel - v * size;
          cache[pixel] = calculateVector(h,v);
        }
        return cache[pixel];
      };
    })();

    var posDelta = textureWidth*0.2/(20*1000);
    

    var stats = {fastCount: 0, fastSumMs: 0};

    return {
      posDelta: posDelta,
      firstFramePos: (new Date()) * posDelta,
      positionsCache: [],
      minX: null,
      minY: null,
      maxX: null,
      maxY: null,

      init: function(options) {
        this.changeRotation(options);


        hs=30;            
        vs=30;            

        F = [0,0,0];    
        S = [0,30,0];    

        r=options.r;            


        f = 30;



        bx=F[X]-S[X];    
        by=F[Y]-S[Y];
        bz=F[Z]-S[Z];    

        c = F[X]*F[X] + S[X]*S[X]
          + F[Y]*F[Y] + S[Y]*S[Y]
          + F[Z]*F[Z] + S[Z]*S[Z]
          - 2*(F[X]*S[X] + F[Y]*S[Y] + F[Z]*S[Z])
          - r*r
        ;

        c4 = c*4;        

        m1 = 0;

        hhs = 0.5*hs;    
        hvs = 0.5*vs;    

        
        L = new Array(3);   

        VY2=f*f;            



        rotCache = {};






        if (canvasData.splice){
          
          copyFnc = function(idxC, idxT){
            canvasData.splice(idxC, 4  , textureData[idxT + 0]
              , textureData[idxT + 1]
              , textureData[idxT + 2]
              , 255);
          };
        } else {
          copyFnc = function(idxC, idxT){
            canvasData[idxC + 0] = textureData[idxT + 0];
            canvasData[idxC + 1] = textureData[idxT + 1];
            canvasData[idxC + 2] = textureData[idxT + 2];
            canvasData[idxC + 3] = 255;
          };
        }

        posDelta = textureWidth*0.2/(20*1000);
        

        stats = {fastCount: 0, fastSumMs: 0};

        getVector = (function(){
          var cache = new Array(size*size);
          return function(pixel){
            if (cache[pixel] === undefined){
              var v = Math.floor(pixel / size);
              var h = pixel - v * size;
              cache[pixel] = calculateVector(h,v);
            }
            return cache[pixel];
          };
        })();

      },
        
     

      renderFrame: function(time){
        this.RF(time);
        return;
        stats.firstMs = new Date() - time;
        this.renderFrame = this.sumRF;
        console.log(rotCache);
        for (var key in rotCache){
          if (rotCache[key] > 1){
            console.log(rotCache[key]);
          }
        }
      },
      sumRF: function(time){
        this.RF(time);
        stats.fastSumMs += new Date() - time;
        stats.fastCount++;
        if (stats.fastSumMs > stats.firstMs) {
          
          this.renderFrame = this.RF;
        }
      },

      turnBy: function(time){
        return 24*60*60 + this.firstFramePos - time * this.posDelta
      },

      changeRotation: function(opts) {
        ry=90+opts.tilt;
        rz=180+opts.turn;

        RY = (90-ry);
        RZ = (180-rz);
        RX = 0,RY,RZ;
      },

      getRadius: function() {
        if (this.minX === null) {
          return null;
        } else {
          return ((this.maxX - this.minX) + (this.maxY - this.minY)) / 2;
        }
      },

      getTexturePointPosition: function(x, y) {
        var maxDistance = 30;
        for (var i = 0; i < maxDistance; i++) {
          var xx
          var yy;
          var pos;
          for (xx = x - i; xx < x + i + 1; xx++) {
            yy = y - i;
            pos = this.getTexturePointPositionExact(xx, yy);
            if (typeof pos !== 'undefined') {
              return pos;
            }
            yy = y + i;
            pos = this.getTexturePointPositionExact(xx, yy);
            if (typeof pos !== 'undefined') {
              return pos;
            }
          }
          for (yy = y - i + 1; yy < y + i; yy++) {
            xx = x - i;
            pos = this.getTexturePointPositionExact(xx, yy);
            if (typeof pos !== 'undefined') {
              return pos;
            }
            xx = x + i;
            pos = this.getTexturePointPositionExact(xx, yy);
            if (typeof pos !== 'undefined') {
              return pos;
            }
          }
        }
      },

      getTexturePointPositionExact: function(x, y) {
        var pixel = this.positionsCache[x + y * textureWidth];
        if (typeof pixel === 'undefined') {
          return pixel;
        } else {
          return {x: pixel % size, y: Math.floor(pixel / size), pixel: pixel, originalX: x, originalY: y};
        }
      },

      RF: function(time){
        
        rx=RX*Math.PI/180;
        ry=RY*Math.PI/180;
        rz=RZ*Math.PI/180;

        
        var turnBy = this.turnBy(time);
        var pixel = size*size;
        var h2 = (textureHeight * textureHeight);

        this.positionsCache = new Array(h2);

        this.minX = null;
        this.minY = null;
        this.maxX = null;
        this.maxY = null;

        while(pixel--){
          var vector = getVector(pixel);
          if (vector !== null){
            var x = pixel % size;
            var y = Math.floor(pixel / size);
            if (this.minX == null) {
              this.minX = x;
              this.maxX = x;
              this.minY = y;
              this.maxY = y;
            } else {
              if (this.minX > x) {
                this.minX = x;
              }
              if (this.maxX < x) {
                this.maxX = x;
              }
              if (this.minY > y) {
                this.minY = y;
              }
              if (this.maxY < y) {
                this.maxY = y;
              }
            }
            
            var lh = Math.floor(vector.lh * tiling.horizontal + turnBy * tiling.horizontal) % textureWidth;
            
            var idxC = pixel * 4;
            var idxT = ((lh + (vector.lv * tiling.vertical) % h2) * 4);
            this.positionsCache[Math.floor(idxT / 4)] = Math.floor(idxC / 4);

            
            canvasData[idxC + 0] = textureData[idxT + 0];
            canvasData[idxC + 1] = textureData[idxT + 1];
            canvasData[idxC + 2] = textureData[idxT + 2];
            canvasData[idxC + 3] = 255;

            
          }
        }
        gCtx.putImageData(canvasImageData, 0, 0);
      }};
  };

  function copyImageToBuffer(aImg)
  {
    gImage = document.createElement('canvas');
    textureWidth = aImg.naturalWidth;
    textureHeight = aImg.naturalHeight;
    gImage.width = textureWidth;
    gImage.height = textureHeight;

    gCtxImg = gImage.getContext("2d");
    gCtxImg.clearRect(0, 0, textureHeight, textureWidth);
    gCtxImg.drawImage(aImg, 0, 0);
    textureImageData = gCtxImg.getImageData(0, 0, textureHeight, textureWidth);

    hs_ch = (hs / size);
    vs_cv = (vs / size);
  }

  this.createSphere = function (gCanvas, textureUrl, callback, tilingInfos) {
    size = Math.min(gCanvas.width, gCanvas.height);
    gCtx = gCanvas.getContext("2d");
    canvasImageData = gCtx.createImageData(size, size);
    tiling = tilingInfos;

    hs_ch = (hs / size);
    vs_cv = (vs / size);

    V[Y]=f;

    b=(2*(-f*V[Y]));
    b2=Math.pow(b,2);

    var img = new Image();

    img.onload = function() {

      copyImageToBuffer(img);
      var earth = sphere();
      callback(earth, textureWidth, textureHeight);


   


    };
    img.setAttribute("src", textureUrl);
  };
}).call(this);

// ---------------------------------------------------------------------------------------------

// LANGUAGE JS

(function ($) {

    //jquery.timer.js
    $.timer = function(func, time, autostart) {
        this.set = function(func, time, autostart) {
            this.init = true;
            if(typeof func == 'object') {
                var paramList = ['autostart', 'time'];
                for(var arg in paramList) {if(func[paramList[arg]] != undefined) {eval(paramList[arg] + " = func[paramList[arg]]");}};
                func = func.action;
            }
            if(typeof func == 'function') {this.action = func;}
            if(!isNaN(time)) {this.intervalTime = time;}
            if(autostart && !this.active) {
                this.active = true;
                this.setTimer();
            }
            return this;
        };
        this.once = function(time) {
            var timer = this;
            if(isNaN(time)) {time = 0;}
            window.setTimeout(function() {timer.action();}, time);
            return this;
        };
        this.play = function(reset) {
            if(!this.active) {
                if(reset) {this.setTimer();}
                else {this.setTimer(this.remaining);}
                this.active = true;
            }
            return this;
        };
        this.pause = function() {
            if(this.active) {
                this.active = false;
                this.remaining -= new Date() - this.last;
                this.clearTimer();
            }
            return this;
        };
        this.stop = function() {
            this.active = false;
            this.remaining = this.intervalTime;
            this.clearTimer();
            return this;
        };
        this.toggle = function(reset) {
            if(this.active) {this.pause();}
            else if(reset) {this.play(true);}
            else {this.play();}
            return this;
        };
        this.reset = function() {
            this.active = false;
            this.play(true);
            return this;
        };
        this.clearTimer = function() {
            window.clearTimeout(this.timeoutObject);
        };
        this.setTimer = function(time) {
            var timer = this;
            if(typeof this.action != 'function') {return;}
            if(isNaN(time)) {time = this.intervalTime;}
            this.remaining = time;
            this.last = new Date();
            this.clearTimer();
            this.timeoutObject = window.setTimeout(function() {timer.go();}, time);
        };
        this.go = function() {
            if(this.active) {
                this.action();
                this.setTimer();
            }
        };

        if(this.init) {
            return new $.timer(func, time, autostart);
        } else {
            this.set(func, time, autostart);
            return this;
        }
    };

    $.fn.polyglotLanguageSwitcher = function (op) {

        var ls = $.fn.polyglotLanguageSwitcher;

        var rootElement = $(this);
        var rootElementId = $(this).attr('id');
        var aElement;
        var ulElement = $("<ul class=\"dropdown\">");
        var length = 0;
        var isOpen = false;
        var liElements = [];
        var settings = $.extend({}, ls.defaults, op);
        var closePopupTimer;
        var isStaticWebSite = settings.websiteType == 'static';

        init();
        installListeners();

        function triggerEvent(evt) {
            if(settings[evt.name]){
                settings[evt.name].call($(this), evt);
            }
        }

        function open() {
            if(!isOpen){
                triggerEvent({name:'beforeOpen', element:rootElement, instance:ls});
                aElement.addClass("active");
                doAnimation(true);
                setTimeout(function () {
                    isOpen = true;
                    triggerEvent({name:'afterOpen', element:rootElement, instance:ls});
                }, 100);
            }
        }

        function close() {
            if(isOpen){
                triggerEvent({name:'beforeClose', element:rootElement, instance:ls});
                doAnimation(false);
                aElement.removeClass("active");
                isOpen = false;
                if (closePopupTimer && closePopupTimer.active) {
                    closePopupTimer.clearTimer();
                }
                triggerEvent({name:'afterClose', element:rootElement, instance:ls});
            }
        }

        function suspendCloseAction() {
            if (closePopupTimer && closePopupTimer.active) {
                closePopupTimer.pause();
            }
        }

        function resumeCloseAction() {
            if (closePopupTimer) {
                closePopupTimer.play(false);
            }
        }

        function doAnimation(open) {
            if (settings.effect == 'fade') {
                if (open) {
                    ulElement.fadeIn(settings.animSpeed);
                } else {
                    ulElement.fadeOut(settings.animSpeed);
                }
            } else {
                if (open) {
                    ulElement.slideDown(settings.animSpeed);
                } else {
                    ulElement.slideUp(settings.animSpeed);
                }
            }
        }

        function doAction(item) {
            close();
            var selectedAElement = $(item).children(":first-child");

            var selectedId = $(selectedAElement).attr("id");
            var selectedText = $(selectedAElement).text();

            $(ulElement).children().each(function () {
                $(this).detach();
            });
            for (var i = 0; i < liElements.length; i++) {
                if ($(liElements[i]).children(":first-child").attr("id") != selectedId) {
                    ulElement.append(liElements[i]);
                }
            }
            var innerSpanElement = aElement.children(":first-child");
            aElement.attr("id", selectedId);
            aElement.text(selectedText);
            aElement.append(innerSpanElement);
        }

        function installListeners() {
            $(document).click(function () {
                close();
            });
            $(document).keyup(function (e) {
                if (e.which == 27) {
                    close();
                }
            });
            if (settings.openMode == 'hover') {
                closePopupTimer = $.timer(function () {
                    close();
                });
                closePopupTimer.set({ time:settings.hoverTimeout, autostart:true });
            }
        }

        function init() {
            var selectedItem;
            var options = $("#" + rootElementId + " > form > select > option");
            if (isStaticWebSite) {
                var selectedId;
                var url = window.location.href;
                options.each(function(){
                    var id = $(this).attr("id");
                    if(url.indexOf('/'+id+'/')>=0){
                        selectedId = id;
                    }
                });
            }
            options.each(function () {
                var id = $(this).attr("id");
                var selected;
                if (isStaticWebSite) {
                    selected = selectedId === id;
                }else{
                    selected = $(this).attr("selected")
                }
                var liElement = toLiElement($(this));
                if (selected) {
                    selectedItem = liElement;
                }
                liElements.push(liElement);
                if (length > 0) {
                    ulElement.append(liElement);
                } else {
                     aElement = $("<a id=\"" + $(this).attr("id") + "\" class=\"current\" href=\"javascript:void(0)\">" + $(this).text() + " <span class=\"trigger\">&raquo;</span></a>");
                    if (settings.openMode == 'hover') {
                        aElement.hover(function () {
                            open();
                            suspendCloseAction();
                        }, function () {
                            resumeCloseAction();
                        });
                    } else {
                        aElement.click(
                            function () {
                                open();
                            }
                        );
                    }
                }
                length++;
            });
            $("#" + rootElementId + " form:first-child").remove();
            rootElement.append(aElement);
            rootElement.append(ulElement);
            if (selectedItem) {
                doAction(selectedItem);
            }
        }

        function toLiElement(option) {
            var id = $(option).attr("id");
            var value = $(option).attr("value");
            var text = $(option).text();
            var liElement;
            if (isStaticWebSite) {
                var url = window.location.href;
                var page = url.substring(url.lastIndexOf("http://enetaji.com/")+1);
                var urlPage = 'http://' + document.domain + '/' + settings.pagePrefix + id + '/' + page;
                liElement = $("<li><a id=\"" + id + "\" href=\"" + urlPage + "\">" + text + "</a></li>");
            } else {
                var href = document.URL.replace('#', '');
                var params = parseQueryString();
                params[settings.paramName] = value;
                if (href.indexOf('?') > 0) {
                    href = href.substring(0, href.indexOf('?'));
                }
                href += toQueryString(params);
                liElement = $("<li><a id=\"" + id + "\" href=\"" + href + "\">" + text + "</a></li>");
            }
            liElement.bind('click', function () {
                triggerEvent({name:'onChange', selectedItem: $(this).children(":first").attr('id'), element:rootElement, instance:ls});
                doAction($(this));
            });
            if (settings.openMode == 'hover') {
                liElement.hover(function () {
                    suspendCloseAction();
                }, function () {
                    resumeCloseAction();
                });
            }
            return liElement;
        }

        function parseQueryString() {
            var params = {};
            var query = window.location.search.substr(1).split('&');
            if (query.length > 0) {
                for (var i = 0; i < query.length; ++i) {
                    var p = query[i].split('=');
                    if (p.length != 2) {
                        continue;
                    }
                    params[p[0]] = decodeURIComponent(p[1].replace(/\+/g, " "));
                }
            }
            return params;
        }

        function toQueryString(params) {
            if (settings.testMode) {
                return '#';
            } else {
                var queryString = '?';
                var i = 0;
                for (var param in params) {
                    var x = '';
                    if (i > 0) {
                        x = '&';
                    }
                    queryString += x + param + "=" + params[param];
                    i++;
                }
                return queryString;
            }
        }

        ls.open = function () {
            open();
        };
        ls.close = function () {
            close();
        };
        triggerEvent({name:'afterLoad', element:rootElement, instance:ls});
        return ls;
    };

    var ls = $.fn.polyglotLanguageSwitcher;
    ls.defaults = {
        openMode:'click',
        hoverTimeout:1500,
        animSpeed:200,
        effect:'slide',
        paramName:'lang',
        pagePrefix:'',
        websiteType:'dynamic',
        testMode:false,
        onChange:NaN,
        afterLoad:NaN,
        beforeOpen:NaN,
        afterOpen:NaN,
        beforeClose:NaN,
        afterClose:NaN
    };


})(jQuery);
// ---------------------------------------------------------------------------------------------

// CAROUSEL JS
var pictures = new Array;
var imgLink = new Array;
var alt = new Array;
var items = '';
testAjax(function(output){
  // here you use the output
	//console.log('4'+output);
});
function testAjax(handleData) {
	$.ajax({
		type: "POST",
		url: base_url+"front/get_data",  
		data: "id=home",
		dataType:'json',
		success: function(msg){
			var counter = 0;
			$.each(msg, function(index, value) {
				  pictures[counter] = 'assets/uploads/globe_product/small/'+value['image'];
				  imgLink[counter] = value['link'];
				  alt[counter] = value['alt'];
				  counter++;
			});
			//console.log('3'+pictures);
			handleData(pictures); 
		},
		complete : function (){
			items = pictures.length;
		}
	});
}

var items;
var angles;
var realAngles = [];
var images;
var jqObs = [];
var rx = 0;
var ry = 0;
var cx = 330;
var cy = 150;
var speed = 0.008;

var speeds = [];

var topspeed = speed;
var speedBackup = 0;
var hovering = false;
var objectsInFront = 0;
var maxInFront = 4;
var dividedIn = 6;
var yposs = [];
var minThreshold = 0; // in pixels
var maxFrames = 35;
var frame = 1;

var rotateInterval = null;
var globeTimeout = null;

var gHovering = false;
var dBetweenFrontals = ((Math.PI * 2) / 10);
var dBettwenBacks = (Math.PI) / (items-maxInFront);
var dFB = dBetweenFrontals-dBettwenBacks;


function itemSize()
{
	if (window.innerWidth <= 240)
	{
		rx = 90;
		ry = 18;
	}
	else if ((window.innerWidth > 240) && (window.innerWidth <= 320))
	{
		rx = 90;
		ry = 18;
	}
	else if ((window.innerWidth > 320) && (window.innerWidth <= 480))
	{
		rx = 135;
		ry = 29;
	}
	else if ((window.innerWidth > 480) && (window.innerWidth <= 800))
	{
		rx = 135;
		ry = 29;
	}
	else
	{
		rx = 220;
		ry = 50;
	}
	angles = new Array ('items');
	images = new Array ('items');
	items = pictures.length;	
	for(var i = 0; i < items; i++)
	{
		images[i] = new Image();
		images[i].src = pictures[i];
        speeds[i] = 0;
	}	
	initCar();
    $(function(){
        $('body').on('mouseenter', '.hoverable', function(){
            hovering = true;
            speedBackup = speed;
            speed = 0;
            
            var $this = $(this);
            var oldSizes = {w: $this.width(), h: $this.height()};
            var oldPos = $this.position();
            $this.data('oldSizes', oldSizes);
            $this.data('oldZIndex', $this.css('zIndex'));
            var newSizes = {
                h: images[$this.data('index')].height*2,
                w: images[$this.data('index')].width*2
            };
            $this.animate({
                width: newSizes.w+'px',
                height: newSizes.h+'px',
                top: - (newSizes.h-oldSizes.h)/2,
                left: - (newSizes.h-oldSizes.h)/2,
                zIndex: 9999999
            }, 'fast');
        }).on('mouseleave', '.hoverable', function(){
            hovering = false;
            speed = speedBackup;
            
            var $this = $(this);
            var oldSizes = $this.data('oldSizes');
            $this.animate({
                width: oldSizes.w+'px',
                height: oldSizes.h+'px',
                top: 0,
                left: 0,
                zIndex: $(this).data('oldZIndex')
            }, 'fast');
        });
    });
}

function initCar()
{
	var content = document.getElementById('carousel');
    $('body').mousemove(function(e){
        if(hovering){
            return;
        }
        //or $(this).offset(); if you really just want the current element's offset
        var relX = e.pageX;
        var width = $(this).width();
        var diff = (width/2 - relX)/(width/2);
        if(Math.abs(width/2 - relX) > minThreshold){
			var sign = diff?diff<0?-1:1:0;
            speed = topspeed * sign;
			if(!globeHovered){}
        }else{
            speed = 0;
        }
    });    
	content.innerHTML = "";
	for(var i = 0; i < items; i++)
	{
        if(i >= dividedIn)
		{
           	angles[i] = Math.PI/2 + Math.PI;
        }
		else
		{
            angles[i] = ((Math.PI * 2) / dividedIn) * i;
        }
		var xpos = (Math.cos(angles[i]) * rx) + cx;
		var ypos = (Math.sin(angles[i]) * ry) + cy;
		
		var obj = newObj(i, xpos, ypos, parseInt(ypos), pictures[i],imgLink[i],alt[i]);
		content.innerHTML += obj;
	}
	rotateInterval = setInterval('rotateCar()', 20);
}

function rotateCar()
{
    if(speed == 0)
	{
        return;
    }
	for(var i = 0; i < items; i++)
	{
        var angleBefore = angles[i];        
		var obj = document.getElementById('obj' + i);
		var $obj = $(obj);
        if(!isAtBack(i) || (howManyAtBack() > (items - dividedIn)))
		{
            angles[i] += speed + speeds[i];
            angles[i] = normalizeAngle(angles[i]);			
			if(isFront5(angles[i])){
				if(!$obj.is(':animated')){
					$obj.fadeTo('fast', 1);
				}
			}else{
				if(!$obj.is(':animated')){
					$obj.fadeTo('fast', 1);
				}
			}
        }
        
		var xpos = (Math.cos(angles[i]) * rx) + cx;
		var ypos = (Math.sin(angles[i]) * ry) + cy;
        yposs[i] = ypos;
		obj.style.left = xpos + 'px';
		obj.style.top = ypos + 'px';
		
		//code for hide products behide a globe
		if(isFront5(angles[i])){
			obj.style.zIndex = parseInt(ypos);
		}else{
			obj.style.zIndex = parseInt(ypos) * -1;
		}
		
		var objImg = document.getElementById('img' + i);
        var $objImg = $(objImg);
        if(!$objImg.is(':animated')){			
			if(isFront1(angles[i]))
			{
				objImg.style.height = (1.5 * images[i].height) + 'px';
				objImg.style.width = (1.5 * images[i].width) + 'px';
				
				if (window.innerWidth <= 240)
					objImg.style.top =  '-35px';
				else if ((window.innerWidth > 240) && (window.innerWidth <= 320))
					objImg.style.top =  '-35px';
				else if ((window.innerWidth > 320) && (window.innerWidth <= 480))
					objImg.style.top =  '-80px';
				else if ((window.innerWidth > 480) && (window.innerWidth <= 800))
					objImg.style.top =  '-80px';
				else
					objImg.style.top =  '-100px';
			}
			else
			{
				var delta = (ypos - cy + ry) / (2 * ry);
				objImg.style.height = (delta * images[i].height) + 'px';
				objImg.style.width = (delta * images[i].width) + 'px';
				objImg.style.top =  '0px';
			}
        }
	}
}


/*
This method is use for changing a postion spinning circle 
on resizing a screen(in other words to make responsive)
*/
function onResizeWindow()
{
	if (window.innerWidth <= 240)
	{
		rx = 90;
		ry = 18;
	}
	else if ((window.innerWidth > 240) && (window.innerWidth <= 320))
	{
		rx = 90;
		ry = 18;
	}
	else if ((window.innerWidth > 320) && (window.innerWidth <= 480))
	{
		rx = 135;
		ry = 29;
	}
	else if ((window.innerWidth > 480) && (window.innerWidth <= 800))
	{
		rx = 135;
		ry = 29;
	}
	else
	{
		rx = 220;
		ry = 50;
	}
	items = pictures.length;
	clearInterval(rotateInterval);	
	for(var i = 0; i < items; i++)
	{
		images[i] = new Image();
		images[i].src = pictures[i];
        speeds[i] = 0;
	}
	initCar();
}

function newObj(id, x, y, z, src,imgLink,alt)
{
	return '<div id="obj' + id + '" style="position:absolute; left:' + x + 'px; top:' + y + 'px; z-index:' + z + ';" ><a href="' + imgLink + '"  target="_blank"><img id="img' + id + '" src="' + src + '" alt="' + alt + '" class="hoverable rotateImg" data-index="'+id+'"/></a></div>';
}

function normalizeAngle(angle){
	if(angle < 0 || angle > Math.PI * 2) return Math.abs((Math.PI * 2) - Math.abs(angle));
	else return angle;
}

function isFront5(angle)
{
	var size = (Math.PI*2)/dividedIn;
    return angle >= (Math.PI/2 - size*1.5) && angle <= (Math.PI/2 + size*1.5)
}

function isFront1(angle)
{
	var size = (Math.PI*2)/dividedIn;
    return angle >= (Math.PI/2 - size*0.005) && angle <= (Math.PI/2 + size*0.20)
}

function howManyAtBack()
{
    var many = 0;
    for(var i = 0; i < items; i++)
	{
        if(isAtBack(i))
		{
            many++;
        }
    }
    return many;
}

function isAtBack(id)
{
	//code for rotate products randomly in each devices
	if (window.innerWidth <= 240)
		return yposs[id] - 132 < 0.005;
	else if ((window.innerWidth > 240) && (window.innerWidth <= 320))
		return yposs[id] - 132 < 0.005;
	else if ((window.innerWidth > 320) && (window.innerWidth <= 480))
		return yposs[id] - 121 < 0.005;
	else if ((window.innerWidth > 480) && (window.innerWidth <= 800))
		return yposs[id] - 121 < 0.005;
	else
		return yposs[id] - 100 < 0.005;
}
// ---------------------------------------------------------------------------------------------