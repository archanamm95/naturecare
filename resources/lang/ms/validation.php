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

    'accepted'              => 'The :attribute mesti diterima.',
    'active_url'            => 'The :attribute tidak sah URL.',
    'after'                 => 'The :attribute mesti tarikh selepas :date.',
    'after_or_equal'        => 'The :attribute mesti tarikh selepas atau sama dengan :date.',
    'alpha'                 => 'The :attribute mungkin hanya mengandungi huruf.',
    'alpha_dash'            => 'The :attribute hanya boleh mengandungi huruf, angka, tanda hubung dan garis bawah.',
    'alpha_num'             => 'The :attribute hanya boleh mengandungi huruf dan angka.',
    'array'                 => 'The :attribute mestilah array.',
    'before'                => 'The :attribute mesti tarikh sebelum ini :date.',
    'before_or_equal'       => 'The :attribute mesti tarikh sebelum atau sama dengan :date.',
    'between'               => [
        'array'     => 'The :attribute mesti ada antara :min and :max items.',
        'file'      => 'The :attribute mesti ada antara :min and :max kilobytes.',
        'numeric'   => 'The :attribute mesti ada antara :min and :max.',
        'string'    => 'The :attribute mesti ada antara :min and :max characters.',
    ],
    'boolean'               => 'The :attribute bidang mesti betul atau salah.',
    'confirmed'             => 'The :attribute pengesahan tidak sepadan.',
    'country'               => 'Negara',
    'date'                  => 'The :attribute tidak sah date.',
    'date_format'           => 'The :attribute tidak sesuai dengan format :format.',
    'different'             => 'The :attribute and :other mesti berbeza.',
    'digits'                => 'The :attribute mesti :digits digits.',
    'digits_between'        => 'The :attribute mesti antara :min and :max digits.',
    'dimensions'            => 'The :attribute mempunyai dimensi gambar yang tidak sah.',
    'distinct'              => 'The :attribute bidang mempunyai nilai pendua.',
    'email'                 => 'The :attribute Mesti alamat e-mel yang sah.',
    'ends_with' => 'The :attribute mesti diakhiri dengan salah satu perkara berikut: :values',
    'exists'                => 'The terpilih :attribute tidak sah.',
    'file'                  => 'The :attribute mesti fail.',
    'filled'                => 'The :attribute bidang mesti mempunyai nilai.',
    'gt'                    => [
        'array'     => 'The :attribute mesti mempunyai lebih daripada :value items.',
        'file'      => 'The :attribute mesti lebih besar daripada :value kilobytes.',
        'numeric'   => 'The :attribute mesti lebih besar daripada :value.',
        'string'    => 'The :attribute mesti lebih besar daripada :value characters.',
    ],
    'gte'                   => [
        'array'     => 'The :attribute perlu ada :value items or more.',
        'file'      => 'The :attribute mesti lebih besar daripada atau sama :value kilobytes.',
        'numeric'   => 'The :attribute mesti lebih besar daripada atau sama :value.',
        'string'    => 'The :attribute mesti lebih besar daripada atau sama :value characters.',
    ],
    'image'                 => 'The :attribute mesti menjadi imej.',
    'in'                    => 'The terpilih :attribute tidak sah.',
    'in_array'              => 'The :attribute bidang tidak wujud di :other.',
    'integer'               => 'The :attribute mestilah bilangan bulat.',
    'ip'                    => 'The :attribute mesti sah IP address.',
    'ipv4'                  => 'The :attribute mesti sah IPv4 address.',
    'ipv6'                  => 'The :attribute mesti sah IPv6 address.',
    'json'                  => 'The :attribute mesti sah JSON string.',
    'lt'                    => [
        'array'     => 'The :attribute mesti mempunyai kurang daripada :value items.',
        'file'      => 'The :attribute mesti kurang daripada :value kilobytes.',
        'numeric'   => 'The :attribute mesti kurang daripada :value.',
        'string'    => 'The :attribute mesti kurang daripada :value characters.',
    ],
    'lte'                   => [
        'array'     => 'The :attribute mesti tidak mempunyai lebih daripada :value items.',
        'file'      => 'The :attribute mestilah kurang daripada atau sama :value kilobytes.',
        'numeric'   => 'The :attribute mestilah kurang daripada atau sama :value.',
        'string'    => 'The :attribute mestilah kurang daripada atau sama :value characters.',
    ],
    'max'                   => [
        'array'     => 'The :attribute mungkin tidak mempunyai lebih daripada :max items.',
        'file'      => 'The :attribute mungkin tidak lebih besar daripada :max kilobytes.',
        'numeric'   => 'The :attribute mungkin tidak lebih besar daripada :max.',
        'string'    => 'The :attribute mungkin tidak lebih besar daripada :max characters.',
    ],
    'mimes'                 => 'The :attribute mestilah fail jenis: :values.',
    'mimetypes'             => 'The :attribute mestilah fail jenis: :values.',
    'min'                   => [
        'array'     => 'The :attribute mesti mempunyai sekurang-kurangnya :min items.',
        'file'      => 'The :attribute mesti sekurang-kurangnya :min kilobytes.',
        'numeric'   => 'The :attribute mesti sekurang-kurangnya :min.',
        'string'    => 'The :attribute mesti sekurang-kurangnya :min characters.',
    ],
    'not_in'                => 'The terpilih :attribute tidak sah.',
    'not_regex'             => 'The :attribute format tidak sah.',
    'numeric'               => 'The :attribute mesti nombor.',
    'present'               => 'The :attribute padang mesti ada.',
    'regex'                 => 'The :attribute format tidak sah.',
    'required'              => 'The :attribute bidang diperlukan.',
    'required_if'           => 'The :attribute bidang diperlukan ketika :other is :value.',
    'required_unless'       => 'The :attribute bidang diperlukan kecuali :other is in :values.',
    'required_with'         => 'The :attribute bidang diperlukan ketika :values is present.',
    'required_with_all'     => 'The :attribute bidang diperlukan ketika :values is present.',
    'required_without'      => 'The :attribute bidang diperlukan ketika :values is not present.',
    'required_without_all'  => 'The :attribute bidang diperlukan apabila tiada :values are present.',
    'same'                  => 'The :attribute and :other must match.',
    'size'                  => [
        'array'     => 'The :attribute mesti mengandungi :size items.',
        'file'      => 'The :attribute mesti :size kilobytes.',
        'numeric'   => 'The :attribute mesti :size.',
        'string'    => 'The :attribute mesti :size characters.',
    ],
    'string'                => 'The :attribute mesti tali.',
    'timezone'              => 'The :attribute mestilah zon yang sah.',
    'unique'                => 'The :attribute telah diambil.',
    'uploaded'              => 'The :attribute gagal memuat naik.',
    'url'                   => 'The :attribute format tidak sah.',

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

    'custom'    => [
        'attribute-name'    => [
            'rule-name' => 'custom-message',
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

    'attributes'    => [],
]; 
