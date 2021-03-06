@extends('layouts.master')
@section('heading')
<h1>{{__('All Tasks')}}</h1>
@stop

@section('content')
<table class="table table-striped" id="tasks-table">
    <thead>
        <tr>

            <th>{{ __('Title') }}</th>
            <th>{{ __('Client') }}</th>
            <th>{{ __('Created at') }}</th>
            <th>{{ __('Deadline') }}</th>
            <th>{{ __('Assigned') }}</th>

        </tr>
    </thead>
</table>
@stop

@push('scripts')
<script>
    $(function () {
        $('#tasks-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('dt.tasks') !!}',
            columns: [
                {data: 'title_link', name: 'title'},
                {data: 'client_name', name: 'client_name'},
                {data: 'created_at', name: 'created_at'},
                {data: 'deadline', name: 'deadline'},
                {data: 'user_assigned_id', name: 'user_assigned_id',},

            ]
        });
    });
</script>
@endpush