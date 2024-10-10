<?php

require 'vendor/autoload.php';

use setasign\Fpdi\Fpdi;
use Imagick;

function concatFiles(array $files, $outputFile) {
    $pdf = new Fpdi();

    foreach ($files as $file) {
        $filePath = __DIR__ . '/public/' . $file;
        if (!file_exists($filePath)) {
            throw new Exception("Le fichier n'existe pas: $filePath");
        }

        $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        if ($fileExtension === 'pdf') {
            // Ajouter des pages PDF au document final
            $pageCount = $pdf->setSourceFile($filePath);
            for ($i = 1; $i <= $pageCount; $i++) {
                $templateId = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($templateId);
                $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
                $pdf->useTemplate($templateId);
            }
        } elseif (in_array($fileExtension, ['jpg', 'jpeg', 'png'])) {
            // Convertir les images en PDF et les ajouter au document final
            $imagick = new Imagick();
            $imagick->readImage($filePath);
            $imagick->setImageFormat('pdf');

            $tmpPdfPath = sys_get_temp_dir() . '/' . uniqid() . '.pdf';
            $imagick->writeImage($tmpPdfPath);
            $imagick->clear();
            $imagick->destroy();

            $pageCount = $pdf->setSourceFile($tmpPdfPath);

            for ($i = 1; $i <= $pageCount; $i++) {
                $templateId = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($templateId);
                $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
                $pdf->useTemplate($templateId);
            }

            unlink($tmpPdfPath);
        } else {
            throw new Exception("Format de fichier non supporté: $filePath");
        }
    }

    $pdf->Output('F', $outputFile);
}

try {
    $files = [
        'SKM_C250i24081322380.pdf',
        'Réservation salle.pdf',
        'WhatsApp Image 2024-10-10 at 11.10.34.jpeg',
        'WhatsApp Image 2024-10-10 at 11.10.34 (1).jpeg',
        'LETTRE_DEMANDE_DE_VISITEUR.pdf',
    ];
    $outputFile = 'output.pdf';
    concatFiles($files, $outputFile);
    echo "Fichier combiné généré: $outputFile";
} catch (Exception $e) {
    echo 'Erreur: ' . $e->getMessage();
}
