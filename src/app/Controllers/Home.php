<?php

namespace App\Controllers;

use ChromePhp;
use Exception;

use Aws\S3\S3Client;
use Aws\S3\ObjectUploader;
use CodeIgniter\Files\File;
use Aws\S3\MultipartUploader;
use Aws\Exception\MultipartUploadException;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message', ['errors' => []]);
    }

    public function upload()
    {
        try{
            # Validaciones de CodeIgniter Para la carga de archivos
            $validationRule = [
                'userfile' => [
                    'label' => 'File',
                    'rules' => 'uploaded[userfile]'
                    . '|is_image[userfile]'
                    . '|mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                ],
            ];

            # Si el archivo no pasa alguna validacion
            if (! $this->validate($validationRule)) {
                $data = ['errors' => $this->validator->getErrors()];

                return view('welcome_message', $data);
            }

            $img = $this->request->getFile('userfile');
            $imgName = $img->getName();

            if (! $img->hasMoved()) {
                $filepath = WRITEPATH . 'uploads/' . $img->store();
                $data = ['uploaded_flleinfo' => new File($filepath)];

                $s3 = new S3Client([ # Usando el SDK de AWS
                    'region'  => 'us-east-2',
                    'version' => 'latest',
                    'credentials' => [
                        'key' => $this->aws->s3['access_key_id'],
                        'secret' => $this->aws->s3['secret_access_key'],
                  ]
                ]);

                $bucket = "ivan-docs"; # Nombre del Bucket
                $key = 'ftp/' . $imgName; # Nombre de la carpeta + Nombre del archivo
                $source = fopen($filepath, 'rb');

                $uploader = new ObjectUploader( # Usando SDK para subir archivo
                    $s3,
                    $bucket,
                    $key,
                    $source
                );
                
                try { # Intentando subir la imagen

                    $result = $uploader->upload();

                    if ($result["@metadata"]["statusCode"] == '200') {
                        print('<p>File successfully uploaded to ' . $result["ObjectURL"] . '.</p>');
                    }
                    print($result);

                } catch (MultipartUploadException $e) {
                    rewind($source);
                    $uploader = new MultipartUploader($s3, $source, [
                        'state' => $e->getState(),
                    ]);
                }

                return view('upload/success', $data);
            } else {
                $data = ['errors' => 'The file has already been moved.'];

                return view('welcome_message', $data);
            }
        } catch (Exception $e) {
            echo $e->getMessage() . "\n";
        }
    }
}
