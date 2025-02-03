    document.addEventListener('DOMContentLoaded', () => {
    let questionIdInput = document.getElementById('question-id-input');
    let modalButtonsArray = [];
    let modal = document.getElementById('modal');
    let closeModalButton = document.getElementById('close-btn');
    let closeModalButton2 = document.getElementById('close-btn2');
    let countdownElement = document.getElementById("count");
    let count = countdownElement.dataset.endTime;


    console.log(count);
    // Loop through the buttons that trigger the modal
    for (let i = 1; i <= count; i++) {
        const openModalButton = document.getElementById('open-modal' + i);
       

        
        if (openModalButton) {
            modalButtonsArray.push(openModalButton); // Store the button in the array
        }
    }



    // Log the modal buttons array for debugging

    // Event listeners for opening the modal
    modalButtonsArray.forEach(button => {
        button.addEventListener('click', function() {
            modal.style.display = "block"; // Show the modal
            let questionId = button.getAttribute('data-value'); // Get the questionId
            questionIdInput.value = questionId; // Set the value to the hidden input
            console.log(document.getElementById('question-id-input').value);
            console.log(questionId); // Log the questionId
        });
    });

    // Event listener to close the modal
    if (closeModalButton) {
        closeModalButton.addEventListener('click', function() {
            modal.style.display = "none"; // Hide the modal
        });
    }

    if (closeModalButton2) {
        closeModalButton2.addEventListener('click', function() {
            modal.style.display = "none"; // Hide the modal
        });
    }
});
        
        
