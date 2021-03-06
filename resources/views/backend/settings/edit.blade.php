@extends('backend.layouts.master')

@section('styles')
@endsection

@section('main-content')
    <div class="my-3 my-md-5">
        <div class="container">
            <div class="page-header">
                <h1 class="page-title">
                    App Settings
                </h1>
            </div>

            <setting-edit
                about_prop="{{$about}}"
                twitter_prop="{{$twitter}}"
                facebook_prop="{{$facebook}}"
                app_avatar_url="{{$about_image_url}}"
                google_analytics_code="{{$google_analytics_code}}"
                app_email_prop="{{$app_contact_email}}">
            </setting-edit>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{asset('tinymce/tinymce.min.js')}}"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '#google_analytics_code',
            height: 200,
            menubar: false,
            resize: 'vertical',
            plugins: 'link, image, code, table, textcolor, lists',
            toolbar: 'styleselect bold italic underline | forecolor backcolor | alignleft aligncenter alignright | bullist numlist outdent indent | link image table youtube giphy | code',
            image_title: true,
            automatic_uploads: true,
            file_picker_types: 'image',
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                input.onchange = function() {
                    var file = this.files[0];
                    var reader = new FileReader();

                    reader.onload = function () {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);

                        cb(blobInfo.blobUri(), { title: file.name });
                    };
                    reader.readAsDataURL(file);
                };

                input.click();
            }
        });
    </script>
@endsection