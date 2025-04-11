# hizpark/file-uploader-contract

![License](https://img.shields.io/github/license/hizpark/file-uploader-contract)

A framework-agnostic file upload contract for PHP. Supports extensible local and cloud storage implementations.

本套件提供一套與存儲無關的文件上傳接口定義，適用於任何本地或雲端上傳實作，方便擴展、替換與測試。

---

## 📦 安裝

```bash
composer require hizpark/file-uploader-contract
```

---

## 🚀 快速開始

### 定義上傳接口

```php
namespace Hizpark\FileUploaderContract\Contracts;

use Hizpark\FileUploaderContract\Contracts\UploadContextContract;
use Hizpark\FileUploaderContract\Contracts\UploadedFileContract;
use Hizpark\FileUploaderContract\Contracts\UploadedFileResultContract;

interface FileUploaderContract
{
    public function upload(UploadedFileContract $file, UploadContextContract $context): UploadedFileResultContract;
}
```

### 定義上傳檔案接口

```php
namespace Hizpark\FileUploaderContract\Contracts;

interface UploadedFileContract
{
    public function getName(): string;
    public function getType(): string;
    public function getTmpName(): string;
    public function getSize(): int;
}
```

---

## 🧠 擴展設計

### 上傳上下文契約

```php
namespace Hizpark\FileUploaderContract\Contracts;

interface UploadContextContract
{
    public function getBasePath(): string;
    public function getDirname(): string;
    public function getScope(): ?string;
    public function getValidator(): UploadedFileValidatorContract|\Closure|null;
    public function getFilenameCallback(): \Closure|null;
    public function getOptions(): array;
}
```

### 上傳結果契約

```php
namespace Hizpark\FileUploaderContract\Contracts;

interface UploadedFileResultContract
{
    public function getFileUrl(): string;
}
```

---

## 🧪 合約測試（可選）

`file-uploader-contract` 主要提供接口定義，並不包含具體的實作。如果你在開發實作套件時（例如 `file-uploader-local` 或 `file-uploader-s3`），你可以選擇撰寫合約測試來驗證實作符合接口行為。

### 合約測試範例

```php
abstract class FileUploaderContractTest extends TestCase
{
    abstract protected function getUploader(): FileUploaderContract;

    public function testUploadReturnsUploadedFileResult()
    {
        $uploader = $this->getUploader();
        $file     = $this->mockUploadedFile(); // 也要提供 mock
        $context  = $this->mockContext(); // 自行實作上下文 mock

        $result = $uploader->upload($file, $context);

        $this->assertInstanceOf(UploadedFileResultContract::class, $result);
        $this->assertNotEmpty($result->getFileUrl());
    }
}
```

---

## 📂 類結構說明

- `FileUploaderContract`：上傳檔案的核心接口
- `UploadContextContract`：包含上傳相關配置與驗證等上下文資訊
- `UploadedFileContract`：表示一個被上傳的文件
- `UploadedFileResultContract`：上傳後返回結果（如 URL）
- `UploadedFileValidatorContract`：文件驗證接口

---

## ✅ 測試建議

| 測試項目                        | 描述                                      |
|----------------------------------|-------------------------------------------|
| ✅ `FileUploaderContract::upload()` | 能正確上傳並回傳 `UploadedFileResultContract`     |
| ✅ `FileUploaderContract`           | 各實作需遵循接口規範，實作需通過合約測試 |
| ✅ `UploadedFileContract`          | 應正確實作文件相關屬性                   |

---

## 📜 License

MIT License. See the [LICENSE](LICENSE) file for details.
