<div class="card card bg-light">
    <div class="card-header"><h3 class="card-title">{{ trans('user.siblings') }}</h3></div>
    <table class="table">
        <tbody>
            @foreach($user->siblings() as $sibling)
            <tr>
                <td>
                    {{ $sibling->profileLink() }} ({{ $sibling->gender }})
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>