<div class="form-group">
    {{ Form::label('title', 'Título de la profesión:*') }}
    {{ Form::text('title', null, ['class' => 'form-control']) }}
</div>
<div class="card-footer">
    <button class="btn btn-outline-primary" type="submit">
        Guardar
    </button>
    <blockquote class="blockquote-footer mt-3 mb-0">
        Los campos marcados con (*) son obligatorios.
    </blockquote>
</div>