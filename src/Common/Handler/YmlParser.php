<?php

namespace App\Common\Handler;

/**
 * Анализ YML-файла
 *
 * Class YmlParser
 * @package App\Common\Handler
 */
class YmlParser extends XmlParser {
    protected function initRules() {
        $em = $this->getEntityManager();
        // категория
        $this
            ->addChain(
                    "/yml_catalog/shop/categories/category",
                    function(ParserData $data, ParserContext $ctx) use ($em) {
                        // пытаемся найти категорию в БД по внешнему ключу или создаем
                        $productDAO = $em->getRepository('product');
                        $product = $productDAO->findOneBy(['externalId' => $data->getAttribute('id')]);
                        if(!$product) {
                            $product = new Product();
                            $product->setExternalId($data->getAttribute('id'));
                        }
                        $quantity = $data->getAttribute('available')=='true' ? 100 : 0;
                        $product->setQuantity($quantity);

                        $ctx->setObj($product);
                    },
                    function(ParserData $data, ParserContext $ctx) use ($em) {
                        // сохраняем в БД
                        $product = $ctx->getObj();
                        $em->persist($product);
                        $em->flush();
                    }
                );
        // товар
        $this
            ->addChain(
                "/yml_catalog/shop/offers/offer",
                function(ParserData $data, ParserContext $ctx) {
                    // пытаемся найти товар в БД по внешнему ключу или создаем
                },
                function(ParserData $data, ParserContext $ctx) {
                    // сохраняем в БД
                })
            ->AddRule('price', '', '/price',
                function(ParserData $data, ParserContext $ctx) {
                    // Создаем базовую цену и добавляем к товару
                })
            ->AddRule('cid', '', '/categoryId',
                function(ParserData $data, ParserContext $ctx) {
                    // ищем категорию, которая уже в БД и добавляем ассоциацию к товару
                })
            ->AddRule('picture', '', '/picture',
                function(ParserData $data, ParserContext $ctx) {
                    // картинку добавляем в виде ссылки на ресурс, не качаем
                })
            ->AddRule('vendor', '', '/picture',
                function(ParserData $data, ParserContext $ctx) {
                    // производитель это именованное свойство manufactory
                })
            ->AddRule('vendorCode', '', '/vendorCode',
                function(ParserData $data, ParserContext $ctx) {
                    // артикул это именованное свойство artnumber
                })
            ->AddRule('name', '', '/name',
                function(ParserData $data, ParserContext $ctx) {
                    // имя товара
                    $product = $ctx->parentObj();
                    $product->setName($data->getValue());
                })
            ->AddRule('description', '', '/description',
                function(ParserData $data, ParserContext $ctx) {
                    // описание товара
                    $product = $ctx->parentObj();
                    $product->setText($data->getValue());
                })
            ->AddRule('param', '', '/param',
                function(ParserData $data, ParserContext $ctx) {
                    // свойство товара, сначала проверяем на существование само свойство по названию
                    // потом ищем значение свойства

                });
    }

    public function getType(): string
    {
        return 'in';
    }

    public function getId(): string
    {
        return 'ymlparser';
    }
}