@extends('layouts._showCourse')

@section('menu')
    @if(Auth::check() && Auth::user()->role === 'admin' )
        @include('admin._menu')
    @endif
@stop

@section('breadcrumb')
    <a href="{{ URL::route('courses.index') }}" class="breadcrumb">
        {{ Lang::get('course.breadcrumb_name') }}
    </a>
    <a href="{{ URL::route('courses.show', $course->id) }}" class="breadcrumb">
        {{ $course->name }}
    </a>
    <a href="" class="breadcrumb">{{ $module->name }}</a>
@stop

@section('title')
    <h4>{{ $module->name }}</h4>
@stop

@section('description')
    {{$module->description}}
@stop

@section('start_date')
    {{$module->start_date}}
@stop

@section('end_date')
    {{$module->end_date}}
@stop

@section('resource_title')
    {{ Lang::get('module.show_activities_title') }}
@stop

@section('resource_route')
    {{ URL::route('activities.create', [$course->id, $module->id]) }}
@stop

@section('list')
    @foreach($module->activities as $activity)
        <li>
            <a href="{{ URL::route('activities.show', [$course->id, $module->id, $activity->id]) }}">
                {{ $activity->title }}
            </a>
        </li>
    @endforeach
@stop

@section('action')

    @if(Auth::check() && Auth::user()->role === 'teacher' )
    <a href="{{ URL::route('modules.edit', [$course->id, $module->id]) }}">
        {{ Lang::get('module.edit_call_to_action') }}
    </a>
    @endif

@stop