<?php

if (!function_exists('fileTypeChecker')) {
    function fileTypeChecker($filePath)
    {
        // Get the file extension
        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp'];

        // Define placeholders for file types
        $placeholders = [
            'pdf' => asset('images/placeholders/placeholder.png'),
            'xls' => asset('images/placeholders/placeholder.png'),
            'xlsx' => asset('images/placeholders/placeholder.png'),
            'doc' => asset('images/placeholders/placeholder.png'),
            'docx' => asset('images/placeholders/placeholder.png'),
            // Add more placeholders if necessary
        ];

        // Check if the file is an image
        if (in_array(strtolower($fileExtension), $imageExtensions)) {
            return true; // Return the actual file path if it's an image
        }else{
            return false;
        }

    }
}
