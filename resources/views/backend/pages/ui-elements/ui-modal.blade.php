@extends(backendView('layouts.app'))

@section('title', 'Ui Modal')

@section('content')

<div class="container">
                    <div class="col-12">
                        <div class="bd-content">

                            <h2 id="how-it-works">How it works</h2>
                            <p>Before getting started with Bootstrap’s modal component, be sure to read the following as our menu options have recently changed.</p>
                            <div class="alert alert-danger" role="alert">
                                <strong>Modal</strong> for more bootstrao components <a href="https://v5.getbootstrap.com/docs/5.0/components/modal/" target="_blank">Bootstrap Modal documentation <i class="fa fa-external-link"></i></a>
                            </div>
                            <ul class="ps-3"> 
                                <li>Modals are built with HTML, CSS, and JavaScript. They’re positioned over everything else in the document and remove scroll from the <code>&lt;body&gt;</code> so that modal content scrolls instead.</li>
                                <li>Clicking on the modal “backdrop” will automatically close the modal.</li>
                                <li>Bootstrap only supports one modal window at a time. Nested modals aren’t supported as we believe them to be poor user experiences.</li>
                                <li>Modals use <code>position: fixed</code>, which can sometimes be a bit particular about its rendering. Whenever possible, place your modal HTML in a top-level position to avoid potential interference from other elements. You’ll likely run into issues when nesting a <code>.modal</code> within another fixed element.</li>
                                <li>Once again, due to <code>position: fixed</code>, there are some caveats with using modals on mobile devices. <a href="https://v5.getbootstrap.com/docs/5.0/getting-started/browsers-devices/#modals-and-dropdowns-on-mobile">See our browser support docs</a> for details.</li>
                                <li>Due to how HTML5 defines its semantics, <a href="https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input#attr-autofocus">the <code>autofocus</code> HTML attribute</a> has no effect in Bootstrap modals. To achieve the same effect, use some custom JavaScript:</li>
                            </ul>
                            <div class="mb-5">
    <pre><code class="language-js" data-lang="js"><span class="kd">var</span> <span class="nx">myModal</span> <span class="o">=</span> <span class="nb">document</span><span class="p">.</span><span class="nx">getElementById</span><span class="p">(</span><span class="s1">'myModal'</span><span class="p">)</span>
    <span class="kd">var</span> <span class="nx">myInput</span> <span class="o">=</span> <span class="nb">document</span><span class="p">.</span><span class="nx">getElementById</span><span class="p">(</span><span class="s1">'myInput'</span><span class="p">)</span>

    <span class="nx">myModal</span><span class="p">.</span><span class="nx">addEventListener</span><span class="p">(</span><span class="s1">'shown.bs.modal'</span><span class="p">,</span> <span class="kd">function</span> <span class="p">()</span> <span class="p">{</span>
        <span class="nx">myInput</span><span class="p">.</span><span class="nx">focus</span><span class="p">()</span>
    <span class="p">})</span>
    </code></pre>
                            </div>

                            <div class="border-top mt-5 pt-3">
                                <h4 id="modal-components">Modal components</h4>
                                <p>Below is a <em>static</em> modal example (meaning its <code>position</code> and <code>display</code> have been overridden). Included are the modal header, modal body (required for <code>padding</code>), and modal footer (optional). We ask that you include modal headers with dismiss actions whenever possible, or provide another explicit dismiss action.</p>
                                <ul class="nav nav-tabs tab-card px-3 border-bottom-0" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav-Preview1" role="tab">Preview</a></li>
                                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-HTML1" role="tab">HTML</a></li>
                                </ul>
                                <div class="card mb-3 bg-transparent">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="nav-Preview1" role="tabpanel">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModalLive">Launch demo modal</button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModalLive" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLiveLabel">Modal title</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Woohoo, you're reading this text in a modal!</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="nav-HTML1" role="tabpanel">
    <pre class="language-html" data-lang="html">
    <code>&lt;!-- Button trigger modal --&gt;
    &lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot; data-bs-toggle=&quot;modal&quot; data-bs-target=&quot;#exampleModalLive&quot;&gt;Launch demo modal&lt;/button&gt;

    &lt;!-- Modal --&gt;
    &lt;div class=&quot;modal fade&quot; id=&quot;exampleModalLive&quot; tabindex=&quot;-1&quot;&gt;
        &lt;div class=&quot;modal-dialog&quot;&gt;
            &lt;div class=&quot;modal-content&quot;&gt;
                &lt;div class=&quot;modal-header&quot;&gt;
                    &lt;h5 class=&quot;modal-title&quot; id=&quot;exampleModalLiveLabel&quot;&gt;Modal title&lt;/h5&gt;
                    &lt;button type=&quot;button&quot; class=&quot;btn-close&quot; data-bs-dismiss=&quot;modal&quot; aria-label=&quot;Close&quot;&gt;&lt;/button&gt;
                &lt;/div&gt;
                &lt;div class=&quot;modal-body&quot;&gt;
                    &lt;p&gt;Woohoo, you're reading this text in a modal!&lt;/p&gt;
                &lt;/div&gt;
                &lt;div class=&quot;modal-footer&quot;&gt;
                    &lt;button type=&quot;button&quot; class=&quot;btn btn-secondary&quot; data-bs-dismiss=&quot;modal&quot;&gt;Close&lt;/button&gt;
                    &lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot;&gt;Save changes&lt;/button&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-top mt-5 pt-3">
                                <h5 id="static-backdrop">Static backdrop</h5>
                                <p>When backdrop is set to static, the modal will not close when clicking outside it. Click the button below to try it.</p>
                                <ul class="nav nav-tabs tab-card px-3 border-bottom-0" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav-Preview2" role="tab">Preview</a></li>
                                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-HTML2" role="tab">HTML</a></li>
                                </ul>
                                <div class="card mb-3 bg-transparent">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="nav-Preview2" role="tabpanel">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdropLive">Launch static backdrop modal</button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="staticBackdropLive" data-backdrop="static" data-keyboard="false" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLiveLabel">Modal title</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>I will not close if you click outside me. Don't even try to press escape key.</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary">Understood</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="nav-HTML2" role="tabpanel">
    <pre class="language-html" data-lang="html">
    <code>&lt;!-- Button trigger modal --&gt;
    &lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot; data-bs-toggle=&quot;modal&quot; data-bs-target=&quot;#staticBackdropLive&quot;&gt;Launch static backdrop modal&lt;/button&gt;

    &lt;!-- Modal --&gt;
    &lt;div class=&quot;modal fade&quot; id=&quot;staticBackdropLive&quot; data-backdrop=&quot;static&quot; data-keyboard=&quot;false&quot; tabindex=&quot;-1&quot;&gt;
        &lt;div class=&quot;modal-dialog&quot;&gt;
            &lt;div class=&quot;modal-content&quot;&gt;
                &lt;div class=&quot;modal-header&quot;&gt;
                    &lt;h5 class=&quot;modal-title&quot; id=&quot;staticBackdropLiveLabel&quot;&gt;Modal title&lt;/h5&gt;
                    &lt;button type=&quot;button&quot; class=&quot;btn-close&quot; data-bs-dismiss=&quot;modal&quot; aria-label=&quot;Close&quot;&gt;&lt;/button&gt;
                &lt;/div&gt;
                &lt;div class=&quot;modal-body&quot;&gt;
                    &lt;p&gt;I will not close if you click outside me. Don't even try to press escape key.&lt;/p&gt;
                &lt;/div&gt;
                &lt;div class=&quot;modal-footer&quot;&gt;
                    &lt;button type=&quot;button&quot; class=&quot;btn btn-secondary&quot; data-bs-dismiss=&quot;modal&quot;&gt;Close&lt;/button&gt;
                    &lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot;&gt;Understood&lt;/button&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-top mt-5 pt-3">
                                <h5 id="vertically-centered">Vertically centered</h5>
                                <p>Add <code>.modal-dialog-centered</code> to <code>.modal-dialog</code> to vertically center the modal.</p>
                                <ul class="nav nav-tabs tab-card px-3 border-bottom-0" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav-Preview3" role="tab">Preview</a></li>
                                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-HTML3" role="tab">HTML</a></li>
                                </ul>
                                <div class="card mb-3 bg-transparent">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="nav-Preview3" role="tabpanel">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Vertically centered modal</button>
                                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModalCenteredScrollable">Vertically centered scrollable modal</button>

                                                <!-- Modal Modal Center-->
                                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal Modal Centered Scrollable-->
                                                <div class="modal fade" id="exampleModalCenteredScrollable" tabindex="-1" aria-labelledby="exampleModalCenteredScrollableTitle" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenteredScrollableTitle">Modal title</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                                                                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                                                                <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                                                                <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                                                                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="tab-pane fade" id="nav-HTML3" role="tabpanel">
    <pre class="language-html" data-lang="html">
    <code>&lt;!-- Button trigger modal --&gt;
    &lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot; data-bs-toggle=&quot;modal&quot; data-bs-target=&quot;#exampleModalCenter&quot;&gt;Vertically centered modal&lt;/button&gt;
    &lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot; data-bs-toggle=&quot;modal&quot; data-bs-target=&quot;#exampleModalCenteredScrollable&quot;&gt;Vertically centered scrollable modal&lt;/button&gt;

    &lt;!-- Modal Modal Center--&gt;
    &lt;div class=&quot;modal fade&quot; id=&quot;exampleModalCenter&quot; tabindex=&quot;-1&quot; aria-labelledby=&quot;exampleModalCenterTitle&quot; style=&quot;display: none;&quot; aria-hidden=&quot;true&quot;&gt;
        &lt;div class=&quot;modal-dialog modal-dialog-centered&quot;&gt;
            &lt;div class=&quot;modal-content&quot;&gt;
                &lt;div class=&quot;modal-header&quot;&gt;
                    &lt;h5 class=&quot;modal-title&quot; id=&quot;exampleModalCenterTitle&quot;&gt;Modal title&lt;/h5&gt;
                    &lt;button type=&quot;button&quot; class=&quot;btn-close&quot; data-bs-dismiss=&quot;modal&quot; aria-label=&quot;Close&quot;&gt;&lt;/button&gt;
                &lt;/div&gt;
                &lt;div class=&quot;modal-body&quot;&gt;
                    ...
                &lt;/div&gt;
                &lt;div class=&quot;modal-footer&quot;&gt;
                    &lt;button type=&quot;button&quot; class=&quot;btn btn-secondary&quot; data-bs-dismiss=&quot;modal&quot;&gt;Close&lt;/button&gt;
                    &lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot;&gt;Save changes&lt;/button&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;

    &lt;!-- Modal Modal Centered Scrollable--&gt;
    &lt;div class=&quot;modal fade&quot; id=&quot;exampleModalCenteredScrollable&quot; tabindex=&quot;-1&quot; aria-labelledby=&quot;exampleModalCenteredScrollableTitle&quot; style=&quot;display: none;&quot; aria-hidden=&quot;true&quot;&gt;
        &lt;div class=&quot;modal-dialog modal-dialog-centered modal-dialog-scrollable&quot;&gt;
            &lt;div class=&quot;modal-content&quot;&gt;
                &lt;div class=&quot;modal-header&quot;&gt;
                    &lt;h5 class=&quot;modal-title&quot; id=&quot;exampleModalCenteredScrollableTitle&quot;&gt;Modal title&lt;/h5&gt;
                    &lt;button type=&quot;button&quot; class=&quot;btn-close&quot; data-bs-dismiss=&quot;modal&quot; aria-label=&quot;Close&quot;&gt;&lt;/button&gt;
                &lt;/div&gt;
                &lt;div class=&quot;modal-body&quot;&gt;
                    ...
                &lt;/div&gt;
                &lt;div class=&quot;modal-footer&quot;&gt;
                    &lt;button type=&quot;button&quot; class=&quot;btn btn-secondary&quot; data-bs-dismiss=&quot;modal&quot;&gt;Close&lt;/button&gt;
                    &lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot;&gt;Save changes&lt;/button&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-top mt-5 pt-3">
                                <h2 id="optional-sizes">Optional sizes</h2>
                                <p>Modals have three optional sizes, available via modifier classes to be placed on a <code>.modal-dialog</code>. These sizes kick in at certain breakpoints to avoid horizontal scrollbars on narrower viewports.</p>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Size</th>
                                            <th>Class</th>
                                            <th>Modal max-width</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Small</td>
                                            <td><code>.modal-sm</code></td>
                                            <td><code>300px</code></td>
                                        </tr>
                                        <tr>
                                            <td>Default</td>
                                            <td class="text-muted">None</td>
                                            <td><code>500px</code></td>
                                        </tr>
                                        <tr>
                                            <td>Large</td>
                                            <td><code>.modal-lg</code></td>
                                            <td><code>800px</code></td>
                                        </tr>
                                        <tr>
                                            <td>Extra large</td>
                                            <td><code>.modal-xl</code></td>
                                            <td><code>1140px</code></td>
                                        </tr>
                                        <tr>
                                            <td>Fullscreen</td>
                                            <td><code>.modal-fullscreen</code></td>
                                            <td><code>Always</code></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <ul class="nav nav-tabs tab-card px-3 border-bottom-0" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav-Preview4" role="tab">Preview</a></li>
                                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-HTML4" role="tab">HTML</a></li>
                                </ul>
                                <div class="card mb-3 bg-transparent">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="nav-Preview4" role="tabpanel">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModalFullscreen">Full screen</button>
                                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModalXl">Extra large modal</button>
                                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModalLg">Large modal</button>
                                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModalSm">Small modal</button>

                                                <!-- Modal Fullscreen -->
                                                <div class="modal fade" id="exampleModalFullscreen" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog modal-fullscreen">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title h4" id="exampleModalFullscreenLabel">Full screen modal</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                                                                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                                                                <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                                                                <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                                                                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                                                                <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                                                                <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                                                                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                                                                <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                                                                <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                                                                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                                                                <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                                                                <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                                                                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                                                                <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                                                                <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                                                                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                                                                <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal XL -->
                                                <div class="modal fade" id="exampleModalXl" tabindex="-1" aria-labelledby="exampleModalXlLabel" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title h4" id="exampleModalXlLabel">Extra large modal</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                            ...
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal LG -->
                                                <div class="modal fade" id="exampleModalLg" tabindex="-1" aria-labelledby="exampleModalLgLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title h4" id="exampleModalLgLabel">Large modal</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                ...
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal SM -->
                                                <div class="modal fade" id="exampleModalSm" tabindex="-1" aria-labelledby="exampleModalSmLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog modal-sm">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title h4" id="exampleModalSmLabel">Small modal</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                ...
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="tab-pane fade" id="nav-HTML4" role="tabpanel">
    <pre class="language-html" data-lang="html">
    <code>&lt;!-- Button trigger modal --&gt;
    &lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot; data-bs-toggle=&quot;modal&quot; data-bs-target=&quot;#exampleModalFullscreen&quot;&gt;Full screen&lt;/button&gt;
    &lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot; data-bs-toggle=&quot;modal&quot; data-bs-target=&quot;#exampleModalXl&quot;&gt;Extra large modal&lt;/button&gt;
    &lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot; data-bs-toggle=&quot;modal&quot; data-bs-target=&quot;#exampleModalLg&quot;&gt;Large modal&lt;/button&gt;
    &lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot; data-bs-toggle=&quot;modal&quot; data-bs-target=&quot;#exampleModalSm&quot;&gt;Small modal&lt;/button&gt;

    &lt;!-- Modal Fullscreen --&gt;
    &lt;div class=&quot;modal fade&quot; id=&quot;exampleModalFullscreen&quot; tabindex=&quot;-1&quot; aria-labelledby=&quot;exampleModalFullscreenLabel&quot; aria-hidden=&quot;true&quot; style=&quot;display: none;&quot;&gt;
        &lt;div class=&quot;modal-dialog modal-fullscreen&quot;&gt;
            &lt;div class=&quot;modal-content&quot;&gt;
                &lt;div class=&quot;modal-header&quot;&gt;
                    &lt;h5 class=&quot;modal-title h4&quot; id=&quot;exampleModalFullscreenLabel&quot;&gt;Full screen modal&lt;/h5&gt;
                    &lt;button type=&quot;button&quot; class=&quot;btn-close&quot; data-bs-dismiss=&quot;modal&quot; aria-label=&quot;Close&quot;&gt;&lt;/button&gt;
                &lt;/div&gt;
                &lt;div class=&quot;modal-body&quot;&gt;
                    ...
                &lt;/div&gt;
                &lt;div class=&quot;modal-footer&quot;&gt;
                    &lt;button type=&quot;button&quot; class=&quot;btn btn-secondary&quot; data-bs-dismiss=&quot;modal&quot;&gt;Close&lt;/button&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;

    &lt;!-- Modal XL --&gt;
    &lt;div class=&quot;modal fade&quot; id=&quot;exampleModalXl&quot; tabindex=&quot;-1&quot; aria-labelledby=&quot;exampleModalXlLabel&quot; style=&quot;display: none;&quot; aria-hidden=&quot;true&quot;&gt;
        &lt;div class=&quot;modal-dialog modal-xl&quot;&gt;
            &lt;div class=&quot;modal-content&quot;&gt;
                &lt;div class=&quot;modal-header&quot;&gt;
                &lt;h5 class=&quot;modal-title h4&quot; id=&quot;exampleModalXlLabel&quot;&gt;Extra large modal&lt;/h5&gt;
                &lt;button type=&quot;button&quot; class=&quot;btn-close&quot; data-bs-dismiss=&quot;modal&quot; aria-label=&quot;Close&quot;&gt;&lt;/button&gt;
                &lt;/div&gt;
                &lt;div class=&quot;modal-body&quot;&gt;
                ...
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;

    &lt;!-- Modal LG --&gt;
    &lt;div class=&quot;modal fade&quot; id=&quot;exampleModalLg&quot; tabindex=&quot;-1&quot; aria-labelledby=&quot;exampleModalLgLabel&quot; aria-hidden=&quot;true&quot; style=&quot;display: none;&quot;&gt;
        &lt;div class=&quot;modal-dialog modal-lg&quot;&gt;
            &lt;div class=&quot;modal-content&quot;&gt;
                &lt;div class=&quot;modal-header&quot;&gt;
                    &lt;h5 class=&quot;modal-title h4&quot; id=&quot;exampleModalLgLabel&quot;&gt;Large modal&lt;/h5&gt;
                    &lt;button type=&quot;button&quot; class=&quot;btn-close&quot; data-bs-dismiss=&quot;modal&quot; aria-label=&quot;Close&quot;&gt;&lt;/button&gt;
                &lt;/div&gt;
                &lt;div class=&quot;modal-body&quot;&gt;
                    ...
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;

    &lt;!-- Modal SM --&gt;
    &lt;div class=&quot;modal fade&quot; id=&quot;exampleModalSm&quot; tabindex=&quot;-1&quot; aria-labelledby=&quot;exampleModalSmLabel&quot; aria-hidden=&quot;true&quot; style=&quot;display: none;&quot;&gt;
        &lt;div class=&quot;modal-dialog modal-sm&quot;&gt;
            &lt;div class=&quot;modal-content&quot;&gt;
                &lt;div class=&quot;modal-header&quot;&gt;
                    &lt;h5 class=&quot;modal-title h4&quot; id=&quot;exampleModalSmLabel&quot;&gt;Small modal&lt;/h5&gt;
                    &lt;button type=&quot;button&quot; class=&quot;btn-close&quot; data-bs-dismiss=&quot;modal&quot; aria-label=&quot;Close&quot;&gt;&lt;/button&gt;
                &lt;/div&gt;
                &lt;div class=&quot;modal-body&quot;&gt;
                    ...
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
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
