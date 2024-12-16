<?php
// Move the `use` statement to the top of the file
use ScssPhp\ScssPhp\Compiler;

// Include the SCSS to CSS compilation logic (should ideally be done via Mix or a controller, not directly in Blade)
$isScssConverted = false;

if ($isScssConverted) {
    // SCSS Compilation Logic (move this to a service or controller ideally)
    require_once(base_path('scssphp/scss.inc.php'));

    $compiler = new Compiler();
    $compineCss = public_path("assets/css/app.min.css");
    $sourceScss = resource_path("scss/config/default/app.scss");

    $scssContents = file_get_contents($sourceScss);
    $importPath = resource_path("scss/config/default");
    $compiler->addImportPath($importPath);
    $targetCss = $compineCss;

    $css = $compiler->compile($scssContents);

    if (!empty($css) && is_string($css)) {
        file_put_contents($targetCss, $css);
    }
}
?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>

<title>@yield('title', 'Home') | ORMAF Performance and Risk Management Software</title>

<!-- Layout config Js -->
<script src="{{asset('assets/login/js/layout.js')}}"></script>
<!-- Bootstrap Css -->
<link href="{{asset('assets/login/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{asset('assets/login/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{asset('assets/login/css/app.min.css')}}" rel="stylesheet" type="text/css" />
<!-- custom Css-->
<link href="{{asset('assets/login/css/custom.min.css')}}" rel="stylesheet" type="text/css" />

</head>
<body>
@yield('content')
    <!-- end auth-page-wrapper -->

    @include ('layouts.login.vendor-scripts')
    @include ('layouts.login.footer')
    <!-- particles js -->
    <script src="{{asset('assets/login/libs/particles.js/particles.js')}}"></script>
    <!-- particles app js -->
    <script src="{{asset('assets/login/js/pages/particles.app.js')}}"></script>
    <!-- Additional Scripts -->
    @stack('scripts')

</body>

</html>
