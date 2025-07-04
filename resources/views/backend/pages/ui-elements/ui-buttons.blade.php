@extends(backendView('layouts.app'))

@section('title', 'Ui Buttons')

@section('content')

<div class="container">
                    <div class="col-12">
                        <div class="card mb-4 shadow-sm border-0">
                            <div class="card-body">
                                <ul class="nav nav-tabs tab-body-header rounded d-inline-flex" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#btn-normal" role="tab">Buttons</a></li>
                                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#btn-group" role="tab">Buttons Groups</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="btn-normal" role="tabpanel">
                                <div class="row justify-content-between">
                                    <div class="col-lg-8 col-sm-12">

                                        <h2 id="examples">Examples</h2>
                                        <p>Bootstrap includes several predefined button styles, each serving its own semantic purpose, with a few extras thrown in for more control.</p>
                                        <div class="bd-example mb-5">
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
                                        
                                        <div class="bd-callout bd-callout-info">
                                            <h5 id="conveying-meaning-to-assistive-technologies">Conveying meaning to assistive technologies</h5>
                                            <p>Using color to add meaning only provides a visual indication, which will not be conveyed to users of assistive technologies – such as screen readers. Ensure that information denoted by the color is either obvious from the content itself (e.g. the visible text), or is included through alternative means, such as additional text hidden with the <code>.visually-hidden</code> class.</p>
                                        </div>
                                        
                                        <h2 id="disable-text-wrapping">Disable text wrapping</h2>
                                        <p>If you don’t want the button text to wrap, you can add the <code>.text-nowrap</code> class to the button. In Sass, you can set <code>$btn-white-space: nowrap</code> to disable text wrapping for each button.</p>
                                        <h2 id="button-tags">Button tags<a class="anchorjs-link " aria-label="Anchor" data-anchorjs-icon="#" href="#button-tags" style="padding-left: 0.375em;"></a></h2>
                                        <p>The <code>.btn</code> classes are designed to be used with the <code>&lt;button&gt;</code> element. However, you can also use these classes on <code>&lt;a&gt;</code> or <code>&lt;input&gt;</code> elements (though some browsers may apply a slightly different rendering).</p>
                                        <p>When using button classes on <code>&lt;a&gt;</code> elements that are used to trigger in-page functionality (like collapsing content), rather than linking to new pages or sections within the current page, these links should be given a <code>role="button"</code> to appropriately convey their purpose to assistive technologies such as screen readers.</p>
                                        <div class="bd-example mb-5">
                                            <a class="btn btn-primary" href="#" role="button">Link</a>
                                            <button class="btn btn-primary" type="submit">Button</button>
                                            <input class="btn btn-primary" type="button" value="Input">
                                            <input class="btn btn-primary" type="submit" value="Submit">
                                            <input class="btn btn-primary" type="reset" value="Reset">
    <pre>
    <code class="language-html" data-lang="html">&lt;a class=&quot;btn btn-primary&quot; href=&quot;#&quot; role=&quot;button&quot;&gt;Link&lt;/a&gt;
    &lt;button class=&quot;btn btn-primary&quot; type=&quot;submit&quot;&gt;Button&lt;/button&gt;
    &lt;input class=&quot;btn btn-primary&quot; type=&quot;button&quot; value=&quot;Input&quot;&gt;
    &lt;input class=&quot;btn btn-primary&quot; type=&quot;submit&quot; value=&quot;Submit&quot;&gt;
    &lt;input class=&quot;btn btn-primary&quot; type=&quot;reset&quot; value=&quot;Reset&quot;&gt;</code>
    </pre>
                                        </div>


                                        <h2 id="outline-buttons">Outline buttons</h2>
                                        <p>In need of a button, but not the hefty background colors they bring? Replace the default modifier classes with the <code>.btn-outline-*</code> ones to remove all background images and colors on any button.</p>
                                        <div class="bd-example mb-5">
                                        
                                            <button type="button" class="btn btn-outline-primary">Primary</button>
                                            <button type="button" class="btn btn-outline-secondary">Secondary</button>
                                            <button type="button" class="btn btn-outline-success">Success</button>
                                            <button type="button" class="btn btn-outline-danger">Danger</button>
                                            <button type="button" class="btn btn-outline-warning">Warning</button>
                                            <button type="button" class="btn btn-outline-info">Info</button>
                                            <button type="button" class="btn btn-outline-light">Light</button>
                                            <button type="button" class="btn btn-outline-dark">Dark</button>

    <pre>
    <code class="language-html" data-lang="html">&lt;button type=&quot;button&quot; class=&quot;btn btn-outline-primary&quot;&gt;Primary&lt;/button&gt;
    &lt;button type=&quot;button&quot; class=&quot;btn btn-outline-secondary&quot;&gt;Secondary&lt;/button&gt;
    &lt;button type=&quot;button&quot; class=&quot;btn btn-outline-success&quot;&gt;Success&lt;/button&gt;
    &lt;button type=&quot;button&quot; class=&quot;btn btn-outline-danger&quot;&gt;Danger&lt;/button&gt;
    &lt;button type=&quot;button&quot; class=&quot;btn btn-outline-warning&quot;&gt;Warning&lt;/button&gt;
    &lt;button type=&quot;button&quot; class=&quot;btn btn-outline-info&quot;&gt;Info&lt;/button&gt;
    &lt;button type=&quot;button&quot; class=&quot;btn btn-outline-light&quot;&gt;Light&lt;/button&gt;
    &lt;button type=&quot;button&quot; class=&quot;btn btn-outline-dark&quot;&gt;Dark&lt;/button&gt;</code>
    </pre>
                                        </div>

                                        <h2 id="sizes">Sizes</h2>
                                        <p>Fancy larger or smaller buttons? Add <code>.btn-lg</code> or <code>.btn-sm</code> for additional sizes.</p>
                                        <div class="bd-example mb-2">
                                            <button type="button" class="btn btn-primary btn-lg">Large button</button>
                                            <button type="button" class="btn btn-secondary btn-lg">Large button</button>
    <pre>
    <code class="language-html" data-lang="html">&lt;button type=&quot;button&quot; class=&quot;btn btn-primary btn-lg&quot;&gt;Large button&lt;/button&gt;
    &lt;button type=&quot;button&quot; class=&quot;btn btn-secondary btn-lg&quot;&gt;Large button&lt;/button&gt;</code>
    </pre>
                                        </div>                            
                                        <div class="bd-example mb-5">
                                            <button type="button" class="btn btn-primary btn-sm">Small button</button>
                                            <button type="button" class="btn btn-secondary btn-sm">Small button</button>
    <pre>
    <code class="language-html" data-lang="html">&lt;button type=&quot;button&quot; class=&quot;btn btn-primary btn-sm&quot;&gt;Small button&lt;/button&gt;
    &lt;button type=&quot;button&quot; class=&quot;btn btn-secondary btn-sm&quot;&gt;Small button&lt;/button&gt;</code>
    </pre>
                                        </div>
                                        
                                        <p>Create block level buttons—those that span the full width of a parent—by adding <code>.btn-block</code>.</p>
                                        <div class="bd-example mb-5">
                                            <button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button>
                                            <button type="button" class="btn btn-secondary btn-lg btn-block">Block level button</button>
    <pre>
    <code class="language-html" data-lang="html">&lt;button type=&quot;button&quot; class=&quot;btn btn-primary btn-lg btn-block&quot;&gt;Block level button&lt;/button&gt;
    &lt;button type=&quot;button&quot; class=&quot;btn btn-secondary btn-lg btn-block&quot;&gt;Block level button&lt;/button&gt;</code>
    </pre>
                                        </div>
                                        
                                        <h2 id="disabled-state">Disabled state</h2>
                                        <p>Make buttons look inactive by adding the <code>disabled</code> boolean attribute to any <code>&lt;button&gt;</code> element. Disabled buttons have <code>pointer-events: none</code> applied to, preventing hover and active states from triggering.</p>
                                        <div class="bd-example mb-5">
                                            <button type="button" class="btn btn-lg btn-primary" disabled="">Primary button</button>
                                            <button type="button" class="btn btn-secondary btn-lg" disabled="">Button</button>
    <pre>
    <code class="language-html" data-lang="html">&lt;button type=&quot;button&quot; class=&quot;btn btn-lg btn-primary&quot; disabled=&quot;&quot;&gt;Primary button&lt;/button&gt;
    &lt;button type=&quot;button&quot; class=&quot;btn btn-secondary btn-lg&quot; disabled=&quot;&quot;&gt;Button&lt;/button&gt;</code>
    </pre>
                                        </div>
                                        
                                        <p>Disabled buttons using the <code>&lt;a&gt;</code> element behave a bit different:</p>
                                        <ul class="ps-3">
                                            <li><code>&lt;a&gt;</code>s don’t support the <code>disabled</code> attribute, so you must add the <code>.disabled</code> class to make it visually appear disabled.</li>
                                            <li>Some future-friendly styles are included to disable all <code>pointer-events</code> on anchor buttons.</li>
                                            <li>Disabled buttons should include the <code>aria-disabled="true"</code> attribute to indicate the state of the element to assistive technologies.</li>
                                        </ul>
                                        <div class="bd-example mb-5">
                                            <a href="#" class="btn btn-primary btn-lg disabled" tabindex="-1" role="button" aria-disabled="true">Primary link</a>
                                            <a href="#" class="btn btn-secondary btn-lg disabled" tabindex="-1" role="button" aria-disabled="true">Link</a>
    <pre>
    <code class="language-html" data-lang="html">&lt;a href=&quot;#&quot; class=&quot;btn btn-primary btn-lg disabled&quot; tabindex=&quot;-1&quot; role=&quot;button&quot; aria-disabled=&quot;true&quot;&gt;Primary link&lt;/a&gt;
    &lt;a href=&quot;#&quot; class=&quot;btn btn-secondary btn-lg disabled&quot; tabindex=&quot;-1&quot; role=&quot;button&quot; aria-disabled=&quot;true&quot;&gt;Link&lt;/a&gt;</code>
    </pre>
                                        </div>

                                        
                                        <div class="bd-callout bd-callout-warning">
                                            <h5 id="link-functionality-caveat">Link functionality caveat</h5>
                                            <p>The <code>.disabled</code> class uses <code>pointer-events: none</code> to try to disable the link functionality of <code>&lt;a&gt;</code>s, but that CSS property is not yet standardized. In addition, even in browsers that do support <code>pointer-events: none</code>, keyboard navigation remains unaffected, meaning that sighted keyboard users and users of assistive technologies will still be able to activate these links. So to be safe, in addition to <code>aria-disabled="true"</code>, also include a <code>tabindex="-1"</code> attribute on these links to prevent them from receiving keyboard focus, and use custom JavaScript to disable their functionality altogether.</p>
                                        </div>
                                        
                                        <h2 id="button-plugin">Button plugin</h2>
                                        <p>The button plugin allows you to create simple on/off toggle buttons.</p>
                                        <div class="card p-4 mb-5 shadow-sm">
                                            Visually, these toggle buttons are identical to the <a href="https://v5.getbootstrap.com/docs/5.0/forms/checks-radios/#checkbox-toggle-buttons">checkbox toggle buttons</a>. However, they are conveyed differently by assistive technologies: the checkbox toggles will be announced by screen readers as “checked”/“not checked” (since, despite their appearance, they are fundamentally still checkboxes), whereas these toggle buttons will be announced as “button”/“button pressed”. The choice between these two approaches will depend on the type of toggle you are creating, and whether or not the toggle will make sense to users when announced as a checkbox or as an actual button.
                                        </div>
                                        
                                        <h3 id="toggle-states">Toggle states</h3>
                                        <p>Add <code>data-bs-toggle="button"</code> to toggle a button’s <code>active</code> state. If you’re pre-toggling a button, you must manually add the <code>.active</code> class <strong>and</strong> <code>aria-pressed="true"</code> to ensure that it is conveyed appropriately to assistive technologies.</p>
                                        <div class="bd-example mb-5">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="button" >Toggle button</button>
                                            <button type="button" class="btn btn-primary active" data-bs-toggle="button"  aria-pressed="true">Active toggle button</button>
                                            <button type="button" class="btn btn-primary" disabled="" data-bs-toggle="button" >Disabled toggle button</button>
    <pre>
    <code class="language-html" data-lang="html">&lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot; data-bs-toggle=&quot;button&quot; autocomplete=&quot;off&quot;&gt;Toggle button&lt;/button&gt;
    &lt;button type=&quot;button&quot; class=&quot;btn btn-primary active&quot; data-bs-toggle=&quot;button&quot; autocomplete=&quot;off&quot; aria-pressed=&quot;true&quot;&gt;Active toggle button&lt;/button&gt;
    &lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot; disabled=&quot;&quot; data-bs-toggle=&quot;button&quot; autocomplete=&quot;off&quot;&gt;Disabled toggle button&lt;/button&gt;</code>
    </pre>
                                        </div>
                                        
                                        <div class="bd-example mb-5">
                                            <a href="#" class="btn btn-primary" role="button" data-bs-toggle="button">Toggle link</a>
                                            <a href="#" class="btn btn-primary active" role="button" data-bs-toggle="button" aria-pressed="true">Active toggle link</a>
                                            <a href="#" class="btn btn-primary disabled" tabindex="-1" aria-disabled="true" role="button" data-bs-toggle="button">Disabled toggle link</a>
    <pre>
    <code class="language-html" data-lang="html">&lt;a href=&quot;#&quot; class=&quot;btn btn-primary&quot; role=&quot;button&quot; data-bs-toggle=&quot;button&quot;&gt;Toggle link&lt;/a&gt;
    &lt;a href=&quot;#&quot; class=&quot;btn btn-primary active&quot; role=&quot;button&quot; data-bs-toggle=&quot;button&quot; aria-pressed=&quot;true&quot;&gt;Active toggle link&lt;/a&gt;
    &lt;a href=&quot;#&quot; class=&quot;btn btn-primary disabled&quot; tabindex=&quot;-1&quot; aria-disabled=&quot;true&quot; role=&quot;button&quot; data-bs-toggle=&quot;button&quot;&gt;Disabled toggle link&lt;/a&gt;</code>
    </pre>
                                        </div>


                                        <h3 id="methods">Methods</h3>
                                        <p>You can create a button instance with the button constructor, for example:</p>
                                        <div class="bd-example mb-5">
    <pre><code class="language-js" data-lang="js"><span class="kd">var</span> <span class="nx">button</span> <span class="o">=</span> <span class="nb">document</span><span class="p">.</span><span class="nx">getElementById</span><span class="p">(</span><span class="s1">'myButton'</span><span class="p">)</span>
    <span class="kd">var</span> <span class="nx">bsButton</span> <span class="o">=</span> <span class="k">new</span> <span class="nx">bootstrap</span><span class="p">.</span><span class="nx">Button</span><span class="p">(</span><span class="nx">button</span><span class="p">)</span>
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
                                                    <td><code>toggle</code></td>
                                                    <td>Toggles push state. Gives the button the appearance that it has been activated.</td>
                                                </tr>
                                                <tr>
                                                    <td><code>dispose</code></td>
                                                    <td>Destroys an element's button.</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p>For example, to toggle all buttons</p>
                                        <div class="bd-example mb-5">
    <pre><code class="language-js" data-lang="js"><span class="kd">var</span> <span class="nx">buttons</span> <span class="o">=</span> <span class="nb">document</span><span class="p">.</span><span class="nx">querySelectorAll</span><span class="p">(</span><span class="s1">'.btn'</span><span class="p">)</span>
    <span class="nx">buttons</span><span class="p">.</span><span class="nx">forEach</span><span class="p">(</span><span class="kd">function</span> <span class="p">(</span><span class="nx">button</span><span class="p">)</span> <span class="p">{</span>
        <span class="kd">var</span> <span class="nx">button</span> <span class="o">=</span> <span class="k">new</span> <span class="nx">bootstrap</span><span class="p">.</span><span class="nx">Button</span><span class="p">(</span><span class="nx">button</span><span class="p">)</span>
        <span class="nx">button</span><span class="p">.</span><span class="nx">toggle</span><span class="p">()</span>
    <span class="p">})</span>
    </code></pre>
                                        </div>

                                    </div>
                                    <div class="col-lg-3 col-sm-12 d-none d-sm-block">
                                        <div class="sticky-lg-top">
                                            <strong class="d-block h6 my-2 pb-2 border-bottom">On this page</strong>
                                            <nav class="color-bg-200 py-3">
                                                <ul class="side-navbar">
                                                    <li><a href="#examples">Examples</a></li>
                                                    <li><a href="#disable-text-wrapping">Disable text wrapping</a></li>
                                                    <li><a href="#button-tags">Button tags</a></li>
                                                    <li><a href="#outline-buttons">Outline buttons</a></li>
                                                    <li><a href="#sizes">Sizes</a></li>
                                                    <li><a href="#disabled-state">Disabled state</a></li>
                                                    <li><a href="#button-plugin">Button plugin</a>
                                                        <ul>
                                                            <li><a href="#toggle-states">Toggle states</a></li>
                                                            <li><a href="#methods">Methods</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div> <!-- Row end  -->
                            </div>

                            <div class="tab-pane fade" id="btn-group" role="tabpanel">
                                <div class="row justify-content-between">
                                    <div class="col-lg-8 col-sm-12">
                                        <h2 id="basic-example">Basic example</h2>
                                        <p>Wrap a series of buttons with <code>.btn</code> in <code>.btn-group</code>.</p>
                                        <div class="bd-example mb-5">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-primary">Left</button>
                                                <button type="button" class="btn btn-primary">Middle</button>
                                                <button type="button" class="btn btn-primary">Right</button>
                                            </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;btn-group&quot; role=&quot;group&quot; aria-label=&quot;Basic example&quot;&gt;
        &lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot;&gt;Left&lt;/button&gt;
        &lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot;&gt;Middle&lt;/button&gt;
        &lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot;&gt;Right&lt;/button&gt;
    &lt;/div&gt;</code>
    </pre>
                                        </div>
                                        
                                        <div class="bd-callout bd-callout-warning">
                                            <h5 id="ensure-correct-role-and-provide-a-label">Ensure correct <code>role</code> and provide a label</h5>
                                            <p>In order for assistive technologies (such as screen readers) to convey that a series of buttons is grouped, an appropriate <code>role</code> attribute needs to be provided. For button groups, this would be <code>role="group"</code>, while toolbars should have a <code>role="toolbar"</code>.</p>
                                            <p>In addition, groups and toolbars should be given an explicit label, as most assistive technologies will otherwise not announce them, despite the presence of the correct role attribute. In the examples provided here, we use <code>aria-label</code>, but alternatives such as <code>aria-labelledby</code> can also be used.</p>
                                        </div>
                                        
                                        <p>These classes can also be added to groups of links, as an alternative to the <a href="/docs/5.0/components/navs/"><code>.nav</code> navigation components</a>.</p>
                                        <div class="bd-example mb-5">
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-primary active" aria-current="page">Active link</a>
                                                <a href="#" class="btn btn-primary">Link</a>
                                                <a href="#" class="btn btn-primary">Link</a>
                                            </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;btn-group&quot;&gt;
        &lt;a href=&quot;#&quot; class=&quot;btn btn-primary active&quot; aria-current=&quot;page&quot;&gt;Active link&lt;/a&gt;
        &lt;a href=&quot;#&quot; class=&quot;btn btn-primary&quot;&gt;Link&lt;/a&gt;
        &lt;a href=&quot;#&quot; class=&quot;btn btn-primary&quot;&gt;Link&lt;/a&gt;
    &lt;/div&gt;</code>
    </pre>
                                        </div>
                                        
                                        <h2 id="mixed-styles">Mixed styles</h2>
                                        <div class="bd-example mb-5">
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <button type="button" class="btn btn-danger">Left</button>
                                                <button type="button" class="btn btn-warning">Middle</button>
                                                <button type="button" class="btn btn-success">Right</button>
                                            </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;btn-group&quot; role=&quot;group&quot; aria-label=&quot;Basic mixed styles example&quot;&gt;
        &lt;button type=&quot;button&quot; class=&quot;btn btn-danger&quot;&gt;Left&lt;/button&gt;
        &lt;button type=&quot;button&quot; class=&quot;btn btn-warning&quot;&gt;Middle&lt;/button&gt;
        &lt;button type=&quot;button&quot; class=&quot;btn btn-success&quot;&gt;Right&lt;/button&gt;
    &lt;/div&gt;</code>
    </pre>
                                        </div>
                                        
                                        <h2 id="outlined-styles">Outlined styles</h2>
                                        <div class="bd-example mb-5">
                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <button type="button" class="btn btn-outline-primary">Left</button>
                                                <button type="button" class="btn btn-outline-primary">Middle</button>
                                                <button type="button" class="btn btn-outline-primary">Right</button>
                                            </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;btn-group&quot; role=&quot;group&quot; aria-label=&quot;Basic outlined example&quot;&gt;
        &lt;button type=&quot;button&quot; class=&quot;btn btn-outline-primary&quot;&gt;Left&lt;/button&gt;
        &lt;button type=&quot;button&quot; class=&quot;btn btn-outline-primary&quot;&gt;Middle&lt;/button&gt;
        &lt;button type=&quot;button&quot; class=&quot;btn btn-outline-primary&quot;&gt;Right&lt;/button&gt;
    &lt;/div&gt;</code>
    </pre>
                                        </div>
                                        
                                        <h2 id="checkbox-and-radio-button-groups">Checkbox and radio button groups</h2>
                                        <p>Combine button-like checkbox and radio <a href="/docs/5.0/forms/checks-radios/">toggle buttons</a> into a seamless looking button group.</p>
                                        <div class="bd-example mb-5">
                                            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                                <input type="checkbox" class="btn-check" id="btncheck1" >
                                                <label class="btn btn-outline-primary" for="btncheck1">Checkbox 1</label>
                                            
                                                <input type="checkbox" class="btn-check" id="btncheck2" >
                                                <label class="btn btn-outline-primary" for="btncheck2">Checkbox 2</label>
                                            
                                                <input type="checkbox" class="btn-check" id="btncheck3" >
                                                <label class="btn btn-outline-primary" for="btncheck3">Checkbox 3</label>
                                            </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;btn-group&quot; role=&quot;group&quot; aria-label=&quot;Basic checkbox toggle button group&quot;&gt;
        &lt;input type=&quot;checkbox&quot; class=&quot;btn-check&quot; id=&quot;btncheck1&quot; autocomplete=&quot;off&quot;&gt;
        &lt;label class=&quot;btn btn-outline-primary&quot; for=&quot;btncheck1&quot;&gt;Checkbox 1&lt;/label&gt;

        &lt;input type=&quot;checkbox&quot; class=&quot;btn-check&quot; id=&quot;btncheck2&quot; autocomplete=&quot;off&quot;&gt;
        &lt;label class=&quot;btn btn-outline-primary&quot; for=&quot;btncheck2&quot;&gt;Checkbox 2&lt;/label&gt;

        &lt;input type=&quot;checkbox&quot; class=&quot;btn-check&quot; id=&quot;btncheck3&quot; autocomplete=&quot;off&quot;&gt;
        &lt;label class=&quot;btn btn-outline-primary&quot; for=&quot;btncheck3&quot;&gt;Checkbox 3&lt;/label&gt;
    &lt;/div&gt;</code>
    </pre>
                                        </div>                                    
                                        <div class="bd-example mb-5">
                                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                <input type="radio" class="btn-check" name="btnradio" id="btnradio1"  checked="">
                                                <label class="btn btn-outline-primary" for="btnradio1">Radio 1</label>
                                            
                                                <input type="radio" class="btn-check" name="btnradio" id="btnradio2" >
                                                <label class="btn btn-outline-primary" for="btnradio2">Radio 2</label>
                                            
                                                <input type="radio" class="btn-check" name="btnradio" id="btnradio3" >
                                                <label class="btn btn-outline-primary" for="btnradio3">Radio 3</label>
                                            </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;btn-group&quot; role=&quot;group&quot; aria-label=&quot;Basic radio toggle button group&quot;&gt;
        &lt;input type=&quot;radio&quot; class=&quot;btn-check&quot; name=&quot;btnradio&quot; id=&quot;btnradio1&quot; autocomplete=&quot;off&quot; checked=&quot;&quot;&gt;
        &lt;label class=&quot;btn btn-outline-primary&quot; for=&quot;btnradio1&quot;&gt;Radio 1&lt;/label&gt;

        &lt;input type=&quot;radio&quot; class=&quot;btn-check&quot; name=&quot;btnradio&quot; id=&quot;btnradio2&quot; autocomplete=&quot;off&quot;&gt;
        &lt;label class=&quot;btn btn-outline-primary&quot; for=&quot;btnradio2&quot;&gt;Radio 2&lt;/label&gt;

        &lt;input type=&quot;radio&quot; class=&quot;btn-check&quot; name=&quot;btnradio&quot; id=&quot;btnradio3&quot; autocomplete=&quot;off&quot;&gt;
        &lt;label class=&quot;btn btn-outline-primary&quot; for=&quot;btnradio3&quot;&gt;Radio 3&lt;/label&gt;
    &lt;/div&gt;</code>
    </pre>
                                        </div>                                    
                                        
                                        <h2 id="button-toolbar">Button toolbar</h2>
                                        <p>Combine sets of button groups into button toolbars for more complex components. Use utility classes as needed to space out groups, buttons, and more.</p>
                                        <div class="bd-example mb-5">
                                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group me-2" role="group" aria-label="First group">
                                                    <button type="button" class="btn btn-primary">1</button>
                                                    <button type="button" class="btn btn-primary">2</button>
                                                    <button type="button" class="btn btn-primary">3</button>
                                                    <button type="button" class="btn btn-primary">4</button>
                                                </div>
                                                <div class="btn-group me-2" role="group" aria-label="Second group">
                                                    <button type="button" class="btn btn-secondary">5</button>
                                                    <button type="button" class="btn btn-secondary">6</button>
                                                    <button type="button" class="btn btn-secondary">7</button>
                                                </div>
                                                <div class="btn-group" role="group" aria-label="Third group">
                                                    <button type="button" class="btn btn-info">8</button>
                                                </div>
                                            </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;btn-toolbar&quot; role=&quot;toolbar&quot; aria-label=&quot;Toolbar with button groups&quot;&gt;
        &lt;div class=&quot;btn-group me-2&quot; role=&quot;group&quot; aria-label=&quot;First group&quot;&gt;
            &lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot;&gt;1&lt;/button&gt;
            &lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot;&gt;2&lt;/button&gt;
            &lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot;&gt;3&lt;/button&gt;
            &lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot;&gt;4&lt;/button&gt;
        &lt;/div&gt;
        &lt;div class=&quot;btn-group me-2&quot; role=&quot;group&quot; aria-label=&quot;Second group&quot;&gt;
            &lt;button type=&quot;button&quot; class=&quot;btn btn-secondary&quot;&gt;5&lt;/button&gt;
            &lt;button type=&quot;button&quot; class=&quot;btn btn-secondary&quot;&gt;6&lt;/button&gt;
            &lt;button type=&quot;button&quot; class=&quot;btn btn-secondary&quot;&gt;7&lt;/button&gt;
        &lt;/div&gt;
        &lt;div class=&quot;btn-group&quot; role=&quot;group&quot; aria-label=&quot;Third group&quot;&gt;
            &lt;button type=&quot;button&quot; class=&quot;btn btn-info&quot;&gt;8&lt;/button&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                        </div>
                                        
                                        <p>Feel free to mix input groups with button groups in your toolbars. Similar to the example above, you’ll likely need some utilities though to space things properly.</p>
                                        <div class="bd-example mb-5">
                                            <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group me-2" role="group" aria-label="First group">
                                                    <button type="button" class="btn btn-outline-secondary">1</button>
                                                    <button type="button" class="btn btn-outline-secondary">2</button>
                                                    <button type="button" class="btn btn-outline-secondary">3</button>
                                                    <button type="button" class="btn btn-outline-secondary">4</button>
                                                </div>
                                                <div class="input-group">
                                                    <div class="input-group-text" id="btnGroupAddon">@</div>
                                                    <input type="text" class="form-control" placeholder="Input group example" aria-label="Input group example" aria-describedby="btnGroupAddon">
                                                </div>
                                            </div>
                                            
                                            <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group" role="group" aria-label="First group">
                                                    <button type="button" class="btn btn-outline-secondary">1</button>
                                                    <button type="button" class="btn btn-outline-secondary">2</button>
                                                    <button type="button" class="btn btn-outline-secondary">3</button>
                                                    <button type="button" class="btn btn-outline-secondary">4</button>
                                                </div>
                                                    <div class="input-group">
                                                    <div class="input-group-text" id="btnGroupAddon2">@</div>
                                                    <input type="text" class="form-control" placeholder="Input group example" aria-label="Input group example" aria-describedby="btnGroupAddon2">
                                                </div>
                                            </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;btn-toolbar mb-3&quot; role=&quot;toolbar&quot; aria-label=&quot;Toolbar with button groups&quot;&gt;
        &lt;div class=&quot;btn-group me-2&quot; role=&quot;group&quot; aria-label=&quot;First group&quot;&gt;
            &lt;button type=&quot;button&quot; class=&quot;btn btn-outline-secondary&quot;&gt;1&lt;/button&gt;
            &lt;button type=&quot;button&quot; class=&quot;btn btn-outline-secondary&quot;&gt;2&lt;/button&gt;
            &lt;button type=&quot;button&quot; class=&quot;btn btn-outline-secondary&quot;&gt;3&lt;/button&gt;
            &lt;button type=&quot;button&quot; class=&quot;btn btn-outline-secondary&quot;&gt;4&lt;/button&gt;
        &lt;/div&gt;
        &lt;div class=&quot;input-group&quot;&gt;
            &lt;div class=&quot;input-group-text&quot; id=&quot;btnGroupAddon&quot;&gt;@&lt;/div&gt;
            &lt;input type=&quot;text&quot; class=&quot;form-control&quot; placeholder=&quot;Input group example&quot; aria-label=&quot;Input group example&quot; aria-describedby=&quot;btnGroupAddon&quot;&gt;
        &lt;/div&gt;
    &lt;/div&gt;

    &lt;div class=&quot;btn-toolbar justify-content-between&quot; role=&quot;toolbar&quot; aria-label=&quot;Toolbar with button groups&quot;&gt;
        &lt;div class=&quot;btn-group&quot; role=&quot;group&quot; aria-label=&quot;First group&quot;&gt;
            &lt;button type=&quot;button&quot; class=&quot;btn btn-outline-secondary&quot;&gt;1&lt;/button&gt;
            &lt;button type=&quot;button&quot; class=&quot;btn btn-outline-secondary&quot;&gt;2&lt;/button&gt;
            &lt;button type=&quot;button&quot; class=&quot;btn btn-outline-secondary&quot;&gt;3&lt;/button&gt;
            &lt;button type=&quot;button&quot; class=&quot;btn btn-outline-secondary&quot;&gt;4&lt;/button&gt;
        &lt;/div&gt;
            &lt;div class=&quot;input-group&quot;&gt;
            &lt;div class=&quot;input-group-text&quot; id=&quot;btnGroupAddon2&quot;&gt;@&lt;/div&gt;
            &lt;input type=&quot;text&quot; class=&quot;form-control&quot; placeholder=&quot;Input group example&quot; aria-label=&quot;Input group example&quot; aria-describedby=&quot;btnGroupAddon2&quot;&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                        </div>
                                        
                                        <h2 id="sizing">Sizing</h2>
                                        <p>Instead of applying button sizing classes to every button in a group, just add <code>.btn-group-*</code> to each <code>.btn-group</code>, including each one when nesting multiple groups.</p>
                                        <div class="bd-example mb-5">
                                            <div class="btn-group btn-group-lg" role="group" aria-label="Large button group">
                                                <button type="button" class="btn btn-outline-dark">Left</button>
                                                <button type="button" class="btn btn-outline-dark">Middle</button>
                                                <button type="button" class="btn btn-outline-dark">Right</button>
                                            </div>
                                            <div class="mt-2"></div>
                                            <div class="btn-group" role="group" aria-label="Default button group">
                                                <button type="button" class="btn btn-outline-dark">Left</button>
                                                <button type="button" class="btn btn-outline-dark">Middle</button>
                                                <button type="button" class="btn btn-outline-dark">Right</button>
                                            </div>
                                            <div class="mt-2"></div>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                <button type="button" class="btn btn-outline-dark">Left</button>
                                                <button type="button" class="btn btn-outline-dark">Middle</button>
                                                <button type="button" class="btn btn-outline-dark">Right</button>
                                            </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;btn-group btn-group-lg&quot; role=&quot;group&quot; aria-label=&quot;Large button group&quot;&gt;
        &lt;button type=&quot;button&quot; class=&quot;btn btn-outline-dark&quot;&gt;Left&lt;/button&gt;
        &lt;button type=&quot;button&quot; class=&quot;btn btn-outline-dark&quot;&gt;Middle&lt;/button&gt;
        &lt;button type=&quot;button&quot; class=&quot;btn btn-outline-dark&quot;&gt;Right&lt;/button&gt;
    &lt;/div&gt;
    &lt;br&gt;
    &lt;div class=&quot;btn-group&quot; role=&quot;group&quot; aria-label=&quot;Default button group&quot;&gt;
        &lt;button type=&quot;button&quot; class=&quot;btn btn-outline-dark&quot;&gt;Left&lt;/button&gt;
        &lt;button type=&quot;button&quot; class=&quot;btn btn-outline-dark&quot;&gt;Middle&lt;/button&gt;
        &lt;button type=&quot;button&quot; class=&quot;btn btn-outline-dark&quot;&gt;Right&lt;/button&gt;
    &lt;/div&gt;
    &lt;br&gt;
    &lt;div class=&quot;btn-group btn-group-sm&quot; role=&quot;group&quot; aria-label=&quot;Small button group&quot;&gt;
        &lt;button type=&quot;button&quot; class=&quot;btn btn-outline-dark&quot;&gt;Left&lt;/button&gt;
        &lt;button type=&quot;button&quot; class=&quot;btn btn-outline-dark&quot;&gt;Middle&lt;/button&gt;
        &lt;button type=&quot;button&quot; class=&quot;btn btn-outline-dark&quot;&gt;Right&lt;/button&gt;
    &lt;/div&gt;</code>
    </pre>
                                        </div>
                                        
                                        <h2 id="nesting">Nesting</h2>
                                        <p>Place a <code>.btn-group</code> within another <code>.btn-group</code> when you want dropdown menus mixed with a series of buttons.</p>
                                        <div class="bd-example mb-5">
                                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                <button type="button" class="btn btn-primary">1</button>
                                                <button type="button" class="btn btn-primary">2</button>
                                            
                                                <div class="btn-group" role="group">
                                                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Dropdown
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                        <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                                        <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                                    </ul>
                                                </div>
                                            </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;btn-group&quot; role=&quot;group&quot; aria-label=&quot;Button group with nested dropdown&quot;&gt;
        &lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot;&gt;1&lt;/button&gt;
        &lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot;&gt;2&lt;/button&gt;

        &lt;div class=&quot;btn-group&quot; role=&quot;group&quot;&gt;
            &lt;button id=&quot;btnGroupDrop1&quot; type=&quot;button&quot; class=&quot;btn btn-primary dropdown-toggle&quot; data-bs-toggle=&quot;dropdown&quot; aria-expanded=&quot;false&quot;&gt;
                Dropdown
            &lt;/button&gt;
            &lt;ul class=&quot;dropdown-menu&quot; aria-labelledby=&quot;btnGroupDrop1&quot;&gt;
                &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Dropdown link&lt;/a&gt;&lt;/li&gt;
                &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Dropdown link&lt;/a&gt;&lt;/li&gt;
            &lt;/ul&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                        </div>
                                        
                                        <h2 id="vertical-variation">Vertical variation<a class="anchorjs-link " aria-label="Anchor" data-anchorjs-icon="#" href="#vertical-variation" style="padding-left: 0.375em;"></a></h2>
                                        <p>Make a set of buttons appear vertically stacked rather than horizontally. <strong>Split button dropdowns are not supported here.</strong></p>
                                        <div class="bd-example mb-5">
                                            <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                                                <button type="button" class="btn btn-dark">Button</button>
                                                <button type="button" class="btn btn-dark">Button</button>
                                                <button type="button" class="btn btn-dark">Button</button>
                                                <button type="button" class="btn btn-dark">Button</button>
                                                <button type="button" class="btn btn-dark">Button</button>
                                                <button type="button" class="btn btn-dark">Button</button>
                                            </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;btn-group-vertical&quot; role=&quot;group&quot; aria-label=&quot;Vertical button group&quot;&gt;
        &lt;button type=&quot;button&quot; class=&quot;btn btn-dark&quot;&gt;Button&lt;/button&gt;
        &lt;button type=&quot;button&quot; class=&quot;btn btn-dark&quot;&gt;Button&lt;/button&gt;
        &lt;button type=&quot;button&quot; class=&quot;btn btn-dark&quot;&gt;Button&lt;/button&gt;
        &lt;button type=&quot;button&quot; class=&quot;btn btn-dark&quot;&gt;Button&lt;/button&gt;
        &lt;button type=&quot;button&quot; class=&quot;btn btn-dark&quot;&gt;Button&lt;/button&gt;
        &lt;button type=&quot;button&quot; class=&quot;btn btn-dark&quot;&gt;Button&lt;/button&gt;
    &lt;/div&gt;</code>
    </pre>
                                        </div>

                                        <div class="bd-example mb-5">
                                            <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                                                <button type="button" class="btn btn-primary">Button</button>
                                                <button type="button" class="btn btn-primary">Button</button>
                                                <div class="btn-group" role="group">
                                                    <button id="btnGroupVerticalDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Dropdown
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1">
                                                        <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                                        <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                                    </ul>
                                                </div>
                                                <button type="button" class="btn btn-primary">Button</button>
                                                <button type="button" class="btn btn-primary">Button</button>
                                                <div class="btn-group" role="group">
                                                    <button id="btnGroupVerticalDrop2" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Dropdown
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">
                                                        <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                                        <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                                    </ul>
                                                </div>
                                                <div class="btn-group" role="group">
                                                    <button id="btnGroupVerticalDrop3" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Dropdown
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop3">
                                                        <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                                        <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                                    </ul>
                                                </div>
                                                <div class="btn-group" role="group">
                                                    <button id="btnGroupVerticalDrop4" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Dropdown
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop4">
                                                        <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                                        <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                                    </ul>
                                                </div>
                                            </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;btn-group-vertical&quot; role=&quot;group&quot; aria-label=&quot;Vertical button group&quot;&gt;
        &lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot;&gt;Button&lt;/button&gt;
        &lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot;&gt;Button&lt;/button&gt;
        &lt;div class=&quot;btn-group&quot; role=&quot;group&quot;&gt;
            &lt;button id=&quot;btnGroupVerticalDrop1&quot; type=&quot;button&quot; class=&quot;btn btn-primary dropdown-toggle&quot; data-bs-toggle=&quot;dropdown&quot; aria-expanded=&quot;false&quot;&gt;
                Dropdown
            &lt;/button&gt;
            &lt;ul class=&quot;dropdown-menu&quot; aria-labelledby=&quot;btnGroupVerticalDrop1&quot;&gt;
                &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Dropdown link&lt;/a&gt;&lt;/li&gt;
                &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Dropdown link&lt;/a&gt;&lt;/li&gt;
            &lt;/ul&gt;
        &lt;/div&gt;
        &lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot;&gt;Button&lt;/button&gt;
        &lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot;&gt;Button&lt;/button&gt;
        &lt;div class=&quot;btn-group&quot; role=&quot;group&quot;&gt;
            &lt;button id=&quot;btnGroupVerticalDrop2&quot; type=&quot;button&quot; class=&quot;btn btn-primary dropdown-toggle&quot; data-bs-toggle=&quot;dropdown&quot; aria-expanded=&quot;false&quot;&gt;
                Dropdown
            &lt;/button&gt;
            &lt;ul class=&quot;dropdown-menu&quot; aria-labelledby=&quot;btnGroupVerticalDrop2&quot;&gt;
                &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Dropdown link&lt;/a&gt;&lt;/li&gt;
                &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Dropdown link&lt;/a&gt;&lt;/li&gt;
            &lt;/ul&gt;
        &lt;/div&gt;
        &lt;div class=&quot;btn-group&quot; role=&quot;group&quot;&gt;
            &lt;button id=&quot;btnGroupVerticalDrop3&quot; type=&quot;button&quot; class=&quot;btn btn-primary dropdown-toggle&quot; data-bs-toggle=&quot;dropdown&quot; aria-expanded=&quot;false&quot;&gt;
                Dropdown
            &lt;/button&gt;
            &lt;ul class=&quot;dropdown-menu&quot; aria-labelledby=&quot;btnGroupVerticalDrop3&quot;&gt;
                &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Dropdown link&lt;/a&gt;&lt;/li&gt;
                &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Dropdown link&lt;/a&gt;&lt;/li&gt;
            &lt;/ul&gt;
        &lt;/div&gt;
        &lt;div class=&quot;btn-group&quot; role=&quot;group&quot;&gt;
            &lt;button id=&quot;btnGroupVerticalDrop4&quot; type=&quot;button&quot; class=&quot;btn btn-primary dropdown-toggle&quot; data-bs-toggle=&quot;dropdown&quot; aria-expanded=&quot;false&quot;&gt;
                Dropdown
            &lt;/button&gt;
            &lt;ul class=&quot;dropdown-menu&quot; aria-labelledby=&quot;btnGroupVerticalDrop4&quot;&gt;
                &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Dropdown link&lt;/a&gt;&lt;/li&gt;
                &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Dropdown link&lt;/a&gt;&lt;/li&gt;
            &lt;/ul&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                        </div>
                                        <div class="bd-example">
                                            <div class="btn-group-vertical" role="group" aria-label="Vertical radio toggle button group">
                                                <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio1"  checked="">
                                                <label class="btn btn-outline-danger" for="vbtn-radio1">Radio 1</label>
                                                <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio2" >
                                                <label class="btn btn-outline-danger" for="vbtn-radio2">Radio 2</label>
                                                <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio3" >
                                                <label class="btn btn-outline-danger" for="vbtn-radio3">Radio 3</label>
                                            </div>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;btn-group-vertical&quot; role=&quot;group&quot; aria-label=&quot;Vertical radio toggle button group&quot;&gt;
        &lt;input type=&quot;radio&quot; class=&quot;btn-check&quot; name=&quot;vbtn-radio&quot; id=&quot;vbtn-radio1&quot; autocomplete=&quot;off&quot; checked=&quot;&quot;&gt;
        &lt;label class=&quot;btn btn-outline-danger&quot; for=&quot;vbtn-radio1&quot;&gt;Radio 1&lt;/label&gt;
        &lt;input type=&quot;radio&quot; class=&quot;btn-check&quot; name=&quot;vbtn-radio&quot; id=&quot;vbtn-radio2&quot; autocomplete=&quot;off&quot;&gt;
        &lt;label class=&quot;btn btn-outline-danger&quot; for=&quot;vbtn-radio2&quot;&gt;Radio 2&lt;/label&gt;
        &lt;input type=&quot;radio&quot; class=&quot;btn-check&quot; name=&quot;vbtn-radio&quot; id=&quot;vbtn-radio3&quot; autocomplete=&quot;off&quot;&gt;
        &lt;label class=&quot;btn btn-outline-danger&quot; for=&quot;vbtn-radio3&quot;&gt;Radio 3&lt;/label&gt;
    &lt;/div&gt;</code>
    </pre>
                                        </div>

                                    </div>
                                    <div class="col-lg-3 col-sm-12 d-none d-sm-block">
                                        <div class="sticky-lg-top">
                                            <strong class="d-block h6 my-2 pb-2 border-bottom">On this page</strong>
                                            <nav class="color-bg-200 py-3">
                                                <ul class="side-navbar">
                                                    <li><a href="#basic-example">Basic example</a></li>
                                                    <li><a href="#mixed-styles">Mixed styles</a></li>
                                                    <li><a href="#outlined-styles">Outlined styles</a></li>
                                                    <li><a href="#checkbox-and-radio-button-groups">Checkbox and radio button groups</a></li>
                                                    <li><a href="#button-toolbar">Button toolbar</a></li>
                                                    <li><a href="#sizing">Sizing</a></li>
                                                    <li><a href="#nesting">Nesting</a></li>
                                                    <li><a href="#vertical-variation">Vertical variation</a></li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div> <!-- Row end  -->
                                </div> <!-- Row end  -->
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
