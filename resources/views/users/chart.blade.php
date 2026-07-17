@extends('layouts.user-profile-wide')

@section('subtitle', trans('app.family_chart'))

@section('user-content')
<div class="card card bg-light table-responsive">
    <table class="table table-bordered table-striped">
        <tbody>
            <tr>
                <th style="width: 9%">{{ trans('user.grand_father') }} & {{ trans('user.grand_mother') }}</th>
                <td class="text-center">
                    {!! $fatherGrandpa ? $fatherGrandpa->profileLink('chart') : '?' !!}
                </td>
                <td class="text-center">
                    {!! $fatherGrandma ? $fatherGrandma->profileLink('chart') : '?' !!}
                </td>
                <td class="text-center">
                    {!! $motherGrandpa ? $motherGrandpa->profileLink('chart') : '?' !!}
                </td>
                <td class="text-center">
                    {!! $motherGrandma ? $motherGrandma->profileLink('chart') : '?' !!}
                </td>
            </tr>
            <tr>
                <th>{{ trans('user.father') }} & {{ trans('user.mother') }}</th>
                <td class="text-center" colspan="2">
                    {!! $father ? $father->profileLink('chart') : '?' !!}
                </td>
                <td class="text-center" colspan="2">
                    {!! $mother ? $mother->profileLink('chart') : '?' !!}
                </td>
            </tr>
            <tr>
                <th>&nbsp;</th>
                <td class="text-center lead" colspan="4">
                    <strong>{!! $user->profileLink('chart') !!} ({{ $user->gender }})</strong>
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
                            $isDivorced = $spouse && !empty($spouse->pivot->divorce_date);
                        ?>
                        <div style="background-color: #fff; padding: 10px; border: 1px solid #eee; margin-bottom: 15px;">
                            <h4 style="margin-top: 0; border-bottom: 1px solid #ddd; padding-bottom: 10px;">
                                @if($spouse)
                                    <small class="text-muted">
                                        @if($user->gender_id == 1)
                                            {{ $isDivorced ? trans('user.ex_wife') : trans('user.wife') }}:
                                        @else
                                            {{ $isDivorced ? trans('user.ex_husband') : trans('user.husband') }}:
                                        @endif
                                    </small>
                                    {!! $spouse->profileLink('chart') !!} ({{ $spouse->gender }})
                                @else
                                    <small class="text-muted">{{ trans('app.unknown') }} {{ $user->gender_id == 1 ? trans('user.wife') : trans('user.husband') }}</small>
                                @endif
                            </h4>
                            
                            @foreach($groupedChilds->chunk(4) as $chunkedChild)
                            <div class="row">
                                @foreach($chunkedChild as $child)
                                <div class="col-md-3">
                                    <h5><strong>{{ ++$no }}. {!! $child->profileLink('chart') !!} ({{ $child->gender }})</strong></h5>
                                    <ul style="padding-left: 30px; margin-bottom: 0;">
                                        @foreach($child->childs as $grand)
                                        <li>{!! $grand->profileLink('chart') !!} ({{ $grand->gender }})</li>
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

<h4 class="page-header mt-5">
    {{ trans('user.siblings') }}, {{ trans('user.nieces') }} & {{ trans('user.grand_childs') }}
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
