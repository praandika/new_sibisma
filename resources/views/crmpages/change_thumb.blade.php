@extends('crmpages.layouts.app')

@section('title', $title)

@section('content')
<section class="contact">
    <div class="container" data-aos="fade-up">
        @foreach($data as $o)
        <div class="section-title">
            <h2>Change Thumbnail {{ $o->activity_title }}</h2>
        </div>

        <div class="row justify-content-center mt-1">
            <div class="col-lg-8 mt-5 mt-lg-0">
                @if(Session::get('img') == 'error')
                <label style="color: red;">Image size to large, make sure max width or height is 800px
                    <br>
                    <a href="https://www.iloveimg.com/resize-image" target="_blank">Resize here</a> or
                    <a href="https://imageresizer.com/" target="_blank">here</a></label>
                <br><br>
                @endif
                <form action="{{ route('activity.changethumbupdate',$o->id) }}" method="post" class="form-style"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $id }}" name="id">
                    <input type="hidden" value="{{ $o->activity_thumb }}" name="img_prev">
                    <div class="form-group mt-3" style="text-align: center;">
                        <label for="photo">Change Thumbnail</label>
                        <input type="file" class="form-control" name="photo" id="photo" placeholder="Photo" required>
                        <img src="{{ asset('img/activity/'.$o->activity_thumb.'') }}" alt="Uploading Image" id="imgPreview" width="300px"
                            style="text-align: center;">
                    </div>

                    <div class="text-center"><button type="submit">Change</button></div>
                </form>
            </div>
        </div>
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
