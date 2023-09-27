<!-- Footer Section -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-2">
                <div class="footer_logo">
                    <img src="images/footer_logo.svg">
                </div>
                <h4>Download app</h4>
                <div class="ap_download">
                    <a href="<?php echo get_settings_by_key('app_android_link'); ?>"><img
                            src="images/ap_icons-01.svg"></a>
                    <a href="<?php echo get_settings_by_key('app_ios_link_app_store'); ?>"><img
                            src="images/ap_icons-02.svg"></a>
                </div>
            </div>
            <div class="col-sm-3">
                <h4>Meet us</h4>
                <p>
                    Kundanoor, Maradu,
                    Ernakulam - Kerala
                    682304
                </p>
                <p>
                    NH-66, Thondayad bypass,
                    Opp-LandMark World,
                    Kozhikode - Kerala
                    673014
                </p>
                <p>
                    Calicut Rd - Machingal
                    Malappuram - Kerala
                    676517
                </p>
            </div>
            <div class="col-sm-2">
                <h4>Call us</h4>
                <p>(+91) 81299 09090
                    <!-- (+91) 85930 19090 <br> -->
                </p>
                <h4>Write to us</h4>
                <a href="mailto:crm@royaldrive.in">crm@royaldrive.in</a>
            </div>
            <div class="col-sm-2">
                <h4>Explore us</h4>
                <ul>
                    <li><a href="javascript:;">Brands</a></li>
                    <li><a href="<?php echo site_url('aboutus');?>">About</a></li>
                    <!-- <li><a href="<?php //echo site_url('testimonials');?>">Testimonials</a></li> -->
                    <li><a href="<?php echo site_url('contactus');?>">Contacts</a></li>
                </ul>
                <ul>
                    <li><a href="<?php echo site_url('career');?>">Careers</a></li>
                    <li><a href="<?php echo site_url('blog');?>">Blog</a></li>
                    <li><a href="<?php echo site_url('privacy-policy'); ?>">Privacy Policy</a></li>
                </ul>

            </div>
            <div class="col-sm-3 ">
                <div class="top_nav">
                    <h4>Connect with us</h4>
                    <div class="socia_icons">
                        <a class="social" href="https://www.facebook.com/royaldrivellp" target="_blank">
                            <i class="fa fa-facebook fa-2x">
                            </i>
                        </a>
                        <!-- <a class="social" href="https://twitter.com/DrivePre?s=08" target="_blank">
                                   <i class="fa fa-twitter fa-2x">
                                   </i>
                              </a> -->
                        <a class="social" href="https://www.instagram.com/royaldrivellp" target="_blank">
                            <i class="fa fa-instagram fa-2x">
                            </i>
                        </a>
                        <a class="social" href="https://api.whatsapp.com/send?phone=919539069090" target="_blank">
                            <i class="fa fa-whatsapp fa-2x">
                            </i>
                        </a>
                        <a class="social" href="https://www.youtube.com/channel/UCVxYCu-mOfV3fkBRQjOS0yw"
                            target="_blank">
                            <i class="fa fa-youtube-play fa-2x">
                            </i>
                        </a>
                    </div>
                    <h4>Subscribe Us</h4>
                    <div class="subscribe">
                        <input type="text" class="form-control" placeholder="Email Address">
                        <a href="javascript:;"><img src="images/subscribe_btn.png"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<section class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <ul class="list-inline">
                    <li>Copyright @ 2021 www.royaldrive.in</li>
                    <!--<li><a href="javascript:;">Terms of use</a></li>-->
                    <li><a href="<?php echo site_url('privacy-policy'); ?>">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <ul class="list-inline last">
                    <!-- <li>Powerd by <a href="http://vestletech.com/" class="designed">Vestle Tech</a></li>-->
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- footer Section End -->

<!--[if lt IE 9]>
     <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- footer Section End -->

<!-- jQuery Load -->
<!--<script  src="scripts/jquery-3.3.1.min.js"></script>-->

<!-- Sumo select -->
<script src="scripts/jquery.sumoselect.js"></script>
<link href="styles/sumoselect.min.css" rel="stylesheet" />
<script type="text/javascript">
$(document).ready(function() {
    $('.SlectBox').SumoSelect({
        csvDispCount: 3
    });
});
</script>
<!-- Sumo select -->

<!-- Bootstrap JS -->
<script src="scripts/bootstrap.min.js"></script>
<!-- owlCarousel JS -->
<script type="text/javascript" src="html5gallery/html5gallery.js"></script>
<script src="scripts/owl.carousel.js"></script>
<script>
$(document).ready(function() {

    var owl = $(".owl-carousel");
    owl.owlCarousel({
        navigation: true,
        singleItem: true,
        transitionStyle: "fade"
    });

    //Select Transtion Type
    $("#transitionType").change(function() {
        var newValue = $(this).val();

        //TransitionTypes is owlCarousel inner method.
        owl.data("owlCarousel").transitionTypes(newValue);

        //After change type go to next slide
        owl.trigger("owl.next");
    });
});
$("#brand_logos").owlCarousel({
    loop: true,
    slideSpeed: 300,
    autoPlay: 1000,
    items: 8,
    stopOnHover: true,
    autoWidth: true,
    itemsDesktop: [1199, 6],
    itemsDesktopSmall: [979, 4],
    itemsTablet: [768, 4]
});
</script>

<!--WOW Scroll Spy-->
<script src="scripts/wow.js"></script>

<!-- All JS plugin Triggers -->
<!-- <script src="scripts/main.js"></script> -->
<script src="scripts/my.script.js" type="text/javascript"></script>
<script src="scripts/jquery.validate.min.js"></script>

<!-- JQUERY STEP -->
<script src="fwizard/js/jquery.steps.js"></script>
<script src="fwizard/js/main.js"></script>

<script>
$(function() {
    $("#frmLogin").validate({
        rules: {
            username: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 8
            }
        },
        // Specify the validation error messages
        messages: {
            email: {
                required: "Please enter username",
                email: "Please enter valid email"
            },
            password: {
                required: "please enter password",
                minlength: "Please enter at least 8 characters"
            }
        }
    });

    $("#frmForgotPassword").validate({
        // Specify the validation rules
        rules: {
            email: {
                required: true,
                email: true
            }
        },
        // Specify the validation error messages
        messages: {
            email: {
                required: "Please enter email",
                email: "Please enter valid email"
            }
        },
        submitHandler: function(form) {
            $('.btnForgetPass').val('Please wait...');
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('user/doForgotPassword');?>",
                data: $(form).serialize(),
                dataType: "json",
                success: function(res) {
                    $('.btnForgetPass').val('SUBMIT');
                    messageBox(res);
                    $(form)[0].reset();
                }
            });
        }
    });
    $("#frmRegister").validate({
        // Specify the validation rules
        rules: {
            email: {
                required: true,
                email: true,
                remote: {
                    url: site_url + 'user/userAlreadyRegistered',
                    type: "post"
                }
            },
            phone: {
                required: true,
                number: true
            },
            password: {
                required: true,
                minlength: 8
            },
            password_confirmation: {
                equalTo: "#regPassword"
            }
        },
        // Specify the validation error messages
        messages: {
            email: {
                required: "Please enter email",
                email: "Please enter valid email",
                remote: "User already registered"
            },
            phone: {
                required: "Please enter phone number",
                number: "Please enter valid phone number"
            }
        }
    });
    $(".frmReferFriend").validate({
        // Specify the validation rules
        rules: {
            ref_first_name: {
                required: true
            },
            ref_email: {
                email: true
            },
            ref_mobile: {
                required: true,
                number: true
            },
            ref_frnd_first_name: {
                required: true
            },
            ref_frnd_mobile: {
                required: true,
                number: true
            },
            ref_frnd_email: {
                required: true,
                email: true
            }
        },
        // Specify the validation error messages
        messages: {
            email: {
                required: "Please enter email",
                email: "Please enter valid email",
                remote: "User already registered"
            },
            phone: {
                required: "Please enter phone number",
                number: "Please enter valid phone number"
            }
        }
    });
    $("#frmPostYourCar").validate({
        rules: {
            'basicinfo[prd_brand]': "required",
            'basicinfo[prd_name]': "required",
            'basicinfo[prd_price]': {
                number: true,
                required: true
            },
            'basicinfo[prd_engine_cc]': {
                number: true
                //  required: true
            },
            'basicinfo[prd_mileage]': {
                number: true
                // required: true
            },
            'basicinfo[prd_km_run]': {
                number: true,
                required: true
            },
            'basicinfo[prd_fual]': "required",
            'basicinfo[prd_model]': "required",
            /* 'basicinfo[prd_variant]' : "required",*/
            chkTerms: "required"
        },
        // Specify the validation error messages
        messages: {
            'basicinfo[prd_brand]': "Please select brand",
            'basicinfo[prd_name]': "Please enter vehicle name",
            'basicinfo[prd_price]': {
                number: "Please enter number",
                required: "Please enter price"
            },
            'basicinfo[prd_engine_cc]': {
                number: "Please enter number",
                required: "Please enter engine cc"
            },
            'basicinfo[prd_mileage]': {
                number: "Please enter number",
                required: "Please enter mileage"
            },
            'basicinfo[prd_km_run]': {
                number: "Please enter number",
                required: "Please enter kms run"
            },
            'basicinfo[prd_fual]': "Please select fule type",
            'basicinfo[prd_model]': "Select model",
            /* 'basicinfo[prd_variant]' : "Select variant",*/
            chkTerms: "Please accept terms and Conditions"
        },
        submitHandler: function(form) {
            if ($('.divSectionVehicle').length <= 0) {
                alert('Please upload atleast one image of your vehicle');
                $('html, body').stop().animate({
                    scrollTop: $('#upload_section').offset().top + 600
                }, 400);
                return false;
            } else if ($('.chkTerms').prop("checked") == false) {
                alert('Please tick agree checkbox before submit form');
                $('#chkTerms').focus();
                return false;
            }
            $(form).ajaxSubmit();
        }
    });
    $("#frmContactus").validate({
        rules: {
            fname: "required",
            email: {
                required: true,
                email: true
            },
            mobile: {
                number: true
            },
            captcha: "required"
        },
        // Specify the validation error messages
        messages: {
            fname: "Please enter name",
            email: {
                required: "Please enter username",
                email: "Please enter valid email"
            },
            mobile: {
                number: "Please enter valid mobile"
            },
            captcha: "Please enter captcha"
        },
        submitHandler: function(form) {
            $('.btnSubmit').html('Please wait...');
            $.ajax({
                type: "POST",
                url: site_url + "contactus/sendContact",
                data: $(form).serialize(),
                dataType: "json",
                success: function(res) {
                    messageBox(res);
                    $('.msgContactus').html(res.msg);
                    if (res.status == 'success') {
                        $(form)[0].reset();
                        $('.btnSubmit').html('send');
                    }
                }
            });
        }
    });

    $('.frmCareers').each(function() {
        $(this).validate({
            rules: {
                cap_fname: "required",
                cap_email: {
                    required: true,
                    email: true
                },
                cap_mobile: {
                    number: true
                },
                attachment: {
                    required: true
                },
                cap_district: {
                    required: true
                }
            },
            // Specify the validation error messages
            messages: {
                cap_fname: "Please enter name",
                cap_email: {
                    required: "Please enter username",
                    email: "Please enter valid email"
                },
                cap_mobile: {
                    number: "Please enter valid mobile"
                },
                attachment: {
                    required: "Please upload .pdf,.doc,.docx files"
                },
                cap_district: {
                    required: "Please select district"
                }
            },
            submitHandler: function(form) {
                $(".frmCareers").validate();
                $('.btnSubmit').html('Please wait...');
                var formData = new FormData(form);
                $.ajax({
                    type: "POST",
                    url: site_url + "career/sendCareer",
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        messageBox(res);
                        $('.msgContactus').html(res.msg);
                        if (res.status == 'success') {
                            $(form)[0].reset();
                            $('.btnSubmit').html('Submit');
                            $('.close').trigger('click');
                        }
                    }
                });
            }
        });
    });
    $('.frmCareers1').each(function() {
        $(this).validate({
            rules: {
                cap_fname: "required",
                cap_email: {
                    required: true,
                    email: true
                },
                cap_mobile: {
                    number: true
                },
                attachment: {
                    required: true
                },
                cap_district: {
                    required: "Please select district"
                }
            },
            // Specify the validation error messages
            messages: {
                cap_fname: "Please enter name",
                cap_email: {
                    required: "Please enter username",
                    email: "Please enter valid email"
                },
                cap_mobile: {
                    number: "Please enter valid mobile"
                },
                attachment: {
                    required: "Please upload .pdf,.doc,.docx files"
                },
                cap_district: {
                    required: "Please select district"
                }
            },
            submitHandler: function(form) {
                $(".frmCareers").validate();
                $('.btnSubmit').html('Please wait...');
                var formData = new FormData(form);
                $.ajax({
                    type: "POST",
                    url: site_url + "careerback/sendCareer",
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        //messageBox(res);
                        $('.msgContactus').html(res.msg);
                        if (res.status == 'success') {
                            //$(form)[0].reset();
                            //$('.btnSubmit').html('Submit');
                            //$('.close').trigger('click');
                        }
                    }
                });
            }
        });
    });
});
</script>
<!--CONTACT-->
<script>
$(function() {
    $('.aboutNave a').click(function() {
        //Toggle Class
        $(".active").removeClass("active");
        $(this).closest('li').addClass("active");
        var theClass = $(this).attr("class");
        $('.' + theClass).parent('li').addClass('active');
        //Animate
        $('html, body').stop().animate({
            scrollTop: $('#' + $(this).attr('data-sec')).offset().top - 160
        }, 400);
        return false;
    });
    $('.scrollTop a').scrollTop();
});
</script>
<style>
span.error {
    color: red;
    font-size: 10px;
    display: none !important;
}

input.error {
    border: 1px solid red;
}

select.error {
    border: 1px solid red;
}

.error[for="attachment"] {
    display: block !important;
}
</style>

<!-- MATERIAL DESIGN ICONIC FONT -->
<link rel="stylesheet" href="fwizard/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
<!-- STYLE CSS -->
<link rel="stylesheet" href="fwizard/css/style.css">

<style>
.label-container {
    position: fixed;
    bottom: 48px;
    right: 105px;
    display: table;
    visibility: hidden;
}

.label-text {
    color: #FFF;
    background: rgba(51, 51, 51, 0.5);
    display: table-cell;
    vertical-align: middle;
    padding: 10px;
    border-radius: 3px;
}

.label-arrow {
    display: table-cell;
    vertical-align: middle;
    color: #333;
    opacity: 0.5;
}

.float {
    position: fixed;
    width: 60px;
    height: 60px;
    bottom: 40px;
    right: 40px;
    background-color: #ffcb05;
    color: #000;
    border-radius: 50px;
    text-align: center;
    box-shadow: 2px 2px 3px #999;
}

.my-float-icon {
    font-size: 24px;
    margin-top: 18px;
}

a.float+div.label-container {
    visibility: hidden;
    opacity: 0;
    transition: visibility 0s, opacity 0.5s ease;
}

a.float:hover+div.label-container {
    visibility: visible;
    opacity: 1;
}

.my-float-icon:hover {
    background-color: #000;
    color: #ffcb05;
}

.float:hover {
    background-color: #000;
    color: #ffcb05;
}
</style>

<a href="<?php echo site_url('sell-your-vehicle'); ?>" class="float">
    <i class="fa fa-car my-float-icon"></i>
</a>
<div class="label-container">
    <div class="label-text">Sell your vehicle</div>
    <i class="fa fa-play label-arrow"></i>
</div>

<script type="module">
// Import the functions you need from the SDKs you need
import {
    initializeApp
} from "https://www.gstatic.com/firebasejs/9.14.0/firebase-app.js";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
const firebaseConfig = {
    apiKey: "AIzaSyDLvyGrKPSR8dlGAjGMw_5Vt6PaCenMqoE",
    authDomain: "instant-keel-239508.firebaseapp.com",
    databaseURL: "https://instant-keel-239508.firebaseio.com",
    projectId: "instant-keel-239508",
    storageBucket: "instant-keel-239508.appspot.com",
    messagingSenderId: "475986271415",
    appId: "1:475986271415:web:1a6ea1a44b781b586fc132"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
</script>