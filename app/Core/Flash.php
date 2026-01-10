<?php
/**
 * Flash Message Class
 * 
 * Manages flash messages (temporary messages displayed once).
 * Messages stored in PHP sessions and automatically cleared after display.
 * 
 * Why Flash Messages?
 * - Show success/error messages after HTTP redirects
 * - Messages cleared after being shown once (prevents duplicates)
 * - Stored in session (persists across redirects)
 */

namespace App\Core;

class Flash
{
    const SUCCESS = 'success';
    const ERROR = 'error';

    /**
     * Set a flash message
     * 
     * @param string $type Type of message (success or error)
     * @param string $message The message to display
     */
    public static function set(string $type, string $message): void
    {
        $_SESSION['flash'][$type] = $message;
    }

    /**
     * Get and clear a flash message
     * 
     * @param string $type Type of message to get
     * @return string|null The message or null if none exists
     */
    public static function get(string $type): ?string
    {
        if (isset($_SESSION['flash'][$type])) {
            $message = $_SESSION['flash'][$type];
            unset($_SESSION['flash'][$type]); // Clear after reading
            return $message;
        }
        return null;
    }

    /**
     * Check if a flash message exists
     * 
     * @param string $type Type of message to check
     * @return bool True if message exists
     */
    public static function has(string $type): bool
    {
        return isset($_SESSION['flash'][$type]);
    }

    /**
     * Set a success message
     */
    public static function success(string $message): void
    {
        self::set(self::SUCCESS, $message);
    }

    /**
     * Set an error message
     */
    public static function error(string $message): void
    {
        self::set(self::ERROR, $message);
    }
}