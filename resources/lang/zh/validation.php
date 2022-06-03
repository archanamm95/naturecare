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

    'accepted'              => '这 :attribute 必须被接受.',
    'active_url'            => '这 :attribute 不是有效的网址.',
    'after'                 => '这 :attribute 必须是之后的日期 :date.',
    'after_or_equal'        => '这 :attribute 必须是等于或小于等于的日期 :date.',
    'alpha'                 => '这 :attribute 只能包含字母.',
    'alpha_dash'            => '这 :attribute 只能包含字母，数字，破折号和下划线.',
    'alpha_num'             => '这 :attribute 只能包含字母和数字.',
    'array'                 => '这 :attribute 必须是一个数组.',
    'before'                => '这 :attribute 必须是一个日期之前 :date.',
    'before_or_equal'       => '这 :attribute 必须是早于或等于的日期 :date.',
    'between'               => [
        'array'     => '这这这这 :attribute 必须介于 :min and :max items.',
        'file'      => '这这这这 :attribute 必须介于 :min and :max kilobytes.',
        'numeric'   => '这这这这 :attribute 必须介于 :min and :max.',
        'string'    => '这这这这 :attribute 必须介于 :min and :max characters.',
    ],
    'boolean'               => '这这这 :attribute 字段必须为true或false。',
    'confirmed'             => '这这这 :attribute 确认不符.',
    'country'               => '国家',
    'date'                  => '这这这 :attribute 不是有效日期.',
    'date_format'           => '这这这 :attribute 与格式不符 :format.',
    'different'             => '这这这 :attribute and :other 必须不同.',
    'digits'                => '这这这 :attribute 一定是 :digits 数字.',
    'digits_between'        => '这这这 :attribute 必须介于 :min and :max 数字.',
    'dimensions'            => '这这这 :attribute 图片尺寸无效.',这
    'distinct'              => '这这这 :attribute 字段具有重复值.',
    'email'                 => '这这这 :attribute 必须是一个有效的E-mail地址.',
    'ends_with' => '这这 :attribute 必须以下列其中一项结尾: :values',
    'exists'                => '这这 这这选定的 :attribute 是无效的.',
    'file'                  => '这这 :attribute 必须是一个文件.',
    'filled'                => '这这 :attribute 字段必须有一个值.',
    'gt'                    => [
        'array'     => '这这 :attribute 必须超过 :value 项目.',
        'file'      => '这这 :attribute 必须超过 :value kilobytes.',
        'numeric'   => '这这 :attribute 必须超过 :value.',
        'string'    => '这这 :attribute 必须超过 :value 人物.',
    ],
    'gte'                   => [
        'array'     => '这这 :attribute 一定有 :value 项或更多.',
        'file'      => '这这 :attribute 必须大于或等于 :value kilobytes.',
        'numeric'   => '这这 :attribute 必须大于或等于 :value.',
        'string'    => '这这 :attribute 必须大于或等于 :value characters.',
    ],
    'image'                 => '这 :attribute 必须是图像.',
    'in'                    => '这 选定的 :attribute 是无效的.',
    'in_array'              => '这 :attribute 字段不存在于 :other.',
    'integer'               => '这 :attribute 必须是整数.',
    'ip'                    => '这 :attribute 必须是有效的 IP 地址.',
    'ipv4'                  => '这 :attribute 必须是有效的 IPv4 地址.',
    'ipv6'                  => '这 :attribute 必须是有效的 IPv6 地址.',
    'json'                  => '这 :attribute 必须是有效的 JSON 细绳.',
    'lt'                    => [
        'array'     => '这 :attribute 必须少于 :value 项目.',
        'file'      => '这 :attribute 必须少于 :value kilobytes.',
        'numeric'   => '这 :attribute 必须少于 :value.',
        'string'    => '这 :attribute 必须少于 :value 人物.',
    ],
    'lte'                   => [
        'array'     => '这这 :attribute 不得超过 :value 项目.',
        'file'      => '这这 :attribute 不得超过 :value kilobytes.',
        'numeric'   => '这这 :attribute 不得超过 :value.',
        'string'    => '这这 :attribute 不得超过 :value 人物.',
    ],
    'max'                   =>这这 [
        'array'     => '这 :attribute 可能不超过 :max 项目.',
        'file'      => '这 :attribute 可能不超过 :max kilobytes.',
        'numeric'   => '这 :attribute 可能不超过 :max.',
        'string'    => '这 :attribute 可能不超过 :max 人物.',
    ],
    'mimes'                 => 'The :attribute 必须是类型的文件: :values.',
    'mimetypes'             => 'The :attribute 必须是类型的文件: :values.',
    'min'                   => [
        'array'     => '这这这 :attribute 必须至少有 :min 项目.',
        'file'      => '这这这 :attribute 必须至少有 :min kilobytes.',
        'numeric'   => '这这这 :attribute 必须至少有 :min.',
        'string'    => '这这这 :attribute 必须至少有 :min 人物.',
    ],
    'not_in'                => '这这 选定的 :attribute 是无效的.',
    'not_regex'             => '这这 :attribute 格式无效.',
    'numeric'               => '这这 :attribute 必须是一个数字.',
    'present'               => '这这 :attribute 字段必须存在.',
    'regex'                 => '这这 :attribute 格式无效.',
    'required'              => '这这 :attribute 必填项.',
    'required_if'           => '这这 :attribute 何时需要该字段 :other 是 :value.',
    'required_unless'       => '这这 :attribute 必填字段，除非 :other 在 :values.',
    'required_with'         => '这这 :attribute 何时需要该字段 :values 存在.',
    'required_with_all'     => '这这 :attribute 何时需要该字段 :values 存在.',
    'required_without'      => '这这 :attribute 何时需要该字段 :values 不存在.',
    'required_without_all'  => '这这 :attribute 当以下任何一个都不为必填字段时 :values 存在.',
    'same'                  => '这这 :attribute and :other must match.',
    'size'                  => [
        'array'     => '这 :attribute 必须包含 :size 项目.',
        'file'      => '这 :attribute 一定是 :size kilobytes.',
        'numeric'   => '这 :attribute 一定是 :size.',
        'string'    => '这 :attribute 一定是 :size 人物.',
    ],
    'string'                => '这 :attribute 一定是 一个字符串.',
    'timezone'              => '这 :attribute 一定是 有效区域.',
    'unique'                => '这 :attribute 已有人带走了.',
    'uploaded'              => '这 :attribute 上传失败.',
    'url'                   => '这 :attribute 格式无效.',

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
