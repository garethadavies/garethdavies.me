/*    Author: Gareth Davies */

// local   http://localhost:81/garethdavies.me/
// test   http://www.garethdavies.me/beta/
// live    http://www.garethdavies.me/
var root = "http://www.garethdavies.me/"; 

Modernizr.load([
      {
            // Load jquery from google's CDN or fall back to local version
            load: '//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js',
            complete: function () {
                  
				  //var pathname = window.location.pathname;
						//alert(pathname);
						
				Modernizr.load(root + '_lib/js/jquery.flexslider-min.js');
				Modernizr.load(root + '_lib/js/jquery.flexslide.init.js');
				  
				  if (!window.jQuery) {
                        Modernizr.load(root + '_lib/js/jquery-1.7.1.min.js');
                  }
            }
      },
      {
            /* Test if browser can handle placeholder attribute */
            test: Modernizr.input.placeholder,
            //yep: root + '_lib/js/test.js',
			nope: root + '_lib/js/jquery.formalize.min.js'
      },
      {
            // Test if browser can handle required attribute. If not, use jquery validation
            test: Modernizr.input.required && Modernizr.input.autocomplete,
            //yep: '_lib/js/test.js',
            nope: root + '_lib/js/jquery.validate.min.js',
            complete: function () {
                  if (jQuery().validate) {
                        // Initiate the form validation
                        $("#contactForm").validate({
                              errorElement: "span",
                              errorPlacement: function (error, element) {
                                    error.appendTo(element.prev("label"));
                              },
                              rules: {
                                    name: {
                                          required: true
                                    },
                                    email: {
                                          required: true,
                                          email: true
                                    },
									message: {
                                          required: true,
                                          minlength: 1
                                    }
                              },
                              messages: {
                                    name: {
                                          required: " Please enter your name"
                                    },
                                    email: {
                                          required: " Please enter your email address",
                                          email: " Please enter a valid email address"
                                    },
                                    message: {
                                          required: " Please enter a message",
                                          minlength: " Please enter a message"
                                    }
                              }
                        });
                  }
            }
      }
]);


/*
* Normalized hide address bar for iOS & Android
* (c) Scott Jehl, scottjehl.com
* MIT License
*/

(function (win) {
      var doc = win.document;

      // If there's a hash, or addEventListener is undefined, stop here
      if (!location.hash && win.addEventListener) {

            //scroll to 1
            window.scrollTo(0, 1);
            var scrollTop = 1,
			getScrollTop = function () {
			      return win.pageYOffset || doc.compatMode === "CSS1Compat" && doc.documentElement.scrollTop || doc.body.scrollTop || 0;
			},

            //reset to 0 on bodyready, if needed
			bodycheck = setInterval(function () {
			      if (doc.body) {
			            clearInterval(bodycheck);
			            scrollTop = getScrollTop();
			            win.scrollTo(0, scrollTop === 1 ? 0 : 1);
			      }
			}, 15);

            win.addEventListener("load", function () {
                  setTimeout(function () {
                        //at load, if user hasn't scrolled more than 20 or so...
                        if (getScrollTop() < 20) {
                              //reset to hide addr bar at onload
                              win.scrollTo(0, scrollTop === 1 ? 0 : 1);
                        }
                  }, 0);
            });
      }
})(this);





















