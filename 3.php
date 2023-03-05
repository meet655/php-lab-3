<?php
// Initialize variables for form data and error messages
$name = '';
$email = '';
$message = '';
$nameErr = '';
$emailErr = '';
$passworderr = '';
$successMsg = '';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize form data
    $name = sanitize_input($_POST['name']);
    $email = sanitize_input($_POST['email']);
    $message = sanitize_input($_POST['message']);

    // Validate name field
    if (empty($name)) {
        $nameErr = 'Name is required.';
    } else {
        // Check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = 'Only letters and white space allowed.';
        }
    }

    // Validate email field
    if (empty($email)) {
        $emailErr = 'Email is required.';
    } else {
        // Check if email address is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = 'Invalid email format.';
        }
    }

    // Validate message field
    if (empty($message)) {
        $messageErr = 'Message is required.';
    }

    // If there are no errors, send email and display success message
    if (empty($nameErr) && empty($emailErr) && empty($messageErr)) {
        $to = 'your-email@example.com';
        $subject = 'Contact Form Submission';
        $body = "Name: $name\nEmail: $email\n\n$message";

        if (mail($to, $subject, $body)) {
            $successMsg = 'Thank you for contacting us. We will get back to you soon!';
        } else {
            $successMsg = 'Oops! Something went wrong. Please try again later.';
        }

        // Reset form data
        $name = '';
        $email = '';
        $password = '';
    }
}

// Function to sanitize form data
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!-- HTML form with error messages and success message -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $name; ?>">
    <span class="error"><?php echo $nameErr; ?></span>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $password; ?>>
    <span class=" error"><?php echo $emailErr; ?></span>

    <label for="password">passsword:-</label>
    <input type="password" id="password" name="password" value="<?php echo $email; ?>">




    <input type="submit" value="Submit">
</form>