<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI SEO & Raw Base64 Debug</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #aiOutput { white-space: pre-line; direction: auto; text-align: left; }
        .img-container { min-height: 250px; background: #eee; display: flex; align-items: center; justify-content: center; border-radius: 10px; overflow: hidden; }
        #aiImage { width: 100%; height: auto; display: none; }
        .debug-box { background: #222; color: #0f0; font-family: 'Courier New', Courier, monospace; font-size: 12px; }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5 mb-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white"><h4>Gemini AI SEO & Base64 Debug</h4></div>
            <div class="card-body">
                <input type="text" id="productInfo" class="form-control mb-3" placeholder="Enter Product Name">
                <div class="d-flex gap-2 mb-4">
                    <button class="btn btn-info w-50" id="textBtn">Generate Content</button>
                    <button class="btn btn-success w-50" id="imageBtn">Generate Image</button>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <h5>Product Image:</h5>
                        <div class="img-container shadow-sm mb-3">
                            <img id="aiImage" src="">
                            <div id="imgLoader" class="spinner-border text-success" style="display:none;"></div>
                            <p id="placeholderText" class="text-muted m-0">No Image</p>
                        </div>

                        <h6>Raw Base64 Code:</h6>
                        <textarea id="rawBase64" class="form-control debug-box" rows="10" readonly placeholder="Base64 data will appear here..."></textarea>
                    </div>

                    <div class="col-md-8">
                        <h5>Content:</h5>
                        <div id="aiOutput" class="p-3 border bg-white rounded shadow-sm" style="min-height: 400px;">Content will appear here...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Content Generation
        $('#textBtn').click(function() {
            let info = $('#productInfo').val();
            if(!info) return alert("Enter product name");
            $(this).prop('disabled', true).text('Generating...');

            $.post("/priya/Storemart_v.4.3/generate-text", { _token: "{{ csrf_token() }}", product_info: info }, function(res) {
                $('#textBtn').prop('disabled', false).text('Generate Content');
                if(res.success) $('#aiOutput').text(res.data);
            });
        });

        // Image Generation + Base64 View
        $('#imageBtn').click(function() {
            let info = $('#productInfo').val();
            if(!info) return alert("Enter product name");

            $('#aiImage').hide();
            $('#placeholderText').hide();
            $('#imgLoader').show();
            $('#rawBase64').val('Fetching data...');
            $(this).prop('disabled', true).text('Processing...');

            $.post("/priya/Storemart_v.4.3/generate-image", { _token: "{{ csrf_token() }}", product_info: info }, function(res) {
                $('#imageBtn').prop('disabled', false).text('Generate Image');
                $('#imgLoader').hide();

                if(res.success) {
                    // Raw Code textarea mein daalna
                    $('#rawBase64').val(res.base64_raw);

                    // Image display karna
                    $('#aiImage').attr('src', res.image_url).fadeIn();
                } else {
                    $('#placeholderText').show().text("Error");
                    $('#rawBase64').val("Error: " + res.message);
                }
            });
        });
    </script>
</body>
</html>
