<form id="delete" action="{{ route('admin.posts.destroy', $model) }}" method="POST">
    @csrf
    @method("DELETE")
    <a href="{{route('admin.posts.edit', $model) }}" class="btn btn-info">Edit</a>
    <input type="submit" id="delete-button" class="btn btn-danger" value="Hapus">
</form>
<br>
