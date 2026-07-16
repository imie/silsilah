<?php 
$type = $type ?? 'tree'; 
$spouseIndex = $spouseIndex ?? 0;
$isDivorced = $isDivorced ?? false;
$spouseClass = $type == 'spouse' ? 'spouse-color-' . ($spouseIndex % 5) : '';
?>
<a href="{{ route('users.tree', $userNode->id) }}" class="tree-card {{ $type == 'chart' ? 'chart-mode' : '' }} gender-{{ $userNode->gender_id == 1 ? 'male' : 'female' }} {{ $spouseClass }}" title="{{ $userNode->name }} ({{ $userNode->gender }})">
    <div class="tree-avatar">
        @if($userNode->photo_path && file_exists(storage_path('app/public/' . $userNode->photo_path)))
            <img src="{{ asset('storage/' . $userNode->photo_path) }}" alt="{{ $userNode->name }}" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
        @else
            {{ strtoupper(substr($userNode->name, 0, 1)) }}
        @endif
    </div>
    <div class="tree-details">
        <span class="tree-name">{{ $userNode->nickname ?: $userNode->name }}</span>
        <span class="tree-subtitle">
            @if($type == 'spouse')
                <span style="background-color: {{ $userNode->gender_id == 1 ? '#3b82f6' : '#ec4899' }}; color: white; padding: 2px 6px; border-radius: 4px; font-size: 10px;">
                    @if($userNode->gender_id == 1)
                        {{ $isDivorced ? trans('user.ex_husband') : trans('user.husband') }}
                    @else
                        {{ $isDivorced ? trans('user.ex_wife') : trans('user.wife') }}
                    @endif
                </span>
            @else
                @if($userNode->gender_id == 1)
                    <i class="fa-solid fa-mars"></i> {{ trans('app.male_code') }}
                @else
                    <i class="fa-solid fa-venus"></i> {{ trans('app.female_code') }}
                @endif
            @endif
        </span>
    </div>
</a>
