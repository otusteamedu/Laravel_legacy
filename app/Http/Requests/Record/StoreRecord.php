<?php

namespace App\Http\Requests\Record;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreRecord extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'client_id' => 'required',
            'date' => 'required',
            'time_start' => 'required',
            'time_finish' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'client_id.required' => 'Поле "клиент" обязательно для заполнения.',
            'date.required' => 'Поле "дата" обязательно для заполнения.',
            'time_start.required' => 'Поле "время начала" обязательно для заполнения.',
            'time_finish.required' => 'Поле "время окончания" обязательно для заполнения.',
        ];
    }

    public function getFormData(): array
    {
        $currentUser = \Auth::user();

        $recordData = $this->only(['client_id', 'price']);
        $recordData['master_id'] = $currentUser->id;

        // Transform times (workaround)
        // TODO use datepicker at front-end and send timestamps to back-end
        $unTransformDates = $this->only(['date', 'time_start', 'time_finish']);

        $dateStart = Carbon::createFromFormat('d.m.Y', $unTransformDates['date']);
        $dateFinish = clone $dateStart;
        [$hoursStart, $minutesStart] = explode(':', $unTransformDates['time_start']);
        [$hoursFinish, $minutesFinish] = explode(':', $unTransformDates['time_finish']);

        $dateStart->setHour((int)$hoursStart);
        $dateStart->setMinute((int)$minutesStart);

        $dateFinish->setHour((int)$hoursFinish);
        $dateFinish->setMinute((int)$minutesFinish);

        $recordData['date_start'] = $dateStart->timestamp;
        $recordData['date_finish'] = $dateFinish->timestamp;

        return $recordData;
    }
}
