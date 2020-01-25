<div class="row">
    <form method="post">
        <div class="input-field col s12">
            <select>
                <option value="" disabled>Выбери клиента</option>
                <option value="1" selected>Мария Слепакова</option>
                <option value="2">Александра Григорьева</option>
                <option value="3">Ольга Кондратьева</option>
            </select>
            <label>Клиент</label>
        </div>

        <div class="input-field col s12 l6">
            <input type="text" class="datepicker" id="datepicker" value="2019-12-10"/>
            <label for="datepicker">Дата</label>
        </div>

        <div class="input-field col s12 l6">
            <input type="text" class="timepicker-start" id="timepicker-start"/>
            <label for="timepicker-start">Время начала</label>
        </div>

        <div class="input-field col s12 l6">
            <input type="text" class="timepicker-end" id="timepicker-end"/>
            <label for="timepicker-end">Время окончания</label>
        </div>

        <div class="input-field col s12">
            <button type="submit" class="waves-effect waves-light btn pink">{{ $button_text }}</button>
        </div>
    </form>
</div>
