@extends('templates.default')

@section('content')
    <div class="main top-margin">
        <h3 class="left-margin titlemover">Event Calendar</h3>
        <div class="row">
            <div class="col-lg-8">
                <form class="form-vertical" role="form" method="post" 
                action="{{ route('event.calendar') }}">
                    <div class="row col-lg-25">
                        <div class="col-lg-6 form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <input type="text" name="title" class="form-control" id="title"
                            placeholder="Title">
                            @if ($errors->has('title'))
                                <span class="help-block">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-3 form-group{{ $errors->has('sdate') ? ' has-error' : '' }}">
                            <input type="date" name="sdate" class="form-control" id="sdate">
                            @if ($errors->has('sdate'))
                                <span class="help-block">{{ $errors->first('sdate') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-3 form-group{{ $errors->has('edate') ? ' has-error' : '' }}">
                            <input type="date" name="edate" class="form-control" id="edate">
                            @if ($errors->has('edate'))
                                <span class="help-block">{{ $errors->first('edate') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-12 form-group{{ $errors->has('notes') ? ' has-error' : '' }}">
                            <input type="text" name="notes" class="form-control" id="notes"
                            placeholder="Notes">
                            @if ($errors->has('notes'))
                                <span class="help-block">{{ $errors->first('notes') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="add" class="btn btn-default">Add</button>
                    </div>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>
            </div> 
        </div>
        <div class="row">
            <div class="col-lg-16">
                <div class="col-lg-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            {{ Auth::user()->getNameOrUsername() }}'s Calendar    
                        </div>
                        <div class="panel-body" >
                            {!! $calendar->calendar() !!}
                            {!! $calendar->script() !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="eventlist">
                        <h5>Event List</h5>
                        <hr>
                        @foreach ($events as $event)
                            <div class="row">
                                <div class="col-lg-1">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="delete" name="delete">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <label>{{ $event->title }}</label>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>                            
@stop