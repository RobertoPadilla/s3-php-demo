# Despliegue de archivos a bucket en Amazon S3

Este repositorio guardará archivos dentro de los buckets configurados en mi cuenta de Amazon, ***no suban archivos grandes***.

### Pasos

- En el archivo de configuracion de entorno (.env) guardar sus respectivas llaves para acceder al bucket como en el siguiente ejemplo:

~~~
aws.s3_security.access_key_id = ********
aws.s3_security.secret_access_key = ********
aws.s3_bucket.name = ivan-docs
aws.s3_bucket.ftp_path = sisgia-test/
~~~

