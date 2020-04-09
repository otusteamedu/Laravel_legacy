<?php


namespace App\Services\Order\Handlers;


class GetOrderCustomerHandler
{
    /**
     * @param array $requestCustomer
     * @return array
     */
    public function handle(array $requestCustomer): array
    {
        return [
            'name' => $this->getFullName($requestCustomer),
            'email' => $requestCustomer['email'],
            'phone' => $this->getPhoneFormat($requestCustomer['phone'])
        ];
    }

    /**
     * @param array $customer
     * @return string
     */
    private function getFullName(array $customer): string
    {
        return $customer['secondName'] . ' ' . $customer['firstName'] . ' ' . $customer['middleName'];
    }

    /**
     * @param string $phone
     * @return string
     */
    private function getPhoneFormat(string $phone): string
    {
        $phoneClean = preg_replace('/[^0-9]/', '', $phone);

        return preg_replace('/^[7]/', '8', $phoneClean);
    }
}
