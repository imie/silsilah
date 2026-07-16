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
                    <?php $no = 0; ?>
                    @foreach($childs->chunk(4) as $chunkedChild)
                    <div class="">
                        @foreach($chunkedChild as $child)
                        <div class="col-md-3">
                            <h4><strong>{{ ++$no }}. @include('users.partials.tree-node', ['userNode' => $child, 'type' => 'chart']) ({{ $child->gender }})</strong></h4>
                            <ul style="padding-left: 30px">
                                @foreach($child->childs as $grand)
                                <li>@include('users.partials.tree-node', ['userNode' => $grand, 'type' => 'chart']) ({{ $grand->gender }})</li>
                                @endforeach
                            </ul>
                        </div>
                        @endforeach
                        @if (! $loop->last)
                        <div class="clearfix"></div><hr>
                        @endif
                    </div>
                    @endforeach
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
