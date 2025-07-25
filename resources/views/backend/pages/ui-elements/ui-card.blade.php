@extends(backendView('layouts.app'))

@section('title', 'Ui Card')

@section('content')

<div class="container">
                    <div class="col-12">
                        <div class="row justify-content-between">
                            <div class="col-lg-8 col-sm-12">

                                <h2 id="about">About</h2>
                                <p>A <strong>card</strong> is a flexible and extensible content container. It includes options for headers and footers, a wide variety of content, contextual background colors, and powerful display options. If you’re familiar with Bootstrap 3, cards replace our old panels, wells, and thumbnails. Similar functionality to those components is available as modifier classes for cards.</p>
                                
                                <h2 id="example">Example</h2>
                                <p>Cards are built with as little markup and styles as possible, but still manage to deliver a ton of control and customization. Built with flexbox, they offer easy alignment and mix well with other Bootstrap components. They have no <code>margin</code> by default, so use <a href="/docs/5.0/utilities/spacing/">spacing utilities</a> as needed.</p>
                                <p>Below is an example of a basic card with mixed content and a fixed width. Cards have no fixed width to start, so they’ll naturally fill the full width of its parent element. This is easily customized with our various <a href="#sizing">sizing options</a>.</p>
                                <div class="bd-example mb-5">
                                    <div class="card" style="width: 18rem;">
                                        <img class="card-img-top" src="{!! backendAssets('dist/assets/images/gallery/1.jpg') !!}" alt="" />
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;card&quot; style=&quot;width: 18rem;&quot;&gt;
        &lt;img class=&quot;card-img-top&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/1.jpg') !!}&quot; alt=&quot;&quot; /&gt;
        &lt;div class=&quot;card-body&quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Card title&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;Some quick example text to build on the card title and make up the bulk of the card's content.&lt;/p&gt;
            &lt;a href=&quot;#&quot; class=&quot;btn btn-primary&quot;&gt;Go somewhere&lt;/a&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                </div>
                                
                                <h2 id="content-types">Content types</h2>
                                <p>Cards support a wide variety of content, including images, text, list groups, links, and more. Below are examples of what’s supported.</p>
                                
                                <h3 id="body">Body<a class="anchorjs-link " aria-label="Anchor" data-anchorjs-icon="#" href="#body" style="padding-left: 0.375em;"></a></h3>
                                <p>The building block of a card is the <code>.card-body</code>. Use it whenever you need a padded section within a card.</p>
                                <div class="bd-example mb-5">
                                    <div class="card">
                                        <div class="card-body">
                                            This is some text within a card body.
                                        </div>
                                    </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;card&quot;&gt;
        &lt;div class=&quot;card-body&quot;&gt;
            This is some text within a card body.
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                </div>
                                
                                <h3 id="titles-text-and-links">Titles, text, and links</h3>
                                <p>Card titles are used by adding <code>.card-title</code> to a <code>&lt;h*&gt;</code> tag. In the same way, links are added and placed next to each other by adding <code>.card-link</code> to an <code>&lt;a&gt;</code> tag.</p>
                                <p>Subtitles are used by adding a <code>.card-subtitle</code> to a <code>&lt;h*&gt;</code> tag. If the <code>.card-title</code> and the <code>.card-subtitle</code> items are placed in a <code>.card-body</code> item, the card title and subtitle are aligned nicely.</p>
                                <div class="bd-example mb-5">
                                    <div class="card" style="width: 18rem;">
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
                                
                                <h3 id="images">Images</h3>
                                <p><code>.card-img-top</code> places an image to the top of the card. With <code>.card-text</code>, text can be added to the card. Text within <code>.card-text</code> can also be styled with the standard HTML tags.</p>
                                <div class="bd-example mb-5">
                                    <div class="card" style="width: 18rem;">
                                        <img class="card-img-top" src="{!! backendAssets('dist/assets/images/gallery/2.jpg') !!}" alt="" />
                                    
                                        <div class="card-body">
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;card&quot; style=&quot;width: 18rem;&quot;&gt;
        &lt;img class=&quot;card-img-top&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/2.jpg') !!}&quot; alt=&quot;&quot; /&gt;

        &lt;div class=&quot;card-body&quot;&gt;
            &lt;p class=&quot;card-text&quot;&gt;Some quick example text to build on the card title and make up the bulk of the card's content.&lt;/p&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                </div>
                                
                                <h3 id="list-groups">List groups</h3>
                                <p>Create lists of content in a card with a flush list group.</p>
                                <div class="bd-example mb-5">
                                    <div class="card" style="width: 18rem;">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Cras justo odio</li>
                                            <li class="list-group-item">Dapibus ac facilisis in</li>
                                            <li class="list-group-item">Vestibulum at eros</li>
                                        </ul>
                                    </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;card&quot; style=&quot;width: 18rem;&quot;&gt;
        &lt;ul class=&quot;list-group list-group-flush&quot;&gt;
            &lt;li class=&quot;list-group-item&quot;&gt;Cras justo odio&lt;/li&gt;
            &lt;li class=&quot;list-group-item&quot;&gt;Dapibus ac facilisis in&lt;/li&gt;
            &lt;li class=&quot;list-group-item&quot;&gt;Vestibulum at eros&lt;/li&gt;
        &lt;/ul&gt;
    &lt;/div&gt;</code>
    </pre>
                                </div>
                                <div class="bd-example mb-5">
                                    <div class="card" style="width: 18rem;">
                                        <div class="card-header">
                                            Featured
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Cras justo odio</li>
                                            <li class="list-group-item">Dapibus ac facilisis in</li>
                                            <li class="list-group-item">Vestibulum at eros</li>
                                        </ul>
                                    </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;card&quot; style=&quot;width: 18rem;&quot;&gt;
        &lt;div class=&quot;card-header&quot;&gt;
            Featured
        &lt;/div&gt;
        &lt;ul class=&quot;list-group list-group-flush&quot;&gt;
            &lt;li class=&quot;list-group-item&quot;&gt;Cras justo odio&lt;/li&gt;
            &lt;li class=&quot;list-group-item&quot;&gt;Dapibus ac facilisis in&lt;/li&gt;
            &lt;li class=&quot;list-group-item&quot;&gt;Vestibulum at eros&lt;/li&gt;
        &lt;/ul&gt;
    &lt;/div&gt;</code>
    </pre>
                                </div>
                                <div class="bd-example mb-5">
                                    <div class="card" style="width: 18rem;">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Cras justo odio</li>
                                            <li class="list-group-item">Dapibus ac facilisis in</li>
                                            <li class="list-group-item">Vestibulum at eros</li>
                                        </ul>
                                        <div class="card-footer">
                                            Card footer
                                        </div>
                                    </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;card&quot; style=&quot;width: 18rem;&quot;&gt;
        &lt;ul class=&quot;list-group list-group-flush&quot;&gt;
            &lt;li class=&quot;list-group-item&quot;&gt;Cras justo odio&lt;/li&gt;
            &lt;li class=&quot;list-group-item&quot;&gt;Dapibus ac facilisis in&lt;/li&gt;
            &lt;li class=&quot;list-group-item&quot;&gt;Vestibulum at eros&lt;/li&gt;
        &lt;/ul&gt;
        &lt;div class=&quot;card-footer&quot;&gt;
            Card footer
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                </div>

                                <h3 id="kitchen-sink">Kitchen sink</h3>
                                <p>Mix and match multiple content types to create the card you need, or throw everything in there. Shown below are image styles, blocks, text styles, and a list group—all wrapped in a fixed-width card.</p>
                                <div class="bd-example mb-5">
                                    <div class="card" style="width: 18rem;">
                                        <img class="card-img-top" src="{!! backendAssets('dist/assets/images/gallery/6.jpg') !!}" alt="" />
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Cras justo odio</li>
                                            <li class="list-group-item">Dapibus ac facilisis in</li>
                                            <li class="list-group-item">Vestibulum at eros</li>
                                        </ul>
                                        <div class="card-body">
                                            <a href="#" class="card-link">Card link</a>
                                            <a href="#" class="card-link">Another link</a>
                                        </div>
                                    </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;card&quot; style=&quot;width: 18rem;&quot;&gt;
        &lt;img class=&quot;card-img-top&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/6.jpg') !!}&quot; alt=&quot;&quot; /&gt;
        &lt;div class=&quot;card-body&quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Card title&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;Some quick example text to build on the card title and make up the bulk of the card's content.&lt;/p&gt;
        &lt;/div&gt;
        &lt;ul class=&quot;list-group list-group-flush&quot;&gt;
            &lt;li class=&quot;list-group-item&quot;&gt;Cras justo odio&lt;/li&gt;
            &lt;li class=&quot;list-group-item&quot;&gt;Dapibus ac facilisis in&lt;/li&gt;
            &lt;li class=&quot;list-group-item&quot;&gt;Vestibulum at eros&lt;/li&gt;
        &lt;/ul&gt;
        &lt;div class=&quot;card-body&quot;&gt;
            &lt;a href=&quot;#&quot; class=&quot;card-link&quot;&gt;Card link&lt;/a&gt;
            &lt;a href=&quot;#&quot; class=&quot;card-link&quot;&gt;Another link&lt;/a&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                </div>

                                <h3 id="header-and-footer">Header and footer</h3>
                                <p>Add an optional header and/or footer within a card.</p>
                                <div class="bd-example mb-5">
                                    <div class="card">
                                        <div class="card-header color-bg-100">
                                            Featured
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Special title treatment</h5>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;card&quot;&gt;
        &lt;div class=&quot;card-header&quot;&gt;
            Featured
        &lt;/div&gt;
        &lt;div class=&quot;card-body&quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Special title treatment&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;With supporting text below as a natural lead-in to additional content.&lt;/p&gt;
            &lt;a href=&quot;#&quot; class=&quot;btn btn-primary&quot;&gt;Go somewhere&lt;/a&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                </div>

                                <p>Card headers can be styled by adding <code>.card-header</code> to <code>&lt;h*&gt;</code> elements.</p>
                                <div class="bd-example mb-5">
                                    <div class="card">
                                        <h5 class="card-header color-bg-100">Featured</h5>
                                        <div class="card-body">
                                            <h5 class="card-title">Special title treatment</h5>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;card&quot;&gt;
        &lt;h5 class=&quot;card-header&quot;&gt;Featured&lt;/h5&gt;
        &lt;div class=&quot;card-body&quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Special title treatment&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;With supporting text below as a natural lead-in to additional content.&lt;/p&gt;
            &lt;a href=&quot;#&quot; class=&quot;btn btn-primary&quot;&gt;Go somewhere&lt;/a&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                </div>
                                <div class="bd-example mb-5">
                                    <div class="card">
                                        <div class="card-header color-bg-100">
                                            Quote
                                        </div>
                                        <div class="card-body">
                                            <blockquote class="blockquote mb-0">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                                <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
                                            </blockquote>
                                        </div>
                                    </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;card&quot;&gt;
        &lt;div class=&quot;card-header&quot;&gt;
            Quote
        &lt;/div&gt;
        &lt;div class=&quot;card-body&quot;&gt;
            &lt;blockquote class=&quot;blockquote mb-0&quot;&gt;
                &lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.&lt;/p&gt;
                &lt;footer class=&quot;blockquote-footer&quot;&gt;Someone famous in &lt;cite title=&quot;Source Title&quot;&gt;Source Title&lt;/cite&gt;&lt;/footer&gt;
            &lt;/blockquote&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                </div>
                                <div class="bd-example mb-5">
                                    <div class="card text-center">
                                        <div class="card-header color-bg-100">
                                            Featured
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Special title treatment</h5>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                        <div class="card-footer text-muted">
                                            2 days ago
                                        </div>
                                    </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;card text-center&quot;&gt;
        &lt;div class=&quot;card-header&quot;&gt;
            Featured
        &lt;/div&gt;
        &lt;div class=&quot;card-body&quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Special title treatment&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;With supporting text below as a natural lead-in to additional content.&lt;/p&gt;
            &lt;a href=&quot;#&quot; class=&quot;btn btn-primary&quot;&gt;Go somewhere&lt;/a&gt;
        &lt;/div&gt;
        &lt;div class=&quot;card-footer text-muted&quot;&gt;
            2 days ago
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                </div>

                                <h2 id="sizing">Sizing</h2>
                                <p>Cards assume no specific <code>width</code> to start, so they’ll be 100% wide unless otherwise stated. You can change this as needed with custom CSS, grid classes, grid Sass mixins, or utilities.</p>
                                <h3 id="using-grid-markup">Using grid markup<a class="anchorjs-link " aria-label="Anchor" data-anchorjs-icon="#" href="#using-grid-markup" style="padding-left: 0.375em;"></a></h3>
                                <p>Using the grid, wrap cards in columns and rows as needed.</p>
                                <div class="bd-example mb-5">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title">Special title treatment</h5>
                                                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title">Special title treatment</h5>
                                                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;row&quot;&gt;
        &lt;div class=&quot;col-sm-6&quot;&gt;
            &lt;div class=&quot;card&quot;&gt;
                &lt;div class=&quot;card-body&quot;&gt;
                    &lt;h5 class=&quot;card-title&quot;&gt;Special title treatment&lt;/h5&gt;
                    &lt;p class=&quot;card-text&quot;&gt;With supporting text below as a natural lead-in to additional content.&lt;/p&gt;
                    &lt;a href=&quot;#&quot; class=&quot;btn btn-primary&quot;&gt;Go somewhere&lt;/a&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;div class=&quot;col-sm-6&quot;&gt;
            &lt;div class=&quot;card&quot;&gt;
                &lt;div class=&quot;card-body&quot;&gt;
                    &lt;h5 class=&quot;card-title&quot;&gt;Special title treatment&lt;/h5&gt;
                    &lt;p class=&quot;card-text&quot;&gt;With supporting text below as a natural lead-in to additional content.&lt;/p&gt;
                    &lt;a href=&quot;#&quot; class=&quot;btn btn-primary&quot;&gt;Go somewhere&lt;/a&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                </div>

                                <h3 id="using-utilities">Using utilities</h3>
                                <p>Use our handful of <a href="https://v5.getbootstrap.com/docs/5.0/utilities/sizing/">available sizing utilities</a> to quickly set a card’s width.</p>
                                <div class="bd-example mb-5">
                                    <div class="card w-75">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                            <a href="#" class="btn btn-primary">Button</a>
                                        </div>
                                    </div>
                                    
                                    <div class="card w-50">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                            <a href="#" class="btn btn-primary">Button</a>
                                        </div>
                                    </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;card w-75&quot;&gt;
        &lt;div class=&quot;card-body&quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Card title&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;With supporting text below as a natural lead-in to additional content.&lt;/p&gt;
            &lt;a href=&quot;#&quot; class=&quot;btn btn-primary&quot;&gt;Button&lt;/a&gt;
        &lt;/div&gt;
    &lt;/div&gt;

    &lt;div class=&quot;card w-50&quot;&gt;
        &lt;div class=&quot;card-body&quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Card title&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;With supporting text below as a natural lead-in to additional content.&lt;/p&gt;
            &lt;a href=&quot;#&quot; class=&quot;btn btn-primary&quot;&gt;Button&lt;/a&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                </div>

                                <h3 id="using-custom-css">Using custom CSS</h3>
                                <p>Use custom CSS in your stylesheets or as inline styles to set a width.</p>
                                <div class="bd-example mb-5">
                                    <div class="card" style="width: 18rem;">
                                        <div class="card-body">
                                            <h5 class="card-title">Special title treatment</h5>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;card&quot; style=&quot;width: 18rem;&quot;&gt;
        &lt;div class=&quot;card-body&quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Special title treatment&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;With supporting text below as a natural lead-in to additional content.&lt;/p&gt;
            &lt;a href=&quot;#&quot; class=&quot;btn btn-primary&quot;&gt;Go somewhere&lt;/a&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                </div>
                                
                                <h2 id="text-alignment">Text alignment</h2>
                                <p>You can quickly change the text alignment of any card—in its entirety or specific parts—with our <a href="https://v5.getbootstrap.com/docs/5.0/utilities/text/#text-alignment">text align classes</a>.</p>
                                <div class="bd-example mb-5">
                                    <div class="card" style="width: 18rem;">
                                        <div class="card-body">
                                            <h5 class="card-title">Special title treatment</h5>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                    
                                    <div class="card text-center" style="width: 18rem;">
                                        <div class="card-body">
                                            <h5 class="card-title">Special title treatment</h5>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                    
                                    <div class="card text-end" style="width: 18rem;">
                                        <div class="card-body">
                                            <h5 class="card-title">Special title treatment</h5>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;card&quot; style=&quot;width: 18rem;&quot;&gt;
        &lt;div class=&quot;card-body&quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Special title treatment&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;With supporting text below as a natural lead-in to additional content.&lt;/p&gt;
            &lt;a href=&quot;#&quot; class=&quot;btn btn-primary&quot;&gt;Go somewhere&lt;/a&gt;
        &lt;/div&gt;
    &lt;/div&gt;

    &lt;div class=&quot;card text-center&quot; style=&quot;width: 18rem;&quot;&gt;
        &lt;div class=&quot;card-body&quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Special title treatment&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;With supporting text below as a natural lead-in to additional content.&lt;/p&gt;
            &lt;a href=&quot;#&quot; class=&quot;btn btn-primary&quot;&gt;Go somewhere&lt;/a&gt;
        &lt;/div&gt;
    &lt;/div&gt;

    &lt;div class=&quot;card text-end&quot; style=&quot;width: 18rem;&quot;&gt;
        &lt;div class=&quot;card-body&quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Special title treatment&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;With supporting text below as a natural lead-in to additional content.&lt;/p&gt;
            &lt;a href=&quot;#&quot; class=&quot;btn btn-primary&quot;&gt;Go somewhere&lt;/a&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                </div>

                                <h2 id="navigation">Navigation</h2>
                                <p>Add some navigation to a card’s header (or block) with Bootstrap’s <a href="https://v5.getbootstrap.com/docs/5.0/components/navs/">nav components</a>.</p>
                                <div class="bd-example mb-5">
                                    <div class="card text-center">
                                        <div class="card-header color-bg-100">
                                            <ul class="nav nav-tabs card-header-tabs">
                                                <li class="nav-item"><a class="nav-link active" aria-current="true" href="#">Active</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
                                                <li class="nav-item"><a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a></li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Special title treatment</h5>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;card text-center&quot;&gt;
        &lt;div class=&quot;card-header&quot;&gt;
            &lt;ul class=&quot;nav nav-tabs card-header-tabs&quot;&gt;
                &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link active&quot; aria-current=&quot;true&quot; href=&quot;#&quot;&gt;Active&lt;/a&gt;&lt;/li&gt;
                &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link&quot; href=&quot;#&quot;&gt;Link&lt;/a&gt;&lt;/li&gt;
                &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link disabled&quot; href=&quot;#&quot; tabindex=&quot;-1&quot; aria-disabled=&quot;true&quot;&gt;Disabled&lt;/a&gt;&lt;/li&gt;
            &lt;/ul&gt;
        &lt;/div&gt;
        &lt;div class=&quot;card-body&quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Special title treatment&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;With supporting text below as a natural lead-in to additional content.&lt;/p&gt;
            &lt;a href=&quot;#&quot; class=&quot;btn btn-primary&quot;&gt;Go somewhere&lt;/a&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                </div>
                                <div class="bd-example mb-5">
                                    <div class="card text-center">
                                        <div class="card-header color-bg-100">
                                            <ul class="nav nav-pills card-header-pills">
                                                <li class="nav-item"><a class="nav-link active" href="#">Active</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
                                                <li class="nav-item"><a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a></li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Special title treatment</h5>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;card text-center&quot;&gt;
        &lt;div class=&quot;card-header&quot;&gt;
            &lt;ul class=&quot;nav nav-pills card-header-pills&quot;&gt;
                &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link active&quot; href=&quot;#&quot;&gt;Active&lt;/a&gt;&lt;/li&gt;
                &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link&quot; href=&quot;#&quot;&gt;Link&lt;/a&gt;&lt;/li&gt;
                &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link disabled&quot; href=&quot;#&quot; tabindex=&quot;-1&quot; aria-disabled=&quot;true&quot;&gt;Disabled&lt;/a&gt;&lt;/li&gt;
            &lt;/ul&gt;
        &lt;/div&gt;
        &lt;div class=&quot;card-body&quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Special title treatment&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;With supporting text below as a natural lead-in to additional content.&lt;/p&gt;
            &lt;a href=&quot;#&quot; class=&quot;btn btn-primary&quot;&gt;Go somewhere&lt;/a&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                </div>
                                
                                <h2 id="images-1">Images</h2>
                                <p>Cards include a few options for working with images. Choose from appending “image caps” at either end of a card, overlaying images with card content, or simply embedding the image in a card.</p>
                                <h3 id="image-caps">Image caps<a class="anchorjs-link " aria-label="Anchor" data-anchorjs-icon="#" href="#image-caps" style="padding-left: 0.375em;"></a></h3>
                                <p>Similar to headers and footers, cards can include top and bottom “image caps”—images at the top or bottom of a card.</p>
                                <div class="bd-example mb-5">
                                    <div class="card mb-3">
                                        <img class="card-img-top" src="{!! backendAssets('dist/assets/images/gallery/10.jpg') !!}" alt="" />
                                    
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                        </div>
                                        <img class="card-img-top" src="{!! backendAssets('dist/assets/images/gallery/8.jpg') !!}" alt="" />
                                    
                                    </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;card mb-3&quot;&gt;
        &lt;img class=&quot;card-img-top&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/10.jpg') !!}&quot; alt=&quot;&quot; /&gt;

        &lt;div class=&quot;card-body&quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Card title&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.&lt;/p&gt;
            &lt;p class=&quot;card-text&quot;&gt;&lt;small class=&quot;text-muted&quot;&gt;Last updated 3 mins ago&lt;/small&gt;&lt;/p&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class=&quot;card&quot;&gt;
        &lt;div class=&quot;card-body&quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Card title&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.&lt;/p&gt;
            &lt;p class=&quot;card-text&quot;&gt;&lt;small class=&quot;text-muted&quot;&gt;Last updated 3 mins ago&lt;/small&gt;&lt;/p&gt;
        &lt;/div&gt;
        &lt;img class=&quot;card-img-top&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/8.jpg') !!}&quot; alt=&quot;&quot; /&gt;

    &lt;/div&gt;</code>
    </pre>
                                </div>
                                
                                <h3 id="image-overlays">Image overlays</h3>
                                <p>Turn an image into a card background and overlay your card’s text. Depending on the image, you may or may not need additional styles or utilities.</p>
                                <div class="bd-example mb-5">
                                    <div class="card bg-dark text-white">
                                        <img class="card-img-top" src="{!! backendAssets('dist/assets/images/gallery/2.jpg') !!}" alt="" />
                                    
                                        <div class="card-img-overlay">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                            <p class="card-text">Last updated 3 mins ago</p>
                                        </div>
                                    </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;card bg-dark text-white&quot;&gt;
        &lt;img class=&quot;card-img-top&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/2.jpg') !!}&quot; alt=&quot;&quot; /&gt;

        &lt;div class=&quot;card-img-overlay&quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Card title&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.&lt;/p&gt;
            &lt;p class=&quot;card-text&quot;&gt;Last updated 3 mins ago&lt;/p&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                </div>
                                <div class="card shadow-sm p-3 mb-5">
                                    Note that content should not be larger than the height of the image. If content is larger than the image the content will be displayed outside the image.
                                </div>
                                
                                <h2 id="horizontal">Horizontal</h2>
                                <p>Using a combination of grid and utility classes, cards can be made horizontal in a mobile-friendly and responsive way. In the example below, we remove the grid gutters with <code>.g-0</code> and use <code>.col-md-*</code> classes to make the card horizontal at the <code>md</code> breakpoint. Further adjustments may be needed depending on your card content.</p>
                                <div class="bd-example mb-5">
                                    <div class="card mb-3">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                <img class="card-img-top" src="{!! backendAssets('dist/assets/images/gallery/5.jpg') !!}" alt="" />
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title">Card title</h5>
                                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;card mb-3&quot; style=&quot;max-width: 540px;&quot;&gt;
        &lt;div class=&quot;row g-0&quot;&gt;
            &lt;div class=&quot;col-md-4&quot;&gt;
                &lt;img class=&quot;card-img-top&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/5.jpg') !!}&quot; alt=&quot;&quot; /&gt;
            &lt;/div&gt;
            &lt;div class=&quot;col-md-8&quot;&gt;
                &lt;div class=&quot;card-body&quot;&gt;
                    &lt;h5 class=&quot;card-title&quot;&gt;Card title&lt;/h5&gt;
                    &lt;p class=&quot;card-text&quot;&gt;This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.&lt;/p&gt;
                    &lt;p class=&quot;card-text&quot;&gt;&lt;small class=&quot;text-muted&quot;&gt;Last updated 3 mins ago&lt;/small&gt;&lt;/p&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                </div>

                                <h2 id="card-styles">Card styles</h2>
                                <p>Cards include various options for customizing their backgrounds, borders, and color.</p>
                                <h3 id="background-and-color">Background and color</h3>
                                <p>Use <a href="https://v5.getbootstrap.com/docs/5.0/utilities/colors/">text and background utilities</a> to change the appearance of a card.</p>
                                <div class="bd-example mb-5">
                                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                                        <div class="card-header">Header</div>
                                        <div class="card-body">
                                            <h5 class="card-title">Primary card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                    <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                                        <div class="card-header">Header</div>
                                        <div class="card-body">
                                            <h5 class="card-title">Secondary card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                    <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                                        <div class="card-header">Header</div>
                                        <div class="card-body">
                                            <h5 class="card-title">Success card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                    <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                                        <div class="card-header">Header</div>
                                        <div class="card-body">
                                            <h5 class="card-title">Danger card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                    <div class="card bg-warning mb-3" style="max-width: 18rem;">
                                        <div class="card-header">Header</div>
                                        <div class="card-body">
                                            <h5 class="card-title">Warning card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                    <div class="card text-body  bg-info mb-3" style="max-width: 18rem;">
                                        <div class="card-header">Header</div>
                                        <div class="card-body">
                                            <h5 class="card-title">Info card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                    <div class="card bg-light mb-3" style="max-width: 18rem;">
                                        <div class="card-header">Header</div>
                                        <div class="card-body">
                                            <h5 class="card-title">Light card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                    <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                                        <div class="card-header">Header</div>
                                        <div class="card-body">
                                            <h5 class="card-title">Dark card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;card text-white bg-primary mb-3&quot; style=&quot;max-width: 18rem;&quot;&gt;
        &lt;div class=&quot;card-header&quot;&gt;Header&lt;/div&gt;
        &lt;div class=&quot;card-body&quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Primary card title&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;Some quick example text to build on the card title and make up the bulk of the card's content.&lt;/p&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class=&quot;card text-white bg-secondary mb-3&quot; style=&quot;max-width: 18rem;&quot;&gt;
        &lt;div class=&quot;card-header&quot;&gt;Header&lt;/div&gt;
        &lt;div class=&quot;card-body&quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Secondary card title&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;Some quick example text to build on the card title and make up the bulk of the card's content.&lt;/p&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class=&quot;card text-white bg-success mb-3&quot; style=&quot;max-width: 18rem;&quot;&gt;
        &lt;div class=&quot;card-header&quot;&gt;Header&lt;/div&gt;
        &lt;div class=&quot;card-body&quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Success card title&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;Some quick example text to build on the card title and make up the bulk of the card's content.&lt;/p&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class=&quot;card text-white bg-danger mb-3&quot; style=&quot;max-width: 18rem;&quot;&gt;
        &lt;div class=&quot;card-header&quot;&gt;Header&lt;/div&gt;
        &lt;div class=&quot;card-body&quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Danger card title&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;Some quick example text to build on the card title and make up the bulk of the card's content.&lt;/p&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class=&quot;card bg-warning mb-3&quot; style=&quot;max-width: 18rem;&quot;&gt;
        &lt;div class=&quot;card-header&quot;&gt;Header&lt;/div&gt;
        &lt;div class=&quot;card-body&quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Warning card title&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;Some quick example text to build on the card title and make up the bulk of the card's content.&lt;/p&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class=&quot;card text-body  bg-info mb-3&quot; style=&quot;max-width: 18rem;&quot;&gt;
        &lt;div class=&quot;card-header&quot;&gt;Header&lt;/div&gt;
        &lt;div class=&quot;card-body&quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Info card title&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;Some quick example text to build on the card title and make up the bulk of the card's content.&lt;/p&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class=&quot;card bg-light mb-3&quot; style=&quot;max-width: 18rem;&quot;&gt;
        &lt;div class=&quot;card-header&quot;&gt;Header&lt;/div&gt;
        &lt;div class=&quot;card-body&quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Light card title&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;Some quick example text to build on the card title and make up the bulk of the card's content.&lt;/p&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class=&quot;card text-white bg-dark mb-3&quot; style=&quot;max-width: 18rem;&quot;&gt;
        &lt;div class=&quot;card-header&quot;&gt;Header&lt;/div&gt;
        &lt;div class=&quot;card-body&quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Dark card title&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;Some quick example text to build on the card title and make up the bulk of the card's content.&lt;/p&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                </div>
                                
                                <div class="card shadow-sm p-3">
                                    <h5 id="conveying-meaning-to-assistive-technologies">Conveying meaning to assistive technologies</h5>
                                    <p>Using color to add meaning only provides a visual indication, which will not be conveyed to users of assistive technologies – such as screen readers. Ensure that information denoted by the color is either obvious from the content itself (e.g. the visible text), or is included through alternative means, such as additional text hidden with the <code>.visually-hidden</code> class.</p>
                                </div>
                                
                                <h3 id="border">Border</h3>
                                <p>Use <a href="https://v5.getbootstrap.com/docs/5.0/utilities/borders/">border utilities</a> to change just the <code>border-color</code> of a card. Note that you can put <code>.text-{color}</code> classes on the parent <code>.card</code> or a subset of the card’s contents as shown below.</p>
                                <div class="bd-example mb-5">
                                    <div class="card border-primary mb-3" style="max-width: 18rem;">
                                        <div class="card-header">Header</div>
                                        <div class="card-body text-primary">
                                            <h5 class="card-title">Primary card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                    <div class="card border-secondary mb-3" style="max-width: 18rem;">
                                        <div class="card-header">Header</div>
                                        <div class="card-body text-secondary">
                                            <h5 class="card-title">Secondary card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                    <div class="card border-success mb-3" style="max-width: 18rem;">
                                        <div class="card-header">Header</div>
                                        <div class="card-body text-success">
                                            <h5 class="card-title">Success card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                    <div class="card border-danger mb-3" style="max-width: 18rem;">
                                        <div class="card-header">Header</div>
                                        <div class="card-body text-danger">
                                            <h5 class="card-title">Danger card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                    <div class="card border-warning mb-3" style="max-width: 18rem;">
                                        <div class="card-header">Header</div>
                                        <div class="card-body">
                                            <h5 class="card-title">Warning card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                    <div class="card border-info mb-3" style="max-width: 18rem;">
                                        <div class="card-header">Header</div>
                                        <div class="card-body">
                                            <h5 class="card-title">Info card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                    <div class="card border-light mb-3" style="max-width: 18rem;">
                                        <div class="card-header">Header</div>
                                        <div class="card-body">
                                            <h5 class="card-title">Light card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                    <div class="card border-dark mb-3" style="max-width: 18rem;">
                                        <div class="card-header">Header</div>
                                        <div class="card-body ">
                                            <h5 class="card-title">Dark card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;card border-primary mb-3&quot; style=&quot;max-width: 18rem;&quot;&gt;
        &lt;div class=&quot;card-header&quot;&gt;Header&lt;/div&gt;
        &lt;div class=&quot;card-body text-primary&quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Primary card title&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;Some quick example text to build on the card title and make up the bulk of the card's content.&lt;/p&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class=&quot;card border-secondary mb-3&quot; style=&quot;max-width: 18rem;&quot;&gt;
        &lt;div class=&quot;card-header&quot;&gt;Header&lt;/div&gt;
        &lt;div class=&quot;card-body text-secondary&quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Secondary card title&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;Some quick example text to build on the card title and make up the bulk of the card's content.&lt;/p&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class=&quot;card border-success mb-3&quot; style=&quot;max-width: 18rem;&quot;&gt;
        &lt;div class=&quot;card-header&quot;&gt;Header&lt;/div&gt;
        &lt;div class=&quot;card-body text-success&quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Success card title&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;Some quick example text to build on the card title and make up the bulk of the card's content.&lt;/p&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class=&quot;card border-danger mb-3&quot; style=&quot;max-width: 18rem;&quot;&gt;
        &lt;div class=&quot;card-header&quot;&gt;Header&lt;/div&gt;
        &lt;div class=&quot;card-body text-danger&quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Danger card title&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;Some quick example text to build on the card title and make up the bulk of the card's content.&lt;/p&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class=&quot;card border-warning mb-3&quot; style=&quot;max-width: 18rem;&quot;&gt;
        &lt;div class=&quot;card-header&quot;&gt;Header&lt;/div&gt;
        &lt;div class=&quot;card-body&quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Warning card title&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;Some quick example text to build on the card title and make up the bulk of the card's content.&lt;/p&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class=&quot;card border-info mb-3&quot; style=&quot;max-width: 18rem;&quot;&gt;
        &lt;div class=&quot;card-header&quot;&gt;Header&lt;/div&gt;
        &lt;div class=&quot;card-body&quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Info card title&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;Some quick example text to build on the card title and make up the bulk of the card's content.&lt;/p&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class=&quot;card border-light mb-3&quot; style=&quot;max-width: 18rem;&quot;&gt;
        &lt;div class=&quot;card-header&quot;&gt;Header&lt;/div&gt;
        &lt;div class=&quot;card-body&quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Light card title&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;Some quick example text to build on the card title and make up the bulk of the card's content.&lt;/p&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class=&quot;card border-dark mb-3&quot; style=&quot;max-width: 18rem;&quot;&gt;
        &lt;div class=&quot;card-header&quot;&gt;Header&lt;/div&gt;
        &lt;div class=&quot;card-body &quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Dark card title&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;Some quick example text to build on the card title and make up the bulk of the card's content.&lt;/p&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                </div>
                                
                                <h3 id="mixins-utilities">Mixins utilities</h3>
                                <p>You can also change the borders on the card header and footer as needed, and even remove their <code>background-color</code> with <code>.bg-transparent</code>.</p>
                                <div class="bd-example mb-5">
                                    <div class="card border-success mb-3" style="max-width: 18rem;">
                                        <div class="card-header bg-transparent border-success">Header</div>
                                            <div class="card-body text-success">
                                            <h5 class="card-title">Success card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                        <div class="card-footer bg-transparent border-success">Footer</div>
                                    </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;card border-success mb-3&quot; style=&quot;max-width: 18rem;&quot;&gt;
        &lt;div class=&quot;card-header bg-transparent border-success&quot;&gt;Header&lt;/div&gt;
            &lt;div class=&quot;card-body text-success&quot;&gt;
            &lt;h5 class=&quot;card-title&quot;&gt;Success card title&lt;/h5&gt;
            &lt;p class=&quot;card-text&quot;&gt;Some quick example text to build on the card title and make up the bulk of the card's content.&lt;/p&gt;
        &lt;/div&gt;
        &lt;div class=&quot;card-footer bg-transparent border-success&quot;&gt;Footer&lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                </div>

                                <h2 id="card-layout">Card layout</h2>
                                <p>In addition to styling the content within cards, Bootstrap includes a few options for laying out series of cards. For the time being, <strong>these layout options are not yet responsive</strong>.</p>
                                <h3 id="card-groups">Card groups</h3>
                                <p>Use card groups to render cards as a single, attached element with equal width and height columns. Card groups start off stacked and use <code>display: flex;</code> to become attached with uniform dimensions starting at the <code>sm</code> breakpoint.</p>
                                <div class="bd-example mb-5">
                                    <div class="card-group">
                                        <div class="card">
                                            <img class="card-img-top" src="{!! backendAssets('dist/assets/images/gallery/6.jpg') !!}" alt="" />
                                            <div class="card-body">
                                                <h5 class="card-title">Card title</h5>
                                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <img class="card-img-top" src="{!! backendAssets('dist/assets/images/gallery/2.jpg') !!}" alt="" />
                                            <div class="card-body">
                                                <h5 class="card-title">Card title</h5>
                                                <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <img class="card-img-top" src="{!! backendAssets('dist/assets/images/gallery/5.jpg') !!}" alt="" />
                                            <div class="card-body">
                                                <h5 class="card-title">Card title</h5>
                                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                            </div>
                                        </div>
                                    </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;card-group&quot;&gt;
        &lt;div class=&quot;card&quot;&gt;
            &lt;img class=&quot;card-img-top&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/6.jpg') !!}&quot; alt=&quot;&quot; /&gt;
            &lt;div class=&quot;card-body&quot;&gt;
                &lt;h5 class=&quot;card-title&quot;&gt;Card title&lt;/h5&gt;
                &lt;p class=&quot;card-text&quot;&gt;This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.&lt;/p&gt;
                &lt;p class=&quot;card-text&quot;&gt;&lt;small class=&quot;text-muted&quot;&gt;Last updated 3 mins ago&lt;/small&gt;&lt;/p&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;div class=&quot;card&quot;&gt;
            &lt;img class=&quot;card-img-top&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/2.jpg') !!}&quot; alt=&quot;&quot; /&gt;
            &lt;div class=&quot;card-body&quot;&gt;
                &lt;h5 class=&quot;card-title&quot;&gt;Card title&lt;/h5&gt;
                &lt;p class=&quot;card-text&quot;&gt;This card has supporting text below as a natural lead-in to additional content.&lt;/p&gt;
                &lt;p class=&quot;card-text&quot;&gt;&lt;small class=&quot;text-muted&quot;&gt;Last updated 3 mins ago&lt;/small&gt;&lt;/p&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;div class=&quot;card&quot;&gt;
            &lt;img class=&quot;card-img-top&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/5.jpg') !!}&quot; alt=&quot;&quot; /&gt;
            &lt;div class=&quot;card-body&quot;&gt;
                &lt;h5 class=&quot;card-title&quot;&gt;Card title&lt;/h5&gt;
                &lt;p class=&quot;card-text&quot;&gt;This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.&lt;/p&gt;
                &lt;p class=&quot;card-text&quot;&gt;&lt;small class=&quot;text-muted&quot;&gt;Last updated 3 mins ago&lt;/small&gt;&lt;/p&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                </div>
                                
                                <p>When using card groups with footers, their content will automatically line up.</p>
                                <div class="bd-example mb-5">
                                    <div class="card-group">
                                        <div class="card">
                                            <img class="card-img-top" src="{!! backendAssets('dist/assets/images/gallery/2.jpg') !!}" alt="" />
                                            <div class="card-body">
                                                <h5 class="card-title">Card title</h5>
                                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                            </div>
                                            <div class="card-footer">
                                                <small class="text-muted">Last updated 3 mins ago</small>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <img class="card-img-top" src="{!! backendAssets('dist/assets/images/gallery/6.jpg') !!}" alt="" />
                                            <div class="card-body">
                                                <h5 class="card-title">Card title</h5>
                                                <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                                            </div>
                                            <div class="card-footer">
                                                <small class="text-muted">Last updated 3 mins ago</small>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <img class="card-img-top" src="{!! backendAssets('dist/assets/images/gallery/8.jpg') !!}" alt="" />
                                            <div class="card-body">
                                                <h5 class="card-title">Card title</h5>
                                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                                            </div>
                                            <div class="card-footer">
                                                <small class="text-muted">Last updated 3 mins ago</small>
                                            </div>
                                        </div>
                                    </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;card-group&quot;&gt;
        &lt;div class=&quot;card&quot;&gt;
            &lt;img class=&quot;card-img-top&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/2.jpg') !!}&quot; alt=&quot;&quot; /&gt;
            &lt;div class=&quot;card-body&quot;&gt;
                &lt;h5 class=&quot;card-title&quot;&gt;Card title&lt;/h5&gt;
                &lt;p class=&quot;card-text&quot;&gt;This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.&lt;/p&gt;
            &lt;/div&gt;
            &lt;div class=&quot;card-footer&quot;&gt;
                &lt;small class=&quot;text-muted&quot;&gt;Last updated 3 mins ago&lt;/small&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;div class=&quot;card&quot;&gt;
            &lt;img class=&quot;card-img-top&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/6.jpg') !!}&quot; alt=&quot;&quot; /&gt;
            &lt;div class=&quot;card-body&quot;&gt;
                &lt;h5 class=&quot;card-title&quot;&gt;Card title&lt;/h5&gt;
                &lt;p class=&quot;card-text&quot;&gt;This card has supporting text below as a natural lead-in to additional content.&lt;/p&gt;
            &lt;/div&gt;
            &lt;div class=&quot;card-footer&quot;&gt;
                &lt;small class=&quot;text-muted&quot;&gt;Last updated 3 mins ago&lt;/small&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;div class=&quot;card&quot;&gt;
            &lt;img class=&quot;card-img-top&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/8.jpg') !!}&quot; alt=&quot;&quot; /&gt;
            &lt;div class=&quot;card-body&quot;&gt;
                &lt;h5 class=&quot;card-title&quot;&gt;Card title&lt;/h5&gt;
                &lt;p class=&quot;card-text&quot;&gt;This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.&lt;/p&gt;
            &lt;/div&gt;
            &lt;div class=&quot;card-footer&quot;&gt;
                &lt;small class=&quot;text-muted&quot;&gt;Last updated 3 mins ago&lt;/small&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                </div>

                                <h3 id="grid-cards">Grid cards</h3>
                                <p>Use the Bootstrap grid system and its <a href="https://v5.getbootstrap.com/docs/5.0/layout/grid/#row-columns"><code>.row-cols</code> classes</a> to control how many grid columns (wrapped around your cards) you show per row. For example, here’s <code>.row-cols-1</code> laying out the cards on one column, and <code>.row-cols-md-2</code> splitting four cards to equal width across multiple rows, from the medium breakpoint up.</p>
                                <div class="bd-example mb-5">
                                    <div class="row row-cols-1 row-cols-md-2 g-4">
                                        <div class="col">
                                            <div class="card">
                                                <img class="card-img-top" src="{!! backendAssets('dist/assets/images/gallery/1.jpg') !!}" alt="" />
                                                <div class="card-body">
                                                    <h5 class="card-title">Card title</h5>
                                                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card">
                                                <img class="card-img-top" src="{!! backendAssets('dist/assets/images/gallery/9.jpg') !!}" alt="" />
                                                <div class="card-body">
                                                    <h5 class="card-title">Card title</h5>
                                                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card">
                                                <img class="card-img-top" src="{!! backendAssets('dist/assets/images/gallery/2.jpg') !!}" alt="" />
                                                <div class="card-body">
                                                    <h5 class="card-title">Card title</h5>
                                                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card">
                                                <img class="card-img-top" src="{!! backendAssets('dist/assets/images/gallery/3.jpg') !!}" alt="" />
                                                <div class="card-body">
                                                    <h5 class="card-title">Card title</h5>
                                                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;row row-cols-1 row-cols-md-2 g-4&quot;&gt;
        &lt;div class=&quot;col&quot;&gt;
            &lt;div class=&quot;card&quot;&gt;
                &lt;img class=&quot;card-img-top&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/1.jpg') !!}&quot; alt=&quot;&quot; /&gt;
                &lt;div class=&quot;card-body&quot;&gt;
                    &lt;h5 class=&quot;card-title&quot;&gt;Card title&lt;/h5&gt;
                    &lt;p class=&quot;card-text&quot;&gt;This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.&lt;/p&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;div class=&quot;col&quot;&gt;
            &lt;div class=&quot;card&quot;&gt;
                &lt;img class=&quot;card-img-top&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/9.jpg') !!}&quot; alt=&quot;&quot; /&gt;
                &lt;div class=&quot;card-body&quot;&gt;
                    &lt;h5 class=&quot;card-title&quot;&gt;Card title&lt;/h5&gt;
                    &lt;p class=&quot;card-text&quot;&gt;This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.&lt;/p&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;div class=&quot;col&quot;&gt;
            &lt;div class=&quot;card&quot;&gt;
                &lt;img class=&quot;card-img-top&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/2.jpg') !!}&quot; alt=&quot;&quot; /&gt;
                &lt;div class=&quot;card-body&quot;&gt;
                    &lt;h5 class=&quot;card-title&quot;&gt;Card title&lt;/h5&gt;
                    &lt;p class=&quot;card-text&quot;&gt;This is a longer card with supporting text below as a natural lead-in to additional content.&lt;/p&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;div class=&quot;col&quot;&gt;
            &lt;div class=&quot;card&quot;&gt;
                &lt;img class=&quot;card-img-top&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/3.jpg') !!}&quot; alt=&quot;&quot; /&gt;
                &lt;div class=&quot;card-body&quot;&gt;
                    &lt;h5 class=&quot;card-title&quot;&gt;Card title&lt;/h5&gt;
                    &lt;p class=&quot;card-text&quot;&gt;This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.&lt;/p&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                </div>
                                
                                <p>Change it to <code>.row-cols-3</code> and you’ll see the fourth card wrap.</p>
                                <div class="bd-example mb-5">
                                    <div class="row row-cols-1 row-cols-md-3 g-4">
                                        <div class="col">
                                            <div class="card">
                                                <img class="card-img-top" src="{!! backendAssets('dist/assets/images/gallery/10.jpg') !!}" alt="" />
                                                <div class="card-body">
                                                    <h5 class="card-title">Card title</h5>
                                                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card">
                                                <img class="card-img-top" src="{!! backendAssets('dist/assets/images/gallery/2.jpg') !!}" alt="" />
                                                <div class="card-body">
                                                    <h5 class="card-title">Card title</h5>
                                                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card">
                                                <img class="card-img-top" src="{!! backendAssets('dist/assets/images/gallery/3.jpg') !!}" alt="" />
                                                <div class="card-body">
                                                    <h5 class="card-title">Card title</h5>
                                                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card">
                                                <img class="card-img-top" src="{!! backendAssets('dist/assets/images/gallery/9.jpg') !!}" alt="" />
                                                <div class="card-body">
                                                    <h5 class="card-title">Card title</h5>
                                                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;row row-cols-1 row-cols-md-3 g-4&quot;&gt;
        &lt;div class=&quot;col&quot;&gt;
            &lt;div class=&quot;card&quot;&gt;
                &lt;img class=&quot;card-img-top&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/10.jpg') !!}&quot; alt=&quot;&quot; /&gt;
                &lt;div class=&quot;card-body&quot;&gt;
                    &lt;h5 class=&quot;card-title&quot;&gt;Card title&lt;/h5&gt;
                    &lt;p class=&quot;card-text&quot;&gt;This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.&lt;/p&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;div class=&quot;col&quot;&gt;
            &lt;div class=&quot;card&quot;&gt;
                &lt;img class=&quot;card-img-top&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/2.jpg') !!}&quot; alt=&quot;&quot; /&gt;
                &lt;div class=&quot;card-body&quot;&gt;
                    &lt;h5 class=&quot;card-title&quot;&gt;Card title&lt;/h5&gt;
                    &lt;p class=&quot;card-text&quot;&gt;This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.&lt;/p&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;div class=&quot;col&quot;&gt;
            &lt;div class=&quot;card&quot;&gt;
                &lt;img class=&quot;card-img-top&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/3.jpg') !!}&quot; alt=&quot;&quot; /&gt;
                &lt;div class=&quot;card-body&quot;&gt;
                    &lt;h5 class=&quot;card-title&quot;&gt;Card title&lt;/h5&gt;
                    &lt;p class=&quot;card-text&quot;&gt;This is a longer card with supporting text below as a natural lead-in to additional content.&lt;/p&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;div class=&quot;col&quot;&gt;
            &lt;div class=&quot;card&quot;&gt;
                &lt;img class=&quot;card-img-top&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/9.jpg') !!}&quot; alt=&quot;&quot; /&gt;
                &lt;div class=&quot;card-body&quot;&gt;
                    &lt;h5 class=&quot;card-title&quot;&gt;Card title&lt;/h5&gt;
                    &lt;p class=&quot;card-text&quot;&gt;This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.&lt;/p&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                </div>
                                
                                <p>When you need equal height, add <code>.h-100</code> to the cards. If you want equal heights by default, you can set <code>$card-height: 100%</code> in Sass.</p>
                                <div class="bd-example mb-5">
                                    <div class="row row-cols-1 row-cols-md-3 g-4">
                                        <div class="col">
                                            <div class="card h-100">
                                                <img class="card-img-top" src="{!! backendAssets('dist/assets/images/gallery/1.jpg') !!}" alt="" />
                                                    <div class="card-body">
                                                    <h5 class="card-title">Card title</h5>
                                                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card h-100">
                                                <img class="card-img-top" src="{!! backendAssets('dist/assets/images/gallery/5.jpg') !!}" alt="" />
                                                <div class="card-body">
                                                    <h5 class="card-title">Card title</h5>
                                                    <p class="card-text">This is a short card.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card h-100">
                                                <img class="card-img-top" src="{!! backendAssets('dist/assets/images/gallery/7.jpg') !!}" alt="" />
                                                <div class="card-body">
                                                    <h5 class="card-title">Card title</h5>
                                                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card h-100">
                                                <img class="card-img-top" src="{!! backendAssets('dist/assets/images/gallery/4.jpg') !!}" alt="" />
                                                <div class="card-body">
                                                    <h5 class="card-title">Card title</h5>
                                                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;row row-cols-1 row-cols-md-3 g-4&quot;&gt;
        &lt;div class=&quot;col&quot;&gt;
            &lt;div class=&quot;card h-100&quot;&gt;
                &lt;img class=&quot;card-img-top&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/1.jpg') !!}&quot; alt=&quot;&quot; /&gt;
                    &lt;div class=&quot;card-body&quot;&gt;
                    &lt;h5 class=&quot;card-title&quot;&gt;Card title&lt;/h5&gt;
                    &lt;p class=&quot;card-text&quot;&gt;This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.&lt;/p&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;div class=&quot;col&quot;&gt;
            &lt;div class=&quot;card h-100&quot;&gt;
                &lt;img class=&quot;card-img-top&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/5.jpg') !!}&quot; alt=&quot;&quot; /&gt;
                &lt;div class=&quot;card-body&quot;&gt;
                    &lt;h5 class=&quot;card-title&quot;&gt;Card title&lt;/h5&gt;
                    &lt;p class=&quot;card-text&quot;&gt;This is a short card.&lt;/p&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;div class=&quot;col&quot;&gt;
            &lt;div class=&quot;card h-100&quot;&gt;
                &lt;img class=&quot;card-img-top&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/7.jpg') !!}&quot; alt=&quot;&quot; /&gt;
                &lt;div class=&quot;card-body&quot;&gt;
                    &lt;h5 class=&quot;card-title&quot;&gt;Card title&lt;/h5&gt;
                    &lt;p class=&quot;card-text&quot;&gt;This is a longer card with supporting text below as a natural lead-in to additional content.&lt;/p&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;div class=&quot;col&quot;&gt;
            &lt;div class=&quot;card h-100&quot;&gt;
                &lt;img class=&quot;card-img-top&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/4.jpg') !!}&quot; alt=&quot;&quot; /&gt;
                &lt;div class=&quot;card-body&quot;&gt;
                    &lt;h5 class=&quot;card-title&quot;&gt;Card title&lt;/h5&gt;
                    &lt;p class=&quot;card-text&quot;&gt;This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.&lt;/p&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                </div>

                                <p>Just like with card groups, card footers will automatically line up.</p>
                                <div class="bd-example mb-5">
                                    <div class="row row-cols-1 row-cols-md-3 g-4">
                                        <div class="col">
                                            <div class="card h-100">
                                                <img class="card-img-top" src="{!! backendAssets('dist/assets/images/gallery/2.jpg') !!}" alt="" />
                                                <div class="card-body">
                                                    <h5 class="card-title">Card title</h5>
                                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                                </div>
                                                <div class="card-footer">
                                                    <small class="text-muted">Last updated 3 mins ago</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card h-100">
                                                <img class="card-img-top" src="{!! backendAssets('dist/assets/images/gallery/5.jpg') !!}" alt="" />
                                                <div class="card-body">
                                                    <h5 class="card-title">Card title</h5>
                                                    <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                                                </div>
                                                <div class="card-footer">
                                                    <small class="text-muted">Last updated 3 mins ago</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card h-100">
                                                <img class="card-img-top" src="{!! backendAssets('dist/assets/images/gallery/6.jpg') !!}" alt="" />
                                                <div class="card-body">
                                                    <h5 class="card-title">Card title</h5>
                                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                                                </div>
                                                <div class="card-footer">
                                                    <small class="text-muted">Last updated 3 mins ago</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;row row-cols-1 row-cols-md-3 g-4&quot;&gt;
        &lt;div class=&quot;col&quot;&gt;
            &lt;div class=&quot;card h-100&quot;&gt;
                &lt;img class=&quot;card-img-top&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/2.jpg') !!}&quot; alt=&quot;&quot; /&gt;
                &lt;div class=&quot;card-body&quot;&gt;
                    &lt;h5 class=&quot;card-title&quot;&gt;Card title&lt;/h5&gt;
                    &lt;p class=&quot;card-text&quot;&gt;This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.&lt;/p&gt;
                &lt;/div&gt;
                &lt;div class=&quot;card-footer&quot;&gt;
                    &lt;small class=&quot;text-muted&quot;&gt;Last updated 3 mins ago&lt;/small&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;div class=&quot;col&quot;&gt;
            &lt;div class=&quot;card h-100&quot;&gt;
                &lt;img class=&quot;card-img-top&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/5.jpg') !!}&quot; alt=&quot;&quot; /&gt;
                &lt;div class=&quot;card-body&quot;&gt;
                    &lt;h5 class=&quot;card-title&quot;&gt;Card title&lt;/h5&gt;
                    &lt;p class=&quot;card-text&quot;&gt;This card has supporting text below as a natural lead-in to additional content.&lt;/p&gt;
                &lt;/div&gt;
                &lt;div class=&quot;card-footer&quot;&gt;
                    &lt;small class=&quot;text-muted&quot;&gt;Last updated 3 mins ago&lt;/small&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;div class=&quot;col&quot;&gt;
            &lt;div class=&quot;card h-100&quot;&gt;
                &lt;img class=&quot;card-img-top&quot; src=&quot;{!! backendAssets('dist/assets/images/gallery/6.jpg') !!}&quot; alt=&quot;&quot; /&gt;
                &lt;div class=&quot;card-body&quot;&gt;
                    &lt;h5 class=&quot;card-title&quot;&gt;Card title&lt;/h5&gt;
                    &lt;p class=&quot;card-text&quot;&gt;This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.&lt;/p&gt;
                &lt;/div&gt;
                &lt;div class=&quot;card-footer&quot;&gt;
                    &lt;small class=&quot;text-muted&quot;&gt;Last updated 3 mins ago&lt;/small&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                </div>

                                <h3 id="masonry">Masonry</h3>
                                <p>In <code>v4</code> we used a CSS-only technique to mimic the behavior of <a href="https://masonry.desandro.com/">Masonry</a>-like columns, but this technique came with lots of unpleasant <a href="https://github.com/twbs/bootstrap/pull/28922">side effects</a>. If you want to have this type of layout in <code>v5</code>, you can just make use of Masonry plugin. <strong>Masonry is not included in Bootstrap</strong>, but we’ve made a <a href="https://v5.getbootstrap.com/docs/5.0/examples/masonry/">demo example</a> to help you get started.</p>
                            </div>
                            <div class="col-lg-3 col-sm-12 d-none d-sm-block">
                                <div class="sticky-lg-top">
                                    <strong class="d-block h6 my-2 pb-2 border-bottom">On this page</strong>
                                    <nav class="color-bg-200 py-3">
                                        <ul class="side-navbar">
                                            <li><a href="#about">About</a></li>
                                            <li><a href="#example">Example</a></li>
                                            <li><a href="#content-types">Content types</a>
                                                <ul>
                                                    <li><a href="#body">Body</a></li>
                                                    <li><a href="#titles-text-and-links">Titles, text, and links</a></li>
                                                    <li><a href="#images">Images</a></li>
                                                    <li><a href="#list-groups">List groups</a></li>
                                                    <li><a href="#kitchen-sink">Kitchen sink</a></li>
                                                    <li><a href="#header-and-footer">Header and footer</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#sizing">Sizing</a>
                                                <ul>
                                                    <li><a href="#using-grid-markup">Using grid markup</a></li>
                                                    <li><a href="#using-utilities">Using utilities</a></li>
                                                    <li><a href="#using-custom-css">Using custom CSS</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#text-alignment">Text alignment</a></li>
                                            <li><a href="#navigation">Navigation</a></li>
                                            <li><a href="#images-1">Images</a>
                                                <ul>
                                                    <li><a href="#image-caps">Image caps</a></li>
                                                    <li><a href="#image-overlays">Image overlays</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#horizontal">Horizontal</a></li>
                                            <li><a href="#card-styles">Card styles</a>
                                                <ul>
                                                    <li><a href="#background-and-color">Background and color</a></li>
                                                    <li><a href="#border">Border</a></li>
                                                    <li><a href="#mixins-utilities">Mixins utilities</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#card-layout">Card layout</a>
                                                <ul>
                                                    <li><a href="#card-groups">Card groups</a></li>
                                                    <li><a href="#grid-cards">Grid cards</a></li>
                                                    <li><a href="#masonry">Masonry</a></li>
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
