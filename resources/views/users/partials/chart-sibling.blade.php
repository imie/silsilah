<div class="card card bg-light table-responsive">
    <table class="table table-bordered table-striped">
        <tbody>
            <tr>
                <th style="width: 35%">{{ trans('user.siblings') }}</th>
                <th class="text-center" colspan="{{ $sibling->childs->count() }}">{!! $sibling->profileLink('chart') !!} ({{ $sibling->gender }})</th>
            </tr>
            <tr>
                <th>{{ trans('user.nieces') }}</th>
                <td>
                    <ul style="padding-left: 15px; margin-bottom: 0;">
                        @foreach($sibling->childs as $child)
                        <li>{!! $child->profileLink('chart') !!} ({{ $child->gender }})</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            <tr>
                <th>{{ trans('user.grand_childs') }}</th>
                <td>
                    <ul style="padding-left: 15px; margin-bottom: 0;">
                        @foreach($sibling->childs as $child)
                            @foreach($child->childs as $grand)
                            <li>{!! $grand->profileLink('chart') !!} ({{ $grand->gender }})</li>
                            @endforeach
                        @endforeach
                    </ul>
                </td>
            </tr>
        </tbody>
    </table>
</div>