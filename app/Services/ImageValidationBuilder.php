<?php declare(strict_types=1);

namespace App\Services;

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
    protected $allow = false;

    protected function setFileProps(array $props) {
        $this->fileProps = $props;
    }

    protected function setRules($rules) {
        $this->rules = $rules;
    }

    /**
     * Init validation builder
     *
     * @param array $props
     * @param $rules
     * @return ImageValidationBuilder
     */
    public function init(array $props, $rules) {
        $this->setFileProps($props);
        $this->setRules($rules);
        $this->testRules($this->rules);

        return $this;
    }

    /**
     * Allowed upload image extension
     *
     * @return ImageValidationBuilder
     *
     * @throws /HttpException
     */
    public function isAllowExtension() : ImageValidationBuilder {
        if(!in_array($this->fileProps['extension'], $this->rules['extensions'])) {
            abort(422, trans('image_validation.wrong_extension', [
                'file_name' => $this->fileProps['original_name'],
                'extensions' => implode(', ', $this->rules['extensions'])
            ]));
        }

        return $this;
    }

    /**
     * Allowed upload image mime
     *
     * @return ImageValidationBuilder
     *
     * @throws /HttpException
     */
    public function isAllowMime() : ImageValidationBuilder {
        if(!in_array($this->fileProps['mime'], $this->rules['mime'])) {
            abort(422, trans('image_validation.wrong_mime', [
                'file_name' => $this->fileProps['original_name'],
                'mime_types' => implode(', ', $this->rules['mime'])
            ]));
        }

        return $this;
    }

    /**
     * Allowed upload image min size
     *
     * @return ImageValidationBuilder
     *
     * @throws /HttpException
     */
    public function isAllowMinSize() : ImageValidationBuilder {
        if($this->fileProps['size'] < $this->rules['min_size']) {
            abort(422, trans('image_validation.wrong_min_size', [
                'file_name' => $this->fileProps['original_name'],
                'size' => round($this->rules['min_size'] / 1048576, 1)
            ]));
        }

        return $this;
    }

    /**
     * Allowed upload image max size
     *
     * @return ImageValidationBuilder
     *
     * @throws /HttpException
     */
    public function isAllowMaxSize() : ImageValidationBuilder {
        if($this->fileProps['size'] > $this->rules['max_size']) {
            abort(422, trans('image_validation.wrong_max_size', [
                'file_name' => $this->fileProps['original_name'],
                'size' => round($this->rules['max_size'] / 1048576, 1)
            ]));
        }

        return $this;
    }

    /**
     * Returns status of validation
     *
     * @return bool
     */
    public function isAllow() : bool {
        return $this->allow;
    }

    /**
     * Check image upload rules configuration
     *
     * @param array $rules
     * @return bool
     */
    protected function testRules($rules) {
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
}
