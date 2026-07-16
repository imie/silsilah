@extends('layouts.user-profile-wide')

@section('subtitle', trans('app.family_tree'))

@section('user-content')

<?php
$childsTotal = 0;
$grandChildsTotal = 0;
$ggTotal = 0;
$ggcTotal = 0;
$ggccTotal = 0;
$udhegTotal = 0;
?>

<div class="tree-container">
    <div id="wrapper">
    @include('users.partials.tree-node', ['userNode' => $user])
    @if ($childsCount = $user->childs->count())
    <?php $childsTotal += $childsCount ?>
    <div class="branch lv1">
        @foreach($user->childs as $child)
        <div class="entry {{ $childsCount == 1 ? 'sole' : '' }}">
            @include('users.partials.tree-node', ['userNode' => $child])
            @if ($grandsCount = $child->childs->count())
            <?php $grandChildsTotal += $grandsCount ?>
            <div class="branch lv2">
                @foreach($child->childs as $grand)
                <div class="entry {{ $grandsCount == 1 ? 'sole' : '' }}">
                    @include('users.partials.tree-node', ['userNode' => $grand])
                    @if ($ggCount = $grand->childs->count())
                    <?php $ggTotal += $ggCount ?>
                    <div class="branch lv3">
                        @foreach($grand->childs as $gg)
                        <div class="entry {{ $ggCount == 1 ? 'sole' : '' }}">
                            @include('users.partials.tree-node', ['userNode' => $gg])
                            @if ($ggcCount = $gg->childs->count())
                            <?php $ggcTotal += $ggcCount ?>
                            <div class="branch lv4">
                                @foreach($gg->childs as $ggc)
                                <div class="entry {{ $ggcCount == 1 ? 'sole' : '' }}">
                                    @include('users.partials.tree-node', ['userNode' => $ggc])
                                    @if ($ggccCount = $ggc->childs->count())
                                    <?php $ggccTotal += $ggccCount ?>
                                    <div class="branch lv5">
                                        @foreach($ggc->childs as $ggcc)
                                        <div class="entry {{ $ggccCount == 1 ? 'sole' : '' }}">
                                            @include('users.partials.tree-node', ['userNode' => $ggcc])
                                            @if ($udhegCount = $ggcc->childs->count())
                                            <?php $udhegTotal += $udhegCount ?>
                                            <div class="branch lv6">
                                                @foreach($ggcc->childs as $udheg)
                                                <div class="entry {{ $udhegCount == 1 ? 'sole' : '' }}">
                                                    @include('users.partials.tree-node', ['userNode' => $udheg])
                                                </div>
                                                @endforeach
                                            </div>
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
            @endif
        </div>
        @endforeach
    </div>
    @endif
</div>
</div>
<div class="container">
<hr>
<div class="row">
    @if ($childsTotal)
    <div class="col-md-1 text-end">{{ trans('app.child_count') }}</div>
    <div class="col-md-1 text-start"><strong style="font-size:30px">{{ $childsTotal }}</strong></div>
    @endif
    @if ($grandChildsTotal)
    <div class="col-md-1 text-end">{{ trans('app.grand_child_count') }}</div>
    <div class="col-md-1 text-start"><strong style="font-size:30px">{{ $grandChildsTotal }}</strong></div>
    @endif
    @if ($ggTotal)
    <div class="col-md-1 text-end">Jumlah Cicit</div>
    <div class="col-md-1 text-start"><strong style="font-size:30px">{{ $ggTotal }}</strong></div>
    @endif
    @if ($ggcTotal)
    <div class="col-md-1 text-end">Jumlah Canggah</div>
    <div class="col-md-1 text-start"><strong style="font-size:30px">{{ $ggcTotal }}</strong></div>
    @endif
    @if ($ggccTotal)
    <div class="col-md-1 text-end">Jumlah Wareng</div>
    <div class="col-md-1 text-start"><strong style="font-size:30px">{{ $ggccTotal }}</strong></div>
    @endif
    @if ($udhegTotal)
    <div class="col-md-1 text-end">Jumlah Udheg2</div>
    <div class="col-md-1 text-start"><strong style="font-size:30px">{{ $udhegTotal }}</strong></div>
    @endif
</div>
@endsection

@section ('ext_css')
<link rel="stylesheet" href="{{ asset('css/tree.css') }}">
@endsection
