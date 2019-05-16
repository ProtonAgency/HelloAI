<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1" />
    <meta name="author" content="Hello Software" />
    <meta name="description" content="Simple AI platform" />
    <meta name="keywords" content="helloai, ai" />
    <title>HelloAI</title>
    <link rel="stylesheet" href="/css/swiper.css">
    <link rel="stylesheet" href="/style.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,900" rel="stylesheet">

    <link rel="icon" type="image/png" href="/logo.png" />

    <style type="text/css">
        .grid__client-logo {
            -webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */
            filter: grayscale(100%);  
        }

        .grid__client-logo:hover {
            -webkit-filter: grayscale(0%); /* Safari 6.0 - 9.0 */
            filter: grayscale(0%); 
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header__content header__content--fix-width">
            <div class="header__logo-title">
                HelloAI
            </div>
            <nav class="header__menu">
                <ul>
                    <li><a class="selected header-link" href="#intro">HOME</a></li>
                    <li><a href="#features" class="header-link">FEATURES</a></li>
                    <li><a href="#pricing" class="header-link">PRICING</a></li>
                    <li><a href="#support" class="header-link">CONTACT</a></li>
                    <li class="header__btn header__btn--login"><a href="{{ route('login') }}">LOGIN</a></li>
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
                    <div class="intro__subtitle">A simple yet powerful cloud based AI platform.</div>
                    <div class="intro__buttons intro__buttons--centered">
                        <a href="#hiw" class="btn btn--blue-bg">SEE HOW IT WORKS</a>
                        <a href="{{ route('register') }}" class="btn btn--green-bg">START NOW</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section -- intro animation -->
    <section class="section section--intro-animation">
        <div class="section__content section__content--fix-width">
            <div class="intro-animation" data-paroller-factor="0.4" data-paroller-type="foreground" data-paroller-direction="vertical">
                <!-- <div class="animation__play modal-toggle" data-openpopup="animation"><span></span></div> -->
                <!-- <img src="images/intro-animation.png" alt="" title=""/> -->
            </div>
        </div>
<!--         <svg class="svg-intro-animation" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0,70 Q50,50 100,70 L100,100 0,100 Z" fill="#f7f8f9"/>
        </svg> -->
    </section>
    <!-- Section -- features -->
    <section class="section section--features" id="features">
        <div class="section__content section__content--fluid-width section__content--padding">
            <div class="grid grid--4col grid--features">
                <div class="grid__item">
                    <div class="grid__icon"><img src="images/icons/icons-64/tabs-64.png" alt="" title=""/></div>
                    <h3 class="grid__title"><span>Simple</span></h3>
                    <p class="grid__text">You can build and train your first model in minutes. HelloAI is perfect for both big and small AI projects.</p>
                </div>
                <div class="grid__item">
                    <div class="grid__icon"><img src="images/icons/icons-64/meter-64.png" alt="" title=""/></div>
                    <h3 class="grid__title"><span>Powerful</span></h3>
                    <p class="grid__text">HelloAI is built on of a very powerful cloud network made up of micro-containers all over the world to ensure your model is always online.</p>
                </div>
                <div class="grid__item">
                    <div class="grid__icon"><img src="images/icons/icons-64/security-64.png" alt="" title=""/></div>
                    <h3 class="grid__title"><span>Secure</span></h3>
                    <p class="grid__text">All of your information and datasets are encrypted allowing you to train advanced AI models with real data.</p>
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
                You can get started with these code snippets or you can view our <a href="/docs">documentation</a>.
            </div>
            <div class="hiw">
                <div class="hiw-titles">
                    <div class="hiw-titles__wrapper swiper-wrapper">
                        <div class="hiw-titles__slide swiper-slide">
                            <span>Create a Model</span>
                        </div>
                        <div class="hiw-titles__slide swiper-slide">
                            <span>Train a Model</span>
                        </div>
                        <div class="hiw-titles__slide swiper-slide">
                            <span>Predict against a Model</span>
                        </div>
                    </div>
                </div>
                <div class="hiw-content">
                    <div class="hiw-content__wrapper swiper-wrapper">
                        <div class="hiw-content__slide swiper-slide">
<pre>
// ....

//$token = ...;
$client->post('https://ai.hellosoftware.co/api/v1/models/new', [
    'form_params' => [
        'name' => 'my model', //model name
        'type' => 'text_analysis', //no other type is supported right now
    ],
    'headers' => [
        'Authorization' => 'Bearer ' . $token,
    ],
]);
</pre>
                        </div>
                        <div class="hiw-content__slide swiper-slide">
<pre>
// ....

//$token = ...;
//$identifier = ...;
$client->post('https://ai.hellosoftware.co/api/v1/models/' . $identifier . '/train', [
    'form_params' => [
        'dataset' => [
            [
                "sample spam string", //string
                "spam", //label
            ],
            [
                "is this a spam string?", //string
                "not spam", //label
            ],
        ],
    ],
    'headers' => [
        'Authorization' => 'Bearer ' . $token,
    ],
]);
</pre>
                        </div>
                        <div class="hiw-content__slide swiper-slide">
<pre>
// ....

//$token = ...;
//$identifier = ...;
$client->post('https://ai.hellosoftware.co/api/v1/models/' . $identifier . '/train', [
    'form_params' => [
        'dataset' => ['Is this a spam string?'], // pass in an array because helloai allows multiple predictions at once
    ],
    'headers' => [
        'Authorization' => 'Bearer ' . $token,
    ],
]);
</pre>
                        </div>
                    </div>
                </div>
                <div class="hiw-buttons">
                    <a class="btn btn--green-bg" href="/docs">GET THE CODE</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Section -- pricing -->
    <section class="section" id="pricing">
        <div class="section__content section__content--fix-width section__content--padding">
            <h2 class="section__title section__title--centered">Our Plans</h2>
            <div class="section__description section__description--centered">
                Just like our platform our pricing plans were designed to fit any project within any budget! Need something bigger? <a href="mailto:sales@lynndigital.com">contact sales</a>.
            </div>
            <div class="pricing">
                <div class="pricing__switcher switcher">
                    <div class="switcher__buttons">
                        <div class="switcher__button switcher__button--enabled">Monthly</div>
                        <div class="switcher__border"></div>
                    </div>
                </div>
                <div class="pricing__plan">
                    <h3 class="pricing__title">FREE</h3>
                    <div class="pricing__values">
                        <div class="pricing__value pricing__value--show"><span>$</span>0 <b>/ month</b></div>
                    </div>
                    <ul class="pricing__list">
                        <li><b>1</b> AI Model</li>
                        <li><b>500s</b> Training Time</li>
                        <li><b>5MB</b> Storage Space</li>
                    </ul>
                    <a class="pricing__signup" href="{{ route('register', ['plan' => 'free']) }}">Sign up</a>
                </div>
                <div class="pricing__plan--popular">
                    <div class="pricing__badge-bg"></div>
                    <div class="pricing__badge-text">POPULAR</div>
                    <h3 class="pricing__title">STARTER</h3>
                    <div class="pricing__values">
                        <div class="pricing__value pricing__value--show"><span>$</span>14 <b>/ month</b></div>
                    </div>
                    <ul class="pricing__list">
                        <li><b>5</b> AI Model</li>
                        <li><b>5000s</b> Training Time/ model</li>
                        <li><b>1GB</b> Storage Space</li>
                    </ul>
                    <a class="pricing__signup" href="{{ route('register', ['plan' => 'starter']) }}">Sign up</a> 
                </div>
                <div class="pricing__plan">
                    <h3 class="pricing__title">PRO</h3>
                    <div class="pricing__values">
                        <div class="pricing__value pricing__value--show"><span>$</span>49 <b>/ month</b></div>
                    </div>
                    <ul class="pricing__list">
                        <li><b>Unlimited</b> AI Model</li>
                        <li><b>Unlimited</b> Training Time</li>
                        <li><b>10GB</b> Storage Space</li>
                    </ul>
                    <a class="pricing__signup" href="{{ route('register', ['plan' => 'starter']) }}">Sign up</a>
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
                        <div class="testimonials__thumb" data-swiper-parallax="-50%"><img src="/images/avatar-1.jpg" alt="" title=""/></div>
                        <div class="testimonials__text" data-swiper-parallax="-100%">
                            <p>"I created HelloAI because I have a passion for machine learning but I had a very difficult time finding beginner resources when I was learning, and I couldn't maintain or afford the infastructure these big AI platforms use."</p>
                        </div>
                        <div class="testimonials__source">Jake Casto <a href="https://lynndigital.com">Lynn Digital LLC</a></div>
                    </div>
                </div>
                <div class="testimonials__pagination swiper-pagination"></div>
            </div>
            <div class="clear"></div>
        </div>
    </section>
    <!-- Section -->
<!--     <section class="section section--clients" id="clients">
        <div class="section__content section__content--fix-width">
            <div class="grid grid--5col">
                <div class="grid__item">
                    <div class="grid__client-logo"><a href="https://1mb.site"><img src="/images/clients/logo-1.png" alt="1mbsite" title=""/></a></div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- Section -->
    <section class="section section--cta" id="cta">
        <div class="section__content section__content--fix-width section__content--padding">
            <h2 class="section__title section__title--centered section__title--cta">Get Started Now!</h2>
            <div class="section__description section__description--centered section__description--cta">
                We believe we have created one of the simplest cloud based AI platforms there is! We'd love to help you build something great or make your existing project even cooler with AI.
            </div>
            <div class="intro__buttons intro__buttons--centered">
                <a href="{{ route('register') }}" class="btn btn--green-bg">CREATE AN ACCOUNT</a>
            </div>
        </div>
    </section>
    <footer class="footer" id="footer">
        <div class="footer__content footer__content--fix-width footer__content--padding">
            <div class="grid grid--5col">
                <div class="grid__item grid__item--x2">
                    <h3 class="grid__title grid__title--footer-logo">
                        HelloAI
                    </h3>
                    <p class="grid__text grid__text--copyright">Copyright &copy; 2019 HelloAI a product of <a href="https://lynndigital.com">Lynn Digital LLC & HelloSoftware</a>. All Rights Reserved. Proudly made in the US</p>
                    <ul class="grid__list grid__list--sicons">
                        <li><a href="https://twitter.com/hellosoftwareai"><img src="images/social/black/twitter.png" alt="" title=""/></a></li>
                    </ul>
                </div>
                <div class="grid__item">
                    <h3 class="grid__title grid__title--footer">Legal</h3>
                    <ul class="grid__list grid__list--fmenu">
                        <li><a href="https://lynndigital.com">Company</a></li>
                    </ul>
                </div>
                <div class="grid__item">
                    <h3 class="grid__title grid__title--footer">Links</h3>
                    <ul class="grid__list grid__list--fmenu">
                        <li><a href="#">Integrations</a></li>
                        <li><a href="#">API</a></li>
                        <li><a href="#">Pricing</a></li>
                        <li><a href="/docs">Documentation</a></li>
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