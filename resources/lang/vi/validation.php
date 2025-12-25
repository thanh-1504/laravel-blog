<?php

return [

    'required' => ':attribute không được để trống.',
    'unique' => ':attribute đã tồn tại.',
    'exists' => ':attribute không hợp lệ.',
    'mimes' => ':attribute phải là file có định dạng: :values.',
    'max' => [
        'file' => ':attribute không được vượt quá :max KB.',
        'string' => ':attribute không được vượt quá :max ký tự.',
    ],

    'attributes' => [
        'title' => 'Tiêu đề',
        'content' => 'Nội dung',
        'category' => 'Danh mục',
        'featured_image' => 'Ảnh bài viết',
    ],
];
