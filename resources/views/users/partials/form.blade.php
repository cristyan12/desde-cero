<div class="form-group">
    {{ Form::label('name', 'Nombre:*') }}
    {{ Form::text('name', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('email', 'Correo electrónico:*') }}
    {{ Form::email('email', null, ['class' => 'form-control']) }}    
</div>
<div class="form-group">
    {{ Form::label('profession_id', 'Profesión:*') }}
    {{ Form::select('profession_id', $professions, null, [
        'class' => 'custom-select',
        'placeholder' => 'Seleccione una profesión...'
    ]) }}
</div>
<div class="form-group">
    {{ Form::label('password', 'Contraseña:*') }}
    {{ Form::password('password', ['class' => 'form-control']) }}
</div>
<div class="card-footer">
    <button class="btn btn-outline-primary" type="submit">
        Guardar
    </button>
    <blockquote class="blockquote-footer mt-3 mb-0">
        Los campos marcados con (*) son obligatorios.
    </blockquote>
</div>