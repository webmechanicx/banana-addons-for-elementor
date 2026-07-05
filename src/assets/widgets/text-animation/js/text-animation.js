(function ($) {
  ("use strict");

  function SimpleTextAnimation($el, phrases, speed, loop, inType, outType) {
    this.$el = $el;
    this.phrases = phrases;
    this.speed = Math.max(100, speed || 2000);
    this.loop = loop === "true" || loop === true;
    this.inType = inType || "fadeIn";
    this.outType = outType || "fadeOut";
    this.index = 0;
    this.timer = null;
    this.init();
  }

  SimpleTextAnimation.prototype.init = function () {
    var self = this;

    // Show first phrase immediately
    this.$el.text(this.phrases[this.index]);

    // Animate it in
    this.animateIn(this.$el, function () {
      // Schedule next
      self.timer = setTimeout(function () {
        self.next();
      }, self.speed);
    });
  };

  SimpleTextAnimation.prototype.animateIn = function ($el, callback) {
    const inClass = `animate__animated animate__${this.inType}`;
    $el.addClass(inClass).one("animationend", function () {
      $el.removeClass(inClass);
      if (callback) callback();
    });
  };

  SimpleTextAnimation.prototype.animateOut = function ($el, callback) {
    const outClass = `animate__animated animate__${this.outType}`;
    $el.addClass(outClass).one("animationend", function () {
      $el.removeClass(outClass);
      if (callback) callback();
    });
  };

  SimpleTextAnimation.prototype.next = function () {
    var self = this;

    // Move index
    this.index++;
    if (this.index >= this.phrases.length) {
      if (!this.loop) return; // stop if not looping
      this.index = 0;
    }

    var nextText = this.phrases[this.index];

    // Animate current text OUT, then swap + animate IN
    this.animateOut(this.$el, function () {
      self.$el.text(nextText);
      self.animateIn(self.$el, function () {
        self.timer = setTimeout(function () {
          self.next();
        }, self.speed);
      });
    });
  };

  // Elementor + normal init
  function initSimpleAnimate(context) {
    $(".hck-wrapper", context).each(function () {
      var $wrap = $(this);
      var config = {};
      try {
        config = JSON.parse($wrap.attr("data-elta"));
      } catch (e) {
        config = {};
      }

      // Get phrases: comma-separated or default to element text
      var phrases = $wrap[0].dataset.phrases
        ? $wrap[0].dataset.phrases.split(",").map(function (p) {
            return p.trim();
          })
        : [$wrap.find(".hck-text").text()];

      var $text = $wrap.find(".hck-text");

      // reset old text
      $text.text("");

      // start animation
      new SimpleTextAnimation($text, phrases, config.speed || 1000, config.loop, config.type);
    });
  }
  $(window).on("elementor/frontend/init", function () {
    elementorFrontend.hooks.addAction("frontend/element_ready/banae_text_animate.default", function ($scope) {
      initSimpleAnimate($scope);
    });
    /*
    // Run again inside Elementor editor
    elementorFrontend.hooks.addAction("frontend/element_ready/simple_animate_widget.default", function ($scope) {
      initSimpleAnimate($scope[0]);
    });*/
  });

  // On normal page load
  /*
  $(document).ready(function () {
    initSimpleAnimate(document);
  });
  */
})(jQuery);
