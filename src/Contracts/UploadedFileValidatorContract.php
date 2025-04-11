<?php

namespace Hizpark\FileUploaderContract\Contracts;

interface UploadedFileValidatorContract
{
    public function validate(UploadedFileContract $file): void;
}
