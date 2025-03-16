<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'] ?? '';

    // Sanitize input before saving (optional but recommended)
    $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');

    // Process the content, e.g., save to a database or a file
    file_put_contents('saved_content.html', $content);
    echo "Content saved successfully!";
}