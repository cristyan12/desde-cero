<div class="form-row">
    <div class="form-group col-md-6">
        {{ Form::label('name', 'Nombre:*') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('last_name', 'Apellido:*') }}
        {{ Form::text('last_name', null, ['class' => 'form-control']) }}
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        {{ Form::label('document_identity', 'Documento de identidad:*') }}
        {{ Form::text('document_identity', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('country_id', 'País:*') }}
        {{ Form::select('country_id', $countries, null, [
            'class' => 'custom-select',
            'placeholder' => '...'
        ]) }}
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        {{ Form::label('born_date', 'Fecha de nacimiento:*') }}
        {{ Form::date('born_date', \Carbon\Carbon::now()) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('hire_date', 'Fecha de contratación:*') }}
        {{ Form::date('hire_date', \Carbon\Carbon::now()), ['class' => 'form-control'] }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('email', 'Correo electrónico:*') }}
    {{ Form::email('email', null, ['class' => 'form-control']) }}
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        {{ Form::label('cell_phone', 'Número de celular:*') }}
        {{ Form::text('cell_phone', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('home_phone', 'Número de casa:') }}
        {{ Form::text('home_phone', null, ['class' => 'form-control']) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('address', 'Dirección:*') }}
    {{ Form::textarea('address', null, ['class' => 'form-control', 'rows' => '5']) }}
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        {{ Form::label('profession_id', 'Cargo:*') }}
        {{ Form::select('profession_id', $professions, null, [
            'class' => 'custom-select',
            'placeholder' => 'Seleccione un cargo a ocupar...'
        ]) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('journal_type', 'Tipo de jornada:*') }}
        {{ Form::select('journal_type', $journalsType, null, [
            'class' => 'custom-select',
            'placeholder' => 'Seleccione una jornada...'
        ]) }}
    </div>
</div>
<div class="card-footer">
    <button class="btn btn-outline-primary" type="submit">
        Guardar
    </button>
    <blockquote class="blockquote-footer mt-3 mb-0">
        Los campos marcados con (*) son obligatorios.
    </blockquote>
</div>