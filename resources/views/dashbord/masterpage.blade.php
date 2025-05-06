@include("dashbord.include.top")

<div class="container-scroller">
    @include("dashbord.include.sidbar")

    <div class="container-fluid page-body-wrapper" style="display: flex; flex-direction: column; min-height: 100vh;">

        @include("dashbord.include.nav")

        <!-- Main panel -->
        <div class="main-panel" style="flex-grow: 1;">
            @yield("content")
        </div>

        @include("dashbord.include.footer")
    </div>
</div>

@include("dashbord.include.bottom")
