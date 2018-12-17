<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';


function findUserById($id ){
    global $db;
    $stmt = $db->prepare("SELECT * FROM users WHERE id=? Limit 1");
    $stmt->execute(array($id));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function findUserByEmail($email ){
    global $db;
    $stmt = $db->prepare("SELECT * FROM users WHERE email=? Limit 1");
    $stmt->execute(array($email));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
}
function findAllPosts(){
    global $db;
    $stmt = $db->prepare("SELECT p.*, u.fullname FROM posts AS p LEFT JOIN users AS u ON u.id = p.userId ORDER BY createAt DESC");
    $stmt->execute();
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}
function createUser($email, $fullName, $passwordHash){
    global $db;
    $stmt = $db->prepare("INSERT INTO users(email, fullname, password) VALUES (?, ?, ?)");
    $stmt->execute(array($email, $fullName,$passwordHash));
    return $db->lastInsertId();
}
function createProfile($userId, $fullName, $numberPhone, $email){
    global $db;
    $stmt = $db->prepare("INSERT INTO profiles(userId, fullName, numberPhone, email) VALUES (?, ?, ?, ?)");
    $stmt->execute(array($userId, $fullName, $numberPhone, $email));
    return $db->lastInsertId();
}
function changePassword($email, $passwordHash){
    global $db;
    $stmt = $db->prepare("UPDATE users SET password=? WHERE email=?");
    $stmt->execute(array($passwordHash, $email));
    return $db->lastInsertId();
}
function createStatus($content, $userId, $time){
    global $db;
    $stmt = $db->prepare("INSERT INTO posts(content, userId, createAt) VALUES (?, ?, ?)");
    $stmt->execute(array($content, $userId, $time));
    return $db->lastInsertId();
}
function updateProfile($email, $fullName, $numberPhone){
    global $db;
    $stmt = $db->prepare("UPDATE users SET fullName=? numberPhone=?  WHERE email=?");
    $stmt->execute(array($fullName, $numberPhone, $email));
    return $db->lastInsertId();
}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function createResetPassword($userId){
    global $db;
    $secref = generateRandomString();
    $stmt = $db->prepare("INSERT INTO reset_password(userId, secret, used) VALUES (?, ?, 0)");
    $stmt->execute(array($userId, $secref));
    return $secref;
}
function findResetPassword($secret){
    global $db;
    $stmt = $db->prepare("SELECT * FROM reset_password WHERE secret=? Limit 1");
    $stmt->execute(array($secret));
    $resetPassword = $stmt->fetch(PDO::FETCH_ASSOC);
    return $resetPassword;
}
function updatePassword($userId, $password){
    global $db;
    $stmt = $db->prepare("UPDATE users SET password = ? WHERE id = ?");
    $stmt->execute(array($password, $userId));
}
function markResetPasswordUsed($secret){
    global $db;
    $stmt = $db->prepare("UPDATE reset_password SET used = 1 WHERE secret = ?");
    $stmt->execute(array($secret));
}

function sendEmail($email, $receiver, $subject, $content){
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    //try {
        //Server settings
        //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'py.it.webmaster@gmail.com';                 // SMTP username
        $mail->Password = 'Py58598857';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('py.it.webmaster@gmail.com', 'Py IT');
        $mail->addAddress($email, $receiver);     // Add a recipient

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $content;

        $mail->send();
        return true;
    // }
    // catch (Exception $e) {
    //     return false;
    // }
}