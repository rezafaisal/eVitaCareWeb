@extends('templates.app')

@section('content')
    @if(Auth::guard('patient')->check())
        @include('home.partials.patient')
    @else
        @if(RoleHelper::hasRole('Doctor'))
            @include('home.partials.doctor')
        @endif

        @if(RoleHelper::hasRole('Nurse'))
            @include('home.partials.nurse')
        @endif
    @endif
@endsection