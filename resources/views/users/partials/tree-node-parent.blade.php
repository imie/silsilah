<?php
    $spouses = $userNode->couples->sort(function ($a, $b) {
        $aDivorced = !empty($a->pivot->divorce_date);
        $bDivorced = !empty($b->pivot->divorce_date);
        if ($aDivorced !== $bDivorced) return $aDivorced ? 1 : -1;
        $aDate = $a->pivot->marriage_date ?? "0000-00-00";
        $bDate = $b->pivot->marriage_date ?? "0000-00-00";
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
        return !$spouses->contains("id", $otherParentId);
    });
    if ($unknownChildren->count() > 0) {
        $spouseGroups["unknown"] = $unknownChildren;
    }
    $isSingleSpouse = count($spouseGroups) == 1 && !isset($spouseGroups["unknown"]);
?>
@if($isSingleSpouse)
    <?php
        $spouseId = array_key_first($spouseGroups);
        $spouse = $spouses->firstWhere("id", $spouseId);
        $children = $spouseGroups[$spouseId];
    ?>
    <div class="couple-wrapper">
        @if($userNode->gender_id == 1)
            @include("users.partials.tree-node", ["userNode" => $userNode])
            @include("users.partials.tree-node", ["userNode" => $spouse, "type" => "spouse", "isDivorced" => !empty($spouse->pivot->divorce_date)])
        @else
            @include("users.partials.tree-node", ["userNode" => $spouse, "type" => "spouse", "isDivorced" => !empty($spouse->pivot->divorce_date)])
            @include("users.partials.tree-node", ["userNode" => $userNode])
        @endif
    </div>
    @if ($children->count() && $level < 7)
        <div class="branch spouse-children couple-children">
            @foreach($children as $child)
                @php
                    $childHasSpouse = $child->couples->count() > 0;
                    $childGenderClass = $child->gender_id == 1 ? 'child-gender-male' : 'child-gender-female';
                    $hasCoupleClass = $childHasSpouse ? 'has-couple' : '';
                @endphp
                <div class="entry {{ $children->count() == 1 ? "sole" : "" }} {{ $childGenderClass }} {{ $hasCoupleClass }}">
                    @include("users.partials.tree-node-parent", ["userNode" => $child, "level" => $level + 1])
                </div>
            @endforeach
        </div>
    @endif
@else
    @include("users.partials.tree-node", ["userNode" => $userNode])
    @include("users.partials.tree-branch", ["userNode" => $userNode, "level" => $level, "spouseGroups" => $spouseGroups, "spouses" => $spouses])
@endif
