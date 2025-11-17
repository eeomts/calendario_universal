<?php
// File: `calendario_universal/projeto/models/Url.php`
class Url
{
    private static $instance;

    protected string $scheme;
    protected string $host;
    protected string $root;
    protected string $baseUrl;
    protected array $segments = [];

    public function __construct()
    {
        $this->scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
        $this->host = $_SERVER['HTTP_HOST'] ?? "localhost";
        $this->root = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/') . '/';
        $this->baseUrl = "{$this->scheme}://{$this->host}{$this->root}";

        $path = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '';
        $clean = substr($path, strlen($this->root));
        $this->segments = array_values(array_filter(explode('/', $clean)));
    }

    public static function getInstance(): Url
    {
        if (!self::$instance) {
            self::$instance = new Url();
        }
        return self::$instance;
    }

    public function getBase(): string
    {
        return $this->baseUrl;
    }

    // Alias compatível com código existente que chama base()
    public function base(): string
    {
        return $this->getBase();
    }

    public function segment(int $i, $default = null)
    {
        return $this->segments[$i] ?? $default;
    }

    public function getSegments(): array
    {
        return $this->segments;
    }
}
