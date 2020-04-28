<?php
namespace App\Services\Student\Handlers;

use Auth;
/**
 * Created by PhpStorm.
 * User: Rom
 * Date: 28.04.2020
 * Time: 12:36
 */
class CreateStudentHandler
{
    private $studentRepository;

    public function __construct(
        \App\Services\Student\Repositories\StudentRepository $studentRepository
    )
    {
        $this->studentRepository = $studentRepository;
    }

    public function handle($data)
    {

        $data['name'] = ucfirst($data['name']);
        $data['created_by'] = Auth::id();

        return $this->studentRepository->createFromObject($data);
    }


}