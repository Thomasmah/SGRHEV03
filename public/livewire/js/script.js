document.getElementById('imageInput').addEventListener('change', handleImageUpload);

let cropper;

function handleImageUpload(event) {
    const input = event.target;
    const croppedImage = document.getElementById('croppedImage');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            const imageUrl = e.target.result;

            if (cropper) {
                cropper.replace(imageUrl);
            } else {
                cropper = new Cropper(croppedImage, {
                    aspectRatio: 1, // Define a proporção do recorte (opcional)
                    viewMode: 1, // Define o modo de visualização
                });

                cropper.replace(imageUrl);
            }
        };

        reader.readAsDataURL(input.files[0]);
    }
}