<div class="panel panel-default">
    <div class="panel-heading"><h3 class="panel-title">{{ __('user.update_photo') }}</h3></div>
    <form method="POST" action="{{ route('users.photo-upload', $user) }}" enctype="multipart/form-data">
        @csrf
        @method('patch')
    <div class="panel-body text-center">
        {{ userPhoto($user, ['style' => 'width:100%;max-width:300px']) }}
    </div>
    <div class="panel-body">
        <div class="form-group">
            <label for="photo" class="control-label">{{ __('user.reupload_photo') }} *</label>
            <input type="file" name="photo" id="photo" class="form-control" required>
            <div class="help-block text-warning">{{ __('user.upload_photo_notes') }}</div>
        </div>
    </div>
    <div class="panel-footer">
        <button type="submit" class="btn btn-success">{{ __('user.update_photo') }}</button>
        {{ link_to_route('users.show', __('app.cancel'), [$user], ['class' => 'btn btn-default']) }}
    </div>
    </form>
</div>
