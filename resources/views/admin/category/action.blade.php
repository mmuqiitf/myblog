<form id="delete" action="{{ route('admin.category.destroy', $model) }}" method="POST">
    @csrf
    @method("DELETE")
    <a href="{{route('admin.category.edit', $model) }}" class="btn btn-info">Edit</a>
    <input type="submit" id="delete-button" class="btn btn-danger" value="Hapus">
</form>