<!-- Nombre -->
<div class="input-field">
	{!! Form::label('name', Lang::get('course.create_name_label')) !!}
	{!! Form::text('name', old('name'), ['class' => 'validate']) !!}

	@if ($errors->has('name'))
		<p class="red-text text-darken-2">
			<i class="fa fa-exclamation-circle"></i>
			{{ $errors->first('name') }}
		</p>
	@endif
</div>
<!-- /Nombre -->

<!-- Descripción -->
<div class="input-field">
	{!! Form::label('description', Lang::get('course.create_description_label')) !!}
	{!! Form::text('description', old('description'), ['class' => 'validate']) !!}
</div>
<!-- /Descripción -->

<!-- Fecha de inicio -->
{!! Form::label('start_date', Lang::get('course.create_start_date_label')) !!}
<div class="input-field">
	{!! Form::text('start_date', old('start_date'), ['placeholder' => Config::get('course.default_date')] ) !!}
</div>
<!-- /Fecha de inicio -->

<!-- Fecha de finalización -->
{!! Form::label('end_date', Lang::get('course.create_end_date_label')) !!}
<div class="input-field">
	{!! Form::text('end_date', old('end_date'), ['placeholder' => Config::get('course.default_date')] ) !!}
</div>
<!-- /Fecha de finalización -->