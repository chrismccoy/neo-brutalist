jQuery(document).ready(function($) {
    var mediaUploader;

    $('#neo_upload_btn').click(function(e) {
        e.preventDefault();

        // If the uploader object has already been created, reopen the dialog
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }

        // Extend the wp.media object
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Download File',
            button: {
                text: 'Use this File'
            },
            multiple: false
        });

        // When a file is selected, grab the URL and set it as the text field's value
        mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#neo_download_url').val(attachment.url);

            // Show clear button
            $('#neo_clear_btn').parent().show();
        });

        // Open the uploader dialog
        mediaUploader.open();
    });

    // Clear Button
    $('#neo_clear_btn').click(function(e) {
        e.preventDefault();
        $('#neo_download_url').val('');
        $(this).parent().hide();
    });
});
