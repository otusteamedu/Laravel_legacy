<?php


use v2\ActPrintForm;
use v2\InvoicePrintForm;
use v2\PrintForm\Printer;

// Объект Printer всем заправляет
$printer = new Printer();

// Распечатаем пару счетов
$invoicePrintForm = new InvoicePrintForm();

// InvoiceModel - это Eloquent модель
$invoice1 = InvoiceModel::find(123);
$printer->printToFile($invoicePrintForm, $invoice1);

$invoice2 = InvoiceModel::find(456);
$printer->printToFile($invoicePrintForm, $invoice2);


// Распечатаем пару актов
$actPrintForm = new ActPrintForm();

// ActModel - это Eloquent модель
$act1 = ActModel::find(789);
$printer->printToFile($actPrintForm, $act1);

$act2 = ActModel::find(1000);
$printer->printToFile($actPrintForm, $act2);
