@extends(backendView('layouts.app'))

@section('title', 'Ui Carousel')

@section('content')

<div class="container">
	<div class="col-12">
		<div class="row justify-content-between">
			<div class="col-lg-8 col-sm-12">
				<h2 id="how-it-works">How it works</h2>
				<p>The carousel is a slideshow for cycling through a series of content, built with CSS 3D transforms and a bit of JavaScript. It works with a series of images, text, or custom markup. It also includes support for previous/next controls and indicators.</p>
				<p>In browsers where the <a href="https://www.w3.org/TR/page-visibility/">Page Visibility API</a> is supported, the carousel will avoid sliding when the webpage is not visible to the user (such as when the browser tab is inactive, the browser window is minimized, etc.).</p>
				<div class="card card-callout mb-3">
					<div class="card-body">
						The animation effect of this component is dependent on the <code>prefers-reduced-motion</code> media query. See the <a href="https://v5.getbootstrap.com/docs/5.0/getting-started/accessibility/#reduced-motion">reduced motion section of our accessibility documentation</a>.
					</div>
				</div>

				<p>Please be aware that nested carousels are not supported, and carousels are generally not compliant with accessibility standards.</p>
				<h2 id="example">Example</h2>
				<p>Carousels don’t automatically normalize slide dimensions. As such, you may need to use additional utilities or custom styles to appropriately size content. While carousels support previous/next controls and indicators, they’re not explicitly required. Add and customize as you see fit.</p>
				<p><strong>The <code>.active</code> class needs to be added to one of the slides</strong> otherwise the carousel will not be visible. Also be sure to set a unique id on the <code>.carousel</code> for optional controls, especially if you’re using multiple carousels on a single page. Control and indicator elements must have a <code>data-bs-target</code> attribute (or <code>href</code> for links) that matches the id of the <code>.carousel</code> element.</p>

				<h3 id="slides-only">Slides only</h3>
				<p>Here’s a carousel with slides only. Note the presence of the <code>.d-block</code> and <code>.w-100</code> on carousel images to prevent browser default image alignment.</p>
				<div class="bd-example mb-5">
					<div class="card">
						<div class="card-body">
							<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
								<div class="carousel-inner">
									<div class="carousel-item active">
										<img class="img-fluid" src="{!! backendAssets('dist/assets/images/gallery/10.jpg') !!}" alt="" />
									</div>
									<div class="carousel-item">
										<img class="img-fluid" src="{!! backendAssets('dist/assets/images/gallery/8.jpg') !!}" alt="" />
									</div>
									<div class="carousel-item">
										<img class="img-fluid" src="{!! backendAssets('dist/assets/images/gallery/1.jpg') !!}" alt="" />
									</div>
								</div>
							</div>
						</div>
					</div>
					<pre>
    <code class="language-html" data-lang="html">&lt;div id=&quot;carouselExampleSlidesOnly&quot; class=&quot;carousel slide&quot; data-bs-ride=&quot;carousel&quot;&gt;
        &lt;div class=&quot;carousel-inner&quot;&gt;
            &lt;div class=&quot;carousel-item active&quot;&gt;
                &lt;img class=&quot;img-fluid&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/10.jpg') !!}&quot; alt=&quot;&quot; /&gt;
            &lt;/div&gt;
            &lt;div class=&quot;carousel-item&quot;&gt;
                &lt;img class=&quot;img-fluid&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/8.jpg') !!}&quot; alt=&quot;&quot; /&gt;
            &lt;/div&gt;
            &lt;div class=&quot;carousel-item&quot;&gt;
                &lt;img class=&quot;img-fluid&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/1.jpg') !!}&quot; alt=&quot;&quot; /&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
				</div>

				<h3 id="with-controls">With controls</h3>
				<p>Adding in the previous and next controls:</p>
				<div class="bd-example mb-5">
					<div class="card">
						<div class="card-body">
							<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
								<div class="carousel-inner">
									<div class="carousel-item active">
										<img class="img-fluid" src="{!! backendAssets('dist/assets/images/gallery/10.jpg') !!}" alt="" />
									</div>
									<div class="carousel-item">
										<img class="img-fluid" src="{!! backendAssets('dist/assets/images/gallery/8.jpg') !!}" alt="" />
									</div>
									<div class="carousel-item">
										<img class="img-fluid" src="{!! backendAssets('dist/assets/images/gallery/1.jpg') !!}" alt="" />
									</div>
								</div>
								<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true"></span>
									<span class="visually-hidden">Previous</span>
								</button>
								<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
									<span class="carousel-control-next-icon" aria-hidden="true"></span>
									<span class="visually-hidden">Next</span>
								</button>
							</div>
						</div>
					</div>
					<pre>
    <code class="language-html" data-lang="html">&lt;div id=&quot;carouselExampleControls&quot; class=&quot;carousel slide&quot; data-bs-ride=&quot;carousel&quot;&gt;
        &lt;div class=&quot;carousel-inner&quot;&gt;
            &lt;div class=&quot;carousel-item active&quot;&gt;
                &lt;img class=&quot;img-fluid&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/10.jpg') !!}&quot; alt=&quot;&quot; /&gt;
            &lt;/div&gt;
            &lt;div class=&quot;carousel-item&quot;&gt;
                &lt;img class=&quot;img-fluid&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/8.jpg') !!}&quot; alt=&quot;&quot; /&gt;
            &lt;/div&gt;
            &lt;div class=&quot;carousel-item&quot;&gt;
                &lt;img class=&quot;img-fluid&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/1.jpg') !!}&quot; alt=&quot;&quot; /&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;a class=&quot;carousel-control-prev&quot; href=&quot;#carouselExampleControls&quot; role=&quot;button&quot; data-slide=&quot;prev&quot;&gt;
            &lt;span class=&quot;carousel-control-prev-icon&quot; aria-hidden=&quot;true&quot;&gt;&lt;/span&gt;
            &lt;span class=&quot;visually-hidden&quot;&gt;Previous&lt;/span&gt;
        &lt;/a&gt;
        &lt;a class=&quot;carousel-control-next&quot; href=&quot;#carouselExampleControls&quot; role=&quot;button&quot; data-slide=&quot;next&quot;&gt;
            &lt;span class=&quot;carousel-control-next-icon&quot; aria-hidden=&quot;true&quot;&gt;&lt;/span&gt;
            &lt;span class=&quot;visually-hidden&quot;&gt;Next&lt;/span&gt;
        &lt;/a&gt;
    &lt;/div&gt;</code>
    </pre>
				</div>

				<h3 id="with-indicators">With indicators</h3>
				<p>You can also add the indicators to the carousel, alongside the controls, too.</p>
				<div class="bd-example mb-5">
					<div class="card">
						<div class="card-body">
							<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
								<ol class="carousel-indicators">
									<li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
									<li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" class=""></li>
									<li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" class=""></li>
								</ol>
								<div class="carousel-inner">
									<div class="carousel-item active">
										<img class="img-fluid" src="{!! backendAssets('dist/assets/images/gallery/10.jpg') !!}" alt="" />
									</div>
									<div class="carousel-item">
										<img class="img-fluid" src="{!! backendAssets('dist/assets/images/gallery/8.jpg') !!}" alt="" />
									</div>
									<div class="carousel-item">
										<img class="img-fluid" src="{!! backendAssets('dist/assets/images/gallery/1.jpg') !!}" alt="" />
									</div>
								</div>
								<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true"></span>
									<span class="visually-hidden">Previous</span>
								</button>
								<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
									<span class="carousel-control-next-icon" aria-hidden="true"></span>
									<span class="visually-hidden">Next</span>
								</button>
							</div>
						</div>
					</div>
					<pre>
    <code class="language-html" data-lang="html">&lt;div id=&quot;carouselExampleIndicators&quot; class=&quot;carousel slide&quot; data-bs-ride=&quot;carousel&quot;&gt;
        &lt;ol class=&quot;carousel-indicators&quot;&gt;
            &lt;li data-bs-target=&quot;#carouselExampleIndicators&quot; data-bs-slide-to=&quot;0&quot; class=&quot;active&quot;&gt;&lt;/li&gt;
            &lt;li data-bs-target=&quot;#carouselExampleIndicators&quot; data-bs-slide-to=&quot;1&quot; class=&quot;&quot;&gt;&lt;/li&gt;
            &lt;li data-bs-target=&quot;#carouselExampleIndicators&quot; data-bs-slide-to=&quot;2&quot; class=&quot;&quot;&gt;&lt;/li&gt;
        &lt;/ol&gt;
        &lt;div class=&quot;carousel-inner&quot;&gt;
            &lt;div class=&quot;carousel-item active&quot;&gt;
                &lt;img class=&quot;img-fluid&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/10.jpg') !!}&quot; alt=&quot;&quot; /&gt;
            &lt;/div&gt;
            &lt;div class=&quot;carousel-item&quot;&gt;
                &lt;img class=&quot;img-fluid&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/8.jpg') !!}&quot; alt=&quot;&quot; /&gt;
            &lt;/div&gt;
            &lt;div class=&quot;carousel-item&quot;&gt;
                &lt;img class=&quot;img-fluid&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/1.jpg') !!}&quot; alt=&quot;&quot; /&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;a class=&quot;carousel-control-prev&quot; href=&quot;#carouselExampleIndicators&quot; role=&quot;button&quot; data-slide=&quot;prev&quot;&gt;
            &lt;span class=&quot;carousel-control-prev-icon&quot; aria-hidden=&quot;true&quot;&gt;&lt;/span&gt;
            &lt;span class=&quot;visually-hidden&quot;&gt;Previous&lt;/span&gt;
        &lt;/a&gt;
        &lt;a class=&quot;carousel-control-next&quot; href=&quot;#carouselExampleIndicators&quot; role=&quot;button&quot; data-slide=&quot;next&quot;&gt;
            &lt;span class=&quot;carousel-control-next-icon&quot; aria-hidden=&quot;true&quot;&gt;&lt;/span&gt;
            &lt;span class=&quot;visually-hidden&quot;&gt;Next&lt;/span&gt;
        &lt;/a&gt;
    &lt;/div&gt;</code>
    </pre>
				</div>

				<h3 id="with-captions">With captions</h3>
				<p>Add captions to your slides easily with the <code>.carousel-caption</code> element within any <code>.carousel-item</code>. They can be easily hidden on smaller viewports, as shown below, with optional <a href="https://v5.getbootstrap.com/docs/5.0/utilities/display/">display utilities</a>. We hide them initially with <code>.d-none</code> and bring them back on medium-sized devices with <code>.d-md-block</code>.</p>
				<div class="bd-example mb-5">
					<div class="card">
						<div class="card-body">
							<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
								<ol class="carousel-indicators">
									<li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"></li>
									<li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" class=""></li>
									<li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" class=""></li>
								</ol>
								<div class="carousel-inner">
									<div class="carousel-item active">
										<img class="img-fluid" src="{!! backendAssets('dist/assets/images/gallery/1.jpg') !!}" alt="" />
										<div class="carousel-caption d-none d-md-block">
											<h5>First slide label</h5>
											<p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
										</div>
									</div>
									<div class="carousel-item">
										<img class="img-fluid" src="{!! backendAssets('dist/assets/images/gallery/2.jpg') !!}" alt="" />
										<div class="carousel-caption d-none d-md-block">
											<h5>Second slide label</h5>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
										</div>
									</div>
									<div class="carousel-item">
										<img class="img-fluid" src="{!! backendAssets('dist/assets/images/gallery/3.jpg') !!}" alt="" />
										<div class="carousel-caption d-none d-md-block">
											<h5>Third slide label</h5>
											<p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
										</div>
									</div>
								</div>
								<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true"></span>
									<span class="visually-hidden">Previous</span>
								</button>
								<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
									<span class="carousel-control-next-icon" aria-hidden="true"></span>
									<span class="visually-hidden">Next</span>
								</button>
							</div>
						</div>
					</div>
					<pre>
    <code class="language-html" data-lang="html">&lt;div id=&quot;carouselExampleCaptions&quot; class=&quot;carousel slide&quot; data-bs-ride=&quot;carousel&quot;&gt;
        &lt;ol class=&quot;carousel-indicators&quot;&gt;
            &lt;li data-bs-target=&quot;#carouselExampleCaptions&quot; data-bs-slide-to=&quot;0&quot; class=&quot;active&quot;&gt;&lt;/li&gt;
            &lt;li data-bs-target=&quot;#carouselExampleCaptions&quot; data-bs-slide-to=&quot;1&quot; class=&quot;&quot;&gt;&lt;/li&gt;
            &lt;li data-bs-target=&quot;#carouselExampleCaptions&quot; data-bs-slide-to=&quot;2&quot; class=&quot;&quot;&gt;&lt;/li&gt;
        &lt;/ol&gt;
        &lt;div class=&quot;carousel-inner&quot;&gt;
            &lt;div class=&quot;carousel-item active&quot;&gt;
                &lt;img class=&quot;img-fluid&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/1.jpg') !!}&quot; alt=&quot;&quot; /&gt;
                &lt;div class=&quot;carousel-caption d-none d-md-block&quot;&gt;
                    &lt;h5&gt;First slide label&lt;/h5&gt;
                    &lt;p&gt;Nulla vitae elit libero, a pharetra augue mollis interdum.&lt;/p&gt;
                &lt;/div&gt;
            &lt;/div&gt;
            &lt;div class=&quot;carousel-item&quot;&gt;
                &lt;img class=&quot;img-fluid&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/2.jpg') !!}&quot; alt=&quot;&quot; /&gt;
                &lt;div class=&quot;carousel-caption d-none d-md-block&quot;&gt;
                    &lt;h5&gt;Second slide label&lt;/h5&gt;
                    &lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit.&lt;/p&gt;
                &lt;/div&gt;
            &lt;/div&gt;
            &lt;div class=&quot;carousel-item&quot;&gt;
                &lt;img class=&quot;img-fluid&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/3.jpg') !!}&quot; alt=&quot;&quot; /&gt;
                &lt;div class=&quot;carousel-caption d-none d-md-block&quot;&gt;
                    &lt;h5&gt;Third slide label&lt;/h5&gt;
                    &lt;p&gt;Praesent commodo cursus magna, vel scelerisque nisl consectetur.&lt;/p&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;a class=&quot;carousel-control-prev&quot; href=&quot;#carouselExampleCaptions&quot; role=&quot;button&quot; data-slide=&quot;prev&quot;&gt;
            &lt;span class=&quot;carousel-control-prev-icon&quot; aria-hidden=&quot;true&quot;&gt;&lt;/span&gt;
            &lt;span class=&quot;visually-hidden&quot;&gt;Previous&lt;/span&gt;
        &lt;/a&gt;
        &lt;a class=&quot;carousel-control-next&quot; href=&quot;#carouselExampleCaptions&quot; role=&quot;button&quot; data-slide=&quot;next&quot;&gt;
            &lt;span class=&quot;carousel-control-next-icon&quot; aria-hidden=&quot;true&quot;&gt;&lt;/span&gt;
            &lt;span class=&quot;visually-hidden&quot;&gt;Next&lt;/span&gt;
        &lt;/a&gt;
    &lt;/div&gt;</code>
    </pre>
				</div>

				<h3 id="crossfade">Crossfade</h3>
				<p>Add <code>.carousel-fade</code> to your carousel to animate slides with a fade transition instead of a slide.</p>
				<div class="bd-example mb-5">
					<div class="card">
						<div class="card-body">
							<div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
								<div class="carousel-inner">
									<div class="carousel-item active">
										<img class="img-fluid" src="{!! backendAssets('dist/assets/images/gallery/10.jpg') !!}" alt="" />
									</div>
									<div class="carousel-item">
										<img class="img-fluid" src="{!! backendAssets('dist/assets/images/gallery/8.jpg') !!}" alt="" />
									</div>
									<div class="carousel-item">
										<img class="img-fluid" src="{!! backendAssets('dist/assets/images/gallery/1.jpg') !!}" alt="" />
									</div>
								</div>
								<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true"></span>
									<span class="visually-hidden">Previous</span>
								</button>
								<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
									<span class="carousel-control-next-icon" aria-hidden="true"></span>
									<span class="visually-hidden">Next</span>
								</button>
							</div>
						</div>
					</div>
					<pre>
    <code class="language-html" data-lang="html">&lt;div id=&quot;carouselExampleFade&quot; class=&quot;carousel slide carousel-fade&quot; data-bs-ride=&quot;carousel&quot;&gt;
        &lt;div class=&quot;carousel-inner&quot;&gt;
            &lt;div class=&quot;carousel-item active&quot;&gt;
                &lt;img class=&quot;img-fluid&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/10.jpg') !!}&quot; alt=&quot;&quot; /&gt;
            &lt;/div&gt;
            &lt;div class=&quot;carousel-item&quot;&gt;
                &lt;img class=&quot;img-fluid&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/8.jpg') !!}&quot; alt=&quot;&quot; /&gt;
            &lt;/div&gt;
            &lt;div class=&quot;carousel-item&quot;&gt;
                &lt;img class=&quot;img-fluid&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/1.jpg') !!}&quot; alt=&quot;&quot; /&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;a class=&quot;carousel-control-prev&quot; href=&quot;#carouselExampleFade&quot; role=&quot;button&quot; data-slide=&quot;prev&quot;&gt;
            &lt;span class=&quot;carousel-control-prev-icon&quot; aria-hidden=&quot;true&quot;&gt;&lt;/span&gt;
            &lt;span class=&quot;visually-hidden&quot;&gt;Previous&lt;/span&gt;
        &lt;/a&gt;
        &lt;a class=&quot;carousel-control-next&quot; href=&quot;#carouselExampleFade&quot; role=&quot;button&quot; data-slide=&quot;next&quot;&gt;
            &lt;span class=&quot;carousel-control-next-icon&quot; aria-hidden=&quot;true&quot;&gt;&lt;/span&gt;
            &lt;span class=&quot;visually-hidden&quot;&gt;Next&lt;/span&gt;
        &lt;/a&gt;
    &lt;/div&gt;</code>
    </pre>
				</div>

				<h3 id="individual-carousel-item-interval">Individual <code>.carousel-item</code> interval</h3>
				<p>Add <code>data-interval=""</code> to a <code>.carousel-item</code> to change the amount of time to delay between automatically cycling to the next item.</p>
				<div class="bd-example mb-5">
					<div class="card">
						<div class="card-body">
							<div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
								<div class="carousel-inner">
									<div class="carousel-item" data-interval="10000">
										<img class="img-fluid" src="{!! backendAssets('dist/assets/images/gallery/2.jpg') !!}" alt="" />
									</div>
									<div class="carousel-item active carousel-item-left" data-interval="2000">
										<img class="img-fluid" src="{!! backendAssets('dist/assets/images/gallery/5.jpg') !!}" alt="" />
									</div>
									<div class="carousel-item carousel-item-next carousel-item-left">
										<img class="img-fluid" src="{!! backendAssets('dist/assets/images/gallery/7.jpg') !!}" alt="" />
									</div>
								</div>
								<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true"></span>
									<span class="visually-hidden">Previous</span>
								</button>
								<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
									<span class="carousel-control-next-icon" aria-hidden="true"></span>
									<span class="visually-hidden">Next</span>
								</button>
							</div>
						</div>
					</div>
					<pre>
    <code class="language-html" data-lang="html">&lt;div id=&quot;carouselExampleInterval&quot; class=&quot;carousel slide&quot; data-bs-ride=&quot;carousel&quot;&gt;
        &lt;div class=&quot;carousel-inner&quot;&gt;
            &lt;div class=&quot;carousel-item&quot; data-interval=&quot;10000&quot;&gt;
                &lt;img class=&quot;img-fluid&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/2.jpg') !!}&quot; alt=&quot;&quot; /&gt;
            &lt;/div&gt;
            &lt;div class=&quot;carousel-item active carousel-item-left&quot; data-interval=&quot;2000&quot;&gt;
                &lt;img class=&quot;img-fluid&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/5.jpg') !!}&quot; alt=&quot;&quot; /&gt;
            &lt;/div&gt;
            &lt;div class=&quot;carousel-item carousel-item-next carousel-item-left&quot;&gt;
                &lt;img class=&quot;img-fluid&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/7.jpg') !!}&quot; alt=&quot;&quot; /&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;a class=&quot;carousel-control-prev&quot; href=&quot;#carouselExampleInterval&quot; role=&quot;button&quot; data-slide=&quot;prev&quot;&gt;
            &lt;span class=&quot;carousel-control-prev-icon&quot; aria-hidden=&quot;true&quot;&gt;&lt;/span&gt;
            &lt;span class=&quot;visually-hidden&quot;&gt;Previous&lt;/span&gt;
        &lt;/a&gt;
        &lt;a class=&quot;carousel-control-next&quot; href=&quot;#carouselExampleInterval&quot; role=&quot;button&quot; data-slide=&quot;next&quot;&gt;
            &lt;span class=&quot;carousel-control-next-icon&quot; aria-hidden=&quot;true&quot;&gt;&lt;/span&gt;
            &lt;span class=&quot;visually-hidden&quot;&gt;Next&lt;/span&gt;
        &lt;/a&gt;
    &lt;/div&gt;</code>
    </pre>
				</div>

				<h2 id="dark-variant">Dark variant</h2>
				<p>Add <code>.carousel-dark</code> to the <code>.carousel</code> for darker controls, indicators, and captions. Controls have been inverted from their default white fill with the <code>filter</code> CSS property. Captions and controls have additional Sass variables that customize the <code>color</code> and <code>background-color</code>.</p>
				<div class="bd-example mb-5">
					<div class="card">
						<div class="card-body">
							<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
								<ol class="carousel-indicators">
									<li data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class=""></li>
									<li data-bs-target="#carouselExampleDark" data-bs-slide-to="1" class=""></li>
									<li data-bs-target="#carouselExampleDark" data-bs-slide-to="2" class="active"></li>
								</ol>
								<div class="carousel-inner">
									<div class="carousel-item" data-interval="10000">
										<img class="img-fluid" src="{!! backendAssets('dist/assets/images/gallery/3.jpg') !!}" alt="" />
										<div class="carousel-caption d-none d-md-block">
											<h5>First slide label</h5>
											<p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
										</div>
									</div>
									<div class="carousel-item active carousel-item-left" data-interval="2000">
										<img class="img-fluid" src="{!! backendAssets('dist/assets/images/gallery/8.jpg') !!}" alt="" />
										<div class="carousel-caption d-none d-md-block">
											<h5>Second slide label</h5>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
										</div>
									</div>
									<div class="carousel-item carousel-item-next carousel-item-left">
										<img class="img-fluid" src="{!! backendAssets('dist/assets/images/gallery/6.jpg') !!}" alt="" />
										<div class="carousel-caption d-none d-md-block">
											<h5>Third slide label</h5>
											<p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
										</div>
									</div>
								</div>
								<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true"></span>
									<span class="visually-hidden">Previous</span>
								</button>
								<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
									<span class="carousel-control-next-icon" aria-hidden="true"></span>
									<span class="visually-hidden">Next</span>
								</button>
							</div>
						</div>
					</div>
					<pre>
    <code class="language-html" data-lang="html">&lt;div id=&quot;carouselExampleDark&quot; class=&quot;carousel carousel-dark slide&quot; data-bs-ride=&quot;carousel&quot;&gt;
        &lt;ol class=&quot;carousel-indicators&quot;&gt;
            &lt;li data-bs-target=&quot;#carouselExampleDark&quot; data-bs-slide-to=&quot;0&quot; class=&quot;&quot;&gt;&lt;/li&gt;
            &lt;li data-bs-target=&quot;#carouselExampleDark&quot; data-bs-slide-to=&quot;1&quot; class=&quot;&quot;&gt;&lt;/li&gt;
            &lt;li data-bs-target=&quot;#carouselExampleDark&quot; data-bs-slide-to=&quot;2&quot; class=&quot;active&quot;&gt;&lt;/li&gt;
        &lt;/ol&gt;
        &lt;div class=&quot;carousel-inner&quot;&gt;
            &lt;div class=&quot;carousel-item&quot; data-interval=&quot;10000&quot;&gt;
                &lt;img class=&quot;img-fluid&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/3.jpg') !!}&quot; alt=&quot;&quot; /&gt;
                &lt;div class=&quot;carousel-caption d-none d-md-block&quot;&gt;
                    &lt;h5&gt;First slide label&lt;/h5&gt;
                    &lt;p&gt;Nulla vitae elit libero, a pharetra augue mollis interdum.&lt;/p&gt;
                &lt;/div&gt;
            &lt;/div&gt;
            &lt;div class=&quot;carousel-item active carousel-item-left&quot; data-interval=&quot;2000&quot;&gt;
                &lt;img class=&quot;img-fluid&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/8.jpg') !!}&quot; alt=&quot;&quot; /&gt;
                &lt;div class=&quot;carousel-caption d-none d-md-block&quot;&gt;
                    &lt;h5&gt;Second slide label&lt;/h5&gt;
                    &lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit.&lt;/p&gt;
                &lt;/div&gt;
            &lt;/div&gt;
            &lt;div class=&quot;carousel-item carousel-item-next carousel-item-left&quot;&gt;
                &lt;img class=&quot;img-fluid&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/6.jpg') !!}&quot; alt=&quot;&quot; /&gt;
                &lt;div class=&quot;carousel-caption d-none d-md-block&quot;&gt;
                    &lt;h5&gt;Third slide label&lt;/h5&gt;
                    &lt;p&gt;Praesent commodo cursus magna, vel scelerisque nisl consectetur.&lt;/p&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;a class=&quot;carousel-control-prev&quot; href=&quot;#carouselExampleDark&quot; role=&quot;button&quot; data-slide=&quot;prev&quot;&gt;
            &lt;span class=&quot;carousel-control-prev-icon&quot; aria-hidden=&quot;true&quot;&gt;&lt;/span&gt;
            &lt;span class=&quot;visually-hidden&quot;&gt;Previous&lt;/span&gt;
        &lt;/a&gt;
        &lt;a class=&quot;carousel-control-next&quot; href=&quot;#carouselExampleDark&quot; role=&quot;button&quot; data-slide=&quot;next&quot;&gt;
            &lt;span class=&quot;carousel-control-next-icon&quot; aria-hidden=&quot;true&quot;&gt;&lt;/span&gt;
            &lt;span class=&quot;visually-hidden&quot;&gt;Next&lt;/span&gt;
        &lt;/a&gt;
    &lt;/div&gt;</code>
    </pre>
				</div>

				<h2 id="usage">Usage</h2>
				<h3 id="via-data-attributes">Via data attributes</h3>
				<p>Use data attributes to easily control the position of the carousel. <code>data-slide</code> accepts the keywords <code>prev</code> or <code>next</code>, which alters the slide position relative to its current position. Alternatively, use <code>data-bs-slide-to</code> to pass a raw slide index to the carousel <code>data-bs-slide-to="2"</code>, which shifts the slide position to a particular index beginning with <code>0</code>.</p>
				<p>The <code>data-bs-ride="carousel"</code> attribute is used to mark a carousel as animating starting at page load. If you don’t use <code>data-bs-ride="carousel"</code> to initialize your carousel, you have to initialize it yourself. <strong>It cannot be used in combination with (redundant and unnecessary) explicit JavaScript initialization of the same carousel.</strong></p>

				<h3 id="via-javascript">Via JavaScript</h3>
				<p>Call carousel manually with:</p>
				<div class="bd-example mb-5">
					<pre><code class="language-js" data-lang="js"><span class="kd">var</span> <span class="nx">myCarousel</span> <span class="o">=</span> <span class="nb">document</span><span class="p">.</span><span class="nx">querySelector</span><span class="p">(</span><span class="s1">'#myCarousel'</span><span class="p">)</span>
    <span class="kd">var</span> <span class="nx">carousel</span> <span class="o">=</span> <span class="k">new</span> <span class="nx">bootstrap</span><span class="p">.</span><span class="nx">Carousel</span><span class="p">(</span><span class="nx">myCarousel</span><span class="p">)</span>
    </code></pre>
				</div>

				<h3 id="options">Options</h3>
				<p>Options can be passed via data attributes or JavaScript. For data attributes, append the option name to <code>data-</code>, as in <code>data-interval=""</code>.</p>
				<table class="table">
					<thead>
						<tr>
							<th style="width: 100px;">Name</th>
							<th style="width: 50px;">Type</th>
							<th style="width: 50px;">Default</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><code>interval</code></td>
							<td>number</td>
							<td><code>5000</code></td>
							<td>The amount of time to delay between automatically cycling an item. If false, carousel will not automatically cycle.</td>
						</tr>
						<tr>
							<td><code>keyboard</code></td>
							<td>boolean</td>
							<td><code>true</code></td>
							<td>Whether the carousel should react to keyboard events.</td>
						</tr>
						<tr>
							<td><code>pause</code></td>
							<td>string | boolean</td>
							<td><code>"hover"</code></td>
							<td>
								<p>If set to <code>"hover"</code>, pauses the cycling of the carousel on <code>mouseenter</code> and resumes the cycling of the carousel on <code>mouseleave</code>. If set to <code>false</code>, hovering over the carousel won't pause it.</p>
								<p>On touch-enabled devices, when set to <code>"hover"</code>, cycling will pause on <code>touchend</code> (once the user finished interacting with the carousel) for two intervals, before automatically resuming. Note that this is in addition to the above mouse behavior.</p>
							</td>
						</tr>
						<tr>
							<td><code>slide</code></td>
							<td>string | boolean</td>
							<td><code>false</code></td>
							<td>Autoplays the carousel after the user manually cycles the first item. If "carousel", autoplays the carousel on load.</td>
						</tr>
						<tr>
							<td><code>wrap</code></td>
							<td>boolean</td>
							<td><code>true</code></td>
							<td>Whether the carousel should cycle continuously or have hard stops.</td>
						</tr>
						<tr>
							<td><code>touch</code></td>
							<td>boolean</td>
							<td><code>true</code></td>
							<td>Whether the carousel should support left/right swipe interactions on touchscreen devices.</td>
						</tr>
					</tbody>
				</table>

				<h3 id="methods">Methods</h3>
				<div class="card card-callout">
					<div class="card-body">
						<h4 id="asynchronous-methods-and-transitions">Asynchronous methods and transitions</h4>
						<p>All API methods are <strong>asynchronous</strong> and start a <strong>transition</strong>. They return to the caller as soon as the transition is started but <strong>before it ends</strong>. In addition, a method call on a <strong>transitioning component will be ignored</strong>.</p>
						<p><a href="https://v5.getbootstrap.com/docs/5.0/getting-started/javascript/#asynchronous-functions-and-transitions">See our JavaScript documentation for more information</a>.</p>
					</div>
				</div>

				<p>You can create a carousel instance with the carousel constructor, for example, to initialize with additional options and start cycling through items:</p>
				<div class="bd-example mb-5">
					<pre><code class="language-js" data-lang="js"><span class="kd">var</span> <span class="nx">myCarousel</span> <span class="o">=</span> <span class="nb">document</span><span class="p">.</span><span class="nx">querySelector</span><span class="p">(</span><span class="s1">'#myCarousel'</span><span class="p">)</span>
    <span class="kd">var</span> <span class="nx">carousel</span> <span class="o">=</span> <span class="k">new</span> <span class="nx">bootstrap</span><span class="p">.</span><span class="nx">Carousel</span><span class="p">(</span><span class="nx">myCarousel</span><span class="p">,</span> <span class="p">{</span>
        <span class="nx">interval</span><span class="o">:</span> <span class="mi">2000</span><span class="p">,</span>
        <span class="nx">wrap</span><span class="o">:</span> <span class="kc">false</span>
    <span class="p">})</span>
    </code></pre>
				</div>
				<table class="table">
					<thead>
						<tr>
							<th>Method</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><code>cycle</code></td>
							<td>Cycles through the carousel items from left to right.</td>
						</tr>
						<tr>
							<td><code>pause</code></td>
							<td>Stops the carousel from cycling through items.</td>
						</tr>
						<tr>
							<td><code>prev</code></td>
							<td>Cycles to the previous item. <strong>Returns to the caller before the previous item has been shown</strong> (e.g., before the <code>slid.bs.carousel</code> event occurs).</td>
						</tr>
						<tr>
							<td><code>next</code></td>
							<td>Cycles to the next item. <strong>Returns to the caller before the next item has been shown</strong> (e.g., before the <code>slid.bs.carousel</code> event occurs).</td>
						</tr>
						<tr>
							<td><code>nextWhenVisible</code></td>
							<td>Cycles the carousel to a particular frame (0 based, similar to an array). <strong>Returns to the caller before the target item has been shown</strong> (e.g., before the <code>slid.bs.carousel</code> event occurs).</td>
						</tr>
						<tr>
							<td><code>dispose</code></td>
							<td>Destroys an element's carousel.</td>
						</tr>
						<tr>
							<td><code>getInstance</code></td>
							<td>Static method which allows you to get the carousel instance associated with a DOM element.</td>
						</tr>
					</tbody>
				</table>

				<h3 id="events">Events</h3>
				<p>Bootstrap’s carousel class exposes two events for hooking into carousel functionality. Both events have the following additional properties:</p>
				<ul>
					<li><code>direction</code>: The direction in which the carousel is sliding (either <code>"left"</code> or <code>"right"</code>).</li>
					<li><code>relatedTarget</code>: The DOM element that is being slid into place as the active item.</li>
					<li><code>from</code>: The index of the current item</li>
					<li><code>to</code>: The index of the next item</li>
				</ul>
				<p>All carousel events are fired at the carousel itself (i.e. at the <code>&lt;div class="carousel"&gt;</code>).</p>
				<table class="table">
					<thead>
						<tr>
							<th style="width: 150px;">Event type</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><code>slide.bs.carousel</code></td>
							<td>Fires immediately when the <code>slide</code> instance method is invoked.</td>
						</tr>
						<tr>
							<td><code>slid.bs.carousel</code></td>
							<td>Fired when the carousel has completed its slide transition.</td>
						</tr>
					</tbody>
				</table>
				<div class="bd-example mb-5">
					<pre class="chroma"><code class="language-js" data-lang="js"><span class="kd">var</span> <span class="nx">myCarousel</span> <span class="o">=</span> <span class="nb">document</span><span class="p">.</span><span class="nx">getElementById</span><span class="p">(</span><span class="s1">'myCarousel'</span><span class="p">)</span>

    <span class="nx">myCarousel</span><span class="p">.</span><span class="nx">addEventListener</span><span class="p">(</span><span class="s1">'slide.bs.carousel'</span><span class="p">,</span> <span class="kd">function</span> <span class="p">()</span> <span class="p">{</span>
        <span class="c1">// do something...
    </span><span class="c1"></span><span class="p">})</span>
    </code></pre>
				</div>
				<h3 id="change-transition-duration">Change transition duration</h3>
				<p>The transition duration of <code>.carousel-item</code> can be changed with the <code>$carousel-transition</code> Sass variable before compiling or custom styles if you’re using the compiled CSS. If multiple transitions are applied, make sure the transform transition is defined first (eg. <code>transition: transform 2s ease, opacity .5s ease-out</code>).</p>

			</div>
			<div class="col-lg-3 col-sm-12 d-none d-sm-block">
				<div class="sticky-lg-top">
					<strong class="d-block h6 my-2 pb-2 border-bottom">On this page</strong>
					<nav class="color-bg-200 py-3">
						<ul class="side-navbar">
							<li><a href="#how-it-works">How it works</a></li>
							<li><a href="#example">Example</a>
								<ul>
									<li><a href="#slides-only">Slides only</a></li>
									<li><a href="#with-controls">With controls</a></li>
									<li><a href="#with-indicators">With indicators</a></li>
									<li><a href="#with-captions">With captions</a></li>
									<li><a href="#crossfade">Crossfade</a></li>
									<li><a href="#individual-carousel-item-interval">Individual <code>.carousel-item</code> interval</a></li>
								</ul>
							</li>
							<li><a href="#dark-variant">Dark variant</a></li>
							<li><a href="#usage">Usage</a>
								<ul>
									<li><a href="#via-data-attributes">Via data attributes</a></li>
									<li><a href="#via-javascript">Via JavaScript</a></li>
									<li><a href="#options">Options</a></li>
									<li><a href="#methods">Methods</a></li>
									<li><a href="#events">Events</a></li>
									<li><a href="#change-transition-duration">Change transition duration</a></li>
								</ul>
							</li>
						</ul>
					</nav>
				</div>
			</div>
		</div> <!-- Row end  -->
	</div>
</div>
@endsection

@push('styles')
<!-- Plugin css -->
<link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/prism/prism.css') !!}">
@endpush

@push('custom_styles')
@endpush

@push('scripts')
<!-- Prism js file please do not add in your project -->
<script src="{!! backendAssets('dist/assets/plugin/prism/prism.js') !!}"></script>
@endpush

@push('custom_scripts')
@endpush

@push('modals')
@endpush