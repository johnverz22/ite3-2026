<?php

namespace App\Services;

class PostService {
    
    /**
     * Converts a title into a URL-friendly slug.
     * Example: "Hello World!" -> "hello-world"
     */
    public static function generateSlug($title) {
        // Convert to lowercase and trim
        $slug = strtolower(trim($title));
        
        // Replace non-alphanumeric characters with hyphens
        $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug);
        
        // Remove multiple hyphens and trim hyphens from ends
        $slug = preg_replace('/-+/', '-', $slug);
        $slug = trim($slug, '-');
        
        return $slug;
    }
}
