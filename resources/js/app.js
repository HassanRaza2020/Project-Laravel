import './bootstrap';
import $ from 'jquery';
window.$ = $;
window.jQuery = $;





document.addEventListener("DOMContentLoaded", function () {
    let page = document.body.getAttribute("data-page");  // Get the page name

    console.log("Current Page:", page);

    if (page === "signup") {
        handleSignup();  // This function runs automatically when the signup page loads
    }
});

// Function to handle signup form submission
function handleSignup() {
    console.log("Signup JS Loaded");

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
}
