<?php
    $childrenBySpouse = $userNode->childs->groupBy(function($child) use ($userNode) {
        return $userNode->gender_id == 1 ? $child->mother_id : $child->father_id;
    });
?>
@if ($childrenBySpouse->count())
<div class="branch lv{{ $level }}">
    @foreach($childrenBySpouse as $spouseId => $children)
        <div class="entry {{ $childrenBySpouse->count() == 1 ? 'sole' : '' }}">
            
            {{-- Spouse Node --}}
            @if($spouseId)
                <?php $spouse = App\User::find($spouseId); ?>
                @if($spouse)
                    <div class="spouse-node">
                        @include('users.partials.tree-node', ['userNode' => $spouse, 'type' => 'spouse'])
                    </div>
                @endif
            @else
                <div class="spouse-node">
                    <div class="tree-card unknown-spouse">
                        <div class="tree-avatar">?</div>
                        <div class="tree-details">
                            <span class="tree-name">Unknown Spouse</span>
                        </div>
                    </div>
                </div>
            @endif
            
            {{-- Children of this specific Spouse --}}
            @if ($children->count())
            <div class="branch spouse-children">
                @foreach($children as $child)
                    <div class="entry {{ $children->count() == 1 ? 'sole' : '' }}">
                        @include('users.partials.tree-node', ['userNode' => $child])
                        
                        {{-- Recurse up to 7 levels natively --}}
                        @if($level < 7)
                            @include('users.partials.tree-branch', ['userNode' => $child, 'level' => $level + 1])
                        @endif
                    </div>
                @endforeach
            </div>
            @endif

        </div>
    @endforeach
</div>
@endif
