@extends('layouts.master')


@section('breadcrumb')

    <a href="{{ URL::route('welcome') }}" class="breadcrumb">
        Cursos
    </a>

    <a href="{{ URL::route('courses.show', $course->id) }}" class="breadcrumb">
        {{ $course->name }}
    </a>

@stop


@section('content')
    <div class="container">

        <section class="course">

            <h1>{{$course->name}}</h1>

            @if(Auth::guest())
                <p><strong>Nota:</strong> Para poder inscribirte en el curso debes registrarte.</p>
                <a href="{{URL::route('signup')}}" class="waves-effect waves-light btn">REGÍSTRATE</a>
            @else
                <a href="" class="waves-effect waves-light btn">INSCRÍBITE</a>
            @endif

            <h3>Descripción</h3>
            <p>{{$course->description}}</p>

            <h5>Fecha de inicio</h5>
            <p>{{$course->start_date}}</p>

            <h5>Fecha de finalización</h5>
            <p>{{$course->end_date}}</p>

        </section>

        <section class="modules">
            <h3>Programa del curso</h3>
            <ul>
                @foreach($course->modules as $module)
                    <li>
                        {{ $module->name }}
                    </li>
                @endforeach
            </ul>
        </section>

        <section class="teachers">
            <h3>Profesores</h3>
            <ul>
                @foreach($course->teachers as $teacher)
                    <li>{{$teacher->name}}</li>
                @endforeach
            </ul>
        </section>

        @if(Auth::guest())
            <p><strong>Nota:</strong> Para poder inscribirte en el curso debes registrarte.</p>
            <a href="{{URL::route('signup')}}"  class="waves-effect waves-light btn">REGÍSTRATE</a>
        @else
            <a href="" class="waves-effect waves-light btn">INSCRÍBITE</a>
        @endif
    </div>
@stop