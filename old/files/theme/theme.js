jQuery(function($) {
  var bradleyController = {
    init: function() {
      var base = this;

      base.isScrolled = !!$(window).scrollTop();
      base.isMenuOpen = false;

      base.breakpoints = {
        mobile: 767,
        tablet: 1024
      };

      base.$siteOverlay = $('.site-overlay');

      base._moveUtils();
      base._headerClasses();
      base._minicartSetup();
      base._initMenus();
      base._initSubmenus();
      base._quantityStyles();
      base._productImageSlider();
      base._bindEvents();
    },

    _bindEvents: function() {
      var base = this;
      var width = $(window).width();

      base._bindMenuEvents();

      $(window).on('scroll', debounce(function() {
        base.isScrolled = !!$(window).scrollTop();
        base._headerClasses();
      }, 50));

      $(window).on('resize', debounce(function() {
        var $menu = $('.desktop-nav > .wsite-menu-default');
        if (typeof DISABLE_NAV_MORE == 'undefined' || !DISABLE_NAV_MORE) {
          $menu.data('pxuMenu').update();
        }
        base._initMenus();
        base._initSubmenus();

        if ($(this).width() != width) {
          width = $(this).width();
          base._closeAllDropdowns();
        }
      }, 300));

      $('.site-utils .search-toggle').on('click', function() {
        base._searchToggle();
      });

      $('.hamburger').on('click', function() {
        base._toggleMobileMenu('toggle');
      });

      var $el = $('.wsite-search-button');

      if ($el.length) {
        $el.get(0).addEventListener('click', function(event) {
          event.stopPropagation();
          base._closeAllDropdowns();
        }, true);
      }

      $('[data-scroll-down]').on('click', function() {
        base._landingScroll('#main-wrap');
      });

      $('.radio-style').on('click', function(event) {
        var $wrapper = $(event.currentTarget);
        $wrapper.siblings('input[type=radio]').trigger('click');
      });

      $('.checkbox-style').on('click', function(event) {
        var $wrapper = $(event.currentTarget);
        $wrapper.siblings('input[type=checkbox]').trigger('click');
      });

      $(document).on('click', '.quantity-up', function(event) {
        var $target = $(event.currentTarget)
          .parents('#wsite-com-product-quantity')
          .children('#wsite-com-product-quantity-input');
        base._updateNumberValue($target, true);
      });

      $(document).on('click', '.quantity-down', function(event) {
        var $target = $(event.currentTarget)
          .parents('#wsite-com-product-quantity')
          .children('#wsite-com-product-quantity-input');
        base._updateNumberValue($target, false);
      });

      $(document).off('click', '[data-category-toggle]').on('click', '[data-category-toggle]', function(event) {
        base._toggleCategoryMenu($(event.currentTarget));
      });

      $('.site-overlay').on('click', function() {
        base._closeAllDropdowns();
      });

      base.utils.onEscKey(function(){
        base._closeAllDropdowns();
      });

      setTimeout(function() {
        base.wrapSelects();
      }, 0);

      $('.site-utils .wsite-search').on('revealer-show', function() {
        $('.site-utils .wsite-search-input').focus();
      });
    },

    _bindMenuEvents: function() {
      var base = this;

      $(document).off('click', '.menu-down-arrow, .more-link, .nonclickable').on('click', '.menu-down-arrow, .more-link, .nonclickable', function(event) {
        var $toggle = $(event.currentTarget);
        $toggle.toggleClass('active');
        $toggle.siblings('.wsite-menu-wrap').revealer('toggle');

        //on mobile the nav is inside another element, no need to toggle the header
        if($toggle.parents('.desktop-nav').length) {
          base._closeAdjacentDropdowns($toggle);
          base.isMenuOpen = $toggle.hasClass('first-level') || $toggle.hasClass('more-link') || ($toggle.hasClass('nonclickable') && $toggle.hasClass('wsite-menu-item'))  ? $toggle.hasClass('active') : true;
          base._headerClasses();
        }
      });
    },

    _initMenus: function() {
      var $desktopNav = $('.desktop-nav .wsite-menu-default');
      if (typeof DISABLE_NAV_MORE == 'undefined' || !DISABLE_NAV_MORE) {
        $desktopNav.pxuMenu({
          moreLinkHtml: 'More',
        });
        setTimeout(function() {
          $desktopNav.data('pxuMenu').update();
        }, 600);
      }

      var $firstLevel = $('.wsite-menu-item-wrap');

      $firstLevel.each(function() {
        if ($(this).children('.wsite-menu-wrap').length > 0) {
          var $link = $(this).children('.wsite-menu-item');
          $(this).children('.menu-down-arrow.second-level').remove();
          $(this).addClass('has-submenu');
          if (!$(this).children('.menu-down-arrow.first-level').length) {
            $link.after('<span class="menu-down-arrow first-level"></span>');
          }
        }
      });

      //has to be run again to compensate for the down arrow on the more menu
      if (typeof DISABLE_NAV_MORE == 'undefined' || !DISABLE_NAV_MORE) {
        $desktopNav.data('pxuMenu').update();
      }
    },

    _initSubmenus: function() {
      var base = this;
      var $menu = $('.desktop-nav > .wsite-menu-default');
      var $submenu = $('> .has-submenu > .wsite-menu-wrap > .wsite-menu', $menu);
      var menuPositionLeft = $(window).width() >= base.breakpoints.mobile ? $menu.offset().left : '';

      var $secondLevel = $('.wsite-menu-subitem-wrap', $menu);

      $secondLevel.each(function() {
        if ($(this).children('.wsite-menu-wrap').length > 0) {
          var $link = $(this).children('.wsite-menu-subitem');
          //in case the more menu somehow throws something in there
          $(this).children('.menu-down-arrow.first-level').remove();
          $(this).addClass('has-submenu');

          if (!$(this).children('.menu-down-arrow.second-level').length) {
            $link.after('<span class="menu-down-arrow second-level"></span>');
          }
        }
      });

      $submenu.css('left', menuPositionLeft);
      $submenu.css('width', $(window).width() - (menuPositionLeft * 2));
    },

    _toggleMobileMenu: function(state) {
      var base = this;
      var $toggle = $('.hamburger');
      var $mobileMenu = $('.collapsed-nav');

      base._closeAdjacentDropdowns($toggle);
      base.isMenuOpen = state === 'toggle' ? !$('.collapsed-nav').hasClass('visible') : false;
      state === 'toggle' ? $toggle.toggleClass('open') : $toggle.removeClass('open');
      base._headerClasses();
      $mobileMenu.revealer(state);
    },

    _closeAdjacentDropdowns: function($thisToggle) {
      var $menu = $('.desktop-nav > .wsite-menu-default');
      var $submenuWrap = $('.has-submenu > .wsite-menu-wrap', $menu);
      var $thisSubmenu = $thisToggle.siblings('.wsite-menu-wrap');
      var $toggle = $('.has-submenu > .menu-down-arrow', $menu);

      $submenuWrap.each(function() {
        //only close other submenus if they're not parents or children
        if (!$(this).is($thisSubmenu) && !$thisSubmenu.parents().is($(this))) {
          $(this).revealer('hide');
        }
      });

      $toggle.each(function() {
        var $this = $(this);
        var submenu = '.wsite-menu-default > .wsite-menu-item-wrap > .wsite-menu-wrap > .wsite-menu';

        if ($thisToggle.hasClass('second-level')) {
          if ($thisToggle.parentsUntil(submenu).find($this).length) {
            return;
          }
        }

        if (!$thisToggle.is($(this))) {
          $(this).removeClass('active');
          $(this).parent().removeClass('active');
        }
      });

      if (!$thisToggle.hasClass('search-toggle')) {
        $('.site-utils .wsite-search').revealer('hide');
      }

      if (!$thisToggle.hasClass('wsite-nav-cart')) {
        $('.minicart-takeover').revealer('hide');
      }

      if(!$thisToggle.hasClass('hamburger')) {
        $('.collapsed-nav').revealer('hide');
        $('.hamburger').removeClass('open');
      }
    },

    _closeAllDropdowns: function() {
      var base = this;

      $('.desktop-nav > .wsite-menu-default > .has-submenu .wsite-menu-wrap').revealer('hide');
      $('.site-utils .wsite-search, .minicart-takeover').revealer('hide');
      $('html, body, .header-wrap').removeClass('fixed');
      $('.menu-down-arrow.first-level, .wsite-menu-subitem-wrap').removeClass('active');

      base.isMenuOpen = false;
      base._headerClasses();
    },

    _moveUtils: function() {
      var base = this;

      if ($(window).width() > base.breakpoints.tablet) {
        $('.wsite-search').insertBefore('.search-toggle');
        var member = $('#member-login').clone(true);
        member.prependTo('.site-utils');
      } else {
       $('.wsite-search').prependTo('.collapsed-nav');
       var member = $('#member-login').clone(true);
       member.appendTo('.collapsed-nav > ul');
      }
    },

    _searchToggle: function() {
      var base = this;
      var $searchToggle = $('.site-utils .search-toggle');
      var $searchWrapper = $('.site-utils .wsite-search');

      base._closeAdjacentDropdowns($searchToggle);
      base.isMenuOpen = !$searchWrapper.hasClass('visible');
      $searchWrapper.revealer('toggle');
      base._headerClasses();
    },

    _headerClasses: function() {
      var base = this;

      $('.header-wrap')
        .toggleClass('fixed', base.isScrolled || base.isMenuOpen)
        .toggleClass('menu-open', base.isMenuOpen);

      $('html, body').toggleClass('fixed', base.isMenuOpen);
      base.toggleOverlay();
    },

    _minicartSetup: function() {
      var base = this;
      var cartOpenClass = 'fixed';

      function toggleMinicart(state) {
        base.isMenuOpen = state === 'hide' ? false : !$('.minicart-takeover').hasClass('visible');

        $('.minicart-takeover').revealer(state);
        base._closeAdjacentDropdowns($('.wsite-nav-cart'));
        base._headerClasses();
      }

      function hijackMinicartToggle() {
        var $cartToggle = $('#wsite-nav-cart-a');

        $cartToggle.off('click mouseenter mouseover mouseleave mouseout');
        $cartToggle.html($cartToggle.html().replace('(', '<sup>').replace(')', '</sup>'));
      }

      function hijackMinicart() {
        var $minicart = $('#wsite-mini-cart');

        $minicart
          .off('mouseenter mouseover mouseleave mouseout')
          .removeClass('arrow-top')
          .removeAttr('style');

        if (!$('.minicart-takeover').length) {
          $minicart.wrap('<div class="minicart-takeover" />');
        }

        if (!$('.product-list-wrap').length
          && !$('.wsite-empty-cart').length) {
          $('.wsite-product-list').wrap('<div class="product-list-wrap" />');
          $('.product-list-wrap').prepend('<div class="gradient-top" />').append('<div class="gradient-bottom" />');
        }

        $(document).off('click', '.wsite-nav-cart').on('click', '.wsite-nav-cart', function(event) {
          toggleMinicart('toggle');
        });

        $(document).on('click', '.minicart-close', function() {
          toggleMinicart('hide');
        });
      }

      // Watch for minicart
      base._observeDom(document, function(docObserver, target, config) {
        // Bail if minicart & toggle not available yet
        if (!$('#wsite-nav-cart-a').length || !$('#wsite-mini-cart').length) return;

        // Watch minicart
        base._observeDom($('#wsite-mini-cart')[0], function(observer, target, config) {
          observer.disconnect();
          hijackMinicart();
          hijackMinicartToggle();
          observer.observe(target, config);
        });

        // Watch toggle (sometimes default toggle updates after cart)
        base._observeDom($('#wsite-nav-cart-a')[0], function(observer, target, config, mutation) {
          observer.disconnect();
          if (mutation.type === 'childList') {
            hijackMinicartToggle();
          }
          observer.observe(target, config);
        });

        // minicart available, so stop watching the doc
        docObserver.disconnect();
      }, {subtree: true});
    },

    _landingScroll: function(scrollTo) {
      $('html, body').animate({
        scrollTop: $(scrollTo).position().top + 'px'
      }, 800);
    },

    // Interval loop
    intervalLoop: function(condition, action, duration, limit) {
      var base = this;
      var counter = 0;
      var looper = setInterval(function() {
        if (counter >= limit || base.checkIfElementExists(condition)) {
          clearInterval(looper);
        } else {
          action();
          counter++;
        }
      }, duration);
    },

    // Check if element exists
    checkIfElementExists: function(selector) {
      return $(selector).length;
    },

    _updateNumberValue: function($target, increase) {
      if ($target.prop('disabled')) return;

      var num = increase === true ? parseInt($target.val(), 10) + 1 : parseInt($target.val(), 10) - 1;
      if (num < 0) {
        num = 0;
      }

      $target.val(num);
    },

    wrapSelects: function() {
      $('select:not(.w-input-offscreen)').wrap('<div class="simple-select-wrapper" />').css('visibility', 'visible');
    },

    _quantityStyles: function() {
      $('<div class="quantity-style"><div class="quantity-up" /><div class="quantity-down" /></div>"')
        .insertAfter('#wsite-com-product-quantity-input');
    },

    _toggleCategoryMenu: function($toggle) {
      var base = this;

      var titleWidth =
        $(window).width() > base.breakpoints.mobile
          ? $toggle.siblings('#wsite-com-title').outerWidth(true)
          : 0;

      $toggle.toggleClass('open');
      $toggle.siblings('.wsite-com-sidebar').revealer('toggle').css('margin-left', titleWidth);
    },

    _productImageSlider: function() {
      var base = this;

      var $imagesStrip = $('#wsite-com-product-images-strip');
      if (!$('.product-images-strip-wrapper').length
        && $imagesStrip.children().length > 4) {
          $imagesStrip.wrap('<div class="product-images-strip-wrapper" />');

          $('.product-images-strip-wrapper')
            .prepend('<div class="gradient-left"><div class="gradient-left-arrow"></div></div>')
            .append('<div class="gradient-right"><div class="gradient-right-arrow"></div></div>');
      }

      base._bindProductImageButtons();
    },

    _bindProductImageButtons: function() {
      $('.product-images-strip-wrapper .gradient-left').click( function() {
        var leftPos = $('#wsite-com-product-images-strip').scrollLeft() - 300;
        $('#wsite-com-product-images-strip').animate({scrollLeft: leftPos}, 500);
      });

      $('.product-images-strip-wrapper .gradient-right').click( function() {
        var leftPos = $('#wsite-com-product-images-strip').scrollLeft() + 300;
        $('#wsite-com-product-images-strip').animate({scrollLeft: leftPos}, 500);
      });
    },

    utils: {
      onEscKey: function(callback) {
        $(document).on('keyup', function(event) {
          if (event.keyCode === 27) callback();
        });
      }
    },

    showOverlay: function() {
      var base = this;
      base.$siteOverlay.show();
    },

    hideOverlay: function() {
      var base = this;
      base.$siteOverlay.hide();
    },

    toggleOverlay: function() {
      var base = this;
      base.$siteOverlay.toggle(base.isMenuOpen);
    },

    _observeDom: function(target, callback, config) {
      var config = $.extend({
        attributes: true,
        childList: true,
        characterData: true
      }, config);

      // create an observer instance & callback
      var observer = new MutationObserver(function(mutations) {
        // Using every() instead of forEach() allows us to short-circuit the observer in the callback
        mutations.every(function(mutation) {
          callback(observer, target, config, mutation);
        });
      });
      // pass in the target node, as well as the observer options
      observer.observe(target, config);
    }
  }

  $(document).ready(function() {
    bradleyController.init();
  });
});
