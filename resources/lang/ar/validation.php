<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'يجب قبول :attribute.',
    'active_url'           => ':attribute ليست رابط URL صحيح.',
    'after'                => ':attribute يجب أن يكون تاريخًا بعد :date.',
    'after_or_equal'       => ':attribute يجب أن يكون تاريخًا بعد أو يساوي :date.',
    'alpha'                => ':attribute يجب أن يحتوي فقط على أحرف.',
    'alpha_dash'           => ':attribute يجب أن يحتوي فقط على أحرف وأرقام وشرطات.',
    'alpha_num'            => ':attribute يجب أن يحتوي فقط على أحرف وأرقام.',
    'array'                => ':attribute يجب أن يكون مصفوفة.',
    'before'               => ':attribute يجب أن يكون تاريخًا قبل :date.',
    'before_or_equal'      => ':attribute يجب أن يكون تاريخًا قبل أو يساوي :date.',
    'between'              => [
        'numeric' => ':attribute يجب أن يكون بين :min و :max.',
        'file'    => ':attribute يجب أن يكون بين :min و :max كيلوبايت.',
        'string'  => ':attribute يجب أن يكون بين :min و :max حرف.',
        'array'   => ':attribute يجب أن يكون بين :min و :max عنصر.',
    ],
    'boolean'              => ':attribute يجب أن يكون صحيحًا أو خاطئًا.',
    'confirmed'            => 'تأكيد :attribute غير متطابق.',
    'date'                 => ':attribute ليس تاريخًا صحيحًا.',
    'date_format'          => ':attribute لا يطابق التنسيق :format.',
    'different'            => ':attribute و :other يجب أن يكونا مختلفين.',
    'digits'               => ':attribute يجب أن يكون :digits أرقام.',
    'digits_between'       => ':attribute يجب أن يكون بين :min و :max أرقام.',
    'dimensions'           => ':attribute لديه أبعاد صورة غير صحيحة.',
    'distinct'             => ':attribute يحتوي على قيمة مكررة.',
    'email'                => ':attribute يجب أن يكون بريدًا إلكترونيًا صحيحًا.',
    'exists'               => ':attribute موجود بالفعل.',
    'file'                 => ':attribute يجب أن يكون ملفًا.',
    'filled'               => ':attribute يجب أن يحتوي على قيمة.',
    'image'                => ':attribute يجب أن يكون صورة.',
    'in'                   => ':attribute غير صحيح.',
    'in_array'             => ':attribute غير موجود في :other.',
    'integer'              => ':attribute يجب أن يكون عددًا صحيحًا.',
    'ip'                   => ':attribute يجب أن يكون عنوان IP صحيحًا.',
    'ipv4'                 => ':attribute يجب أن يكون عنوان IPv4 صحيحًا.',
    'ipv6'                 => ':attribute يجب أن يكون عنوان IPv6 صحيحًا.',
    'json'                 => ':attribute يجب أن يكون سلسلة JSON صحيحة.',
    'max'                  => [
        'numeric' => ':attribute يجب ألا يزيد عن :max.',
        'file'    => ':attribute يجب ألا يزيد عن :max كيلوبايت.',
        'string'  => ':attribute يجب ألا يزيد عن :max حرف.',
        'array'   => ':attribute يجب ألا يحتوي على أكثر من :max عنصر.',
    ],
    'mimes'                => ':attribute يجب أن يكون ملفًا من نوع: :values.',
    'mimetypes'            => ':attribute يجب أن يكون ملفًا من نوع: :values.',
    'min'                  => [
        'numeric' => ':attribute يجب أن يكون على الأقل :min.',
        'file'    => ':attribute يجب أن يكون على الأقل :min كيلوبايت.',
        'string'  => ':attribute يجب أن يكون على الأقل :min حرف.',
        'array'   => ':attribute يجب أن يحتوي على الأقل :min عنصر.',
    ],
    'not_in'               => ':attribute غير صحيح.',
    'numeric'              => ':attribute يجب أن يكون رقمًا.',
    'present'              => ':attribute يجب أن يكون موجودًا.',
    'regex'                => ':attribute غير صحيح.',
    'required'             => ':attribute مطلوب.',
    'required_if'          => ':attribute مطلوب عندما :other هو :value.',
    'required_unless'      => ':attribute مطلوب ما لم يكن :other في :values.',
    'required_with'        => ':attribute مطلوب عندما يكون :values موجودًا.',
    'required_with_all'    => ':attribute مطلوب عندما يكون :values موجودًا.',
    'required_without'     => ':attribute مطلوب عندما لا يكون :values موجودًا.',
    'required_without_all' => ':attribute مطلوب عندما لا يكون أي من :values موجودًا.',
    'same'                 => ':attribute و :other يجب أن يتطابقا.',
    'size'                 => [
        'numeric' => ':attribute يجب أن يكون :size.',
        'file'    => ':attribute يجب أن يكون :size كيلوبايت.',
        'string'  => ':attribute يجب أن يكون :size حرفًا.',
        'array'   => ':attribute يجب أن يحتوي على :size عنصر.',
    ],
    'string'               => ':attribute يجب أن يكون نصًا.',
    'timezone'             => ':attribute يجب أن يكون منطقة صحيحة.',
    'unique'               => ':attribute مأخوذ بالفعل.',
    'uploaded'             => 'فشل رفع :attribute.',
    'url'                  => ':attribute غير صحيح.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'user' => [
        'replacement_user_id' => [
            'required' => 'يرجى اختيار واحد.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
