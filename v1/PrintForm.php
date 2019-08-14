<?php


namespace v1;

/**
 * Абстрактный класс описывыающий печатную форму (например, печатная форма счёта или акта выполненных работ)
 * От этого класса нужно сделать потомка в котором по необходимости переопределить некоторые методы, задать настройки
 * Например: InvoicePrintForm extends PrintForm
 *
 * Проблема: класc PrintForm делает слишком много!
 *
 * Попробуем разбить класс на нексколько, выделить интерфейсы, см. директорию v2
 */

abstract class PrintForm
{
    use FieldsetAwareTrait;

    const FORMAT_HTML = 'html';
    const FORMAT_PDF = 'pdf';
    const FORMAT_DOC = 'doc';
    const FORMAT_DOCX = 'docx';
    const FORMAT_EXCEL = 'xlsx';

    const TEMPLATE_FORMAT_PHP = 'php';
    const TEMPLATE_FORMAT_EXCEL = 'xlsx';
    const TEMPLATE_FORMAT_DOCX = 'docx';

    const OUT_SAVE = 0b01;
    const OUT_STREAM = 0b10;
    const OUT_SAVE_AND_STREAM = 0b11;

    protected $key; // условное название этой печатной формы (выводится на кнопке и в выпадающем списке)
    protected $title; // начало текста, который попадёт в начало имени файла и в заголовок html страницы (при выводе в браузер)
    protected $format; // в каком формате в итоге генерировать документ
    protected $templateFormat;
    protected $out; // что сделать с резульатом? Сохранить в папку объекта или отправить в браузер пользователю или и то и другое?
    protected $pdfLandscape = false;
    protected $excelTableOpts = 0; // опции для вывода таблиц в шаблон (см XlsWriter::replaceData())

    /** @var Fieldset|F[] */
    protected $fieldset;

    public $allowMultiple = true;
    public $allowMultipleAsOne = false;

    public function __construct(string $key, string $title, $format = self::FORMAT_HTML, int $out = self::OUT_STREAM)
    {
        $this->key = $key;
        $this->title = $title;
        $this->format = $format;
        $this->out = $out;

        // На основе выходного формата определим формат шаблона по умолчанию (можно переопределить в конструкторе потомка)
        switch ($format) {
            case self::FORMAT_EXCEL:
                $this->templateFormat = self::TEMPLATE_FORMAT_EXCEL;
                break;
            case self::FORMAT_DOCX:
                $this->templateFormat = self::TEMPLATE_FORMAT_DOCX;
                break;

            default:
                $this->templateFormat = self::TEMPLATE_FORMAT_PHP;
        }

        if ($format === self::FORMAT_DOCX) {
            $this->allowMultiple = false;
        }
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getFormat(): string
    {
        return $this->format;
    }

    public function getOut(): int
    {
        return $this->out;
    }

    public function setOut(int $out)
    {
        $this->out = $out;
    }

    public function setPdfLandscape(bool $isLandscape = true)
    {
        $this->pdfLandscape = $isLandscape;
    }

    final public function getFieldset(): Fieldset
    {
        // Лениво инициализируем fieldset, если его ещё нет
        // обычно его нет на момент запуска конструктора, когда дочерние классы делают $this->addFields(...)
        if (!$this->fieldset) {
            $this->fieldset = new Fieldset();
        }

        return $this->fieldset;
    }

    /**
     * Метод для переопределения в классах потомках - проверяет, подходит ли данная печатная форма для данного объекта?
     * Этот метод вызывается при формировании меню из кнопок на печать ModuleAbstract::getSubmenuItemsTplData
     * @param ObjAbstract $obj
     * @return bool
     */
    public function testForObj(ObjAbstract $obj): bool
    {
        return true;
    }

    /**
     * Возвращает текст, который попадёт в заголовок html страницы
     * @param ObjAbstract $obj
     * @return string
     */
    protected function getTitleHtml(ObjAbstract $obj): string
    {
        return $this->title . ' ' . strip_tags($obj->getDescriptionHtml());
    }

    /**
     * Возвращает текст, который попадёт в название Excel листа
     * @param ObjAbstract $obj
     * @return string
     */
    protected function getTitleExcelSheet(ObjAbstract $obj): string
    {
        return strip_tags($obj->getDescriptionHtml());
    }

    /**
     * Возвращает текст, который попадёт в заголовок html страницы, если на печать выведено одновременно несколько объектов
     * @param int $count
     * @return string
     */
    protected function getTitleHtmlMultiple(int $count): string
    {
        return $this->title . ' (' . $count . ')';
    }

    /**
     * Возвращает имя файла шаблона, которое потом будет передано в Template::parseTpl
     * Если вернуть относительный путь, то Template::parseTpl будет искать в папке текущего модуля
     * Можно вернуть абсолютный путь для надёжности
     *
     * По умолчанию в базовом классе PrintForm подразумеваем, что шаблоны должны лежать в папке PrintForms внутри папки
     * текущего модуля
     *
     * @param ObjAbstract $obj
     * @return string
     */
    protected function getTemplate(ObjAbstract $obj): string
    {
        switch ($this->templateFormat) {
            case self::TEMPLATE_FORMAT_EXCEL:
                $ext = 'xlsx';
                break;

            case self::TEMPLATE_FORMAT_DOCX:
                $ext = 'docx';
                break;

            default:
                $ext = 'tpl.php';
        }

        $validFilename = File::getValidFilename($this->key, true);
        $module = Misc::getModule($obj);
        return LIGHT_DIR_PROJECT . "/Module/$module/PrintForms/$validFilename.$ext";
    }

    /**
     * В случае если файл сохраняется в папку объекта, или отправляется в браузер пользотелю как PDF или DOC
     * нужно сформировать имя этого файла
     *
     * Делаем public - иногда нужно доступаться из вне
     *
     * @param ObjAbstract $obj
     * @return string
     */
    public function getFilename(ObjAbstract $obj): string
    {
        $filename = $this->getTitleHtml($obj) . '.' . $this->format;
        return File::getValidFilename($filename);
    }

    protected function getFilenameMultiple(int $count): string
    {
        $filename = $this->getTitleHtmlMultiple($count) . '.' . $this->format;
        return File::getValidFilename($filename);
    }

    /**
     * Для переопределения в классах потомках, если нужно добавить какие-то дополнительные данные для вывода на печать
     * в зависимости от полученного объекта
     * @param ObjAbstract $obj
     * @return array
     */
    protected function getTplData(ObjAbstract $obj): array
    {
        switch ($this->templateFormat) {
            case self::TEMPLATE_FORMAT_EXCEL:
                $data = $this->getTplDataForExcel($obj);
                break;

            case self::TEMPLATE_FORMAT_DOCX:
                $data = $this->getTplDataForDocx($obj);
                break;

            default:
                $data = $obj->getTplData(F::MODE_VIEW);
        }

        $data['_printForm'] = $this->key;
        $data = array_merge($data, $this->getDialogDataFromRequest());

        return $data;
    }

    /**
     * Для переопределения в классах потомках, если нужно добавить какие-то дополнительные данные для вывода на печать
     * в зависимости от полученного объекта
     * @param array $objects
     * @return array
     */
    protected function getTplDataForMultipleAsOne(array $objects): array
    {
        $data['_printForm'] = $this->key;
        $data = array_merge($data, $this->getDialogDataFromRequest());

        return $data;
    }

    protected function getTplDataForExcel(ObjAbstract $obj): array
    {
        // Используем простой метод $obj->getData(), чтобы получить данные ещё не преобразованные в формат Excel
        // (например, даты чисто в текстовом формате)
        // Преобразование в Excel форматы будет позже на этапе writeCellData()
        return $obj->getData();
    }

    protected function getTplDataForDocx(ObjAbstract $obj): array
    {
        // Для вывода в шаблон docx преобразуем все поля объекта в текстовое представление
        $data = $obj->getData();
        foreach ($obj->getFieldset() as $field) {
            $data[$field->key] = $obj->getFieldText($field->key);
        }
        return $data;
    }

    protected function getDialogDataFromRequest(): array
    {
        if ($this->getFieldset()->count()) {
            $dialogData = $this->getFieldset()->getDataFromRequest($_POST);
            if ($dialogData) {
                return $dialogData;
            }
        }
        return [];
    }

    /**
     * Можно переопределить в классе потомке для заполнения диалога печати начальными данными
     * @param ObjAbstract $obj
     * @return array
     */
    public function getDataForAjaxDialog(ObjAbstract $obj): array
    {
        return [];
    }

    /**
     * Можно переопределить в классах потомках для заполнения диалогоа массовой печати начальными данными
     * @param array $ids
     * @param array $objects
     * @return array
     */
    public function getDataForAjaxDialogMultiple(array $ids, array $objects): array
    {
        return [];
    }

    public function proceedPrintMultipeAsOne(array $objects)
    {
        // Здесь было много кода
    }

    public function hasFieldset(): bool
    {
        return $this->getFieldset()->count() > 0;
    }

    /**
     * @param ObjAbstract $obj
     * @param string $targetDir
     * @throws \Exception
     */
    public function proceedPrint(ObjAbstract $obj, string $targetDir)
    {

    }

    /**
     * @param array $objects
     * @param array $targetDirs
     * @throws \Exception
     */
    public function proceedPrintMultiple(array $objects, array $targetDirs)
    {
        // здесь было много кода
    }

    private function isOutStream(): bool
    {
        return $this->out & self::OUT_STREAM;
    }

    private function isOutSave(): bool
    {
        return $this->out & self::OUT_SAVE;
    }

    /**
     * @return string
     * @throws \Exception
     */
    private function createTmpDir(): string
    {
        $prefix = 'PrintForm_' . $this->key . '_' . date('Y-m-d_H_i_s');
        // Функция File::mkdirTmp автоматически запланирует удаление директории после окончания работы скрипта
        return File::mkdirTmp($prefix);
    }

    /**
     * @param string $templateFilepathAbs
     * @param ObjAbstract $obj
     * @return TemplaterAbstract
     */
    private function createTemplater(string $templateFilepathAbs, ObjAbstract $obj): TemplaterAbstract
    {
        switch ($this->templateFormat) {
            case self::TEMPLATE_FORMAT_EXCEL:
                $titleExcelSheet = $this->getTitleExcelSheet($obj);
                return new TemplaterExcel($templateFilepathAbs, $titleExcelSheet, $obj->getFieldset(),
                    $this->excelTableOpts);

            case self::TEMPLATE_FORMAT_DOCX:
                return new TemplaterDocx($templateFilepathAbs);
        }

        $titleHtml = $this->getTitleHtml($obj);
        return new TemplaterPhp($templateFilepathAbs, $titleHtml);
    }

    /**
     * @param TemplaterAbstract $templateWriter
     * @param string $dest
     * @throws \Exception
     */
    private function save(TemplaterAbstract $templateWriter, string $dest)
    {
        switch ($this->format) {
            case self::FORMAT_HTML:
                $templateWriter->saveHtml($dest);
                break;

            case self::FORMAT_DOC:
                $templateWriter->saveDoc($dest);
                break;

            case self::FORMAT_DOCX:
                $templateWriter->saveDocx($dest);
                break;

            case self::FORMAT_PDF:
                $templateWriter->savePdf($dest, $this->pdfLandscape);
                break;

            case self::FORMAT_EXCEL:
                $templateWriter->saveExcel($dest);
                break;
        }
    }

    private function saveAsync(TemplaterAbstract $templateWriter, string $dest): ?Process
    {
        if ($this->format === self::FORMAT_PDF) {
            // Асинхронное сохранение доступно только при сохранении в PDF (и то, только из HTML)
            return $templateWriter->savePdfAsync($dest, $this->pdfLandscape);
        }

        // Все прочие форматы сохраняются синхронно
        $this->save($templateWriter, $dest);
        // Возвращаем null, чтобы сигнализировать вызывающему методу, что тут никакого асинхронного процесса нет
        // и дожидаться завершения нет смысла (всё уже синхронно завершено)
        return null;
    }

    protected function writeData(TemplaterAbstract $templater, array $data, ObjAbstract $obj)
    {
        $templater->writeData($data);
    }

    /**
     * @return ConcatinaterInterface
     * @throws \Exception
     */
    private function createConcatinater(): ConcatinaterInterface
    {
        switch ($this->format) {
            case self::FORMAT_DOC:
            case self::FORMAT_HTML:
                return new ConcatinaterHtml(new Filesystem());

            case self::FORMAT_EXCEL:
                return new ConcatinaterExcel();

            case self::FORMAT_PDF:
                return new ConcatinaterPdf();
        }

        throw new \Exception('No Concatinater class for format ' . $this->format);
    }

    public function isLinkBlank()
    {
        return ($this->out & self::OUT_STREAM) && $this->format === self::FORMAT_HTML;
    }

    public function getIcon()
    {
        switch ($this->format) {
            case self::FORMAT_EXCEL:
                return Img::iconExcel();

            case self::FORMAT_PDF:
                return Img::iconPdf();

            case self::FORMAT_DOC:
            case self::FORMAT_DOCX:
                return Img::iconWord();

        }
        return Img::iconPrint();
    }

}
