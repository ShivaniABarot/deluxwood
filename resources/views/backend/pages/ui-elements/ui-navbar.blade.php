@extends(backendView('layouts.app'))

@section('title', 'Ui Navbar')

@section('content')

<div class="container">
                    <div class="col-12">
                        <div class="bd-content">
                            
                            <h2 id="how-it-works">How it works</h2>
                            <p>Here’s what you need to know before getting started with the navbar:</p>
                            <div class="alert alert-danger" role="alert">
                                <strong>Navbar</strong> for more bootstrao components <a href="https://v5.getbootstrap.com/docs/5.0/components/navbar/" target="_blank">Bootstrap Navbar documentation <i class="fa fa-external-link"></i></a>
                            </div>
                            <ul class="ps-3">
                                <li>Navbars require a wrapping <code>.navbar</code> with <code>.navbar-expand{-sm|-md|-lg|-xl|-xxl}</code> for responsive collapsing and <a href="#color-schemes">color scheme</a> classes.</li>
                                <li>Navbars and their contents are fluid by default. Change the <a href="#containers">container</a> to limit their horizontal width in different ways.</li>
                                <li>Use our <a href="https://v5.getbootstrap.com/docs/5.0/utilities/spacing/">spacing</a> and <a href="https://v5.getbootstrap.com/docs/5.0/utilities/flex/">flex</a> utility classes for controlling spacing and alignment within navbars.</li>
                                <li>Navbars are responsive by default, but you can easily modify them to change that. Responsive behavior depends on our Collapse JavaScript plugin.</li>
                                <li>Ensure accessibility by using a <code>&lt;nav&gt;</code> element or, if using a more generic element such as a <code>&lt;div&gt;</code>, add a <code>role="navigation"</code> to every navbar to explicitly identify it as a landmark region for users of assistive technologies.</li>
                                <li>Indicate the current item by using <code>aria-current="page"</code> for the current page or <code>aria-current="true"</code> for the current item in a set.</li>
                            </ul>
                            <div class="card card-callout p-3">
                                <span>The animation effect of this component is dependent on the <code>prefers-reduced-motion</code> media query. See the <a href="https://v5.getbootstrap.com/docs/5.0/getting-started/accessibility/#reduced-motion">reduced motion section of our accessibility documentation</a>.</span>
                            </div>
                            <p>Read on for an example and list of supported sub-components.</p>
                            
                            <div class="border-top mt-5 pt-3">
                                <h4 id="supported-content">Supported content</h4>
                                <p>Navbars come with built-in support for a handful of sub-components. Choose from the following as needed:</p>
                                <ul class="ps-3">
                                    <li><code>.navbar-brand</code> for your company, product, or project name.</li>
                                    <li><code>.navbar-nav</code> for a full-height and lightweight navigation (including support for dropdowns).</li>
                                    <li><code>.navbar-toggler</code> for use with our collapse plugin and other <a href="#responsive-behaviors">navigation toggling</a> behaviors.</li>
                                    <li>Flex and spacing utilities for any form controls and actions.</li>
                                    <li><code>.navbar-text</code> for adding vertically centered strings of text.</li>
                                    <li><code>.collapse.navbar-collapse</code> for grouping and hiding navbar contents by a parent breakpoint.</li>
                                </ul>
                                <p>Here’s an example of all the sub-components included in a responsive light-themed navbar that automatically collapses at the <code>lg</code> (large) breakpoint.</p>
                                <ul class="nav nav-tabs tab-card px-3 border-bottom-0" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav-Preview1" role="tab">Preview</a></li>
                                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-HTML1" role="tab">HTML</a></li>
                                </ul>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="nav-Preview1" role="tabpanel">
                                                <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
                                            </div>
                                            <div class="tab-pane fade" id="nav-HTML1" role="tabpanel">
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p>This example uses <a href="https://v5.getbootstrap.com/docs/5.0/utilities/colors/">color</a> (<code>bg-light</code>) and <a href="https://v5.getbootstrap.com/docs/5.0/utilities/spacing/">spacing</a> (<code>my-2</code>, <code>my-lg-0</code>, <code>me-sm-0</code>, <code>my-sm-0</code>) utility classes.</p>
                                
                                <ul class="nav nav-tabs tab-card px-3 border-bottom-0" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav-Preview2" role="tab">Preview</a></li>
                                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-HTML2" role="tab">HTML</a></li>
                                </ul>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="nav-Preview2" role="tabpanel">
                                                <div class="header">
                                                    <nav class="navbar navbar-light navbar-expand-lg">
                                                        <div class="container-xxl">
                                            
                                                            <!-- Brand -->
                                                            <a href="{!! backendRoutePut('home') !!}" class="me-3 me-lg-4 brand-icon">
                                                                <svg width="35" height="35" fill="currentColor" class="bi bi-app-indicator " viewBox="0 0 16 16">
                                                                    <path d="M5.5 2A3.5 3.5 0 0 0 2 5.5v5A3.5 3.5 0 0 0 5.5 14h5a3.5 3.5 0 0 0 3.5-3.5V8a.5.5 0 0 1 1 0v2.5a4.5 4.5 0 0 1-4.5 4.5h-5A4.5 4.5 0 0 1 1 10.5v-5A4.5 4.5 0 0 1 5.5 1H8a.5.5 0 0 1 0 1H5.5z"></path>
                                                                    <path d="M16 3a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"></path>
                                                                </svg>
                                                            </a>
                                            
                                                            <!-- header rightbar icon -->
                                                            <div class="h-right d-flex align-items-center mr-5 mr-lg-0 order-1">
                                                                <div class="d-flex">
                                                                    <a class="nav-link text-muted collapsed" data-bs-toggle="collapse" data-bs-target="#main-search" href="#" title="Search this chat" aria-expanded="false">
                                                                        <i class="fa fa-search"></i>
                                                                    </a>
                                                                    <a class="nav-link text-primary" href="#" data-bs-toggle="modal" data-bs-target="#LayoutModal">
                                                                        <i class="fa fa-sliders"></i>
                                                                    </a>
                                                                    <a class="nav-link text-primary" href="#" title="Settings" data-bs-toggle="modal" data-bs-target="#SettingsModal"><i class="fa fa-gear"></i></a>
                                                                </div>
                                                                <div class="dropdown notifications">
                                                                    <a class="nav-link dropdown-toggle pulse" href="#" role="button" data-bs-toggle="dropdown">
                                                                        <i class="fa fa-bell"></i>
                                                                        <span class="pulse-ring"></span>
                                                                    </a>
                                                                </div>
                                                                <div class="dropdown user-profile ms-2 ms-sm-3">
                                                                    <a class="nav-link dropdown-toggle pulse p-0" href="#" role="button" data-bs-toggle="dropdown">
                                                                        <img class="avatar rounded-circle img-thumbnail" src="{!! backendAssets('dist/assets/images/profile_av.svg') !!}" alt="">
                                                                    </a>
                                                                </div>
                                                            </div>
                                            
                                                            <!-- menu toggler -->
                                                            <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainHeader5">
                                                                <span class="fa fa-bars"></span>
                                                            </button>
                                            
                                                            <!-- main menu -->
                                                            <div class="collapse navbar-collapse order-0" id="mainHeader5">
                                                                <ul class="navbar-nav me-auto">
                                                                    <li class="nav-item">
                                                                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#">Features</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#">Pricing</a>
                                                                    </li>
                                                                    <li class="nav-item dropdown">
                                                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                            Dropdown link
                                                                        </a>
                                                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
                                                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                                        </ul>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </nav>
                                            
                                                    <!-- Search: div -->
                                                    <div class="border-bottom px-lg-5 px-md-2 collapse bg-primary" id="main-search">
                                                        <div class="container py-4">
                                            
                                                            <div class="input-group">
                                                                <input type="text" class="form-control border-0 p-0 bg-transparent" placeholder="Search. Components, Layouts, etc...">
                                            
                                                                <div class="input-group-append ms-3">
                                                                    <button class="btn btn-light" type="submit">Search</button>
                                                                </div>
                                                            </div>
                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="nav-HTML2" role="tabpanel">
    <pre class="language-html m-0" data-lang="html">
    <code>&lt;div class=&quot;header&quot;&gt;
        &lt;nav class=&quot;navbar navbar-expand-lg&quot;&gt;
            &lt;div class=&quot;container-xxl&quot;&gt;

                &lt;!-- Brand --&gt;
                &lt;a href=&quot;{!! backendRoutePut('home') !!}&quot; class=&quot;me-3 me-lg-4 brand-icon&quot;&gt;
                    &lt;svg xmlns=&quot;http://www.w3.org/2000/svg&quot; width=&quot;24&quot; viewBox=&quot;0 0 64 80&quot; fill=&quot;none&quot;&gt;
                        &lt;path d=&quot;M58.8996 22.7L26.9996 2.2C23.4996 -0.0999999 18.9996 0 15.5996 2.5C12.1996 5 10.6996 9.2 11.7996 13.3L15.7996 26.8L3.49962 39.9C-3.30038 47.7 3.79962 54.5 3.89962 54.6L3.99962 54.7L36.3996 78.5C36.4996 78.6 36.5996 78.6 36.6996 78.7C37.8996 79.2 39.1996 79.4 40.3996 79.4C42.9996 79.4 45.4996 78.4 47.4996 76.4C50.2996 73.5 51.1996 69.4 49.6996 65.6L45.1996 51.8L58.9996 39.4C61.7996 37.5 63.3996 34.4 63.3996 31.1C63.4996 27.7 61.7996 24.5 58.8996 22.7ZM46.7996 66.7V66.8C48.0996 69.9 46.8996 72.7 45.2996 74.3C43.7996 75.9 41.0996 77.1 37.9996 76L5.89961 52.3C5.29961 51.7 1.09962 47.3 5.79962 42L16.8996 30.1L23.4996 52.1C24.3996 55.2 26.5996 57.7 29.5996 58.8C30.7996 59.2 31.9996 59.5 33.1996 59.5C35.0996 59.5 36.9996 58.9 38.6996 57.8C38.7996 57.8 38.7996 57.7 38.8996 57.7L42.7996 54.2L46.7996 66.7ZM57.2996 36.9C57.1996 36.9 57.1996 37 57.0996 37L44.0996 48.7L36.4996 25.5V25.4C35.1996 22.2 32.3996 20 28.9996 19.3C25.5996 18.7 22.1996 19.8 19.8996 22.3L18.2996 24L14.7996 12.3C13.8996 8.9 15.4996 6.2 17.3996 4.8C18.4996 4 19.8996 3.4 21.4996 3.4C22.6996 3.4 23.9996 3.7 25.2996 4.6L57.1996 25.1C59.1996 26.4 60.2996 28.6 60.2996 30.9C60.3996 33.4 59.2996 35.6 57.2996 36.9Z&quot; fill=&quot;black&quot;&gt;&lt;/path&gt;
                    &lt;/svg&gt;
                &lt;/a&gt;

                &lt;!-- header rightbar icon --&gt;
                &lt;div class=&quot;h-right d-flex align-items-center mr-5 mr-lg-0 order-1&quot;&gt;
                    &lt;div class=&quot;d-flex&quot;&gt;
                        &lt;a class=&quot;nav-link text-muted collapsed&quot; data-bs-toggle=&quot;collapse&quot; data-bs-target=&quot;#main-search&quot; href=&quot;#&quot; title=&quot;Search this chat&quot; aria-expanded=&quot;false&quot;&gt;
                            &lt;i class=&quot;fa fa-search&quot;&gt;&lt;/i&gt;
                        &lt;/a&gt;
                        &lt;a class=&quot;nav-link text-primary&quot; href=&quot;#&quot; data-bs-toggle=&quot;modal&quot; data-bs-target=&quot;#LayoutModal&quot;&gt;
                            &lt;i class=&quot;fa fa-sliders&quot;&gt;&lt;/i&gt;
                        &lt;/a&gt;
                        &lt;a class=&quot;nav-link text-primary&quot; href=&quot;#&quot; title=&quot;Settings&quot; data-bs-toggle=&quot;modal&quot; data-bs-target=&quot;#SettingsModal&quot;&gt;&lt;i class=&quot;fa fa-gear&quot;&gt;&lt;/i&gt;&lt;/a&gt;
                    &lt;/div&gt;
                    &lt;div class=&quot;dropdown notifications&quot;&gt;
                        &lt;a class=&quot;nav-link dropdown-toggle pulse&quot; href=&quot;#&quot; role=&quot;button&quot; data-bs-toggle=&quot;dropdown&quot;&gt;
                            &lt;i class=&quot;fa fa-bell&quot;&gt;&lt;/i&gt;
                            &lt;span class=&quot;pulse-ring&quot;&gt;&lt;/span&gt;
                        &lt;/a&gt;
                        &lt;div id=&quot;NotificationsDiv&quot; class=&quot;dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-right p-0 m-0&quot;&gt;
                            &lt;div class=&quot;card border-0 w380&quot;&gt;
                                &lt;div class=&quot;card-header border-0 p-3&quot;&gt;
                                    &lt;h5 class=&quot;mb-0 font-weight-light d-flex justify-content-between&quot;&gt;
                                        &lt;span&gt;Notifications Center&lt;/span&gt;
                                        &lt;span class=&quot;badge text-muted&quot;&gt;14&lt;/span&gt;
                                    &lt;/h5&gt;
                                    &lt;ul class=&quot;nav nav-tabs mt-3 border-bottom-0&quot; role=&quot;tablist&quot;&gt;
                                        &lt;li class=&quot;nav-item&quot;&gt;
                                            &lt;a class=&quot;nav-link font-weight-light ps-0 me-2 active&quot; data-bs-toggle=&quot;tab&quot; href=&quot;#Noti-tab-Message&quot; role=&quot;tab&quot;&gt;Message&lt;/a&gt;
                                        &lt;/li&gt;
                                        &lt;li class=&quot;nav-item&quot;&gt;
                                            &lt;a class=&quot;nav-link font-weight-light me-2&quot; data-bs-toggle=&quot;tab&quot; href=&quot;#Noti-tab-Events&quot; role=&quot;tab&quot;&gt;Events&lt;/a&gt;
                                        &lt;/li&gt;
                                        &lt;li class=&quot;nav-item&quot;&gt;
                                            &lt;a class=&quot;nav-link font-weight-light&quot; data-bs-toggle=&quot;tab&quot; href=&quot;#Noti-tab-Logs&quot; role=&quot;tab&quot;&gt;Logs&lt;/a&gt;
                                        &lt;/li&gt;
                                    &lt;/ul&gt;
                                &lt;/div&gt;
                                &lt;div class=&quot;tab-content card-body&quot;&gt;
                                    &lt;div class=&quot;tab-pane fade show active&quot; id=&quot;Noti-tab-Message&quot; role=&quot;tabpanel&quot;&gt;
                                        &lt;ul class=&quot;list-unstyled list mb-0&quot;&gt;
                                            &lt;li class=&quot;py-2 mb-1 border-bottom&quot;&gt;
                                                &lt;a href=&quot;javascript:void(0);&quot; class=&quot;d-flex&quot;&gt;
                                                    &lt;img class=&quot;avatar rounded-circle&quot; src=&quot;{!! backendAssets('dist/assets/images/xs/avatar1.svg') !!}&quot; alt=&quot;&quot;&gt;
                                                    &lt;div class=&quot;flex-fill ms-3&quot;&gt;
                                                        &lt;p class=&quot;d-flex justify-content-between mb-0 text-muted&quot;&gt;&lt;span class=&quot;font-weight-bold&quot;&gt;Chris Fox&lt;/span&gt; &lt;small&gt;2MIN&lt;/small&gt;&lt;/p&gt;
                                                        &lt;span class=&quot;text-muted&quot;&gt;changed an issue from &quot;In Progress&quot; to &lt;span class=&quot;badge bg-success&quot;&gt;Review&lt;/span&gt;&lt;/span&gt;
                                                    &lt;/div&gt;
                                                &lt;/a&gt;
                                            &lt;/li&gt;
                                            &lt;li class=&quot;py-2 mb-1 border-bottom&quot;&gt;
                                                &lt;a href=&quot;javascript:void(0);&quot; class=&quot;d-flex&quot;&gt;
                                                    &lt;div class=&quot;avatar rounded-circle no-thumbnail&quot;&gt;RH&lt;/div&gt;
                                                    &lt;div class=&quot;flex-fill ms-3&quot;&gt;
                                                        &lt;p class=&quot;d-flex justify-content-between mb-0 text-muted&quot;&gt;&lt;span class=&quot;font-weight-bold&quot;&gt;Robert Hammer&lt;/span&gt; &lt;small&gt;13MIN&lt;/small&gt;&lt;/p&gt;
                                                        &lt;span class=&quot;text-muted&quot;&gt;It is a long established fact that a reader will be distracted&lt;/span&gt;
                                                    &lt;/div&gt;
                                                &lt;/a&gt;
                                            &lt;/li&gt;
                                            &lt;li class=&quot;py-2 mb-1 border-bottom&quot;&gt;
                                                &lt;a href=&quot;javascript:void(0);&quot; class=&quot;d-flex&quot;&gt;
                                                    &lt;img class=&quot;avatar rounded-circle&quot; src=&quot;{!! backendAssets('dist/assets/images/xs/avatar3.svg') !!}&quot; alt=&quot;&quot;&gt;
                                                    &lt;div class=&quot;flex-fill ms-3&quot;&gt;
                                                        &lt;p class=&quot;d-flex justify-content-between mb-0 text-muted&quot;&gt;&lt;span class=&quot;font-weight-bold&quot;&gt;Orlando Lentz&lt;/span&gt; &lt;small&gt;1HR&lt;/small&gt;&lt;/p&gt;
                                                        &lt;span class=&quot;text-muted&quot;&gt;There are many variations of passages&lt;/span&gt;
                                                    &lt;/div&gt;
                                                &lt;/a&gt;
                                            &lt;/li&gt;
                                            &lt;li class=&quot;py-2 mb-1 border-bottom&quot;&gt;
                                                &lt;a href=&quot;javascript:void(0);&quot; class=&quot;d-flex&quot;&gt;
                                                    &lt;img class=&quot;avatar rounded-circle&quot; src=&quot;{!! backendAssets('dist/assets/images/xs/avatar4.svg') !!}&quot; alt=&quot;&quot;&gt;
                                                    &lt;div class=&quot;flex-fill ms-3&quot;&gt;
                                                        &lt;p class=&quot;d-flex justify-content-between mb-0 text-muted&quot;&gt;&lt;span class=&quot;font-weight-bold&quot;&gt;Barbara Kelly&lt;/span&gt; &lt;small&gt;1DAY&lt;/small&gt;&lt;/p&gt;
                                                        &lt;span class=&quot;text-muted&quot;&gt;Contrary to popular belief &lt;span class=&quot;badge bg-danger&quot;&gt;Code&lt;/span&gt;&lt;/span&gt;
                                                    &lt;/div&gt;
                                                &lt;/a&gt;
                                            &lt;/li&gt;
                                            &lt;li class=&quot;py-2 mb-1 border-bottom&quot;&gt;
                                                &lt;a href=&quot;javascript:void(0);&quot; class=&quot;d-flex&quot;&gt;
                                                    &lt;img class=&quot;avatar rounded-circle&quot; src=&quot;{!! backendAssets('dist/assets/images/xs/avatar5.svg') !!}&quot; alt=&quot;&quot;&gt;
                                                    &lt;div class=&quot;flex-fill ms-3&quot;&gt;
                                                        &lt;p class=&quot;d-flex justify-content-between mb-0 text-muted&quot;&gt;&lt;span class=&quot;font-weight-bold&quot;&gt;Robert Hammer&lt;/span&gt; &lt;small&gt;13MIN&lt;/small&gt;&lt;/p&gt;
                                                        &lt;span class=&quot;text-muted&quot;&gt;making it over 2000 years old&lt;/span&gt;
                                                    &lt;/div&gt;
                                                &lt;/a&gt;
                                            &lt;/li&gt;
                                            &lt;li class=&quot;py-2 mb-1 border-bottom&quot;&gt;
                                                &lt;a href=&quot;javascript:void(0);&quot; class=&quot;d-flex&quot;&gt;
                                                    &lt;img class=&quot;avatar rounded-circle&quot; src=&quot;{!! backendAssets('dist/assets/images/xs/avatar6.svg') !!}&quot; alt=&quot;&quot;&gt;
                                                    &lt;div class=&quot;flex-fill ms-3&quot;&gt;
                                                        &lt;p class=&quot;d-flex justify-content-between mb-0 text-muted&quot;&gt;&lt;span class=&quot;font-weight-bold&quot;&gt;Orlando Lentz&lt;/span&gt; &lt;small&gt;1HR&lt;/small&gt;&lt;/p&gt;
                                                        &lt;span class=&quot;text-muted&quot;&gt;There are many variations of passages&lt;/span&gt;
                                                    &lt;/div&gt;
                                                &lt;/a&gt;
                                            &lt;/li&gt;
                                            &lt;li class=&quot;py-2&quot;&gt;
                                                &lt;a href=&quot;javascript:void(0);&quot; class=&quot;d-flex&quot;&gt;
                                                    &lt;img class=&quot;avatar rounded-circle&quot; src=&quot;{!! backendAssets('dist/assets/images/xs/avatar7.svg') !!}&quot; alt=&quot;&quot;&gt;
                                                    &lt;div class=&quot;flex-fill ms-3&quot;&gt;
                                                        &lt;p class=&quot;d-flex justify-content-between mb-0 text-muted&quot;&gt;&lt;span class=&quot;font-weight-bold&quot;&gt;Rose Rivera&lt;/span&gt; &lt;small class=&quot;&quot;&gt;1DAY&lt;/small&gt;&lt;/p&gt;
                                                        &lt;span class=&quot;text-muted&quot;&gt;Add Calander Event&lt;/span&gt;
                                                    &lt;/div&gt;
                                                &lt;/a&gt;
                                            &lt;/li&gt;
                                        &lt;/ul&gt;
                                    &lt;/div&gt;
                                    &lt;div class=&quot;tab-pane fade&quot; id=&quot;Noti-tab-Events&quot; role=&quot;tabpanel&quot;&gt;
                                        &lt;ul class=&quot;list-unstyled list mb-0&quot;&gt;
                                            &lt;li class=&quot;py-2 mb-1 border-bottom&quot;&gt;
                                                &lt;a href=&quot;javascript:void(0);&quot; class=&quot;d-flex&quot;&gt;
                                                    &lt;div class=&quot;avatar rounded no-thumbnail&quot;&gt;&lt;i class=&quot;fa fa-info-circle fa-lg&quot;&gt;&lt;/i&gt;&lt;/div&gt;
                                                    &lt;div class=&quot;flex-fill ms-3&quot;&gt;
                                                        &lt;p class=&quot;mb-0 text-muted&quot;&gt;Campaign &lt;strong class=&quot;text-primary&quot;&gt;Holiday Sale&lt;/strong&gt; is nearly reach budget limit.&lt;/p&gt;
                                                        &lt;small class=&quot;text-muted&quot;&gt;10:00 AM Today&lt;/small&gt;
                                                    &lt;/div&gt;
                                                &lt;/a&gt;
                                            &lt;/li&gt;
                                            &lt;li class=&quot;py-2 mb-1 border-bottom&quot;&gt;
                                                &lt;a href=&quot;javascript:void(0);&quot; class=&quot;d-flex&quot;&gt;
                                                    &lt;div class=&quot;avatar rounded no-thumbnail&quot;&gt;&lt;i class=&quot;fa fa-thumbs-up fa-lg&quot;&gt;&lt;/i&gt;&lt;/div&gt;
                                                    &lt;div class=&quot;flex-fill ms-3&quot;&gt;
                                                        &lt;p class=&quot;mb-0 text-muted&quot;&gt;Your New Campaign &lt;strong class=&quot;text-primary&quot;&gt;Holiday Sale&lt;/strong&gt; is approved.&lt;/p&gt;
                                                        &lt;small class=&quot;text-muted&quot;&gt;11:30 AM Today&lt;/small&gt;
                                                    &lt;/div&gt;
                                                &lt;/a&gt;
                                            &lt;/li&gt;
                                            &lt;li class=&quot;py-2 mb-1 border-bottom&quot;&gt;
                                                &lt;a href=&quot;javascript:void(0);&quot; class=&quot;d-flex&quot;&gt;
                                                    &lt;div class=&quot;avatar rounded no-thumbnail&quot;&gt;&lt;i class=&quot;fa fa-pie-chart fa-lg&quot;&gt;&lt;/i&gt;&lt;/div&gt;
                                                    &lt;div class=&quot;flex-fill ms-3&quot;&gt;
                                                        &lt;p class=&quot;mb-0 text-muted&quot;&gt;Website visits from Twitter is &lt;strong class=&quot;text-danger&quot;&gt;27% higher&lt;/strong&gt; than last week.&lt;/p&gt;
                                                        &lt;small class=&quot;text-muted&quot;&gt;04:00 PM Today&lt;/small&gt;
                                                    &lt;/div&gt;
                                                &lt;/a&gt;
                                            &lt;/li&gt;
                                            &lt;li class=&quot;py-2 mb-1 border-bottom&quot;&gt;
                                                &lt;a href=&quot;javascript:void(0);&quot; class=&quot;d-flex&quot;&gt;
                                                    &lt;div class=&quot;avatar rounded no-thumbnail&quot;&gt;&lt;i class=&quot;fa fa-warning fa-lg&quot;&gt;&lt;/i&gt;&lt;/div&gt;
                                                    &lt;div class=&quot;flex-fill ms-3&quot;&gt;
                                                        &lt;p class=&quot;mb-0 text-muted&quot;&gt;&lt;strong class=&quot;text-warning&quot;&gt;Error&lt;/strong&gt; on website analytics configurations&lt;/p&gt;
                                                        &lt;small class=&quot;text-muted&quot;&gt;Yesterday&lt;/small&gt;
                                                    &lt;/div&gt;
                                                &lt;/a&gt;
                                            &lt;/li&gt;
                                            &lt;li class=&quot;py-2 mb-1 border-bottom&quot;&gt;
                                                &lt;a href=&quot;javascript:void(0);&quot; class=&quot;d-flex&quot;&gt;
                                                    &lt;div class=&quot;avatar rounded no-thumbnail&quot;&gt;&lt;i class=&quot;fa fa-thumbs-up fa-lg&quot;&gt;&lt;/i&gt;&lt;/div&gt;
                                                    &lt;div class=&quot;flex-fill ms-3&quot;&gt;
                                                        &lt;p class=&quot;mb-0 text-muted&quot;&gt;Your New Campaign &lt;strong class=&quot;text-primary&quot;&gt;Holiday Sale&lt;/strong&gt; is approved.&lt;/p&gt;
                                                        &lt;small class=&quot;text-muted&quot;&gt;11:30 AM Today&lt;/small&gt;
                                                    &lt;/div&gt;
                                                &lt;/a&gt;
                                            &lt;/li&gt;
                                        &lt;/ul&gt;
                                    &lt;/div&gt;
                                    &lt;div class=&quot;tab-pane fade&quot; id=&quot;Noti-tab-Logs&quot; role=&quot;tabpanel&quot;&gt;
                                        &lt;h4&gt;No Logs right now!&lt;/h4&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;
                                &lt;a class=&quot;card-footer text-center border-top-0&quot; href=&quot;#&quot;&gt; View all notifications&lt;/a&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;
                    &lt;/div&gt;
                    &lt;div class=&quot;dropdown user-profile ms-2 ms-sm-3&quot;&gt;
                        &lt;a class=&quot;nav-link dropdown-toggle pulse p-0&quot; href=&quot;#&quot; role=&quot;button&quot; data-bs-toggle=&quot;dropdown&quot;&gt;
                            &lt;img class=&quot;avatar rounded-circle img-thumbnail&quot; src=&quot;{!! backendAssets('dist/assets/images/profile_av.svg') !!}&quot; alt=&quot;&quot;&gt;
                        &lt;/a&gt;
                        &lt;div class=&quot;dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-right p-0 m-0&quot;&gt;
                            &lt;div class=&quot;card border-0 w240&quot;&gt;
                                &lt;div class=&quot;card-body border-bottom&quot;&gt;
                                    &lt;div class=&quot;d-flex py-1&quot;&gt;
                                        &lt;img class=&quot;avatar rounded-circle&quot; src=&quot;{!! backendAssets('dist/assets/images/profile_av.svg') !!}&quot; alt=&quot;&quot;&gt;
                                        &lt;div class=&quot;flex-fill ms-3&quot;&gt;
                                            &lt;p class=&quot;mb-0 text-muted&quot;&gt;&lt;span class=&quot;font-weight-bold&quot;&gt;Chris Fox&lt;/span&gt;&lt;/p&gt;
                                            &lt;small class=&quot;text-muted&quot;&gt;chris.fox@gamil.com&lt;/small&gt;
                                            &lt;div&gt;
                                                &lt;a href=&quot;#&quot; class=&quot;card-link&quot;&gt;Sign out&lt;/a&gt;
                                            &lt;/div&gt;
                                        &lt;/div&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;
                                &lt;div class=&quot;list-group m-2&quot;&gt;
                                    &lt;a href=&quot;#&quot; class=&quot;list-group-item list-group-item-action border-0&quot;&gt;&lt;i class=&quot;w30 fa fa-user&quot;&gt;&lt;/i&gt;Profile &amp;amp; account&lt;/a&gt;
                                    &lt;a href=&quot;#&quot; class=&quot;list-group-item list-group-item-action border-0&quot;&gt;&lt;i class=&quot;w30 fa fa-gear&quot;&gt;&lt;/i&gt;Settings&lt;/a&gt;
                                    &lt;a href=&quot;#&quot; class=&quot;list-group-item list-group-item-action border-0&quot;&gt;&lt;i class=&quot;w30 fa fa-tag&quot;&gt;&lt;/i&gt;Customization&lt;/a&gt;
                                    &lt;a href=&quot;#&quot; class=&quot;list-group-item list-group-item-action border-0&quot;&gt;&lt;i class=&quot;w30 fa fa-users&quot;&gt;&lt;/i&gt;Manage team&lt;/a&gt;
                                    &lt;a href=&quot;#&quot; class=&quot;list-group-item list-group-item-action border-0&quot;&gt;&lt;i class=&quot;w30 fa fa-calendar&quot;&gt;&lt;/i&gt;My Events&lt;/a&gt;
                                    &lt;a href=&quot;#&quot; class=&quot;list-group-item list-group-item-action border-0&quot;&gt;&lt;i class=&quot;w30 fa fa-credit-card&quot;&gt;&lt;/i&gt;My Statements&lt;/a&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;
                    &lt;/div&gt;
                &lt;/div&gt;

                &lt;!-- menu toggler --&gt;
                &lt;button class=&quot;navbar-toggler p-0 border-0&quot; type=&quot;button&quot; data-bs-toggle=&quot;collapse&quot; data-bs-target=&quot;#mainHeader5&quot;&gt;
                    &lt;span class=&quot;fa fa-bars&quot;&gt;&lt;/span&gt;
                &lt;/button&gt;

                &lt;!-- main menu --&gt;
                &lt;div class=&quot;collapse navbar-collapse order-0&quot; id=&quot;mainHeader5&quot;&gt;
                    &lt;ul class=&quot;navbar-nav me-auto&quot;&gt;
                        &lt;li class=&quot;nav-item&quot;&gt;
                            &lt;a class=&quot;nav-link active&quot; href=&quot;#&quot;&gt;&lt;i class=&quot;fa fa-dashboard me-2&quot;&gt;&lt;/i&gt;&lt;span&gt;Dashboard&lt;/span&gt;&lt;/a&gt;
                        &lt;/li&gt;
                        &lt;li class=&quot;nav-item dropdown&quot;&gt;
                            &lt;a class=&quot;nav-link dropdown-toggle&quot; href=&quot;#&quot; role=&quot;button&quot; data-bs-toggle=&quot;dropdown&quot; aria-expanded=&quot;false&quot;&gt;
                                &lt;i class=&quot;fa fa-slack me-2&quot;&gt;&lt;/i&gt;&lt;span&gt;Apps&lt;/span&gt;
                            &lt;/a&gt;
                            &lt;ul class=&quot;dropdown-menu rounded-lg shadow border-0 dropdown-animation&quot;&gt;
                                &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Calendar&lt;/a&gt;&lt;/li&gt;
                                &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Chat app&lt;/a&gt;&lt;/li&gt;
                                &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Inbox&lt;/a&gt;&lt;/li&gt;
                            &lt;/ul&gt;
                        &lt;/li&gt;
                        &lt;li class=&quot;nav-item dropdown&quot;&gt;
                            &lt;a class=&quot;nav-link dropdown-toggle&quot; href=&quot;#&quot; role=&quot;button&quot; data-bs-toggle=&quot;dropdown&quot; aria-expanded=&quot;false&quot;&gt;
                                &lt;i class=&quot;fa fa-file me-2&quot;&gt;&lt;/i&gt;&lt;span&gt;Pages&lt;/span&gt;
                            &lt;/a&gt;
                            &lt;ul class=&quot;dropdown-menu rounded-lg shadow border-0 dropdown-animation&quot;&gt;
                                &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Profile&lt;/a&gt;&lt;/li&gt;
                                &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Timeline&lt;/a&gt;&lt;/li&gt;
                                &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Image Gallery&lt;/a&gt;&lt;/li&gt;
                                &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Invoices&lt;/a&gt;&lt;/li&gt;
                                &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Pricing&lt;/a&gt;&lt;/li&gt;
                                &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Teams Board&lt;/a&gt;&lt;/li&gt;
                                &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;FAQs&lt;/a&gt;&lt;/li&gt;
                                &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Widget's&lt;/a&gt;&lt;/li&gt;
                            &lt;/ul&gt;
                        &lt;/li&gt;
                        &lt;li class=&quot;nav-item dropdown&quot;&gt;
                            &lt;a class=&quot;nav-link dropdown-toggle&quot; href=&quot;#&quot; role=&quot;button&quot; data-bs-toggle=&quot;dropdown&quot; aria-expanded=&quot;false&quot;&gt;
                                &lt;i class=&quot;fa fa-lock me-2&quot;&gt;&lt;/i&gt;&lt;span&gt;Authentication&lt;/span&gt;
                            &lt;/a&gt;
                            &lt;ul class=&quot;dropdown-menu rounded-lg shadow border-0 dropdown-animation&quot;&gt;
                                &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Sign in&lt;/a&gt;&lt;/li&gt;
                                &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Sign up&lt;/a&gt;&lt;/li&gt;
                                &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Password reset&lt;/a&gt;&lt;/li&gt;
                                &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;2-Step Authentication&lt;/a&gt;&lt;/li&gt;
                                &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;404&lt;/a&gt;&lt;/li&gt;
                            &lt;/ul&gt;
                        &lt;/li&gt;
                        &lt;li class=&quot;nav-item dropdown&quot;&gt;
                            &lt;a class=&quot;nav-link dropdown-toggle&quot; href=&quot;#&quot; role=&quot;button&quot; data-bs-toggle=&quot;dropdown&quot; aria-expanded=&quot;false&quot;&gt;
                                &lt;i class=&quot;fa fa-file-text me-2&quot;&gt;&lt;/i&gt;&lt;span&gt;Docs&lt;/span&gt;
                            &lt;/a&gt;
                            &lt;ul class=&quot;dropdown-menu rounded-lg shadow border-0 dropdown-animation&quot;&gt;
                                &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Stater page&lt;/a&gt;&lt;/li&gt;
                                &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Documentation&lt;/a&gt;&lt;/li&gt;
                                &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Changelog&lt;/a&gt;&lt;/li&gt;
                            &lt;/ul&gt;
                        &lt;/li&gt;
                    &lt;/ul&gt;
                &lt;/div&gt;

            &lt;/div&gt;
        &lt;/nav&gt;

        &lt;!-- Search: div --&gt;
        &lt;div class=&quot;border-bottom px-lg-5 px-md-2 collapse bg-primary&quot; id=&quot;main-search&quot;&gt;
            &lt;div class=&quot;container py-4&quot;&gt;

                &lt;div class=&quot;input-group&quot;&gt;
                    &lt;input type=&quot;text&quot; class=&quot;form-control border-0 p-0 bg-transparent&quot; placeholder=&quot;Search. Components, Layouts, etc...&quot;&gt;

                    &lt;div class=&quot;input-group-append ms-3&quot;&gt;
                        &lt;button class=&quot;btn btn-light&quot; type=&quot;submit&quot;&gt;Search&lt;/button&gt;
                    &lt;/div&gt;
                &lt;/div&gt;

            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <ul class="nav nav-tabs tab-card px-3 border-bottom-0" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav-Preview3" role="tab">Preview</a></li>
                                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-HTML3" role="tab">HTML</a></li>
                                </ul>
                                <div class="card mb-3 bg-transparent">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="nav-Preview3" role="tabpanel">
                                                <div class="header shadow-sm">
                                                    <nav class="navbar navbar-light bg-secondary py-2 py-md-3 px-lg-5 px-md-2">
                                                        <div class="container-xxl">
                                            
                                                            <!-- Brand -->
                                                            <a href="{!! backendRoutePut('home') !!}" class="me-3 me-lg-4 brand-icon">
                                                                <svg width="35" height="35" fill="currentColor" class="bi bi-app-indicator " viewBox="0 0 16 16">
                                                                    <path d="M5.5 2A3.5 3.5 0 0 0 2 5.5v5A3.5 3.5 0 0 0 5.5 14h5a3.5 3.5 0 0 0 3.5-3.5V8a.5.5 0 0 1 1 0v2.5a4.5 4.5 0 0 1-4.5 4.5h-5A4.5 4.5 0 0 1 1 10.5v-5A4.5 4.5 0 0 1 5.5 1H8a.5.5 0 0 1 0 1H5.5z"></path>
                                                                    <path d="M16 3a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"></path>
                                                                </svg>
                                                            </a>
                                            
                                                            <!-- Search -->
                                                            <div class="h-left">
                                                                <div class="input-group border rounded">
                                                                    <button class="btn btn-outline-secondary dropdown-toggle border-0 d-none d-sm-block" type="button" data-bs-toggle="dropdown" aria-expanded="false">Fillter</button>
                                                                    <ul class="dropdown-menu border-0 shadow">
                                                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                                        <li><hr class="dropdown-divider"></li>
                                                                        <li><a class="dropdown-item" href="#">Separated link</a></li>
                                                                    </ul>
                                                                    <input type="text" class="form-control bg-transparent border-0" placeholder="Search here...">
                                                                </div>
                                                            </div>
                                            
                                                            <!-- header rightbar icon -->
                                                            <div class="h-right flex-grow-1 justify-content-end d-flex align-items-center me-5 me-lg-0">
                                                                <div class="d-flex">
                                                                    <a class="nav-link text-primary" href="#" title="Settings" data-bs-toggle="modal" data-bs-target="#SettingsModal"><i class="fa fa-gear"></i></a>
                                                                    <a class="nav-link text-primary" href="#" data-bs-toggle="modal" data-bs-target="#LayoutModal">
                                                                        <i class="fa fa-sliders"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="dropdown notifications">
                                                                    <a class="nav-link dropdown-toggle pulse" href="#" role="button" data-bs-toggle="dropdown">
                                                                        <i class="fa fa-bell"></i>
                                                                        <span class="pulse-ring"></span>
                                                                    </a>
                                                                </div>
                                                                <div class="dropdown user-profile ms-2 ms-sm-3">
                                                                    <a class="nav-link dropdown-toggle pulse p-0" href="#" role="button" data-bs-toggle="dropdown">
                                                                        <img class="avatar rounded-circle img-thumbnail" src="{!! backendAssets('dist/assets/images/profile_av.svg') !!}" alt="">
                                                                    </a>
                                                                </div>
                                                            </div>
                                            
                                                        </div>
                                                    </nav>
                                            
                                                    <div class="sub-header">
                                                        <nav class="navbar navbar-light navbar-expand-lg p-0">
                                                            <div class="container-xxl">
                                            
                                                                <!-- menu toggler -->
                                                                <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainHeader1">
                                                                    <span class="fa fa-bars"></span>
                                                                </button>
                                            
                                                                <!-- main menu -->
                                                                <div class="collapse navbar-collapse order-0 py-1 py-md-2 px-lg-5 px-md-4" id="mainHeader1">
                                                                    <ul class="navbar-nav me-auto">
                                                                        <li class="nav-item">
                                                                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <a class="nav-link" href="#">Features</a>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <a class="nav-link" href="#">Pricing</a>
                                                                        </li>
                                                                        <li class="nav-item dropdown">
                                                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                Dropdown link
                                                                            </a>
                                                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                                                                <li><a class="dropdown-item" href="#">Action</a></li>
                                                                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                                                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                                            </ul>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </nav>
                                                    </div>
                                            
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="nav-HTML3" role="tabpanel">
    <pre class="language-html m-0" data-lang="html">
    <code>&lt;div class=&quot;header shadow-sm&quot;&gt;
        &lt;nav class=&quot;navbar navbar-light bg-secondary py-2 py-md-3 px-lg-5 px-md-2&quot;&gt;
            &lt;div class=&quot;container-xxl&quot;&gt;

                &lt;!-- Brand --&gt;
                &lt;a href=&quot;{!! backendRoutePut('home') !!}&quot; class=&quot;me-3 me-lg-4 brand-icon&quot;&gt;
                    &lt;svg xmlns=&quot;http://www.w3.org/2000/svg&quot; width=&quot;24&quot; viewBox=&quot;0 0 64 80&quot; fill=&quot;none&quot;&gt;
                        &lt;path d=&quot;M58.8996 22.7L26.9996 2.2C23.4996 -0.0999999 18.9996 0 15.5996 2.5C12.1996 5 10.6996 9.2 11.7996 13.3L15.7996 26.8L3.49962 39.9C-3.30038 47.7 3.79962 54.5 3.89962 54.6L3.99962 54.7L36.3996 78.5C36.4996 78.6 36.5996 78.6 36.6996 78.7C37.8996 79.2 39.1996 79.4 40.3996 79.4C42.9996 79.4 45.4996 78.4 47.4996 76.4C50.2996 73.5 51.1996 69.4 49.6996 65.6L45.1996 51.8L58.9996 39.4C61.7996 37.5 63.3996 34.4 63.3996 31.1C63.4996 27.7 61.7996 24.5 58.8996 22.7ZM46.7996 66.7V66.8C48.0996 69.9 46.8996 72.7 45.2996 74.3C43.7996 75.9 41.0996 77.1 37.9996 76L5.89961 52.3C5.29961 51.7 1.09962 47.3 5.79962 42L16.8996 30.1L23.4996 52.1C24.3996 55.2 26.5996 57.7 29.5996 58.8C30.7996 59.2 31.9996 59.5 33.1996 59.5C35.0996 59.5 36.9996 58.9 38.6996 57.8C38.7996 57.8 38.7996 57.7 38.8996 57.7L42.7996 54.2L46.7996 66.7ZM57.2996 36.9C57.1996 36.9 57.1996 37 57.0996 37L44.0996 48.7L36.4996 25.5V25.4C35.1996 22.2 32.3996 20 28.9996 19.3C25.5996 18.7 22.1996 19.8 19.8996 22.3L18.2996 24L14.7996 12.3C13.8996 8.9 15.4996 6.2 17.3996 4.8C18.4996 4 19.8996 3.4 21.4996 3.4C22.6996 3.4 23.9996 3.7 25.2996 4.6L57.1996 25.1C59.1996 26.4 60.2996 28.6 60.2996 30.9C60.3996 33.4 59.2996 35.6 57.2996 36.9Z&quot; fill=&quot;black&quot;&gt;&lt;/path&gt;
                    &lt;/svg&gt;
                &lt;/a&gt;

                &lt;!-- Search --&gt;
                &lt;div class=&quot;h-left&quot;&gt;
                    &lt;div class=&quot;input-group border rounded&quot;&gt;
                        &lt;button class=&quot;btn btn-outline-secondary dropdown-toggle border-0 d-none d-sm-block&quot; type=&quot;button&quot; data-bs-toggle=&quot;dropdown&quot; aria-expanded=&quot;false&quot;&gt;Fillter&lt;/button&gt;
                        &lt;ul class=&quot;dropdown-menu border-0 shadow&quot;&gt;
                            &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Action&lt;/a&gt;&lt;/li&gt;
                            &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Another action&lt;/a&gt;&lt;/li&gt;
                            &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Something else here&lt;/a&gt;&lt;/li&gt;
                            &lt;li&gt;&lt;hr class=&quot;dropdown-divider&quot;&gt;&lt;/li&gt;
                            &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Separated link&lt;/a&gt;&lt;/li&gt;
                        &lt;/ul&gt;
                        &lt;input type=&quot;text&quot; class=&quot;form-control bg-transparent border-0&quot; placeholder=&quot;Search here...&quot;&gt;
                    &lt;/div&gt;
                &lt;/div&gt;

                &lt;!-- header rightbar icon --&gt;
                &lt;div class=&quot;h-right flex-grow-1 justify-content-end d-flex align-items-center me-5 me-lg-0&quot;&gt;
                    &lt;div class=&quot;d-flex&quot;&gt;
                        &lt;a class=&quot;nav-link text-primary&quot; href=&quot;#&quot; title=&quot;Settings&quot; data-bs-toggle=&quot;modal&quot; data-bs-target=&quot;#SettingsModal&quot;&gt;&lt;i class=&quot;fa fa-gear&quot;&gt;&lt;/i&gt;&lt;/a&gt;
                        &lt;a class=&quot;nav-link text-primary&quot; href=&quot;#&quot; data-bs-toggle=&quot;modal&quot; data-bs-target=&quot;#LayoutModal&quot;&gt;
                            &lt;i class=&quot;fa fa-sliders&quot;&gt;&lt;/i&gt;
                        &lt;/a&gt;
                    &lt;/div&gt;
                    &lt;div class=&quot;dropdown notifications&quot;&gt;
                        &lt;a class=&quot;nav-link dropdown-toggle pulse&quot; href=&quot;#&quot; role=&quot;button&quot; data-bs-toggle=&quot;dropdown&quot;&gt;
                            &lt;i class=&quot;fa fa-bell&quot;&gt;&lt;/i&gt;
                            &lt;span class=&quot;pulse-ring&quot;&gt;&lt;/span&gt;
                        &lt;/a&gt;
                        &lt;div id=&quot;NotificationsDiv&quot; class=&quot;dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-right p-0 m-0&quot;&gt;
                            &lt;div class=&quot;card border-0 w380&quot;&gt;
                                &lt;div class=&quot;card-header border-0 p-3&quot;&gt;
                                    &lt;h5 class=&quot;mb-0 font-weight-light d-flex justify-content-between&quot;&gt;
                                        &lt;span&gt;Notifications Center&lt;/span&gt;
                                        &lt;span class=&quot;badge text-muted&quot;&gt;14&lt;/span&gt;
                                    &lt;/h5&gt;
                                    &lt;ul class=&quot;nav nav-tabs mt-3 border-bottom-0&quot; role=&quot;tablist&quot;&gt;
                                        &lt;li class=&quot;nav-item&quot;&gt;
                                            &lt;a class=&quot;nav-link font-weight-light ps-0 me-2 active&quot; data-bs-toggle=&quot;tab&quot; href=&quot;#Noti-tab-Message&quot; role=&quot;tab&quot;&gt;Message&lt;/a&gt;
                                        &lt;/li&gt;
                                        &lt;li class=&quot;nav-item&quot;&gt;
                                            &lt;a class=&quot;nav-link font-weight-light me-2&quot; data-bs-toggle=&quot;tab&quot; href=&quot;#Noti-tab-Events&quot; role=&quot;tab&quot;&gt;Events&lt;/a&gt;
                                        &lt;/li&gt;
                                        &lt;li class=&quot;nav-item&quot;&gt;
                                            &lt;a class=&quot;nav-link font-weight-light&quot; data-bs-toggle=&quot;tab&quot; href=&quot;#Noti-tab-Logs&quot; role=&quot;tab&quot;&gt;Logs&lt;/a&gt;
                                        &lt;/li&gt;
                                    &lt;/ul&gt;
                                &lt;/div&gt;
                                &lt;div class=&quot;tab-content card-body&quot;&gt;
                                    &lt;div class=&quot;tab-pane fade show active&quot; id=&quot;Noti-tab-Message&quot; role=&quot;tabpanel&quot;&gt;
                                        &lt;ul class=&quot;list-unstyled list mb-0&quot;&gt;
                                            &lt;li class=&quot;py-2 mb-1 border-bottom&quot;&gt;
                                                &lt;a href=&quot;javascript:void(0);&quot; class=&quot;d-flex&quot;&gt;
                                                    &lt;img class=&quot;avatar rounded-circle&quot; src=&quot;{!! backendAssets('dist/assets/images/xs/avatar1.svg') !!}&quot; alt=&quot;&quot;&gt;
                                                    &lt;div class=&quot;flex-fill ms-3&quot;&gt;
                                                        &lt;p class=&quot;d-flex justify-content-between mb-0 text-muted&quot;&gt;&lt;span class=&quot;font-weight-bold&quot;&gt;Chris Fox&lt;/span&gt; &lt;small&gt;2MIN&lt;/small&gt;&lt;/p&gt;
                                                        &lt;span class=&quot;text-muted&quot;&gt;changed an issue from &quot;In Progress&quot; to &lt;span class=&quot;badge bg-success&quot;&gt;Review&lt;/span&gt;&lt;/span&gt;
                                                    &lt;/div&gt;
                                                &lt;/a&gt;
                                            &lt;/li&gt;
                                            &lt;li class=&quot;py-2 mb-1 border-bottom&quot;&gt;
                                                &lt;a href=&quot;javascript:void(0);&quot; class=&quot;d-flex&quot;&gt;
                                                    &lt;div class=&quot;avatar rounded-circle no-thumbnail&quot;&gt;RH&lt;/div&gt;
                                                    &lt;div class=&quot;flex-fill ms-3&quot;&gt;
                                                        &lt;p class=&quot;d-flex justify-content-between mb-0 text-muted&quot;&gt;&lt;span class=&quot;font-weight-bold&quot;&gt;Robert Hammer&lt;/span&gt; &lt;small&gt;13MIN&lt;/small&gt;&lt;/p&gt;
                                                        &lt;span class=&quot;text-muted&quot;&gt;It is a long established fact that a reader will be distracted&lt;/span&gt;
                                                    &lt;/div&gt;
                                                &lt;/a&gt;
                                            &lt;/li&gt;
                                            &lt;li class=&quot;py-2 mb-1 border-bottom&quot;&gt;
                                                &lt;a href=&quot;javascript:void(0);&quot; class=&quot;d-flex&quot;&gt;
                                                    &lt;img class=&quot;avatar rounded-circle&quot; src=&quot;{!! backendAssets('dist/assets/images/xs/avatar3.svg') !!}&quot; alt=&quot;&quot;&gt;
                                                    &lt;div class=&quot;flex-fill ms-3&quot;&gt;
                                                        &lt;p class=&quot;d-flex justify-content-between mb-0 text-muted&quot;&gt;&lt;span class=&quot;font-weight-bold&quot;&gt;Orlando Lentz&lt;/span&gt; &lt;small&gt;1HR&lt;/small&gt;&lt;/p&gt;
                                                        &lt;span class=&quot;text-muted&quot;&gt;There are many variations of passages&lt;/span&gt;
                                                    &lt;/div&gt;
                                                &lt;/a&gt;
                                            &lt;/li&gt;
                                            &lt;li class=&quot;py-2 mb-1 border-bottom&quot;&gt;
                                                &lt;a href=&quot;javascript:void(0);&quot; class=&quot;d-flex&quot;&gt;
                                                    &lt;img class=&quot;avatar rounded-circle&quot; src=&quot;{!! backendAssets('dist/assets/images/xs/avatar4.svg') !!}&quot; alt=&quot;&quot;&gt;
                                                    &lt;div class=&quot;flex-fill ms-3&quot;&gt;
                                                        &lt;p class=&quot;d-flex justify-content-between mb-0 text-muted&quot;&gt;&lt;span class=&quot;font-weight-bold&quot;&gt;Barbara Kelly&lt;/span&gt; &lt;small&gt;1DAY&lt;/small&gt;&lt;/p&gt;
                                                        &lt;span class=&quot;text-muted&quot;&gt;Contrary to popular belief &lt;span class=&quot;badge bg-danger&quot;&gt;Code&lt;/span&gt;&lt;/span&gt;
                                                    &lt;/div&gt;
                                                &lt;/a&gt;
                                            &lt;/li&gt;
                                            &lt;li class=&quot;py-2 mb-1 border-bottom&quot;&gt;
                                                &lt;a href=&quot;javascript:void(0);&quot; class=&quot;d-flex&quot;&gt;
                                                    &lt;img class=&quot;avatar rounded-circle&quot; src=&quot;{!! backendAssets('dist/assets/images/xs/avatar5.svg') !!}&quot; alt=&quot;&quot;&gt;
                                                    &lt;div class=&quot;flex-fill ms-3&quot;&gt;
                                                        &lt;p class=&quot;d-flex justify-content-between mb-0 text-muted&quot;&gt;&lt;span class=&quot;font-weight-bold&quot;&gt;Robert Hammer&lt;/span&gt; &lt;small&gt;13MIN&lt;/small&gt;&lt;/p&gt;
                                                        &lt;span class=&quot;text-muted&quot;&gt;making it over 2000 years old&lt;/span&gt;
                                                    &lt;/div&gt;
                                                &lt;/a&gt;
                                            &lt;/li&gt;
                                            &lt;li class=&quot;py-2 mb-1 border-bottom&quot;&gt;
                                                &lt;a href=&quot;javascript:void(0);&quot; class=&quot;d-flex&quot;&gt;
                                                    &lt;img class=&quot;avatar rounded-circle&quot; src=&quot;{!! backendAssets('dist/assets/images/xs/avatar6.svg') !!}&quot; alt=&quot;&quot;&gt;
                                                    &lt;div class=&quot;flex-fill ms-3&quot;&gt;
                                                        &lt;p class=&quot;d-flex justify-content-between mb-0 text-muted&quot;&gt;&lt;span class=&quot;font-weight-bold&quot;&gt;Orlando Lentz&lt;/span&gt; &lt;small&gt;1HR&lt;/small&gt;&lt;/p&gt;
                                                        &lt;span class=&quot;text-muted&quot;&gt;There are many variations of passages&lt;/span&gt;
                                                    &lt;/div&gt;
                                                &lt;/a&gt;
                                            &lt;/li&gt;
                                            &lt;li class=&quot;py-2&quot;&gt;
                                                &lt;a href=&quot;javascript:void(0);&quot; class=&quot;d-flex&quot;&gt;
                                                    &lt;img class=&quot;avatar rounded-circle&quot; src=&quot;{!! backendAssets('dist/assets/images/xs/avatar7.svg') !!}&quot; alt=&quot;&quot;&gt;
                                                    &lt;div class=&quot;flex-fill ms-3&quot;&gt;
                                                        &lt;p class=&quot;d-flex justify-content-between mb-0 text-muted&quot;&gt;&lt;span class=&quot;font-weight-bold&quot;&gt;Rose Rivera&lt;/span&gt; &lt;small class=&quot;&quot;&gt;1DAY&lt;/small&gt;&lt;/p&gt;
                                                        &lt;span class=&quot;text-muted&quot;&gt;Add Calander Event&lt;/span&gt;
                                                    &lt;/div&gt;
                                                &lt;/a&gt;
                                            &lt;/li&gt;
                                        &lt;/ul&gt;
                                    &lt;/div&gt;
                                    &lt;div class=&quot;tab-pane fade&quot; id=&quot;Noti-tab-Events&quot; role=&quot;tabpanel&quot;&gt;
                                        &lt;ul class=&quot;list-unstyled list mb-0&quot;&gt;
                                            &lt;li class=&quot;py-2 mb-1 border-bottom&quot;&gt;
                                                &lt;a href=&quot;javascript:void(0);&quot; class=&quot;d-flex&quot;&gt;
                                                    &lt;div class=&quot;avatar rounded no-thumbnail&quot;&gt;&lt;i class=&quot;fa fa-info-circle fa-lg&quot;&gt;&lt;/i&gt;&lt;/div&gt;
                                                    &lt;div class=&quot;flex-fill ms-3&quot;&gt;
                                                        &lt;p class=&quot;mb-0 text-muted&quot;&gt;Campaign &lt;strong class=&quot;text-primary&quot;&gt;Holiday Sale&lt;/strong&gt; is nearly reach budget limit.&lt;/p&gt;
                                                        &lt;small class=&quot;text-muted&quot;&gt;10:00 AM Today&lt;/small&gt;
                                                    &lt;/div&gt;
                                                &lt;/a&gt;
                                            &lt;/li&gt;
                                            &lt;li class=&quot;py-2 mb-1 border-bottom&quot;&gt;
                                                &lt;a href=&quot;javascript:void(0);&quot; class=&quot;d-flex&quot;&gt;
                                                    &lt;div class=&quot;avatar rounded no-thumbnail&quot;&gt;&lt;i class=&quot;fa fa-thumbs-up fa-lg&quot;&gt;&lt;/i&gt;&lt;/div&gt;
                                                    &lt;div class=&quot;flex-fill ms-3&quot;&gt;
                                                        &lt;p class=&quot;mb-0 text-muted&quot;&gt;Your New Campaign &lt;strong class=&quot;text-primary&quot;&gt;Holiday Sale&lt;/strong&gt; is approved.&lt;/p&gt;
                                                        &lt;small class=&quot;text-muted&quot;&gt;11:30 AM Today&lt;/small&gt;
                                                    &lt;/div&gt;
                                                &lt;/a&gt;
                                            &lt;/li&gt;
                                            &lt;li class=&quot;py-2 mb-1 border-bottom&quot;&gt;
                                                &lt;a href=&quot;javascript:void(0);&quot; class=&quot;d-flex&quot;&gt;
                                                    &lt;div class=&quot;avatar rounded no-thumbnail&quot;&gt;&lt;i class=&quot;fa fa-pie-chart fa-lg&quot;&gt;&lt;/i&gt;&lt;/div&gt;
                                                    &lt;div class=&quot;flex-fill ms-3&quot;&gt;
                                                        &lt;p class=&quot;mb-0 text-muted&quot;&gt;Website visits from Twitter is &lt;strong class=&quot;text-danger&quot;&gt;27% higher&lt;/strong&gt; than last week.&lt;/p&gt;
                                                        &lt;small class=&quot;text-muted&quot;&gt;04:00 PM Today&lt;/small&gt;
                                                    &lt;/div&gt;
                                                &lt;/a&gt;
                                            &lt;/li&gt;
                                            &lt;li class=&quot;py-2 mb-1 border-bottom&quot;&gt;
                                                &lt;a href=&quot;javascript:void(0);&quot; class=&quot;d-flex&quot;&gt;
                                                    &lt;div class=&quot;avatar rounded no-thumbnail&quot;&gt;&lt;i class=&quot;fa fa-warning fa-lg&quot;&gt;&lt;/i&gt;&lt;/div&gt;
                                                    &lt;div class=&quot;flex-fill ms-3&quot;&gt;
                                                        &lt;p class=&quot;mb-0 text-muted&quot;&gt;&lt;strong class=&quot;text-warning&quot;&gt;Error&lt;/strong&gt; on website analytics configurations&lt;/p&gt;
                                                        &lt;small class=&quot;text-muted&quot;&gt;Yesterday&lt;/small&gt;
                                                    &lt;/div&gt;
                                                &lt;/a&gt;
                                            &lt;/li&gt;
                                            &lt;li class=&quot;py-2 mb-1 border-bottom&quot;&gt;
                                                &lt;a href=&quot;javascript:void(0);&quot; class=&quot;d-flex&quot;&gt;
                                                    &lt;div class=&quot;avatar rounded no-thumbnail&quot;&gt;&lt;i class=&quot;fa fa-thumbs-up fa-lg&quot;&gt;&lt;/i&gt;&lt;/div&gt;
                                                    &lt;div class=&quot;flex-fill ms-3&quot;&gt;
                                                        &lt;p class=&quot;mb-0 text-muted&quot;&gt;Your New Campaign &lt;strong class=&quot;text-primary&quot;&gt;Holiday Sale&lt;/strong&gt; is approved.&lt;/p&gt;
                                                        &lt;small class=&quot;text-muted&quot;&gt;11:30 AM Today&lt;/small&gt;
                                                    &lt;/div&gt;
                                                &lt;/a&gt;
                                            &lt;/li&gt;
                                        &lt;/ul&gt;
                                    &lt;/div&gt;
                                    &lt;div class=&quot;tab-pane fade&quot; id=&quot;Noti-tab-Logs&quot; role=&quot;tabpanel&quot;&gt;
                                        &lt;h4&gt;No Logs right now!&lt;/h4&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;
                                &lt;a class=&quot;card-footer text-center border-top-0&quot; href=&quot;#&quot;&gt; View all notifications&lt;/a&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;
                    &lt;/div&gt;
                    &lt;div class=&quot;dropdown user-profile ms-2 ms-sm-3&quot;&gt;
                        &lt;a class=&quot;nav-link dropdown-toggle pulse p-0&quot; href=&quot;#&quot; role=&quot;button&quot; data-bs-toggle=&quot;dropdown&quot;&gt;
                            &lt;img class=&quot;avatar rounded-circle img-thumbnail&quot; src=&quot;{!! backendAssets('dist/assets/images/profile_av.svg') !!}&quot; alt=&quot;&quot;&gt;
                        &lt;/a&gt;
                        &lt;div class=&quot;dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-right p-0 m-0&quot;&gt;
                            &lt;div class=&quot;card border-0 w240&quot;&gt;
                                &lt;div class=&quot;card-body border-bottom&quot;&gt;
                                    &lt;div class=&quot;d-flex py-1&quot;&gt;
                                        &lt;img class=&quot;avatar rounded-circle&quot; src=&quot;{!! backendAssets('dist/assets/images/profile_av.svg') !!}&quot; alt=&quot;&quot;&gt;
                                        &lt;div class=&quot;flex-fill ms-3&quot;&gt;
                                            &lt;p class=&quot;mb-0 text-muted&quot;&gt;&lt;span class=&quot;font-weight-bold&quot;&gt;Chris Fox&lt;/span&gt;&lt;/p&gt;
                                            &lt;small class=&quot;text-muted&quot;&gt;chris.fox@gamil.com&lt;/small&gt;
                                            &lt;div&gt;
                                                &lt;a href=&quot;#&quot; class=&quot;card-link&quot;&gt;Sign out&lt;/a&gt;
                                            &lt;/div&gt;
                                        &lt;/div&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;
                                &lt;div class=&quot;list-group m-2&quot;&gt;
                                    &lt;a href=&quot;#&quot; class=&quot;list-group-item list-group-item-action border-0&quot;&gt;&lt;i class=&quot;w30 fa fa-user&quot;&gt;&lt;/i&gt;Profile &amp;amp; account&lt;/a&gt;
                                    &lt;a href=&quot;#&quot; class=&quot;list-group-item list-group-item-action border-0&quot;&gt;&lt;i class=&quot;w30 fa fa-gear&quot;&gt;&lt;/i&gt;Settings&lt;/a&gt;
                                    &lt;a href=&quot;#&quot; class=&quot;list-group-item list-group-item-action border-0&quot;&gt;&lt;i class=&quot;w30 fa fa-tag&quot;&gt;&lt;/i&gt;Customization&lt;/a&gt;
                                    &lt;a href=&quot;#&quot; class=&quot;list-group-item list-group-item-action border-0&quot;&gt;&lt;i class=&quot;w30 fa fa-users&quot;&gt;&lt;/i&gt;Manage team&lt;/a&gt;
                                    &lt;a href=&quot;#&quot; class=&quot;list-group-item list-group-item-action border-0&quot;&gt;&lt;i class=&quot;w30 fa fa-calendar&quot;&gt;&lt;/i&gt;My Events&lt;/a&gt;
                                    &lt;a href=&quot;#&quot; class=&quot;list-group-item list-group-item-action border-0&quot;&gt;&lt;i class=&quot;w30 fa fa-credit-card&quot;&gt;&lt;/i&gt;My Statements&lt;/a&gt;
                                &lt;/div&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;
                    &lt;/div&gt;
                &lt;/div&gt;

            &lt;/div&gt;
        &lt;/nav&gt;

        &lt;div class=&quot;sub-header&quot;&gt;
            &lt;nav class=&quot;navbar navbar-light navbar-expand-lg p-0&quot;&gt;
                &lt;div class=&quot;container-xxl&quot;&gt;

                    &lt;!-- menu toggler --&gt;
                    &lt;button class=&quot;navbar-toggler p-0 border-0&quot; type=&quot;button&quot; data-bs-toggle=&quot;collapse&quot; data-bs-target=&quot;#mainHeader1&quot;&gt;
                        &lt;span class=&quot;fa fa-bars&quot;&gt;&lt;/span&gt;
                    &lt;/button&gt;

                    &lt;!-- main menu --&gt;
                    &lt;div class=&quot;collapse navbar-collapse order-0 py-1 py-md-2 px-lg-5 px-md-4&quot; id=&quot;mainHeader1&quot;&gt;
                        &lt;ul class=&quot;navbar-nav me-auto&quot;&gt;
                            &lt;li class=&quot;nav-item&quot;&gt;
                                &lt;a class=&quot;nav-link active&quot; href=&quot;#&quot;&gt;&lt;i class=&quot;fa fa-dashboard me-2&quot;&gt;&lt;/i&gt;&lt;span&gt;Dashboard&lt;/span&gt;&lt;/a&gt;
                            &lt;/li&gt;
                            &lt;li class=&quot;nav-item dropdown&quot;&gt;
                                &lt;a class=&quot;nav-link dropdown-toggle&quot; href=&quot;#&quot; role=&quot;button&quot; data-bs-toggle=&quot;dropdown&quot; aria-expanded=&quot;false&quot;&gt;
                                    &lt;i class=&quot;fa fa-slack me-2&quot;&gt;&lt;/i&gt;&lt;span&gt;Apps&lt;/span&gt;
                                &lt;/a&gt;
                                &lt;ul class=&quot;dropdown-menu rounded-lg shadow border-0 dropdown-animation&quot;&gt;
                                    &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Calendar&lt;/a&gt;&lt;/li&gt;
                                    &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Chat app&lt;/a&gt;&lt;/li&gt;
                                    &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Inbox&lt;/a&gt;&lt;/li&gt;
                                &lt;/ul&gt;
                            &lt;/li&gt;
                            &lt;li class=&quot;nav-item dropdown&quot;&gt;
                                &lt;a class=&quot;nav-link dropdown-toggle&quot; href=&quot;#&quot; role=&quot;button&quot; data-bs-toggle=&quot;dropdown&quot; aria-expanded=&quot;false&quot;&gt;
                                    &lt;i class=&quot;fa fa-file me-2&quot;&gt;&lt;/i&gt;&lt;span&gt;Pages&lt;/span&gt;
                                &lt;/a&gt;
                                &lt;ul class=&quot;dropdown-menu rounded-lg shadow border-0 dropdown-animation&quot;&gt;
                                    &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Profile&lt;/a&gt;&lt;/li&gt;
                                    &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Timeline&lt;/a&gt;&lt;/li&gt;
                                    &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Image Gallery&lt;/a&gt;&lt;/li&gt;
                                    &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Invoices&lt;/a&gt;&lt;/li&gt;
                                    &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Pricing&lt;/a&gt;&lt;/li&gt;
                                    &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Teams Board&lt;/a&gt;&lt;/li&gt;
                                    &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;FAQs&lt;/a&gt;&lt;/li&gt;
                                    &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Widget's&lt;/a&gt;&lt;/li&gt;
                                &lt;/ul&gt;
                            &lt;/li&gt;
                            &lt;li class=&quot;nav-item dropdown&quot;&gt;
                                &lt;a class=&quot;nav-link dropdown-toggle&quot; href=&quot;#&quot; role=&quot;button&quot; data-bs-toggle=&quot;dropdown&quot; aria-expanded=&quot;false&quot;&gt;
                                    &lt;i class=&quot;fa fa-lock me-2&quot;&gt;&lt;/i&gt;&lt;span&gt;Authentication&lt;/span&gt;
                                &lt;/a&gt;
                                &lt;ul class=&quot;dropdown-menu rounded-lg shadow border-0 dropdown-animation&quot;&gt;
                                    &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Sign in&lt;/a&gt;&lt;/li&gt;
                                    &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Sign up&lt;/a&gt;&lt;/li&gt;
                                    &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Password reset&lt;/a&gt;&lt;/li&gt;
                                    &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;2-Step Authentication&lt;/a&gt;&lt;/li&gt;
                                    &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;404&lt;/a&gt;&lt;/li&gt;
                                &lt;/ul&gt;
                            &lt;/li&gt;
                            &lt;li class=&quot;nav-item dropdown&quot;&gt;
                                &lt;a class=&quot;nav-link dropdown-toggle&quot; href=&quot;#&quot; role=&quot;button&quot; data-bs-toggle=&quot;dropdown&quot; aria-expanded=&quot;false&quot;&gt;
                                    &lt;i class=&quot;fa fa-file-text me-2&quot;&gt;&lt;/i&gt;&lt;span&gt;Docs&lt;/span&gt;
                                &lt;/a&gt;
                                &lt;ul class=&quot;dropdown-menu rounded-lg shadow border-0 dropdown-animation&quot;&gt;
                                    &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Stater page&lt;/a&gt;&lt;/li&gt;
                                    &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Documentation&lt;/a&gt;&lt;/li&gt;
                                    &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Changelog&lt;/a&gt;&lt;/li&gt;
                                &lt;/ul&gt;
                            &lt;/li&gt;
                        &lt;/ul&gt;
                    &lt;/div&gt;

                &lt;/div&gt;
            &lt;/nav&gt;
        &lt;/div&gt;

    &lt;/div&gt;</code>
    </pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-top mt-5 pt-3">
                                <h3 id="external-content">External content</h3>
                                <p>Sometimes you want to use the collapse plugin to trigger hidden content elsewhere on the page. Because our plugin works on the <code>id</code> and <code>data-bs-target</code> matching, that’s easily done!</p>
                                <ul class="nav nav-tabs tab-card px-3 border-bottom-0" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav-Preview5" role="tab">Preview</a></li>
                                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-HTML5" role="tab">HTML</a></li>
                                </ul>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="nav-Preview5" role="tabpanel">
                                                <div class="collapse" id="navbarToggleExternalContent">
                                                    <div class="bg-dark p-4">
                                                        <h5 class="text-white h4">Collapsed content</h5>
                                                        <span class="text-muted">Toggleable via the navbar brand.</span>
                                                    </div>
                                                </div>
                                                <nav class="navbar navbar-dark bg-dark">
                                                        <div class="container-xxl">
                                                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                                                            <span class="navbar-toggler-icon"></span>
                                                        </button>
                                                    </div>
                                                </nav>
                                            </div>
                                            <div class="tab-pane fade" id="nav-HTML5" role="tabpanel">
    <pre class="language-html m-0" data-lang="html">
    <code>&lt;div class=&quot;collapse&quot; id=&quot;navbarToggleExternalContent&quot;&gt;
        &lt;div class=&quot;bg-dark p-4&quot;&gt;
            &lt;h5 class=&quot;text-white h4&quot;&gt;Collapsed content&lt;/h5&gt;
            &lt;span class=&quot;text-muted&quot;&gt;Toggleable via the navbar brand.&lt;/span&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;nav class=&quot;navbar navbar-dark bg-dark&quot;&gt;
            &lt;div class=&quot;container-xxl&quot;&gt;
            &lt;button class=&quot;navbar-toggler&quot; type=&quot;button&quot; data-bs-toggle=&quot;collapse&quot; data-bs-target=&quot;#navbarToggleExternalContent&quot; aria-controls=&quot;navbarToggleExternalContent&quot; aria-expanded=&quot;false&quot; aria-label=&quot;Toggle navigation&quot;&gt;
                &lt;span class=&quot;navbar-toggler-icon&quot;&gt;&lt;/span&gt;
            &lt;/button&gt;
        &lt;/div&gt;
    &lt;/nav&gt;</code>
    </pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
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
