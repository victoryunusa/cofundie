"use strict";
let oldImage = document.getElementById('oldImage').value;
let source = !oldImage ? null : [{ source:oldImage }];

let oldCoverImage = document.getElementById('oldCoverImage').value;
let coverSource = !oldCoverImage ? null : [{ source:oldCoverImage }];

// Upload temporary Image
FilePond.registerPlugin(
    FilePondPluginFileValidateSize,
    FilePondPluginFileValidateType,
    FilePondPluginImagePreview,
    FilePondPluginImageExifOrientation,
    FilePondPluginImageResize
);
FilePond.create(document.getElementById("filepond_image"), {
    credits: null,
    allowImagePreview: true,
    acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
    imageResizeTargetWidth: 1400,
    imageResizeTargetHeight: 1400,
    imagePreviewMaxHeight: 250,
    imagePreviewMinHeight: 100,
    maxFileSize: "512KB",
    minFileSize: "10KB",
    instantUpload: !oldImage,
    files: source,
    server: {
        process: (fieldName, file, metadata, load, error, progress, abort) => {
            const formData = new FormData();
            formData.append(fieldName, file, file.name);

            const request = new XMLHttpRequest();

            request.open(
                "POST",
                "/upload-temporary-file/filepond_image"
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


                        document.getElementById('image').value = response.folder;
                    } else {
                        Notify.error(null, 'Something went wrong')
                    }
                }
            };
            request.send(formData);
        },
    }
});


FilePond.create(document.getElementById("filepond_cover_image"), {
    credits: null,
    allowImagePreview: true,
    acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
    imageResizeTargetWidth: 1400,
    imageResizeTargetHeight: 1400,
    imagePreviewMaxHeight: 100,
    imagePreviewMinHeight: 100,
    maxFileSize: "512KB",
    minFileSize: "10KB",
    instantUpload: !oldCoverImage,
    files: coverSource,
    server: {
        process: (fieldName, file, metadata, load, error, progress, abort) => {
            const formData = new FormData();
            formData.append(fieldName, file, file.name);

            const request = new XMLHttpRequest();

            request.open(
                "POST",
                "/upload-temporary-file/filepond_cover_image"
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


                        document.getElementById('image').value = response.folder;
                    } else {
                        Notify.error(null, 'Something went wrong')
                    }
                }
            };
            request.send(formData);
        },
    }
});
