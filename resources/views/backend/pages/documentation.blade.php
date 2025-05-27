@extends(backendView('layouts.app'))

@section('title', 'Documentation')

@section('content')
<div class="container-fluid">

                        <div class="row px-2">

                            <div class="col-12">
                                <div class="mb-3 pt-3 card" style="font-size: 16px;">
                                    <div class="card-header">
                                        <h5 class="fw-bold"><i class="icofont-thumbs-up me-2"></i>Getting Started</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>This guide will help you get started with <strong class="text-secondary">eBazar</strong>! All the important stuff –&nbsp;compiling the source, file structure, build tools, file includes –&nbsp;is documented here, but should you have any questions, always feel free to reach out to <span class="text-muted">pixelwibes@gmail.com</span></p>
                                        <p>If you really like our work, design, performance and support then <a href="https://themeforest.net/downloads"> please don't forgot to rate us</a> on Themeforest,<br> it really motivate us to provide something better.
                                            <span class="ms-2">
                                                <i class="fa fa-star text-warning"></i>
                                                <i class="fa fa-star text-warning"></i>
                                                <i class="fa fa-star text-warning"></i>
                                                <i class="fa fa-star text-warning"></i>
                                                <i class="fa fa-star text-warning"></i>
                                            </span>
                                        </p>
                                        <p class="mb-2"><strong>Please Note :</strong></p>
                                        <p>- All images are just used for Preview Purpose Only. They are not part of the template and NOT included in the final purchase files.</p>
                                        <p>- This is Admin panel design integrated with Laravel, ready to develop template. It does not include any Business logic to produce database records.</p>
                                    </div>
                                </div>
                            </div> <!-- Doc: Getting Started -->

                            <div class="col-12">
                                <div class="mb-3 pt-3 card">
                                    <div class="card-header">
                                        <h5 class="fw-bold"><i class="icofont-code me-2"></i>Installation Setup Laravel</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>This template is built in Laravel-8 and requires PHP 7.3+, Node 14.x and NPM 6.9.0 to be installed</p>
                                        <p>To get started, you need to do the following:</p>
                                        <ol style="line-height: 30px;">
                                            <li><strong>Node.js and NPM:</strong>  You can download Node.js from <a href="https://nodejs.org" target="_blank" rel="noopener noreferrer nofollow external">NodeJS</a>. NPM comes bundled with Node.js</li>
                                            <li><strong>Project Setup:</strong> After Installing Node and NPM, run 'npm install' command to install npm related dependencies</li>
                                            <li><strong>Composer:</strong> Laravel project dependencies are managed through the <code><a href="https://getcomposer.org" style="color:red;text-decoration: underline;">PHP Composer tool</a> </code>. The first step is to install the depencencies by navigating into your project in terminal and typing this command: <span style="background-color: black;padding: 5px;color: white;">composer install</span></li>
                                            <li><strong>Note:</strong> However, any SASS code you write must be able compile via change reflected use this command: <span style="background-color: black;padding: 5px;color: white;">npm run dev</span> </li>
                                        </ol>
                                    </div>
                                </div>
                            </div> <!-- Doc: Dev Setup -->

                            <div class="col-12">
                                <div class="mb-3 pt-3 card">
                                    <div class="card-header">
                                        <h5 class="fw-bold"><i class="icofont-folder me-2"></i>File Structure</h5>
                                    </div>
                                    <div class="card-body">
                                        <ul style="line-height: 28px;">
                                            <li>
                                                <strong><i class="icofont-folder-open text-secondary me-2"></i>app</strong> <span class="text-muted">- The app directory holds the base code for your Laravel application.</span>
                                                <ul class="mb-3">
                                                    <li><strong><i class="icofont-folder text-secondary me-2"></i>Console</strong></li>
                                                    <li><strong><i class="icofont-folder text-secondary me-2"></i>Domains</strong></li>
                                                    <li><strong><i class="icofont-folder text-secondary me-2"></i>Exceptions</strong></li>
                                                    <li><strong><i class="icofont-folder text-secondary me-2"></i>Helpers / Global</strong></li>
                                                    <li>
                                                        <strong><i class="icofont-folder text-secondary me-2"></i>Http</strong>
                                                        <ul class="mb-3">
                                                            <li>
                                                                <strong><i class="icofont-folder text-secondary me-2"></i>Controllers</strong>
                                                                <ul class="mb-3">
                                                                    <li><strong><i class="icofont-folder text-secondary me-2"></i>Backend</strong></li>
                                                                    <li><strong><i class="icofont-folder text-secondary me-2"></i>Frontend</strong></li>
                                                                    <li><strong><i class="icofont-file-code text-secondary me-2"></i>Controller.php</strong></li>
                                                                    <li><strong><i class="icofont-file-code text-secondary me-2"></i>LocaleController.php</strong></li>
                                                                </ul>
                                                            </li>
                                                            <li><strong><i class="icofont-folder text-secondary me-2"></i>Livewire</strong></li>
                                                            <li><strong><i class="icofont-folder text-secondary me-2"></i>Middleware</strong></li>
                                                            <li><strong><i class="icofont-folder text-secondary me-2"></i>Requests</strong></li>
                                                            <li><strong><i class="icofont-file-code color-light-orange me-2"></i>Kernel</strong></li>
                                                        </ul>
                                                    </li>
                                                    <li><strong><i class="icofont-folder text-secondary me-2"></i>Models</strong></li>
                                                    <li><strong><i class="icofont-folder text-secondary me-2"></i>Providers</strong></li>
                                                    <li><strong><i class="icofont-folder text-secondary me-2"></i>Rules</strong></li>
                                                    <li><strong><i class="icofont-folder text-secondary me-2"></i>Services</strong></li>
                                                </ul>

                                            </li>
                                            <li><strong><i class="icofont-folder-open text-secondary me-2"></i>bootstrap</strong><span class="text-muted">- The bootstrap directory contains all the bootstrapping scripts used for your application.</span></li>
                                            <li><strong><i class="icofont-folder-open text-secondary me-2"></i>config</strong><span class="text-muted">- The config directory holds all your project configuration files (.config).</span></li>
                                            <li><strong><i class="icofont-folder-open text-secondary me-2"></i>database</strong><span class="text-muted">- The database directory holds your database files.</span></li>
                                            <li><strong><i class="icofont-folder-open text-secondary me-2"></i>public</strong><span class="text-muted">- The public directory helps to start your Laravel project and maintains other necessary files such as JavaScript, CSS, and images of your project.</span></li>
                                            <li>
                                                <strong><i class="icofont-folder-open text-secondary me-2"></i>resources</strong><span class="text-muted">- The resources directory holds all the Sass files, language (localization) files, templates (if any).</span>
                                                <ul class="mb-3">
                                                    <li><strong><i class="icofont-folder text-secondary me-2"></i>js</strong></li>
                                                    <li><strong><i class="icofont-folder text-secondary me-2"></i>lang</strong></li>
                                                    <li><strong><i class="icofont-folder text-secondary me-2"></i>sass</strong></li>
                                                    <li><strong><i class="icofont-folder text-secondary me-2"></i>views</strong></li>
                                                </ul>
                                            </li>
                                            <li><strong><i class="icofont-folder-open text-secondary me-2"></i>routes</strong><span class="text-muted">- The routes directory contain all your definition files for routing, such as console.php, api.php, channels.php, etc.</span></li>
                                            <li><strong><i class="icofont-folder-open text-secondary me-2"></i>storage</strong><span class="text-muted">- The storage directory holds your session files, cache, compiled templates as well as miscellaneous files generated by the framework.</span></li>
                                            <li><strong><i class="icofont-folder-open text-secondary me-2"></i>test</strong><span class="text-muted">- The test directory holds all your test cases.</span></li>
                                            <li><strong><i class="icofont-folder text-secondary me-2"></i>node_modules</strong> <span class="text-muted">- NPM dependencies (by default the folder is not included) <code>npm</code> installs dependencies. </span></li>
                                            <li><strong><i class="icofont-file-code color-light-orange  me-2"></i>_ide_helper.php</strong> <span class="text-muted">-package Generation is done based on the files in your project </span></li>
                                            <li><strong><i class="icofont-file-code color-light-orange  me-2"></i>composer.json</strong> <span class="text-muted">- The PHP Composer can be defined as a dependency manager or dependency management tool specifically built for PHP</span></li>
                                            <li><strong><i class="icofont-file-code color-light-orange  me-2"></i>composer.lock</strong> <span class="text-muted">- It basically states that your project is locked to those specific versions </span></li>
                                            <li><strong><i class="icofont-file-code color-light-orange  me-2"></i>package.json</strong> <span class="text-muted">- List of dependencies and npm information</span></li>
                                            <li><strong><i class="icofont-file-code color-light-orange  me-2"></i>phpunit.xml</strong> <span class="text-muted">- Convenient helper methods  allow to expressively test your applications</span></li>
                                            <li><strong><i class="icofont-file-code color-light-orange  me-2"></i>server.php</strong> <span class="text-muted">-  Head to your cli and start the server</span></li>
                                            <li><strong><i class="icofont-file-code color-light-orange  me-2"></i>webpack.mix.js</strong> <span class="text-muted">- Mix makes it a cinch to compile and minify your application's</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div> <!-- Doc: File Structure -->

                            <div class="col-12">
                                <div class="mb-3 pt-3 card">
                                    <div class="card-header">
                                        <h5 class="fw-bold"><i class="icofont-layout me-2"></i>Create Layouts help class</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3 row-cols-1 row-cols-lg-2">
                                            <div class="col">
                                                <div class="color-bg-200 p-3">
                                                <h6>Default Sidebar Layout Setting</h6>
    <pre class="  language-html" data-lang="html" style="margin: 0; padding: 0; background: transparent !important;"><code class="  language-html"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>sidebar<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span></code>
    </pre>
    Toggle class in sidebar <code>.sidebar</code>
    </div>
                                            </div>
                                            <div class="col">
                                                <div class="color-bg-200 p-3">
                                                <h6>Mini Sidebar Layout Setting</h6>
    <pre class="  language-html" data-lang="html" style="margin: 0; padding: 0; background: transparent !important;"><code class="  language-html"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>sidebar sidebar-mini<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span></code>
    </pre>
    Toggle class in sidebar <code>.sidebar-mini</code>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="color-bg-200 p-3">
                                                <h6>Font Setting</h6>
    <pre class="  language-html" data-lang="html" style="margin: 0; padding: 0; background: transparent !important;"><code class="  language-html"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>body</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>font-Plex<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span></code>
    </pre>
    <code>.font-poppins</code>, <code>.font-opensans</code>, <code>.font-montserrat</code>, <code>.font-Plex</code>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="color-bg-200 p-3">
                                                <h6>RTL Mode</h6>
    <pre class="  language-html" data-lang="html" style="margin: 0; padding: 0; background: transparent !important;"><code class="  language-html"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>body</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>rtl_mode<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span></code>
    </pre>
    Toggle class in Body tage <code>.rtl_mode</code>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="color-bg-200 p-3">
                                                <h6>Sidebar Gradient</h6>
    <pre class="  language-html" data-lang="html" style="margin: 0; padding: 0; background: transparent !important;"><code class="  language-html"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>sidebar gradient<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span></code>
    </pre>
    Toggle class in sidebar <code>.gradient</code>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="color-bg-200 p-3">
                                                <h6>Light/Dark &amp; High Contrast</h6>
    <pre class="  language-html" data-lang="html" style="margin: 0; padding: 0; background: transparent !important;"><code class="  language-html"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>html</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>no-js <span class="token punctuation">"</span></span> <span class="token attr-name">lang</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>en<span class="token punctuation">"</span></span> <span class="token attr-name">data-theme</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>dark<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span></code>
    </pre>
    Change class in HTML tage <code>.light</code>, <code>.dark</code>, &amp; <code>.high-contrast</code>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="color-bg-200 p-3">
                                                <h6>Theme Color Settings</h6>
    <pre class="  language-html" data-lang="html" style="margin: 0; padding: 0; background: transparent !important;"><code class="  language-html"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation attr-equals">=</span><span class="token punctuation">"</span>theme-blue<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span></code>
    </pre>
    <code>.theme-tradewind</code>,
    <code>.theme-monalisa</code>,
    <code>.theme-cyan</code>,
    <code>.theme-indigo</code>,
    <code>.theme-blue</code>,
    <code>.theme-green</code>,
    <code>.theme-orange</code>,
    <code>.theme-blush</code>,
    <code>.theme-red</code>,
    <code>.theme-dynamic</code>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3 pt-3 card">
                                    <div class="card-header">
                                        <h5 class="fw-bold"><i class="icofont-gear me-2"></i>Setting info</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-4">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="card mb-3">
                                                    <div class="card-body">
                                                        <div class="theme-setting">
                                                            <h6 class="fw-bold"> Template Color Settings</h6>
                                                            <p>There are 9 Color option template available here. just simple select your favorite color options.also sidebar gradient colorsidebar gradient color option available. just simple gradient swich on. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card mb-3">
                                                    <div class="card-body">
                                                        <div class="theme-setting">
                                                            <h6 class="fw-bold"> Dyanamic color setting</h6>
                                                            <p>You can set your own primary colors and secondary colors also set chart color options available.just simply set your own color. click in the color box to open the color picker and choose your color</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card mb-3">
                                                    <div class="card-body">
                                                        <div class="theme-setting">
                                                            <h6 class="fw-bold"> Google Font setting</h6>
                                                            <p>There are 4 google font options. just simply select the fonts option</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card mb-3">
                                                    <div class="card-body">
                                                        <div class="theme-setting">
                                                            <h6 class="fw-bold mb-3">Light/Dark & Contrast Layout </h6>
                                                            <p><strong>Light:</strong>  By Default Light Color Layout Template Selected  </p>
                                                            <p><strong>Dark:</strong>  Enable Dark Mode Swich On. </p>
                                                            <p><strong>High Contrast:</strong>  Enable High Contrast Mode Swich On. </p>
                                                            <p><strong>RTL:</strong>  Enable RTL Mode Swich On. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card mb-3">
                                                    <div class="card-body">
                                                        <div class="theme-setting">
                                                            <h6 class="fw-bold mb-3">High Contrast Themefor better accessibility </h6>
                                                            <p>eBazar has a pre-built High contrast theme for improving accessibility.</p>
                                                            <p> If you follow the standard of eBazar, the High contrast theme will be applied to all eBazar elements, regardless of whether they are charts or labels.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Doc: Setting info -->

                            <div class="col-12">
                                <div class="mb-3 pt-3 card">
                                    <div class="card-header">
                                        <h5 class="fw-bold"><i class="icofont-paint-brush me-2"></i>Comman Utilities With Custom Class</h5>
                                    </div>
                                    <div class="card-header">
                                        <h5 class="fw-bold">Text Color</h5>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered  doc-table">
                                            <thead>
                                                <tr>
                                                    <th>Class</th>
                                                    <th>Results</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><code>.text-primary</code></td>
                                                    <td class="text-primary">Lorem ipsum dolor sit amet consectecur.</td>
                                                </tr>
                                                <tr>
                                                    <td><code>.text-secondary</code></td>
                                                    <td class="text-secondary">Lorem ipsum dolor sit amet consectecur.</td>
                                                </tr>
                                                <tr>
                                                    <td><code>.text-success</code></td>
                                                    <td class="text-success">Lorem ipsum dolor sit amet consectecur.</td>
                                                </tr>
                                                <tr>
                                                    <td><code>.text-info</code></td>
                                                    <td class="text-info">Lorem ipsum dolor sit amet consectecur.</td>
                                                </tr>
                                                <tr>
                                                    <td><code>.text-warning</code></td>
                                                    <td class="text-warning">Lorem ipsum dolor sit amet consectecur.</td>
                                                </tr>
                                                <tr>
                                                    <td><code>.text-danger</code></td>
                                                    <td class="text-danger">Lorem ipsum dolor sit amet consectecur.</td>
                                                </tr>
                                                <tr>
                                                    <td><code>.text-dark</code></td>
                                                    <td class="text-dark">Lorem ipsum dolor sit amet consectecur.</td>
                                                </tr>
                                                <tr>
                                                    <td><code>.color-lightyellow</code></td>
                                                    <td class="color-lightyellow">Lorem ipsum dolor sit amet consectecur.</td>
                                                </tr>
                                                <tr>
                                                    <td><code>.color-lightblue</code></td>
                                                    <td class="color-lightblue">Lorem ipsum dolor sit amet consectecur.</td>
                                                </tr>
                                                <tr>
                                                    <td><code>.color-light-success</code></td>
                                                    <td class="color-light-success">Lorem ipsum dolor sit amet consectecur.</td>
                                                </tr>
                                                <tr>
                                                    <td><code>.color-light-orange</code></td>
                                                    <td class="color-light-orange">Lorem ipsum dolor sit amet consectecur.</td>
                                                </tr>
                                                <tr>
                                                    <td><code>.color-careys-pink</code></td>
                                                    <td class="color-careys-pink">Lorem ipsum dolor sit amet consectecur.</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-header">
                                        <h5 class="fw-bold">Background Color</h5>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered doc-table">
                                            <thead>
                                                <tr>
                                                    <th>Class</th>
                                                    <th>Results</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><code>.bg-primary</code></td>
                                                    <td class="bg-primary"></td>
                                                </tr>
                                                <tr>
                                                    <td><code>.bg-secondary</code></td>
                                                    <td class="bg-secondary"></td>
                                                </tr>
                                                <tr>
                                                    <td><code>.bg-success</code></td>
                                                    <td class="bg-success"></td>
                                                </tr>
                                                <tr>
                                                    <td><code>.bg-info</code></td>
                                                    <td class="bg-info"></td>
                                                </tr>
                                                <tr>
                                                    <td><code>.bg-warning</code></td>
                                                    <td class="bg-warning"></td>
                                                </tr>
                                                <tr>
                                                    <td><code>.bg-danger</code></td>
                                                    <td class="bg-danger"></td>
                                                </tr>
                                                <tr>
                                                    <td><code>.bg-dark</code></td>
                                                    <td class="bg-dark"></td>
                                                </tr>
                                                <tr>
                                                    <td><code>.bg-white</code></td>
                                                    <td class="bg-white"></td>
                                                </tr>
                                                <tr>
                                                    <td><code>.bg-lightyellow</code></td>
                                                    <td class="bg-lightyellow"></td>
                                                </tr>
                                                <tr>
                                                    <td><code>.bg-lightblue</code></td>
                                                    <td class="bg-lightblue"></td>
                                                </tr>
                                                <tr>
                                                    <td><code>.bg-careys-pink</code></td>
                                                    <td class="bg-careys-pink"></td>
                                                </tr>
                                                <tr>
                                                    <td><code>.light-success-bg</code></td>
                                                    <td class="light-success-bg"></td>
                                                </tr>
                                                <tr>
                                                    <td><code>.light-orange-bg </code></td>
                                                    <td class="light-orange-bg"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div><!-- Doc: Comman Utilities -->

                            <div class="col-12">
                                <div class="mb-3 pt-3 card">
                                    <div class="card-header">
                                        <h5 class="fw-bold"><i class="icofont-paint me-2"></i>Layouts Components</h5>
                                        <p class="text-muted">Comman Components Easy to customize by developer</p>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-md-12">
                                            <div class="card-header">
                                                <h5 class="fw-bold">Button</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="bd-example">
                                                    <button type="button" class="btn btn-primary">Primary</button>
                                                    <button type="button" class="btn btn-secondary">Secondary</button>
                                                    <button type="button" class="btn btn-success">Success</button>
                                                    <button type="button" class="btn btn-danger">Danger</button>
                                                    <button type="button" class="btn btn-warning">Warning</button>
                                                    <button type="button" class="btn btn-info">Info</button>
                                                    <button type="button" class="btn btn-light">Light</button>
                                                    <button type="button" class="btn btn-dark">Dark</button>

                                                    <button type="button" class="btn btn-link">Link</button>
            <pre>
            <code class="language-html" data-lang="html">&lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot;&gt;Primary&lt;/button&gt;
            &lt;button type=&quot;button&quot; class=&quot;btn btn-secondary&quot;&gt;Secondary&lt;/button&gt;
            &lt;button type=&quot;button&quot; class=&quot;btn btn-success&quot;&gt;Success&lt;/button&gt;
            &lt;button type=&quot;button&quot; class=&quot;btn btn-danger&quot;&gt;Danger&lt;/button&gt;
            &lt;button type=&quot;button&quot; class=&quot;btn btn-warning&quot;&gt;Warning&lt;/button&gt;
            &lt;button type=&quot;button&quot; class=&quot;btn btn-info&quot;&gt;Info&lt;/button&gt;
            &lt;button type=&quot;button&quot; class=&quot;btn btn-light&quot;&gt;Light&lt;/button&gt;
            &lt;button type=&quot;button&quot; class=&quot;btn btn-dark&quot;&gt;Dark&lt;/button&gt;

            &lt;button type=&quot;button&quot; class=&quot;btn btn-link&quot;&gt;Link&lt;/button&gt;</code>
            </pre>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="card-header">
                                                <h5 class="fw-bold">Navbar</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="bd-example">
                                                    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
                                                        <div class="container-xxl">
                                                            <a class="navbar-brand" href="#">Navbar</a>
                                                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                                                <span class="navbar-toggler-icon"></span>
                                                            </button>
                                                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                                                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Home</a></li>
                                                                    <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
                                                                    <li class="nav-item dropdown">
                                                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                            Dropdown
                                                                        </a>
                                                                        <ul class="dropdown-menu border-0 shadow" aria-labelledby="navbarDropdown">
                                                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                                                            <li><hr class="dropdown-divider"></li>
                                                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                                        </ul>
                                                                    </li>
                                                                    <li class="nav-item"><a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a></li>
                                                                </ul>
                                                                <form class="d-flex">
                                                                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </nav>
            <pre class="language-html m-0" data-lang="html">
            <code>&lt;nav class=&quot;navbar navbar-expand-lg navbar-light bg-light&quot;&gt;
                &lt;div class=&quot;container-xxl&quot;&gt;
                    &lt;a class=&quot;navbar-brand&quot; href=&quot;#&quot;&gt;Navbar&lt;/a&gt;
                    &lt;button class=&quot;navbar-toggler&quot; type=&quot;button&quot; data-bs-toggle=&quot;collapse&quot; data-bs-target=&quot;#navbarSupportedContent&quot; aria-controls=&quot;navbarSupportedContent&quot; aria-expanded=&quot;false&quot; aria-label=&quot;Toggle navigation&quot;&gt;
                        &lt;span class=&quot;navbar-toggler-icon&quot;&gt;&lt;/span&gt;
                    &lt;/button&gt;
                    &lt;div class=&quot;collapse navbar-collapse&quot; id=&quot;navbarSupportedContent&quot;&gt;
                        &lt;ul class=&quot;navbar-nav me-auto mb-2 mb-lg-0&quot;&gt;
                            &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link active&quot; aria-current=&quot;page&quot; href=&quot;#&quot;&gt;Home&lt;/a&gt;&lt;/li&gt;
                            &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link&quot; href=&quot;#&quot;&gt;Link&lt;/a&gt;&lt;/li&gt;
                            &lt;li class=&quot;nav-item dropdown&quot;&gt;
                                &lt;a class=&quot;nav-link dropdown-toggle&quot; href=&quot;#&quot; id=&quot;navbarDropdown&quot; role=&quot;button&quot; data-bs-toggle=&quot;dropdown&quot; aria-expanded=&quot;false&quot;&gt;
                                    Dropdown
                                &lt;/a&gt;
                                &lt;ul class=&quot;dropdown-menu border-0 shadow&quot; aria-labelledby=&quot;navbarDropdown&quot;&gt;
                                    &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Action&lt;/a&gt;&lt;/li&gt;
                                    &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Another action&lt;/a&gt;&lt;/li&gt;
                                    &lt;li&gt;&lt;hr class=&quot;dropdown-divider&quot;&gt;&lt;/li&gt;
                                    &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Something else here&lt;/a&gt;&lt;/li&gt;
                                &lt;/ul&gt;
                            &lt;/li&gt;
                            &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link disabled&quot; href=&quot;#&quot; tabindex=&quot;-1&quot; aria-disabled=&quot;true&quot;&gt;Disabled&lt;/a&gt;&lt;/li&gt;
                        &lt;/ul&gt;
                        &lt;form class=&quot;d-flex&quot;&gt;
                            &lt;input class=&quot;form-control me-2&quot; type=&quot;search&quot; placeholder=&quot;Search&quot; aria-label=&quot;Search&quot;&gt;
                            &lt;button class=&quot;btn btn-outline-success&quot; type=&quot;submit&quot;&gt;Search&lt;/button&gt;
                        &lt;/form&gt;
                    &lt;/div&gt;
                &lt;/div&gt;
            &lt;/nav&gt;</code>
            </pre>
                                                </div> <!-- example end  -->
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="card-header">
                                                <h5 class="fw-bold">Breadcrumb</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="bd-example">
                                                    <nav aria-label="breadcrumb">
                                                        <ol class="breadcrumb p-2">
                                                            <li class="breadcrumb-item active" aria-current="page">Home</li>
                                                        </ol>
                                                    </nav>

                                                    <nav aria-label="breadcrumb">
                                                        <ol class="breadcrumb p-2">
                                                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                                                            <li class="breadcrumb-item active" aria-current="page">Library</li>
                                                        </ol>
                                                    </nav>

                                                    <nav aria-label="breadcrumb">
                                                        <ol class="breadcrumb p-2">
                                                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                                                            <li class="breadcrumb-item"><a href="#">Library</a></li>
                                                            <li class="breadcrumb-item active" aria-current="page">Data</li>
                                                        </ol>
                                                    </nav>
                        <pre>
                        <code class="language-html" data-lang="html">&lt;nav aria-label=&quot;breadcrumb&quot;&gt;
                            &lt;ol class=&quot;breadcrumb&quot;&gt;
                                &lt;li class=&quot;breadcrumb-item active&quot; aria-current=&quot;page&quot;&gt;Home&lt;/li&gt;
                            &lt;/ol&gt;
                        &lt;/nav&gt;

                        &lt;nav aria-label=&quot;breadcrumb&quot;&gt;
                            &lt;ol class=&quot;breadcrumb&quot;&gt;
                                &lt;li class=&quot;breadcrumb-item&quot;&gt;&lt;a href=&quot;#&quot;&gt;Home&lt;/a&gt;&lt;/li&gt;
                                &lt;li class=&quot;breadcrumb-item active&quot; aria-current=&quot;page&quot;&gt;Library&lt;/li&gt;
                            &lt;/ol&gt;
                        &lt;/nav&gt;

                        &lt;nav aria-label=&quot;breadcrumb&quot;&gt;
                            &lt;ol class=&quot;breadcrumb&quot;&gt;
                                &lt;li class=&quot;breadcrumb-item&quot;&gt;&lt;a href=&quot;#&quot;&gt;Home&lt;/a&gt;&lt;/li&gt;
                                &lt;li class=&quot;breadcrumb-item&quot;&gt;&lt;a href=&quot;#&quot;&gt;Library&lt;/a&gt;&lt;/li&gt;
                                &lt;li class=&quot;breadcrumb-item active&quot; aria-current=&quot;page&quot;&gt;Data&lt;/li&gt;
                            &lt;/ol&gt;
                        &lt;/nav&gt;</code>
                        </pre>
                                                </div> <!-- example end  -->
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="card-header">
                                                <h5 class="fw-bold">Card</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="bd-example">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Card title</h5>
                                                            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                            <a href="#" class="card-link">Card link</a>
                                                            <a href="#" class="card-link">Another link</a>
                                                        </div>
                                                    </div>
                    <pre>
                    <code class="language-html" data-lang="html">&lt;div class=&quot;card&quot; style=&quot;width: 18rem;&quot;&gt;
                        &lt;div class=&quot;card-body&quot;&gt;
                            &lt;h5 class=&quot;card-title&quot;&gt;Card title&lt;/h5&gt;
                            &lt;h6 class=&quot;card-subtitle mb-2 text-muted&quot;&gt;Card subtitle&lt;/h6&gt;
                            &lt;p class=&quot;card-text&quot;&gt;Some quick example text to build on the card title and make up the bulk of the card's content.&lt;/p&gt;
                            &lt;a href=&quot;#&quot; class=&quot;card-link&quot;&gt;Card link&lt;/a&gt;
                            &lt;a href=&quot;#&quot; class=&quot;card-link&quot;&gt;Another link&lt;/a&gt;
                        &lt;/div&gt;
                    &lt;/div&gt;</code>
                    </pre>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- Doc: Layouts Components -->

                            <div class="col-12">
                                <div class="mb-3 pt-3 card">
                                    <div class="card-header">
                                        <h5 class="fw-bold"><i class="icofont-flag-alt-2 me-2"></i>Advantages </h5>
                                    </div>

                                    <div class="card-body">
                                        <ul style="line-height: 30px; font-size: 16px;">
                                            <li>Very easy access to any starters components and core settings from anywhere in the template.</li>
                                            <li>Intuitive clear architecture.</li>
                                            <li>Avoiding the probabilities of conflicts between Front codes and third party plugins (libraries).</li>
                                            <li>Creation of wrapper components simply solves complicated initializations structures for the users.</li>
                                            <li>Everything is structured, each component in its own file and in its component in the main object.</li>
                                            <li>The ability of extending functionality without affecting the behavior of the core object and not changing the existing functionality.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div> <!-- Doc: eBazar Advantages  -->

                            <div class="col-12">
                                <div class="mb-3 pt-3 card">
                                    <div class="card-header">
                                        <h5 class="fw-bold"><i class="icofont-diamond me-2"></i>eBazar Template Credit</h5>
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <tbody>
                                                    <tr>
                                                        <td>Google font</td>
                                                        <td><a href="https://fonts.google.com/">https://fonts.google.com/</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Bootstrap</td>
                                                        <td><a href="https://v5.getbootstrap.com/">https://v5.getbootstrap.com/</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jquery</td>
                                                        <td><a href="https://jquery.com/">https://jquery.com/</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>SASS</td>
                                                        <td><a href="https://sass-lang.com/">https://sass-lang.com/</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Grunt</td>
                                                        <td><a href="https://gruntjs.com/">https://gruntjs.com/</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>NPM</td>
                                                        <td><a href="https://www.npmjs.com/">https://www.npmjs.com/</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Fontawesome</td>
                                                        <td><a href="https://fontawesome.com/v4.7.0/">https://fontawesome.com/v4.7.0/</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Icon Font</td>
                                                        <td><a href="https://icofont.com/icons">https://icofont.com/icons</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Apex Charts</td>
                                                        <td><a href="https://apexcharts.com/">https://apexcharts.com/</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sparkline Charts</td>
                                                        <td><a href="https://omnipotent.net/jquery.sparkline/#s-about">https://omnipotent.net/jquery.sparkline/#s-about</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Fullcalendar</td>
                                                        <td><a href="https://fullcalendar.io/">https://fullcalendar.io/</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pexels</td>
                                                        <td><a href="https://www.pexels.com/">https://www.pexels.com/</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- Doc: Template Credit  -->

                            <div class="col-12">
                                <div class="mb-3 pt-3 card">
                                    <div class="card-header">
                                        <h5 class="fw-bold"><i class="icofont-love me-2"></i>THANK YOU!</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mt-2">
                                            <div class="col-xl-8 col-lg-8 col-md-12">
                                                <div class="card overflow-hidden mb-3">
                                                    <div class="bg-primary py-5 px-4 text-light">
                                                        <h4>pixelwibes.com</h4>
                                                        <p >Once again, thank you so much for purchasing this template. As I said at the beginning, I'd be glad to help you if you have any questions relating to this template.
                                                            If you really like our work, design, performance and support then <a class="text-warning" href="https://themeforest.net/downloads"> please don't forgot to rate us</a> on Themeforest, it really motivate us to provide something better.</p>
                                                    </div>
                                                    <div class="p-4">
                                                        <h6>Customize Code and Devlopment</h6>
                                                        <span>We Can provide Bunch of Services to Customize Template According To Your Requirements</span>
                                                        <div class="mt-4 mb-2">
                                                            <a href="http://www.pixelwibes.com" target="_blank" class="btn btn-primary">Hire Us</a>
                                                        </div>
                                                        <div class="dividers-block"></div>
                                                        <h6>eBazar guide</h6>
                                                        <span>Get started with eBazar Business and learn about features for admins and users.</span>
                                                        <div class="mt-4 mb-2">
                                                            <a href="http://pixelwibes.com/" class="btn btn-primary">Check out the guide</a>
                                                        </div>
                                                        <div class="dividers-block"></div>
                                                        <h6>Get answers</h6>
                                                        <span>Visit the help centre for answers to common issues.</span>
                                                        <div class="mt-4 mb-2">
                                                            <a href="http://pixelwibes.com/" class="btn btn-primary">Go to Help Centre</a>
                                                        </div>
                                                        <div class="dividers-block"></div>
                                                        <span class="text-muted">Thanks for choosing <strong class="text-warning">Pixel Wibes</strong> Admin.</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-12">
                                                <div class="card bg-info-light mb-3">
                                                    <div class="card-body d-flex align-items-center justify-content-center flex-column">
                                                        <div class="preview-pane text-center">
                                                            <svg width="100" fill="currentColor" class="bi bi-chat-text color-defult " viewBox="0 0 16 16">
                                                                <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
                                                                <path d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8zm0 2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z"/>
                                                            </svg>
                                                            <a href="http://pixelwibes.com/" class="fw-bold fs-6 mt-2 d-flex justify-content-center color-defult ">Chat with us</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card bg-lightyellow">
                                                    <div class="card-body d-flex align-items-center justify-content-center flex-column">
                                                        <div class="preview-pane text-center">
                                                            <svg width="100" fill="currentColor" class="bi bi-envelope color-defult " viewBox="0 0 16 16">
                                                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/>
                                                            </svg>
                                                            <a href="mailto:pixelwibes@gmail.com" class="fw-bold  fs-6 mt-2 d-flex justify-content-center color-defult ">Email us</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- Doc: THANK YOU!  -->
                        </div> <!-- .row end -->

                    </div>
@endsection

@section('footer')
@include(backendView('includes.footer'))
@endsection

@push('styles')
<!-- Prism plugin css -->
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
