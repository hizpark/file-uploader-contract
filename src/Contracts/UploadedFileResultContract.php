<?php

namespace Hizpark\FileUploaderContract\Contracts;

interface UploadedFileResultContract
{
    public function getFileUrl(): string;
}
