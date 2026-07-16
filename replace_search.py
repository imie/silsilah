import re

file_path = 'resources/views/users/search.blade.php'
with open(file_path, 'r') as f:
    content = f.read()

old_card = """        <div class="card card bg-light">
            <div class="card-header text-center">
                {{ userPhoto($user, ['style' => 'width:100%;max-width:300px']) }}
                @if ($user->age)
                    {!! $user->age_string !!}
                @endif
            </div>
            <div class="card-body">
                <h3 class="card-title">{{ $user->profileLink() }} ({{ $user->gender }})</h3>
                <div>{{ trans('user.nickname') }} : {{ $user->nickname }}</div>
                <hr style="margin: 5px 0;">
                <div>{{ trans('user.father') }} : {{ $user->father_id ? $user->father->name : '' }}</div>
                <div>{{ trans('user.mother') }} : {{ $user->mother_id ? $user->mother->name : '' }}</div>
            </div>
            <div class="card-footer">
                {{ link_to_route('users.show', trans('app.show_profile'), [$user->id], ['class' => 'btn btn-secondary btn-xs']) }}
                {{ link_to_route('users.chart', trans('app.show_family_chart'), [$user->id], ['class' => 'btn btn-secondary btn-xs']) }}
            </div>
        </div>"""

new_card = """        <div class="card shadow-sm border-0 mb-4 h-100" style="border-radius: 1rem; transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
            <div class="card-header bg-white border-0 text-center pt-4 pb-0">
                {{ userPhoto($user, ['style' => 'width:120px;height:120px;border-radius:50%;object-fit:cover;box-shadow: 0 4px 8px rgba(0,0,0,0.1);']) }}
                @if ($user->age)
                    <div class="mt-2 text-muted small">{!! $user->age_string !!}</div>
                @endif
            </div>
            <div class="card-body text-center">
                <h4 class="card-title mb-1 fw-bold">{{ $user->profileLink() }} <span class="text-muted fs-6">
                    @if($user->gender_id == 1)
                        <i class="fa-solid fa-mars text-primary"></i>
                    @else
                        <i class="fa-solid fa-venus" style="color:#d63384"></i>
                    @endif
                </span></h4>
                <div class="text-muted small mb-3">{{ $user->nickname }}</div>
                
                <div class="d-flex justify-content-between text-start small bg-light p-2 rounded">
                    <div>
                        <span class="text-muted d-block" style="font-size:0.75rem">{{ trans('user.father') }}</span>
                        <strong>{{ $user->father_id ? $user->father->nickname ?: $user->father->name : '-' }}</strong>
                    </div>
                    <div class="text-end">
                        <span class="text-muted d-block" style="font-size:0.75rem">{{ trans('user.mother') }}</span>
                        <strong>{{ $user->mother_id ? $user->mother->nickname ?: $user->mother->name : '-' }}</strong>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white border-0 text-center pb-4 pt-0">
                <div class="d-grid gap-2">
                    {{ link_to_route('users.show', trans('app.show_profile'), [$user->id], ['class' => 'btn btn-outline-primary btn-sm rounded-pill']) }}
                    {{ link_to_route('users.chart', trans('app.show_family_chart'), [$user->id], ['class' => 'btn btn-outline-secondary btn-sm rounded-pill']) }}
                </div>
            </div>
        </div>"""

if old_card in content:
    content = content.replace(old_card, new_card)
    with open(file_path, 'w') as f:
        f.write(content)
    print("Replaced successfully")
else:
    print("Could not find old_card snippet")
