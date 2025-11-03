<?php
// Database configuration for Vercel deployment
// Uses ONLY environment variables - no fallback to avoid exposing credentials

$DB_HOST = $_ENV['DB_HOST'] ?? getenv('DB_HOST') ?? null;
$DB_USER = $_ENV['DB_USER'] ?? getenv('DB_USER') ?? null;
$DB_PASS = $_ENV['DB_PASS'] ?? getenv('DB_PASS') ?? null;
$DB_NAME = $_ENV['DB_NAME'] ?? getenv('DB_NAME') ?? null;

// If any credential is missing, disable database
if (!$DB_HOST || !$DB_USER || !$DB_PASS || !$DB_NAME) {
    $DB_HOST = $DB_USER = $DB_PASS = $DB_NAME = null;
}
?>