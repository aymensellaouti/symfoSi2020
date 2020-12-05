<?php


namespace App\Service;


class ImageUploaderService
{
    public function uploadFile($file, $uplaodDirectory) {
        // récupére le nom du file
        $imageName = $file->getClientOriginalName();
        // On crée le nouveau nom
        $newImageName = md5(uniqid()).$imageName;
        /*
         * Copier l'image temporaire qu'on a uploadé dans un dossier qu'on va spécifier
         * */
        $file->move($uplaodDirectory, $newImageName);
        return $newImageName;
    }

}