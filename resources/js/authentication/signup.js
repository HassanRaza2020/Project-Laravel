
// Function to handle signup form submission

document.getElementById("signupForm")?.addEventListener("submit", function (e) {
    e.preventDefault();
    console.log("Signup form submitted!");

    $.ajax({
        url: "http://127.0.0.1:8000/post-signup",
        type: "POST",
        data: {
            _token: document.querySelector('meta[name="csrf-token"]').content,
            username: document.getElementById("username").value,
        },
        success: function (response) {
            console.log("Signup Success:", response);
        },
        error: function (xhr) {
            console.error("Signup Error:", xhr);
        }
    });
});

