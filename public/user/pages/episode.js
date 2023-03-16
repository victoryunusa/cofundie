"use strict";
// Upload temporary Image
FilePond.registerPlugin(
    FilePondPluginFileValidateSize,
    FilePondPluginFileValidateType,
);
const filePond = FilePond.create(document.getElementById("episode"), {
    credits: null,
    acceptedFileTypes: ['audio/*'],
    minFileSize: "10KB",
    allowMultiple: true,
    server: {
        process: (fieldName, file, metadata, load, error, progress, abort) => {
            const formData = new FormData();
            formData.append(fieldName, file, file.name);

            const request = new XMLHttpRequest();

            request.open("POST",document.getElementById('uploadUrl').value);
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

document.addEventListener('FilePond:processfiles', (e) => {
    console.log(e)
});
