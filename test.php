<?php
$passwordError = "";
if (!empty($_POST["password"]) && !empty($_POST["confirm_password"])) {
    $password = htmlspecialchars($_POST["password"]);
    $confirmPassword = htmlspecialchars($_POST["confirm_password"]);

    $password_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';

    if ($password != $confirmPassword) {
        $passwordError .= "Passwords are not same.\n";
    }
    if (!preg_match($password_pattern, $password)) {
        $passwordError .= "Password must have at least 8 character length with mimimum 1 uppercase, 1 lowercase, 1 number and 1 special characters.\n";
    }
} else {
    $passwordError .= "Enter password and confirm.\n";
}

// Prepare validation response for acknowleding user
if (!empty($passwordError)) {
    $validationOutput = array("type" => "error", "ack" => nl2br($passwordError));
} else {
    $validationOutput = array("type" => "success", "ack" => "Password is valid.");
    // Handle further processing once the password is validated
}


?>