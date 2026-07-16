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
    <div id="hourglass-wrapper" style="display: flex; align-items: center; justify-content: center; min-width: min-content;">
        
        <!-- Ancestors Section (Left) -->
        <div class="ancestors-tree" style="display: flex; align-items: center;">
            @include('users.partials.ancestor-tree', ['userNode' => $user, 'level' => 1])
        </div>

        <!-- Current User + Descendants Section (Right) -->
        <div id="wrapper" style="display: flex; align-items: center;">
            <div class="entry sole" style="margin-right: 0;">
                @include('users.partials.tree-node', ['userNode' => $user])
                @include('users.partials.tree-branch', ['userNode' => $user, 'level' => 1])
            </div>
        </div>
        
    </div>
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
