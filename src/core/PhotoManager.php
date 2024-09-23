<?php

namespace src\core;

use Exception;

class PhotoManager {

    /* @throws Exception */
    public static function savePhoto($photo_dir, $photo, $elId): string {
        try {
            $targetDir = __DIR__ . '/../resources/images/' . $photo_dir . '/';

            $photoName = $elId . '_' . time() . '_' . basename($photo['name']);
            $targetFilePath = $targetDir . $photoName;

            if (move_uploaded_file($photo['tmp_name'], $targetFilePath)) {
                return '/resources/images/' . $photo_dir . '/' . $photoName;
            }
        } catch (Exception) {
            throw new Exception('Photo loading error');
        }
        return '';
    }

    /* @throws Exception */
    public static function deletePhoto($photo): void
    {
        $photoPath = __DIR__ . '/..' . $photo['photo_url'];

        if (file_exists($photoPath)) {
            if (!unlink($photoPath)) {
                throw new Exception("Не удалось удалить файл: {$photoPath}");
            }
        }
    }

}