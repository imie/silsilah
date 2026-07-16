<?php
$parents = [];
if ($userNode->father_id && $userNode->father) {
    $parents[] = $userNode->father;
}
if ($userNode->mother_id && $userNode->mother) {
    $parents[] = $userNode->mother;
}
?>

@if (count($parents))
<div class="ancestor-branch lv{{ $level }}">
    @foreach($parents as $parent)
    <div class="ancestor-entry {{ count($parents) == 1 ? 'sole' : '' }}">
        
        {{-- Recurse up to 3 levels (level 1 = parents, 2 = grandparents, 3 = great-grandparents) --}}
        @if($level < 3)
            @include('users.partials.ancestor-tree', ['userNode' => $parent, 'level' => $level + 1])
        @endif
        
        {{-- Render the Parent Node --}}
        @include('users.partials.tree-node', ['userNode' => $parent])
        
    </div>
    @endforeach
</div>
@endif
