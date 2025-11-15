<?php

/**
 * Classe RealUrl
 * Suporte completo para servidor real, htaccess, subpastas, paths amigáveis
 * Inspirada em League\Url e Spatie\Url, mas simples e compacta.
 */

class RealURL
{
    protected string $scheme = '';
    protected string $host = '';
    protected int|null $port = null;
    protected string $path = '';
    protected array $segments = [];
    protected array $query = [];
    protected string $fragment = '';
    protected string $baseUrl = '';

    public function __construct()
    {
        $this->parseServerUrl();
    }

    private function parseServerUrl(): void
    {
        // Detecta http/https
        $this->scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            ? 'https'
            : 'http';

        $this->host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $this->port = isset($_SERVER['SERVER_PORT']) ? (int)$_SERVER['SERVER_PORT'] : null;

        // REQUEST_URI = /projeto/teste?x=1#frag
        $full = $_SERVER['REQUEST_URI'] ?? '/';
        $parsed = parse_url($full);

        // Path
        $this->path = $parsed['path'] ?? '/';

        // Segments
        $this->segments = array_values(
            array_filter(explode('/', trim($this->path, '/')))
        );

        // Query
        parse_str($parsed['query'] ?? '', $this->query);

        // Fragmento
        $this->fragment = $parsed['fragment'] ?? '';

        // remove todas as pastas antes da raiz do projeto
        $root = '/calendario_universal/projeto/';

        $uriPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// remove prefixo até o caminho real
        $clean = preg_replace('#^.+' . preg_quote($root, '#') . '#', '', $uriPath);

// gera segments corretos (login, cadastro, etc)
        $this->segments = array_values(array_filter(explode('/', trim($clean, '/'))));

// baseUrl correto
        $this->baseUrl = "{$this->scheme}://{$this->host}{$root}";
    }

    /* GETTERS */

    public function getScheme(): string
    {
        return $this->scheme;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getPort(): ?int
    {
        return $this->port;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getSegments(): array
    {
        return $this->segments;
    }

    public function segment(int $i, $default = null): mixed
    {
        return $this->segments[$i] ?? $default;
    }

    public function getQuery(): array
    {
        return $this->query;
    }

    public function query(string $key, $default = null): mixed
    {
        return $this->query[$key] ?? $default;
    }

    public function getFragment(): string
    {
        return $this->fragment;
    }

    public function base($path = '') {
        return BASE_URL . ltrim($path, '/');
    }

    public function full(): string
    {
        $url = $this->baseUrl . $this->path;

        if (!empty($this->query)) {
            $url .= '?' . http_build_query($this->query);
        }

        if ($this->fragment) {
            $url .= '#' . $this->fragment;
        }

        return $url;
    }
}