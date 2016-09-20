(function() {
  'use strict';

  var app = {
    active: 'active',
    successCls: 'success',
    errorCls: 'error',

    init: function(){
      this.nodeCleaning(document),
      triggers.init(),
      nav.init(),
      slider.init(),
      forms.init(),
      map.init(),
      scrollTop.init(),
      lazyLoad.init();
    },
    getLang: function(){
      return document.documentElement.lang;
    },
    hasClass: function(el, cls){
      return (' ' + el.className + ' ').indexOf(' ' + cls + ' ') > -1;
    },
    insertAfter: function(el, referenceNode){
      referenceNode.parentNode.insertBefore(el, referenceNode.nextSibling);
    },
    nodeCleaning: function(node){
      for(var n = 0; n < node.childNodes.length; n ++) {
        var child = node.childNodes[n];

        if (child.nodeType === 8 || (child.nodeType === 3 && !/\S/.test(child.nodeValue))) {
          node.removeChild(child);
          n --;
        }
        else if(child.nodeType === 1) {
          this.nodeCleaning(child);
        }
      }
    }
  }

  var nav = {
    __proto__: app,
    navId: 'menu-primary',

    init: function(){
      this.setActiveItem();
    },
    setActiveItem: function(){
      var url = window.location.href,
          nav = document.getElementById(this.navId),
          navItem = nav.querySelectorAll('a');

      for (var i = 0; i < navItem.length; i++) {
        if (navItem[i].getAttribute('href') == url) {
          navItem[i].classList.add(this.active);
        }
      }
    }
  }

  var triggers = {
    __proto__: app,
    itemTrigger: 'item-trigger',
    aFalse:      'a-false',

    init: function() {
      this.itemTriggers();
    },
    itemTriggers: function() {
      var _this = this,
          trigger = document.getElementsByClassName(this.itemTrigger);

      for (var i = 0; i < trigger.length; i++) {
        trigger[i].addEventListener('click', function(e){
          var target = document.getElementById(this.dataset.trigger);

          target.classList.toggle(_this.active);
          this.classList.toggle(_this.active);

          e.preventDefault();
        });
      }
    }
  }

  var map = {
    init: function(){
      this.createMap();
    },
    createMap: function(){
      var _this = this,
          map = document.getElementById('map');

      if (map && typeof google === 'object' && typeof google.maps === 'object') {
        gMap = new google.maps.Map(map, {
          zoom: 17,
          center: _this.getCoords(map),
          scrollwheel: false
        });

        var pin = _this.getMapPin(map, gMap),
            infoWin = _this.getInfoWindow(map, gMap);

        if (pin) {
          pin.addListener('click', function() {
            infoWin.open(gMap, pin);
          });
        }
      }
    },
    getCoords: function(map){
      var lat = +map.dataset.lat,
          lng = +map.dataset.lng,
          companyCoords = {lat: lat, lng: lng};

      return companyCoords;
    },
    getMapPin: function(map, gMap){
      var _this = this,
          markerUrl = map.dataset.pin;

      if (markerUrl) {
        var marker = new google.maps.Marker({
          position: _this.getCoords(map),
          map: gMap,
          icon: markerUrl
        });

        return marker;
      }
    },
    getInfoWindow: function(map, gMap){
      var _this = this,
          info = map.dataset.info;

      if (info) {
        var infoWindow = new google.maps.InfoWindow({
          content: info,
          position: _this.getCoords(map)
        });

        return infoWindow;
      }
    }
  }

  var forms = {
    __proto__:      app,
    required:       'required',

    validError:     'validation-error',
    validMessage:   'validation-message',

    reqFieldError:  'Обязательное поле',//'This field is mandatory',
    nameError:      'Имя должно быть 2-32 символа в длину и содержать А-я',//'Name must be 2-32 chars long and contain A-z letters',
    phoneError:     'Phone must be 6-12 chars long and be numeric',
    emailError:     'Пожалуйста, введите корректный e-mail адрес',//'Please enter a valid email',

    loadingClass:   'loading',
    ajaxMessageCls: 'ajax-respond',
    ajaxSuccess:    'Спасибо, ваше сообщение отправлено',//'Yay! Data send!',
    ajaxError:      'Ой, что-то пошло не так!',//'Whoops, looks like something went wrong!',


    init: function(){
      this.formSubmit();
    },
    formSubmit: function(){
      var form  = document.getElementsByTagName('form');
      var _this = this;

      for (var i = 0; i < form.length; i++) {
        form[i].addEventListener('submit', function(e){
          e.preventDefault();

          if (_this.validate(this)) {
            _this.sendRequest(this);
          }
        });
      }
    },
    validate: function(form){
      var field;
      var required = form.getElementsByClassName(this.required);
      var invalid = form.getElementsByClassName(this.validError);

      for (var i = 0; i < required.length; i++) {
        field = required[i];

        this.checkEmptyValue(field);
        this.checkName(field);
        this.checkEmail(field);
      }

      if (invalid.length == 0) {
        return true;
      }
    },
    checkEmptyValue: function(field){
      if (field.value == "" || null) {
        this.addEmptyValueError(field);
      } else {
        this.removeEmptyValueError(field);
      }
    },
    checkName: function(field){
      var name = 'name';
      var pattern = /[А-я]{2,32}/;
      var message = this.nameError;

      this.validateField(field, name, pattern, message);
    },
    checkPhone: function(field){
      var name = 'phone';
      var pattern = /^\d{6,12}$/;
      var message = this.phoneError;

      this.validateField(field, name, pattern, message);
    },
    checkEmail: function(field){
      var name = 'email';
      var pattern = /[^\s@]+@[^\s@]+\.[^\s@]+/;
      var message = this.emailError;

      this.validateField(field, name, pattern, message);
    },
    validateField: function(field, fieldName, pattern, message){
      if (field.getAttribute('name') == fieldName) {
        var value = field.value;
        var messageAdded = field.nextElementSibling;

        if (!value.match(pattern)) {

          if (!messageAdded){
            field.classList.add(this.validError);
            this.addErrorContainer(field, message);
          }

        } else {

          if (messageAdded) {
            field.classList.remove(this.validError);
            this.removeErrorContainer(field, message);
          }

        }
      }
    },
    createMessageContainer: function(){
      var container = document.createElement('label');
      container.className = 'message';

      return container;
    },
    addErrorContainer: function(element, message){
      var fieldID = element.getAttribute('ID');
      var container = this.createMessageContainer();

      container.innerHTML = message;
      container.setAttribute('for', fieldID);
      container.classList.add(this.validMessage);

      this.insertAfter(container, element)
    },
    removeErrorContainer: function(field){
      var parent = field.parentElement;

      parent.removeChild(field.nextSibling);
      field.classList.remove(this.validError);
    },
    addEmptyValueError: function(element){
      element.setAttribute('placeholder', this.reqFieldError);
      element.classList.add(this.validError);
    },
    removeEmptyValueError: function(element){
      element.removeAttribute('placeholder');
      element.classList.remove(this.validError);
    },
    ajaxMessage: function(){
      var container = this.createMessageContainer();
      container.classList.add(this.ajaxMessageCls);

      return container;
    },
    showAjaxRespond: function(form, messageText){
      var message = this.ajaxMessage();
      message.innerHTML = messageText;

      form.appendChild(message);

      setTimeout(function(){
        form.removeChild(message);
      }, 50000);
    },
    prepareData: function(form){
      var field,
          fields = form.elements,
          fieldsArray = [];

      for (var i = 0; i < fields.length; i++) {
        if (fields[i].getAttribute('name')){
          field = fields[i].getAttribute('name') + '=' + fields[i].value;
          fieldsArray.push(field);
        }
      }

      fieldsArray = fieldsArray.join('&');

      return fieldsArray;
    },
    sendRequest: function(form){
      var _this = this;
      form.classList.add(this.loadingClass);

      var xhr = new XMLHttpRequest();
      var data = this.prepareData(form);

      xhr.onreadystatechange = function() {
        if (xhr.readyState == XMLHttpRequest.DONE ) {
           form.classList.remove(_this.loadingClass);

           if (xhr.status == 200) {
            _this.showAjaxRespond(form, _this.ajaxSuccess);
            form.reset();
           } else {
            messageText = _this.showAjaxRespond(form, _this.ajaxError);
           }
        }
      }

      xhr.open(form.getAttribute('method'), form.getAttribute('action'));
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.send(data);
    }
  }

  var slider = {
    __proto__: app,
    slider:  'slider',
    slides:  '.slides',
    navDots: 'slider-dots',
    navDot:  'dot',
    data:    'data-link',

    init: function(){
      this.intitSliders();
    },
    intitSliders: function(){
      var sliders = document.getElementsByClassName(this.slider);

      for (var i = 0; i < sliders.length; i ++) {

        var slider = sliders[i];
        var slides = slider.children[0];
        var slide  = slides.children;
        var slidesLength = slide.length;

        if(slidesLength > 1){
          this.highlightFirstItem(slides);
          this.setSlidePosition(slide);
          this.createDots(slidesLength, slider);
          this.dotClick();
        }
      }
    },
    highlightFirstItem: function(container){
      container.firstChild.classList.add(this.active);
    },
    createDots: function(length, slider){
      var dotsContainer = document.createElement('ul');
      dotsContainer.className = this.navDots;

      for (var i = 0; i < length; i++){
        var dot = document.createElement('li');

        dot.className = this.navDot;
        dot.setAttribute(this.data, [i]);

        dotsContainer.appendChild(dot);
      }

      slider.appendChild(dotsContainer);
      this.highlightFirstItem(dotsContainer);
    },
    dotClick: function(){
      var dots = document.getElementsByClassName(this.navDot);
      var _this = this;

      for (var i = 0; i < dots.length ; i++) {
        dots[i].addEventListener('click', function(){
          if(!_this.hasClass(this, _this.active)){;
            _this.switchSlide(this);
            _this.changeDot(this);
            this.classList.add(_this.active);
          }
        });
      }
    },
    changeDot: function(dot){
      var dots = dot.parentElement.children;
      this.removeActive(dots);
    },
    removeActive: function(elements){
      for (var i = 0; i < elements.length; i++){
        elements[i].classList.remove(this.active);
      }
    },
    setSlidePosition: function(children){
      for (var i = 0; i < children.length; i++){
        children[i].setAttribute(this.data, [i]);
      }
    },
    switchSlide: function(dot){
      var slides = dot.parentElement.parentElement.children[0].children;
      var targetSlide = dot.dataset.link;

      this.hideSlides(slides);

      for (var i = 0; i < slides.length; i++){
        if (slides[i].dataset.link == targetSlide){
          slides[i].classList.add(this.active);
          lazyLoad.checkVisibility(slides[i]);
        }
      }
    },
    hideSlides: function(slides){
      this.removeActive(slides);
    },
  }

  var scrollTop = {
    __proto__:   app,
    scrollClass: 'scroll-top',
    scrollSpeed: 400,
    visible: false,

    init: function(){
      this.setActive();
      this.clickEvent();
    },
    getBtn: function(){
      var btn = document.getElementById(this.scrollClass);
      return btn;
    },
    getHeight: function(){
      var winHeight = window.innerHeight*1.5;
      return winHeight;
    },
    setActive: function(){
      this.checkOffset(this.getHeight());
      this.checkOnScroll(this.getHeight());
    },
    checkOffset: function(val){
      var _this = this;
      var topOffset = window.pageYOffset || document.documentElement.scrollTop;

      if (_this.visible == false && topOffset > val) {
        _this.getBtn().classList.add(_this.active);
        _this.visible = true;
      } else if(_this.visible == true && topOffset < val) {
        _this.getBtn().classList.remove(_this.active);
        _this.visible = false;
      }
    },
    checkOnScroll: function(val){
      var _this = this;

      window.addEventListener('scroll', function(){
        _this.checkOffset(val);
      });
    },
    clickEvent: function(){
      var _this = this;

      this.getBtn().addEventListener('click', function(e){
        e.preventDefault();
        _this.scrollPage();
      });
    },
    scrollPage: function(){
      var scrollDuration = this.scrollSpeed,
          scrollStep = -window.scrollY / (scrollDuration / 15),
          scrollInterval = setInterval(function(){
          if (window.scrollY != 0) {
              window.scrollBy(0, scrollStep);
          }
          else clearInterval(scrollInterval);
      },15);
    }
  }

  var lazyLoad = {
    __proto__:     app,
    visibleStatus: 'data-visible',
    isVisible:     'yes',
    replaceStatus: 'data-replaced',
    isReplaced:    'yes',

    init: function(){
      var lazy = document.getElementsByClassName('lazy'),
          _this = this,
          el;
      for (var i = 0; i < lazy.length; i++) {
        el = lazy[i];

        _this.inViewport(el);
        _this.checkVisibility(el);
      }
    },
    inViewport: function(el){
      this.setVisibleFlag(el);
    },
    setVisibleFlag: function(el){
      el.setAttribute(this.visibleStatus, this.isVisible);
    },
    setReplaceFlag: function(el){
      el.setAttribute(this.replaceStatus, this.isReplaced);
    },
    replaceSrc: function(el){
      this.setReplaceFlag(el);

      if (el.hasAttribute('src')){
        el.setAttribute('src', el.dataset.lazy);
      } else {
        el.style.backgroundImage = "url(" + el.dataset.lazy + ")";
      }
    },
    checkVisibility: function(el){
      if (
          el.dataset.replaced != this.isReplaced
          && el.dataset.visible == this.isVisible
          && this.hasClass(el, this.active)
          )
      {
        this.replaceSrc(el);
      }
    }
  }

  window.onload = (function(){
    app.init();
  });

})();