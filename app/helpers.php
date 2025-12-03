<?php

if (!function_exists('highlightText')) {
    function highlightText($text, $searchTerm) {
        if (!$searchTerm) return e($text);
        
        $highlighted = preg_replace(
            "/(" . preg_quote($searchTerm) . ")/i",
            '<span style="background-color: #dbeafe; color: #1e40af; padding: 2px 4px; border-radius: 4px; font-weight: bold; border: 1px solid #93c5fd;">$1</span>',
            e($text)
        );
        
        return $highlighted;
    }
}