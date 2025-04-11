<?php

namespace Hizpark\FileUploaderContract\Contracts;

interface FileUploaderContract
{
    public function upload(UploadedFileContract $file, UploadContextContract $context): UploadedFileResultContract;
}
