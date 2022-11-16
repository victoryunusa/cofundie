// Upload temporary Image
FilePond.registerPlugin(
    FilePondPluginFileValidateSize,
    FilePondPluginFileValidateType,
    FilePondPluginImagePreview,
    FilePondPluginImageExifOrientation,
    FilePondPluginImageResize
);
FilePond.create(document.getElementById("filepond_thumbnail"), {
    credits: null,
    allowImagePreview: true,
    acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
    imageResizeTargetWidth: 1400,
    imageResizeTargetHeight: 1400,
    maxFileSize: "512KB",
    minFileSize: "10KB",
    instantUpload: false,
    files: [
        {source: document.getElementById('thumbnail_source').value}
    ],
    server: {
        process: (fieldName, file, metadata, load, error, progress, abort) => {
            const formData = new FormData();
            formData.append(fieldName, file, file.name);
            formData.append('max_size', '512');

            const request = new XMLHttpRequest();

            request.open(
                "POST",
                "/upload-temporary-file/filepond_thumbnail"
            );
            request.setRequestHeader('X-CSRF-TOKEN', $csrf_token)
            request.upload.onprogress = (e) => {
                progress(e.lengthComputable, e.loaded, e.total);
            };

            request.onload = function () {
                if (request.status >= 200 && request.status < 300) {
                    load(request.responseText);
                } else {
                    error("oh no");
                }
            };

            request.onreadystatechange = function () {
                if (this.readyState == 4) {
                    if (this.status == 200) {
                        let response = JSON.parse(this.response);


                        document.getElementById('thumbnail').value = response.folder;
                    } else {
                        Notify.error(null, 'Something went wrong')
                    }
                }
            };
            request.send(formData);
        },
    }
});

$('input[name="make_slug"]').on('click', function () {
   let $type = $(this).val();
   let $automaticSlug = $('#automaticSlug').val();
   let $currentSlug = $('#currentSlug').val();
    let $title = $('#podcast_title').val();

   if ($type === "manual"){
       $('#permalink').val($currentSlug).attr('readonly', false)
   }else if($type === "automatic"){
       $('#permalink').val(slugify($title)).attr('readonly', true);

   }else{
       $('#permalink').val($currentSlug).attr('readonly', true)
   }
});

$('#podcast_title').on('input', function () {
    if ($('input[name="make_slug"]:checked').val() === 'automatic'){
        let $title = $('#podcast_title').val();
        $('#permalink').val(slugify($title));
    }
})
