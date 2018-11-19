{!!Form::model($kategori, [
	'route' => $kategori->exists ? ['kategori.update', $kategori->id] : 'kategori.store',
	'method' => $kategori->exists ? 'PUT' : 'POST'
])!!}

	<div class="form-group">
		<label for="" class="control-label">Kategori</label>
		{!! Form::text('kategori', null, ['class' => 'form-control', 'id' => 'kategori']) !!}
	</div>

{!! Form::close() !!}
