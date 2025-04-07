<?php


class Session {

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function set(string $key, $value): void {
        $_SESSION[$key] = $value;
    }

    public function get(string $key) {
        return $_SESSION[$key] ?? null;
    }

    public function has(string $key): bool {
        return isset($_SESSION[$key]);
    }

    public function remove(string $key): void {
        if ($this->has($key)) {
            unset($_SESSION[$key]);
        }
    }

    public function destroy(): void {
        $_SESSION = [];
        session_destroy();
    }

     public function incrementCounter(string $key): int {
         $currentValue = $this->get($key, 0);
         $newValue = $currentValue + 1;
         $this->set($key, $newValue);
         return $newValue;
     }
}

?>



