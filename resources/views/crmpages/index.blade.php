@extends('crmpages.layouts.app')

@section('title','CRM Activities')

@section('content')
<!-- ======= Timeline Section ======= -->
<section id="resume" class="resume">
    <div class="container" data-aos="fade-up">
        <div class="box mb-4">
            <div class="section-title">
                <h2>CRM Bisma's Activities</h2>
                <p>Activities system</p>
            </div>

            <div class="section-title">
                <button type="submit" style="
                background: #0563bb;
                border: 0;
                padding: 10px 35px;
                color: #fff;
                transition: 0.4s;
                border-radius: 50px;" id="addDataBtn" onclick="addData()">
                    Add Activity
                </button>
            </div>

            <div id="addData" @if(Session::get('show')==true) '' @else hidden @endif>
                <section class="contact">
                    <div class="container" data-aos="fade-up">
                        <div class="section-title">
                            <h2>New Activity</h2>
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
                                <form action="{{ route('activity.store') }}" method="post" class="form-style"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <input type="text" name="title" class="form-control" id="title"
                                                placeholder="Title" value="{{ old('title') }}" required>
                                        </div>
                                        <div class="col-md-6 form-group mt-3 mt-md-0">
                                            <input type="datetime-local" class="form-control" name="datetime"
                                                id="datetime" placeholder="Datetime" value="{{ old('datetime') }}"
                                                required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <input type="text" name="place" class="form-control" id="place"
                                                placeholder="Place e.g: Sanur" value="{{ old('place') }}" required>
                                        </div>
                                        <div class="col-md-6 form-group mt-3 mt-md-0">
                                            <input type="text" class="form-control" name="note" id="note"
                                                placeholder="Note:..." value="{{ old('note') }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3" style="text-align: center;">
                                        <label for="photo">Upload Photo Activity</label>
                                        <input type="file" class="form-control" name="photo" id="photo"
                                            placeholder="Photo" required>
                                        <img src="{{ asset('img/noimage.jpg') }}" alt="Uploading Image" id="imgPreview"
                                            width="300px" style="text-align: center;">
                                    </div>

                                    <div class="text-center"><button type="submit">Save</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <div class="box">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <h3 class="resume-title">Timeline Activities</h3>
                    @forelse($data as $o)
                    <div class="resume-item">
                        <h4>{{ $o->activity_title }}</h4>
                        <h5>{{ \Carbon\Carbon::parse($o->activity_time)->isoFormat('dddd, D MMMM Y | H:mm') }} WITA</h5>
                        <p><em>{{ $o->activity_place }}</em></p>
                        <p>{{ $o->activity_note }}</p>
                        <img src="{{ asset('img/activity/'.$o->activity_thumb.'') }}" class="img-fluid img_thumb"
                            width="200px"> <br>
                        <a href="{{ route('photo.add',$o->id) }}" style="
                        background: #0563bb;
                        border: 0;
                        padding: 10px 35px;
                        color: #fff;
                        transition: 0.4s;
                        border-radius: 50px;
                        display: inline-block;
                        ">Add Photo</a>
                        |
                        <a href="{{ route('activity.show',$o->id) }}" class="btn-style">Show more...</a>
                    </div>
                    @empty
                    <div class="resume-item">
                        <h4>No data available</h4>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section><!-- End Timeline Section -->
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

<script>
    function addData() {
        let form = document.getElementById("addData");

        form.toggleAttribute("hidden")
    }

</script>
@endpush
