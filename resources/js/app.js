import "./bootstrap";

function setupVideoModal({
    videoPlayerSelector = "#video-player",
    triggerSelector = ".play-video",
    modalSelector = "#exampledsModal",
} = {}) {
    const videoPlayer = document.querySelector(videoPlayerSelector);
    const videoModalElement = document.querySelector(modalSelector);
    let hls = null;

    if (!videoPlayer || !videoModalElement) return;

    document.querySelectorAll(triggerSelector).forEach(function (el) {
        el.addEventListener("click", function (e) {
            e.preventDefault();

            const videoSrc = this.getAttribute("data-video-url");
            if (!videoSrc) return;

            videoPlayer.pause();
            videoPlayer.removeAttribute("src");
            if (hls) {
                hls.destroy();
                hls = null;
            }

            if (window.Hls && Hls.isSupported()) {
                hls = new Hls();
                hls.loadSource(videoSrc);
                hls.attachMedia(videoPlayer);
                hls.on(Hls.Events.MANIFEST_PARSED, function () {
                    videoPlayer.play();
                });
            } else {
                videoPlayer.src = videoSrc;
                videoPlayer.play();
            }
            if (this.classList.contains("ignite"))
                this.classList.add("hidden");
        });
    });

    videoModalElement.addEventListener("hidden.bs.modal", function () {
        videoPlayer.pause();
        videoPlayer.currentTime = 0;
        videoPlayer.removeAttribute("src");
        if (hls) {
            hls.destroy();
            hls = null;
        }
    });
}

// Example usage:
setupVideoModal({
    videoPlayerSelector: "#video-player",
    triggerSelector: ".play-video",
    modalSelector: "#exampledsModal",
});

$(document).ready(function () {
    const $spinner = $("#global-spinner"); // Cache the spinner element

    $("#referenceEditForm").on("submit", function (e) {
        e.preventDefault();

        // Clear previous alerts and errors immediately
        $(".alert").remove();
        $(".invalid-feedback").remove();
        $(".is-invalid").removeClass("is-invalid");

        var $form = $(this);
        var formData = new FormData(this);

        // IMPORTANT: When using FormData with file uploads, the AJAX 'method'
        // MUST be 'POST' because the PUT/PATCH method is spoofed via a hidden
        // field (@method('PUT')) inside the FormData object.
        $.ajax({
            url: $form.attr("action"),
            method: "POST", // Change from "Put" to "POST" for file uploads with FormData
            data: formData,
            processData: false,
            contentType: false,
            timeout: 0, // disable AJAX timeout
            // 🌟 STEP 1: SHOW SPINNER BEFORE SENDING REQUEST 🌟
            beforeSend: function () {
                // Assuming $spinner is defined globally or in this scope
                $spinner.css("display", "flex");
            },

            success: function (response) {
                // Check for explicit 'success' flag from controller's JSON
                if (response.success) {
                    // Display success message
                    $(
                        '<div class="alert alert-success">' +
                            response.message +
                            "</div>"
                    ).insertBefore($form);

                    // Update H2 title if the controller returned it
                    if (response.new_title) {
                        $("h2").text("Edit Reference: " + response.new_title);
                    }

                    location.href = "/admin/ressources";
                } else {
                    // Fallback error if controller returned a 200 but success=false (unlikely with our setup)
                    $(
                        '<div class="alert alert-danger">' +
                            (response.message ||
                                "An unexpected server error occurred.") +
                            "</div>"
                    ).insertBefore($form);
                }
            },

            error: function (response) {
                // Handle validation errors (422) specifically
                if (response.status === 422) {
                    var errors = response.responseJSON.errors;

                    // Display main error message
                    $(
                        '<div class="alert alert-danger">Please correct the following errors:</div>'
                    ).insertBefore($form);

                    // Loop through all validation errors
                    $.each(errors, function (key, messages) {
                        // Find the input element (using its name attribute)
                        var $input = $form.find('[name="' + key + '"]');

                        // Add Bootstrap/Tailwind invalid class to highlight the field
                        $input.addClass("is-invalid");

                        // Append the error message below the input
                        var $errorDiv = $(
                            '<div class="invalid-feedback text-sm text-red-600"></div>'
                        );
                        $errorDiv.text(messages[0]); // Display only the first error message

                        // If the input is part of a larger container (like a custom file input),
                        // this attempts to insert the error message right after the input.
                        $input.after($errorDiv);
                    });
                }
                // Handle other server errors (500)
                else {
                    var errorMessage =
                        response.responseJSON && response.responseJSON.message
                            ? response.responseJSON.message
                            : "A server error occurred (" +
                              response.status +
                              "). Please check console.";

                    $(
                        '<div class="alert alert-danger">' +
                            errorMessage +
                            "</div>"
                    ).insertBefore($form);
                    console.error("AJAX Error:", response);
                }
            },

            // 🌟 STEP 2: HIDE SPINNER AFTER REQUEST IS COMPLETE (Success or Error) 🌟
            complete: function () {
                $spinner.css("display", "none");
            },
        });
    });
});