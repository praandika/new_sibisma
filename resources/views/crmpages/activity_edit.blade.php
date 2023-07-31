@extends('crmpages.layouts.app')

@section('title', $title)

@section('content')
<section class="contact">
    <div class="container" data-aos="fade-up">
        @foreach($data as $o)
        <div class="section-title">
            <h2>Edit {{ $o->activity_title }}</h2>
        </div>

        <div class="row justify-content-center mt-1">
            <div class="col-lg-8 mt-5 mt-lg-0">
                <form action="{{ route('activity.updateact',$o->id) }}" method="post" class="form-style"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $o->id }}">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="text" name="title" class="form-control" id="title" placeholder="Title"
                                value="{{ $o->activity_title }}" required>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <input type="datetime-local" class="form-control" name="datetime" id="datetime"
                                placeholder="Datetime" value="{{ $o->activity_time }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="text" name="place" class="form-control" id="place"
                                placeholder="Place e.g: Sanur" value="{{ $o->activity_place }}" required>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <input type="text" class="form-control" name="note" id="note" placeholder="Note:..."
                                value="{{ $o->activity_note }}" required>
                        </div>
                    </div>

                    <div class="text-center"><button type="submit">Update</button></div>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection
