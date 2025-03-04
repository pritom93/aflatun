<script>
    document.getElementById('imageUpload').addEventListener('change', function(event) {
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = '';
    const file = event.target.files[0];
    if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
    const img = document.createElement('img');
    img.src = e.target.result;
    img.style.maxWidth = '100px';
    img.style.height = '100px';
    img.style.borderRadius = '50%';
    img.style.objectFit = 'cover';
    preview.appendChild(img);
    };
    reader.readAsDataURL(file);
    }
    });

    document.getElementById('clearImage').addEventListener('click', function() {
    document.getElementById('imageUpload').value = '';
    document.getElementById('imagePreview').innerHTML = '';
    });
</script>