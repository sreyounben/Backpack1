@extends(backpack_view('blank'))

@php
$defaultBreadcrumbs = [
    trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
    $crud->entity_name_plural => url($crud->route),
    trans('backpack::crud.preview') => false,
];

// if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
$breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp

@section('header')
    <section class="container-fluid d-print-none">
        <a href="javascript: window.print();" class="btn float-right"><i class="la la-print"></i></a>
        <h2>
            <span class="text-capitalize">{!! $crud->getHeading() ?? $crud->entity_name_plural !!}</span>
            <small>{!! $crud->getSubheading() ?? mb_ucfirst(trans('backpack::crud.preview')) . ' ' . $crud->entity_name !!}.</small>
            @if ($crud->hasAccess('list'))
                <small class=""><a href="{{ url($crud->route) }}" class="font-sm"><i
                            class="la la-angle-double-left"></i> {{ trans('backpack::crud.back_to_all') }}
                        <span>{{ $crud->entity_name_plural }}</span></a></small>
            @endif
        </h2>
    </section>
@endsection

@section('content')
    <table aria-hidden="true" class="table table-striped">
        <tbody>
            <tr class="bg-white">
                <td colspan="12" class="p-0"><label class="navbar-brand custom-navbar-brand mb-0">
                        Real Time​Data</label>
                </td>
            </tr>
            <tr>
                <td class="border-0 font-weight-bold">Product Code</td>
                <td class="border-0 ">:</td>
                <td class="border-0">{{ $entry->code }}</td>
                <td class="border-0 font-weight-bold">Product Name</td>
                <td class="border-0 ">:</td>
                <td class="border-0">{{ $entry->name }}</td>
            </tr>
            <tr>
                <td class="border-0 font-weight-bold">Price</td>
                <td class="border-0 ">:</td>
                <td class="border-0">{{ $entry->price }}</td>

                <td class="border-0 font-weight-bold">Image</td>
                <td class="border-0 ">:</td>
                <td class="border-0">
                    <a href="{{ asset('storage/' . $entry->image) }}"
                        data-lightbox="lightbox">
                        <img src=" {{ asset('storage/' . $entry->image) }} " alt="Hell" width="35"/>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
@endsection

@section('after_styles')
    <link rel="stylesheet"
        href="{{ asset('packages/backpack/crud/css/crud.css') . '?v=' . config('backpack.base.cachebusting_string') }}">
    <link rel="stylesheet"
        href="{{ asset('packages/backpack/crud/css/show.css') . '?v=' . config('backpack.base.cachebusting_string') }}">
@endsection

@section('after_scripts')
    <script src="{{ asset('packages/backpack/crud/js/crud.js') . '?v=' . config('backpack.base.cachebusting_string') }}">
    </script>
    <script src="{{ asset('packages/backpack/crud/js/show.js') . '?v=' . config('backpack.base.cachebusting_string') }}">
    </script>
@endsection
