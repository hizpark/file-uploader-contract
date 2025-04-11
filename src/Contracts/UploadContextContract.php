<?php

namespace Hizpark\FileUploaderContract\Contracts;

use Closure;

interface UploadContextContract
{
    public function getBasePath(): string;

    public function getDirname(): string;

    public function getScope(): ?string;

    public function getValidator(): UploadedFileValidatorContract|Closure|null;

    public function getFilenameCallback(): ?Closure;

    public function getOptions(): array;
}
