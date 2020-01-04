<?php declare(strict_types=1);

namespace App\Services\Uploader;


class ImageValidationBuilder
{
    /**
     * Upload image file properties
     *
     * @var array
     */
    protected $fileProps = [];

    /**
     * Image validation rules set
     *
     * @var array
     */
    protected $rules = [];

    /**
     * @var bool
     */
    protected $allow = true;

    /**
     * @var bool
     */
    protected $withAbort = true;

    protected function setFileProps(array $props) {
        $this->fileProps = $props;
    }

    protected function setRules($rules) {
        $this->rules = $rules;
    }

    protected function setAllow(bool $value) {
        $this->allow = $value;
    }

    public function setAbort($value) {
        $this->withAbort = $value;
    }

    /**
     * @param array $props
     * @param $rules
     * @param bool $abort
     * @return $this
     */
    public function init(array $props, $rules, bool $abort = true) {
        $this->setFileProps($props);
        $this->setRules($rules);
        $this->testRules($this->rules);
        $this->setAbort($abort);

        return $this;
    }

    /**
     * @return ImageValidationBuilder|bool|void
     */
    public function isAllowExtension()
    {
        return $this->allow && in_array($this->fileProps['extension'], $this->rules['extensions'])
            ? $this
            : $this->abortExtension();
    }

    /**
     * @return ImageValidationBuilder|bool|void
     */
    public function isAllowMime()
    {
        return $this->allow && in_array($this->fileProps['mime'], $this->rules['mime'])
            ? $this
            : $this->abortMime();
    }

    /**
     * @return ImageValidationBuilder|bool|void
     */
    public function isAllowMinSize()
    {
        return $this->allow && $this->fileProps['size'] < $this->rules['min_size']
            ? $this->abortMinSize()
            : $this;
    }

    /**
     * @return ImageValidationBuilder|bool|void
     */
    public function isAllowMaxSize()
    {
        return $this->allow && $this->fileProps['size'] > $this->rules['max_size']
            ? $this->abortMaxSize()
            : $this;
    }

    /**
     * Returns status of validation
     *
     * @return bool
     */
    public function isAllow() : bool
    {
        return $this->allow;
    }

    /**
     * Check image upload rules configuration
     *
     * @param array $rules
     * @return bool
     */
    protected function testRules($rules)
    {
        $this->testArrayTypeRule($rules['extensions'], 'extensions');
        $this->testArrayTypeRule($rules['mime'], 'mime');
        $this->testStringTypeRule($rules['min_size'], 'min_size');
        $this->testStringTypeRule($rules['max_size'], 'max_size');

        return true;
    }

    /**
     * Check image upload rules configuration - mime rule, extensions rule (array type)
     *
     * @param array $rule
     * @param string $name - rule name
     * @return bool|void
     */
    protected function testArrayTypeRule($rule, $name) {
        return isset($rule) && is_array($rule) && count($rule) > 0
            ? true
            : abort(500, trans('image_validation.error_rule_config', ['rule_name' => $name]));
    }

    /**
     * Check image upload rules configuration - max_size rule, min_size rule (string type)
     *
     * @param string $rule
     * @param string $name - rule name
     * @return bool|void
     */
    protected function testStringTypeRule($rule, $name) {
        return isset($rule) && is_numeric($rule) && $rule > 0
            ? true
            : abort(500, trans('image_validation.error_rule_config', ['rule_name' => $name]));
    }

    protected function abortExtension() {
        return $this->abortAction([
            422, trans('image_validation.wrong_extension', [
                'file_name' => $this->fileProps['original_name'],
                'extensions' => implode(', ', $this->rules['extensions'])
            ])
        ]);
    }

    protected function abortMime() {
        return $this->abortAction([
            422, trans('image_validation.wrong_mime', [
                'file_name' => $this->fileProps['original_name'],
                'mime_types' => implode(', ', $this->rules['mime'])
            ])
        ]);
    }

    protected function abortMinSize() {
        return $this->abortAction([
            422, trans('image_validation.wrong_min_size', [
                'file_name' => $this->fileProps['original_name'],
                'size' => round($this->rules['min_size'] / 1024, 1)
            ])
        ]);
    }

    protected function abortMaxSize() {
        return $this->abortAction([
            422, trans('image_validation.wrong_max_size', [
                'file_name' => $this->fileProps['original_name'],
                'size' => round($this->rules['max_size'] / 1024, 1)
            ])
        ]);
    }

    /**
     * @param $abortData
     * @return $this|void
     */
    private function abortAction(array $abortData) {
        $this->setAllow(false);
        return $this->withAbort
            ? abort(...$abortData)
            : $this;
    }
}
