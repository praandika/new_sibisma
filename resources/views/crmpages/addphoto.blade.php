@extends('crmpages.layouts.app')

@section('title','Add Photo')

@section('content')
<section id="resume" class="resume">
    <div class="container" data-aos="fade-up">
        <div class="box mb-4">
            <div class="section-title">
                <h2><a href="{{ route('activity.index') }}">CRM Bisma's Activities</a></h2>
                <p>Activities system</p>
            </div>
        </div>
        <section class="contact">
            <div class="container" data-aos="fade-up">
                @foreach($data as $o)
                <div class="section-title">
                    <h2>{{ $o->activity_title }}</h2>
                </div>
                @endforeach

                <div class="row justify-content-center mt-1">
                    <div class="col-lg-8 mt-5 mt-lg-0">
                        @if(Session::get('img') == 'error')
                        <label style="color: red;">Image size to large, make sure max width or height is 800px
                            <br>
                            <a href="https://www.iloveimg.com/resize-image" target="_blank">Resize here</a> or
                            <a href="https://imageresizer.com/" target="_blank">here</a></label>
                        <br><br>
                        @endif
                        <form action="{{ route('photo.store') }}" method="post" class="form-style"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $id }}" name="activity_id">
                            <div class="form-group mt-3" style="text-align: center;">
                                <label for="photo">Add Photo Activity</label>
                                <input type="file" class="form-control" name="photo" id="photo" placeholder="Photo"
                                    required>
                                <img src="{{ asset('img/noimage.jpg') }}" alt="Uploading Image" id="imgPreview"
                                    width="300px" style="text-align: center;">
                            </div>

                            <div class="text-center"><button type="submit">Save</button></div>
                        </form>
                    </div>
                </div>

                <div class="box">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <h3 class="resume-title">Thumbnail</h3>
                            <img src="{{ asset('img/activity/'.$thumbnail.'') }}" class="img-fluid img_thumb"
                                width="200px">
                            
                            <div class="resume-item">
                                <h4>Current photos</h4>
                                @forelse($photos as $o)
                                    <img src="{{ asset('img/activity/'.$o->photos.'') }}"
                                    class="img-fluid img_thumb" width="200px">
                                @empty
                                    <h4>No photo available</h4>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
