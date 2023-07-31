@extends('crmpages.layouts.app')

@section('title', $title)

@section('content')
<section id="resume" class="resume">
    <div class="container" data-aos="fade-up">
        <div class="box mb-4">
            <div class="section-title">
                <h2><a href="{{ route('activity.index') }}">CRM Bisma's Activities</a></h2>
            </div>
        </div>
        @foreach($activity as $o)
        <section class="contact">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>{{ $o->activity_title }}</h2>
                </div>

                <div class="box">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <h3 class="resume-title">Thumbnail</h3>
                            <img src="{{ asset('img/activity/'.$o->activity_thumb.'') }}" class="img-fluid img_thumb"
                                width="200px">
                            <div class="resume-item">
                                <h5>{{ \Carbon\Carbon::parse($o->activity_time)->isoFormat('dddd, D MMMM Y | H:mm') }}
                                    WITA
                                </h5>
                                <p><em>{{ $o->activity_place }}</em></p>
                                <p>{{ $o->activity_note }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endforeach

        <div class="box">
            <div class="resume-item">
                <h4>Photos</h4>
                @forelse($photos as $o)
                <div class="image-box" style="
                    margin: 10px;
                    display: inline-block;
                ">
                    <img src="{{ asset('img/activity/'.$o->photos.'') }}" class="img-fluid img_thumb" width="200px"> <br>
                    <a href="{{ route('photo.delete',$o->id) }}"
                        style="
                            background: red;
                            padding: 5px 10px;
                            border-radius: 10px;
                            color: white;
                        "
                        onclick="return confirm('are you sure?')"
                    >Delete</a>
                </div>
                
                @empty
                <h4>No photo available</h4>
                @endforelse
            </div>
        </div>

        <br>

        @foreach($activity as $o)
            <a href="{{ route('activity.edit',$o->id) }}" style="
            background: #0563bb;
            border: 0;
            padding: 10px 35px;
            color: #fff;
            transition: 0.4s;
            border-radius: 50px;
            display: inline-block;
            ">Edit</a>
            |
            <a href="{{ route('activity.changethumb',$o->id) }}" style="
            background: #0563bb;
            border: 0;
            padding: 10px 35px;
            color: #fff;
            transition: 0.4s;
            border-radius: 50px;
            display: inline-block;
            ">Change Thumbnail</a>
        @endforeach
    </div>
</section>
@endsection

@push('after-script')
<script>
    let imgInput = document.getElementById("photo");
    let imgPreview = document.getElementById("imgPreview");
    imgInput.onchange = evt => {
        const [file] = imgInput.files
        if (file) {
            imgPreview.src = URL.createObjectURL(file)
        }
    }

</script>
@endpush
