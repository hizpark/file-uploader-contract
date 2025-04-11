<?php

namespace Hizpark\FileUploaderContract\Contracts;

interface UploadedFileContract
{
    public function getName(): string;

    public function getType(): string;

    public function getTmpName(): string;

    public function getSize(): int;
}
