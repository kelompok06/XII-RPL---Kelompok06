{!!Form::model($post, [
	'route' => $post->exists ? ['post.update', $post->id] : 'post.store',
	'method' => $post->exists ? 'PUT' : 'POST'
])!!}
	<div class="form-group">
		<label for="" class="control-label">Kategori</label>
		<select name="kategori_id" class="select2 form-control" id="cari" style="width: 100%;">
		</select>
	</div>
	<div class="form-group">
		<label for="" class="control-label">Title</label>
		{!! Form::text('title', null, ['class' => 'form-control', 'id' => 'title']) !!}
	</div>
  <div class="form-group">
		<label for="" class="control-label">Content</label>
		{!! Form::text('content', null, ['class' => 'form-control', 'id' => 'content']) !!}
	</div>

	<script type="text/javascript">
		$('#cari').select2({
			placeholder: 'Cari Kategori...',
			ajax: {
				url: '/cari/kategori',
				dataType: 'json',
				delay: 250,
				processResults: function (data) {
					return {
						results: $.map(data, function (item) {
							return {
								text: item.kategori,
								id: item.id
							}
						})
					};
				},
				cache: true
			}
		});
	</script>

{!! Form::close() !!}
