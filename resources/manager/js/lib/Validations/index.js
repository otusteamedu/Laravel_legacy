/**
 * Библиотека языковых констант для валидации форм
 * @param opt
 * @returns {{SNAKE_CASE_ALPHA_EN: string, MAX_FILE: string, MAX_ARRAY: string, MIN_ARRAY: string, MAX_NUMERIC: string, SAME_AS_PASSWORD: string, NUM: string, KEBAB_CASE_ALPHA_EN: string, REQUIRED: string, UNIQUE: string, NUM_DOT: string, ALPHA_NUM: string, EMAIL: string, MIN_STRING: string, IMAGE: string, MIN_NUMERIC: string, CONFIRMED: string, MAX_STRING: string, MIN_FILE: string}}
 */
export default function (opt = null) {
    return {
        ALPHA_NUM: `Поле «${opt.field_name}» может содержать только буквы и цифры.`,
        CONFIRMED: `Поле «${opt.field_name}» должно быть подтверждено.`,
        EMAIL: 'Поле «Email» должно быть действительным адресом электронной почты.',
        IMAGE: `Поле «${opt.field_name}» должно быть изображением.`,
        KEBAB_CASE_ALPHA_EN: `В поле «${opt.field_name}» допускаются только латинские буквы в нижнем регистре, цифры и тире между символами!`,
        SNAKE_CASE_ALPHA_EN: `В поле «${opt.field_name}» допускаются только латинские буквы в нижнем регистре, цифры и нижнее подчеркивание между символами!`,
        MAX_ARRAY: `Количество элементов в поле «${opt.field_name}» не может превышать ${opt.max}.`,
        MAX_FILE: `Размер файла в поле не может быть более ${opt.max} Кб.`,
        MAX_NUMERIC: `Значение поля «${opt.field_name}» не может быть более ${opt.max}.`,
        MAX_STRING: `Поле «${opt.field_name}» должно содержать не более ${opt.max} символов.`,
        MIN_ARRAY: `Количество элементов в поле «${opt.field_name}» не может быть менее ${opt.min}.`,
        MIN_FILE: `Размер файла в поле «${opt.field_name}» не может быть менее ${opt.min} Кб.`,
        MIN_NUMERIC: `Значени поля «${opt.field_name}» не может быть менее ${opt.min}.`,
        MIN_STRING: `Поле «${opt.field_name}» должно содержать не менее ${opt.min} символов.`,
        NUM: `Поле «${opt.field_name} должно содержать только целые цифры.`,
        NUM_DOT: `Поле «${opt.field_name} должно содержать только цифры и точку-разделитель.`,
        REQUIRED: `Поле «${opt.field_name}» обязательно для заполнения.`,
        SAME_AS_PASSWORD: 'Поле «Подтверждение пароля» должно совпадать с полем «Пароль».',
        UNIQUE: `Поле «${opt.field_name}» с таким значение уже существует.`
    }
}
