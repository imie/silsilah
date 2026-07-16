<div class="card card bg-light">
    <div class="card-header"><h3 class="card-title">{{ __('user.family') }}</h3></div>

    <table class="table">
        <tbody>
            <tr>
                <th class="col-sm-4">{{ __('user.father') }}</th>
                <td class="col-sm-8">
                    @can ('edit', $user)
                        @if (request('action') == 'set_father')
                        <form method="POST" action="{{ route('family-actions.set-father', $user->id) }}">
                        @csrf
                        <div class="form-group">
                            <select name="set_father_id" class="form-control">
                                <option value="">{{ __('app.select_from_existing_males') }}</option>
                                @foreach($malePersonList as $id => $name)
                                    <option value="{{ $id }}" {{ $user->father_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group">
                            <input type="text" name="set_father" class="form-control input-sm" placeholder="{{ __('app.enter_new_name') }}">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-info btn-sm" id="set_father_button">{{ __('app.update') }}</button>
                                {{ link_to_route('users.show', __('app.cancel'), [$user->id], ['class' => 'btn btn-secondary btn-sm']) }}
                            </span>
                        </div>
                        </form>
                        @else
                            {{ $user->fatherLink() }}
                            <div class="float-end">
                                {{ link_to_route('users.show', __('user.set_father'), [$user->id, 'action' => 'set_father'], ['class' => 'btn btn-link btn-xs']) }}
                            </div>
                        @endif
                    @else
                        {{ $user->fatherLink() }}
                    @endcan
                </td>
            </tr>
            <tr>
                <th>{{ __('user.mother') }}</th>
                <td>
                    @can ('edit', $user)
                        @if (request('action') == 'set_mother')
                        <form method="POST" action="{{ route('family-actions.set-mother', $user->id) }}">
                        @csrf
                        <div class="form-group">
                            <select name="set_mother_id" class="form-control">
                                <option value="">{{ __('app.select_from_existing_females') }}</option>
                                @foreach($femalePersonList as $id => $name)
                                    <option value="{{ $id }}" {{ $user->mother_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group">
                            <input type="text" name="set_mother" class="form-control input-sm" placeholder="{{ __('app.enter_new_name') }}">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-info btn-sm" id="set_mother_button">{{ __('app.update') }}</button>
                                {{ link_to_route('users.show', __('app.cancel'), [$user->id], ['class' => 'btn btn-secondary btn-sm']) }}
                            </span>
                        </div>
                        </form>
                        @else
                            {{ $user->motherLink() }}
                            <div class="float-end">
                                {{ link_to_route('users.show', __('user.set_mother'), [$user->id, 'action' => 'set_mother'], ['class' => 'btn btn-link btn-xs']) }}
                            </div>
                        @endif
                    @else
                        {{ $user->motherLink() }}
                    @endcan
                </td>
            </tr>
            <tr>
                <th class="col-sm-4">{{ __('user.parent') }}</th>
                <td class="col-sm-8">
                    @can ('edit', $user)
                    <div class="float-end">
                        @unless (request('action') == 'set_parent')
                            {{ link_to_route('users.show', __('user.set_parent'), [$user->id, 'action' => 'set_parent'], ['class' => 'btn btn-link btn-xs']) }}
                        @endunless
                    </div>
                    @endcan

                    @if ($user->parent)
                    {{ $user->parent->husband->name }} & {{ $user->parent->wife->name }}
                    @endif

                    @can('edit', $user)
                        @if (request('action') == 'set_parent')
                            <form method="POST" action="{{ route('family-actions.set-parent', $user->id) }}">
                            @csrf
                            <div class="form-group">
                                <select name="set_parent_id" class="form-control">
                                    <option value="">{{ __('app.select_from_existing_couples') }}</option>
                                    @foreach($allMariageList as $id => $name)
                                        <option value="{{ $id }}" {{ $user->parent_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-info btn-sm" id="set_parent_button">{{ __('app.update') }}</button>
                            {{ link_to_route('users.show', __('app.cancel'), $user, ['class' => 'btn btn-secondary btn-sm']) }}
                            </form>
                        @endif
                    @endcan
                </td>
            </tr>
            @if ($user->gender_id == 1)
            <tr>
                <th>{{ __('user.wife') }}</th>
                <td>
                    @can ('edit', $user)
                    <div class="float-end">
                        @unless (request('action') == 'add_spouse')
                            {{ link_to_route('users.show', __('user.add_wife'), [$user->id, 'action' => 'add_spouse'], ['class' => 'btn btn-link btn-xs']) }}
                        @endunless
                    </div>
                    @endcan

                    @if ($user->wifes->isEmpty() == false)
                        <ul class="list-unstyled">
                            @foreach($user->wifes as $wife)
                            <li>{{ $wife->profileLink() }}</li>
                            @endforeach
                        </ul>
                    @endif
                    @can('edit', $user)
                        @if (request('action') == 'add_spouse')
                        <div>
                            <form method="POST" action="{{ route('family-actions.add-wife', $user->id) }}">
                            @csrf
                            <div class="form-group">
                                <select name="set_wife_id" class="form-control">
                                    <option value="">{{ __('app.select_from_existing_females') }}</option>
                                    @foreach($femalePersonList as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-7">
                                        <input type="text" name="set_wife" class="form-control input-sm" placeholder="{{ __('app.enter_new_name') }}">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="date" name="marriage_date" class="form-control input-sm" placeholder="{{ __('couple.marriage_date') }}">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-sm" id="set_wife_button">{{ __('app.update') }}</button>
                            {{ link_to_route('users.show', __('app.cancel'), $user, ['class' => 'btn btn-secondary btn-sm']) }}
                            </form>
                        </div>
                        @endif
                    @endcan
                </td>
            </tr>
            @else
            <tr>
                <th>{{ __('user.husband') }}</th>
                <td>
                    @can ('edit', $user)
                    <div class="float-end">
                        @unless (request('action') == 'add_spouse')
                            {{ link_to_route('users.show', __('user.add_husband'), [$user->id, 'action' => 'add_spouse'], ['class' => 'btn btn-link btn-xs']) }}
                        @endunless
                    </div>
                    @endcan
                    @if ($user->husbands->isEmpty() == false)
                        <ul class="list-unstyled">
                            @foreach($user->husbands as $husband)
                            <li>{{ $husband->profileLink() }}</li>
                            @endforeach
                        </ul>
                    @endif
                    @can('edit', $user)
                        @if (request('action') == 'add_spouse')
                        <div>
                            <form method="POST" action="{{ route('family-actions.add-husband', $user->id) }}">
                            @csrf
                            <div class="form-group">
                                <select name="set_husband_id" class="form-control">
                                    <option value="">{{ __('app.select_from_existing_males') }}</option>
                                    @foreach($malePersonList as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-7">
                                        <input type="text" name="set_husband" class="form-control input-sm" placeholder="{{ __('app.enter_new_name') }}">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="date" name="marriage_date" class="form-control input-sm" placeholder="{{ __('couple.marriage_date') }}">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-sm" id="set_husband_button">{{ __('app.update') }}</button>
                            {{ link_to_route('users.show', __('app.cancel'), [$user->id], ['class' => 'btn btn-secondary btn-sm']) }}
                            </form>
                        </div>
                        @endif
                    @endcan
                </td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
