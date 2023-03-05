<!DOCTYPE html>
<html>

<head>
    <title>Contact Form</title>
</head>

<body>
    <h1>Contact Us</h1>
    <?php if (isset($errors)) { ?>
    <ul>
        <?php foreach ($errors as $error) { ?>
        <li><?= $error ?></li>
        <?php } ?>
    </ul>
    <?php } ?>
    <form method="post" action="process_form.php">
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?= $name ?? '' ?>">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?= $email ?? '' ?>">
        </div>
        <div>
            <label for="subject">Subject:</label>
            <input type="text" name="subject" id="subject" value="<?= $subject ?? '' ?>">
        </div>
        <div>
            <label for="message">Message:</label>
            <textarea name="message" id="message"><?= $message ?? '' ?></textarea>
        </div>
        <div>
            <button type="submit">Send</button>
        </div>
    </form>
</body>

</html>
<?php
$errors = [];

// Validate name
if (empty($_POST['name'])) {
    $errors[] = 'Name is required';
} else {
    $name = htmlspecialchars($_POST['name']);
}

// Validate email
if (empty($_POST['email'])) {
    $errors[] = 'Email is required';
} elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Invalid email format';
} else {
    $email = htmlspecialchars($_POST['email']);
}

// Validate subject
if (empty($_POST['subject'])) 
{
    $errors[] = 'Subject is required';
} 
else 
{
    $subject = htmlspecialchars($_POST['subject']);
}

// Validate message
if (empty($_POST['message'])) 
{
    $errors[] = 'Message is required';
} 
else {
    $message = htmlspecialchars($_POST['message']);
}

?>