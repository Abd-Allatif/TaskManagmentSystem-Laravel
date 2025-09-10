@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                        {{-- Performance Card --}}
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category">Admin Managment View</h5>
                            <h2 class="card-title">Data</h2>
                        </div>
                        <div class="col-sm-6">
                            <div class="btn-group btn-group-toggle float-right" data-toggle="buttons" id="toggle-group">
                                <label class="btn btn-sm btn-primary btn-simple active" id="0">
                                    <input type="radio" name="options" checked>
                                    <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Users</span>
                                    <span class="d-block d-sm-none">
                                        <i class="tim-icons icon-single-02"></i>
                                    </span>
                                </label>
                                <label class="btn btn-sm btn-primary btn-simple" id="1">
                                    <input type="radio" class="d-none d-sm-none" name="options">
                                    <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Tasks</span>
                                    <span class="d-block d-sm-none">
                                        <i class="tim-icons icon-gift-2"></i>
                                    </span>
                                </label>
                                <label class="btn btn-sm btn-primary btn-simple" id="2">
                                    <input type="radio" class="d-none" name="options">
                                    <span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Categories</span>
                                    <span class="d-block d-sm-none">
                                        <i class="tim-icons icon-tap-02"></i>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-body" id="card-content">
                    @include('partials.users', ['users' => $users])
                    @include('partials.tasks', ['tasks' => $tasks])
                    @include('partials.categories', ['categories' => $categories])
                </div>

                <div id="views-html" style="display:none;">
                    <div data-view="users">@include('partials.users', ['users' => $users])</div>
                    <div data-view="tasks">@include('partials.tasks', ['tasks' => $tasks])</div>
                    <div data-view="categories">@include('partials.categories', ['categories' => $categories])</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card card-tasks">
                <div class="card-header ">
                    <h6 class="title d-inline">Today's Dead Lines</h6>
                    <p class="card-category d-inline">today</p>
                </div>
                <div class="card-body ">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">

                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="title">Update the Documentation</p>
                                        <p class="text-muted">Dwuamish Head, Seattle, WA 8:47 AM</p>
                                    </td>
                                    <td class="td-actions text-right">

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">

                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="title">GDPR Compliance</p>
                                        <p class="text-muted">The GDPR is a regulation that requires businesses to protect
                                            the personal data and privacy of Europe citizens for transactions that occur
                                            within EU member states.</p>
                                    </td>
                                    <td class="td-actions text-right">

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">

                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="title">Solve the issues</p>
                                        <p class="text-muted">Fifty percent of all respondents said they would be more
                                            likely to shop at a company </p>
                                    </td>
                                    <td class="td-actions text-right">

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">

                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="title">Release v2.0.0</p>
                                        <p class="text-muted">Ra Ave SW, Seattle, WA 98116, SUA 11:19 AM</p>
                                    </td>
                                    <td class="td-actions text-right">

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">

                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="title">Export the processed files</p>
                                        <p class="text-muted">The report also shows that consumers will not easily forgive
                                            a company once a breach exposing their personal data occurs. </p>
                                    </td>
                                    <td class="td-actions text-right">

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">

                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="title">Arival at export process</p>
                                        <p class="text-muted">Capitol Hill, Seattle, WA 12:34 AM</p>
                                    </td>
                                    <td class="td-actions text-right">

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <script>
        (function() {
            function initToggle() {
                const container = document.querySelector('#toggle-group');
                const content = document.getElementById('card-content');
                const viewsContainer = document.getElementById('views-html');

                if (!container || !content || !viewsContainer) return;

                const labels = Array.from(container.querySelectorAll('label'));
                const views = Array.from(viewsContainer.children).map(div => div.innerHTML);

                labels.forEach((label, idx) => {
                    label.addEventListener('click', function(e) {
                        e.preventDefault();
                        labels.forEach(l => l.classList.remove('active'));
                        this.classList.add('active');

                        const input = this.querySelector('input[type="radio"]');
                        if (input) input.checked = true;

                        content.innerHTML = views[idx] || '<p>No data available.</p>';
                    });
                });

                // initialize
                const activeIndex = labels.findIndex(l => l.classList.contains('active'));
                content.innerHTML = views[activeIndex >= 0 ? activeIndex : 0];
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initToggle);
            } else {
                initToggle();
            }
        })();
    </script>
@endsection
