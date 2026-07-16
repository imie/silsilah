<?php
    $spouses = $userNode->couples->sort(function ($a, $b) {
        $aDivorced = !empty($a->pivot->divorce_date);
        $bDivorced = !empty($b->pivot->divorce_date);

        if ($aDivorced !== $bDivorced) {
            return $aDivorced ? 1 : -1;
        }

        $aDate = $a->pivot->marriage_date ?? '0000-00-00';
        $bDate = $b->pivot->marriage_date ?? '0000-00-00';

        return $bDate <=> $aDate;
    })->values();
    $childs = $userNode->childs;
    $spouseGroups = [];
    foreach($spouses as $sp) {
        $spouseGroups[$sp->id] = $childs->filter(function($child) use ($userNode, $sp) {
            return $userNode->gender_id == 1 ? $child->mother_id == $sp->id : $child->father_id == $sp->id;
        });
    }
    $unknownChildren = $childs->filter(function($child) use ($userNode, $spouses) {
        $otherParentId = $userNode->gender_id == 1 ? $child->mother_id : $child->father_id;
        return !$spouses->contains('id', $otherParentId);
    });
    if ($unknownChildren->count() > 0) {
        $spouseGroups['unknown'] = $unknownChildren;
    }
?>
@if (count($spouseGroups) > 0)
<div class="branch lv{{ $level }}">
    @foreach($spouseGroups as $spouseId => $children)
        <div class="entry {{ count($spouseGroups) == 1 ? 'sole' : '' }}">
            
            {{-- Spouse Node --}}
            @if($spouseId !== 'unknown')
                <?php $spouse = $spouses->firstWhere('id', $spouseId); ?>
                @if($spouse)
                    <div class="spouse-node">
                        @include('users.partials.tree-node', ['userNode' => $spouse, 'type' => 'spouse'])
                        @if(!empty($spouse->pivot->divorce_date))
                            <div style="text-align: center; margin-top: 2px;">
                                <span class="label label-danger" style="background-color: #d9534f; padding: .2em .6em .3em; font-size: 75%; font-weight: 700; line-height: 1; color: #fff; border-radius: .25em;">Divorced</span>
                            </div>
                        @endif
                    </div>
                @endif
            @else
                <div class="spouse-node">
                    <div class="tree-card unknown-spouse">
                        <div class="tree-avatar">?</div>
                        <div class="tree-details">
                            <span class="tree-name">{{ trans('app.unknown') }} {{ $userNode->gender_id == 1 ? trans('user.wife') : trans('user.husband') }}</span>
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
