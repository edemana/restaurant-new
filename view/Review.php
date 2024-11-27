<!DOCTYPE html>
<html lang="eng">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Author" content="EVPH">
    <title>Review Page</title>
    <link rel="stylesheet" href="../assets/css/akornor.css">
    <link rel="stylesheet" href="../assets/css/feedback.css">
    <link rel="shortcut icon" href="../assets/images/favicon.ico" type="image/x-icon">


</head>

<body>
    <p style="text-align:center; 
    padding: 20px;font-size: 1.2em;color: #555;
    line-height: 1.6;max-width: 800px;margin: 0 auto;">Thank you for ordering from Akornor! We are always looking for ways to improve<br>
        your customer experience and we want to make sure that we collect all of your <br>
        feedback to improve our services.</p>

    <div class="form-container"  data-aos="fade-right" data-aos-duration="2000">
        <h2 class="form-title">Feedback</h2>
        <form id="FeedbackForm" class="form" action="../functions/submit_feedback.php" method="post">
            <label for="category" class="form-label">Review</label>
            <select id="category" name="category" required class="form-input">
                <option value="Customer Service">Customer Service</option>
                <option value="Food Quality">Food and Drinks</option>
                <option value="Pool table">Pool table</option>
            </select>

            <label for="comments" class="form-label">Feedback</label>
            <textarea id="comments" name="comments" placeholder="Let us know what you think" required
                class="form-input form-textarea"></textarea>

            <label for="rating" class="form-label">Rating</label>
            <select id="rating" name="rating" required class="form-input">
                <option value="1">1 - Poor</option>
                <option value="2">2 - Fair</option>
                <option value="3">3 - Good</option>
                <option value="4">4 - Very Good</option>
                <option value="5">5 - Excellent</option>
            </select>
            <button type="submit" class="form-button">
                Submit
            </button>
            <button type="cancel" class="form-button">
                Cancel
            </button>
        </form>
    </div>



    </div>

    <!-- Thank you message -->
    <p id="thankYouMessage" style="display: none; color: green; font-weight: bold;"></p>

    <script>
        form.addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent page reload

            // Get form data
            const formData = new FormData(form);

            // Send data to the server using Fetch API
            fetch("../functions/submit_feedback.php", {
                method: "POST",
                body: formData,
            })
                .then((response) => {
                    if (response.ok) {
                        return response.text();
                    } else {
                        throw new Error("Failed to submit feedback");
                    }
                })
                .then((data) => {
                    // Display the thank you message
                    const reviewType = formData.get("Review Type"); // Get selected review type
                    message.textContent = `Thank you for your ${reviewType} feedback, it means a lot to us!`;
                    message.style.display = "block";

                    // Clear the form fields
                    form.reset();
                })
                .catch((error) => {
                    console.error(error);
                    message.textContent = "Something went wrong. Please try again.";
                    message.style.color = "red";
                    message.style.display = "block";
                });
        });

        form.addEventListener("cancel", function (event) {
            event.preventDefault(); // Prevent page reload

            // Get form data
            const formData = new FormData(form);

            // Send data to the server using Fetch API
            fetch("../functions/submit_feedback.php", {
                method: "POST",
                body: formData,
            })
                .then((data) => {
                    // Clear the form fields
                    form.reset();
                })
                .catch((error) => {
                    console.error(error);
                    message.textContent = "Something went wrong. Please try again.";
                    message.style.color = "red";
                    message.style.display = "block";
                });
        });

    </script>
</body>