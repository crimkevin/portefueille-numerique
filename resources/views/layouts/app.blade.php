<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en-us">

<head>
	<meta charset="utf-8">
	<title>Wallet - Payday Loan Service Template</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
	<meta name="description" content="This is meta description">
	<meta name="author" content="Themefisher">
	<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
	<link rel="icon" href="images/favicon.png" type="image/x-icon">

  <!-- theme meta -->
  <meta name="theme-name" content="wallet" />

	<!-- # Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">

	<!-- # CSS Plugins -->
	<link rel="stylesheet"  href="{{asset("plugins/slick/slick.css")}}">
	<link rel="stylesheet" href="{{asset('plugins/font-awesome/fontawesome.min.css')}}" >
	<link rel="stylesheet" href="{{asset('plugins/font-awesome/brands.css')}}">
	<link rel="stylesheet" href="{{asset('plugins/font-awesome/solid.css')}}" >

	<!-- # Main Style Sheet -->
	<link rel="stylesheet" href="{{asset('css/style.css')}}" >
</head>

<body>

<!-- navigation -->
<header class="navigation bg-tertiary">
	<nav class="navbar navbar-expand-xl navbar-light text-center py-3">
		<div class="container">
			<a class="navbar-brand" href="index.html">
				<img loading="prelaod" decoding="async" class="img-fluid" width="160" src="images/logo.png" alt="Wallet">
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mx-auto mb-2 mb-lg-0">
					<li class="nav-item"> <a class="nav-link" href="index.html">Home</a>
					</li>
					<li class="nav-item "> <a class="nav-link" href="about.html">About</a>
					</li>
					<li class="nav-item "> <a class="nav-link" href="how-it-works.html">How It Works</a>
					</li>
					<li class="nav-item "> <a class="nav-link" href="services.html">Services</a>
					</li>
                    <li class="nav-item "> <a class="nav-link" href="{{route('operation')}}">Operations</a>
					</li>
					<li class="nav-item "> <a class="nav-link" href="contact.html">Contact</a>
					</li>
					<li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Pages</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
							<li><a class="dropdown-item " href="blog.html">Blog</a>
							</li>
							<li><a class="dropdown-item " href="blog-details.html">Blog Details</a>
							</li>
							<li><a class="dropdown-item " href="service-details.html">Service Details</a>
							</li>
							<li><a class="dropdown-item " href="faq.html">FAQ&#39;s</a>
							</li>
							<li><a class="dropdown-item " href="legal.html">Legal</a>
							</li>
							<li><a class="dropdown-item " href="terms.html">Terms &amp; Condition</a>
							</li>
							<li><a class="dropdown-item " href="privacy-policy.html">Privacy &amp; Policy</a>
							</li>
						</ul>
					</li>
				</ul>
				<!-- account btn --> <a href="{{route('login')}}" class="btn btn-outline-primary">Log In</a>
				<!-- account btn --> <a href="{{route('register')}}" class="btn btn-primary ms-2 ms-lg-3">Sign Up</a>
			</div>
		</div>
	</nav>
</header>

<!-- /navigation -->
@yield('content')


<footer class="section-sm bg-tertiary">
	<div class="container">
		<div class="row justify-content-between">
			<div class="col-lg-2 col-md-4 col-6 mb-4">
				<div class="footer-widget">
					<h5 class="mb-4 text-primary font-secondary">Service</h5>
					<ul class="list-unstyled">
						<li class="mb-2"><a href="service-details.html">Personal loans</a>
						</li>
						<li class="mb-2"><a href="service-details.html">Home Equity Loans</a>
						</li>
						<li class="mb-2"><a href="service-details.html">Student Loans</a>
						</li>
						<li class="mb-2"><a href="service-details.html">Mortgage Loans</a>
						</li>
						<li class="mb-2"><a href="service-details.html">Payday Loans</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-2 col-md-4 col-6 mb-4">
				<div class="footer-widget">
					<h5 class="mb-4 text-primary font-secondary">About</h5>
					<ul class="list-unstyled">
						<li class="mb-2"><a href="#!">Benefits</a>
						</li>
						<li class="mb-2"><a href="#!">Careers</a>
						</li>
						<li class="mb-2"><a href="#!">Our Story</a>
						</li>
						<li class="mb-2"><a href="#!">Team</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-2 col-md-4 col-6 mb-4">
				<div class="footer-widget">
					<h5 class="mb-4 text-primary font-secondary">Help</h5>
					<ul class="list-unstyled">
						<li class="mb-2"><a href="contact.html">Contact Us</a>
						</li>
						<li class="mb-2"><a href="faq.html">FAQs</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-4 col-md-12 newsletter-form">
				<div style="background-color: #F4F4F4; padding: 35px;">
					<h5 class="mb-4 text-primary font-secondary">Subscribe</h5>
					<div class="pe-0 pe-xl-5">
						<form action="#!" method="post" name="mc-embedded-subscribe-form" target="_blank">
							<div class="input-group mb-3">
								<input type="text" class="form-control shadow-none bg-white border-end-0" placeholder="Email address"> <span class="input-group-text border-0 p-0">
                    <button class="input-group-text border-0 bg-primary" type="submit" name="subscribe"
                      aria-label="Subscribe for Newsletter"><i class="fas fa-arrow-right"></i></button>
                  </span>
							</div>
							<div style="position: absolute; left: -5000px;" aria-hidden="true">
								<input type="text" name="b_463ee871f45d2d93748e77cad_a0a2c6d074" tabindex="-1">
							</div>
						</form>
					</div>
					<p class="mb-0">Lorem ipsum dolor sit amet, rdghds consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat</p>
				</div>
			</div>
		</div>
		<div class="row align-items-center mt-5 text-center text-md-start">
			<div class="col-lg-4">
        <a href="index.html">
          <img loading="prelaod" decoding="async" class="img-fluid" width="160" src="images/logo.png" alt="Wallet">
        </a>
			</div>
			<div class="col-lg-4 col-md-6 mt-4 mt-lg-0">
				<ul class="list-unstyled list-inline mb-0 text-lg-center">
					<li class="list-inline-item me-4"><a class="text-black" href="privacy-policy.html">Privacy Policy</a>
					</li>
					<li class="list-inline-item me-4"><a class="text-black" href="terms.html">Terms &amp; Conditions</a>
					</li>
				</ul>
			</div>
			<div class="col-lg-4 col-md-6 text-md-end mt-4 mt-md-0">
				<ul class="list-unstyled list-inline mb-0 social-icons">
					<li class="list-inline-item me-3"><a title="Explorer Facebook Profile" class="text-black" href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
					</li>
					<li class="list-inline-item me-3"><a title="Explorer Twitter Profile" class="text-black" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
					</li>
					<li class="list-inline-item me-3"><a title="Explorer Instagram Profile" class="text-black" href="https://instagram.com/"><i class="fab fa-instagram"></i></a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</footer>


<!-- # JS Plugins -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}" ></script>
<script src="{{asset('plugins/bootstrap/bootstrap.min.js')}}" ></script>
<script src="{{asset('plugins/slick/slick.min.js')}}" ></script>
<script src="{{asset('plugins/scrollmenu/scrollmenu.min.js')}}" ></script>

<!-- Main Script -->
<script src="{{asset('js/script.js')}}" ></script>

</body>
</html>
