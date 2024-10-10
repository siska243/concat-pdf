# Concaténation de fichiers PDF et d'images en PHP
# Concaténation de fichiers PDF et d'images en PHP

Ce projet permet de concaténer plusieurs fichiers PDF et images (JPEG, PNG) en un seul fichier PDF. Il utilise les bibliothèques **FPDI** pour manipuler les fichiers PDF et **Imagick** pour convertir les images en PDF.

## Prérequis

- **PHP** doit être installé sur votre machine.
- **Composer** doit être installé pour gérer les dépendances.
- Les bibliothèques suivantes doivent être installées :
  - `setasign/fpdi` : pour manipuler les fichiers PDF.
  - **Imagick** : extension PHP pour manipuler les images.

### Installation des dépendances

1. Installez **FPDI** via Composer :
   ```bash
   composer require setasign/fpdi
   ```
2.  Installez **FPDI** via Composer
  ```bash
   composer require setasign/fpdf
   ```
3. Installez l'extension **Imagick** (Linux) :
   ```bash
   sudo apt-get install php-imagick
   ```

## Utilisation

1. Placez les fichiers PDF et images que vous souhaitez concaténer dans le répertoire racine du projet.
2. Modifiez le tableau `$files` dans le script `index.php` pour y inclure les noms des fichiers à concaténer.
3. Exécutez le script :
   ```bash
   php -S localhost:3000 index.php
   ```
4. Le fichier PDF concaténé sera généré sous le nom `output.pdf`.

## Exemple

Le tableau `$files` contient la liste des fichiers à concaténer :
Les fichiers doivent etre dans le repertoire public

```php
$files = [
    'file1.pdf',
    'file2.jpg',
    'file3.png',
    'file4.pdf'
];
```
Le fichier de sortie sera généré avec le nom `output.pdf`.

## Remarques

- Les fichiers doivent être situés dans le même répertoire que le script.
- Les formats supportés pour les images sont `jpg`, `jpeg` et `png`.
- Assurez-vous que tous les fichiers existent avant d'exécuter le script, sinon une exception sera levée.

## Licence

Ce projet est sous licence MIT.

