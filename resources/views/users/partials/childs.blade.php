<div class="card card bg-light mb-3">
    <div class="card-header">
        @can ('edit', $user)
        <div class="float-end" style="margin: -3px -6px">
            {{ link_to_route('users.show', __('user.add_child'), [$user->id, 'action' => 'add_child'], ['class' => 'btn btn-success btn-xs']) }}
        </div>
        @endcan
        <h3 class="card-title">{{ __('user.childs') }} ({{ $user->childs->count() }})</h3>
    </div>

    <ul class="list-group">
        @forelse($user->childs as $child)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    {{ $child->profileLink() }} ({{ $child->gender }})
                </div>
                @can('edit', $user)
                <div class="btn-group btn-group-sm">
                    <form method="POST" action="{{ route('family-actions.rearrange-child', [$user->id, $child->id]) }}" style="display:inline;">
                        @csrf
                        <input type="hidden" name="direction" value="up">
                        <button type="submit" class="btn btn-outline-secondary btn-sm" {{ $loop->first ? 'disabled' : '' }} title="Move Up">&#x25B2;</button>
                    </form>
                    <form method="POST" action="{{ route('family-actions.rearrange-child', [$user->id, $child->id]) }}" style="display:inline;">
                        @csrf
                        <input type="hidden" name="direction" value="down">
                        <button type="submit" class="btn btn-outline-secondary btn-sm" {{ $loop->last ? 'disabled' : '' }} title="Move Down">&#x25BC;</button>
                    </form>
                </div>
                @endcan
            </li>
        @empty
            <li class="list-group-item">{{ __('app.childs_were_not_recorded') }}</li>
        @endforelse
        @can('edit', $user)
        @if (request('action') == 'add_child')
        <li class="list-group-item">
            <form method="POST" action="{{ route('family-actions.add-child', $user->id) }}">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="add_child_name" class="control-label">{{ __('user.child_name') }}</label>
                        <input type="text" name="add_child_name" id="add_child_name" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">{{ __('user.child_gender') }}</label>
                        <div>
                            <label class="radio-inline"><input type="radio" name="add_child_gender_id" value="1"> {{ __('app.male') }}</label>
                            <label class="radio-inline"><input type="radio" name="add_child_gender_id" value="2"> {{ __('app.female') }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="add_child_parent_id" class="control-label">{{ __('user.add_child_from_existing_couples', ['name' => $user->name]) }}</label>
                        <select name="add_child_parent_id" id="add_child_parent_id" class="form-control">
                            <option value="">{{ __('app.unknown') }}</option>
                            @foreach($usersMariageList as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="add_child_birth_order" class="control-label">{{ __('user.birth_order') }}</label>
                        <input type="number" name="add_child_birth_order" id="add_child_birth_order" class="form-control" min="1">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success btn-sm">{{ __('user.add_child') }}</button>
            {{ link_to_route('users.show', __('app.cancel'), [$user->id], ['class' => 'btn btn-secondary btn-sm']) }}
            </form>
        </li>
        @endif
        @endcan
    </ul>
</div>
