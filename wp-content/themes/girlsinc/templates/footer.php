<?php use Roots\Sage\Assets; ?>
<footer>
    <div class="container-fluid container-primary">
        <?php if(!is_front_page()) { ?>
        <div class="row prefooter-ctas text-center footer-icons clearfix">
            <div class="d-block col-6">
                <a href="/donate">
                    <img class="mx-auto d-block" src="<?= Assets\asset_path('images/footer-icon-donate.png') ?>">
                    <span class="cta-label">Donate Now</span>
                </a>
            </div>
            <div class="d-block col-6">
                <a href="/take-action/">
                    <img class="mx-auto d-block" src="<?= Assets\asset_path('images/footer-icon-action.png') ?>">
                    <span class="cta-label">Take Action</span>
                </a>
            </div>
        </div>
        <?php } ?>

        <div class="row prefooter-newsletter" id="newsletter-form">
            <div class="col-12">
                <script type="text/javascript" id="bloomerangForm228352"></script>
<script type="text/javascript">
    var insertForm228352 = function() {
        var html228352 = '<style text=\'text/css\'>' +
'.email-registration-form label{color: #fff;' +
'                display: block;}' +
'' +
'.email-registration-form label.error{color:#900;' +
'                display: inline-block; ' +
'                padding: 0 10px;}' +
'' +
'.email-registration-form .field{padding: 4px 20px 4px 0; display: inline-block; max-width: 100%; width: 33%; color: #fff}' +
'' +
'.email-registration-form .field .required-star{color: #aa0000; ' +
'                display: inline-block; ' +
'                margin-left: 5px;}' +
'' +
'.email-registration-form .field .checkboxes{max-width:275px;' +
'                border: 1px solid #A9A9A9;' +
'                -webkit-transition: all .3s ease-out;' +
'                -moz-transition: all .3s ease-out;' +
'                transition: all .3s ease-out;}' +
'' +
'.email-registration-form .field .checkbox{display:block;' +
'                position:relative;' +
'                -moz-box-sizing:border-box;' +
'                box-sizing:border-box;' +
'                height:30px;' +
'                line-height:26px;' +
'                padding:2px 28px 2px 8px;' +
'                border-bottom:1px solid rgba(0,0,0,0.1);' +
'                color:#404040;  ' +
'                overflow:hidden;' +
'                text-decoration:none; }' +
'' +
'.email-registration-form .field .checkbox input{opacity:0.01;' +
'                position:absolute;' +
'                left:-50px;  ' +
'                z-index:-5;}' +
'' +
'.email-registration-form .field .checkbox:last-child{border-bottom:none;}' +
'' +
'.email-registration-form .field .checkbox.selected{background: rgb(50, 142, 253);' +
'                color:#fff; }' +
'' +
'.email-registration-form .field .checkbox.selected:before{color:#fff;' +
'                text-shadow:1px 2px 1px rgba(0,0,0,0.25);' +
'                line-height:30px;' +
'                position:absolute;' +
'                right:10px; }' +
'' +
'.email-registration-form .field input{padding: 4px; ' +
'                width: 100%; border: none; border-bottom: 2px solid #fff; background: transparent; color: #fff;}' +
'' +
'.email-registration-form .errors{border: 1px solid #900;' +
'                color: #900;  ' +
'                padding: 10px;}' +
'' +
'.email-registration-form .hidden{display: none;}' +
'' +
'.btn-group .btn-submit-email{padding: 4px 10px;}' +
'input:focus { outline: none;}' +
'input, select, textarea, button{font-family: inherit;}' +
'*::-webkit-input-placeholder { ' +
'  color: #fff; ' +
'}' +
'*::-moz-placeholder { ' +
'  color: #fff; ' +
'}' +
'*::-ms-input-placeholder { ' +
'  color: #fff; ' +
'}' +
'*::-moz-placeholder { ' +
'  color: #fff; ' +
'}' +
'</style>' +
'' +
'<div id="email-registration-form-container">' +
'  <form id="email-registration-form" class="email-registration-form" method="post" action="javascript:void(0)">' +
'    <div class="errors hidden"></div>' +
'    <div class="section contact">' +
'      <h5 class="text-center" style="margin-bottom: 20px;">Sign up for our mailing list</h5>' +
'      <div class="field text first-name required" >' +
'        <label for="first-name"><span class="label">First Name</span>' /*<span class="required-star">*</span></label>'*/ +
'        <input id="first-name" name="first-name" class="required" type="text"></input>' +
'       </div>' +
'<div class="field text last-name required" >' +
'<label for="last-name"><span class="label">Last Name</span>' /*<span class="required-star">*</span></label>' */ +
'<input id="last-name" name="last-name" class="required" type="text"></input>' +
'</div>' +
'<div class="field email email-address required" >' +
'<label for="email-address"><span class="label">Email</span>' /*<span class="required-star">*</span></label>'*/ +
'<input id="email-address" name="email-address" class="email required" type="email" placeholder="someone@website.com"></input>' +
'</div>' +
'' +
'</div>' +
'    ' +
'    ' +
'    <div class="text-center">' +
'      <input class="btn btn-submit btn" type="submit" style="font-size: 18px;" value="Sign up"/>' +
'    </div>' +
'  </form>' +
'</div>' +
'' +
'' +  '';var successHtml228352 = '<div class=\'donation-success\'>' +
                                                       '  <h2>Thank you for Registering!</h2>' +
                                                       '  <p>Your email address has been added to our mailing list.</p>' +
                                                        '   ' +
                                                        '</div>';( function($) {if (!Bloomerang.useEmailId('228352')) {
                                    html228352 = '<p style="color: red">Only one email sign-up form can be used on each page.</p>';
                                }if (jQuery('#bloomerangForm228352').length) {

                        jQuery('#bloomerangForm228352').after(html228352);

                    };
                    if (Bloomerang.emailSignupFormLoaded) {
                                            return false;
                                        }
                                        Bloomerang.emailSignupFormLoaded = true;
                     jQuery('.email-registration-form .section.captcha').attr('style', 'display: none');

                    Bloomerang.useKey('pub_318e7c35-a482-11e7-afbe-024e165d44b3');

        // Register proper callbacks for various stages/outcomes of submission
        Bloomerang.Widget.Email.OnSubmit = function (args) {
            jQuery(".btn-submit-email").val("Registering...").prop("disabled", true).addClass("disabled");
            var val = function (selector) { return jQuery(selector).val(); };
            Bloomerang.Account
                    .individual()
                    .firstName(val(".email-registration-form #first-name"))
                    .lastName(val(".email-registration-form #last-name"))
                    .homeEmail(val(".email-registration-form #email-address"))
                    .applyEmailSignupCustomFields();

           Bloomerang.Interaction.applyEmailSignupCustomFields();
        };
        Bloomerang.ValidateEmailSignupFormCaptcha = function() {
            if (typeof(grecaptcha) !== "undefined" && jQuery("#captcha" + Bloomerang.Data.WidgetIds.EmailSignup).children().length) {
                var captchaResponse = grecaptcha.getResponse(jQuery(".email-registration-form").data("captcha-id"));
                if (captchaResponse) {
                    jQuery(".email-registration-form .noCaptchaResponseError").hide();
                    Bloomerang.captchaResponse(captchaResponse);
                    return true;
                } else {
                    jQuery(".email-registration-form .noCaptchaResponseError").show();
                    return false;
                }
            } else return true;
        };
        Bloomerang.Api.OnSuccess = Bloomerang.Widget.Email.OnSuccess = function (response) {
            jQuery("#email-registration-form-container").html(successHtml228352);
            var distance = 100;
            var offset = jQuery("#email-registration-form-container").offset().top;
            var offsetTop = offset > distance ? offset - distance : offset;
		        jQuery('html, body').animate({ scrollTop : offsetTop}, 500);
        };
        Bloomerang.Api.OnError = Bloomerang.Widget.Email.OnError = function (response) {
            jQuery(".btn-submit-email").val("Register").prop("disabled", false).removeClass("disabled");
            jQuery("#email-registration-form-container .errors").removeClass("hidden").html(response.Message);
            var distance = 100;
            var offset = jQuery("#email-registration-form-container .errors").offset().top;
            var offsetTop = offset > distance ? offset - distance : offset;
		        jQuery('html, body').animate({ scrollTop : offsetTop}, 500);
            if (typeof(grecaptcha) !== "undefined" && jQuery("#captcha" + Bloomerang.Data.WidgetIds.EmailSignup).children().length) {
              grecaptcha.reset(jQuery(".email-registration-form").data("captcha-id"));
            }
        };

        Bloomerang.Util.applyEmailSignupCustomFields = function (obj, type) {

            // Clear any fields from a previous failed submission
            obj.clearCustomFields();

            // Apply all <input> (not multiselect), <select> and <textarea> fields
            jQuery(".email-registration-form .section.custom-fields :input:not(a > input, select)[id*=" + type + "]").each(function() {
                if (jQuery(this).val().hasValue()) {
                    obj.customFreeformField(jQuery(this).attr("id").toUntypedValue(), jQuery(this).val());
                }
            });

            // Apply all <select> fields
            jQuery(".email-registration-form .section.custom-fields select[id*=" + type + "]").each(function() {
                if (jQuery(this).val().hasValue()) {
                    obj.customPickField(jQuery(this).attr("id").toUntypedValue(), jQuery(this).val());
                }
            });

            // Apply all multiselect fields
            jQuery(".email-registration-form .section.custom-fields .checkboxes[id*=" + type + "]").each(function() {
                obj.customPickField(jQuery(this).attr("id").toUntypedValue(),
                jQuery.map(jQuery(this).children(".checkbox.selected"), function(v) { return jQuery(v).attr("data-id"); }));
            });
        };

        String.prototype.hasValue = function() {
            return (this && jQuery.trim(this)); //IE8 doesn't have a native trim function
        };

        Bloomerang.Account.applyEmailSignupCustomFields = function () {
            Bloomerang.Util.applyEmailSignupCustomFields(this, "Account");
            return this;
        };

        Bloomerang.Interaction.applyEmailSignupCustomFields = function () {
            Bloomerang.Util.applyEmailSignupCustomFields(this, "Interaction");
            return this;
        };

        String.prototype.toUntypedValue = function() {
            return this.substring(this.indexOf('_') + 1);
        };

        jQuery.validator.addMethod("currency", function (value, element, options) {
            return !value ||
                value
                  .replace("$", "")
                  .replace(".", "")
                  .split(",").join("")
                  .match(/^\d+$/g);
        }, "Not a valid currency");

        jQuery.validator.classRuleSettings.currency = { currency: true };

        jQuery.validator.addMethod("number", function (value, element, options) {
            return !value ||
                value
                  .replace(".", "")
                  .split(",").join("")
                  .match(/^\d+$/g);
        }, "Not a valid number");

        jQuery.validator.classRuleSettings.number = { number: true };

        jQuery.validator.addMethod("validYear", function (value, element, options) {
            try {
                return (!value || value.match(/^[1-9]\d\d\d$/)) ? true : false;
            }
            catch (e) {
                return false;
            }
        }, function () { return "Must be a 4 digit year"; });

        jQuery.validator.classRuleSettings.validYear = { validYear: true };

        // Intercept form submission to validate then submit via API
        jQuery("#email-registration-form-container form").validate({
            submitHandler: function () {
                if (!Bloomerang.ValidateEmailSignupFormCaptcha()) {
                  return false;
                }

                // Restore proper callbacks in case there are multiple widgets on the page
                Bloomerang.Api.OnSubmit = Bloomerang.Widget.Email.OnSubmit;
                Bloomerang.Api.OnSuccess = Bloomerang.Widget.Email.OnSuccess;
                Bloomerang.Api.OnError = Bloomerang.Widget.Email.OnError;
                Bloomerang.Api.joinMailingList();
            }
        });

})(jQuery);
    };

                var startBloomerangLoad = function() {
                    if (window.bloomerangLoadStarted == undefined) {
                        window.bloomerangLoadStarted = true;
                        var script = document.createElement('script');
                        script.type = 'text/javascript';
                        script.src = 'https://crm.bloomerang.co/Content/Scripts/Api/Bloomerang-v2.js?nocache=2017-10-17';
                        document.getElementsByTagName('head')[0].appendChild(script);
                        waitForBloomerangLoad(function() { Bloomerang.Util.requireJQueryValidation(function() { insertForm228352(); })});
                    }
                    else {
                        waitForBloomerangLoad(function() { Bloomerang.Util.requireJQueryValidation(function() { insertForm228352(); })});
                    }
                };

                var waitForBloomerangLoad = function(callback) {
                    if (typeof(Bloomerang) === 'undefined' || !Bloomerang._isReady) {
                        setTimeout(function () { waitForBloomerangLoad(callback) }, 500);
                    }
                    else {
                        if (true) {
                            callback();
                        } else {
                            window.bloomerangLoadStarted = undefined;
                            Bloomerang = undefined; // The version of Blomerang.js is not what we want. So blow it away and reload.
                            startBloomerangLoad();
                        }
                    }
                };

                startBloomerangLoad();
</script>

            </div>
        </div>
    </div>
    <div class="container-fluid container-dark">
        <div class="row footer-sidebar">
            <div class="col-6 col-lg-3">
                <div class="row">
                    <?php dynamic_sidebar('sidebar-footer-init'); ?>
                </div>
            </div>
            <div class="col-6 col-lg-9">
                <div class="row">
                    <?php dynamic_sidebar('sidebar-footer'); ?>
                </div>
            </div>
        </div>
        <div class="row footer-social">
            <div class="col-xl-9 offset-xl-3">
                <span>CONNECT WITH US</span>
                <?= do_shortcode('[social_icons]'); ?>
            </div>
        </div>
        <hr>
        <div class="row footer-copyright">
            <div class="col-">
                <p>&copy;<?= date('Y'); ?> Girls Inc. 120 Wall Street, New York, NY 10005-39021 ∙ <a href="mailto:communications@girlsinc.org">communications@girlsinc.org</a></p>
            </div>
        </div>
    </div>
</footer>
