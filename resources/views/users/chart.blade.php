@extends('layouts.user-profile-wide')

@section('subtitle', trans('app.family_chart'))

@section('user-content')
<div class="card card bg-light table-responsive">
    <table class="table table-bordered table-striped">
        <tbody>
            <tr>
                <th style="width: 9%">{{ trans('user.grand_father') }} & {{ trans('user.grand_mother') }}</th>
                <td class="text-center">
                    @if($fatherGrandpa)
                        @include('users.partials.tree-node', ['userNode' => $fatherGrandpa, 'type' => 'chart'])
                    @else
                        ?
                    @endif
                </td>
                <td class="text-center">
                    @if($fatherGrandma)
                        @include('users.partials.tree-node', ['userNode' => $fatherGrandma, 'type' => 'chart'])
                    @else
                        ?
                    @endif
                </td>
                <td class="text-center">
                    @if($motherGrandpa)
                        @include('users.partials.tree-node', ['userNode' => $motherGrandpa, 'type' => 'chart'])
                    @else
                        ?
                    @endif
                </td>
                <td class="text-center">
                    @if($motherGrandma)
                        @include('users.partials.tree-node', ['userNode' => $motherGrandma, 'type' => 'chart'])
                    @else
                        ?
                    @endif
                </td>
            </tr>
            <tr>
                <th>{{ trans('user.father') }} & {{ trans('user.mother') }}</th>
                <td class="text-center" colspan="2">
                    @if($father)
                        @include('users.partials.tree-node', ['userNode' => $father, 'type' => 'chart'])
                    @else
                        ?
                    @endif
                </td>
                <td class="text-center" colspan="2">
                    @if($mother)
                        @include('users.partials.tree-node', ['userNode' => $mother, 'type' => 'chart'])
                    @else
                        ?
                    @endif
                </td>
            </tr>
            <tr>
                <th>&nbsp;</th>
                <td class="text-center lead" colspan="4">
                    <strong>@include('users.partials.tree-node', ['userNode' => $user, 'type' => 'chart']) ({{ $user->gender }})</strong>
                </td>
            </tr>
            <tr>
                <th>{{ trans('user.childs') }} & {{ trans('user.grand_childs') }}</th>
                <td colspan="4">
                    <?php 
                        $no = 0; 
                        $spouseGroups = [];
                        foreach($spouses as $sp) {
                            $spouseGroups[$sp->id] = $childs->filter(function($child) use ($user, $sp) {
                                return $user->gender_id == 1 ? $child->mother_id == $sp->id : $child->father_id == $sp->id;
                            });
                        }
                        $unknownChildren = $childs->filter(function($child) use ($user, $spouses) {
                            $otherParentId = $user->gender_id == 1 ? $child->mother_id : $child->father_id;
                            return !$spouses->contains('id', $otherParentId);
                        });
                        if ($unknownChildren->count() > 0) {
                            $spouseGroups['unknown'] = $unknownChildren;
                        }
                    ?>
                    @forelse($spouseGroups as $spouseId => $groupedChilds)
                        <?php 
                            $spouse = $spouseId === 'unknown' ? null : $spouses->firstWhere('id', $spouseId);
                        ?>
                        <div style="background-color: #fff; padding: 10px; border: 1px solid #eee; margin-bottom: 15px;">
                            <h4 style="margin-top: 0; border-bottom: 1px solid #ddd; padding-bottom: 10px;">
                                @if($spouse)
                                    <small class="text-muted">{{ $user->gender_id == 1 ? trans('user.wife') : trans('user.husband') }}:</small> 
                                    @include('users.partials.tree-node', ['userNode' => $spouse, 'type' => 'chart'])
                                    @if(!empty($spouse->pivot->divorce_date))
                                        <span class="label label-danger" style="margin-left: 5px; background-color: #d9534f; padding: .2em .6em .3em; font-size: 75%; font-weight: 700; line-height: 1; color: #fff; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: .25em;">Divorced</span>
                                    @endif
                                @else
                                    <small class="text-muted">{{ trans('app.unknown') }} {{ $user->gender_id == 1 ? trans('user.wife') : trans('user.husband') }}</small>
                                @endif
                            </h4>
                            
                            @foreach($groupedChilds->chunk(4) as $chunkedChild)
                            <div class="row">
                                @foreach($chunkedChild as $child)
                                <div class="col-md-3">
                                    <h5><strong>{{ ++$no }}. @include('users.partials.tree-node', ['userNode' => $child, 'type' => 'chart']) ({{ $child->gender }})</strong></h5>
                                    <ul style="padding-left: 30px">
                                        @foreach($child->childs as $grand)
                                        <li>@include('users.partials.tree-node', ['userNode' => $grand, 'type' => 'chart']) ({{ $grand->gender }})</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                    @empty
                        <div class="text-muted">{{ trans('app.data_not_available') }}</div>
                    @endforelse
                </td>
            </tr>
        </tbody>
    </table>
</div>

<h4 class="page-header">
    {{ trans('user.siblings') }}, {{ trans('user.nieces') }}, & {{ trans('user.grand_childs') }}
</h4>
@foreach ($siblings->chunk(3) as $chunkedSiblings)
<div class="row">
    @foreach ($chunkedSiblings as $sibling)
    <div class="col-sm-4">
        @include('users.partials.chart-sibling')
    </div>
    @endforeach
</div>
@endforeach
@endsection
