@extends('layouts.app')
@section('content')
    <div class="container-fluid app-body">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row filter-section">
                    <form action="{{ route('post_filter') }}" method="post" id="postingForm">
                        {{ csrf_field() }}
                        <div class="col-md-3">
                            <div class="activities">
                                <input class="form-control" type="search" name="search" placeholder="search" id="search"/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="activities">
                                <input type="date" class="form-control" name="date" id="Date" @if(isset($date)) value="{{ date("F J, Y", strtotime($date)) }}" @endif>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="activities">
                                <select class="form-control" name="group_id" id="group_id">
                                    <option selected disabled>All Group</option>
                                    @foreach($post_groups as $post_group)
                                        <option value="{{ $post_group->id }}" @if(isset($group_id) && $group_id == $post_group->id) selected @endif>{{ $post_group->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="activities">
                                <input class="btn btn-primary" type="submit" name="submit" />
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 group-col">

                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3>Recent Post sent to buffer</h3>
                        <div class="activities">

                            <div class="panel panel-default activity">
                                <div class="panel-body">
                                    <table class="table table-bordered ">
                                        <thead>
                                            <tr>
                                                <th width="15%">Group Name</th>
                                                <th width="15%">Group Type</th>
                                                <th width="15%">Account Name</th>
                                                <th width="45%">Post Text</th>
                                                <th width="10%">Time</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($postings as $posting)
                                                <tr>
                                                    <td>{{ $posting->group_name }}</td>
                                                    <td>{{ $posting->group_type }}</td>
                                                    <td class="text-center"><img class="avatar-img" src="{{ asset($posting->account_name) }}"></td>
                                                    <td>{{ $posting->post_text }}</td>
                                                    <td class="text-center">{{ $posting->time }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    {{ $postings->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
