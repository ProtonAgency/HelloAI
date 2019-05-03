<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1" />
    <meta name="author" content="SmartTemplates" />
    <meta name="description" content="landing page template for saas companies" />
    <meta name="keywords" content="landing page template, saas landing page template, saas website template, one page saas template" />
    <title>HelloAI</title>
    <link rel="stylesheet" href="css/swiper.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,900" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="header__content header__content--fix-width">
            <div class="header__logo-title">
                <img style="height: 40px; vertical-align: middle" src="images/logo.png"> HelloAI
            </div>
            <nav class="header__menu">
                <ul>
                    <li><a class="selected header-link" href="#intro">HOME</a></li>
                    <li class="menu-item-has-children">
                        <a href="#features" class="header-link">FEATURES</a>
                        <ul class="sub-menu">
                            <li><a href="#hiw" class="header-link">HOW IT WORKS</a></li>
                            <li><a href="#clients" class="header-link">OUR CLIENTS</a></li>
                            <li><a href="#testimonials" class="header-link">TESTIMONIALS</a></li>
                        </ul>
                    </li>
                    <li><a href="#pricing" class="header-link">PRICING</a></li>
                    <li><a href="#support" class="header-link">CONTACT</a></li>
                    <li class="header__btn header__btn--login modal-toggle" data-openpopup="signuplogin" data-popup="login"><a href="#">CLIENT LOGIN</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <!-- Section -- intro -->
    <section class="section section--intro" id="intro">
        <div class="section__content section__content--fix-width section__content--intro">
            <div class="intro">
                <div class="intro__content">
                    <div class="intro__title">Say Hello to <span>AI</span></div>
                    <div class="intro__subtitle">Landing page template for Software as a Service website</div>
                    <div class="intro__description">For as low as <span>$2.95</span> per design</div>
                    <div class="intro__buttons intro__buttons--centered">
                        <a href="index.html" class="btn btn--blue-bg">TRY DEMO</a>
                        <a href="index.html" class="btn btn--green-bg">START NOW</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section -- intro animation -->
    <section class="section section--intro-animation">
        <div class="section__content section__content--fix-width">
            <div class="intro-animation" data-paroller-factor="0.4" data-paroller-type="foreground" data-paroller-direction="vertical">
                <div class="animation__play modal-toggle" data-openpopup="animation"><span></span></div>
                <img src="images/intro-animation.png" alt="" title=""/>
            </div>
        </div>
        <svg class="svg-intro-animation" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0,70 Q50,50 100,70 L100,100 0,100 Z" fill="#f7f8f9"/>
        </svg>
    </section>
    <!-- Section -- features -->
    <section class="section section--features" id="features">
        <div class="section__content section__content--fluid-width section__content--padding">
            <div class="grid grid--4col grid--features">
                <div class="grid__item">
                    <div class="grid__icon"><img src="images/icons/icons-64/desktop-chart-64.png" alt="" title=""/></div>
                    <h3 class="grid__title">SaaS Landing Page <span>Analysis</span></h3>
                    <p class="grid__text">A perfect structure created after we analized trends in SaaS landing page designs. Analysis made to the most popular SaaS businesses.</p>
                </div>
                <div class="grid__item">
                    <div class="grid__icon"><img src="images/icons/icons-64/target-64.png" alt="" title=""/></div>
                    <h3 class="grid__title">Target <span>audience</span></h3>
                    <p class="grid__text">Blocks, Elements and Modifiers. A smart HTML/CSS structure that can easely be reused. Layout driven by the purpose of modularity.</p>
                </div>
                <div class="grid__item">
                    <div class="grid__icon"><img src="images/icons/icons-64/security-64.png" alt="" title=""/></div>
                    <h3 class="grid__title">Best online <span>Security</span></h3>
                    <p class="grid__text">A perfect structure created after we analized trends in SaaS landing page designs. Analysis made to the most popular SaaS businesses.</p>
                </div>
            </div>
        </div>
        <svg class="svg-features-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0,100 Q50,50 100,100 L0,100 Z" fill="#fff"/>
        </svg>
    </section>
    <!-- Section -- How it works -->
    <section class="section" id="hiw">
        <div class="section__content section__content--fix-width section__content--padding">
            <h2 class="section__title section__title--centered">Easy to use API</h2>
            <div class="section__description section__description--centered">
                Guide to setup and configuration. You can present below a guide and a description of how your system configuration works and add some animated screens.
            </div>
            <div class="hiw">
                <div class="hiw-titles">
                    <div class="hiw-titles__wrapper swiper-wrapper">
                        <div class="hiw-titles__slide swiper-slide">
                            <span>Initializing JS</span>
                        </div>
                        <div class="hiw-titles__slide swiper-slide">
                            <span>Configuration CSS</span>
                        </div>
                        <div class="hiw-titles__slide swiper-slide">
                            <span>Security Levels API</span>
                        </div>
                        <div class="hiw-titles__slide swiper-slide">
                            <span>Add Instances</span>
                        </div>
                        <div class="hiw-titles__slide swiper-slide">
                            <span>General API Settings</span>
                        </div>
                    </div>
                </div>
                <div class="hiw-content">
                    <div class="hiw-content__wrapper swiper-wrapper">
                        <div class="hiw-content__slide swiper-slide">
                            <pre>
    <strong>$('.modal-toggle').on('click', function(e) {</strong>
      e.preventDefault();
      var modalopen = $(this).data("openpopup");
      $('.modal--'+modalopen).toggleClass('modal--visible');
      var modaltype = $(this).data("popup");
      $('.modal__content--'+modaltype).toggleClass('modal__content--visible');
            $('.modal__switch').on('click', function(e) {
              $('.modal__content').removeClass('modal__content--visible');
              var modaltypeb = $(this).data("popup");
              $('.modal__content--'+modaltypeb).toggleClass('modal__content--visible');
            });
    });
                                            </pre>
                        </div>
                        <div class="hiw-content__slide swiper-slide">
                            <pre>
    <strong>.hiw-titles__slide{</strong>
         width: calc(100% / 5);
         cursor:pointer;
         padding:30px 0; 
         margin:0 0 -2px 0;
         text-align:center;
         opacity:.4;
         -webkit-transition: all 1s;
        -moz-transition: all 1s;
        transition: all 1s;
    }
                                            </pre>
                        </div>
                        <div class="hiw-content__slide swiper-slide">
                            <pre>
    <strong>$(".input__field").focus(function(){</strong>
        $(this).parent().addClass('input--filled');
    });

    <strong>$('.input__field').blur(function()</strong>
    {
        if( !$(this).val() ) {
              $(this).parent().removeClass('input--filled');
        }
    });
                                            </pre>
                        </div>
                        <div class="hiw-content__slide swiper-slide">
                            <pre>
    <strong>$('.modal-toggle').on('click', function(e) {</strong>
      e.preventDefault();
      var modalopen = $(this).data("openpopup");
      $('.modal--'+modalopen).toggleClass('modal--visible');
      var modaltype = $(this).data("popup");
      $('.modal__content--'+modaltype).toggleClass('modal__content--visible');
            $('.modal__switch').on('click', function(e) {
              $('.modal__content').removeClass('modal__content--visible');
              var modaltypeb = $(this).data("popup");
              $('.modal__content--'+modaltypeb).toggleClass('modal__content--visible');
            });
    });
                                            </pre>
                        </div>
                        <div class="hiw-content__slide swiper-slide">
                            <pre>
    <strong>.hiw-titles__slide{</strong>
         width: calc(100% / 5);
         cursor:pointer;
         padding:30px 0; 
         margin:0 0 -2px 0;
         text-align:center;
         opacity:.4;
         -webkit-transition: all 1s;
        -moz-transition: all 1s;
        transition: all 1s;
    }
                                            </pre>
                        </div>
                    </div>
                </div>
                <div class="hiw-buttons">
                    <button class="btn btn--green-bg">GET THE CODE</button>
                    <button class="btn btn--blue-bg">RUN EXAMPLE</button>
                </div>
            </div>
        </div>
    </section>
    <!-- Section -- pricing -->
    <section class="section" id="pricing">
        <div class="section__content section__content--fix-width section__content--padding">
            <h2 class="section__title section__title--centered">Our Plans</h2>
            <div class="section__description section__description--centered">
                We believe we have created the most efficient SaaS landing page for your users. Landing page with features that will convince you to use it for your SaaS business.
            </div>
            <div class="pricing">
                <div class="pricing__switcher switcher">
                    <div class="switcher__buttons">
                        <div class="switcher__button switcher__button--enabled">Monthly</div>
                        <div class="switcher__button">Yearly</div>
                        <div class="switcher__border"></div>
                    </div>
                </div>
                <div class="pricing__plan">
                    <h3 class="pricing__title">FREE</h3>
                    <div class="pricing__values">
                        <div class="pricing__value pricing__value--show"><span>$</span>0 <b>/ month</b></div>
                        <div class="pricing__value pricing__value--hide pricing__value--hidden"><span>$</span>0 <b>/ yearly</b></div>
                    </div>
                    <ul class="pricing__list">
                        <li><b>1</b> User Account</li>
                        <li><b>10</b> Team Members</li>
                        <li><b>Unlimited</b> Emails Accounts</li>
                        <li>Set And Manage Permissions</li>
                        <li class="disabled">API &amp; extension support</li>
                        <li class="disabled">Developer support</li>
                        <li class="disabled">A / B Testing</li>
                    </ul>
                    <a class="pricing__signup" href="">Sign up</a>
                </div>
                <div class="pricing__plan">
                    <h3 class="pricing__title">STARTUP</h3>
                    <div class="pricing__values">
                        <div class="pricing__value pricing__value--show"><span>$</span>29 <b>/ month</b></div>
                        <div class="pricing__value pricing__value--hide pricing__value--hidden"><span>$</span>320 <b>/ yearly</b></div>
                    </div>
                    <ul class="pricing__list">
                        <li><b>10</b> User Account</li>
                        <li><b>100</b> Team Members</li>
                        <li><b>Unlimited</b> Emails Accounts</li>
                        <li>Set And Manage Permissions</li>
                        <li>API &amp; extension support</li>
                        <li class="disabled">Developer support</li>
                        <li class="disabled">A / B Testing</li>
                    </ul>
                    <a class="pricing__signup" href="">Sign up</a> 
                </div>
                <div class="pricing__plan pricing__plan--popular">
                    <div class="pricing__badge-bg"></div>
                    <div class="pricing__badge-text">POPULAR</div>
                    <h3 class="pricing__title">PRO</h3>
                    <div class="pricing__values">
                        <div class="pricing__value pricing__value--show"><span>$</span>49 <b>/ month</b></div>
                        <div class="pricing__value pricing__value--hide pricing__value--hidden"><span>$</span>529 <b>/ yearly</b></div>
                    </div>
                    <ul class="pricing__list">
                        <li><b>50</b> User Account</li>
                        <li><b>500</b> Team Members</li>
                        <li><b>Unlimited</b> Emails Accounts</li>
                        <li>Set And Manage Permis sions</li>
                        <li>API &amp; extension support</li>
                        <li>Developer support</li>
                        <li class="disabled">A / B Testing</li>
                    </ul>
                    <a class="pricing__signup" href="">Sign up</a>
                </div>
                <div class="pricing__plan">
                    <h3 class="pricing__title">ULTRA</h3>
                    <div class="pricing__values">
                        <div class="pricing__value pricing__value--show"><span>$</span>99 <b>/ month</b></div>
                        <div class="pricing__value pricing__value--hide pricing__value--hidden"><span>$</span>900 <b>/ yearly</b></div>
                    </div>
                    <ul class="pricing__list">
                        <li><b>Unlimited</b> User Account</li>
                        <li><b>Unlimited</b> Team Members</li>
                        <li><b>Unlimited</b> Emails Accounts</li>
                        <li>Set And Manage Permissions</li>
                        <li>API &amp; extension support</li>
                        <li>Developer support</li>
                        <li>A / B Testing</li>
                    </ul>
                    <a class="pricing__signup" href="">Sign up</a>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </section>
    <!-- Section -- testimonials -->
    <section class="section section--testimonials" id="testimonials">
        <div class="section__content section__content--fix-width section__content--padding">
            <h2 class="section__title section__title--centered">Success stories</h2>
            <div class="testimonials">
                <div class="testimonials__content swiper-wrapper">
                    <div class="testimonials__slide swiper-slide">
                        <div class="testimonials__thumb" data-swiper-parallax="-50%"><img src="images/avatar-1.jpg" alt="" title=""/></div>
                        <div class="testimonials__text" data-swiper-parallax="-100%">
                            <p>"Business is all about the customer: what the customer wants and what they get. Generally, every customer wants a product or service that solves their problem, worth their money, and is delivered with amazing customer service"</p>
                        </div>
                        <div class="testimonials__source">Lason Duvan <a href="#">New York Business Center</a></div>
                    </div>
                    <div class="testimonials__slide swiper-slide">
                        <div class="testimonials__thumb" data-swiper-parallax="-50%"><img src="images/avatar-2.jpg" alt="" title=""/></div>
                        <div class="testimonials__text" data-swiper-parallax="-100%">
                            <p>"No one can make you successful; the will to success comes from within.' I've made this my motto. I've internalized it to the point of understanding that the success of my actions and/or endeavors doesn't depend on anyone else, and that includes a possible failure"</p>
                        </div>
                        <div class="testimonials__source">Jada Sacks <a href="#">Paris Tehnics</a></div>
                    </div>
                    <div class="testimonials__slide swiper-slide">
                        <div class="testimonials__thumb" data-swiper-parallax="-50%"><img src="images/avatar-3.jpg" alt="" title=""/></div>
                        <div class="testimonials__text" data-swiper-parallax="-100%">
                            <p>"The American Dream is that any man or woman, despite of his or her background, can change their circumstances and rise as high as they are willing to work"</p>
                        </div>
                        <div class="testimonials__source">Lason Duvan <a href="#">Music Software</a></div>
                    </div>
                    <div class="testimonials__slide swiper-slide">
                        <div class="testimonials__thumb" data-swiper-parallax="-50%"><img src="images/avatar-4.jpg" alt="" title=""/></div>
                        <div class="testimonials__text" data-swiper-parallax="-100%">
                            <p>"Business is all about the customer: what the customer wants and what they get. Generally, every customer wants a product or service that solves their problem, worth their money, and is delivered with amazing customer service"</p>
                        </div>
                        <div class="testimonials__source">Duran Jackson <a href="#">New York Business Center</a></div>
                    </div>
                    <div class="testimonials__slide swiper-slide">
                        <div class="testimonials__thumb" data-swiper-parallax="-50%"><img src="images/avatar-5.jpg" alt="" title=""/></div>
                        <div class="testimonials__text" data-swiper-parallax="-100%">
                            <p>"No one can make you successful; the will to success comes from within.' I've made this my motto. I've internalized it to the point of understanding that the success of my actions and/or endeavors doesn't depend on anyone else, and that includes a possible failure"</p>
                        </div>
                        <div class="testimonials__source">Maria Allesi <a href="#">Italy Solutions</a></div>
                    </div>
                    <div class="testimonials__slide swiper-slide">
                        <div class="testimonials__thumb" data-swiper-parallax="-50%"><img src="images/avatar-6.jpg" alt="" title=""/></div>
                        <div class="testimonials__text" data-swiper-parallax="-100%">
                            <p>"The American Dream is that any man or woman, despite of his or her background, can change their circumstances and rise as high as they are willing to work"</p>
                        </div>
                        <div class="testimonials__source">Jenifer Patrison<a href="#">App Dating</a></div>
                    </div>
                </div>
                <div class="testimonials__pagination swiper-pagination"></div>
            </div>
            <div class="clear"></div>
        </div>
    </section>
    <!-- Section -->
    <section class="section section--clients" id="clients">
        <div class="section__content section__content--fix-width">
            <div class="grid grid--5col">
                <div class="grid__item">
                    <div class="grid__client-logo"><a href="#"><img src="images/clients/clients-logo1.png" alt="" title=""/></a></div>
                </div>
                <div class="grid__item">
                    <div class="grid__client-logo"><a href="#"><img src="images/clients/clients-logo2.png" alt="" title=""/></a></div>
                </div>
                <div class="grid__item">
                    <div class="grid__client-logo"><a href="#"><img src="images/clients/clients-logo3.png" alt="" title=""/></a></div>
                </div>
                <div class="grid__item">
                    <div class="grid__client-logo"><a href="#"><img src="images/clients/clients-logo4.png" alt="" title=""/></a></div>
                </div>
                <div class="grid__item">
                    <div class="grid__client-logo"><a href="#"><img src="images/clients/clients-logo5.png" alt="" title=""/></a></div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section -->
    <section class="section section--cta" id="cta">
        <div class="section__content section__content--fix-width section__content--padding">
            <h2 class="section__title section__title--centered section__title--cta">Get Started Now!</h2>
            <div class="section__description section__description--centered section__description--cta">
                We believe we have created the most efficient SaaS landing page for your users. Landing page with features that will convince you to use it for your SaaS business.
            </div>
            <div class="intro__buttons intro__buttons--centered">
                <a href="index.html" class="btn btn--green-bg">CREATE AN ACCOUNT</a>
            </div>
        </div>
    </section>
    <footer class="footer" id="footer">
        <div class="footer__content footer__content--fix-width footer__content--padding">
            <div class="grid grid--5col">
                <div class="grid__item grid__item--x2">
                    <h3 class="grid__title grid__title--footer-logo">HelloAI</h3>
                    <p class="grid__text grid__text--copyright">Copyright &copy; 2019 HelloAI a product of <a href="https://lynndigital.com">Lynn Digital LLC</a> and <a href="https://hellosoftware.co">HelloSoftware</a>. All Rights Reserved. </p>
                    <ul class="grid__list grid__list--sicons">
                        <li><a href="https://twitter.com/hellosoftwareai"><img src="images/social/black/twitter.png" alt="" title=""/></a></li>
                    </ul>
                </div>
                <div class="grid__item">
                    <h3 class="grid__title grid__title--footer">Company</h3>
                    <ul class="grid__list grid__list--fmenu">
                        <li><a href="#">About</a></li>
                        <li><a href="#">Carrers</a></li>
                        <li><a href="#">Awards</a></li>
                        <li><a href="#">Users Program</a></li>
                        <li><a href="#">Locations</a></li>
                    </ul>
                </div>
                <div class="grid__item">
                    <h3 class="grid__title grid__title--footer">Products</h3>
                    <ul class="grid__list grid__list--fmenu">
                        <li><a href="#">Integrations</a></li>
                        <li><a href="#">API</a></li>
                        <li><a href="#">Pricing</a></li>
                        <li><a href="#">Documentation</a></li>
                        <li><a href="#">Release Notes</a></li>
                    </ul>
                </div>
                <div class="grid__item">
                    <h3 class="grid__title grid__title--footer">Support</h3>
                    <ul class="grid__list grid__list--fmenu">
                        <li><a href="mailto:ai@hellosupport.co">Contact</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <section class="modal modal--signuplogin">
        <div class="modal__overlay modal__overlay--toggle"></div>
        <div class="modal__wrapper modal-transition">
            <div class="modal__body">
                <div class="modal__content modal__content--login">
                    <div class="modal__info">
                        <h2 class="modal__title">First time here?</h2>
                        <div class="modal__descr">Join now and get <span>20% OFF</span> for all products</div>
                        <ul class="modal__list">
                            <li>premium access to all products</li>
                            <li>free testing tools</li>
                            <li>unlimited user accounts</li>
                        </ul>
                        <button class="modal__switch modal__switch--signup" data-popup="signup">Signup</button>
                    </div>
                    <div class="modal__form form">
                        <h2 class="form__title">Login</h2>
                        <form class="form__container" id="LoginForm" method="post" action="index.html">
                            <div class="form__row">
                                <label class="form__label" for="namec">Name</label>
                                <input name="namec" id="namec" class="form__input" type="text"/>
                                <span class="form__row-border"></span>
                            </div>
                            <div class="form__row">
                                <label class="form__label">Email</label>
                                <input name="emailc" class="form__input" type="text"/>  
                                <span class="form__row-border"></span>                                  
                            </div>
                            <div class="modal__checkbox"><input id="remember" name="remember" value="remember" checked type="checkbox"><label for="remember">Keep me Signed in</label></div>
                            <div class="modal__switch modal__switch--forgot" data-popup="forgot">Forgot Password?</div>
                            <input type="submit" name="submit" class="form__submit btn btn--green-bg" id="submitl" value="LOGIN" />
                        </form>
                    </div>
                </div>
                <!-- End Modal login -->
                <div class="modal__content modal__content--forgot">
                    <div class="modal__form form">
                        <h2 class="form__title">Forgot Password</h2>
                        <form class="form__container" id="ForgotForm" method="post" action="index.html">
                            <div class="form__row">
                                <label class="form__label">Email</label>
                                <input name="emailf" class="form__input" type="text"/>  
                                <span class="form__row-border"></span>                                  
                            </div>
                            <input type="submit" name="submit" class="form__submit btn btn--green-bg" id="submitf" value="RESET PASSWORD" />
                        </form>
                    </div>
                    <div class="modal__info">
                        <h2 class="modal__title">We got you covered</h2>
                        <div class="modal__descr">A new password will be sent by email. Remembered your password?</div>
                        <button class="modal__switch modal__switch--signup" data-popup="login">Login</button>
                    </div>
                </div>
                <!-- End Modal login -->
                <div class="modal__content modal__content--signup">
                    <div class="modal__form form">
                        <h2 class="form__title">Signup</h2>
                        <form class="form__container" id="SignupForm" method="post" action="index.html">
                            <div class="form__row">
                                <label class="form__label" for="names">Username</label>
                                <input name="namec" id="names" class="form__input" type="text"/>
                                <span class="form__row-border"></span>
                            </div>
                            <div class="form__row">
                                <label class="form__label">Email</label>
                                <input name="emails" class="form__input" type="text"/>  
                                <span class="form__row-border"></span>                                  
                            </div>
                            <div class="form__row">
                                <label class="form__label" for="pass">Password</label>
                                <input name="pass" id="pass" class="form__input" type="password"/>
                                <span class="form__row-border"></span>
                            </div>
                            <input type="submit" name="submit" class="form__submit btn btn--green-bg" id="submit" value="SIGNUP" />
                        </form>
                    </div>
                    <div class="modal__info">
                        <h2 class="modal__title">Allready have an account?</h2>
                        <div class="modal__descr">Login now and starting using our <span>amazing</span> products</div>
                        <ul class="modal__list">
                            <li>premium access to all products</li>
                            <li>free testing tools</li>
                            <li>unlimited user accounts</li>
                        </ul>
                        <button class="modal__switch modal__switch--login" data-popup="login">Login</button>
                    </div>
                </div>
                <!-- End Modal signup -->
            </div>
        </div>
    </section>
    <!-- Modal for Login and Signup -->
    <section class="modal modal--animation">
        <div class="modal__overlay modal__overlay--toggle"></div>
        <div class="modal__wrapper modal__wrapper--image modal-transition">
            <div class="modal__body">
                <button class="modal__close modal__overlay--toggle"><span></span></button>
                <div class="modal__header">How it works animation</div>
                <div class="modal__image">
                    <img src="images/intro-animation.gif" alt="" title=""/>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal for animation -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery.paroller.min.js"></script>
    <script src="js/jquery.custom.js"></script>
    <script src="js/swiper.min.js"></script>
    <script src="js/swiper.custom.js"></script>
    <script src="js/menu.js"></script>
</body>
</html>