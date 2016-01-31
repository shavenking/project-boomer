@if (preg_match('/projects\.(internal|bid|works).*/', request()->route()->getName()))
    @include('components.internal-sidebar')
@endif

@if (preg_match('/projects\.(external|checklists).*/', request()->route()->getName()))
    @include('components.external-sidebar')
@endif
