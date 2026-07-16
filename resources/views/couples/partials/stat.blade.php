<div class="card card bg-light table-responsive hidden-xs">
    <table class="table table-condensed table-bordered">
        <tr>
            <td class="col-xs-2 text-center">{{ trans('couple.husband') }}</td>
            <td class="col-xs-2 text-center">{{ trans('couple.wife') }}</td>
            <td class="col-xs-2 text-center">{{ trans('couple.childs_count') }}</td>
            <td class="col-xs-2 text-center">{{ trans('couple.marriage_date') }}</td>
            <td class="col-xs-2 text-center">{{ trans('couple.divorce_date') }}</td>
            <td class="col-xs-2 text-center">{{ trans('app.address') }}</td>
        </tr>
        <tr>
            <td class="text-center lead" style="border-top: none;">{{ $couple->husband->profileLink() }}</td>
            <td class="text-center lead" style="border-top: none;">{{ $couple->wife->profileLink() }}</td>
            <td class="text-center lead" style="border-top: none;">{{ $couple->childs->count() }}</td>
            <td class="text-center lead" style="border-top: none;">{{ $couple->marriage_date }}</td>
            <td class="text-center lead" style="border-top: none;">{{ $couple->divorce_date }}</td>
            <td class="text-center lead" style="border-top: none;">{{ $couple->address }}</td>
        </tr>
    </table>
</div>

<ul class="list-group visible-xs">
    <li class="list-group-item">
        {{ trans('couple.husband') }}
        <span class="float-end">{{ $couple->husband->profileLink() }}</span>
    </li>
    <li class="list-group-item">
        {{ trans('couple.wife') }}
        <span class="float-end">{{ $couple->wife->profileLink() }}</span>
    </li>
    <li class="list-group-item">
        {{ trans('couple.childs_count') }}
        <span class="float-end">{{ $couple->childs->count() }}</span>
    </li>
    <li class="list-group-item">
        {{ trans('couple.marriage_date') }}
        <span class="float-end">{{ $couple->marriage_date }}</span>
    </li>
    <li class="list-group-item">
        {{ trans('couple.divorce_date') }}
        <span class="float-end">{{ $couple->divorce_date }}</span>
    </li>
    <li class="list-group-item">
        {{ trans('app.address') }}
        <span class="float-end">{{ $couple->address }}</span>
    </li>
</ul>