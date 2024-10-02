<?php

namespace core;

class Controller {
    public function loadView($view, $data = []) {
        extract($data);
        require_once "../app/views/$view.php";
    }    

    public function asset($path) {
        $manifestPath = '../public/assets/build/manifest.json';
        if (file_exists($manifestPath)) {
            $manifest = json_decode(file_get_contents($manifestPath), true);
            if (isset($manifest[$path])) {
                return '/assets/build/' . $manifest[$path];
            }
        }
        return '/assets/build/' . $path;
    }

    /**
     * Route helper function to generate URLs for defined routes
     *
     * @param string $path - The path or route name
     * @param array $params - Optional route parameters to include in the URL
     * @return string - The generated URL for the route
     */
    public function route($path, $params = []) {
        // Basic URL building (extend logic based on your routing implementation)
        $url = '/' . trim($path, '/');
        
        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }
        
        return $url;
    }
}
